<?php
use \AcceptanceTester;

class PaymentCreateCest
{
    //_______________________________________________________________________________EXAMPLE
       
    /**
     * @group example
     */
    public function EXAMPLECreateFull(AcceptanceTester $I) {
        $name = 'TEST';
        $currency = 'qwe';
        $I->click(PaymentCreatePage::$CheckboxActive);
        $I->wait(3);
        $this->CreatePayment($I, $name, $currency,'off',"описание",'WebMoney');
    }
    
     /**
     * @group example
     */
    public function ExampleCreateAndDeleteMany(AcceptanceTester $I){
        $names = ['name','name2','name3','name4','name5'];
        foreach ($names as $name) {
            $I->amOnPage(PaymentCreatePage::$URL);
            $this->CreatePayment($I, $name);
//            $this->CheckForAlertPresent($I, 'success');
        }
        $this->DeletePayments($I,$names);
        $this->CheckForAlertPresent($I, 'success');
    }
    //_______________________________________________________________________________EXAMPLE
    
    protected $CreatedMethods       = []; 
    protected $CreatedCurrencies    = [];
    protected static $Logged        = false;
    
    public function _before(AcceptanceTester $I){
        if(self::$Logged) $I->amOnPage(PaymentCreatePage::$URL);
    }
    
    /**
     * @group current
     */
    public function Authorization(AcceptanceTester $I) {
        InitTest::Login($I);
        self::$Logged=TRUE;
    }

    /**
     * @group create
     */
    public function NameEmpty(AcceptanceTester $I){
        $name = "";
        $this->CreatePayment($I, $name);
        $this->CheckForAlertPresent($I, 'required');
    }
    
    /**
     * @group create
     */
    public function NameNoramal(AcceptanceTester $I){
        $name                   = "ОплатаТест";
        $this->CreatedMethods[] = $name;
        
        $this->CreatePayment($I, $name);
        $this->CheckForAlertPresent($I, 'success');
    }
    
    /**
     * @group create
     */
    public function Name250(AcceptanceTester $I){
        $name                   = InitTest::$text250;
        $this->CreatedMethods[] = $name;
        
        $this->CreatePayment($I, $name);
        $this->CheckForAlertPresent($I, 'success');
    }
    
    /**
     * @group create
     */
    public function Name251(AcceptanceTester $I){
        $name                   = InitTest::$text251;
        $this->CreatedMethods[] = $name;
        
        $this->CreatePayment($I, $name);
        $this->CheckForAlertPresent($I, 'error');
    }
    
    /**
     * @group create
     */
    public function NameSymbols(AcceptanceTester $I){
        $name                   = InitTest::$textSymbols;
        $this->CreatedMethods[] = $name;
        
        $this->CreatePayment($I, $name);
        $this->CheckForAlertPresent($I, 'success');
    }
    
    /**
     * Check that all created currencies present is select menu
     * 
     * @group create
     */
    public function CurrenciesCheck(AcceptanceTester $I) {
        $CreatedCurrencies = $this->GrabAllCreatedCurrenciesOrDelete($I);
        
        //add options of <select> at create page to array $Options[]
        $I->amOnPage(PaymentCreatePage::$URL);
        $OptionsAmount = $I->grabTagCount($I, 'select option', 0);
        $I->comment("$OptionsAmount");
        for($row=0;$row<$OptionsAmount;++$row){
            $Options[$row] = $I->grabTextFrom(PaymentCreatePage::SelectCurrency($row+1));
            $Options[$row] = trim(array_shift(explode('(',$Options[$row])));//to get only name of currency
        }
        foreach ($CreatedCurrencies as $key=>$Currecy){
            $I->assertEquals($Currecy, $Options[$key]);
        }
    }
    
        /**
         * Checks that,created method uses selected currency 
         * 
         * @group create
         */
        public function CurrencySelection(AcceptanceTester $I){
            $PaymentName                = 'ОплатаВалюта';
            $this->CreatedMethods []    = $PaymentName;
            $CurrencyName               = 'Pounds';
            $this->CreatedCurrencies [] = $CurrencyName; 
            
            $this->CreateCurrency($I, $CurrencyName);
            
            $I->amOnPage(PaymentCreatePage::$URL);
            $this->CreatePayment($I, $PaymentName, $CurrencyName);
            
            $this->CheckInList($I, $PaymentName, $CurrencyName);
        }
        
        
        
        
        
        
        
        
        
        
        
        
        /**
         * @group current 
         */
        public function DeleteAllCreatedPaymentsAndCurrencies(AcceptanceTester $I) {
            $this->DeletePayments($I, $this->CreatedMethods);
            $this->GrabAllCreatedCurrenciesOrDelete($I, $this->CreatedCurrencies);
            
        }

    

    
    
    
    
    
    
    
    
    
    
    
    
