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
class BaseWishlist extends \wishlist\classes\ParentWishlist {

    public function __construct() {
        parent::__construct();
    }

    private function checkPerm() {
        $permAllow = TRUE;
        if (!$this->dx_auth->is_logged_in())
            $permAllow = FALSE;

        return $permAllow;
    }

    public function all() {
        $parent = parent::all();
        if ($parent) {
            return $this->dataModel;
        } else {
            return $this->errors;
        }
    }

    public function addItem($varId, $listId, $listName) {
        $listId = $this->input->post('wishlist');
        $listName = $this->input->post('wishListName');
        
        if (parent::addItem($varId, $listId, $listName)) {
            return $this->dataModel;
        } else {
            return $this->errors;
        }
    }

    public function show($user_id, $list_id) {
        if (parent::show($user_id, $list_id)) {
            return $this->dataModel;
        } else {
            return false;
        }
    }
    
    public function addReview($list_id){
        if(parent::addReview($list_id)){
            return $this->dataModel = "Увеличено";
        }else{
            return $this->errors[] = "Невозможно увеличить";
        }
       
    }
    
    public function getMostViewedWishLists($limit=10){
        if(parent::getMostViewedWishLists($limit)){
            return $this->dataModel;
        }else{
            return $this->errors;
        }
    }

    public function user($user_id) {
        if (parent::user($user_id)) {
            return $this->dataModel;
        } else {
            return false;
        }
    }

    public function getMostPopularItems($limit = 10) {
        if (parent::getMostPopularItems($limit)) {
            return $this->dataModel;
        } else {
            return $this->errors;
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
        parent::createWL($title, $access, $description, $user_id, $user_image, $user_birthday);
    }
    
    public function createWishList(){
        $listName = $this->input->post('wishListName');
        $user_id = $this->input->post('user_id');        
        
        if(parent::createWishList($user_id, $listName)){
            return $this->dataModel = "Создано";
        }else{
            return $this->errors;
        }      
    }

    public function userUpdate() {        
        
        if ($this->settings[maxDescLenght] < iconv_strlen($this->input->post(description), 'UTF-8'))
            $desc = substr($this->input->post(description), 0, $this->settings[maxDescLenght]);
        else
            $desc = $this->input->post(description);

        if (!(strtotime($this->input->post(user_birthday)) + 50000))
            return false;

        $updated = parent::userUpdate($this->input->post(user_id), $this->input->post(user_name), strtotime($this->input->post(user_birthday)) + 50000, $desc);
        if($updated){
            return $this->dataModel = "Обновлено";
        }else{
            return $this->errors = "Не обновлено";
        }
    }

    public function updateWL() {
        $id = $this->input->post(WLID);
        $data = array('access' => $this->input->post(access));        
        $comments = $this->input->post(comment);
        parent::updateWL($id, $data, $comments);
    }

    /**
     * delete full WL
     */
    public function deleteWL($wish_list_id) {
        parent::deleteWL($wish_list_id);
        redirect('/wishlist');
    }

    public function deleteItem($variant_id, $wish_list_id, $redirect = 'true') {
        parent::deleteItem($variant_id, $wish_list_id);
        if ($redirect) {
            redirect('/wishlist');
        }
    }
    
     public function moveItem($varId, $wish_list_id) {
         if(parent::moveItem($varId, $wish_list_id)){
             return $this->dataModel = "Операция успешна";
         }else{
             return $this->errors[] = "Не удалось переместить";
         }       
    }

  
    public function autoload() {

    }

    public static function adminAutoload() {
        parent::adminAutoload();
    }

    public function _install() {
        parent::_install();
    }

    public function _deinstall() {
        parent::_deinstall();
    }

    function do_upload() {
        if (parent::do_upload()) {
            redirect('/wishlist');
        }
    }

}