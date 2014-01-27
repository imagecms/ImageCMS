<?php

/**
 * Each parser retrieves its information, and 
 * returns the data prepared for the `attendance` table
 *
 * @author 
 */
interface IUrlInterpretator {

    /**
     * 
     * @return int id for `type_id` of `urls` table
     */
    public function getTypeId();

    /**
     * Returns array of parsed data for `attendance` table
     * @return array 
     */
    public function getResult();

    /**
     * Passing by one Url to method, - method process it.
     * @param string $url
     */
    public function interprate($url);
}

?>
