<?php

/**
 * Class AdminAddController for mod_stats module
 * @uses ControllerBase
 * @author DevImageCms
 * @copyright (c) 2014, ImageCMS
 * @property stats_model $stats_model
 * @package ImageCMSModule
 */
class AdminAddController extends ControllerBase {

    public function __construct($some) {
        parent::__construct($some);
        $this->controller->load->model('stats_model');
    }

    /**
     * Ajax update setting by value and setting name
     */
    public function ajaxUpdateSettingValue() {
        \mod_stats\classes\AdminHelper::create()->ajaxUpdateSettingValue();
    }

    /**
     * Autocomlete products
     * @return jsone
     */
    public function autoCompleteProducts() {
        \mod_stats\classes\AdminHelper::create()->autoCompleteProducts();
    }

    /**
     * Autocomlete categories
     * @return jsone
     */
    public function autoCompleteCategories() {
        \mod_stats\classes\AdminHelper::create()->autoCompleteCategories();
    }

   

}
