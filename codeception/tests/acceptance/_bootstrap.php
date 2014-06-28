<?php
// Here you can initialize variables that will be available to your tests
class initTest{
    public function login($I) {
        $userName = 'ad@min.com';
        $password = 'admin';
        $I->wantTo('log in as admin');
        $I->amOnPage('/admin/login');
        $I->appendField('login', $userName);
        $I->appendField('password', $password);
        $I->click('.btn.btn-info');
        $I->seeInCurrentUrl('/components/run/shop/dashboard');
        $I->seeElement("nav");
        
    } 
    
}