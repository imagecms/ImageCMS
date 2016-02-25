<?php

/**
 * Created by PhpStorm.
 * User: mark
 * Date: 24.03.15
 * Time: 9:54
 */

namespace xbanners\src\BannerPagesTypes;

class BasePageType
{

    protected $locale;

    protected $localeId;

    protected $tpl_name;

    protected function getLocaleId() {
        $languages = \CI::$APP->db->where('identif', $this->locale)->get('languages');
        $this->localeId = $languages ? (int) $languages->row()->id : NULL;
        return $this->localeId;
    }

    public function getView() {
        $tree = $this->getPages();
        $assetpath = 'file:' . APPPATH . 'modules/xbanners/assets/admin/banner_pages_types/';
        return \CI::$APP->template->fetch($assetpath . $this->tpl_name, ['tree' => $tree]);
    }

}