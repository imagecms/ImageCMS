<?php

require_once realpath(dirname(__FILE__) . '/../..') . '/enviroment.php';

doLogin();

class ParentWishlistTest extends \PHPUnit_Framework_TestCase {

    public $object = null;

    protected function setUp() {
        $this->object = new \wishlist\classes\ParentWishlist();
    }

    protected function tearDown() {

    }

    /**
     * @dataProvider provider
     */
    public function testCreate10WL($a, $b) {
        $this->assertTrue($this->object->createWishList($a, $b), 'All cool, Bro!');
    }

    /**
     * @dataProvider provider
     */
    public function testCreateWOverLimit($a, $b) {
        $this->assertFalse($this->object->createWishList($a, $b), 'All cool, Bro!');
    }

    public function testRemoveAllWL() {
        $wllist = $this->object->wishlist_model->getWLsByUserId($GLOBALS['userId'], array('public', 'shared', 'private'));
        foreach ($wllist as $value) {
            $this->assertTrue($this->object->deleteWL($value['id']));
        }
    }

    public function provider() {
        return array(
            array($GLOBALS['userId'], 'name1'),
            array($GLOBALS['userId'], 'name2'),
            array($GLOBALS['userId'], 'name3'),
            array($GLOBALS['userId'], 'name4'),
            array($GLOBALS['userId'], 'name5'),
            array($GLOBALS['userId'], 'name6'),
            array($GLOBALS['userId'], 'name7'),
            array($GLOBALS['userId'], 'name8'),
            array($GLOBALS['userId'], 'name9'),
            array($GLOBALS['userId'], 'name10'),
        );
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
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
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
     * @covers wishlist\classes\ParentWishlist::createWL
     * @todo   Implement testCreateWL().
     */
    public function testCreateWL() {
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
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
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