<?php

namespace PaymentTester;

/**
 * METHODS
 * 
 * createPayment
 * createCurrency
 * createDelivery
 * editDelivery
 * checkInList
 * checkInFront
 * grabAllCreatedCurrencies
 * deletePayments  
 * deleteCurrencies
 * deleteDelivery
 * checkForAlert
 */
class PaymentSteps extends \PaymentTester {

    /**
     * Create payment method with specified parameters
     * 
     * @param string $name          Fill field "Name"
     * @param string $currency      Select "Currency Name"
     * @param string $active        Set Checkbox "Active" on|off
     * @param string $description   Fill field "Description"
     * @param string $paymentsystem Select "Payment system"
     */
    public function createPayment($name, $currency = null, $active = null, $description = null, $paymentsystem = null) {
        $I = $this;


        if (isset($name)) {
            $I->amOnPage(\PaymentCreatePage::$URL);
            $I->fillField(\PaymentCreatePage::$FieldName, $name);
        }
        if (isset($currency)) {
            
            $I->click(\PaymentCreatePage::$SelectCurrency);
            $I->selectOption(\PaymentCreatePage::$SelectPaymentSystem, $currency);
        }
        if (isset($active)) {
            $Class = $I->grabAttributeFrom('//form/div[1]/div[3]/div[2]/span', 'class');

            switch ($active) {
                case 'on':
                    if ($Class == 'frame_label') {
                        $I->click(\PaymentCreatePage::$CheckboxActive);
                        $I->comment('Checkbox Active on');
                    }
                    break;
                case 'off':
                    if ($Class == 'frame_label active') {
                        $I->click(\PaymentCreatePage::$CheckboxActive);
                        $I->comment('Checkbox Active off');
                    }
                    break;
            }
        }
        if (isset($description)) {
            $I->fillField(\PaymentCreatePage::$FieldDescription, $description);
        }
        if (isset($paymentsystem)) {
            //for chrome
            $I->selectOption(\PaymentCreatePage::$SelectPaymentSystem, $paymentsystem);
            //forfirefox
            $I->click(\PaymentCreatePage::$SelectPaymentSystem);                
            $I->doubleClick("//option[contains(.,\"$paymentsystem\")]");
        }
        $I->click(\PaymentCreatePage::$ButtonCreate);
        $I->wait(3);
    }

