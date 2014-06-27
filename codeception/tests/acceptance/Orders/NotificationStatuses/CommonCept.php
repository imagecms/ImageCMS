<?php

$userName = 'ad@min.com';
$password = 'admin';
$I = new AcceptanceTester($scenario);
$c = 1;
$a = array('qwe',
           'qwa',
           'ewq');

$I->wantTo('log in as regular user');
$I->amOnPage('/admin/login');
$I->appendField('login', $userName);
$I->appendField('password', 'admin');
$I->click('Войти');
$I->seeInCurrentUrl('/components/run/shop/dashboard');
$I->amOnPage('/admin');
$I->click('//nav/ul/li[2]/a');
$I->click('//nav/ul/li[2]/ul/li[10]/a');   
$I->seeInCurrentUrl('/components/run/shop/notificationstatuses/index');
$I->click('.btn.btn-small.btn-success.pjax');
foreach ($a as $value) {
    
    $I->appendField('#inputFio', $value);
    
}
$I->seeInPageSource('mainContent');
$I->seeInPageSource('Название');
$I->wait(5);
//$I = new AcceptanceTester($scenario);
//$I->wantTo('log in as regular user');
//$I->amOnPage('/admin/login');
//$I->appendField('login', $userName);
//$I->appendField('password', 'admin');
//$I->click('Войти');
//$I->seeInCurrentUrl('/components/run/shop/dashboard');
////sleep('10');
//
//$I->amOnPage('/admin');
//$I->click('//nav/ul/li[2]/a');
//$I->click('//nav/ul/li[2]/ul/li[10]/a');   
//$I->waitForElement('mainContent');
