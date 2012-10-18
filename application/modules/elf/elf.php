<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Image CMS
 *
 * core.php
 */
class Elf extends MY_Controller {
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		return true;
	}
	
	function elfinder_init()
	{
		$this->load->helper('path');
		$opts = array(
				// 'debug' => true,
				'roots' => array(
						array(
								'driver' => 'LocalFileSystem',
								'path'   => set_realpath('yourfilespath'),
								'URL'    => site_url('yourfilespath') . '/'
								// more elFinder options here
						)
				)
		);
		$this->load->library('elfinder_lib', $opts);
	}
}