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

        $ci = &get_instance();
        $siteinfo = $ci->load->library("SiteInfo");

        switch ($name) {
            case 'siteinfo_logo';
            case 'siteinfo_logo_url';
                return $siteinfo->getFaviconLogoUrl('siteinfo_logo');

            case 'siteinfo_favicon';
            case 'siteinfo_favicon_url';
                return $siteinfo->getFaviconLogoUrl('siteinfo_favicon');

            case 'siteinfo_logo_path';
            case 'siteinfo_favicon_path';
                $name_ = str_replace("_path", '', $name);
                $file = $siteinfo->getSiteInfo($name_);
                return $siteinfo->getFaviconLogoPath() . $file[$templateName];

            default:
                return $siteinfo->getSiteInfo($name);
        }
    }

}

/* End of siteinfo.php */
?>