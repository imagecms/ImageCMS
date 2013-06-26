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
        if (!strstr($this->uri->uri_string(), 'wishlist') && !strstr($this->uri->uri_string(), 'sync')) {
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
        $this->renderUserWL();
    }

    public function all() {
        if (!$users = $this->wishlist_model->getAllUsers()) {
            $this->errors[] = 'Нет пользователей';
            return FALSE;
        }
        $lists = '';

        foreach ($users as $user) {
            $lists [] = array(
                'user' => $user,
                'lists' => $this->wishlist_model->getWLsByUserId($user['id'], 'public')
            );
        }

        if ($lists) {
            $this->dataModel = $lists;
            return TRUE;
        } else {
            $this->errors[] = 'Нет списков';
            return FALSE;
        }
    }

    public function show($user_id, $list_id) {

        $wishlist = $this->wishlist_model->getUserWishList($user_id, $list_id, array('public'));

        if ($wishlist) {
            self::addReview($list_id);
            $this->dataModel = $wishlist;

            return TRUE;
        } else {
            return FALSE;
        }
    }

    public static function addReview($list_id) {
        $CI = & get_instance();
        $listsAdded = array();

        if ($CI->input->cookie('wishListViewer')) {
            $listsAdded = unserialize($CI->input->cookie('wishListViewer'));
        }

        if (!in_array($list_id, $listsAdded)) {
            array_push($listsAdded, $list_id);
            if ($CI->wishlist_model->addRewiew($list_id)) {
                $cookie = array(
                    'name' => 'wishListViewer',
                    'value' => serialize($listsAdded),
                    'expire' => 60 * 60 * 24,
                    'prefix' => ''
                );
                $CI->input->set_cookie($cookie);
                return TRUE;
            }
        }
        return FALSE;
    }

    public function getMostViewedWishLists($limit = 10) {
        $views = $this->wishlist_model->getMostViewedWishLists($limit);
        if ($views) {
            $this->dataModel = $views;
            return TRUE;
        } else {
            $this->errors[] = "Нет просмотров";
            return FALSE;
        }
    }

    public function user($user_id) {
        if ($this->renderUserWL($user_id, $access = array('public'))) {
            $this->dataModel = $this->dataModel[wishlists];
            return TRUE;
        } else {
            $this->errors[] = "Неверний запрос";
            return FALSE;
        }
    }

    public function userUpdate($userID, $user_name, $user_birthday, $description) {
        $this->wishlist_model->createUserIfNotExist($this->dx_auth->get_user_id());
        if (!$userID) {
            $userID = $this->dx_auth->get_user_id();
        }
        if ($this->wishlist_model->updateUser($userID, $user_name, $user_birthday, $description)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function updateWL($id, $data, $comments) {
        $this->wishlist_model->upateWishList($id, $data);
        $this->wishlist_model->upateWishListItemsComments($id, $comments);
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
    }

    public function createWishList($user_id, $listName) {
        if ($listName)
            $count_lists = $this->wishlist_model->getUserWishListCount($this->dx_auth->get_user_id());

        if ($count_lists >= $this->settings['maxListsCount']) {
            $this->errors[] = 'Лимит списков равен ' . $this->settings['maxListsCount'] . ' исчерпан </br>';
            return FALSE;
        }

        if ($listName) {
            if (iconv_strlen($listName, 'UTF-8') > $this->settings['maxListName']) {
                $listName = substr($listName, 0, (int) $this->settings['maxListName']);
                $this->errors[] = 'Поле имя будет изменено до длини ' . $this->settings['maxListName'] . ' символов </br>';
            }
            $this->wishlist_model->createWishList($listName, $user_id);
        } else {
            $this->errors[] = "Поле имя не должно пустеть...";
        }

        if (count($this->errors))
            return FALSE;
        else {
            $this->dataModel = "Создано";
            return TRUE;
        }
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

        if (count($this->errors))
            return FALSE;
        else {
            $this->dataModel = "Создано";
            return TRUE;
        }
    }

    /**
     * add item to wish list
     *
     * @return boolean
     */
    public function _addItem($varId, $listId, $listName) {
        $count_lists = 0;
        $count_items = $this->wishlist_model->getUserWishListItemsCount($this->dx_auth->get_user_id());
        if($count_items >= $this->settings['maxItemsCount']){
            $this->errors[] = 'Исчерпан лимит продуктов';
            return FALSE;
        }
        if (!$this->dx_auth->is_logged_in()) {
            $this->errors[] = 'Пользователь не залогинен';
            return FALSE;
        }

        if (strlen($listName) > $this->settings['maxListName']) {
            $listName = substr($listName, 0, (int) $this->settings['maxListName']);
            $this->errors[] = 'Поле имя будет изменено до длини ' . $this->settings['maxListName'] . ' символов </br>';
        }

        if ($listName)
            $count_lists = $this->wishlist_model->getUserWishListCount($this->dx_auth->get_user_id());

        if ($count_lists >= $this->settings['maxListsCount']) {
            $this->errors[] = 'Лимит Cписков Желания исчерпан. Максимум - ' . $this->settings['maxListsCount'] . ' </br>';
            return FALSE;
        } else
        if (!$this->wishlist_model->_addItem($varId, $listId, $listName))
            $this->errors[] = "Невозможно додать";

        if (count($this->errors))
            return FALSE;
        else {
            $this->dataModel = "Добавлено";
            return TRUE;
        }
    }

    public function moveItem($varId, $wish_list_id, $to_listId = '', $to_listName = '') {
        $this->wishlist_model->deleteItem($varId, $wish_list_id);
        if ($this->_addItem($varId, $to_listId, $to_listName)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function deleteItem($variant_id, $wish_list_id) {
        $forReturn = $this->wishlist_model->deleteItem($variant_id, $wish_list_id);
        if (!$forReturn)
            $this->errors[] = 'Невозможно удалить товар из Списка Желания';
        else
            $this->dataModel = "Операция успешна";

        return $forReturn;
    }

    public function getUserInfo($id) {
        if (!$id)
            $id = $this->dx_auth->get_user_id();

        return $this->wishlist_model->getUserByID($id);
    }

    public function renderUserWL($userId, $access = array('public', 'private', 'shared')) {
        $wishlists = $this->wishlist_model->getUserWishListsByID($userId, $access);
        $userInfo = $this->getUserInfo();
        $w = array();

        foreach ($wishlists as $wishlist)
            $w[$wishlist[wish_list_id]][] = $wishlist;

        $this->dataModel[wishlists] = $w;
        $this->dataModel[user] = $userInfo;

        return TRUE;
    }

    public function renderUserWLEdit($wish_list_id, $userID = null) {
        if ($userID === null)
            $userID = $this->dx_auth->get_user_id();

        if ($wish_list_id) {
            $wishlists = $this->wishlist_model->getUserWishList($userID, $wish_list_id);

            $w = array();
            foreach ($wishlists as $wishlist)
                $w[$wishlist[title]][] = $wishlist;
            $this->dataModel = $w;
            return TRUE;
        }
        return FALSE;
    }

    function do_upload($userID = null) {
        if (!$userID)
            $userID = $this->dx_auth->get_user_id();

        $config['upload_path'] = './uploads/mod_wishlist';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = '100000';
        $config['max_width'] = '10240000';
        $config['max_height'] = '768000';

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload()) {
            $this->errors[] = $this->upload->display_errors();
            return FALSE;
        } else {
            $this->dataModel = array('upload_data' => $this->upload->data());
            $this->db->where('id', $userID)
                    ->update('mod_wish_list_users', array('user_image' => $this->dataModel[upload_data][file_name]));
            return TRUE;
        }
    }

    public function getMostPopularItems($limit = 10) {
        $result = $this->wishlist_model->getMostPopularProducts($limit);
        if ($result) {
            $this->dataModel = $result;
            return TRUE;
        } else {
            $this->error[] = 'Неверний запрос';
            return FALSE;
        }
    }

    public function getUserWishListItemsCount($user_id) {
        return $this->wishlist_model->getUserWishListItemsCount($user_id);
    }

    public function deleteItemByIds($ids) {
        return $this->wishlist_model->deleteItemsByIDs($ids);
    }

    public function deleteImage($image) {
        $basePath = substr(dirname(__FILE__), 0, strpos(dirname(__FILE__), "application"));
        return unlink($basePath . "uploads/mod_wishlist/" . $image);
    }

    public function renderPopup() {
        $wish_lists = $this->wishlist_model->getWishLists();
        if ($this->wishlist_model->getWishLists()) {
            $this->dataModel = $wish_lists;
            return TRUE;
        } else {
            return FALSE;
        }
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