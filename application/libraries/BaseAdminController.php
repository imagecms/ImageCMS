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

    public static function getCurrentLocale() {
//        if (self::$currentLocale)
//            return self::$currentLocale;

        $ci = get_instance();
//        $lang_id = $ci->config->item('cur_lang');
//        if ($lang_id) {
//            $ci->db->select('identif');
//            $query = $ci->db->get_where('languages', array('id' => $lang_id))->result();
//
//            if ($query) {
//                self::$currentLocale = $query[0]->identif;
//            } else {
//                self::$currentLocale = 'ru';
//            }
//        } else {
//            $defaultLanguage = getDefaultLanguage();
//            if (!is_array($defaultLanguage) || !isset($defaultLanguage['identif'])) {
//                self::$currentLocale = 'ru';
//            } else {
//                self::$currentLocale = $defaultLanguage['identif'];
//            }
//        }

        $sqlLangSel = 'SELECT lang_sel FROM settings';
        $lang = $ci->db->query($sqlLangSel)->row();
        if ($lang->lang_sel == 'russian_lang') {
            return 'ru';
        } else {
            return 'en';
        }

//        return self::$currentLocale;
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
                    if (method_exists($moduleName, 'adminAutoload'))
                        $moduleName::adminAutoload();
                }
            }
        }
    }

}

?>
