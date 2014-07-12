<?php
use \AcceptanceTester;
class TextElementCest
{
    /**
     * @group Verify
     */
//---------------------------AUTORIZATION---------------------------------------
    public function Login(AcceptanceTester $I){
        InitTest::Login($I);
    }
    /**
     * @group Verify
     */
//-----------------------VERIFY LINKS BUTTONS-----------------------------------
    public function VerifyLinkNotfStatuses (AcceptanceTester $I){
        $I->click(NavigationBarPage::$Orders);
        $I->click(NavigationBarPage::$NotificationStatuses);   
        $I->seeInCurrentUrl(NotificationStatusesPage::$ListPageURL);
        $I->click(NotificationStatusesPage::$ListButtonCreate);
        $I->seeInCurrentUrl(NotificationStatusesPage::$CreatePageUrl);
        $I->click(NotificationStatusesPage::$CreationButtonBack);
        $I->seeInCurrentUrl(NotificationStatusesPage::$ListPageURL);
        $I->click(NotificationStatusesPage::$ListLinkEditing);
        $I->seeInCurrentUrl(NotificationStatusesPage::$EditingPageURL);
        $I->click(NotificationStatusesPage::$EditingButtonBack);
        $I->seeInCurrentUrl(NotificationStatusesPage::$ListPageURL);
        $I->click(NotificationStatusesPage::$ListHeaderCheckBox);
        $I->click(NotificationStatusesPage::$ListButtonDelete);
        $I->click('button.close');
        $I->click(NotificationStatusesPage::$ListButtonDelete);
        $I->click('//div[3]/a[2]');
    }    
    /**
     * @group Verify
     */
//-----------------------VERIFY TEXT LIST PAGE----------------------------------
    public function VerifyTextListPage (AcceptanceTester $I){
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
    public function VerifyTextMessage (AcceptanceTester $I){
        $I->amOnPage(NotificationStatusesPage::$ListPageURL);
        $I->moveMouseOver(NotificationStatusesPage::$ListLinkEditing);
        $I->waitForText('Редактировать статус уведомления');
        $I->see('Редактировать статус уведомления', 'div.tooltip-inner');
        $I->moveMouseOver(NotificationStatusesPage::$ListButtonCreate);
    }
    /**
     * @group Verify
     */
//-----------------------VERIFY TEXT DELETE WINDOW------------------------------
    public function VerifyTextDeleteWindow (AcceptanceTester $I){
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
    /**
     * @group Verify
     */
//-----------------------VERIFY TEXT CREATING PAGE------------------------------
    public function VerifyTextCreatePage (AcceptanceTester $I){
        $I->amOnPage(NotificationStatusesPage::$CreatePageUrl);
        $I->see('Создание статуса уведомления о появлении', NotificationStatusesPage::$CreationNameTitle);
        $I->see('Вернуться', NotificationStatusesPage::$CreationButtonBack );
        $I->see('Создать',  NotificationStatusesPage::$CreationButtonCreate);
        $I->see('Создать и выйти',  NotificationStatusesPage::$CreationButtonCreateAndGoBack);        
        $I->see('Общая информация',  NotificationStatusesPage::$CreationNameBlock);        
        $I->see('Название',  NotificationStatusesPage::$CreationNameFild);        
    }
    /**
     * @group Verify
     */
//-----------------------VERIFY TEXT EDITING PAGE-------------------------------
    public function VerifyTextEditPage (AcceptanceTester $I){
        $I->amOnPage(NotificationStatusesPage::$EditingPageURL);
        $I->see('Редактирование статуса уведомления о появлении',  NotificationStatusesPage::$EditingNameTitle);
        $I->see('Вернуться',  NotificationStatusesPage::$EditingButtonBack);
        $I->see('Сохранить',  NotificationStatusesPage::$EditingButtonSave);
        $I->see('Сохранить и выйти',  NotificationStatusesPage::$EditingButtonSaveAndGoBack);
        $I->see('Данные статуса уведомления о появлении',  NotificationStatusesPage::$EditingNameBlock);
        $I->see('Название',  NotificationStatusesPage::$EditingNameFild);
    }
    /**
     * @group Verify
     */    
//-------------VERIFY TEXT ALERT MESSAGE CREATING PAGE--------------------------
    public function VerifyTextAlertMessageCreatingPage (AcceptanceTester $I){
        $I->amOnPage(NotificationStatusesPage::$CreatePageUrl);
        $I->click('Создать');
        $I->seeElement(NotificationStatusesPage::$CreationAlertMessage);    
    }
    /**
     * @group Verify
     */    
//-----------------------VERIFY TEXT CREATE MESSAGE-----------------------------
    public function VerifyTextCreateMessageCreatingPage (AcceptanceTester $I){
        $I->amOnPage(NotificationStatusesPage::$CreatePageUrl);
        $I->fillField(NotificationStatusesPage::$CreationFildInput,'qwe 123 !@# ЯЧС');
        $I->click(NotificationStatusesPage::$CreationButtonCreate);
        $I->see('Сообщение',NotificationStatusesPage::$CreationCreateMessage); 
        $I->wait('1');
    }
    /**
     * @group Verify
     */
//--------------VERIFY TEXT ALERT MESSAGE EDITING PAGE--------------------------
    public function VerifyTextAlertMessageEdictingPage (AcceptanceTester $I){
        $I->amOnPage(NotificationStatusesPage::$ListPageURL);
        $I->waitForElement(NotificationStatusesPage::$ListLinkForEditing);
        $I->click(NotificationStatusesPage::$ListLinkForEditing);
        $I->fillField(NotificationStatusesPage::$EditingFildInput,'');
        $I->click('//button[1]');
        $I->seeElement(NotificationStatusesPage::$CreationAlertMessage);    
    }
    /**
     * @group Verify
     */    
//-----------------------VERIFY TEXT EDITING MESSAGE----------------------------
     public function VerifyTextEdicttMessageEdictingPage (AcceptanceTester $I){
        $I->amOnPage(NotificationStatusesPage::$ListPageURL);
        $I->waitForElement(NotificationStatusesPage::$ListLinkForEditing);
        $I->click(NotificationStatusesPage::$ListLinkForEditing);
        $I->fillField(NotificationStatusesPage::$EditingFildInput,'ХоЛеСтеРИннн 123123123');
        $I->click(NotificationStatusesPage::$EditingButtonSave);
        $I->see('Сообщение',NotificationStatusesPage::$EdictingEdictMessage);
        $I->wait('1');
    }
    /**
     * @group Verify
     */
//------------VERIFY TEXT DELETING MESSAGE LIST PAGE----------------------------
    public function VerifyTextMessageDeletingStatus (AcceptanceTester $I){
        $I->amOnPage(NotificationStatusesPage::$ListPageURL);
        $I->waitForElement(NotificationStatusesPage::$ListHeaderCheckBox);
        $I->click(NotificationStatusesPage::$ListHeaderCheckBox);
        $I->click(NotificationStatusesPage::$ListCheckBoxFirst);
        $I->click(NotificationStatusesPage::$ListCheckBoxSecond); 
        $I->click(NotificationStatusesPage::$ListButtonDelete); 
        $I->click(NotificationStatusesPage::$DeleteWindowButtonDelete);
        $I->waitForText('Статус удален');
        InitTest::ClearAllCach($I);      
    }     
}