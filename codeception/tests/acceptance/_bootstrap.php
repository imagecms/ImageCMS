<?php
// Here you can initialize variables that will be available to your tests
\Codeception\Util\Autoload::registerSuffix('Page', __DIR__.DIRECTORY_SEPARATOR.'_pages');
class InitTest{
    public static function Login($I) {
        $userName = 'ad@min.com';
        $password = 'admin';
        $I->wantTo('log in as admin');
        $I->amOnPage('/admin/login');
        $I->fillField('login', $userName);
        $I->fillField('password', $password);
        $I->click('.btn.btn-info');
        $I->seeInCurrentUrl('/components/run/shop/dashboard');
        $I->seeElement("nav");
        
    }
    public static function ClearAllCach ($I){
       // $I = new AcceptanceTester(($scenario));//Don't uncoment
        $I->amOnSubdomain("/admin");
        $I->click(NavigationBarPage::$System);
        $I->click(NavigationBarPage::$SystemClearAllCach);
        $I->waitForElement(".alert.in.fade.alert-error", '30');
        
    }
    
}