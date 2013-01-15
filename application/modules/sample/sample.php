<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Image CMS
 *
 * Module Sample
 */

class Sample_Module extends MY_Controller {

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
        //code
	}


    // Install 
    public function _install()
    {
        /*
    	if( $this->dx_auth->is_admin() == FALSE) exit;

        $this->load->dbforge();

        $fields = array(
            'id' => array(
                         'type' => 'INT',
                         'constraint' => 11,
                         'auto_increment' => TRUE,
                     ),
            'param1' => array(
                         'type' => 'INT',
                         'constraint' => 11,
                     ),
                 );
        
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field($fields);
        $this->dbforge->create_table('sample_table', TRUE);

        // Enable module autoload
        $this->db->where('name', 'sample_module');
        $this->db->update('components', array('autoload' => '1'));

        // Or
        $this->load->model('model_name');
        $this->model_name->make_install();
        */
    }

    // Delete module
    public function _deinstall()
    {
        /*
       	if( $this->dx_auth->is_admin() == FALSE) exit;
    
        $this->load->dbforge();
        $this->dbforge->drop_table('sample_table');
         */
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
