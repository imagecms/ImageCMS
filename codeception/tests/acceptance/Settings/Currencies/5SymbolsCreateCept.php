<?php

$I = new AcceptanceTester($scenario);
initTest::login($I);
$I->amOnPage('/admin/components/run/shop/currencies/create');
$I->fillField('.//*[@id="cur_cr_form"]/table/tbody/tr/td/div/div[1]/div/input', 'qйййй');
$I->fillField('.//*[@id="cur_cr_form"]/table/tbody/tr/td/div/div[2]/div/input', 'qйййй');
$I->fillField('.//*[@id="cur_cr_form"]/table/tbody/tr/td/div/div[3]/div/input', 'qйййй');
$I->fillField('.//*[@id="mod_name"]/div/input', '11111');
$I->click('.//*[@id="mainContent"]/section/div[1]/div[2]/div/button[1]');
$I->waitForElementVisible('.alert.in.fade.alert-success');
$I->see('Валюта создана');
$I->waitForElementNotVisible('.alert.in.fade.alert-success');
$I->seeInField('.//*[@id="cur_ed_form"]/table/tbody/tr/td/div/div[1]/div/input', 'qйййй');
$I->seeInField('.//*[@id="cur_ed_form"]/table/tbody/tr/td/div/div[2]/div/input', 'qйййй');
$I->seeInField('.//*[@id="cur_ed_form"]/table/tbody/tr/td/div/div[3]/div/input', 'qйййй');
$I->seeInField('.//*[@id="mod_name"]/div/input', '11111.0000');
$I->click('.//*[@id="mainContent"]/section/div[1]/div[2]/div/a/span[2]');
//$I->waitForText('Список валют');
//$text=$I->grabTextFrom('.//*[@id="mainContent"]/section/div[2]/div/form/table/tbody/tr[last()]/td[1]');
//$I->see('qйййй', ".//*[@id='mainContent']/section/div[2]/div/form/table/tbody/tr[$text]/td[2]/a");
//$I->see('qйййй', ".//*[@id='mainContent']/section/div[2]/div/form/table/tbody/tr[$text]/td[3]");
//$I->see('qйййй', ".//*[@id='mainContent']/section/div[2]/div/form/table/tbody/tr[$text]/td[4]");
//$I->seeOptionIsSelected($selector, $optionText);
