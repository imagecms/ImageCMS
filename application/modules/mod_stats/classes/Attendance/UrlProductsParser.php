<?php

/**
 * 
 *
 * @author kolia
 */
class UrlProductsParser implements IUrlParser {

    /**
     * Data from `urls` table 
     * @var array
     */
    protected $urlData;

    /**
     * Data for `attendance` table
     * @var array
     */
    protected $attendanceData;

    public function getData() {
        
    }

    public function getTypeId() {
        return 1;
    }

    public function processData() {
        
    }

    public function setData(&$urlData) {
        $this->urlData = &$urlData;
    }

}

?>
