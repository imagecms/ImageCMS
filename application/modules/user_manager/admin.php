<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Image CMS
 * @property Users $users
 */
class Admin extends BaseAdminController
{

    public function __construct() {
        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('user_manager');

        // only admin access
        $this->load->library('DX_Auth');

        $this->load->library('Form_validation');
    }

    /*
     * Index function of user_manager admin
     * Select roles and displau main template
     */

    public function index($pagination = null) {

        //////**********  Pagination pages **********\\\\\\\
        if ($pagination) {
            $paginationSession = ['usr_manager_url' => $pagination];
            $this->session->set_userdata($paginationSession);
        } else {
            $this->session->unset_userdata('usr_manager_url');
        }

        $this->set_tpl_roles();
        $this->template->add_array($this->genre_user_table());
        $this->template->add_array($this->show_edit_prems_tpl(10));
        $this->template->registerJsFile(getModulePath('user_manager') . 'templates/js/script.js', 'after');
        $this->display_tpl('main');
    }

    /*
     * Assign template roles
     */

    public function set_tpl_roles() {
        $locale = MY_Controller::getCurrentLocale();
        $this->db->select('shop_rbac_roles.*', FALSE);
        $this->db->select('shop_rbac_roles_i18n.alt_name', FALSE);
        $this->db->where('locale', $locale);
        $this->db->join('shop_rbac_roles_i18n', 'shop_rbac_roles_i18n.id = shop_rbac_roles.id');
        $role = $this->db->get('shop_rbac_roles')->result_array();

        //$this->template->assign('roles', $query->result_array());
        $this->template->assign('roles', $role);
        // roles
    }

    public function getRolesTable($roleId) {
        $this->template->add_array($this->show_edit_prems_tpl($roleId));
        $this->display_tpl('genreroletable');
    }

    /**
     * Generate table with user with pagination
     * Ajax usage
     * Calling from javascript from main.tpl
     * @return array
     */
    public function genre_user_table() {

        //cp_check_perm('user_view_data');

        $this->load->model('dx_auth/users', 'users');

        $offset = (int) $this->uri->segment(6);
        $row_count = 20;

        // Get all users
        $users = $this->users->get_all($offset, $row_count);

        if (count($users)) {
            $this->load->library('Pagination');

            $config['base_url'] = site_url('admin/components/cp/user_manager/index');
            $config['total_rows'] = $this->users->get_all()->num_rows();
            $config['per_page'] = $row_count;
            $config['uri_segment'] = $this->uri->total_segments();

            $config['separate_controls'] = true;
            $config['full_tag_open'] = '<div class="pagination pull-left"><ul>';
            $config['full_tag_close'] = '</ul></div>';
            $config['controls_tag_open'] = '<div class="pagination pull-right"><ul>';
            $config['controls_tag_close'] = '</ul></div>';
            $config['next_link'] = lang('Next', 'admin') . '&nbsp;&gt;';
            $config['prev_link'] = '&lt;&nbsp;' . lang('Prev', 'admin');
            $config['cur_tag_open'] = '<li class="btn-primary active"><span>';
            $config['cur_tag_close'] = '</span></li>';
            $config['prev_tag_open'] = '<li>';
            $config['prev_tag_close'] = '</li>';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';
            $config['num_tag_close'] = '</li>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';

            $this->pagination->num_links = 5;
            $this->pagination->initialize($config);
            $this->template->assign('paginator', $this->pagination->create_links_ajax());
            // End pagination
        }

        $users = $users->result_array();

        for ($i = 0, $users_c = count($users); $i < $users_c; $i++) {
            if ($users[$i]['banned'] == 1) {
                $users[$i]['banned'] = 1;
            } else {
                $users[$i]['banned'] = 0;
            }
        }
        return [
                'users'    => $users,
                'cur_page' => $offset,
               ];
    }

