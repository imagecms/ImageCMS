<?php

/**
 * 
 * @author kolia
 */
interface DynamicDiagramInterface {

    /**
     * For setting date to start from 
     * @param string $date YYYY-MM-DD
     */
    public function setDateFrom($date);

    /**
     * For setting end date
     * @param string $date YYYY-MM-DD
     */
    public function setDateTo($date);

    /**
     * Group condition (day, month, or year)
     * @param string $interval day|month|year
     */
    public function setDateInterval($interval);

    /**
     * @return array
     */
    public function getData();
}

?>
