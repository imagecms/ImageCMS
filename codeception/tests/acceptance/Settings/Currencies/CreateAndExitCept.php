<?php

$I = new AcceptanceTester($scenario);
initTest::login($I);
$I->amOnPage('/admin/components/run/shop/currencies/create');
$I->fillField('.//*[@id="cur_cr_form"]/table/tbody/tr/td/div/div[1]/div/input', 'ййй');
$I->fillField('.//*[@id="cur_cr_form"]/table/tbody/tr/td/div/div[2]/div/input', 'ййй');
$I->fillField('.//*[@id="cur_cr_form"]/table/tbody/tr/td/div/div[3]/div/input', 'ййй');
$I->fillField('.//*[@id="mod_name"]/div/input', '01030.2');
$I->click('.//*[@id="mainContent"]/section/div[1]/div[2]/div/button[2]');
$I->waitForElementVisible('.alert.in.fade.alert-success');
$I->see('Валюта создана');
$I->waitForElementNotVisible('.alert.in.fade.alert-success');
$I->waitForText('Список валют');
$text=$I->grabTextFrom('.//*[@id="mainContent"]/section/div[2]/div/form/table/tbody/tr[last()]/td[1]');
$I->see('ййй', './/*[@id="mainContent"]/section/div[2]/div/form/table/tbody/tr[last()]/td[2]/a');
$I->see('ййй', './/*[@id="mainContent"]/section/div[2]/div/form/table/tbody/tr[last()]/td[3]');
$I->see('ййй', './/*[@id="mainContent"]/section/div[2]/div/form/table/tbody/tr[last()]/td[4]');

