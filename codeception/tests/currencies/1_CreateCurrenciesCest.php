<?php
use \CurrenciesTester;

class CreateCurrenciesCest
{
//    public function _before()
//    {
//    }
//
//    public function _after()
//    {
//    }

    public function Autorization(CurrenciesTester $I)
    {
        InitTest::Login($I);
        $I->amOnPage("/admin/components/run/shop/currencies");
        $I->waitForText("Список валют", "10", "//*[@id='mainContent']/section/div[1]/div[1]/span[2]");
    }
    
    
    public function NamesInCreate(CurrenciesTester $I)
    {
        $I->amOnPage("/admin/components/run/shop/currencies");
        $rows = $I->grabTagCount($I,"tbody tr");
        $I->comment("$rows");
        //Определение строчки главной валюты
        for ($j=1;$j<$rows;++$j){
            //Поиск атрибута checked для радиоточки
            $atribCheck = $I->grabAttributeFrom("//tbody/tr[$j]/td[5]/input","checked");
                if($atribCheck == TRUE){
                break;
            }
        }
        $SymbolMainCur=$I->grabTextFrom(".//*[@class='']/tr[$j]/td[4]");
        $I->click(CurrenciesPage::$CreateCurrencyButton);
        $I->waitForElement('.//*[@id="mod_name"]/label');
        $I->see('Создание валюты', 'span.title');
        $I->see('Свойства', './/*[@id="cur_cr_form"]/table/thead/tr/th');
        $I->see('Название:', './/*[@id="cur_cr_form"]/table/tbody/tr/td/div/div[1]/label');
        $I->see('ISO Код:', './/*[@id="cur_cr_form"]/table/tbody/tr/td/div/div[2]/label');
        $I->see('Символ:', './/*[@id="cur_cr_form"]/table/tbody/tr/td/div/div[3]/label');
        $I->see('Курс валюты:', './/*[@id="mod_name"]/label');
        $I->see('(Например: USD)', './/*[@id="cur_cr_form"]/table/tbody/tr/td/div/div[2]/div/p');
        $I->see('(Например: $)', './/*[@id="cur_cr_form"]/table/tbody/tr/td/div/div[3]/div/p');
        $I->see("= 1.000 $SymbolMainCur", './/*[@id="mod_name"]/div/p');
        $I->see('Вернуться', CurrenciesPage::$GoBackButton);
        $I->see('Создать', CurrenciesPage::$SaveButton);
        $I->see('Создать и выйти', CurrenciesPage::$SaveAndExitButton);
    }
    
    
    public function RequiredFieldsSaveButtonInCreate(CurrenciesTester $I)
    {
        $I->amOnPage('/admin/components/run/shop/currencies/create');
        $I->click(CurrenciesPage::$SaveButton);
        $I->see('Это поле обязательное.', './/*[@id="cur_cr_form"]/table/tbody/tr/td/div/div[1]/div/label');
        $I->see('Это поле обязательное.', './/*[@id="cur_cr_form"]/table/tbody/tr/td/div/div[2]/div/label');
        $I->see('Это поле обязательное.', './/*[@id="cur_cr_form"]/table/tbody/tr/td/div/div[3]/div/label');
        $I->see('Это поле обязательное.', './/*[@id="mod_name"]/div/label');
        $I->click(CurrenciesPage::$GoBackButton);
        $I->waitForText('Список валют');
        InitTest::ClearAllCach($I);
    }
    
    
    public function RequiredFieldsSaveAndExitButtonInCreate(CurrenciesTester $I)
    {
        $I->amOnPage('/admin/components/run/shop/currencies/create');
        $I->click(CurrenciesPage::$SaveAndExitButton);
        $I->see('Это поле обязательное.', './/*[@id="cur_cr_form"]/table/tbody/tr/td/div/div[1]/div/label');
        $I->see('Это поле обязательное.', './/*[@id="cur_cr_form"]/table/tbody/tr/td/div/div[2]/div/label');
        $I->see('Это поле обязательное.', './/*[@id="cur_cr_form"]/table/tbody/tr/td/div/div[3]/div/label');
        $I->see('Это поле обязательное.', './/*[@id="mod_name"]/div/label');
    }
    
    
    public function TypesOfSymbolsInCreate(CurrenciesTester $I)
    {
        $I->amOnPage('/admin/components/run/shop/currencies/create');
        $I->fillField(CurrenciesPage::$NameCurrencyCreate, 'йццукsadasd123324?"{{$&(+|!@.,;:ADFФЦВ');
        $I->fillField(CurrenciesPage::$IsoCodCreate, 'йццукsadasd123324?"{{$&(+|!@.,;:ADFФЦВ');
        $I->fillField(CurrenciesPage::$SymbolCreate, 'йццукsadasd123324?"{{$&(+|!@.,;:ADFФЦВ');
        $I->fillField(CurrenciesPage::$Rate, 'qwweйЫВSDFцук!"№;№%%:??*()_1ЮБ.,7653423');
        $I->seeInField(CurrenciesPage::$NameCurrencyCreate, 'йццукsadasd123324?"{{$&(+|!@.,;:ADFФЦВ');
        $I->seeInField(CurrenciesPage::$IsoCodCreate, 'йццукsadasd123324?"{{$&(+|!@.,;:ADFФЦВ');
        $I->seeInField(CurrenciesPage::$SymbolCreate, 'йццукsadasd123324?"{{$&(+|!@.,;:ADFФЦВ');
        $I->seeInField(CurrenciesPage::$Rate, '1.7653423');
    }
    
