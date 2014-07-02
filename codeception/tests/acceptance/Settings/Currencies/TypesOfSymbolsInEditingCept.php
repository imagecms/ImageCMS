<?php

$I = new AcceptanceTester($scenario);
initTest::login($I);
$I->amOnPage('/admin/components/run/shop/currencies');
$I->click('.//*[@id="currency_tr1"]/td[2]/a');
$I->waitForElement('.//*[@id="mod_name"]/label');
$I->fillField(CurrenciesPage::$NameCurrencyEdit, 'йццукsadasd123324?"{{$&(+|!@.,;:ADFФЦВ');
$I->fillField(CurrenciesPage::$IsoCodEdit, 'йццукsadasd123324?"{{$&(+|!@.,;:ADFФЦВ');
$I->fillField(CurrenciesPage::$SymbolEdit, 'йццукsadasd123324?"{{$&(+|!@.,;:ADFФЦВ');
$I->fillField(CurrenciesPage::$Rate, 'qwweйЫВSDFцук!"№;№%%:??*()_1ЮБ.,7653423');
$I->seeInField(CurrenciesPage::$NameCurrencyEdit, 'йццукsadasd123324?"{{$&(+|!@.,;:ADFФЦВ');
$I->seeInField(CurrenciesPage::$IsoCodEdit, 'йццукsadasd123324?"{{$&(+|!@.,;:ADFФЦВ');
$I->seeInField(CurrenciesPage::$SymbolEdit, 'йццукsadasd123324?"{{$&(+|!@.,;:ADFФЦВ');
$I->seeInField(CurrenciesPage::$Rate, '1.7653423');
