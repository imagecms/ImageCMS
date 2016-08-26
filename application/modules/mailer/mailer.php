<?php

use CMSFactory\assetManager;

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Image CMS
 *
 * Класс отображения страниц по ID.
 */
class Mailer extends MY_Controller
{

    public $settings = [];

    public function __construct() {
        parent::__construct();

        $this->load->module('core');
        $lang = new MY_Lang();
        $lang->load('mailer');
    }

    /**
     * Подписка пользователей.
     */
    public function index() {
        $this->load->library('form_validation');

        if ($this->input->post()) {

            $this->form_validation->set_rules('user_email', lang('Your e-mail', 'mailer'), 'required|trim|valid_email');

            if ($this->form_validation->run($this) == FALSE) {

                echo $errors = validation_errors();
                redirect('/mailer/error/');
            } else {

                $email = $this->input->post('user_email');

                /** @var CI_DB_result $query */
                $query = $this->db->get_where('mail', ['email' => $email]);
                $row = $query->num_rows() > 0 ? $query->row() : false;

                if ($row && $this->input->post('add_user_mail') != 1) {
                    redirect('/mailer/already/');

                } elseif (!$row && $this->input->post('add_user_mail') == 1) {
                    redirect('/mailer/no/');

                }

                if ($this->input->post('add_user_mail') == 2) {

                    $date = date('U');

                    if ($this->dx_auth->is_email_available($email)) {

                        $this->registerUserByEmail($email);
                    }

                    $data = [
                             'email' => $email,
                             'date'  => $date,
                            ];

                    $this->db->insert('mail', $data);

                    redirect('/mailer/success/');
                } else {
                    $this->db->delete('mail', ['email' => $email]);
                    redirect('/mailer/cancel/');
                }
            }
        }
    }

    public function ajaxSubmit() {

        $this->load->library('form_validation');
        $this->form_validation->set_rules('user_email', lang('Your e-mail', 'mailer'), 'required|trim|valid_email');

        if ($this->form_validation->run($this) == FALSE) {
            assetManager::create()
                ->setData(
                    [
                     'mailer_errors' => validation_errors(),
                    ]
                )
                ->render('error', true);
        } else {

            $email = $this->input->post('user_email');

            /** @var CI_DB_result $query */
            $query = $this->db->get_where('mail', ['email' => $email]);
            $row = $query->num_rows() > 0 ? $query->row() : false;

            if ($row && $this->input->post('add_user_mail') != 1) {

                assetManager::create()->render('already', true);
                exit;
            } elseif (!$row && $this->input->post('add_user_mail') == 1) {

                assetManager::create()->render('no', true);
                exit;
            }

            if ($this->input->post('add_user_mail') == 2) {

                if ($this->dx_auth->is_email_available($email)) {

                    $this->registerUserByEmail($email);
                }

                $date = date('U');
                $data = [
                         'email' => $email,
                         'date'  => $date,
                        ];

                $this->db->insert('mail', $data);
                assetManager::create()
                    ->setData(
                        ['email' => $query]
                    )
                    ->render('success', true);

            } else {
                $this->db->delete('mail', ['email' => $email]);
                assetManager::create()->render('cancel', true);
            }
        }
    }

    /**
     * Register subscribed user by email
     * @param string $email - user email
     * @return false|null
     */
    private function registerUserByEmail($email) {
        if (!$email) {
            return FALSE;
        }
        $username = array_shift(explode('@', $email));
        $password = random_string('alnum', 8);
        $key = random_string('alnum', 5);
        $this->dx_auth->register($username, $password, $email, '', $key);
    }

    /**
     * @return void
     */
    public function getForm() {
        assetManager::create()
            ->render('form', true);
    }

    /**
     * @return void
     */
    public function success() {
        assetManager::create()
            ->render('success', true);
    }

    /**
     * @return void
     */
    public function already() {
        assetManager::create()
            ->render('already', true);
    }

    /**
     * @return void
     */
    public function cancel() {
        assetManager::create()
            ->render('cancel', true);
    }

    /**
     *@return void
     */
    public function no() {
        assetManager::create()
            ->render('no', true);
    }

    /**
     * @return void
     */
    public function error() {
        assetManager::create()
            ->render('error', true);
    }

    /**
     *  Create modules table in db
     *
     * @return bool
     */
    public function _install() {

        $this->load->dbforge();

        $fields = [
                   'id'    => [
                               'type'           => 'INT',
                               'constraint'     => 11,
                               'auto_increment' => TRUE,
                              ],
                   'email' => [
                               'type'       => 'VARCHAR',
                               'constraint' => 255,
                               'default'    => NULL,
                              ],
                   'date'  => [
                               'type'       => 'int',
                               'constraint' => 15,
                               'default'    => NULL,
                              ],
                  ];

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field($fields);
        $this->dbforge->create_table('mail', TRUE);

        $this->db->where('name', 'mailer')
            ->update('components', ['autoload' => '1', 'enabled' => '1']);
    }

    public function _deinstall() {

        $this->load->dbforge();
        $this->dbforge->drop_table('mailer');
    }

}

/* End of file mailer.php */