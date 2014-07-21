<?php
use \AcceptanceTester;
class TextElementOSCest
{
//---------------------------AUTORIZATION---------------------------------------   
    
    public function Login(AcceptanceTester $I){
        InitTest::Login($I);
    }
    
    
//---------------------------ORDER STATUS CREATE PAGE WAY-----------------------
    
    public function  WayCreateOS (AcceptanceTester $I){       
        $I->amOnPage(OrderStatusesPage::$ListURL);
        $I->click(OrderStatusesPage::$ListaButtonCreateStatuse);
        $I->seeInCurrentUrl(OrderStatusesPage::$CreateURL);
        $I->amOnPage(OrderStatusesPage::$ListURL);
    }
    
    
    
//---------------------------ORDER STATUS EDIT PAGE WAY-------------------------
    
    public function  WayEditOS (AcceptanceTester $I){       
        $I->amOnPage(OrderStatusesPage::$ListURL);
        $I->click(OrderStatusesPage::$ListLinkStstusTr1);
        $I->see('Редактирование статуса заказа', OrderStatusesPage::$EditTitle);
    }
    
    
//---------------------------ORDER STATUS LIST PAGE WAY-------------------------
    
    public function  WayListOS (AcceptanceTester $I){       
        $I->click(NavigationBarPage::$Orders);
        $I->click(NavigationBarPage::$OrderStatuses);
        $I->seeInCurrentUrl(OrderStatusesPage::$ListURL);
    } 
    
    
//---------------------------TEXT PRESENCE LIST PAGE----------------------------
    
    
    public function  TextPresenceList (AcceptanceTester $I){       
        $I->amOnPage(OrderStatusesPage::$ListURL);
        $I->see('Статусы заказов', OrderStatusesPage::$ListTitle);
        $I->see('Создать статус', OrderStatusesPage::$ListaButtonCreateStatuse);
        $I->see('ID', OrderStatusesPage::$ListColumnID);
        $I->see('Название', OrderStatusesPage::$ListColumnName);
        $I->see('Цвет фона', OrderStatusesPage::$ListCollumBackColor);
        $I->see('Цвет шрифта', OrderStatusesPage::$ListCollumFontColor);
        $I->see('Удалить', OrderStatusesPage::$ListColumnDelete);
    }
    
    
//-------------------TEXT MESSAGE MOUSE FOCUS LIST PAGE-------------------------
    
    
    public function  MouseMessage (AcceptanceTester $I){
        $I->amOnPage(OrderStatusesPage::$ListURL);
        $I->moveMouseOver(OrderStatusesPage::$ListLinkStstusTr1);
        $I->wait(1);
        $I->see('Редактировать статус', OrderStatusesPage::$ListMessageMouseFocuse);
        $I->moveMouseOver(OrderStatusesPage::$ListaButtonCreateStatuse);
        $I->waitForElementNotVisible(OrderStatusesPage::$ListMessageMouseFocuse);
        $I->dontSeeElement(OrderStatusesPage::$ListMessageMouseFocuse);
    }
    
    
    
//--------------------TEXT PRESENCE CREATING PAGE-------------------------------
    
    
    public function TextPresenceCrate(AcceptanceTester $I){
        $I->amOnPage(OrderStatusesPage::$CreateURL);
        $I->see('Создание статуса заказа', OrderStatusesPage::$CreateTitle);
        $I->see('Вернуться', OrderStatusesPage::$CreateButtonBack);
        $I->see('Создать', OrderStatusesPage::$CreateButtonCreate);
        $I->see('Создать и выйти', OrderStatusesPage::$CreateButtonCreateAndGoBack);
        $I->see('Информация', OrderStatusesPage::$CreateNameBlock);
        $I->see('Название', OrderStatusesPage::$CreateNameFieldName);
        $I->see('Цвет фона', OrderStatusesPage::$CreateNameFieldColor);
        $I->see('Цвет шрифта', OrderStatusesPage::$CreateNameFieldColorFont);
    }
    
    
    
//--------------------ELEMENT PRESENCE CREATING PAGE----------------------------
    
    
    public function ElementPresenceCreate(AcceptanceTester $I){
        $I->amOnPage(OrderStatusesPage::$CreateURL);        
        $I->seeElement(OrderStatusesPage::$CreateFieldName);
        $I->seeElement(OrderStatusesPage::$CreateNameFieldColor);
        $I->seeElement(OrderStatusesPage::$CreateNameFieldColorFont);
    }
    
    
    
//---------------ALERT MESSAGE PRESENCE CREATING PAGE---------------------------
    
    
    public function AlertMessageCreate(AcceptanceTester $I){
        $I->amOnPage(OrderStatusesPage::$CreateURL);        
        $I->fillField(OrderStatusesPage::$CreateFieldName, '');
        $I->click(OrderStatusesPage::$CreateButtonCreateAndGoBack);
        $I->seeElement(OrderStatusesPage::$CreateMessageAlertFild);        
        $I->fillField(OrderStatusesPage::$CreateFieldName, '123');
        $I->dontSeeElement(OrderStatusesPage::$EditNessageAlert);        
    } 
    
    
//---------------------MESSAGE CREATING STATUS----------------------------------
    
    
    public function MessageCreateStatus(AcceptanceTester $I){
        $I->amOnPage(OrderStatusesPage::$CreateURL);
        $I->fillField(OrderStatusesPage::$CreateFieldName, 'ZavorotkiShock');
        $I->click(OrderStatusesPage::$CreateButtonCreate);
        $I->waitForElement(OrderStatusesPage::$CreateMessageCreatingStatus);
        $I->see('Статус заказа создан', OrderStatusesPage::$CreateMessageCreatingStatus);
    }   
    
    
//------------------TEXT PRESENCE EDITING PAGE----------------------------------
    
    
    public function TextPresenceEdit(AcceptanceTester $I){
        $I->amOnPage(OrderStatusesPage::$ListURL);
        $I->amOnPage(OrderStatusesPage::$ListURL);
        $I->click(OrderStatusesPage::$ListLinkStstusTr1);
        $I->see('Редактирование статуса заказа', OrderStatusesPage::$EditTitle);
        $I->see('Вернуться', OrderStatusesPage::$EditButtonBack);
        $I->see('Сохранить', OrderStatusesPage::$EditButtonSave);
        $I->see('Сохранить и выйти', OrderStatusesPage::$EditButtonSaveAndGoBack);
        $I->see('Информация', OrderStatusesPage::$EditNameBlock);
        $I->see('Название', OrderStatusesPage::$EditNameFieldName);
        $I->see('Цвет фона', OrderStatusesPage::$EditNameFieldColor);
        $I->see('Цвет шрифта', OrderStatusesPage::$EditNameFieldColorFont);
    }
    
    
    
//---------------ELEMENT PRESENCE EDITING PAGE----------------------------------
    
    
    public function ElementPresenceEdit(AcceptanceTester $I){
        $I->amOnPage(OrderStatusesPage::$ListURL);
        $I->click(OrderStatusesPage::$ListLinkStstusTr1);
        $I->seeElement(OrderStatusesPage::$EditFieldName);
        $I->seeElement(OrderStatusesPage::$EditFieldColor);
        $I->seeElement(OrderStatusesPage::$EditNameFieldColorFont);
    }
    
    
//---------------ALERT MESSAGE PRESENCE EDITING PAGE----------------------------
    
    
    public function AlertMessageEdit(AcceptanceTester $I){
        $I->amOnPage(OrderStatusesPage::$ListURL);
        $I->click(OrderStatusesPage::$EditLinkEditing);
        $I->fillField(OrderStatusesPage::$EditFieldName, '');
        $I->click(OrderStatusesPage::$EditButtonSaveAndGoBack);
        $I->seeElement(OrderStatusesPage::$EditNessageAlert);        
        $I->fillField(OrderStatusesPage::$EditFieldName, '123');
        $I->dontSeeElement(OrderStatusesPage::$EditNessageAlert);        
    } 
    
    
//---------------ALERT MESSAGE FOR EDITING STATUS-------------------------------
    
    
    public function EditingMessageEdit(AcceptanceTester $I){
        $I->amOnPage(OrderStatusesPage::$ListURL);
        $I->click(OrderStatusesPage::$ListLinkStatusTr2);
        $I->click(OrderStatusesPage::$EditButtonSaveAndGoBack);
        $I->wait(1);
        $I->see('Изменения сохранены', OrderStatusesPage::$EditMessageEditingStatus);
    }
    
    
//---------------TEXT ELEMENT PRESENCE DELETING PAGE----------------------------
    
    
    public function TextElementDeletingWindow(AcceptanceTester $I){
        $I->amOnPage(OrderStatusesPage::$ListURL);
        $I->click(OrderStatusesPage::$ListButtonDelete);
        $I->waitForText('Удаление статуса заказа', '3', OrderStatusesPage::$DeleteTitle);
        $I->seeElement(OrderStatusesPage::$DeleteWindow);
        $I->see('Удаление статуса заказа', OrderStatusesPage::$DeleteTitle);
        $I->see('Вы действительно хотите удалить статус?', OrderStatusesPage::$DeleteMessage);
        $I->see('Удалить', OrderStatusesPage::$DeleteButtonDelete);
        $I->see('Отменить', OrderStatusesPage::$DeleteButtonCancel);
        $I->see('×', OrderStatusesPage::$DeleteButtonX);
    }
    
    
//---------------------BUTTON DELETING WINDOW-----------------------------------
    
    
    public function ButtonDeletingWindow(AcceptanceTester $I){
        $I->amOnPage(OrderStatusesPage::$ListURL);
        $I->click(OrderStatusesPage::$ListButtonDelete);
        $I->wait(1);
        $I->seeElement(OrderStatusesPage::$DeleteWindow);
        $I->click(OrderStatusesPage::$DeleteButtonCancel);
        $I->wait(1);
        $I->dontSeeElement(OrderStatusesPage::$DeleteWindow);
        $I->click(OrderStatusesPage::$ListButtonDelete);
        $I->wait(1);
        $I->seeElement(OrderStatusesPage::$DeleteWindow);
        $I->click(OrderStatusesPage::$DeleteButtonX);
    }
    
    
    
//---------------------MESSAGE FOR DELETING STATUS------------------------------
    
    
    public function MessageDeletingStatusWindow(AcceptanceTester $I){
        $I->amOnPage(OrderStatusesPage::$ListURL);
        $I->click(OrderStatusesPage::$ListButtonDelete);
        $I->wait(1);
        $I->click(OrderStatusesPage::$DeleteButtonDelete);
        $I->wait(1);
        $I->see('Статус удален', OrderStatusesPage::$DeleteMessageDeleting);
    } 
    
    
    
} 
