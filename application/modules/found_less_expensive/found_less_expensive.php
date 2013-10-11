<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @author Igor R.
 * @copyright ImageCMS (c) 2013, Igor R. <dev@imagecms.net>
 * 
 * In order to render button and link insert into product template
 * {$CI->load->module('found_less_expensive')->showButtonWithForm()}
 * 
 * Нашли дешевле
 */
class Found_less_expensive extends MY_Controller {

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
        \CMSFactory\assetManager::create()
                ->registerStyle('style')
                ->registerScript('scripts')
                ->render('buttonWithForm', true);
    }

    /**
     * Save data from form
     * @return string
     */
    public function save_message() {
        $data = $this->input->post();
        $data['date'] = time();
        $data['status'] = 0;
        unset($data['cms_token']);
        if ($this->db->insert('mod_found_less_expensive', $data)) {
            $this->prepareEmailData($data);
            return 'success';
        }
    }

    /**
     * Get email settings
     * @param type $messageData
     */
    public function prepareEmailData($messageData) {
        $data = $this->found_less_expensive_model->getModuleSettings();
        $this->sendEmail($data['emailTo'], $data['emailFrom'], $data['emailSubject'], $data['emailTemplate'], $messageData);
    }

    /**
     * Send email
     * @param type $email
     */
    public function sendEmail($fromEmail, $toEmail, $subject, $message, $messageData) {

        /*
         * use module cms email
         * you need create new letter 'expensive' in database "admin/components/cp/cmsemail/index" with variables and other information 
         */
        /*
          // variables
          //
          $data = array(
          //variables
          );
          // comand for send letter use module cms email
          \cmsemail\email::getInstance()->sendEmail($toEmail, 'expensive', $data);
         */

        // Init email config
        $config['wordwrap'] = TRUE;
        $config['charset'] = 'UTF-8';
        $config['mailtype'] = 'html';

        $this->email->initialize($config);

        $message = "<html><body>" . $message . "</body></html>";

        // Replace %linkPage%, %linkProduct%
        $message = str_replace('%linkPage%', $messageData['productUrl'], $message);
        $message = str_replace('%linkProduct%', $messageData['link'], $message);

        $this->email->from($fromEmail);
        $this->email->to($toEmail);
        $this->email->subject($subject);
        $this->email->message($message);

        $this->email->send();
    }

    /**
     * Install module
     */
    public function _install() {
        $this->load->dbforge();
        ($this->dx_auth->is_admin()) OR exit;
        $fields = array(
            'id' => array(
                'type' => 'INT',
                'auto_increment' => TRUE
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => '70',
                'null' => TRUE,
            ),
            'email' => array(
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => TRUE,
            ),
            'phone' => array(
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => TRUE,
            ),
            'question' => array(
                'type' => 'VARCHAR',
                'constraint' => '250',
                'null' => TRUE,
            ),
            'link' => array(
                'type' => 'VARCHAR',
                'constraint' => '150',
                'null' => TRUE,
            ),
            'productUrl' => array(
                'type' => 'VARCHAR',
                'constraint' => '250',
                'null' => TRUE,
            ),
            'date' => array(
                'type' => 'INT',
                'null' => TRUE,
            ),
            'status' => array(
                'type' => 'VARCHAR',
                'constraint' => '150',
                'null' => TRUE,
            ),
        );

        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('mod_found_less_expensive');

        $this->db->where('name', 'found_less_expensive');
        $this->db->update('components', array(
            'enabled' => 1,
            'autoload' => 1));
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
