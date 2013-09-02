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
        }

        return '';
    }

}


/* End of siteinfo.php */
?>