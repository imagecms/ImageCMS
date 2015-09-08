<?php

use admin_menu\classes\AdminMenuBuilder as AdminMenuBuilder;

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 * Related_products Module Admin
 */
class Admin extends BaseAdminController {

    public function __construct() {
        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('admin_menu');
        $this->load->model('admin_menu_model');

        if (MAINSITE) {
            redirect(site_url('admin'));
        }
    }

    /**
     * Start page
     */
    public function index() {
        $this->load->helper('admin_menu');
        if (is_saas()) {
            $this->edit_tariff_menus();
        } else {
            $this->edit_menus();
        }
    }

    public function edit_menus() {
        \MY_Lang::setLang('en_US');
        $lang = new \MY_Lang();
        $lang->load('admin_menu');

        $menus = array(
            'full' => $this->load->module('admin_menu')->setDevMode('full')->show(),
            'corporate' => $this->load->module('admin_menu')->setDevMode('corporate')->show(),
            'professional' => $this->load->module('admin_menu')->setDevMode('professional')->show(),
            'premium' => $this->load->module('admin_menu')->setDevMode('premium')->show(),
        );

        $menus = array_filter($menus);

        \MY_Lang::setLang($this->config->item('language'));
        $lang->load('admin_menu');
        $this->load->module('admin_menu')->unsetDevMode();

        \CMSFactory\assetManager::create()
            ->setData('menus', $menus)
            ->registerStyle('admin_menu_dev')
            ->registerScript('admin_menu_dev')
            ->renderAdmin('edit_menus');
    }

    public function edit_tariff_menus() {
        \MY_Lang::setLang('en_US');
        $lang = new \MY_Lang();
        $lang->load('admin_menu');

        $type = $this->input->get('type') ? $this->input->get('type') : 'billing';
        $tariffs = \saas\models\SaasTariff::all();

        foreach ($tariffs as $key => $tariff) {
            $tariffs[$key]->menu = $this->load->module('admin_menu')->setDevMode("Tariff_{$tariff->id}_menu", $type)->show();
        }

        $menus = array(
            'full' => $this->load->module('admin_menu')->setDevMode('full')->show(),
            'tariffs' => $tariffs
        );

        $menus = array_filter($menus);

        $this->template->registerCssFile('./application/modules/admin_menu/assets/js/context_menu/jquery.contextMenu.css');
        $this->template->registerJsFile('./application/modules/admin_menu/assets/js/context_menu/jquery.contextMenu.js', 'after');
        $this->template->registerJsFile('./application/modules/admin_menu/assets/js/context_menu/jquery.ui.position.js', 'after');
        $this->load->module('admin_menu')->unsetDevMode();
        \CMSFactory\assetManager::create()
            ->setData('menus', $menus)
            ->registerStyle('admin_menu_dev_tariff')
            ->registerScript('admin_menu_dev')
            ->renderAdmin('edit_tariff_menus');
    }

    /**
     * Cms menus page
     */
    private function cms() {
        \CMSFactory\assetManager::create()
            ->setData(
                array(
                    'full_menu' => AdminMenuBuilder::getMenuList(AdminMenuBuilder::$FULL_MENU),
                    'corporate_menu' => AdminMenuBuilder::getMenuList(AdminMenuBuilder::$CORPORATE_MENU),
                    'professional_menu' => AdminMenuBuilder::getMenuList(AdminMenuBuilder::$PROFESSIONAL_MENU),
                    'premium_menu' => AdminMenuBuilder::getMenuList(AdminMenuBuilder::$PREMIUM_MENU),
                )
            )
            ->registerStyle('admin_menu')
            ->registerScript('admin_menu')
            ->renderAdmin(__FUNCTION__);
    }

    /**
     * Premmerce tariffs menus page
     */
    private function tariffs() {
        $tariffs = \saas\models\SaasTariff::all();
        foreach ($tariffs as $key => $tariff) {
            $tariffs[$key]->menu = AdminMenuBuilder::getMenuList("Tariff_{$tariff->id}_menu");
        }

        \CMSFactory\assetManager::create()
            ->setData(
                array(
                    'tariffs' => $tariffs,
                    'full_menu' => AdminMenuBuilder::getMenuList(AdminMenuBuilder::$FULL_MENU),
                )
            )
            ->registerStyle('admin_menu')
            ->registerScript('admin_menu')
            ->renderAdmin(__FUNCTION__);
    }

    /**
     * Save cms menu
     */
    public function saveMenu() {
        $data = $this->input->post();
        $data = array_map('json_decode', $data);

        if ($data) {
            AdminMenuBuilder::save($data);
            showMessage(lang('Successfully saved.', 'admin_menu'), lang('Success', 'admin_menu'));
        } else {
            showMessage(lang('No data to save.', 'admin_menu'), lang('Error', 'admin_menu'), 'r');
        }
    }

    /**
     * Save tariffs menus
     */
    public function saveTariffsMenus() {
        $data = $this->input->post();
        $tariffsMenus = json_decode($data['tariffsMenus']);
        $type = $data['type'];

        if ($tariffsMenus) {
            AdminMenuBuilder::saveTariffsMenus($tariffsMenus, $type);
            showMessage(lang('Successfully saved.', 'admin_menu'), lang('Success', 'admin_menu'));
        } else {
            showMessage(lang('No data to save.', 'admin_menu'), lang('Error', 'admin_menu'), 'r');
        }
    }

    /**
     * Upload tariffs menus
     */
    public function uploadTariffsMenus() {
        $tariffs_menus_paths = glob(AdminMenuBuilder::getMenuPath() . 'store/Tariff_*_menu.php');

        $menus = array();
        foreach ($tariffs_menus_paths as $path) {
            $saas_path = str_replace('./', '/var/www/saas_data/mainsaas/', $path);
            $menus[$saas_path] = file_get_contents($path);
        }

        saas\server\Store::uploadTariffsMenus($menus);

        showMessage(lang('Successfully updated.', 'admin_menu'), lang('Success', 'admin_menu'));
    }

    public function ajaxUpdateItemTitle() {
        $data = $this->input->post();
        $poFileManager = new \translator\classes\PoFileManager();

        $name = 'admin_menu';
        $type = 'modules';
        $lang = $this->config->item('language');

        $po_data = array();
        $po_data[$data['origin']]['translation'] = $data['translate'];

        $poFileManager->update($name, $type, $lang, $po_data);
    }

    public function ajaxGetNewMenuItem() {
        $type = $this->input->get('type') ? $this->input->get('type') : 'TD';
        return \CMSFactory\assetManager::create()->setData('type', $type)->fetchAdminTemplate('devMenuOneItem', FALSE);
    }

}