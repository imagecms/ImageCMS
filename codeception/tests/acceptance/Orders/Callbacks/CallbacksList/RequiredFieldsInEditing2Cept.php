<?php

$I = new AcceptanceTester($scenario);
initTest::login($I);
$I->amOnPage('/admin/components/run/shop/callbacks');
$I->click('.//*[@id="callbacks_all"]/table/tbody/tr[1]/td[3]/a');
$I->waitForElement('.//*[@id="editCallbackForm"]/div[2]/label');
$I->fillField('.//*[@id="editCallbackForm"]/div[3]/div/input', '');
$I->fillField('.//*[@id="editCallbackForm"]/div[4]/div/input', '');
$I->fillField('.//*[@id="editCallbackForm"]/div[5]/div/textarea', '');
$I->click('.//*[@id="mainContent"]/section/div[1]/div[2]/div/button[2]');
//$I->waitForElement('.//*[@id="editCallbackForm"]/div[3]/div/label');
$I->see('Это поле обязательное.', './/*[@id="editCallbackForm"]/div[3]/div/label');
$I->see('Это поле обязательное.', './/*[@id="editCallbackForm"]/div[4]/div/label');