<?php

namespace DeliveryTester;

class DeliverySteps extends \DeliveryTester {

    /**
     * Create Delivery with specified parrameters
     * if you wont to skip some field type null
     * if you want to select several Payment methods pass array
     * 
     * 
     * @param string            $name               Delivery name type null to skip
     * @param sting             $active             Active Checkbox on - enabled| null
     * @param string            $description        Method description type null to skip
     * @param string            $descriptionprice   Method price description type null to skip
     * @param int|float|string  $price              Delivery price type null to skip
     * @param int|float|string  $freefrom           Delivery free from type null to skip
     * @param string            $message            Delivery sum specified message type null to skip
     * @param string            $pay                Payment methods one pay or array of payments
     * @return void
     */
    function createDelivery(
    $name = null, $active = null, $description = null, $descriptionprice = null, $price = null, $freefrom = null, $message = null, $pay = null) {
        $I = $this;
        $I->amOnPage(\DeliveryPage::$URL);
        $I->click(\DeliveryPage::$CreateButton);
        $I->waitForText("Создание способа доставки");
        if (isset($name)) {
            $I->fillField(\DeliveryCreatePage::$FieldName, $name);
        }
        if (isset($active)) {
            $I->checkOption(\DeliveryCreatePage::$CheckboxActive);
        }
        if (isset($description)) {
            $I->fillField(\DeliveryCreatePage::$FieldDescription, $description);
        }
        if (isset($descriptionprice)) {
            $I->fillField(\DeliveryCreatePage::$FieldDescriptionPrice, $descriptionprice);
        }
        if (isset($price)) {
            $I->fillField(\DeliveryCreatePage::$FieldPrice, $price);
        }
        if (isset($freefrom)) {
            $I->fillField(\DeliveryCreatePage::$FieldFreeFrom, $freefrom);
        }
        if (isset($message)) {
            $I->click(\DeliveryCreatePage::$CheckboxPriceSpecified);
            $I->fillField(\DeliveryCreatePage::$FieldPriceSpecified, $message);
        }
        if (isset($pay)) {
            if (is_string($pay)) {
                $I->click($pay);
            }
            if (is_array($pay)) {
                foreach ($pay as $value) {
                    $I->click($value);
                }
            }
        }
        $I->click(\DeliveryCreatePage::$ButtonCreate);
        $I->wait("3");
    }

    /**
     * Delivery searching
     * 
     * Search of delivery method in list and return his row or false if not present
     * @version 1.1
     * @param   type                $methodname name of delivery method which you want to search
     * @return  int|boolean         if Delivery Method is present return method row else return false
     */
    function SearchDeliveryMethod($methodname) {
        $I = $this;
        $rows = $I->grabClassCount($I,'niceCheck') - 1;
        $present = FALSE;

        for ($row = 1; $row <= $rows; ++$row) {
            $CMethod = $I->grabTextFrom(\DeliveryPage::ListMethodLine($row));

            if ($CMethod == $methodname) {
                $present = TRUE;
                break;
            }
        }
        return $present ? $row : $present;
    }

