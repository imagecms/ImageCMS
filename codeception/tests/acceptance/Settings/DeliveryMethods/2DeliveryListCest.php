<?php
use \AcceptanceTester;

include_once __DIR__.'\DeliveryHelper.php';

class DeliveryListCest extends DeliveryTestHelper{
    public $name = "ДоставкаСписокТест";
    
    public function _before(AcceptanceTester $I){
        static $callcount=0;
        if ($callcount > 1) {
            $I->amOnPage(DeliveryPage::$URL); 
        }
        $callcount++;
    }

    /**
     * @group list
     */
    public function Authorization(AcceptanceTester $I) {
        InitTest::Login($I);
        $I->amOnPage(DeliveryPage::$URL);
    }

    /**
     * @group list
     */
    public function Initialization(AcceptanceTester $I) {
        if(!$this->SearchDeliveryMethod($I, $this->name)) { 
            $I->amOnPage(DeliveryCreatePage::$URL);
            $this->CreateDelivery($I, $this->name); 
        }
        $I->amOnPage(DeliveryPage::$URL);
    }

    /**
     * @group list
     */
    public function CheckBoxTitle(AcceptanceTester $I) {
        $I->click(DeliveryPage::$CheckboxHeader);
        $Rowcount = $I->grabClassCount($I, 'niceCheck')-1;
        for($row = 1;$row <= $Rowcount;++$row){
            $Cclass = $I->grabAttributeFrom(DeliveryPage::ListCheckboxLine($row).'/..', 'class');
            $class  = 'frame_label active';
            $I->assertEquals($Cclass, $class);
        }
        $Disabled = $I->grabAttributeFrom(DeliveryPage::$DeleteButton, 'disabled');
        $I->assertEquals($Disabled, NULL);
    }
    
    /**
     * @group list
     */
    public function CheckBoxLine(AcceptanceTester $I) {
        $I->click(DeliveryPage::ListCheckboxLine(1));
        $Activity = $I->grabAttributeFrom("//tbody//tr[1]", 'class');
        $I->assertEquals("active", $Activity);
        $Disabled = $I->grabAttributeFrom(DeliveryPage::$DeleteButton, 'disabled');
        $I->assertEquals($Disabled, NULL);
    }
    
    /**
     * @group list
     */
    public function ToggleActive(AcceptanceTester $I) {
        $I->comment("$this->name");
        $row = $this->SearchDeliveryMethod($I, $this->name);
//        $I->click(DeliveryPage::ListCheckboxLine($row));
        $class = $I->grabAttributeFrom(DeliveryPage::ListActiveButtonLine($row), 'class');
        
        If ($class == 'prod-on_off disable_tovar') { 
            $I->click(DeliveryPage::ListActiveButtonLine($row));}
        
        $this->CheckInFrontEnd($I, $this->name);
    }
    
    /**
     * Verify that unactive method isn't present at frontend
     * @group list
     */
      public function ToggleUnActive (AcceptanceTester $I){
          $row = $this->SearchDeliveryMethod($I, $this->name);
          if($row) {
              $ActiveButtonClass = $I->grabAttributeFrom (DeliveryPage::ListActiveButtonLine($row), 'class');
              $I->comment($ActiveButtonClass);
              if( $ActiveButtonClass == 'prod-on_off ') $I->click(DeliveryPage::ListActiveButtonLine($row));
              $missing = $this->CheckMethodNotPresentInFrontEnd($I, $this->name);
              if(!$missing)     $I->fail ('Unactive Method is present in front end');
              elseif ($missing) $I->assertEquals(true, true, "Unactive Method is missing in front end");
          }
              else $I->fail('There are no method $this->name for testing ToggleUnActive, create it before test');
      }
    
    
    /**
     * @group list
     */
    public function WindowButtonCancelX(AcceptanceTester $I) {
        $row = $this->SearchDeliveryMethod($I, $this->name);
        $I->click(DeliveryPage::ListCheckboxLine($row));
        $I->click(DeliveryPage::$DeleteButton);
        $I->waitForText("Удаление способов доставки", NULL, "//*[@id='mainContent']/div/div[1]/div[1]/h3");
        $I->click(DeliveryPage::$DeleteWindowBack);
        $I->see("Список способов доставки",null,".title");
        $I->wait('1');
        $I->click(DeliveryPage::$DeleteButton);
        $I->waitForText("Удаление способов доставки", NULL, "//*[@id='mainContent']/div/div[1]/div[1]/h3");
        $I->click(DeliveryPage::$DeleteWindowX);
        $I->see("Список способов доставки",null,".title");
        }
        
    /**
     * @group list
     */
    public function ButtonDelete(AcceptanceTester $I) {
        $row = $this->SearchDeliveryMethod($I, $this->name);
        $I->click(DeliveryPage::ListCheckboxLine($row));
        $I->click(DeliveryPage::$DeleteButton);
        $I->waitForText("Удаление способов доставки", NULL, "//*[@id='mainContent']/div/div[1]/div[1]/h3");
        $I->click(DeliveryPage::$DeleteWindowDelete);
        $this->CheckForAlertPresent($I, 'success', null, null, 'delete');
    }
        
        /**
         * @group list
         */
    
         /**
        public function DeleteCreatedMethods(AcceptanceTester $I) {
            $Methods = $this->name;
            $this->DeleteDeliveryMethods($I, $Methods);
        }
        */
}