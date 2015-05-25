<?php
use Banners\Statistic\ClickStatistic;

class ClickStatisticTest extends \Codeception\TestCase\Test {
    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * @var ClickStatistic
     */
    protected static $CS;

    public static $TEST_IMAGE_NAME = 'image_name.jpg';
    /**
     * @var \Banners\Models\Banners
     */
    public static $TEST_BANNER;

    /**
     * @var \Banners\Models\BannerImage
     */
    public static $TEST_BANNER_IMAGE;

    protected function _before() {

    }

    protected function _after() {
    }

    public static function setUpBeforeClass() {
        /**
         * Create banner
         */

        self::$TEST_BANNER = new \Banners\Models\Banners();
        self::$TEST_BANNER->setName('TEST BANNER NANE');
        self::$TEST_BANNER->setEffects(array());
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

        self::$CS = new ClickStatistic(md5(self::$TEST_BANNER_IMAGE->getId()), 'ru');

    }


    public static function tearDownAfterClass() {
        /**
         * Delete banner
         */
        \Banners\Models\BannersQuery::create()->findPk(self::$TEST_BANNER->getId())->delete();

    }

    // tests
    public function testConstruct() {
        $this->assertInstanceOf('Banners\Statistic\ClickStatistic', self::$CS);
        $this->assertAttributeNotEmpty('bannerImage', self::$CS);
        $this->assertAttributeInstanceOf('Banners\Models\BannerImage', 'bannerImage', self::$CS);


    }

    public function testIncreaseClicks() {
        $beforeClicksCount = self::$TEST_BANNER_IMAGE->getClicks();

        self::$CS->increaseClicks();
        $afterClicksCount = self::$TEST_BANNER_IMAGE->getClicks();
        $this->assertNotEquals($beforeClicksCount, $afterClicksCount);
        $this->assertEquals(++$beforeClicksCount, $afterClicksCount);

        self::$CS->increaseClicks();
        $afterClicksCount = self::$TEST_BANNER_IMAGE->getClicks();
        $this->assertNotEquals($beforeClicksCount, $afterClicksCount);
        $this->assertEquals(++$beforeClicksCount, $afterClicksCount);
    }

    public function testGetUrl() {
        $imageUrl = ClickStatistic::getUrl(self::$TEST_BANNER_IMAGE->getId());
        $this->assertInternalType('string', $imageUrl);
        $this->assertStringStartsWith('http', $imageUrl);
        $this->assertContains('xbanners/go', $imageUrl);
        $this->assertContains(md5(self::$TEST_BANNER_IMAGE->getId()), $imageUrl);
    }

}