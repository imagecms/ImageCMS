<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
/**
 * Java Script helper
 */

/**
 * Show Roar message
 *
 * @param string $message
 * @param string|boolean $title
 * @param string $class
 * @param boolean $ret
 * @return null|string
 */
function showMessage($message, $title = FALSE, $class = '', $ret = false) {
    $del = ["'", '"'];

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
    echo '<script>$.pjax({url: "' . $url . '", container:"' . $selector . '"}); </script>';
    //    echo '<script>$.pjax({url: "' . $url . '", container:"' . $selector . '"});location.reload();</script>';
}

/**
 * Redirect function
 * @param string $location
 */
function ajax_redirect($location) {
    echo lang('Redirecting') . ': <b>' . $location . '</b> ' . "<script type='text/javascript'> setTimeout(\"location.href = '" . $location . "';\",50); </script>";
}

/*
 * Load content to DIV
 */

/**
 * @param string $div_id
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

/**
 * @param string $code
 */
function jsCode($code) {
    echo "<script type=\"text/javascript\"> " . $code . " </script>";
}

if (!function_exists('checkAjaxRequest')) {

    function checkAjaxRequest() {
        $CI = & get_instance();
        if ($CI->input->server('HTTP_X_REQUESTED_WITH') != 'XMLHttpRequest') {
            return false;
        } else {
            return true;
        }
    }

}

/* End of javascript helper */