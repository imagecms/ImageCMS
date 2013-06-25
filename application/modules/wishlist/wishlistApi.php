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
        $lists = parent::all();
        if ($this->dataModel) {
            return \CMSFactory\assetManager::create()
                    ->setData('lists', $lists)
                    ->setData('settings', $this->settings)
                    ->fetchTemplate('all');
        } else {
            return \CMSFactory\assetManager::create()
                    ->setData('lists', $this->errors)
                    ->setData('lists', $lists)
                    ->setData('settings', $this->settings)
                    ->fetchTemplate('all');
        }
    }
    
    public function addItem($varId) {
        parent::addItem($varId);
        if ($this->dataModel) {
            return $this->return_success($this->dataModel);
        } else {
            return $this->return_success($this->errors);
        }
    }
    
    public function moveItem($varId, $wish_list_id) {
        parent::moveItem($varId, $wish_list_id);
        if ($this->dataModel) {
            return $this->return_success($this->dataModel);
        } else {
            return $this->return_success($this->errors);
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
    
     public function show($user_id, $list_id) {
        if (parent::show($user_id, $list_id)) {
            return \CMSFactory\assetManager::create()
                        ->setData('wishlist', $this->dataModel)
                        ->fetchTemplate('other_list');
        } else {
            return \CMSFactory\assetManager::create()
                        ->setData('wishlist', 'empty')
                        ->fetchTemplate('other_list');
        }
    }
    
    public function getMostViewedWishLists($limit=10){
        parent::getMostViewedWishLists($limit);
        if($this->dataModel){
            return $this->return_success($this->dataModel);
        }else{
            return $this->errors;
        }
    }
    
    public function user($user_id) {
        $user_wish_lists = parent::user($user_id);
        if($user_wish_lists){
            return \CMSFactory\assetManager::create()
                ->setData('wishlists', $user_wish_lists)
                ->fetchTemplate('other_wishlist');
        }else{
            
        }
        
    }


    public function renderPopup($varId, $wish_list_id = '') {
        parent::renderPopup();
        if($this->dataModel){
            return $popup = \CMSFactory\assetManager::create()
                ->registerStyle('style')
                ->setData('class', 'btn')
                ->setData('wish_list_id', $wish_list_id)
                ->setData('varId', $varId)
                ->setData('wish_lists', $this->dataModel)
                ->setData('max_lists_count', $this->settings['maxListsCount'])
                ->fetchTemplate('wishPopup');
        }else{
             return $popup = \CMSFactory\assetManager::create()
                ->registerStyle('style')
                ->setData('class', 'btn')
                ->setData('wish_list_id', $wish_list_id)
                ->setData('varId', $varId)
                ->setData('errors', $this->errors)
                ->setData('max_lists_count', $this->settings['maxListsCount'])
                ->fetchTemplate('wishPopup');
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