    /**
     * @param string $type
     */
    public function auto_complit($type) {

        $s_limit = $this->input->get('limit');
        $s_coef = $this->input->get('term');

        $this->db->select('users.*', FALSE);
        if ($type == 'name') {
            $this->db->like('username', $s_coef);
        } else {

            $this->db->like('email', $s_coef);
        }
        $this->db->limit($s_limit);

        $query = $this->db->get('users');

        $users = $query->result_array();

        foreach ($users as $user) {
            if ($type == 'email') {
                $response[] = [
                               'value' => $user['email'],
                              ];
            } else {
                $response[] = [
                               'value' => $user['username'],
                              ];
            }
        }
        echo json_encode($response);
    }

    /**
     * Register new user
     */
    public function create_user() {

        if ($this->input->post()) {

            $this->load->model('dx_auth/users', 'user2');
            $val = $this->form_validation;

            $val->set_rules('username', lang('Login', 'user_manager'), 'trim|required|xss_clean');
            $val->set_rules('password', lang('Password', 'user_manager'), 'trim|min_length[' . $this->config->item('DX_login_min_length') . ']|max_length[' . $this->config->item('DX_login_max_length') . ']|required|xss_clean');
            $val->set_rules('password_conf', lang('Confirm the password', 'user_manager'), 'matches[password]|required');
            $val->set_rules('email', lang('E-Mail', 'user_manager'), 'trim|required|xss_clean|valid_email');

            if (preg_match('/[а-яА-Яіїёъa-zA-Z]/i', $this->input->post('phone'))) {

                $val->set_rules('phone', lang('Phone', 'user_manager'), 'trim|xss_clean|numeric');

            } else {
                $val->set_rules('phone', lang('Phone', 'user_manager'), 'trim|xss_clean');

            }

            ($hook = get_hook('users_create_set_val_rules')) ? eval($hook) : NULL;

            $email = $this->input->post('email');
            $role = $this->input->post('role');

            // check user mail
            if ($this->user2->check_email($email)->num_rows() > 0) {
                showMessage(lang('User with the same e-mail has been registered', 'user_manager'), '', 'r');
                exit;
            }

            $this->load->helper('string');
            if ($val->run() AND $user_info = $this->dx_auth->register($val->set_value('username'), $val->set_value('password'), $val->set_value('email'), '', random_string('alnum', 5), $this->input->post('phone'), false)) {

                //set user role
                $user_info = $this->user2->get_user_by_email($user_info['email'])->row_array();
                $this->user2->set_role($user_info['id'], $role);

                $this->lib_admin->log(
                    lang('Create a user or the username has been created', 'user_manager') .
                    ' <a href="' . site_url('/admin/components/cp/user_manager/edit_user/' . $user_info['id']) . '">' . $val->set_value('username') . '</a>'
                );

                showMessage(lang('Username has been created or user has been created', 'user_manager'));

                $action = $this->input->post('action');

                if ($action == 'close') {
                    pjax('/admin/components/cp/user_manager/edit_user/' . $user_info['id']);
                } else {
                    pjax('/admin/components/init_window/user_manager');
                }
            } else {
                $fields = [
                           'username',
                           'password',
                           'password_conf',
                           'email',
                           'phone',
                          ];
                $script = '<script type="text/javascript">';
                foreach ($fields as $field) {
                    $error = $val->error($field);
                    if (!empty($error)) {
                        $script .= "showError('$field','$error'); ";
                    }
                }
                $script .= '</script>';
                echo $script;
            }
        }

        $this->set_tpl_roles();
        if (!$this->ajaxRequest) {
            $this->template->registerJsFile('templates/administrator/js/jquery.maskedinput-1.3.min.js', 'after');
            $this->template->registerJsFile(getModulePath('user_manager') . 'templates/js/create.js', 'after');
            $this->display_tpl('create_user');
        }
    }

    /**
     * Ban, unban or delete users
     * @param int $user_id
     */
    public function actions($user_id) {
        $this->load->model('dx_auth/users', 'users');

        $query = $this->db->query("SELECT username, banned FROM users WHERE id = $user_id");

        foreach ($query->result() as $row) {
            if ($row->banned == 0) {

                //cp_check_perm('user_edit');
                ($hook = get_hook('users_ban')) ? eval($hook) : NULL;
                $this->users->ban_user($user_id);
                $this->lib_admin->log(
                    lang('Ban the user  or the user has been banned', 'user_manager') .
                    ' <a href="' . site_url('/admin/components/cp/user_manager/edit_user/' . $user_id) . '">' . $row->username . '</a>'
                );
            } else {

                //cp_check_perm('user_edit');
                ($hook = get_hook('users_unban')) ? eval($hook) : NULL;
                $this->users->unban_user($user_id);
                $this->lib_admin->log(
                    lang('The user has been unbanned ', 'user_manager') .
                    ' <a href="' . site_url('/admin/components/cp/user_manager/edit_user/' . $user_id) . '">' . $row->username . '</a>'
                );
            }
        }
    }

