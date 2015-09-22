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
        $lang = new MY_Lang();
        $lang->load('wishlist');
        $this->load->helper(['form', 'url']);
    }

    /**
     * index method
     */
    public function index() {
        $this->core->set_meta_tags('Wishlist');
        $this->template->registerMeta("ROBOTS", "NOINDEX, NOFOLLOW");
        if ($this->dx_auth->is_logged_in()) {
            parent::getUserWL($this->dx_auth->get_user_id());
            \CMSFactory\assetManager::create()
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
        \CMSFactory\assetManager::create()
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
     * @param type $varId
     */
    public function addItem($varId) {
        parent::addItem($varId);
        if ($this->dataModel) {
            redirect($this->input->cookie('url'));
        } else {
            \CMSFactory\assetManager::create()
                    ->registerScript('wishlist', TRUE)
                    ->setData('errors', $this->errors)
                    ->render('errors');
        }
    }

    /**
     * move item to another wishlist
     * @param type $varId
     * @param type $wish_list_id
     */
    public function moveItem($varId, $wish_list_id) {
        parent::moveItem($varId, $wish_list_id);
        if ($this->dataModel) {
            redirect('/wishlist');
        } else {
            \CMSFactory\assetManager::create()
                    ->setData('errors', $this->errors)
                    ->render('errors');
        }
    }

    /**
     * get all wishlist
     */
    public function all() {
        $lists = parent::all();
        if ($this->dataModel) {
            \CMSFactory\assetManager::create()
                    ->setData('lists', $lists)
                    ->setData('settings', $this->settings)
                    ->render('all');
        } else {
            \CMSFactory\assetManager::create()
                    ->setData('errors', $this->errors)
                    ->setData('settings', $this->settings)
                    ->render('all');
        }
    }

    /**
     * show wishlist by hash
     * @param type $hash
     */
    public function show($hash) {
        if (parent::show($hash)) {
            \CMSFactory\assetManager::create()
                    ->setData('wishlist', $this->dataModel['wish_list'])
                    ->setData('user', $this->dataModel['user'])
                    ->registerStyle('style', TRUE)
                    ->registerScript('wishlist', TRUE)
                    ->render('other_list');
        } else {
            \CMSFactory\assetManager::create()
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
     * @param type $user_id
     */
    public function user($user_id) {
        $user_wish_lists = parent::user($user_id);
        \CMSFactory\assetManager::create()
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
     * @param type $varId
     */
    public function renderWLButton($varId, $data = []) {
        if ($this->dx_auth->is_logged_in()) {
            $href = '/wishlist/renderPopup/' . $varId;
        } else {
            $href = '/auth/login';
        }

        if (!in_array($varId, $this->userWishProducts)) {
            \CMSFactory\assetManager::create()
                    ->registerScript('wishlist', TRUE)
                    ->setData('data', $data)
                    ->setData('varId', $varId)
                    ->setData('value', lang('Add to Wish List', 'wishlist'))
                    ->setData('class', 'btn')
                    ->setData('href', $href)
                    ->setData('max_lists_count', $this->settings['maxListsCount'])
                    ->setData($data)
                    ->render('button', true);
        } else {
            \CMSFactory\assetManager::create()
                    ->registerScript('wishlist', TRUE)
                    ->setData('data', $data)
                    ->setData('varId', $varId)
                    ->setData('href', $href)
                    ->setData('value', lang('Already in Wish List', 'wishlist'))
                    ->setData('max_lists_count', $this->settings['maxListsCount'])
                    ->setData('class', 'btn inWL')
                    ->setData($data)
                    ->render('button', true);
        }
    }

    /**
     * render popup for adding to wishlist
     * @param type $varId
     * @param type $wish_list_id
     * @return mixed
     */
    public function renderPopup($varId, $wish_list_id = '') {
        $wish_lists = $this->wishlist_model->getWishLists();
        $data = ['wish_lists' => $wish_lists];

        return $popup = \CMSFactory\assetManager::create()
                ->registerStyle('style', TRUE)
                ->setData('class', 'btn')
                ->setData('wish_list_id', $wish_list_id)
                ->setData('varId', $varId)
                ->setData($data)
                ->setData('max_lists_count', $this->settings['maxListsCount'])
                ->render('wishPopup', TRUE);
    }

    /**
     * edit wish list
     *
     * @param integer $wish_list_id
     */
    public function editWL($wish_list_id) {
        if (parent::renderUserWLEdit($wish_list_id)) {
            \CMSFactory\assetManager::create()
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
        \CMSFactory\assetManager::create()
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