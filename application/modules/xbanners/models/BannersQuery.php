<?php

namespace xbanners\models;

use xbanners\models\Base\BannersQuery as BaseBannersQuery;
use Propel\Runtime\ActiveQuery\Criteria;

/**
 * Skeleton subclass for performing query and update operations on the 'banners' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class BannersQuery extends BaseBannersQuery
{

    /**
     * Get fully translated banner data filtered
     * by current page id and date
     * for usage in front end
     *
     * @param string $place
     * @param string $locale en | ru
     * @param int|null $AllowedPageId
     * @return Banners
     */
    public function getTranslatedByPlace($place, $locale = null, $AllowedPageId = null) {
        if (!$locale) {
            $locale = \MY_Controller::defaultLocale();
        }
        $query = $this
            ->joinWithI18n($locale)
            ->filterByPlace($place)
            ->joinWithBannerImage()
            ->useBannerImageQuery()
            ->orderByPosition(Criteria::DESC)
        //------------------------------------------------------------banner image query
            ->filterByActive(true)
            ->filterByActiveFrom(['max' => time()])
            ->_or()
            ->where('active_from is null')
            ->filterByActiveTo(['min' => time()])
            ->_or()
            ->where('active_to is null');
        if (is_numeric($AllowedPageId)) {
            $query = $query->filterByAllowedPage([$AllowedPageId, 0]);
        }

        return $query->joinWithI18n($locale, Criteria::INNER_JOIN)
        //-----------------------------------------------------------/banner image query
            ->endUse()
            ->find()
            ->getFirst();
    }

}