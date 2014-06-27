<?php

$I = new AcceptanceTester($Ostap);
$I->wantTo('Verify Text Present in Notification Statuses');
$I->amOnPage('/admin');
//открытие страницы Статусы уведомлений.
$I->click('//nav/ul/li[2]/a');
$I->click('//nav/ul/li[2]/ul/li[10]/a');
//проверка УРЛ открытой страницы
$I->seeInCurrentUrl('/components/run/shop/notificationstatuses/index');
//проверка на странице Названий(title,button,link)
