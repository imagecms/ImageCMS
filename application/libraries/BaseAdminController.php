<?php

class BaseAdminController extends MY_Controller {

    public static $currentLocale = null;

    public function __construct() {
        parent::__construct();
        $this->load->library('Permitions');
        Permitions::checkPermitions();
        $this->autoloadModules();
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

    private function autoloadModules() {
        $query = $this->db->select('id, name, identif, autoload, enabled')->where('autoload', 1)->get('components')->result_array();        
        foreach ($query as $module) {
            if ($module['autoload'] == 1) {
                $mod_name = $module['name'];
                $this->load->module($mod_name);
                if (method_exists($mod_name, 'autoload') === TRUE)
                    $this->$mod_name->autoload();
            }
        }
    }

}

?>
