<?php

$I = new AcceptanceTester($scenario);
initTest::login($I);
$I->amOnPage('/');
$I->waitForText('Заказать звонок');
$I->see('Заказать звонок', 'html/body/div[1]/div[1]/header/div[2]/div/div/div[1]/div/div[2]/button');
$I->click(CallbacksPage::$OrderCallButton);
$I->waitForElement(CallbacksPage::$CallMeButton);
$I->see('Заказать звонок', './/*[@id="ordercall"]/div[1]/div');
$I->see('Имя:', 'label > span.title');
$I->see('Телефон:', '//form[@id="data-callback"]/label[2]/span');
$I->see('Комментарий:', '//form[@id="data-callback"]/label[3]/span');
$I->see('Позвоните мне', 'div.btn-form > button[type="submit"]');