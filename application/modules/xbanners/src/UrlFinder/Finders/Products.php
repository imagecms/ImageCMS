<?php

namespace xbanners\src\UrlFinder\Finders;

final class Products extends BaseFinder
{

    protected $table = 'shop_products';

    protected $translations = 'shop_products_i18n';

    protected $nameColumn = 'shop_products_i18n.name';

    protected $urlColumn = 'shop_products.url';

    protected $langColumn = 'shop_products_i18n.locale';

    /**
     * @return string
     */
    public function getGroupName() {
        return lang('Products', 'xbanners');
    }

    /**
     * @param string $url
     * @return string
     */
    public function formUrl($url) {
        return '/shop/product/' . $url;
    }

}