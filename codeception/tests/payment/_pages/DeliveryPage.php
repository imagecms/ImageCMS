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
    public static $CheckboxHeader = "//section[@class='mini-layout']//thead/tr/th[1]/span/span";
    public static $IDHeader = "//section[@class='mini-layout']//thead/tr/th[2]";
                            //section/div[2]/div/table/thead/tr/th[2]
    public static $MethodHEader = "//section[@class='mini-layout']//thead/tr/th[3]";
    public static $PriceHeader = "//section[@class='mini-layout']//thead/tr/th[4]";
    public static $FreeFromHeader = "//section[@class='mini-layout']//thead/tr/th[5]";
    public static $ActiveButton = "//section[@class='mini-layout']//thead/tr/th[6]";
     
    //Delete Window
    public static $Deletewindow = ".modal.hide.fade.modal_del.in";
    public static $DeleteWindowDelete = ".btn.btn-primary";
    public static $DeleteWindowBack = ".//*[@id='mainContent']/div/div[1]/div[3]/a[2]";
    public static $DeleteWindowX = ".close";

    //Functions
    public static function ListCheckboxLine($row){
        $ListCheckboxLine  = "//section[@class='mini-layout']//tbody/tr[$row]/td[1]/span/span";
        return $ListCheckboxLine;
    }
    public static function ListIDLine($row){
        $ListID  = "//section[@class='mini-layout']//tbody/tr[$row]/td[2]/p";
        return $ListID;
    }
    public static function ListMethodLine ($row){
        $ListMethod = "//section[@class='mini-layout']//tbody/tr[$row]/td[3]/a";
        return $ListMethod;
    }
    public static function ListPriceLine ($row){
        $ListPrice = "//section[@class='mini-layout']//tbody/tr[$row]/td[4]/p";
        return $ListPrice;
    }
    public static function ListFreeFromLine($row){
        $ListFreeFrom = "//section[@class='mini-layout']//tbody/tr[$row]/td[5]/p";
        return $ListFreeFrom;
    }
    public static function ListActiveButtonLine($row){
        $ListActiveButton = "//section/div[2]/div/table/tbody/tr[$row]/td[6]/div/span";
        return $ListActiveButton;
    }
}


