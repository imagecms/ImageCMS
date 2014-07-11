<?php

$I = new AcceptanceTester($scenario);
initTest::login($I);
$I->amOnPage('/admin/components/run/shop/callbacks/themes');
$I->click('.//*[@id="orderStatusesList"]/section/div[2]/div/table/tbody/tr/td[2]/a');
$I->waitForText('Редактирование темы обратного звонка');
$I->fillField(CallbacksPage::$NameTheme, 'www');
$I->click(CallbacksPage::$SaveAndExitButton);
$I->waitForElementVisible('.alert.in.fade.alert-success');
$I->see('Изменения сохранены');
$I->waitForElementNotVisible('.alert.in.fade.alert-success');
$I->waitForText('Темы обратных звонков');
$I->see('www', './/*[@id="orderStatusesList"]/section/div[2]/div/table/tbody/tr/td[2]/a');

