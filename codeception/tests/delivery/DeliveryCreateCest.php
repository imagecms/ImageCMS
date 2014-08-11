<?php

use \DeliveryTester;

class DeliveryCreateCest {

    protected $CreatedMethods = [];


    /**
     * @group create
     * @group current
     */
    public function authorization(DeliveryTester $I) {
        InitTest::Login($I);
        InitTest::changeTextAditorToNative($I);
    }

//  ____________________________________________________________FIELD_NAME_TESTS


    /**
     * @group create
     * @guy DeliveryTester\DeliverySteps
     */
    public function nameNormal(DeliveryTester\DeliverySteps $I) {
        $name = 'Способ Доставки Тест';
        //For deleting
        $this->CreatedMethods[] = $name;

        $I->CreateDelivery($name,'on');
        $I->CheckInList($name);
        $I->CheckInFrontEnd($name);
    }

    /**
     * @group create
     * @guy DeliveryTester\DeliverySteps
     */
    public function name250(DeliveryTester\DeliverySteps $I) {
        $name = InitTest::$text250;
        //For deleting
        $this->CreatedMethods[] = $name;

        $I->CreateDelivery($name,'on');
        $I->CheckInList($name);
        $I->CheckInFrontEnd($name);
    }

    /**
     * @group create
     * @guy DeliveryTester\DeliverySteps
     */
    public function name500(DeliveryTester\DeliverySteps $I) {
        $name = InitTest::$text500;
        //For deleting
        $this->CreatedMethods[] = $name;

        $I->CreateDelivery($name, 'on');
        $I->CheckInList($name);
        $I->CheckInFrontEnd($name);
    }

    /**
     * @group create
     * @guy DeliveryTester\DeliverySteps
     */
    public function nameSymbols(DeliveryTester\DeliverySteps $I) {
        $name = InitTest::$textSymbols;
        //For deleting
        $this->CreatedMethods[] = $name;

        $I->CreateDelivery($name,'on');
        $I->CheckInList($name);
        $I->CheckInFrontEnd($name);
    }

//    _____________________________________________________CHECKBOX_ACTIVE_TESTS

    /**
     * @group create
     * @guy DeliveryTester\DeliverySteps
     */
    public function activeCheck(DeliveryTester\DeliverySteps $I) {
        $name = "Доставка актив";
        //For deleting
        $this->CreatedMethods[] = $name;

        $I->CreateDelivery($name, 'on');
        $I->CheckInList($name, 'on');
        $I->CheckInFrontEnd($name);
    }

    /**
     * @group create
     * @guy DeliveryTester\DeliverySteps
     */
    public function activeUnCheck(DeliveryTester\DeliverySteps $I) {
        $name = "Доставка неактив";
        //For deleting
        $this->CreatedMethods[] = $name;

        $I->CreateDelivery($name);
        $I->CheckInList($name, 'off');
    }

//    ___________________________________________________FIELD_DESCRIPTION_TESTS

    /**
     * @group create
     * @guy DeliveryTester\DeliverySteps
     */
    public function description(DeliveryTester\DeliverySteps $I) {
        $name = "Доставка Описание";
        //For deleting
        $this->CreatedMethods[] = $name;
        $description = $descriptionprice = InitTest::$textSymbols;

        $I->CreateDelivery($name, 'on', $description, $descriptionprice);
        $I->CheckInFrontEnd($name, $description);
//  _________________________________________________________________________________________________________BUG
    }

//  ________________________________________________FIELDS_PRICE_FREE_FROM_TESTS
    /**
     * @group create
     * @guy DeliveryTester\DeliverySteps
     */
    public function priceFreeFromSymb(DeliveryTester\DeliverySteps $I) {
        $price = $freefrom = InitTest::$textSymbols;
        $name = 'ДоставкаЦенаСимволи';
        //For deleting
        $this->CreatedMethods[] = $name;

        $I->CreateDelivery($name, 'on', null, null, $price, $freefrom);
        $I->CheckInList($name, null, $price, $freefrom);
        $I->CheckInFrontEnd($I, $name, null, $price, $freefrom);
//  _________________________________________________________________________________________________________BUG
    }

