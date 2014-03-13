<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 * WishList Module Admin
 * @property wishlist_model $wishlist_model
 */
class Admin extends BaseAdminController {

    public function __construct() {
        parent::__construct();
        $this->load->model('wishlist_model');
        $this->load->language('wishlist');
        $this->load->helper('string_helper');
        $this->settings = $this->wishlist_model->getSettings();

        $lang = new MY_Lang();
        $lang->load('wishlist');
    }

    /**
     * render wadmin start page
     */
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

    /**
     * updare settings for wish lists
     */
    public function update_settings() {
        if ($_POST) {
            $this->wishlist_model->setSettings($_POST['settings']);
        }
    }

    /**
     * render settings page for wishlist
     */
    public function settings() {
        \CMSFactory\assetManager::create()
                ->setData('settings', $this->wishlist_model->getSettings())
                ->renderAdmin('main');
    }

    /**
     * render user wish list
     *
     * @param type $id
     */
    public function userWL($id) {
        $wishlist = new Wishlist();
        $this->session->set_userdata(array('admin_edit_user_id' => $id));
        
        $wishlist->getUserWL($id, array('public', 'shared', 'private'));
        \CMSFactory\assetManager::create()
                ->registerScript('wishlist')
                ->registerStyle('style')
                ->setData('wishlists', $wishlist->dataModel['wishlists'])
                ->setData('user', $wishlist->dataModel['user'])
                ->setData('settings', $wishlist->settings)
                ->setData('errors', $this->errors)
                ->setData('upload_errors', $this->session->flashdata('upload_errors'))
                ->setData('userId', $id)
                ->renderAdmin('wishlist');
    }

    /**
     * render user edit list page
     *
     * @param type $wish_list_id
     * @param type $userID
     */
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

    /**
     * delete list by list id
     *
     * @param type $wish_list_id
     */
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

    /**
     * update wish list
     */
    public function updateWL() {
        $wishlist = new \wishlist\classes\BaseWishlist();
        $wishlist->updateWL();

        redirect($_SERVER['HTTP_REFERER']);
    }

    /**
     * user information update
     */
    public function userUpdate() {
        $wishlist = new \wishlist\classes\BaseWishlist();
        $wishlist->userUpdate();

        redirect($_SERVER['HTTP_REFERER']);
    }

    /**
     * create wish list
     */
    public function createWishList() {
        $wishlist = new \wishlist\classes\BaseWishlist();
        $result = $wishlist->createWishList();
        $response = array('status' => 0);
        if (is_array($result)) {
            $response['errors'] = $result;
        } else {
            $response['status'] = 1;
        }
        echo json_encode($response);
    }

    /**
     * upload image
     */
    public function do_upload() {
        $wishlist = new \wishlist\classes\BaseWishlist();
        $wishlist->do_upload();
//        var_dumps_exit($wishlist->errors);
        if($wishlist->errors){
            $this->session->set_flashdata('upload_errors', $wishlist->errors);
        }
        redirect($_SERVER['HTTP_REFERER']);
    }

    /**
     * render add and move item popup
     *
     * @param type $varId
     * @param type $wish_list_id
     * @param type $user_id
     * @return type
     */
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

    /**
     * delete item from wish list
     *
     * @param type $varId
     * @param type $wish_list_id
     */
    public function deleteItem($varId, $wish_list_id) {
        $wishlist = new \wishlist\classes\BaseWishlist();
        $wishlist->deleteItem($varId, $wish_list_id);

        redirect($_SERVER['HTTP_REFERER'] . '#lists');
    }

    /**
     * move item to wish list
     *
     * @param type $varId - current item  variant id
     * @param type $wish_list_id - current item  list id
     */
    public function moveItem($varId, $wish_list_id) {
        $wishlist = new \wishlist\classes\BaseWishlist();
        $wishlist->moveItem($varId, $wish_list_id);
        $user_id = $this->session->userdata('admin_edit_user_id');

        redirect('/admin/components/cp/wishlist/userWL/' . $user_id . '#lists');
    }

    /**
     * delete user image
     */
    public function deleteImage() {
        $wishlist = new \wishlist\classes\BaseWishlist();
        $wishlist->deleteImage();

        redirect($_SERVER['HTTP_REFERER']);
    }

    public function delete_user() {
        foreach ($_POST['ids'] as $id)
            $this->wishlist_model->delUser($id);
    }

}
