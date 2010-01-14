<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once('FirePHPCore/FirePHP.class.php');

/*
fb('Log message'  , FirePHP::LOG);
fb('Info message' , FirePHP::INFO);
fb('Warn message' , FirePHP::WARN);
fb('Error message', FirePHP::ERROR);
*/

class Fire {

	function Fire(){}

	public function load()
	{
		return FirePHP::getInstance(TRUE);
	}


}
/* End of file firephp.php */
