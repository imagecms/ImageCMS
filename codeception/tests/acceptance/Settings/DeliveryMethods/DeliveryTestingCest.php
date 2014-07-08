<?php

use \AcceptanceTester;

class DeliveryTesting {
    /**
     * @group create
     */
    public function Authorization(AcceptanceTester $I) {
        InitTest::Login($I);
        $I->amOnPage("/admin/components/run/shop/deliverymethods/index");
        $I->waitForText("Список способов доставки", "1", ".title");
    }

//------------------------------------------FIELD NAME TESTS----------------------------------------------------------------------------------------------------
    /**
     * @group createa
     */
    public function NameEmpty(AcceptanceTester $I) {
        $I->click(DeliveryPage::$CreateButton);
        $I->waitForText("Создание способа доставки", '10', '.title');
        $I->click(DeliveryCreatePage::$ButtonCreate);
        $I->waitForElementVisible('//label[@generated="true"]');
        $I->see('Это поле обязательное.', 'label.alert.alert-error');
        $I->click(DeliveryCreatePage::$ButtonBack);
        $I->wait('2');
    }

    /**
     * @group createa
     */
    public function Name250(AcceptanceTester $I) {
        $I->click(DeliveryPage::$CreateButton);
        $I->waitForText("Создание способа доставки", '10', '.title');
        $this->CreateDelivery($I, InitTest::$name250);
        $I->waitForElementVisible(".alert.in.fade.alert-success");
        $I->waitForElementNotVisible(".alert.in.fade.alert-success");
        $I->click(DeliveryCreatePage::$ButtonBack);
        $I->wait('2');
        $this->VerifyList($I, InitTest::$name250);
    }

    /**
     * @group createa
     */
    public function Name500(AcceptanceTester $I) {
        $I->click(DeliveryPage::$CreateButton);
        $I->waitForText("Создание способа доставки", '10', '.title');
        $this->CreateDelivery($I, InitTest::$name500);
        $I->waitForElementVisible(".alert.in.fade.alert-success");
        $I->waitForElementNotVisible(".alert.in.fade.alert-success");
        $I->click(DeliveryCreatePage::$ButtonBack);
        $I->wait('2');
        $this->VerifyList($I, InitTest::$name500);
    }

