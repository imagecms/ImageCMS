<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 * Класс авторизации через посторонние сервисы
 * @author a.gula <a.gula@imagecms.net>
 * @property socauth_model $socauth_model
 */
class Socauth extends MY_Controller {

    public $settings;

    public function __construct() {
        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('socauth');
        $this->load->module('core');
        $this->load->model('socauth_model');

        $this->settings = $this->socauth_model->getSettings();
    }

    /**
     * Write cookies for auth
     */
    private function writeCookies() {
        $this->load->helper('cookie');
        if (!strstr($this->uri->uri_string(), 'socauth/vk')) {
            $cookie = array(
                'name' => 'url',
                'value' => $this->uri->uri_string(),
                'expire' => '15000000',
                'prefix' => ''
            );
            $this->input->set_cookie($cookie);
        }
    }

    /**
     *
     * @param string $soc type of social service
     * @param type $socId social service ID
     */
    public function link($soc, $socId) {
        $this->socauth_model->setLink($soc, $socId);

        redirect($this->input->cookie('url'));
    }

    /**
     *
     * @param type $soc type of social service
     */
    public function unlink($soc) {
        if ($this->dx_auth->is_logged_in()) {
            if ($this->socauth_model->delUserSocial($soc)) {
                echo json_encode(array('answer' => 'sucesfull'));
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

            if (count($emailCheck) > 0) {
                redirect('/socauth/error');
            }

            $pass = random_string('alnum', 20);

            //            $this->sendPassByEmail($email, $pass);

            $register = $this->dx_auth->register($username, $pass, $email, $address, $key, $phone, TRUE);

            if (!$register) {
                redirect('/socauth/error');
            }

            $userId = $this->socauth_model->getUserByEmail($email);

            $this->socauth_model->setUserSoc($id, $social, $userId->id);
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
            redirect($this->input->cookie('url'));
        }
    }

    public function index() {
        if (!$this->dx_auth->is_logged_in()) {
            redirect('/auth/login');
        } else {
            redirect($this->input->cookie('url'));
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
                if (!$soc[isMain]) {
                    $social[$soc[social]] = 'linked';
                } else {
                    $social[$soc[social]] = 'main';
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
            $postdata = "grant_type=authorization_code&code={$this->input->get(code)}&client_id={$this->settings[yandexClientID]}&client_secret={$this->settings[yandexClientSecret]}";

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, 'https://oauth.yandex.ru/token');
            curl_setopt($curl, CURLOPT_HEADER, 0);
            curl_setopt($curl, CURLOPT_NOBODY, 0);
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $postdata);
            curl_setopt($curl, CURLOPT_REFERER, "http://{$_SERVER['HTTP_HOST']}/socauth/ya");
            $res = curl_exec($curl);
            $res = json_decode($res);
            curl_close($curl);

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, "https://login.yandex.ru/info?format=json&oauth_token={$res->access_token}");
            curl_setopt($curl, CURLOPT_HEADER, 0);
            curl_setopt($curl, CURLOPT_NOBODY, 0);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_USERAGENT, 'MSIE 9');
            curl_setopt($curl, CURLOPT_REFERER, "{$_SERVER['HTTP_HOST']}/socauth/ya");
            $res = curl_exec($curl);
            $res = json_decode($res);
            curl_close($curl);

