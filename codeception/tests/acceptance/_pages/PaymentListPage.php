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
        $ListMethodLine = "//table//tbody//tr[$row]/td[3]";
        return $ListMethodLine;
    }
    static function CurrencyNameLine($row) {
        $Currency = "//tbody/tr[$row]/td[4]/p";
        return $Currency;
    }
    static function CurrencySymbolLine($row) {
        $Symbol = "//tbody/tr[$row]/td[5]/p";
    }
    static function ActiveLine($row) {
        $Active = "//tbody/tr[$row]/td[6]/div/span";
    }
}

/**
 * Locators of elements at "payment create" page
 */
class PaymentCreatePage{
    public static $PageURL = '/admin/components/run/shop/paymentmethods/create';
    
    static $Title       = '.title';
    static $TitleHead   = '//thead//th';
    
    //Buttons
    static $ButtonBack          = '.t-d_u';
    static $ButtonCreate        = '.btn.btn-small.btn-success.formSubmit';
    static $ButtonCreateExit    = '.btn.btn-small.formSubmit:nth-child(3)';

    //Labels
    static $NameLabel           = "//label[@for='Name']";
    static $CurrencyLabel       = "//label[@for='CurrencyId']";
    static $Activelabel         = '.frame_label.active';
    static $DescriptionLable    = '//label[@for="Description"]';
    static $PaymentSystemLabel  = '//label[@for="inputRecCount"]';
    
    //Fields
    static $FieldName           = '#Name';
    static $FieldDescription    = '#Description';
    
    //Selects
    static $SelectCurrency      = '#CurrencyId';
    static function SelectCurrency($row) {
        $currency = "//select[@id='CurrencyId']/option[$row]";
        return $currency;
    }
    
    static $SelectPaymentSystem = '//select[@name="PaymentSystemName"]';
    static function SelectPaymentSystem($row){
        $system = "//select[@name='PaymentSystemName']/option[$row]";
        return $row;
    }
     
}

/**
 * Locators of elements at "payment edit" page
 */
class PaymentEditPage{
    
    static $Title       = '.title';
    static $TitleHead   = '//thead//th';
    
    //Buttons
    static $ButtonBack          = '.t-d_u';
    static $ButtonSave          = '.btn.btn-small.btn-primary.formSubmit';
    static $ButtonSaveExit      = '.btn.btn-small.formSubmit:nth-child(3)';

    //Labels
    static $NameLabel           = "//form/div[1]/div[1]/label";
    static $CurrencyLabel       = "//form/div[1]/div[2]/label";
    static $Activelabel         = '//form/div[1]/div[3]/div[2]/span';
    static $DescriptionLable    = '//form/div[2]/label';
    static $PaymentSystemLabel  = '//form/div[3]/div[1]/label"]';
    
    //Fields
    static $FieldName           = '//input[@name="Name"]';
    static $FieldDescription    = '//textarea[@name="Description"]';
    
    //Selects
    static $SelectCurrency      = '//select[@name="CurrencyId"]';
    static function SelectCurrency($row) {
        $currency = "//select[@name='CurrencyId']/option[2]";
        return $currency;
    }
    
    static $SelectPaymentSystem = '//select[@name="PaymentSystemName"]';
    static function SelectPaymentSystem($row){
        $system = "//select[@name='PaymentSystemName']/option[$row]";
        return $row;
    }
    
    //additional fields
    
}