<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 * Module Frame
 */
class Exchangeunfu extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $e = new \exchangeunfu\exc();
        $e->index();
    }

    public function autoload() {

    }

    public function _install() {

        $this->load->dbforge();

        $fields = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE,
            ),
            'product_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => FALSE,
            ),
            'variant_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => FALSE,
            ),
            'region' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
            )
        );

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field($fields);
        $this->dbforge->create_table('mod_exchangeunfu', TRUE);

        $this->db->query('INSERT INTO `mod_exchangeunfu` (
`id` ,
`product_id` ,
`variant_id` ,
`region`
)
VALUES (
NULL ,  \'892\',  \'873\',  \'lviv\'
);');

        $this->db->where('name', 'exchangeunfu')
                ->update('components', array('autoload' => '1', 'enabled' => '1'));
    }

    public function _deinstall() {

        $this->load->dbforge();
        $this->dbforge->drop_table('mod_exchangeunfu');
    }

}

/* End of file sample_module.php */
