<?php

use \DeliveryTester;

class DeliveryListCest {

    public $name = "ДоставкаСписокТест";
    
//    public function _before(DeliveryTester $I){
//        static $LoggedIn=false;
//        if ($LoggedIn) {
//            $I->amOnPage(DeliveryPage::$URL); 
//        }
//        $LoggedIn = true ;
//    }

    /**
     * @group list
     * @group current
     */
    public function authorization(DeliveryTester $I) {
        InitTest::Login($I);
    }

    /**
     * @group list
     * @group current
     * @guy DeliveryTester\DeliverySteps
     */
    public function initialisation(DeliveryTester\DeliverySteps $I) {
        $I->amOnPage(DeliveryListPage::$URL);
        if (!$I->SearchDeliveryMethod($this->name)) {
            $I->CreateDelivery($this->name);
        }
    }

    /**
     * @group list
     */
    public function checkBoxTitle(DeliveryTester $I) {
        $I->wait(1);
        $I->amOnPage(DeliveryListPage::$URL);
        $I->waitForText("Список способов доставки");
        $I->click(DeliveryListPage::$HeadCheck);
        $Rowcount = $I->grabClassCount($I, 'niceCheck') - 1;
        for ($row = 1; $row <= $Rowcount;  ++$row) {
            $Cclass = $I->grabAttributeFrom(DeliveryListPage::lineCheck($row) . '/..', 'class');
            $class = 'frame_label active';
            $I->assertEquals($Cclass, $class);
        }
        $Disabled = $I->grabAttributeFrom(DeliveryListPage::$ButtonDelete, 'disabled');
        $I->assertEquals($Disabled, NULL);
    }

    /**
     * @group list
     */
    public function checkBoxLine(DeliveryTester $I) {
        $I->amOnPage(DeliveryListPage::$URL);
        $I->click(DeliveryListPage::lineCheck(1));
        $Activity = $I->grabAttributeFrom(DeliveryListPage::lineCheck(1).'/../../..', 'class');
        $I->assertEquals("active", $Activity);
        $Disabled = $I->grabAttributeFrom(DeliveryListPage::$ButtonDelete, 'disabled');
        $I->assertEquals($Disabled, NULL);
    }

    /**
     * @group list
     * @guy DeliveryTester\DeliverySteps
     */
    public function toggleActive(DeliveryTester\DeliverySteps $I) {
        $I->amOnPage(DeliveryListPage::$URL);
        $I->comment("$this->name");
        $row = $I->SearchDeliveryMethod($this->name);
        $class = $I->grabAttributeFrom(DeliveryListPage::lineActiveToggle($row), 'class');

        If ($class == 'prod-on_off disable_tovar') {
            $I->click(DeliveryListPage::lineActiveToggle($row));
        }

        $I->CheckInFrontEnd($this->name);
    }

    /**
     * Verify that unactive method isn't present at frontend
     * 
     * @group list
     * @guy DeliveryTester\DeliverySteps
     */
    public function toggleUnActive(DeliveryTester\DeliverySteps $I) {
        $I->amOnPage(DeliveryListPage::$URL);
        $row = $I->SearchDeliveryMethod($this->name);
        if ($row) {
            $ActiveButtonClass = $I->grabAttributeFrom(DeliveryListPage::lineActiveToggle($row), 'class');
            $I->comment($ActiveButtonClass);
            if ($ActiveButtonClass == 'prod-on_off ') {
                $I->click(DeliveryListPage::lineActiveToggle($row));
            }
            $missing = $I->CheckMethodNotPresentInFrontEnd($this->name);
            if (!$missing) {
                $I->fail('Unactive Method is present in front end');
            } elseif ($missing) {
                $I->assertEquals(true, true, "Unactive Method is missing in front end");
            }
        } else {
            $I->fail('There are no method $this->name for testing ToggleUnActive, create it before test');
        }
    }
    /**
     * @group list
     * @guy DeliveryTester\DeliverySteps
     */
    public function windowButtonCancelX(DeliveryTester\DeliverySteps $I) {
        $I->amOnPage(DeliveryListPage::$URL);
        $row = $I->SearchDeliveryMethod($this->name);
        $I->click(DeliveryListPage::lineCheck($row));
        $I->click(DeliveryListPage::$ButtonDelete);
        $I->waitForText("Удаление способов доставки", NULL, DeliveryListPage::$WindowDeleteTitle);
        $I->click(DeliveryListPage::$WindowDeleteButtonCancel);
        $I->see("Список способов доставки",null,".title");
        $I->wait(3);
        $I->click(DeliveryListPage::$ButtonDelete);
        $I->waitForText("Удаление способов доставки", NULL, DeliveryListPage::$WindowDeleteTitle);
        $I->wait(1);
        $I->click(DeliveryListPage::$WindowDeleteButtonClose);
        $I->wait(3);
        $I->see("Список способов доставки",null,  DeliveryListPage::$Title);
        }
    
    /**
     * @group current
     * @group list
     * @guy DeliveryTester\DeliverySteps
     */
    public function buttonDelete(DeliveryTester\DeliverySteps $I) {
        $I->amOnPage(DeliveryListPage::$URL);
        $row = $I->SearchDeliveryMethod($this->name);
        if(!$row){ 
            $I->createDelivery($this->name);
            $row = $I->SearchDeliveryMethod($this->name);
        }
        $I->comment("$row");
        $I->click(DeliveryListPage::lineCheck($row));
        $I->click(DeliveryListPage::$ButtonDelete);
        $I->waitForText("Удаление способов доставки", NULL, "//*[@id='mainContent']/div/div[1]/div[1]/h3");
        $I->wait(2);
        $I->click(DeliveryListPage::$WindowDeleteButtonDelete);
        $I->exactlySeeAlert($I,'success', 'Способ доставки удален');
    }
    
    /**
     * @group list
     * @group current
     */
    public function logout(DeliveryTester $I) {
        InitTest::Loguot($I);
    }
}