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
        $this->deleteItem($varId, $wish_list_id, false);
        if ($this->addItem($varId)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function deleteItem($variant_id, $wish_list_id) {
        if(parent::deleteItem($variant_id, $wish_list_id)){
            return $this->dataModel;
        }else{
            return $this->errors;
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
