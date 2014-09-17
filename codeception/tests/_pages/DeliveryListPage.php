<?php

class DeliveryListPage
{


    public static $URL                      = '/admin/components/run/shop/deliverymethods/index'; 
    public static $Title                    = '.title';
    
    //кнопки
    public static $ButtonCreate             = 'a[href="/admin/components/run/shop/deliverymethods/create"]';
    public static $ButtonDelete             = '.btn.btn-small.btn-danger.action_on';


    //таблиця заголовки
    public static $HeadCheck                = "//section[@class='mini-layout']//th[1]/span/span";
    public static $HeadID                   = "//section[@class='mini-layout']//th[2]";
    public static $HeadMethod               = "//section[@class='mini-layout']//th[3]";
    public static $HeadPrice                = "//section[@class='mini-layout']//th[4]";
    public static $HeadFreeFrom             = "//section[@class='mini-layout']//th[5]";
    public static $HeadActive               = "//section[@class='mini-layout']//th[6]";
     
   //таблиця рядки
    public static function lineCheck($row){
        return "//section[@class='mini-layout']//tbody/tr[$row]/td[1]/span/span";
    }
    public static function lineID($row){
        return "//section[@class='mini-layout']//tbody/tr[$row]/td[2]/p";
    }
    public static function lineMethod ($row){
        return "//section[@class='mini-layout']//tbody/tr[$row]/td[3]/a";
    }
    public static function linePrice($row){
        return  "//section[@class='mini-layout']//tbody/tr[$row]/td[4]/p";
    }
    public static function LineFreeFrom($row){
        return "//section[@class='mini-layout']//tbody/tr[$row]/td[5]/p";
    }
    public static function LineToggleActive($row){
        return "//section/div[2]/div/table/tbody/tr[$row]/td[6]/div/span";
    }
    
    //вікно видалення
    public static $WindowDelete             = ".modal.hide.fade.modal_del.in";
    public static $WindowDeleteButtonDelete = ".btn.btn-primary";
    public static $WindowDeleteButtonCancel = "//div[@id='mainContent']/div/div[1]/div[3]/a[2]";
    public static $WindowDeleteButtonClose  = ".close";

}