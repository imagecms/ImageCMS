<?php

use template_manager\classes\TemplateManager;

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * ImageCMS
 * siteinfo helper
 */
if (!function_exists('siteinfo')) {

    /**
     * Get information about site
     *
     * @param string $name - name of siteinfo param
     *    - siteinfo_compatyname
     *    - siteinfo_address
     *    - siteinfo_mainphone
     *    - siteinfo_contacts
     *    - siteinfo_logo
     *    - siteinfo_favicon
     *    - "or some contact name"
     * @return bool|string
     */
    function siteinfo($name = NULL) {

        // for shorter notation...
        if (0 !== strpos($name, 'siteinfo_')) {
            $name = 'siteinfo_' . $name;
        }
        $ci = &get_instance();
        $ci->load->library('SiteInfo');
        $siteinfo = new SiteInfo();
        // next code is only for compatibility with older versions of library,
        // so in the future needed to be removed (with funciton processOldVersions() too)

        if (FALSE !== $data = siteInfoAdditionalManipulations($name)) {
            return $data;
        } else {
            $value = $siteinfo->getSiteInfo($name);

            if (in_array($name, ['siteinfo_logo', 'siteinfo_favicon'])) {
                return $ci->siteinfo->imagesPath . $value;
            }
            return $value;
        }
    }

}

if (!function_exists('siteInfoAdditionalManipulations')) {

    /**
     * Функція існує суто для сумісності із старими версіями
     * @deprecated since version 4.6
     * @param string $name
     * @return string|boolean
     */
    function siteInfoAdditionalManipulations($name) {
        if (FALSE !== strpos($name, '_path')) {
            $name = str_replace('_path', '', $name);
        }
        if (FALSE !== strpos($name, '_url')) {
            $name = str_replace('_url', '', $name);
        }

        $siteinfo = new SiteInfo();
        $value = $siteinfo->getSiteInfo($name);
        switch ($name) {
            case 'siteinfo_favicon':
            case 'siteinfo_logo':
                // із врахуванням активного шаблону
                if (is_array($value)) {
                    $settings = CI::$APP->cms_base->get_settings();
                    if (array_key_exists($settings['site_template'], $value)) {
                        $fileName = $value[$settings['site_template']];
                        if (SHOP_INSTALLED) {
                            $colorScheme = CI::$APP->load->module('template_manager')->getComponent('TColorScheme')->getColorSheme();

                            return "/templates/{$settings['site_template']}/css/{$colorScheme}/{$fileName}";
                        } else {
                            return "/templates/{$settings['site_template']}/images/{$fileName}";
                        }
                    } elseif (count($value) > 0) {
                        reset($value);
                        $key = key($value);
                        if (SHOP_INSTALLED) {
                            $colorScheme = CI::$APP->load->module('template_manager')->getComponent('TColorScheme')->getColorSheme();
                            $template = TemplateManager::getInstance()->getCurentTemplate();
                            return '/templates/' . $template->name . "/css/{$colorScheme}/" . $value[$key];
                        } else {
                            return "/templates/{$settings['site_template']}/images/" . array_shift($value);
                        }
                    }
                    return '';
                } elseif (is_string($value)) {
                    return empty($value) ? '' : CI::$APP->siteinfo->imagesPath . $value;
                }
        }
        return false;
    }

}