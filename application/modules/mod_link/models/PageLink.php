<?php

namespace mod_link\models;

use mod_link\models\Base\PageLink as BasePageLink;
use SProductsQuery;

/**
 * Skeleton subclass for representing a row from the 'page_link' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class PageLink extends BasePageLink
{

    private $productsCached = [];

    /**
     * @var array
     */
    private $pageData;

    /**
     * @return array
     */
    public function getPageData() {
        return $this->pageData;
    }

    /**
     * @param array $pageData
     */
    public function setPageData($pageData) {
        $this->pageData = $pageData;
    }

    public function getLinkedProducts($locale = null) {

        $locale = $locale ?: \MY_Controller::getCurrentLocale();
        if (!array_key_exists($locale, $this->productsCached)) {

            $productIds = $this->getPageLinkProducts(PageLinkProductQuery::create()->select('ProductId'))->getData();

            $products = [];
            if (count($productIds)) {
                $products = SProductsQuery::create()
                    ->joinWithI18n($locale)
                    ->filterByPrimaryKeys($productIds)->find()->getData();
            }
            $this->productsCached[$locale] = $products;
        }

        return $this->productsCached[$locale];

    }

    /**
     * Get the [active_from] column value.
     *
     * @param bool $format
     * @return int
     */
    public function getActiveFrom($format = false) {
        $date = parent::getActiveFrom();
        return $format ? $this->formatDate($date, $format) : $date;

    }

    /**
     * Get the [active_to] column value.
     *
     * @param bool $format
     * @return int
     */
    public function getActiveTo($format = false) {

        $date = parent::getActiveTo();
        return $format ? $this->formatDate($date, $format) : $date;

    }

    /**
     * Format date
     * @param $unixTimeStamp
     * @param bool $format
     * @return bool|string
     */
    private function formatDate($unixTimeStamp, $format = false) {
        $format = is_string($format) ? $format : 'd-m-Y';
        return $unixTimeStamp ? date($format, $unixTimeStamp) : null;
    }

}