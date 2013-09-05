<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cache_dane {
    
    public static $path = 'system/cache/dane/';
    
    
    public static function set_data($data, $hash){
        
        
        file_put_contents(self::$path . md5($hash), $data);
        
    }
    
    public static function get_data($hash){
        

        $file = self::$path . md5($hash);
        if (file_exists($file))
            return file_get_contents($file);       
        else
            return false;
        
    }
    
    public static function clear_html_cache(){
        
    }
}
