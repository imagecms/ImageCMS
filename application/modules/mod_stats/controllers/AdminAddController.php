<?php
use mod_stats\classes\AdminHelper;

/**
 * Class AdminAddController for mod_stats module
 * @uses ControllerBase
 * @author DevImageCms
 * @copyright (c) 2014, ImageCMS
 * @property stats_model $stats_model
 * @package ImageCMSModule
 */
class AdminAddController extends ControllerBase
{

    public function __construct($some) {
        parent::__construct($some);
        $this->controller->load->model('stats_model');
    }

    /**
     * Ajax update setting by value and setting name
     */
    public function ajaxUpdateSettingValue() {
        AdminHelper::create()->ajaxUpdateSettingValue();
    }

    /**
     * Autocomplete products
     */
    public function autoCompleteProducts() {
        AdminHelper::create()->autoCompleteProducts();
    }

    /**
     * Autocomplete categories
     */
    public function autoCompleteCategories() {
        AdminHelper::create()->autoCompleteCategories();
    }

}