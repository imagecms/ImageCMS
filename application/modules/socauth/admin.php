<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Admin Class for Social Auth Module
 * @uses BaseAdminController
 * @author A.Gula <a.gula@imagecms.net>
 * @copyright (c) 2013, ImageCMS
 * @package ImageCMSModule
 */
class Admin extends BaseAdminController {

    public function __construct() {
        parent::__construct();
        $lang = new MY_Lang();
            $lang->load('socauth');
    }

    /**
     * Get settings from DB and display settings page
     * @author A.Gula <a.gula@imagecms.net>
     * @copyright (c) 2013, ImageCMS
     */
    public function index() {
        /** Get Settings from DB */
        $settings = $this->db
            ->select('settings')
            ->where('identif', 'socauth')
            ->get('components')
            ->row_array();

        /** Show template file */
        \CMSFactory\assetManager::create()
                ->setData('settings', unserialize($settings[settings]))
                ->renderAdmin('settings');
    }

    /**
     * Update settings from POST
     * @param $_POST
     * @author A.Gula <a.gula@imagecms.net>
     * @copyright (c) 2013, ImageCMS
     */
    public function update_settings() {
        $result = array_map('trim', $this->input->post());

        /** Save input data */
        $this->db
            ->where('identif', 'socauth')
            ->update('components', array('settings' => serialize($result)));

        showMessage(lang('Settings are saved', 'socauth'));
        pjax($this->input->server('HTTP_REFERER'));
    }

}

/* End of file admin.php */