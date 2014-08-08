<?php
use \CallbacksTester;

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
    public function Autorization(CallbacksTester $I)
    {
        InitTest::Login($I);
        $I->amOnPage("/admin/components/run/shop/callbacks/statuses");
        $I->waitForText("Статусы обратных звонков");
    }  
    
    
    public function ICMS_1461_NamesInCreate(CallbacksTester $I)
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
    
    
    public function RequiredFieldsInCreateSaveButton(CallbacksTester $I)
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
    
    
    public function RequiredFieldsInCreateSaveAndExitButton(CallbacksTester $I)
    {
        $I->amOnPage('/admin/components/run/shop/callbacks/statuses');
        $I->click(CallbacksPage::$CreateStatusButton);
        $I->waitForText('Создание статуса обратного звонка');
        $I->click(CallbacksPage::$SaveAndExitButton);
        $I->see('Это поле обязательное.', './/*[@id="addCallbackStatusForm"]/div[1]/div/label');
        $I->click(CallbacksPage::$GoBackButton);
        $I->waitForText('Статусы обратных звонков');
    } 
    
    /**
     * @guy CallbacksTester\CallbacksSteps
     */
    
    public function TypesOfSymbolsInCreate(CallbacksTester\CallbacksSteps $I)
    {
        $name="qwerrQEQE12345!#@$#%%^&*()_+|}{:>?<,./;][\\=-0ёцвцаымпУКП";        
        $I->CreateStatusCallback($name,$name);
        InitTest::ClearAllCach($I);
    } 
            
    /**
     * @guy CallbacksTester\CallbacksSteps
     */
    
    public function Symbols128Create(CallbacksTester\CallbacksSteps $I)
    {
        $name="Статустатустатустатустатустатустатустатустатустатустатустатустатустатустатустатустатустатустатустатустатустатустатустатустатуста";        
        $I->CreateStatusCallback($name, $name);
    } 
    
    /**
     * @guy CallbacksTester\CallbacksSteps
     */
    
    public function Symbols255Create(CallbacksTester\CallbacksSteps $I)
    {
        $name="12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345";        
        $I->CreateStatusCallback($name, $name);
    } 
    
    /**
     * @guy CallbacksTester\CallbacksSteps
     */
    
    public function Symbols256Create(CallbacksTester\CallbacksSteps $I)
    {
        $name="12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке123456"; 
        $name2="12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345";
        $I->CreateStatusCallback($name, $name2);
        InitTest::ClearAllCach($I);
    } 
    
    
    public function CreateAndExit(CallbacksTester $I)
    {
        $I->amOnPage('/admin/components/run/shop/callbacks/createStatus');
        $I->fillField(CallbacksPage::$NameStatus, 'На рассмотрении');
        $I->click(CallbacksPage::$SaveAndExitButton);
        $I->waitForElementVisible('.alert.in.fade.alert-success');
        $I->see('Позиция создана');
        $I->waitForElementNotVisible('.alert.in.fade.alert-success');
        $I->see('На рассмотрении', CallbacksPage::ThemeNameLine('last()'));
        $def=$I->grabAttributeFrom(\CallbacksPage::ActiveButtonLine('last()'), 'class');
        $I->assertEquals($def, "prod-on_off  disable_tovar");
        $DeleteBut=$I->grabAttributeFrom(\CallbacksPage::DeleteStatusButtonLine("last()"), 'disabled');
        $I->comment("DeleteBut");
        $I->assertEquals($DeleteBut, null);
    } 
    
    /**
     * @guy CallbacksTester\CallbacksSteps
     */
    
    public function OneSymbolsCreate(CallbacksTester\CallbacksSteps $I)
    {
        $name="q";
        $default='';
        $I->CreateStatusCallback($name,$name,$default);
        $default='prod-on_off ';
        $I->CheckStatusCallbackListLanding($name, $default);
    } 
}