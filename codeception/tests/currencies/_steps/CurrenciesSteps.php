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
    
    function EditCurrency($j,$name=null,$isocode=null,$symbol=null,$rate=null,$template=null,$amount=null,$notNull='off',$save='save')
    {
        $I = $this;
        $I->amOnPage(\CurrenciesPage::$URL);
        $I->wait("2");
        $I->click(\CurrenciesPage::CurrencyNameLine($j));
        $I->waitForElement('.//*[@id="mod_name"]/label');
        if(isset($name)){
            $I->fillField(\CurrenciesPage::$NameCurrencyEdit, $name);
        }
        if(isset($isocode)){
            $I->fillField(\CurrenciesPage::$IsoCodEdit, $isocode);
        }
        if(isset($symbol)){
            $I->fillField(\CurrenciesPage::$SymbolEdit, $symbol);
        }
        if(isset($rate)){
            $I->fillField(\CurrenciesPage::$Rate, $rate);        
        }
        if(isset($template)){
            $I->click(\CurrenciesPage::$CurrencyTemplateSelect);
//            $I->click(\CurrenciesPage::$CurrencyTemplateSelect."/option[$template]");
            $text=$I->grabTextFrom(\CurrenciesPage::$CurrencyTemplateSelect."/option[$template]");
            $I->comment($text);
            $I->click(\CurrenciesPage::$CurrencyTemplateSelect."/option[$template]");
            $I->wait('2');
            $I->seeOptionIsSelected(\CurrenciesPage::$CurrencyTemplateSelect, $text);
            
        }        
        if(isset($amount)){
            $I->click(\CurrenciesPage::$AmountDecimalsSelect);
            $I->selectOption(\CurrenciesPage::$AmountDecimalsSelect, $amount);
        }
        switch ($notNull) {
            case 'off':
                $check=$I->grabAttributeFrom(\CurrenciesPage::$NotNullsCheckbox.'/input', 'checked');
                $I->comment("$check");
                if($check==true){
                    $I->click(\CurrenciesPage::$NotNullsCheckbox);
                    $I->wait('1');
                    $I->dontSeeCheckboxIsChecked(\CurrenciesPage::$NotNullsCheckbox.'/input');
                    break;
                }
                else{
                    $I->dontSeeCheckboxIsChecked(\CurrenciesPage::$NotNullsCheckbox.'/input');
                    break;
                }
                break;
            case 'on':
                $check=$I->grabAttributeFrom(\CurrenciesPage::$NotNullsCheckbox.'/input', 'checked');
                $I->comment("$check");
                if($check==false){
                    $I->click(\CurrenciesPage::$NotNullsCheckbox);
                    $I->wait('1');
                    $I->seeCheckboxIsChecked(\CurrenciesPage::$NotNullsCheckbox.'/input');
                    break;
                }
                else{
                    $I->seeCheckboxIsChecked(\CurrenciesPage::$NotNullsCheckbox.'/input');
                    break;
                }
                break;
//            case 'onCheck':                
//                $I->seeCheckboxIsChecked(\CurrenciesPage::$NotNullsCheckbox);
//                break;
//            case 'off':
//                $I->click(\CurrenciesPage::$NotNullsCheckbox);
//                $I->wait('1');
//                $I->dontSeeCheckboxIsChecked(\CurrenciesPage::$NotNullsCheckbox);
//                break;
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
        if(isset($template)){
            return $text;
        }
    }
    
    function CheckInFields($name1=null,$isocode1=null,$symbol1=null,$rate1=null,$templateText=null,$amount1=null,$notNull1="off")
    {
        $I = $this;
        $I->waitForText('Редактирование валют');
        $I->wait('3');
        $I->seeElement(\CurrenciesPage::$TemplateForm);
        if(isset($name1)){
            $I->seeInField(\CurrenciesPage::$NameCurrencyEdit, $name1);
        }
        if(isset($isocode1)){
            $I->seeInField(\CurrenciesPage::$IsoCodEdit, $isocode1);
        }
        if(isset($symbol1)){
            $I->seeInField(\CurrenciesPage::$SymbolEdit, $symbol1);
        }
        if(isset($rate1)){
            $I->seeInField(\CurrenciesPage::$Rate, $rate1);
        }
        if(isset($templateText)){
            $I->seeOptionIsSelected(\CurrenciesPage::$CurrencyTemplateSelect, $templateText); 
        }
        if(isset($amount1)){
            $I->seeOptionIsSelected(\CurrenciesPage::$AmountDecimalsSelect, $amount1);
        }
        switch ($notNull1) {
            case 'off':
                $I->dontSeeCheckboxIsChecked(\CurrenciesPage::$NotNullsCheckbox.'/input');
                break;
            case 'on':
                $I->seeCheckboxIsChecked(\CurrenciesPage::$NotNullsCheckbox.'/input');
                break;
        }
    }
    
    function CheckInListLanding($name1,$isocode1,$symbol1)
    {
        $I = $this;
        $I->wait('3');
        $I->see($name1, \CurrenciesPage::CurrencyNameLine('last()'));
        $I->see($isocode1, \CurrenciesPage::IsoCodeLine('last()'));
        $I->see($symbol1, \CurrenciesPage::SymbolCurrencyLine('last()'));
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
        $rows = $I->grabCCSAmount($I,".btn.btn-small.btn-danger");
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
    
    
    function CreateProduct($name,$price,$j=null)
    {
        $I = $this;
        $I->amOnPage('/admin/components/run/shop/products/create');
        $I->waitForText('Создание товара');        
        $I->fillField(\ProductsPage::$NameProduct, $name);
        $I->fillField(\ProductsPage::$Price, "$price");
        if(isset($j)){
            $I->click(\ProductsPage::$Currency);
    //        $I->selectOption(\ProductsPage::$Currency, $j);
    //        $I->click(\ProductsPage::$Currency);
            $I->click(\ProductsPage::$Currency."/option[$j]");
            $I->wait('1');
            $IsoProduct=$I->grabTextFrom(\ProductsPage::$Currency."/option[$j]");
            $I->comment("$IsoProduct");
        }
        $I->click(\CurrenciesPage::$SaveButton);
        $I->waitForText($name, 6, ".//*[@id='mainContent']/section/div/div[1]/span[2]");
        if(isset($j)){
            return $IsoProduct;
        }
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
    
    
    function CheckProductCart($firMain,$secMain,$firADD=null,$secADD=null)
    {
        $I = $this;
        $TextCart=$I->grabTextFrom(\CurrenciesPage::$CartInfo);
        $I->comment($TextCart);
        if($TextCart=='0'){
//            break;
        }
        else{
            $I->click(\CurrenciesPage::$CartButton);
            $I->wait('2');
            for($i=1;$i<=$TextCart;$i++){
                $I->click(\CurrenciesPage::$CartDeleteProductButton);
                $I->wait('2');
            }
            $I->waitForText('Ваша корзина пуста');
            $I->click(\CurrenciesPage::$CloseCartButton);
            $I->waitForElementNotVisible(\CurrenciesPage::$CartForm);
//            break;
        }
        $I->click(\CurrenciesPage::$FirstProductSearching);
        $I->waitForElement(\CurrenciesPage::$CardForm);
//        $I->seeInCurrentUrl("//shop/product/$name");
        $I->see($firMain, \CurrenciesPage::$MainFirstPlaceCard);
        $I->see($secMain, \CurrenciesPage::$MainSecondPlaceCard);
        if(isset($firADD)){
            $I->see($firADD, \CurrenciesPage::$AdditFirstPlaceCard);
        }
        if(isset($secADD)){
            $I->see($secADD, \CurrenciesPage::$AdditSecondPlaceCard);
        }
        $I->wait('3');
        $I->click(\CurrenciesPage::$BuyCardButton);
        $I->waitForElement(\CurrenciesPage::$CloseCartButton);
        $I->see($firMain, \CurrenciesPage::$MainFirstPlaceSum);
        $I->see($secMain, \CurrenciesPage::$MainSecondPlaceSum);
        $I->see($firMain, \CurrenciesPage::$MainFirstCart);
        $I->see($secMain, \CurrenciesPage::$MainSecondCart);
        if(isset($firADD)){
            $I->see($firADD, \CurrenciesPage::$AdditFirstCart);
        }
        if(isset($secADD)){
            $I->see($secADD, \CurrenciesPage::$AdditSecondCart);
        }
        $I->wait('3');
        $I->click(\CurrenciesPage::$ExecuteOrderCardButton);
        $I->waitForText('Оформление заказа');
        $I->see($firMain, \CurrenciesPage::$MainFirstProductExecuteOrdering);
        $I->see($secMain, \CurrenciesPage::$MainSecondProductExecuteOrdering);
        $I->see($firMain, \CurrenciesPage::$MainFirstCostProductsExecuteOrdering);
        $I->see($secMain, \CurrenciesPage::$MainSecondCostProductsExecuteOrdering);
        $I->see($firMain, \CurrenciesPage::$MainFirstSumExecuteOrdering);
        $I->see($secMain, \CurrenciesPage::$MainSecondSumExecuteOrdering);
        if(isset($firADD)){
            $I->see($firADD, \CurrenciesPage::$AdditFirstSumExecuteOrdering);
        }
        if(isset($secADD)){
            $I->see($secADD, \CurrenciesPage::$AdditSecondSumExecuteOrdering);
        }
        $I->fillField(\CurrenciesPage::$PhoneField, '111111111111');
        $I->wait('3');
        $I->click(\CurrenciesPage::$SubmitOrderButton);
        $I->waitForText('Заказ');
        $I->see($firMain, \CurrenciesPage::$MainFirstProductOrderFinish);
        $I->see($secMain, \CurrenciesPage::$MainSecondProductOrderFinish);
        $I->see($firMain, \CurrenciesPage::$MainFirstCostProductsOrderFinish);
        $I->see($secMain, \CurrenciesPage::$MainSecondCostProductsOrderFinish);
        $I->see($firMain, \CurrenciesPage::$MainFirstSumOrderFinish);
        $I->see($secMain, \CurrenciesPage::$MainSecondSumOrderFinish);
        if(isset($firADD)){
            $I->see($firADD, \CurrenciesPage::$AdditFirstSumOrderFinish);
        }
        if(isset($secADD)){
            $I->see($secADD, \CurrenciesPage::$AdditSecondSumOrderFinish);
        }
    }
}