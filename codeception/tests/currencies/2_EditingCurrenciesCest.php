<?php
use \AcceptanceTester;

class EditingCurrenciesCest
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
    
    
    public function NamesInEditing(AcceptanceTester $I)
    {
        $I->amOnPage('/admin/components/run/shop/currencies');
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
        $I->click('.//*[@id="currency_tr1"]/td[2]/a');
        $I->waitForElement('.//*[@id="mod_name"]/label');
        $I->see('Редактирование валют', 'span.title');
        $I->see('Свойства', '.table.table-striped.table-bordered.table-hover.table-condensed.content_big_td>thead>tr>th');
        $I->see('Название:', './/*[@id="cur_ed_form"]/table/tbody/tr/td/div/div[1]/label');
        $I->see('ISO Код:', './/*[@id="cur_ed_form"]/table/tbody/tr/td/div/div[2]/label');
        $I->see('Символ:', './/*[@id="cur_ed_form"]/table/tbody/tr/td/div/div[3]/label');
        $I->see('Курс валюты:', './/*[@id="mod_name"]/label');
        $I->see('(Например: USD)', './/*[@id="cur_ed_form"]/table/tbody/tr/td/div/div[2]/div/p');
        $I->see('(Например: $)', './/*[@id="cur_ed_form"]/table/tbody/tr/td/div/div[3]/div/p');
        $I->see("= 1.000 $SymbolMainCur", './/*[@id="mod_name"]/div/p');
        $I->see('Вернуться', CurrenciesPage::$GoBackButton);
        $I->see('Сохранить', CurrenciesPage::$SaveButton);
        $I->see('Сохранить и выйти', CurrenciesPage::$SaveAndExitButton);
    }
    
    
    public function RequiredFieldsSaveButtonInEditing(AcceptanceTester $I)
    {
        $I->amOnPage('/admin/components/run/shop/currencies');
        $I->click('.//*[@id="currency_tr1"]/td[2]/a');
        $I->waitForElement('.//*[@id="mod_name"]/label');
        $I->fillField(CurrenciesPage::$NameCurrencyEdit, '');
        $I->fillField(CurrenciesPage::$IsoCodEdit, '');
        $I->fillField(CurrenciesPage::$SymbolEdit, '');
        $I->fillField(CurrenciesPage::$Rate, '');
        $I->click(CurrenciesPage::$SaveButton);
        $I->see('Это поле обязательное.', './/*[@id="cur_ed_form"]/table/tbody/tr/td/div/div[1]/div/label');
        $I->see('Это поле обязательное.', './/*[@id="cur_ed_form"]/table/tbody/tr/td/div/div[2]/div/label');
        $I->see('Это поле обязательное.', './/*[@id="cur_ed_form"]/table/tbody/tr/td/div/div[3]/div/label');
        $I->see('Это поле обязательное.', './/*[@id="mod_name"]/div/label');
        InitTest::ClearAllCach($I);
    }
    
    
    public function RequiredFieldsSaveAndExitButtonInEditing(AcceptanceTester $I)
    {
        $I->amOnPage('/admin/components/run/shop/currencies');
        $I->click('.//*[@id="currency_tr1"]/td[2]/a');
        $I->waitForElement('.//*[@id="mod_name"]/label');
        $I->fillField(CurrenciesPage::$NameCurrencyEdit, '');
        $I->fillField(CurrenciesPage::$IsoCodEdit, '');
        $I->fillField(CurrenciesPage::$SymbolEdit, '');
        $I->fillField(CurrenciesPage::$Rate, '');
        $I->click(CurrenciesPage::$SaveAndExitButton);
        $I->see('Это поле обязательное.', './/*[@id="cur_ed_form"]/table/tbody/tr/td/div/div[1]/div/label');
        $I->see('Это поле обязательное.', './/*[@id="cur_ed_form"]/table/tbody/tr/td/div/div[2]/div/label');
        $I->see('Это поле обязательное.', './/*[@id="cur_ed_form"]/table/tbody/tr/td/div/div[3]/div/label');
        $I->see('Это поле обязательное.', './/*[@id="mod_name"]/div/label');
    }
    
    
    public function TypesOfSymbolsInEditing(AcceptanceTester $I)
    {
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
    }
    
    
    public function OneAnd2SymbolsEditing(AcceptanceTester $I)
    {
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
        InitTest::ClearAllCach($I);
    }
    
    
    public function Symbols5Editing(AcceptanceTester $I)
    {
        $I->amOnPage('/admin/components/run/shop/currencies');
        $I->click('.//*[@id="currency_tr1"]/td[2]/a');
        $I->waitForElement('.//*[@id="mod_name"]/label');
        $I->fillField(CurrenciesPage::$NameCurrencyEdit, 'Динар');
        $I->fillField(CurrenciesPage::$IsoCodEdit, 'Динар');
        $I->fillField(CurrenciesPage::$SymbolEdit, 'Динар');
        $I->fillField(CurrenciesPage::$Rate, '11111');
        $I->click(CurrenciesPage::$SaveButton);
        $I->waitForElementVisible('.alert.in.fade.alert-success');
        $I->see('Изменения сохранены');
        $I->waitForElementNotVisible('.alert.in.fade.alert-success');
        $I->seeInField(CurrenciesPage::$NameCurrencyEdit, 'Динар');
        $I->seeInField(CurrenciesPage::$IsoCodEdit, 'Динар');
        $I->seeInField(CurrenciesPage::$SymbolEdit, 'Динар');
        $I->seeInField(CurrenciesPage::$Rate, '11111.0000');
        $I->click(CurrenciesPage::$GoBackButton);
        $I->waitForText('Список валют');
        $I->see('Динар', './/*[@id="mainContent"]/section/div[2]/div/form/table/tbody/tr[1]/td[2]/a');
        $I->see('Динар', './/*[@id="mainContent"]/section/div[2]/div/form/table/tbody/tr[1]/td[3]');
        $I->see('Динар', './/*[@id="mainContent"]/section/div[2]/div/form/table/tbody/tr[1]/td[4]');
    }
    
    
    public function Symbols6Editing(AcceptanceTester $I)
    {
        $I->amOnPage('/admin/components/run/shop/currencies');
        $I->click('.//*[@id="currency_tr1"]/td[2]/a');
        $I->waitForElement('.//*[@id="mod_name"]/label');
        $I->fillField(CurrenciesPage::$NameCurrencyEdit, 'валюта');
        $I->fillField(CurrenciesPage::$IsoCodEdit, 'валюта');
        $I->fillField(CurrenciesPage::$SymbolEdit, 'валюта');
        $I->fillField(CurrenciesPage::$Rate, '111111');
        $I->click(CurrenciesPage::$SaveButton);
        $I->waitForElementVisible('.alert.in.fade.alert-error');
        $I->see('Поле Iso Код не может превышать 5 символов в длину.');
        $I->see('Поле Символ не может превышать 5 символов в длину.');
        $I->waitForElementNotVisible('.alert.in.fade.alert-error');
        $I->fillField(CurrenciesPage::$IsoCodEdit, 'валют');
        $I->click(CurrenciesPage::$SaveButton);
        $I->waitForElementVisible('.alert.in.fade.alert-error');
        $I->see('Поле Символ не может превышать 5 символов в длину.');
        $I->waitForElementNotVisible('.alert.in.fade.alert-error');
        $I->fillField(CurrenciesPage::$IsoCodEdit, 'валюта');
        $I->fillField(CurrenciesPage::$SymbolEdit, 'валют');
        $I->click(CurrenciesPage::$SaveButton);
        $I->waitForElementVisible('.alert.in.fade.alert-error');
        $I->see('Поле Iso Код не может превышать 5 символов в длину.');
        $I->waitForElementNotVisible('.alert.in.fade.alert-error');
        $I->fillField(CurrenciesPage::$IsoCodEdit, 'валют');
        $I->click(CurrenciesPage::$SaveButton);
        $I->waitForElementVisible('.alert.in.fade.alert-success');
        $I->see('Изменения сохранены');
        $I->waitForElementNotVisible('.alert.in.fade.alert-success');
        $I->waitForText('Редактирование валют');
        $I->seeInField(CurrenciesPage::$NameCurrencyEdit, 'валюта');
        $I->seeInField(CurrenciesPage::$IsoCodEdit, 'валют');
        $I->seeInField(CurrenciesPage::$SymbolEdit, 'валют');
        $I->seeInField(CurrenciesPage::$Rate, '111111.0000');
        InitTest::ClearAllCach($I);
    }
    
    
    public function Symbols10Editing(AcceptanceTester $I)
    {
        $I->amOnPage('/admin/components/run/shop/currencies');
        $I->click('.//*[@id="currency_tr1"]/td[2]/a');
        $I->waitForElement('.//*[@id="mod_name"]/label');
        $I->fillField(CurrenciesPage::$NameCurrencyEdit, 'Гульден123');
        $I->fillField(CurrenciesPage::$IsoCodEdit, 'Гульден123');
        $I->fillField(CurrenciesPage::$SymbolEdit, 'Гульден123');
        $I->fillField(CurrenciesPage::$Rate, '105236.2354');
        $I->click(CurrenciesPage::$SaveButton);
        $I->waitForElementVisible('.alert.in.fade.alert-error');
        $I->see('Поле Iso Код не может превышать 5 символов в длину.');
        $I->see('Поле Символ не может превышать 5 символов в длину.');
        $I->waitForElementNotVisible('.alert.in.fade.alert-error');
        $I->fillField(CurrenciesPage::$IsoCodEdit, 'Гульд');
        $I->click(CurrenciesPage::$SaveButton);
        $I->waitForElementVisible('.alert.in.fade.alert-error');
        $I->see('Поле Символ не может превышать 5 символов в длину.');
        $I->waitForElementNotVisible('.alert.in.fade.alert-error');
        $I->fillField(CurrenciesPage::$IsoCodEdit, 'Гульден123');
        $I->fillField(CurrenciesPage::$SymbolEdit, 'Гульд');
        $I->click(CurrenciesPage::$SaveButton);
        $I->waitForElementVisible('.alert.in.fade.alert-error');
        $I->see('Поле Iso Код не может превышать 5 символов в длину.');
        $I->waitForElementNotVisible('.alert.in.fade.alert-error');
        $I->fillField(CurrenciesPage::$IsoCodEdit, 'Гульд');
        $I->click(CurrenciesPage::$SaveButton);
        $I->waitForElementVisible('.alert.in.fade.alert-success');
        $I->see('Изменения сохранены');
        $I->waitForElementNotVisible('.alert.in.fade.alert-success');
        $I->waitForText('Редактирование валют');
        $I->seeInField(CurrenciesPage::$NameCurrencyEdit, 'Гульден123');
        $I->seeInField(CurrenciesPage::$IsoCodEdit, 'Гульд');
        $I->seeInField(CurrenciesPage::$SymbolEdit, 'Гульд');
        $I->seeInField(CurrenciesPage::$Rate, '105236.2354');      
    }
    
    
    public function Symbols255Editing(AcceptanceTester $I)
    {
        $I->amOnPage('/admin/components/run/shop/currencies');
        $I->click('.//*[@id="currency_tr1"]/td[2]/a');
        $I->waitForElement('.//*[@id="mod_name"]/label');
        $I->fillField(CurrenciesPage::$NameCurrencyEdit, 'Франкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранк');
        $I->fillField(CurrenciesPage::$IsoCodEdit, 'frank');
        $I->fillField(CurrenciesPage::$SymbolEdit, 'fr');
        $I->fillField(CurrenciesPage::$Rate, '.0210');
        $I->click(CurrenciesPage::$SaveButton);
        $I->waitForElementVisible('.alert.in.fade.alert-success');
        $I->see('Изменения сохранены');
        $I->waitForElementNotVisible('.alert.in.fade.alert-success');
        $I->seeInField(CurrenciesPage::$NameCurrencyEdit, 'Франкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранкфранк');
        $I->seeInField(CurrenciesPage::$IsoCodEdit, 'frank');
        $I->seeInField(CurrenciesPage::$SymbolEdit, 'fr');
        $I->seeInField(CurrenciesPage::$Rate, '0.0210');
        InitTest::ClearAllCach($I);
    }
    
    
    public function Symbols256Editing(AcceptanceTester $I)
    {
        $I->amOnPage('/admin/components/run/shop/currencies');
        $I->click('.//*[@id="currency_tr1"]/td[2]/a');
        $I->waitForElement('.//*[@id="mod_name"]/label');
        $I->fillField(CurrenciesPage::$NameCurrencyEdit, 'Форинтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфори');
        $I->fillField(CurrenciesPage::$IsoCodEdit, 'forin');
        $I->fillField(CurrenciesPage::$SymbolEdit, 'фор');
        $I->fillField(CurrenciesPage::$Rate, '00120.01');
        $I->click(CurrenciesPage::$SaveButton);
        $I->waitForElementVisible('.alert.in.fade.alert-success');
        $I->see('Изменения сохранены');
        $I->waitForElementNotVisible('.alert.in.fade.alert-success');
        $I->seeInField(CurrenciesPage::$NameCurrencyEdit, 'Форинтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфоринтфор');
        $I->seeInField(CurrenciesPage::$IsoCodEdit, 'forin');
        $I->seeInField(CurrenciesPage::$SymbolEdit, 'фор');
        $I->seeInField(CurrenciesPage::$Rate, '120.0100');
    }
    
    
    public function SaveAndExitButton(AcceptanceTester $I)
    {
        $I->amOnPage('/admin/components/run/shop/currencies');
        $I->click('.//*[@id="currency_tr1"]/td[2]/a');
        $I->waitForElement('.//*[@id="mod_name"]/label');
        $I->fillField(CurrenciesPage::$NameCurrencyEdit, 'Лат');
        $I->fillField(CurrenciesPage::$IsoCodEdit, 'лат');
        $I->fillField(CurrenciesPage::$SymbolEdit, 'лат');
        $I->fillField(CurrenciesPage::$Rate, '11111');
        $I->click(CurrenciesPage::$SaveAndExitButton);
        $I->waitForElementVisible('.alert.in.fade.alert-success');
        $I->see('Изменения сохранены');
        $I->waitForElementNotVisible('.alert.in.fade.alert-success');
        $I->waitForText('Список валют');
        $I->see('Лат', './/*[@id="mainContent"]/section/div[2]/div/form/table/tbody/tr[1]/td[2]/a');
        $I->see('лат', './/*[@id="mainContent"]/section/div[2]/div/form/table/tbody/tr[1]/td[3]');
        $I->see('лат', './/*[@id="mainContent"]/section/div[2]/div/form/table/tbody/tr[1]/td[4]');
        InitTest::ClearAllCach($I);
    }
    
}