<?php

use Banners\Models\BannersQuery;
use Banners\Models\Banners;
use Banners\Models\BannerImage;

class BannersQueryTest extends \Codeception\TestCase\Test {

    /**
     * @var \UnitTester
     */
    protected $tester;
    protected $locale = 'ru';
    protected $bannersTable = 'banners';
    protected $bannersTranslationsTable = 'banners_i18n';
    protected $bannersImagesTable = 'banner_image';
    protected $bannersImagesTranslationsTable = 'banner_image_i18n';
    protected $bannerPlace = 'test_banner';
    protected $imageSrc = 'some/path';

    public function testInit() {
        $bannersColection = BannersQuery::create()->findByPlace($this->bannerPlace);
        if (!$bannersColection->isEmpty()) {
            $bannersColection->delete();
        }
    }

    public function testActiveFilter() {

        $banner = $this->createBanner();
        $image = $this->createBannerImage(true);

        $banner->addBannerImage($image);
        $banner->save();

        $this->checkBanner(['id' => $banner->getId(), 'place' => $this->bannerPlace]);
        $this->checkBannerImage(['banner_id' => $banner->getId(), 'active' => true]);
        $this->checkBannerImageTranslations(['id' => $image->getId(), 'src' => $this->imageSrc]);

        $selectedBanner = BannersQuery::create()->getTranslatedByPlace($this->bannerPlace, $this->locale);
        $selectedSrc = $selectedBanner->getBannerImages()->getFirst()->getSrc();
        $this->tester->assertEquals($selectedSrc, $this->imageSrc);

        $image->setActive(false);
        $image->save();

        $this->checkBannerImage(['banner_id' => $banner->getId(), 'active' => false]);

        $selectedBannerNotActive = BannersQuery::create()->getTranslatedByPlace($this->bannerPlace, $this->locale);
        $this->tester->assertEmpty($selectedBannerNotActive);

        $banner->delete();
    }

    public function testLocale() {
        $this->locale = 'en';
        $banner = $this->createBanner();
        $bannerImage = $this->createBannerImage();
        $banner->addBannerImage($bannerImage);
        $banner->save();

        $this->checkBanner(['id' => $banner->getId()]);
        $this->checkBannerTranslations(['id' => $banner->getId(), 'locale' => $this->locale]);
        $this->checkBannerImage(['banner_id' => $banner->getId()]);
        $this->checkBannerImageTranslations(['id' => $bannerImage->getId(), 'locale' => $this->locale]);

        $selectedBannerWrite = BannersQuery::create()->getTranslatedByPlace($this->bannerPlace, $this->locale);
        $this->assertEquals($selectedBannerWrite->getId(), $banner->getId());

        $selectedBannerWrongLocale = \Banners\Models\BannersQuery::create()->getTranslatedByPlace($this->bannerPlace, 'ru');
        $this->assertEmpty($selectedBannerWrongLocale);

        $banner->delete();
    }

    public function testActiveFromTime() {
        $activeFrom = time() - (10 * 60);
        $banner = $this->createBanner();
        $bannerImage = $this->createBannerImage();
        $bannerImage->setActiveFrom($activeFrom);
        $banner->addBannerImage($bannerImage);
        $banner->save();

        $this->checkBannerImage(['banner_id' => $banner->getId(), 'active_from' => $activeFrom]);
        $selectedBannerWriteTime = \Banners\Models\BannersQuery::create()->getTranslatedByPlace($this->bannerPlace, $this->locale);
        $this->assertEquals($banner->getId(), $selectedBannerWriteTime->getId());

        $newActiveFrom = time() + (10 * 60);
        $bannerImage->setActiveFrom($newActiveFrom);
        $bannerImage->save();
        $this->checkBannerImage(['banner_id' => $banner->getId(), 'active_from' => $newActiveFrom]);
        $selectedBannerWrongTime = \Banners\Models\BannersQuery::create()->getTranslatedByPlace($this->bannerPlace, $this->locale);
        $this->assertEmpty($selectedBannerWrongTime);

        $banner->delete();
    }

