<?php

$I = new AcceptanceTester($scenario);
initTest::login($I);
$I->amOnPage('/admin/components/run/shop/currencies/create');
$I->fillField(CurrenciesPage::$NameCurrencyCreate, 'qйййй');
$I->fillField(CurrenciesPage::$IsoCodCreate, 'qйййй');
$I->fillField(CurrenciesPage::$SymbolCreate, 'qйййй');
$I->fillField(CurrenciesPage::$Rate, '11111');
$I->click(CurrenciesPage::$SaveButton);
$I->waitForElementVisible('.alert.in.fade.alert-success');
$I->see('Валюта создана');
$I->waitForElementNotVisible('.alert.in.fade.alert-success');
$I->seeInField(CurrenciesPage::$NameCurrencyEdit, 'qйййй');
$I->seeInField(CurrenciesPage::$IsoCodEdit, 'qйййй');
$I->seeInField(CurrenciesPage::$SymbolEdit, 'qйййй');
$I->seeInField(CurrenciesPage::$Rate, '11111.0000');
$I->click(CurrenciesPage::$GoBackButton);
//$I->waitForText('Список валют');
//$text=$I->grabTextFrom('.//*[@id="mainContent"]/section/div[2]/div/form/table/tbody/tr[last()]/td[1]');
//$I->see('qйййй', ".//*[@id='mainContent']/section/div[2]/div/form/table/tbody/tr[$text]/td[2]/a");
//$I->see('qйййй', ".//*[@id='mainContent']/section/div[2]/div/form/table/tbody/tr[$text]/td[3]");
//$I->see('qйййй', ".//*[@id='mainContent']/section/div[2]/div/form/table/tbody/tr[$text]/td[4]");
//$I->seeOptionIsSelected($selector, $optionText);
