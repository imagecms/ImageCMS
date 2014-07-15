<?php

/**
 * METHODS
 * CreateDelivery
 * CheckInList
 * CheckInFrontEnd
 * CheckForAlertPresent
 * GrabAllCreatedPayments
 * 
 * @todo Improve Create Delivery (default value = null)
 * @todo Make order in AlertPresent method 
 * @todo Add create simple payment methods for testing
 * @todo Add create simple product category and product for testing
 * 
 * @author Cray
 */

class DeliveryTestHelper {
    
    //-----------------------PROTECTED METHODS----------------------------------
    /**
     * Create Delivery with specified parrameters
     * if you wont to skip some field type off
     * if you want to select several Payment methods type "method1_method2_met hod3"
     * @param object            $I                  Controller
     * @param string            $name               Delivery name type off to skip
     * @param sting             $active             Active Checkbox on - enabled| off - disabled
     * @param string            $description        Method description type off to skip
     * @param string            $descriptionprice   Method price description type off to skip
     * @param int|float|string  $price              Delivery price type off to skip
     * @param int|float|string  $freefrom           Delivery free from type off to skip
     * @param string            $message            Delivery sum specified message type off to skip
     * @param string            $pay                Payment methods "_" - delimiter for few methods
     * @return void
     */
    protected function CreateDelivery($I, $name = "off", $active = "on", $description = "off", $descriptionprice = "off", $price = "off", $freefrom = "off", $message = "off", $pay = "off") {
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
                $pay = explode("_", $pay);
                foreach ($pay as $value) {
                    $I->click($value);
                }
                break;
        }
        $I->click(DeliveryCreatePage::$ButtonCreate);
        $I->wait("3");
    }

    /**
     * Checking current parameters in Delivery List page 
     * if you want to skip verifying of some parameters type null
     * @param object            $I          Controller
     * @param sring             $name       Delivery name
     * @param string            $active     Active checkbox on - enabled |off - disabled 
     * @param int|string|float  $price      Delivery price
     * @param int|string|float  $freefrom   Delivery free from
     * @return void
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
    
    /**
     * Checking current parameters in frontend 
     * if you want to skip verifying of some parameters type null
     * @param object            $I              Controller
     * @param string            $name           Delivery name
     * @param string            $description    Description
     * @param float|int|string  $price          Delivery price
     * @param float|int|string  $freefrom       Delivery free from
     * @param string            $message        Delivery sum specified message
     * @param string|array      $pay            Delivery Payment methods, which will included, if passed string : "_" - delimiter for few methods 
     * @return void
     */
    protected function CheckInFrontEnd(AcceptanceTester $I,$name,$description=null,$price=null,$freefrom=null,$message=null,$pay=null) {
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
        else { $I->amOnPage("/shop/cart"); }
        
        $WasCalled = TRUE;
        $present = FALSE;
        $I->waitForText('Оформление заказа');
        $ClassCount = $I->grabClassCount($I, 'name-count');
        
        for ($j=1;$j<=$ClassCount;++$j){
            $CName = $I->grabTextFrom("//div[@class='frame-radio']/div[$j]//span[@class='text-el']");
            
            if ($CName == $name){
                $present = TRUE;
                break;
            }
        }
        
        //Error when method isn't present in front end
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
         
         if($pay){
            $I->click("//div[@class='frame-radio']/div[$j]//span[@class='text-el']");
            $script1 = "$('body').animate({'scrollTop':$('body').height()},'slow')";
            $script2 = "$('html').animate({'scrollTop':$('body').height()},'slow')";
            $I->executeJS($script1);
            $I->executeJS($script2);
            
            if ($pay == 'off'){
                $I->waitForText('Нет способов оплаты', NULL, '//div[@class="frame-form-field"]/div[@class="help-block"]');
                $I->see('Нет способов оплаты', '//div[@class="frame-form-field"]/div[@class="help-block"]');
            }
            
            else {
                $I->waitForElementVisible("#cuselFrame-paymentMethod");
                $I->click(".cuselText");
                is_string($pay)?$pay = explode("_", $pay):print "";
                $j=1;
                foreach ($pay as $value) {
                    $Cpay = $I->grabTextFrom("//div[@id='cusel-scroll-paymentMethod']/span[$j]");
                    $I->assertEquals($Cpay, $value);
                    $j++;
                    }
            }
         }
    }
    
    /**
     * Checking that alerts is present after clicking create button
     * @param object        $I Controller 
     * @param string        $errorMessaege      Message which you want to check in current element error|succes|required
     * @param CssXpathRegEx $field              selector of field which you want to check
     * @param string        $module             create|edit
     * @return void
     */
    protected function CheckForAlertPresent(AcceptanceTester $I,$type,$errorMessage = null,$field=null,$module = 'create') {
        switch ($type){
            case 'error':
                    $I->comment("I want to see that error alert is present");
                    $I->waitForElementVisible('.alert.in.fade.alert-error');
                    $errorMessage?$I->see($errorMessage, '.alert.in.fade.alert-error'):$I->seeElement('.alert.in.fade.alert-error');
                    $I->waitForElementNotVisible('.alert.in.fade.alert-error');
                    ///edit or create
                    //$I->see("Создание способа доставки", '.title');
                    break;
            case 'success':
                    $I->comment("I want to see that success alert is present");
                    $I->waitForElementVisible('.alert.in.fade.alert-success');
                    if      ($module == 'create')   { $I->see('Доставка создана','.alert.in.fade.alert-success'); }
                    elseif  ($module == 'edit')     { $I->see('Изменения сохранены','.alert.in.fade.alert-success'); }
                    $I->waitForElementNotVisible('.alert.in.fade.alert-success');
                    break;
            //Checking required field (red color(class alert) & message 
            case 'required':
                    $I->comment("I want to see that field is required");
                    $I->waitForElementVisible('//label[@generated="true"]');
                    $I->see('Это поле обязательное.', 'label.alert.alert-error');
                    if      ($module=='create') { $I->assertEquals($I->grabAttributeFrom($field, 'class'), "alert alert-error");}
                    elseif  ($module=='edit')   { $I->assertEquals($I->grabAttributeFrom($field, 'class'), "required alert alert-error");}
                    break;
                default :
                    $I->fail("unknown type of error entered");
        }
    }
    
    /**
     * Grab all payments from payment methods list page and record them to array $PaymentMethods
     * @param   AcceptanceTester    $I
     * @return  array               $PaymentMethods
     */
    protected function GrabAllCreatedPayments(AcceptanceTester $I) {
        $I->amOnPage(PaymentPage::$URL);
        $I->waitForText("Список способов оплаты", NULL, ".title");
        /**
         * @var int $rows Count of table rows
         * @var int $row Current row in table 
         */
        $rows = $I->grabClassCount($I, 'niceCheck')-1;
        if ($rows > 0){//was !=0
            $I->comment("I want to read and remember all created payment methods");
            for ($row = 1;$row<=$rows;++$row) { $PaymentMethods[$row] = $I->grabTextFrom (PaymentPage::ListMethodLine($row)); }
        }
        else { $I->fail( "there are no created payments" ); }
        return $PaymentMethods;
    }
    
}
