<?php

$I = new AcceptanceTester($scenario);
initTest::login($I);
$I->amOnPage('/admin/components/run/shop/currencies/create');
$I->fillField(CurrenciesPage::$NameCurrencyCreate, '12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345');
$I->fillField(CurrenciesPage::$IsoCodCreate, 'qйййй');
$I->fillField(CurrenciesPage::$SymbolCreate, 'qйййй');
$I->fillField(CurrenciesPage::$Rate, '.234');
$I->click(CurrenciesPage::$SaveButton);
$I->waitForElementVisible('.alert.in.fade.alert-success');
$I->see('Валюта создана');
$I->waitForElementNotVisible('.alert.in.fade.alert-success');
$I->seeInField(CurrenciesPage::$NameCurrencyEdit, '12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345');
$I->seeInField(CurrenciesPage::$IsoCodEdit, 'qйййй');
$I->seeInField(CurrenciesPage::$SymbolEdit, 'qйййй');
$I->seeInField(CurrenciesPage::$Rate, '0.2340');

