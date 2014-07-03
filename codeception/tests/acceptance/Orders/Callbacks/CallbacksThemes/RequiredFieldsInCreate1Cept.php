<?php

$I = new AcceptanceTester($scenario);
initTest::login($I);
$I->amOnPage('/admin/components/run/shop/callbacks/createTheme');
$I->click('.//*[@id="mainContent"]/section/div[1]/div[2]/div/button[1]');
$I->see('Это поле обязательное.', './/*[@id="addCallbackStatusForm"]/div/div/label');
$I->click('.//*[@id="mainContent"]/section/div[1]/div[2]/div/a/span[2]');
$I->waitForText('Темы обратных звонков');
