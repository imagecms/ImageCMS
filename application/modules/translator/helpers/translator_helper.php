<?php

if (!function_exists('sort_names')) {

    /**
     * Sorting names array for translator name selector
     * @param array $arr
     * @return array
     */
    function sort_names($arr) {
        usort($arr, function($a, $b) {
                    $first = $a['menu_name'];
                    $second = $b['menu_name'];
                    return strnatcmp($first, $second);
                });
        return $arr;
    }

}
?>
