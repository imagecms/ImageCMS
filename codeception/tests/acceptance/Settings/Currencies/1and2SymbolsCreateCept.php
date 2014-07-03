<?php

$I = new AcceptanceTester($scenario);
initTest::login($I);
$I->amOnPage('/admin/components/run/shop/currencies/create');
$I->fillField(CurrenciesPage::$NameCurrencyCreate, 'q');
$I->fillField(CurrenciesPage::$IsoCodCreate, 'q');
$I->fillField(CurrenciesPage::$SymbolCreate, 'q');
$I->fillField(CurrenciesPage::$Rate, '1');
$I->click(CurrenciesPage::$SaveButton);
//$I->see('×Ошибка: Поле Название должно быть не менее 2 символов в длину.\n\nЗапросов к базе: 20', 'html/body/div[1]/div[2]/div[4]');
$I->waitForElementVisible('.alert.in.fade.alert-error');
$I->see('Поле Название должно быть не менее 2 символов в длину.');
$I->waitForElementNotVisible('.alert.in.fade.alert-error');
$I->appendField(CurrenciesPage::$NameCurrencyCreate, 'q');
$I->click(CurrenciesPage::$SaveButton);
$I->waitForElementVisible('.alert.in.fade.alert-success');
$I->see('Валюта создана');
$I->waitForElementNotVisible('.alert.in.fade.alert-success');
$I->seeInField(CurrenciesPage::$NameCurrencyEdit, 'qq');
$I->seeInField(CurrenciesPage::$IsoCodEdit, 'q');
$I->seeInField(CurrenciesPage::$SymbolEdit, 'q');
$I->seeInField(CurrenciesPage::$Rate, '1.0000');