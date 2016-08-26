<?php

namespace xbanners\src\BannerPagesTypes;

/**
 * Created by PhpStorm.
 * User: mark
 * Date: 23.03.15
 * Time: 19:19
 */
class Product extends BasePageType
{

    public function __construct($locale) {
        $this->locale = $locale;
        $this->tpl_name = 'product';
    }

    public function getPages() {
        $products = \SProductsQuery::create()
                ->joinWithI18n($this->locale)
                ->filterByActive(1)
                ->find();

        $data = [];
        foreach ($products as $product) {
            $data[$product->getId()] = [
                                        'id'   => $product->getId(),
                                        'name' => $product->getName(),
                                       ];
        }

        return $data;
    }

}