<?php

$I = new AcceptanceTester($scenario);
initTest::login($I);
$I->amOnPage('/admin/components/run/shop/currencies/create');
$I->fillField(CurrenciesPage::$CreateName, 'qййййй1234');
//$I->fillField('.//*[@id="cur_cr_form"]/table/tbody/tr/td/div/div[1]/div/input', 'qййййй1234');
$I->fillField('.//*[@id="cur_cr_form"]/table/tbody/tr/td/div/div[2]/div/input', 'qййййй1234');
$I->fillField('.//*[@id="cur_cr_form"]/table/tbody/tr/td/div/div[3]/div/input', 'qййййй1234');
$I->fillField('.//*[@id="mod_name"]/div/input', '111112.1233');
$I->click('.//*[@id="mainContent"]/section/div[1]/div[2]/div/button[1]');
$I->waitForElementVisible('.alert.in.fade.alert-error');
$I->see('Поле Iso Код не может превышать 5 символов в длину.');
$I->see('Поле Символ не может превышать 5 символов в длину.');
$I->waitForElementNotVisible('.alert.in.fade.alert-error');
$I->fillField('.//*[@id="cur_cr_form"]/table/tbody/tr/td/div/div[2]/div/input', 'qйййй');
$I->click('.//*[@id="mainContent"]/section/div[1]/div[2]/div/button[1]');
$I->waitForElementVisible('.alert.in.fade.alert-error');
$I->see('Поле Символ не может превышать 5 символов в длину.');
$I->waitForElementNotVisible('.alert.in.fade.alert-error');
$I->fillField('.//*[@id="cur_cr_form"]/table/tbody/tr/td/div/div[2]/div/input', 'qййййй1234');
$I->fillField('.//*[@id="cur_cr_form"]/table/tbody/tr/td/div/div[3]/div/input', 'qйййй');
$I->click('.//*[@id="mainContent"]/section/div[1]/div[2]/div/button[1]');
$I->waitForElementVisible('.alert.in.fade.alert-error');
$I->see('Поле Iso Код не может превышать 5 символов в длину.');
$I->waitForElementNotVisible('.alert.in.fade.alert-error');
$I->fillField('.//*[@id="cur_cr_form"]/table/tbody/tr/td/div/div[2]/div/input', 'qйййй');
$I->click('.//*[@id="mainContent"]/section/div[1]/div[2]/div/button[1]');
$I->waitForElementVisible('.alert.in.fade.alert-success');
$I->see('Валюта создана');
$I->waitForElementNotVisible('.alert.in.fade.alert-success');
$I->waitForText('Редактирование валют');
$I->seeInField('.//*[@id="cur_ed_form"]/table/tbody/tr/td/div/div[1]/div/input', 'qййййй1234');
$I->seeInField('.//*[@id="cur_ed_form"]/table/tbody/tr/td/div/div[2]/div/input', 'qйййй');
$I->seeInField('.//*[@id="cur_ed_form"]/table/tbody/tr/td/div/div[3]/div/input', 'qйййй');
$I->seeInField('.//*[@id="mod_name"]/div/input', '111112.1233');      