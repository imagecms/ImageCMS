<?php
use \AcceptanceTester;

class PaymentCreateCest
{
    protected $Createdmethods   = []; 
    protected static $logged    = false;
    
    public function _before(AcceptanceTester $I){
        if(self::$logged) $I->amOnPage(PaymentCreatePage::$URL);
    }
    
    /**
     * @group current
     */
    public function Authorization(AcceptanceTester $I) {
        InitTest::Login($I);
        self::$logged=TRUE;
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
        $this->Createdmethods[] = $name;
        
        $this->PaymentCreate($I, $name);
        $this->CheckForAlertPresent($I, 'success');
    }
    
    /**
     * @group create
     */
    public function Name250(AcceptanceTester $I){
        $name                   = InitTest::$text250;
        $this->Createdmethods[] = $name;
        
        $this->PaymentCreate($I, $name);
        $this->CheckForAlertPresent($I, 'success');
    }
    
    /**
     * @group create
     */
    public function Name251(AcceptanceTester $I){
        $name                   = InitTest::$text251;
        $this->Createdmethods[] = $name;
        
        $this->PaymentCreate($I, $name);
        $this->CheckForAlertPresent($I, 'error');
    }
    
    /**
     * @group current
     */
    public function Test(AcceptanceTester $I) {
        $name = 'TEST';
        $currency = 'qwe';
        $I->click(PaymentCreatePage::$CheckboxActive);
        $I->wait(3);
        $this->PaymentCreate($I, $name, $currency,'off',"описание",'WebMoney');
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
     * @todo Complete methods specified below
     */
    protected function DeletePayments(AcceptanceTester $I) {
        
    }
    protected function CreateCurrencies(AcceptanceTester $I) {
        
    }    
    protected function CrabAllCreatedCurrencies(AcceptanceTester $I) {
        
    } 
    protected function CheckInListPresent(AcceptanceTester $I) {
        
    }
    protected function CheckInFrontEndPresent(AcceptanceTester $I) {
        
    }
}