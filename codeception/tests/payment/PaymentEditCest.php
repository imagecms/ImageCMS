<?php

use \PaymentTester;

class PaymentEditCest {

    protected static $Logged = false;
    protected $PaymentName = 'ОплатаРедактирование';
    protected $DeliveryName = 'ДоставкаДляОплатаРедактирование';
    protected $CurrencyNme = 'Pounds';

    public function _before() {
        
    }

    /**
     * @group edit
     * @group current
     */
    public function authorization(PaymentTester $I) {
        InitTest::Login($I);
        self::$Logged = true;
    }

    /**
     * @group edit
     * @guy PaymentTester\PaymentSteps
     */
    public function init(PaymentTester\PaymentSteps $I) {
        $I->createCurrency($this->CurrencyNme, 'GBP', '£', '0.0167');
        $I->createPayment($this->PaymentName, $this->CurrencyNme, 'on');
        $I->createDelivery($this->DeliveryName, 'on', null, null, null, null, null, $this->PaymentName);
    }

    /**
     * @group edit
     * @group current
     * @guy PaymentTester\PaymentSteps 
     */
    public function name250(PaymentTester\PaymentSteps $I) {
        $I->amOnPage(PaymentListPage::$URL);
        try {
            $I->click($this->PaymentName);
        } catch (Exception $e) {
            $I->createDelivery($this->DeliveryName, 'on', null, null, null, null, null, $this->PaymentName);
        }
        $I->waitForText('Редактирование способа оплаты', null, '.title');
        $I->editPayment(InitTest::$text250);
        $I->checkInList(InitTest::$text250);
        $this->PaymentName = InitTest::$text250;
    }

    /**
     * @todo finish method and add to stepObject, realise checking for all payment systems
     * Method for checking payment system in FrontEnd
     * @group current
     * @guy PaymentTester\PaymentSteps 
     * 
     */
//    public function frontPay(PaymentTester\PaymentSteps $I) {
//        $I->amOnPage('/shop/cart');
//        $I->waitForText('Оформление заказа');
//        $DeliveryName = $this->DeliveryName;
////        $PaymentName = 
//        $DeliveriesInProcessingOrderPageAmount = $I->grabClassCount($I, 'name-count');
//        for ($j = 1; $j <= $DeliveriesInProcessingOrderPageAmount; ++$j) {
//            $GrabbedName = $I->grabTextFrom("//div[@class='frame-radio']/div[$j]//span[@class='text-el']");
//            if ($GrabbedName == $DeliveryName) {
//                $I->click("//div[@class='frame-radio']/div[$j]//span[@class='text-el']");
//                break;
//            }
//        }
//        $I->wait(7);
//        $I->scrollToElement($I, '.frame-payment.p_r');
//        $I->click("#cuselFrame-paymentMethod");
//        $payment_name = InitTest::$text250;
//        $payment_options_css = 'div[id="cusel-scroll-paymentMethod"]';
//        $payment_options_xpath = '//div[@id="cusel-scroll-paymentMethod"]';
//        $payment_methods_amount = $I->grabCCSAmount($I, "$payment_options_css span");
//        for ($index = 1; $index <= $payment_methods_amount; $index++) {
//            $text = $I->grabTextFrom("$payment_options_xpath/span[$index]");
//            if ($text == $payment_name) {
//                $I->click("$payment_options_xpath/span[$index]");
//                break;
//            }
////            $I->comment($text);
//        }
//        //Заповнити поля тел і.т.д
//        $I->click('#submitOrder');
//        $I->wait(5);
//    }
}
