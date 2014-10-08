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
     * @guy DeliveryTester\DeliverySteps
     */
    public function listDeleteAlert(DeliveryTester\DeliverySteps $I) {
        $name = "Доставка удаление";
        $I->createDelivery($name);
        $I->waitForText("Редактирование способа доставки: " . $name, null, '.title');
        $I->amOnPage(DeliveryListPage::$URL);
        $AllMethodsCount = $I->grabClassCount($I, "niceCheck") - 1;
        for ($row = 1; $row <= $AllMethodsCount;  ++$row) {
            $CurrentRowMethod = $I->grabTextFrom(DeliveryListPage::lineMethodLink($row));
            if ($CurrentRowMethod == $name) {
                $I->click(DeliveryListPage::lineCheck($row));
            }
        }

        $I->click(DeliveryListPage::$ButtonDelete);
        $I->waitForText("Удаление способов доставки", NULL, DeliveryListPage::$WindowDeleteTitle);
        $I->wait(1);
        $I->click(DeliveryListPage::$WindowDeleteButtonDelete);
        $I->exactlySeeAlert($I, 'success', 'Способ доставки удален');
    }

    /**
     * @group message
     * @guy DeliveryTester\DeliverySteps
     */
    public function creteNameEmptyAlert(DeliveryTester\DeliverySteps $I) {
        $I->amOnPage(DeliveryListPage::$URL);
        $I->waitForText('Список способов доставки', null, DeliveryListPage::$Title);
        $I->click(DeliveryListPage::$ButtonCreate);
        $I->waitForText("Создание способа доставки", null, DeliveryCreatePage::$Title);
        $I->click(DeliveryCreatePage::$ButtonCreate);
        $I->CheckForAlertPresent('required', 'create');
    }

    /**
     * @group message
     * @guy DeliveryTester\DeliverySteps
     */
    public function creteNameMaxSymbolsListAlert(DeliveryTester\DeliverySteps $I) {
        $name = InitTest::$text501;
        $I->amOnPage(DeliveryListPage::$URL);
        $I->waitForText('Список способов доставки', null, DeliveryListPage::$Title);
        $I->click(DeliveryListPage::$ButtonCreate);
        $I->waitForText("Создание способа доставки", null, DeliveryCreatePage::$Title);

        $I->fillField(DeliveryCreatePage::$InputName, $name);
        $I->click(DeliveryCreatePage::$ButtonCreate);
        $I->CheckForAlertPresent('error', 'namemax');
    }

    /**
     * @group message
     * @guy DeliveryTester\DeliverySteps
     */
    public function createNameNormalAlert(DeliveryTester\DeliverySteps $I) {
        $name = "ДоставкаСообщение";        
        $I->amOnPage(DeliveryListPage::$URL);
        $I->waitForText('Список способов доставки', null, DeliveryListPage::$Title);
        $I->click(DeliveryListPage::$ButtonCreate);
        $I->waitForText("Создание способа доставки", null, DeliveryCreatePage::$Title);
        $I->fillField(DeliveryCreatePage::$InputName, $name);
        $I->click(DeliveryCreatePage::$ButtonCreate);
        $I->exactlySeeAlert($I, 'success', 'Доставка создана');
        $I->waitForText("Редактирование способа доставки: " . $name, null, DeliveryEditPage::$Title);
    }

    /**
     * @group message
     * @group current
     * @guy DeliveryTester\DeliverySteps
     */
    public function editNameEmpty(DeliveryTester\DeliverySteps $I) {
        $first_name = "ДоставкаИмяПусто";
        $changed_name = '';
        //For deleting
        $this->CreatedMethods[] = $first_name;
        $this->CreatedMethods[] = $changed_name;
//        $I->createDelivery($firstname);
        $I->amOnPage(DeliveryListPage::$URL);
        $I->waitForText('Список способов доставки', null, DeliveryListPage::$Title);
        $I->click(DeliveryListPage::$ButtonCreate);
        $I->waitForText("Создание способа доставки", null, DeliveryCreatePage::$Title);
        $I->fillField(DeliveryCreatePage::$InputName, $first_name);
        $I->click(DeliveryCreatePage::$ButtonCreate);
        $I->waitForText("Редактирование способа доставки: " . $first_name, null, DeliveryEditPage::$Title);
        $I->fillField(DeliveryEditPage::$InputName, $changed_name);
        $I->click(DeliveryEditPage::$ButtonSave);
        $I->CheckForAlertPresent('required', 'edit');
    }


    /**
     * @group message
     * @guy DeliveryTester\DeliverySteps
     */
    public function editName501(DeliveryTester\DeliverySteps $I) {
        $first_name = "ДоствкаИмяМаксСимв";
        $changed_name = InitTest::$text501;
        //For deleting
        $this->CreatedMethods[] = $first_name;
        $this->CreatedMethods[] = $changed_name;

        $I->createDelivery($first_name);
        $I->waitForText("Редактирование способа доставки: " . $first_name, null, DeliveryEditPage::$Title);
        $I->fillField(DeliveryEditPage::$InputName, $changed_name);
        $I->click(DeliveryEditPage::$ButtonSave);
        $I->CheckForAlertPresent('error', 'namemax');
    }

    /**
     * @group message
     * @guy DeliveryTester\DeliverySteps
     */
    public function deleteAllCreatedMethods(DeliveryTester\DeliverySteps $I) {
        $I->amOnPage(DeliveryListPage::$URL);
        //Deleting
        $I->DeleteDeliveryMethods($this->CreatedMethods);
        unset($this->CreatedMethods);
    }
    /**
     * @group message
     */
    public function logout(DeliveryTester $I) {
        InitTest::Loguot($I);
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
