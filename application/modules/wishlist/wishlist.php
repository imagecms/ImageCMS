<?php

use CMSFactory\assetManager;
use wishlist\classes\BaseWishlist;

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 * Module Wishlist
 * @property wishlist_model $wishlist_model
 */
class Wishlist extends BaseWishlist
{

    public function __construct() {

        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('wishlist');
        $this->load->helper(['form', 'url']);
    }

    /**
     * index method
     */
    public function index() {

        $this->core->set_meta_tags('Wishlist');
        $this->template->registerMeta('ROBOTS', 'NOINDEX, NOFOLLOW');
        if ($this->dx_auth->is_logged_in()) {
            parent::getUserWL($this->dx_auth->get_user_id());
            assetManager::create()
                ->registerScript('jquery_ui')
                ->registerScript('cusel_min', TRUE)
                ->registerScript('wishlist', TRUE)
                ->registerStyle('style', TRUE)
                ->registerStyle('jquery_ui_1.9.2.custom.min')
                ->setData('wishlists', $this->dataModel['wishlists'])
                ->setData('user', $this->dataModel['user'])
                ->setData('settings', $this->settings)
                ->setData('errors', $this->errors)
                ->render('wishlist');
        } else {
            $this->core->error_404();
        }
    }

    public function renderWL() {

        parent::getUserWL($this->dx_auth->get_user_id());
        assetManager::create()
            ->registerScript('wishlist', TRUE)
            ->registerStyle('style', TRUE)
            ->setData('wishlists', $this->dataModel['wishlists'])
            ->setData('user', $this->dataModel['user'])
            ->setData('settings', $this->settings)
            ->setData('errors', $this->errors)
            ->render('wishlist', TRUE);
    }

    /**
     * add item to wishlist
     * @param integer $varId
     * @return mixed|void
     */
    public function addItem($varId) {

        parent::addItem($varId);

        if ($this->dataModel) {
            assetManager::create()->setData('success', true);
        } else {
            assetManager::create()->setData('errors', $this->errors);
        }
        $this->renderPopup($varId, $this->input->post('wishlist'));
    }

    /**
     * move item to another wishlist
     * @param integer $varId
     * @param integer $wish_list_id
     * @return mixed|void
     */
    public function moveItem($varId, $wish_list_id) {

        parent::moveItem($varId, $wish_list_id);
        if ($this->dataModel) {
            redirect('/wishlist');
        } else {
            assetManager::create()
                ->setData('errors', $this->errors);
            $this->renderPopup($varId, $wish_list_id);
        }
    }

    /**
     * get all wishlist
     */
    public function all() {

        $lists = parent::all();
        if ($this->dataModel) {
            assetManager::create()
                ->setData('lists', $lists)
                ->setData('settings', $this->settings)
                ->render('all');
        } else {
            assetManager::create()
                ->setData('errors', $this->errors)
                ->setData('settings', $this->settings)
                ->render('all');
        }
    }

    /**
     * show wishlist by hash
     * @param string $hash
     * @return bool|void
     */
    public function show($hash) {

        if (parent::show($hash)) {
            assetManager::create()
                ->setData('wishlist', $this->dataModel['wish_list'])
                ->setData('user', $this->dataModel['user'])
                ->registerStyle('style', TRUE)
                ->registerScript('wishlist', TRUE)
                ->render('other_list');
        } else {
            assetManager::create()
                ->setData('wishlist', 'empty')
                ->registerStyle('style', TRUE)
                ->registerScript('wishlist', TRUE)
                ->render('other_list');
        }
    }

    /**
     * get most viewed wishlists
     * @param integer $limit
     * @return mixed
     */
    public function getMostViewedWishLists($limit = 10) {

        parent::getMostViewedWishLists($limit);
        if ($this->dataModel) {
            return $this->dataModel;
        } else {
            return $this->errors;
        }
    }

    /**
     * get user by user id
     * @param integer $user_id
     * @return bool|void
     */
    public function user($user_id) {

        $user_wish_lists = parent::user($user_id);
        assetManager::create()
            ->setData('wishlists', $user_wish_lists)
            ->render('other_wishlist');
    }

    /**
     * update user data
     * @return mixed
     */
    public function userUpdate() {

        parent::userUpdate();
        if ($this->dataModel) {
            redirect('/wishlist');
        } else {
            return $this->errors;
        }
    }

