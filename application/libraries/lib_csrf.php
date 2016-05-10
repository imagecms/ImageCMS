<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Image CMS
 * CSRF Library Beta.
 */
class Lib_csrf
{

    public $ci = NULL;

    private $enc_key = '';

    private $tokens = [];     // User token.

    private $sess_id = NULL;     // Session id.

    private $hidden_name = 'cms_token';

    private $max_tokens = 10;

    public $log_errors = FALSE;

    public $log_ajax_requests = FALSE;

    public function __construct() {
        $this->ci = &get_instance();

        $this->_generate_token();

        if ($this->check_token() === FALSE) {
            if ($this->log_errors === TRUE) {
                $this->_write_message('Wrong code.');
            }

            $err_text = 'Подозрение на атаку Cross-Site Request Forgery.';
            show_error($err_text);
            die();
        }
    }

    private function addDisabledCsrfUrls() {

        // Diable CSRF library form web money service
        $ci = $this->ci;
        if ($ci->uri->segment(1) == 'shop' && $ci->uri->segment(2) == 'cart' && $ci->uri->segment(3) == 'view' && $ci->input->get('result') == 'true' && $ci->input->get('pm') > 0) {
            define('ICMS_DISBALE_CSRF', true);
        }
        // Support for robokassa
        if ($ci->uri->segment(1) == 'shop' && $ci->uri->segment(2) == 'cart' && $ci->uri->segment(3) == 'view' && $ci->input->get('getResult') == 'true') {
            define('ICMS_DISBALE_CSRF', true);
        }
        if ($ci->uri->segment(1) == 'exchange') {
            define('ICMS_DISBALE_CSRF', true);
        }
        // Support for privat
        if ($ci->uri->segment(1) == 'shop' && $ci->uri->segment(2) == 'order' && $ci->uri->segment(3) == 'view' && $ci->input->post()) {
            define('ICMS_DISBALE_CSRF', true);
        }
        if ($ci->uri->segment(1) == 'shop' && $ci->uri->segment(2) == 'cart' && $ci->uri->segment(3) == 'view' && $ci->input->get('succes') == 'true') {
            define('ICMS_DISBALE_CSRF', true);
        }
        if ($ci->uri->segment(1) == 'shop' && $ci->uri->segment(2) == 'cart' && $ci->uri->segment(3) == 'view' && $ci->input->get('fail') == 'true') {
            define('ICMS_DISBALE_CSRF', true);
        }
        if ($ci->input->server('HTTP_REFERER') AND strpos($ci->input->server('HTTP_REFERER') . '', 'facebook.com')) {
            define('ICMS_DISBALE_CSRF', true);
        }
        if ($ci->input->server('HTTP_REFERER') AND strpos($ci->input->server('HTTP_REFERER') . '', 'facebook.com')) {
            define('ICMS_DISBALE_CSRF', true);
        }
        // Support for privat

        if ($ci->uri->segment(1) == 'shop' && $ci->uri->segment(2) == 'order' && $ci->uri->segment(3) == 'view') {
            define('ICMS_DISBALE_CSRF', true);
        }
        //new payment system
        if (preg_match('/payment_method_/i', $ci->uri->segment(1)) || preg_match('/payment_method_/i', $ci->uri->segment(2))) {
            define('ICMS_DISBALE_CSRF', true);
        }
        if ($ci->uri->segment(1) == 'facebook_store' && $ci->uri->segment(2) == 'auth_from_fb_store') {
            define('ICMS_DISBALE_CSRF', true);
        }

        if ($ci->uri->segment(4) == 'xbanners') {
            define('ICMS_DISBALE_CSRF', true);
        }
    }

    private function check_token() {
        $this->addDisabledCsrfUrls();
        if (count($_POST) > 0) {
            if (defined('ICMS_DISBALE_CSRF') AND ICMS_DISBALE_CSRF === TRUE) {
                return TRUE;
            }
            // Don't check ajax requests
            if (isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
                if (strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                    if ($this->log_ajax_requests === TRUE) {
                        $this->_write_message('Ajax Request');
                    }
                    return TRUE;
                }
            }

            $post_token = $this->ci->input->post($this->hidden_name);

            if (array_search($post_token, $this->tokens) == FALSE) {
                if ($this->tokens[0] != $post_token) {
                    return FALSE;
                }
            }
        }

        return TRUE;
    }

    /**
     * Create input hidden
     */
    public function create_hidden_html() {
        return '<input type="hidden" value="' . $this->get_token() . '" name="' . $this->hidden_name . '" />';
    }

    /**
     * @param string $text
     */
    private function _write_message($text) {
        $this->ci->load->helper('file');

        $post_data = '<br/>Post data:<br/>';
        foreach ($_POST as $k => $v) {
            $post_data .= $k . ': ' . $v . '<br/>';
        }

        $request_uri = 'Request uri: ' . $_SERVER['REQUEST_URI'] . '<br/><br/>';

        $new_text = '<p>' . date('d-m-Y H:i:s') . ' IP:' . $_SERVER['REMOTE_ADDR'] . ' Referer: ' . $_SERVER['HTTP_REFERER'] . '<br/>' . $request_uri . $text . $post_data . '<br/>________________</p>';

        @write_file('./application/logs/csrf.html', $new_text, 'a');
    }

    private function _generate_token() {
        $this->sess_id = $this->_get_sess_id();
        $n_token = md5($this->sess_id . $this->enc_key);

        $this->tokens = $this->ci->session->userdata('ci_tokens');

        if (is_array($this->tokens) AND count($this->tokens) > $this->max_tokens) {
            $this->tokens = array_slice($this->tokens, -3, 3);
        }

        if (is_array($this->tokens)) {
            if (array_search($n_token, $this->tokens) === FALSE) {
                $this->tokens[] = $n_token;
            }
        } else {
            $this->tokens = [];
            $this->tokens[] = $n_token;
        }

        $this->ci->session->set_userdata('ci_tokens', $this->tokens);
    }

    public function get_token() {
        if (count($this->tokens) == 0) {
            $this->_generate_token();
        }
        return array_pop($this->tokens);
    }

    private function _get_sess_id() {
        return $this->ci->session->userdata('session_id');
    }

}

/* End of file lib_csfr.php */