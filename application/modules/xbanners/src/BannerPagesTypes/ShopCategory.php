<?php

namespace xbanners\src\BannerPagesTypes;

/**
 * Created by PhpStorm.
 * User: mark
 * Date: 23.03.15
 * Time: 19:19
 */
class ShopCategory extends BasePageType
{

    public function __construct($locale) {
        $this->locale = $locale;
        $this->tpl_name = 'shop_category';
    }

    public function getPages() {
        $categories = \ShopCore::app()->SCategoryTree->getTree_(\SCategoryTree::MODE_SINGLE, $this->locale);

        $data = [];
        foreach ($categories as $category) {
            $data[$category->getId()] = [
                'id' => $category->getId(),
                'name' => $category->getName(),
                'level' => $category->getLevel(),
            ];
        }

        return $data;
    }

}