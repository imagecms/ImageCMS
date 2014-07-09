<?php

$I = new AcceptanceTester($scenario);
initTest::login($I);
$I->amOnPage('/admin/components/run/shop/callbacks/createStatus');
$I->fillField(CallbacksPage::$NameStatus, 'www');
$I->click(CallbacksPage::$SaveAndExitButton);
$I->waitForElementVisible('.alert.in.fade.alert-success');
$I->see('Позиция создана');
$I->waitForElementNotVisible('.alert.in.fade.alert-success');
$I->waitForText('Статусы обратных звонков');
$text=$I->grabTextFrom('.//*[@id="orderStatusesList"]/section/div[2]/div/table/tbody/tr[last()]/td[1]');
$I->see('www', './/*[@id="orderStatusesList"]/section/div[2]/div/table/tbody/tr[last()]/td[2]/a');


