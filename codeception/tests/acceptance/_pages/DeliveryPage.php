<?php

class DeliveryPage
{
    //ListElements
    /*
     * HERE Description of variables which contains locators of every element on Delivery page 
     * and functions which returns element locator in current line
     */
    public static $ListCreateButton = ".btn.btn-small.btn-success.pjax";
    public static $ListDeleteButton = ".btn.btn-small.btn-danger.action_on";
    public static $ListCheckboxHeader = "//table/thead/tr/th[1]/span/span";
    public static function ListCheckboxLine($row){
        $ListCheckboxLine  = "//table/tbody/tr[$row]/td[1]/span/span";
        return $ListCheckboxLine;
    }
    public static function ListIDLine($row){
        $ListID  = "//table/tbody/tr[$row]/td[2]/p";
        return $ListID;
    }
    public static function ListMethodLine ($row){
        $ListMethod = "//table/tbody/tr[$row]/td[3]/a";
        return $ListMethod;
    }
    public static function ListPriceLine ($row){
        $ListPrice = "//table/tbody/tr[$row]/td[4]/p";
        return $ListPrice;
    }
    public static function ListFreeFromLine($row){
        $ListFreeFrom = "//table/tbody/tr[$row]/td[5]/p";
        return $ListFreeFrom;
    }
    public static function ListActiveButtonLine($row){
        $ListActiveButton = "//table/tbody/tr[$row]/td[6]/div/span";
        return $ListActiveButton;
    }
}