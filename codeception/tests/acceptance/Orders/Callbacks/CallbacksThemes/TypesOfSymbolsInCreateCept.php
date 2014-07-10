<?php

$I = new AcceptanceTester($scenario);
initTest::login($I);
$I->amOnPage('/admin/components/run/shop/callbacks/createTheme');
$I->fillField(CallbacksPage::$NameTheme, 'qwerrQEQE12345!#@$#%%^&*()_+|}{:>?<,./;][\\=-0ёцвцаымпУКП');
$I->seeInField(CallbacksPage::$NameTheme, 'qwerrQEQE12345!#@$#%%^&*()_+|}{:>?<,./;][\\=-0ёцвцаымпУКП');
$I->click(CallbacksPage::$SaveButton);
$I->waitForElementVisible('.alert.in.fade.alert-success');
$I->see('Тема начата');
$I->waitForElementNotVisible('.alert.in.fade.alert-success');
$I->seeInField(CallbacksPage::$NameTheme, 'qwerrQEQE12345!#@$#%%^&*()_+|}{:>?<,./;][\\=-0ёцвцаымпУКП');

