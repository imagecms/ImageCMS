<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Admin Class Mobile version for Shop Module
 * @uses BaseAdminController
 * @author <dev@imagecms.net>
 * @copyright (c) 2013, ImageCMS
 * @package Shop.ImageCMSModule
 */
class Admin extends BaseAdminController {

    public function __construct() {
        parent::__construct();
    }

    public function get_settings() {
        $settings = $this->db->where('name','mobile')->get('components')->result_array();

            $this->settings = $settings[0]['settings'];

        
    }

    /**
     * @author <dev@imagecms.net>
     * @copyright (c) 2013, ImageCMS
     */
    public function index() {
        
        $this->get_settings();
        \CMSFactory\assetManager::create()->setData(array('mobileTemplates' => $this->_getMobileTemplatesList()));
        \CMSFactory\assetManager::create()->setData(unserialize($this->settings))->renderAdmin('main');
    }
    /**
     * update settings
     * @return view
     * @author Kaero <dev@imagecms.net>
     * @copyright (c) 2013, ImageCMS
     */
    public function update(){
        $sql = "update components set settings = '" . serialize($_POST) . "' where name = 'mobile'";
        $this->db->query($sql);
        showMessage('Даные сохранены');
    }
    /**
     * get template directory
     * @return view
     * @author Kaero <dev@imagecms.net>
     * @copyright (c) 2013, ImageCMS
     */
    protected function _getMobileTemplatesList() {
        $paths = array();
        $this->load->helper('directory');

        $dirs = array(
            './application/modules/shop/templates/*',
            './templates/*/shop',
        );

        foreach ($dirs as $dir) {
            $result = glob($dir, GLOB_ONLYDIR);
            if (is_array($result)) {

                // Remove templates from select except mobile version
                foreach ($result as $pathItemIndex => $pathItem) {
                    if (!stristr($pathItem, '_mobile'))
                        unset($result[$pathItemIndex]);
                }

                $paths = array_merge($paths, $result);
            }
        }

        if (sizeof($paths > 0)) {
            return $paths;
        } else {
            return false;
        }
    }

}