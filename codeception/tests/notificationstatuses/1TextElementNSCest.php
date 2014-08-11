<?php
use \NotificationStatusesTester;
class TextElementNSCest
{
//---------------------------AUTORIZATION---------------------------------------
    /**
     * @group aaa
     */
    public function Login(NotificationStatusesTester $I){
        InitTest::Login($I);
    }
    

//-----------------------VERIFY LINKS BUTTONS-----------------------------------
    
    /**
     * @group a
     */
    public function VerifyWayNotfStatusesList (NotificationStatusesTester $I){
        $I->wantTo('Verify Way on Notification Statuses List Page.');
        $I->click(NavigationBarPage::$Orders);
        $I->click(NavigationBarPage::$NotificationStatuses);   
        $I->seeInCurrentUrl(NotificationStatusesPage::$ListPageURL);
    } 
    /**
     * @group a
     */
    public function VerifyWayNotfStatusesCreate1 (NotificationStatusesTester $I){
        $I->wantTo('Verify Way on Notification Statuses Create and Edit Page.');
        $I->wait('1');
        $I->click('//body/div[1]/div[3]/div/nav/ul/li[2]/a');
        $I->click('//body/div[1]/div[3]/div/nav/ul/li[2]/ul/li[10]/a');
        $I->seeInCurrentUrl('/admin/components/run/shop/notificationstatuses');
        $I->wait('1');
        $I->click('//body/div[1]/div[5]/div/div[3]/section/div[1]/div[2]/div/a');
        $I->seeInCurrentUrl('/admin/components/run/shop/notificationstatuses/create');
    } 
    /**
     * @group a
     */
    public function VerifyWayNotfStatusesCreate2 (NotificationStatusesTester $I){
        $I->wantTo('Verify Way on Notification Statuses Create and Edit Page.');
        $I->amOnPage('/admin/components/run/shop/notificationstatuses/create');
        $I->click('//body/div[1]/div[5]/div/section/div/div[2]/div/a');
        $I->wait('1');
        $I->seeInCurrentUrl('/admin/components/run/shop/notificationstatuses');
        
    } 
    /**
     * @group a
     */
    public function VerifyWayNotfStatusesEdit1 (NotificationStatusesTester $I){
        $I->wantTo('Verify Way on Notification Statuses Create and Edit Page.');
        $I->amOnPage('/admin/components/run/shop/notificationstatuses');
        $I->click('//body/div[1]/div[5]/div/div[3]/section/div[2]/table/tbody/tr[1]/td[3]/a');
        $I->seeInCurrentUrl('/components/run/shop/notificationstatuses/edit');
        $I->click('//body/div[1]/div[5]/div/section/div[1]/div[2]/div/a');
        $I->seeInCurrentUrl('/admin/components/run/shop/notificationstatuses');
    } 
    
    

//-----------------------VERIFY TEXT LIST PAGE----------------------------------
    
    /**
     * @group a
     */
    public function VerifyTextListPage (NotificationStatusesTester $I){
        $I->wantTo('Verify Text on Notification Statuses List Page.');
        $I->amOnPage(NotificationStatusesPage::$ListPageURL);
        $I->see('Статусы уведомлений о появлении', NotificationStatusesPage::$ListTitle );
        $I->see('Создать статус', NotificationStatusesPage::$ListButtonCreate);
        $I->see('Удалить', NotificationStatusesPage::$ListButtonDelete);
        $I->see('Новый',  NotificationStatusesPage::$ListNameFirstStatuse);
        $I->see('Выполнен',  NotificationStatusesPage::$ListNameSecondStatuse);
        $I->see('ID',  NotificationStatusesPage::$ListNameFirstCollum);
        $I->see('Имя', NotificationStatusesPage::$ListNameSecondCollum);
        $I->see('Позиция',  NotificationStatusesPage::$ListNameThirdCollum);
    }   
    
    
    
//-----------------------VERIFY TEXT MESSAGE LIST PAGE--------------------------
    
    /**
     * @group a
     */
    public function VerifyTextMessage (NotificationStatusesTester $I){
        $I->wantTo('Verify Text Message at Focus Cursor on Notification Statuses Name.');
        $I->amOnPage(NotificationStatusesPage::$ListPageURL);
        $I->moveMouseOver(NotificationStatusesPage::$ListLinkEditing);
        $I->waitForText('Редактировать статус уведомления');
        $I->see('Редактировать статус уведомления', 'div.tooltip-inner');
        $I->moveMouseOver(NotificationStatusesPage::$ListButtonCreate);
    }

    
    
//-----------------------VERIFY TEXT DELETE WINDOW------------------------------
    
    /**
     * @group a
     */
    public function VerifyTextDeleteWindow (NotificationStatusesTester $I){
        $I->wantTo('Verify Text on Delete Window.');
        $I->amOnPage(NotificationStatusesPage::$ListPageURL);
        $I->click(NotificationStatusesPage::$ListHeaderCheckBox);
        $I->click(NotificationStatusesPage::$ListButtonDelete);
        $I->waitForText('Удаление статуса', '5', NotificationStatusesPage::$DeleteWindowTitle);
        $I->seeElement(NotificationStatusesPage::$DeleteWindow);
        $I->see('Удаление статуса',  NotificationStatusesPage::$DeleteWindowTitle);
        $I->see('Удалить ваш статус?', NotificationStatusesPage::$DeleteWindowMassege);
        $I->see('Удалить', NotificationStatusesPage::$DeleteWindowButtonDelete);
        $I->see('Отменить', NotificationStatusesPage::$DeleteWindowButtonCancel);
        $I->see('×', NotificationStatusesPage::$DeleteWindowButtonX);   
    }

    
    
//-----------------------VERIFY TEXT CREATING PAGE------------------------------
    
