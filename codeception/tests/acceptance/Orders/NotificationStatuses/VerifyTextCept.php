<?php
//login
$I->wantTo('log in as regular user');
$I->amOnPage('/admin/login');
$I->appendField('login', $userName);
$I->appendField('password', 'admin');
$I->click('Войти');
$I->seeInCurrentUrl('/components/run/shop/dashboard');
//test
$I = new AcceptanceTester($scenario);
$I->wantTo('Verify Text Present in Notification Statuses');
$I->amOnPage('/admin');
//открытие страницы Статусы уведомлений.
$I->click('//nav/ul/li[2]/a');
$I->click('//nav/ul/li[2]/ul/li[10]/a');
//проверка УРЛ открытой страницы
$I->seeInCurrentUrl('/components/run/shop/notificationstatuses/index');
//проверка на странице Названий(title,button,link)$I->seeInPageSource('Статусы уведомлений о появлении');
$I->seeInPageSource('Статусы о появлении о появлении');
sleep(7);
