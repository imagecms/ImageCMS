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
            return false;
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
            return false;
        }
    }

    
    public function renderPopup(){
         if(parent::renderPopup()){
             return $this->dataModel;
         }else{
             return $this->errors;
         }        
    }

}
