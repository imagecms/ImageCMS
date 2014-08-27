<?php
namespace CurrenciesTester;

class CurrenciesSteps extends \CurrenciesTester
{
    function CreateCurrency($name,$isocode,$symbol,$rate,$save='save')
    {
        $I = $this;
        $I->amOnPage(\CurrenciesPage::$URL);
        $I->click(\CurrenciesPage::$CreateCurrencyButton);
        $I->waitForElement('.//*[@id="mod_name"]/label');
        $I->fillField(\CurrenciesPage::$NameCurrencyCreate, $name);        
        $I->fillField(\CurrenciesPage::$IsoCodCreate, $isocode);
        $I->fillField(\CurrenciesPage::$SymbolCreate, $symbol);
        $I->fillField(\CurrenciesPage::$Rate, $rate);
        $I->dontSeeElement(\CurrenciesPage::$TemplateForm);
        switch ($save) {
            case 'save':
                $I->click(\CurrenciesPage::$SaveButton);
                break;
            case 'saveexit':
                $I->click(\CurrenciesPage::$SaveAndExitButton);
                break;
        }
    }    
    
    function EditCurrency($name,$isocode,$symbol,$rate,$template=null,$format,$delimTens=null,$delimThousands=null,$amount=null,$notNull='off',$save='save')
    {
        $I = $this;
        $I->amOnPage('/admin/components/run/shop/currencies');
        $I->click('.//*[@id="currency_tr1"]/td[2]/a');
        $I->waitForElement('.//*[@id="mod_name"]/label');
        $I->fillField(\CurrenciesPage::$NameCurrencyEdit, $name);
        $I->fillField(\CurrenciesPage::$IsoCodEdit, $isocode);
        $I->fillField(\CurrenciesPage::$SymbolEdit, $symbol);
        $I->fillField(\CurrenciesPage::$Rate, $rate);        
        if(isset($template)){
            $I->selectOption(\CurrenciesPage::$CurrencyTemplate, $template);
            $text=$I->grabTextFrom(\CurrenciesPage::$CurrencyTemplate."/option[$template]");
            $I->comment($text);
        }
        if(isset($format)){
            $I->fillField(\CurrenciesPage::$FormatLine, $format);
        }
        if(isset($delimTens)){
            $I->fillField(\CurrenciesPage::$DelimiterTens, $delimTens);
        }
        if(isset($delimThousands)){
            $I->fillField(\CurrenciesPage::$DelimiterThousands, $delimThousands);
        }
        if(isset($amount)){
            $I->fillField(\CurrenciesPage::$AmountDecimals, $amount);
        }
        switch ($notNull) {
            case 'off':
                $I->dontSeeCheckboxIsChecked(\CurrenciesPage::$NotNullsCheckbox);
                break;
            case 'on':
                $I->checkOption(\CurrenciesPage::$NotNullsCheckbox);
                $I->wait('1');
                $I->seeCheckboxIsChecked(\CurrenciesPage::$NotNullsCheckbox);
                break;
        }
        $I->wait('3');
        switch ($save) {
            case 'save':
                $I->click(\CurrenciesPage::$SaveButton);
                break;
            case 'saveexit':
                $I->click(\CurrenciesPage::$SaveAndExitButton);
                break;
        }
    }
    
    function CheckInFields($name1,$isocode1,$symbol1,$rate1,$format1,$delimTens1,$delimThousands1,$amount1,$notNull1="off")
    {
        $I = $this;
        $I->waitForText('Редактирование валют');
        $I->wait('1');
        $I->seeElement(\CurrenciesPage::$TemplateForm);
        $I->seeInField(\CurrenciesPage::$NameCurrencyEdit, $name1);
        $I->seeInField(\CurrenciesPage::$IsoCodEdit, $isocode1);
        $I->seeInField(\CurrenciesPage::$SymbolEdit, $symbol1);
        $I->seeInField(\CurrenciesPage::$Rate, $rate1);
        $I->seeOptionIsSelected(\CurrenciesPage::$CurrencyTemplate, 'Не выбрано');
        $I->seeInField(\CurrenciesPage::$FormatLine, $format1);
        $I->seeInField(\CurrenciesPage::$DelimiterTens, $delimTens1);
        $I->seeInField(\CurrenciesPage::$DelimiterThousands, $delimThousands1);
        $I->seeInField(\CurrenciesPage::$AmountDecimals, $amount1);
        switch ($notNull1) {
            case 'off':
                $I->dontSeeCheckboxIsChecked(\CurrenciesPage::$NotNullsCheckbox);
                break;
            case 'on':
                $I->seeCheckboxIsChecked(\CurrenciesPage::$NotNullsCheckbox);
                break;
        }
    }
    
    function CheckInListLanding($name1,$isocode1,$symbol1)
    {
        $I = $this;
        $I->wait('3');
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
    
    function CheckInFrontEnd($name1,$isocode1,$symbol1)
    {
        $I = $this;
        $I->wait('3');
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
    
       
    function SearchMainCurrencyLine()
    {
        $I = $this;
        $I->amOnPage(\CurrenciesPage::$URL);
        $rows = $I->grabTagCount($I,"tbody tr");
        $I->comment("$rows");
        //Определение строчки главной валюты
        for ($j=1;$j<$rows;++$j){
            //Поиск атрибута checked для радиоточки
            $atribCheck = $I->grabAttributeFrom(\CurrenciesPage::RadioButtonLine($j),"checked");
                if($atribCheck == TRUE){
                break;
            }
        }
        $I->comment("Main Currency Line: $j");
        return "$j";
    }
    
    
    function CreateProduct($name,$price,$j)
    {
        $I = $this;
        $I->amOnPage('/admin/components/run/shop/products/create');
        $I->waitForText('Создание товара');        
        $I->fillField(\ProductsPage::$NameProduct, $name);
        $I->fillField(\ProductsPage::$Price, "$price");
        $I->click(\ProductsPage::$Currency);
//        $I->selectOption(\ProductsPage::$Currency, $j);
//        $I->click(\ProductsPage::$Currency);
        $I->click(\ProductsPage::$Currency."/option[$j]");
        $I->wait('1');
        $IsoProduct=$I->grabTextFrom(\ProductsPage::$Currency."/option[$j]");
        $I->comment("$IsoProduct");
        $I->click(\CurrenciesPage::$SaveButton);
        $I->waitForText($name, 4, ".//*[@id='mainContent']/section/div/div[1]/span[2]");
        return $IsoProduct;
    }
    
    
    function DeleteWindowOperation($y,$button='delete')
    {
        $I = $this;
        $I->click(\CurrenciesPage::DeleteButtonLine($y));
        $I->waitForElement(\CurrenciesPage::$DeleteWindow);
        $I->see('Удалить валюту');
        $I->see('Удалить выбранную валюту?');
        $I->see('Удалить', \CurrenciesPage::$DeleteButtonWindow);
        $I->see('Отменить', \CurrenciesPage::$CancelButtonWindow);
        switch ($button) {
            case 'delete':
                $I->click(\CurrenciesPage::$DeleteButtonWindow);
                break;
            case 'cancel':
                $I->click(\CurrenciesPage::$CancelButtonWindow);
                break;
        }        
    }
}