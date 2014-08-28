<?php
use \OrderStatusesTester;
class TextElementOSCest
{
//---------------------------AUTORIZATION---------------------------------------   
    /**
     * @group aaa
     */
    public function Login(OrderStatusesTester $I){
        InitTest::Login($I);
    }
    
    
//---------------------------ORDER STATUS CREATE PAGE WAY-----------------------
    /**
     * @group a
     */
    public function  WayCreateOS (OrderStatusesTester $I){    
        $I->wantTo('Verify Way to Create Status Page.');
        $I->amOnPage(OrderStatusesListPage::$ListURL);
        $I->click(OrderStatusesListPage::$ListaButtonCreateStatuse);
        $I->seeInCurrentUrl(OrderStatusesCreatePage::$CreateURL);
        $I->amOnPage(OrderStatusesListPage::$ListURL);
    }
    
    
    
//---------------------------ORDER STATUS EDIT PAGE WAY-------------------------
    /**
     * @group a
     */
    public function  WayEditOS (OrderStatusesTester $I){ 
        $I->wantTo('Verify Way to Editing Status Page.');
        $I->amOnPage(OrderStatusesListPage::$ListURL);
        $I->click(OrderStatusesListPage::$ListLinkStstusTr1);
        $I->wait('1');
        $I->see('Редактирование статуса заказа', OrderStatusesCreatePage::$EditTitle);
    }
    
    
//---------------------------ORDER STATUS LIST PAGE WAY-------------------------
    /**
     * @group a
     */
    public function  WayListOS (OrderStatusesTester $I){   
        $I->wantTo('Verify Way to Status List Page.');
        $I->click(NavigationBarPage::$Orders);
        $I->click(NavigationBarPage::$OrderStatuses);
        $I->seeInCurrentUrl(OrderStatusesListPage::$ListURL);
    } 
    
    
//---------------------------TEXT PRESENCE LIST PAGE----------------------------
    
    /**
     * @group a
     */
    public function  TextPresenceList (OrderStatusesTester $I){    
        $I->wantTo('Verify Text Present on Status List Page.');
        $I->amOnPage(OrderStatusesListPage::$ListURL);
        $I->see('Статусы заказов', OrderStatusesListPage::$ListTitle);
        $I->see('Создать статус', OrderStatusesListPage::$ListaButtonCreateStatuse);
        $I->see('ID', OrderStatusesListPage::$ListColumnID);
        $I->see('Название', OrderStatusesListPage::$ListColumnName);
        $I->see('Цвет фона', OrderStatusesListPage::$ListCollumBackColor);
        $I->see('Цвет шрифта', OrderStatusesListPage::$ListCollumFontColor);
        $I->see('Удалить', OrderStatusesListPage::$ListColumnDelete);
    }
    
    
//-------------------TEXT MESSAGE MOUSE FOCUS LIST PAGE-------------------------
    
    /**
     * @group a
     */
    public function  MouseMessage (OrderStatusesTester $I){
        $I->wantTo('Verify Message When Focus Cursor on Name Status.');
        $I->amOnPage(OrderStatusesListPage::$ListURL);
        $I->moveMouseOver(OrderStatusesListPage::$ListLinkStstusTr1);
        $I->wait(1);
        $I->see('Редактировать статус', OrderStatusesListPage::$ListMessageMouseFocuse);
        $I->moveMouseOver(OrderStatusesListPage::$ListaButtonCreateStatuse);
        $I->waitForElementNotVisible(OrderStatusesListPage::$ListMessageMouseFocuse);
        $I->dontSeeElement(OrderStatusesListPage::$ListMessageMouseFocuse);
    }
    
    
    
//--------------------TEXT PRESENCE CREATING PAGE-------------------------------
    
    /**
     * @group a
     */
    public function TextPresenceCrate(OrderStatusesTester $I){
        $I->wantTo('Verify Text Present on Create Status Page.');
        $I->amOnPage(OrderStatusesCreatePage::$CreateURL);
        $I->see('Создание статуса заказа', OrderStatusesCreatePage::$CreateTitle);
        $I->see('Вернуться', OrderStatusesCreatePage::$CreateButtonBack);
        $I->see('Создать', OrderStatusesCreatePage::$CreateButtonCreate);
        $I->see('Создать и выйти', OrderStatusesCreatePage::$CreateButtonCreateAndGoBack);
        $I->see('Информация', OrderStatusesCreatePage::$CreateNameBlock);
        $I->see('Название', OrderStatusesCreatePage::$CreateNameFieldName);
        $I->see('Цвет фона', OrderStatusesCreatePage::$CreateNameFieldColor);
        $I->see('Цвет шрифта', OrderStatusesCreatePage::$CreateNameFieldColorFont);
    }
    
    
    
//--------------------ELEMENT PRESENCE CREATING PAGE----------------------------
    
