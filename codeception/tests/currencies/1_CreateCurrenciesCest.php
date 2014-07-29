<?php
use \AcceptanceTester;

class CreateCurrenciesCest
{
//    public function _before()
//    {
//    }
//
//    public function _after()
//    {
//    }

    public function Autorization(AcceptanceTester $I)
    {
        InitTest::Login($I);
        $I->amOnPage("/admin/components/run/shop/currencies");
        $I->waitForText("Список валют", "10", "//*[@id='mainContent']/section/div[1]/div[1]/span[2]");
    }
    
    
    public function NamesInCreate(AcceptanceTester $I)
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
    
    
    public function RequiredFieldsSaveButtonInCreate(AcceptanceTester $I)
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
    
    
    public function RequiredFieldsSaveAndExitButtonInCreate(AcceptanceTester $I)
    {
        $I->amOnPage('/admin/components/run/shop/currencies/create');
        $I->click(CurrenciesPage::$SaveAndExitButton);
        $I->see('Это поле обязательное.', './/*[@id="cur_cr_form"]/table/tbody/tr/td/div/div[1]/div/label');
        $I->see('Это поле обязательное.', './/*[@id="cur_cr_form"]/table/tbody/tr/td/div/div[2]/div/label');
        $I->see('Это поле обязательное.', './/*[@id="cur_cr_form"]/table/tbody/tr/td/div/div[3]/div/label');
        $I->see('Это поле обязательное.', './/*[@id="mod_name"]/div/label');
    }
    
    
    public function TypesOfSymbolsInCreate(AcceptanceTester $I)
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
    
    
    public function OneAnd2SymbolsCreate(AcceptanceTester $I)
    {
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
        InitTest::ClearAllCach($I);
    }
    
    
    public function Symbols5Create(AcceptanceTester $I)
    {
        $I->amOnPage('/admin/components/run/shop/currencies/create');
        $I->fillField(CurrenciesPage::$NameCurrencyCreate, 'Динар');
        $I->fillField(CurrenciesPage::$IsoCodCreate, 'Динар');
        $I->fillField(CurrenciesPage::$SymbolCreate, 'Динар');
        $I->fillField(CurrenciesPage::$Rate, '11111');
        $I->click(CurrenciesPage::$SaveButton);
        $I->waitForElementVisible('.alert.in.fade.alert-success');
        $I->see('Валюта создана');
        $I->waitForElementNotVisible('.alert.in.fade.alert-success');
        $I->seeInField(CurrenciesPage::$NameCurrencyEdit, 'Динар');
        $I->seeInField(CurrenciesPage::$IsoCodEdit, 'Динар');
        $I->seeInField(CurrenciesPage::$SymbolEdit, 'Динар');
        $I->seeInField(CurrenciesPage::$Rate, '11111.0000');
        $I->click(CurrenciesPage::$GoBackButton);        
    }
    
    
    public function Symbols6Create(AcceptanceTester $I)
    {
        $I->amOnPage('/admin/components/run/shop/currencies/create');
        $I->fillField(CurrenciesPage::$NameCurrencyCreate, 'тугрик');
        $I->fillField(CurrenciesPage::$IsoCodCreate, 'тугрик');
        $I->fillField(CurrenciesPage::$SymbolCreate, 'тугрик');
        $I->fillField(CurrenciesPage::$Rate, '111111');
        $I->click(CurrenciesPage::$SaveButton);
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
        $I->waitForText('Редактирование валют');
        $I->seeInField(CurrenciesPage::$NameCurrencyEdit, 'тугрик');
        $I->seeInField(CurrenciesPage::$IsoCodEdit, 'тугри');
        $I->seeInField(CurrenciesPage::$SymbolEdit, 'тугри');
        $I->seeInField(CurrenciesPage::$Rate, '111111.0000');
        InitTest::ClearAllCach($I);
    }
    
    
    public function Symbols10Create(AcceptanceTester $I)
    {
        $I->amOnPage('/admin/components/run/shop/currencies/create');
        $I->fillField(CurrenciesPage::$NameCurrencyCreate, 'Гульден123');
        $I->fillField(CurrenciesPage::$IsoCodCreate, 'Гульден123');
        $I->fillField(CurrenciesPage::$SymbolCreate, 'Гульден123');
        $I->fillField(CurrenciesPage::$Rate, '111112.1233');
        $I->click(CurrenciesPage::$SaveButton);
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
        $I->waitForText('Редактирование валют');
        $I->seeInField(CurrenciesPage::$NameCurrencyEdit, 'Гульден123');
        $I->seeInField(CurrenciesPage::$IsoCodEdit, 'Гульд');
        $I->seeInField(CurrenciesPage::$SymbolEdit, 'Гульд');
        $I->seeInField(CurrenciesPage::$Rate, '111112.1233');     
    }
    
    
    public function Symbols255Create(AcceptanceTester $I)
    {
        $I->amOnPage('/admin/components/run/shop/currencies/create');
        $I->fillField(CurrenciesPage::$NameCurrencyCreate, 'Франкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранк');
        $I->fillField(CurrenciesPage::$IsoCodCreate, 'frank');
        $I->fillField(CurrenciesPage::$SymbolCreate, 'fr');
        $I->fillField(CurrenciesPage::$Rate, '.234');
        $I->click(CurrenciesPage::$SaveButton);
        $I->waitForElementVisible('.alert.in.fade.alert-success');
        $I->see('Валюта создана');
        $I->waitForElementNotVisible('.alert.in.fade.alert-success');
        $I->seeInField(CurrenciesPage::$NameCurrencyEdit, 'Франкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранк');
        $I->seeInField(CurrenciesPage::$IsoCodEdit, 'frank');
        $I->seeInField(CurrenciesPage::$SymbolEdit, 'fr');
        $I->seeInField(CurrenciesPage::$Rate, '0.2340');
        InitTest::ClearAllCach($I);
    }
    
    
    public function Symbols256Create(AcceptanceTester $I)
    {
        $I->amOnPage('/admin/components/run/shop/currencies/create');
        $I->fillField(CurrenciesPage::$NameCurrencyCreate, 'Форинтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфори');
        $I->fillField(CurrenciesPage::$IsoCodCreate, 'forin');
        $I->fillField(CurrenciesPage::$SymbolCreate, 'фор');
        $I->fillField(CurrenciesPage::$Rate, '00120.0102');
        $I->click(CurrenciesPage::$SaveButton);
        $I->waitForElementVisible('.alert.in.fade.alert-success');
        $I->see('Валюта создана');
        $I->waitForElementNotVisible('.alert.in.fade.alert-success');
        $I->seeInField(CurrenciesPage::$NameCurrencyEdit, 'Форинтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфор');
        $I->seeInField(CurrenciesPage::$IsoCodEdit, 'forin');
        $I->seeInField(CurrenciesPage::$SymbolEdit, 'фор');
        $I->seeInField(CurrenciesPage::$Rate, '120.0102'); 
    }
    
    
    public function CreateAndExitButton(AcceptanceTester $I)
    {
        $I->amOnPage('/admin/components/run/shop/currencies/create');
        $I->fillField(CurrenciesPage::$NameCurrencyCreate, 'лира');
        $I->fillField(CurrenciesPage::$IsoCodCreate, 'лира');
        $I->fillField(CurrenciesPage::$SymbolCreate, 'лира');
        $I->fillField(CurrenciesPage::$Rate, '01030.2');
        $I->click(CurrenciesPage::$SaveAndExitButton);
        $I->waitForElementVisible('.alert.in.fade.alert-success');
        $I->see('Валюта создана');
        $I->waitForElementNotVisible('.alert.in.fade.alert-success');
        $I->waitForText('Список валют');
        $text=$I->grabTextFrom('.//*[@id="mainContent"]/section/div[2]/div/form/table/tbody/tr[last()]/td[1]');
        $I->see('лира', './/*[@id="mainContent"]/section/div[2]/div/form/table/tbody/tr[last()]/td[2]/a');
        $I->see('лира', './/*[@id="mainContent"]/section/div[2]/div/form/table/tbody/tr[last()]/td[3]');
        $I->see('лира', './/*[@id="mainContent"]/section/div[2]/div/form/table/tbody/tr[last()]/td[4]');
        InitTest::ClearAllCach($I);
    }
}