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
        $I->click($this->PaymentName);
        $I->waitForText('Редактирование способа оплаты', null, '.title');
        $I->editPayment(InitTest::$text250);
        $I->checkInList(InitTest::$text250);
        
//        $I->fillField(DeliveryEditPage::$FieldName, InitTest::$text250);
//        $I->checkInList($name)
    }

}
