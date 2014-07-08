<?php

$I = new AcceptanceTester($scenario);
initTest::login($I);
$I->amOnPage('/admin/components/run/shop/currencies');
$I->click('.//*[@id="currency_tr1"]/td[2]/a');
$I->waitForElement('.//*[@id="mod_name"]/label');
$I->fillField(CurrenciesPage::$NameCurrencyEdit, '12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345');
$I->fillField(CurrenciesPage::$IsoCodEdit, 'qйййй');
$I->fillField(CurrenciesPage::$SymbolEdit, 'qйййй');
$I->fillField(CurrenciesPage::$Rate, '.0210');
$I->click(CurrenciesPage::$SaveButton);
$I->waitForElementVisible('.alert.in.fade.alert-success');
$I->see('Изменения сохранены');
$I->waitForElementNotVisible('.alert.in.fade.alert-success');
$I->seeInField(CurrenciesPage::$NameCurrencyEdit, '12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345');
$I->seeInField(CurrenciesPage::$IsoCodEdit, 'qйййй');
$I->seeInField(CurrenciesPage::$SymbolEdit, 'qйййй');
$I->seeInField(CurrenciesPage::$Rate, '0.0210');