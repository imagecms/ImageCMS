<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cache_html {

    private static $path;

    public static function set_html($html, $file) {
        self::$path = PUBPATH . 'system/cache/templates_c/HTML/';

        if (!is_dir('system/cache/templates_c/HTML/')) {
            mkdir('system/cache/templates_c/HTML/', 0777);
        }

        $file = $file . MY_Controller::getCurrentLocale();

        file_put_contents(self::$path . md5($file) . '.html', $html);
    }

    public static function get_html($file) {
        self::$path = PUBPATH . 'system/cache/templates_c/HTML/';
        
        if (!\CI_Controller::get_instance()->config->item('tpl_force_compile')) {
            $file = $file . MY_Controller::getCurrentLocale();
            $file = self::$path . md5($file) . '.html';
            if (file_exists($file)) {
                if (time() - filemtime($file) > \CI_Controller::get_instance()->config->item('tpl_compiled_ttl')) {
                    @unlink($file);
                    return false;
                } else {
                    return file_get_contents($file);
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public static function clear_html_cache() {
        
    }

}
