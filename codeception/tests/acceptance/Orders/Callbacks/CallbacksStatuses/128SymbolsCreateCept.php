<?php

$I = new AcceptanceTester($scenario);
initTest::login($I);
$I->amOnPage('/admin/components/run/shop/callbacks/createStatus');
$I->fillField(CallbacksPage::$NameStatus, '12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцу');
$I->click(CallbacksPage::$SaveButton);
$I->waitForElementVisible('.alert.in.fade.alert-success');
$I->see('Позиция создана');
$I->waitForElementNotVisible('.alert.in.fade.alert-success');
$I->seeInField(CallbacksPage::$NameStatus, '12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцу');
