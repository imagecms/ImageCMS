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
    
    public function addItem($varId) {
        parent::addItem($varId);
        if ($this->dataModel) {
            return json_encode(
                        array(
                            'answer' => 'success',
                            'data' => $this->dataModel
                        )
                    );
        } else {
            return json_encode(
                        array(
                            'answer' => 'error',
                            'data' => $this->errors
                        )
                    );
        }
    }
    
    public function moveItem($varId, $wish_list_id) {
        parent::moveItem($varId, $wish_list_id);
        if ($this->dataModel) {
             return json_encode(
                        array(
                            'answer' => 'success',
                            'data' => $this->dataModel
                        )
                    );
        } else {
             return json_encode(
                        array(
                            'answer' => 'error',
                            'data' => $this->errors
                        )
                    );
        }
    }
    
    public function deleteItem($variant_id, $wish_list_id) {
        parent::deleteItem($variant_id, $wish_list_id);
        if($this->dataModel){
             return $this->return_success($this->dataModel);
        }else{
            return $this->return_success($this->errors);
        }        
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
             return $this->return_success($data);
        }else{
            return $this->return_error(array('data' => $this->errors));
        }       
    }
    
    private function return_success($data = ""){
        return json_encode(
                    array(
                        'answer' => 'success',
                        'data' => $data
                    )
                );
    }
    
    private function return_error($data = ""){
        return json_encode(
                   array(
                        'answer' => 'error', 
                        'data' => $data
                   )
               );
    }
    
    
}

/* End of file api.php */
