<?php
use \AcceptanceTester;

class PaymentCreateCest
{
    static $logged = false;
    public function _before(AcceptanceTester $I){
        if(self::$logged) $I->amOnPage(PaymentCreatePage::$URL);
//        if(self::$logged) $I->amOnPage('/admin/components/run/shop/paymentmethods/create');
    }
    
    /**
     * @group current
     */
    public function Authorization(AcceptanceTester $I) {
        InitTest::Login($I);
        self::$logged=TRUE;
    }

    /**
     * @group current
     */
    public function test(AcceptanceTester $I){
        $I->wait(2);
        
        $I->click(PaymentCreatePage::$ButtonCreate);
//        $I->waitForElementVisible(PaymentAlertsPage::$AlertRequiredLabel);
//        $I->seeElement(PaymentAlertsPage::$AlertRequiredField);
    }
    
    //-----------------------PROTECTED METHODS----------------------------------
    
    protected function PaymentCreate(AcceptanceTester $I,$name,$currency=null,$active=null,$description=null,$paymentsystem=null) {
        if(isset($name)){
            
        }
        
        if(isset($currency)){
            
        }
        
        if(isset($active)){
            
        }
        
        if(isset($description)){
            
        }
        
        if(isset($paymentsystem)){
            
        }
        $I->click(PaymentCreatePage::$ButtonCreate);
    }
    
    protected function CheckForAlertPresent(AcceptanceTester $I,$type) {
        switch ($type){
            case 'success':
                $I->waitForElementVisible(PaymentAlertsPage::$AlertSuccess);
                $I->waitForElementNotVisible(PaymentAlertsPage::$AlertSuccess);
                break;
            case 'error':
                $I->waitForElementVisible(PaymentAlertsPage::$AlertError);
                $I->waitForElementNotVisible(PaymentAlertsPage::$AlertError);
                break;
            case 'required':
                $I->waitForElementVisible(PaymentAlertsPage::$AlertRequiredLabel);
                $I->seeElement(PaymentAlertsPage::$AlertRequiredField);
                break;
        }
    }
}