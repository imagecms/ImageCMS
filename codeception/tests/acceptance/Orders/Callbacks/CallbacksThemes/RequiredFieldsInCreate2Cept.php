<?php

$I = new AcceptanceTester($scenario);
initTest::login($I);
$I->amOnPage('/admin/components/run/shop/callbacks/createTheme');
$I->click(CallbacksPage::$SaveAndExitButton);
$I->see('Это поле обязательное.', './/*[@id="addCallbackStatusForm"]/div/div/label');
$I->click(CallbacksPage::$GoBackButton);
$I->waitForText('Темы обратных звонков');

