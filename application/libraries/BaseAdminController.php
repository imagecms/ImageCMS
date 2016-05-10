<?php

/**
 * @property Lib_admin lib_admin
 */
class BaseAdminController extends MY_Controller
{

    /**
     * @var string
     */
    public static $currentLocale;

    /**
     * @var bool
     */
    private static $adminAutoLoaded = false;

    public function __construct() {
        parent::__construct();

        $lang = new MY_Lang();
        $lang->load('admin');

        $this->load->library('Permitions');
        if (PHP_SAPI != 'cli') {
            Permitions::checkPermitions();
        }

        $this->load->library('lib_admin');
        $this->lib_admin->init_settings();
        $this->autoloadModules();
    }

    /**
     * Run ImageCMS modules autoload method for admin-page
     * @access private
     * @copyright ImageCMS (c) 2013, Kaero <dev@imagecms.net>
     */
    private function autoloadModules() {
        if (!self::$adminAutoLoaded) {
            /** Search module with autoload */
            $query = $this->db
                ->select('name')
                ->where('autoload', 1)
                ->get('components');

            if ($query) {
                $moduleName = null;
                /** Run all Admin autoload method */
                foreach ($query->result_array() as $module) {
                    $moduleName = $module['name'];
                    Modules::load_file($moduleName, APPPATH . 'modules' . DIRECTORY_SEPARATOR . $moduleName . DIRECTORY_SEPARATOR);
                    $moduleName = ucfirst($moduleName);
                    if (class_exists($moduleName)) {
                        if (method_exists($moduleName, 'adminAutoload')) {
                            $moduleName::adminAutoload();
                        }
                    }
                }
            }
            self::$adminAutoLoaded = true;
        }
    }

}