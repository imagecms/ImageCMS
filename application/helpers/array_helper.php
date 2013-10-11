<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!function_exists('my_print_r')) {

    function my_print_r($array = array()) {
        echo "<pre>";
        print_r($array);
        echo "</pre>";
    }

}

if (!function_exists('is_true_array')) {

    function is_true_array($array) {
        if ($array == false)
            return false;

        if (sizeof($array) > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}


if (!function_exists('array_key_exists_recursive')) {

    /**
     * Recursive search key in associative array (depth does not matter)
     * @param string $key
     * @param array $array
     * @param boolean $return (optional) if true then result will be returned (false default)
     * @return boolean|mixed
     */
    function array_key_exists_recursive($key, $array, $return = FALSE) {
        foreach ($array as $key_ => $value_) {
            if (is_array($value_)) {
                if (FALSE !== $value = array_key_exists_recursive($key, $value_, $return)) {
                    return $return === FALSE ? TRUE : $value;
                }
            } else {
                if ($key_ == $key) {
                    return $return === FALSE ? TRUE : $array[$key_];
                }
            }
        }
        return FALSE;
    }

}
?>
