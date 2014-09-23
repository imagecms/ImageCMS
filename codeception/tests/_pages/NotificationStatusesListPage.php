<?php

class NotificationStatusesListPage
{

    public static $URL  = '/admin/components/run/shop/notificationstatuses/index';
    public static $Title = 'span.title';
    
    //кнопки
    public static $ButtonCreate = '.btn.btn-small.btn-success.pjax';
    public static $ButtonDelete = '.btn.btn-small.btn-danger.action_on';
    
    //заголовки таблиці
    public static $HeadCheck    = '//section[@class="mini-layout"]//thead//th[1]/span/span';
    public static $HeadID       = '//section[@class="mini-layout"]//thead//th[2]';
    public static $HeadName     = '//section[@class="mini-layout"]//thead//th[3]';
    public static $HeadPosition = '//section[@class="mini-layout"]//thead//th[4]';
    
    //рядки таблиці
    public static function lineCheck($row)          { return "//section[@class='mini-layout']//tbody/tr[$row]/td[1]/span/span"; }
    public static function lineIDText($row)         { return "//section[@class='mini-layout']//tbody/tr[$row]/td[2]/span";      }
    public static function lineNameLink($row)       { return "//section[@class='mini-layout']//tbody/tr[$row]/td[3]/a";         }
    public static function linePositionText($row)   { return "//section[@class='mini-layout']//tbody/tr[$row]/td[4]/span";      }

    //вікно видалення
    static $WindowDelete                = '.modal.hide.fade.modal_del.in';
    static $WindowDeleteTitle           = '.modal.hide.fade.modal_del.in h3';
    static $WindowDeleteQuestion        = '.modal.hide.fade.modal_del.in p';
    static $WindowDeleteButtonDelete    = '.modal.hide.fade.modal_del.in a:nth-child(1)';
    static $WindowDeleteButtonBack      = '.modal.hide.fade.modal_del.in a:nth-child(2)';
    static $WindowDeleteButtonClose     = '.modal.hide.fade.modal_del.in button.close';
}