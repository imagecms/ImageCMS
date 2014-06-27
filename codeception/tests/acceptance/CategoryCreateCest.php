<?php

use \AcceptanceTester;

class CategoryCreateCest {

    public function _before() {
        
    }

    public function _after() {
        
    }

    /**
     * @group anriy
     * @group fulltest
     */
    public function login(AcceptanceTester $I) {
        
        $userName = 'ad@min.com';                
        $I->wantTo('log in as regular user');
        $I->amOnPage('/admin/login');
        $I->appendField('login', $userName);
        $I->appendField('password', 'admin');
        $I->click('Войти');
        $I->seeInCurrentUrl('/components/run/shop/dashboard');
    }

    /**
     * @group fulltest
     * 
     */
    public function createNewCategory(AcceptanceTester $I) {
        $I->amOnPage('/admin/');
        $I->click('//nav/ul/li[3]/a');
        $I->click('//nav/ul/li[3]/ul/li[1]/a');
        $I->waitForElement('.//*[@id="mainContent"]/section/div[1]/div[2]/div/a');
        $I->click('.//*[@id="mainContent"]/section/div[1]/div[2]/div/a');
        $I->waitForElement('#inputName');
        $I->appendField('#inputName', 'Категория');
        $I->click('a.chosen-single');
        $I->click('//div[@id="inputMainC_chosen"]/div/ul/li[4]');
        $I->click('//*[@id="mainContent"]/section/div/div[2]/div/button[2]');
    }
}
