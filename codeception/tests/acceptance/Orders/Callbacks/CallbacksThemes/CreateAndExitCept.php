<?php

$I = new AcceptanceTester($scenario);
initTest::login($I);
$I->amOnPage('/admin/components/run/shop/callbacks/createTheme');
$I->fillField(CallbacksPage::$NameTheme, 'ййй');
$I->click(CallbacksPage::$SaveAndExitButton);
$I->waitForElementVisible('.alert.in.fade.alert-success');
$I->see('Тема начата');
$I->waitForElementNotVisible('.alert.in.fade.alert-success');
$I->waitForText('Темы обратных звонков');
$text=$I->grabTextFrom('.//*[@id="orderStatusesList"]/section/div[2]/div/table/tbody/tr[last()]/td[1]');
$I->see('ййй', './/*[@id="orderStatusesList"]/section/div[2]/div/table/tbody/tr[last()]/td[2]/a');
