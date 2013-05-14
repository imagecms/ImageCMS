<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Image CMS
 *
 * User support module.
 */

class Admin extends MY_Controller {

    public $tickets_per_page = 20;

	function __construct()
	{
            parent::__construct();
	}


    /** 
     * Display list of tickets
     */
    public function index()
    {
       
    }  

}

/* End of file admin.php */
