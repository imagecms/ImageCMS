<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Image CMS
 *
 * Module Sample
 */
class Social_servises extends MY_Controller {

    public $fsettings = array();

    public function __construct() {
        parent::__construct();
        //$this->load->module('core');
        $ci = &get_instance();
        $row = $ci->db->where('name', 'facebook_int')->get('shop_settings')->row();
        $this->fsettings = unserialize($row->value);
    }

    public function index() {
        
    }

    public function autoload() {
        if (isset($_POST['signed_request'])) {
            //if (isset($_GET['a'])) {
            $this->auth($_POST['signed_request']);
        }
        if (strpos($_SERVER['HTTP_REFERER'] . "", 'vk.com')) {
            $this->vauth();
        }
    }

    private function display_tpl($file = '') {
        $file = realpath(dirname(__FILE__)) . '/templates/public/' . $file . '.tpl';
        $this->template->display('file:' . $file);
    }

    private function fetch_tpl($file = '') {
        $file = realpath(dirname(__FILE__)) . '/templates/public/' . $file . '.tpl';
        return $this->template->fetch('file:' . $file);
    }

    private function auth($signed_request) {
        if ($this->parse_signed_request($signed_request, $this->fsettings['secretkey'])) {
            $data = $this->parse_signed_request($signed_request, $this->fsettings['secretkey']);
            session_start();
            $_SESSION['facebook_user'] = $data;
            $_SESSION['freferer'] = $_SERVER['HTTP_REFERER'];
        } else {
            echo "Проверьте настройки интеграции с facebook";
            exit();
            //$this->core->error_404();
        }
    }

    function get_fsettings() {
        return $this->fsettings;
    }

    public function parse_signed_request($signed_request = Null, $secret) {
        list($encoded_sig, $payload) = explode('.', $signed_request, 2);
        // decode the data
        $sig = $this->base64_url_decode($encoded_sig);
        $data = json_decode($this->base64_url_decode($payload), true);

        if (strtoupper($data['algorithm']) !== 'HMAC-SHA256') {
            error_log('Unknown algorithm. Expected HMAC-SHA256');
            return null;
        }

        // check sig
        $expected_sig = hash_hmac('sha256', $payload, $secret, $raw = true);
        if ($sig !== $expected_sig) {
            error_log('Bad Signed JSON signature!');
            return null;
        }
        return $data;
    }

    public function base64_url_decode($input) {
        return base64_decode(strtr($input, '-_', '+/'));
    }

    private function vauth() {
        session_start();
        $_SESSION['vreferer'] = $_SERVER['HTTP_REFERER'];
        if (isset($_GET['viewer_id']))
            $_SESSION['vk_user'] = $_GET['viewer_id'];
    }

}
?>



