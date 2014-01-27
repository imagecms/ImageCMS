<?php

/**
 * 
 *
 * @author 
 */
class Attendance {

    /**
     *
     * @var AttendanceDirector 
     */
    protected $ad;

    public function __construct() {
        $this->ad = new AttendanceDirector;
    }

    /**
     * loads, gathers data
     */
    public function processData() {
        $this->ad->addInterpretator(new UrlCategoriesInterpretator);
        $this->ad->addInterpretator(new UrlProductsInterpretator);
        $this->ad->processData();
    }

    public function getResult($parserId) {
        return $this->ad->getResults($parserId);
    }

    public function saveAllResults() {
        return $this->ad->saveAllResults();
    }

}

?>
