<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Admin Class for NewLevelSettings
 * @uses BaseAdminController
 * @author L.Andriy <l.andriy@siteimage.com.ua>
 * @copyright (c) 2013, ImageCMS
 * @package ImageCMSModule
 */
class Admin extends BaseAdminController {

    private $path;

    public function __construct() {
        parent::__construct();

        $this->path = TEMPLATES_PATH . 'newLevel';
        $this->load->model('level_model');
    }

    /**
     * @access public
     * @author L.Andriy <l.andriy@siteimage.com.ua>
     * @copyright (c) 2013, ImageCMS
     */
    public function index() {

        if ($_POST) {
            $sql = "update components set settings = '" . serialize($_POST) . "' where name = 'new_level_settings'";
            $this->db->query($sql);
            showMessage('Даные сохранены');
        } else {

            $thema = array();

            if ($handle = opendir($this->path . '/css/')) {
                while (false !== ($file = readdir($handle))) {
                    if ($file != "." && $file != "..") {
                        if (!is_file($this->path . '/css/' . $file)) {
                            $thema[$file] = "css/$file";
                        }
                    }
                }
                closedir($handle);
            }

            $settings = $this->level_model->getSettings();



            \CMSFactory\assetManager::create()
                    ->registerScript('main')
                    ->setData(array('data' => $settings, 'thema' => $thema, 'img' => '/templates/newLevel/' . $settings['thema'] . '/'))
                    ->renderAdmin('settings');
        }
    }

}

/* End of file admin.php */
