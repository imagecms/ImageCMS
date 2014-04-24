<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Image CMS
 *
 * Group Mailer Admin
 */
class Admin extends BaseAdminController {

    public function __construct() {
        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('group_mailer');

        $this->load->library('DX_Auth');
        //cp_check_perm('module_admin'); 
    }

    public function index() {
        // Get all user groups
        $locale = chose_language();
        $roles = $this->db->where('locale', $locale)->join('shop_rbac_roles_i18n', 'shop_rbac_roles.id=shop_rbac_roles_i18n.id')->get('shop_rbac_roles')->result_array();
        $this->template->assign('roles', $roles);

        // Get admin email
        $this->db->select('email');
        $this->db->where('id', $this->dx_auth->get_user_id());
        $query = $this->db->get('users', 1)->row_array();
        $this->template->assign('admin_mail', $query['email']);

        // Get site name
        $this->template->assign('site_settings', $this->cms_base->get_settings());


        // Display email form
        $this->display_tpl('form');
    }

    public function send_email() {
        // Load form validation class
        $this->load->library('form_validation');

        $this->form_validation->set_rules('subject', lang("Theme", 'group_mailer'), 'required|trim');
        $this->form_validation->set_rules('name', lang("Your name", 'group_mailer'), 'required|trim');
        $this->form_validation->set_rules('email', lang("Your e-mail", 'group_mailer'), 'required|trim|valid_email');
        $this->form_validation->set_rules('message', lang("Message", 'group_mailer'), 'required|trim');

        if ($this->form_validation->run($this) == FALSE) {
            showMessage(validation_errors(), false, 'r');
        } else {
            $this->load->helper('typography');
            $this->load->library('email');

            // Init email config
            $config['wordwrap'] = TRUE;
            $config['charset'] = 'UTF-8';
            $config['mailtype'] = $_POST['mailtype'];
            $this->email->initialize($config);

            if (count($_POST['roles']) > 0) {
                foreach ($_POST['roles'] as $k => $v) {
                    $this->db->or_where('role_id', $v);
                }
            }

            // Get users array
            $users = $this->db->get('users');

            if ($users->num_rows() > 0) {
                $message = $_POST['message'];

                if ($_POST['mailtype'] == 'html') {
                    $message = "<html><body>" . nl2br_except_pre($message) . "</body></html>";
                }
                $counter = array('true' => 0, 'all' => 0);
                foreach ($users->result_array() as $user) {
                    // Replace {username}
                    $tmp_msg = str_replace('%username%', $user['username'], $message);

                    $this->email->from($_POST['email'], $_POST['name']);
                    $this->email->to($user['email']);
                    $this->email->reply_to($_POST['email'], $_POST['name']);
                    $this->email->subject($_POST['subject']);
                    $this->email->message($tmp_msg);
                    $counter['all'] ++;
                    if ($this->email->send()) {
                        $counter['true'] ++;
                    }
                }

                $this->load->library('lib_admin');
                $this->lib_admin->log(lang("Sent", 'group_mailer') . ' (' . $counter['true'] . '/' . $counter['all'] . ') ' . lang("users e-mail with a subject", 'group_mailer') . ' - ' . $_POST['subject']);
                $class = 'b';
                if ($counter['true'] == $counter['all']) {
                    $class = 'g';
                } else if ($counter['true'] == 0) {
                    $class = 'r';
                }
                if ($class !== 'r') {
                    showMessage(lang("Message has been sent.", 'group_mailer') . ' ' . lang("Number of e-mails sent", 'group_mailer') . ' ' . $counter['all'] . ' ' . lang('pcs.', 'group_mailer'), false, $class);
                } else {
                    showMessage(lang("None of the messages", 'group_mailer') . $counter['all'] . lang("Number not", 'group_mailer'), false, $class);
                }

                updateDiv('page', site_url('admin/components/cp/group_mailer/index'));
            }
        }
    }

    /**
     * Display template file
     */
    private function display_tpl($file = '') {
        $file = realpath(dirname(__FILE__)) . '/templates/admin/' . $file;
        $this->template->show('file:' . $file);
    }

    /**
     * Fetch template file
     */
    private function fetch_tpl($file = '') {
        $file = realpath(dirname(__FILE__)) . '/templates/admin/' . $file . '.tpl';
        return $this->template->fetch('file:' . $file);
    }

}

/* End of file admin.php */
