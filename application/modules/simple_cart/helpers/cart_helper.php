<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('cart_total_items'))
{
	function cart_total_items()
    {
        $ci =& get_instance();

        $total = $ci->session->userdata('cart_items');

        if (is_array($total) AND count($total) > 0)
        {
            return count($total);
        }

        return 0;
    }
}

if ( ! function_exists('cart_total_price'))
{
	function cart_total_price()
    {
        $ci =& get_instance();
        return $ci->load->module('simple_cart')->total();
    }
}
