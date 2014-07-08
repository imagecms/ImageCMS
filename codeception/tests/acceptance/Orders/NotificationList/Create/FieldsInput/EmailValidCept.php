<?php

$I = new AcceptanceTester($scenario);
InitTest::Login($I);

//    Проверка появления сообщений в поле Имя.

$I->amOnPage('/shop/category/telefoniia-pleery-gps/telefony/smartfony?per_page=12');
$I->click('//div[3]/div/div/button');
$I->fillField('//label[2]/span[2]/input', 'as12@0987qweasd.net');
$I->click('//span[2]/div/button'); 
$I->amOnPage('/admin/components/run/shop/notifications');
$I->click(['link' => 'as12@0987qweasd.net']);
$I->seeInField('//div[2]/div/input', 'as12@0987qweasd.net');
$I->amOnPage('/admin/components/run/shop/notifications');
$I->click(NotificationListPage::$ListMainCheckBox);
$I->click(NotificationListPage::$ListButtonDelete);
$I->click(NotificationListPage::$DeleteWindowButtonDelete);
InitTest::ClearAllCach($I);