<?php

use Banners\Managers\ImagesManager;

class ImagesManagerTest extends \Codeception\TestCase\Test {
    /**
     * @var \UnitTester
     */
    protected $tester;

    public static $TEST_IMAGE_NAME = 'image_name.jpg';

    /**
     * @var \Banners\Models\Banners
     */
    public static $TEST_BANNER;

    /**
     * @var \Banners\Models\BannerImage
     */
    public static $TEST_BANNER_IMAGE;
    /**
     * @var ImagesManager
     */
    public static $IM;

    protected function _before() {

    }

    protected function _after() {
    }


    public static function setUpBeforeClass() {
        self::$IM = ImagesManager::getInstance();
        /**
         * Create banner
         */

        self::$TEST_BANNER = new \Banners\Models\Banners();
        self::$TEST_BANNER->setName('TEST BANNER NANE');
        self::$TEST_BANNER->setEffects('');
        self::$TEST_BANNER->setHeight('100');
        self::$TEST_BANNER->setWidth('100');
        self::$TEST_BANNER->setPageType('main');
        self::$TEST_BANNER->setLocale('ru');
        self::$TEST_BANNER->setPlace('shop_category_top');
        self::$TEST_BANNER->save();

        /**
         * Create banner image
         */
        self::$TEST_BANNER_IMAGE = new \Banners\Models\BannerImage();
        self::$TEST_BANNER_IMAGE->setBannerId(self::$TEST_BANNER->getId());
        self::$TEST_BANNER_IMAGE->setActive(1);
        self::$TEST_BANNER_IMAGE->setClicks(10);
        self::$TEST_BANNER_IMAGE->setLocale('ru');
        self::$TEST_BANNER_IMAGE->setActiveFrom(NULL);
        self::$TEST_BANNER_IMAGE->setActiveTo(NULL);
        self::$TEST_BANNER_IMAGE->setAllowedPage(2);
        self::$TEST_BANNER_IMAGE->setName('TEST IMAGE');
        self::$TEST_BANNER_IMAGE->setPermanent(1);
        self::$TEST_BANNER_IMAGE->setSrc('/test/image/' . self::$TEST_IMAGE_NAME);
        self::$TEST_BANNER_IMAGE->setUrl('http://test/image/url');
        self::$TEST_BANNER_IMAGE->setTarget(0);
        self::$TEST_BANNER_IMAGE->save();

    }


    public static function tearDownAfterClass() {
        /**
         * Delete banner
         */
        \Banners\Models\BannersQuery::create()->findPk(self::$TEST_BANNER->getId())->delete();

    }

    public function testGetInstance() {
        $this->assertInstanceOf('Banners\Managers\ImagesManager', self::$IM->getInstance());
    }

    // tests
    public function testGetImageOriginPath() {
        $expected = ImagesManager::IMAGES_ORIGIN_DIR_PATH . self::$TEST_IMAGE_NAME;
        $actual = self::$IM->getImageOriginPath(self::$TEST_IMAGE_NAME);
        $this->assertEquals($expected, $actual);

        $this->assertNull(self::$IM->getImageOriginPath());
    }

    public function testGetImageTunedPath() {
        $expected = ImagesManager::IMAGES_TUNED_DIR_PATH . self::$TEST_IMAGE_NAME;
        $actual = self::$IM->getImageTunedPath(self::$TEST_IMAGE_NAME);
        $this->assertEquals($expected, $actual);

        $this->assertNull(self::$IM->getImageTunedPath());
    }

    public function testDelete() {
        $this->assertFalse(self::$IM->delete(NULL));

        $badImageId = '123456';
        $this->assertFalse(self::$IM->delete($badImageId));
        $this->assertTrue(self::$IM->delete(self::$TEST_BANNER_IMAGE->getId(), self::$TEST_BANNER_IMAGE->getLocale()));
        $this->assertNull(self::$TEST_BANNER_IMAGE->getSrc());
    }

    public function testGetImagesByPageType() {
        $this->assertInternalType('array', self::$IM->getImagesByPageType(self::$TEST_BANNER, 'ru'));
    }


}

// codecept_debug();