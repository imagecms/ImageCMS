<?php

$I = new AcceptanceTester($scenario);
initTest::login($I);
$I->amOnPage('/admin/components/run/shop/currencies');
$I->click('.//*[@id="currency_tr1"]/td[2]/a');
$I->waitForElement('.//*[@id="mod_name"]/label');
$I->fillField('.//*[@id="cur_ed_form"]/table/tbody/tr/td/div/div[1]/div/input', 'q');
$I->fillField('.//*[@id="cur_ed_form"]/table/tbody/tr/td/div/div[2]/div/input', 'q');
$I->fillField('.//*[@id="cur_ed_form"]/table/tbody/tr/td/div/div[3]/div/input', 'q');
$I->fillField('.//*[@id="mod_name"]/div/input', '1');
$I->click('.//*[@id="mainContent"]/section/div[1]/div[2]/div/button[1]');
//$I->see('×Ошибка: Поле Название должно быть не менее 2 символов в длину.\n\nЗапросов к базе: 20', 'html/body/div[1]/div[2]/div[4]');
$I->waitForElementVisible('.alert.in.fade.alert-error');
$I->see('Поле Название должно быть не менее 2 символов в длину.');
$I->waitForElementNotVisible('.alert.in.fade.alert-error');
$I->appendField('.//*[@id="cur_ed_form"]/table/tbody/tr/td/div/div[1]/div/input', 'q');
$I->click('.//*[@id="mainContent"]/section/div[1]/div[2]/div/button[1]');
$I->waitForElementVisible('.alert.in.fade.alert-success');
$I->see('Изменения сохранены');
$I->waitForElementNotVisible('.alert.in.fade.alert-success');
$I->seeInField('.//*[@id="cur_ed_form"]/table/tbody/tr/td/div/div[1]/div/input', 'qq');
$I->seeInField('.//*[@id="cur_ed_form"]/table/tbody/tr/td/div/div[2]/div/input', 'q');
$I->seeInField('.//*[@id="cur_ed_form"]/table/tbody/tr/td/div/div[3]/div/input', 'q');
$I->seeInField('.//*[@id="mod_name"]/div/input', '1.0000');