<?php

class DeliveryPage
{
    //ListElements
    /*
     * HERE Description of variables which contains locators of every element on Delivery page 
     * and functions which returns element locator in current line
     */
    //Variables
    public static $ListCreateButton = ".btn.btn-small.btn-success.pjax";
    public static $ListDeleteButton = ".btn.btn-small.btn-danger.action_on";
    public static $ListCheckboxHeader = "//table/thead/tr/th[1]/span/span";
    public static $ListIDHeader = "//table/thead/tr/th[2]";
    public static $ListMethodHEader = "//table/thead/tr/th[3]";
    public static $ListPriceHeader = "//table/thead/tr/th[4]";
    public static $ListFreeFromHeader = "//table/thead/tr/th[5]";
    public static $ListActiveButton = "//table/thead/tr/th[6]";
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
class DeliveryCreate
{
    public static $FieldNameLabel = "//*[@id='createDelivery']/div[1]/label";
    public static $FieldName = ".//*[@id='Name']";
    public static $CheckboxActiveLabel = "//form[@id='createDelivery']/div[2]/div[2]/span";
    public static $CheckboxActive = "//*[@id='createDelivery']/div[2]/div[2]/span/span";
    public static $FieldDescriptionLabel = "//*[@id='createDelivery']/div[3]/label";
    public static $FieldDescription = ".//*[@id='Description']";
    public static $FieldDescriptionPriceLabel = ".//*[@id='createDelivery']/div[4]/label";
    public static $FieldDescriptionPrice = "//*[@id='priceDescription']";
    public static $FieldPriceLabel = "//*[@id='deliveryPriceDisableBlock']/div[1]/label";
    public static $FieldPrice = "//*[@id='Price']";
    public static $FieldFreeFromLabel = "//*[@id='deliveryPriceDisableBlock']/div[2]/label";
    public static $FieldFreeFrom = "//*[@id='FreeFrom']";
    public static $CheckboxPriceSpecifiedLabel = "//*[@id='deliveryPriceDisableBlock']/div[2]/div[2]/span";
    public static $CheckboxPriceSpecified = "//*[@id='deliverySumSpecifiedSpan']";
    public static $PaymentLabel = "//*[@id='mainContent']/div/section/div[2]/table/tbody/tr/td/div/div/div[3]/div[1]";
    public static function PaymentMethodLabel($row){
        $Payment = $row;
        return $Payment;
    }
         
}