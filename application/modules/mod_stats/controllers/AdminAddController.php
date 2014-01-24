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

    /**
     * Autocomlete products
     * @return jsone
     */
    public function autoCompleteProducts() {
        \mod_stats\classes\AdminHelper::create()->autoCompleteProducts();
    }

    public function gather_attendance() {
        // load classes
        $this->controller->load('classes/Attendance/IUrlInterpretator' . EXT);
        $this->controller->load('classes/Attendance/*');
        $attendance = new Attendance();
        $attendance->addInterpretator(new UrlCategoriesInterpretator);
        $attendance->addInterpretator(new UrlProductsInterpretator);
        $attendance->processData();
        echo '<pre>';
        print_r($attendance->getResults());
        echo '</pre>';
        exit;
    }

}
