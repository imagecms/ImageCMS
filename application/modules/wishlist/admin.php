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
        $this->load->language('wishlist');
        $this->load->helper('string_helper');
        $this->settings = $this->wishlist_model->getSettings();
    }

    public function index() {
        $wishlist = new \wishlist\classes\ParentWishlist();
        $users = $this->wishlist_model->getAllUsers();
        foreach ($users as $key => $user) {
            $user['lists_count'] = $this->wishlist_model->getUserWishListCount($user['id']);
            $user['items_count'] = $this->wishlist_model->getUserWishListItemsCount($user['id']);
            $users[$key] = $user;
        }

        \CMSFactory\assetManager::create()
                ->setData('settings', $this->wishlist_model->getSettings())
                ->setData('users', $users)
                ->renderAdmin('users');
    }

    public function update_settings() {
        if ($_POST) {
            $this->wishlist_model->setSettings($_POST['settings']);
        }
    }

    public function settings() {
        \CMSFactory\assetManager::create()
                ->setData('settings', $this->wishlist_model->getSettings())
                ->renderAdmin('main');
    }

    public function userWL($id) {
        $wishlist = new Wishlist();
        $this->session->set_userdata(array('admin_edit_user_id' => $id));
        if ($wishlist->getUserWL($id, array('public', 'shared', 'private')))
            \CMSFactory\assetManager::create()
                    ->registerScript('wishlist')
                    ->registerStyle('style')
                    ->setData('wishlists', $wishlist->dataModel['wishlists'])
                    ->setData('user', $wishlist->dataModel['user'])
                    ->setData('settings', $wishlist->settings)
                    ->renderAdmin('wishlist');
    }

    public function editWL($wish_list_id, $userID) {
        $wishlist = new Wishlist();
        if ($wishlist->renderUserWLEdit($wish_list_id, $userID)) {
            $user_id = $this->session->userdata('admin_edit_user_id');
            \CMSFactory\assetManager::create()
                    ->registerScript('wishlist')
                    ->registerStyle('style')
                    ->setData('wishlists', $wishlist->dataModel)
                    ->setData('user_id', $user_id)
                    ->renderAdmin('wishlistEdit');
        }
        else
            redirect($_SERVER['HTTP_REFERER']);
    }

    public function deleteWL($wish_list_id) {
        $wishlist = new \wishlist\classes\ParentWishlist();
        $wishlist->deleteWL($wish_list_id);

        if (!strstr($this->uri->uri_string(), 'editWL')) {
            $user_id = $this->session->userdata('admin_edit_user_id');
            redirect('/admin/components/cp/wishlist/userWL/' . $user_id . '#lists');
        } else {
            redirect($_SERVER['HTTP_REFERER'] . "#lists");
        }
    }

    public function updateWL() {
        $wishlist = new \wishlist\classes\BaseWishlist();
        $wishlist->updateWL();

        redirect($_SERVER['HTTP_REFERER']);
    }

    public function userUpdate() {
        $wishlist = new \wishlist\classes\BaseWishlist();
        $wishlist->userUpdate();

        redirect($_SERVER['HTTP_REFERER']);
    }

    public function createWishList() {
        $wishlist = new \wishlist\classes\BaseWishlist();
        $wishlist->createWishList();

        redirect($_SERVER['HTTP_REFERER'] . "#lists");
    }

    public function do_upload() {
        $wishlist = new \wishlist\classes\BaseWishlist();
        $wishlist->do_upload();

        redirect($_SERVER['HTTP_REFERER']);
    }

    public function renderPopup($varId, $wish_list_id, $user_id) {
        $wish_lists = $this->wishlist_model->getWishLists($user_id);
        $data = array('wish_lists' => $wish_lists);

        return $popup = \CMSFactory\assetManager::create()
                ->registerStyle('style')
                ->setData('class', 'btn')
                ->setData('wish_list_id', $wish_list_id)
                ->setData('varId', $varId)
                ->setData('user_id', $user_id)
                ->setData($data)
                ->setData('max_lists_count', $this->settings['maxListsCount'])
                ->renderAdmin('wishPopup');
    }

    public function moveItem($varId, $wish_list_id){
        $wishlist = new \wishlist\classes\BaseWishlist();
        $wishlist->moveItem($varId, $wish_list_id);
        $user_id = $this->session->userdata('admin_edit_user_id');

        redirect('/admin/components/cp/wishlist/userWL/' . $user_id . '#lists');
    }

    public function deleteImage(){
        $wishlist = new \wishlist\classes\BaseWishlist();
        $wishlist->deleteImage();

        redirect($_SERVER['HTTP_REFERER']);
    }
}