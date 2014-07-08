<?php

use \AcceptanceTester;

class DeliveryTesting {
    public function _after(AcceptanceTester $I) {
        $I->amOnPage("/admin/components/run/shop/deliverymethods/index");
        $I->click(DeliveryPage::$CreateButton);
        $I->waitForText("Создание способа доставки", NULL, '.title');
    }
    /**
     * @group create
     */
    public function Authorization(AcceptanceTester $I) {
        InitTest::Login($I);
        $I->amOnPage("/admin/components/run/shop/deliverymethods/index");
        $I->waitForText("Список способов доставки", "1", ".title");
    }
//-----------------------FIELD NAME TESTS---------------------------------------
    /**
     * @group createa
     */
    public function NameEmpty(AcceptanceTester $I) {
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
        $name = InitTest::$text250;
        $this->CreateDelivery($I, $name);
        $I->waitForElementVisible(".alert.in.fade.alert-success");
        $I->waitForElementNotVisible(".alert.in.fade.alert-success");
        $I->click(DeliveryCreatePage::$ButtonBack);
        $I->wait('2');
        $this->VerifyList($I, $name);
        $this->VerifyFront($I, $name);
    }

    /**
     * @group createa
     */
    public function Name500(AcceptanceTester $I) {
        $name = InitTest::$text500;
        $this->CreateDelivery($I, $name);
        $I->waitForElementVisible(".alert.in.fade.alert-success");
        $I->waitForElementNotVisible(".alert.in.fade.alert-success");
        $I->click(DeliveryCreatePage::$ButtonBack);
        $I->wait('2');
        $this->VerifyList($I, $name);
        $this->VerifyFront($I, $name);
    }

        /**
         * @group createa
         */
    public function Name501(AcceptanceTester $I) {
        $this->CreateDelivery($I, InitTest::$text501);
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
        $name = InitTest::$textSymbols;
        $this->CreateDelivery($I, $name);
        $I->click(DeliveryCreatePage::$ButtonBack);
        $this->VerifyList($I, $name);
        $this->VerifyFront($I, $name);
    }
//-----------------------CHECKBOX ACTIVE TESTS----------------------------------
    /**
     * @group createaa
     */
    public function ActiveCheck(AcceptanceTester $I){
        $name = "Доставка актив";
        $this->CreateDelivery($I, $name, 'on');
        $this->VerifyList($I, $name,'on');
        $this->VerifyFront($I, $name);
    }
    /**
     * @group createaa
     */
    public function ActiveUnCheck(AcceptanceTester $I) {
        $name = "Доставка неактив";
        $this->CreateDelivery($I, $name, 'off');
        $this->VerifyList($I, $name,'off');
    }
//-----------------------FIELD DESCRIPTION TESTS--------------------------------
    /**
     * @group createa
     */
    public function Description(AcceptanceTester $I) {
        $name = "Доставка Описание";
        $description = 
        $descriptionprice = InitTest::$textSymbols;
        $this->CreateDelivery($I, $name, 'on', $description, $descriptionprice);
        $this->VerifyFront($I,$name,$description);
        
    }
//-----------------------FIELDS PRICE & FREE FROM TESTS-------------------------
    /**
     * @group create
     */
    public function PriceFreeFromSymb(AcceptanceTester $I) {
        $this->VerifyFront($I, "Доставка1");
    }




//-----------------------PROTECTED FUNCTIONS------------------------------------
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
    /*
     * function checking current parameters in Delivery List page 
     * if you want to skip verifying of some parameters type null
     */
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
    /*
     * function checking current parameters in frontend 
     * if you want to skip verifying of some parameters type null
     */
    protected function VerifyFront(AcceptanceTester $I,$name,$description=null) {
        static $WasCalled  = FALSE;
        if(!$WasCalled){
        $I->comment("$WasCalled");
        $I->amOnPage('/shop/product/mobilnyi-telefon-sony-xperia-v-lt25i-black');
        $buy = "//div[@class='frame-prices-buy f-s_0']//form/div[3]";
        $basket = "//div[@class='frame-prices-buy f-s_0']//form/div[2]";
        $Attribute1 = $I->grabAttributeFrom($buy,'class');
        //$Attribute2 = $I->grabAttributeFrom($basket,'class');
        $Attribute1 == 'btn-buy-p btn-buy'?$I->click($buy):$I->click($basket);
        $I->waitForElementVisible("//*[@id='popupCart']");
        $I->click(".btn-cart.btn-cart-p.f_r");
        }  
        else {
        $I->amOnPage("/shop/cart");    
        }
        $WasCalled = TRUE;
        $I->waitForText('Оформление заказа');
        $ClassCount = $I->grabClassCount($I, 'name-count');
        for ($j=1;$j<=$ClassCount;++$j){
            $CName = $I->grabTextFrom("//div[@class='frame-radio']/div[$j]//span[@class='text-el']");
            if ($CName == $name){
                $I->assertEquals($name, $CName);
                break;
            }
        }
        if ($description){
            $Cdescription = $I->grabAttributeFrom("//div[@class='frame-radio']/div[$j]//span[@class='icon_ask']", 'data-title');
            $I->assertEquals($Cdescription,$description);
        }
    }    
//    protected function called(AcceptanceTester $I) {
//        static $wascalled = FALSE;
//        if (!$wascalled){
//        $I->comment("$wascalled");}
//        $wascalled = TRUE;
//    }

}
