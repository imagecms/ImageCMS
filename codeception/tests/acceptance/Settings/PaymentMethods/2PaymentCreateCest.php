<?php
use \AcceptanceTester;

require_once 'PaymentHelper.php';

class PaymentCreateCest extends PaymentTestHelper{
    
    protected $CreatedPaymentMethods    = []; 
    protected $CreatedCurrencies        = [];
    protected static $Logged            = false;
    
//    public function _before(AcceptanceTester $I){
//        if(self::$Logged) $I->amOnPage(PaymentCreatePage::$URL);
//    }
    
    /**
     * @group current
     */
    public function authorization(AcceptanceTester $I) {
//        $thispath   = __DIR__;
//        $mysqlPath  = '..\..\..\..\..\..\..\modules\database\MySQL-5.5.35\bin';
//        $I->runShellCommand("cd $thispath && cd $mysqlPath && mysqldump.exe -u root cmsprem > C:\OpenServer\domains\imagecms.loc\codeception\tests\_data\cmsprem.sql");
                

        InitTest::dataBaseDump($I);
        InitTest::dataBaseBackUp($I);
        self::$Logged=TRUE;
    }
    
    
    //__________________________________________________________________________FIELD NAME

    /**
     * @group create
     */
    public function nameEmpty(AcceptanceTester $I){
        $name = "";
        $this->CreatePayment($I, $name);
        $this->CheckForAlertPresent($I, 'required');
    }
    
    /**
     * @group create
     */
    public function nameNoramal(AcceptanceTester $I){
        $name                   = "ОплатаТест";
        $this->CreatedPaymentMethods[] = $name;
        
        $this->CreatePayment($I, $name);
        $this->CheckForAlertPresent($I, 'success');
    }
    
    /**
     * @group create
     */
    public function name250(AcceptanceTester $I){
        $name                   = InitTest::$text250;
        $this->CreatedPaymentMethods[] = $name;
        
        $this->CreatePayment($I, $name);
        $this->CheckForAlertPresent($I, 'success');
    }
    
    /**
     * @group create
     */
    public function name251(AcceptanceTester $I){
        $name                   = InitTest::$text251;
        $this->CreatedPaymentMethods[] = $name;
        
        $this->CreatePayment($I, $name);
        $this->CheckForAlertPresent($I, 'error');
    }
    
    /**
     * @group create
     */
    public function nameSymbols(AcceptanceTester $I){
        $name                   = InitTest::$textSymbols;
        $this->CreatedPaymentMethods[] = $name;
        
        $this->CreatePayment($I, $name);
        $this->CheckForAlertPresent($I, 'success');
    }
    
    //__________________________________________________________________________CURRENCY SELECTION
    
    /**
     * Check that all created currencies present is select menu
     * 
     * @group create
     */
    public function currenciesCheck(AcceptanceTester $I) {
        $CreatedCurrencies = $this->GrabAllCreatedCurrenciesOrDelete($I);
        
        //add options of <select> at create page to array $Options[]
        $I->amOnPage(PaymentCreatePage::$URL);
        $OptionsAmount = $I->grabTagCount($I, 'select option', 0);
        $I->comment("$OptionsAmount");
        for($row=0;$row<$OptionsAmount;++$row){
            $Options[$row] = $I->grabTextFrom(PaymentCreatePage::SelectCurrency($row+1));
            $Options[$row] = trim(array_shift(explode('(',$Options[$row])));//to get only name of currency
        }
        foreach ($CreatedCurrencies as $key=>$Currecy){
            $I->assertEquals($Currecy, $Options[$key]);
        }
    }
    
