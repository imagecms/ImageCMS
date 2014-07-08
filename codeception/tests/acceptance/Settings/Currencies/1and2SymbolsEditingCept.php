<?php

$I = new AcceptanceTester($scenario);
initTest::login($I);
$I->amOnPage('/admin/components/run/shop/currencies');
$I->click('.//*[@id="currency_tr1"]/td[2]/a');
$I->waitForElement('.//*[@id="mod_name"]/label');
$I->fillField(CurrenciesPage::$NameCurrencyEdit, 'q');
$I->fillField(CurrenciesPage::$IsoCodEdit, 'q');
$I->fillField(CurrenciesPage::$SymbolEdit, 'q');
$I->fillField(CurrenciesPage::$Rate, '1');
$I->click(CurrenciesPage::$SaveButton);
//$I->see('×Ошибка: Поле Название должно быть не менее 2 символов в длину.\n\nЗапросов к базе: 20', 'html/body/div[1]/div[2]/div[4]');
$I->waitForElementVisible('.alert.in.fade.alert-error');
$I->see('Поле Название должно быть не менее 2 символов в длину.');
$I->waitForElementNotVisible('.alert.in.fade.alert-error');
$I->appendField(CurrenciesPage::$NameCurrencyEdit, 'q');
$I->click(CurrenciesPage::$SaveButton);
$I->waitForElementVisible('.alert.in.fade.alert-success');
$I->see('Изменения сохранены');
$I->waitForElementNotVisible('.alert.in.fade.alert-success');
$I->seeInField(CurrenciesPage::$NameCurrencyEdit, 'qq');
$I->seeInField(CurrenciesPage::$IsoCodEdit, 'q');
$I->seeInField(CurrenciesPage::$SymbolEdit, 'q');
$I->seeInField(CurrenciesPage::$Rate, '1.0000');