    /**
     * @group a
     */
    public function ElementPresenceCreate(OrderStatusesTester $I){
        $I->wantTo('Verify Element Present on Create Status Page.');
        $I->amOnPage(OrderStatusesCreatePage::$CreateURL);        
        $I->seeElement(OrderStatusesCreatePage::$CreateFieldName);
        $I->seeElement(OrderStatusesCreatePage::$CreateNameFieldColor);
        $I->seeElement(OrderStatusesCreatePage::$CreateNameFieldColorFont);
    }
    
    
    
//---------------ALERT MESSAGE PRESENCE CREATING PAGE---------------------------
    
    /**
     * @group a
     */
    public function AlertMessageCreate(OrderStatusesTester $I){
        $I->wantTo('Verify Alert Message Present on Create Status Page.');
        $I->amOnPage(OrderStatusesCreatePage::$CreateURL);        
        $I->fillField(OrderStatusesCreatePage::$CreateFieldName, '');
        $I->click(OrderStatusesCreatePage::$CreateButtonCreateAndGoBack);
        $I->seeElement(OrderStatusesCreatePage::$CreateMessageAlertFild);        
        $I->fillField(OrderStatusesCreatePage::$CreateFieldName, '123');
        $I->dontSeeElement(OrderStatusesCreatePage::$EditNessageAlert);        
    } 
    
    
//---------------------MESSAGE CREATING STATUS----------------------------------
    
    /**
     * @group a
     */
    public function MessageCreateStatus(OrderStatusesTester $I){
        $I->wantTo('Verify Message Cteation Status Present.');
        $I->amOnPage(OrderStatusesCreatePage::$CreateURL);
        $I->fillField(OrderStatusesCreatePage::$CreateFieldName, 'ZavorotkiShock');
        $I->click(OrderStatusesCreatePage::$CreateButtonCreate);
        $I->waitForElement(OrderStatusesCreatePage::$CreateMessageCreatingStatus);
        $I->see('Статус заказа создан', OrderStatusesCreatePage::$CreateMessageCreatingStatus);
    }   
    
    
//------------------TEXT PRESENCE EDITING PAGE----------------------------------
    
    /**
     * @group a
     */
    public function TextPresenceEdit(OrderStatusesTester $I){
        $I->wantTo('Verify Text Presence on Editing Status Page.');
        $I->amOnPage(OrderStatusesListPage::$ListURL);
        $I->wait('1');
        $I->click(OrderStatusesListPage::$ListLinkStstusTr1);
        $I->see('Редактирование статуса заказа', OrderStatusesCreatePage::$EditTitle);
        $I->see('Вернуться', OrderStatusesCreatePage::$EditButtonBack);
        $I->see('Сохранить', OrderStatusesCreatePage::$EditButtonSave);
        $I->see('Сохранить и выйти', OrderStatusesCreatePage::$EditButtonSaveAndGoBack);
        $I->see('Информация', OrderStatusesCreatePage::$EditNameBlock);
        $I->see('Название', OrderStatusesCreatePage::$EditNameFieldName);
        $I->see('Цвет фона', OrderStatusesCreatePage::$EditNameFieldColor);
        $I->see('Цвет шрифта', OrderStatusesCreatePage::$EditNameFieldColorFont);
    }
    
    
    
//---------------ELEMENT PRESENCE EDITING PAGE----------------------------------
    
    /**
     * @group a
     */
    public function ElementPresenceEdit(OrderStatusesTester $I){
        $I->wantTo('Verify Element Presence on Editing Status Page.');
        $I->amOnPage(OrderStatusesListPage::$ListURL);
        $I->wait('1');
        $I->click(OrderStatusesListPage::$ListLinkStstusTr1);
        $I->seeElement(OrderStatusesCreatePage::$EditFieldName);
        $I->seeElement(OrderStatusesCreatePage::$EditFieldColor);
        $I->seeElement(OrderStatusesCreatePage::$EditNameFieldColorFont);
    }
    
    
//---------------ALERT MESSAGE PRESENCE EDITING PAGE----------------------------
    
