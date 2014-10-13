<?php

use \PremmerceTester;

class RedirectsCest {
    /*
     * ПЕРЕВІРКА РЕДІРЕКТІВ
     * 
     * Створити Магаз на Рос домені з країною Росія  
     * перевірити урлу
     * змінити країну на Україну
     * перевірити урлу
     * змінити країну на Білорусію
     * перевірити урлу
     * Створити Магаз на Укр домені з країною Україна
     * перевірити урлу
     * змінити країну на Росію
     * перевірити урлу
     * змінити країну на Білорусію
     * перевірити урлу
     * Створити Магаз на Укр домені з країною Росія
     * перевірити урлу
     * змінити країну на Україну
     * перевірити урлу
     * змінити країну на Білорусію
     * перевірити урлу
     * Створити Магаз на Рос домені з країною Україна  
     * перевірити урлу
     * змінити країну на Росію
     * перевірити урлу
     * змінити країну на Білорусію
     * перевірити урлу
     */

    protected $urlUa            = 'http://imagego.com.ua/';
    protected $urlRu            = 'http://imagego.ru/';
    protected $createStorePage  = "saas/create_store";

    
    /*
     * створити  на.ru - російська мова 
     */
    public function createRuStoreRuLanguage(PremmerceTester $I) {
        $I->amOnUrl($this->urlRu . $this->createStorePage);
        
//        generate name for store
        $generated = $this->generateName();
        $this->createStore($I, $generated, $generated . '@gmail.com');
        $I->waitForElement('.info-header', 60);
    }

    /**
     * змінити і перевірити мови
     * -російська
     * -українська
     * -білоруська
     */
    public function changeCountriesRuToUa(PremmerceTester $I) {
        $this->verifyUrl($I, 'ru');
        $this->changeCountry($I, 1);
        $this->verifyUrl($I, 'ua');
        $this->changeCountry($I, 4);
        $this->verifyUrl($I, 'ru');
        $this->logout($I);
    }

    /*
     * створити  на.com.ua - українська мова 
     */
    public function createUaStoreUaLanguage(PremmerceTester $I) {
        
        $I->amOnUrl($this->urlUa . $this->createStorePage);
//        generate name for store
        $generated = $this->generateName();
        $this->createStore($I, $generated, $generated . '@gmail.com');
        $I->waitForElement('.info-header', 60);
    }
    
    
    /**
     * змінити і перевірити мови
     * -українська
     * -російська
     * -білоруська
     */
    public function changeCountriesUaToRu(PremmerceTester $I) {
        $this->verifyUrl($I, 'ua');
        $this->changeCountry($I, 2);
        $this->verifyUrl($I, 'ru');
        $this->changeCountry($I, 4);
        $this->verifyUrl($I, 'ru');
        $this->logout($I);
    }
    
    /*
     * створити  на.com.ua - російська мова 
     */
    public function createUaStoreRusLanguage(PremmerceTester $I) {
        
        $I->amOnUrl($this->urlUa . $this->createStorePage);
//        generate name for store
        $generated = $this->generateName();
        $this->createStore($I, $generated, $generated . '@gmail.com', 2);
        $I->waitForElement('.info-header', 60);
        $this->changeCountriesRuUa($I);
    }
    
    /*
     * створити  на.ru - українська мова 
     */
    public function createRuStoreUaLanguage(PremmerceTester $I) {
        
        $I->amOnUrl($this->urlRu . $this->createStorePage);
//        generate name for store
        $generated = $this->generateName();
        $this->createStore($I, $generated, $generated . '@gmail.com', 2);
        $I->waitForElement('.info-header', 60);
        $this->changeCountriesUaRu($I);
    }
    
    
    
    
    /*----------------------------PROTECTED-----------------------------------*/

    protected function logout(PremmerceTester $I){
        $I->click('.btn-profile.btn.isDrop');
        $I->wait(2);
        $I->click('.sub-menu.drop-sub-menu.drop.noinherit.active>li:nth-child(2)>a');
    }
    /**
     * @param string $country ru | ua
     */
    protected function verifyUrl(PremmerceTester $I, $country = 'ru') {

        $current_utl = $I->executeJS('return location.href'); //Js - повертає урлу 
        if   ( $country == 'ru') { $expected = $this->urlRu; } 
        else { $expected = $this->urlUa; }
        
        preg_match('~http:\/\/[a-z0-9\.]*/~', $current_utl , $matches);
        $actual = $matches[0];
        $I->assertEquals($expected, $actual);
    }

    protected function changeCountry(PremmerceTester $I, $number) {

        $I->click('//ul[@class="nav nav-vertical nav-sidebar"]/ li[2]');
        $I->waitForElement('#cuselFrame-country');
        $I->click('#cuselFrame-country');
        $I->click("#cusel-scroll-country>span:nth-child($number)");
        $I->click('//div[@class="panel-form"][1]//button');
        $I->reloadPage();
        $I->wait(3);
    }

    protected function createStore(PremmerceTester $I, $store_name, $email, $country = NULL) {
        $I->fillField(CreateStorePage::$InputDomain, $store_name);
        $I->fillField(CreateStorePage::$InputEmail, $email);
        $I->fillField(CreateStorePage::$InputPassword, 'adminadmin');
        $I->fillField(CreateStorePage::$InputName, 'CI-server');
        $I->fillField(CreateStorePage::$InputPhone, '800800');
        $I->fillField(CreateStorePage::$InputCity, 'Lviv');
        if (isset($country)) {
            $I->click(CreateStorePage::$SelectCountry);
            $I->click(CreateStorePage::selectCountryOption($country));
        }
        $I->click(CreateStorePage::$SelectCategoryOfProducts);
        $I->click(CreateStorePage::selectCategoryOfProductsOption(11));
        $I->click(CreateStorePage::$SelectProducts);
        $I->click(CreateStorePage::selectProductsOption(3));
        $I->checkOption(CreateStorePage::$CheckAgree);
        $I->click(CreateStorePage::$ButtonCreate);
    }

    protected function generateName() {
        $set = "abcdefghijklmnopqrstuvwxyz1234567890";
        $size = strlen($set) - 1;
        $name = '';
        $max = 10;
        while ($max--) {
            $name.=$set[rand(0, $size)];
        }
        return $name;
    }

}
