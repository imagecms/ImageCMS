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

        switch ($name) {
            case 'siteinfo_logo';
            case 'siteinfo_logo_url';
                return getFaviconLogoUrl('siteinfo_logo');

            case 'siteinfo_favicon';
            case 'siteinfo_favicon_url';
                return getFaviconLogoUrl('siteinfo_favicon');

            case 'siteinfo_logo_path';
            case 'siteinfo_favicon_path';
                $name_ = str_replace("_path", '', $name);
                $file = getSiteInfo($name_);
                $templateName = getActiveTemplateName();
                return getFaviconLogoPath($templateName) . $file[$templateName];

            default:
                return getSiteInfo($name);
        }
    }

    if (!function_exists('getSiteInfo')) {

        function getSiteInfo($name = NULL) {

            // simple check just in case
            if (!is_string($name)) {
                return '';
            }

            $ci = &get_instance();
            // getting data from DB
            $result = $ci->db->select('siteinfo')->get('settings');

            if ($result)
                $result1 = $result->row_array();
            else
                return '';

            $siteinfo = @unserialize($result1['siteinfo']);

            // another simple check
            if (!is_array($siteinfo)) {
                return '';
            }

            // if key exists value will be returned
            if (key_exists($name, $siteinfo)) {

                return $siteinfo[$name];
            }
            return '';
        }

    }

    if (!function_exists('getFaviconLogoPath')) {

        /**
         * Returns path to images folder
         * (depends from active template, and its type)
         * @param string $templateName 
         * @return string|boolean Description
         */
        function getFaviconLogoPath($templateName = NULL) {
            if ($templateName == NULL) {
                $templateName = getActiveTemplateName();
            }
            // looking for any color scheme (by folder existing)
            $cssPath = TEMPLATES_PATH . $templateName . DIRECTORY_SEPARATOR . "css" . DIRECTORY_SEPARATOR;
            $cssPath = str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, $cssPath);

            $cssDir = dir($cssPath);
            $colorSchemes = array();
            while (false !== ($item = $cssDir->read())) {
                if ($item == '.' || $item == '..') {
                    continue;
                }
                if (is_dir($cssPath . DIRECTORY_SEPARATOR . $item)) {
                    if (0 === strpos($item, 'color_scheme_')) {
                        $colorSchemes[] = $item;
                    }
                }
            }
            if (count($colorSchemes) > 0) { // newLevel-type template
                $ci = &get_instance();
                $colorScheme_ = $ci->load->module('new_level')->getColorScheme();
                $colorScheme = array_pop(explode('/', $colorScheme_));
                if (!in_array($colorScheme, $colorSchemes)) {
                    return FALSE;
                }
                $imagesPath = $cssPath . $colorScheme . DIRECTORY_SEPARATOR;
            } else { // old-school template type
                $imagesPath = TEMPLATES_PATH . $templateName . DIRECTORY_SEPARATOR . "images" . DIRECTORY_SEPARATOR;
            }
            // enshure that path is correct formed to current OS
            return str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, $imagesPath);
        }

    }

    if (!function_exists('getFaviconLogoUrl')) {

        /**
         * Returning full url with image
         * @param string siteinfo_logo|siteinfo_favicon $logoOrFavicon
         * @return string
         */
        function getFaviconLogoUrl($logoOrFavicon) {
            $templateName = getActiveTemplateName();
            $path = getFaviconLogoPath($templateName);

            $fileData = getSiteInfo($logoOrFavicon);
            if (!key_exists($templateName, $fileData) || empty($fileData)) {
                return '';
            }

            $path = str_replace(PUBPATH, '', $path);
            $path .= $fileData[$templateName];
            $path = trim($path, DIRECTORY_SEPARATOR);
            return '/' . str_replace(DIRECTORY_SEPARATOR, '/', $path);
        }

    }

    if (!function_exists('getActiveTemplateName')) {

        /**
         * Returns current active template
         * @return string
         */
        function getActiveTemplateName() {
            $CI = &get_instance();
            $settings = $CI->cms_base->get_settings();
            return $settings['site_template'];
        }

    }
}

/* End of siteinfo.php */
?>