<?php

$I = new AcceptanceTester($scenario);
initTest::login($I);
$I->amOnPage('/admin/components/run/shop/callbacks');
$I->click('.//*[@id="callbacks_all"]/table/tbody/tr[1]/td[3]/a');
$I->waitForElement('.//*[@id="editCallbackForm"]/div[2]/label');
$I->fillField(CallbacksPage::$UserNameEdit, '');
$I->fillField(CallbacksPage::$TelephoneEdit, '');
$I->fillField(CallbacksPage::$CommentEdit, '');
$datAtr=$I->grabAttributeFrom(CallbacksPage::$DateEdit, "readonly");
$I->assertEquals($datAtr, 'true');
$I->click(CallbacksPage::$SaveButton);
//$I->waitForElement('.//*[@id="editCallbackForm"]/div[3]/div/label');
$I->see('Это поле обязательное.', './/*[@id="editCallbackForm"]/div[3]/div/label');
$I->see('Это поле обязательное.', './/*[@id="editCallbackForm"]/div[4]/div/label');
$I->click(CallbacksPage::$GoBackButton);
$I->waitForText('Список обратных звонков');