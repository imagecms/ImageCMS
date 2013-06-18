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


    private function checkPerm() {
        $permAllow = TRUE;
        if (!$this->dx_auth->is_logged_in())
            $permAllow = FALSE;

        return $permAllow;
    }

    public function index() {
        if (!$this->checkPerm())
            $this->core->error_404();
    }

    /**
     * Create WL
     */

    public function createWL($title, $access, $description, $user_id, $user_image, $user_birthday) {

        $this->db->set('title',$title);
        $this->db->set('access',$access);
        $this->db->set('description',$description);
        $this->db->set('user_id',$user_id);
        $this->db->set('user_image',$user_image);
        $this->db->set('user_birthday',$user_birthday);
        $this->db->insert('mod_wish_list');
        
        if (true)
            echo json_encode(array(
                'answer' => 'sucesfull',
            ));
        else
            echo json_encode(array(
                'answer' => 'error',
            ));
    }

    /**
     * Edit WL
     */
    public function editWL() {

        if (true)
            echo json_encode(array(
                'answer' => 'sucesfull',
            ));
        else
            echo json_encode(array(
                'answer' => 'error',
            ));
    }

    /**
     * delete full WL
     */
    public function deleteWL() {
        
    }

    public function addItem($varId, $listId, $listName) {
        if($varId)
        {
           return $this->wishlist_model->addItem($varId, $listId, $listName);
        }else{
            return false;
        }
        
//        if (true)
//            echo json_encode(array(
//                'answer' => 'sucesfull',
//            ));
//        else
//            echo json_encode(array(
//                'answer' => 'error',
//            ));
    }

   

    public function deleteItem($id, $varId) {
        if (true)
            echo json_encode(array(
                'answer' => 'sucesfull',
            ));
        else
            echo json_encode(array(
                'answer' => 'error',
            ));
    }

    public function editItem($id, $varId) {
        if (true)
            echo json_encode(array(
                'answer' => 'sucesfull',
            ));
        else
            echo json_encode(array(
                'answer' => 'error',
            ));
    }

    public function moveItem($id, $varId) {
        if (true)
            echo json_encode(array(
                'answer' => 'sucesfull',
            ));
        else
            echo json_encode(array(
                'answer' => 'error',
            ));
    }

    function editWLName($id, $newName) {
        if (true)
            echo json_encode(array(
                'answer' => 'sucesfull',
            ));
        else
            echo json_encode(array(
                'answer' => 'error',
            ));
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
                ->setData('varId', $varId)
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

        $this->db
                ->where('identif', 'wishlist')
                ->update('settings', array(
                    'settings' => '',
                    'enabled' => 1,
                    'autoload' => 1,
        ));
    }

    public function _deinstall() {
        $this->load->dbforge();
        ($this->dx_auth->is_admin()) OR exit;
        $this->dbforge->drop_table('mod_wish_list_products');
        $this->dbforge->drop_table('mod_wish_list');
    }

    public function renderPopup($varId) {
        $wish_lists = $this->wishlist_model->getWishLists();
        $data = array('wish_lists'=> $wish_lists);
        //return $this->display_tpl('wishPopup');
        $comments = \CMSFactory\assetManager::create()
                ->setData('value', 'Добавить в Список Желания')
                ->setData('class', 'btn')
                ->setData('varId', $varId)
                ->setData($data)
                ->fetchTemplate('wishPopup');
        return json_encode(array('popup' => $comments));
    }

}

/* End of file wishlist.php */
