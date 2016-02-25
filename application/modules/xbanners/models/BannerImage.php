<?php

namespace xbanners\models;

use xbanners\models\Base\BannerImage as BaseBannerImage;
use xbanners\src\Managers\ImagesManager;
use xbanners\src\Statistic\ClickStatistic;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\Map\TableMap;

/**
 * Skeleton subclass for representing a row from the 'banner_image' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class BannerImage extends BaseBannerImage
{

    /**
     * Form BannerImage object from array
     * @param array $arr - array data of BannerImage fields
     * @param string $keyType
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_FIELDNAME) {
        parent::fromArray($arr, $keyType);
    }

    /**
     * Get origin image file path
     * @return null|string
     */
    public function getImageOriginPath() {
        if (!$this->getSrc()) {
            return NULL;
        }

        $imagePath = ImagesManager::getInstance()->getImageOriginPath($this->getSrc());

        return file_exists(".$imagePath") ? $imagePath : NULL;
    }

    /**
     * Get click statistic url
     * @return string
     */
    public function getStatisticUrl() {
        if (!$this->getUrl()) {
            return '';
        }

        return ClickStatistic::getUrl($this->getId());
    }

    /**
     * Set last position to banner image
     * @return int
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setLastPosition() {
        $lastBannerImage = BannerImageQuery::create()
                ->filterByBannerId($this->getBannerId())
                ->orderByPosition(Criteria::DESC)
                ->findOne();

        $position = $lastBannerImage ? ($lastBannerImage->getPosition() + 1) : 0;
        $this->setPosition($position);
        return $this->save();
    }

}