        /**
         * Checks that,created method uses selected currency 
         * 
         * @group create
         */
        public function currencySelection(AcceptanceTester $I){
            $PaymentName                = 'ОплатаВалюта';
            $this->CreatedPaymentMethods []    = $PaymentName;
            $CurrencyName               = 'Pounds';
            $this->CreatedCurrencies [] = $CurrencyName; 
            $this->CreateCurrency($I, $CurrencyName);
            $I->amOnPage(PaymentCreatePage::$URL);
            $this->CreatePayment($I, $PaymentName, $CurrencyName);
            $this->CheckInPaymentList($I, $PaymentName, $CurrencyName);
        }
        //______________________________________________________________________FIELD DESCRIPTION
        
        //______________________________________________________________________ACTIVE CHECKBOX
        /**
         * @group create
         */
        public function checkboxActiveOn(AcceptanceTester $I) {
            $pay                    = 'ОплатаАктив';
            $this->CreatedPaymentMethods[] = $pay;
            $delivery               = 'ДоставкаоплатаАктив';
            
            $this->CreatePayment($I, $pay,NULL,'on');
            $this->CreateDelivery($I, $delivery, 'on', null, null, null, null, null, $pay);
            $this->CheckInFrontEnd($I, $delivery, null, null, null, null, $pay);
        }
        
        /**
         * @group create
         */
        public function checkboxActiveOff(AcceptanceTester $I) {
            $pay                    = 'ОплатаНеАктив';
            $this->CreatedPaymentMethods[] = $pay;
            $delivery               = 'ДоставкаОплатаНеактив';
            
            $this->CreatePayment($I, $pay,NULL,'off');
            $this->CreateDelivery($I, $delivery, 'on', null, null, null, null, null, $pay);
            $this->CheckInFrontEnd($I, $delivery, null, null, null, null, 'off');
        }
        
        
        //______________________________________________________________________PAY SYSTEMS
        //OR ONE TEST FOR ALL

        /**
         * Create Payment methods for each payment system
         * @group create
         */
        public function fastAllPaymentSystems(AcceptanceTester $I){
            $prefix         = 'Оплата';//for name of payment name = $prefix.$paymentsystem
            $PaymentSystems = [
                'WebMoney',
                'ОщадБанк Украины',
                'СберБанк России',
                'Robokassa',
                'LiqPay',
                'YandexMoney',
                'QiWi',
                'PayPal',
                'ПриватБанк',
                'Interkassa'
                ];
            
                foreach ($PaymentSystems as $paymentsystem) {
                    $this->CreatedPaymentMethods[] = $name = $prefix.$paymentsystem;
                    $this->CreatePayment($I, $name, 'Dollars', 'on', null, $paymentsystem);
                    //$this->CheckInList($I, $name);
                    //$this->CreateDelivery($I, 'Доставка'.$name, 'on', null, null, null, null, null, $paymentsystem);
                    //$this->CheckInFrontEnd($I, 'Доставка'.$name, null, null, null, null, null, $name);
                }
        }
        
        /**
         * @group currents
         * 
         * experimental
         */
          public function qwewqe(AcceptanceTester $I) {
                   
                   
                   /*Microsoft Windows [Version 6.1.7601]


c:\OpenServer\modules\database\MySQL-5.5.35\bin>mysql.exe -u root cmsprem < C:\c
msprem.sql

c:\OpenServer\modules\database\MySQL-5.5.35\bin>mysqldump.exe -u root cmsprem >
C:\my.sql*/
                   
                   
                   
              /*     
              $I->amOnPage("/admin/components/run/shop/paymentmethods/index");
              try {
                  $I->click('button#pkpk');
              }
               catch (Exception $e){                         // \PHPUnit_Framework_Exception  or EXEPTION
                   $I->comment("exeption catched");
                   $I->see('Создание');
               }*/
               
          }  
        
        /**
         * @group create
         * 
         * insert this after all tests
         */
        public function deleteAllCreatedPaymentsAndCurrencies(AcceptanceTester $I) {
            $this->DeletePayments($I, $this->CreatedPaymentMethods);
            $this->GrabAllCreatedCurrenciesOrDelete($I, $this->CreatedCurrencies);
        }
        
