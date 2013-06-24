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
    
    public function renderPopup(){
         if(parent::renderPopup()){
             return $this->dataModel;
         }else{
             return $this->errors;
         }        
    }

}
