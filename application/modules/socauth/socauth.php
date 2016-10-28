<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 * Класс авторизации через посторонние сервисы
 * @author a.gula <a.gula@imagecms.net>
 * @property socauth_model $socauth_model
 */


use OAuth\Common\Consumer\Credentials;
use OAuth\Common\Http\Uri;
use OAuth\Common\Storage\Session;
use OAuth\OAuth2\Service\Facebook;
use OAuth\OAuth2\Service\Vkontakte;

/**
 * @property Socauth_model socauth_model
 */
class Socauth extends MY_Controller
{

    public $settings;

    public $serviceFactory;

    public $uriFactory;

    public $currentUri;

    public function __construct() {

        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('socauth');
        $this->load->module('core');
        $this->load->model('socauth_model');

        $this->settings = $this->socauth_model->getSettings();
        $this->serviceFactory = new \OAuth\ServiceFactory();
        $this->uriFactory = new Uri\UriFactory();
        $this->currentUri = $this->uriFactory->createFromSuperGlobalArray($_SERVER);
        $this->currentUri->setQuery('');
    }

    /**
     *
     * @param type $soc type of social service
     */
    public function unlink($soc) {

        if ($this->dx_auth->is_logged_in()) {
            if ($this->socauth_model->delUserSocial($soc)) {
                echo json_encode(['answer' => 'sucesfull']);
            }
        }
    }

    /**
     * Just alias (not action, because starts from "_", and now accessable in system)
     */
    public function _socAuth($social, $id, $username, $email, $address, $key, $phone, $redirect = true) {

        return $this->socAuth($social, $id, $username, $email, $address, $key, $phone, $redirect);
    }

    /**
     *
     * @param type $social social service ID
     * @param type $id social service ID
     * @param type $username name in social service
     * @param type $email email in social service
     * @param type $address address in social service
     * @param type $key
     * @param type $phone phone in social service
     */
    private function socAuth($social, $id, $username, $email, $address, $key, $phone, $redirect = true) {

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            redirect('/socauth/error');
        }

        $user = $this->socauth_model->getUserSocInfoBySocId($id);

