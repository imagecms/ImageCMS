<?php
use \PaymentTester;

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
    public function authorization(PaymentTester $I) {
        InitTest::dataBaseBackUp($I);
//        InitTest::dataBaseDump($I);
//        InitTest::dataBaseBackUp($I);
//        InitTest::Login($I);
//        self::$Logged=TRUE;
    }
    
    
    //__________________________________________________________________________FIELD NAME

    /**
     * @group create
     */
    public function nameEmpty(PaymentTester $I){
        $name = "";
        $this->CreatePayment($I, $name);
        $this->CheckForAlertPresent($I, 'required');
    }
    
    /**
     * @group create
     */
    public function nameNoramal(PaymentTester $I){
        $name                   = "ОплатаТест";
        $this->CreatedPaymentMethods[] = $name;
        
        $this->CreatePayment($I, $name);
        $this->CheckForAlertPresent($I, 'success');
    }
    
    /**
     * @group create
     */
    public function name250(PaymentTester $I){
        $name                   = InitTest::$text250;
        $this->CreatedPaymentMethods[] = $name;
        
        $this->CreatePayment($I, $name);
        $this->CheckForAlertPresent($I, 'success');
    }
    
    /**
     * @group create
     */
    public function name251(PaymentTester $I){
        $name                   = InitTest::$text251;
        $this->CreatedPaymentMethods[] = $name;
        
        $this->CreatePayment($I, $name);
        $this->CheckForAlertPresent($I, 'error');
    }
    
    /**
     * @group create
     */
    public function nameSymbols(PaymentTester $I){
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
    public function currenciesCheck(PaymentTester $I) {
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
        public function currencySelection(PaymentTester $I){
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
        public function checkboxActiveOn(PaymentTester $I) {
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
        public function checkboxActiveOff(PaymentTester $I) {
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
        public function fastAllPaymentSystems(PaymentTester $I){
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
//                    $this->CheckInPaymentList($I, $name);
//                    $this->CreateDelivery($I, 'Доставка'.$name, 'on', null, null, null, null, null, $paymentsystem);
//                    $this->CheckInFrontEnd($I, 'Доставка'.$name, null, null, null, null, null, $name);
                }
        }
        
        /**
         * @group currents
         * 
         * experimental
         */
          public function qwewqe(PaymentTester $I) {
                   
               
          }  
        
        /**
         * @group create
         * 
         * insert this after all tests
         */
        public function deleteAllCreatedPaymentsAndCurrencies(PaymentTester $I) {
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