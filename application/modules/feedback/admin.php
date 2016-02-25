<?php

use CMSFactory\assetManager;

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Image CMS
 *
 * Feedback Module
 */
class Admin extends BaseAdminController
{

    /**
     * Admin constructor.
     */
    public function __construct() {
        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('feedback');

        // Only admin access
        $this->load->library('DX_Auth');
    }

    /**
     * Display settings form
     */
    public function index() {
        assetManager::create()
            ->setData('settings', $this->settings())
            ->renderAdmin('settings');
    }

    /**
     * @param string $action
     * @return mixed
     */
    public function settings($action = 'get') {
        switch ($action) {
            case 'get':
                $this->db->limit(1);
                $this->db->where('name', 'feedback');
                $query = $this->db->get('components');

                if ($query->num_rows() == 1) {
                    $query = $query->row_array();
                    return unserialize($query['settings']);
                }
                break;

            case 'update':
                if (count($this->input->post()) > 0) {
                    $this->load->library('form_validation');

                    $this->form_validation->set_rules('email', lang('E-Mail', 'feedback'), 'trim|valid_email|required|xss_clean');
                    $this->form_validation->set_rules('message_max_len', lang('Maximum message length', 'feedback'), 'trim|integer|required|xss_clean');

                    if ($this->form_validation->run($this) == FALSE) {
                        showMessage(validation_errors(), false, 'r');
                    } else {
                        $data = [
                            'email' => $this->input->post('email'),
                            'message_max_len' => (int) $this->input->post('message_max_len'),
                        ];
                        $this->db->where('name', 'feedback');
                        $this->db->update('components', ['settings' => serialize($data)]);

                        $this->lib_admin->log(lang('Feedbacks settings was edited', 'feedback'));
                        showMessage(lang('Settings have been saved', 'feedback'));
                    }
                }
                break;
        }
    }

}

/* End of file admin.php */