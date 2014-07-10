<?php

$I = new AcceptanceTester($scenario);
initTest::login($I);
$I->amOnPage('/admin/components/run/shop/callbacks/themes');
$I->click('.//*[@id="orderStatusesList"]/section/div[2]/div/table/tbody/tr/td[2]/a');
$I->waitForText('Редактирование темы обратного звонка');
$I->fillField(CallbacksPage::$NameTheme, 'q');
$I->click(CallbacksPage::$SaveButton);
$I->waitForElementVisible('.alert.in.fade.alert-success');
$I->see('Изменения сохранены');
$I->waitForElementNotVisible('.alert.in.fade.alert-success');
$I->seeInField(CallbacksPage::$NameTheme, 'q');

