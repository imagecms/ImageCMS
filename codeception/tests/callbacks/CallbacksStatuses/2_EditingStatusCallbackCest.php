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
        $I->amOnPage("/admin/components/run/shop/callbacks/statuses");
        $I->waitForText("Статусы обратных звонков");
    }
    
    
    public function NamesInEditing(CallbacksTester $I)
    {
        $I->moveMouseOver('.//*[@id="orderStatusesList"]/section/div[2]/div/table/tbody/tr[1]/td[2]/a');
//        $I->canSeeElement("div.tooltip-inner");
//        $I->see('Редактировать статус обратного звонка');
        $I->click('.//*[@id="orderStatusesList"]/section/div[2]/div/table/tbody/tr[1]/td[2]/a');
        $I->waitForText('Редактирование статуса обратного звонка');
        $I->see('Редактирование статуса обратного звонка', 'span.title.w-s_n');
        $I->see('Информация', './/*[@id="mainContent"]/section/div[2]/table/thead/tr/th');
        $I->see('Имя:', './/*[@id="addCallbackStatusForm"]/div[1]/label');
        $I->see('По умолчанию', 'span.frame_label.no_connection');
        $I->see('Статус будет назначен всем новым запросам.', 'div.help-block');
        $I->see('Вернуться', CallbacksPage::$GoBackButton);
        $I->see('Сохранить', CallbacksPage::$SaveButton);
        $I->see('Сохранить и выйти', CallbacksPage::$SaveAndExitButton);
        InitTest::ClearAllCach($I);
    }
    
    
    public function RequiredFieldsInEditingSaveButton(CallbacksTester $I)
    {
        $I->amOnPage('/admin/components/run/shop/callbacks/statuses');
        $I->click('.//*[@id="orderStatusesList"]/section/div[2]/div/table/tbody/tr[1]/td[2]/a');
        $I->waitForText('Редактирование статуса обратного звонка');
        $I->fillField(CallbacksPage::$NameStatus, '');
        $I->click(CallbacksPage::$SaveButton);
        $I->see('Это поле обязательное.', './/*[@id="addCallbackStatusForm"]/div[1]/div/label');
        $I->click(CallbacksPage::$GoBackButton);
        $I->waitForText('Статусы обратных звонков');
    }
    
    
    public function RequiredFieldsInEditingSaveAndExitButton(CallbacksTester $I)
    {
        $I->amOnPage('/admin/components/run/shop/callbacks/statuses');
        $I->click('.//*[@id="orderStatusesList"]/section/div[2]/div/table/tbody/tr[1]/td[2]/a');
        $I->waitForText('Редактирование статуса обратного звонка');
        $I->fillField(CallbacksPage::$NameStatus, '');
        $I->click(CallbacksPage::$SaveAndExitButton);
        $I->see('Это поле обязательное.', './/*[@id="addCallbackStatusForm"]/div[1]/div/label');
        InitTest::ClearAllCach($I);
    }
    
    
    public function TypesOfSymbolsInEditing(CallbacksTester $I)
    {
        $I->amOnPage('/admin/components/run/shop/callbacks/statuses');
        $I->click('.//*[@id="orderStatusesList"]/section/div[2]/div/table/tbody/tr[1]/td[2]/a');
        $I->waitForText('Редактирование статуса обратного звонка');
        $I->fillField(CallbacksPage::$NameStatus, 'qwerrQEQE12345!#@$#%%^&*()_+|}{:">?<,./;][\\=-0ёцвцаымпУКП');
        $I->seeInField(CallbacksPage::$NameStatus, 'qwerrQEQE12345!#@$#%%^&*()_+|}{:">?<,./;][\\=-0ёцвцаымпУКП');
        $I->click(CallbacksPage::$SaveButton);
        $I->waitForElementVisible('.alert.in.fade.alert-success');
        $I->see('Изменения сохранены');
        $I->waitForElementNotVisible('.alert.in.fade.alert-success');
        $I->seeInField(CallbacksPage::$NameStatus, 'qwerrQEQE12345!#@$#%%^&*()_+|}{:">?<,./;][\\=-0ёцвцаымпУКП');
    }
    
    /**
     * @guy CallbacksTester\CallbacksSteps
     */
    
    public function OneSymbolsEditing(CallbacksTester\CallbacksSteps $I)
    {
        $name='q';
        $I->EditStatusCallback($name, $name);
        InitTest::ClearAllCach($I);
    }
    
    /**
     * @guy CallbacksTester\CallbacksSteps
     */
    
    public function Symbols128Editing(CallbacksTester\CallbacksSteps $I)
    {
        $name='12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцу';
        $I->EditStatusCallback($name, $name);
    }
    
    /**
     * @guy CallbacksTester\CallbacksSteps
     */
    
    public function Symbols255Editing(CallbacksTester\CallbacksSteps $I)
    {
        $name='12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345';
        $I->EditStatusCallback($name, $name);
        InitTest::ClearAllCach($I);
    }
    
    /**
     * @guy CallbacksTester\CallbacksSteps
     */
    
    public function Symbols256Editing(CallbacksTester\CallbacksSteps $I)
    {
        $name='12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке123456';
        $name1='12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345';
        $I->EditStatusCallback($name, $name1);
    }
    
    
    public function SaveAndExit(CallbacksTester $I)
    {
        $I->amOnPage('/admin/components/run/shop/callbacks/statuses');
        $I->click('.//*[@id="orderStatusesList"]/section/div[2]/div/table/tbody/tr[1]/td[2]/a');
        $I->waitForText('Редактирование статуса обратного звонка');
        $I->fillField(CallbacksPage::$NameStatus, 'sss');
        $I->click(CallbacksPage::$SaveAndExitButton);
        $I->waitForElementVisible('.alert.in.fade.alert-success');
        $I->see('Изменения сохранены');
        $I->waitForElementNotVisible('.alert.in.fade.alert-success');
        $I->waitForText('Статусы обратных звонков');
        $I->see('sss', './/*[@id="orderStatusesList"]/section/div[2]/div/table/tbody/tr[1]/td[2]/a');
        InitTest::ClearAllCach($I);
    }
    
    
}