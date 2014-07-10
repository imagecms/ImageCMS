<?php

$I = new AcceptanceTester($scenario);
initTest::login($I);
$I->amOnPage('/');
$I->waitForText('Заказать звонок');
$I->click(CallbacksPage::$OrderCallButton);
$I->waitForElement(CallbacksPage::$CallMeButton);
$I->fillField(CallbacksPage::$UserNameCreate, '');
$I->fillField(CallbacksPage::$TelephoneCreate, '');
$I->fillField(CallbacksPage::$CommentCreate, '');
$I->click(CallbacksPage::$CallMeButton);
$I->waitForElement('.//*[@id="data-callback"]/label[1]/span[2]/label');
$I->see('Поле Имя является обязательным.', './/*[@id="data-callback"]/label[1]/span[2]/label');
$I->see('Поле Телефон является обязательным.', './/*[@id="data-callback"]/label[2]/span[2]/label');