    /**
     * @group create
     * 
     * @guy DeliveryTester\DeliverySteps
     */
    public function priceFreeFrom1num(DeliveryTester\DeliverySteps $I) {
        $price = $freefrom = '1';
        $name = 'ДоставкаЦена1Цифра';
        //For deleting
        $this->CreatedMethods[] = $name;

        $I->CreateDelivery($name, 'on', null, null, $price, $freefrom);
        $I->CheckInList($name, NULL, $price, $freefrom);
        $I->CheckInFrontEnd($name, null, $price, $freefrom);
    }

    /**
     * @group create
     * @guy DeliveryTester\DeliverySteps
     */
    public function priceFreeFrom10num(DeliveryTester\DeliverySteps $I) {
        $price = $freefrom = '55555.55555';
        $name = 'ДоставкаЦена10Цифр';
        //For deleting
        $this->CreatedMethods[] = $name;

        $I->CreateDelivery($name, 'on', null, null, $price, $freefrom);
        $I->CheckInList($name, null, $price, $freefrom);
        $I->CheckInFrontEnd($name, null, $price, $freefrom);
    }

    /**
     * @group create
     * @guy DeliveryTester\DeliverySteps
     */
    public function priceFreeFrom15num(DeliveryTester\DeliverySteps $I) {
        $price = $freefrom = '1234567890.321';
        $name = 'ДоставкаЦена15Цифр';
        //For deleting
        $this->CreatedMethods[] = $name;


        $I->CreateDelivery($name, 'on', null, null, $price, $freefrom);
        $I->CheckInList($name, null, $price, $freefrom);
        $I->CheckInFrontEnd($name, null, $price, $freefrom);
    }

//  ______________________________CHECKBOX_PRICE_SPECIFIED_FIELD_PRICE_SPECIFIED

    /**
     * @group create
     */
    public function checkPriseSpecified(DeliveryTester $I) {
        $I->amOnPage(DeliveryCreatePage::$URL);
        $I->checkOption(DeliveryCreatePage::$CheckboxPriceSpecified);
        $I->waitForElementVisible(DeliveryCreatePage::$FieldPriceSpecified);

        $a = $I->grabAttributeFrom(DeliveryCreatePage::$FieldPrice, 'disabled');
        $b = $I->grabAttributeFrom(DeliveryCreatePage::$FieldPrice, 'disabled');

        if ($a && $b) {
            $I->assertEquals($a, 'true');
            $I->assertEquals($b, 'true');
        } else {
            $I->fail("Lields are editable");
        }
    }


    /**
     * @group create
     * @guy DeliveryTester\DeliverySteps
     */
    //__________________________________________________________________________+++++++++++bug here
    public function fieldPriseSpecified250(DeliveryTester\DeliverySteps $I) {
        $name = 'УточнениеЦены250';
        $message = InitTest::$text250;
        //For deleting
        $this->CreatedMethods[] = $name;

        $I->CreateDelivery($name, 'on', null, null, null, null, $message);
        $I->waitForText('Редактирование способа доставки: ' . $name, 10);
        $I->wait(5);
        $I->CheckInFrontEnd($name, null, null, null, $message);
    }
    

    /**
     * @group create
     * @guy DeliveryTester\DeliverySteps
     */
    //__________________________________________________________________________+++++++++++bug here
    public function fieldPriseSpecified500(DeliveryTester\DeliverySteps $I) {
        $name = 'УточнениеЦены500';
        $message = InitTest::$text500;
        //For deleting
        $this->CreatedMethods[] = $name;

        $I->CreateDelivery($name, 'on', null, null, null, null, $message);
        $I->CheckInFrontEnd($name, null, null, null, $message);
    }


    /**
     * @group create
     * @guy DeliveryTester\DeliverySteps
     */

