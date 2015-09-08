<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Image CMS
 */
class Tags_Widgets extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('tags');
    }

    // Display recent or popular news

    public function tags_cloud($widget = []) {
        if ($widget['settings'] == FALSE) {
            $settings = $this->defaults;
        } else {
            $settings = $widget['settings'];
        }

        $this->load->module('tags');
        $this->tags->prepare_tags();

        return $this->tags->build_cloud();
    }

    // Display recent or popular news

    public function pages_tags_cloud($widget = []) {
        if ($widget['settings'] == FALSE) {
            $settings = $this->defaults;
        } else {
            $settings = $widget['settings'];
        }

        $this->load->module('tags');
        $this->tags->prepare_tags();

        return $this->template->fetch(
            'widgets/' . $widget['name'],
            [
                    'tags' => $this->tags->build_cloud('array'),
                    'widget' => $widget
                        ]
        );
    }

    // Configure form

    public function tags_cloud_configure($action = 'show_settings') {
        if ($this->dx_auth->is_admin() == FALSE) {
            exit;
        }

        switch ($action) {
            case 'show_settings':

                break;

            case 'update_settings':

                break;

            case 'install_defaults':

                break;
        }
    }

}