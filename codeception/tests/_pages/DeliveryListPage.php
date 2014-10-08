<?php

class DeliveryListPage
{


    public static $URL                      = '/admin/components/run/shop/deliverymethods/index'; 
    public static $Title                    = '.title';
    
    //кнопки
    public static $ButtonCreate             = 'a[href="/admin/components/run/shop/deliverymethods/create"]';
    public static $ButtonDelete             = '.btn.btn-small.btn-danger.action_on';


    //заголовки таблиці
    public static $HeadCheck                = "//section[@class='mini-layout']//th[1]/span/span";
    public static $HeadIDText               = "//section[@class='mini-layout']//th[2]";
    public static $HeadMethodText           = "//section[@class='mini-layout']//th[3]";
    public static $HeadPriceText            = "//section[@class='mini-layout']//th[4]";
    public static $HeadFreeFromText         = "//section[@class='mini-layout']//th[5]";
    public static $HeadActiveText           = "//section[@class='mini-layout']//th[6]";
     
   //рядки таблиці
    public static function lineCheck($row)              { return "//section[@class='mini-layout']//tbody/tr[$row]/td[1]/span/span"; }
    public static function lineIDText($row)             { return "//section[@class='mini-layout']//tbody/tr[$row]/td[2]/p";         }
    public static function lineMethodLink ($row)        { return "//section[@class='mini-layout']//tbody/tr[$row]/td[3]/a";         }
    public static function linePriceText($row)          { return  "//section[@class='mini-layout']//tbody/tr[$row]/td[4]/p";        }
    public static function lineFreeFromText($row)       { return "//section[@class='mini-layout']//tbody/tr[$row]/td[5]/p";         }
    public static function lineActiveToggle($row)       { return "//section/div[2]/div/table/tbody/tr[$row]/td[6]/div/span";        }
    
    //вікно видалення
    public static $WindowDelete             = ".modal.hide.fade.modal_del.in";
    public static $WindowDeleteTitle        = ".modal.hide.fade.modal_del.in h3";
    public static $WindowDeleteButtonDelete = ".btn.btn-primary";
    public static $WindowDeleteButtonCancel = "//div[@id='mainContent']/div/div[1]/div[3]/a[2]";
    public static $WindowDeleteButtonClose  = ".close";

}