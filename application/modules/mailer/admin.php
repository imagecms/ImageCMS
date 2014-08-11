<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Image CMS
 *
 * Mailer Admin
 */
class Admin extends BaseAdminController {

    public function __construct() {
        parent::__construct();

        $this->load->library('DX_Auth');
        $lang = new MY_Lang();
        $lang->load('mailer');
        //cp_check_perm('module_admin');
    }

    public function index() {
        // Get all user groups
        $roles = $this->db->get('shop_rbac_roles')->result_array();
        $this->template->assign('roles', $roles);

        // Get admin email
        $this->db->select('email');
        $this->db->where('id', $this->dx_auth->get_user_id());
        $query = $this->db->get('users', 1)->row_array();
        $this->template->assign('admin_mail', $query['email']);

        // Get site name
        $this->template->assign('site_settings', $this->cms_base->get_settings());


        $query = $this->db->get('mail');
        $row = $query->result_array();
        $this->template->assign('all', $row);


        if (!$this->ajaxRequest)
            $this->display_tpl('form');
    }

    public function send_email() {

        // Load form validation class
        $this->load->library('form_validation');

        $this->form_validation->set_rules('subject', lang("Theme", 'mailer'), 'required|trim');
        $this->form_validation->set_rules('name', lang("Your name", 'mailer'), 'required|trim');
        $this->form_validation->set_rules('email', lang("Your e-mail", 'mailer'), 'required|trim|valid_email');
        $this->form_validation->set_rules('message', lang("Message", 'mailer'), 'required|trim');

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

            // Get users array
            $users = $this->db->get('mail');

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
                $this->lib_admin->log(lang("Send", 'mailer') . '(' . $counter['true'] . '/' . $counter['all'] . ')' . lang("users e-mail with a subject", 'mailer') . ')' . $_POST['subject']);
                $class = '';
                if ($counter['true'] == $counter['all']) {
                    $class = '';
                } else if ($counter['true'] == 0) {
                    $class = 'r';
                }
                if ($class !== 'r') {
                    showMessage(lang("message has been sent", 'mailer') . ': ' . $counter['true'] . lang("Number of e-mails sent", 'mailer') . $counter['all'] . lang('pcs.', 'mailer') . $class);
                } else {
                    showMessage(lang("none of the messages", 'mailer') . $counter['all'] . lang("Number not", 'mailer'), $class);
                }
            }
        }
    }

    public function deleteUsers() {


        if (!empty($_POST['ids'])) {

            foreach ($_POST['ids'] as $id) {
                $this->db->delete('mail', array('id' => $id));
            }

            showMessage(lang("Subscribers removal", 'mailer'));
        } else {
            showMessage(lang('There is not ID', 'mailer'), '', 'r');
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