        if (count($user) == 0) {

            $emailCheck = $this->socauth_model->getUserByEmail($email);

            if (count($emailCheck) > 0 ) {

                redirect('/socauth/error');
            }

            $pass = random_string('alnum', 20);

                $register = $this->dx_auth->register($username, $pass, $email, $address, $key, $phone, TRUE);
            if (!$register) {
                redirect('/socauth/error');
            }

            $userId = $this->socauth_model->getUserByEmail($email);

            $this->socauth_model->setUserSoc($id, $social, $userId['id']);
        } else {
            $data = new stdClass;
            $userData = $this->db
                ->join('mod_social', 'users.id=mod_social.userId')
                ->where('socialId', $id)
                ->get('users', 1)
                ->row();

            if (count($userData) == 0) {
                redirect('/socauth/error');
            }

            $data->role_id = $userData->role_id;
            $data->id = $userData->userId;
            $data->username = $userData->username;

            $this->dx_auth->_set_session($data);
            $this->dx_auth->_set_last_ip_and_last_login($userData->id);
            $this->dx_auth->_clear_login_attempts();
            $this->dx_auth_event->user_logged_in($userData->id);
        }
        if ($redirect) {

            $url = $this->input->cookie('url');
            $this->jsOpenPopap($url);
        }
    }

    public function index() {

        if (!$this->dx_auth->is_logged_in()) {
            redirect('/auth/login');
        } else {
            redirect($this->input->cookie('url'));
        }
    }

    /**
     * rendering login buttons
     */
    public function renderLogin() {

        if (!$this->dx_auth->is_logged_in()) {
            $this->writeCookies();
            \CMSFactory\assetManager::create()
                ->setData($this->settings)
                ->render('loginButtons', TRUE);
        }
    }

    /**
     * Write cookies for auth
     */
    private function writeCookies() {

        $this->load->helper('cookie');
        if (!strstr($this->uri->uri_string(), 'socauth/vk')) {
            $cookie = [
                       'name'   => 'url',
                       'value'  => $this->input->server('HTTP_REFERER'),
                       'expire' => '15000000',
                       'prefix' => '',
                      ];
            $this->input->set_cookie($cookie);
        }
    }

    /**
     * rendering link buttons
     */
    public function renderLink() {

        if ($this->dx_auth->is_logged_in()) {
            $this->writeCookies();

            $socials = $this->db
                ->where('userId', $this->dx_auth->get_user_id())
                ->get('mod_social');

            if (!$socials) {
                return;
            }

            $socials = $socials->result_array();

            foreach ($socials as $soc) {
                if (!$soc['isMain']) {
                    $social[$soc['social']] = 'linked';
                } else {
                    $social[$soc['social']] = 'main';
                }
            }

            \CMSFactory\assetManager::create()
                ->setData($this->settings)
                ->setData($social)
                ->registerScript('socauth')
                ->render('linkButtons', TRUE);
        }
    }

    /**
     * get data from yandex
     */
    public function ya() {

        if ($this->input->get()) {

            $params = [
                       'grant_type'    => 'authorization_code',
                       'code'          => $this->input->get('code'),
                       'client_id'     => $this->settings['yandexClientID'],
                       'client_secret' => $this->settings['yandexClientSecret'],
                      ];
            $url = 'https://oauth.yandex.ru/token';
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, urldecode(http_build_query($params)));
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            $result = curl_exec($curl);
            curl_close($curl);
            $tokenInfo = json_decode($result, true);

            if (isset($tokenInfo['access_token'])) {
                $params = [
                           'format'      => 'json',
                           'oauth_token' => $tokenInfo['access_token'],
                          ];

                $userInfo = json_decode(file_get_contents('https://login.yandex.ru/info?' . urldecode(http_build_query($params))), true);

            }
            if (!$this->dx_auth->is_logged_in()) {
                $this->socAuth('ya', $userInfo['id'], $userInfo['real_name'], $userInfo['default_email'], '', '', '');
            } else {
                $this->link('ya', $userInfo['id']);
            }
        } else {
            $this->core->error_404();
        }
    }

    /**
     *
     * @param string $soc type of social service
     * @param string $socId social service ID
     * @param bool $redirect
     */
    public function link($soc, $socId, $redirect = true) {

        $this->socauth_model->setLink($soc, $socId);

        if ($this->settings['URLredirect']) {
            redirect(site_url() . $this->settings['URLredirect']);
        }

        if ($redirect) {

            $url = $this->input->cookie('url');
            $this->jsOpenPopap($url);

        } else {

            redirect($this->input->cookie('url'));
        }

    }

    /**
     * @param string $url
     */
    private function jsOpenPopap($url) {

        echo "<script type='text/javascript'>";
        echo "(function(){
                if(window.opener !== null){
                    window.opener.location.assign(\" $url \");
                    window.close();
                }else{
                    window.location.assign(\" $url \");
                }
            })()";
        echo '</script>';

    }

    /**
     * get data from facebook
     */
    public function facebook() {

        if ($this->input->get()) {
            $storage = new Session();

            $credentials = new Credentials(
                $this->settings['facebookClientID'],
                $this->settings['facebookClientSecret'],
                $this->currentUri->getAbsoluteUri()
            );

            /** @var $facebookService Facebook */
            $facebookService = $this->serviceFactory->createService('facebook', $credentials, $storage);

            if (!empty($this->input->get('code'))) {

                $state = $this->input->get('state') ?: null;

                $token = $facebookService->requestAccessToken($this->input->get('code'), $state);

                $result = json_decode($facebookService->request('/me?fields=email,name,location'), true);

            }

            if (!$this->dx_auth->is_logged_in()) {
                $this->socAuth('fb', $result['id'], $result['name'], $result['email'], $result['location']['name'], '', '');
            } else {
                $this->link('fb', $result['id']);
            }
        } else {
            $this->core->error_404();
        }
    }

    /**
     * get data from Vkontakte
     */
    public function vk() {

        $this->core->set_meta_tags('SocAuts');
        if ($this->input->get()) {

            $storage = new Session();

            $credentials = new Credentials(
                $this->settings['vkClientID'],
                $this->settings['vkClientSecret'],
                $this->currentUri->getAbsoluteUri()
            );

            /** @var $vkService Vkontakte */
            $vkService = $this->serviceFactory->createService('vkontakte', $credentials, $storage);

            if (!empty($this->input->get('code'))) {
                $token = $vkService->requestAccessToken($this->input->get('code'));
                $result = json_decode($vkService->request('/users.get?v=5.80&fields=city,country'), true);
            }

            $address = $result['response'][0]['city']['title'] . ' ' . $result['response'][0]['country']['title'];

            if (!$this->dx_auth->is_logged_in()) {
                $this->socAuth('vk', $token->getExtraParams()['user_id'], $result['response'][0]['first_name'], $token->getExtraParams()['email'], $address, '', '');
            } else {
                $this->link('vk', $token->getExtraParams()['user_id']);
            }
        } else {
            $this->core->error_404();
        }
    }

    public function error() {

        $this->core->set_meta_tags('SocAuts');

        if (!$this->dx_auth->is_logged_in()) {
            redirect('/auth/login');
        } else {
            redirect($this->input->cookie('url'));
        }
    }

    /**
     * get data from google
     */
    public function google() {

        if ($this->input->get()) {
            $storage = new Session();
            $credentials = new Credentials(
                $this->settings['googleClientID'],
                $this->settings['googleClientSecret'],
                $this->currentUri->getAbsoluteUri()
            );
            /** @var $googleService Google */
            $googleService = $this->serviceFactory->createService('google', $credentials, $storage, ['userinfo_email', 'userinfo_profile']);
            if (!empty($this->input->get('code'))) {
                $state = $this->input->get('state') ?: null;
                $googleService->requestAccessToken($this->input->get('code'), $state);

                $result = json_decode($googleService->request('userinfo'), true);

            }

            if (!$this->dx_auth->is_logged_in()) {
                $this->socAuth('google', $result['id'], $result['name'], $result['email'], '', '', '');
            } else {
                $this->link('google', $result['id']);
            }
        } else {
            $this->core->error_404();
        }
    }

    /**
     * install method
     */
    public function _install() {

        $this->load->dbforge();
        ($this->dx_auth->is_admin()) OR exit;
        $fields = [
                   'id'       => [
                                  'type'           => 'INT',
                                  'auto_increment' => TRUE,
                                 ],
                   'socialId' => [
                                  'type'       => 'VARCHAR',
                                  'constraint' => '30',
                                  'null'       => TRUE,
                                 ],
                   'userId'   => [
                                  'type'       => 'VARCHAR',
                                  'constraint' => '25',
                                  'null'       => TRUE,
                                 ],
                   'social'   => [
                                  'type'       => 'VARCHAR',
                                  'constraint' => '20',
                                  'null'       => TRUE,
                                 ],
                   'isMain'   => [
                                  'type'       => 'INT',
                                  'constraint' => '1',
                                  'null'       => TRUE,
                                 ],
                  ];

        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('mod_social');

        $this->db->where('name', 'socauth');
        $this->db->update(
            'components',
            [
             'enabled'  => 1,
             'autoload' => 0,
            ]
        );
    }

    /**
     * deinstall method
     */
    public function _deinstall() {

        $this->load->dbforge();
        ($this->dx_auth->is_admin()) OR exit;
        $this->dbforge->drop_table('mod_social');
    }

}

/* End of file socauth.php */