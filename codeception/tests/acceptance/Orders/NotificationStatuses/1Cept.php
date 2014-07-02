<?php

        
$I = new AcceptanceTester($scenario);
InitTest::Login($I);

$I->amOnPage('/admin');
$I->click(NavigationBarPage::$Orders);
$I->click(NavigationBarPage::$NotificationStatuses);
$I->waitForText("Статусы уведомлений о появлении");
$I->dragAndDrop("//tbody/tr[1]/td[3]", "//tbody/tr[3]/td[3]");
$I->wait("10");
//$lines = $I->grabTagCount($I,"tr td","1");
//$I->comment($lines);
