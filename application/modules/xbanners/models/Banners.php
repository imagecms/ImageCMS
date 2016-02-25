<?php

namespace xbanners\models;

use xbanners\models\Base\Banners as BaseBanners;
use xbanners\src\Entities\BannerEffects;
use xbanners\src\Entities\BannerView;

/**
 * Skeleton subclass for representing a row from the 'banners' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class Banners extends BaseBanners
{

    /**
     * Show banner view
     * @return string
     */
    public function show() {
        return (new BannerView($this))->show();
    }

    /**
     * Set banner effects
     * @param array $param
     * @return void
     */
    public function setEffects($param) {
        parent::setEffects((string) (new BannerEffects($param)));
    }

    /**
     * Get banner effects
     * @return BannerEffects
     */
    public function getEffects() {
        return new BannerEffects(parent::getEffects());
    }

    /**
     * Banner object to array
     * @return array
     */
    public function asArray() {
        $banner = array_merge(
            $this->toArray(),
            $this->getCurrentTranslation()->toArray()
        );
        $this->initBannersI18ns();
        $imagesArray = [];
        foreach ($this->getBannerImages() as $key => $oneImage) {
            $imageTranslationArray = $oneImage->getCurrentTranslation()->toArray();
            $imageArray = $oneImage->toArray();
            $imagesArray[$key] = array_merge($imageArray, $imageTranslationArray);
        }
        $banner['BannerImages'] = $imagesArray;
        return $banner;
    }

    /**
     * Get banner preview image src
     * @return string
     */
    public function getPreviewSrc() {
        return getBannerPreviewSrc($this->getPlace());
    }

}