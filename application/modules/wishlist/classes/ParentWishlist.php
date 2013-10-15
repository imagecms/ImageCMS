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
 * @version 1.0 big start!
 */
class ParentWishlist extends \MY_Controller {

    /**
     * array that contains wishlist settings
     * @var array
     */
    public $settings = array();

    /**
     * contains output data
     * @var mixed
     */
    public $dataModel;

    /**
     * contains errors array
     * @var array
     */
    public $errors = array();

    /**
     * contains array of user wish products
     * @var array
     */
    public $userWishProducts;

    public function __construct() {
        parent::__construct();
        $lang = new \MY_Lang();
        $lang->load('wishlist');

        $this->writeCookies();
        $this->load->model('wishlist_model');
        $this->load->helper(array('form', 'url'));
        $this->load->language('wishlist');
        $this->settings = $this->wishlist_model->getSettings();

        if ($this->settings)
            $this->userWishProducts = $this->wishlist_model->getUserWishProducts();
    }

    /**
     * set in cookie previous page url
     *
     * @access private
     * @author DevImageCms
     * @copyright (c) 2013, ImageCMS
     */
    private function writeCookies() {
        $this->load->helper('cookie');
        if (!strstr($this->uri->uri_string(), 'wishlist') && !strstr($this->uri->uri_string(), 'sync')) {
            $cookie = array(
                'name' => 'url',
                'value' => $this->uri->uri_string(),
                'expire' => '15000',
                'prefix' => ''
            );
            @$this->input->set_cookie($cookie);
        }
    }

    /**
     * get all users wish lists
     *
     * @access public
     * @param  array $access - list access
     * @author DevImageCms
     * @copyright (c) 2013, ImageCMS
     * @return boolean
     */
    public function all($access = array('public')) {
        if (!$users = $this->wishlist_model->getAllUsers()) {
            $this->errors[] = lang('No users', 'wishlist');
            return FALSE;
        }

        foreach ($users as $user) {
            $lists [] = array(
                'user' => $user,
                'lists' => $this->wishlist_model->getWLsByUserId($user['id'], $access)
            );
        }

        if ($lists) {
            $this->dataModel = $lists;
            return TRUE;
        } else {
            $this->errors[] = lang('No lists', 'wishlist');
            return FALSE;
        }
    }

    /**
     * get user wish list
     *
     * @access public
     * @param int $hash
     * @param array $access list access
     * @author DevImageCms
     * @copyright (c) 2013, ImageCMS
     * @return boolean
     */
    public function show($hash, $access = array('shared', 'private', 'public')) {
        if (!$hash)
            return FALSE;

        $wishlist = $this->wishlist_model->getUserWishListByHash($hash, $access);
        $user_data = $this->wishlist_model->getUserByID($wishlist[0]['wl_user_id']);
        if ($wishlist[0]['access'] == 'private') {
            if ($wishlist[0]['user_id'] != $this->dx_auth->get_user_id()) {
                $this->core->error_404();
            }
        }

        if ($wishlist) {
            self::addReview($hash);
            $this->dataModel['wish_list'] = $wishlist;
            $this->dataModel['user'] = $user_data;

            return TRUE;
        } else {
            $this->errors[] = lang('Invalid request', 'wishlist');
            return FALSE;
        }
    }

    /**
     * add view point to list
     *
     * @access public
     * @param int $hash
     * @author DevImageCms
     * @copyright (c) 2013, ImageCMS
     * @return boolean
     */
    public static function addReview($hash) {
        $CI = & get_instance();
        $listsAdded = array();

        if ($CI->input->cookie('wishListViewer')) {
            $listsAdded = unserialize($CI->input->cookie('wishListViewer'));
        }

        if (!in_array($hash, $listsAdded)) {
            array_push($listsAdded, $hash);
            if ($CI->wishlist_model->addReview($hash)) {
                $cookie = array(
                    'name' => 'wishListViewer',
                    'value' => serialize($listsAdded),
                    'expire' => 60 * 60 * 24,
                    'prefix' => ''
                );
                @$CI->input->set_cookie($cookie);
                return TRUE;
            }
        }
        return FALSE;
    }

