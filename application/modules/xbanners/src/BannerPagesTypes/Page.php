<?php

namespace xbanners\src\BannerPagesTypes;

use CI;

/**
 * Created by PhpStorm.
 * User: mark
 * Date: 23.03.15
 * Time: 19:19
 */

class Page extends BasePageType
{

    public function __construct($locale) {
        $this->locale = $locale;
        $this->localeId = $this->getLocaleId();
        $this->tpl_name = 'page';
    }

    public function getPages() {
        $pages = CI::$APP->db
            ->where('lang', $this->localeId)
            ->order_by('title')
            ->get('content');

        $pages = $pages ? $pages->result_array() : [];

        $data = [];
        foreach ($pages as $page) {
            $data[$page['id']] = [
                'id' => $page['id'],
                'name' => $page['title'],
            ];
        }

        return $data;
    }
}