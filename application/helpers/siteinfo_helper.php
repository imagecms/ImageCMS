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

        // simple check just in case
        if (is_array($name) || is_object($name) || is_bool($name)) {
            return '';
        }

        $ci = &get_instance();
        // getting data from DB
        $result = $ci->db->select('siteinfo')->get('settings');

        if ($result)
            $result1 = $result->row_array();
        else
            return '';

        $siteinfo = unserialize($result1['siteinfo']);

        // another simple check
        if (!is_array($siteinfo)) {
            return '';
        }

        // if key exists value will be returned
        if (FALSE !== $val = array_key_exists_recursive($name, $siteinfo, TRUE)) {
            return $val;
        } else {
            // logo and favicon depends from template...
            $settings = $ci->cms_base->get_settings();
            $tplName = $settings['site_template'];
            if ($name == 'siteinfo_favicon' || $name == 'siteinfo_logo') {
                $fileName = $name == 'siteinfo_favicon' ? 'favicon.ico' : 'logo.png';
                if (key_exists($tplName, $siteinfo[$name])) {
                    $path = $siteinfo[$name][$tplName];
                } else {
                    // trying to return frequently favicon location
                    $fLoc = "templates/{$tplName}/images/{$fileName}";
                    if (file_exists($fLoc)) {
                        return $fLoc;
                    }
                }
            }
        }
        return '';
    }

    if (!function_exists('getFaviconLogoPath')) {

        /**
         * Returns path for current images path
         * (depends from active template, and its type)
         * @return string|boolean Description
         */
        function getFaviconLogoPath() {
            $templateName = getActiveTemplateName();
            // looking for any color scheme (by folder existing)
            $path = "./templates/{$templateName}/css/";
            $cssDir = dir($path);
            $colorSchemes = array();
            while (false !== ($item = $cssDir->read())) {
                if ($item == '.' || $item == '..') {
                    continue;
                }
                if (is_dir($path . DIRECTORY_SEPARATOR . $item)) {
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
                $imagesPath = "./templates/{$templateName}/css/{$colorScheme}/";
            } else { // old-school template type
                $imagesPath = "./templates/{$templateName}/images/";
            }
            return $imagesPath;
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