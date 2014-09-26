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
        $I->amOnPage(CallbacksPage::$URLThemes);
        $I->waitForText("Темы обратных звонков");
    }
    
    
    public function NamesInCreate(CallbacksTester $I)
    {
        $I->click(NavigationBarPage::$Orders);
        $I->waitForElement(CallbacksPage::$OrdersFormUp);
        $I->click(NavigationBarPage::$CallbackThemes);
        $I->waitForElementNotVisible(CallbacksPage::$OrdersFormUp);
        $I->see('Темы обратных звонков', 'span.title');
        $I->wait('1');
        $I->click(CallbacksPage::$CreateThemeButton);
        $I->waitForText('Создание темы обратного звонка');
        $I->see('Создание темы обратного звонка', 'span.title.w-s_n');
        $I->see('Информация', '//*[@id="mainContent"]/section/table/thead/tr/th');
        $I->see('Название:', './/*[@id="addCallbackStatusForm"]/div/label');
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
    
    /**
     * @guy CallbacksTester\CallbacksSteps
     */
    
    public function TypesOfSymbolsInCreate(CallbacksTester\CallbacksSteps $I)
    {
        $name='qwerrQEQE12345!#@$#%%^&*()_+|}{:>?<,./;][\\=-0ёцвцаымпУКП';
        $I->CreateThemeCallback($name, $name);
        InitTest::ClearAllCach($I);
    }
    
    /**
     * @guy CallbacksTester\CallbacksSteps
     */
    
    public function OneSymbolsCreate(CallbacksTester\CallbacksSteps $I)
    {
        $name='q';
        $I->CreateThemeCallback($name, $name);
    }
    
    /**
     * @guy CallbacksTester\CallbacksSteps
     */
    
    public function Symbols128Create(CallbacksTester\CallbacksSteps $I)
    {
        $name='12345йцуке12345йцуке12345йцук 12345йцуке12345йцуке12345йцуке12345 цуке12345йцуке12345йцуке1 345йцуке12345йцуке 2345йцуке12345йцу';
        $I->CreateThemeCallback($name, $name);
        InitTest::ClearAllCach($I);
    }
    
    /**
     * @guy CallbacksTester\CallbacksSteps
     */
    
    public function Symbols255Create(CallbacksTester\CallbacksSteps $I)
    {
        $name='12345йцуке12345йцуке123 5йцуке12345йцуке12345йцуке12345йцук 12345йцуке12345йцуке12345йцу е12345йцуке12345йцуке12345йц ке12345йцуке12345йц ке12345йцуке12345йцуке12345 цуке12345йцуке12345й уке12345йцуке12345йцуке1234 йцуке12345йцуке1 345йцуке12345йцук 12345';
        $I->CreateThemeCallback($name, $name);
    }
    
    /**
     * @guy CallbacksTester\CallbacksSteps
     */
    
    public function Symbols256Create(CallbacksTester\CallbacksSteps $I)
    {
        $name='12345йцуке12345 цуке12345йцуке12345йцу е12345йцуке12345йцуке123 5йцуке12345йцу е12345йцуке12345йцу е12345йцуке12345йцуке 2345йцуке12345йцуке123 5йцуке12345йцуке12345йцуке1234 йцуке12345йцуке12345 цуке12345йцуке12345йц ке12345йцуке12345йцу е12345йцуке123456';
        $name1='12345йцуке12345 цуке12345йцуке12345йцу е12345йцуке12345йцуке123 5йцуке12345йцу е12345йцуке12345йцу е12345йцуке12345йцуке 2345йцуке12345йцуке123 5йцуке12345йцуке12345йцуке1234 йцуке12345йцуке12345 цуке12345йцуке12345йц ке12345йцуке12345йцу е12345йцуке12345';
        $I->CreateThemeCallback($name, $name1);
        InitTest::ClearAllCach($I);
    }
    
    /**
     * @guy CallbacksTester\CallbacksSteps
     */
    
    public function CreateAndExit(CallbacksTester\CallbacksSteps $I)
    {
        $name='ййй';
        $I->CreateThemeCallback($name, $name, $save='saveexit');
    }
    
    
}