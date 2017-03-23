<?php namespace CMSFactory;

class AdminLoader
{

    /**
     * @var AdminLoader
     */
    private static $instance;

    /**
     * @var bool
     */
    private static $adminAutoLoaded = false;

    /**
     * @var \CI_DB_active_record
     */
    private $db;

    public static function getInstance() {
        return self::$instance ?: self::$instance = new self(\CI::$APP->db);
    }

    public function __construct(\CI_DB_active_record $db) {
        $this->db = $db;
    }

    public function adminAutoload() {
        if (!self::$adminAutoLoaded) {
            /** Search module with autoload */
            $query = $this->db->select('name')->where('autoload', 1)->get('components');

            if ($query) {
                /** Run all Admin autoload method */
                $modules = $query->result_array();
                $modules = array_column($modules, 'name');
                array_unshift($modules, 'core');

                $modules = array_unique($modules);

                foreach ($modules as $moduleName) {
                    \Modules::load_file($moduleName, APPPATH . 'modules' . DIRECTORY_SEPARATOR . $moduleName . DIRECTORY_SEPARATOR);
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