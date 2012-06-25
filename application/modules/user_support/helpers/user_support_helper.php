<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('get_status_color'))
{
    function get_status_color($status_id)
    {
        $ci =& get_instance();

        $ci->load->module('user_support');

        return $ci->user_support->statuses_colors[$status_id];
    }
}

if ( ! function_exists('get_priority_color'))
{
    function get_priority_color($priority_id)
    {
        $ci =& get_instance();

        $ci->load->module('user_support');

        return $ci->user_support->priorities_colors[$priority_id];
    }
}

if ( ! function_exists('get_priority_text'))
{
    function get_priority_text($priority_id)
    {
        $ci =& get_instance();

        $ci->load->module('user_support');

        return $ci->user_support->priorities[$priority_id];
    }
}

if ( ! function_exists('get_status_text'))
{
    function get_status_text($status_id)
    {
        $ci =& get_instance();

        $ci->load->module('user_support');

        return $ci->user_support->statuses[$status_id];
    }
}

if ( ! function_exists('get_department_name'))
{
    function get_department_name($id)
    {
        $ci =& get_instance();

        $ci->load->module('user_support');

        return $ci->user_support->get_department_name($id);
    }
}

