<?php

namespace xbanners\models;

use xbanners\models\Base\BannerImageI18n as BaseBannerImageI18n;
use Propel\Runtime\Map\TableMap;

/**
 * Skeleton subclass for representing a row from the 'banner_image_i18n' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class BannerImageI18n extends BaseBannerImageI18n
{

    public function fromArray($arr, $keyType = TableMap::TYPE_FIELDNAME) {
        parent::fromArray($arr, $keyType);
    }

}