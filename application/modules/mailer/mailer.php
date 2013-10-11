<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Image CMS
 *
 * Класс отображения страниц по ID.
 */
class Mailer extends MY_Controller {

    public $settings = array();

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

        $this->form_validation->set_rules('user_email', lang("Your e-mail", 'mailer'), 'required|trim|valid_email');

        if ($this->form_validation->run($this) == FALSE) {

            echo $errors = validation_errors();

            redirect('/mailer/error/');
        } else {


            $query = $this->db->get_where('mail', array('email' => $this->input->post('user_email')));
            $row = $query->row();

            if (!empty($row) && $this->input->post('add_user_mail') != 1) {
                redirect('/mailer/already/');
                exit;
            } elseif (empty($row) && $this->input->post('add_user_mail') == 1) {
                redirect('/mailer/no/');
                exit;
            }


            if ($this->input->post('add_user_mail') == 2) {

                $date = date('U');
                $email = $this->input->post('user_email');
                
                   
                $data = array(
                    'email' => $email,
                    'date' => $date
                );
                    
                $this->db->insert('mail', $data);
                   
                $this->template->add_array(array(
                    'email' => $query,
                ));
                   
                redirect('/mailer/success/');
                    
            } else {

                $this->db->delete('mail', array('email' => $this->input->post('user_email')));
                redirect('/mailer/cancel/');
            }
        }
    }

    public function getForm() {
        return $this->fetch_tpl('form');
    }

    public function success() {
        $this->show_tpl('success');
    }

    public function already() {
        $this->show_tpl('already');
    }

    public function cancel() {
        $this->show_tpl('cancel');
    }

    public function no() {
        $this->show_tpl('no');
    }

    public function error() {
        $this->show_tpl('error');
    }

    /**
     * Загрузка настроек модуля 
     */
    private function load_settings() {
        $this->db->limit(1);
        $this->db->where('name', 'page_id');
        $query = $this->db->get('components');

        if ($query->num_rows() == 1) {
            $settings = $query->row_array();
            $this->settings = unserialize($settings['settings']);
        }
    }

    /**
     * Функция будет вызвана при установке модуля из панели управления
     */
    public function _install() {
        if ($this->dx_auth->is_admin() == FALSE)
            exit;
        //Create Table MAIL
        $sql = "CREATE TABLE IF NOT EXISTS `mail` (
                    `id` int(11) NOT NULL AUTO_INCREMENT,
                    `email` varchar(255) DEFAULT NULL,
                    `date` int(15) DEFAULT NULL,
                    PRIMARY KEY (`id`)
                    ) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";

        $this->db->query($sql);

        // Включаем доступ к модулю по URL
        $this->db->limit(1);
        $this->db->where('name', 'mailer');
        $this->db->update('components', array('enabled' => 1));
    }

    public function _deinstall() {
        if ($this->dx_auth->is_admin() == FALSE)
            exit;
        //Delete Table MAIL
        $sql = "DROP TABLE `mail`;";

        $this->db->query($sql);

        //$this->load->model('install')->deinstall();
    }

    /**
     * Display template file
     */
    private function display_tpl($file = '') {
        $file = realpath(dirname(__FILE__)) . '/templates/public/' . $file;
        $this->template->show('file:' . $file);
    }

    /**
     * Display template file
     */
    private function show_tpl($file = '') {

        $file = realpath(dirname(__FILE__)) . '/templates/public/' . $file;
        $this->template->show('file:' . $file);
    }

    /**
     * Fetch template file
     */
    private function fetch_tpl($file = '') {
        $file = realpath(dirname(__FILE__)) . '/templates/public/' . $file . '.tpl';
        return $this->template->fetch('file:' . $file);
    }

}

/* End of file mailer.php */
