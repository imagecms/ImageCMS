<?php
// This is global bootstrap for autoloading 
class initTest{
    public function login($I) {
        $userName = 'ad@min.com';
        $password = "admin";
        $I = new AcceptanceTester($scenario);
        $I->wantTo('log in as admin');
        $I->amOnPage('/admin/login');
        $I->appendField('login', $userName);
        $I->appendField('password', $password);
        $I->click('.btn.btn-info');
        $I->seeInCurrentUrl('/components/run/shop/dashboard');
        
    } 
    
}