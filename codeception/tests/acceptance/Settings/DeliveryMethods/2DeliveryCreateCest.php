<?php

use \AcceptanceTester;

include_once __DIR__.'\DeliveryHelper.php';

/**
 * @todo try to include DeliveryHelpers.php
 */

class DeliveryCreateCest extends DeliveryTestHelper{
    
    public function _before(AcceptanceTester $I) {
        static $callCount;
        if($callCount){
        $I->amOnPage("/admin/components/run/shop/deliverymethods/index");
        $I->click(DeliveryPage::$CreateButton);
        $I->waitForText("Создание способа доставки", NULL, '.title');
        }
        $callCount = true;
    }
    
    /**
     * @group create
     */
    public function Authorization(AcceptanceTester $I) {
        InitTest::Login($I);
        $I->amOnPage("/admin/components/run/shop/deliverymethods/index");
        $I->waitForText("Список способов доставки", "1", ".title");
    }
    
    //-----------------------FIELD NAME TESTS-----------------------------------
    
    /**
     * @group create
     */
    public function NameEmpty(AcceptanceTester $I) {
        $I->click(DeliveryCreatePage::$ButtonCreate);
        $this->CheckForAlertPresent($I,'required',NULL,  DeliveryCreatePage::$FieldName);
    }

    /**
     * @group create
     */
    public function Name250(AcceptanceTester $I) {
        $name = InitTest::$text250;
        
        $this->CreateDelivery($I, $name);
        $this->CheckForAlertPresent($I, 'success');
        $this->CheckInList($I, $name);
        $this->CheckInFrontEnd($I, $name);
    }

    /**
     * @group create
     */
    public function Name500(AcceptanceTester $I) {
        $name = InitTest::$text500;
        
        $this->CreateDelivery($I, $name);
        $this->CheckForAlertPresent($I, 'success');
        $this->CheckInList($I, $name);
        $this->CheckInFrontEnd($I, $name);
    }
    
    /**
     * @group create
     */
    public function Name501(AcceptanceTester $I) {
        $this->CreateDelivery($I, InitTest::$text501);
        $this->CheckForAlertPresent($I, 'error', 'Поле Название не может превышать 500 символов в длину.');
    }
    
    /**
     * @group create
     */
    public function NameSymbols(AcceptanceTester $I){
        $name = InitTest::$textSymbols;
        
        $this->CreateDelivery($I, $name);
        $this->CheckForAlertPresent($I, "success");
        $this->CheckInList($I, $name);
        $this->CheckInFrontEnd($I, $name);
    }
    
    //-----------------------CHECKBOX ACTIVE TESTS------------------------------
    
    /**
     * @group create
     */
    public function ActiveCheck(AcceptanceTester $I){
        $name = "Доставка актив";
        
        $this->CreateDelivery($I, $name, 'on');
        $this->CheckInList($I, $name,'on');
        $this->CheckInFrontEnd($I, $name);
    }
    
    /**
     * @group create
     */
    public function ActiveUnCheck(AcceptanceTester $I) {
        $name = "Доставка неактив";
        
        $this->CreateDelivery($I, $name, 'off');
        $this->CheckInList($I, $name,'off');
    }
    
    //-----------------------FIELD DESCRIPTION TESTS----------------------------
    
    /**
     * @group create
     */
    public function Description(AcceptanceTester $I) {
        $name        = "Доставка Описание";
        $description = $descriptionprice = InitTest::$textSymbols;
        
        $this->CreateDelivery($I, $name, 'on', $description, $descriptionprice);
        $this->CheckForAlertPresent($I, 'success');
        $this->CheckInFrontEnd($I,$name,$description);
        
    }
    
    //-----------------------FIELDS PRICE & FREE FROM TESTS---------------------
    
    /**
     * @group create
     */
    public function PriceFreeFromSymb(AcceptanceTester $I) {
        $price = $freefrom = InitTest::$textSymbols;
        $name  = 'ДоставкаЦенаСимволи';
        
        $this->CreateDelivery($I, $name, 'on', 'off', 'off', $price, $freefrom);
        $this->CheckForAlertPresent($I, 'success');
        $this->CheckInList($I, $name, NULL, $price, $freefrom);
        $this->CheckInFrontEnd($I, $name, null, $price, $freefrom);
    }
    
    /**
     * @group create
     */
    public function PriceFreeFrom1num(AcceptanceTester $I) {
        $price = $freefrom = '1';
        $name  = 'ДоставкаЦена1Цифра';
        
        $this->CreateDelivery($I, $name, 'on', 'off', 'off', $price, $freefrom);
        $this->CheckForAlertPresent($I, 'success');
        $this->CheckInList($I, $name, NULL, $price, $freefrom);
        $this->CheckInFrontEnd($I, $name, null, $price, $freefrom);
    }
    
