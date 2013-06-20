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
    }

    function index() {
        $w = parent::renderUserWL();
        \CMSFactory\assetManager::create()
                ->registerScript('wishlist')
                ->registerStyle('style')
                ->setData('wishlists', $w)
                ->render('wishlist');
    }

    public function renderWLButton($varId) {
        if (!in_array($varId, $this->userWishProducts))
            \CMSFactory\assetManager::create()
                    ->registerScript('wishlist')
                    ->setData('data', $data)
                    ->setData('varId', $varId)
                    ->setData('value', 'Добавить в Список Желания')
                    ->setData('class', 'btn')
                    ->setData('max_lists_count', $this->settings['maxListsCount'])
                    ->render('button', true);
        else
            \CMSFactory\assetManager::create()
                    ->registerScript('wishlist')
                    ->setData('data', $data)
                    ->setData('varId', $varId)
                    ->setData('value', 'Уже в Списке Желания')
                    ->setData('max_lists_count', $this->settings['maxListsCount'])
                    ->setData('class', 'btn inWL')
                    ->render('button', true);
    }

    public function renderPopup($varId) {
        $wish_lists = $this->wishlist_model->getWishLists();
        $back_linck = $_SERVER['HTTP_REFERER'];

        $data = array('wish_lists' => $wish_lists, 'backlinck' => $back_linck);

        return $popup = \CMSFactory\assetManager::create()
                ->registerStyle('style')
                ->setData('value', 'Добавить в Список Желания')
                ->setData('class', 'btn')
                ->setData('varId', $varId)
                ->setData($data)
                ->setData('max_lists_count', $this->settings['maxListsCount'])
                ->render('wishPopup', false);
        return json_encode(array('popup' => $popup));
    }

}

/* End of file wishlist.php */
