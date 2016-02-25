<?php

namespace xbanners\src\Entities;

use xbanners\models\Banners;

class BannerView
{

    /**
     * @var \Banners\Models\Banners
     */
    protected $banner;

    /**
     * @param Banners $banner
     */
    public function __construct(Banners $banner) {
        $this->banner = $banner;
    }

    /**
     * @return Banners
     */
    public function getBanner() {
        return $this->banner;
    }

    /**
     * @return string
     */
    public function show() {
        $data = [
            'banner' => $this->banner,
        ];
        return $this->render($data);
    }

    /**
     * @return string
     */
    protected function render($data) {
        return \Ci::$APP->load->module('xbanners')->show($data);
    }

}