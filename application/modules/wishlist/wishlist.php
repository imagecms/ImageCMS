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
//        $this->load->model('wishlist_model');
//        $this->settings = $this->wishlist_model->getSettings();
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
        /** We recomend to use http://ellislab.com/codeigniter/user-guide/database/forge.html */
        $query = '';
        /**
          $this->load->dbforge();

          $fields = array(
          'id' => array('type' => 'INT', 'constraint' => 11, 'auto_increment' => TRUE,),
          'name' => array('type' => 'VARCHAR', 'constraint' => 50,),
          'value' => array('type' => 'VARCHAR', 'constraint' => 100,)
          );

          $this->dbforge->add_key('id', TRUE);
          $this->dbforge->add_field($fields);
          $this->dbforge->create_table('mod_empty', TRUE);
         */
        /**
          $this->db->where('name', 'module_frame')
          ->update('components', array('autoload' => '1', 'enabled' => '1'));
         */
    }

    public function _deinstall() {
        /**
          $this->load->dbforge();
          $this->dbforge->drop_table('mod_empty');
         *
         */
    }

}

/* End of file wishlist.php */
