<?php

namespace admin_menu\classes;

/**
 * AdminMenuBuilder class
 */
class AdminMenuBuilder
{

    /**
     * Menu folder path
     * @var string
     */
    private static $MENU_PATH = '';

    /**
     * Full menu file name
     * @var string
     */
    public static $FULL_MENU = 'full';

    /**
     * Corporate menu name
     * @var string
     */
    public static $CORPORATE_MENU = 'corporate';

    /**
     * Professional menu name
     * @var string
     */
    public static $PROFESSIONAL_MENU = 'professional';

    /**
     * Premium menu name
     * @var string
     */
    public static $PREMIUM_MENU = 'premium';

    /**
     * Menu content
     * @var string
     */
    private static $MENU_LIST = '';

    /**
     * Removed items array
     * @var array
     */
    private static $REMOVED_ITEMS = array();

    /**
     * CI object
     * @var type
     */
    private static $CI;

    public static function getInstance() {

        static $inst = null;
        if ($inst === null) {
            $inst = new self();
        }
        self::$CI = &get_instance();

        return $inst;
    }

    private function __construct() {

    }

    public static function getItemName($name) {

        $curentLocale = \CI::$APP->config->item('language');
        \MY_Lang::setLang($curentLocale);
        $lang = new \MY_Lang();
        $lang->load('admin_menu');

        $name = lang($name, 'admin_menu');

        \MY_Lang::setLang('en_US');
        $lang->load('admin_menu');
        return $name;
    }

    /**
     * Save cms menu data
     * @param array $data
     */
    public static function save($data) {

        if ($data['corporate']) {
            self::saveOneMenu($data['corporate'], self::$CORPORATE_MENU);
        }

        if ($data['professional']) {
            self::saveOneMenu($data['professional'], self::$PROFESSIONAL_MENU);
        }

        if ($data['premium']) {
            self::saveOneMenu($data['premium'], self::$PREMIUM_MENU);
        }
    }

    /**
     * Save one menu data
     * @param array $data - one menu data
     * @param string $menu_name - menu file name
     */
    private static function saveOneMenu($data, $menu_name) {

        $menu_export = var_export($data, TRUE);
        $menu_export = str_replace("stdClass::__set_state(", '', $menu_export);
        $menu_export = str_replace("))", ')', $menu_export);
        $menu_export = str_replace("'true'", 'true', $menu_export);
        $menu_export = str_replace("'false'", 'false', $menu_export);
        $menu_export = preg_replace("/'text' => '(.*)'/", '\'text\' =>  lang("$1", "admin_menu")', $menu_export);
        $menu_export = preg_replace("/[\s]*[']?[\d]{1,3}[']?[\s]*=>/", "", $menu_export);
        $menu_export = "<?php return " . $menu_export . ';';
        $menu_path = self::getMenuPath() . "/cms/{$menu_name}.php";
        chmod($menu_path, 0777);
        file_put_contents($menu_path, $menu_export);
    }

    /**
     * Save taiffs name
     * @param array $data - menu data
     */
    public static function saveTariffsMenus($data, $type) {

        foreach ($data as $tariff_id => $tariffMenu) {
            $menuName = "Tariff_{$tariff_id}_menu";
            self::saveOneTariffMenu($tariffMenu, $menuName, $type);
        }
    }

    /**
     * Save one menu tariff data
     * @param array $data - one menu data
     * @param string $menu_name - menu file name
     */
    private static function saveOneTariffMenu($data, $menu_name, $type) {

        $menu_export = var_export($data, TRUE);
        $menu_export = str_replace("stdClass::__set_state(", '', $menu_export);
        $menu_export = str_replace("))", ')', $menu_export);
        $menu_export = preg_replace("/'text' => '(.*)'/", '\'text\' =>  lang("$1", "admin_menu")', $menu_export);
        $menu_export = preg_replace("/[\s]*[']?[\d]{1,3}[']?[\s]*=>/", "", $menu_export);
        $menu_export = "<?php return " . $menu_export . ';';
        file_put_contents(self::getMenuPath() . "/{$type}/{$menu_name}.php", $menu_export);
    }

