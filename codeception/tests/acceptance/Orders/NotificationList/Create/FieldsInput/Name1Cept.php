<?php
$I = new AcceptanceTester($scenario);
InitTest::Login($I);

//    Проверка появления сообщений в поле Имя.

$I->amOnPage('/shop/category/telefoniia-pleery-gps/telefony/smartfony?per_page=12');
$I->click('//div[3]/div/div/button');
$I->fillField('//span[2]/input', '1');
$I->click('//span[2]/div/button'); 
$I->amOnPage('/admin/components/run/shop/notifications');
$I->click(['link' => 'ad@min.com']);
$I->seeInField('//div[2]/div/div/input', '1');
$I->amOnPage('/admin/components/run/shop/notifications');
$I->click(NotificationListPage::$ListMainCheckBox);
$I->click(NotificationListPage::$ListButtonDelete);
$I->click(NotificationListPage::$DeleteWindowButtonDelete);
InitTest::ClearAllCach($I);
