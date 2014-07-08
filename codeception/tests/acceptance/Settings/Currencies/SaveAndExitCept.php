<?php

$I = new AcceptanceTester($scenario);
initTest::login($I);
$I->amOnPage('/admin/components/run/shop/currencies');
$I->click('.//*[@id="currency_tr1"]/td[2]/a');
$I->waitForElement('.//*[@id="mod_name"]/label');
$I->fillField(CurrenciesPage::$NameCurrencyEdit, 'цццц');
$I->fillField(CurrenciesPage::$IsoCodEdit, 'цццц');
$I->fillField(CurrenciesPage::$SymbolEdit, 'цццц');
$I->fillField(CurrenciesPage::$Rate, '11111');
$I->click(CurrenciesPage::$SaveAndExitButton);
$I->waitForElementVisible('.alert.in.fade.alert-success');
$I->see('Изменения сохранены');
$I->waitForElementNotVisible('.alert.in.fade.alert-success');
$I->waitForText('Список валют');
$I->see('цццц', './/*[@id="mainContent"]/section/div[2]/div/form/table/tbody/tr[1]/td[2]/a');
$I->see('цццц', './/*[@id="mainContent"]/section/div[2]/div/form/table/tbody/tr[1]/td[3]');
$I->see('цццц', './/*[@id="mainContent"]/section/div[2]/div/form/table/tbody/tr[1]/td[4]');

