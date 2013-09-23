<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Permitions {

    private static $shop_controllers_path = 'application/modules/shop/admin/';  //define shop admin controllers path
    private static $base_controllers_path = 'application/modules/admin/';       //define base admin controllers path
    private static $modules_controllers_path = 'application/modules/';          //define modules path
    private static $rbac_roles_table = 'shop_rbac_roles';                       //define rbac roles table name
    private static $rbac_privileges_table = 'shop_rbac_privileges';             //define privileges table name
    private static $rbac_group_table = 'shop_rbac_group';                       //define group table
    private static $rbac_roles_privileges_table = 'shop_rbac_roles_privileges'; //define roles privileges table
    private static $controller_types = array('shop', 'base', 'module');         //define controllers types

    public function __construct() {
        $ci = & get_instance();
        $ci->load->library('DX_Auth');
    }

    /**
     * runs in BaseAdminController and ShopAdminController __construct()
     */
    public static function checkPermitions() {
        self::checkUrl();
    }

    /**
     *
     * @param type $adminClassName
     * @param type $adminMethod
     * @return boolean
     */
    private static function checkAllPermitions($adminClassName, $adminMethod) {
        $ci = & get_instance();

        //define error message
        $err_text = '<div class="alert alert-error">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <h4>Warning!</h4>
            %error_message%.
            </div>';

        //check if user is loged in
        if ($ci->dx_auth->is_logged_in()) {
            //creating string for search in rbac privileges table
            $privilege = $adminClassName . '::' . $adminMethod;

            //searching privilege
            $privilege = $ci->db->where('name', $privilege)->get(self::$rbac_privileges_table)->row();

            //searching user by id to get his role id
            $userProfile = $ci->db->where('id', $ci->dx_auth->get_user_id())->get('users')->row();

            $locale = 'ru';

            //get privilege title
            $priv_title = $ci->db->select("title")->where(array('id' => $privilege->id, 'locale' => $locale))->get(self::$rbac_privileges_table . "_i18n")->row();

            //if user exists!
            if (!empty($userProfile))
            //get user role
                $userRole = $ci->db->where('id', $userProfile->role_id)->get(self::$rbac_roles_table)->row();

            //if privilege found
            if (!empty($privilege)) {
                //check if role exists
                if (!empty($userRole)) {
                    //check if user has needed privilege
                    $userPrivilege = $ci->db->where(array('role_id' => (int) $userRole->id, 'privilege_id' => (int) $privilege->id))->get(self::$rbac_roles_privileges_table)->result();
                    if (!empty($userPrivilege)) {
                        //yes, current user has needed privilege
                        return TRUE;
                    } else {
                        //no, permition denied
                        redirect('admin/rbac/permition_denied');
                    }
                }
            } else {
                //if privilege not found in base check if user is admin
                if ($userRole->name != 'Administrator' AND $adminMethod != 'permition_denied')
                    redirect('admin/rbac/permition_denied');
            }
        }else {
            //user always has access to admin/login page
            if ($adminClassName != 'Login')
                if ($ci->input->is_ajax_request()) {
                    echo json_encode(array('success' => false, 'redirect' => 'admin/login'));
                    exit;
                }
                else
                    redirect('admin/login');
        }
    }

    /**
     * parsing url to get needed parameters
     * @param type $checkLink
     * @param type $link
     * @return array with class name and class method
     */
    private static function checkUrl($checkLink = FALSE, $link = '') {
        $ci = & get_instance();

        if ($checkLink AND $link != '') {
            $uri_array = explode("/", $link);
            $for_check = $uri_array[1];
        }
        else
            $for_check = $ci->uri->segment(2);

        if ($for_check == 'components') {
            if (in_array($ci->uri->segment(3), array('init_window', 'run', 'cp')) OR in_array($uri_array[2], array('init_window', 'run', 'cp'))) {
                $classNamePrep = 'Admin';
                $controller_segment = 4;
                $controller_method = 5;
            } else {
                $controller_segment = 2;
                $controller_method = 3;
                $classNamePrep = 'Base';
            }
            if ($ci->uri->segment(4) == 'shop' OR $uri_array[3] == 'shop') {
                $classNamePrep = 'ShopAdmin';
                $controller_segment = 5;
                $controller_method = 6;
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

    /**
     * scans all admin controllers
     */
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

    /**
     * scans needed controller for public methods and write them into privileges table
     * @param type $controller
     * @param type $folder
     */
    private static function scanControllers($controller, $folder) {
        $locale = MY_Controller::getCurrentLocale();
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
                $group = $ci->db->where('name', ucfirst($controllerClassName))->get(self::$rbac_group_table)->row();
                if (empty($group)) {
                    $ci->db->insert(self::$rbac_group_table, array('name' => ucfirst($controllerClassName), 'type' => $folder));
                    $ci->db->insert(self::$rbac_group_table . "_i18n", array('id' => $ci->db->insert_id(), 'description' => '', 'locale' => $locale));
                    $group = $ci->db->where('name', ucfirst($controllerClassName))->get(self::$rbac_group_table)->row();
                }
                if (empty($dbPrivilege)) {
                    $ci->db->insert(self::$rbac_privileges_table, array('name' => $privilegeName, 'group_id' => $group->id));
                    $ci->db->insert(self::$rbac_privileges_table . "_i18n", array('id' => $ci->db->insert_id(), 'title' => '', 'description' => '', 'locale' => $locale));
                }
            }
        }
        if ($folder == 'module')
            unlink($controller);
    }

    /**
     * check if user with id = 1 exists and has all privileges
     * @return boolean
     */
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

    /**
     * add all privileges to superadmin role
     */
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

                $sql = "INSERT INTO shop_rbac_group (type, name) VALUES(" . $this->db->escape($_POST['type']) . "," . $this->db->escape($_POST['Name']) . ")";
                $this->db->query($sql);

                $idNewGroup = $this->db->insert_id();

                $sql = "INSERT INTO  shop_rbac_group_i18n (id, description, locale) VALUES(" . $idNewGroup . ", " . $this->db->escape($_POST['Description']) . ", '" . MY_Controller::getCurrentLocale() . "' ) ";

                $this->db->query($sql);

                if ($_POST['Privileges']) {
                    $idPrivilege = implode(',', $_POST['Privileges']);
                    $sql = "UPDATE shop_rbac_privileges SET group_id = " . $idNewGroup . " WHERE id IN(" . $idPrivilege . ")";
                    $this->db->query($sql);
                }

                showMessage('Группа создана');
                if ($_POST['action'] == 'tomain')
                    pjax('/admin/rbac/groupEdit/' . $idNewGroup);
                if ($_POST['action'] == 'tocreate')
                    pjax('/admin/rbac/groupCreate');
                if ($_POST['action'] == 'toedit')
                    pjax('/admin/rbac/groupEdit/' . $idNewGroup);
            }
        } else {

            $sqlModel = 'SELECT SRP.id, SRP.name, SRP.group_id, SRPI.title, SRPI.description
            FROM shop_rbac_privileges SRP
            INNER JOIN shop_rbac_privileges_i18n SRPI ON SRPI.id = SRP.id WHERE SRPI.locale = "' . MY_Controller::getCurrentLocale() . '"  ORDER BY SRP.name ASC';
            $model = $this->db->query($sqlModel);

            $this->template->add_array(array(
                'model' => $model,
                'privileges' => $model->result(),
            ));

            $this->template->show('groupCreate', FALSE);
        }
    }

    public function groupEdit($groupId) {

        $sqlModel = 'SELECT SRG.id, SRG.name, SRGI.description
            FROM shop_rbac_group SRG
            INNER JOIN shop_rbac_group_i18n SRGI ON SRGI.id = SRG.id WHERE SRG.id = "' . $groupId . '" AND SRGI.locale = "' . MY_Controller::getCurrentLocale() . '"  ORDER BY SRG.name ASC';
        $model = $this->db->query($sqlModel);

        if ($model === null)
            $this->error404('Гр
                    уппа не найдена');

        if (!empty($_POST)) {

            $sql = "UPDATE shop_rbac_group SET name = " . $this->db->escape($_POST['Name']) .
                    " WHERE id = " . $groupId;
            $this->db->query($sql);

            $sql = "UPDATE shop_rbac_group_i18n SET description = " . $this->db->escape($_POST['Description']) . " WHERE id = " . $groupId . " AND locale = '" . MY_Controller::getCurrentLocale() . "'";
            $this->db->query($sql);

            if ($_POST['Privileges']) {
                $idPrivilege = implode(',', $_POST['Privileges']);
                $sql = "UPDATE shop_rbac_privileges SET group_id = " . $groupId . " WHERE id IN(" . $idPrivilege . ")";
                $this->db->query($sql);
            }
            showMessage('Изменения сохранены');
            if ($_POST['action'] == 'tomain')
                pjax('/admin/rbac/groupEdit/' . $groupId);
            if ($_POST['action'] == 'tocreate')
                pjax('/admin/rbac/groupCreate');
            if ($_POST['action'] == 'toedit')
                pjax('/admin/rbac/groupEdit/' . $groupId);
        } else {

            $sqlPrivilege = $this->db->select(array('id', 'name', 'group_id'))->get('shop_rbac_privileges')->result();


            $this->template->add_array(array(
                'model' => $model->row(),
                'privileges' => $sqlPrivilege
            ));

            $this->template->show('groupEdit', FALSE);
        }
    }

    public function groupList() {


        $sql = 'SELECT SRG.id, SRG.name, SRGI.description
            FROM shop_rbac_group SRG
            INNER JOIN shop_rbac_group_i18n SRGI ON SRGI.id = SRG.id WHERE SRGI.locale = "' . MY_Controller::getCurrentLocale() . '" ORDER BY name ASC';
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
        $groupId = $this->input->post('ids');

        if ($groupId != null) {
            foreach ($groupId as $id) {
                $this->db->delete('shop_rbac_group', array('id' => $id));
                $this->db->delete('shop_rbac_group_i18n', array('id' => $id));
            }
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
            $this->form_validation->set_rules('Name', 'Имя', 'required');
            $this->form_validation->set_rules('Importance', 'Важность', 'numeric');
            if ($this->form_validation->run($this) == FALSE) {
                showMessage(validation_errors(), '', 'r');
            } else {
                if ($this->db->where('name', $_POST['Name'])->get(self::$rbac_roles_table)->num_rows() == 0) {
                    $sql = "INSERT INTO shop_rbac_roles(name, importance) VALUES(" . $this->db->escape($_POST['Name']) . ", " . $this->db->escape($_POST['Importance']) .
                            ")";
                    $this->db->query($sql);
                    $idCreate = $this->db->insert_id();
                    $sql = "INSERT INTO shop_rbac_roles_i18n(id, alt_name, locale, description) VALUES(" . $idCreate . ", " . $this->db->escape($_POST['Name']) .
                            ",  '" . MY_Controller::getCurrentLocale() . "',  "
                            . $this->db->escape($_POST['Description']) . ")";
                    $this->db->query($sql);
                    if ($_POST['Privileges']) {
                        foreach ($_POST['Privileges'] as $idPrivilege) {
                            $sqlPrivilege = "INSERT INTO shop_rbac_roles_privileges (role_id, privilege_id) VALUES(" . $idCreate . ", " . $this->db->escape($idPrivilege) . ")";
                            $this->db->query($sqlPrivilege);
                        }
                    }
                    showMessage(lang("Changes have been saved"));
                    if ($_POST['action'] == 'new') {
                        pjax('/admin/rbac/roleEdit/' . $idCreate);
                    } else {
                        pjax('/admin/rbac/roleList');
                    }
                } else {
                    showMessage("Такое имя для роли уже занято");
                }
            }
        } else {
            //preparing array of controller types
            $types = $this->db->query("SELECT DISTINCT `type` FROM " . self::$rbac_group_table)->result_array();
            foreach ($types as $item)
                $controller_types[] = $item['type'];

            //preparing groups
            foreach ($controller_types as $controller_type) {
                $result[$controller_type] = $this->db->query("SELECT * FROM " . self::$rbac_group_table . "
                    JOIN `" . self::$rbac_group_table . "_i18n` ON " . self::$rbac_group_table . ".id=" . self::$rbac_group_table . "_i18n.id
                        WHERE `type`='" . $controller_type . "' AND `locale`='" . MY_Controller::getCurrentLocale() . "'")->result_array();
                if (!empty($result[$controller_type])) {
                    foreach ($result[$controller_type] as $key => $group) {
                        $result[$controller_type][$key]['privileges'] = $this->db->query("SELECT * FROM " . self::$rbac_privileges_table . "
                            JOIN " . self::$rbac_privileges_table . "_i18n ON " . self::$rbac_privileges_table . ".id=" . self::$rbac_privileges_table . "_i18n.id
                                WHERE `group_id`=" . (int) $group['id'] . " AND `locale`='" . MY_Controller::getCurrentLocale() . "'")->result_array();
                    }
                }
            }

            //array sort
            foreach ($controller_types as $controller_type) {
                //foreach ($result[$controller_type] as $key => $value) {
                for ($j = 0; $j < count($result[$controller_type]); $j++) {
                    for ($i = 0; $i < count($result[$controller_type]) - $j; $i++)
                        if ($result[$controller_type][$i + 1])
                            if (count($result[$controller_type][$i + 1]['privileges']) < count($result[$controller_type][$i]['privileges'])) {
                                $temp = $result[$controller_type][$i];
                                $result[$controller_type][$i] = $result[$controller_type][$i + 1];
                                $result[$controller_type][$i + 1] = $temp;
                            }
                }
            }
            $this->template->add_array(array(
                'types' => $result
            ));

            $this->template->show('roleCreate', FALSE);
        }
    }

    public function translateRole($id, $lang) {

        $sqlModel = 'SELECT id, alt_name, locale, description
            FROM  shop_rbac_roles_i18n
            WHERE id = "' . $id . '" AND locale = "' . $lang . '"';

        $queryModel = $this->db->query($sqlModel)->row();

        if ($_POST) {
            if (empty($queryModel)) {

                $sql = "INSERT INTO shop_rbac_roles_i18n(id, alt_name, locale, description) VALUES(" . $id . ", " . $this->db->escape($_POST['alt_name']) .
                        ",  '" . $lang . "',  "
                        . $this->db->escape($_POST['Description']) . ")";
                $this->db->query($sql);
            } else {
                $sqlI = "UPDATE shop_rbac_roles_i18n SET alt_name = " . $this->db->escape($_POST['alt_name']) . ", locale = '" . $lang . "', description = " . $this->db->escape($_POST['Description']) . " WHERE id = '" . $id . "' AND locale = '" . $lang . "'";
                $this->db->query($sqlI);
            }

            showMessage(lang("Changes have been saved"));
            if ($_POST['action'] == 'edit') {
                pjax('/admin/rbac/translateRole/' . $id . '/' . $lang);
            } else {
                pjax('/admin/rbac/roleList');
            }
        } else {

            $this->template->add_array(array(
                'model' => $queryModel,
                'idRole' => $id,
                'lang_sel' => $lang
            ));
            $this->template->show('translateRole', FALSE);
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
        $sqlModel = 'SELECT SRR.id, SRR.name, SRR.importance, SRRI.alt_name, SRRI.description
            FROM shop_rbac_roles SRR
            INNER JOIN shop_rbac_roles_i18n SRRI ON SRRI.id = SRR.id WHERE SRR.id = "' . $roleId . '" AND SRRI.locale = "' . MY_Controller::getCurrentLocale() . '" ORDER BY SRR.name ASC';

        $queryModel = $this->db->query($sqlModel);
        $queryModel->row();

        if ($queryModel === null)
            $this->error404(lang("Role not found"));

        if (!empty($_POST)) {
            $this->form_validation->set_rules('Name', 'Name', 'required');

            if ($this->form_validation->run($this) == FALSE) {
                showMessage(validation_errors(), '', 'r');
            } else {
                $sql = "UPDATE shop_rbac_roles SET importance = " . $this->db->escape($_POST['Importance']) .
                        " WHERE id   =   '" . $roleId . "'";
                $this->db->query($sql);

                $sqlI = "UPDATE shop_rbac_roles_i18n SET alt_name = " .
                        $this->db->escape($_POST['alt_name']) . ", description = " .
                        $this->db->escape($_POST['Description']) . " WHERE id = '" .
                        $roleId . "' AND locale = '" . MY_Controller::getCurrentLocale() . "'";
                $this->db->query($sqlI);

                if ($_POST['Privileges']) {
                    $idForDelete = implode(', ', $_POST['Privileges']);
                    $sqlDelete = "DELETE FROM `shop_rbac_roles_privileges` WHERE `role_id`=" . $roleId . " AND `privilege_id` NOT IN (" . $idForDelete . ")";
                    $this->db->query($sqlDelete);

                    foreach ($_POST['Privileges'] as $idPrivilege) {
                        if (!$this->db->where(array('role_id' => $roleId, 'privilege_id' => (int) $idPrivilege))->get(self::$rbac_roles_privileges_table)->num_rows()) {
                            $sqlPrivilege = "INSERT INTO shop_rbac_roles_privileges (role_id, privilege_id) VALUES(" . $this->db->escape($roleId) . ", " . $this->db->escape($idPrivilege) . ")";
                            $this->db->query($sqlPrivilege);
                        }
                    }
                }
                showMessage(lang("Changes have been saved"));
                if ($_POST['action'] != 'edit')
                    pjax('/admin/rbac/roleList');
            }
        } else {
            //preparing array of privileges ids which belong to currenc role
            $sql = 'SELECT `privilege_id`
            FROM `shop_rbac_roles_privileges` WHERE `role_id` = ' . $roleId;
            $queryPrivilegeR = $this->db->query($sql)->result_array();
            $role_privileges = array();
            foreach ($queryPrivilegeR as $item)
                $role_privileges[] = (int) $item['privilege_id'];

            //preparing array of controller types
            $types = $this->db->query("SELECT DISTINCT `type` FROM " . self::$rbac_group_table)->result_array();
            foreach ($types as $item)
                $controller_types[] = $item['type'];

            //preparing groups
            foreach ($controller_types as $controller_type) {
                $result[$controller_type] = $this->db->query("SELECT * FROM " . self::$rbac_group_table . "
                    JOIN `" . self::$rbac_group_table . "_i18n` ON " . self::$rbac_group_table . ".id=" . self::$rbac_group_table . "_i18n.id
                        WHERE `type`='" . $controller_type . "' AND `locale`='" . MY_Controller::getCurrentLocale() . "'")->result_array();
                if (!empty($result[$controller_type])) {
                    foreach ($result[$controller_type] as $key => $group) {
                        $result[$controller_type][$key]['privileges'] = $this->db->query("SELECT * FROM " . self::$rbac_privileges_table . "
                            JOIN " . self::$rbac_privileges_table . "_i18n ON " . self::$rbac_privileges_table . ".id=" . self::$rbac_privileges_table . "_i18n.id
                                WHERE `group_id`=" . (int) $group['id'] . " AND `locale`='" . MY_Controller::getCurrentLocale() . "'")->result_array();
                    }
                }
            }

            //array sort
            foreach ($controller_types as $controller_type) {
                //foreach ($result[$controller_type] as $key => $value) {
                for ($j = 0; $j < count($result[$controller_type]); $j++) {
                    for ($i = 0; $i < count($result[$controller_type]) - $j; $i++)
                        if ($result[$controller_type][$i + 1])
                            if (count($result[$controller_type][$i + 1]['privileges']) < count($result[$controller_type][$i]['privileges'])) {
                                $temp = $result[$controller_type][$i];
                                $result[$controller_type][$i] = $result[$controller_type][$i + 1];
                                $result[$controller_type][$i + 1] = $temp;
                            }
                }
            }

            $sqlLangSel = 'SELECT lang_sel FROM settings';
            $Lang = $this->db->query($sqlLangSel)->row();
            $this->template->add_array(array(
                'model' => $queryModel->row(),
                'lang_sel' => $Lang,
                'types' => $result,
                'privilegeCheck' => $role_privileges
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

        $sql = 'SELECT SRR.id, SRR.name, SRR.importance, SRRI.alt_name, SRRI.description
            FROM shop_rbac_roles SRR
            INNER JOIN shop_rbac_roles_i18n SRRI ON SRRI.id = SRR.id WHERE SRRI.locale = "' . MY_Controller::getCurrentLocale() . '" ORDER BY SRR.name ASC';
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
            foreach ($groupId as $id) {
                $this->db->delete('shop_rbac_roles', array('id' => $id));
                $this->db->delete('shop_rbac_roles_i18n', array('id' => $id));
                $this->db->delete('shop_rbac_roles_privileges', array('role_id' => $id));
            }

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


                $sql = "INSERT INTO shop_rbac_privileges(name, group_id) VALUES(" . $this->db->escape($_POST['Name']) .
                        ",  " . $this->db->escape($_POST['GroupId']) . ")";
                $this->db->query($sql);

                $idNewPrivilege = $this->db->insert_id();

                $sqlI = "INSERT INTO shop_rbac_privileges_i18n(id, title, description, locale) VALUES("
                        . $idNewPrivilege .
                        ", " . $this->db->escape($_POST['Title']) .
                        ", " . $this->db->escape($_POST['Description']) .
                        ", '" . MY_Controller::getCurrentLocale() . "')";
                $this->db->query($sqlI);


                showMessage(lang("Privilege created"));

                if ($_POST['action'] == 'close') {
                    pjax('/admin/rbac/privilegeCreate');
                } else {
                    pjax('/admin/rbac/privilegeList');
                }
            }
        } else {
            $sql = 'SELECT SRG.id, SRGI.description
            FROM shop_rbac_group SRG
            INNER JOIN  shop_rbac_group_i18n SRGI ON SRGI.id = SRG.id WHERE SRGI.locale = "' . MY_Controller::getCurrentLocale() . '"';
            $queryRBACGroup = $this->db->query($sql)->result();

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
//        $queryRBACPrivilege = $this->db->get_where('shop_rbac_privileges', array('id' => $privilegeId))->row();

        $sqlPr = 'SELECT SRP.id, SRP.name, SRP.group_id, SRPI.title, SRPI.description
            FROM shop_rbac_privileges SRP
            INNER JOIN   shop_rbac_privileges_i18n SRPI ON SRPI.id = SRP.id WHERE SRPI.locale = "' . MY_Controller::getCurrentLocale() . '" AND SRP.id = ' . $privilegeId;
        $queryRBACPrivilege = $this->db->query($sqlPr)->row();

        if ($queryRBACPrivilege === null AND FALSE)
            $this->error404(lang("The privilege is not found"));


        if (!empty($_POST)) {


            $sql = "UPDATE shop_rbac_privileges SET name = " . $this->db->escape($_POST[
                            'Name']) . ",  description  =  " . $this->db->escape($_POST['Description']) . ", group_id = " . $this->db->escape($_POST['GroupId']) .
                    " WHERE id = " . $privilegeId;
            $this->db->query($sql);

            showMessage(lang("Changes have been saved"));

            if ($_POST['action'] == 'close') {
                pjax('/admin/rbac/privilegeEdit/' . $privilegeId);
            } else {
                pjax('/admin/rbac/privilegeList');
            }
        } else {
            $sql = 'SELECT SRG.id, SRGI.description
            FROM shop_rbac_group SRG
            INNER JOIN  shop_rbac_group_i18n SRGI ON SRGI.id = SRG.id WHERE SRGI.locale = "' . MY_Controller::getCurrentLocale() . '"';
            $queryRBACGroup = $this->db->query($sql)->result();

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

        $sql = 'SELECT SRG.id, SRG.name, SRGI.description
            FROM shop_rbac_group SRG
            INNER JOIN shop_rbac_group_i18n SRGI ON SRGI.id = SRG.id WHERE SRGI.locale = "' . MY_Controller::getCurrentLocale() . '"';
        $queryGroups = $this->db->query($sql)->result();
        foreach ($queryGroups as $key => $value) {
            $sqlPriv = 'SELECT SRP.id, SRP.name, SRP.group_id, SRPI.title, SRPI.description
            FROM shop_rbac_privileges SRP
            INNER JOIN  shop_rbac_privileges_i18n SRPI ON SRPI.id = SRP.id WHERE SRPI.locale = "' . MY_Controller::getCurrentLocale() . '" AND SRP.group_id = ' . $value->id;
            $queryGroupsPrivilege = $this->db->query($sqlPriv)->result();

            $queryGroups[$key]->privileges = $queryGroupsPrivilege;
        }

        $queryRBACGroup = $this->db->select(array('id', 'name'))->get('shop_rbac_privileges')->result();

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

    public static function checkControlPanelAccess($role_id) {
        if ($role_id != null) {
            $ci = & get_instance();
            $r = $ci->db->query("SELECT * FROM `" . self::$rbac_roles_privileges_table . "`
                        JOIN `" . self::$rbac_privileges_table . "` ON " . self::$rbac_roles_privileges_table . ".privilege_id = " . self::$rbac_privileges_table . ".id
                        WHERE " . self::$rbac_roles_privileges_table . ".role_id = " . $role_id . " AND `name` = 'Admin::__construct'")->num_rows();
            if ($r > 0)
                return 'admin';
            else
                return '';
        }
        else
            return '';
    }

    public function deletePermition($id = null) {
        if (!$id)
            return false;
        else {
            $this->db->where('id', $id)->delete(self::$rbac_privileges_table . "_i18n");
            $this->db->where('id', $id)->delete(self::$rbac_privileges_table);
            showMessage("Привилегия удалена");
            pjax('/admin/rbac/roleEdit/1');
        }
    }

    /**
     * helper functions
     */
    /* private static function groupsIntoFile() {
      $ci = &get_instance();
      $join_string = self::$rbac_group_table . ".id=" . self::$rbac_group_table . "_i18n.id";
      $groups = $ci->db->query("SELECT * FROM `" . self::$rbac_group_table . "`
      JOIN `" . self::$rbac_group_table . "_i18n` ON " . $join_string)->result_array();
      file_put_contents('groups.php', var_export($groups, true));
      }

      private static function groupsIntoDB() {
      $ci = &get_instance();
      $locale = 'ru';
      $string = "\$result = " . file_get_contents('groups_descriptions.php') . ";";
      eval($string);
      if (is_array($result)) {
      foreach ($result as $item) {
      //$ci->db->where('id', $item['id'])->update(self::$rbac_group_table . "_i18n", array('description' => $item['description']));
      $g = $ci->db->where('name', $item['name'])->get(self::$rbac_group_table)->row();
      $ci->db->where('id', $g->id)->update(self::$rbac_group_table . "_i18n", array('description' => $item['description']));
      }
      }
      }

      private static function privilegesIntoFile() {
      $ci = &get_instance();
      $locale = 'ru';
      $join_string = self::$rbac_privileges_table . ".id=" . self::$rbac_privileges_table . "_i18n.id";
      $privileges = $ci->db->query("SELECT * FROM `" . self::$rbac_privileges_table . "`
      JOIN `" . self::$rbac_privileges_table . "_i18n` ON " . $join_string)->result_array();
      file_put_contents('privileges.php', var_export($privileges, true));
      }


      private static function privilegesIntoDB() {
      $ci = &get_instance();
      $locale = 'ru';
      $string = "\$result = " . file_get_contents('privileges.php') . ";";
      eval($string);
      if (is_array($result)) {
      foreach ($result as $item) {
      $p = $ci->db->where('name', $item['name'])->get(self::$rbac_privileges_table)->row();
      $ci->db->where('id', $p->id)->update(self::$rbac_privileges_table . "_i18n", array('title' => $item['title'], 'description' => $item['description']));
      }
      }
      }

     */
}

?>
