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

    public function all() {
        parent::all();
        $data['settings'] =  $this->settings;

        if ($this->dataModel) {
             $data['data'] = $this->dataModel;
             $data['answer'] = 'success';
        } else {
             $data['errors'] = $this->errors;
             $data['answer'] = 'error';
        }
        return json_encode($data);
    }

    public function _addItem($varId) {
        parent::addItem($varId);
        return $this->return_json();
    }

    public function moveItem($varId, $wish_list_id) {
        parent::moveItem($varId, $wish_list_id);
        return $this->return_json();
    }

    public function deleteItem($variant_id, $wish_list_id) {
        parent::deleteItem($variant_id, $wish_list_id);
        return $this->return_json();
    }

     public function show($user_id, $list_id) {
         parent::show($user_id, $list_id);
         return $this->return_json();
    }

    public function getMostViewedWishLists($limit=10){
        parent::getMostViewedWishLists($limit);
        return $this->return_json();
    }

    public function user($user_id) {
        parent::user($user_id);
        return $this->return_json();
    }

    public function userUpdate() {
        parent::userUpdate();
        return $this->return_json();
    }

    public function getMostPopularItems($limit = 10) {
        parent::getMostPopularItems($limit);
        return $this->return_json();
    }

     public function createWishList(){
        parent::createWishList();
        return $this->return_json();
    }

    public function updateWL() {
        parent::updateWL();
    }

    public function deleteWL($wish_list_id) {
       parent::deleteWL($wish_list_id);
       return $this->return_json();
    }

    public function deleteImage(){
        parent::deleteImage();
        return $this->return_json();
    }

    public function renderWLButton($varId) {
        if($this->dx_auth->is_logged_in()){
            $data['href'] = '/wishlist/renderPopup/' . $varId;
        }else{
            $data['href'] = '/auth/login';
        }

        if (!in_array($varId, $this->userWishProducts)){
            $data['varId'] = $varId;
            $data['value'] = lang(btn_add_2_WL);
            $data['max_lists_count'] = $this->settings['maxListsCount'];
            $data['class'] = 'btn';
        }else{
            $data['varId'] = $varId;
            $data['value'] = lang(btn_already_in_WL);
            $data['max_lists_count'] = $this->settings['maxListsCount'];
            $data['class'] = 'btn inWL';
        }
        return json_encode($data);
    }


    public function renderPopup($varId, $wish_list_id = '') {
        parent::renderPopup();
        $data['varId'] = $varId;
        $data['wish_list_id'] = $wish_list_id;
        $data['max_lists_count'] = $this->settings['maxListsCount'];
        $data['class'] = 'btn';
        if($this->dataModel){
            $data['wish_lists'] = $this->dataModel;
            $data['answer'] = 'success';
        }else{
            $data['errors'] = $this->errors;
            $data['answer'] = 'error';
        }
        return json_encode($data);
    }

    public function editWL($wish_list_id) {
        if (parent::renderUserWLEdit($wish_list_id)){
            $data['wishlists'] = $this->dataModel;
            $data['answer'] = 'success';
            return json_encode($data);
        }
    }


    public function do_upload() {
        parent::do_upload();
        return $this->return_json();
    }


    private function return_json(){
        $data = array();
        if($this->dataModel){
            $data= array(
                'answer' => 'success',
                'data' => $this->dataModel
            );
        }  else {
            if($this->errors){
                 $data= array(
                    'answer' => 'error',
                    'data' => $this->errors
                );
            }
        }
        return json_encode($data);
    }

}

/* End of file api.php */
