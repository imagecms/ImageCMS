<?php

class PaymentCreatePage
{
        
    // include url of current page
    static $URL = '/admin/components/run/shop/paymentmethods/create';

    /**
     * Declare UI map for this page here. CSS or XPath allowed.
     * public static $usernameField = '#username';
     * public static $formSubmitButton = "#mainForm input[type=submit]";
     */

    /**
     * Basic route example for your current URL
     * You can append any additional parameter to URL
     * and use it in tests like: EditPage::route('/123-post');
     */
    
    static $Title       = '.title';
    static $TitleHead   = '//thead//th';
    
    static $CheckboxActive = ".niceCheck";


    //Buttons
    static $ButtonBack          = '.t-d_u';
    static $ButtonCreate        = '.btn.btn-small.btn-success.formSubmit';
    static $ButtonCreateExit    = '.btn.btn-small.formSubmit:nth-child(3)';

    //Labels
    static $LabelName           = "//label[@for='Name']";
    static $LabelCurrency       = "//label[@for='CurrencyId']";
    static $LabelActive         = '.frame_label.active';
    static $LableDescription    = '//label[@for="Description"]';
    static $LabelPaymentSystem  = '//label[@for="inputRecCount"]';
    
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

//     public static function route($param)
//     {
//        return static::$URL.$param;
//     }
//
//    /**
//     * @var AcceptanceTester;
//     */
//    protected $acceptanceTester;
//
//    public function __construct(AcceptanceTester $I)
//    {
//        $this->acceptanceTester = $I;
//    }
//
//    /**
//     * @return PaymentCreatePage
//     */
//    public static function of(AcceptanceTester $I)
//    {
//        return new static($I);
//    }
}