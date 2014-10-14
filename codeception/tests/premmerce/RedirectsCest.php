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

    
    /**
     * створити  на.ru - російська мова 
     * @guy PremmerceTester\PremmerceSteps
     */
    public function createRuStoreRuLanguage(PremmerceTester\PremmerceSteps $I) {
        $I->amOnUrl($this->urlRu . $this->createStorePage);
        $generated = $this->generateName();
        $I->createStore($generated, $generated . '@gmail.com', $generated);
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

    /**
     * створити  на.com.ua - українська мова 
     * @guy PremmerceTester\PremmerceSteps
     */
    public function createUaStoreUaLanguage(PremmerceTester\PremmerceSteps $I) {
        
        $I->amOnUrl($this->urlUa . $this->createStorePage);
//        generate name for store
        $generated = $this->generateName();
        $I->createStore($generated, $generated . '@gmail.com', $generated);
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
    
    /**
     * створити  на.com.ua - російська мова 
     * @guy PremmerceTester\PremmerceSteps
     */
    public function createUaStoreRusLanguage(PremmerceTester\PremmerceSteps $I) {
        
        $I->amOnUrl($this->urlUa . $this->createStorePage);
//        generate name for store
        $generated = $this->generateName();
        $I->createStore($generated, $generated . '@gmail.com', $generated,  2);
        $this->changeCountriesRuToUa($I);
    }
    
    /**
     * створити  на.ru - українська мова 
     * @guy PremmerceTester\PremmerceSteps
     */
    public function createRuStoreUaLanguage(PremmerceTester\PremmerceSteps $I) {
        
        $I->amOnUrl($this->urlRu . $this->createStorePage);
//        generate name for store
        $generated = $this->generateName();
        $I->createStore($generated, $generated . '@gmail.com', $generated, 2);
        $this->changeCountriesUaToRu($I);
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
