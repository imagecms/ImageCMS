<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Input extends CI_Input {

    public function __construct()
    {
        parent::__construct();
		$this->_security =& load_class('Security');
    }

    public function xss_clean($string)
    {
        return $this->_security->xss_clean($string);
    }

}
