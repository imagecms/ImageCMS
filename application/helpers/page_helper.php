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
		$ci->db->select('content_permissions.data as roles', FALSE);
		$ci->db->where('id', $id);
		$ci->db->join('content_permissions','content_permissions.page_id = content.id', 'left');
		$query = $ci->db->get('content');

		if ($query->num_rows() == 1)
		{
			$page = $query->row_array();
			if ($ci->core->check_page_access(unserialize($page['roles']),FALSE))
			{
			return $page;
			}
			
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
		$ci->db->select('content_permissions.data as roles', FALSE);
		$ci->db->order_by($category['order_by'], $category['sort_order']);
		$ci->db->join('content_permissions','content_permissions.page_id = content.id', 'left');

		if ($limit > 0)
		{
			$ci->db->limit($limit);
		}

		$query = $ci->db->get('content');
		$all_pages_cat=$query->result_array();//cutter
		if (count($all_pages_cat)> 0)
		{
			foreach ($all_pages_cat as $v)
			{
				if ($ci->core->check_page_access(unserialize($v['roles']),FALSE))
				{
					$pages[]=$v;
				}
			}
		}
		return $pages;
		//return $query->result_array();
	}
}

if (!function_exists('encode'))
{
	function encode($string)
	{
		if(!is_string($string))
			$string = (string) $string;
		return htmlspecialchars($string, ENT_QUOTES, 'utf-8');
	}
}
