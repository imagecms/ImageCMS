<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Image CMS
 *
 * Group Mailer Module
 */

class Group_Mailer extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		
	}

	// Index function
	function index()
	{
        //code
	}

	// Autoload default function
	function autoload()
	{
        //code
	}


    function _install()
    {
        return;
    }

    
    function _deinstall()
    {
        return;
    }

    /**
     * Display template file
     */ 
	function display_tpl($file = '')
	{
        $file = realpath(dirname(__FILE__)).'/templates/'.$file.'.tpl';  
		$this->template->display('file:'.$file);
	}

    /**
     * Fetch template file
     */ 
	function fetch_tpl($file = '')
	{
        $file = realpath(dirname(__FILE__)).'/templates/'.$file.'.tpl';  
		return $this->template->fetch('file:'.$file);
	}

}

/* End of file group_mailer.php */
