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
        if ($this->input->post()) {
            $this->wishlist_model->setSettings($this->input->post('settings'));
            $this->lib_admin->log(lang("Wishlists settings was edited", "wishlist"));
            showMessage(lang("Wishlists settings was edited", "wishlist"));
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
        $wishlist = \CI::$APP->load->module('wishlist');
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
        } else {
            redirect($this->input->server('HTTP_REFERER'));
        }
    }

    /**
     * delete list by list id
     *
     * @param type $wish_list_id
     */
    public function deleteWL($wish_list_id) {
        $wishlist = new \wishlist\classes\ParentWishlist();
        $wishlist->deleteWL($wish_list_id);

        $this->lib_admin->log(lang("Wish list deleted.", "wishlist") . ' ID: ' . $wish_list_id);
        if (!strstr($this->uri->uri_string(), 'editWL')) {
            $user_id = $this->session->userdata('admin_edit_user_id');
            redirect('/admin/components/cp/wishlist/userWL/' . $user_id . '#lists');
        } else {
            redirect($this->input->server('HTTP_REFERER') . "#lists");
        }
    }

    /**
     * update wish list
     */
    public function updateWL() {
        $wishlist = new \wishlist\classes\BaseWishlist();
        $wishlist->updateWL();

        $this->lib_admin->log(lang("User wish list edited.", "wishlist"));
        showMessage(lang('Changes have been saved', 'wishlist'));
    }

    /**
     * user information update
     */
    public function userUpdate() {
        $wishlist = new \wishlist\classes\BaseWishlist();
        $wishlist->userUpdate();

        redirect($this->input->server('HTTP_REFERER'));
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
        if ($wishlist->errors) {
            $this->session->set_flashdata('upload_errors', $wishlist->errors);
        }
        redirect($this->input->server('HTTP_REFERER'));
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

        $variant = SProductVariantsQuery::create()->findOneById($varId);
        $fullName = $variant->getSProducts()->getName() . " ({$variant->getName()})";

        return \CMSFactory\assetManager::create()
                        ->registerStyle('style')
                        ->setData('class', 'btn')
                        ->setData('wish_list_id', $wish_list_id)
                        ->setData('varId', $varId)
                        ->setData('user_id', $user_id)
                        ->setData($data)
                        ->setData('max_lists_count', $this->settings['maxListsCount'])
                        ->setData('fullName', $fullName)
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

        $this->lib_admin->log(lang("Product was deleted from wish list.", "wishlist") . ' ID: ' . $varId);
        redirect($this->input->server('HTTP_REFERER') . '#lists');
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

        $this->lib_admin->log(lang("Wish list product moved to another wish list.", "wishlist"));
        redirect('/admin/components/cp/wishlist/userWL/' . $user_id . '#lists');
    }

    /**
     * delete user image
     */
    public function deleteImage() {
        $wishlist = new \wishlist\classes\BaseWishlist();
        $wishlist->deleteImage();

        redirect($this->input->server('HTTP_REFERER'));
    }

    public function delete_user() {
        foreach ($this->input->post('ids') as $id) {
            $this->wishlist_model->delUser($id);
        }

        $this->lib_admin->log(lang("Wishlists was removed", "wishlist") . '. Ids users: ' . implode(', ', $this->input->post('ids')));
    }

}