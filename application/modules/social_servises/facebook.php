<?php

class facebook{
    public $settings = array();
    public function __construct() {
        //load settings
        $ci = &get_instance();
        $row = $ci->db->where('name', 'facebook_int')->get('Shop_settings')->row();
        $this->settings = unserialize($row->value);
    }
    function get_settings()
    {
        return $this->settings;
    }
    function parse_signed_request($signed_request, $secret) {
        list($encoded_sig, $payload) = explode('.', $signed_request, 2);
        // decode the data
        $sig = base64_url_decode($encoded_sig);
        $data = json_decode(base64_url_decode($payload), true);

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

    function base64_url_decode($input) {
        return base64_decode(strtr($input, '-_', '+/'));
        }

//        if (parse_signed_request($signed_request, $secret)) {
//        $data = parse_signed_request($signed_request, $secret);
//        $auth_url = "http://www.facebook.com/dialog/oauth?client_id=" . $app_id . "&redirect_uri=" . urlencode($canvas_page);
//        $canvas_page = "http://www.test7.siteimage.com.ua/";
//        if (empty($data["user_id"])) {
//        echo("<script> top.location.href='" . $auth_url . "'</script>");
//        }
//        session_start();
//        $_SESSION['facebook_user'] = $data;
//        $_SESSION['freferer'] = $_SERVER['HTTP_REFERER'];
//        unset($_POST);
//    }

}

?>
