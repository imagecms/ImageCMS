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
        $settings = $this->db->select('settings')
                ->where('identif', 'wishlist')
                ->get('components')
                ->row_array();
        $settings = unserialize($settings['settings']);
        return $settings;
    }

    /**
     * Save settings
     * @param type $settings
     * @return boolean
     */
    public function setSettings($settings) {
        return $this->db->where('identif', 'wishlist')
                        ->update('components', array('settings' => serialize($settings)));
    }

    public function getWishLists($userID = NULL) {
        if (!$userID)
            $userID = $this->dx_auth->get_user_id();

        return $this->db
                        ->where('user_id', $userID)
                        ->get('mod_wish_list')
                        ->result_array();
    }

    public function getAllUsers() {
        return $this->db
                        ->order_by('user_name')
                        ->get('mod_wish_list_users')
                        ->result_array();
    }

    public function getUserByID($id) {
        return $this->db->where('id', $id)->get('mod_wish_list_users')->row_array();
    }

    public function getWLsByUserId($user_id, $access = array('shared')) {
        return $all_lists = $this->db
                        ->where('user_id', $user_id)
                        ->where_in('access', $access)
                        ->get('mod_wish_list')->result_array();
    }

    public function getUserWishList($user_id, $list_id, $access = array('public', 'shared', 'private')) {
        $locale = \MY_Controller::getCurrentLocale();
        $query = $this->db
                ->where('mod_wish_list.user_id', $user_id)
                ->where_in('access', $access)
                ->where('mod_wish_list.id', $list_id)
                ->where('shop_products_i18n.locale', $locale)
                ->where('shop_product_variants_i18n.locale', $locale)
                ->join('mod_wish_list_products', 'mod_wish_list_products.wish_list_id=mod_wish_list.id')
                ->join('shop_product_variants', 'shop_product_variants.id=mod_wish_list_products.variant_id')
                ->join('shop_product_variants_i18n', 'shop_product_variants_i18n.id=shop_product_variants.id')
                ->join('shop_products', 'shop_products.id=shop_product_variants.product_id')
                ->join('shop_products_i18n', 'shop_products_i18n.id=shop_products.id')
                ->get('mod_wish_list')
                ->result_array();
        if (!$query)
            return $this->db
                            ->select('*, mod_wish_list.id AS `wish_list_id`')
                            ->where_in('mod_wish_list.access', $access)
                            ->where('mod_wish_list_products.wish_list_id', NULL)
                            ->where('mod_wish_list.id', $list_id)
                            ->where('mod_wish_list.user_id', $user_id)
                            ->join('mod_wish_list_products', 'mod_wish_list_products.wish_list_id=mod_wish_list.id', 'left')
                            ->get('mod_wish_list')
                            ->result_array();
        return $query;
    }

    public function deleteItem($variant_id, $wish_list_id) {
        return $this->db
                        ->delete('mod_wish_list_products', array(
                            'variant_id' => $variant_id,
                            'wish_list_id' => $wish_list_id,
        ));
    }

    public function deleteItemsByIDs($ids) {
        foreach ($ids as $id) {
            $this->db->where('id', $id)->delete('mod_wish_list_products');
        }
    }

    public function getUserWishListsByID($user_id, $access = array('public', 'shared', 'private')) {
        $locale = \MY_Controller::getCurrentLocale();

        return array_merge(
                $this->db
                        ->select('*, shop_product_variants.mainImage AS `image`')
                        ->where('mod_wish_list.user_id', $user_id)
                        ->join('mod_wish_list_products', 'mod_wish_list_products.wish_list_id=mod_wish_list.id', 'left')
                        ->where_in('mod_wish_list.access', $access)
                        ->where('shop_products_i18n.locale', $locale)
                        ->where('shop_product_variants_i18n.locale', $locale)
                        ->join('shop_product_variants', 'shop_product_variants.id=mod_wish_list_products.variant_id')
                        ->join('shop_product_variants_i18n', 'shop_product_variants_i18n.id=shop_product_variants.id')
                        ->join('shop_products', 'shop_products.id=shop_product_variants.product_id')
                        ->join('shop_products_i18n', 'shop_products_i18n.id=shop_products.id')
                        ->get('mod_wish_list')
                        ->result_array(),
                $this->db
                        ->select('*, mod_wish_list.id AS `wish_list_id`')
                        ->where_in('mod_wish_list.access', $access)
                        ->where('mod_wish_list_products.wish_list_id', NULL)
                        ->where('mod_wish_list.user_id', $user_id)
                        ->join('mod_wish_list_products', 'mod_wish_list_products.wish_list_id=mod_wish_list.id', 'left')
                        ->get('mod_wish_list')->result_array()
        );
    }

    public function delWishListById($id) {
        return $this->db->delete('mod_wish_list', array('id' => $id));
    }

    public function delWishListProductsByWLId($id) {
        $this->db->where('wish_list_id', $id);
        return $this->db->delete('mod_wish_list_products');
    }

    public function getUserWishProducts() {
        $ID = null;
        $ids = $this->db->where('mod_wish_list.user_id', $this->dx_auth->get_user_id())
                ->join('mod_wish_list_products', 'mod_wish_list_products.wish_list_id=mod_wish_list.id')
                ->group_by('variant_id')
                ->get('mod_wish_list');

        if ($ids) {
            $ids = $ids->result_array();

            foreach ($ids as $id) {
                $ID[] = $id['variant_id'];
            }
        }

        return $ID;
    }

    public function getMostPopularProducts($limit = 10) {
        return $this->db->select('COUNT(id) as productCount, variant_id,')
                        ->order_by('productCount', 'desc')
                        ->group_by('variant_id')
                        ->limit($limit)
                        ->get('mod_wish_list_products')
                        ->result_array();
    }

    public function insertWishList($title, $access, $description, $user_id) {
        return $this->db->set('title', $title)
                        ->set('access', $access)
                        ->set('description', $description)
                        ->set('user_id', $user_id)
                        ->insert('mod_wish_list');
    }

    public function upateWishList($id, $data) {
        return $this->db->where('id', $id)->update('mod_wish_list', $data);
    }

    public function upateWishListItemsComments($wish_list_id, $comments) {
        foreach ($comments as $key => $coments) {
            $this->db->where('wish_list_id', $wish_list_id)
                    ->where('variant_id ', $key)
                    ->set('comment', $coments)
                    ->update('mod_wish_list_products');
        }
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

    public function createUserIfNotExist($user_id) {
        if (!$this->db->where('id', $user_id)->get('mod_wish_list_users')->result_array()) {
            $this->db->insert('mod_wish_list_users', array('id' => $user_id, 'user_name' => $this->dx_auth->get_username()));
            return TRUE;
        }
        return FALSE;
    }

    public function updateUser($userID, $user_name, $user_birthday, $description) {
        return $this->db->where('id', $userID)
                        ->set('user_name', $user_name)
                        ->set('user_birthday', $user_birthday)
                        ->set('description', $description)
                        ->update('mod_wish_list_users');
    }

    public function createWishList($listName, $user_id) {
        $this->createUserIfNotExist($user_id);
        $data = array(
            'title' => $listName,
            'user_id' => $user_id,
            'hash' => random_string('unique', 16)
        );
        return $this->db->insert('mod_wish_list', $data);
    }

    public function getUserWishListCount($user_id) {
        $query = $this->db->where('user_id', $user_id)->get('mod_wish_list');
        if ($query) {
            return count($query->result_array());
        }
        else
            return 0;
    }

    public function getUserWishListItemsCount($user_id) {
        $query = $this->db->where('mod_wish_list.user_id', $user_id)
                ->join("mod_wish_list_products", 'mod_wish_list_products.wish_list_id=mod_wish_list.id')
                ->get('mod_wish_list');
        if ($query) {
            return count($query->result_array());
        }
        else
            return 0;
    }

    public function addRewiew($list_id) {
        $count = $this->db->where('id', $list_id)
                ->select('review_count')
                ->get('mod_wish_list')
                ->row_array();
        return $this->db->where('id', $list_id)
                        ->set('review_count', $count['review_count'] + 1)
                        ->update('mod_wish_list');
    }

    public function getMostViewedWishLists($limit = 10) {
        return $this->db
                        ->select('id,title,review_count')
                        ->where('review_count <>', 0)
                        ->limit($limit)
                        ->get('mod_wish_list')
                        ->result_array();
    }

    public function install() {
        mkdir('./uploads/mod_wishlist', 0777);

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
            'review_count' => array(
                'type' => 'INT',
                'null' => FALSE,
                'default' => 0
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
                'null' => TRUE
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
                    'settings' => serialize(array('maxListName' => 254,
                        'maxListsCount' => 10,
                        'maxItemsCount' => 100,
                        'maxCommentLenght' => 500,
                        'maxDescLenght' => 1000,
                        'maxImageWidth' => 150,
                        'maxImageHeight' => 150)),
                    'enabled' => 1,
                    'autoload' => 1
        ));
    }

    public function deinstall() {
        $this->load->dbforge();
        ($this->dx_auth->is_admin()) OR exit;
        rmdir('./uploads/mod_wishlist');
        $this->dbforge->drop_table('mod_wish_list_products');
        $this->dbforge->drop_table('mod_wish_list_users');
        $this->dbforge->drop_table('mod_wish_list');
    }

}

?>
