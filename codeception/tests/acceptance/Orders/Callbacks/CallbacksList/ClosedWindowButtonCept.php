<?php

$I = new AcceptanceTester($scenario);
initTest::login($I);
$I->amOnPage('/');
$I->waitForText('Заказать звонок');
$I->see('Заказать звонок', 'html/body/div[1]/div[1]/header/div[2]/div/div/div[1]/div/div[2]/button');
$I->click(CallbacksPage::$OrderCallButton);
$I->waitForElement(CallbacksPage::$CallMeButton);
$I->click('.//*[@id="ordercall"]/button');
$I->waitForElementNotVisible('.//*[@id="ordercall"]');

