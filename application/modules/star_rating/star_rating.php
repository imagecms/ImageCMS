<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Image CMS
 *
 * Star rating module
 */

class Star_rating extends Controller {

	public function __construct()
	{
		parent::Controller();
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
        //code
	}

    // Install
    // Create votes table
    public function _install()
    {
    	if($this->dx_auth->is_admin() == FALSE) exit;

        $this->load->dbforge();

        $fields = array(
            'page_id' => array(
                         'type' => 'INT',
                         'constraint' => 11,
                     ),
            'total_votes' => array(
                         'type' => 'INT',
                         'constraint' => 11,
                     ),
            'value' => array(
                         'type' => 'INT',
                         'constraint' => 11,
                     ),
            );
        
        $this->dbforge->add_key('page_id', TRUE);
        $this->dbforge->add_field($fields);
        $this->dbforge->create_table('content_ratings', TRUE);
    }

    // Delete module
    // Delete votes table
    public function _deinstall()
    {
       	if( $this->dx_auth->is_admin() == FALSE) exit;
    
        $this->load->dbforge();
        $this->dbforge->drop_table('content_ratings');
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

