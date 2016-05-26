<?php

if (!function_exists('getBanner')) {

    /**
     * Get banner by place
     * @param string $place - banner place name
     * @param string $type - banner returns format
     * @return array|null|string
     */
    function getBanner($place, $type = 'view') {
        $banner = CI::$APP->load->module('xbanners')->getBanner($place);

        if (!($banner instanceof \xbanners\models\Banners)) {
            return null;
        }
        switch ($type) {
            case 'view':
                return $banner->show();
            case 'array':
                return $banner->asArray();
            case 'object':
                return $banner;
            default:
                return null;
        }
    }

}

if (!function_exists('makeSelected')) {

    /**
     * Make selected option in banner allowed pages select selected
     * @param integer $selectedId - selected id
     * @param string $optionsHTML - options html string
     * @return string
     */
    function makeSelected($selectedId, $optionsHTML) {
        $search = 'value="' . $selectedId . '"';
        $replace = 'value="' . $selectedId . '" selected="selected"';
        return str_replace($search, $replace, $optionsHTML);
    }

}

if (!function_exists('getBannerPreviewSrc')) {

    /**
     * Returns banner preview image file src
     * @param string $bannerPlaceName - banner place name
     * @return string
     */
    function getBannerPreviewSrc($bannerPlaceName) {
        $defaultPath = site_url('/application/modules/xbanners/assets/images/default.jpg');
        if (!$bannerPlaceName) {
            return $defaultPath;
        }

        $currentTemplate = \template_manager\classes\TemplateManager::getInstance()->getCurentTemplate();
        $bannerPlacePreviewFilePath = "/templates/$currentTemplate->name/xbanners/banner_places_previews/$bannerPlaceName";
        $file = array_shift(glob(".$bannerPlacePreviewFilePath*"));

        if ($file) {
            $fileInfo = pathinfo($file);
            return site_url("$bannerPlacePreviewFilePath.") . $fileInfo['extension'];
        }

        return $defaultPath;
    }

}