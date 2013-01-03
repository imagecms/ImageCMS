<?php

class BaseAdminController extends MY_Controller {
    public static $currentLocale = null;
    
    
    public function __construct() {
        parent::__construct();
        $this->load->library('Permitions');
        Permitions::checkPermitions();
    }

//    public function render($viewName, array $data = array(), $return = false) {
//        if (!empty($data))
//            $this->template->add_array($data);
//
//        if ($this->ajaxRequest)
//            echo $this->template->fetch('file:' . 'application/modules/cfcm/templates/admin/' . $viewName);
//        else
//            $this->template->show('file:' . 'application/modules/cfcm/templates/admin/' . $viewName);
////     	$this->template->fetch('file:' . 'application/modules/cfcm/templates/admin/' . $viewName);
//        exit;
//    }
    public static function getCurrentLocale() {
        if (self::$currentLocale)
            return self::$currentLocale;

        $ci = get_instance();
        $lang_id = $ci->config->item('cur_lang');

        if ($lang_id) {
            $ci->db->select('identif');
            $query = $ci->db->get_where('languages', array('id' => $lang_id))->result();

            if ($query) {
                self::$currentLocale = $query[0]->identif;
            } else {
                self::$currentLocale = 'ru';
            }
        } else {
            $defaultLanguage = getDefaultLanguage();
            if (!is_array($defaultLanguage) || !isset($defaultLanguage['identif'])) {
                self::$currentLocale = 'ru';
            } else {
                self::$currentLocale = $defaultLanguage['identif'];
            }
        }

        return self::$currentLocale;
    }

}

?>
