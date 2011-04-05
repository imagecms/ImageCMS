<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Image CMS
 *
 * Language Switcher
 */

class Language_Switch extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->module('core');
	}

	// Index function
	public function index()
	{
        //code
	}

	// Autoload default function
	public function autoload()	
	{
	}


    // Install 
    public function _install()
    {
        
    	if( $this->dx_auth->is_admin() == FALSE) exit;

        $this->load->dbforge();

        $this->db->where('name', 'language_switch');
        $this->db->update('components', array('autoload' => 0, 'in_menu' => 1) );
    }

    // Delete module
    public function _deinstall()
    {
    }

    /**
     * Display template file
     */ 
	private function display_tpl($file = '')
	{
		$file = realpath(dirname(__FILE__)).'/templates/public/'.$file.'.tpl';  
		$this->template->display('file:'.$file);
	}

    /**
     * Fetch template file
     */ 
	private function fetch_tpl($file = '')
	{
		$file = realpath(dirname(__FILE__)).'/templates/public/'.$file.'.tpl';  
		return $this->template->fetch('file:'.$file);
	}

}

/* End of file sample_module.php */
