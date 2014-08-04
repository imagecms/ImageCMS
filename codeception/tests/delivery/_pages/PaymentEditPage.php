<?php

class PaymentEditPage
{
    // include url of current page
    static $URL = '';

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
    static $ButtonSave          = '.btn.btn-small.btn-primary.formSubmit';
    static $ButtonSaveExit      = '.btn.btn-small.formSubmit:nth-child(3)';

    //Labels
    static $NameLabel           = "//form/div[1]/div[1]/label";
    static $CurrencyLabel       = "//form/div[1]/div[2]/label";
    static $Activelabel         = '//form/div[1]/div[3]/div[2]/span';
    static $DescriptionLable    = '//form/div[2]/label';
    static $PaymentSystemLabel  = '//form/div[3]/div[1]/label';
    
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
//     * @return PaymentEditPage
//     */
//    public static function of(AcceptanceTester $I)
//    {
//        return new static($I);
//    }
}