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

if (!function_exists('result_column')) {

    /**
     * For 
     * @param array $result array of arrays
     * @return array
     */
    function result_column($result) {

        if (count($result) == 0) {
            return array();
        }

        $key = key($result[0]); 
       
        for ($i = 0; $i < count($result); $i++) {
            $result[$i] = $result[$i][$key];
        }

        return $result;
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
            if (is_array($value_) && $key_ !== $key) {
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

if (!function_exists('array_to_file')) {

    /**
     * Write array in file.
     * 
     * @param string $file
     * @param array $array
     * @return bool
     */
    function array_to_file($file, $array) {
        return file_put_contents($file, '<?php $arr = ' . var_export($array, true) . ';');
    }

}

if (!function_exists('user_function_sort')) {

    function user_function_sort($arr) {
        usort($arr, function($a, $b) {
                    return strnatcmp($a['value'], $b['value']);
                });
        return $arr;
    }

}
?>
