<?php

require_once realpath(dirname(__FILE__) . '/../..') . '/enviroment.php';

doLogin();
/**
 * @property \Codeception\TestCase\Test $this Description
 */
class ParentWishlistTest extends \PHPUnit_Framework_TestCase {

    public $object = null;

    protected function setUp() {
        $this->object = new \wishlist\classes\ParentWishlist();
    }

    protected function tearDown() {

    }

    /**
     * @covers wishlist\classes\ParentWishlist::all
     * @todo   Implement testAll().
     */
    public function testAll() {
        $this->assertTrue($this->object->all(), 'Cant all');
    }

    /**
     * @covers wishlist\classes\ParentWishlist::show
     * @todo   Implement testShow().
     */
    public function testShow() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

    /**
     * @covers wishlist\classes\ParentWishlist::addReview
     * @todo   Implement testAddReview().
     */
    public function testAddReview() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

    /**
     * @covers wishlist\classes\ParentWishlist::getMostViewedWishLists
     * @todo   Implement testGetMostViewedWishLists().
     * @depends testAddReview
     */
    public function testGetMostViewedWishLists() {
        $this->assertTrue($this->object->getMostViewedWishLists(), 'Cant get most popular');
    }

    /**
     * @covers wishlist\classes\ParentWishlist::user
     * @todo   Implement testUser().
     */
    public function testUser() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

    /**
     * @covers wishlist\classes\ParentWishlist::userUpdate
     * @todo   Implement testUserUpdate().
     */
    public function testUserUpdate() {
        $this->assertTrue($this->object->userUpdate('9999999','test_name','544516462','test_desc'), 'Cant Update User');
    }

    /**
     * @covers wishlist\classes\ParentWishlist::updateWL
     * @todo   Implement testUpdateWL().
     */
    public function testUpdateWL() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

    /**
     * @covers wishlist\classes\ParentWishlist::createWishList
     * @todo   Implement testCreateWishList().
     */
    public function testCreateWishList() {
        $this->assertTrue($this->object->createWishList($GLOBALS['userId'],'test'), 'Cant all');
        return TRUE;
    }

    /**
     * @covers wishlist\classes\ParentWishlist::deleteWL
     * @todo   Implement testDeleteWL().
     */
    public function testDeleteWL() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

    /**
     * @covers wishlist\classes\ParentWishlist::_addItem
     * @todo   Implement test_addItem().
     */
    public function test_addItem() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

    /**
     * @covers wishlist\classes\ParentWishlist::moveItem
     * @todo   Implement testMoveItem().
     */
    public function testMoveItem() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

    /**
     * @covers wishlist\classes\ParentWishlist::deleteItem
     * @todo   Implement testDeleteItem().
     */
    public function testDeleteItem() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

    /**
     * @covers wishlist\classes\ParentWishlist::getUserInfo
     * @todo   Implement testGetUserInfo().
     */
    public function testGetUserInfo() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

    /**
     * @covers wishlist\classes\ParentWishlist::renderUserWL
     * @todo   Implement testRenderUserWL().
     */
    public function testRenderUserWL() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

    /**
     * @covers wishlist\classes\ParentWishlist::renderUserWLEdit
     * @todo   Implement testRenderUserWLEdit().
     */
    public function testRenderUserWLEdit() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

    /**
     * @covers wishlist\classes\ParentWishlist::do_upload
     * @todo   Implement testDo_upload().
     */
    public function testDo_upload() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

    /**
     * @covers wishlist\classes\ParentWishlist::getMostPopularItems
     * @todo   Implement testGetMostPopularItems().
     */
    public function testGetMostPopularItems() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

    /**
     * @covers wishlist\classes\ParentWishlist::getUserWishListItemsCount
     * @todo   Implement testGetUserWishListItemsCount().
     */
    public function testGetUserWishListItemsCount() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

    /**
     * @covers wishlist\classes\ParentWishlist::deleteItemByIds
     * @todo   Implement testDeleteItemByIds().
     */
    public function testDeleteItemByIds() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

    /**
     * @covers wishlist\classes\ParentWishlist::deleteImage
     * @todo   Implement testDeleteImage().
     */
    public function testDeleteImage() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

    /**
     * @covers wishlist\classes\ParentWishlist::renderPopup
     * @todo   Implement testRenderPopup().
     */
    public function testRenderPopup() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

    /**
     * @covers wishlist\classes\ParentWishlist::autoload
     * @todo   Implement testAutoload().
     */
    public function testAutoload() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

    /**
     * @covers wishlist\classes\ParentWishlist::adminAutoload
     * @todo   Implement testAdminAutoload().
     */
    public function testAdminAutoload() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

    /**
     * @covers wishlist\classes\ParentWishlist::_install
     * @todo   Implement test_install().
     */
    public function test_install() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

    /**
     * @covers wishlist\classes\ParentWishlist::_deinstall
     * @todo   Implement test_deinstall().
     */
    public function test_deinstall() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

}