<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

if (!function_exists('my_print_r')) {

//@codingStandardsIgnoreStart
    function my_print_r($array = []) {
        echo "<pre>";
        print_r($array);
        echo "</pre>";
    }

//@codingStandardsIgnoreEnd
}

if (!function_exists('is_true_array')) {

    /**
     *
     * @param array $array
     * @return boolean
     */
    function is_true_array($array) {
        if ($array == false) {
            return false;
        }
        $arraySize = count($array);
        return $arraySize > 0;
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
            return [];
        }

        $key = key($result[0]);
        $countResult = count($result);
        for ($i = 0; $i < $countResult; $i++) {
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
     * @return integer
     */
    function array_to_file($file, $array) {
        return file_put_contents($file, '<?php $arr = ' . var_export($array, true) . ';');
    }

}

if (!function_exists('user_function_sort')) {

    /**
     *
     * @param array $arr
     * @param string $key
     * @return array
     */
    function user_function_sort($arr, $key = 'value') {
        usort(
            $arr,
            function ($a, $b) use ($key) {
                    return strnatcmp($a[$key], $b[$key]);
            }
        );
        return $arr;
    }

}


if (!function_exists('pluralize')) {

    /**
     *
     * @param integer $count
     * @param array $words
     * @return string
     */
    function pluralize($count = 0, array $words = []) {

        if (empty($words)) {
            $words = [
                      ' ',
                      ' ',
                      ' ',
                     ];
        }

        $numeric = (int) abs($count);
        if ($numeric % 100 == 1 || ($numeric % 100 > 20) && ($numeric % 10 == 1)) {
            return $words[0];
        }
        if ($numeric % 100 == 2 || ($numeric % 100 > 20) && ($numeric % 10 == 2)) {
            return $words[1];
        }
        if ($numeric % 100 == 3 || ($numeric % 100 > 20) && ($numeric % 10 == 3)) {
            return $words[1];
        }
        if ($numeric % 100 == 4 || ($numeric % 100 > 20) && ($numeric % 10 == 4)) {
            return $words[1];
        }
        return $words[2];
    }

}

if (!function_exists('array_column')) {

    /**
     *
     * @param array $array
     * @param string $column_name
     * @return array
     */
    function array_column($array, $column_name) {
        return array_map(
            function($element) use($column_name) {
                    return $element[$column_name];
            },
            $array
        );
    }

}