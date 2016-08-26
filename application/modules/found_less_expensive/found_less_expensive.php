<?php

use cmsemail\email;
use CMSFactory\assetManager;

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * @property Found_less_expensive_model found_less_expensive_model
 * @author Igor R.
 * @copyright ImageCMS (c) 2013, Igor R. <dev@imagecms.net>
 *
 * In order to render button and link insert into product template
 * {$CI->load->module('found_less_expensive')->showButtonWithForm()}
 *
 * Нашли дешевле
 */
class Found_less_expensive extends MY_Controller
{

    public function __construct() {

        parent::__construct();
        $this->load->model('found_less_expensive_model');
        $this->load->library('email');
        $lang = new MY_Lang();
        $lang->load('found_less_expensive');
    }

    public static function adminAutoload() {
        parent::adminAutoload();
    }

    /**
     * Display button and form
     */
    public function showButtonWithForm() {
        assetManager::create()
                ->registerStyle('style')
                ->registerScript('scripts')
                ->render('buttonWithForm', true);
    }

    /**
     * @return array|string
     */
    public function save_message() {

        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', lang('Name', 'admin'), 'required');
        $this->form_validation->set_rules('phone', lang('Phone', 'admin'), 'required|numeric');
        $this->form_validation->set_rules('email', lang('Email', 'admin'), 'required|valid_email');
        $this->form_validation->set_rules('link', lang('link', 'admin'), 'required');

        if (!$this->form_validation->run()) {

            return json_encode(
                [
                 'message' => validation_errors(),
                 'errors'  => $this->form_validation->getErrorsArray(),
                ]
            );
        }

        $data = $this->input->post();
        $data['date'] = time();
        $data['status'] = 0;
        unset($data['cms_token']);
        if ($this->db->insert('mod_found_less_expensive', $data)) {
            $this->sendEmail($data);

            return json_encode(
                ['success' => 'success']
            );
        }
    }

    /**
     * Send email
     * @param array $messageData
     * @return bool
     */
    public function sendEmail(array $messageData) {

        $variables = [
                      'userName'    => $messageData['name'],
                      'userEmail'   => $messageData['email'],
                      'userPhone'   => $messageData['phone'],
                      'userLink'    => $messageData['link'],
                      'userMessage' => $messageData['question'],
                      'date'        => date('d-m-Y H:i:s', $messageData['date']),
                      'productUrl'  => $messageData['productUrl'],

                     ];
        return email::getInstance()->sendEmail($this->dx_auth->get_user_email(), 'Found_less_expensive', $variables);
    }

    /**
     * Install module
     */
    public function _install() {

        $email_patterns = $this->found_less_expensive_model->getEmailPatterns();
        $this->db->insert('mod_email_paterns', $email_patterns);

        $email_patterns_i18n = $this->found_less_expensive_model->getEmailPatternsI18n();
        $this->db->insert('mod_email_paterns_i18n', $email_patterns_i18n);

        $this->load->dbforge();
        ($this->dx_auth->is_admin()) OR exit;
        $fields = [
                   'id'         => [
                                    'type'           => 'INT',
                                    'auto_increment' => TRUE,
                                   ],
                   'name'       => [
                                    'type'       => 'VARCHAR',
                                    'constraint' => '70',
                                    'null'       => TRUE,
                                   ],
                   'email'      => [
                                    'type'       => 'VARCHAR',
                                    'constraint' => '50',
                                    'null'       => TRUE,
                                   ],
                   'phone'      => [
                                    'type'       => 'VARCHAR',
                                    'constraint' => '50',
                                    'null'       => TRUE,
                                   ],
                   'question'   => [
                                    'type'       => 'VARCHAR',
                                    'constraint' => '250',
                                    'null'       => TRUE,
                                   ],
                   'link'       => [
                                    'type'       => 'VARCHAR',
                                    'constraint' => '150',
                                    'null'       => TRUE,
                                   ],
                   'productUrl' => [
                                    'type'       => 'VARCHAR',
                                    'constraint' => '250',
                                    'null'       => TRUE,
                                   ],
                   'date'       => [
                                    'type' => 'INT',
                                    'null' => TRUE,
                                   ],
                   'status'     => [
                                    'type'       => 'VARCHAR',
                                    'constraint' => '150',
                                    'null'       => TRUE,
                                   ],
                  ];

        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('mod_found_less_expensive');

        $this->db->where('name', 'found_less_expensive');
        $this->db->update(
            'components',
            [
             'enabled'  => 1,
             'autoload' => 1,
            ]
        );
    }

    /**
     * Deinstall module
     */
    public function _deinstall() {
        $this->load->dbforge();
        ($this->dx_auth->is_admin()) OR exit;
        $this->dbforge->drop_table('mod_found_less_expensive');
    }

}