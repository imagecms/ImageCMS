<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * CMSFactory Base Class
 * @package CMSFactory
 * @compatibility ImageCMS v4.3+
 * @copyright ImageCMS (c) 2013, <dev@imagecms.net>
 */
class CMSFactory extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {

    }

    public function autoload() {

    }

    public function _install() {
        ($this->dx_auth->is_admin()) OR exit;
        $this->db->where('name', 'cmsfactory');
        $this->db->update('components', array('name' => 'CMSFactory', 'identif' => 'CMSFactory'));
    }

}
