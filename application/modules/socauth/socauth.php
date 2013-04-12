<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 *
 * Класс редиректа удаленных товаров
 */
class Socauth extends MY_Controller {

    public $settings;

    public function __construct() {
        parent::__construct();
        $this->load->module('core');

        $this->settings = $this->db->select('settings')
                ->where('identif', 'socauth')
                ->get('components')
                ->row_array();
        $this->settings = unserialize($this->settings[settings]);
    }

    public function socAuth($social, $id, $username, $email, $address, $key, $phone) {

        $user = $this->db
                ->where('socialId', $id)
                ->get('mod_social')
                ->row();

        if (count($user) == 0) {

            $emailChack = $this->db->where('email', $email)
                    ->get('users', 1)
                    ->row();

            if (count($emailChack) > 0)
                redirect('/socauth');

            $pass = random_string('alnum', 20);

            $this->load->library('email');

            $this->email->from('your@example.com', 'Your Name');
            $this->email->to($email);
            $this->email->subject('Password');
            $this->email->message("Ваш пароль для входа на сайт {$_SERVER[HTTP_HOST]} - $pass");
            $this->email->send();

            $pass = crypt($this->dx_auth->_encode($pass));

            $register = $this->dx_auth->register($username, $pass, $email, $address, $key, $phone);

            if (!$register)
                redirect('/socauth');

            $userId = $this->db
                    ->select('id')
                    ->where('email', $email)
                    ->get('users', 1)
                    ->row();

            $this->db->set('socialId', $id);
            $this->db->set('userId', $userId->id);
            $this->db->set('social', $social);
            $this->db->insert('mod_social');
        }else {
            $data = new stdClass;
            $userData = $this->db
                    ->join('mod_social', 'users.id=mod_social.userId')
                    ->where('email', $email)
                    ->where('socialId', $id)
                    ->get('users', 1)
                    ->row();

            if (count($userData) == 0)
                redirect('/socauth');

            $data->role_id = $userData->role_id;
            $data->id = $userData->userId;
            $data->username = $userData->username;

            $this->dx_auth->_set_session($data);
            $this->dx_auth->_set_last_ip_and_last_login($userData->id);
            $this->dx_auth->_clear_login_attempts();
            $this->dx_auth_event->user_logged_in($userData->id);
        }
        redirect("/shop/profile");
    }

    public function index() {
        \CMSFactory\assetManager::create()
                ->setData($this->settings)
                ->render('buttons', TRUE);
    }

