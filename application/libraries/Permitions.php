<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Permitions {

    private $shop_controllers_path;
    private $base_controllers_path;

    public function __construct() {
        //$ci = &get_instance();
        //$ci->load->library('DX_Auth');
//        $this->load->library('Form_validation');
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
        } else {
            $controller_segment = 2;
            $controller_method = 3;
        }
//        var_dump(SHOP_DIR);

        $adminController = ShopCore::$ci->uri->segment($controller_segment);
        $adminClassName = 'ShopAdmin' . ucfirst($adminController);
        $adminMethod = ShopCore::$ci->uri->segment($controller_method);
        $adminClassFile = SHOP_DIR . 'admin' . DS . $adminController . '.php';
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
            echo $_POST['dada'];

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
