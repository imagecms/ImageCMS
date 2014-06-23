<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * Java Script helper
 */

/**
 * Show Roar message
 */
function showMessage($message, $title = FALSE, $class = '', $ret = false) {
    $del = array("'", '"');

    $message = str_replace($del, '', $message);
    $title = str_replace($del, '', $title);


    if ($title == FALSE) {
        $title = lang('Message') . ": ";
        if ($class == 'r') {
            $title = lang('Error') . ": ";
        }
        if ($class == 'g') {
            $title = lang('Success') . ": ";
        }
    }
    $CI = & get_instance();
    $message .= '<br/><strong>' . lang('Requests to the database') . ': ' . $CI->db->total_queries() . '</strong>';
    $message = str_replace("\n", '<br/>', $message);
    $message = str_replace("<p>", '', $message);
    $message = str_replace("</p>", '', $message);
    if (!$ret) {
        echo "<script type=\"text/javascript\"> showMessage('" . $title . "','" . $message . "','" . $class . "'); </script>";
    } else {
        return "<script type=\"text/javascript\"> showMessage('" . $title . "','" . $message . "','" . $class . "'); </script>";
    }
}

function pjax($url, $selector = '#mainContent') {
    echo '<script>$.pjax({url: "' . $url . '", container:"' . $selector . '"});</script>';
}

/**
 * Redirect function
 */
function ajax_redirect($location) {
    echo lang('Redirecting') . ': <b>' . $location . '</b> ' . "<script type='text/javascript'> setTimeout(\"location.href = '" . $location . "';\",3000); </script>";
}

/*
 * Load content to DIV
 */

function updateDiv($div_id, $url) {
    echo "<script type=\"text/javascript\"> ajax_div('" . $div_id . "','" . $url . "'); </script>";
}

/*
 * Same function as above but with other name ;)
 */

function ajax_div($div_id, $url) {
    echo "<script type=\"text/javascript\"> ajax_div('" . $div_id . "','" . $url . "'); </script>";
}

/*
 * Execute java script code
 */

function jsCode($code) {
    echo "<script type=\"text/javascript\"> " . $code . " </script>";
}

if (!function_exists('checkAjaxRequest')) {

    function checkAjaxRequest() {
        if ($_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest')
            return false;
        else
            return true;
    }

}

/* End of javascript helper */