    //-----------------------PROTECTED METHODS----------------------------------
    /**
     * Create payment method with specified parameters
     * 
     * @param AcceptanceTester $I   Controller
     * @param string $name          Fill field "Name"
     * @param string $currency      Select "Currency Name"
     * @param string $active        Set Checkbox "Active" on|off
     * @param string $description   Fill field "Description"
     * @param string $paymentsystem Select "Payment system"
     */
    protected function CreatePayment(AcceptanceTester $I,$name,$currency=null,$active=null,$description=null,$paymentsystem=null) {
        if(isset($name)){
            $I->fillField(PaymentCreatePage::$FieldName, $name);
        }
        if(isset($currency)){
            $I->selectOption(PaymentCreatePage::$SelectPaymentSystem, $currency);
        }
        if(isset($active)){
            $Class = $I->grabAttributeFrom('//form/div[1]/div[3]/div[2]/span', 'class');
            
            switch ($active){
                case 'on':
                    if($Class == 'frame_label') { 
                        $I->click(PaymentCreatePage::$CheckboxActive);
                        $I->comment('Checkbox Active on');
                    }
                    break;
                case 'off':
                    if($Class == 'frame_label active') {
                        $I->click(PaymentCreatePage::$CheckboxActive);
                        $I->comment('Checkbox Active off');
                    }
                    break;
            }
        }
        if(isset($description)){
            $I->fillField(PaymentCreatePage::$FieldDescription, $description);
        }
        if(isset($paymentsystem)){
            $I->selectOption(PaymentCreatePage::$SelectPaymentSystem, $paymentsystem);
        }
        $I->click(PaymentCreatePage::$ButtonCreate);
    }
    
    /**
     * Create currency with specified parameters
     * 
     * @param AcceptanceTester  $I
     * @param string            $name
     * @param string            $ISO
     * @param string            $symbol
     * @param string            $rate
     */
    protected function CreateCurrency(AcceptanceTester $I,$name='Pounds',$ISO='GBP',$symbol='£',$rate='0.0167'){
        $I->amOnPage('/admin/components/run/shop/currencies/create');
            if(isset($name)){
               $I->fillField('//input[@name="Name"]', $name);
            }
            if(isset($ISO)){
               $I->fillField('//input[@name="Code"]', $ISO);
            }
            if(isset($symbol)){
               $I->fillField('//input[@name="Symbol"]', $symbol);
            }
            if(isset($rate)){
               $I->fillField('//input[@name="Rate"]', $rate);
            }
            $I->click('.btn.btn-small.btn-success.formSubmit');
            $this->CheckForAlertPresent($I, 'success');
    }    
    
    /**
     * Checks that selected alert is present in the page
     * 
     * @param AcceptanceTester  $I      controller
     * @param string            $type   success|error|required
     */
    protected function CheckForAlertPresent(AcceptanceTester $I,$type) {
        switch ($type){
            case 'success':
                $I->waitForElementVisible(PaymentListPage::$AlertSuccess);
                $I->waitForElementNotVisible(PaymentListPage::$AlertSuccess);
                break;
            case 'error':
                $I->waitForElementVisible(PaymentListPage::$AlertError);
                $I->waitForElementNotVisible(PaymentListPage::$AlertError);
                break;
            case 'required':
                $I->seeElement(PaymentListPage::$AlertRequiredLabel);
                $I->seeElement(PaymentListPage::$AlertRequiredField);
                break;
            default :
                $I->fail('passed incorrect variable: "$type" to method');
        }
    }
 