    /**
     * @guy CurrenciesTester\CurrenciesSteps
     */
    
    public function OneAnd2SymbolsCreate(CurrenciesTester\CurrenciesSteps $I)
    {
        $name="q";
        $isocode="q";
        $symbol="q";
        $rate="1";
        $I->CreateCurrency($name,$isocode,$symbol,$rate);        
        $I->waitForElementVisible('.alert.in.fade.alert-error');
        $I->see('Поле Название должно быть не менее 2 символов в длину.');
        $I->waitForElementNotVisible('.alert.in.fade.alert-error');        
        $I->appendField(CurrenciesPage::$NameCurrencyCreate, 'q');
        $I->click(CurrenciesPage::$SaveButton);
        $I->waitForElementVisible('.alert.in.fade.alert-success');
        $I->see('Валюта создана');
        $I->waitForElementNotVisible('.alert.in.fade.alert-success');
        $name1="qq";
        $isocode1="q";
        $symbol1="q";
        $rate1="1.0000";
        $I->CheckInFields($name1,$isocode1,$symbol1,$rate1);
        $I->click(CurrenciesPage::$GoBackButton);                
        $I->CheckInListLanding($name1,$isocode1,$symbol1);
        InitTest::ClearAllCach($I);
    }
    
    /**
     * @guy CurrenciesTester\CurrenciesSteps
     */
    
    public function Symbols5Create(CurrenciesTester\CurrenciesSteps $I)
    {
        $name="Динар";
        $isocode="Динар";
        $symbol="Динар";
        $rate="11111";
        $I->CreateCurrency($name,$isocode,$symbol,$rate);      
        $I->waitForElementVisible('.alert.in.fade.alert-success');
        $I->see('Валюта создана');
        $I->waitForElementNotVisible('.alert.in.fade.alert-success');
        $name1="Динар";
        $isocode1="Динар";
        $symbol1="Динар";
        $rate1="11111.0000";
        $I->CheckInFields($name1,$isocode1,$symbol1,$rate1);
        $I->click(CurrenciesPage::$GoBackButton);                
        $I->CheckInListLanding($name1,$isocode1,$symbol1);
    }
    
    /**
     * @guy CurrenciesTester\CurrenciesSteps
     */
    
    public function Symbols6Create(CurrenciesTester\CurrenciesSteps $I)
    {
        $name="тугрик";
        $isocode="тугрик";
        $symbol="тугрик";
        $rate="111111";
        $I->CreateCurrency($name,$isocode,$symbol,$rate);        
        $I->waitForElementVisible('.alert.in.fade.alert-error');
        $I->see('Поле Iso Код не может превышать 5 символов в длину.');
        $I->see('Поле Символ не может превышать 5 символов в длину.');
        $I->waitForElementNotVisible('.alert.in.fade.alert-error');
        $I->fillField(CurrenciesPage::$IsoCodCreate, 'тугри');
        $I->click(CurrenciesPage::$SaveButton);
        $I->waitForElementVisible('.alert.in.fade.alert-error');
        $I->see('Поле Символ не может превышать 5 символов в длину.');
        $I->waitForElementNotVisible('.alert.in.fade.alert-error');
        $I->fillField(CurrenciesPage::$IsoCodCreate, 'тугрик');
        $I->fillField(CurrenciesPage::$SymbolCreate, 'тугри');
        $I->click(CurrenciesPage::$SaveButton);
        $I->waitForElementVisible('.alert.in.fade.alert-error');
        $I->see('Поле Iso Код не может превышать 5 символов в длину.');
        $I->waitForElementNotVisible('.alert.in.fade.alert-error');
        $I->fillField(CurrenciesPage::$IsoCodCreate, 'тугри');
        $I->click(CurrenciesPage::$SaveButton);
        $I->waitForElementVisible('.alert.in.fade.alert-success');
        $I->see('Валюта создана');
        $I->waitForElementNotVisible('.alert.in.fade.alert-success');
        $name1="тугрик";
        $isocode1="тугри";
        $symbol1="тугри";
        $rate1="111111.0000";
        $I->CheckInFields($name1,$isocode1,$symbol1,$rate1);
        $I->click(CurrenciesPage::$GoBackButton);               
        $I->CheckInListLanding($name1,$isocode1,$symbol1);
        InitTest::ClearAllCach($I);
    }
    
