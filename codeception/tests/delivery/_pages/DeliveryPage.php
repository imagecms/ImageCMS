<?php

class DeliveryPage
{
    //ListElements
    /*
     * HERE Description of variables which contains locators of every element on Delivery page 
     * and functions which returns element locator in current line
     */
    //Variables
    static $URL = "/admin/components/run/shop/deliverymethods/index"; 
    public static $CreateButton = "//*[@id='mainContent']/div/section/div[1]/div[2]/div/a";


    public static $DeleteButton = ".btn.btn-small.btn-danger.action_on";
    public static $CheckboxHeader = "//table/thead/tr/th[1]/span/span";
    public static $IDHeader = "//table/thead/tr/th[2]";
    public static $MethodHEader = "//table/thead/tr/th[3]";
    public static $PriceHeader = "//table/thead/tr/th[4]";
    public static $FreeFromHeader = "//table/thead/tr/th[5]";
    public static $ActiveButton = "//table/thead/tr/th[6]";
     
    //Delete Window
    public static $Deletewindow = ".modal.hide.fade.modal_del.in";
    public static $DeleteWindowDelete = ".btn.btn-primary";
    public static $DeleteWindowBack = ".//*[@id='mainContent']/div/div[1]/div[3]/a[2]";
    public static $DeleteWindowX = ".close";

    //Functions
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


