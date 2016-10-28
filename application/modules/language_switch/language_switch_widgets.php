<?php

use CMSFactory\assetManager;

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * language_switch widgets
 */
class Language_switch_Widgets extends MY_Controller
{

    public function __construct() {
        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('language_switch');
    }

    /**
     *
     * @param array $widget
     * @return string
     */
    public function language_switch_show($widget = []) {
        $current_address = (string) $this->uri->uri_string();

        if (\core\src\CoreFactory::getConfiguration()->isDefaultLanguage()) {
            $current_address = '/' . $current_address;
        } else {
            $current_address = substr_replace($current_address, '', 0, strlen($this->uri->segment(1)));
        }

        $languages = $this->db->where('active', 1)->get('languages')->result_array();
        foreach ($languages as $key => $lang) {
            if ($lang['identif'] == MY_Controller::getCurrentLocale()) {
                $languages[$key]['current'] = 1;
            } else {
                $languages[$key]['current'] = 0;
            }
        }

        return assetManager::create()
            ->setData('languages', $languages)
            ->setData('current_address', $current_address)
            ->fetchTemplate('../widgets/' . $widget['name']);
    }

}