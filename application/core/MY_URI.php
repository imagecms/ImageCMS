<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class MY_URI extends CI_URI {

    private $GET_params_arr = [];

    public function __construct() {
        parent::__construct();
    }

    public function getParam($key) {
        parse_str($this->input->server('QUERY_STRING'), $this->GET_params_arr);
        return $this->GET_params_arr[$key];
    }

    public function getAllParams() {
        parse_str($this->input->server('QUERY_STRING'), $this->GET_params_arr);
        return $this->GET_params_arr;
    }

    // Create from array string like: ?var1=value&var2=value

    public function array_to_uri($arr = []) {
        $n = 0;
        $str = '?';
        $cnt = count($arr);

        if ($cnt > 0) {
            foreach ($arr as $k => $v) {
                $str .= $k . '=' . $v;
                $n++;
                if ($n < $cnt) {
                    $str .= '&';
                }
            }
        }

        return $str;
    }

    /**
     * Enable Russian charaters in url
     */
    public function _filter_uri($str) {
        if ($str != '' AND $this->config->item('permitted_uri_chars') != '') {
            if (!preg_match("|^[" . ($this->config->item('permitted_uri_chars')) . "]+$|iu", rawurlencode($str))) {
                exit('The URI you submitted has disallowed characters.');
            }
        }

        return $str;
    }

    /**
     * Get host name
     * @param bool $withoutWWW
     * @return mixed
     */
    public function getHost($withoutWWW = false) {
        $host = CI::$APP->input->server('HTTP_HOST');
        return $withoutWWW ? str_replace('www.', '', $host) : $host;
    }

    /**
     * Returns base url
     * @return string
     */
    public function getBaseUrl() {
        $pageURL = (CI::$APP->input->server("HTTPS") == "on") ? "https://" : "http://";

        return $pageURL . $this->getHost();
    }

}

/* End of file MY_URI.php */