    /**
     * @group a
     */
    public function VerifyTextCreatePage (NotificationStatusesTester $I){
        $I->wantTo('Verify Text on Create Sataus Page.');
        $I->amOnPage(NotificationStatusesPage::$CreatePageUrl);
        $I->see('Создание статуса уведомления о появлении', NotificationStatusesPage::$CreationNameTitle);
        $I->see('Вернуться', NotificationStatusesPage::$CreationButtonBack );
        $I->see('Создать',  NotificationStatusesPage::$CreationButtonCreate);
        $I->see('Создать и выйти',  NotificationStatusesPage::$CreationButtonCreateAndGoBack);        
        $I->see('Общая информация',  NotificationStatusesPage::$CreationNameBlock);        
        $I->see('Название',  NotificationStatusesPage::$CreationNameFild);        
    }

    
    
//-----------------------VERIFY TEXT EDITING PAGE-------------------------------
    
    /**
     * @group a
     */
    public function VerifyTextEditPage (NotificationStatusesTester $I){
        $I->wantTo('Verify Text on Edit Status Page.');
        $I->amOnPage(NotificationStatusesPage::$EditingPageURL);
        $I->see('Редактирование статуса уведомления о появлении',  NotificationStatusesPage::$EditingNameTitle);
        $I->see('Вернуться',  NotificationStatusesPage::$EditingButtonBack);
        $I->see('Сохранить',  NotificationStatusesPage::$EditingButtonSave);
        $I->see('Сохранить и выйти',  NotificationStatusesPage::$EditingButtonSaveAndGoBack);
        $I->see('Данные статуса уведомления о появлении',  NotificationStatusesPage::$EditingNameBlock);
        $I->see('Название',  NotificationStatusesPage::$EditingNameFild);
    }

    
    
//-------------VERIFY TEXT ALERT MESSAGE CREATING PAGE--------------------------
    
    /**
     * @group a
     */
    public function VerifyTextAlertMessageCreatingPage (NotificationStatusesTester $I){
        $I->wantTo('Verify Alert Message Present on Create Status Page.');
        $I->amOnPage(NotificationStatusesPage::$CreatePageUrl);
        $I->click('Создать');
        $I->seeElement(NotificationStatusesPage::$CreationAlertMessage);    
    }

    
    
//-----------------------VERIFY TEXT CREATE MESSAGE-----------------------------
    
    /**
     * @group aaa
     */
    public function VerifyTextCreateMessageCreatingPage (NotificationStatusesTester $I){
        $I->wantTo('Verify Message About Creating Status.');
        $I->amOnPage(NotificationStatusesPage::$CreatePageUrl);
        $I->fillField(NotificationStatusesPage::$CreationFildInput,'qwe 123 !@# ЯЧС');
        $I->click(NotificationStatusesPage::$CreationButtonCreate);
        $I->exactlySeeAlert($I, 'success', 'Статус ожидания создан');
        $I->wait('1');
    }

    
    
//--------------VERIFY TEXT ALERT MESSAGE EDITING PAGE--------------------------
    
    /**
     * @group aaa
     */
    public function VerifyTextAlertMessageEdictingPage (NotificationStatusesTester $I){
        $I->wantTo('Verify Alert Message.');
        $I->amOnPage(NotificationStatusesPage::$ListPageURL);
        $I->wait('1');
        $I->click('Выполнен');
        $I->waitForElement(NotificationStatusesPage::$EditingFildInput);
        $I->fillField(NotificationStatusesPage::$EditingFildInput,'');
        $I->click('.btn.btn-small.btn-primary.action_on.formSubmit');
        $I->waitForElement(NotificationStatusesPage::$CreationAlertMessage);
        $I->seeElement(NotificationStatusesPage::$CreationAlertMessage);    
    }

    
    
//-----------------------VERIFY TEXT EDITING MESSAGE----------------------------
    
    /**
     * @group a
     */
     public function VerifyTextEdicttMessageEdictingPage (NotificationStatusesTester $I){
        $I->wantTo('Verify Alert Message Present on Edit Status Page.');
        $I->amOnPage(NotificationStatusesPage::$ListPageURL);
        $I->waitForElement(NotificationStatusesPage::$ListLinkForEditing);
        $I->click(NotificationStatusesPage::$ListLinkForEditing);
        $I->fillField(NotificationStatusesPage::$EditingFildInput,'ХоЛеСтеРИннн 123123123');
        $I->click(NotificationStatusesPage::$EditingButtonSave);
        $I->wait('1');
        $I->exactlySeeAlert($I, 'success', 'Изменения сохранены');
//        $I->see('Изменения сохранены',NotificationStatusesPage::$EdictingEdictMessage);
        $I->wait('1');
    }

    
    
//------------VERIFY TEXT DELETING MESSAGE LIST PAGE----------------------------
    
    /**
     * @group a
     */
    public function VerifyTextMessageDeletingStatus (NotificationStatusesTester $I){
        $I->wantTo('Verify Message About Deleting Status Present.');
        $I->amOnPage(NotificationStatusesPage::$ListPageURL);
        $I->waitForElement(NotificationStatusesPage::$ListHeaderCheckBox);
        $I->click(NotificationStatusesPage::$ListHeaderCheckBox);
        $I->click(NotificationStatusesPage::$ListCheckBoxFirst);
        $I->click(NotificationStatusesPage::$ListCheckBoxSecond); 
        $I->click(NotificationStatusesPage::$ListButtonDelete); 
        $I->wait(1);
        $I->click(NotificationStatusesPage::$DeleteWindowButtonDelete);
        $I->waitForText('Статус удален');
        InitTest::ClearAllCach($I);      
    }   
    
    
    
}