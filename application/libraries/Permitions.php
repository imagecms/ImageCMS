<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Permitions {

    private static $shop_controllers_path = 'application/modules/shop/admin/';
    private static $base_controllers_path = 'application/modules/admin/';
    private static $modules_controllers_path = 'application/modules/';
    private static $rbac_roles_table = 'shop_rbac_roles';
    private static $rbac_privileges_table = 'shop_rbac_privileges';
    private static $rbac_group_table = 'shop_rbac_group';
    private static $rbac_roles_privileges_table = 'shop_rbac_roles_privileges';
    private static $controller_types = array('shop', 'base', 'module');

    public function __construct() {
        $ci = & get_instance();
        $ci->load->library('DX_Auth');
    }

    public static function checkPermitions() {
        self::checkUrl();
    }

    private static function checkAllPermitions($adminClassName, $adminMethod) {
        $ci = & get_instance();
        $err_text = '<div id="notice" style="width: 500px;">' . '<b>%error_message%.</b>' . '
			</div><script type="text/javascript">showMessage(\'Сообщение: \',\'%error_message%\',\'\');</script>';
        //check if user is loged in
        if ($ci->dx_auth->is_logged_in()) {
            $privilege = $adminClassName . '::' . $adminMethod;
            $privilege = $ci->db->where('name', $privilege)->get(self::$rbac_privileges_table)->row();
            //check if current privilege exist in db
            if ($privilege) {
                $userProfile = $ci->db->where('id', $ci->dx_auth->get_user_id())->get('users')->row();
                if ($userProfile)
                    $userRole = $ci->db->where('id', $userProfile->role_id)->get(self::$rbac_roles_table)->row();
                //check if user has as role
                if ($userRole) {
                    $userPrivilege = $ci->db->where(array('role_id' => (int) $userRole->id, 'privilege_id' => (int) $privilege->id))->get(self::$rbac_roles_privileges_table)->result();
                    if (count($userPrivilege) > 0)
                        return TRUE;
                    else
                        die(str_replace('%error_message%', ShopCore::t('Не достаточно прав для: ') . $privilege->description, $err_text));
                }
            } else {
                return true;
            }
        }
        //die(str_replace('%error_message%', ShopCore::t('Ошибка проверки прав доступа'), $err_text));
    }

    private static function checkUrl($checkLink = FALSE, $link = '') {
        $ci = & get_instance();

        if ($checkLink AND $link != '') {
            $uri_array = explode("/", $link);
            $for_check = $uri_array[1];
        }
        else
            $for_check = $ci->uri->segment(2);

        if ($for_check == 'components') {
            if ($ci->uri->segment(4) == 'shop' OR $uri_array[3] == 'shop') {
                $classNamePrep = 'ShopAdmin';
                $controller_segment = 5;
                $controller_method = 6;
            }
            if (in_array($ci->uri->segment(3), array('init_window', 'run', 'cp')) OR in_array($uri_array[2], array('init_window', 'run', 'cp'))) {
                $classNamePrep = 'Admin';
                $controller_segment = 4;
                $controller_method = 5;
            } else {
                $controller_segment = 2;
                $controller_method = 3;
                $classNamePrep = 'Base';
            }
        } else {
            $controller_segment = 2;
            $controller_method = 3;
            $classNamePrep = 'Base';
        }
        if ($checkLink AND $link != '')
            $adminController = $uri_array[$controller_segment - 1];
        else
            $adminController = $ci->uri->segment($controller_segment);

        switch ($classNamePrep) {
            case 'ShopAdmin':
                $adminClassName = 'ShopAdmin' . ucfirst($adminController);
                $adminClassFile = self::$shop_controllers_path . $adminController . '.php';
                break;
            case 'Admin':
                $adminClassName = $adminController;
                $adminClassFile = self::$modules_controllers_path . $adminController . '/' . 'admin.php';
                break;
            case 'Base':
                $adminClassName = ucfirst($adminController);
                $adminClassFile = self::$base_controllers_path . $adminController . '.php';
                break;
        }
        if ($checkLink AND $link != '')
            $adminMethod = $uri_array[$controller_method - 1];
        else
            $adminMethod = $ci->uri->segment($controller_method);

        if (!$adminMethod)
            $adminMethod = 'index';

        if (!file_exists($adminClassFile) AND $adminClassFile != 'application/modules/admin/.php')
            die("Файл " . $adminClassFile . " не найден");
        else {
            if ($checkLink AND $link != '')
                return array('adminClassName' => $adminClassName, 'adminMethod' => $adminMethod);
            else
                self::checkAllPermitions($adminClassName, $adminMethod);
        }
    }

    private static function processRbacPrivileges() {
        $ci = & get_instance();
        $controllerFolders = self::$controller_types;
        foreach ($controllerFolders as $folder) {
            if ($folder == 'base') {
                $adminControllersDir = self::$base_controllers_path;
            }
            if ($folder == 'shop') {
                $adminControllersDir = self::$shop_controllers_path;
            }
            if ($folder == 'module') {
                $adminControllersDir = self::$modules_controllers_path;
                $ci->load->helper("directory");
                $controllers = directory_map($adminControllersDir, true);
                foreach ($controllers as $c) {
                    if (file_exists($adminControllersDir . $c . "/admin.php") AND !in_array($c, array('shop', 'admin'))) {
                        $result[] = $adminControllersDir . $c . "/admin.php";
                    }
                }
                $controllers = $result;
            }
            $fileExtension = EXT;

            if ($handle = opendir($adminControllersDir)) {
                //list of the admin controllers
                if (!$controllers)
                    $controllers = glob($adminControllersDir . "*$fileExtension");
                foreach ($controllers as $controller) {
                    self::scanControllers($controller, $folder);
                }
                $controllers = false;
                closedir($handle);
            }
        }
        showMessage("Успех");
    }

    private static function scanControllers($controller, $folder) {
        $ci = & get_instance();
        $fileExtension = EXT;
        if ($folder == 'module') {
            $arr = explode("/", $controller);
            $text = file_get_contents($controller);
            $text = str_replace("class Admin", "class " . $arr[2], $text);
            write_file(str_replace("admin.php", $arr[2] . "temp" . $fileExtension, $controller), $text);
            $controller = str_replace("admin.php", $arr[2] . "temp" . $fileExtension, $controller);
        }

        require_once $controller;
        $controllerName = str_replace("temp", "", basename($controller, $fileExtension));
        switch ($folder) {
            case 'base':
                $controllerClassName = ucfirst($controllerName);
                break;
            case 'module':
                $controllerClassName = $arr[2];
                break;
            case 'shop':
                $controllerClassName = 'ShopAdmin' . ucfirst($controllerName);
                break;
        }

        $class = new ReflectionClass($controllerClassName);

        $controllerMethods = $class->getMethods(ReflectionMethod::IS_PUBLIC);

        foreach ($controllerMethods as $controllerMethod) {
            if ($controllerMethod->class == $controllerClassName) {
                $privilegeName = $controllerMethod->class . '::' . $controllerMethod->name;
                $dbPrivilege = $ci->db->where('name', $privilegeName)->get(self::$rbac_privileges_table)->row();
                $group = $ci->db->where('name', ucfirst($controllerName))->get(self::$rbac_group_table)->row();
                if (empty($group)) {
                    $ci->db->insert(self::$rbac_group_table, array('name' => ucfirst($controllerName), 'description' => ''));
                    $group = $ci->db->where('name', ucfirst($controllerName))->get(self::$rbac_group_table)->row();
                }
                if (empty($dbPrivilege))
                    $ci->db->insert(self::$rbac_privileges_table, array('name' => $privilegeName, 'description' => $privilegeName, 'group_id' => $group->id, 'type' => $folder));
            }
        }
        if ($folder == 'module')
            unlink($controller);
    }

    private static function checkSuperAdmin() {
        $ci = & get_instance();
        $superAdmin = $ci->db->where('id', 1)->get('users')->row();
        if (empty($superAdmin))
            die("Супер администратор не найден");
        else {
            $role_id = $superAdmin->role_id;
            $privileges = $ci->db->get(self::$rbac_privileges_table)->result();
            if (!empty($privileges)) {
                $countAllPermitions = count($privileges);
                $countUserPermitions = 0;
                foreach ($privileges as $privilege) {
                    if ($ci->db->where(array('privilege_id' => $privilege->id, 'role_id' => $role_id))->get(self::$rbac_roles_privileges_table)->num_rows() > 0)
                        $countUserPermitions++;
                }
                if ($countAllPermitions == $countUserPermitions)
                    return true;
                else
                    die("Суперадмин не найден");
            }
        }
    }

    private static function createSuperAdmin() {
        $ci = & get_instance();
        $superAdmin = $ci->db->where('id', 1)->get('users')->row();
        if (empty($superAdmin))
            die("Супер администратор не найден");
        else {
            $role_id = $superAdmin->role_id;
            $privileges = $ci->db->get(self::$rbac_privileges_table)->result();
            if (!empty($privileges))
                foreach ($privileges as $privilege) {
                    if ($ci->db->where(array('privilege_id' => $privilege->id, 'role_id' => $role_id))->get(self::$rbac_roles_privileges_table)->num_rows() == 0)
                        $ci->db->insert(self::$rbac_roles_privileges_table, array('role_id' => $role_id, 'privilege_id' => $privilege->id));
                }
        }
    }

}

?>
