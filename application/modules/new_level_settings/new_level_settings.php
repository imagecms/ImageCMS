<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class for NewLevelSettings
 * @uses MY_Controller
 * @author L.Andriy <l.andriy@siteimage.com.ua>
 * @copyright (c) 2013, ImageCMS
 * @package ImageCMSModule
 * @property level_model $level_model
 */
class new_level_settings extends MY_Controller {

    public $no_install = true;

    public function __construct() {
        parent::__construct();
        if (count($this->db->where('name', 'new_level_settings')->get('components')->result_array()) == 0)
            $this->no_install = false;
        $this->load->module('core');

        $this->load->model('level_model');
    }

    public function autoload() {
        

        $settings = $this->level_model->getSettings();

        

        $this->template->assign('colorScheme', $settings['thema']);
    }

    public function _install() {

        $this->db->where('name', 'new_level_settings');
        $this->db->update('components', array('enabled' => 1));
    }

    public function _deinstall() {

        if ($this->dx_auth->is_admin() == FALSE)
            exit;
    }

}

/* End of file NewLevelSettings.php */
