<?php

$I = new AcceptanceTester($scenario);
initTest::login($I);
$I->amOnPage('/admin/components/run/shop/callbacks/themes');
$I->click('.//*[@id="orderStatusesList"]/section/div[2]/div/table/tbody/tr/td[2]/a');
$I->waitForText('Редактирование темы обратного звонка');
$I->fillField(CallbacksPage::$NameTheme, '');
$I->click(CallbacksPage::$SaveAndExitButton);
$I->see('Это поле обязательное.', './/*[@id="addCallbackStatusForm"]/div/div/label');
$I->click(CallbacksPage::$GoBackButton);
$I->waitForText('Темы обратных звонков');

