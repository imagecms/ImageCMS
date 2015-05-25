<?php

namespace admin_menu\classes;

class MenuCallback {

    private function __construct() {
        
    }

    private static $instance;

    public static function getInstance() {
        if (is_null(self::$instance))
            self::$instance = new self;
        return self::$instance;
    }

    /**
     * Check if Billing
     * @return boolean
     */
    private static function isSaas() {
        $saas_module_path = DOCUMENT_ROOT . '/application/modules/saas/module_info.php';
        return file_exists($saas_module_path) ? TRUE : FALSE;
    }

    /**
     * Run menu callback
     * @param string $callback - MenuCallback class static method name
     * @return boolean
     */
    public static function run($callback) {
        if ($callback) {

            $data = array();
            if (self::isSaas() && !\Admin_menu::$DEV_MODE) {
                $user = \saas\models\Users::with('saasUser')->where('id', '=', \CI::$APP->dx_auth->get_user_id())->first();
                if ($user) {
                    $user_data = \saas\server\Store::getOneUserData($user->saasUser);
                    $dataKey = lcfirst(str_replace('get', '', $callback));
                    $data[$dataKey] = $user_data[$dataKey];
                }
            }

            if (method_exists(MenuCallbacks::getInstance(), $callback)) {
                return MenuCallbacks::getInstance()->$callback($data);
            }
        }
        return FALSE;
    }

}
