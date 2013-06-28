<?php

require_once realpath(dirname(__FILE__) . '/../..') . '/enviroment.php';

doLogin();

/**
 * @property \Codeception\TestCase\Test $this
 */
class ParentWishlistTest extends \PHPUnit_Framework_TestCase {

    public $object = null;

    protected function setUp() {
        $this->object = new \wishlist\classes\ParentWishlist();
    }

    protected function tearDown() {

    }

    /**
     * @covers wishlist\classes\ParentWishlist::show
     */
    public function testShow() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

    /**
     * @covers wishlist\classes\ParentWishlist::userUpdate
     */
    public function testUserUpdate() {
        $this->assertTrue($this->object->userUpdate(999999, 'test_name', '544516462', 'test_desc'), 'Cant Update User');
    }

    /**
     * @covers wishlist\classes\ParentWishlist::all
     */
    public function testAll() {
        $this->assertTrue($this->object->all(), 'Cant all');
    }

    /**
     * @covers wishlist\classes\ParentWishlist::createWishList
     */
    public function testCreateWishList() {
        $this->assertTrue($this->object->createWishList(999999, 'test'), 'Cant create');
        $id = $this->object->db->insert_id();
        $this->object->db
                ->where('title', 'test')
                ->set('hash', '1')
                ->update('mod_wish_list');
        return $id;
    }

    /**
     * @covers wishlist\classes\ParentWishlist::addReview
     * @depends testCreateWishList
     */
    public function testAddReview($id) {
        $this->assertTrue($this->object->addReview(1), 'Cant add review');
    }

    /**
     * @covers wishlist\classes\ParentWishlist::user
     */
    public function testUser() {
        $this->assertTrue($this->object->user(999999));
        $this->assertTrue($this->object->user(999999), array('public', 'public', 'shared'));
    }

    /**
     * @covers wishlist\classes\ParentWishlist::getMostViewedWishLists
     */
    public function testGetMostViewedWishLists() {
        $this->assertTrue($this->object->getMostViewedWishLists(), 'Cant get most popular');
    }

    /**
     * @covers wishlist\classes\ParentWishlist::updateWL
     * @depends testCreateWishList
     */
    public function testUpdateWL($id) {
        $this->assertTrue($this->object->updateWL($id, array(), array()));
    }

    /**
     * @covers wishlist\classes\ParentWishlist::_addItem
     * @depends testCreateWishList
     */
    public function test_addItem($id) {
        $this->assertTrue($this->object->_addItem('1', $id, 'test'));
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
        $this->assertArrayHasKey('id', $this->object->getUserInfo(999999));
        $this->assertArrayHasKey('user_name', $this->object->getUserInfo(999999));
        $this->assertArrayHasKey('user_image', $this->object->getUserInfo(999999));
        $this->assertArrayHasKey('user_birthday', $this->object->getUserInfo(999999));
        $this->assertArrayHasKey('description', $this->object->getUserInfo(999999));
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
     * @covers wishlist\classes\ParentWishlist::deleteWL
     * @depends testCreateWishList
     */
    public function testDeleteWL($id) {
        $this->assertTrue($this->object->deleteWL($id));
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