    /**
     * Check Paymement
     * 
     * Checks that passed method present at "payment list" page ,
     * then checks the passed parameters and return his row, 
     * or fail test if something wrong
     * 
     * @param AcceptanceTester  $I                  controller
     * @param string            $name               Name of Payment method
     * @param string            $CurrencyName       checks currency name if isset
     * @param string            $CurrencySymbol     checks currency symbol if isset
     * @param bool              $active             checks that method: true - active || false unactive if isset
     * @return int              return row of passed payment
     */
    protected function CheckInList(AcceptanceTester $I, $name, $CurrencyName = null, $CurrencySymbol = null, $active = null) {
        isset($name)?$I->comment("I search method $name in list"):$I->fail("name of payment method must be passed");
        $I->amOnPage(PaymentListPage::$URL);
        $I->waitForText("Список способов оплаты", NULL, ".title");
        
        $present    = false;
        $rows       = $I->grabClassCount($I, 'niceCheck')-1;
        
        if ($rows > 0){
            for ($row = 1;$row<=$rows;++$row) { 
                $PaymentMethod = $I->grabTextFrom (PaymentListPage::MethodNameLine($row));
                if ($PaymentMethod == $name){
                    $I->assertEquals($PaymentMethod, $name,"Method $PaymentMethod present in row $row");
                    $present = true;
                    break;
                }
            }
        } else { $I->fail( "Couldn't find $name, there are no created payments" ); }
        if(!$present) { $I->fail("There is no payment $name in list"); }
        
        if(isset($CurrencyName)){
            $grabbedCurrencyName = $I->grabTextFrom(PaymentListPage::CurrencyNameLine($row));
            $I->assertEquals($grabbedCurrencyName, $CurrencyName);
        }
        
        if(isset($CurrencySymbol)){
            $grabbedCurrencySymbol = $I->grabTextFrom(PaymentListPage::CurrencySymbolLine($row));
            $I->assertEquals($grabbedCurrencySymbol, $CurrencySymbol);
            
        }
        
        if(isset($active)){
            $grabbedActiveClass = $I->grabAttributeFrom(PaymentListPage::ActiveLine($row), 'class');
            $active?$I->assertEquals($grabbedActiveClass, 'prod-on_off '):$I->assertEquals($grabbedActiveClass, 'prod-on_off disable_tovar');
        }
        return $row;

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
    protected function DeletePayments(AcceptanceTester $I,$paymethods) {
        $I->amOnPage(PaymentListPage::$URL);
        $MethodsAmount = $I->grabClassCount($I, 'niceCheck')-1;
        for($row=1;$row<=$MethodsAmount;++$row){
            $MethodName = $I->grabTextFrom(PaymentListPage::MethodNameLine($row));
            if(is_array($paymethods)){
                foreach ($paymethods as $paymethod){
                    if($paymethod == $MethodName){ 
                        $I->click(PaymentListPage::CheckboxLine($row));
                    }
                }
            }elseif(is_string($paymethods)){
                if($paymethods == $MethodName){ $I->click(PaymentListPage::CheckboxLine($row)); }
            }
        }
        $I->click(PaymentListPage::$ButtonDelete);
        $I->waitForElementVisible(PaymentListPage::$DeleteWindowQuestion);
        $I->click(PaymentListPage::$DeleteWindowButtonDelete);
        $I->waitForElementNotVisible(PaymentListPage::$DeleteWindowQuestion);
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
    protected function GrabAllCreatedCurrenciesOrDelete(AcceptanceTester $I,$settedTodeleteName=null) {
        $Currencies = [];
        $I->amOnPage(CurrenciesPage::$URL);
        $CurrenciesAmount = $I->grabClassCount($I, 'mainCurrency');
        for($row = 1; $row <= $CurrenciesAmount; ++$row){
            $findedCur = $I->grabTextFrom(CurrenciesPage::CuccencyNameLine($row));
            if(is_string($settedTodeleteName) && $findedCur == $settedTodeleteName 
                    || is_array($settedTodeleteName) && in_array($findedCur, $settedTodeleteName)){
                $I->click("//tr[$row]//td[7]//button");
                $I->waitForElementVisible("div#first .btn.btn-primary");
                $I->wait(1);
                $I->click("div#first .btn.btn-primary");
                $I->waitForElementNotVisible("div#first .btn.btn-primary");
                $I->wait(3);
                $row--;
                $CurrenciesAmount--;
            }else{
                $Currencies[] = $findedCur;
                
            }
        }
        return $Currencies;
    }
    
    
    /**
     * @todo Complete methods specified below
     */    
    protected function CheckInFrontEndPresent(AcceptanceTester $I) {
        
    }

}