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
    
//    public static function a ($I,$tag1,$tag2){
//        $I->executeJS("var container = document.createElement('input');
//	container.id = 'length';
//	container.value = document.getElementsByTagName(\"$tag1\")[0].getElementsByTagName(\"$tag2\").length;
//	document.body.insertBefore(container, document.body.firstChild)");
//        $I->wait("1");
//        $lines = $I->grabValueFrom('#length');
//        $I->comment((string)$lines);        
//    }
    
    public static function TagCount ($I,$tags,$position='0'){
        $tag = explode(" ",$tags);
        $I->executeJS("var container = document.createElement('input');
	container.id = 'length';
        container.type = 'hidden';
	container.value = document.getElementsByTagName(\"$tag[0]\")[$position].getElementsByTagName(\"$tag[1]\").length;
	document.body.insertBefore(container, document.body.firstChild)");
        $I->wait("1");
        $lines = $I->grabValueFrom('#length');
        return $lines;
    }
}