    /**
     * Checking current parameters in frontend 
     * first time goes "processing order" page by clicking, other times goes to "processing order" page immediately
     * if you want to skip verifying of some parameters type null
     * 
     * @version 2.0 beter 
     * 
     * @param string            $DeliveryName           Delivery name
     * @param string            $description            Description
     * @param float|int|string  $price                  Delivery price
     * @param float|int|string  $freefrom               Delivery free from
     * @param string            $message                Delivery sum specified message
     * @param string|array      $pay                    Delivery Payment methods, which will included, if passed string : "_" - delimiter for few methods 
     * @return void
     */
    function CheckInFrontEnd($DeliveryName, $description = null, $price = null, $freefrom = null, $message = null, $pay = null) {
        $I = $this;
        $I->wait(1);
        $I->amOnPage('/');
        $I->waitForElement('.menu-header');

        $buy = "//div[@class='frame-prices-buy f-s_0']//form/div[3]";
        $globalbaseket = 'div#tinyBask button';

        $globalbaseketclass = $I->grabAttributeFrom($globalbaseket, 'class');

        if (!empty($globalbaseketclass)) { 
            $I->comment('My basket is not empty');
            $I->amOnPage("/shop/cart");
        } else {
            $I->amOnPage('/shop/product/mobilnyi-telefon-sony-xperia-v-lt25i-black');
            $I->wait(5);
            $I->click($buy);
            $I->waitForElementVisible("//*[@id='popupCart']",10);
            $I->click(".btn-cart.btn-cart-p.f_r");
        }
        $I->waitForText('Оформление заказа');

        $present = FALSE;
        $ClassCount = $I->grabClassCount($I, 'name-count');

        for ($j = 1; $j <= $ClassCount; ++$j) {
            $CName = $I->grabTextFrom("//div[@class='frame-radio']/div[$j]//span[@class='text-el']");
            $I->comment($CName);
            $I->comment($DeliveryName);
            
            if ($CName == $DeliveryName) {
                $present = TRUE;
                break;
            }
        }

        $present ? $I->assertEquals($DeliveryName, $CName) : $I->fail("Delivery method isn't present in front end");
        if ($description) {
            $Cdescription = $I->grabAttributeFrom("//div[@class='frame-radio']/div[$j]//span[@class='icon_ask']", 'data-title');
            $I->assertEquals($Cdescription, $description);
        }

        if ($price) {
            $Cprice = $I->grabTextFrom("//div[@class='frame-radio']/div[$j]/div[@class='help-block']/div[1]");
            $Cprice = preg_replace('/[^0-9.]*/u', '', $Cprice);
            $price = ceil($price);
            $I->assertEquals($Cprice, $price);
        }

        if ($freefrom) {
            $Cfreefrom = $I->grabTextFrom("//div[@class='frame-radio']/div[$j]/div[@class='help-block']/div[2]");
            $Cfreefrom = preg_replace('/[^0-9.]*/u', '', $Cfreefrom);
            $freefrom = ceil($freefrom);
            $I->assertEquals($Cfreefrom, $freefrom);
        }

        if ($message) {
            $Cmessage = $I->grabTextFrom("//div[@class='frame-radio']/div[$j]/div[@class='help-block']");
            $I->comment($Cmessage);
            $I->assertEquals($Cmessage, $message);
        }

        if ($pay) {
            $JQScrollToclick = "$('html,body').animate({scrollTop:$('div.frame-radio>div:nth-child($j)').offset().top});";
            $I->executeJS($JQScrollToclick);
            $I->wait(5);
            $I->click("//div[@class='frame-radio']/div[$j]//span[@class='text-el']");
            $sc = "$('html,body').animate({scrollTop:$('#submitOrder').offset().top},'fast');";
            $I->executeJS($sc);

            if ($pay == 'off') {
                $I->waitForText('Нет способов оплаты', NULL, '//div[@class="frame-form-field"]/div[@class="help-block"]');
                $I->see('Нет способов оплаты', '//div[@class="frame-form-field"]/div[@class="help-block"]');
            } else {
                $I->waitForElementVisible("#cuselFrame-paymentMethod");
                $I->click(".cuselText");
                is_string($pay) ? $pay = explode("_", $pay) : print "";
                $j = 1;
                foreach ($pay as $value) {
                    $Cpay = $I->grabTextFrom("//div[@id='cusel-scroll-paymentMethod']/span[$j]");
                    $I->assertEquals($Cpay, $value);
                    $j++;
                }
            }
        }
    }

    /**
     * FrontEnd present
     * 
     * Check that delivery method is not present in processing order  page of Front End
     * 
     * @staticvar boolean $WasCalled
     * @param AcceptanceTester $I controller
     * @param type $name Delivery Method name
     */
    function CheckMethodNotPresentInFrontEnd($name) {
$I = $this;
        
        $I->amOnPage('/');

        $buy = "//div[@class='frame-prices-buy f-s_0']//form/div[3]";
        $globalbaseket = 'div#tinyBask button';

        $globalbaseketclass = $I->grabAttributeFrom($globalbaseket, 'class');

        if (!empty($globalbaseketclass)) { 
            $I->comment('My basket is not empty');
            $I->amOnPage("/shop/cart");
        } else {
            $I->amOnPage('/shop/product/mobilnyi-telefon-sony-xperia-v-lt25i-black');
            $I->wait(5);
            $I->click($buy);
            $I->waitForElementVisible("//*[@id='popupCart']",10);
            $I->click(".btn-cart.btn-cart-p.f_r");
        }
        $I->waitForText('Оформление заказа');
        $missing = TRUE;
        /**
         * @var int $ClassCount number of all delivery methods available in processing order  page(front)
         */
        $ClassCount = $I->grabClassCount($I, 'name-count');

        for ($j = 1; $j <= $ClassCount;  ++$j) {
            /**
             * @var string $CNmame name of delivery method in current row 
             */
            $CName = $I->grabTextFrom("//div[@class='frame-radio']/div[$j]//span[@class='text-el']");

            if ($CName == $name) {
                $missing = FALSE;
                break;
            }
        }
        return $missing;
    }
    /**
     * @param array             $Methods    Names of delivery methods which you want to delete         
     */
    function DeleteDeliveryMethods ($Methods) {
        $I = $this;
        $I->amOnPage(\DeliveryPage::$URL);
        $HaveMethodsToDelete = false;
        $AllMethodsCount = $I->grabClassCount($I, "niceCheck")-1;
        for ($row = 1;$row <= $AllMethodsCount;++$row){
            $CurrentRowMethod = $I->grabTextFrom(\DeliveryPage::ListMethodLine($row));
            if(is_array($Methods)){
                if(in_array($CurrentRowMethod, $Methods)){
                        $I->click (\DeliveryPage::ListCheckboxLine ($row));
                        $HaveMethodsToDelete = true;
                }
            }
            else {
                if($CurrentRowMethod == $Methods){
                        $I->click (\DeliveryPage::ListCheckboxLine ($row));
                        $HaveMethodsToDelete = true;
                    }        
            }   
        }
        if($HaveMethodsToDelete){
            $I->click(\DeliveryPage::$DeleteButton);
            $I->waitForText("Удаление способов доставки", NULL, "//*[@id='mainContent']/div/div[1]/div[1]/h3");
            $I->click(\DeliveryPage::$DeleteWindowDelete);
            $I->wait('3');
        }
    }
    