        //______________________________________________________________________
        
//        /**
//         * @group create
//         */
//        public function WebMoneySystem(AcceptanceTester $I) {
//            $paymentsystem                  = 'WebMoney';
//            $name                           = "ОПЛАТА".$paymentsystem;
//            $this->CreatedPaymentMethods[]  = $name;
//
//            $this->CreatePayment($I, $name, null, 'on', null, $paymentsystem);
//        }
//        
//        /**
//         * @group create
//         */
//        public function OschadBankInvoiceSystem(AcceptanceTester $I) {
//            $paymentsystem                  = 'ОщадБанк Украины';
//            $name                           = "ОПЛАТА".$paymentsystem;
//            $this->CreatedPaymentMethods[]  = $name;
//            
//            $this->CreatePayment($I, $name, null, 'on', null, $paymentsystem);
//        }
//        
//        /**
//         * @group create
//         */
//        public function SberBankInvoiceSystem(AcceptanceTester $I) {
//            $paymentsystem                  = 'СберБанк России';
//            $name                           = "ОПЛАТА".$paymentsystem;
//            $this->CreatedPaymentMethods[]  = $name;
//            
//            $this->CreatePayment($I, $name, null, 'on', null, $paymentsystem);
//        }
//        
//        /**
//         * @group create
//         */
//        public function RobokassaSystem(AcceptanceTester $I) {
//            $paymentsystem                  = 'Robokassa';
//            $name                           = "ОПЛАТА".$paymentsystem;
//            $this->CreatedPaymentMethods[]  = $name;
//            
//            $this->CreatePayment($I, $name, null, 'on', null, $paymentsystem);
//        }
//        
//        /**
//         * @group create
//         */
//        public function LiqPaySystem(AcceptanceTester $I) {
//            $paymentsystem                  = 'LiqPay';
//            $name                           = "ОПЛАТА".$paymentsystem;
//            $this->CreatedPaymentMethods[]  = $name;
//            
//            $this->CreatePayment($I, $name, null, 'on', null, $paymentsystem);
//        }
//        
//        /**
//         * @group create
//         */
//        public function YandexMoneySystem(AcceptanceTester $I) {
//            $paymentsystem                  = 'YandexMoney';
//            $name                           = "ОПЛАТА".$paymentsystem;
//            $this->CreatedPaymentMethods[]  = $name;
//
//            $this->CreatePayment($I, $name, null, 'on', null, $paymentsystem);
//        }
//        
//        /**
//         * @group create
//         */
//        public function QiWiSystem(AcceptanceTester $I) {
//            $paymentsystem                  = 'QiWi';
//            $name                           = "ОПЛАТА".$paymentsystem;
//            $this->CreatedPaymentMethods[]  = $name;
//            
//            $this->CreatePayment($I, $name, null, 'on', null, $paymentsystem);
//        }
//        
//        /**
//         * @group create
//         */
//        public function PayPalSystem(AcceptanceTester $I) {
//            $paymentsystem                  = 'PayPal';
//            $name                           = "ОПЛАТА".$paymentsystem;
//            $this->CreatedPaymentMethods[]  = $name;
//            
//            $this->CreatePayment($I, $name, null, 'on', null, $paymentsystem);
//        }
//        
//        
//        /**
//         * @group create
//         */
//        public function PrivateBankSystem(AcceptanceTester $I) {
//            $paymentsystem                  = 'ПриватБанк';
//            $name                           = "ОПЛАТА".$paymentsystem;
//            $this->CreatedPaymentMethods[]  = $name;
//            
//            $this->CreatePayment($I, $name, null, 'on', null, $paymentsystem);
//        }
//        
//        /**
//         * @group create
//         */
//        public function InterkassaSystem(AcceptanceTester $I) {
//            $paymentsystem                  = 'Interkassa';
//            $name                           = "ОПЛАТА".$paymentsystem;
//            $this->CreatedPaymentMethods[]  = $name;
//
//            $this->CreatePayment($I, $name, null, 'on', null, $paymentsystem);
//        }

        
        
}   