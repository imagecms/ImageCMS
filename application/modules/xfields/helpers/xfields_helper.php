<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Display page fields.
 * NOTE: This function works onlu in page_full.tpl
 *
 * @param $string $list_type - possible values: ul
 */
if ( ! function_exists('xfields_list'))
{
	function xfields_list($list_type = '')
	{
        return modules::run('xfields/display_all', array('text', $list_type));
	}
}

/**
 * Return fields by page id.
 * This function is for usage on category.tpl
 *
 * Example: 
 *      {$fields = page_fields($page.id)}
 *
 *      {foreach $fields as $field}
 *          {$field}<br/>
 *      {/foreach} 
 * 
 */
if ( ! function_exists('page_fields'))
{
	function page_fields($page_id)
    {
        $ci =& get_instance();
        return $ci->load->module('xfields')->_page_fields($page_id);
	}
}

/**
 * Return extended fields array
 *
 * Example:
 *      {$fields = page_fields($page.id)}
 *
 *      {foreach $fields as $field}
 *          {$field.data.label_text}: {$fields.field_data}
 *      {/foreach}
 *
 */
if ( ! function_exists('page_fields_extended'))
{
	function page_fields_extended($page_id)
    {
        $ci =& get_instance();
        return $ci->load->module('xfields')->_page_fields_extended($page_id);
	}
}

/**
 * Display fields group as html list
 */
if ( ! function_exists('fields_group'))
{
	function fields_group($page_id, $name, $render = 'ul')
    {
        $ci =& get_instance();
        $fields = $ci->load->module('xfields')->_page_fields($page_id); 
        $group = $ci->load->module('xfields')->load_group($name);

        
        if ($render != 'ul' OR $render != 'ol')
        {
            $render = 'ul';
        }

        if (count($group))
        {
            echo '<ul>';
            foreach ($group['fields'] as $g)
            {
                echo '<li>'.$g['data']['label_text'].' '.$g['rezult']."</li>\n";
            }
            echo '</ul>';
        }
	}
}

