<?php
use \CallbacksTester;

class EditingThemeCallbackCest
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
    
    
    public function NamesInEditing(CallbacksTester $I)
    {
        $I->amOnPage(CallbacksPage::$URLThemes);
        $I->moveMouseOver(CallbacksPage::ThemeNameLine('1'));
//        $I->canSeeElement('div.tooltip-inner');
//        $I->see('Редактировать тему обратного звонка');
        $I->click(CallbacksPage::ThemeNameLine('1'));
        $I->waitForText('Редактирование темы обратного звонка');
        $I->see('Редактирование темы обратного звонка', 'span.title.w-s_n');
        $I->see('Информация', '//*[@id="mainContent"]/section/table/thead/tr/th');
        $I->see('Название:', './/*[@id="addCallbackStatusForm"]/div/label');
        $I->see('Вернуться', CallbacksPage::$GoBackButton);
        $I->see('Сохранить', CallbacksPage::$SaveButton);
        $I->see('Сохранить и выйти', CallbacksPage::$SaveAndExitButton);
        InitTest::ClearAllCach($I);
    }
    
    
    public function RequiredFieldsInEditingSaveButton(CallbacksTester $I)
    {
        $I->amOnPage(CallbacksPage::$URLThemes);
        $I->click(CallbacksPage::ThemeNameLine('1'));
        $I->waitForText('Редактирование темы обратного звонка');
        $I->fillField(CallbacksPage::$NameTheme, '');
        $I->click(CallbacksPage::$SaveButton);
        $I->see('Это поле обязательное.', './/*[@id="addCallbackStatusForm"]/div/div/label');
        $I->click(CallbacksPage::$GoBackButton);
        $I->waitForText('Темы обратных звонков');
    }
    
    
    public function RequiredFieldsInEditingSaveAndExitButton(CallbacksTester $I)
    {
        $I->amOnPage(CallbacksPage::$URLThemes);
        $I->click(CallbacksPage::ThemeNameLine('1'));
        $I->waitForText('Редактирование темы обратного звонка');
        $I->fillField(CallbacksPage::$NameTheme, '');
        $I->click(CallbacksPage::$SaveAndExitButton);
        $I->see('Это поле обязательное.', './/*[@id="addCallbackStatusForm"]/div/div/label');
        $I->click(CallbacksPage::$GoBackButton);
        $I->waitForText('Темы обратных звонков');
        InitTest::ClearAllCach($I);
    }
    
    /**
     * @guy CallbacksTester\CallbacksSteps
     */
    
    public function TypesOfSymbolsInEditing(CallbacksTester\CallbacksSteps $I)
    {
        $name='qwerrQEQE12345!#@$#%%^&*()_+|}{:>?<,./;][\\=-0ёцвцаымпУКП';
        $I->EditThemeCallback($name, $name);
    }
    
    /**
     * @guy CallbacksTester\CallbacksSteps
     */
    
    public function OneSymbolsEditing(CallbacksTester\CallbacksSteps $I)
    {
        $name='q';
        $I->EditThemeCallback($name, $name);
        InitTest::ClearAllCach($I);
    }
    
    /**
     * @guy CallbacksTester\CallbacksSteps
     */
    
    public function Symbols128Editing(CallbacksTester\CallbacksSteps $I)
    {
        $name='12345йцуке12345йцуке12345 цуке12345йцуке 2345йцуке12345йцуке123 5йцуке12345йцуке12345 цуке12345йцуке12345 цуке12345 цуке12345йцу';
        $I->EditThemeCallback($name, $name);
    }
    
    /**
     * @guy CallbacksTester\CallbacksSteps
     */
    
    public function Symbols255Editing(CallbacksTester\CallbacksSteps $I)
    {
        $name='12345йцуке12345йцуке12345йц ке12345йцуке123 5йцуке12345йцуке12 45йцуке12345йцук 12345йцуке12345йцуке123 5йцуке12345йцуке12345йцуке 2345йцуке12345йцуке12345йцук 12345йцуке12345йцу е12345йцуке12345йцу е12345йцуке12345йцук 12345йцуке12345йцуке1234 йцуке12345';
        $I->EditThemeCallback($name, $name);
        InitTest::ClearAllCach($I);
    }
    
    /**
     * @guy CallbacksTester\CallbacksSteps
     */
    
    public function Symbols256Editing(CallbacksTester\CallbacksSteps $I)
    {
        $name='12345йцуке12345йц ке12345йцуке12345й уке12345йцуке12345йц ке12345йцуке12345йцуке12345й уке12345йцуке12345йцуке1234 йцуке123 5йцуке12345йцуке1234 йцуке12345йцуке12345йцук 12345йцуке12345йцуке12 45йцуке12345йцуке12345йц ке12345йцуке12345йцуке12345й уке123456';
        $name1='12345йцуке12345йц ке12345йцуке12345й уке12345йцуке12345йц ке12345йцуке12345йцуке12345й уке12345йцуке12345йцуке1234 йцуке123 5йцуке12345йцуке1234 йцуке12345йцуке12345йцук 12345йцуке12345йцуке12 45йцуке12345йцуке12345йц ке12345йцуке12345йцуке12345й уке12345';
        $I->EditThemeCallback($name, $name1);
    }
    
    /**
     * @guy CallbacksTester\CallbacksSteps
     */
    
    public function SaveAndExitButton(CallbacksTester\CallbacksSteps $I)
    {
        $name='www';
        $I->EditThemeCallback($name, $name, $save='saveexit');
        InitTest::ClearAllCach($I);
    }
}