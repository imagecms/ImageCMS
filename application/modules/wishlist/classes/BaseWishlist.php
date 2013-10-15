<?php

namespace wishlist\classes;

/**
 * Image CMS
 * Module Wishlist
 * @property \Wishlist_model $wishlist_model
 * @property \DX_Auth $dx_auth
 * @property \CI_URI $uri
 * @property \CI_DB_active_record $db
 * @property \CI_Input $input
 */
class BaseWishlist extends \wishlist\classes\ParentWishlist {

    public function __construct() {
        parent::__construct();
        $lang = new \MY_Lang();
        $lang->load('wishlist');
    }

    /**
     * get all user wishlists
     * @return mixed
     */
    public function all() {
        $parent = parent::all();
        if ($parent) {
            return $this->dataModel;
        } else {
            return $this->errors;
        }
    }

    /**
     * add item to wishlist
     * @param $varId
     * @param $listId
     * @param $listName
     * @return mixed
     */
    public function addItem($varId, $listId, $listName) {
        if (!$listId)
            $listId = $this->input->post('wishlist');
        if (!$listName)
            $listName = $this->input->post('wishListName');

        if (parent::_addItem($varId, $listId, $listName)) {
            return $this->dataModel;
        } else {
            return $this->errors;
        }
    }

    /**
     * move item
     * @param $varId
     * @param $wish_list_id
     * @return mixed
     */
    public function moveItem($varId, $wish_list_id) {
        $listId = $this->input->post('wishlist');
        $user_id = $this->input->post('user_id');
        $listName = $this->input->post('wishListName');

        if ((!$listId && !$listName)) {
            return $this->errors[] = lang('Unable to move', 'wishlist');
        }

        if (parent::moveItem($varId, $wish_list_id, $listId, $listName, $user_id)) {
            return $this->dataModel = lang('Successful operation', 'wishlist');
        } else {
            return $this->errors[] = lang('Unable to move', 'wishlist');
        }
    }

    /**
     * show WL by hash
     * @param $hash
     * @return boolean
     */
    public function show($hash) {
        if (parent::show($hash)) {
            return $this->dataModel;
        } else {
            $this->errors;
            return false;
        }
    }

    /**
     * show most popular wishlist
     * @param $limit
     * @return mixed
     */
    public function getMostViewedWishLists($limit = 10) {
        if (parent::getMostViewedWishLists($limit)) {
            return $this->dataModel;
        } else {
            return $this->errors;
        }
    }

    /**
     * get user by id
     * @param $user_id
     * @return boolean
     */
    public function user($user_id) {
        if (parent::user($user_id)) {
            return $this->dataModel;
        } else {
            return false;
        }
    }

