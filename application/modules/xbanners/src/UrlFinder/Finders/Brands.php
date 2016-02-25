<?php

namespace xbanners\src\UrlFinder\Finders;

final class Brands extends BaseFinder
{

    protected $table = 'shop_brands';

    protected $translations = 'shop_brands_i18n';

    protected $nameColumn = 'shop_brands_i18n.name';

    protected $urlColumn = 'shop_brands.url';

    protected $langColumn = 'shop_brands_i18n.locale';

    /**
     * @return string
     */
    public function getGroupName() {
        return lang('Brands', 'xbanners');
    }

    /**
     * @param string $url
     * @return string
     */
    public function formUrl($url) {
        return '/shop/brand/' . $url;
    }

}