<?php

$I = new AcceptanceTester($scenario);
initTest::login($I);
$I->amOnPage('/admin/components/run/shop/currencies');
$I->click('.//*[@id="currency_tr1"]/td[2]/a');
$I->waitForElement('.//*[@id="mod_name"]/label');
$I->fillField('.//*[@id="cur_ed_form"]/table/tbody/tr/td/div/div[1]/div/input', '12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert123456');
$I->fillField('.//*[@id="cur_ed_form"]/table/tbody/tr/td/div/div[2]/div/input', 'qйййй');
$I->fillField('.//*[@id="cur_ed_form"]/table/tbody/tr/td/div/div[3]/div/input', 'qйййй');
$I->fillField('.//*[@id="mod_name"]/div/input', '00120.01');
$I->click('.//*[@id="mainContent"]/section/div[1]/div[2]/div/button[1]');
$I->waitForElementVisible('.alert.in.fade.alert-success');
$I->see('Изменения сохранены');
$I->waitForElementNotVisible('.alert.in.fade.alert-success');
$I->seeInField('.//*[@id="cur_ed_form"]/table/tbody/tr/td/div/div[1]/div/input', '12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345');
$I->seeInField('.//*[@id="cur_ed_form"]/table/tbody/tr/td/div/div[2]/div/input', 'qйййй');
$I->seeInField('.//*[@id="cur_ed_form"]/table/tbody/tr/td/div/div[3]/div/input', 'qйййй');
$I->seeInField('.//*[@id="mod_name"]/div/input', '120.0100');
