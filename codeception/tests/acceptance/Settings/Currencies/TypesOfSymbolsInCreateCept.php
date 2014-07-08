<?php

$I = new AcceptanceTester($scenario);
initTest::login($I);
$I->amOnPage('/admin/components/run/shop/currencies/create');
$I->fillField(CurrenciesPage::$NameCurrencyCreate, 'йццукsadasd123324?"{{$&(+|!@.,;:ADFФЦВ');
$I->fillField(CurrenciesPage::$IsoCodCreate, 'йццукsadasd123324?"{{$&(+|!@.,;:ADFФЦВ');
$I->fillField(CurrenciesPage::$SymbolCreate, 'йццукsadasd123324?"{{$&(+|!@.,;:ADFФЦВ');
$I->fillField(CurrenciesPage::$Rate, 'qwweйЫВSDFцук!"№;№%%:??*()_1ЮБ.,7653423');
$I->seeInField(CurrenciesPage::$NameCurrencyCreate, 'йццукsadasd123324?"{{$&(+|!@.,;:ADFФЦВ');
$I->seeInField(CurrenciesPage::$IsoCodCreate, 'йццукsadasd123324?"{{$&(+|!@.,;:ADFФЦВ');
$I->seeInField(CurrenciesPage::$SymbolCreate, 'йццукsadasd123324?"{{$&(+|!@.,;:ADFФЦВ');
$I->seeInField(CurrenciesPage::$Rate, '1.7653423');