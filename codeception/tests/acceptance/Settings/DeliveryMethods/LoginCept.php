<?php 
$I = new AcceptanceTester($scenario);
$I->wantTo('Login');
        $userName = 'ad@min.com';
        $password = "admin";
        $I->wantTo('log in as admin');
        $I->amOnPage('/admin/login');
        $I->appendField('login', $userName);
        $I->appendField('password', $password);
        $I->click('.btn.btn-info');
        $I->seeInCurrentUrl('/components/run/shop/dashboard');
        $I->seeElement("nav");