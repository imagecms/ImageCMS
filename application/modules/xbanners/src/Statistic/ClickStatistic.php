<?php

namespace xbanners\src\Statistic;

use xbanners\models\BannerImageQuery;

/**
 * Click Statistic class
 */
class ClickStatistic
{

    /**
     * Banner image object
     * @var array|\Banners\Models\BannerImage|mixed
     */
    private $bannerImage;

    public function __construct($imageIdMd5, $locale = NULL) {

        $locale = $locale ? $locale : \MY_Controller::getCurrentLocale();

        $this->bannerImage = BannerImageQuery::create()
            ->joinWithI18n($locale)
            ->where('md5(BannerImage.Id) = ?', $imageIdMd5)
            ->findOne();
    }

    /**
     * Run click statistic
     */
    public function run() {

        if ($this->bannerImage->getUrl()) {
            $this->increaseClicks();
            $this->goToUrl();
        } else {
            \CI::$APP->core->error_404();
        }
    }

    /**
     * Increase banner image clicks value
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function increaseClicks() {

        $this->bannerImage->setClicks($this->bannerImage->getClicks() + 1);
        $this->bannerImage->save();
    }

    /**
     * Go to banner image url
     */
    private function goToUrl() {

        redirect($this->bannerImage->getUrl(), 'location', '301');
    }

    /**
     * Get click statistic
     * @param $imageId - banner image id
     * @return string
     */
    public static function getUrl($imageId) {

        return site_url('xbanners/go') . '/' . md5($imageId);
    }

}