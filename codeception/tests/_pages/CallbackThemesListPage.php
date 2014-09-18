<?php

class CallbackThemesListPage
{
    public static $URL = '/admin/components/run/shop/callbacks/themes';
    
    public static $Title = '.title';
    
    //кнопки
    public static $ButtonCreate = '.pjax.btn.btn-small.btn-success';
    
    //заголовки таблиці
    public static $HeadID       = '//thead//th[1]';
    public static $HeadName     = '//thead//th[2]';
    public static $HeadDelete   = '//thead//th[3]';
    
    //рядки таблиці
    public static function lineID($row)     { return "//section[@class='mini-layout']//tbody/tr[$row]/td[1]"; }
    public static function lineName($row)   { return "//section[@class='mini-layout']//tbody/tr[$row]/td[2]/a"; }
    public static function lineDelete($row) { return "//section[@class='mini-layout']//tbody/tr[$row]/td[3]/a"; }
}