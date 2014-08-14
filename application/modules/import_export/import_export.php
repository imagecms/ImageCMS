<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**vadik
 * Image CMS
 * Module Sample
 */
class Import_export extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('import_export');
        $this->load->module('core');

    }

    public function index() {
        
    }

    /**
     * Метод относится к стандартным методам ImageCMS.
     * Будет вызван каждый раз при обращении к сайту.
     * Запускается при условии включении "Автозагрузка модуля-> Да" в панели
     * уплавнеия модулями.
     */
    public function autoload() {
        
    }

    /**
     * Метод относиться  к стандартным методам ImageCMS.
     * Будет вызван при установке модуля пользователем
     */
    public function _install() {
        
    }

    /**
     * Метод относиться  к стандартным методам ImageCMS.
     * Будет вызван при удалении модуля пользователем
     */
    public function _deinstall() {
        
    }

}

/* End of file sample_module.php */
