<?php

$I = new AcceptanceTester($scenario);
initTest::login($I);
$I->amOnPage('/admin/components/run/shop/callbacks/statuses');
$I->click(CallbacksPage::$CreateStatusButton);
$I->waitForText('Редактирование статуса обратного звонка');
$I->fillField(CallbacksPage::$NameStatus, 'qwerrQEQE12345!#@$#%%^&*()_+|}{:">?<,./;][\\=-0ёцвцаымпУКП');
$I->seeInField(CallbacksPage::$NameStatus, 'qwerrQEQE12345!#@$#%%^&*()_+|}{:">?<,./;][\\=-0ёцвцаымпУКП');
$I->click(CallbacksPage::$SaveButton);
$I->waitForElementVisible('.alert.in.fade.alert-success');
$I->see('Изменения сохранены');
$I->waitForElementNotVisible('.alert.in.fade.alert-success');
$I->seeInField(CallbacksPage::$NameStatus, 'qwerrQEQE12345!#@$#%%^&*()_+|}{:">?<,./;][\\=-0ёцвцаымпУКП');

