<?php

use \PaymentTester;

class PaymentCreateCest {

    protected $CreatedPaymentMethods = [];
    protected $CreatedCurrencies = [];
    protected static $Logged = false;

    /**
     * @group create
     * @group current
     */
    public function authorization(PaymentTester $I) {
        InitTest::Login($I);
        self::$Logged = true;
    }

    //__________________________________________________________________________FIELD NAME

    /**
     * @group create
     * @guy PaymentTester\PaymentSteps
     */
    public function nameNoramal(PaymentTester\PaymentSteps $I) {
        $name = "ОплатаТест";
        $this->CreatedPaymentMethods[] = $name;

        $I->createPayment($name);
        $I->checkInList($name);
    }

    /**
     * @group create
     * @guy PaymentTester\PaymentSteps
     */
    public function name250(PaymentTester\PaymentSteps $I) {
        $name = InitTest::$text250;
        $this->CreatedPaymentMethods[] = $name;

        $I->CreatePayment($name);
        $I->checkInList($name);
    }

    /**
     * @group create
     * @guy PaymentTester\PaymentSteps
     */
    public function nameSymbols(PaymentTester\Paymentsteps $I) {
        $name = InitTest::$textSymbols;
        $DeliveryName = "Доставка Оплата";

        $this->CreatedPaymentMethods[] = $name;

        $I->createPayment($name, null, 'on');
        $I->checkInList($name);
    }

    //__________________________________________________________________________CURRENCY SELECTION

    /**
     * Check that all created currencies present is select menu
     * 
     * @group create
     * @guy PaymentTester\PaymentSteps
     */
    public function currenciesCheck(PaymentTester\PaymentSteps $I) {
        $CreatedCurrencies = $I->GrabAllCreatedCurrencies();

        //add options of <select> at create page to array $Options[]
        $I->amOnPage(PaymentCreatePage::$URL);
        $OptionsAmount = $I->grabTagCount($I, 'select option', 0);
        $I->comment("$OptionsAmount");
        for ($row = 0; $row < $OptionsAmount; ++$row) {
            $Options[$row] = $I->grabTextFrom(PaymentCreatePage::SelectCurrency($row + 1));
            $Options[$row] = trim(array_shift(explode('(', $Options[$row]))); //to get only name of currency
        }
        foreach ($CreatedCurrencies as $key => $Currecy) {
            $I->assertEquals($Currecy, $Options[$key]);
        }
    }

    /**
     * Checks that,created method uses selected currency 
     * 
     * @group create
     * @guy PaymentTester\PaymentSteps
     */
    public function currencySelection(PaymentTester\PaymentSteps $I) {
        $PaymentName = 'ОплатаВалюта';
        $this->CreatedPaymentMethods [] = $PaymentName;
        $CurrencyName = 'Pounds';
        $this->CreatedCurrencies [] = $CurrencyName;
        $I->CreateCurrency($CurrencyName);
        $I->amOnPage(PaymentCreatePage::$URL);
        $I->CreatePayment($PaymentName, $CurrencyName);
        $I->checkInList($PaymentName, $CurrencyName);
    }

    //______________________________________________________________________FIELD DESCRIPTION
    //There are nothing to check
    //______________________________________________________________________ACTIVE CHECKBOX
    /**
     * @group create
     * @guy PaymentTester\PaymentSteps
     */
    public function checkboxActiveOn(PaymentTester\PaymentSteps $I) {
        $pay = 'ОплатаАктив';
        $this->CreatedPaymentMethods[] = $pay;
        $delivery = 'ДоставкаоплатаАктив';

        $I->CreatePayment($pay, null, 'on');
        $I->CreateDelivery($delivery, 'on', null, null, null, null, null, $pay);
        $I->checkInFront($delivery, null, null, null, null, $pay);
    }

    /**
     * @group create
     * @group current
     * @guy paymentTester\PaymentSteps
     */
    public function checkboxActiveOff(PaymentTester\PaymentSteps $I) {
        $pay = 'ОплатаНеАктив';
        $this->CreatedPaymentMethods[] = $pay;
        $delivery = 'ДоставкаОплатаНеактив';

        $I->CreatePayment($pay, null, 'off');
        $I->CreateDelivery($delivery, 'on', null, null, null, null, null, $pay);
        $I->CheckInFront($delivery, null, null, null, null, 'off');
    }

//        
//        
//        //______________________________________________________________________PAY SYSTEMS
//        //OR ONE TEST FOR ALL
//
//        /**
//         * Create Payment methods for each payment system
//         * @group create
//         */
//        public function fastAllPaymentSystems(PaymentTester $I){
//            $prefix         = 'Оплата';//for name of payment name = $prefix.$paymentsystem
//            $PaymentSystems = [
//                'WebMoney',
//                'ОщадБанк Украины',
//                'СберБанк России',
//                'Robokassa',
//                'LiqPay',
//                'YandexMoney',
//                'QiWi',
//                'PayPal',
//                'ПриватБанк',
//                'Interkassa'
//                ];
//            
//                foreach ($PaymentSystems as $paymentsystem) {
//                    $this->CreatedPaymentMethods[] = $name = $prefix.$paymentsystem;
//                    $this->CreatePayment($I, $name, 'Dollars', 'on', null, $paymentsystem);
////                    $this->CheckInPaymentList($I, $name);
////                    $this->CreateDelivery($I, 'Доставка'.$name, 'on', null, null, null, null, null, $paymentsystem);
////                    $this->CheckInFrontEnd($I, 'Доставка'.$name, null, null, null, null, null, $name);
//                }
//        }
//        
//        /**
//         * @group currents
//         * 
//         * experimental
//         */
//          public function qwewqe(PaymentTester $I) {
//                   
//               
//          }  
//        
//        /**
//         * @group create
//         * 
//         * insert this after all tests
//         */
//        public function deleteAllCreatedPaymentsAndCurrencies(PaymentTester $I) {
//            $this->DeletePayments($I, $this->CreatedPaymentMethods);
//            $this->GrabAllCreatedCurrenciesOrDelete($I, $this->CreatedCurrencies);
//        }
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
