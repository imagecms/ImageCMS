<?php
use \AcceptanceTester;

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
    public function Autorization(AcceptanceTester $I)
    {
        InitTest::Login($I);
        $I->amOnPage("/admin/components/run/shop/callbacks/themes");
        $I->waitForText("Темы обратных звонков");
    }
    
    
    public function NamesInEditing(AcceptanceTester $I)
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
    
    
    public function RequiredFieldsInEditingSaveButton(AcceptanceTester $I)
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
    
    
    public function RequiredFieldsInEditingSaveAndExitButton(AcceptanceTester $I)
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
    
    
    public function TypesOfSymbolsInEditing(AcceptanceTester $I)
    {
        $I->amOnPage('/admin/components/run/shop/callbacks/themes');
        $I->click('.//*[@id="orderStatusesList"]/section/div[2]/div/table/tbody/tr/td[2]/a');
        $I->waitForText('Редактирование темы обратного звонка');
        $I->fillField(CallbacksPage::$NameTheme, 'qwerrQEQE12345!#@$#%%^&*()_+|}{:>?<,./;][\\=-0ёцвцаымпУКП');
        $I->seeInField(CallbacksPage::$NameTheme, 'qwerrQEQE12345!#@$#%%^&*()_+|}{:>?<,./;][\\=-0ёцвцаымпУКП');
        $I->click(CallbacksPage::$SaveButton);
        $I->waitForElementVisible('.alert.in.fade.alert-success');
        $I->see('Изменения сохранены');
        $I->waitForElementNotVisible('.alert.in.fade.alert-success');
        $I->seeInField(CallbacksPage::$NameTheme, 'qwerrQEQE12345!#@$#%%^&*()_+|}{:>?<,./;][\\=-0ёцвцаымпУКП');
    }
    
    
    public function OneSymbolsEditing(AcceptanceTester $I)
    {
        $I->amOnPage('/admin/components/run/shop/callbacks/themes');
        $I->click('.//*[@id="orderStatusesList"]/section/div[2]/div/table/tbody/tr/td[2]/a');
        $I->waitForText('Редактирование темы обратного звонка');
        $I->fillField(CallbacksPage::$NameTheme, 'q');
        $I->click(CallbacksPage::$SaveButton);
        $I->waitForElementVisible('.alert.in.fade.alert-success');
        $I->see('Изменения сохранены');
        $I->waitForElementNotVisible('.alert.in.fade.alert-success');
        $I->seeInField(CallbacksPage::$NameTheme, 'q');
        InitTest::ClearAllCach($I);
    }
    
    
    public function Symbols128Editing(AcceptanceTester $I)
    {
        $I->amOnPage('/admin/components/run/shop/callbacks/themes');
        $I->click('.//*[@id="orderStatusesList"]/section/div[2]/div/table/tbody/tr/td[2]/a');
        $I->waitForText('Редактирование темы обратного звонка');
        $I->fillField(CallbacksPage::$NameTheme, '12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцу');
        $I->click(CallbacksPage::$SaveButton);
        $I->waitForElementVisible('.alert.in.fade.alert-success');
        $I->see('Изменения сохранены');
        $I->waitForElementNotVisible('.alert.in.fade.alert-success');
        $I->seeInField(CallbacksPage::$NameTheme, '12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцу');

    }
    
    
    public function Symbols255Editing(AcceptanceTester $I)
    {
        $I->amOnPage('/admin/components/run/shop/callbacks/themes');
        $I->click('.//*[@id="orderStatusesList"]/section/div[2]/div/table/tbody/tr/td[2]/a');
        $I->waitForText('Редактирование темы обратного звонка');
        $I->fillField(CallbacksPage::$NameTheme, '12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345');
        $I->click(CallbacksPage::$SaveButton);
        $I->waitForElementVisible('.alert.in.fade.alert-success');
        $I->see('Изменения сохранены');
        $I->waitForElementNotVisible('.alert.in.fade.alert-success');
        $I->seeInField(CallbacksPage::$NameTheme, '12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345');
        InitTest::ClearAllCach($I);
    }
    
    
    public function Symbols256Editing(AcceptanceTester $I)
    {
        $I->amOnPage('/admin/components/run/shop/callbacks/themes');
        $I->click('.//*[@id="orderStatusesList"]/section/div[2]/div/table/tbody/tr/td[2]/a');
        $I->waitForText('Редактирование темы обратного звонка');
        $I->fillField(CallbacksPage::$NameTheme, '12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке123456');
        $I->click(CallbacksPage::$SaveButton);
        $I->waitForElementVisible('.alert.in.fade.alert-success');
        $I->see('Изменения сохранены');
        $I->waitForElementNotVisible('.alert.in.fade.alert-success');
        $I->seeInField(CallbacksPage::$NameTheme, '12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345');

    }
    
    
    public function SaveAndExitButton(AcceptanceTester $I)
    {
        $I->amOnPage('/admin/components/run/shop/callbacks/themes');
        $I->click('.//*[@id="orderStatusesList"]/section/div[2]/div/table/tbody/tr/td[2]/a');
        $I->waitForText('Редактирование темы обратного звонка');
        $I->fillField(CallbacksPage::$NameTheme, 'www');
        $I->click(CallbacksPage::$SaveAndExitButton);
        $I->waitForElementVisible('.alert.in.fade.alert-success');
        $I->see('Изменения сохранены');
        $I->waitForElementNotVisible('.alert.in.fade.alert-success');
        $I->waitForText('Темы обратных звонков');
        $I->see('www', './/*[@id="orderStatusesList"]/section/div[2]/div/table/tbody/tr/td[2]/a');
        InitTest::ClearAllCach($I);
    }
}