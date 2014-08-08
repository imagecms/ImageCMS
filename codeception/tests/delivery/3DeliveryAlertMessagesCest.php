<?php

use \DeliveryTester;

class DeliveryAlertMessagesCest {

    protected $CreatedMethods = [];

    /**
     * @group message
     * @group current
     */
    public function authorization(DeliveryTester $I) {
        InitTest::Login($I);    
    }

    /**
     * @group message
     * @group current
     * @guy DeliveryTester\DeliverySteps
     */
    public function listDeleteAlert(DeliveryTester\DeliverySteps $I) {
        $name = "Доставка удаление";
        $I->createDelivery($name);

        $I->amOnPage(DeliveryPage::$URL);
        $AllMethodsCount = $I->grabClassCount($I, "niceCheck") - 1;
        for ($row = 1; $row <= $AllMethodsCount;  ++$row) {
            $CurrentRowMethod = $I->grabTextFrom(DeliveryPage::ListMethodLine($row));
            if ($CurrentRowMethod == $name) {
                $I->click(DeliveryPage::ListCheckboxLine($row));
            }
        }

        $I->click(DeliveryPage::$DeleteButton);
        $I->waitForText("Удаление способов доставки", NULL, "//*[@id='mainContent']/div/div[1]/div[1]/h3");
        $I->wait(1);
        $I->click(DeliveryPage::$DeleteWindowDelete);
        $I->exactlySeeAlert($I, 'success', 'Способ доставки удален');


//    $I->CheckForAlertPresent('success', 'delete');
    }

    /**
     * @group message
     * @guy DeliveryTester\DeliverySteps
     */
    public function creteNameEmptyAlert(DeliveryTester\DeliverySteps $I) {
        $I->amOnPage(DeliveryCreatePage::$URL);
        $I->click(DeliveryCreatePage::$ButtonCreate);
        $I->CheckForAlertPresent('required', 'create');
    }

    /**
     * @group message
     * @guy DeliveryTester\DeliverySteps
     */
    public function creteNameMaxSymbolsListAlert(DeliveryTester\DeliverySteps $I) {
        $name = InitTest::$text501;
        $I->amOnPage(DeliveryCreatePage::$URL);
        $I->fillField(DeliveryCreatePage::$FieldName, $name);
        $I->click(DeliveryCreatePage::$ButtonCreate);
        $I->CheckForAlertPresent('error', 'namemax');
    }

    /**
     * @group message
     * @group current
     * @guy DeliveryTester\DeliverySteps
     */
    public function createNameNormalAlert(DeliveryTester\DeliverySteps $I) {
        $name = "ДоставкаСообщение";
        $I->amOnPage(DeliveryCreatePage::$URL);
        $I->fillField(DeliveryCreatePage::$FieldName, $name);
        $I->click(DeliveryCreatePage::$ButtonCreate);
        $I->exactlySeeAlert($I, 'success', 'Доставка создана');
    }

    /**
     * @group message
     * @guy DeliveryTester\DeliverySteps
     */
    public function editNameEmpty(DeliveryTester\DeliverySteps $I) {
        $firstname = "ДоставкаИмяПусто";
        $changedname = '';
        //For deleting
        $this->CreatedMethods[] = $firstname;
        $this->CreatedMethods[] = $changedname;

        $I->createDelivery($firstname);
        $I->waitForText("Редактирование способа доставки: " . $firstname, null, '.title');
        $I->fillField(DeliveryEditPage::$FieldName, $changedname);
        $I->click(DeliveryEditPage::$ButtonSave);
        $I->CheckForAlertPresent('required', 'edit');
    }

    /**
     * @group message
     * @guy DeliveryTester\DeliverySteps
     */
    public function editName501(DeliveryTester\DeliverySteps $I) {
        $firstname = "ДоствкаИмяМаксСимв";
        $changedname = InitTest::$text501;
        //For deleting
        $this->CreatedMethods[] = $firstname;
        $this->CreatedMethods[] = $changedname;

        $I->createDelivery($firstname);
        $I->waitForText("Редактирование способа доставки: " . $firstname, null, '.title');
        $I->fillField(DeliveryEditPage::$FieldName, $changedname);
        $I->click(DeliveryEditPage::$ButtonSave);
        $I->CheckForAlertPresent('error', 'namemax');
    }

    /**
     * @group edit
     * @guy DeliveryTester\DeliverySteps
     */
    public function deleteAllCreatedMethods(DeliveryTester\DeliverySteps $I) {
        $I->amOnPage(DeliveryPage::$URL);
        //Deleting
        $I->DeleteDeliveryMethods($this->CreatedMethods);
        unset($this->CreatedMethods);
    }

    /**
     * @todo implement functions below
     */
//    public function fieldPriseSpecifiedEmpty(DeliveryTester\DeliverySteps $I) {
//    }
//    public function fieldPriseSpecified501(DeliveryTester\DeliverySteps $I) {
//    }
//    public function ePriceSpecifiedEmpty(DeliveryTester\DeliverySteps $I) {
//    }
//    public function eFieldPriceSpecified501(DeliveryTester\DeliverySteps $I){
//    }
//    ____________________________________________________________________________
}