    /**
     * get most viewed wish list
     *
     * @access public
     * @param int $limit count lists to get
     * @author DevImageCms
     * @copyright (c) 2013, ImageCMS
     * @return boolean
     */
    public function getMostViewedWishLists($limit = 10) {
        $views = $this->wishlist_model->getMostViewedWishLists($limit);
        if ($views) {
            $this->dataModel = $views;
            return TRUE;
        } else {
            $this->errors[] = lang('No views', 'wishlist');
            return FALSE;
        }
    }

    /**
     * render user lists
     *
     * @access public
     * @param int $user_id
     * @param array $access
     * @author DevImageCms
     * @copyright (c) 2013, ImageCMS
     * @return boolean
     */
    public function user($user_id, $access = array('public')) {
        if ($this->getUserWL($user_id, $access)) {
            $this->dataModel = $this->dataModel['wishlists'];
            return TRUE;
        } else {
            $this->errors[] = lang('Invalid request', 'wishlist');
            return FALSE;
        }
    }

    /**
     * update user information
     *
     * @access public
     * @param $userID
     * @param $user_name
     * @param $user_birthday
     * @param $description
     * @author DevImageCms
     * @copyright (c) 2013, ImageCMS
     * @return boolean
     */
    public function userUpdate($userID, $user_name, $user_birthday, $description) {
        if (!$userID) {
            $userID = $this->dx_auth->get_user_id();
        }
        $this->wishlist_model->createUserIfNotExist($userID);

        if ($this->wishlist_model->updateUser($userID, $user_name, $user_birthday, $description)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * update wish list
     *
     * @access public
     * @param $id
     * @param $data
     * @param $comments
     * @author DevImageCms
     * @copyright (c) 2013, ImageCMS
     * @return boolean
     */
    public function updateWL($id, $data, $comments) {
        $return = TRUE;
        $return = $this->wishlist_model->updateWishList($id, $data);
        if ($comments) {
            $this->wishlist_model->updateWishListItemsComments($id, $comments);
        }
        if ($return) {
            $this->dataModel[] = lang("Updated", "wishlist");
        } else {
            $this->errors[] = lang('Not updated', 'wishlist');
        }
        return $return;
    }

    /**
     * create wish list
     *
     * @access public
     * @param int $user_id
     * @param string $listName
     * @author DevImageCms
     * @copyright (c) 2013, ImageCMS
     * @return boolean
     */
    public function createWishList($user_id, $listName, $wlType, $wlDescription) {
        if ($listName)
            $count_lists = $this->wishlist_model->getUserWishListCount($user_id);

        if ($count_lists >= $this->settings['maxListsCount']) {
            $this->errors[] = lang('Wish Lists limit exhausted', 'wishlist') . '. ' . lang('List maximum', 'wishlist') . ' - ' . $this->settings['maxListsCount'];
            return FALSE;
        }

        if (iconv_strlen($wlDescription, 'UTF-8') > $this->settings['maxWLDescLenght']) {
            $wlDescription = mb_substr($wlDescription, 0, (int) $this->settings['maxWLDescLenght'], 'utf-8');
            $this->errors[] = lang('List description limit exhausted', 'wishlist') . '. ' . lang('List description max count', 'wishlist') . ' - ' . $this->settings['maxWLDescLenght'];
        }

        if ($listName) {
            if (iconv_strlen($listName, 'UTF-8') > $this->settings['maxListName']) {
                $listName = mb_substr($listName, 0, (int) $this->settings['maxListName'], 'utf-8');
                $this->errors[] = lang('Wish list name will be changed', 'wishlist') . '. ' . lang('List name length maximum', 'wishlist') . ' - ' . $this->settings['maxListName'];
            }
            $this->wishlist_model->createWishList($listName, $user_id, $wlType, $wlDescription);
        } else {
            $this->errors[] = lang('Wish List name can not be empty!', 'wishlist');
        }

        if (count($this->errors))
            return FALSE;
        else {
            $this->dataModel = lang('Created', 'wishlist');
            return TRUE;
        }
    }

    /**
     * delete full WL
     *
     * @access public
     * @param int $id list id
     * @author DevImageCms
     * @copyright (c) 2013, ImageCMS
     * @return boolean
     */
    public function deleteWL($id) {
        $forReturn = TRUE;

        $forReturn = $this->wishlist_model->delWishListById($id);

        if ($forReturn) {
            $this->wishlist_model->delWishListProductsByWLId($id);
        }
        else
            $this->errors[] = lang('You can not delete Wish List', 'wishlist');

        if (count($this->errors))
            return FALSE;
        else {
            $this->dataModel = lang('Successfully deleted', 'wishlist');
            return TRUE;
        }
    }

    /**
     * delete all wishlists
     * @param $UserID
     * @return boolean
     */
    public function deleteAllWL($UserID) {
        $forReturn = TRUE;

        $WLs = $this->wishlist_model->getAllUserWLs($UserID);
        if ($forReturn) {
            foreach ($WLs as $wl) {
                $forReturn = $this->wishlist_model->delWishListById($wl);
                $forReturn = $this->wishlist_model->delWishListProductsByWLId($wl);

                if (!$forReturn)
                    $this->errors[] = lang('Can not remove items from wishlist', 'wishlist');
            }
        }
        else
            $this->errors[] = lang('You can not delete Wish List', 'wishlist');

        if (count($this->errors))
            return FALSE;
        else {
            $this->dataModel = lang('Successfully deleted', 'wishlist');
            return TRUE;
        }
    }

    /**
     * add item to wish list
     *
     * @access public
     * @param $varId
     * @param string $listId
     * @param $listName
     * @param $userId
     * @author DevImageCms
     * @copyright (c) 2013, ImageCMS
     * @return boolean
     */
    public function _addItem($varId, $listId, $listName, $userId = null) {
        if (!$userId)
            $userId = $this->dx_auth->get_user_id();
        $count_lists = 0;
        $count_items = $this->wishlist_model->getUserWishListItemsCount($userId);

        if (!$this->settings) {
            $this->settings = $this->wishlist_model->getSettings();
        }

        if ($count_items >= $this->settings['maxItemsCount']) {
            $this->errors[] = lang('Limit of list items exhausted', 'wishlist');
            return FALSE;
        }

        if (!$this->dx_auth->is_logged_in()) {
            $this->errors[] = lang('User is not logged in', 'wishlist');
            return FALSE;
        }

        if (mb_strlen($listName, 'utf-8') > $this->settings['maxListName']) {
            $listName = mb_substr($listName, 0, (int) $this->settings['maxListName'], 'utf-8');
            $this->errors[] = lang('Wishlist name will be changed', 'wishlist') . '. ' . lang('Maximum length of wishlist name', 'wishlist') . ' - ' . $this->settings['maxListName'];
        }

        if ($listName) {
            $listId = "";
            $count_lists = $this->wishlist_model->getUserWishListCount($userId);
        }

        if ($count_lists >= $this->settings['maxListsCount']) {
            $this->errors[] = lang('Wish Lists limit exhausted', 'wishlist') . '. ' . lang('List maximum', 'wishlist') . ' - ' . $this->settings['maxListsCount'];
            return FALSE;
        }

        if (!$this->wishlist_model->addItem($varId, $listId, $listName, $userId))
            $this->errors[] = lang('You can not add', 'wishlist');

        if (count($this->errors))
            return FALSE;
        else {
            $this->dataModel = lang('Added to wishlist', 'wishlist');
            return TRUE;
        }
    }

    /**
     * move item from one wish list to another
     *
     * @param $varId
     * @param $wish_list_id
     * @param $to_listId
     * @param $to_listName
     * @access public
     * @author DevImageCms
     * @copyright (c) 2013, ImageCMS
     * @return boolean
     */
    public function moveItem($varId, $wish_list_id, $to_listId = '', $to_listName = '', $user_id = null) {
        if (!$user_id)
            $user_id = $this->dx_auth->get_user_id();

        if ($to_listName) {
            $this->wishlist_model->createWishList($to_listName, $user_id);
            $to_listId = $this->db->insert_id();
        }

        $data = array('wish_list_id' => $to_listId);
        return $this->wishlist_model->updateWishListItem($varId, $wish_list_id, $data);
    }

    /**
     * delete item from wish list
     *
     * @param $variant_id
     * @param $wish_list_id
     * @access public
     * @author DevImageCms
     * @copyright (c) 2013, ImageCMS
     * @return boolean
     */
    public function deleteItem($variant_id, $wish_list_id) {
        $forReturn = $this->wishlist_model->deleteItem($variant_id, $wish_list_id);
        if ($forReturn == 0)
            $this->errors[] = lang('Can not remove items from wishlist', 'wishlist');
        else
            $this->dataModel = lang('Item deleted', 'wishlist');

        return $forReturn;
    }

    /**
     * get user info
     *
     * @param $id
     * @access public
     * @author DevImageCms
     * @copyright (c) 2013, ImageCMS
     * @return boolean
     */
    public function getUserInfo($id) {
        return $this->wishlist_model->getUserByID($id);
    }

    /**
     * render user wish list
     *
     * @param $userId
     * @param array $access
     * @access public
     * @author DevImageCms
     * @copyright (c) 2013, ImageCMS
     * @return boolean
     */
    public function getUserWL($userId, $access = array('public', 'private', 'shared')) {
        $this->wishlist_model->createUserIfNotExist($userId);

        $wishlists = $this->wishlist_model->getUserWishListsByID($userId, $access);
        $userInfo = $this->getUserInfo($userId);
        $this->dataModel['user'] = $userInfo;

        if (!$wishlists) {
            return FALSE;
        }

        if (empty($userInfo)) {
            $this->errors[] = lang('User data is not found', 'wishlist');
            return FALSE;
        }
        $w = array();

        foreach ($wishlists as $wishlist)
            $w[$wishlist['wish_list_id']][] = $wishlist;

        $this->dataModel['wishlists'] = $w;

        return TRUE;
    }

    /**
     * render user wish list edit page
     *
     * @param $wish_list_id
     * @param $userID
     * @access public
     * @author DevImageCms
     * @copyright (c) 2013, ImageCMS
     * @return boolean
     */
    public function renderUserWLEdit($wish_list_id, $userID = null) {
        if ($userID === null)
            $userID = $this->dx_auth->get_user_id();

        if ($wish_list_id) {
            $wishlists = $this->wishlist_model->getUserWishList($userID, $wish_list_id);
            if (empty($wishlists))
                return FALSE;

            $w = array();
            foreach ($wishlists as $wishlist)
                $w[$wishlist['title']][] = $wishlist;
            $this->dataModel = $w;
            return TRUE;
        }
        return FALSE;
    }

    /**
     * upload image for user
     *
     * @param $userID
     * @access public
     * @author DevImageCms
     * @copyright (c) 2013, ImageCMS
     * @return boolean
     */
    function do_upload($userID = null) {

        if (!$userID)
            $userID = $this->dx_auth->get_user_id();

        $allowedFileFormats = array('image/gif', 'image/jpeg', 'image/png', 'image/jpg');

        list($width, $height, $type, $attr) = getimagesize($_FILES["file"]['tmp_name']);

        if ($this->settings['maxImageSize'] < $_FILES["file"]['size'])
            $this->errors[] = lang('Maximum image size is exceeded', 'wishlist');
        if ($this->settings['maxImageWidth'] < $width)
            $this->errors[] = lang('Maximum width of the image is exceeded', 'wishlist');
        if ($this->settings['maxImageHeight'] < $height)
            $this->errors[] = lang('Max image height exceeded', 'wishlist');
        if (!in_array($_FILES["file"]['type'], $allowedFileFormats))
            $this->errors[] = lang('Invalid file format', 'wishlist');
        if ($this->errors)
            return FALSE;

        if(!file_exists('./uploads/mod_wishlist/')){
            mkdir('./uploads/mod_wishlist/');
            chmod('./uploads/mod_wishlist/', 0777);
        }
        
        $config['upload_path'] = './uploads/mod_wishlist/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = $this->settings['maxImageSize'];
        $config['max_width'] = $this->settings['maxImageWidth'];
        $config['max_height'] = $this->settings['maxImageHeight'];

        $this->load->library('upload', $config);
        return TRUE;
    }

    /**
     * get most popular items by wish list usage
     *
     * @param $limit
     * @access public
     * @author DevImageCms
     * @copyright (c) 2013, ImageCMS
     * @return boolean
     */
    public function getMostPopularItems($limit = 10) {
        $result = $this->wishlist_model->getMostPopularProducts();

        if ($result !== FALSE) {
            $this->dataModel = $result;
            return TRUE;
        } else {
            $this->error[] = lang('Invalid request', 'wishlist');
            return FALSE;
        }
    }

    /**
     * get user wish list items count
     *
     * @param $user_id
     * @access public
     * @author DevImageCms
     * @copyright (c) 2013, ImageCMS
     * @return boolean
     */
    public function getUserWishListItemsCount($user_id) {
        return $this->wishlist_model->getUserWishListItemsCount($user_id);
    }

    /**
     * delete list items by id's
     *
     * @param array $ids
     * @access public
     * @author DevImageCms
     * @copyright (c) 2013, ImageCMS
     * @return boolean
     */
    public function deleteItemsByIds($ids) {
        return $this->wishlist_model->deleteItemsByIDs($ids);
    }

    /**
     * delete  image
     *
     * @param string $image image name
     * @access public
     * @author DevImageCms
     * @copyright (c) 2013, ImageCMS
     * @return boolean
     */
    public function deleteImage($image, $user_id) {
        $this->db->where('id', $user_id)->update('mod_wish_list_users', array('user_image' => ''));
        $basePath = substr(dirname(__FILE__), 0, strpos(dirname(__FILE__), "application"));
        return unlink($basePath . "uploads/mod_wishlist/" . $image);
    }

    /**
     * get popup for adding or moving items
     *
     * @access public
     * @author DevImageCms
     * @copyright (c) 2013, ImageCMS
     * @return boolean
     */
    public function renderPopup($userID = null) {
        $wish_lists = $this->wishlist_model->getWishLists($userID);
        if ($wish_lists) {
            $this->dataModel = $wish_lists;
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * send email
     */
    public function send_email($wish_list_id, $email) {
        $user = $this->wishlist_model->getUserByID($this->dx_auth->get_user_id());
        $wish_list = $this->db->where('id', $wish_list_id)->get('mod_wish_list');
        
        if ($wish_list) {
            $wish_list = $wish_list->row_array();
        } else {
            $wish_list = array();
        }
        $db_user = $this->db->where('id', $this->dx_auth->get_user_id())->get('users')->row_array();

        if ($user) {
            $name = $user['user_name'] ? $user['user_name'] : $this->dx_auth->get_username();
            $phone = $db_user['phone'] ? $db_user['phone'] : '(---) --- --- --- ';
            
            $user_variables = array(
                '$userName$' => $name,
                '$userPhone$' => $phone,
                '$wishName$' => $wish_list['title'],
                '$wishLink$' => site_url('wishlist/show/' . $wish_list['hash']),
                '$wishListViews$' =>  $wish_list['hash']['review_count'],
            );
            
            \cmsemail\email::getInstance()->sendEmail($email, 'wish_list', $user_variables);
            
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public function autoload() {
        
    }

    public static function adminAutoload() {
        parent::adminAutoload();
    }

    public function _install() {
        $this->wishlist_model->install();
    }

    public function _deinstall() {
        $this->wishlist_model->deinstall();
    }

}