    /**
     * Get menu folder path
     * @return string
     */
    public static function getMenuPath() {

        if (MAINSITE) {
            self::$MENU_PATH = MAINSITE . '/application/modules/admin_menu/menus/';
        } else {
            self::$MENU_PATH = './application/modules/admin_menu/menus/';
        }

        return self::$MENU_PATH;
    }

    /**
     * Get rendered menu
     * @param string $type - menu file name
     * @return string
     */
    public static function getMenuList($type) {

        self::$CI = &get_instance();
        self::$MENU_LIST = '';
        \MY_Lang::setLang('en_US');
        $lang = new \MY_Lang();
        $lang->load('admin_menu');

        $menu = include_once self::getMenuPath() . "{$type}.php";

        \MY_Lang::setLang(self::$CI->config->item('language'));
        $lang->load('admin_menu');

        foreach ($menu as $item) {
            self::renderMenuItem($item);
        }

        return self::$MENU_LIST;
    }

    /**
     * Render menu items
     * @param array $item - one menu item
     * @param string $parent - parent name
     */
    private static function renderMenuItem($item, $parent = '') {

        self::$CI = &get_instance();
        $data = array('item' => $item, 'parent' => $parent);
        self::$MENU_LIST .= self::$CI->template->fetch('file:' . dirname(__DIR__) . '/assets/menu/item.tpl', $data);

        if ($item['subMenu']) {
            self::$MENU_LIST .= '<ul>';

            $parent = $item['identifier'];
            foreach ($item['subMenu'] as $item) {
                self::renderMenuItem($item, $parent);
            }

            self::$MENU_LIST .= '</ul>';
        }
    }

    /**
     * Get menu array
     * @param string $menu_name - menu name
     * @param string|null $menu_type
     * @return string
     */
    public static function getMenu($menu_name, $menu_type) {

        $menu = include AdminMenuBuilder::getMenuPath() . "{$menu_type}/{$menu_name}.php";
        $menu = self::appendModulesMenus($menu);
        $menu = self::removeMenuItems($menu);

        return $menu;
    }

    /**
     * Remove items from menu
     * @param array $menu - menu items array
     * @return array
     */
    private static function removeMenuItems($menu) {

        foreach (self::$REMOVED_ITEMS as $item) {
            if (is_array($item)) {
                foreach ($item as $item_pos => $sub_items) {
                    foreach ($sub_items as $sub_item_pos) {
                        unset($menu[$item_pos]['subMenu'][$sub_item_pos]);
                    }
                }
            } else {
                unset($menu[$item]);
            }
        }

        return $menu;
    }

    /**
     * Append modules menu aray to current menu
     * @param array $menu - carrent menu array
     * @return array
     */
    private static function appendModulesMenus($menu) {

        $modules = self::prepareModulesMenusData();
        foreach ($modules as $item) {
            foreach ($item as $position => $module_item) {
                array_splice($menu, $position, 0, array($module_item));
            }
        }

        return $menu;
    }

    /**
     * Prepare modules menus data
     * @return array
     */
    private static function prepareModulesMenusData() {

        //        self::$CI = &get_instance();
        //        $modules_dir = realpath('./application/modules');
        //
        //        $modules = scandir($modules_dir);
        //        $menus_data = array();
        //        foreach ($modules as $module) {
        //            $module_file = "{$modules_dir}/{$module}/{$module}.php";
        //
        //            if (is_file($module_file) && $module != 'admin') {
        //                $lang = new \MY_Lang();
        //                $lang->load($module);
        //                include_once($module_file);
        //                if (method_exists($module, 'addMenu')) {
        //                    $menus_data[] = $module::addMenu();
        //                }
        //            }
        //        }
        //        return $menus_data;
        return [];
    }

    /**
     * Set item(s) to remove
     * @param int|array $item_position - item position or array of item sub position to remove
     */
    public static function removeItemFromMenu($item_position) {

        self::$REMOVED_ITEMS[] = $item_position;
    }

}