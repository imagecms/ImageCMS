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
            if ($array == false)
                return false;

            if (sizeof($array) > 0)
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
