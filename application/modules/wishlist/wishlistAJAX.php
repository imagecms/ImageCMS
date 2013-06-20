<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 * Module Wishlist
 * @property wishlist_model $wishlist_model
 */
class WishlistAJAX extends Wishlist {

    public function __construct() {
        parent::__construct();
    }

    private function checkPerm() {
        $permAllow = TRUE;
        if (!$this->dx_auth->is_logged_in())
            $permAllow = FALSE;

        return $permAllow;
    }

    public function index() {
        $this->core->error_404();
    }

    /**
     *
     * @param type $title
     * @param type $access
     * @param type $description
     * @param type $user_id
     * @param type $user_image
     * @param type $user_birthday
     */
    public function createWL($title, $access, $description, $user_id, $user_image, $user_birthday) {

        $this->db->set('title', $title);
        $this->db->set('access', $access);
        $this->db->set('description', $description);
        $this->db->set('user_id', $user_id);
        $this->db->set('user_image', $user_image);
        $this->db->set('user_birthday', $user_birthday);
        $this->db->insert('mod_wish_list');

        if (true)
            echo json_encode(array(
                'answer' => 'sucesfull',
            ));
        else
            echo json_encode(array(
                'answer' => 'error',
                'errors' => $this->errors,
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
                'errors' => $this->errors,
            ));
    }

    /**
     * delete full WL
     */
    public function deleteWL() {
        if (parent::deleteWL())
            echo json_encode(array(
                'answer' => 'sucesfull',
            ));
        else
            echo json_encode(array(
                'answer' => 'error',
                'errors' => $this->errors,
            ));
    }

    public function addItem() {
        if (parent::addItem()) {

        }

        if (true)
            echo json_encode(array(
                'answer' => 'sucesfull',
            ));
        else
            echo json_encode(array(
                'answer' => 'error',
                'errors' => $this->errors,
            ));
    }

    public function deleteItem() {
        if (parent::deleteItem())
            echo json_encode(array(
                'answer' => 'sucesfull',
            ));
        else
            echo json_encode(array(
                'answer' => 'error',
                'errors' => $this->errors,
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
                'errors' => $this->errors,
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
                'errors' => $this->errors,
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
                'errors' => $this->errors,
            ));
    }

    public function getWLbyHash($hash) {

    }

    public function renderUserWL($userId, $type = '') {
        $wishlists = $this->db
                ->where('mod_wish_list.user_id', 47)
                ->join('mod_wish_list_products', 'mod_wish_list_products.wish_list_id=mod_wish_list.id')
                ->join('shop_product_variants', 'shop_product_variants.id=mod_wish_list_products.variant_id')
                ->join('shop_product_variants_i18n', 'shop_product_variants_i18n.id=shop_product_variants.id')
                ->join('shop_products', 'shop_products.id=shop_product_variants.product_id')
                ->join('shop_products_i18n', 'shop_products_i18n.id=shop_products.id')
                ->get('mod_wish_list')
                ->result_array();
        $w = array();
        foreach ($wishlists as $wishlist)
            $w[$wishlist[title]][] = $wishlist;

        var_dump($w);
        \CMSFactory\assetManager::create()
                ->registerScript('wishlist')
                ->setData('wishlists', $w)
                ->render('wishlist');
    }

    public function renderWLByHash($hash) {

    }

    /**
     * Render Wish List button
     * @param type $varId
     */
    public function renderWLButton($varId) {
        if (true)
            \CMSFactory\assetManager::create()
                    ->registerScript('wishlist')
                    ->setData('data', $data)
                    ->setData('id', $varId)
                    ->setData('value', 'Добавить в Список Желания')
                    ->setData('class', 'btn')
                    ->render('button', true);
        else
            \CMSFactory\assetManager::create()
                    ->registerScript('wishlist')
                    ->setData('data', $data)
                    ->setData('id', $varId)
                    ->setData('value', 'Уже в Списке Желания')
                    ->setData('class', 'btn inWL')
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
                'type' => 'INT',
                'null' => FALSE
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
        $data = array('wish_lists' => $wish_lists);
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