            if (!$this->dx_auth->is_logged_in()) {
                $this->socAuth('ya', $res->id, $res->display_name, $res->default_email, '', '', '');
            } else {
                $this->link('ya', $res->id);
            }
        } else {
            $this->core->error_404();
        }
    }

    /**
     * get data from facebook
     */
    public function facebook() {
        if ($this->input->get()) {
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, "https://graph.facebook.com/oauth/access_token?client_id={$this->settings[facebookClientID]}&redirect_uri=http://{$_SERVER['HTTP_HOST']}/socauth/facebook&client_secret={$this->settings[facebookClientSecret]}&code={$this->input->get(code)}");
            curl_setopt($curl, CURLOPT_HEADER, 0);
            curl_setopt($curl, CURLOPT_NOBODY, 0);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_USERAGENT, 'MSIE 9');
            curl_setopt($curl, CURLOPT_REFERER, "{$_SERVER['HTTP_HOST']}/socauth/facebook");
            $res = curl_exec($curl);
            curl_close($curl);

            $params = array();
            parse_str($res, $params);

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, "https://graph.facebook.com/me?access_token={$params[access_token]}");
            curl_setopt($curl, CURLOPT_HEADER, 0);
            curl_setopt($curl, CURLOPT_NOBODY, 0);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_USERAGENT, 'MSIE 9');
            curl_setopt($curl, CURLOPT_REFERER, "{$_SERVER['HTTP_HOST']}/socauth/facebook");
            $res = curl_exec($curl);
            curl_close($curl);

            $res = json_decode($res);

            if (!$this->dx_auth->is_logged_in()) {
                $this->socAuth('fb', $res->id, $res->name, $res->email, $res->location->name, '', '');
            } else {
                $this->link('fb', $res->id);
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
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, "https://oauth.vk.com/access_token?client_id={$this->settings[vkClientID]}&client_secret={$this->settings[vkClientSecret]}&code={$this->input->get(code)}&redirect_uri=http://{$_SERVER['HTTP_HOST']}/socauth/vk");
            curl_setopt($curl, CURLOPT_HEADER, 0);
            curl_setopt($curl, CURLOPT_NOBODY, 0);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_USERAGENT, 'MSIE 9');
            curl_setopt($curl, CURLOPT_REFERER, "{$_SERVER['HTTP_HOST']}/socauth/vk");
            $res = curl_exec($curl);
            $res = json_decode($res);
            curl_close($curl);

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, "https://api.vk.com/method/users.get?uids={$res->user_id}&fields=uid,first_name,last_name,nickname,screen_name,sex,bdate,city,country,timezone,photo,photo_medium,photo_big,email&access_token={$res->access_token}");
            curl_setopt($curl, CURLOPT_HEADER, 0);
            curl_setopt($curl, CURLOPT_NOBODY, 0);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_USERAGENT, 'MSIE 9');
            curl_setopt($curl, CURLOPT_REFERER, "{$_SERVER['HTTP_HOST']}/socauth/vk");
            $res = curl_exec($curl);
            $res = json_decode($res);
            curl_close($curl);

            if ($res->error) {
                $this->error();
            }

            $isRegistereg = $this->db
                ->join('users', 'mod_social.userId=users.id')
                ->where('socialId', $res->response[0]->uid)
                ->get('mod_social', 1)
                ->row();

            if (count($isRegistereg) == 0) {
                \CMSFactory\assetManager::create()
                        ->setData('data', $res->response[0])
                        ->render('vklogin');
            } else {
                $this->socAuth('vk', $res->response[0]->uid, $res->response[0]->first_name . ' ' . $res->response[0]->last_name, $isRegistereg->email, '', '', '');
            }
        } elseif ($this->input->post()) {
            $this->load->helper(array('form', 'url'));

            $this->load->library('form_validation');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|xss_clean|trim');
            $this->form_validation->run();

            if (!validation_errors()) {
                if (!$this->dx_auth->is_logged_in()) {
                    $this->socAuth('vk', $this->input->post('uid'), $this->input->post('name'), $this->input->post('email'), '', '', '');
                } else {
                    $this->link('vk', $this->input->post('uid'));
                }
            } else {
                redirect();
            }
        } else {
            $this->core->error_404();
        }
    }

    /**
     * get data from google
     */
    public function google() {

        if ($this->input->get()) {

            $postdata = array(
                'code' => $this->input->get(code),
                'client_id' => "{$this->settings[googleClientID]}",
                'client_secret' => "{$this->settings[googleClientSecret]}",
                'redirect_uri' => "http://{$_SERVER['HTTP_HOST']}/socauth/google",
                'grant_type' => 'authorization_code'
            );

            $opts = array(
                'http' => array(
                    'method' => 'POST',
                    'header' => 'Content-type:application/x-www-form-urlencoded',
                    'content' => $postdata
                )
            );

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, 'https://accounts.google.com/o/oauth2/token');
            curl_setopt($curl, CURLOPT_HEADER, 0);
            curl_setopt($curl, CURLOPT_NOBODY, 0);
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $postdata);
            curl_setopt($curl, CURLOPT_REFERER, "http://{$_SERVER['HTTP_HOST']}");
            $res = curl_exec($curl);
            $res = json_decode($res);

            curl_close($curl);

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, 'https://www.googleapis.com/oauth2/v1/userinfo?access_token=' . $res->access_token);
            curl_setopt($curl, CURLOPT_HEADER, 0);
            curl_setopt($curl, CURLOPT_NOBODY, 0);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_USERAGENT, 'MSIE 9');
            curl_setopt($curl, CURLOPT_REFERER, "http://{$_SERVER['HTTP_HOST']}/socauth/google");
            $res = curl_exec($curl);
            $res = json_decode($res);

            curl_close($curl);

            if (!$this->dx_auth->is_logged_in()) {
                $this->socAuth('google', $res->id, $res->name, $res->email, '', '', '');
            } else {
                $this->link('google', $res->id);
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
        $fields = array(
            'id' => array(
                'type' => 'INT',
                'auto_increment' => TRUE),
            'socialId' => array(
                'type' => 'VARCHAR',
                'constraint' => '30',
                'null' => TRUE),
            'userId' => array(
                'type' => 'VARCHAR',
                'constraint' => '25',
                'null' => TRUE),
            'social' => array(
                'type' => 'VARCHAR',
                'constraint' => '20',
                'null' => TRUE),
            'isMain' => array(
                'type' => 'INT',
                'constraint' => '1',
                'null' => TRUE)
        );

        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('mod_social');

        $this->db->where('name', 'socauth');
        $this->db->update(
            'components',
            array(
            'enabled' => 1,
            'autoload' => 0)
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