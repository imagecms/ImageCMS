<?php
namespace CurrenciesTester;

class CurrenciesSteps extends \CurrenciesTester
{
    function CreateCurrency($name,$isocode,$symbol,$rate,$save='save')
    {
        $I = $this;
        $I->amOnPage('/admin/components/run/shop/currencies/create');        
        $I->fillField(\CurrenciesPage::$NameCurrencyCreate, $name);        
        $I->fillField(\CurrenciesPage::$IsoCodCreate, $isocode);
        $I->fillField(\CurrenciesPage::$SymbolCreate, $symbol);
        $I->fillField(\CurrenciesPage::$Rate, $rate);
        switch ($save) {
            case 'save':
                $I->click(\CurrenciesPage::$SaveButton);
                break;
            case 'saveexit':
                $I->click(\CurrenciesPage::$SaveAndExitButton);
                break;
        }
    }    
    
    function EditCurrency($name,$isocode,$symbol,$rate,$save='save')
    {
        $I = $this;
        $I->amOnPage('/admin/components/run/shop/currencies');
        $I->click('.//*[@id="currency_tr1"]/td[2]/a');
        $I->waitForElement('.//*[@id="mod_name"]/label');
        $I->fillField(\CurrenciesPage::$NameCurrencyEdit, $name);
        $I->fillField(\CurrenciesPage::$IsoCodEdit, $isocode);
        $I->fillField(\CurrenciesPage::$SymbolEdit, $symbol);
        $I->fillField(\CurrenciesPage::$Rate, $rate);
        switch ($save) {
            case 'save':
                $I->click(\CurrenciesPage::$SaveButton);
                break;
            case 'saveexit':
                $I->click(\CurrenciesPage::$SaveAndExitButton);
                break;
        }
    }
    
    function CheckInFields($name1,$isocode1,$symbol1,$rate1)
    {
        $I = $this;
        $I->waitForText('Редактирование валют');
        $I->seeInField(\CurrenciesPage::$NameCurrencyEdit, $name1);
        $I->seeInField(\CurrenciesPage::$IsoCodEdit, $isocode1);
        $I->seeInField(\CurrenciesPage::$SymbolEdit, $symbol1);
        $I->seeInField(\CurrenciesPage::$Rate, $rate1);        
    }
    
    function CheckInListLanding($name1,$isocode1,$symbol1)
    {
        $I = $this;
        $I->wait('1');
        $I->see($name1, './/*[@id="mainContent"]/section/div[2]/div/form/table/tbody/tr[last()]/td[2]/a');
        $I->see($isocode1, './/*[@id="mainContent"]/section/div[2]/div/form/table/tbody/tr[last()]/td[3]');
        $I->see($symbol1, './/*[@id="mainContent"]/section/div[2]/div/form/table/tbody/tr[last()]/td[4]');
        $RadioBut=$I->grabAttributeFrom(\CurrenciesPage::RadioButtonLine("last()"), 'checked');
        $I->comment("$RadioBut");
        $I->assertEquals($RadioBut, null);
        $ActiveBut=$I->grabAttributeFrom(\CurrenciesPage::ActiveButtonLine("last()"), 'class');
        $I->comment("$ActiveBut");
        $I->assertEquals($ActiveBut, "prod-on_off disable_tovar");
        $DeleteBut=$I->grabAttributeFrom(\CurrenciesPage::DeleteButtonLine("last()"), 'disabled');
        $I->comment("DeleteBut");
        $I->assertEquals($DeleteBut, null);
    }
}