<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * ImageCMS
 * Widgets helper
 */
if ( !function_exists('widget') )
{
    /**
     * Run widget
     * 
     * @param string $name - widget name
     * @param integer $cache - cache ttl in minutes
     * @param boolean $hide_error Если true выводит ошибку в виде HTML комментария,
     * который не видят посетители сайта.
     */
    function widget($name = FALSE, $cache = FALSE, $hide_error = FALSE)
    {
        $ci =& get_instance(); 

        $ci->db->limit(1);
        $query = $ci->db->limit(1)->get_where('widgets', array('name' => $name));

        if ($query->num_rows() == 1)
        {
            $widget = $query->row_array();
        }
        else
        {
            if($hide_error)
            {
                return "<!-- ERROR! Widget \"$name\" not found. -->";
            }
            else
            {
                return 'Can\'t find widget <b>'.$name.'</b>';
            }
        }

        if ( ($data = $ci->cache->fetch('widget'.$name, 'widgets')) != FALSE AND $cache != FALSE)
        {
            return $data;
        }
        else
        {	
            $widget['settings'] = unserialize($widget['settings']);

            switch ($widget['type'])
            {
                case 'module':
                    $result = $ci->load->module($widget['data'].'/'.$widget['data'].'_widgets')->$widget['method']($widget); 
                break;

                case 'html':
                    $result = $widget['data'];
                break;
            }

            if ($cache != FALSE AND is_integer($cache))
            {
                $ci->cache->store('widget'.$name, $result, $cache * 60, 'widgets');
            }

            return $result;       
        }
    }
}

if ( !function_exists('widget_exist') )
{
    /**
     * Проверяет наличие виджета как такового.
     * Функционал будет полезен в шаблонах, когда виджет должен быть окружен
     * дополнительным HTML кодом, который не должен отображаться без виджета.
     * 
     * @param string $name Имя виджета
     * @return boolean True если такой виджет существует
     */
    function widget_exist($name = null) {
        $ci = & get_instance();
        $ci->db->limit(1);
        $query = $ci->db->limit(1)->get_where('widgets', array('name' => $name));
        return ($query->num_rows() == 1) ? true : false;
    }
}

/* End of widget_helper.php */
