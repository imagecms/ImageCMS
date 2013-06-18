<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 * Module Wishlist
 * @property wishlist_model $wishlist_model
 */
class Wishlist extends MY_Controller {

    public $settings = array();

    public function __construct() {
        parent::__construct();
        $this->load->model('wishlist_model');
        $this->settings = $this->wishlist_model->getSettings();
    }

    public function index() {

    }

    /**
     * Create WL
     */
    public function createWL() {

    }

    /**
     * Edit WL
     */
    public function editWL() {

    }

    /**
     * delete full WL
     */
    public function deleteWL() {

    }

    public function addItem($id, $varId) {
        if (true)
            echo json_encode(array(
                'answer' => 'sucesfull',
            ));
        else
            echo json_encode(array(
                'answer' => 'error',
            ));
    }

    public function deleteItem($id, $varId) {

    }

    public function editItem($id, $varId) {

    }

    public function moveItem($id, $varId) {

    }

    function editWLName($id, $newName) {

    }

    public function getWLbyHash($hash) {

    }

    public function renderUserWL($userId, $type = '') {

    }

    public function renderWLByHash($hash) {

    }

    public function renderWLButton($varId) {
        \CMSFactory\assetManager::create()
                ->registerScript('wishlist')
                ->setData('data', $data)
                ->setData('value', 'Добавить в Список Желания')
                ->setData('class', 'btn')
                ->render('button', true);
    }

    /**
     *
     * @param type $id array()
     */
    public function deleteItemByIds($id) {
        if (!$id)
            return;
    }

    public function autoload() {

    }

    public static function adminAutoload() {
        parent::adminAutoload();
    }

    public function _install() {

        $this->load->dbforge();
        ($this->dx_auth->is_admin()) OR exit;

        $fields = array(
            'id' => array(
                'type' => 'INT',
                'auto_increment' => TRUE
            ),
            'title' => array(
                'type' => 'VARCHAR',
                'constraint' => '254',
                'null' => FALSE
            ),
            'access' => array(
                'type' => 'ENUM',
                'constraint' => "'public','private','shared'",
                'default' => "shared"
            ),
            'description' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'user_id' => array(
                'type' => 'INT',
                'null' => FALSE
            ),
            'user_image' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'user_birthday' => array(
                'type' => 'TIMESTAMP',
                'null' => TRUE
            ),
            'hash' => array(
                'type' => 'VARCHAR',
                'constraint' => '16',
                'null' => FALSE
            )
        );

        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('mod_wish_list');


        $fields = array(
            'id' => array(
                'type' => 'INT',
                'auto_increment' => TRUE
            ),
            'wish_list_id' => array(
                'type' => 'INT',
                'null' => FALSE
            ),
            'variant_id' => array(
                'type' => 'INT',
                'null' => FALSE
            ),
            'comment' => array(
                'type' => 'TEXT',
                'null' => TRUE
            )
        );
        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('mod_wish_list_products');


    }

    public function _deinstall() {

        $this->load->dbforge();
        $this->dbforge->drop_table('mod_wish_list_products');
        $this->dbforge->drop_table('mod_wish_list');

        $this->db->where('module','wishlist')
                ->delete('components');
    }

}

/* End of file wishlist.php */
