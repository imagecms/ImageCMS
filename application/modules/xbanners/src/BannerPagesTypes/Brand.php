<?php

namespace Banners\BannerPagesTypes;
/**
 * Created by PhpStorm.
 * User: mark
 * Date: 23.03.15
 * Time: 19:19
 */

class Brand extends BasePageType {

    public function __construct($locale) {
        $this->locale = $locale;
        $this->tpl_name = 'brand';
    }

    public function getPages() {
        $brands = \SBrandsQuery::create()
            ->joinWithI18n($this->locale)
            ->find();

        $data = [];
        foreach ($brands as $brand) {
            $data[$brand->getId()] = [
                'id' => $brand->getId(),
                'name' => $brand->getName(),
            ];
        }

        return $data;
    }

    public function getView() {
        $tree = $this->getPages();
        return parent::getView($this->tpl_name, ['tree' => $tree]);
    }

}