    /**
     * Checking current parameters in Delivery List page 
     * if you want to skip verifying of some parameters type null
     * @param sring             $name       Delivery name
     * @param string            $active     Active checkbox on - enabled |off - disabled 
     * @param int|string|float  $price      Delivery price
     * @param int|string|float  $freefrom   Delivery free from
     * @return void
     */
    function CheckInList($name,$active=null,$price=null,$freefrom=null){
        $I = $this;
        $I->wait(3);
        $I->amOnPage(\DeliveryPage::$URL);
        $I->waitForText('Список способов доставки');
        $rows  = $I->grabTagCount($I,"tbody tr");
        $I->comment($rows);
        $present = FALSE;
        if($rows>0){
            
            for ($j=1;$j<=$rows;++$j){
                $method = $I->grabTextFrom(\DeliveryPage::ListMethodLine($j));
                $I->comment($method);
                
                if ($method == $name){
                    $present = TRUE;
                    break;
                }
            }
        }
        $I->comment("results: \n Method: \n$method Present: $present in row: $j\n");
        //Error when method isn't present in delivery list page
        $present?$I->assertEquals($method,$name):$I->fail("Method wasn't created");
        
        if($active){
            $attribute = $I->grabAttributeFrom(\DeliveryPage::ListActiveButtonLine($j),"class");
            
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
            $Cprice = $I->grabTextFrom(\DeliveryPage::ListPriceLine($j));
            $price = number_format($price, 5,".","");
            $I->assertEquals(preg_replace('/[^0-9.]*/u', '', $Cprice),$price);
        }
        
        if($freefrom){
            $Cfreefrom = $I->grabTextFrom(\DeliveryPage::ListFreeFromLine($j));
            $freefrom = number_format($freefrom, 5,".","");
            $I->assertEquals(preg_replace('/[^0-9.]*/u', '', $Cfreefrom), $freefrom);
        }
    }
    
    
    /**
     * Grab all payments from payment methods list page and record them to array $PaymentMethods
     * @param   AcceptanceTester    $I
     * @return  array               $PaymentMethods
     */
    function GrabAllCreatedPayments() {
        $I = $this;
        $I->amOnPage(\PaymentListPage::$URL);
        $I->waitForText("Список способов оплаты", NULL, ".title");
        /**
         * @var int $rows Count of table rows
         * @var int $row Current row in table 
         */
        $rows = $I->grabClassCount($I, 'niceCheck')-1;
        if ($rows > 0){//was !=0
            $I->comment("I want to read and remember all created payment methods");
            for ($row = 1;$row<=$rows;++$row) { $PaymentMethods[$row] = $I->grabTextFrom (\PaymentListPage::MethodNameLine($row)); }
        }
        else { $I->fail( "there are no created payments" ); }
        return $PaymentMethods;
    }
    
