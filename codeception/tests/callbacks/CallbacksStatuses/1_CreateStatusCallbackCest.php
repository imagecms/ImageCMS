<?php
use \AcceptanceTester;

class CreateStatusCallbackCest
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
        $I->amOnPage("/admin/components/run/shop/callbacks/statuses");
        $I->waitForText("Статусы обратных звонков");
    }  
    
    
    public function NamesInCreate(AcceptanceTester $I)
    {
        $I->amOnPage('/admin/components/run/shop/callbacks/statuses');
        $I->click(CallbacksPage::$CreateStatusButton);
        $I->waitForText('Создание статуса обратного звонка');
        $I->see('Создание статуса обратного звонка', 'span.title');
        $I->see('Информация', './/*[@id="mainContent"]/section/div[2]/table/thead/tr/th');
        $I->see('Название:', './/*[@id="addCallbackStatusForm"]/div[1]/label');
        $I->see('По умолчанию', 'span.frame_label.no_connection');
        $I->see('Статус будет назначен всем новым запросам.', 'span.help-block');
        $I->see('Вернуться', CallbacksPage::$GoBackButton);
        $I->see('Создать', CallbacksPage::$SaveButton);
        $I->see('Создать и выйти', CallbacksPage::$SaveAndExitButton);
    } 
    
    
    public function RequiredFieldsInCreateSaveButton(AcceptanceTester $I)
    {
        $I->amOnPage('/admin/components/run/shop/callbacks/statuses');
        $I->click(CallbacksPage::$CreateStatusButton);
        $I->waitForText('Создание статуса обратного звонка');
        $I->click(CallbacksPage::$SaveButton);
        $I->see('Это поле обязательное.', './/*[@id="addCallbackStatusForm"]/div[1]/div/label');
        $I->click(CallbacksPage::$GoBackButton);
        $I->waitForText('Статусы обратных звонков');
        InitTest::ClearAllCach($I);
    } 
    
    
    public function RequiredFieldsInCreateSaveAndExitButton(AcceptanceTester $I)
    {
        $I->click(CallbacksPage::$CreateStatusButton);
        $I->waitForText('Создание статуса обратного звонка');
        $I->click(CallbacksPage::$SaveAndExitButton);
        $I->see('Это поле обязательное.', './/*[@id="addCallbackStatusForm"]/div[1]/div/label');
        $I->click(CallbacksPage::$GoBackButton);
        $I->waitForText('Статусы обратных звонков');
    } 
    
    
    public function TypesOfSymbolsInCreate(AcceptanceTester $I)
    {
        $I->amOnPage('/admin/components/run/shop/callbacks/createStatus');
        $I->fillField(CallbacksPage::$NameStatus, 'qwerrQEQE12345!#@$#%%^&*()_+|}{:>?<,./;][\\=-0ёцвцаымпУКП');
        $I->seeInField(CallbacksPage::$NameStatus, 'qwerrQEQE12345!#@$#%%^&*()_+|}{:>?<,./;][\\=-0ёцвцаымпУКП');
        $I->click(CallbacksPage::$SaveButton);
        $I->waitForElementVisible('.alert.in.fade.alert-success');
        $I->see('Статус создан');
        $I->waitForElementNotVisible('.alert.in.fade.alert-success');
        $I->seeInField(CallbacksPage::$NameStatus, 'qwerrQEQE12345!#@$#%%^&*()_+|}{:>?<,./;][\\=-0ёцвцаымпУКП');
        InitTest::ClearAllCach($I);
    } 
    
    
    public function OneSymbolsCreate(AcceptanceTester $I)
    {
        $I->amOnPage('/admin/components/run/shop/callbacks/createStatus');
        $I->fillField(CallbacksPage::$NameStatus, 'q');
        $I->click(CallbacksPage::$SaveButton);
        $I->waitForElementVisible('.alert.in.fade.alert-success');
        $I->see('Позиция создана');
        $I->waitForElementNotVisible('.alert.in.fade.alert-success');
        $I->seeInField(CallbacksPage::$NameStatus, 'q');
    } 
    
    
    public function Symbols128Create(AcceptanceTester $I)
    {
        $I->amOnPage('/admin/components/run/shop/callbacks/createStatus');
        $I->fillField(CallbacksPage::$NameStatus, 'q');
        $I->click(CallbacksPage::$SaveButton);
        $I->waitForElementVisible('.alert.in.fade.alert-success');
        $I->see('Позиция создана');
        $I->waitForElementNotVisible('.alert.in.fade.alert-success');
        $I->seeInField(CallbacksPage::$NameStatus, 'q');
        InitTest::ClearAllCach($I);
    } 
    
    
    public function Symbols255Create(AcceptanceTester $I)
    {
        $I->amOnPage('/admin/components/run/shop/callbacks/createStatus');
        $I->fillField(CallbacksPage::$NameStatus, '12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345');
        $I->click(CallbacksPage::$SaveButton);
        $I->waitForElementVisible('.alert.in.fade.alert-success');
        $I->see('Позиция создана');
        $I->waitForElementNotVisible('.alert.in.fade.alert-success');
        $I->seeInField(CallbacksPage::$NameStatus, '12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345');
    } 
    
    
    public function Symbols256Create(AcceptanceTester $I)
    {
        $I->amOnPage('/admin/components/run/shop/callbacks/createStatus');
        $I->fillField(CallbacksPage::$NameStatus, '12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке123456');
        $I->click(CallbacksPage::$SaveButton);
        $I->waitForElementVisible('.alert.in.fade.alert-success');
        $I->see('Позиция создана');
        $I->waitForElementNotVisible('.alert.in.fade.alert-success');
        $I->seeInField(CallbacksPage::$NameStatus, '12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345');
        InitTest::ClearAllCach($I);
    } 
    
    
    public function CreateAndExit(AcceptanceTester $I)
    {
        $I->amOnPage('/admin/components/run/shop/callbacks/createStatus');
        $I->fillField(CallbacksPage::$NameStatus, '12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке123456');
        $I->click(CallbacksPage::$SaveButton);
        $I->waitForElementVisible('.alert.in.fade.alert-success');
        $I->see('Позиция создана');
        $I->waitForElementNotVisible('.alert.in.fade.alert-success');
        $I->seeInField(CallbacksPage::$NameStatus, '12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345');
    } 
    
}