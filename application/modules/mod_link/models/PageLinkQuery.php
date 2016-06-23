<?php

namespace mod_link\models;

use mod_link\models\Base\PageLinkQuery as BasePageLinkQuery;
use mod_link\models\Map\PageLinkTableMap;

/**
 * Skeleton subclass for performing query and update operations on the 'page_link' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class PageLinkQuery extends BasePageLinkQuery
{

    public function findOneActiveByPageId($pageId) {

        return $this
            ->filterByaActive()
        //            ->condition('permanentCondition', PageLinkTableMap::COL_PERMANENT . ' = ?', true)
        //            ->condition('activeFrom', PageLinkTableMap::COL_ACTIVE_FROM . ' <= ?', time())
        //            ->condition('activeTo', PageLinkTableMap::COL_ACTIVE_TO . ' >= ?', time())
        //            ->combine(['activeFrom', 'activeTo'], 'and', 'dateCondition')
        //            ->where(['permanentCondition', 'dateCondition'], 'or')
            ->findOneByPageId($pageId);
    }

    public function filterByaActive() {
        $this->condition('permanentCondition', PageLinkTableMap::COL_PERMANENT . ' = ?', true)
            ->condition('activeFrom', PageLinkTableMap::COL_ACTIVE_FROM . ' <= ?', time())
            ->condition('activeTo', PageLinkTableMap::COL_ACTIVE_TO . ' >= ?', time())
            ->combine(['activeFrom', 'activeTo'], 'and', 'dateCondition')
            ->where(['permanentCondition', 'dateCondition'], 'or');
        return $this;
    }

}