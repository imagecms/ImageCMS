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
//        $model = new ShopRbacGroup();


        $this->form_validation;

//        $val = $this->set_rules('Name', lang('amt_user_login'), 'required');
        $this->form_validation->set_rules('Name', 'Name', 'required');

//        $rules['Name'] = "required";



        if (!empty($_POST)) {
            if ($this->form_validation->run($this) == FALSE) {
                showMessage(validation_errors(), '', 'r');
            } else {

//            $this->form_validation->set_rules($model->rules());
//
//            if ($this->form_validation->run($this) == FALSE) {
//                showMessage(validation_errors(), '', 'r');
//            } else {
//                // Check if privilege name is aviable.
//                $nameCheck = ShopRbacGroupQuery::create()
//                        ->filterByName($this->input->post('Name'))
//                        ->findOne();
//
//                if ($nameCheck !== null) {
//                    die(showMessage(ShopCore::t('Группа с таким названием уже существует')));
//                }
//
//                $model->fromArray($_POST);
//
//                $privileges = ShopRbacPrivilegesQuery::create()
//                        ->findPks($_POST['Privileges']);
//
//                $model->setShopRbacPrivilegess($privileges);
//                $model->save();

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


//        $model = ShopRbacGroupQuery::create()
//                ->orderByName(Criteria::ASC)
//                ->find();

        $sql = 'SELECT id, name, description FROM shop_rbac_group ORDER BY name ASC';
        $query = $this->db->query($sql);

//        var_dumps($query->result());

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

}

?>
