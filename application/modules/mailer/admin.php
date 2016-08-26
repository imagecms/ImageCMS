<?php

use CMSFactory\assetManager;

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Image CMS
 *
 * Mailer Admin
 */
class Admin extends BaseAdminController
{

    public function __construct() {
        parent::__construct();

        $this->load->library('DX_Auth');
        $lang = new MY_Lang();
        $lang->load('mailer');
    }

    /**
     * @TODO: Переписать на ассет менеджер
     */
    public function index() {
        $roles = $this->db->get('shop_rbac_roles')->result_array();

        /** @var CI_DB_result $query */
        $query = $this->db->get('mail');

        $all_subscribers = $query->num_rows() > 0 ? $query->result_array() : [];

        assetManager::create()
            ->setData(
                [
                 'roles'         => $roles,
                 'admin_mail'    => $this->dx_auth->get_user_email(),
                 'all'           => $all_subscribers,
                 'site_settings' => $this->cms_base->get_settings(),
                ]
            );

        if (!$this->ajaxRequest) {
            assetManager::create()
                ->renderAdmin('form', true);
        }
    }

    public function send_email() {

        // Load form validation class
        $this->load->library('form_validation');

        $this->form_validation->set_rules('subject', lang('Theme', 'mailer'), 'required|trim');
        $this->form_validation->set_rules('name', lang('Your name', 'mailer'), 'required|trim');
        $this->form_validation->set_rules('email', lang('Your e-mail', 'mailer'), 'required|trim|valid_email');
        $this->form_validation->set_rules('message', lang('Message', 'mailer'), 'required|trim');

        if ($this->form_validation->run($this) == FALSE) {
            showMessage(validation_errors(), false, 'r');
        } else {
            $this->load->helper('typography');
            $this->load->library('email');

            // Init email config
            $config['wordwrap'] = TRUE;
            $config['charset'] = 'UTF-8';
            $config['mailtype'] = $this->input->post('mailtype');
            $this->email->initialize($config);

            // Get users array
            $users = $this->db->get('mail');

            if ($users->num_rows() > 0) {
                $message = $this->input->post('message');

                if ($this->input->post('mailtype') == 'html') {
                    $message = '<html><body>' . nl2br_except_pre($message) . '</body></html>';
                }
                $counter = [
                            'true' => 0,
                            'all'  => 0,
                           ];
                foreach ($users->result_array() as $user) {
                    // Replace {username}
                    $tmp_msg = str_replace('%username%', $user['username'], $message);

                    $this->email->from($this->input->post('email'), $this->input->post('name'));
                    $this->email->to($user['email']);
                    $this->email->reply_to($this->input->post('email'), $this->input->post('name'));
                    $this->email->subject($this->input->post('subject'));
                    $this->email->message($tmp_msg);
                    $counter['all'] ++;
                    if ($this->email->send()) {
                        $counter['true'] ++;
                    }
                }

                $this->load->library('lib_admin');
                $this->lib_admin->log(lang('Send', 'mailer') . '(' . $counter['true'] . '/' . $counter['all'] . ')' . lang('users e-mail with a subject', 'mailer') . ')' . $this->input->post('subject'));
                $class = '';
                if ($counter['true'] == $counter['all']) {
                    $class = '';
                } else if ($counter['true'] == 0) {
                    $class = 'r';
                }
                if ($class !== 'r') {
                    showMessage(lang('message has been sent', 'mailer') . ': ' . $counter['true'] . lang('Number of e-mails sent', 'mailer') . $counter['all'] . lang('pcs.', 'mailer') . $class);
                } else {
                    showMessage(lang('none of the messages', 'mailer') . $counter['all'] . lang('Number not', 'mailer'), $class);
                }
            }
        }
    }

    public function deleteUsers() {

        if ($this->input->post('ids')) {

            foreach ($this->input->post('ids') as $id) {
                $this->db->delete('mail', ['id' => $id]);
            }

            showMessage(lang('Subscribers removal', 'mailer'));
        } else {
            showMessage(lang('There is not ID', 'mailer'), '', 'r');
        }
    }

}

/* End of file admin.php */