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

    protected $urlUa            = 'http://premmerce.com.ua/';
    protected $urlRu            = 'http://premmerce.ru/';
//    protected $urlUa            = 'http://imagego.com.ua/';
//    protected $urlRu            = 'http://imagego.ru/';
    protected $createStorePage  = "saas/create_store";

    
    /**
     * створити  на.ru - російська мова 
     * @guy PremmerceTester\PremmerceSteps
     */
    public function createRuStoreRuCountry(PremmerceTester\PremmerceSteps $I) {
        $I->amOnUrl($this->urlRu . $this->createStorePage);
        $generated = $I->generateName();
        $I->createStore($generated, $generated . '@gmail.com', $generated);
    }

    /**
     * змінити і перевірити мови
     * -російська
     * -українська
     * -білоруська
     * @guy PremmerceTester\PremmerceSteps
     */
    public function changeCountriesRuToUa(PremmerceTester\PremmerceSteps $I) {
        $this->verifyUrl($I, 'ru');
        $this->changeCountry($I, 1);
        $this->verifyUrl($I, 'ua');
        $this->changeCountry($I, 4);
        $this->verifyUrl($I, 'ru');
        $I->logoutCabinet();
    }

    /**
     * створити  на.com.ua - українська мова 
     * @guy PremmerceTester\PremmerceSteps
     */
    public function createUaStoreUaCountry(PremmerceTester\PremmerceSteps $I) {
        
        $I->amOnUrl($this->urlUa . $this->createStorePage);
//        generate name for store
        $generated = $I->generateName();
        $I->createStore($generated, $generated . '@gmail.com', $generated);
    }
    
    
    /**
     * змінити і перевірити мови
     * -українська
     * -російська
     * -білоруська
     * 
     * @guy PremmerceTester\PremmerceSteps
     */
    public function changeCountriesUaToRu(PremmerceTester\PremmerceSteps $I) {
        $this->verifyUrl($I, 'ua');
        $this->changeCountry($I, 2);
        $this->verifyUrl($I, 'ru');
        $this->changeCountry($I, 4);
        $this->verifyUrl($I, 'ru');
        $I->logoutCabinet();
    }
    
    /**
     * створити  на.com.ua - російська мова 
     * @guy PremmerceTester\PremmerceSteps
     */
    public function createUaStoreRusCountry(PremmerceTester\PremmerceSteps $I) {
        
        $I->amOnUrl($this->urlUa . $this->createStorePage);
//        generate name for store
        $generated = $I->generateName();
        $I->createStore($generated, $generated . '@gmail.com', $generated,  2);
        $this->changeCountriesRuToUa($I);
    }
    
    /**
     * створити  на.ru - українська мова 
     * @guy PremmerceTester\PremmerceSteps
     */
    public function createRuStoreUaCountry(PremmerceTester\PremmerceSteps $I) {
        
        $I->amOnUrl($this->urlRu . $this->createStorePage);
//        generate name for store
        $generated = $I->generateName();
        $I->createStore($generated, $generated . '@gmail.com', $generated, 2);
        $this->changeCountriesUaToRu($I);
    }
    
    
    
    
    /*----------------------------PROTECTED-----------------------------------*/

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
        $I->wait(2);
        $I->click('//ul[@class="nav nav-vertical nav-sidebar"]/ li[2]');
        $I->waitForElement('#cuselFrame-country');
        $I->click('#cuselFrame-country');
        $I->click("#cusel-scroll-country>span:nth-child($number)");
        $I->click('//div[@class="panel-form"][1]//button');
        $I->reloadPage();
        $I->wait(3);
    }

}
