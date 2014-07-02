<?php

$I = new AcceptanceTester($scenario);
initTest::login($I);
$I->amOnPage('/admin/components/run/shop/currencies/create');
$I->fillField(CurrenciesPage::$NameCurrencyCreate, 'ййй');
$I->fillField(CurrenciesPage::$IsoCodCreate, 'ййй');
$I->fillField(CurrenciesPage::$SymbolCreate, 'ййй');
$I->fillField(CurrenciesPage::$Rate, '01030.2');
$I->click(CurrenciesPage::$SaveAndExitButton);
$I->waitForElementVisible('.alert.in.fade.alert-success');
$I->see('Валюта создана');
$I->waitForElementNotVisible('.alert.in.fade.alert-success');
$I->waitForText('Список валют');
$text=$I->grabTextFrom('.//*[@id="mainContent"]/section/div[2]/div/form/table/tbody/tr[last()]/td[1]');
$I->see('ййй', './/*[@id="mainContent"]/section/div[2]/div/form/table/tbody/tr[last()]/td[2]/a');
$I->see('ййй', './/*[@id="mainContent"]/section/div[2]/div/form/table/tbody/tr[last()]/td[3]');
$I->see('ййй', './/*[@id="mainContent"]/section/div[2]/div/form/table/tbody/tr[last()]/td[4]');

