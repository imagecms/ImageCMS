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
     * @return array
     */
    public function getSettings() {
        $this->db->cache_on();
        $settings = $this->db->select('settings')
                ->where('identif', 'wishlist')
                ->get('components')
                ->row_array();
        $this->db->cache_off();
        $settings = unserialize($settings['settings']);
        return $settings;
    }

    /**
     * Save settings
     * @param array $settings
     * @return boolean
     */
    public function setSettings($settings) {
        return $this->db->where('identif', 'wishlist')
                        ->update('components', array('settings' => serialize($settings)
        ));
    }

    /**
     * get wish lists
     *
     * @param int $userID filter by user id
     * @return array
     */
    public function getWishLists($userID = NULL) {
        if (!$userID)
            $userID = $this->dx_auth->get_user_id();

        return $this->db
                        ->where('user_id', $userID)
                        ->get('mod_wish_list')
                        ->result_array();
    }

    /**
     * get all users
     *
     * @return array/false
     */
    public function getAllUsers() {
        $users = $this->db
                ->order_by('user_name')
                ->get('mod_wish_list_users');

        if ($users)
            return $users->result_array();
        else
            return FALSE;
    }

    /**
     * get user by id
     *
     * @param $id
     * @return array
     */
    public function getUserByID($id) {
        $query = $this->db
                ->where('id', $id)
                ->get('mod_wish_list_users');

        if ($query) {
            return $query->row_array();
        } else {
            return FALSE;
        }
    }

    /**
     * get wish list by user id
     *
     * @param $user_id
     * @param $access
     * @return array
     */
    public function getWLsByUserId($user_id, $access = array('shared')) {
        return $all_lists = $this->db
                ->where('user_id', $user_id)
                ->where_in('access', $access)
                ->get('mod_wish_list')
                ->result_array();
    }

    /**
     * get user wish list
     *
     * @param type $user_id
     * @param type $list_id
     * @param type $access
     * @return array
     */
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

    /**
     * get user wish list by hash
     *
     * @param $hash
     * @param $access
     * @return array
     */
    public function getUserWishListByHash($hash, $access = array('public', 'shared', 'private')) {
        $locale = \MY_Controller::getCurrentLocale();

        $query = $this->db->select('*, mod_wish_list.user_id as wl_user_id, shop_product_variants.mainImage as image')
                ->where_in('access', $access)
                ->where('mod_wish_list.hash', $hash)
                ->where('shop_products_i18n.locale', $locale)
                ->where('shop_product_variants_i18n.locale', $locale)
                ->join('mod_wish_list_products', 'mod_wish_list_products.wish_list_id=mod_wish_list.id')
                ->join('shop_product_variants', 'shop_product_variants.id=mod_wish_list_products.variant_id')
                ->join('shop_product_variants_i18n', 'shop_product_variants_i18n.id=shop_product_variants.id')
                ->join('shop_products', 'shop_products.id=shop_product_variants.product_id')
                ->join('shop_products_i18n', 'shop_products_i18n.id=shop_products.id')
                ->get('mod_wish_list')
                ->result_array();

        if (!$query) {
            return $this->db
                            ->select('*, mod_wish_list.id AS `wish_list_id`')
                            ->where_in('mod_wish_list.access', $access)
                            ->where('mod_wish_list_products.wish_list_id', NULL)
                            ->where('mod_wish_list.hash', $hash)
                            ->join('mod_wish_list_products', 'mod_wish_list_products.wish_list_id=mod_wish_list.id', 'left')
                            ->get('mod_wish_list')
                            ->result_array();
        }

        return $query;
    }

    /**
     * delete item from list
     *
     * @param $variant_id
     * @param $wish_list_id
     * @return boolean
     */
    public function deleteItem($variant_id, $wish_list_id) {
        $this->db
                ->delete('mod_wish_list_products', array(
                    'variant_id' => $variant_id,
                    'wish_list_id' => $wish_list_id,
        ));
        if ($this->db->affected_rows() == 0)
            return FALSE;
        else
            return TRUE;
    }

    /**
     * delete items by ids
     *
     * @param array $ids
     * @return array
     */
    public function deleteItemsByIDs($ids) {
        return $this->db->where_in('id', $ids)
                        ->delete('mod_wish_list_products');
    }

    /**
     * get user wish list by id
     *
     * @param $user_id
     * @param $access
     * @return array
     */
    public function getUserWishListsByID($user_id, $access = array('public', 'shared', 'private')) {
        $locale = \MY_Controller::getCurrentLocale();
        $queryFirst = $this->db
                ->select('*, shop_product_variants.mainImage AS `image`, mod_wish_list_products.id AS  list_product_id')
                ->where('mod_wish_list.user_id', $user_id)
                ->join('mod_wish_list_products', 'mod_wish_list_products.wish_list_id=mod_wish_list.id', 'left')
                ->where_in('mod_wish_list.access', $access)
                ->where('shop_products_i18n.locale', $locale)
                ->where('shop_product_variants_i18n.locale', $locale)
                ->join('shop_product_variants', 'shop_product_variants.id=mod_wish_list_products.variant_id')
                ->join('shop_product_variants_i18n', 'shop_product_variants_i18n.id=shop_product_variants.id')
                ->join('shop_products', 'shop_products.id=shop_product_variants.product_id')
                ->join('shop_products_i18n', 'shop_products_i18n.id=shop_products.id')
                ->get('mod_wish_list');

        if ($queryFirst) {
            $queryFirst = $queryFirst->result_array();
        }

        $querySecond = $this->db
                ->select('*, mod_wish_list.id AS `wish_list_id`')
                ->where_in('mod_wish_list.access', $access)
                ->where('mod_wish_list_products.wish_list_id', NULL)
                ->where('mod_wish_list.user_id', $user_id)
                ->join('mod_wish_list_products', 'mod_wish_list_products.wish_list_id=mod_wish_list.id', 'left')
                ->get('mod_wish_list');

        if ($querySecond) {
            $querySecond = $querySecond->result_array();
        }

        $arr = array_merge($queryFirst, $querySecond);
        if (count($arr) > 0) {
            return $arr;
        } else {
            return FALSE;
        }
    }

    /**
     * delete wish list by id
     *
     * @param $id
     * @return boolean
     */
    public function delWishListById($id) {
        $this->db
                ->where_in('id', $id)
                ->delete('mod_wish_list');
        return $this->db->affected_rows();
    }

    /**
     * delete wish list products by wish list id
     *
     * @param $id
     * @return boolean
     */
    public function delWishListProductsByWLId($id) {
        $this->db->where_in('wish_list_id', (array) $id);
        $this->db->delete('mod_wish_list_products');
        return $this->db->affected_rows();
    }

    /**
     * get user wish list products
     *
     * @param $userID
     * @return array
     */
    public function getUserWishProducts($userID = null) {
        if (!$userID)
            $userID = $this->dx_auth->get_user_id();
        $ID = array();
        $ids = $this->db
                ->where('mod_wish_list.user_id', $userID)
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

    /**
     *
     *
     * @param $userID
     * @return array
     */
    public function getAllUserWLs($userID = null) {
        if (!$userID)
            $userID = $this->dx_auth->get_user_id();

        $ID = array();

        $ids = $this->db
                ->where('mod_wish_list.user_id', $userID)
                ->get('mod_wish_list');

        if ($ids) {
            $ids = $ids->result_array();

            foreach ($ids as $id) {
                $ID[] = $id['id'];
            }
        }

        return $ID;
    }

    /**
     * get most popular products
     *
     * @param $limit
     * @return array
     */
    public function getMostPopularProducts($limit = 10) {
        $query = $this->db
                ->select('COUNT(id) as productCount, variant_id,')
                ->order_by('productCount', 'desc')
                ->group_by('variant_id')
                ->limit($limit)
                ->get('mod_wish_list_products');
        if ($query)
            return $query->result_array();
        else
            return FALSE;
    }

    /**
     * insert wish list
     *
     * @param $title
     * @param $access
     * @param $description
     * @param $user_id
     * @return boolean
     */
    public function insertWishList($title, $access, $user_id) {
        return $this->db->set('title', $title)
                        ->set('access', $access)
                        ->set('user_id', $user_id)
                        ->insert('mod_wish_list');
    }

    /**
     * update wish list
     *
     * @param $id
     * @param $data
     * @return boolean
     */
    public function updateWishList($id, $data) {
        $this->db->where('id', $id)
                ->update('mod_wish_list', $data);

        if ($this->db->affected_rows() == 0)
            return FALSE;
        else
            return TRUE;
    }

    /**
     * update wish lists items comments
     *
     * @param $wish_list_id
     * @param $comments
     * @return boolean
     */
    public function updateWishListItemsComments($wish_list_id, $comments) {
        foreach ($comments as $key => $coments) {
            if (!$this->db->where('wish_list_id', $wish_list_id)
                            ->where('variant_id ', $key)
                            ->set('comment', $coments)
                            ->update('mod_wish_list_products'))
                return FALSE;
        }
        return TRUE;
    }

    /**
     * insert user
     *
     * @param $user_id
     * @param $user_image
     * @param $user_birthday
     * @param $user_name
     * @return boolean
     */
    public function insertUser($user_id, $user_image, $user_birthday, $user_name = null) {
        if (!$user_name)
            $user_name = $this->dx_auth->get_username();
        return $this->db->set('id', $user_id)
                        ->set('user_name', $user_name)
                        ->set('user_image', $user_image)
                        ->set('user_birthday', $user_birthday)
                        ->insert('mod_wish_list_users');
    }

    /**
     * add item to wish list
     *
     * @param $varId
     * @param $listId
     * @param $listName
     * @param $user_id
     * @return boolean
     */
    public function addItem($varId, $listId, $listName, $user_id = null) {
        if (!$user_id)
            $user_id = $this->dx_auth->get_user_id();

        if (!$listId) {
            if ($listName != '') {
                $this->createWishList($listName, $user_id);
                $listId = $this->db->insert_id();
            } else {
                return FALSE;
            }
        }

        $data = array(
            'variant_id' => $varId,
            'wish_list_id' => $listId
        );

        return $this->db->insert('mod_wish_list_products', $data);
    }

    /**
     * create user wish list if not exist
     *
     * @param $user_id
     * @param $user_name
     * @return boolean
     */
    public function createUserIfNotExist($user_id, $user_name = null) {
        if (!$user_name)
            $user_name = $this->dx_auth->get_username();
        $user = $this->db->where('id', $user_id)->get('mod_wish_list_users');
        if ($user) {
            $user = $user->result_array();
        } else {
            $user = FALSE;
        }

//        var_dumps($user);
        if (!$user) {
//            $user = $user->result_array();
            $this->db->insert('mod_wish_list_users', array(
                'id' => $user_id,
                'user_name' => $user_name
            ));
            return TRUE;
        }
        return FALSE;
    }

    /**
     * update user
     *
     * @param $userID
     * @param $user_name
     * @param $user_birthday
     * @param $description
     * @return boolean
     */
    public function updateUser($userID, $user_name, $user_birthday, $description) {
        return $this->db->where('id', $userID)
                        ->set('user_name', $user_name)
                        ->set('user_birthday', $user_birthday)
                        ->set('description', $description)
                        ->update('mod_wish_list_users');
    }

    /**
     * create wish list
     *
     * @param $listName
     * @param $user_id
     * @return boolean
     */
    public function createWishList($listName, $user_id, $access = 'shared', $description) {
        $this->createUserIfNotExist($user_id);
        $data = array(
            'title' => $listName,
            'user_id' => $user_id,
            'description' => $description,
            'hash' => random_string('unique', 16),
            'access' => $access
        );
        return $this->db->insert('mod_wish_list', $data);
    }

    /**
     * update WishList item
     *
     * @param $varId
     * @param $wish_list_id
     * @param $data
     * @return boolean
     */
    public function updateWishListItem($varId, $wish_list_id, $data) {
        return $this->db
                        ->where('wish_list_id', $wish_list_id)
                        ->where('variant_id', $varId)
                        ->update('mod_wish_list_products', $data);
    }

    /**
     * get user wish list count
     *
     * @param $user_id
     * @return int
     */
    public function getUserWishListCount($user_id) {
        $query = $this->db
                ->where('user_id', $user_id)
                ->get('mod_wish_list');
        if ($query) {
            return count($query->result_array());
        }
        else
            return 0;
    }

    /**
     * get user wish list items count
     *
     * @param $user_id
     * @return int
     */
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

    /**
     * add list rewiev
     *
     * @param $list_id
     * @return boolean
     */
    public function addReview($hash) {
        $count = $this->db->where('hash', $hash)
                ->select('review_count')
                ->get('mod_wish_list')
                ->row_array();
        if (!$count)
            return FALSE;

        return $this->db->where('hash', $hash)
                        ->set('review_count', $count['review_count'] + 1)
                        ->update('mod_wish_list');
    }

    /**
     * get most view wish lists
     *
     * @param $limit
     * @return boolean
     */
    public function getMostViewedWishLists($limit = 10) {
        return $this->db
                        ->select('id,title,review_count')
                        ->where('review_count <>', 0)
                        ->limit($limit)
                        ->get('mod_wish_list')
                        ->result_array();
    }

    /**
     *
     * @param type $userID
     * @param type $file_name
     * @return boolean
     */
    public function setUserImage($userID, $file_name) {
        return $this->db
                        ->where('id', $userID)
                        ->update('mod_wish_list_users', array(
                            'user_image' => $file_name
        ));
    }

    /**
     *
     * @param int $userID
     * @return bool
     */
    public function delUser($userID) {
        $WLs = $this->getAllUserWLs($userID);
        $this->delWishListProductsByWLId($WLs);
        $this->delWishListById($WLs);
        $this->db
                ->where('id', $userID)
                ->delete('mod_wish_list_users');
        return TRUE;
    }

    /**
     * install module(create db tables, set default values)
     */
    public function install() {

        $this->load->dbforge();
        ($this->dx_auth->is_admin()) OR exit;
        @mkdir('./uploads/mod_wishlist', 0777);

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
            'description' => array(
                'type' => 'Text',
                'null' => TRUE
            ),
            'access' => array(
                'type' => 'ENUM',
                'constraint' => "'public','private','shared'",
                'default' => "shared"
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
                    'settings' => serialize(
                            array(
                                'maxUserName' => 256,
                                'maxListName' => 254,
                                'maxListsCount' => 10,
                                'maxItemsCount' => 100,
                                'maxCommentLenght' => 500,
                                'maxDescLenght' => 1000,
                                'maxWLDescLenght' => 1000,
                                'maxImageWidth' => 150,
                                'maxImageHeight' => 150,
                                'maxImageSize' => 2000000
                            )
                    ),
                    'enabled' => 1,
                    'autoload' => 1
        ));
        
        $this->insertPaterns();
        
        return TRUE;
    }

    public function insertPaterns() {
        $this->db->where_in('id', '111')->delete('mod_email_paterns');
        $this->db->where_in('id', '111')->delete('mod_email_paterns_i18n');
        
        $file = $this->load->file(dirname(__FILE__) . '/patern.sql', true);
        $this->db->query($file);

        $file = $this->load->file(dirname(__FILE__) . '/patern_i18n.sql', true);
        $this->db->query($file);
    }

    /**
     * deinstall module
     */
    public function deinstall() {
        $this->load->dbforge();
        ($this->dx_auth->is_admin()) OR exit;
        @rmdir('./uploads/mod_wishlist');

        $this->dbforge->drop_table('mod_wish_list_products');
        $this->dbforge->drop_table('mod_wish_list_users');
        $this->dbforge->drop_table('mod_wish_list');

        $this->db->where_in('id', '111')->delete('mod_email_paterns');
        $this->db->where_in('id', '111')->delete('mod_email_paterns_i18n');

        return TRUE;
    }

}

?>