    /**
     * @guy CurrenciesTester\CurrenciesSteps
     */
    
    public function Symbols10Create(CurrenciesTester\CurrenciesSteps $I)
    {
        $name="Гульден123";
        $isocode="Гульден123";
        $symbol="Гульден123";
        $rate="111112.1233";
        $I->CreateCurrency($name,$isocode,$symbol,$rate);       
        $I->waitForElementVisible('.alert.in.fade.alert-error');
        $I->see('Поле Iso Код не может превышать 5 символов в длину.');
        $I->see('Поле Символ не может превышать 5 символов в длину.');
        $I->waitForElementNotVisible('.alert.in.fade.alert-error');
        $I->fillField(CurrenciesPage::$IsoCodCreate, 'Гульд');
        $I->click(CurrenciesPage::$SaveButton);
        $I->waitForElementVisible('.alert.in.fade.alert-error');
        $I->see('Поле Символ не может превышать 5 символов в длину.');
        $I->waitForElementNotVisible('.alert.in.fade.alert-error');
        $I->fillField(CurrenciesPage::$IsoCodCreate, 'Гульден123');
        $I->fillField(CurrenciesPage::$SymbolCreate, 'Гульд');
        $I->click(CurrenciesPage::$SaveButton);
        $I->waitForElementVisible('.alert.in.fade.alert-error');
        $I->see('Поле Iso Код не может превышать 5 символов в длину.');
        $I->waitForElementNotVisible('.alert.in.fade.alert-error');
        $I->fillField(CurrenciesPage::$IsoCodCreate, 'Гульд');
        $I->click(CurrenciesPage::$SaveButton);
        $I->waitForElementVisible('.alert.in.fade.alert-success');
        $I->see('Валюта создана');
        $I->waitForElementNotVisible('.alert.in.fade.alert-success');
        $name1="Гульден123";
        $isocode1="Гульд";
        $symbol1="Гульд";
        $rate1="111112.1233";
        $I->CheckInFields($name1,$isocode1,$symbol1,$rate1);
        $I->click(CurrenciesPage::$GoBackButton);               
        $I->CheckInListLanding($name1,$isocode1,$symbol1);
    }
    
    /**
     * @guy CurrenciesTester\CurrenciesSteps
     */
    
    public function Symbols255Create(CurrenciesTester\CurrenciesSteps $I)
    {
        $name="Франкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранк";
        $isocode="frank";
        $symbol="fr";
        $rate=".234";
        $I->CreateCurrency($name,$isocode,$symbol,$rate);
        $I->waitForElementVisible('.alert.in.fade.alert-success');
        $I->see('Валюта создана');
        $I->waitForElementNotVisible('.alert.in.fade.alert-success');
        $name1="Франкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранк";
        $isocode1="frank";
        $symbol1="fr";
        $rate1="0.2340";
        $I->CheckInFields($name1,$isocode1,$symbol1,$rate1);
        $I->click(CurrenciesPage::$GoBackButton);                
        $I->CheckInListLanding($name1,$isocode1,$symbol1);
        InitTest::ClearAllCach($I);
    }
    
    /**
     * @guy CurrenciesTester\CurrenciesSteps
     */
    
    public function Symbols256Create(CurrenciesTester\CurrenciesSteps $I)
    {
        $name="Форинтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфори";
        $isocode="forin";
        $symbol="фор";
        $rate="00120.0102";
        $I->CreateCurrency($name,$isocode,$symbol,$rate);     
        $I->waitForElementVisible('.alert.in.fade.alert-success');
        $I->see('Валюта создана');
        $I->waitForElementNotVisible('.alert.in.fade.alert-success');
        $name1="Форинтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфор";
        $isocode1="forin";
        $symbol1="фор";
        $rate1="120.0102";
        $I->CheckInFields($name1,$isocode1,$symbol1,$rate1);
        $I->click(CurrenciesPage::$GoBackButton);                
        $I->CheckInListLanding($name1,$isocode1,$symbol1);
    }
    
    /**
     * @guy CurrenciesTester\CurrenciesSteps
     */
    
    public function CreateAndExitButton(CurrenciesTester\CurrenciesSteps $I)
    {
        $name="лира";
        $isocode="лира";
        $symbol="лира";
        $rate="01030.2";
        $save="saveexit";
        $I->CreateCurrency($name,$isocode,$symbol,$rate,$save);
        $I->waitForElementVisible('.alert.in.fade.alert-success');
        $I->see('Валюта создана');
        $I->waitForElementNotVisible('.alert.in.fade.alert-success');
        $I->waitForText('Список валют'); 
        $name1="лира";
        $isocode1="лира";
        $symbol1="лира";
        $rate1="1030.2000";
        $I->CheckInListLanding($name1,$isocode1,$symbol1);
        $I->click(CurrenciesPage::CurrencyNameLine("last()"));       
        $I->CheckInFields($name1,$isocode1,$symbol1,$rate1);
        InitTest::ClearAllCach($I);
    }
}