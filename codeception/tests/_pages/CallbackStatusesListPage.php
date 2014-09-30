<?php

class CallbackStatusesListPage
{
    public static $URL = '/admin/components/run/shop/callbacks/statuses';
    public static $Title = '.title';
    
    //кнопки
    public static $ButtonCreate = '.pjax.btn.btn-small.btn-success';
    
    //заголовки таблиці
    public static $HeadID = '//thead/tr/th[1]';
    public static $HeadName = '//thead/tr/th[2]';
    public static $HeadDefault = '//thead/tr/th[3]';
    public static $HeadDelete = '//thead/tr/th[4]';
    
    //рядки таблиці
    public static function lineID($row)         { return "//section//tbody/tr[$row]/td[1]";             }
    public static function lineName($row)       { return "//section//tbody/tr[$row]/td[2]/a";           }
    public static function lineDefault($row)    { return "//section//tbody/tr[$row]/td[3]/div/span";    }
    public static function lineDelete($row)     { return "//section//tbody/tr[$row]/td[4]/a";           }
}