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
        $I->amOnPage("/admin/components/run/shop/callbacks/themes");
        $I->waitForText("Темы обратных звонков");
    }
    
    
    public function NamesInEditing(CallbacksTester $I)
    {
        $I->amOnPage('/admin/components/run/shop/callbacks/themes');
        $I->moveMouseOver('.//*[@id="orderStatusesList"]/section/div[2]/div/table/tbody/tr/td[2]/a');
//        $I->canSeeElement('div.tooltip-inner');
//        $I->see('Редактировать тему обратного звонка');
        $I->click('.//*[@id="orderStatusesList"]/section/div[2]/div/table/tbody/tr/td[2]/a');
        $I->waitForText('Редактирование темы обратного звонка');
        $I->see('Редактирование темы обратного звонка', 'span.title.w-s_n');
        $I->see('Информация', '.table.table-striped.table-bordered.table-hover.table-condensed.content_big_td>thead>tr>th');
        $I->see('Имя:', './/*[@id="addCallbackStatusForm"]/div/label');
        $I->see('Вернуться', CallbacksPage::$GoBackButton);
        $I->see('Сохранить', CallbacksPage::$SaveButton);
        $I->see('Сохранить и выйти', CallbacksPage::$SaveAndExitButton);
        InitTest::ClearAllCach($I);
    }
    
    
    public function RequiredFieldsInEditingSaveButton(CallbacksTester $I)
    {
        $I->amOnPage('/admin/components/run/shop/callbacks/themes');
        $I->click('.//*[@id="orderStatusesList"]/section/div[2]/div/table/tbody/tr/td[2]/a');
        $I->waitForText('Редактирование темы обратного звонка');
        $I->fillField(CallbacksPage::$NameTheme, '');
        $I->click(CallbacksPage::$SaveButton);
        $I->see('Это поле обязательное.', './/*[@id="addCallbackStatusForm"]/div/div/label');
        $I->click(CallbacksPage::$GoBackButton);
        $I->waitForText('Темы обратных звонков');
    }
    
    
    public function RequiredFieldsInEditingSaveAndExitButton(CallbacksTester $I)
    {
        $I->amOnPage('/admin/components/run/shop/callbacks/themes');
        $I->click('.//*[@id="orderStatusesList"]/section/div[2]/div/table/tbody/tr/td[2]/a');
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
        $name='12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцу';
        $I->EditThemeCallback($name, $name);
    }
    
    /**
     * @guy CallbacksTester\CallbacksSteps
     */
    
    public function Symbols255Editing(CallbacksTester\CallbacksSteps $I)
    {
        $name='12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345';
        $I->EditThemeCallback($name, $name);
        InitTest::ClearAllCach($I);
    }
    
    /**
     * @guy CallbacksTester\CallbacksSteps
     */
    
    public function Symbols256Editing(CallbacksTester\CallbacksSteps $I)
    {
        $name='12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке123456';
        $name1='12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345';
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