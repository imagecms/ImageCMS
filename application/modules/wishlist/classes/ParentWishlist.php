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
                'name' => 'url',
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

        if ($lists) {
            $this->dataModel = $lists;
            return true;
        } else {
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

    public function user($user_id) {
        $user_wish_lists = $this->renderUserWL($userId, $access = "public");
        if ($user_wish_lists) {
            $this->dataModel = $user_wish_lists;
            return true;
        } else {
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
        $this->wishlist_model->insertWishList($title, $access, $description, $user_id);
        $this->wishlist_model->insertUser($user_id, $user_image, $user_birthday);
        
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
            $wishlists = $this->wishlist_model->getUserWishList($this->dx_auth->get_user_id(), $wish_list_id);                   

            $w = array();
            foreach ($wishlists as $wishlist)
                $w[$wishlist[title]][] = $wishlist;
            $this->dataModel = $w;
            return TRUE;
        } else {
            if ($this->input->post()) {
                $this->db->where('wish_list_id', $this->input->post(WLID));
                foreach ($this->input->post(comment)as $key => $coments) {
                    $this->db->where('variant_id ', $key);

                    $this->db->set('comment', $coments);
                    $this->db->update('mod_wish_list_products');
                }
            }
        }
        return FALSE;
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
        if (!$this->dx_auth->is_logged_in())
            $this->errors[] = 'Пользователь не залогинен';

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

        if (count($this->errors)) {
            return false;
        } else {
            $this->wishlist_model->addItem($varId, $listId, $listName);
            return true;
        }
    }

    public function deleteItem($variant_id, $wish_list_id) {
        $forReturn = $this->wishlist_model->deleteItem($variant_id, $wish_list_id);
        if (!$forReturn)
            $this->errors[] = 'Невозможно удалить товар из Списка Желания';

        return $forReturn;
    }

    public function editItem($id, $varId) {

    }

    public function moveItem($id, $varId) {

    }

    function editWLName($id, $newName) {

    }

    public function getWLbyHash($hash) {

    }

    public function renderUserWL($userId, $access = 'shared') {
        $wishlists = $this->wishlist_model->getUserWishListsByID($this->dx_auth->get_user_id());

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
        $this->wishlist_model->install();        
    }

    public function _deinstall() {
        $this->wishlist_model->deinstall();
    }

}