    /**
     * Create currency with specified parameters
     * 
     * @param string            $name
     * @param string            $ISO
     * @param string            $symbol
     * @param string            $rate
     */
    public function createCurrency($name = 'Pounds', $ISO = 'GBP', $symbol = '£', $rate = '0.0167') {
        $I = $this;

        $I->amOnPage('/admin/components/run/shop/currencies/create');
        if (isset($name)) {
            $I->fillField('//input[@name="Name"]', $name);
        }
        if (isset($ISO)) {
            $I->fillField('//input[@name="Code"]', $ISO);
        }
        if (isset($symbol)) {
            $I->fillField('//input[@name="Symbol"]', $symbol);
        }
        if (isset($rate)) {
            $I->fillField('//input[@name="Rate"]', $rate);
        }
        $I->click('.btn.btn-small.btn-success.formSubmit');
        $I->wait(3);
    }
    

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
    public function createDelivery($name = null, $active = null, $description = null, $descriptionprice = null, $price = null, $freefrom = null, $message = null, $pay = null) {
        $I = $this;
//        $I->amOnPage(\DeliveryPage::$URL);
//        $I->click(\DeliveryPage::$CreateButton);
//        $I->waitForText("Создание способа доставки");
        $I->amOnPage(\DeliveryCreatePage::$URL);
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
    function editDelivery($name = null, $active = null, $description = null, $descriptionprice = null, $price = null, $freefrom = null, $message = null, $pay = null) {

        $I = $this;

        if (isset($name)) {
            $I->fillField(\DeliveryEditPage::$FieldName, $name);
        }
        if (isset($active)) {
            $Cactive = $I->grabAttributeFrom("//*[@id='deliveryUpdate']/div[2]/div[2]/span", 'class');
            $Cactive == 'frame_label no_connection active' ? $Cactive = TRUE : $Cactive = FALSE;
            if ($active == "on" && !$Cactive) {
                $I->click(\DeliveryEditPage::$CheckboxActive);
            } elseif ($active == "off" && $Cactive) {
                $I->click(\DeliveryEditPage::$CheckboxActive);
            }
        }
        if (isset($description)) {
            $I->fillField(\DeliveryEditPage::$FieldDescription, $description);
        }
        if (isset($descriptionprice)) {
            $I->fillField(\DeliveryEditPage::$FieldDescriptionPrice, $descriptionprice);
        }
        if (isset($price)) {
            $I->grabAttributeFrom(\DeliveryEditPage::$FieldPrice, 'disabled') == 'true' ? $I->click(\DeliveryEditPage::$CheckboxPriceSpecified) : print '';
            $I->fillField(\DeliveryEditPage::$FieldPrice, $price);
        }
        if (isset($freefrom)) {
            $I->grabAttributeFrom(\DeliveryEditPage::$FieldPrice, 'disabled') == 'true' ? $I->click(\DeliveryEditPage::$CheckboxPriceSpecified) : print '';
            $I->fillField(\DeliveryEditPage::$FieldFreeFrom, $freefrom);
        }
        if (isset($message)) {
            $class = $I->grabAttributeFrom(\DeliveryEditPage::$CheckboxPriceSpecified . '/..', 'class');
            $class == 'frame_label no_connection' ? $I->click(\DeliveryEditPage::$CheckboxPriceSpecified) : $I->comment('already marked');
            $I->fillField(\DeliveryEditPage::$FieldPriceSpecified, $message);
        }
        if (isset($pay)) {
            $paymentAmount = $I->grabClassCount($I, 'niceCheck') - 2;
            for ($row = 1; $row <= $paymentAmount; ++$row) {
                $Cclass = $I->grabAttributeFrom(\DeliveryEditPage::PaymentMethodLabel($row), 'class');
                if ($Cclass == 'frame_label no_connection d_b active') {
                    $I->click(\DeliveryEditPage::PaymentMethodCheckbox($row));
                }
            }
            if (is_string($pay) && $pay != 'off') {
                $I->click("//span[contains(.,\"$pay\")]");
            }
            if (is_array($pay)) {
                foreach ($pay as $value) {
                    $I->click("//span[contains(.,\"  $value  \")]");
                }
            }
        }
        $I->click(\DeliveryEditPage::$ButtonSave);
        $I->wait('3');
    }

    /**
     * Check Paymement in list
     * 
     * Checks that passed method present at "payment list" page ,
     * then checks the passed parameters and return his row, 
     * or fail test if something wrong
     * 
     * @param string            $name               Name of Payment method
     * @param string            $CurrencyName       checks currency name if isset
     * @param string            $CurrencySymbol     checks currency symbol if isset
     * @param bool              $active             checks that method: true - active || false unactive if isset
     * @return int              return row of passed payment
     */
    public function checkInList($name, $CurrencyName = null, $CurrencySymbol = null, $active = null) {

        
        $I = $this;
        $I->wait(3);
        isset($name) ? $I->comment("I search method $name in list") : $I->fail("name of payment method must be passed");
        $I->amOnPage(\PaymentListPage::$URL);
        $I->waitForText("Список способов оплаты", NULL, ".title");

        $present = false;
        $rows = $I->grabClassCount($I, 'niceCheck') - 1;

        if ($rows > 0) {
            for ($row = 1; $row <= $rows; ++$row) {
                $PaymentMethod = $I->grabTextFrom(\PaymentListPage::MethodNameLine($row));
                if ($PaymentMethod == $name) {
                    $I->assertEquals($PaymentMethod, $name, "Method $PaymentMethod present in row $row");
                    $present = true;
                    break;
                }
            }
        } else {
            $I->fail("Couldn't find $name, there are no created payments");
        }
        if (!$present) {
            $I->fail("There is no payment $name in list");
        }

        if (isset($CurrencyName)) {
            $grabbedCurrencyName = $I->grabTextFrom(\PaymentListPage::CurrencyNameLine($row));
            $I->assertEquals($grabbedCurrencyName, $CurrencyName);
        }

        if (isset($CurrencySymbol)) {
            $grabbedCurrencySymbol = $I->grabTextFrom(\PaymentListPage::CurrencySymbolLine($row));
            $I->assertEquals($grabbedCurrencySymbol, $CurrencySymbol);
        }

        if (isset($active)) {
            $grabbedActiveClass = $I->grabAttributeFrom(\PaymentListPage::ActiveLine($row), 'class');
            $active ? $I->assertEquals($grabbedActiveClass, 'prod-on_off ') : $I->assertEquals($grabbedActiveClass, 'prod-on_off disable_tovar');
        }
        return $row;
    }

    /**
     * Checking current parameters in frontend 
     * if basket is empty goes to "processing order" page by clicking, else goes to "processing order" page immediately
     * if you want to skip verifying of some parameters type null
     * verify one payment if string or many if array transmitted
     * 
     * @param string            $DeliveryName           Delivery name
     * @param string            $description    Description
     * @param float|int|string  $price          Delivery price
     * @param float|int|string  $freefrom       Delivery free from
     * @param string            $message        Delivery sum specified message
     * @param string|array      $pays           Delivery Payment methods, which will included, if passed string : "_" - delimiter for few methods
     * @param string            $selectpay      Pass to select method, confirm the order and verify payment
     * @return void
     */
    public function checkInFront($DeliveryName, $description = null, $price = null, $freefrom = null, $message = null, $pays = null, $selectpay = null) {


        $I = $this;
$I->wait(1);
        $I->amOnPage('/');
        $I->waitForElement('.menu-header');

        $buy = "//div[@class='frame-prices-buy f-s_0']//form/div[3]";
        $globalbaseket = 'div#tinyBask button';

        $globalbasketclass = $I->grabAttributeFrom($globalbaseket, 'class');

        if (!empty($globalbasketclass)) { 
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
        $DeliveriesInProcessingOrderPageAmount = $I->grabClassCount($I, 'name-count');

        for ($j = 1; $j <= $DeliveriesInProcessingOrderPageAmount; ++$j) {
            $GrabbedName = $I->grabTextFrom("//div[@class='frame-radio']/div[$j]//span[@class='text-el']");

            if ($GrabbedName == $DeliveryName) {
                $present = TRUE;
                break;
            }
        }
        $present ? $I->assertEquals($DeliveryName, $GrabbedName) : $I->fail("Delivery method isn't present in front end");

        if ($description) {
            $GrabbedDescription = $I->grabAttributeFrom("//div[@class='frame-radio']/div[$j]//span[@class='icon_ask']", 'data-title');
            $I->assertEquals($GrabbedDescription, $description, "description is the same as desired");
        }

        if ($price) {
            $GrabbedPrice = $I->grabTextFrom("//div[@class='frame-radio']/div[$j]/div[@class='help-block']/div[1]");
            $GrabbedPrice = preg_replace('/[^0-9.]*/u', '', $GrabbedPrice);
            $price = ceil($price);
            $I->assertEquals($GrabbedPrice, $price, "price is the same as desired");
        }

        if ($freefrom) {
            $Grabbedfreefrom = $I->grabTextFrom("//div[@class='frame-radio']/div[$j]/div[@class='help-block']/div[2]");
            $Grabbedfreefrom = preg_replace('/[^0-9.]*/u', '', $Grabbedfreefrom);
            $freefrom = ceil($freefrom);
            $I->assertEquals($Grabbedfreefrom, $freefrom, "price is the same as desired");
        }

        if ($message) {
            $Cmessage = $I->grabTextFrom("//div[@class='frame-radio']/div[$j]/div[@class='help-block']");
            $I->comment($Cmessage);
            $I->assertEquals($Cmessage, $message, "price specified messege is the same as desired");
        }

        if ($pays) {
            $I->scrollToElement($I, "div[class=\'frame-radio\'] div:nth-child(1) span[class=\'text-el\']"); //scroll for click
            $I->wait(5);
            $I->click("//div[@class='frame-radio']/div[$j]//span[@class='text-el']");
            $I->scrollToElement($I, '.frame-payment.p_r');

            if ($pays == 'off') {
                $I->waitForText('Нет способов оплаты', NULL, '//div[@class="frame-form-field"]/div[@class="help-block"]');
                $I->see('Нет способов оплаты', '//div[@class="frame-form-field"]/div[@class="help-block"]');
            } else {
                $I->waitForElementVisible("#cuselFrame-paymentMethod");
                $I->click(".cuselText");
                foreach ((array) $pays as $key => $pay) {
                    $GrabbedPay = $I->grabTextFrom("//div[@id='cusel-scroll-paymentMethod']/span[$key+1]");
                    $I->assertEquals($GrabbedPay, $pay);
                }
            }
        }
        if (isset($selectpay)) {
            $I->scrollToElement($I, "div[class=\'frame-radio\'] div:nth-child(1) span[class=\'text-el\']"); //scroll for click
            $I->wait(5);
            $I->click("//div[@class='frame-radio']/div[$j]//span[@class='text-el']");
            $I->scrollToElement($I, '.frame-payment.p_r');
            $I->wait(5);
            $I->click("#cuselFrame-paymentMethod");
            //White spaces added to method in "select" 
            //Read text ,trim then verify , if true click
//            $payment_options = "//div[@id='cusel-scroll-paymentMethod']";
            $I->grabTextFrom("$cssOrXPathOrRegex");
            $I->click(" " . $selectpay . " ");
            $I->wait(5);
        }
    }

    /**
     * Grab all currencies
     * 
     * Grab all currencies in currencies list page and add them to array
     * If $settedTodeleteName passed olso delete currencies with this name
     * 
     * @param   AcceptanceTester $I
     * @param   array|string $settedTodeleteName set it, to delete one currency or array of currencies
     * @return  array   all creted currencies
     */
    public function grabAllCreatedCurrencies() {
        $I = $this;

        $Currencies = [];
        $I->amOnPage(\CurrenciesPage::$URL);
        $CurrenciesAmount = $I->grabClassCount($I, 'mainCurrency');
        for ($row = 1; $row <= $CurrenciesAmount; ++$row) {
            $findedCur = $I->grabTextFrom(\CurrenciesPage::CurrencyNameLine($row));
            $Currencies[] = $findedCur;
        }
        return $Currencies;
    }

    /**
     * Delete Payments
     * 
     * Delete all payment methods with names from array, 
     * or all methods with current name if passed string
     * 
     * @param AcceptanceTester $I controller
     * @param array|string $paymethods Names of payment methods witch you want to delete
     */
    public function deletePayments($paymethods) {
        $I = $this;
        $haveSomethingToRemove = false;
        $I->amOnPage(\PaymentListPage::$URL);
        $MethodsAmount = $I->grabClassCount($I, 'niceCheck') - 1;
        for ($row = 1; $row <= $MethodsAmount; ++$row) {
            $MethodName = $I->grabTextFrom(\PaymentListPage::MethodNameLine($row));
            if (is_array($paymethods)) {
                if (in_array($MethodName, $paymethods)) {
                    $I->click(\PaymentListPage::CheckboxLine($row));
                    $haveSomethingToRemove = true;
                }
            } elseif (is_string($paymethods)) {
                if ($paymethods == $MethodName) {
                    $I->click(\PaymentListPage::CheckboxLine($row));
                    $haveSomethingToRemove = true;
                }
            }
        }
        if ($haveSomethingToRemove) {
            $I->click(\PaymentListPage::$ButtonDelete);
            $I->waitForElementVisible(\PaymentListPage::$DeleteWindowQuestion);
            $I->click(\PaymentListPage::$DeleteWindowButtonDelete);
            $I->waitForElementNotVisible(\PaymentListPage::$DeleteWindowQuestion);
        } else {
            $I->comment('nothing to delete');
        }
        return $haveSomethingToRemove;
    }

    /**
     * Delete currencies with passed name
     * 
     * @param array|string $CurrenciName
     */
    public function deleteCurrencies($CurrenciName) {
        $I = $this;
        $I->amOnPage(\CurrenciesPage::$URL);
        $CurrenciesAmount = $I->grabClassCount($I, 'mainCurrency');
        for ($row = 1; $row <= $CurrenciesAmount; ++$row) {
            $findedCur = $I->grabTextFrom(\CurrenciesPage::CurrencyNameLine($row));
            if (is_string($CurrenciName) && $findedCur == $CurrenciName || is_array($CurrenciName) && in_array($findedCur, $CurrenciName)) {
                $I->click("//tr[$row]//td[7]//button");
                $I->waitForElementVisible("div#first .btn.btn-primary");
                $I->wait(1);
                $I->click("div#first .btn.btn-primary");
                $I->waitForElementNotVisible("div#first .btn.btn-primary");
                $I->wait(3);
                $row--;
                $CurrenciesAmount--;
            }
        }
    }

    /**
     * @param array             $Methods    Names of delivery methods which you want to delete         
     */
    public function deleteDelivery($Methods) {
        $I = $this;
        $I->amOnPage(\DeliveryPage::$URL);
        $HaveMethodsToDelete = false;
        $AllMethodsCount = $I->grabClassCount($I, "niceCheck") - 1;
        for ($row = 1; $row <= $AllMethodsCount; ++$row) {
            $CurrentRowMethod = $I->grabTextFrom(\DeliveryPage::ListMethodLine($row));
            if (is_array($Methods)) {
                if (in_array($CurrentRowMethod, $Methods)) {
                    $I->click(\DeliveryPage::ListCheckboxLine($row));
                    $HaveMethodsToDelete = true;
                }
            } else {
                if ($CurrentRowMethod == $Methods) {
                    $I->click(\DeliveryPage::ListCheckboxLine($row));
                    $HaveMethodsToDelete = true;
                }
            }
        }
        if ($HaveMethodsToDelete) {
            $I->click(\DeliveryPage::$DeleteButton);
            $I->waitForText("Удаление способов доставки", NULL, "//*[@id='mainContent']/div/div[1]/div[1]/h3");
            $I->click(\DeliveryPage::$DeleteWindowDelete);
            $I->wait('3');
        }
    }

    /**
     * Checks that selected alert is present in the page
     * 
     * @param AcceptanceTester  $I      controller
     * @param string            $type   success|error|required
     */
    public function checkForAlert($type) {
        $I = $this;
        switch ($type) {
            case 'success':
                $I->waitForElementVisible(\PaymentListPage::$AlertSuccess);
                $I->waitForElementNotVisible(\PaymentListPage::$AlertSuccess);
                break;
            case 'error':
                $I->waitForElementVisible(\PaymentListPage::$AlertError);
                $I->waitForElementNotVisible(\PaymentListPage::$AlertError);
                break;
            case 'required':
                $I->seeElement(\PaymentListPage::$AlertRequiredLabel);
                $I->seeElement(\PaymentListPage::$AlertRequiredField);
                break;
            default :
                $I->fail('passed incorrect variable: "$type" to method');
        }
    }
        /**
     * Create payment method with specified parameters
     * 
     * @param string $name          Fill field "Name"
     * @param string $currency      Select "Currency Name"
     * @param string $active        Set Checkbox "Active" on|off
     * @param string $description   Fill field "Description"
     * @param string $paymentsystem Select "Payment system"
     */
    public function editPayment($name, $currency = null, $active = null, $description = null, $paymentsystem = null) {
        $I = $this;


        if (isset($name)) {
            $I->fillField(\PaymentEditPage::$FieldName, $name);
        }
        if (isset($currency)) {
            
            $I->click(\PaymentEditPage::$SelectCurrency);
            $I->selectOption(\PaymentEditPage::$SelectPaymentSystem, $currency);
        }
        if (isset($active)) {
            $Class = $I->grabAttributeFrom('//form/div[1]/div[3]/div[2]/span', 'class');
            $I->comment($Class);

            switch ($active) {
                case 'on':
                    if ($Class == 'frame_label no_connection') {
                        $I->click(\PaymentEditPage::$CheckboxActive);
                        $I->comment('Checkbox Active on');
                    }
                    break;
                case 'off':
                    if ($Class == 'frame_label no_connection active') {
                        $I->click(\PaymentEditPage::$CheckboxActive);
                        $I->comment('Checkbox Active off');
                    }
                    break;
            }
        }
        if (isset($description)) {
            $I->fillField(\PaymentEditPage::$FieldDescription, $description);
        }
        if (isset($paymentsystem)) {
            //for chrome
            $I->selectOption(\PaymentEditPage::$SelectPaymentSystem, $paymentsystem);
            //forfirefox
            $I->click(\PaymentEditPage::$SelectPaymentSystem);                
            $I->doubleClick("//option[contains(.,\"$paymentsystem\")]");
        }
        $I->click(\PaymentEditPage::$ButtonSave);
        $I->wait(3);
    }

}
