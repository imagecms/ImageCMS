<?php

$I = new AcceptanceTester($scenario);
initTest::login($I);
$I->amOnPage('/admin/components/run/shop/currencies');
$I->click('.//*[@id="currency_tr1"]/td[2]/a');
$I->waitForElement('.//*[@id="mod_name"]/label');
$I->fillField(CurrenciesPage::$NameCurrencyEdit, 'qйййй');
$I->fillField(CurrenciesPage::$IsoCodEdit, 'qйййй');
$I->fillField(CurrenciesPage::$SymbolEdit, 'qйййй');
$I->fillField(CurrenciesPage::$Rate, '11111');
$I->click(CurrenciesPage::$SaveButton);
$I->waitForElementVisible('.alert.in.fade.alert-success');
$I->see('Изменения сохранены');
$I->waitForElementNotVisible('.alert.in.fade.alert-success');
$I->seeInField(CurrenciesPage::$NameCurrencyEdit, 'qйййй');
$I->seeInField(CurrenciesPage::$IsoCodEdit, 'qйййй');
$I->seeInField(CurrenciesPage::$SymbolEdit, 'qйййй');
$I->seeInField(CurrenciesPage::$Rate, '11111.0000');
$I->click(CurrenciesPage::$GoBackButton);
$I->waitForText('Список валют');
$I->see('qйййй', './/*[@id="mainContent"]/section/div[2]/div/form/table/tbody/tr[1]/td[2]/a');
$I->see('qйййй', './/*[@id="mainContent"]/section/div[2]/div/form/table/tbody/tr[1]/td[3]');
$I->see('qйййй', './/*[@id="mainContent"]/section/div[2]/div/form/table/tbody/tr[1]/td[4]');