    /**
     * Search users
     */
    public function search() {
        if ($this->input->get()) {
            $locale = MY_Controller::defaultLocale();
            @$s_data = $this->input->get('s_data');
            @$s_email = $this->input->get('s_email');
            $role = $this->input->get('role');
            $this->db->select('users.*', FALSE);
            $this->db->select('shop_rbac_roles.name AS role_name', FALSE);
            $this->db->select('shop_rbac_roles_i18n.alt_name AS role_alt_name, shop_rbac_roles_i18n.locale', FALSE);

            $this->db->join('shop_rbac_roles', 'shop_rbac_roles.id = users.role_id', 'left');
            $this->db->join('shop_rbac_roles_i18n', "shop_rbac_roles.id = shop_rbac_roles_i18n.id AND shop_rbac_roles_i18n.locale='$locale'", 'left');

            if (!empty($s_data)) {
                $this->db->like('username', $s_data);
            } elseif (!empty($s_email)) {
                $this->db->like('email', $s_email);
            }
            $this->db->order_by('created', 'desc');

            $query = $this->db->get('users');

            if ($query->num_rows() == 0) {
                $this->template->add_array($this->show_edit_prems_tpl($id = 2));
                $this->template->add_array(['role_id' => $role]);
                $this->template->assign('users', FALSE);
                $rezult_table = $this->fetch_tpl('main');

                echo $rezult_table;
            } else {
                $users = $query->result_array();

                for ($i = 0, $users_c = count($users); $i < $users_c; $i++) {

                    if ((int) $role != 0) {
                        if ($users[$i]['role_id'] != $role) {
                            unset($users[$i]);
                        }
                    }

                    if ($role === 'without') {
                        if ($users[$i]['role_id']) {
                            unset($users[$i]);
                        }
                    }
                }

                // recount users
                if (count($users) == 0) {
                    $this->template->add_array($this->show_edit_prems_tpl($id = 2));
                    $this->template->add_array(['role_id' => $role]);
                    $this->template->assign('users', FALSE);
                    $rezult_table = $this->fetch_tpl('main');

                    echo $rezult_table;
                } else {

                    $this->template->assign('users', $users);
                    $this->template->add_array($this->show_edit_prems_tpl($id = 2));
                    $this->template->add_array(['role_id' => $role]);
                    $rezult_table = $this->fetch_tpl('main');

                    echo $rezult_table;
                }
            }
        } else {
            showMessage(lang('a_bas_filt_pass_not_post'), '', 'r');
            pjax('/admin/components/init_window/user_manager');
            exit();
        }
    }

    /**
     * Show edit_users form
     * @param int $user_id
     */
    public function edit_user($user_id) {
        ////cp_check_perm('user_edit');

        $this->load->model('dx_auth/users', 'users');

        $user = $this->users->get_user_by_id($user_id);

        if ($user->num_rows() == 0) {
            showMessage(lang('amt_users_not_found'), '', 'r');
            exit;
        } else {
            $this->template->add_array($user->row_array());
            $this->set_tpl_roles();
            if (!$this->ajaxRequest) {

                $userPagination = $this->session->userdata('usr_manager_url');
                $userPagination = $userPagination ? $userPagination : null;

                $this->template->assign('userPagination', $userPagination);
                $this->display_tpl('edit_user');
            }
        }
    }

