<?php

namespace wishlist\classes;

/**
 * Image CMS
 * Module Wishlist
 * @property \Wishlist_model $wishlist_model
 * @property \DX_Auth $dx_auth
 * @property \CI_URI $uri
 * @property \CI_DB_active_record $db
 * @property \CI_Input $input
 */
class ParentWishlist extends \MY_Controller {

    public $settings = array();
    public $dataModel;
    public $errors = array();
    public $userWishProducts;

    public function __construct() {
        parent::__construct();

        $this->writeCookies();
        $this->load->model('wishlist_model');
        $this->load->helper(array('form', 'url'));
        $this->settings = $this->wishlist_model->getSettings();
        $this->userWishProducts = $this->wishlist_model->getUserWishProducts();
    }

    private function writeCookies() {
        $this->load->helper('cookie');
        if (!strstr($this->uri->uri_string(), 'wishlist')) {
            $cookie = array(
                'name' => 'url2',
                'value' => $this->uri->uri_string(),
                'expire' => '15000',
                'prefix' => ''
            );
            $this->input->set_cookie($cookie);
        }
    }

    private function checkPerm() {
        $permAllow = TRUE;
        if (!$this->dx_auth->is_logged_in())
            $permAllow = FALSE;

        return $permAllow;
    }

    public function index() {
//        if (!$this->checkPerm())
//            $this->core->error_404();

        $this->renderUserWL();
    }

    public function all() {
        $users = $this->wishlist_model->getAllUsers();
        $lists = '';
        
        foreach ($users as $user) {
            $lists [] = array(
                'user' => $user,
                'lists' => $this->wishlist_model->getWLsByUserId($user['id'], 'public')
            );
        }
        
        if($lists){
            $this->dataModel = $lists;
             return true;
        }        
        else{
            return false;
        }
        
       
    }

    public function show($user_id, $list_id) {
        $wishlist = $this->wishlist_model->getUserWishList($user_id, $list_id);
        
        if ($wishlist) {
            $this->dataModel = $wishlist;
            return true;
        } else {
            return false;
        }        
    }
    
    public function user($user_id){
        $user_wish_lists = $this->renderUserWL($userId, $access="public");
        if($user_wish_lists){
            $this->dataModel = $user_wish_lists;
            return true;
        }else{
            return false;
        }
     
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
            ));
    }

    /**
     * Edit WL
     */
    public function editWL($wish_list_id) {
        if ($wish_list_id) {
            $wishlists = $this->db
                    ->where('mod_wish_list.user_id', $this->dx_auth->get_user_id())
                    ->where('mod_wish_list.id', $wish_list_id)
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

            \CMSFactory\assetManager::create()
                    ->registerScript('wishlist')
                    ->registerStyle('style')
                    ->setData('wishlists', $w)
                    ->render('wishlistEdit');
        }
        else
            FALSE;
    }

    /**
     * delete full WL
     * @return type
     */
    public function deleteWL($id) {
        $forReturn = TRUE;

        $forReturn = $this->wishlist_model->delWishListById($id);

        if ($forReturn) {
            $forReturn = $this->wishlist_model->delWishListProductsByWLId($id);

            if (!$forReturn)
                $this->errors[] = 'Невозможно удалить товары из списка';
        }
        else
            $this->errors[] = 'Невозможно удалить Список Желания';

        return $forReturn;
    }

    /**
     * add item to wish list
     *
     * @return boolean
     */
    public function addItem($varId) {
        $listId = $this->input->post('wishlist');
        $listName = $this->input->post('wishListName');


        if (!$listId) {
            $listId = "";
        }

        if ($listName == 'Создать список') {
            $listName = "";
        }

        if (strlen($listName) > $this->settings['maxListName']) {
            $listName = substr($listName, 0, (int) $this->settings['maxListName']);
            $this->errors[] = 'Поле имя будет изменено до длини ' . $this->settings['maxListName'] . ' символов </br>';
        }

        $this->wishlist_model->addItem($varId, $listId, $listName);

        if (count($this->errors)) {
            return false;
        } else {
            return true;
        }
    }

    public function deleteItem($variant_id, $wish_list_id) {
        $forReturn = $this->db->delete('mod_wish_list_products', array(
            'variant_id' => $variant_id,
            'wish_list_id' => $wish_list_id,
        ));
        if (!$forReturn)
            $this->errors[] = 'Невозможно удалить товар из Списка Желания';

        return $forReturn;
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

    public function renderUserWL($userId, $access = 'shared') {
        $wishlists = $this->db
                ->where('mod_wish_list.user_id', $this->dx_auth->get_user_id())
                ->where('mod_wish_list.access', $access)
                ->join('mod_wish_list_products', 'mod_wish_list_products.wish_list_id=mod_wish_list.id')
                ->join('shop_product_variants', 'shop_product_variants.id=mod_wish_list_products.variant_id')
                ->join('shop_product_variants_i18n', 'shop_product_variants_i18n.id=shop_product_variants.id')
                ->join('shop_products', 'shop_products.id=shop_product_variants.product_id')
                ->join('shop_products_i18n', 'shop_products_i18n.id=shop_products.id')
                ->get('mod_wish_list')
                ->result_array();
//        var_dump($wishlists);
        $w = array();
        foreach ($wishlists as $wishlist)
            $w[$wishlist[title]][] = $wishlist;
        return $w;
    }

    public function renderWLByHash($hash) {
        
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

    public function _deinstall() {
        $this->load->dbforge();
        ($this->dx_auth->is_admin()) OR exit;
        $this->dbforge->drop_table('mod_wish_list_products');
        $this->dbforge->drop_table('mod_wish_list_users');
        $this->dbforge->drop_table('mod_wish_list');
    }

}