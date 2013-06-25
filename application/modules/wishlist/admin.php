<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 * Sample Module Admin
 * @property wishlist_model $wishlist_model
 */
class Admin extends BaseAdminController {

    public function __construct() {
        parent::__construct();
        $this->load->model('wishlist_model');
        $this->settings = $this->wishlist_model->getSettings();
    }

    public function index() {
        \CMSFactory\assetManager::create()
                ->setData('settings', $this->wishlist_model->getSettings())
                ->setData('users', $this->wishlist_model->getAllUsers())
                ->renderAdmin('users');
    }

    public function update_settings() {
        if ($_POST) {
            $this->wishlist_model->setSettings($_POST[settings]);
        }
    }

    public function settings() {
        \CMSFactory\assetManager::create()
                ->setData('settings', $this->wishlist_model->getSettings())
                ->renderAdmin('main');
    }

    public function userWL($id) {
        $wishlist = new Wishlist();
        if ($wishlist->renderUserWL($id, array('public', 'shared', 'private')))
            \CMSFactory\assetManager::create()
                    ->registerScript('wishlist')
                    ->registerStyle('style')
                    ->setData('wishlists', $wishlist->dataModel[wishlists])
                    ->setData('user', $wishlist->dataModel[user])
                    ->setData('settings', $wishlist->settings)
                    ->renderAdmin('wishlist');
    }

    public function editWL($wish_list_id, $userID) {
        $wishlist = new Wishlist();
        if ($wishlist->renderUserWLEdit($wish_list_id, $userID)) {
            \CMSFactory\assetManager::create()
                    ->registerScript('wishlist')
                    ->registerStyle('style')
                    ->setData('wishlists', $wishlist->dataModel)
                    ->renderAdmin('wishlistEdit');
        }
        else
            redirect('/wishlist');
    }

    public function deleteWL($wish_list_id) {
        $wishlist = new Wishlist();
        $wishlist->deleteWL($wish_list_id);
        redirect('/wishlist');
    }

}