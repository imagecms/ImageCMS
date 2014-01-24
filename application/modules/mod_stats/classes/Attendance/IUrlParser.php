<?php

/**
 * Each parser retrieves its information, and returns the data prepared for the `attendance` table
 *
 * @author 
 */
interface IUrlParser {

    /**
     * 
     * @return int id for `type_id` of `urls` table
     */
    public function getTypeId();

    /**
     * Returns array of parsed data for `attendance` table
     * @return array 
     */
    public function getData();

    /**
     * Runs parsing process 
     */
    public function processData();

    /**
     * Data from `urls` table 
     * @param array $data
     */
    public function setData(&$data);
}

?>
