<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Permitions {
    private $shop_controllers_path;
    private $base_controllers_path;
    
    public function __construct() {
        //$ci = &get_instance();
        //$ci->load->library('DX_Auth');
        
    }

    public static function checkBasePermitions() {
        echo "checking permitions";
        exit();
    }

    public static function checkPermitions() {
        self::checkUrl();
    }

    private static function checkShopPermitions($adminClassName, $adminMethod) {
        $err_text = '<div id="notice" style="width: 500px;">' . '<b>%error_message%.</b>' . '
			</div><script type="text/javascript">showMessage(\'Сообщение: \',\'%error_message%\',\'\');</script>';

        //check if user is loged in
        if (ShopCore::$ci->dx_auth->is_logged_in()) {
            $privilege = $adminClassName . '::' . $adminMethod;

            $privilege = ShopRbacPrivilegesQuery::create()
                    ->filterByName($privilege)
                    ->findOne();

            //check if current privilege exist in db
            if ($privilege !== null) {
                $userProfile = SUserProfileQuery::create()
                        ->filterById(ShopCore::$ci->dx_auth->get_user_id())
                        ->findOne();

                if ($userProfile !== null)
                    $userRole = $userProfile->getShopRbacRoles();

                //check if user has as role
                if ($userRole !== null) {
                    $requestPrivilegCriteria = ShopRbacPrivilegesQuery::create()
                            ->filterByName($privilege->getName());

                    $userPrivilege = $userRole->getShopRbacPrivilegess($requestPrivilegCriteria);

                    //check if user has such privilege
                    if ($userPrivilege->count() > 0) {
                        return TRUE;
                    } else {
                        die(str_replace('%error_message%', ShopCore::t('Не достаточно прав для: ') . $privilege->getDescription(), $err_text));
                    }
                }
            } else {
                return true;
            }
        }

        die(str_replace('%error_message%', ShopCore::t('Ошибка проверки прав доступа'), $err_text));
    }

    private static function checkUrl() {
        //checking second uri segment
        $for_check = ShopCore::$ci->uri->segment(2);
        if ($for_check == 'components') {
            $controller_segment = 5;
            $controller_method = 6;
        }else{
            $controller_segment = 2;
            $controller_method = 3;
        }
        var_dump(SHOP_DIR);
        
        $adminController = ShopCore::$ci->uri->segment($controller_segment);
        $adminClassName = 'ShopAdmin' . ucfirst($adminController);
        $adminMethod = ShopCore::$ci->uri->segment($controller_method);
        $adminClassFile = SHOP_DIR . 'admin' . DS . $adminController . '.php';
    }

}

?>