    /**
     * Update user data
     * @param int $user_id
     */
    public function update_user($user_id) {

        //cp_check_perm('edit_user');

        $this->load->model('dx_auth/users', 'user2');
        $userPagination = $this->session->userdata('usr_manager_url');
        $userPagination = $userPagination ? $userPagination : null;

        $val = $this->form_validation;

        $val->set_rules('username', lang('amt_user_login'), 'trim|xss_clean');
        $val->set_rules('new_pass', lang('amt_password'), 'trim|max_length[' . $this->config->item('DX_login_max_length') . ']|xss_clean');
        $val->set_rules('new_pass_conf', lang('amt_new_pass_confirm'), 'matches[new_pass]');

        if (preg_match('/[а-яА-Яіїёъa-zA-Z]/i', $this->input->post('phone'))) {

            $val->set_rules('phone', lang('Phone', 'user_manager'), 'trim|xss_clean|numeric');

        } else {
            $val->set_rules('phone', lang('Phone', 'user_manager'), 'trim|xss_clean');

        }
        $val->set_rules('email', lang('amt_email'), 'trim|xss_clean|valid_email');

        $user_data = $this->user2->get_user_field($user_id, ['username', 'email'])->row_array();

        if (strlen($this->input->post('new_pass')) !== 0) {
            $val->set_rules('new_pass', lang('amt_password'), 'trim|min_length[' . $this->config->item('DX_login_min_length') . ']|max_length[' . $this->config->item('DX_login_max_length') . ']|required|xss_clean');
            $val->set_rules('new_pass_conf', lang('amt_new_pass_confirm'), 'matches[new_pass]|required');
        }

        if ($user_data['email'] != $this->input->post('email')) {
            if ($this->user2->check_email($this->input->post('email'))->num_rows() > 0) {
                showMessage(lang('amt_email_exists'), false, 'r');
                exit;
            }
        }

        if ($val->run()) {
            $data = [
                     'username'   => $this->input->post('username'),
                     'email'      => $this->input->post('email'),
                     'role_id'    => $this->input->post('role_id'),
                     'phone'      => $this->input->post('phone'),
                     'banned'     => $this->input->post('banned'),
                     'ban_reason' => $this->input->post('ban_reason'),
                    ];

            //change password
            if ($this->input->post('new_pass')) {
                $new_pass = crypt($this->dx_auth->_encode($this->input->post('new_pass')));
                $data['password'] = $new_pass;
            }

            ($hook = get_hook('users_user_update')) ? eval($hook) : NULL;

            $this->db->where('id', $user_id);
            $this->db->update('users', $data);

            $replaceData = [
                            'user_name' => $this->input->post('username'),
                            'password'  => $this->input->post('new_pass'),
                           ];

            if ($replaceData['password']) {
                \cmsemail\email::getInstance()->sendEmail($this->input->post('email'), 'change_password', $replaceData);
            }

            $this->lib_admin->log(
                lang('amt_updated_user') .
                ' <a href="' . site_url('/admin/components/cp/user_manager/edit_user/' . $user_id) . '">' . $data['username'] . '</a>'
            );

            showMessage(lang('Changes saved', 'user_manager'));

            $action = $this->input->post('action');

            if ($action == 'close') {
                pjax('/admin/components/cp/user_manager/edit_user/' . $user_id);
            } else {
                pjax('/admin/components/init_window/user_manager/index/'. $userPagination);
            }
        } else {

            showMessage(validation_errors(), '', 'r');
        }
    }

    /*     * ***********************************
     * Groups                           *
     * ********************************** */

    public function groups_index() {
        $query = $this->db->get('roles');
        $this->template->assign('roles', $query->result_array());
        $this->display_tpl('groups');
    }