        /**
         * @group createa
         */
    public function Name501(AcceptanceTester $I) {
        $I->click(DeliveryPage::$CreateButton);
        $I->waitForText("Создание способа доставки", '10', '.title');
        $this->CreateDelivery($I, InitTest::$name501);
        $I->waitForElementVisible('.alert.in.fade.alert-error');
        $I->waitForText("Поле Название не может превышать 500 символов в длину.",null, '.alert.in.fade.alert-error');
        $I->waitForElementNotVisible('.alert.in.fade.alert-error');
        $I->see("Создание способа доставки", '.title');
        $I->click(DeliveryCreatePage::$ButtonBack);
        $I->wait('5');
    }
    /**
     * @group createa
     */
    public function NameSymbols(AcceptanceTester $I){
        $I->click(DeliveryPage::$CreateButton);
        $I->waitForText("Создание способа доставки", '10', '.title');
        $this->CreateDelivery($I, InitTest::$nameSymbols);
        $I->click(DeliveryCreatePage::$ButtonBack);
        $this->VerifyList($I, InitTest::$nameSymbols);
    }
    //---------------------------CHECKBOX ACTIVE TESTS--------------------------------------------------------------------------------
    /**
     * @group createa
     */
    public function ActiveCheck(AcceptanceTester $I){
        $I->click(DeliveryPage::$CreateButton);
        $I->waitForText("Создание способа доставки", '10', '.title');
        $name = "Доставка актив";
        $this->CreateDelivery($I, $name, 'on');
        $this->VerifyList($I, $name,'on');
    }
    /**
     * @group createa
     */
    public function ActiveUnCheck(AcceptanceTester $I) {
        $I->click(DeliveryPage::$CreateButton);
        $I->waitForText("Создание способа доставки", '10', '.title');
        $name = "Доставка неактив";
        $this->CreateDelivery($I, $name, 'off');
        $this->VerifyList($I, $name,'off');
    }
    /**
     * @group createa
     */
    public function Description(AcceptanceTester $I) {
        $I->click(DeliveryPage::$CreateButton);
        $I->waitForText("Создание способа доставки", '10', '.title');
        $name = "Доставка Описание";
        $description = 
        $descriptionprice = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyzАБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЬЫЪЭЮЯЇЄІабвгдеёжзийклмнопрстуфхцчшщьыъэюяїєі,<.>?\/|~`!@#$%^&*(){}[]\'";:';
        $this->CreateDelivery($I, $name, 'on', $description, $descriptionprice);
        
    }
    /**
     * @group create
     */
    public function Verify(AcceptanceTester $I) {
        $this->VerifyFront($I);
 
    }




//-------------------------------------------------PROTECTED FUNCTIONS---------------------------------------------------------------------------------------------------------------------
    /**
     * function create Delivery with specified parrameters
     * if you wont to skip some field type off
     * if you want to select several Payment methods type "method1_method2_met hod3"
     */
    protected function CreateDelivery(AcceptanceTester $I, $name = "off", $active = "on", $description = "off", $descriptionprice = "off", $price = "off", $freefrom = "off", $message = "off", $pay = "off") {
        switch ($name) {
            case 'off':
                break;
            default :
                $I->fillField(DeliveryCreatePage::$FieldName, $name);
                break;
        }
        switch ($active) {
            case 'off':
                break;
            case 'on' :
                $I->checkOption(DeliveryCreatePage::$CheckboxActive);
                //$I->click(DeliveryCreatePage::$CheckboxActive);
                break;
        }
        switch ($description) {
            case 'off':
                break;
            default :
                $I->fillField(DeliveryCreatePage::$FieldDescription, $description);
                break;
        }
        switch ($descriptionprice) {
            case 'off':
                break;
            default :
                $I->fillField(DeliveryCreatePage::$FieldDescriptionPrice, $descriptionprice);
                break;
        }
        switch ($price) {
            case 'off';
                break;
            default :
                $I->fillField(DeliveryCreatePage::$FieldPrice, $price);
                break;
        }
        switch ($freefrom) {
            case 'off':
                break;
            default :
                $I->fillField(DeliveryCreatePage::$FieldFreeFrom, $freefrom);
                break;
        }
        switch ($message) {
            case 'off':
                break;
            default :
                $I->checkOption(DeliveryCreatePage::$CheckboxPriceSpecified);
                $I->fillField(DeliveryCreatePage::$FieldPriceSpecified, $message);
        }
        switch ($pay) {
            case 'off':
                break;
            default :
                //$len = $I->grabClassCount($I, 'focus frame_label no_connection');
                $pay = explode("_", $pay);
                foreach ($pay as $value) {
                    $I->click($value);
                }
                break;
        }
        $I->click(DeliveryCreatePage::$ButtonCreate);
        $I->wait("3");
    }
    protected function VerifyList(AcceptanceTester $I,$name,$active=null){
        $I->amOnPage('/admin/components/run/shop/deliverymethods/index');
        $rows  = $I->grabTagCount($I,"tbody tr");
        $I->comment($rows);
        $present = 0;
        if($rows>0){
            for ($j=1;$j<=$rows;++$j){
                $method = $I->grabTextFrom(DeliveryPage::ListMethodLine($j));
                $I->comment($method);
                if ($method == $name){
                    $present++;
                    break;
                }
            }
        }
        $I->comment("results: \n Method: \t$method Present: $present in row: $j\n");
        $present>0?$I->assertEquals($method,$name):$I->fail("Method wasn't created");
        if($active){
            $attribute = $I->grabAttributeFrom(DeliveryPage::ListActiveButtonLine($j),"class");
            switch ($active){
                case 'on':
                    $I->assertEquals("prod-on_off ", $attribute);
                    break;
                case 'off':
                    $I->assertEquals("prod-on_off disable_tovar", $attribute);
                    break;
            }
        }
    }
    protected function VerifyFront(AcceptanceTester $I) {
        $I->amOnPage("/shop/product/mobilnyi-telefon-fly-e141-tv-dual-sim-black");
        $I->waitForElement('.btnBuy');
        $I->click('.btnBuy');//edit
        $I->waitForElementVisible("//*[@id='popupCart']");
        $I->click(".btn-cart.btn-cart-p.f_r");
        $I->waitForText('Оформление заказа');
        
    }    

}
