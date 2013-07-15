<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cache_html {
    
    public static $path = 'system/cache/templates_c/HTML/';
    
    
    public static function set_html($html, $file){
        
        if (!is_dir('system/cache/templates_c/HTML/'))
            mkdir('system/cache/templates_c/HTML/', 0777);
        
        $file = $file . MY_Controller::getCurrentLocale();
        file_put_contents(self::$path . md5($file) . '.html', $html);
        
    }
    
    public static function get_html($file){
        
        
        
        $file = $file . MY_Controller::getCurrentLocale();
        $file = self::$path . md5($file) . '.html';
        if (file_exists($file)){
            if (time() - filemtime($file) > 86400){
                @unlink($file);
                return false;
            } else
                return file_get_contents($file);       
        }
        else
            return false;
        
    }
    
    public static function clear_html_cache(){
        
    }
}
