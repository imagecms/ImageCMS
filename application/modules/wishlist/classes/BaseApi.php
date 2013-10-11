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
class BaseApi extends \wishlist\classes\ParentWishlist {

    public function __construct() {
        parent::__construct();
        $lang = new \MY_Lang();
        $lang->load('wishlist');
    }

    /**
     * get all public users lists
     *
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
     * add item to wish list
     *
     * @param int $varId
     * @return mixed
     */
    public function _addItem($varId) {
        $listId = $this->input->post('wishlist');
        $listName = $this->input->post('wishListName');

        if (parent::_addItem($varId, $listId, $listName)) {
            return $this->dataModel;
        } else {
            return $this->errors;
        }
    }

    /**
     * move item to wish list
     *
     * @param int $varId - item var current id
     * @param int $wish_list_id - item wish list current id
     * @return mixed
     */
    public function moveItem($varId, $wish_list_id) {
        $to_listId = $this->input->post('wishlist');
        $to_listName = $this->input->post('wishListName');

        if (parent::moveItem($varId, $wish_list_id, $to_listId, $to_listName)) {
            return $this->dataModel = lang('Successful operation', 'wishlist');
        } else {
            return $this->errors = lang('Unable to move', 'wishlist');
        }
    }

    /**
     * delete item from wish list
     *
     * @param int $variant_id - item var current id
     * @param int $wish_list_id - item wish list current id
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
     * delete items by ids
     *
     * @return mixed
     */
    public function deleteItemsByIds() {
        $items = $this->input->post('listItem');
        if ($items) {
            if (parent::deleteItemsByIds($items)) {
                return $this->dataModel = lang('Successful operation', 'wishlist');
            } else {
                return $this->errors[] = lang('Unable to move', 'wishlist');
            }
        }
    }

    /**
     * get user public list by hash
     *
     * @param type $hash - unique list identificator
     * @return mixed
     */
    public function show($hash) {
        if (parent::show($hash)) {
            return $this->dataModel;
        } else {
            return $this->errors;
        }
    }

    /**
     * get most viewed wish lists
     *
     * @param int $limit - lists count
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
     * get user public lists
     *
     * @param int $user_id
     * @return mixed
     */
    public function user($user_id) {
        if (parent::user($user_id)) {
            return $this->dataModel;
        } else {
            return $this->errors;
        }
    }

    /**
     * update user information
     *
     * @return mixed
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
        }else {
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
     * get most popular items
     *
     * @param int $limit - items count
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
     * create wish list
     *
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
     * delete wish list
     *
     * @param int $wish_list_id
     * @return mixed
     */
    public function deleteWL($wish_list_id) {
        if (parent::deleteWL($wish_list_id)) {
            return $this->dataModel;
        } else {
            return $this->errors;
        }
    }

    /**
     * update wiish list
     *
     * @return mixed
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
     * delete image
     *
     * @return mixed
     */
    public function deleteImage() {
        $image = $this->input->post('image');
        $user_id = $this->input->post('user_id');

        if (!$user_id) {
            $user_id = $this->dx_auth->get_user_id();
        }

        if (parent::deleteImage($image, $user_id)) {
            return $this->dataModel[] = lang('Successful deleting', 'wishlist');
        } else {
            return $this->errors[] = lang('Error', 'wishlist');
        }
    }

    /**
     * upload image
     *
     * @return mixed
     */
    public function do_upload() {
        if ($this->input->post('userID')) {
            if (parent::do_upload($this->input->post('userID'))) {
                if (!$this->upload->do_upload()) {
                    $this->errors[] = $this->upload->display_errors();
                    return $this->errors[] = lang('Loading error', 'wishlist');
                } else {
                    $this->dataModel = array('upload_data' => $this->upload->data());
                    $this->wishlist_model->setUserImage($this->input->post('userID'), $this->dataModel['upload_data']['file_name']);
                    return $this->dataModel[] = lang('Image uploaded', 'wishlist');
                }
                return $this->dataModel[] = lang('Image uploaded', 'wishlist');
            } else {
                return $this->errors[] = lang('Can not Upload photo', 'wishlist');
            }
        } else {
            return $this->errors[] = lang('You did not enter user', 'wishlist');
        }
    }

    /**
     * get popup
     *
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
            return $this->errors = lang('Error', 'wishlist');
        }
    }

}

/* End of file BaseApi.php */