    /**
     * @group create
     */
    public function PriceFreeFrom10num(AcceptanceTester $I) {
        $price = $freefrom = '55555.55555';
        $name = 'ДоставкаЦена10Цифр';
        
        $this->CreateDelivery($I, $name, 'on', 'off', 'off', $price, $freefrom);
        $this->CheckForAlertPresent($I, 'success');
        $this->CheckInList($I, $name, NULL, $price, $freefrom);
        $this->CheckInFrontEnd($I, $name, null, $price, $freefrom);
    }
    
    /**
     * @group create
     */
    public function PriceFreeFrom15num(AcceptanceTester $I) {
        $price = $freefrom = '9999999999.999';
        $name = 'ДоставкаЦена20Цифр';
        
        $this->CreateDelivery($I, $name, 'on', 'off', 'off', $price, $freefrom);
        $this->CheckForAlertPresent($I, 'success');
        $this->CheckInList($I, $name, NULL, $price, $freefrom);
        $this->CheckInFrontEnd($I, $name, null, $price, $freefrom);
    }
    
    //---------------------CHECKBOX PRICE SPECIFIED & FIELD PRICE SPECIFIED-----
    
    /**
     * @group create
     */
    public function CheckPriseSpecified(AcceptanceTester $I) {
        $I->checkOption(DeliveryCreatePage::$CheckboxPriceSpecified);
        $I->waitForElementVisible(DeliveryCreatePage::$FieldPriceSpecified);
        
        $a = $I->grabAttributeFrom(DeliveryCreatePage::$FieldPrice, 'disabled');
        $b = $I->grabAttributeFrom(DeliveryCreatePage::$FieldPrice, 'disabled');
        
        if($a&&$b){
            $I->assertEquals($a, 'true');
            $I->assertEquals($b, 'true');
        }
        else { $I->fail("Lields are editable"); }
    }
    
    /**
     * @group create
     */
    public function FieldPriseSpecifiedEmpty(AcceptanceTester $I) {
        $name = "УточнениеЦеныПусто";
        
        $this->CreateDelivery($I, $name, 'on', 'off', 'off', 'off', 'off', "");
        $this->CheckForAlertPresent($I, 'success');
    }
    
    /**
     * @group create
     */
    public function FieldPriseSpecified250(AcceptanceTester $I) {
        $name = 'УточнениеЦены250';
        $message = InitTest::$text250;
        
        $this->CreateDelivery($I, $name, 'on', 'off', 'off', 'off', 'off', $message);
        $this->CheckForAlertPresent($I, 'success');
        $this->CheckInFrontEnd($I, $name, NULL, NULL, NULL, $message);
    }
    
    /**
     * @group create
     */
    public function FieldPriseSpecified500(AcceptanceTester $I) {
        $name = 'УточнениеЦены500';
        $message = InitTest::$text500;
        
        $this->CreateDelivery($I, $name, 'on', 'off', 'off', 'off', 'off', $message);
        $this->CheckForAlertPresent($I, 'success');
        $this->CheckInFrontEnd($I, $name, NULL, NULL, NULL, $message);
    }
    
    /**
     * @group create
     */
    public function FieldPriseSpecified501(AcceptanceTester $I) {
        $name = 'УточнениеЦены501';
        $message = InitTest::$text501;
        
        $this->CreateDelivery($I, $name, 'on', 'off', 'off', 'off', 'off', $message);
        $this->CheckForAlertPresent($I, 'error');
    }
    
    /**
     * @group create
     */
    public function FieldPriseSpecifiedSymbols(AcceptanceTester $I) {
        $name = 'УточнениеЦеныСимволы';
        $message = InitTest::$textSymbols;
        
        $this->CreateDelivery($I, $name, 'on', 'off', 'off', 'off', 'off', $message);
        $this->CheckForAlertPresent($I, 'success');
        $this->CheckInFrontEnd($I, $name, null, null, null, $message);
    }
    
    //---------------------PAYMENT METHODS FIELD--------------------------------
    
    /**
     * @group create
     */
    public function DeliveryPaymentVerify(AcceptanceTester $I) {
        $PaymentMethods = $this->GrabAllCreatedPayments($I);
        $row            = 1;
        
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
     */
    public function DeliveryPaymentEmpty(AcceptanceTester $I) {
        $name = "ДоставкаОплатаНет";
        
        $I->amOnPage(DeliveryCreatePage::$URL);
        $this->CreateDelivery($I, $name, 'on', 'off', 'off', 'off', 'off', 'off', 'off');
        $this->CheckInFrontEnd($I, $name, null, null, null, null, 'off');
    }
    
    /**
     * @group create
     */
    public function DeliveryPaymentCheckedAll(AcceptanceTester $I) {
        $name = "ДоставкаОплатаВсе";
        $pay  = $this->GrabAllCreatedPayments($I);
        $pay  = implode("_", $pay);
        
        $I->amOnPage(DeliveryCreatePage::$URL);
        $this->CreateDelivery($I, $name, 'on', 'off', 'off', 'off', 'off', 'off', $pay);
        $this->CheckInFrontEnd($I, $name, null, null, null, null, $pay);
    }
}
