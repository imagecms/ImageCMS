<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CmsCacheHelper {
    public static $key = null;
    public static $duration = false;

    public function init($key,$duration)
    {
        $ci = get_instance();

        self::$key = $key;
        self::$duration = $duration;

        if (($data = $ci->cache->fetch('parts'.$key, 'parts')) === false) 
        { 
            return false;
        }
 
        return $data;
    }

    public function storeCache($content)
    {
        $ci = get_instance();

        $ci->cache->store('parts'.self::$key, $content, self::$duration, 'parts');

        return self::$key;
    }
}

if (!function_exists('beginCache'))
{
    function beginCache($key, $duration = false)
    {
        $result = CmsCacheHelper::init($key, $duration);

        if ($result === false)
        {
            ob_start();
            ob_implicit_flush(false);
            return true; // Begin cache
        }
        else
        {
            // Display cached content
            echo $result;
            return false;
        }
    }
}

if (!function_exists('endCache'))
{
    function endCache()
    {
        $content = ob_get_clean();
        CmsCacheHelper::storeCache($content);
        return $content;
    }
}