    /**
     * get most populars items
     * @param $limit
     * @return mixed
     */
    public function getMostPopularItems($limit = 10) {
        if (parent::getMostPopularItems($limit)) {
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
        $listName = $this->input->post('wishListName');
        $user_id = $this->input->post('user_id');
        $wlType = $this->input->post('wlTypes');
        $wlDescription = $this->input->post('wlDescription');

        if (parent::createWishList($user_id, $listName, $wlType, $wlDescription)) {
            return $this->dataModel = lang('Created', 'wishlist');
        } else {
            return $this->errors;
        }
    }

    /**
     * update user data
     * @return boolean
     */
    public function userUpdate() {

        if ($this->settings['maxDescLenght'] < iconv_strlen($this->input->post('description'), 'UTF-8'))
            $desc = mb_substr($this->input->post('description'), 0, $this->settings['maxDescLenght'], 'UTF-8');
        else
            $desc = $this->input->post('description');

        if ($this->input->post('user_birthday')) {
            if (!(strtotime($this->input->post('user_birthday')) + 50000))
                return false;
            $user_birthday = strtotime($this->input->post('user_birthday')) + 50000;
        }else{
            $user_birthday = '';
        }


        $userName = $this->input->post('user_name');

        if ($this->settings['maxUserName'] < iconv_strlen($userName, 'UTF-8'))
            $desc = mb_substr($userName, 0, $this->settings['maxUserName'], 'UTF-8');

        $updated = parent::userUpdate($this->input->post('user_id'), $userName, $user_birthday, $desc);
        if ($updated) {
            return $this->dataModel = lang('Updated', 'wishlist');
        } else {
            return $this->errors = lang('Not updated', 'wishlist');
        }
    }

    /**
     * update user WL
     */
    public function updateWL() {

        $id = $this->input->post('WLID');
        $wlDescription = $this->input->post('description');

        if (iconv_strlen($wlDescription, 'UTF-8') > $this->settings['maxWLDescLenght']) {
            $wlDescription = mb_substr($wlDescription, 0, (int) $this->settings['maxWLDescLenght'], 'utf-8');
            $this->errors[] = lang('List description limit exhausted', 'wishlist') . '. ' . lang('List description max count', 'wishlist') . ' - ' . $this->settings['maxWLDescLenght'];
        }

        foreach ($this->input->post('comment') as $key => $comment) {
            if ($this->settings['maxCommentLenght'] < iconv_strlen($comment, 'UTF-8'))
                $desc[$key] = mb_substr($comment, 0, $this->settings['maxCommentLenght']);
            else
                $desc[$key] = $comment;
        }
        if ($this->settings['maxListName'] < iconv_strlen($this->input->post('title'), 'UTF-8'))
            $title = mb_substr($this->input->post('title'), 0, $this->settings['maxListName'], 'UTF-8');
        else
            $title = $this->input->post('title');

        $data = array(
            'access' => $this->input->post('access'),
            'description' => $wlDescription,
            'title' => $title,
        );

        parent::updateWL($id, $data, $desc);
    }

    /**
     * delete item from wishlist
     * @param $variant_id
     * @param $wish_list_id
     * @return mixed
     */
    public function deleteItem($variant_id, $wish_list_id) {
        if (parent::deleteItem($variant_id, $wish_list_id)) {
            return $this->dataModel;
        } else {
            return $this->errors;
        }
    }

    /**
     * delete items from wishlist by id
     * @return mixed
     */
    public function deleteItemsByIds() {
        $items = $this->input->post('listItem');
        if ($items) {
            if (parent::deleteItemsByIds($items)) {
                return $this->dataModel = lang('Successful deleted', 'wishlist');
            } else {
                return $this->errors[] = lang('Unable to delete', 'wishlist');
            }
        }
    }

    /**
     * delete image
     * @return mixed
     */
    public function deleteImage() {
        $image = $this->input->post('image');
        $user_id = $this->input->post('user_id');

        if (!$user_id) {
            $user_id = $this->dx_auth->get_user_id();
        }

        if (parent::deleteImage($image, $user_id)) {
            return $this->dataModel[] = lang('Successful deleted', 'wishlist');
        } else {
            return $this->errors[] = lang('Unable to delete', 'wishlist');
        }
    }

    /**
     * render popup
     * @return mixed
     */
    public function renderPopup() {
        if (parent::renderPopup()) {
            return $this->dataModel;
        } else {
            return $this->errors;
        }
    }

    /**
     * upload user photo
     * @return boolean
     */
    public function do_upload() {
        if (parent::do_upload($this->input->post('userID'))) {
            if (!$this->upload->do_upload('file')) {
                $this->errors[] = $this->upload->display_errors();
                return FALSE;
            } else {
                $this->dataModel = array('upload_data' => (array)$this->upload);
                $this->wishlist_model->setUserImage($this->input->post('userID'), $this->dataModel['upload_data']['file_name']);
                return TRUE;
            }
            return $this->dataModel[] = lang('Image uploaded', 'wishlist');
        } else {
            return $this->errors[] = lang('Can not upload photo', 'wishlist');
        }
    }

    /**
     * send email
     */
    public function send_email() {
        $this->load->helper('email');
        $email = $this->input->post('email');
        $wish_list_id = $this->input->post('wish_list_id');
        if (!valid_email($email)) {
            return $this->errors[] = lang('Invalid email', 'wishlist');
        }

        if (parent::send_email($wish_list_id, $email)) {
            return $this->dataModel = lang('Successful operation', 'wishlist');
        } else {
            return $this->errors[] = lang('Error', 'wishlist');
        }
    }

}
