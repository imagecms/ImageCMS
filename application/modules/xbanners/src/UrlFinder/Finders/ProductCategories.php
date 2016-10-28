<?php

namespace xbanners\src\UrlFinder\Finders;

use Propel\Runtime\ActiveQuery\Criteria;
use xbanners\src\UrlFinder\Results\Result;

final class ProductCategories extends BaseFinder
{

    protected $table = 'shop_category';

    protected $translations = 'shop_category_i18n';

    protected $nameColumn = 'shop_category_i18n.name';

    protected $urlColumn = 'shop_category.full_path as url';

    protected $langColumn = 'shop_category_i18n.locale';

    /**
     * @return string
     */
    public function getGroupName() {
        return lang('Product Categories', 'xbanners');
    }

    /**
     * @param string $word
     * @param string $language
     * @param integer $limit
     * @return Result
     */
    public function getResultsFor($word, $language, $limit = 10) {
        /* @var $db \CI_DB_active_record */
        $products = \SCategoryQuery::create()
            ->joinWithI18n($language)
            ->joinWithRoute()
            ->useI18nQuery($language, null, Criteria::INNER_JOIN)
            ->filterByName('%' . $word . '%', Criteria::LIKE)
            ->endUse()
            ->limit($limit)
            ->find();

        $result = new Result($this->getGroupName());
        foreach ($products as $oneResult) {
            $result->addResult($oneResult->getName(), $this->formUrl($oneResult->getRouteUrl()));
        }
        return $result;
    }

    /**
     * @param string $url
     * @return string
     */
    public function formUrl($url) {
        return '/' . $url;
    }

}