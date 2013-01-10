<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 *
 * Класс редиректа удаленных товаров
 */
class Trash extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->module('core');
    }

    public function index() {
        $this->core->error_404();
    }

    public function autoload() {
//        \behaviorFactory\BehaviorFactory::get();

        $row = $this->db->get_where('trash', array('trash_url' => $this->uri->uri_string()))->row();
        if ($row != null) {
            ($row->trash_redirect_type != '404') OR $this->core->error_404();
            redirect($row->trash_redirect, 'location', $row->trash_type);
        }
    }

    public function addProductWhenDelete(SProducts $model) {
        $array = array(
            'trash_id' => $model->category_id,
            'trash_url' => 'shop/product/' . $model->url,
            'trash_redirect_type' => 'category',
            'trash_type' => '301',
            'trash_redirect' => shop_url('category/' . $model->getMainCategory()->getFullPath())
        );

        $this->db->insert('trash', $array);
    }

    public function _install() {
        $this->load->dbforge();
        ($this->dx_auth->is_admin()) OR exit;
        $fields = array(
            'id' => array(
                'type' => 'INT',
                'auto_increment' => TRUE
            ),
            'trash_id' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE,
            ),
            'trash_url' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE,
            ),
            'trash_redirect_type' => array(
                'type' => 'VARCHAR',
                'constraint' => '20',
                'null' => TRUE,
            ),
            'trash_redirect' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE,
            ),
            'trash_type' => array(
                'type' => 'VARCHAR',
                'constraint' => '3',
                'null' => TRUE,
            ),
        );

        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('trash');

        $this->db->where('name', 'trash');
        $this->db->update('components', array('enabled' => 0, 'autoload' => 1));
    }

    public function _deinstall() {
        $this->load->dbforge();
        ($this->dx_auth->is_admin()) OR exit;
        $this->dbforge->drop_table('trash');
    }

}

/* End of file trash.php */