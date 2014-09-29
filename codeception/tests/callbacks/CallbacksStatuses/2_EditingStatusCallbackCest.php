<?php
use \CallbacksTester;

class EditingStatusCallbackCest
{
//    public function _before()
//    {
//    }
//
//    public function _after()
//    {
//    }

    public function Autorization(CallbacksTester $I)
    {
        InitTest::Login($I);
        $I->amOnPage(CallbacksPage::$URLStatuses);
        $I->waitForText("Статусы обратных звонков");
    }
    
    
    public function NamesInEditing(CallbacksTester $I)
    {
        $I->moveMouseOver(CallbacksPage::StatusNameLine('1'));
//        $I->canSeeElement("div.tooltip-inner");
//        $I->see('Редактировать статус обратного звонка');
        $I->click(CallbacksPage::StatusNameLine('1'));
        $I->waitForText('Редактирование статуса обратного звонка');
        $I->see('Редактирование статуса обратного звонка', 'span.title.w-s_n');
        $I->see('Информация', './/*[@id="mainContent"]/section/table/thead/tr/th');
        $I->see('Название:', './/*[@id="addCallbackStatusForm"]/div[1]/label');
        $I->see('По умолчанию', 'span.frame_label.no_connection');
        $I->see('Статус будет назначен всем новым запросам.', 'div.help-block');
        $I->see('Вернуться', CallbacksPage::$GoBackButton);
        $I->see('Сохранить', CallbacksPage::$SaveButton);
        $I->see('Сохранить и выйти', CallbacksPage::$SaveAndExitButton);
        InitTest::ClearAllCach($I);
    }
    
    
    public function RequiredFieldsInEditingSaveButton(CallbacksTester $I)
    {
        $I->amOnPage(CallbacksPage::$URLStatuses);
        $I->click(CallbacksPage::StatusNameLine('1'));
        $I->waitForText('Редактирование статуса обратного звонка');
        $I->fillField(CallbacksPage::$NameStatus, '');
        $I->click(CallbacksPage::$SaveButton);
        $I->see('Это поле обязательное.', './/*[@id="addCallbackStatusForm"]/div[1]/div/label');
        $I->click(CallbacksPage::$GoBackButton);
        $I->waitForText('Статусы обратных звонков');
    }
    
    
    public function RequiredFieldsInEditingSaveAndExitButton(CallbacksTester $I)
    {
        $I->amOnPage(CallbacksPage::$URLStatuses);
        $I->click(CallbacksPage::StatusNameLine('1'));
        $I->waitForText('Редактирование статуса обратного звонка');
        $I->fillField(CallbacksPage::$NameStatus, '');
        $I->click(CallbacksPage::$SaveAndExitButton);
        $I->see('Это поле обязательное.', './/*[@id="addCallbackStatusForm"]/div[1]/div/label');
        InitTest::ClearAllCach($I);
    }
    
    /**
     * @guy CallbacksTester\CallbacksSteps
     */
    
    public function TypesOfSymbolsInEditing(CallbacksTester\CallbacksSteps $I)
    {
        $name='qwerrQEQE12345!#@$#%%^&*()_+|}{:">?<,./;][\\=-0ёцвцаымпУКП';
        $I->EditStatusCallback($name, $name);
    }
    
    /**
     * @guy CallbacksTester\CallbacksSteps
     */
    
    public function OneSymbolsEditing(CallbacksTester\CallbacksSteps $I)
    {
        $name='q';
        $default='';
        $save='save';
        $I->EditStatusCallback($name, $name, $save, $default);
        InitTest::ClearAllCach($I);
    }
    
    /**
     * @guy CallbacksTester\CallbacksSteps
     */
    
    public function Symbols128Editing(CallbacksTester\CallbacksSteps $I)
    {
        $name='12345йцуке12345йцуке12345йцуке12345йцуке1234 йцуке12345йцуке12345йцуке12345йцуке 2345йцуке12345йцуке1234 йцуке12345йцуке12345йцу';
        $I->EditStatusCallback($name, $name);
    }
    
    /**
     * @guy CallbacksTester\CallbacksSteps
     */
    
    public function Symbols255Editing(CallbacksTester\CallbacksSteps $I)
    {
        $name='12345йцуке12345йцуке12345йцуке1 345йцуке12345йцуке12345йцуке12345йцуке12345йцук 12345йцуке12345йцуке12345йцуке12345йц ке12345йцуке12345йцуке12345й уке12345йцуке12345йцуке123 5йцуке12345йцуке12345йцуке123 5йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345';
        $I->EditStatusCallback($name, $name);
        InitTest::ClearAllCach($I);
    }
    
    /**
     * @guy CallbacksTester\CallbacksSteps
     */
    
    public function Symbols256Editing(CallbacksTester\CallbacksSteps $I)
    {
        $name='12345йцуке12345йцуке12 45йцуке12 45йцуке12345 цуке12345йцуке12345йцуке 2345йцуке12345йцуке12345йц ке12345йцуке12345йцуке12345йцуке1 345йцуке12345йцуке12345йцу е12345йцуке12345йцуке12345йцуке 2345йцуке12345йцуке12 45йцуке12345йцуке12345йцук 12345йцуке123456';
        $name1='12345йцуке12345йцуке12 45йцуке12 45йцуке12345 цуке12345йцуке12345йцуке 2345йцуке12345йцуке12345йц ке12345йцуке12345йцуке12345йцуке1 345йцуке12345йцуке12345йцу е12345йцуке12345йцуке12345йцуке 2345йцуке12345йцуке12 45йцуке12345йцуке12345йцук 12345йцуке12345';
        $I->EditStatusCallback($name, $name1);
    }
    
    /**
     * @guy CallbacksTester\CallbacksSteps
     */
    
    public function SaveAndExit(CallbacksTester\CallbacksSteps $I)
    {
        $name='sss';
        $I->EditStatusCallback($name, $name, $save='saveexit');
//        $I->amOnPage('/admin/components/run/shop/callbacks/statuses');
//        $I->click('.//*[@id="orderStatusesList"]/section/div[2]/div/table/tbody/tr[1]/td[2]/a');
//        $I->waitForText('Редактирование статуса обратного звонка');
//        $I->fillField(CallbacksPage::$NameStatus, 'sss');
//        $I->click(CallbacksPage::$SaveAndExitButton);
//        $I->waitForElementVisible('.alert.in.fade.alert-success');
//        $I->see('Изменения сохранены');
//        $I->waitForElementNotVisible('.alert.in.fade.alert-success');
//        $I->waitForText('Статусы обратных звонков');
//        $I->see('sss', './/*[@id="orderStatusesList"]/section/div[2]/div/table/tbody/tr[1]/td[2]/a');
        InitTest::ClearAllCach($I);
    }
    
    
}