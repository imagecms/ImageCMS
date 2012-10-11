<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/* The MX_Controller class is autoloaded as required */

/**
 * @property Core $core
 */
class MY_Controller extends MX_Controller {

    public $pjaxRequest = false;

    public function __construct()
    {
        parent::__construct();
        
        if (in_array('X-PJAX' , array_keys( getallheaders())))
	    $this->pjaxRequest = true;
    }

}
