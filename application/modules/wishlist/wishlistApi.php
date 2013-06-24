<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 * Module Wishlist
 * @property wishlist_model $wishlist_model
 */
class WishlistApi extends \wishlist\classes\BaseApi {

    public function __construct() {
        parent::__construct();
    }

    public function renderPopup($varId, $wish_list_id = '') {
        parent::renderPopup();
        if($this->dataModel){
             $data = array(
                 'answer' => 'success',
                 'wish_lists' => $this->dataModel, 
                 'class' => 'btn',
                 'wish_list_id' => $wish_list_id,
                 'varId' => $varId,
                 'max_lists_count' => $this->settings['maxListsCount']
                    
             );
             return json_encode($data);
        }else{
            $data = array('answer' => 'error');
            return json_encode($data);
        }       
    }
}

/* End of file api.php */
