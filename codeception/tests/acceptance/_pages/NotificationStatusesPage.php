<?php

class NotificationStatusesPage
{
    public static $ListPageURL = "components/run/shop/notificationstatuses";
    public static $ListCreateButton = ".btn.btn-small.btn-success.pjax"; 
    public static $ListLinkEditing = "//table/tbody/tr[3]/td[3]/a";
    public static $ListMainCheckBox = "//div[2]/table/thead/tr/th[1]/span/span";
    public static $ListFirstCheckBox = ".//*[@id='mainContent']/div/div[3]/section/div[2]/table/tbody/tr[1]/td[1]/span/span";
    public static $ListSecondCheckBox = "//div[2]/table/tbody/tr[2]/td[1]/span/span";
    public static $ListDeleteButton = "//div[1]/div[2]/div/button";   
    public static $CreatePageUrl = "components/run/shop/notificationstatuses/create";
    public static $CreationCreateButton = ".btn.btn-small.btn-success.action_on.formSubmit";
    public static $CreationBackButton = ".t-d_u";
    public static $CreationCreateAndGoBackButton = ".btn.btn-small.btn-default.formSubmit";
    public static $CreationInputFild =  ".//*[@id='inputFio']";
    public static $EditingBackButton = "//div[1]/div[2]/div/a/span[2]";
    public static $EditingSaveButton = "//div[1]/div[2]/div/button[1]";
    public static $EditingSaveAndGoBackButton = "//div[1]/div[2]/div/button[2]";
    public static $EditingInputFild = ".//*[@id='Name']";
    public static function ListCheckboxLine($row){
        $ListCheckboxLine  = "//table/tbody/tr[$row]/td[1]/span/span";
        return $ListCheckboxLine;     
     }
    public static function ListIDLine($row){
        $ListID  = "//table/tbody/tr[$row]/td[2]/span";
        return $ListID;
        
    }
    public static function ListMethodLine ($row){
        $ListMethod = "//table/tbody/tr[$row]/td[3]/a";
        return $ListMethod;
    }
     public static function ListPositionLine ($row){
        $ListPrice = "//table/tbody/tr[$row]/td[4]/span";
        return $ListPrice;
    }
}