<?php

//namespace wishlist;

/**
 * Image CMS
 * Module Wishlist
 * @property wishlist_model $wishlist_model
 */
class WishlistApi extends \wishlist\classes\BaseApi {

    public function __construct() {
        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('wishlist');
    }

    /**
     * get all public users wish lists
     *
     * @return json
     */
    public function all() {
        parent::all();
        $data['settings'] = $this->settings;

        if ($this->dataModel) {
            $data['data'] = $this->dataModel;
            $data['answer'] = 'success';
        } else {
            $data['errors'] = $this->errors;
            $data['answer'] = 'error';
        }
        return json_encode($data);
    }

    /**
     * add item to wish list
     *
     * @param int $varId - current variant id
     * @return json
     */
    public function addItem($varId) {
        parent::_addItem($varId);
        return $this->return_json();
    }

    /**
     * move item to wish list
     *
     * @param int $varId - current variant id
     * @param int $wish_list_id - current wish list id
     * @return json
     */
    public function moveItem($varId, $wish_list_id) {
        parent::moveItem($varId, $wish_list_id);
        return $this->return_json();
    }

    /**
     * delete item from list
     *
     * @param int $variant_id
     * @param int $wish_list_id
     * @return json
     */
    public function deleteItem($variant_id, $wish_list_id) {
        parent::deleteItem($variant_id, $wish_list_id);
        return $this->return_json();
    }

    /**
     * delete items from wish lists
     *
     * @return json
     */
    public function deleteItemsByIds() {
        parent::deleteItemsByIds($items);
        return $this->return_json();
    }

    /**
     * get public wish list
     *
     * @param $hash
     * @return json
     */
    public function show($hash) {
        parent::show($hash);
        return $this->return_json();
    }

    /**
     * get  most viewed wish lists
     *
     * @param int $limit
     * @return json
     */
    public function getMostViewedWishLists($limit = 10) {
        parent::getMostViewedWishLists($limit);
        return $this->return_json();
    }

    /**
     * get user public wish list
     *
     * @param int $user_id
     * @return json
     */
    public function user($user_id) {
        parent::user($user_id);
        return $this->return_json();
    }

    /**
     * user update information
     *
     * @return json
     */
    public function userUpdate() {
        parent::userUpdate();
        return $this->return_json();
    }

    /**
     * get most popular items
     *
     * @param int $limit = 10
     * @return json
     */
    public function getMostPopularItems($limit = 10) {
        parent::getMostPopularItems($limit);
        return $this->return_json();
    }

    /**
     * create wish list
     *
     * @return json
     */
    public function createWishList() {
        parent::createWishList();
        return $this->return_json();
    }

    /**
     * update wish list
     *
     * @return json
     */
    public function updateWL() {
        parent::updateWL();
        return $this->return_json();
    }

    /**
     * delete wish list
     *
     * @param int $wish_list_id
     * @return json
     */
    public function deleteWL($wish_list_id) {
        parent::deleteWL($wish_list_id);
        return $this->return_json();
    }

    /**
     * delete image
     *
     * @return json
     */
    public function deleteImage() {
        parent::deleteImage();
        return $this->return_json();
    }

    /**
     * get wish list button
     *
     * @param int $varId
     * @return json
     */
    public function renderWLButton($varId, $data = array()) {
        if ($this->dx_auth->is_logged_in()) {
            $data['href'] = '/wishlist/renderPopup/' . $varId;
        } else {
            $data['href'] = '/auth/login';
        }

        if (!in_array($varId, $this->userWishProducts)) {
            $data['varId'] = $varId;
            $data['value'] = lang('Add to Wish List', 'wishlist');
            $data['max_lists_count'] = $this->settings['maxListsCount'];
            $data['class'] = 'btn';
        } else {
            $data['varId'] = $varId;
            $data['value'] = lang('Already in Wish List', 'wishlist');
            $data['max_lists_count'] = $this->settings['maxListsCount'];
            $data['class'] = 'btn inWL';
        }
        return json_encode($data);
    }

    /**
     * get popup
     *
     * @param int $varId
     * @param int $wish_list_id
     * @return json
     */
    public function renderPopup($varId, $wish_list_id = '') {
        parent::renderPopup();
        $data['varId'] = $varId;
        $data['wish_list_id'] = $wish_list_id;
        $data['max_lists_count'] = $this->settings['maxListsCount'];
        $data['class'] = 'btn';
        if ($this->dataModel) {
            $data['wish_lists'] = $this->dataModel;
            $data['answer'] = 'success';
        } else {
            $data['errors'] = $this->errors;
            $data['answer'] = 'error';
        }
        return json_encode($data);
    }

    /**
     * render popup for adding to wishlist
     * @param type $varId
     * @param type $wish_list_id
     * @return mixed
     */
    public function renderPopupTpl($varId, $wish_list_id = '') {
        $wish_lists = $this->wishlist_model->getWishLists();
        $data = array('wish_lists' => $wish_lists);

        return $popup = \CMSFactory\assetManager::create()
                ->registerStyle('style')
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
     * @param int $wish_list_id
     * @param int $userID
     * @return json
     */
    public function editWL($wish_list_id, $userID = null) {
        if (parent::renderUserWLEdit($wish_list_id, $userID)) {
            $data['wishlists'] = $this->dataModel;
            $data['answer'] = 'success';
            return json_encode($data);
        } else {
            $data['answer'] = 'error';
            return json_encode($data);
        }
    }

    /**
     * upload image
     *
     * @return json
     */
    public function do_upload() {
        parent::do_upload();
        return $this->return_json();
    }

    /**
     * send email
     *
     * @return json
     */
    public function send_email() {
        parent::send_email();
        return $this->return_json();
    }

    public function renderEmail($wish_list_id) {
        \CMSFactory\assetManager::create()
                ->setData('wish_list_id', $wish_list_id)
                ->render('sendEmail', TRUE);
    }

    /**
     * return sting format information about user wish list items
     */
    public function sync() {
        $user_id = $this->dx_auth->get_user_id();
        if ($user_id) {
            $wish_lists = $this->wishlist_model->getUserWishListsByID($user_id);
            $str = '[';
            foreach ($wish_lists as $key => $value) {
                $str .= '"' . $value['product_id'] . '_' . $value['variant_id'] . '",';
            }
            echo rtrim($str, ',') . ']';
        }
    }

    /**
     * return json method results
     *
     * @return json
     */
    private function return_json() {
        $data = array();
        if ($this->dataModel) {
            $data = array(
                'answer' => 'success',
                'data' => $this->dataModel
            );
        } else {
            if ($this->errors) {
                $data = array(
                    'answer' => 'error',
                    'data' => $this->errors
                );
            }
        }
        return json_encode($data);
    }

}

/* End of file wishlistApi.php */