    /**
     * Edit Delivery 
     * 
     * Edit delivery method by specifying parameters, 
     * must be on delivery edit page before calling
     * 
     * @param string    $name               Deliveryname
     * @param string    $active             off - disabled | on - enabled
     * @param string    $description        Delivery description
     * @param string    $descriptionprice   Delivery price description
     * @param string    $price              Delivery price
     * @param string    $freefrom           Delivery freefrom
     * @param string    $message            Delivery sum specified message
     * @param array     $pay                Select payment methods, array or string for one
     * @param array     $payoff             Unselect payment methods, array or sring for one
     */
    function EditDelivery($name = null, 
            $active = null, 
            $description = null,
            $descriptionprice = null, 
            $price = null, 
            $freefrom = null, 
            $message = null, 
            $pay = null){
        
        $I = $this;
        
        if(isset($name)) { 
            $I->fillField(\DeliveryEditPage::$FieldName, $name); }
        if(isset($active)) {
            $Cactive = $I->grabAttributeFrom("//*[@id='deliveryUpdate']/div[2]/div[2]/span", 'class');
            $Cactive == 'frame_label no_connection active'?$Cactive = TRUE:$Cactive = FALSE;
            if      ($active == "on" && !$Cactive)   { 
                $I->click(\DeliveryEditPage::$CheckboxActive); 
                
            }
            elseif  ($active == "off" && $Cactive)   {
                $I->click(\DeliveryEditPage::$CheckboxActive); 
                
            }
        }
        if(isset($description)) { 
            $I->fillField(\DeliveryEditPage::$FieldDescription, $description); 
        }
        if(isset($descriptionprice)) { 
            $I->fillField(\DeliveryEditPage::$FieldDescriptionPrice, $descriptionprice); 
            
        }
        if(isset($price)) { 
            $I->grabAttributeFrom(\DeliveryEditPage::$FieldPrice, 'disabled')== 'true'?$I->click(\DeliveryEditPage::$CheckboxPriceSpecified):  print '';
            $I->fillField(\DeliveryEditPage::$FieldPrice,$price);
        }
        if(isset($freefrom)) { 
            $I->grabAttributeFrom(\DeliveryEditPage::$FieldPrice, 'disabled')== 'true'?$I->click(\DeliveryEditPage::$CheckboxPriceSpecified):  print '';
            $I->fillField(\DeliveryEditPage::$FieldFreeFrom, $freefrom);
        }
        if(isset($message)) { 
            $class = $I->grabAttributeFrom(\DeliveryEditPage::$CheckboxPriceSpecified.'/..', 'class');
            $class == 'frame_label no_connection'?$I->click(\DeliveryEditPage::$CheckboxPriceSpecified):$I->comment('already marked');
            $I->fillField(\DeliveryEditPage::$FieldPriceSpecified, $message);
        }
        if(isset($pay)) {
            $paymentAmount = $I->grabClassCount($I, 'niceCheck')-2;
            for($row = 1 ; $row <=$paymentAmount; ++$row){
                $Cclass = $I->grabAttributeFrom(\DeliveryEditPage::PaymentMethodLabel($row), 'class');
                if($Cclass == 'frame_label no_connection d_b active'){
                        $I->click(\DeliveryEditPage::PaymentMethodCheckbox($row));
                    }
            }
            if(is_string($pay) && $pay != 'off'){
                $I->click("//span[contains(.,\"$pay\")]");
            }
            if (is_array($pay))  {
                foreach ($pay as $value) {
                        $I->click("//span[contains(.,\"  $value  \")]");
                    }
                }
            }
        $I->click(\DeliveryEditPage::$ButtonSave);
        $I->wait('3');
    }
    
    
    
    
    
    
    /**
     * Checking that alerts is present after clicking create button
     * 
     * @param string    $type       error|success|required
     * @param string    $text      create|edit|delete|drag|namemax
     * @return void
     */
    function CheckForAlertPresent($type = null,$text = null) {
        $I = $this;
        switch ($type){
            case 'error':
                    $I->waitForText('Ошибка:', null, '.alert.in.fade.alert-error h4');
                    if ($text  == 'namemax') { $I->see('Поле Название не может превышать 500 символов в длину.', '.alert.in.fade.alert-error'); }
                    $I->waitForElementNotVisible('.alert.in.fade.alert-error');
                    break;
            case 'success':
                    
//                    $I->waitForText('Сообщение:', null, "//div[@class='alert in fade alert-success']//h4");
                    if      ($text  == 'create')   { $I->waitForText('Доставка создана',            null, "//div[@class='alert in fade alert-success']"); }              
                    elseif  ($text  == 'edit')     { $I->waitForText('Изменения сохранены',         null, "//div[@class='alert in fade alert-success']"); }
                    elseif  ($text  == 'delete')   { $I->waitForText('Способ доставки удален',      null, "//div[@class='alert in fade alert-success']"); }
                    elseif  ($text  == 'drag')     { $I->WaitForText('Позиции сохранены',           null, "//div[@class='alert in fade alert-success']"); }
                    $I->waitForElementNotVisible("//div[@class='alert in fade alert-success']");


                    break;
            case 'required':
                    $I->comment("I want to see that field is required");
                    $I->waitForText('Это поле обязательное.', NULL, '//label[@generated="true"]');

                    if      ($text =='create') { $I->assertEquals($I->grabAttributeFrom(\DeliveryCreatePage::$FieldName, 'class'), "alert alert-error"); }
                    elseif  ($text =='edit')   { $I->assertEquals($I->grabAttributeFrom(\DeliveryEditPage::$FieldName, 'class'), "required alert alert-error"); }
                    break;
                default :
                    $I->fail("unknown type of error entered");
        }
    }

}