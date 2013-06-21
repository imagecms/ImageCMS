<?php

/**
 * @property CI_DB_active_record $db
 * @property DX_Auth $dx_auth
 */
class Wishlist_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    /**
     * Get module settings
     */
    public function getSettings() {
        $settings = $this->db
                ->select('settings')
                ->where('identif', 'wishlist')
                ->get('components')
                ->row_array();
        $settings = unserialize($settings[settings]);
        return $settings;
    }

    /**
     * Save settings
     * @param type $settings
     * @return boolean
     */
    public function setSettings($settings) {
        $forReturn = $this->db
                ->where('identif', 'wishlist')
                ->update('components', array('settings' => serialize($settings)));
        return $forReturn;
    }

    public function getWishLists() {
        return $this->db->where('user_id', $this->dx_auth->get_user_id())->get('mod_wish_list')->result_array();
    }

    public function getAllUsers() {
        return $this->db->get('mod_wish_list_users')->result_array();
    }

    public function getWLsByUserId($user_id, $access = 'shared') {
        return $all_lists = $this->db
                        ->where('user_id', $user_id)
                        ->where('access', $access)
                        ->get('mod_wish_list')->result_array();
    }

    public function getUserWishList($user_id, $list_id) {
        return $this->db
                        ->where('mod_wish_list.user_id', $user_id)
                        ->where('mod_wish_list.id', $list_id)
                        ->where('shop_products_i18n.locale', \MY_Controller::getCurrentLocale())
                        ->where('shop_product_variants_i18n.locale', \MY_Controller::getCurrentLocale())
                        ->join('mod_wish_list_products', 'mod_wish_list_products.wish_list_id=mod_wish_list.id')
                        ->join('shop_product_variants', 'shop_product_variants.id=mod_wish_list_products.variant_id')
                        ->join('shop_product_variants_i18n', 'shop_product_variants_i18n.id=shop_product_variants.id')
                        ->join('shop_products', 'shop_products.id=shop_product_variants.product_id')
                        ->join('shop_products_i18n', 'shop_products_i18n.id=shop_products.id')
                        ->get('mod_wish_list')
                        ->result_array();
    }

    public function deleteItem($variant_id, $wish_list_id) {
        return $this->db->delete('mod_wish_list_products', array(
                    'variant_id' => $variant_id,
                    'wish_list_id' => $wish_list_id,
        ));
    }

    public function getUserWishListsByID($user_id, $access = array('public', 'shared', 'private')) {
        return $this->db->where('mod_wish_list.user_id', $user_id)
                        ->join('mod_wish_list_products', 'mod_wish_list_products.wish_list_id=mod_wish_list.id')
                        ->where_in('mod_wish_list.access', $access)
                        ->where('shop_products_i18n.locale', \MY_Controller::getCurrentLocale())
                        ->where('shop_product_variants_i18n.locale', \MY_Controller::getCurrentLocale())
                        ->join('shop_product_variants', 'shop_product_variants.id=mod_wish_list_products.variant_id')
                        ->join('shop_product_variants_i18n', 'shop_product_variants_i18n.id=shop_product_variants.id')
                        ->join('shop_products', 'shop_products.id=shop_product_variants.product_id')
                        ->join('shop_products_i18n', 'shop_products_i18n.id=shop_products.id')
                        ->get('mod_wish_list')
                        ->result_array();
    }

    public function delWishListById($id) {
        return $this->db->delete('mod_wish_list', array('id' => $id));
    }

    public function delWishListProductsByWLId($id) {
        $this->db->where('wish_list_id', $id);
        return $this->db->delete('mod_wish_list_products');
    }

    public function getUserWishProducts() {
        $ids = $this->db
                ->where('mod_wish_list.user_id', $this->dx_auth->get_user_id())
                ->join('mod_wish_list_products', 'mod_wish_list_products.wish_list_id=mod_wish_list.id')
                ->group_by('variant_id')
                ->get('mod_wish_list');

        if ($ids)
            $ids = $ids->result_array();

        foreach ($ids as $id) {
            $ID[] = $id[variant_id];
        }

        return $ID;
    }

    public function insertWishList($title, $access, $description, $user_id) {
        return $this->db->set('title', $title)
                        ->set('access', $access)
                        ->set('description', $description)
                        ->set('user_id', $user_id)
                        ->insert('mod_wish_list');
    }

    public function insertUser($user_id, $user_image, $user_birthday) {
        return $this->db->set('id', $user_id)
                        ->set('user_name', $this->dx_auth->get_username())
                        ->set('user_image', $user_image)
                        ->set('user_birthday', $user_birthday)
                        ->insert('mod_wish_list_users');
    }

    public function addItem($varId, $listId, $listName) {
        if ($listName != '') {
            $this->createWishList($listName, $this->dx_auth->get_user_id());
            $listId = $this->db->insert_id();
        }
        $data = array(
            'variant_id' => $varId,
            'wish_list_id' => $listId
        );

        return $this->db->insert('mod_wish_list_products', $data);
    }

    public function createWishList($listName, $user_id) {
        if (!$this->db->where('user_id', $user_id)->get('mod_wish_list')->result_array()) {
            $this->db->insert('mod_wish_list_users', array('id' => $user_id, 'user_name' => $this->dx_auth->get_username()));
        }
        $data = array(
            'title' => $listName,
            'user_id' => $user_id
        );
        return $this->db->insert('mod_wish_list', $data);
    }

    public function install() {
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

        $fields = array(
            'id' => array(
                'type' => 'INT',
                'null' => FALSE
            ),
            'user_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '254',
                'null' => TRUE
            ),
            'user_image' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'user_birthday' => array(
                'type' => 'INT',
                'null' => FALSE
            ),
            'description' => array(
                'type' => 'TEXT',
                'null' => TRUE
            )
        );

        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('mod_wish_list_users');


        $this->db
                ->where('identif', 'wishlist')
                ->update('components', array(
                    'settings' => '',
                    'enabled' => 1,
                    'autoload' => 1,
        ));
    }

    public function deinstall() {
        $this->load->dbforge();
        ($this->dx_auth->is_admin()) OR exit;
        $this->dbforge->drop_table('mod_wish_list_products');
        $this->dbforge->drop_table('mod_wish_list_users');
        $this->dbforge->drop_table('mod_wish_list');
    }

}

?>
