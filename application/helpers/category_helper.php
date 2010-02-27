<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('get_sub_categories'))
{
    function get_sub_categories($category_id = 0)
    {
        $ci =& get_instance();
        $categories = $ci->lib_category->unsorted();

        $result = array();

        foreach($categories as $category)
        {
            if ($category['parent_id'] == $category_id)
            {
                $result[] = $category;
            }
        }

        return $result;
    }
}

if (!function_exists('category_list'))
{
    function category_list($exclude_cats = '')
    {
        $ci =& get_instance();
        $ci->load->helper('html');
        $ci->load->module('core');
        $categories = $ci->lib_category->unsorted();

        $exclude_cats = explode(',', $exclude_cats);

        $result = array();

        foreach($categories as $row)
        {
            if (!in_array($row['id'], $exclude_cats))
            {
                $row['fetch_pages'] = unserialize($row['fetch_pages']);

                $total_pages = $ci->core->_get_category_pages($row, 0, 0, TRUE);
                $result[] = '<a href="'.site_url($row['path_url']).'">'.$row['name'].' ('.$total_pages.')</a>';
            }
        }

        return ul($result);
    }
}

if (!function_exists('sub_category_list'))
{
    function sub_category_list($category_id = 0)
    {
        if ($category_id > 0)
        {
            $categories = get_sub_categories($category_id);

            if (count($categories) > 0)
            {
                $ci =& get_instance();
                $ci->load->helper('html');
                $ci->load->module('core');

                foreach($categories as $row)
                {
                    $row['fetch_pages'] = unserialize($row['fetch_pages']);

                    $total_pages = $ci->core->_get_category_pages($row, 0, 0, TRUE);
                    $result[] = '<a href="'.site_url($row['path_url']).'">'.$row['name'].' ('.$total_pages.')</a>';
                }

                return ul($result);
            }
            else
            {
                return FALSE;
            }
        }
        else
        {
            return FALSE;
        }
    }
}

if (!function_exists('get_category_name'))
{
    function get_category_name($id)
    {
        $ci =& get_instance();
        $c = $ci->lib_category->get_category($id);

        if ($c['name'] == '')
        {
            $c['name'] = 'root';
        }

        return $c['name'];
    }
}

/* End of file category_helper.php */
