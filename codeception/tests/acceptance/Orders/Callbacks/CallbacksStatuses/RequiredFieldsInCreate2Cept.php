<?php

$I = new AcceptanceTester($scenario);
initTest::login($I);
$I->amOnPage('/admin/components/run/shop/callbacks/statuses');
$I->click(CallbacksPage::$CreateStatusButton);
$I->waitForText('Создание статуса обратного звонка');
$I->click(CallbacksPage::$SaveAndExitButton);
$I->see('Это поле обязательное.', './/*[@id="addCallbackStatusForm"]/div[1]/div/label');
$I->click(CallbacksPage::$GoBackButton);
$I->waitForText('Статусы обратных звонков');

