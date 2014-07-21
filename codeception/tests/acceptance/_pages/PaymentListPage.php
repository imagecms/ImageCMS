<?php

/**
 * Locators of elements at "payment list" page
 */
class PaymentListPage
{
    
    static $URL     = '/admin/components/run/shop/paymentmethods/index';
    
    static $Title   = '.title';
    
    //buttons
    static $ButtonCreate = ".btn.btn-small.btn-success.pjax";
    static $ButtonDelete = "#del_sel_pm";

    //table header
    static $CheckboxHeader          = '.t-a_c.span1 .niceCheck';
    static $IDHeader                = '//th[2]';
    static $MethodNameHeader        = '//th[3]';
    static $CurrencyNameHeader      = '//th[4]';
    static $CurrencySymbolHeader    = '//th[5]';
    static $ActiveHeader            = '//th[6]';
    
    //window delete
    static $DeleteWindow                = '.modal.hide.fade.modal_del.in';
    static $DeleteWindowTitle           = '.modal-header>h3';
    static $DeleteWindowQuestion        = '.modal-body>p';
    static $DeleteWindowButtonDelete    = '.btn.btn-primary';
    static $DeleteWindowButtonBack      = '.modal-footer a.btn:nth-child(2)';
    static $DeleteWindowButtonXClose    = '.close';

    //allerts for all pages?
    public static $AlertError       = '.alert.in.fade.alert-error';      //max symbols
    public static $AlertSuccess     = '.alert.in.fade.alert-success';    //suxess changes or creating
    public static $AlertRequiredLabel   = 'label.alert.alert-error';    //required field message under field
    public static $AlertRequiredField   = 'input.alert.alert-error';    //required field class

    //table rows
    static function CheckboxLine($row){
        $CheckboxLine = "//tbody/tr[$row]/td[1]/span/span";
        return $CheckboxLine;
    }
    static function IDLine($row) {
        $ID = "//tbody/tr[$row]/td[2]/p";
        return $ID;
    }
    static function MethodNameLine($row) {
        $ListMethodLine = "//table//tbody//tr[$row]/td[3]/a";
        return $ListMethodLine;
    }
    static function CurrencyNameLine($row) {
        $Currency = "//tbody/tr[$row]/td[4]/p";
        return $Currency;
    }
    static function CurrencySymbolLine($row) {
        $Symbol = "//tbody/tr[$row]/td[5]/p";
        return $Symbol;
    }
    static function ActiveLine($row) {
        $Active = "//tbody/tr[$row]/td[6]/div/span";
        return $Active;
    }
}


