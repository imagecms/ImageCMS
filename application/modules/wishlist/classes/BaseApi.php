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
class BaseApi extends \wishlist\classes\ParentWishlist {

    public function __construct() {
        parent::__construct();
    }
    
    public function all() {
        $parent = parent::all();
        if ($parent) {
            return $this->dataModel;
        } else {
            return $this->errors;
        }
    }
    
    public function addItem($varId) {
        $listId = $this->input->post('wishlist');
        $listName = $this->input->post('wishListName');

        if (parent::addItem($varId, $listId, $listName)) {
            return $this->dataModel;
        } else {
            return $this->errors;
        }
    }
    
    public function moveItem($varId, $wish_list_id) {
        $to_listId = $this->input->post('wishlist');
        $to_listName = $this->input->post('wishListName');
        
        if (parent::moveItem($varId, $wish_list_id, $to_listId, $to_listName)) {
            return $this->dataModel = "Операция успешна";
        } else {
            return $this->errors[] = "Не удалось переместить";
        }
    }
    
    public function deleteItem($variant_id, $wish_list_id) {
        if(parent::deleteItem($variant_id, $wish_list_id)){
            return $this->dataModel;
        }else{
            return $this->errors;
        }        
    }
    
    public function show($user_id, $list_id) {
        if (parent::show($user_id, $list_id)) {
            return $this->dataModel;
        } else {
            return $this->errors;
        }
    }
    
    public function getMostViewedWishLists($limit = 10) {
        if (parent::getMostViewedWishLists($limit)) {
            return $this->dataModel;
        } else {
            return $this->errors;
        }
    }
    
    public function user($user_id) {
        if (parent::user($user_id)) {
            return $this->dataModel;
        } else {
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
        if ($updated) {
            return $this->dataModel = "Обновлено";
        } else {
            return $this->errors = "Не обновлено";
        }
    }
    
     public function getMostPopularItems($limit = 10) {
        if (parent::getMostPopularItems($limit)) {
            return $this->dataModel;
        } else {
            return $this->errors;
        }
    }
    
    
    public function createWishList() {
        $listName = $this->input->post('wishListName');
        $user_id = $this->input->post('user_id');

        if (parent::createWishList($user_id, $listName)) {
            return $this->dataModel = "Создано";
        } else {
            return $this->errors;
        }
    }
    
    public function deleteWL($wish_list_id) {
        if(parent::deleteWL($wish_list_id)){
            return $this->dataModel;
        }else{
            return $this->errors;
        }
    }
    
    
    public function updateWL() {
        $id = $this->input->post(WLID);

        foreach ($this->input->post(comment) as $key => $comment) {
            if ($this->settings[maxCommentLenght] < iconv_strlen($comment, 'UTF-8'))
                $desc[$key] = substr($comment, 0, $this->settings[maxDescLenght]);
            else
                $desc[$key] = $comment;
        }

        if ($this->settings[maxListName] < iconv_strlen($this->input->post(title), 'UTF-8'))
            $title = substr($this->input->post(title), 0, $this->settings[maxListName]);
        else
            $title = $this->input->post(title);

        $data = array(
            'access' => $this->input->post(access),
            'title' => $title,
        );

        parent::updateWL($id, $data, $desc, $title);
    }


    
    public function renderPopup(){
         if(parent::renderPopup()){
             return $this->dataModel;
         }else{
             return $this->errors;
         }        
    }

}
