<?php

namespace template_manager;

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 * Module template_manager
 */
class template_manager extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('template_manager');
    }

    public function index() {
        
    }

    public function autoload() {
        
    }

    /**
     * Інклудить всі файли потрібні файли, кидає ексепшн якщо якогось немає
     */
    public function getIncludes() {
        $classes = array();
        foreach ($this->xml->components as $component) {
            require_once $component->attributes->handler; // TODO: перевірити
        }
    }

    public function installTemplate() {

        // todo врахувати моменти коли не ставити шаблон і коли вивести повідомлення

        foreach ($this->xml->dependities as $dep) {
            switch ($dep) {
                case 'widget':


                    break;

                default:
                    break;
            }
        }

        foreach ($this->xml as $q) {
            //записуємо HTML-віджети і сетаємо дані про компоненти
        }

        // повідомлення "сакцес"
    }

    public function donwloadTemplate($sourceUrl) {
        // скачати темплейт в uploads/templates
        // розпакувати в templates
        // якісь мінімальні перевірки
    }

    public function _install() {
        
    }

    public function _deinstall() {
        
    }

}

/* End of file templateManager.php */
