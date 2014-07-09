<?php

use \AcceptanceTester;

class DeliveryTesting {
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
     * @group createa
     */
    public function NameEmpty(AcceptanceTester $I) {
        $I->click(DeliveryCreatePage::$ButtonCreate);
        $this->CheckForAlertPresent($I,'required',  DeliveryCreatePage::$FieldName);
    }

    /**
     * @group createa
     */
    public function Name250(AcceptanceTester $I) {
        $name = InitTest::$text250;
        $this->CreateDelivery($I, $name);
        $this->CheckForAlertPresent($I, 'success');
        $this->CheckInList($I, $name);
        $this->CheckInFrontEnd($I, $name);
    }

    /**
     * @group createa
     */
    public function Name500(AcceptanceTester $I) {
        $name = InitTest::$text500;
        $this->CreateDelivery($I, $name);
        $this->CheckForAlertPresent($I, 'success');
        $this->CheckInList($I, $name);
        $this->CheckInFrontEnd($I, $name);
    }
    /**
     * @group createa
     */
    public function Name501(AcceptanceTester $I) {
        $this->CreateDelivery($I, InitTest::$text501);
        $this->CheckForAlertPresent($I, "error");
    }
    /**
     * @group createa
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
     * @group createa
     */
    public function ActiveCheck(AcceptanceTester $I){
        $name = "Доставка актив";
        $this->CreateDelivery($I, $name, 'on');
        $this->CheckInList($I, $name,'on');
        $this->CheckInFrontEnd($I, $name);
    }
    /**
     * @group createa
     */
    public function ActiveUnCheck(AcceptanceTester $I) {
        $name = "Доставка неактив";
        $this->CreateDelivery($I, $name, 'off');
        $this->CheckInList($I, $name,'off');
    }
    //-----------------------FIELD DESCRIPTION TESTS----------------------------
    /**
     * @group createa
     */
    public function Description(AcceptanceTester $I) {
        $name = "Доставка Описание";
        $description = $descriptionprice = InitTest::$textSymbols;
        $this->CreateDelivery($I, $name, 'on', $description, $descriptionprice);
        $this->CheckForAlertPresent($I, 'success');
        $this->CheckInFrontEnd($I,$name,$description);
        
    }
    //-----------------------FIELDS PRICE & FREE FROM TESTS---------------------
    /**
     * @group createa
     */
    public function PriceFreeFromSymb(AcceptanceTester $I) {
        $price = $freefrom = InitTest::$textSymbols;
        $name = 'ДоставкаЦенаСимволи';
        $this->CreateDelivery($I, $name, 'on', 'off', 'off', $price, $freefrom);
        $this->CheckForAlertPresent($I, 'success');
        $this->CheckInList($I, $name, NULL, $price, $freefrom);
        $this->CheckInFrontEnd($I, $name, null, $price, $freefrom);
    }
    /**
     * @group createa
     */
    public function PriceFreeFrom1num(AcceptanceTester $I) {
        $price = $freefrom = '1';
        $name = 'ДоставкаЦена1Цифра';
        $this->CreateDelivery($I, $name, 'on', 'off', 'off', $price, $freefrom);
        $this->CheckForAlertPresent($I, 'success');
        $this->CheckInList($I, $name, NULL, $price, $freefrom);
        $this->CheckInFrontEnd($I, $name, null, $price, $freefrom);
    }
    /**
     * @group createa
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
     * @group createa
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
     * @group createa
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
        else {
            $I->fail("Lields are editable");
        }
    }
    /**
     * @group createa
     */
    public function FieldPriseSpecifiedEmpty(AcceptanceTester $I) {
        $name = "УточнениеЦеныПусто";
        $this->CreateDelivery($I, $name, 'on', 'off', 'off', 'off', 'off', "");
        $this->CheckForAlertPresent($I, 'success');
    }
    /**
     * @group createa
     */
    public function FieldPriseSpecified250(AcceptanceTester $I) {
        $name = 'УточнениеЦены250';
        $message = InitTest::$text250;
        $this->CreateDelivery($I, $name, 'on', 'off', 'off', 'off', 'off', $message);
        $this->CheckForAlertPresent($I, 'success');
        $this->CheckInFrontEnd($I, $name, NULL, NULL, NULL, $message);
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
    protected function CheckInList(AcceptanceTester $I,$name,$active=null,$price=null,$freefrom=null){
        $I->amOnPage('/admin/components/run/shop/deliverymethods/index');
        $rows  = $I->grabTagCount($I,"tbody tr");
        $I->comment($rows);
        $present = FALSE;
        if($rows>0){
            for ($j=1;$j<=$rows;++$j){
                $method = $I->grabTextFrom(DeliveryPage::ListMethodLine($j));
                $I->comment($method);
                if ($method == $name){
                    $present = TRUE;
                    break;
                }
            }
        }
        $I->comment("results: \n Method: \t$method Present: $present in row: $j\n");
        //Error when method isn't present in delivery list page
        $present?$I->assertEquals($method,$name):$I->fail("Method wasn't created");
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
        
        if($price){
            $Cprice = $I->grabTextFrom(DeliveryPage::ListPriceLine($j));
            $price = number_format($price, 5,".","");
            $I->assertEquals(preg_replace('/[^0-9.]*/u', '', $Cprice),$price);
        }
        if($freefrom){
            $Cfreefrom = $I->grabTextFrom(DeliveryPage::ListFreeFromLine($j));
            $freefrom = number_format($freefrom, 5,".","");
            $I->assertEquals(preg_replace('/[^0-9.]*/u', '', $Cfreefrom), $freefrom);
        }
    }
    /*
     * function checking current parameters in frontend 
     * if you want to skip verifying of some parameters type null
     */
    protected function CheckInFrontEnd(AcceptanceTester $I,$name,$description=null,$price=null,$freefrom=null,$message=null) {
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
        $present = false;
        $I->waitForText('Оформление заказа');
        $ClassCount = $I->grabClassCount($I, 'name-count');
        for ($j=1;$j<=$ClassCount;++$j){
            $CName = $I->grabTextFrom("//div[@class='frame-radio']/div[$j]//span[@class='text-el']");
            if ($CName == $name){
                $present = TRUE;
                break;
            }
        }
        //Error when method isn't present in delivery list page
        $present?$I->assertEquals($name, $CName):$I->fail("Delivery method isn't present in front end");
        if ($description){
            $Cdescription = $I->grabAttributeFrom("//div[@class='frame-radio']/div[$j]//span[@class='icon_ask']", 'data-title');
            $I->assertEquals($Cdescription,$description);
        }
        if($price){
            $Cprice = $I->grabTextFrom("//div[@class='frame-radio']/div[$j]/div[@class='help-block']/div[1]");
            //$I->assertEquals(preg_replace('/[^0-9].*/', '',$price), $Cprice);
            $Cprice = preg_replace('/[^0-9.]*/u', '', $Cprice);
            $price  = ceil($price);
            $I->assertEquals($Cprice, $price);
        }
        if($freefrom){
            $Cfreefrom = $I->grabTextFrom("//div[@class='frame-radio']/div[$j]/div[@class='help-block']/div[2]");
            $Cfreefrom = preg_replace('/[^0-9.]*/u', '', $Cfreefrom);
            $freefrom = ceil($freefrom);
            $I->assertEquals($Cfreefrom, $freefrom);
         }
         if($message){
             $Cmessage = $I->grabTextFrom("//div[@class='frame-radio']/div[$j]/div[@class='help-block']");
             $I->comment($Cmessage);
             $I->assertEquals($Cmessage, $message);
         }
    }
    protected function CheckForAlertPresent(AcceptanceTester $I,$type,$field=null) {
        switch ($type){
            case 'error':
                    $I->comment("I want to see that error alert is present");
                    $I->waitForElementVisible('.alert.in.fade.alert-error');
                    $I->waitForText("Поле Название не может превышать 500 символов в длину.",null, '.alert.in.fade.alert-error');
                    $I->waitForElementNotVisible('.alert.in.fade.alert-error');
                    $I->see("Создание способа доставки", '.title');
                    break;
            case 'success':
                    $I->comment("I want to see that success alert is present");
                    $I->waitForElementVisible('.alert.in.fade.alert-success');
                    $I->see('Доставка создана','.alert.in.fade.alert-success');
                    $I->waitForElementNotVisible('.alert.in.fade.alert-success');
                    break;
            //Checking required field (red color(class alert) & message 
            case 'required':
                    $I->comment("I want to see that field is required");
                    $I->waitForElementVisible('//label[@generated="true"]');
                    $I->see('Это поле обязательное.', 'label.alert.alert-error');
                    $I->assertEquals($I->grabAttributeFrom($field, 'class'), "alert alert-error");
                    break;
        }
}
}
