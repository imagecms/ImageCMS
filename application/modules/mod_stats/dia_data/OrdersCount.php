<?php

/**
 * 
 *
 * @author kolia
 */
class OrdersCount extends DynamicDiagramBase {

    /**
     * 
     * @param int $paid (optional) additional param 1 - paid, 0 - unpaid, if empty - all
     * @return boolean
     */
    public function getData($params) {
        echo $params;
    }

    public function setAdditionalParams(array $params = array()) {
        
    }

}
?>


