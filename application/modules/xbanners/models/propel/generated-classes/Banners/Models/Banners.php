<?php

namespace Banners\Models;

use Banners\Models\Base\Banners as BaseBanners;

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
class Banners extends BaseBanners {

    /**
     * Show banner view
     * @return string
     */
    public function show() {
        return (new \Banners\Entities\BannerView($this))->show();
    }

    /**
     * Set banner effects
     * @param array $param
     */
    public function setEffects(array $param) {
        parent::setEffects((string) (new \Banners\Entities\BannerEffects($param)));
    }

    /**
     * Get banner effects
     * @return \Banners\Entities\BannerEffects
     */
    public function getEffects() {
        return new \Banners\Entities\BannerEffects(parent::getEffects());
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