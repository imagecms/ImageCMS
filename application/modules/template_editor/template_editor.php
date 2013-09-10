<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Image CMS
 */

class Template_editor extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
                $lang = new MY_Lang();
                $lang->load('template_editor');
	}

	// Index function
	public function index()
	{
        //code
	}

}

/* End of file template_editor.php */
