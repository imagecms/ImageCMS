<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * ImageCMS
 * Widgets helper
 * @property CI_DB_active_record $db
 */
if (!function_exists('widget')) {

    /**
     * Run widget
     *
     * @param string $name - widget name
     * @param integer $cache - cache ttl in minutes
     */
    function widget($name = FALSE, $cache = FALSE) {
        $ci = & get_instance();

        $query = $ci->db->limit(1)->get_where('widgets', array('name' => $name));

        if ($query->num_rows() == 1) {
            $widget = $query->row_array();
        } else {
            log_message('error', 'Can\'t run widget <b>' . $name . '</b>');
        }

        if (($data = $ci->cache->fetch('widget' . $name, 'widgets')) != FALSE AND $cache != FALSE) {
            return $data;
        } else {
            $widget['settings'] = unserialize($widget['settings']);

            switch ($widget['type']) {
                case 'module':
                    $subpath = isset($widget['settings']['subpath']) ? $widget['settings']['subpath'] . '/' : '';
                    $result = $ci->load->module($widget['data'] . '/' . $subpath . $widget['data'] . '_widgets')->$widget['method']($widget);
                    break;

                case 'html':
                    $locale = MY_Controller::getCurrentLocale();
                    $id = $widget['id'];
                    $sql = "select * from widget_i18n where locale = '$locale' and id = '$id'";
                    $w_i18 = $ci->db->query($sql)->row_array();      
                    $result = $w_i18['data'];
                    break;
            }

            if ($cache != FALSE AND is_integer($cache)) {
                $ci->cache->store('widget' . $name, $result, $cache * 60, 'widgets');
            }

            return $result;
        }
    }

}

if (!function_exists('widget_ajax')) {

    function widget_ajax($name, $container) {

        echo "
                <script type=text/javascript>
                    $(window).load(function(){
                            $.ajax({
                                async : 'false',
                                type : 'post',
                                url : locale+'/shop/ajax/widget/$name',
                                success : function(data){
                                    $('$container').html(data);
                                    $(document).trigger({type: 'widget_ajax', el: $('$container')})
                                }
                            })
                      })

                 </script>
            ";
    }

}

if (!function_exists('getWidgetTitle')) {

    function getWidgetTitle($name) {
        $ci = & get_instance();

        $query = $ci->db->limit(1)->get_where('widgets', array('name' => $name));

        if ($query->num_rows() == 1) {
            $widget = $query->row_array();
        } else {
            log_message('error', 'Can\'t run widget <b>' . $name . '</b>');
        }

        $widget = unserialize($widget['settings']);

        return $widget['title'];
    }

}

if (!function_exists('getProductViewsCount')) {

    function getProductViewsCount() {
        $ci = & get_instance();
        
        $views = $ci->session->userdata('page');

        if($views){
            $count = count($views);
        }else{
            $count = 0;
        }
        
        return $count;
    }

}
    /* End of widget_helper.php */
