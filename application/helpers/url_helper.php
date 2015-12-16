<?php

if (!function_exists('site_url')) {

    /**
     * Site URL
     *
     * Create a local URL based on your basepath. Segments can be passed via the
     * first parameter either as a string or an array.
     *
     * @access    public
     * @param string $uri
     * @return string
     */
    function site_url($uri = '') {
        if (mb_strpos($uri, 'http') === 0) {
            return $uri;
        }

        $CI = & get_instance();
        return $CI->config->site_url($uri);
    }

}

/**
 * Use system url_helper methods
 */
require_once __DIR__ . './../../system/helpers/url_helper.php';