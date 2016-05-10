<?php

namespace xbanners\src\UrlFinder\Finders;

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
     * @param string $url
     * @return string
     */
    public function formUrl($url) {
        return '/shop/category/' . $url;
    }

}