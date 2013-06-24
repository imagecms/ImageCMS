<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 * Module Wishlist
 * @property wishlist_model $wishlist_model
 */
class Wishlist extends \wishlist\classes\BaseWishlist {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));    
    }

    function index() {
        if (parent::renderUserWL($this->dx_auth->get_user_id())) {
            \CMSFactory\assetManager::create()
                    ->registerScript('wishlist')
                    ->registerStyle('style')
                    ->setData('wishlists', $this->dataModel[wishlists])
                    ->setData('user', $this->dataModel[user])
                    ->setData('settings', $this->settings)
                    ->render('wishlist');
        }
    }

    public function addItem($varId) {
        parent::addItem($varId);
        if ($this->dataModel) {
            redirect($this->input->cookie('url'));
        } else {
            \CMSFactory\assetManager::create()
                    ->registerScript('wishlist')
                    ->setData('errors', $this->errors)
                    ->render('errors');
        }
    }

    public function moveItem($varId, $wish_list_id) {
        parent::deleteItem($varId, $wish_list_id, false);
        if (parent::addItem($varId)) {
            redirect('/wishlist');
        } else {
            \CMSFactory\assetManager::create()
                    ->setData('errors', $this->errors)
                    ->render('errors');
        }
    }

    public function all() {
        $lists = parent::all();
        if ($this->dataModel) {
            \CMSFactory\assetManager::create()
                    ->setData('lists', $lists)
                    ->setData('settings', $this->settings)
                    ->render('all');
        } else {
            \CMSFactory\assetManager::create()
                    ->setData('lists', $this->errors)
                    ->setData('lists', $lists)
                    ->setData('settings', $this->settings)
                    ->render('all');
        }
    }
    

    public function show($user_id, $list_id) {       
        if (parent::show($user_id, $list_id)) {
            \CMSFactory\assetManager::create()
                    ->setData('wishlist', $this->dataModel)
                    ->render('other_list');
        } else {
            \CMSFactory\assetManager::create()
                    ->setData('wishlist', 'empty')
                    ->render('other_list');
        }
    }
    
    public function addReview($list_id){
        parent::addReview($list_id);
        if($this->dataModel){
            return $this->dataModel;
        }else{
            return $this->errors;
        }       
    }
    
    public function getMostViewedWishLists($limit=10){
        parent::getMostViewedWishLists($limit);
        if($this->dataModel){
            return $this->dataModel;
        }else{
            return $this->errors;
        }
    }
    

    public function user($user_id) {
        $user_wish_lists = parent::user($user_id);
        \CMSFactory\assetManager::create()
                ->setData('wishlists', $user_wish_lists)
                ->render('other_wishlist');
    }

    public function userUpdate() {
        parent::userUpdate();
        redirect('/wishlist');
    }

    public function getMostPopularItems($limit= 10){
       parent::getMostPopularItems($limit);
       if($this->dataModel){
           var_dumps($this->dataModel);
        }else{
            return $this->errors;
        }
    }
    
    public function createWishList(){
        parent::createWishList();
        if($this->dataModel){
            return $this->dataModel;
        }else{
            return $this->errors;
        }      
    }

    public function renderWLButton($varId) {
        if (!in_array($varId, $this->userWishProducts))
            \CMSFactory\assetManager::create()
                    ->registerScript('wishlist')
                    ->setData('data', $data)
                    ->setData('varId', $varId)
                    ->setData('value', 'Добавить в Список Желания')
                    ->setData('class', 'btn')
                    ->setData('max_lists_count', $this->settings['maxListsCount'])
                    ->render('button', true);
        else
            \CMSFactory\assetManager::create()
                    ->registerScript('wishlist')
                    ->setData('data', $data)
                    ->setData('varId', $varId)
                    ->setData('value', 'Уже в Списке Желания')
                    ->setData('max_lists_count', $this->settings['maxListsCount'])
                    ->setData('class', 'btn inWL')
                    ->render('button', true);
    }

    public function renderPopup($varId, $wish_list_id = '') {
        $wish_lists = $this->wishlist_model->getWishLists();
        $data = array('wish_lists' => $wish_lists);

        return $popup = \CMSFactory\assetManager::create()
                ->registerStyle('style')
                ->setData('class', 'btn')
                ->setData('wish_list_id', $wish_list_id)
                ->setData('varId', $varId)
                ->setData($data)
                ->setData('max_lists_count', $this->settings['maxListsCount'])
                ->render('wishPopup');
    }

    public function editWL($wish_list_id) {
        if (parent::renderUserWLEdit($wish_list_id))
            \CMSFactory\assetManager::create()
                    ->registerScript('wishlist')
                    ->registerStyle('style')
                    ->setData('wishlists', $this->dataModel)
                    ->render('wishlistEdit');
        else
            redirect('/wishlist');
    }

    public function updateWL() {
        parent::updateWL();
        redirect('/wishlist');
    }

}

/* End of file wishlist.php */
