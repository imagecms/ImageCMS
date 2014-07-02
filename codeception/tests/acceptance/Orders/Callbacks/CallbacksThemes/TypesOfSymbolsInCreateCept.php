<?php

$I = new AcceptanceTester($scenario);
initTest::login($I);
$I->amOnPage('/admin/components/run/shop/callbacks/createTheme');
$I->fillField('.//*[@id="Text"]', 'qwerrQEQE12345!#@$#%%^&*()_+|}{:>?<,./;][\\=-0ёцвцаымпУКП');
$I->seeInField('.//*[@id="Text"]', 'qwerrQEQE12345!#@$#%%^&*()_+|}{:>?<,./;][\\=-0ёцвцаымпУКП');
$I->click('.//*[@id="mainContent"]/section/div[1]/div[2]/div/button[1]');
$I->waitForElementVisible('.alert.in.fade.alert-success');
$I->see('Тема начата');
$I->waitForElementNotVisible('.alert.in.fade.alert-success');
$I->seeInField('.//*[@id="Text"]', 'qwerrQEQE12345!#@$#%%^&*()_+|}{:>?<,./;][\\=-0ёцвцаымпУКП');

