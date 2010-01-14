<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
    if (!function_exists('my_print_r'))
    {
        function my_print_r($array = array())
        {
            echo "<pre>";
                print_r($array);
            echo "</pre>";
        }
    }

    if (!function_exists('is_true_array'))
    {
        function is_true_array($array)
        {
            if (count($array) > 0 AND is_array($array) )
            {
                return TRUE;
            }
            else
            {
                return FALSE;
            }
        }
    }
?>
