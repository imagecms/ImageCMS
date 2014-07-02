<?php

$I = new AcceptanceTester($scenario);
initTest::login($I);
$I->amOnPage('/admin/components/run/shop/callbacks/themes');
$I->click('.//*[@id="orderStatusesList"]/section/div[2]/div/table/tbody/tr/td[2]/a');
$I->waitForText('Редактирование темы обратного звонка');
$I->fillField('.//*[@id="Text"]', '');
$I->click('.//*[@id="mainContent"]/section/div[1]/div[2]/div/button[2]');
$I->see('Это поле обязательное.', './/*[@id="addCallbackStatusForm"]/div/div/label');
$I->click('.//*[@id="mainContent"]/section/div[1]/div[2]/div/a/span[2]');
$I->waitForText('Темы обратных звонков');

