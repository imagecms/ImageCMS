<?php
namespace AcceptanceTester;

class CurrenciesSteps extends \AcceptanceTester
{
    function CreateCurrency(AcceptanceTester $I,$name,$isocode,$symbol,$rate)
    {
        $I->$this;
        $I->amOnPage('/admin/components/run/shop/currencies/create');
        $I->fillField(\CurrenciesPage::$NameCurrencyCreate, $name);
        $I->fillField(\CurrenciesPage::$IsoCodCreate, $isocode);
        $I->fillField(\CurrenciesPage::$SymbolCreate, $symbol);
        $I->fillField(\CurrenciesPage::$Rate, $rate1);
        $I->click(\CurrenciesPage::$SaveButton);        
    }    
    
    function EditCurrency(AcceptanceTester $I,$name,$isocode,$symbol,$rate1,$rate)
    {
        $I = $this;
        $I->amOnPage('/admin/components/run/shop/currencies');
        $I->click('.//*[@id="currency_tr1"]/td[2]/a');
        $I->waitForElement('.//*[@id="mod_name"]/label');
        $I->fillField(CurrenciesPage::$NameCurrencyEdit, $name);
        $I->fillField(CurrenciesPage::$IsoCodEdit, $isocode);
        $I->fillField(CurrenciesPage::$SymbolEdit, $symbol);
        $I->fillField(CurrenciesPage::$Rate, $rate1);
        $I->click(CurrenciesPage::$SaveButton);
    }
}