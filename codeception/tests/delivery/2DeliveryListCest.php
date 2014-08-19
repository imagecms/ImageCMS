<?php

use \DeliveryTester;

class DeliveryListCest {

    public $name = "ДоставкаСписокТест";
    
    public function _before(DeliveryTester $I){
        static $LoggedIn=false;
        if ($LoggedIn) {
            $I->amOnPage(DeliveryPage::$URL); 
        }
        $LoggedIn = true ;
    }

    /**
     * @group list
     * @group current
     */
    public function authorization(DeliveryTester $I) {
        InitTest::Login($I);
        $I->amOnPage(DeliveryPage::$URL);
    }



    /**
     * @group list
     * @guy DeliveryTester\DeliverySteps
     */
    public function initialisation(DeliveryTester\DeliverySteps $I) {
        if (!$I->SearchDeliveryMethod($this->name)) {
            $I->amOnPage(DeliveryCreatePage::$URL);
            $I->CreateDelivery($this->name);
        }
    }

    /**
     * @group list
     */
    public function checkBoxTitle(DeliveryTester $I) {
        $I->click(DeliveryPage::$CheckboxHeader);
        $Rowcount = $I->grabClassCount($I, 'niceCheck') - 1;
        for ($row = 1; $row <= $Rowcount;  ++$row) {
            $Cclass = $I->grabAttributeFrom(DeliveryPage::ListCheckboxLine($row) . '/..', 'class');
            $class = 'frame_label active';
            $I->assertEquals($Cclass, $class);
        }
        $Disabled = $I->grabAttributeFrom(DeliveryPage::$DeleteButton, 'disabled');
        $I->assertEquals($Disabled, NULL);
    }

    /**
     * @group list
     */
    public function checkBoxLine(DeliveryTester $I) {
        $I->click(DeliveryPage::ListCheckboxLine(1));
        $Activity = $I->grabAttributeFrom("//tbody//tr[1]", 'class');
        $I->assertEquals("active", $Activity);
        $Disabled = $I->grabAttributeFrom(DeliveryPage::$DeleteButton, 'disabled');
        $I->assertEquals($Disabled, NULL);
    }

    /**
     * @group list
     * @guy DeliveryTester\DeliverySteps
     */
    public function toggleActive(DeliveryTester\DeliverySteps $I) {
        $I->comment("$this->name");
        $row = $I->SearchDeliveryMethod($this->name);
        $class = $I->grabAttributeFrom(DeliveryPage::ListActiveButtonLine($row), 'class');

        If ($class == 'prod-on_off disable_tovar') {
            $I->click(DeliveryPage::ListActiveButtonLine($row));
        }

        $I->CheckInFrontEnd($this->name);
    }

    /**
     * Verify that unactive method isn't present at frontend
     * 
     * @group list
     * @group current
     * @guy DeliveryTester\DeliverySteps
     */
    public function toggleUnActive(DeliveryTester\DeliverySteps $I) {
        $row = $I->SearchDeliveryMethod($this->name);
        if ($row) {
            $ActiveButtonClass = $I->grabAttributeFrom(DeliveryPage::ListActiveButtonLine($row), 'class');
            $I->comment($ActiveButtonClass);
            if ($ActiveButtonClass == 'prod-on_off ') {
                $I->click(DeliveryPage::ListActiveButtonLine($row));
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
        $row = $I->SearchDeliveryMethod($this->name);
        $I->click(DeliveryPage::ListCheckboxLine($row));
        $I->click(DeliveryPage::$DeleteButton);
        $I->waitForText("Удаление способов доставки", NULL, "//*[@id='mainContent']/div/div[1]/div[1]/h3");
        $I->click(DeliveryPage::$DeleteWindowBack);
        $I->see("Список способов доставки",null,".title");
        $I->wait(1);
        $I->click(DeliveryPage::$DeleteButton);
        $I->waitForText("Удаление способов доставки", NULL, "//*[@id='mainContent']/div/div[1]/div[1]/h3");
        $I->click(DeliveryPage::$DeleteWindowX);
        $I->wait(3);
        $I->see("Список способов доставки",null,".title");
        }
    
    /**
     * @group list
     * @guy DeliveryTester\DeliverySteps
     */
    public function buttonDelete(DeliveryTester\DeliverySteps $I) {
        $row = $I->SearchDeliveryMethod($this->name);
        if(!$row){ 
            $I->createDelivery($this->name);
            $row = $I->SearchDeliveryMethod($this->name);
        }
        $I->comment("$row");
        $I->click(DeliveryPage::ListCheckboxLine($row));
        $I->click(DeliveryPage::$DeleteButton);
        $I->waitForText("Удаление способов доставки", NULL, "//*[@id='mainContent']/div/div[1]/div[1]/h3");
        $I->wait(2);
        $I->click(DeliveryPage::$DeleteWindowDelete);
        $I->CheckForAlertPresent('success', 'delete');
    }
//    /**
//     * @group list
//     * @guy DeliveryTester\DeliverySteps
//     */
//    public function deleteCreatedMethods(DeliveryTester\DeliverySteps $I) {
//        $I->createDelivery($this->name);
//        $I->DeleteDeliveryMethods($this->name);
//    }

        

}
