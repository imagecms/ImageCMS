<?php
use \DeliveryTester;

class PresentationCest
{
    protected $CreatedMethods = [];

    public function _before(DeliveryTester $I) {
        static $LoggedIn = false;
        if ($LoggedIn) {
            $I->amOnPage(DeliveryCreatePage::$URL);
            $I->waitForText("Создание способа доставки", NULL, '.title');
        }
        $LoggedIn = true;
    }

    /**
     * @group presentation
     */
    public function authorization(DeliveryTester $I) {
        InitTest::Login($I);
        InitTest::changeTextAditorToNative($I);
    }


    /**
     * @group presentation
     * @guy DeliveryTester\DeliverySteps
     */
    public function nameEmpty(DeliveryTester\DeliverySteps $I) {
        $I->click(DeliveryCreatePage::$ButtonCreate);
        $I->CheckForAlertPresent('required','create');
    }
    
    /**
     * @group presentation
     * @guy DeliveryTester\DeliverySteps
     */
    public function nameNormal(DeliveryTester\DeliverySteps $I) {
        $name = "СпособДоставкиТест";
        //For deleting
        $this->CreatedMethods[] = $name;

        $I->CreateDelivery($name, 'on');
        $I->CheckInList($name);
        $I->CheckInFrontEnd($name);
    }

    /**
     * @group presentation
     * @guy DeliveryTester\DeliverySteps
     */
    public function activeUnCheck(DeliveryTester\DeliverySteps $I) {
        $name = "Доставка неактив";
        //For deleting
        $this->CreatedMethods[] = $name;

        $I->CreateDelivery($name);
        $I->CheckInList($name, 'off');
    }


    /**
     * @group presentation
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


    /**
     * @group presentation
     * @guy DeliveryTester\DeliverySteps
     */
    public function fieldPriseSpecifiedNormal(DeliveryTester\DeliverySteps $I) {
        $name = 'УточнениеЦеныДоставки';
        $message = "Уточнение Цены доставки";
        //For deleting
        $this->CreatedMethods[] = $name;

        $I->CreateDelivery($name, 'on', null, null, null, null, $message);
        $I->CheckInFrontEnd($name, null, null, null, $message);
    }

    /**
     * @group presentation
     * @guy DeliveryTester\DeliverySteps
     */
    public function deliveryPaymentCheckedAll(DeliveryTester\DeliverySteps $I) {
        $name = "ДоставкаОплатаВсе";
        //For deleting
        $this->CreatedMethods[] = $name;

        $pay = $I->GrabAllCreatedPayments();

        $I->amOnPage(DeliveryCreatePage::$URL);
        $I->CreateDelivery($name, 'on', null, null, null, null, null, $pay);
        $I->CheckInFrontEnd($name, null, null, null, null, $pay);
    }

    /**
     * @group presentation
     * @guy DeliveryTester\DeliverySteps
     */
    public function deleteAllCreatedMethods(DeliveryTester\DeliverySteps $I) {
        $I->amOnPage(DeliveryPage::$URL);
        //Deleting
        $I->DeleteDeliveryMethods($this->CreatedMethods);
        unset($this->CreatedMethods);
    }
}