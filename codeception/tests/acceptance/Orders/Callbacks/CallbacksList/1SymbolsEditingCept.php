<?php

$I = new AcceptanceTester($scenario);
initTest::login($I);
$I->amOnPage('/admin/components/run/shop/callbacks');
$I->click('.//*[@id="callbacks_all"]/table/tbody/tr[1]/td[3]/a');
$I->waitForElement('.//*[@id="editCallbackForm"]/div[2]/label');
$I->fillField(CallbacksPage::$UserNameEdit, 'a');
$I->fillField(CallbacksPage::$TelephoneEdit, '1');
$I->fillField(CallbacksPage::$CommentEdit, 's');
$I->click(CallbacksPage::$SaveButton);
$I->waitForElementVisible('.alert.in.fade.alert-success');
$I->see('Изменения сохранены');
$I->waitForElementNotVisible('.alert.in.fade.alert-success');
$I->seeInField(CallbacksPage::$UserNameEdit, 'a');
$I->seeInField(CallbacksPage::$TelephoneEdit, '1');
$I->seeInField(CallbacksPage::$CommentEdit, 's');
