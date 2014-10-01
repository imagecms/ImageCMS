<?php

use \PaymentTester;

class PaymentEditCest {

    protected static $Logged = false;
    protected static $Init = true;
    //array of all created payments for deleting
    protected $CreatedPayments = [];
    //payment method name for testing will change in tests
    protected $PaymentName = 'ОплатаРедактирование';
    protected $DeliveryName = 'ДоставкаДляОплатаРедактирование';
    protected $CurrencyName = 'Pounds';

    /**
     * @guy PaymentTester\PaymentSteps
     */
    public function _before(PaymentTester\PaymentSteps $I) {
        if (self::$Logged && self::$Init) {
            $I->amOnPage(PaymentListPage::$URL);
            try {
                $I->click($this->PaymentName);
            } catch (Exception $e) {
                $I->createPayment($this->PaymentName, $this->CurrencyName, 'on');
            }
            $I->waitForText('Редактирование способа оплаты', null, '.title');
        }
    }

    /**
     * @group edit
     * @group current
     * @guy PaymentTester\PaymentSteps
     */
    public function authorization(PaymentTester\PaymentSteps $I) {
        InitTest::Login($I);
        self::$Logged = TRUE;
    }

    /**
     * create currency ,payment and delivery for testing
     * 
     * @group edit
     * @guy PaymentTester\PaymentSteps
     */
    public function init(PaymentTester\PaymentSteps $I) {
        $I->createCurrency($this->CurrencyName, 'GBP', '£', '0.0167');
        $I->createPayment($this->PaymentName, $this->CurrencyName, 'on');
        $I->createDelivery($this->DeliveryName, 'on', null, null, null, null, null, $this->PaymentName);
        self::$Init = TRUE;
    }

    /**
     * check that method is created with 250 symbols in name
     * 
     * @group edit
     * @guy PaymentTester\PaymentSteps 
     */
    public function name250(PaymentTester\PaymentSteps $I) {
        $this->CreatedPayments [] = $this->PaymentName = $name = InitTest::$text250;
        $I->editPayment($name);
        $I->checkInList($name);
    }

    /**
     * check that method is created with all available symbols in name
     * @group edit
     * @guy PaymentTester\PaymentSteps 
     */
    public function nameSymbols(PaymentTester\PaymentSteps $I) {
        $this->CreatedPaymentsp[] = $this->PaymentName = $name = InitTest::$textSymbols;
        $I->editPayment($name);
        $I->checkInList($name);
    }

    /**
     * rename method to normal name 
     * @group edit
     * @guy PaymentTester\PaymentSteps
     */
    public function nameNormal(PaymentTester\PaymentSteps $I) {
        $this->CreatedPaymentsp[] = $this->PaymentName = $name = "ОплатаРедактирование";
        $I->editPayment($name);
        $I->checkInList($name);
    }

    /**
     * Check that all created currencies present is select menu
     * 
     * @group edit
     * @guy PaymentTester\PaymentSteps
     */
    public function currenciesCheck(PaymentTester\PaymentSteps $I) {

        $OptionsAmount = $I->grabTagCount($I, 'select option', 0);
        $I->comment("$OptionsAmount");
        for ($row = 0; $row < $OptionsAmount; ++$row) {
            $Options[$row] = $I->grabTextFrom(PaymentEditPage::selectCurrencyOption($row + 1));
            $Options[$row] = trim(array_shift(explode('(', $Options[$row]))); //to get only name of currency without whitespaces
        }
        $CreatedCurrencies = $I->GrabAllCreatedCurrencies();

        $difference = array_diff($CreatedCurrencies, $Options);
        empty($difference) ? $I->assertEquals(TRUE, TRUE, 'all created currencies present in select menu') : $I->fail('there id no all currencies in select menu');
    }

    /**
     * Checks that,created method uses selected currency 
     * 
     * @group edit
     * @guy PaymentTester\PaymentSteps
     */
    public function currencySelection(PaymentTester\PaymentSteps $I) {
        $I->editPayment($this->PaymentName, $this->CurrencyName);
        $I->checkInList($this->PaymentName, $this->CurrencyName);
    }

    /**
     * Check that unactive method have unactive toggle button 'active'
     * 
     * @group current
     * @group create
     * @guy paymentTester\PaymentSteps
     */
    public function checkboxActiveOff(PaymentTester\PaymentSteps $I) {
        $I->EditPayment($this->PaymentName, null, 'off');
        $I->checkInList($this->PaymentName, null, null, false);
    }
    
    /**
     * Check that active method have active toggle button 'active'
     * 
     * @group current
     * @group edit
     * @guy PaymentTester\PaymentSteps
     */
    public function checkboxActiveOn(PaymentTester\PaymentSteps $I) {
        $I->EditPayment($this->PaymentName, null, 'on');
        $I->checkInList($this->PaymentName, null, null, true);
    }
    
    /**
     * Delete all created and logout
     * 
     * @group edit
     * @guy PaymentTester\PaymentSteps
     * 
     */
    public function destruct(PaymentTester\PaymentSteps $I){
        $I->deletePayments($this->PaymentName);
        $I->deleteCurrencies($this->CurrencyName);
        $I->deleteDelivery($this->DeliveryName);
        InitTest::Loguot($I);
    }
}
