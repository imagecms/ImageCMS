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
        $this->PaymentCreate($I, $name, $currency,'off',"описание",'WebMoney');
    }
    
     /**
     * @group example
     */
    public function ExampleCreateAndDeleteMany(AcceptanceTester $I){
        $names = ['name','name2','name3','name4','name5'];
        foreach ($names as $name) {
            $I->amOnPage(PaymentCreatePage::$URL);
            $this->PaymentCreate($I, $name);
//            $this->CheckForAlertPresent($I, 'success');
        }
        $this->DeletePayments($I,$names);
        $this->CheckForAlertPresent($I, 'success');
    }
    //_______________________________________________________________________________EXAMPLE
    
    protected $CreatedMethods   = []; 
    protected static $Logged    = false;
    
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
        $this->PaymentCreate($I, $name);
        $this->CheckForAlertPresent($I, 'required');
    }
    
    /**
     * @group create
     */
    public function NameNoramal(AcceptanceTester $I){
        $name                   = "ОплатаТест";
        $this->CreatedMethods[] = $name;
        
        $this->PaymentCreate($I, $name);
        $this->CheckForAlertPresent($I, 'success');
    }
    
    /**
     * @group create
     */
    public function Name250(AcceptanceTester $I){
        $name                   = InitTest::$text250;
        $this->CreatedMethods[] = $name;
        
        $this->PaymentCreate($I, $name);
        $this->CheckForAlertPresent($I, 'success');
    }
    
    /**
     * @group create
     */
    public function Name251(AcceptanceTester $I){
        $name                   = InitTest::$text251;
        $this->CreatedMethods[] = $name;
        
        $this->PaymentCreate($I, $name);
        $this->CheckForAlertPresent($I, 'error');
    }
    
    /**
     * @group create
     */
    public function NameSymbols(AcceptanceTester $I){
        $name                   = InitTest::$textSymbols;
        $this->CreatedMethods[] = $name;
        
        $this->PaymentCreate($I, $name);
        $this->CheckForAlertPresent($I, 'success');
    }
    
    /**
     * Check thet all created currencies present is select menu
     * 
     * @todo comparison
     * @group current
     */
    public function CurenciesCheck(AcceptanceTester $I) {
        $CreatedCurrencies = $this->CrabAllCreatedCurrencies($I);
        foreach ($CreatedCurrencies as $cur){
            $I->comment("$cur");
        }
        $I->amOnPage(PaymentCreatePage::$URL);
        $OptionsAmount = $I->grabTagCount($I, 'select option', 0);
        $I->comment("$OptionsAmount");
        for($row=1;$row<=$OptionsAmount;++$row){
            $Options[$row] = $I->grabTextFrom(PaymentCreatePage::SelectCurrency($row));
            /**
             * explode a string $Options[$row] by "(" delimiter, 
             * take the first element of array, 
             * trim white spaces, 
             * to get only name of currency
             */
            $Options[$row] = trim(array_shift(explode('(',$Options[$row])));
            $I->comment("$Options[$row]");
        }
//        foreach ($CreatedCurrencies as $Currency) {
//            $I->comment("$Currency");
//        }
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
    protected function PaymentCreate(AcceptanceTester $I,$name,$currency=null,$active=null,$description=null,$paymentsystem=null) {
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
     * Checks that selected  Alert is present in the page
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
     * @todo Complete methods specified below
     */
    protected function CrabAllCreatedCurrencies(AcceptanceTester $I) {
        $Currencies = [];
        $I->amOnPage(CurrenciesPage::$URL);
        $CurrenciesAmount = $I->grabClassCount($I, 'mainCurrency');
        for($row = 1; $row <= $CurrenciesAmount; ++$row){
            $Currencies[] = $I->grabTextFrom(CurrenciesPage::CuccencyNameLine($row));
        }
        return $Currencies;
    }
    
    protected function CheckInListPresent(AcceptanceTester $I) {
        
    }
    protected function CheckInFrontEndPresent(AcceptanceTester $I) {
        
    }
}