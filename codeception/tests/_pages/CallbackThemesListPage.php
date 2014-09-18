<?php

class CallbackThemesListPage
{
    public static $URL = '/admin/components/run/shop/callbacks/themes';
    
    public static $Title = '.title';
    
    //кнопки
    public static $ButtonCreate = '.pjax.btn.btn-small.btn-success';
    
    //заголовки таблиці
    public static $HeadIDText       = '//thead//th[1]';
    public static $HeadNameText     = '//thead//th[2]';
    public static $HeadDeleteText   = '//thead//th[3]';
    
    //рядки таблиці
    public static function lineIDText($row)         { return "//section[@class='mini-layout']//tbody/tr[$row]/td[1]";   }
    public static function lineNameLink($row)       { return "//section[@class='mini-layout']//tbody/tr[$row]/td[2]/a"; }
    public static function lineDeleteButton($row)   { return "//section[@class='mini-layout']//tbody/tr[$row]/td[3]/a"; }
}