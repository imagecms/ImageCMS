<?php

$I = new AcceptanceTester($scenario);
initTest::login($I);
$I->amOnPage('/');
$I->waitForText('Заказать звонок');
$I->click(CallbacksPage::$OrderCallButton);
$I->waitForElement(CallbacksPage::$CallMeButton);
$I->fillField(CallbacksPage::$UserNameCreate, '12345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678');
$I->fillField(CallbacksPage::$TelephoneCreate, '12345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678');
$I->fillField(CallbacksPage::$CommentCreate, '12345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678');
$I->click(CallbacksPage::$CallMeButton);
$I->waitForElement('.//*[@id="data-callback"]/label[2]/span[2]/label');
$I->see('Поле Телефон не может превышать 50 символов в длину.', './/*[@id="data-callback"]/label[2]/span[2]/label');
$I->fillField(CallbacksPage::$TelephoneCreate, '12345678901234567890123456789012345678901234567890');
$I->click(CallbacksPage::$CallMeButton);
$I->waitForElementNotVisible('.//*[@id="ordercall"]');

