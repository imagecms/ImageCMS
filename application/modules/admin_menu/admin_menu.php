<?php

use admin_menu\classes\AdminMenuBuilder as AdminMenuBuilder;

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 * Admin_menu controller
 * @property Admin_menu_model $admin_menu_model
 */
class Admin_menu extends MY_Controller {

    static private $SAAS;
    static private $SAAS_USER;
    static public $DEV_MODE;
    static private $MENU_NAME;
    static private $MENU_TYPE;
    static private $HIDEN_MODULES = array('language_switch', 'payment_method_webmoney', 'payment_method_privat24', 'payment_method_liqpay', 'payment_method_oschadbank', 'payment_method_sberbank', 'payment_method_robokassa', 'payment_method_interkassa', 'test', 'admin', 'CMSFactory', 'core', 'imagebox', 'forms', 'admin_menu', 'comments', 'cfcm', 'auth', 'shop', 'smart_filter', 'tags', 'navigation', 'shop_news', 'admin_menu');

    public function __construct() {
        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('admin_menu');
        $this->load->model('admin_menu_model');
        self::$SAAS = file_exists('./application/modules/saas/module_info.php') ? TRUE : FALSE;

        if (self::$SAAS) {
            $user_id = $this->dx_auth->get_user_id();
            self::$SAAS_USER = saas\models\Users::find($user_id)->saasUser;
        }
    }

    public function index() {
        
    }

    public function setDevMode($menu_name = NULL, $menu_type = 'cms') {
        self::$DEV_MODE = TRUE;
        self::$MENU_NAME = $menu_name;
        self::$MENU_TYPE = $menu_type;
        return $this;
    }

    public function unsetDevMode() {
        self::$DEV_MODE = FALSE;
        self::$MENU_NAME = NULL;
        self::$MENU_TYPE = NULL;
        return $this;
    }

    public function autoload() {
        
    }

    private static function setMenuType($menu_type) {
        self::$MENU_TYPE = self::$DEV_MODE ? self::$MENU_TYPE : $menu_type;
    }

    /**
     * Show menu
     * @return string
     * Use in template: {echo $CI->load->module('admin_menu')->show()}
     */
    public function show() {
        if (!$this->dx_auth->is_logged_in()) {
            return NULL;
        }

        if (self::$SAAS) {
            return $this->showPremerceProfileMenu();
        } else {
            return MAINSITE ? $this->showByTariff() : $this->showCmsMenu();
        }
    }

    /**
     * Render cms menu
     * @return type
     * Use in template: {echo $CI->load->module('admin_menu')->showCmsMenu()}
     */
    public function showCmsMenu() {
        self::setMenuType('cms');
        $menu_name = strtolower(array_pop(explode(' ', IMAGECMS_NUMBER)));
        return $this->getMenu($menu_name);
    }

    /**
     * Show menu by user tariff
     * @return string
     * Use in template: {echo $CI->load->module('admin_menu')->showByTariff()}
     */
    public function showByTariff() {
        if (!self::$DEV_MODE) {
            $tariff_id = $this->load->module('mainsaas')->getTariffId();
            $menu_name = "Tariff_{$tariff_id}_menu";
        } else {
            $menu_name = self::$MENU_NAME;
        }
        self::setMenuType('store');

        return $this->getMenu($menu_name);
    }

    /**
     * Show menu by user tariff
     * @return string
     * Use in template: {echo $CI->load->module('admin_menu')->showByTariff()}
     */
    public function showPremerceProfileMenu() {
        $tariff_id = self::$SAAS_USER->tariff_id;
        $menu_name = "Tariff_{$tariff_id}_menu";
        self::setMenuType('billing');
        return $this->getMenu($menu_name);
    }

    /**
     * Get menu by menu name
     * @param string $menu_name - menu name
     * @return string
     */
    private function getMenu($menu_name) {
        $menu_name = self::$DEV_MODE ? self::$MENU_NAME : $menu_name;

        $menu = AdminMenuBuilder::getMenu($menu_name, self::$MENU_TYPE);
        $modules = self::$DEV_MODE ? array() : $this->getModules();

        if ($menu) {
            $tpl = self::$DEV_MODE ? 'dev_menu' : 'menu';

            return CMSFactory\assetManager::create()
                            ->setData(array(
                                'menu' => $menu,
                                'modules' => $modules,
                                'SAAS' => self::$SAAS
                            ))
                            ->registerScript('admin_menu')
                            ->fetchAdminTemplate($tpl);
        }
    }

    public function getModules() {
        if (self::$SAAS) {
            $tariff_modules_ids = json_decode(self::$SAAS_USER->saasTariff->module);
            $tariff_modules = $this->admin_menu_model->getUserModulesNames($tariff_modules_ids);

            $modules = saas\server\classes\DomainsModules::getDefaultModules();

            foreach ($tariff_modules as $module) {
                if (!in_array($module['name'], $modules) && $module['name'] != 'admin') {
                    array_push($modules, $module['name']);
                }
            }
            sort($modules);
            foreach ($modules as $key => $module_name) {
                if (in_array($module_name, self::$HIDEN_MODULES)) {
                    unset($modules[$key]);
                    continue;
                }

                $info_file = APPPATH . 'modules/' . $module_name . '/module_info.php';
                $lang = new MY_Lang();
                $lang->load($module_name);

                if (file_exists($info_file)) {
                    include($info_file);
                    $modules[$key] = array('name' => $module_name);
                    $modules[$key] = array_merge($modules[$key], $com_info);
                } else {
                    $modules[$key] = array('menu_name' => $module_name, 'name' => $module_name);
                }
                unset($com_info);
            }
        } else {
            $modules = $this->load->module('admin/components')->find_components_for_menu_list(TRUE);
        }

        return $modules;
    }

    /**
     * Install module
     */
    public function _install() {
        $this->admin_menu_model->install();
    }

    /**
     * Deinstall module
     */
    public function _deinstall() {
        $this->admin_menu_model->deinstall();
    }

}

/* End of file sample_module.php */
