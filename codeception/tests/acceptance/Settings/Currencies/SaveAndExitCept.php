<?php

$I = new AcceptanceTester($scenario);
initTest::login($I);
$I->amOnPage('/admin/components/run/shop/currencies');
$I->click('.//*[@id="currency_tr1"]/td[2]/a');
$I->waitForElement('.//*[@id="mod_name"]/label');
$I->fillField('.//*[@id="cur_ed_form"]/table/tbody/tr/td/div/div[1]/div/input', 'цццц');
$I->fillField('.//*[@id="cur_ed_form"]/table/tbody/tr/td/div/div[2]/div/input', 'цццц');
$I->fillField('.//*[@id="cur_ed_form"]/table/tbody/tr/td/div/div[3]/div/input', 'цццц');
$I->fillField('.//*[@id="mod_name"]/div/input', '11111');
$I->click('.//*[@id="mainContent"]/section/div[1]/div[2]/div/button[2]');
$I->waitForElementVisible('.alert.in.fade.alert-success');
$I->see('Изменения сохранены');
$I->waitForElementNotVisible('.alert.in.fade.alert-success');
$I->waitForText('Список валют');
$I->see('цццц', './/*[@id="mainContent"]/section/div[2]/div/form/table/tbody/tr[1]/td[2]/a');
$I->see('цццц', './/*[@id="mainContent"]/section/div[2]/div/form/table/tbody/tr[1]/td[3]');
$I->see('цццц', './/*[@id="mainContent"]/section/div[2]/div/form/table/tbody/tr[1]/td[4]');

