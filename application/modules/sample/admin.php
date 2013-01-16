<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Image CMS
 *
 * Sample Module Admin
 */

class Admin extends MY_Controller {

	public function __construct()
	{
		parent::__construct();

        // Only admin access 
        // Do not delete this code !
		 cp_check_perm('module_admin');
	}


	public function index()
	{
	
	}

    /**
     * Display template file
     */ 
	private function display_tpl($file = '')
	{
        $file = realpath(dirname(__FILE__)).'/templates/admin/'.$file.'.tpl';  
		$this->template->display('file:'.$file);
	}

    /**
     * Fetch template file
     */ 
	private function fetch_tpl($file = '')
	{
        $file = realpath(dirname(__FILE__)).'/templates/admin/'.$file.'.tpl';  
		return $this->template->fetch('file:'.$file);
	}

}


/* End of file admin.php */
