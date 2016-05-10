<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

if (!function_exists('media_url')) {

    /**
     * @param string|array $url
     * @return string
     */
    function media_url($url = '') {

        $CI = &get_instance();
        /* @var $config CI_Config */
        $config = $CI->config;

        if (is_array($url)) {
            $url = implode('/', $url);
        }

        $index_page = $config->slash_item('index_page');
        if ($index_page === '/') {
            $index_page = '';
        }

        if ($CI->uri->segment(1) == MY_Controller::getCurrentLocale()) {
            $lenstr = strlen(MY_Controller::getCurrentLocale() . '/');
            $cut = 0 - (int) $lenstr;
            $mediaUrl = substr($config->slash_item('base_url'), 0, $cut);
            $return = $mediaUrl . $index_page . preg_replace('|^/*(.+?)/*$|', "\\1", $url);
        } else {
            $return = $config->slash_item('base_url') . $index_page . preg_replace('|^/*(.+?)/*$|', "\\1", $url);
        }

        return $return;
    }

}


if (!function_exists('whereami')) {

    function whereami() {

        $CI = &get_instance();
        if ($CI->uri->segment(1)) {
            return 'inside';
        } else {
            return 'mainpage';
        }
    }

}