    /**
     * @group a
     */
    public function AlertMessageEdit(OrderStatusesTester $I){
        $I->wantTo('Verify Alert Message Present on Editing Status Page.');
        $I->amOnPage(OrderStatusesListPage::$ListURL);
        $I->click(OrderStatusesCreatePage::$EditLinkEditing);
        $I->fillField(OrderStatusesCreatePage::$EditFieldName, '');
        $I->click(OrderStatusesCreatePage::$EditButtonSaveAndGoBack);
        $I->seeElement(OrderStatusesCreatePage::$EditNessageAlert);        
        $I->fillField(OrderStatusesCreatePage::$EditFieldName, '123');
        $I->dontSeeElement(OrderStatusesCreatePage::$EditNessageAlert);        
    } 
    
    
//---------------ALERT MESSAGE FOR EDITING STATUS-------------------------------
    
    /**
     * @group a
     */
    public function EditingMessageEdit(OrderStatusesTester $I){
        $I->wantTo('Verify Message Editing Status Present.');
        $I->amOnPage(OrderStatusesListPage::$ListURL);
        $I->click(OrderStatusesListPage::$ListLinkStatusTr2);
        $I->click(OrderStatusesCreatePage::$EditButtonSaveAndGoBack);
        $I->wait(1);
        $I->see('Изменения сохранены', OrderStatusesCreatePage::$EditMessageEditingStatus);
    }
    
    
//---------------TEXT ELEMENT PRESENCE DELETING PAGE----------------------------
    
    /**
     * @group aaa
     */
    public function TextElementDeletingWindow(OrderStatusesTester $I){
        $I->wantTo('Verify Text Present on Delete Window.');
        $I->amOnPage(OrderStatusesListPage::$ListURL);
        $I->click(OrderStatusesListPage::$ListButtonDelete);
        $I->waitForText('Удаление статуса заказа', '3', OrderStatusesListPage::$DeleteTitle);
        $I->seeElement(OrderStatusesListPage::$DeleteWindow);
        $I->wait(1);
        $I->see('Удаление статуса заказа', OrderStatusesListPage::$DeleteTitle);
        $I->see('Вы действительно хотите удалить статус?', '.control-group>p');
        $I->see('Удалить', OrderStatusesListPage::$DeleteButtonDelete);
        $I->see('Отменить', OrderStatusesListPage::$DeleteButtonCancel);
        $I->see('×', OrderStatusesListPage::$DeleteButtonX);
    }
    
    
//---------------------BUTTON DELETING WINDOW-----------------------------------
    
    /**
     * @group a
     */
    public function ButtonDeletingWindow(OrderStatusesTester $I){
        $I->wantTo('Verify Butons on Delete Window.');
        $I->amOnPage(OrderStatusesListPage::$ListURL);
        $I->click(OrderStatusesListPage::$ListButtonDelete);
        $I->wait(1);
        $I->seeElement(OrderStatusesListPage::$DeleteWindow);
        $I->click(OrderStatusesListPage::$DeleteButtonCancel);
        $I->wait(1);
        $I->dontSeeElement(OrderStatusesListPage::$DeleteWindow);
        $I->click(OrderStatusesListPage::$ListButtonDelete);
        $I->wait(1);
        $I->seeElement(OrderStatusesListPage::$DeleteWindow);
        $I->click(OrderStatusesListPage::$DeleteButtonX);
    }
    
    
    
//---------------------MESSAGE FOR DELETING STATUS------------------------------
    
    /**
     * @group a
     */
    public function MessageDeletingStatusWindow(OrderStatusesTester $I){
        $I->wantTo('Verify Message About Deleting Status Present.');
        $I->amOnPage(OrderStatusesListPage::$ListURL);
        $I->click(OrderStatusesListPage::$ListButtonDelete);
        $I->wait(1);
        $I->click(OrderStatusesListPage::$DeleteButtonDelete);
        $I->wait(1);
        $I->see('Статус удален', OrderStatusesListPage::$DeleteMessageDeleting);
        InitTest::ClearAllCach($I);
    } 
    
    
    
} 
