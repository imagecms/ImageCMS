<?php
use \PaymentTester;

class PaymentSystemsCest
{
  //______________________________________________________________________PAY SYSTEMS


    /**
     * Create Payment methods for each payment system
     * @group create
     * @group current
     * @guy PaymentTester\PaymentSteps
     */
    public function AllPaymentSystems(PaymentTester\PaymentSteps $I) {
        $pay_prefix = 'Оплата'; //for name of payment name = $prefix.$paymentsystem
        $delivery_prefix = 'Доставка'; //for name of payment name = $prefix.$paymentsystem

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
            $this->CreatedPaymentMethods[] = $payname = $pay_prefix . $paymentsystem;
            $this->CreatedDeliveries[] = $delname = $delivery_prefix . $paymentsystem;
            $I->wait(1);
            $I->CreatePayment($payname, 'Dollars', 'on', null, $paymentsystem);
            $I->wait(1);
            $I->checkInList($payname);
            $I->wait(1);
            $I->CreateDelivery($delname, 'on', null, null, null, null, null, $paymentsystem);
        }
    }

    /**
     * Delete all after tests
     * @group create
     * @guy PaymentTester\PaymentSteps
     */
    public function deleteAllCreated(PaymentTester\PaymentSteps $I) {
        $I->wait(1);
        $I->DeletePayments($this->CreatedPaymentMethods);
        $I->wait(1);
        $I->deleteCurrencies($this->CreatedCurrencies);
        $I->wait(1);
        $I->deleteDelivery($this->CreatedDeliveries);
        $I->wait(1);
        InitTest::Loguot($I);
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