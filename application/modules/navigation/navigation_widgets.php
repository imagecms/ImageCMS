<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Image CMS
 *
 * Navigation widgets
 */

class Navigation_Widgets extends MY_Controller{

	function __construct()
	{
		parent::__construct();
	}
    
    function widget_navigation($widget = array())
    {
        $this->load->module('core');

        if ( $widget['settings'] == FALSE)
        {
            $settings = $this->defaults;
        }else{
            $settings = $widget['settings'];
        }

        switch ($this->core->core_data['data_type'])
        {
            case 'category':                
                $cur_category = $this->core->cat_content;

                $i = 0;
                $path_count = count($cur_category['path']);

                $path_categories = $this->lib_category->get_category(array_keys($cur_category['path']));

                $tpl_data = array('navi_cats' => $path_categories);

                return $this->template->fetch('widgets/'.$widget['name'], $tpl_data);
            break;

            case 'page':
                if ($this->core->cat_content['id'] > 0)
                {
                    $cur_category = $this->core->cat_content;

                    $path_categories = $this->lib_category->get_category(array_keys($cur_category['path']));

                    // Insert Page data
                    $path_categories[] = array(
                                    'path_url' => $this->core->page_content['cat_url']. $this->core->page_content['url'],
                                    'name' => $this->core->page_content['title']
                                    );

                    $tpl_data = array('navi_cats' => $path_categories);

                    return $this->template->fetch('widgets/'.$widget['name'], $tpl_data); 
                }
            break;
        }
    }

    // Template functions
	function display_tpl($file, $vars = array())
    {
        $this->template->add_array($vars);

        $file =  realpath(dirname(__FILE__)).'/templates/'.$file.'.tpl';  
		$this->template->display('file:'.$file);
	}

	function fetch_tpl($file, $vars = array())
    {
        $this->template->add_array($vars);

        $file =  realpath(dirname(__FILE__)).'/templates/'.$file.'.tpl';  
		return $this->template->fetch('file:'.$file);
	}

}

/* End of file widgets.php */
