<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * ImageCMS
 * siteinfo helper
 */
if (!function_exists('siteinfo')) {

    /**
     * <p>Get information about site </p>
     * <p>Predefined values are:</p>
     * <ul>
     *     <li> siteinfo_compatyname, </li>
     *     <li> siteinfo_address,</li>
     *     <li> siteinfo_mainphone,</li>
     *     <li> siteinfo_contacts,</li>
     *     <li> siteinfo_logo,</li>
     *     <li> siteinfo_favicon,</li>
     * </ul>
     * <p>If you want to return contact, then set 
     * parameter type of contact from admin panel - settings - siteinfo</p>
     *
     * @param string $name - name of siteinfo param
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

        // another simple check just in case
        if (!is_array($siteinfo)) {
            return '';
        }

        // if key exists value will be returned
        if (FALSE !== $val = array_key_exists_recursive($name, $siteinfo, TRUE)) {

            return $val;
        } else {

            // logo and favicon depends from template...
            $CI = &get_instance();

            $settings = $CI->cms_base->get_settings();
            $tplName = $settings['site_template'];

            switch ($name) {
                case 'siteinfo_favicon_url':
                    if (key_exists($tplName, $siteinfo['siteinfo_favicon'])) {
                        return site_url() . $siteinfo['siteinfo_favicon'][$tplName]['path'];
                    } else {
                        // trying to return frequently favicon location
                        $fLoc = "templates/{$tplName}/images/favicon.ico";
                        if (file_exists($fLoc)) {
                            return site_url() . $fLoc;
                        }
                    }
                case 'siteinfo_logo_url':
                    if (key_exists($tplName, $siteinfo['siteinfo_logo'])) {
                        return site_url() . $siteinfo['siteinfo_logo'][$tplName]['path'];
                    } else {
                        // trying to return frequently favicon location
                        $fLoc = "templates/{$tplName}/images/logo.png";
                        if (file_exists($fLoc)) {
                            return site_url() . $fLoc;
                        }
                    }
            }
        }
        return '';
    }

}

/* End of siteinfo.php */
?>