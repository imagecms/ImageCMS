<?php

class BaseAdminController extends MY_Controller {

    public static $currentLocale = null;

    public function __construct() {
        parent::__construct();
        $this->load->library('Permitions');
        Permitions::checkPermitions();
        $this->autoloadModules();

        $this->lang->load('admin');
    }

    /**
     * Run ImageCMS modules autoload method for admin-page
     * @access private
     * @copyright ImageCMS (c) 2013, Kaero <dev@imagecms.net>
     */
    private function autoloadModules() {
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
                    if (method_exists($moduleName, 'adminAutoload') && !self::$detect_load_admin[$moduleName] && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
                        $moduleName::adminAutoload();
                        self::$detect_load_admin[$moduleName] = 1;
                    }
                }
            }
        }
    }

}

?>
