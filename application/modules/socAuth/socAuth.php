<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 *
 * Класс редиректа удаленных товаров
 */
class socAuth extends MY_Controller {

    public $settings;

    public function __construct() {
        parent::__construct();
        $this->load->module('core');

        $this->settings = $this->db->select('settings')
                ->where('identif', 'socAuth')
                ->get('components')
                ->row_array();
        $this->settings = unserialize($this->settings[settings]);
    }

    public function index() {
        var_dump(site_url());
        var_dump($_SERVER[HTTP_HOST]);
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
            curl_setopt($curl, CURLOPT_REFERER, "http://$_SERVER[HTTP_HOST]/socAuth/ya");
            $res = curl_exec($curl);
            $res = json_decode($res);
            var_dumps($res);
            curl_close($curl);

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, "https://login.yandex.ru/info?format=json&oauth_token={$res->access_token}");
            curl_setopt($curl, CURLOPT_HEADER, 0);
            curl_setopt($curl, CURLOPT_NOBODY, 0);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_USERAGENT, 'MSIE 9');
            curl_setopt($curl, CURLOPT_REFERER, "$_SERVER[HTTP_HOST]/socAuth/ya");
            $res = curl_exec($curl);
            $res = json_decode($res);
            var_dumps($res);
            curl_close($curl);
        }
        else
            $this->core->error_404();
    }

    public function facebook() {
        if ($_GET) {
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, "https://graph.facebook.com/oauth/access_token?client_id={$this->settings[facebookClientID]}&redirect_uri=http://{$_SERVER[HTTP_HOST]}/socAuth/facebook&client_secret={$this->settings[facebookClientSecret]}&code=$_GET[code]");
            curl_setopt($curl, CURLOPT_HEADER, 0);
            curl_setopt($curl, CURLOPT_NOBODY, 0);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_USERAGENT, 'MSIE 9');
            curl_setopt($curl, CURLOPT_REFERER, "$_SERVER[HTTP_HOST]/socAuth/facebook");
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
            curl_setopt($curl, CURLOPT_REFERER, "$_SERVER[HTTP_HOST]/socAuth/facebook");
            $res = curl_exec($curl);
            curl_close($curl);

            $res = json_decode($res);
            var_dumps($res);
        }
        else
            $this->core->error_404();
    }

    public function vk() {
        if ($_GET) {
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, "https://oauth.vk.com/access_token?client_id={$this->settings[vkClientID]}&client_secret={$this->settings[vkClientSecret]}&code=$_GET[code]&redirect_uri=http://$_SERVER[HTTP_HOST]/socAuth/vk");
            curl_setopt($curl, CURLOPT_HEADER, 0);
            curl_setopt($curl, CURLOPT_NOBODY, 0);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_USERAGENT, 'MSIE 9');
            curl_setopt($curl, CURLOPT_REFERER, "$_SERVER[HTTP_HOST]/socAuth/vk");
            $res = curl_exec($curl);
            $res = json_decode($res);
            var_dumps($res);
            curl_close($curl);

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, "https://api.vk.com/method/users.get?uids={$res->user_id}&fields=uid,first_name,last_name,nickname,screen_name,sex,bdate,city,country,timezone,photo&access_token={$res->access_token}");
            curl_setopt($curl, CURLOPT_HEADER, 0);
            curl_setopt($curl, CURLOPT_NOBODY, 0);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_USERAGENT, 'MSIE 9');
            curl_setopt($curl, CURLOPT_REFERER, "$_SERVER[HTTP_HOST]/socAuth/vk");
            $res = curl_exec($curl);
            $res = json_decode($res);
            var_dumps($res);
            curl_close($curl);
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
                'redirect_uri' => "http://$_SERVER[HTTP_HOST]/socAuth/google",
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

            curl_close($curl);

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, 'https://www.googleapis.com/oauth2/v1/userinfo?access_token=' . $res->access_token);
            curl_setopt($curl, CURLOPT_HEADER, 0);
            curl_setopt($curl, CURLOPT_NOBODY, 0);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_USERAGENT, 'MSIE 9');
            curl_setopt($curl, CURLOPT_REFERER, "http://$_SERVER[HTTP_HOST]/socAuth/google");
            $res = curl_exec($curl);
            $res = json_decode($res);

            var_dumps($res);

            curl_close($curl);
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
                'constraint' => '15',
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
        $this->dbforge->create_table('social');

        $this->db->where('name', 'social');
        $this->db->update('components', array('enabled' => 0, 'autoload' => 1));
    }

    public function _deinstall() {
        $this->load->dbforge();
        ($this->dx_auth->is_admin()) OR exit;
        $this->dbforge->drop_table('social');
    }

    public function twitter() {
        $oauth_nonce = md5(uniqid(rand(), true));
        $oauth_timestamp = time();

        $oauth_base_text = "GET&";
        $oauth_base_text .= urlencode($this->settings[twitterRequestTokenURL]) . "&";
        $oauth_base_text .= urlencode("oauth_callback=" . urlencode($this->settings[twitterCallbackURL]) . "&");
        $oauth_base_text .= urlencode("oauth_consumer_key=" . $this->settings[twitterConsumerKey] . "&");
        $oauth_base_text .= urlencode("oauth_nonce=" . $oauth_nonce . "&");
        $oauth_base_text .= urlencode("oauth_signature_method=HMAC-SHA1&");
        $oauth_base_text .= urlencode("oauth_timestamp=" . $oauth_timestamp . "&");
        $oauth_base_text .= urlencode("oauth_version=1.0");

        $key = $this->settings[twitterConsumerKey] . "&";

        $oauth_signature = base64_encode(hash_hmac("sha1", $oauth_base_text, $key, true));

        $url = $this->settings[twitterRequestTokenURL];
        $url .= '?oauth_callback=' . urlencode($this->settings[twitterCallbackURL]);
        $url .= '&oauth_consumer_key=' . $this->settings[twitterConsumerKey];
        $url .= '&oauth_nonce=' . $oauth_nonce;
        $url .= '&oauth_signature=' . urlencode($oauth_signature);
        $url .= '&oauth_signature_method=HMAC-SHA1';
        $url .= '&oauth_timestamp=' . $oauth_timestamp;
        $url .= '&oauth_version=1.0';

        $response = file_get_contents($url);
        var_dump($response);
        /*
          $postdata = array(
          'code' => $_GET[code],
          'client_id' => "{$this->settings[googleClientID]}",
          'client_secret' => "{$this->settings[googleClientSecret]}",
          'redirect_uri' => "http://$_SERVER[HTTP_HOST]/socAuth/google",
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