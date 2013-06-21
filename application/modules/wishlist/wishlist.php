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
        $w = parent::renderUserWL($this->dx_auth->get_user_id());
        \CMSFactory\assetManager::create()
                ->registerScript('wishlist')
                ->registerStyle('style')
                ->setData('wishlists', $w)
                ->render('wishlist');
    }

    public function addItem($varId) {
        if (parent::addItem($varId)) {
            redirect($this->input->cookie('url'));
        } else {
            \CMSFactory\assetManager::create()
                    ->registerScript('wishlist')
                    ->setData('errors', $this->errors)
                    ->render('errors');
        }
    }

    public function all() {
        $lists = parent::all();
        if ($lists) {
            \CMSFactory\assetManager::create()
                    ->registerStyle('style')
                    ->setData('lists', $lists)
                    ->render('all');
        } else {
            \CMSFactory\assetManager::create()
                    ->registerStyle('style')
                    ->setData('lists', $lists)
                    ->render('all');
        }
    }

    public function show($user_id, $list_id) {
        if (parent::show($user_id, $list_id)) {
            \CMSFactory\assetManager::create()
                    ->setData('wishlist', $this->dataModel)
                    ->render('list');
        }
    }

    public function user($user_id) {
        $user_wish_lists = parent::user($user_id);
        \CMSFactory\assetManager::create()
                ->registerScript('wishlist')
                ->registerStyle('style')
                ->setData('wishlists', $user_wish_lists)
                ->render('wishlist');
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

    public function renderPopup($varId) {
        $wish_lists = $this->wishlist_model->getWishLists();
        $data = array('wish_lists' => $wish_lists);

        return $popup = \CMSFactory\assetManager::create()
                ->registerStyle('style')
                ->setData('value', 'Добавить в Список Желания')
                ->setData('class', 'btn')
                ->setData('varId', $varId)
                ->setData($data)
                ->setData('max_lists_count', $this->settings['maxListsCount'])
                ->render('wishPopup');
    }

    public function editWL($wish_list_id) {
        if (parent::editWL($wish_list_id))
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
