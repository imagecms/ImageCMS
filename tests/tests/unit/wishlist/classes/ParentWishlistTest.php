<?php

require_once realpath(dirname(__FILE__) . '/../../../..') . '/enviroment.php';

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
     * @covers wishlist\classes\ParentWishlist::renderPopup
     * @depends testCreateWishList
     */
    public function testRenderPopup() {
        $this->assertTrue($this->object->renderPopup(999999));
        $this->assertFalse($this->object->renderPopup(4322343));
    }

    /**
     * @covers wishlist\classes\ParentWishlist::show
     * @depends testCreateWishList
     */
    public function testShow() {
        $this->assertTrue($this->object->show(1, array('public', 'shared', 'private')));
        $this->assertFalse($this->object->show(3, array('public', 'shared', 'private')));
    }

    /**
     * @covers wishlist\classes\ParentWishlist::_addItem
     * @depends testCreateWishList
     */
    public function test_addItem($id) {
        $this->assertTrue($this->object->_addItem('1031', $id, '', 999999));
        return $this->object->db->insert_id();
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
        $this->assertFalse($this->object->user(999999));
        $this->assertTrue($this->object->user(999999, array('public', 'shared', 'private')));
    }

    /**
     * @covers wishlist\classes\ParentWishlist::getMostViewedWishLists
     */
    public function testGetMostViewedWishLists() {
        $this->assertTrue($this->object->getMostViewedWishLists(), 'Cant get most viewed');
    }

    /**
     * @covers wishlist\classes\ParentWishlist::getMostPopularItems
     */
    public function testGetMostPopularItems() {
        $this->assertTrue($this->object->getMostPopularItems(), 'Cant get most popular');
    }

    /**
     * @covers wishlist\classes\ParentWishlist::updateWL
     * @depends testCreateWishList
     */
    public function testUpdateWL($id) {
        $this->assertTrue($this->object->updateWL($id, array(), array()));
    }

    /**
     * @covers wishlist\classes\ParentWishlist::moveItem
     * @depends testCreateWishList
     */
    public function testMoveItem($id) {
        $this->assertTrue($this->object->moveItem('1031', $id, '2', 'test2', 999999));
    }

    /**
     * @covers wishlist\classes\ParentWishlist::deleteItem
     * @depends testCreateWishList
     */
    public function testDeleteItem($id) {
        $this->object->wishlist_model->addItem(1031, $id, '');
        $this->assertTrue($this->object->deleteItem('1031', $id));
    }

    /**
     * @covers wishlist\classes\ParentWishlist::getUserInfo
     */
    public function testGetUserInfo() {
        $this->assertArrayHasKey('id', $this->object->getUserInfo(999999));
        $this->assertArrayHasKey('user_name', $this->object->getUserInfo(999999));
        $this->assertArrayHasKey('user_image', $this->object->getUserInfo(999999));
        $this->assertArrayHasKey('user_birthday', $this->object->getUserInfo(999999));
        $this->assertArrayHasKey('description', $this->object->getUserInfo(999999));
    }

    /**
     * @covers wishlist\classes\ParentWishlist::getUserWL
     */
    public function testRenderUserWL() {
        $this->assertTrue($this->object->getUserWL(999999, array('public', 'shared', 'private')));
    }

    /**
     * @covers wishlist\classes\ParentWishlist::renderUserWLEdit
     * @depends testCreateWishList
     */
    public function testRenderUserWLEdit($id) {
        $this->assertTrue($this->object->renderUserWLEdit($id, 999999));
        $this->assertFalse($this->object->renderUserWLEdit('as', 999999));
    }

    /**
     * @covers wishlist\classes\ParentWishlist::do_upload
     */
    public function testDo_upload() {
        $_FILES = array(
            'userfile' =>
            array(
                'name' => '002.png',
                'type' => 'image/png',
                'tmp_name' => '/tmp/php7k30REd',
                'error' => 0,
                'size' => 343));
        $this->assertTrue($this->object->do_upload(47));

        $_FILES = array(
            'userfile' =>
            array(
                'name' => '002.png',
                'type' => 'image/pn2g',
                'tmp_name' => '/tmp/php7k30REd',
                'error' => 0,
                'size' => 343));
        $this->assertFalse($this->object->do_upload(47));

        $_FILES = array(
            'userfile' =>
            array(
                'name' => '002.png',
                'type' => 'image/pn2g',
                'tmp_name' => '/tmp/php7k30REd',
                'error' => 0,
                'size' => 344444444443));
        $this->assertFalse($this->object->do_upload(47));
    }

    /**
     * @covers wishlist\classes\ParentWishlist::getUserWishListItemsCount
     * @depends test_addItem
     */
    public function testGetUserWishListItemsCount() {
        $this->assertInternalType('int', $this->object->getUserWishListItemsCount(999999));
    }

    /**
     * @covers wishlist\classes\ParentWishlist::deleteItemsByIds
     * @depends testCreateWishList
     * @depends test_addItem
     */
    public function testDeleteItemsByIds($id) {
        for ($i = 0; $i < 6; $i++) {
            $this->assertTrue($this->object->_addItem('1031', $id, '', 999999));
            $ids[] = $this->object->db->insert_id();
        }
        $this->assertTrue($this->object->deleteItemsByIds($ids));
    }

    /**
     * @covers wishlist\classes\ParentWishlist::deleteImage
     */
    public function testDeleteImage() {
        write_file('../../../../../uploads/mod_wishlist/test.png', '');
        $this->assertTrue($this->object->deleteImage('test.png'));
        $this->assertFalse($this->object->deleteImage('test.png'));
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

    /**
     * @covers wishlist\classes\ParentWishlist::deleteAllWL
     */
    public function testDeleteAllWL() {
        $this->assertTrue($this->object->deleteAllWL(999999));
    }

}