    public function fieldPriseSpecifiedSymbols(DeliveryTester $I) {
        $name = 'УточнениеЦеныСимволы';
        $message = InitTest::$textSymbols;
        //For deleting
        $this->CreatedMethods[] = $name;

        $I->CreateDelivery($name, 'on', null, null, null, null, $message);
        $I->CheckInFrontEnd($name, null, null, null, $message);
    }

//  _______________________________________________________PAYMENT_METHODS_FIELD

    /**
     * @group create
     * @guy DeliveryTester\DeliverySteps
     */
    public function deliveryPaymentVerify(DeliveryTester\DeliverySteps $I) {
        $PaymentMethods = $I->GrabAllCreatedPayments();
        $row = 1;

        $I->amOnPage(DeliveryCreatePage::$URL);
        $I->waitForText("Создание способа доставки", NULL, '.title');
        $I->comment("I want to Verify created Pay Methods with Create Page Pay Methods");

        foreach ($PaymentMethods as $Currentpay) {
            $I->comment($Currentpay);
            $CreatePagePay = $I->grabTextFrom(DeliveryCreatePage::PaymentMethodLabel($row));
            $I->assertEquals($CreatePagePay, $Currentpay);
            $row++;
        }
    }

    /**
     * @group create
     * @group current
     * @guy DeliveryTester\DeliverySteps
     */
    public function deliveryPaymentEmpty(DeliveryTester\DeliverySteps $I) {
        $name = "ДоставкаОплатаНет";
        //For deleting
        $this->CreatedMethods[] = $name;

        $I->CreateDelivery($name, 'on', null, null, null, null, null, null);
        $I->waitForText('Редактирование способа доставки: ' . $name, 10);
        $I->CheckInFrontEnd($name, null, null, null, null, 'off');
    }

    /**
     * @group create
     * @guy DeliveryTester\DeliverySteps
     */
    //__________________________________________________________________________+++++++++++bug here
    public function deliveryPaymentCheckedAll(DeliveryTester\DeliverySteps $I) {
        $name = "ДоставкаОплатаВсе";
        //For deleting
        $this->CreatedMethods[] = $name;

        $pay = $I->GrabAllCreatedPayments();

        $I->amOnPage(DeliveryCreatePage::$URL);
        $I->CreateDelivery($name, 'on', null, null, null, null, null, $pay);
        $I->waitForText('Редактирование способа доставки: ' . $name, 10);
        $I->CheckInFrontEnd($name, null, null, null, null, $pay);
    }

    /**
     * @group create
     * @guy DeliveryTester\DeliverySteps
     */
    public function deleteAllCreatedMethods(DeliveryTester\DeliverySteps $I) {
        $I->amOnPage(DeliveryPage::$URL);
        //Deleting
        $I->DeleteDeliveryMethods($this->CreatedMethods);
        unset($this->CreatedMethods);
    }

}
    //__________________________________________________________________________+++++++++++bug here
    //    ________________________¶¶
    //_______________________¶
    //______________________¶___________¶¶¶
    //______________________¶________¶¶¶
    //______¶¶¶¶¶¶__________¶_______¶
    //____________¶¶¶______¶¶¶¶¶¶_¶¶
    //_______________¶¶¶___¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶
    //__¶¶¶___¶¶¶___¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶
    //_____¶¶¶___¶¶¶_¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶
    //___¶¶¶¶¶¶¶¶¶¶¶_¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶
    //__¶¶¶¶¶¶¶¶¶¶¶¶_¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶
    //___¶¶¶¶¶¶¶¶¶¶¶_¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶
    //_____¶¶¶___¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶
    //__¶¶¶___¶¶¶__¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶
    //_______________¶¶¶__¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶¶
    //____________¶¶¶______¶¶¶¶¶¶__¶¶
    //______¶¶¶¶¶¶__________¶________¶
    //______________________¶_________¶¶¶
    //______________________¶____________¶¶¶
    //_______________________¶
    //________________________¶¶
    //    
