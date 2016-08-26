<?php

namespace xbanners\src\BannerPagesTypes;

/**
 * Created by PhpStorm.
 * User: mark
 * Date: 23.03.15
 * Time: 19:19
 */
class Category extends BasePageType
{

    public function __construct($locale) {
        $this->locale = $locale;
        $this->localeId = $this->getLocaleId($locale);
        $this->tpl_name = 'category';
    }

    private function getCategories() {
        return \CI::$APP->lib_category->setLocaleId($this->localeId)->build();
    }

    public function getPages() {
        $categories = $this->getCategories();

        $data = [];
        foreach ($categories as $category) {
            $data[$category['id']] = [
                                      'id'   => $category['id'],
                                      'name' => $category['name'],
                                     ];
        }

        return $data;
    }

}