    public function ya() {

        if ($_GET) {
            $postdata = "grant_type=authorization_code&code=$_GET[code]&client_id={$this->settings[yandexClientID]}&client_secret={$this->settings[yandexClientSecret]}";

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, 'https://oauth.yandex.ru/token');
            curl_setopt($curl, CURLOPT_HEADER, 0);
            curl_setopt($curl, CURLOPT_NOBODY, 0);
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $postdata);
            curl_setopt($curl, CURLOPT_REFERER, "http://$_SERVER[HTTP_HOST]/socauth/ya");
            $res = curl_exec($curl);
            $res = json_decode($res);
            curl_close($curl);

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, "https://login.yandex.ru/info?format=json&oauth_token={$res->access_token}");
            curl_setopt($curl, CURLOPT_HEADER, 0);
            curl_setopt($curl, CURLOPT_NOBODY, 0);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_USERAGENT, 'MSIE 9');
            curl_setopt($curl, CURLOPT_REFERER, "$_SERVER[HTTP_HOST]/socauth/ya");
            $res = curl_exec($curl);
            $res = json_decode($res);
            curl_close($curl);

            $this->socAuth('ya', $res->id, $res->display_name, $res->default_email, '', '', '');
        }
        else
            $this->core->error_404();
    }

    public function facebook() {
        if ($_GET) {
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, "https://graph.facebook.com/oauth/access_token?client_id={$this->settings[facebookClientID]}&redirect_uri=http://{$_SERVER[HTTP_HOST]}/socauth/facebook&client_secret={$this->settings[facebookClientSecret]}&code=$_GET[code]");
            curl_setopt($curl, CURLOPT_HEADER, 0);
            curl_setopt($curl, CURLOPT_NOBODY, 0);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_USERAGENT, 'MSIE 9');
            curl_setopt($curl, CURLOPT_REFERER, "$_SERVER[HTTP_HOST]/socauth/facebook");
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
            curl_setopt($curl, CURLOPT_REFERER, "$_SERVER[HTTP_HOST]/socauth/facebook");
            $res = curl_exec($curl);
            curl_close($curl);

            $res = json_decode($res);

            $this->socAuth('fb', $res->id, $res->name, $res->email, $res->location->name, '', '');
        }
        else
            $this->core->error_404();
    }

    public function vk() {
        if ($this->input->get()) {
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, "https://oauth.vk.com/access_token?client_id={$this->settings[vkClientID]}&client_secret={$this->settings[vkClientSecret]}&code=$_GET[code]&redirect_uri=http://$_SERVER[HTTP_HOST]/socauth/vk");
            curl_setopt($curl, CURLOPT_HEADER, 0);
            curl_setopt($curl, CURLOPT_NOBODY, 0);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_USERAGENT, 'MSIE 9');
            curl_setopt($curl, CURLOPT_REFERER, "$_SERVER[HTTP_HOST]/socauth/vk");
            $res = curl_exec($curl);
            $res = json_decode($res);
            curl_close($curl);

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, "https://api.vk.com/method/users.get?uids={$res->user_id}&fields=uid,first_name,last_name,nickname,screen_name,sex,bdate,city,country,timezone,photo,email&access_token={$res->access_token}");
            curl_setopt($curl, CURLOPT_HEADER, 0);
            curl_setopt($curl, CURLOPT_NOBODY, 0);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_USERAGENT, 'MSIE 9');
            curl_setopt($curl, CURLOPT_REFERER, "$_SERVER[HTTP_HOST]/socauth/vk");
            $res = curl_exec($curl);
            $res = json_decode($res);
            curl_close($curl);

            \CMSFactory\assetManager::create()
                    ->setData('data', $res->response[0])
                    ->render('vklogin', TRUE);
        } elseif ($this->input->post()) {
            $this->load->helper(array('form', 'url'));

            $this->load->library('form_validation');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|xss_clean|trim');
            $this->form_validation->run();

            if (!validation_errors())
                $this->socAuth('vk', $this->input->post(uid), $this->input->post(name), $this->input->post(email), '', '', '');
            else
                redirect();
        }
        else
            $this->core->error_404();
    }

    public function google() {
        if ($_GET) {
            $postdata = array(
                'code' => $_GET[code],
                'client_id' => "{$this->settings[googleClientID]}",
                'client_secret' => "{$this->settings[googleClientSecret]}",
                'redirect_uri' => "http://$_SERVER[HTTP_HOST]/socauth/google",
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
            curl_setopt($curl, CURLOPT_REFERER, "http://$_SERVER[HTTP_HOST]");
            $res = curl_exec($curl);
            $res = json_decode($res);

            curl_close($curl);

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, 'https://www.googleapis.com/oauth2/v1/userinfo?access_token=' . $res->access_token);
            curl_setopt($curl, CURLOPT_HEADER, 0);
            curl_setopt($curl, CURLOPT_NOBODY, 0);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_USERAGENT, 'MSIE 9');
            curl_setopt($curl, CURLOPT_REFERER, "http://$_SERVER[HTTP_HOST]/socauth/google");
            $res = curl_exec($curl);
            $res = json_decode($res);

            curl_close($curl);

            $this->socAuth('google', $res->id, $res->name, $res->email, '', '', '');
        }
        else
            $this->core->error_404();
    }

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
                'null' => TRUE)
        );

        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('mod_social');

        $this->db->where('name', 'socauth');
        $this->db->update('components', array(
            'enabled' => 1,
            'autoload' => 1));
    }

    public function _deinstall() {
        $this->load->dbforge();
        ($this->dx_auth->is_admin()) OR exit;
        $this->dbforge->drop_table('mod_social');
    }

    public function twitter() {
        $this->core->error_404();
//        $oauth_nonce = md5(uniqid(rand(), true));
//        $oauth_timestamp = time();
//
//        $oauth_base_text = "GET&";
//        $oauth_base_text .= urlencode($this->settings[twitterRequestTokenURL]) . "&";
//        $oauth_base_text .= urlencode("oauth_callback=" . urlencode($this->settings[twitterCallbackURL]) . "&");
//        $oauth_base_text .= urlencode("oauth_consumer_key=" . $this->settings[twitterConsumerKey] . "&");
//        $oauth_base_text .= urlencode("oauth_nonce=" . $oauth_nonce . "&");
//        $oauth_base_text .= urlencode("oauth_signature_method=HMAC-SHA1&");
//        $oauth_base_text .= urlencode("oauth_timestamp=" . $oauth_timestamp . "&");
//        $oauth_base_text .= urlencode("oauth_version=1.0");
//
//        $key = $this->settings[twitterConsumerKey] . "&";
//
//        $oauth_signature = base64_encode(hash_hmac("sha1", $oauth_base_text, $key, true));
//
//        $url = $this->settings[twitterRequestTokenURL];
//        $url .= '?oauth_callback=' . urlencode($this->settings[twitterCallbackURL]);
//        $url .= '&oauth_consumer_key=' . $this->settings[twitterConsumerKey];
//        $url .= '&oauth_nonce=' . $oauth_nonce;
//        $url .= '&oauth_signature=' . urlencode($oauth_signature);
//        $url .= '&oauth_signature_method=HMAC-SHA1';
//        $url .= '&oauth_timestamp=' . $oauth_timestamp;
//        $url .= '&oauth_version=1.0';
//
//        $response = file_get_contents($url);
//        var_dump($response);
        /*
          $postdata = array(
          'code' => $_GET[code],
          'client_id' => "{$this->settings[googleClientID]}",
          'client_secret' => "{$this->settings[googleClientSecret]}",
          'redirect_uri' => "http://$_SERVER[HTTP_HOST]/socauth/google",
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
          curl_setopt($curl, CURLOPT_REFERER, "http://$_SERVER[HTTP_HOST]");
          $res = curl_exec($curl);
          $res = json_decode($res);
          var_dumps($res);

          curl_close($curl); */
    }

}

/* End of file trash.php */