    public function testActiveToTime() {
        $activeTo = time() + (10 * 60);
        $banner = $this->createBanner();
        $bannerImage = $this->createBannerImage();
        $bannerImage->setActiveTo($activeTo);
        $banner->addBannerImage($bannerImage);
        $banner->save();

        $this->checkBannerImage(['banner_id' => $banner->getId(), 'active_to' => $activeTo]);
        $selectedBannerWriteTime = \Banners\Models\BannersQuery::create()->getTranslatedByPlace($this->bannerPlace, $this->locale);
        $this->assertEquals($banner->getId(), $selectedBannerWriteTime->getId());

        $newActiveTo = time() - (10 * 60);
        $bannerImage->setActiveTo($newActiveTo);
        $bannerImage->save();
        $this->checkBannerImage(['banner_id' => $banner->getId(), 'active_to' => $newActiveTo]);
        $selectedBannerWrongTime = \Banners\Models\BannersQuery::create()->getTranslatedByPlace($this->bannerPlace, $this->locale);
        $this->assertEmpty($selectedBannerWrongTime);

        $banner->delete();
    }

    public function testBannerWithoutimages() {
        $banner = $this->createBanner();
        $banner->save();

        $this->checkBanner(['id' => $banner->getId()]);
        $this->tester->dontSeeInDatabase($this->bannersImagesTable, ['banner_id' => $banner->getId()]);
        $selectedBannerWithoutImages = \Banners\Models\BannersQuery::create()->getTranslatedByPlace($this->bannerPlace, $this->locale);
        $this->assertNull($selectedBannerWithoutImages);
        $banner->delete();
    }

    /**
     * @group image
     */
    public function testAllowedPages() {
        $allowedPage = 1;
        $allowedPag2 = 2;

        $bannerImage = $this->createBannerImage();
        $bannerImage->setAllowedPage($allowedPage);

        $bannerImage2 = $this->createBannerImage();
        $bannerImage2->setAllowedPage($allowedPage);

        $bannerImageNotAllowed = $this->createBannerImage();
        $bannerImageNotAllowed->setAllowedPage($allowedPag2);

        $banner = $this->createBanner();
        $banner->addBannerImage($bannerImage);
        $banner->addBannerImage($bannerImage2);
        $banner->addBannerImage($bannerImageNotAllowed);
        $banner->save();

        $imageIds = [$bannerImage->getId(), $bannerImage2->getId()];
        $banner->clear();

        $selectedBannerAllowed = BannersQuery::create()->getTranslatedByPlace($this->bannerPlace, $this->locale, $allowedPage);
        $images = $selectedBannerAllowed->getBannerImages();

        $this->assertEmpty(array_diff($images->getPrimaryKeys(), $imageIds));

        $banner->delete();
    }

    /* --------------------------------------------------------------------------
     *                      HELPERS
     */

    protected function checkBanner(array $checkData) {
        $this->tester->seeInDatabase($this->bannersTable, $checkData);
    }

    protected function checkBannerTranslations(array $checkData) {
        $this->tester->seeInDatabase($this->bannersTranslationsTable, $checkData);
    }

    protected function checkBannerImage(array $checkData) {
        $this->tester->seeInDatabase($this->bannersImagesTable, $checkData);
    }

    protected function checkBannerImageTranslations(array $checkData) {
        $this->tester->seeInDatabase($this->bannersImagesTranslationsTable, $checkData);
    }

    /**
     * @param type $place
     * @return \Banners\Models\Banners
     */
    protected function createBanner() {
        $banner = new Banners();
        $banner->setLocale($this->locale);
        $banner->setPlace($this->bannerPlace);
        $banner->setName($this->bannerPlace);
        return $banner;
    }

    /**
     * @param boolean $active
     * @param string $src
     * @param int $activeFrom
     * @param int $activeTo
     * @return \Banners\Models\BannerImage
     */
    protected function createBannerImage($active = true) {
        $bannerImage = new BannerImage();
        $bannerImage->setLocale($this->locale);
        $bannerImage->setSrc($this->imageSrc);
        $bannerImage->setActive($active);

        return $bannerImage;
    }
}
