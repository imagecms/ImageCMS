<?php

require_once realpath(dirname(__FILE__) . '/../..') . '/enviroment.php';

class WishlistApiTest extends \Codeception\TestCase\Test {

    /**
     * @var \CodeGuy
     */
    protected $codeGuy;

    protected function _before() {
//        include APPPATH . 'modules/wishlist/wishlistApi.php';
    }

    protected function _after() {
        
    }

    public function testM1e() {
                include APPPATH . 'modules/wishlist/wishlistApi.php';
//        $model = new WishlistApi();        
    }

    public function testMyUser() {
//        include APPPATH . 'modules/wishlist/wishlistApi.php';
////        $model = new WishlistApi();        
    }

}