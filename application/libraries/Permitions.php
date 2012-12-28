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

    /*     * *************  RBAC privileges groups  ************** */

    /**
     * create a RBAC privileges group
     * 
     * @access public 
     * @return	void
     */
    public function groupCreate() {

        $this->form_validation->set_rules('Name', 'Name', 'required');

        if (!empty($_POST)) {
            if ($this->form_validation->run($this) == FALSE) {
                showMessage(validation_errors(), '', 'r');
            } else {

                $sql = "INSERT INTO shop_rbac_group (name, description) VALUES(" . $this->db->escape($_POST['Name']) . "," . $this->db->escape($_POST['Description']) . ")";

                $this->db->query($sql);

                if ($_POST['Privileges']) {
                    $idPrivilege = implode(',', $_POST['Privileges']);
                    $sql = "UPDATE shop_rbac_privileges SET group_id = " . $this->db->insert_id() . " WHERE id IN(" . $idPrivilege . ")";
                    $this->db->query($sql);
                }

                showMessage(ShopCore::t('Группа создана'));
                if ($_POST['action'] == 'tomain')
                    pjax('/admin/rbac/groupEdit/' . $this->db->insert_id());
                if ($_POST['action'] == 'tocreate')
                    pjax('/admin/rbac/groupCreate');
                if ($_POST['action'] == 'toedit')
                    pjax('/admin/rbac/groupEdit/' . $this->db->insert_id());
            }
        } else {
            $privileges = ShopRbacPrivilegesQuery::create()
                    ->orderByGroupId(Criteria::ASC)
                    ->find();

            $this->template->add_array(array(
                'model' => $model,
                'privileges' => $privileges,
            ));

            $this->template->show('groupCreate', FALSE);
        }
    }

    public function groupEdit($groupId) {

        $sqlModel = 'SELECT id, name, description FROM shop_rbac_group WHERE id = ' . $groupId;
        $model = $this->db->query($sqlModel);

        if ($model === null)
            $this->error404(ShopCore::t('Группа не найдена'));

        if (!empty($_POST)) {

            if ($_POST['Privileges']) {
                $idPrivilege = implode(',', $_POST['Privileges']);
                $sql = "UPDATE shop_rbac_privileges SET group_id = " . $groupId . " WHERE id IN(" . $idPrivilege . ")";
                $this->db->query($sql);
            }
            showMessage(ShopCore::t('Изменения сохранены'));
            if ($_POST['action'] == 'tomain')
                pjax('/admin/rbac/groupList');
            if ($_POST['action'] == 'tocreate')
                pjax('/admin/rbac/groupCreate');
            if ($_POST['action'] == 'toedit')
                pjax('/admin/rbac/groupEdit/' . $groupId);
        } else {

            $sqlPrivilege = 'SELECT id, name, description, group_id FROM shop_rbac_privileges ORDER BY group_id ASC';
            $privileges = $this->db->query($sqlPrivilege);


            $this->template->add_array(array(
                'model' => $model->row(),
                'privileges' => $privileges->result()
            ));

            $this->template->show('groupEdit', FALSE);
        }
    }

    public function groupList() {


        $sql = 'SELECT id, name, description FROM shop_rbac_group ORDER BY name ASC';
        $query = $this->db->query($sql);

        $this->template->add_array(array(
            'model' => $query->result()
        ));

        $this->template->show('groupList', FALSE);
    }

    /**
     * delete a RBAC privileges group
     * 
     * @param integer $groupId
     * @access public 
     * @return	void
     */
    public function groupDelete() {
        $groupId = $this->input->post('id');
        $model = ShopRbacGroupQuery::create()
                ->findPks($groupId);

        if ($model != null) {
            $model->delete();
            showMessage('Успех', 'Группа(ы) успешно удалены');
            pjax('/admin/rbac/groupList');
        }
    }

    /*     * *************  RBAC roles  ************** */

    /**
     * create a RBAC role
     * 
     * @access public 
     * @return     void
     */
    public function roleCreate() {

        if (!empty($_POST)) {
            $this->form_validation->set_rules('Name', 'Name', 'required');

            if ($this->form_validation->run($this) == FALSE) {
                showMessage(validation_errors(), '', 'r');
            } else {


                $sql = "INSERT INTO shop_rbac_roles (name, description) VALUES(" . $this->db->escape($_POST['Name']) . ", " . $this->db->escape($_POST['Description']) . ")";
                $this->db->query($sql);


                if ($_POST['Privileges']) {

                    $idCreate = $this->db->insert_id();
                    foreach ($_POST['Privileges'] as $idPrivilege) {
                        $sqlPrivilege = "INSERT INTO shop_rbac_roles_privileges (role_id, privilege_id) VALUES(" . $idCreate . ", " . $this->db->escape($idPrivilege) . ")";
//                      
                        $this->db->query($sqlPrivilege);
                    }
                }


                showMessage(ShopCore::t(lang('a_js_edit_save')));

                if ($_POST['action'] == 'edit') {
                    pjax('/admin/components/run/shop/rbac/roleEdit/' . $idCreate);
                } else {
                    pjax('/admin/rbac/roleList');
                }
            }
        } else {

            $queryGroups = $this->db->select(array('id', 'name', 'description'))->get('shop_rbac_group')->result();
            foreach ($queryGroups as $key => $value) {
                $queryGroups[$key]->privileges = $this->db->get_where('shop_rbac_privileges', array('group_id' => $value->id))->result();
            }

            $this->template->add_array(array(
                'groups' => $queryGroups
            ));

            $this->template->show('roleCreate', FALSE);
        }
    }

    /**
     * edit a RBAC role
     *
     * @access	public 
     * @param	integer $roleId
     * @return	void
     */
    public function roleEdit($roleId) {

        $sqlModel = 'SELECT id, name, description, importance 
            FROM shop_rbac_roles WHERE id =' . $roleId . ' ORDER BY name ASC';
        $queryModel = $this->db->query($sqlModel);
        $queryModel->row();

        if ($queryModel === null)
            $this->error404(ShopCore::t(lang('a_rback_not_found')));

        if (!empty($_POST)) {
            $this->form_validation->set_rules('Name', 'Name', 'required');

            if ($this->form_validation->run($this) == FALSE) {
                showMessage(validation_errors(), '', 'r');
            } else {


                $sql = "UPDATE shop_rbac_roles SET name = " . $this->db->escape($_POST['Name']) . ", description = " . $this->db->escape($_POST['Description']) . ", importance = " . $this->db->escape($_POST['Importance']) . " WHERE id = " . $roleId;
                $this->db->query($sql);


                if ($_POST['Privileges']) {

                    foreach ($_POST['Privileges'] as $idPrivilege) {
                        $sqlPrivilege = "INSERT INTO shop_rbac_roles_privileges (role_id, privilege_id) VALUES(" . $this->db->escape($roleId) . ", " . $this->db->escape($idPrivilege) . ")";
//                      
                        $this->db->query($sqlPrivilege);
                    }
                }


                showMessage(ShopCore::t(lang('a_js_edit_save')));

                if ($_POST['action'] == 'edit') {

                    pjax('/admin/rbac/roleEdit/' . $roleId);
                } else {
                    pjax('/admin/components/run/shop/rbac/role_list');
                }
            }
        } else {

            $this->db->select('privilege_id');
            $queryPrivilegeR = $this->db->get_where('shop_rbac_roles_privileges', array('role_id' => $roleId))->result_array();

            $queryGroups = $this->db->select(array('id', 'name', 'description'))->get('shop_rbac_group')->result();
            foreach ($queryGroups as $key => $value) {
                $queryGroups[$key]->privileges = $this->db->get_where('shop_rbac_privileges', array('group_id' => $value->id))->result();
            }

            $emptyArray = array();

            foreach ($queryPrivilegeR as $key => $id) {
                $emptyArray[$key] = $id['privilege_id'];
            }            

            $this->template->add_array(array(
                'model' => $queryModel->row(),
                'groups' => $queryGroups,
                'privilegeCheck' => $emptyArray
            ));

            $this->template->show('roleEdit', FALSE);
        }
    }

    /**
     * display a list of RBAC roles
     * 
     * @access public
     * @return	void
     */
    public function roleList() {

        $sql = 'SELECT id, name, description, importance FROM shop_rbac_roles ORDER BY name ASC';
        $query = $this->db->query($sql);

        $this->template->add_array(array(
            'model' => $query->result(),
        ));

        $this->template->show('roleList', FALSE);
    }

    /**
     * delete a RBAC privileges group
     * 
     * @param integer $groupId
     * @access public 
     * @return	void
     */
    public function roleDelete() {
        $groupId = $this->input->post('ids');

        if ($groupId != null) {
            foreach ($groupId as $id)
                $this->db->delete('shop_rbac_roles', array('id' => $id));

            showMessage('Успех', 'Группа(ы) успешно удалены');
            pjax('/admin/rbac/roleList');
        }
    }

    /*     * *************  RBAC privileges  ************** */

    /**
     * create a RBAC privilege
     * 
     * @access public 
     * @return	void
     */
    public function privilegeCreate() {

        if (!empty($_POST)) {

            $this->form_validation->set_rules('Name', 'Name', 'required');

            if ($this->form_validation->run($this) == FALSE) {
                showMessage(validation_errors(), '', 'r');
            } else {


                $sql = "INSERT INTO shop_rbac_privileges (name, description, group_id) VALUES(" . $this->db->escape($_POST['Name']) . ", " . $this->db->escape($_POST['Description']) . ", " . $this->db->escape($_POST['GroupId']) . ")";
                $this->db->query($sql);


                showMessage(ShopCore::t(lang('a_rbak_privile_create')));

                if ($_POST['action'] == 'close') {
                    pjax('/admin/components/run/shop/rbac/privilege_create');
                } else {
                    pjax('/admin/components/run/shop/rbac/privilege_list');
                }
            }
        } else {
            $queryRBACGroup = $this->db->select(array('id', 'name', 'description'))->get('shop_rbac_group')->result();

            $this->template->add_array(array(
                'groups' => $queryRBACGroup
            ));

            $this->template->show('privilegeCreate', FALSE);
        }
    }

    /**
     * edit a RBAC privilege
     * 
     * @param integer $privilegeId
     * @access public 
     * @return	void
     */
    public function privilegeEdit($privilegeId) {
        $queryRBACPrivilege = $this->db->get_where('shop_rbac_privileges', array('id' => $privilegeId))->row();

        if ($queryRBACPrivilege === null AND FALSE)
            $this->error404(ShopCore::t(lang('a_rbak_privi_not')));

        if (!empty($_POST)) {


            $sql = "UPDATE shop_rbac_privileges SET name = " . $this->db->escape($_POST['Name']) . ", description = " . $this->db->escape($_POST['Description']) . ", group_id = " . $this->db->escape($_POST['GroupId']) . " WHERE id = " . $privilegeId;
            $this->db->query($sql);

            showMessage(ShopCore::t(lang('a_js_edit_save')));

            if ($_POST['action'] == 'close') {
                pjax('/admin/rbac/privilegeEdit/' . $privilegeId);
            } else {
                pjax('/admin/rbac/privilegeList');
            }
        } else {
            $queryRBACGroup = $this->db->select(array('id', 'name', 'description'))->get('shop_rbac_group')->result();

            $this->template->add_array(array(
                'model' => $queryRBACPrivilege,
                'groups' => $queryRBACGroup
            ));

            $this->template->show('privilegeEdit', FALSE);
        }
    }

    /**
     * display a list of RBAC privileges
     * 
     * @access public
     * @return	void
     */
    public function privilegeList() {

        $queryPrivilegeR = $this->db->select()->get('shop_rbac_roles_privileges')->result();

        $queryGroups = $this->db->select(array('id', 'name', 'description'))->get('shop_rbac_group')->result();
        foreach ($queryGroups as $key => $value) {
            $queryGroups[$key]->privileges = $this->db->get_where('shop_rbac_privileges', array('group_id' => $value->id))->result();
        }

        $queryRBACGroup = $this->db->select(array('id', 'name', 'description'))->get('shop_rbac_privileges')->result();

        $this->template->add_array(array(
            'model' => $queryRBACGroup,
            'groups' => $queryGroups
        ));

        $this->template->show('privilegeList', FALSE);
    }

    /**
     * delete a RBAC privilege
     * 
     * @param integer $privilegeId
     * @access public 
     * @return	void
     */
    public function privilegeDelete() {
        $privilegeId = $this->input->post('id');
        $model = ShopRbacPrivilegesQuery::create()
                ->findPks($privilegeId);

        if ($model != null) {
            $model->delete();
            showMessage('Успех', 'Привилегии успешно удалены');
            pjax('/admin/components/run/shop/rbac/privilege_list');
        }
    }

}

?>
