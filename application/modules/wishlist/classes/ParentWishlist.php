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
        \CMSFactory\Events::create()->on('WishList:onShow')->setListener('addReview');

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
            $this->errors[] = 'Нет списков';
            return false;
        }
    }

    public function show($user_id, $list_id) {
        $wishlist = $this->wishlist_model->getUserWishList($user_id, $list_id);

        if ($wishlist) {
            \CMSFactory\Events::create()->registerEvent($list_id, 'WishList:onShow');
            \CMSFactory\Events::runFactory();
            $this->dataModel = $wishlist;

            return true;
        } else {
            return false;
        }
    }

    public function addReview($list_id){
        $sessID = $this->session->userdata('regenerated');
        if(!$this->input->cookie('wishListViewer')){
            if($this->wishlist_model->addRewiew($list_id)){
                $cookie = array(
                    'name' => 'wishListViewer',
                    'value' => $sessID,
                    'expire' => 60*60*24,
                    'prefix' => ''
                );
                $this->input->set_cookie($cookie);
                return TRUE;
            }
        }
        return FALSE;

    }

    public function getMostViewedWishLists($limit=10){
        $views = $this->wishlist_model->getMostViewedWishLists($limit);
        if($views){
            $this->dataModel = $views;
            return TRUE;
        }else{
            $this->errors[] = "Нет просмотров";
            return FALSE;
        }
    }

    public function user($user_id) {
        if ($this->renderUserWL($user_id, $access = array('public'))) {
            $this->dataModel = $this->dataModel[wishlists];
            return true;
        } else {
            return false;
        }
    }

    public function userUpdate($userID, $user_name, $user_birthday, $description) {
        $this->wishlist_model->createUserIfNotExist($this->dx_auth->get_user_id());
        if(!$userID){
            $userID = $this->dx_auth->get_user_id();
        }
        if($this->wishlist_model->updateUser($userID, $user_name, $user_birthday, $description)){
            return TRUE;
        }else{
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

    public function createWishList($user_id, $listName){
        if (strlen($listName) > $this->settings['maxListName']) {
            $listName = substr($listName, 0, (int) $this->settings['maxListName']);
            $this->errors[] = 'Поле имя будет изменено до длини ' . $this->settings['maxListName'] . ' символов </br>';
        }

        $this->wishlist_model->createWishList($listName, $user_id);

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

        return $forReturn;
    }

    /**
     * add item to wish list
     *
     * @return boolean
     */
    public function addItem($varId, $listId, $listName) {
        $count_lists = 0;
        if (!$this->dx_auth->is_logged_in()) {
            $this->errors[] = 'Пользователь не залогинен';
            return FALSE;
        }

        if (strlen($listName) > $this->settings['maxListName']) {
            $listName = substr($listName, 0, (int) $this->settings['maxListName']);
            $this->errors[] = 'Поле имя будет изменено до длини ' . $this->settings['maxListName'] . ' символов </br>';
        }

        if ($listName)
            $count_lists = $this->wishlist_model->getUserWishListCount();

        if ($count_lists >= $this->settings['maxListsCount']) {
            $this->errors[] = 'Лимит списков равен ' . $this->settings['maxListsCount'] . ' исчерпан </br>';
            return FALSE;
        }
        else
            $this->wishlist_model->addItem($varId, $listId, $listName);

        if (count($this->errors))
            return FALSE;
        else {
            $this->dataModel = "Добавлено";
            return TRUE;
        }
    }

    public function deleteItem($variant_id, $wish_list_id) {
        $forReturn = $this->wishlist_model->deleteItem($variant_id, $wish_list_id);
        if (!$forReturn)
            $this->errors[] = 'Невозможно удалить товар из Списка Желания';

        return $forReturn;
    }

    public function moveItem($varId, $wish_list_id) {
        $this->deleteItem($varId, $wish_list_id, false);
        if ($this->addItem($varId)) {
            return TRUE;
        } else {
            return FALSE;
        }
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
            $w[$wishlist[title]][] = $wishlist;
        $this->dataModel[wishlists] = $w;
        $this->dataModel[user] = $userInfo;

        return true;
    }

    public function renderUserWLEdit($wish_list_id) {
        if ($wish_list_id) {
            $wishlists = $this->wishlist_model->getUserWishList($this->dx_auth->get_user_id(), $wish_list_id);

            $w = array();
            foreach ($wishlists as $wishlist)
                $w[$wishlist[title]][] = $wishlist;
            $this->dataModel = $w;
            return TRUE;
        }
        return FALSE;
    }

    function do_upload() {
        $config['upload_path'] = './uploads/mod_wishlist';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '100000';
        $config['max_width'] = '10240000';
        $config['max_height'] = '768000';

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload()) {
            $this->errors[] = $this->upload->display_errors();
            return FALSE;
        } else {
            $this->dataModel = array('upload_data' => $this->upload->data());
            $this->db
                    ->where('id', $this->dx_auth->get_user_id())
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
    public function getUserWishListItemsCount($user_id){
        echo $this->wishlist_model->getUserWishListCount(47);
    }

    public function deleteItemByIds($ids) {
        return $this->wishlist_model->deleteItemsByIDs($ids);
    }

    public function renderPopup(){
        $wish_lists = $this->wishlist_model->getWishLists();
        if($this->wishlist_model->getWishLists()){
            $this->dataModel = $wish_lists;
            return TRUE;
        }else{
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