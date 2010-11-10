<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('get_page'))
{
    // Get page by id
	function get_page($id)
    {
        $ci =& get_instance();
        
        $ci->db->limit(1);
        $ci->db->select('content.*');
        $ci->db->select('CONCAT_WS("", content.cat_url, content.url) as full_url');
        $ci->db->where('id', $id);
        $query = $ci->db->get('content');
        
        if ($query->num_rows() == 1)
        {
            return $query->row_array();
        }

        return FALSE;
    }
}

if ( ! function_exists('category_pages'))
{
    // Get pages by category
	function category_pages($category, $limit = 0)
    {
        $ci =& get_instance();

        $category = $ci->lib_category->get_category($category);
        $category['fetch_pages'] = unserialize($category['fetch_pages']);

        $ci->db->where('post_status', 'publish');
        $ci->db->where('publish_date <=', time());
        $ci->db->where('lang', $ci->config->item('cur_lang'));
  
        if (count($category['fetch_pages']) > 0)
        {
            $category['fetch_pages'][] = $category['id'];
            $ci->db->where_in('category', $category['fetch_pages']);
        }
        else
        {
            $ci->db->where('category', $category['id']);
        }

        $ci->db->select('content.*');
        $ci->db->select('CONCAT_WS("", content.cat_url, content.url) as full_url', FALSE);
        $ci->db->order_by($category['order_by'], $category['sort_order']);       

        if ($limit > 0)
        {
            $ci->db->limit($limit);
        }
        
        $query = $ci->db->get('content'); 

        //var_dump($query);

        return $query->result_array();
    }
}

if (!function_exists('encode'))
{
    function encode($string)
    {
        return htmlspecialchars($string, ENT_QUOTES, 'utf-8');
    }
}
