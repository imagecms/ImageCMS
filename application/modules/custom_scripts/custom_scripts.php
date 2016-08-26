<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 * Module Frame
 */
class Custom_scripts extends MY_Controller
{

    const BODY_POSITION = 1;
    const HEAD_POSITION = -1;

    public function __construct() {
        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('custom_scripts');
    }

    public function index() {

    }

    public function autoload() {

        $model = $this->load->model('Custom_scripts_model');

        $headerScripts = $model->getScript(self::HEAD_POSITION);
        $bodyScripts = $model->getScript(self::BODY_POSITION);

        $headerScripts && CI_Controller::get_instance()->template->registerString($headerScripts, 'before');
        $bodyScripts && CI_Controller::get_instance()->template->registerString($bodyScripts, 'after');
    }

    public function _install() {

        $this->load->dbforge();
        $fields = [
                   'id'       => [
                                  'type'           => 'INT',
                                  'constraint'     => 11,
                                  'auto_increment' => TRUE,
                                 ],
                   'name'     => ['type' => 'TEXT'],
                   'value'    => ['type' => 'TEXT'],
                   'position' => [
                                  'type'       => 'INT',
                                  'constraint' => 5,
                                  'unsigned'   => false,
                                  'null'       => false,
                                 ],
                  ];

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field($fields);
        $this->dbforge->create_table('custom_scripts', TRUE);

        $this->db->where('name', 'custom_scripts')
            ->update('components', ['autoload' => '1']);

    }

    public function _deinstall() {
        $this->load->dbforge();
        $this->dbforge->drop_table('custom_scripts');
    }

}

/* End of file sample_module.php */