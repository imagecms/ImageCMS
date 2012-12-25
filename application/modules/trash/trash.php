<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Image CMS
 *
 * Класс редиректа удаленных товаров
 */
class Trash extends MY_Controller {

    public $settings = array();

    public function __construct() {
        parent::__construct();

        $this->load->module('core');
    }

    public function index() {
        
    }

    public function autoload() {
        $row = $this->db->get_where('trash', array('trash_url' => $this->uri->uri_string()))->row();
        if ($row != null) {
            ($row->trash_redirect_type != '404') OR $this->core->error_404();
            redirect($row->trash_redirect, 'location', 301);
        }
    }

    public function addProductWhenDelete(SProducts $model) {
        $array = array(
            'trash_id' => $model->category_id,
            'trash_url' => 'shop/product/' . $model->url,
            'trash_redirect_type' => 'category',
            'trash_redirect' => shop_url('category/' . $model->getMainCategory()->getFullPath())
        );
        
        $this->db->insert('trash', $array);
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
        $sql = "
CREATE  TABLE IF NOT EXISTS `trash` (
  `id` INT NULL AUTO_INCREMENT ,
  `trash_id` VARCHAR(200) NULL ,
  `trash_url` VARCHAR(200) NULL ,
  `trash_redirect_type` VARCHAR(200) NULL ,
  `trash_redirect` VARCHAR(200) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = MyISAM;
";

        $this->db->query($sql);

        // Включаем доступ к модулю по URL
        $this->db->limit(1);
        $this->db->where('name', 'trash');
        $this->db->update('components', array('enabled' => 1, 'autoload' => 1));
    }

    public function _deinstall() {
        if ($this->dx_auth->is_admin() == FALSE)
            exit;
        //Delete Table MAIL
        $sql = "DROP TABLE `trash`;";

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
