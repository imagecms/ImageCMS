<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Image CMS
 */

class Tags_Widgets extends MY_Controller {

   	public function __construct()
	{
		parent::__construct();
    } 

    // Display recent or popular news
    public function tags_cloud($widget = array())
    {
        if ( $widget['settings'] == FALSE)
        {
            $settings = $this->defaults;
        }else{
            $settings = $widget['settings'];
        }

        $this->load->module('tags');
        $this->tags->prepare_tags();
        //shuffle( $this->tags->tags );

        return $this->tags->build_cloud();
    }

    // Configure form
    public function tags_cloud_configure($action = 'show_settings', $widget_data = array())
    {
        if( $this->dx_auth->is_admin() == FALSE) exit;

        switch ($action)
        {
            case 'show_settings':

            break;

            case 'update_settings':

            break;

            case 'install_defaults':
                     
            break;
        }
    }

}
