<?php

/**
 * Locators of elements at "payment list" page
 */
class PaymentListPage {

    static $URL                         = '/admin/components/run/shop/paymentmethods/index';
    static $Title                       = '.title';
    
    //кнопки
    static $ButtonCreate                = ".mini-layout .btn.btn-small.btn-success.pjax";
    static $ButtonDelete                = "#del_sel_pm";
   
    //алерти
    public static $AlertError           = '.alert.in.fade.alert-error';
    public static $AlertSuccess         = '.alert.in.fade.alert-success';
    public static $AlertRequiredLabel   = 'label.alert.alert-error';
    public static $AlertRequiredField   = 'input.alert.alert-error';
    
    //вікно видалення
    static $WindowDelete                = '.modal.hide.fade.modal_del.in';
    static $WindowDeleteTitle           = '.modal-header>h3';
    static $WindowDeleteQuestion        = '.modal-body>p';
    static $WindowDeleteButtonDelete    = '.btn.btn-primary';
    static $WindowDeleteButtonBack      = '.modal-footer a.btn:nth-child(2)';
    static $WindowDeleteButtonClose     = '.close';

    //заголовки таблиці
    static $HeadCheck                   = '.t-a_c.span1 .niceCheck';
    static $HeadID                      = "//section[@class='mini-layout']//th[2]";
    static $HeadMethod                  = "//section[@class='mini-layout']//th[3]";
    static $HeadCurrencyName            = "//section[@class='mini-layout']//th[4]";
    static $HeadCurrencySymbol          = "//section[@class='mini-layout']//th[5]";
    static $HeadActive                  = "//section[@class='mini-layout']//th[6]";

    //рядки таблиці
    static function lineCheck($row)             { return "//section[@class='mini-layout']//tbody/tr[$row]/td[1]/span/span"; }
    static function lineID($row)                { return "//section[@class='mini-layout']//tbody/tr[$row]/td[2]/p";         }
    static function lineMethod($row)            { return "//section[@class='mini-layout']//table//tbody//tr[$row]/td[3]/a"; }
    static function lineCurrencyName($row)      { return "//section[@class='mini-layout']//tbody/tr[$row]/td[4]/p";         }
    static function lineCurrencySymbol($row)    { return "//section[@class='mini-layout']//tbody/tr[$row]/td[5]/p";         }
    static function lineActive($row)            { return "//section[@class='mini-layout']//tbody/tr[$row]/td[6]/div/span";  }
}