    /**
     * get most popylar items
     * @param integer $limit
     * @return mixed
     */
    public function getMostPopularItems($limit = 10) {

        parent::getMostPopularItems($limit);
        if ($this->dataModel) {
            return $this->dataModel;
        } else {
            return $this->errors;
        }
    }

    /**
     * create wishlist
     * @return mixed
     */
    public function createWishList() {

        parent::createWishList();
        if ($this->dataModel) {
            return $this->dataModel;
        } else {
            foreach ($this->errors as $error) {
                echo $error;
            }
        }
    }

    /**
     * renser button for add to wishlist
     * @param integer $varId
     * @param array $data
     */
    public function renderWLButton($varId, $data = []) {

        $locale = MY_Controller::getCurrentLocale();
        $href = $this->dx_auth->is_logged_in() ? '/' . $locale . '/wishlist/renderPopup/' . $varId : '/auth/login';

        if (!in_array($varId, $this->userWishProducts)) {
            $value = lang('Add to Wish List', 'wishlist');
            $class = 'btn';
        } else {
            $value = lang('Already in Wish List', 'wishlist');
            $class = 'btn inWL';
        }
        assetManager::create()
            ->registerScript('wishlist', TRUE)
            ->setData('data', $data)
            ->setData('varId', $varId)
            ->setData('value', $value)
            ->setData('class', $class)
            ->setData('href', $href)
            ->setData('max_lists_count', $this->settings['maxListsCount'])
            ->setData($data)
            ->render('button', true);
    }

    /**
     * render popup for adding to wishlist
     * @param integer $varId
     * @param int|string $wish_list_id
     * @return mixed
     */
    public function renderPopup($varId, $wish_list_id = '') {

        if ($this->ajaxRequest) {

            $wish_lists = $this->wishlist_model->getWishLists();
            $data = ['wish_lists' => $wish_lists];

            return assetManager::create()
                ->registerStyle('style', TRUE)
                ->setData('class', 'btn')
                ->setData('wish_list_id', $wish_list_id)
                ->setData('varId', $varId)
                ->setData($data)
                ->setData('max_lists_count', $this->settings['maxListsCount'])
                ->render('wishPopup', TRUE);
        } else {
            $this->core->error_404();
        }
    }

    /**
     * edit wish list
     *
     * @param integer $wish_list_id
     */
    public function editWL($wish_list_id) {

        if (parent::renderUserWLEdit($wish_list_id)) {
            assetManager::create()
                ->registerScript('wishlist', TRUE)
                ->registerStyle('style', TRUE)
                ->setData('wishlists', $this->dataModel)
                ->render('wishlistEdit', TRUE);
        } else {
            redirect('/wishlist');
        }
    }

    /**
     * update wish list
     *
     */
    public function updateWL() {

        parent::updateWL();
        redirect('/wishlist');
    }

    /**
     * delete wish list
     *
     * @param integer $wish_list_id
     * @return bool|void
     */
    public function deleteWL($wish_list_id) {

        parent::deleteWL($wish_list_id);
        redirect('/wishlist');
    }

    /**
     * delete item from wish list
     *
     * @param integer $variant_id
     * @param integer $wish_list_id
     * @return mixed
     */
    public function deleteItem($variant_id, $wish_list_id) {

        parent::deleteItem($variant_id, $wish_list_id);
        if ($this->dataModel) {
            redirect('/wishlist');
        } else {
            return $this->errors;
        }
    }

    /**
     * delete items by ids
     *
     * @return mixed
     */
    public function deleteItemsByIds() {

        parent::deleteItemsByIds();
        redirect('/wishlist');
    }

    /**
     * delete user image
     *
     * @return mixed
     */
    public function deleteImage() {

        parent::deleteImage();

        redirect('/wishlist');
    }

    /**
     * upload user image
     */
    public function do_upload() {

        parent::do_upload();
        redirect('/wishlist');
    }

    public function renderEmail($wish_list_id) {

        assetManager::create()
            ->setData('wish_list_id', $wish_list_id)
            ->render('sendEmail');
    }

    /**
     * send email
     */
    public function send_email() {

        parent::send_email();

        if ($this->dataModel) {
            return $this->dataModel;
        } else {
            return $this->errors;
        }
    }

}

/* End of file wishlist.php */