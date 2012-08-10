<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Image CMS
 */

class Admin  extends MY_Controller {

	function __construct()
	{
		parent::__construct();

    	$this->load->library('DX_Auth');
        cp_check_perm('module_admin');	
	}

    public function index()
    {
        $this->load->module('tags');
        $tags = $this->tags->prepare_tags();

        $this->template->add_array(array(
            'tags_cloud' => $this->tags->build_cloud('array'),
            ));

        $this->display_tpl('tags_admin');
    }


    /**
     * Display template file
     */ 
	private function display_tpl($file = '')
	{
        $file =  realpath(dirname(__FILE__)).'/templates/admin/'.$file.'.tpl';  
		$this->template->display('file:'.$file);
	}

    /**
     * Fetch template file
     */ 
	private function fetch_tpl($file = '')
	{
        $file =  realpath(dirname(__FILE__)).'/templates/admin/'.$file.'.tpl';  
		return $this->template->fetch('file:'.$file);
	}

}
/* End of file admin.php */
