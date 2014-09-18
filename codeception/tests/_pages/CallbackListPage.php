<?php

class CallbackListPage
{
    public static $URL          = '/admin/components/run/shop/callbacks';
    public static $Title        = '.title';
    
    //кнопки
    public static $ButtonDelete = '.btn.btn-small.btn-danger.action_on';
    
    //заголовки таблиці
    public static $HeadCheck    = '//section[@class="mini-layout"]//thead/tr/th[1]/span/span';
    public static $HeadID       = '//section[@class="mini-layout"]//thead/tr/th[2]';
    public static $HeadUserName = '//section[@class="mini-layout"]//thead/tr/th[3]';
    public static $HeadPhone    = '//section[@class="mini-layout"]//thead/tr/th[4]';
    public static $HeadTheme    = '//section[@class="mini-layout"]//thead/tr/th[5]';
    public static $HeadStatus   = '//section[@class="mini-layout"]//thead/tr/th[6]';
    public static $HeadDate     = '//section[@class="mini-layout"]//thead/tr/th[7]';
    public static $HeadDelete   = '//section[@class="mini-layout"]//thead/tr/th[8]';

    //Таби статус
    public static function tabStatus($position)                 { return "//section[@class='mini-layout']/div[2]/div/a[$position]"; }
    
    //Рядки таблиці
    public static function lineCheck($row)                      { return "//section[@class='mini-layout']/div[3]/div[1]//tbody/tr[$row]/td[1]/span/span"; }
    public static function lineID($row)                         { return "//section[@class='mini-layout']/div[3]/div[1]//tbody/tr[$row]/td[2]"; }
    public static function lineUserName($row)                   { return "//section[@class='mini-layout']/div[3]/div[1]//tbody/tr[$row]/td[3]/a"; }
    public static function linePhone($row)                      { return "//section[@class='mini-layout']/div[3]/div[1]//tbody/tr[$row]/td[4]"; }
    public static function lineThemeSelect($row)                { return "//section[@class='mini-layout']/div[3]/div[1]//tbody/tr[$row]/td[5]//select"; }
    public static function lineThemeSelectOption($row,$option)  { return "//section[@class='mini-layout']/div[3]/div[1]//tbody/tr[$row]/td[5]//select/option[$option]"; }
    public static function lineStatusSelect($row)               { return "//section[@class='mini-layout']/div[3]/div[1]//tbody/tr[$row]/td[6]//select"; }
    public static function lineStatusSelectOption($row,$option) { return "//section[@class='mini-layout']/div[3]/div[1]//tbody/tr[$row]/td[6]//select/option[$option]"; }
    public static function lineDate($row)                       { return "//section[@class='mini-layout']/div[3]/div[1]//tbody/tr[$row]/td[7]"; }
    public static function lineDelete($row)                     { return "//section[@class='mini-layout']/div[3]/div[1]//tbody/tr[$row]/td[8]/a"; }
}