    public function _create() {

        if (!$this->ajaxRequest) {
            $this->display_tpl('create_group');
        }
        //cp_check_perm('roles_create');

        if ($this->input->post()) {

            $this->form_validation->set_rules('name', lang('amt_identif'), 'required|trim|max_length[150]|min_length[2]|alpha_dash');
            $this->form_validation->set_rules('alt_name', lang('amt_tname'), 'required|trim|max_length[150]|min_length[2]');
            $this->form_validation->set_rules('desc', lang('amt_description'), 'trim|max_length[300]|min_length[2]');

            if ($this->form_validation->run($this) == FALSE) {
                showMessage(validation_errors(), false, 'r');
            } else {
                $data = [
                         'name'     => $this->input->post('name'),
                         'alt_name' => $this->input->post('alt_name'),
                         'desc'     => $this->lib_admin->db_post('desc'),
                        ];

                ($hook = get_hook('users_create_role')) ? eval($hook) : NULL;

                $this->db->insert('roles', $data);

                $this->lib_admin->log(lang('amt_created_group') . $data['name']);
                showMessage(lang('amt_group_created'));

                $action = $this->input->post('action');

                $user_info = $this->db->get_where('roles', ['name' => $data['name']]);
                $row = $user_info->row();

                if ($action == 'close') {
                    pjax('/admin/components/cp/user_manager/edit/' . $row->id);
                } else {
                    pjax('/admin/components/init_window/user_manager#group');
                }
            }
        }
    }

    public function deleteAll() {
        if (!$this->input->post('ids')) {
            showMessage(lang('a_del_user_notif'), '', 'r');
            exit;
        } else {
            $this->load->model('dx_auth/users', 'users');
        }

        $ids = $this->input->post('ids');
        foreach ($ids as $id) {
            //cp_check_perm('user_delete');
            ($hook = get_hook('users_delete')) ? eval($hook) : NULL;
            $this->users->delete_user($id);
            $this->lib_admin->log(lang('amt_deleted_user') . $id);
        }
    }

    public function update_role_perms() {
        $this->load->model('dx_auth/permissions', 'permissions');
        $permission_data = [];

        $all_perms = $this->get_permissions_table();

        foreach ($all_perms as $k => $v) {
            if ($this->input->post($k) == 1) {
                $permission_data[$k] = 1;
            }
        }

        if (count($permission_data) > 0) {
            $this->permissions->set_permission_data($this->input->post('role_id'), $permission_data);
        } else {
            $this->db->where('role_id', $this->input->post('role_id'));
            $this->db->delete('permissions');
        }

        showMessage(lang('Changes saved', 'user_manager'));
    }

    /**
     * @param int $id
     */
    public function show_edit_prems_tpl($id) {

        $this->load->model('dx_auth/permissions', 'permissions');
        $permissions = $this->permissions->get_permission_data($id);

        $all_perms = $this->get_permissions_table();

        // Explode all perms to groups by prefix
        $groups = [];
        foreach ($all_perms as $k => $v) {
            $tmp = explode('_', $k);
            $groups[$tmp[0]][$k] = $v;
        }

        foreach ($groups as $key => $row) {
            $count[$key] = count($row);
        }

        array_multisort($count, SORT_ASC, $groups);
        $this->db->where('locale', BaseAdminController::getCurrentLocale());
        $this->db->join('shop_rbac_roles_i18n', 'shop_rbac_roles_i18n.id = shop_rbac_roles.id');
        $role = $this->db->get('shop_rbac_roles')->result_array();

        $this->template->add_array(
            [
             'selected_role' => $id,
             'roles'         => $role,
             'all_perms'     => $all_perms,
             'permissions'   => $permissions,
             'groups'        => $groups,
             'group_names'   => $this->get_group_names(),
            ]
        );
    }

    public function get_permissions_table() {
        return get_permissions_array();
    }

    public function get_group_names() {
        return get_perms_groups();
    }

    //////////////////////////////////////////
    // Template functions

    private function display_tpl($file) {
        $file = realpath(__DIR__) . '/templates/' . $file;
        $this->template->show('file:' . $file);
    }

    private function fetch_tpl($file) {
        $file = realpath(__DIR__) . '/templates/' . $file;
        return $this->template->show('file:' . $file);
    }

    /**
     * Set user role
     * @return bool
     */
    public function setRoleId() {
        $userId = $this->input->post('userId');
        $roleId = $this->input->post('roleId');
        $userId = is_array($userId) ? $userId : [$userId];

        $this->db->where_in('id', $userId)->set('role_id', $roleId)->update('users');

        if ($this->input->is_ajax_request()) {
            echo json_encode(['success' => TRUE, 'message' => lang('User role changed.', 'admin')]);
        } else {
            return TRUE;
        }
    }

}

/* End of file admin.php */