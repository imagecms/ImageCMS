<?php
use \CurrenciesTester;

class EditingCurrenciesCest
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
    
    
    public function NamesInEditing(CurrenciesTester $I)
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
        $I->see('Шаблон вывода валюты', '//*[@id="cur_ed_form"]/table[2]/thead/tr/th');
        $I->see('Шаблон валюты:', '//*[@id="cur_ed_form"]/table[2]/tbody/tr/td/div/div[1]/label');
        $I->see('Строка формата:', '//*[@id="cur_ed_form"]/table[2]/tbody/tr/td/div/div[2]/label');
        $I->see('Разделитель десятков:', '//*[@id="cur_ed_form"]/table[2]/tbody/tr/td/div/div[3]/label');
        $I->see('Разделитель тысяч:', '//*[@id="cur_ed_form"]/table[2]/tbody/tr/td/div/div[4]/label');
        $I->see('Количество дясятичных знаков:', '//*[@id="cur_ed_form"]/table[2]/tbody/tr/td/div/div[5]/label');
        $I->see('Не показывать нули в дробной части:', '//*[@id="cur_ed_form"]/table[2]/tbody/tr/td/div/div[6]/label');
        $I->see('Перечень возможных кодов валют приведен в международном стандарте', '//*[@id="cur_ed_form"]/table[2]/tbody/tr/td/div/div[7]/div/p[1]');
        $I->see('Убрать показ в публичной части незначащих нулей у дробной части цены - если у вас цена 12500,00 рублей - будет отображено 12500, если у вас 12500,50 - будет отображено 12500,50.', '//*[@id="cur_ed_form"]/table[2]/tbody/tr/td/div/div[7]/div/p[2]');
    }
    
    /**
     * @guy CurrenciesTester\CurrenciesSteps
     */
    
    public function RequiredFieldsSaveButtonInEditing(CurrenciesTester\CurrenciesSteps $I)
    {
        $name="";
        $isocode="";
        $symbol="";
        $rate="";
        $I->EditCurrency($name,$isocode,$symbol,$rate);
        $I->see('Это поле обязательное.', './/*[@id="cur_ed_form"]/table/tbody/tr/td/div/div[1]/div/label');
        $I->see('Это поле обязательное.', './/*[@id="cur_ed_form"]/table/tbody/tr/td/div/div[2]/div/label');
        $I->see('Это поле обязательное.', './/*[@id="cur_ed_form"]/table/tbody/tr/td/div/div[3]/div/label');
        $I->see('Это поле обязательное.', './/*[@id="mod_name"]/div/label');
        InitTest::ClearAllCach($I);
    }
    
    /**
     * @guy CurrenciesTester\CurrenciesSteps
     */
    
    public function RequiredFieldsSaveAndExitButtonInEditing(CurrenciesTester\CurrenciesSteps $I)
    {
        $name="";
        $isocode="";
        $symbol="";
        $rate="";
        $I->EditCurrency($name,$isocode,$symbol,$rate,$save='saveexit');
        $I->see('Это поле обязательное.', './/*[@id="cur_ed_form"]/table/tbody/tr/td/div/div[1]/div/label');
        $I->see('Это поле обязательное.', './/*[@id="cur_ed_form"]/table/tbody/tr/td/div/div[2]/div/label');
        $I->see('Это поле обязательное.', './/*[@id="cur_ed_form"]/table/tbody/tr/td/div/div[3]/div/label');
        $I->see('Это поле обязательное.', './/*[@id="mod_name"]/div/label');
    }
    
    
    public function  ICMS_1458_TypesOfSymbolsInEditing(CurrenciesTester $I)
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
    
    /**
     * @guy CurrenciesTester\CurrenciesSteps
     */
    
    public function OneAnd2SymbolsEditing(CurrenciesTester\CurrenciesSteps $I)
    {
        $name="q";
        $isocode="q";
        $symbol="q";
        $rate="1";
        $I->EditCurrency($name,$isocode,$symbol,$rate);      
        $I->waitForElementVisible('.alert.in.fade.alert-error');
        $I->see('Поле Название должно быть не менее 2 символов в длину.');
        $I->waitForElementNotVisible('.alert.in.fade.alert-error');
        $I->appendField(CurrenciesPage::$NameCurrencyEdit, 'q');
        $I->click(CurrenciesPage::$SaveButton);
        //$I->waitForElementVisible('.alert.in.fade.alert-success');
        $I->waitForText('Изменения сохранены');
        //$I->waitForElementNotVisible('.alert.in.fade.alert-success');
        $name1="qq";
        $isocode1="q";
        $symbol1="q";
        $rate1="1.0000";
        $I->CheckInFields($name1,$isocode1,$symbol1,$rate1);
        $I->seeElement('//*[@id="cur_ed_form"]/table[2]');
        $I->seeElement(CurrenciesPage::$CurrencyTemplate);
        $I->seeElement(CurrenciesPage::$FormatLine);
        $I->seeElement(CurrenciesPage::$DelimiterTens);
        $I->seeElement(CurrenciesPage::$AmountDecimals);
        $I->seeElement(CurrenciesPage::$NotNullsCheckbox);
        InitTest::ClearAllCach($I);
    }
    
    /**
     * @guy CurrenciesTester\CurrenciesSteps
     */
    
    public function Symbols5Editing(CurrenciesTester\CurrenciesSteps $I)
    {
        $name="Динар";
        $isocode="Динар";
        $symbol="Динар";
        $rate="11111";
        $I->EditCurrency($name,$isocode,$symbol,$rate);
//        $I->exactlySeeAlert($I, 'success', 'Изменения сохранены');
        //$I->waitForElementVisible('.alert.in.fade.alert-success');
        $I->waitForText('Изменения сохранены', 4);
        //$I->waitForElementNotVisible('.alert.in.fade.alert-success');
        $I->wait('3');
        $name1="Динар";
        $isocode1="Динар";
        $symbol1="Динар";
        $rate1="11111.0000";
        $I->CheckInFields($name1,$isocode1,$symbol1,$rate1);
        $I->click(CurrenciesPage::$GoBackButton);
        $I->waitForText('Список валют');
        $I->see('Динар', './/*[@id="mainContent"]/section/div[2]/div/form/table/tbody/tr[1]/td[2]/a');
        $I->see('Динар', './/*[@id="mainContent"]/section/div[2]/div/form/table/tbody/tr[1]/td[3]');
        $I->see('Динар', './/*[@id="mainContent"]/section/div[2]/div/form/table/tbody/tr[1]/td[4]');
    }
    
    /**
     * @guy CurrenciesTester\CurrenciesSteps
     */
    
    public function Symbols6Editing(CurrenciesTester\CurrenciesSteps $I)
    {     
        $name="валюта";
        $isocode="валюта";
        $symbol="валюта";
        $rate="111111";
        $I->EditCurrency($name,$isocode,$symbol,$rate);
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
        //$I->waitForElementVisible('.alert.in.fade.alert-success');
        $I->waitForText('Изменения сохранены');
        //$I->waitForElementNotVisible('.alert.in.fade.alert-success');
        $name1="валюта";
        $isocode1="валют";
        $symbol1="валют";
        $rate1="111111.0000";
        $I->CheckInFields($name1,$isocode1,$symbol1,$rate1);
        InitTest::ClearAllCach($I);
    }
    
    /**
     * @guy CurrenciesTester\CurrenciesSteps
     */
    
    public function ICMS_1508_Symbols10Editing(CurrenciesTester\CurrenciesSteps $I)
    {
        $name="Гульден123";
        $isocode="Гульден123";
        $symbol="Гульден123";
        $rate="105236.2354";
        $I->EditCurrency($name,$isocode,$symbol,$rate);
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
        //$I->waitForElementVisible('.alert.in.fade.alert-success');
        $I->waitForText('Изменения сохранены',4);
        //$I->waitForElementNotVisible('.alert.in.fade.alert-success');
        $name1="Гульден123";
        $isocode1="Гульд";
        $symbol1="Гульд";
        $rate1="105236.2354";
        $I->CheckInFields($name1,$isocode1,$symbol1,$rate1);      
    }
    
    /**
     * @guy CurrenciesTester\CurrenciesSteps
     */
    
    public function Symbols255Editing(CurrenciesTester\CurrenciesSteps $I)
    {
        $name="Франкфранкфранк франкфранкфранкфранк франкфранкфранкфранкфранкфранкфранкфранкфранк франкфранкфранкфранкфранк франкфранкфранкфранк франкфранкфранкфранкфранк франкфранкфранк франк франкфранк франкфр анкфранкфранкфранк франкфранкфранк франк ф р анкфранкфранк";
        $isocode="frank";
        $symbol="fr";
        $rate=".0210";
        $I->EditCurrency($name,$isocode,$symbol,$rate);
        //$I->waitForElementVisible('.alert.in.fade.alert-success');
        $I->waitForText('Изменения сохранены');
        //$I->waitForElementNotVisible('.alert.in.fade.alert-success');
        $name1="Франкфранкфранк франкфранкфранкфранк франкфранкфранкфранкфранкфранкфранкфранкфранк франкфранкфранкфранкфранк франкфранкфранкфранк франкфранкфранкфранкфранк франкфранкфранк франк франкфранк франкфр анкфранкфранкфранк франкфранкфранк франк ф р анкфранкфранк";
        $isocode1="frank";
        $symbol1="fr";
        $rate1="0.0210";
        $I->CheckInFields($name1,$isocode1,$symbol1,$rate1);
        InitTest::ClearAllCach($I);
    }
    
    /**
     * @guy CurrenciesTester\CurrenciesSteps
     */
    
    public function Symbols256Editing(CurrenciesTester\CurrenciesSteps $I)
    {
        $name="Форинтфоринт форинтфоринтфоринт форинтфо ринтфоринтфоринтфор интфоринтфоринтфоринтфоринтфоринтфоринтфори нтфоринтфоринтфоринтфор интфоринтфоринтфоринтфоринтф оринтфоринтфор интфоринтфоринтфоринтфор интфоринт форинтфоринтфоринтфоринтф оринтфоринтфоринтфорин";
        $isocode="forin";
        $symbol="фор";
        $rate="00120.01";
        $I->EditCurrency($name,$isocode,$symbol,$rate);
        //$I->waitForElementVisible('.alert.in.fade.alert-success');
        $I->waitForText('Изменения сохранены', 4);
        //$I->waitForElementNotVisible('.alert.in.fade.alert-success');
        $name1="Форинтфоринт форинтфоринтфоринт форинтфо ринтфоринтфоринтфор интфоринтфоринтфоринтфоринтфоринтфоринтфори нтфоринтфоринтфоринтфор интфоринтфоринтфоринтфоринтф оринтфоринтфор интфоринтфоринтфоринтфор интфоринт форинтфоринтфоринтфоринтф оринтфоринтфоринтфори";
        $isocode1="forin";
        $symbol1="фор";
        $rate1="120.0100";
        $I->CheckInFields($name1,$isocode1,$symbol1,$rate1);
    }
    
    /**
     * @guy CurrenciesTester\CurrenciesSteps
     */
    
    public function SaveAndExitButton(CurrenciesTester\CurrenciesSteps $I)
    {
        $name="Лат";
        $isocode="лат";
        $symbol="лат";
        $rate="11111";
        $I->EditCurrency($name,$isocode,$symbol,$rate,$save='saveexit');
        //$I->waitForElementVisible('.alert.in.fade.alert-success');
        $I->waitForText('Изменения сохранены');
        //$I->waitForElementNotVisible('.alert.in.fade.alert-success');
        $I->waitForText('Список валют');
        $I->see('Лат', './/*[@id="mainContent"]/section/div[2]/div/form/table/tbody/tr[1]/td[2]/a');
        $I->see('лат', './/*[@id="mainContent"]/section/div[2]/div/form/table/tbody/tr[1]/td[3]');
        $I->see('лат', './/*[@id="mainContent"]/section/div[2]/div/form/table/tbody/tr[1]/td[4]');
        InitTest::ClearAllCach($I);
    }
    
}