<?php

use Banners\Managers\BannerPageTypesManager;

class BannerPageTypesManagerTest extends \Codeception\TestCase\Test {
    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * @var BannerPageTypesManager;
     */
    protected static $BPTM;

    protected function _before() {
        self::$BPTM = BannerPageTypesManager::getInstance();
    }

    protected function _after() {
    }

    
    public function testGetInstance() {
        $this->assertInstanceOf('Banners\Managers\BannerPageTypesManager', self::$BPTM);
    }

    public function testGetPagesTypes() {
        $this->assertInternalType('array', self::$BPTM->getPagesTypes());
        $this->assertCount(7, self::$BPTM->getPagesTypes());

        $categoryPageType = self::$BPTM->getPagesTypes(BannerPageTypesManager::PAGE_TYPE_CATEGORY);
        $this->assertInternalType('array', $categoryPageType);
        $this->assertCount(2, $categoryPageType);
        $this->assertNotEmpty($categoryPageType['name']);
        $this->assertNotEmpty($categoryPageType['class']);
        $this->assertInternalType('string', $categoryPageType['name']);
        $this->assertInternalType('string', $categoryPageType['class']);
    }

    public function testGetView() {
        $this->assertNull(self::$BPTM->getView(BannerPageTypesManager::PAGE_TYPE_MAIN, 'ru'));
    }

    public function testGetPages() {
        $this->assertNull(self::$BPTM->getPages(BannerPageTypesManager::PAGE_TYPE_MAIN, 'ru'));
    }


}

//codecept_debug(self::$BPTM->getPagesTypes(BannerPageTypesManager::PAGE_TYPE_CATEGORY));

// codecept_debug();