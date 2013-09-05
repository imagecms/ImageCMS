<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS 
 * Product slider admin
 */
class Admin extends BaseAdminController {

    public function __construct() {
        parent::__construct();
    }

    public function index() {

        if ($_POST) {

            $sql = "update components set settings = '" . serialize($_POST) . "' where name = 'settings_additional'";
            $this->db->query($sql);
            showMessage(lang('Даные сохранены', 'settings_additional'));
        } else {

            $this->settings = $this->cms_base->get_settings();

            $path = $this->settings['site_template'];

            $settings = $this->db->where('name', 'settings_additional')->get('components')->result_array();
            $settings = unserialize($settings[0]['settings']);

            $new_arr = array();

            if ($handle = opendir(TEMPLATES_PATH . $path . '/stylesets')) {
                while (false !== ($file = readdir($handle))) {
                    if ($file != "." && $file != "..") {
                        if (!is_file(TEMPLATES_PATH . $file)) {
                            $new_arr[$path . '/stylesets/' . $file] = "$file";
                        }
                    }
                }
                closedir($handle);
            }
            \CMSFactory\assetManager::create()
                    ->setData(array('data' => $settings, 'subStyle' => $new_arr))
                    ->renderAdmin('settings');
        }
    }

}