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
    }

    public function all() {
        $parent = parent::all();
        if ($parent) {
            return $this->dataModel;
        } else {
            return $this->errors;
        }
    }

    public function _addItem($varId) {
        $listId = $this->input->post('wishlist');
        $listName = $this->input->post('wishListName');

        if (parent::_addItem($varId, $listId, $listName)) {
            return $this->dataModel;
        } else {
            return $this->errors;
        }
    }

    public function moveItem($varId, $wish_list_id) {
        $to_listId = $this->input->post('wishlist');
        $to_listName = $this->input->post('wishListName');

        if (parent::moveItem($varId, $wish_list_id, $to_listId, $to_listName)) {
            return $this->dataModel = "Операция успешна";
        } else {
            return $this->errors = "Не удалось переместить";
        }
    }

    public function deleteItem($variant_id, $wish_list_id) {
        if(parent::deleteItem($variant_id, $wish_list_id)){
            return $this->dataModel;
        }else{
            return $this->errors;
        }
    }
    
    public function deleteItemByIds(){
        $items = $this->input->post('listItem');
        if($items){
            if(parent::deleteItemByIds($items)){
                return $this->dataModel[] = lang('deleted');
            }else{
                return $this->errors[] = lang('error_cant_delete');
            }
        }
     }

    public function show($hash) {
        if (parent::show($hash)) {
            return $this->dataModel;
        } else {
            return $this->errors;
        }
    }

    public function getMostViewedWishLists($limit = 10) {
        if (parent::getMostViewedWishLists($limit)) {
            return $this->dataModel;
        } else {
            return $this->errors;
        }
    }

    public function user($user_id) {
        if (parent::user($user_id)) {
            return $this->dataModel;
        } else {
            return $this->errors;
        }
    }

    public function userUpdate() {

        if ($this->settings['maxDescLenght'] < iconv_strlen($this->input->post('description'), 'UTF-8'))
            $desc = substr($this->input->post('description'), 0, $this->settings['maxDescLenght']);
        else
            $desc = $this->input->post('description');

        if (!(strtotime($this->input->post('user_birthday')) + 50000))
            return false;

        $updated = parent::userUpdate($this->input->post('user_id'), $this->input->post('user_name'), strtotime($this->input->post('user_birthday')) + 50000, $desc);
        if ($updated) {
            return $this->dataModel = "Обновлено";
        } else {
            return $this->errors = "Не обновлено";
        }
    }

     public function getMostPopularItems($limit = 10) {
        if (parent::getMostPopularItems($limit)) {
            return $this->dataModel;
        } else {
            return $this->errors;
        }
    }


    public function createWishList() {
        $listName = $this->input->post('wishListName');
        $user_id = $this->input->post('user_id');

        if (parent::createWishList($user_id, $listName)) {
            return $this->dataModel = "Создано";
        } else {
            return $this->errors;
        }
    }

    public function deleteWL($wish_list_id) {
        if(parent::deleteWL($wish_list_id)){
            return $this->dataModel;
        }else{
            return $this->errors;
        }
    }


    public function updateWL() {
        $id = $this->input->post('WLID');

        foreach ($this->input->post('comment') as $key => $comment) {
            if ($this->settings['maxCommentLenght'] < iconv_strlen($comment, 'UTF-8'))
                $desc[$key] = substr($comment, 0, $this->settings['maxDescLenght']);
            else
                $desc[$key] = $comment;
        }

        if ($this->settings['maxListName'] < iconv_strlen($this->input->post('title'), 'UTF-8'))
            $title = substr($this->input->post('title'), 0, $this->settings['maxListName']);
        else
            $title = $this->input->post('title');

        $data = array(
            'access' => $this->input->post('access'),
            'title' => $title,
        );

        if(parent::updateWL($id, $data, $desc, $title)){
            return $this->dataModel;
        }else{
            return $this->errors;
        }
    }

    public function deleteImage(){
       $image = $this->input->post('image');
       if(parent::deleteImage($image)){
           return $this->dataModel[] = "Успешно удалено";
       }else{
           return $this->errors[] = "Ошибка";
       }
    }

    public function do_upload() {
        if($this->input->post('userID')){
            if (parent::do_upload($this->input->post('userID'))) {
                if (!$this->upload->do_upload()) {
                    $this->errors[] = $this->upload->display_errors();
                    return $this->errors[] = lang('error_download');
                } else {
                    $this->dataModel = array('upload_data' => $this->upload->data());
                    $this->wishlist_model->setUserImage($this->input->post('userID'), $this->dataModel['upload_data']['file_name']);
                    return $this->dataModel[] = lang('picture_uploaded');
                }
                return $this->dataModel[] = lang('picture_uploaded');
            } else {
                return $this->errors[] = lang('error_upload_photo');
            }     
        }else{
            return $this->errors[] = lang('error_user_id');
        }
    }



    public function renderPopup(){
         if(parent::renderPopup()){
             return $this->dataModel;
         }else{
             return $this->errors;
         }
    }

}
