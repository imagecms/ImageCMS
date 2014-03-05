<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

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
     */
    function siteinfo($name = NULL) {
        // for shorter notation...
        if (0 !== strpos($name, 'siteinfo_')) {
            $name = 'siteinfo_' . $name;
        }
        $siteinfo = CI::$APP->load->library("SiteInfo");
        // next code is only for compatibility with older versions of library, 
        // so in the future needed to be removed (with funciton processOldVersions() too)
        if (FALSE !== $data = siteInfoAdditionalManipulations($name)) {
            return $data;
        } else {
            $value = $siteinfo->getSiteInfo($name);
            if (in_array($name, array('siteinfo_logo', 'siteinfo_favicon'))) {
                return CI::$APP->siteinfo->imagesPath . $value;
            }
            return $value;
        }
    }

}



if (!function_exists('siteInfoAdditionalManipulations')) {

    /**
     * Функція існує суто для сумісності із старими версіями
     * @param string $name
     * @param string $value
     * @return string|boolean
     */
    function siteInfoAdditionalManipulations($name) {
        if (FALSE !== strpos($name, '_path')) {
            $name = str_replace('_path', '', $name);
        }
        if (FALSE !== strpos($name, '_url')) {
            $name = str_replace('_url', '', $name);
        }
        $siteinfo = CI::$APP->load->library("SiteInfo");
        $value = $siteinfo->getSiteInfo($name);
        switch ($name) {
            case 'siteinfo_favicon':
            case 'siteinfo_logo':
                // із врахуванням активного шаблону
                if (is_array($value)) {
                    $settings = CI::$APP->cms_base->get_settings();
                    $colorScheme = CI::$APP->load->module('new_level')->getColorScheme();
                    if (key_exists($settings['site_template'], $value)) {
                        $fileName = $value[$settings['site_template']];
                        return "/templates/{$settings['site_template']}/{$colorScheme}/{$fileName}";
                    } elseif (count($value) > 0) {
                        reset($value);
                        $key = key($value);
                        return "/templates/" . $key . "/{$colorScheme}/" . $value[$key];
                    }
                    return '';
                } elseif (is_string($value)) {
                    return empty($value) ? '' : CI::$APP->siteinfo->imagesPath . $value;
                }
        }
        return false;
    }

}

/* End of siteinfo.php */
?>