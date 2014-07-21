<?php
use \AcceptanceTester;

class EditingStatusCallbackCest
{
//    public function _before()
//    {
//    }
//
//    public function _after()
//    {
//    }

    public function Autorization(AcceptanceTester $I)
    {
        InitTest::Login($I);
        $I->amOnPage("/admin/components/run/shop/callbacks/statuses");
        $I->waitForText("Статусы обратных звонков");
    }
    
    
    public function NamesInEditing(AcceptanceTester $I)
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
    
    
    public function RequiredFieldsInEditingSaveButton(AcceptanceTester $I)
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
    
    
    public function RequiredFieldsInEditingSaveAndExitButton(AcceptanceTester $I)
    {
        //$I->amOnPage('/admin/components/run/shop/callbacks/statuses');
        $I->click('.//*[@id="orderStatusesList"]/section/div[2]/div/table/tbody/tr[1]/td[2]/a');
        $I->waitForText('Редактирование статуса обратного звонка');
        $I->fillField(CallbacksPage::$NameStatus, '');
        $I->click(CallbacksPage::$SaveAndExitButton);
        $I->see('Это поле обязательное.', './/*[@id="addCallbackStatusForm"]/div[1]/div/label');
        InitTest::ClearAllCach($I);
    }
    
    
    public function TypesOfSymbolsInEditing(AcceptanceTester $I)
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
    
    
    public function OneSymbolsEditing(AcceptanceTester $I)
    {
        $I->amOnPage('/admin/components/run/shop/callbacks/statuses');
        $I->click('.//*[@id="orderStatusesList"]/section/div[2]/div/table/tbody/tr[1]/td[2]/a');
        $I->waitForText('Редактирование статуса обратного звонка');
        $I->fillField(CallbacksPage::$NameStatus, 'q');
        $I->click(CallbacksPage::$SaveButton);
        $I->waitForElementVisible('.alert.in.fade.alert-success');
        $I->see('Изменения сохранены');
        $I->waitForElementNotVisible('.alert.in.fade.alert-success');
        $I->seeInField(CallbacksPage::$NameStatus, 'q');
        InitTest::ClearAllCach($I);
    }
    
    
    public function Symbols128Editing(AcceptanceTester $I)
    {
        $I->amOnPage('/admin/components/run/shop/callbacks/statuses');
        $I->click('.//*[@id="orderStatusesList"]/section/div[2]/div/table/tbody/tr[1]/td[2]/a');
        $I->waitForText('Редактирование статуса обратного звонка');
        $I->fillField(CallbacksPage::$NameStatus, '12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцу');
        $I->click(CallbacksPage::$SaveButton);
        $I->waitForElementVisible('.alert.in.fade.alert-success');
        $I->see('Изменения сохранены');
        $I->waitForElementNotVisible('.alert.in.fade.alert-success');
        $I->seeInField(CallbacksPage::$NameStatus, '12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцу');
    }
    
    
    public function Symbols255Editing(AcceptanceTester $I)
    {
        $I->amOnPage('/admin/components/run/shop/callbacks/statuses');
        $I->click('.//*[@id="orderStatusesList"]/section/div[2]/div/table/tbody/tr[1]/td[2]/a');
        $I->waitForText('Редактирование статуса обратного звонка');
        $I->fillField(CallbacksPage::$NameStatus, '12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345');
        $I->click(CallbacksPage::$SaveButton);
        $I->waitForElementVisible('.alert.in.fade.alert-success');
        $I->see('Изменения сохранены');
        $I->waitForElementNotVisible('.alert.in.fade.alert-success');
        $I->seeInField(CallbacksPage::$NameStatus, '12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345');
        InitTest::ClearAllCach($I);
    }
    
    
    public function Symbols256Editing(AcceptanceTester $I)
    {
        $I->amOnPage('/admin/components/run/shop/callbacks/statuses');
        $I->click('.//*[@id="orderStatusesList"]/section/div[2]/div/table/tbody/tr[1]/td[2]/a');
        $I->waitForText('Редактирование статуса обратного звонка');
        $I->fillField(CallbacksPage::$NameStatus, '12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке123456');
        $I->click(CallbacksPage::$SaveButton);
        $I->waitForElementVisible('.alert.in.fade.alert-success');
        $I->see('Изменения сохранены');
        $I->waitForElementNotVisible('.alert.in.fade.alert-success');
        $I->seeInField(CallbacksPage::$NameStatus, '12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345йцуке12345');
    }
    
    
    public function SaveAndExit(AcceptanceTester $I)
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