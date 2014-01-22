<?php

/**
 * 
 *
 * @author 
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

}
