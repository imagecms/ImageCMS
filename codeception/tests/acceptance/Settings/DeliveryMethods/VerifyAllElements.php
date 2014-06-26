<?php

$userName = 'ad@min.com';
$password = "admin";
$I = new AcceptanceTester($scenario);
$I->wantTo('log in as regular user');
$I->amOnPage('/admin/login');
$I->appendField('login', $userName);
$I->appendField('password', $password);
$I->click('Войти');
$I->seeInCurrentUrl('/components/run/shop/dashboard');
