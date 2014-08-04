<?php
use \CallbacksTester;

class CreateThemeCallbackCest
{
//    public function _before()
//    {
//    }
//
//    public function _after()
//    {
//    }

    // tests
    public function Autorization(CallbacksTester $I)
    {
        InitTest::Login($I);
        $I->amOnPage("/admin/components/run/shop/callbacks/themes");
        $I->waitForText("Темы обратных звонков");
    }
    
    
    public function NamesInCreate(CallbacksTester $I)
    {
        $I->click('html/body/div[1]/div[3]/div/nav/ul/li[2]/a');
        $I->waitForElement('html/body/div[1]/div[3]/div/nav/ul/li[2]/ul');
        $I->click('html/body/div[1]/div[3]/div/nav/ul/li[2]/ul/li[7]/a');
        $I->waitForElementNotVisible('html/body/div[1]/div[3]/div/nav/ul/li[2]/ul');
        $I->see('Темы обратных звонков', 'span.title');
        $I->click(CallbacksPage::$CreateThemeButton);
        $I->waitForText('Создание темы обратного звонка');
        $I->see('Создание темы обратного звонка', 'span.title.w-s_n');
        $I->see('Информация', '.table.table-striped.table-bordered.table-hover.table-condensed.content_big_td>thead>tr>th');
        $I->see('Имя:', './/*[@id="addCallbackStatusForm"]/div/label');
        $I->see('Вернуться', CallbacksPage::$GoBackButton);
        $I->see('Создать', CallbacksPage::$SaveButton);
        $I->see('Создать и выйти', CallbacksPage::$SaveAndExitButton);
    }
    
    
    public function RequiredFieldsInCreateSaveButton(CallbacksTester $I)
    {
        $I->amOnPage('/admin/components/run/shop/callbacks/createTheme');
        $I->click(CallbacksPage::$SaveButton);
        $I->see('Это поле обязательное.', './/*[@id="addCallbackStatusForm"]/div/div/label');
        $I->click(CallbacksPage::$GoBackButton);
        $I->waitForText('Темы обратных звонков');
        InitTest::ClearAllCach($I);
    }
    
    
    public function RequiredFieldsInCreateSaveAndExitButton(CallbacksTester $I)
    {
        $I->amOnPage('/admin/components/run/shop/callbacks/createTheme');
        $I->click(CallbacksPage::$SaveAndExitButton);
        $I->see('Это поле обязательное.', './/*[@id="addCallbackStatusForm"]/div/div/label');
        $I->click(CallbacksPage::$GoBackButton);
        $I->waitForText('Темы обратных звонков');
    }
    
    
    public function TypesOfSymbolsInCreate(CallbacksTester $I)
    {
        $I->amOnPage('/admin/components/run/shop/callbacks/createTheme');
        $I->fillField(CallbacksPage::$NameTheme, 'qwerrQEQE12345!#@$#%%^&*()_+|}{:>?<,./;][\\=-0ёцвцаымпУКП');
        $I->seeInField(CallbacksPage::$NameTheme, 'qwerrQEQE12345!#@$#%%^&*()_+|}{:>?<,./;][\\=-0ёцвцаымпУКП');
        $I->click(CallbacksPage::$SaveButton);
        $I->waitForElementVisible('.alert.in.fade.alert-success');
        $I->see('Тема начата');
        $I->waitForElementNotVisible('.alert.in.fade.alert-success');
        $I->seeInField(CallbacksPage::$NameTheme, 'qwerrQEQE12345!#@$#%%^&*()_+|}{:>?<,./;][\\=-0ёцвцаымпУКП');
        InitTest::ClearAllCach($I);
    }
    
    
    public function OneSymbolsCreate(CallbacksTester $I)
    {
        $I->amOnPage('/admin/components/run/shop/callbacks/createTheme');
        $I->fillField(CallbacksPage::$NameTheme, 'q');
        $I->click(CallbacksPage::$SaveButton);
        $I->waitForElementVisible('.alert.in.fade.alert-success');
        $I->see('Тема начата');
        $I->waitForElementNotVisible('.alert.in.fade.alert-success');
        $I->seeInField(CallbacksPage::$NameTheme, 'q');
    }
    
    
    public function Symbols128Create(CallbacksTester $I)
    {
        $I->amOnPage('/admin/components/run/shop/callbacks/createTheme');
        $I->fillField(CallbacksPage::$NameTheme, '12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцу');
        $I->click(CallbacksPage::$SaveButton);
        $I->waitForElementVisible('.alert.in.fade.alert-success');
        $I->see('Тема начата');
        $I->waitForElementNotVisible('.alert.in.fade.alert-success');
        $I->seeInField(CallbacksPage::$NameTheme, '12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцу');
        InitTest::ClearAllCach($I);
    }
    
    
    public function Symbols255Create(CallbacksTester $I)
    {
        $I->amOnPage('/admin/components/run/shop/callbacks/createTheme');
        $I->fillField(CallbacksPage::$NameTheme, '12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345');
        $I->click(CallbacksPage::$SaveButton);
        $I->waitForElementVisible('.alert.in.fade.alert-success');
        $I->see('Тема начата');
        $I->waitForElementNotVisible('.alert.in.fade.alert-success');
        $I->seeInField(CallbacksPage::$NameTheme, '12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345');

    }
    
    
    public function Symbols256Create(CallbacksTester $I)
    {
        $I->amOnPage('/admin/components/run/shop/callbacks/createTheme');
        $I->fillField(CallbacksPage::$NameTheme, '12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке123456');
        $I->click(CallbacksPage::$SaveButton);
        $I->waitForElementVisible('.alert.in.fade.alert-success');
        $I->see('Тема начата');
        $I->waitForElementNotVisible('.alert.in.fade.alert-success');
        $I->seeInField(CallbacksPage::$NameTheme, '12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345');
        InitTest::ClearAllCach($I);
    }
    
    
    public function CreateAndExit(CallbacksTester $I)
    {
        $I->amOnPage('/admin/components/run/shop/callbacks/createTheme');
        $I->fillField(CallbacksPage::$NameTheme, 'ййй');
        $I->click(CallbacksPage::$SaveAndExitButton);
        $I->waitForElementVisible('.alert.in.fade.alert-success');
        $I->see('Тема начата');
        $I->waitForElementNotVisible('.alert.in.fade.alert-success');
        $I->waitForText('Темы обратных звонков');
        $text=$I->grabTextFrom('.//*[@id="orderStatusesList"]/section/div[2]/div/table/tbody/tr[last()]/td[1]');
        $I->see('ййй', './/*[@id="orderStatusesList"]/section/div[2]/div/table/tbody/tr[last()]/td[2]/a');
    }
    
    
}