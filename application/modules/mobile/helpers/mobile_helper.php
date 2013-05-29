<?php

if (!function_exists('mobile_url')) {

    function mobile_url($url) {
        if (empty($url))
            return '/';
        return site_url('mobile/' . $url);
    }

}
?>
