<?php

require_once realpath(dirname(__FILE__) . '/../../..') . '/enviroment.php';

doLogin();

class WishlistGlobalTest extends \PHPUnit_Framework_TestCase {

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

}