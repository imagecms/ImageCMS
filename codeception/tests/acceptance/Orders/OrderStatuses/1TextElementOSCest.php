<?php
use \AcceptanceTester;
class TextElementOSCest
{
//---------------------------AUTORIZATION---------------------------------------   
    /**
     * @group a
     */
    public function Login(AcceptanceTester $I){
        InitTest::Login($I);
    }
    
    
//---------------------------ORDER STATUS CREATE PAGE WAY-----------------------
    /**
     * @group a
     */
    public function  WayCreateOS (AcceptanceTester $I){    
        $I->wantTo('Проверить путь к странице "Создание статуса".');
        $I->amOnPage(OrderStatusesPage::$ListURL);
        $I->click(OrderStatusesPage::$ListaButtonCreateStatuse);
        $I->seeInCurrentUrl(OrderStatusesPage::$CreateURL);
        $I->amOnPage(OrderStatusesPage::$ListURL);
    }
    
    
    
//---------------------------ORDER STATUS EDIT PAGE WAY-------------------------
    /**
     * @group a
     */
    public function  WayEditOS (AcceptanceTester $I){ 
        $I->wantTo('Проверить путь к странице "Редактирование статуса".');
        $I->amOnPage(OrderStatusesPage::$ListURL);
        $I->click(OrderStatusesPage::$ListLinkStstusTr1);
        $I->see('Редактирование статуса заказа', OrderStatusesPage::$EditTitle);
    }
    
    
//---------------------------ORDER STATUS LIST PAGE WAY-------------------------
    /**
     * @group a
     */
    public function  WayListOS (AcceptanceTester $I){   
        $I->wantTo('Проверить путь к странице "Список статусов".');
        $I->click(NavigationBarPage::$Orders);
        $I->click(NavigationBarPage::$OrderStatuses);
        $I->seeInCurrentUrl(OrderStatusesPage::$ListURL);
    } 
    
    
//---------------------------TEXT PRESENCE LIST PAGE----------------------------
    
    /**
     * @group a
     */
    public function  TextPresenceList (AcceptanceTester $I){    
        $I->wantTo('Проверить текст елементов страницы "Список статусов".');
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
    
    /**
     * @group a
     */
    public function  MouseMessage (AcceptanceTester $I){
        $I->wantTo('Проверить появление сообщения "Редактировать статус", при фокусировке курсора мишы на названии статуса на странице "Список статусов".');
        $I->amOnPage(OrderStatusesPage::$ListURL);
        $I->moveMouseOver(OrderStatusesPage::$ListLinkStstusTr1);
        $I->wait(1);
        $I->see('Редактировать статус', OrderStatusesPage::$ListMessageMouseFocuse);
        $I->moveMouseOver(OrderStatusesPage::$ListaButtonCreateStatuse);
        $I->waitForElementNotVisible(OrderStatusesPage::$ListMessageMouseFocuse);
        $I->dontSeeElement(OrderStatusesPage::$ListMessageMouseFocuse);
    }
    
    
    
//--------------------TEXT PRESENCE CREATING PAGE-------------------------------
    
    /**
     * @group a
     */
    public function TextPresenceCrate(AcceptanceTester $I){
        $I->wantTo('Проверить текст елементов страницы "Создание статуса".');
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
    
    /**
     * @group a
     */
    public function ElementPresenceCreate(AcceptanceTester $I){
        $I->wantTo('ПРоверить наличие полей на странице "Создание статуса".');
        $I->amOnPage(OrderStatusesPage::$CreateURL);        
        $I->seeElement(OrderStatusesPage::$CreateFieldName);
        $I->seeElement(OrderStatusesPage::$CreateNameFieldColor);
        $I->seeElement(OrderStatusesPage::$CreateNameFieldColorFont);
    }
    
    
    
//---------------ALERT MESSAGE PRESENCE CREATING PAGE---------------------------
    
    /**
     * @group a
     */
    public function AlertMessageCreate(AcceptanceTester $I){
        $I->wantTo('Проверить появление сообщения об обязатеьности заполнения поля "Название" на странице "Создание статуса".');
        $I->amOnPage(OrderStatusesPage::$CreateURL);        
        $I->fillField(OrderStatusesPage::$CreateFieldName, '');
        $I->click(OrderStatusesPage::$CreateButtonCreateAndGoBack);
        $I->seeElement(OrderStatusesPage::$CreateMessageAlertFild);        
        $I->fillField(OrderStatusesPage::$CreateFieldName, '123');
        $I->dontSeeElement(OrderStatusesPage::$EditNessageAlert);        
    } 
    
    
//---------------------MESSAGE CREATING STATUS----------------------------------
    
    /**
     * @group a
     */
    public function MessageCreateStatus(AcceptanceTester $I){
        $I->wantTo('Проверить появление сообщения о создании статуса.');
        $I->amOnPage(OrderStatusesPage::$CreateURL);
        $I->fillField(OrderStatusesPage::$CreateFieldName, 'ZavorotkiShock');
        $I->click(OrderStatusesPage::$CreateButtonCreate);
        $I->waitForElement(OrderStatusesPage::$CreateMessageCreatingStatus);
        $I->see('Статус заказа создан', OrderStatusesPage::$CreateMessageCreatingStatus);
    }   
    
    
//------------------TEXT PRESENCE EDITING PAGE----------------------------------
    
    /**
     * @group a
     */
    public function TextPresenceEdit(AcceptanceTester $I){
        $I->wantTo('Проверить текст елементов на странице "Редактирование статуса".');
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
    
    /**
     * @group a
     */
    public function ElementPresenceEdit(AcceptanceTester $I){
        $I->wantTo('Проверить наличие полей на странице "Редактирование статуса".');
        $I->amOnPage(OrderStatusesPage::$ListURL);
        $I->click(OrderStatusesPage::$ListLinkStstusTr1);
        $I->seeElement(OrderStatusesPage::$EditFieldName);
        $I->seeElement(OrderStatusesPage::$EditFieldColor);
        $I->seeElement(OrderStatusesPage::$EditNameFieldColorFont);
    }
    
    
//---------------ALERT MESSAGE PRESENCE EDITING PAGE----------------------------
    
    /**
     * @group a
     */
    public function AlertMessageEdit(AcceptanceTester $I){
        $I->wantTo('Проверить появление сообщении об обязательности заполнения поля "Название" на странице "Редактирование статуса".');
        $I->amOnPage(OrderStatusesPage::$ListURL);
        $I->click(OrderStatusesPage::$EditLinkEditing);
        $I->fillField(OrderStatusesPage::$EditFieldName, '');
        $I->click(OrderStatusesPage::$EditButtonSaveAndGoBack);
        $I->seeElement(OrderStatusesPage::$EditNessageAlert);        
        $I->fillField(OrderStatusesPage::$EditFieldName, '123');
        $I->dontSeeElement(OrderStatusesPage::$EditNessageAlert);        
    } 
    
    
//---------------ALERT MESSAGE FOR EDITING STATUS-------------------------------
    
    /**
     * @group a
     */
    public function EditingMessageEdit(AcceptanceTester $I){
        $I->wantTo('Проверить появление и текст сообщение о редактировании статуса.');
        $I->amOnPage(OrderStatusesPage::$ListURL);
        $I->click(OrderStatusesPage::$ListLinkStatusTr2);
        $I->click(OrderStatusesPage::$EditButtonSaveAndGoBack);
        $I->wait(1);
        $I->see('Изменения сохранены', OrderStatusesPage::$EditMessageEditingStatus);
    }
    
    
//---------------TEXT ELEMENT PRESENCE DELETING PAGE----------------------------
    
    /**
     * @group a
     */
    public function TextElementDeletingWindow(AcceptanceTester $I){
        $I->wantTo('Проверить текст и присутствие елементов окна "Удаление статуса".');
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
    
    /**
     * @group a
     */
    public function ButtonDeletingWindow(AcceptanceTester $I){
        $I->wantTo('Проверить кликабельность кнопок окна "Удаление статуса".');
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
    
    /**
     * @group a
     */
    public function MessageDeletingStatusWindow(AcceptanceTester $I){
        $I->wantTo('Проверить появление сообщения об удалении статуса.');
        $I->amOnPage(OrderStatusesPage::$ListURL);
        $I->click(OrderStatusesPage::$ListButtonDelete);
        $I->wait(1);
        $I->click(OrderStatusesPage::$DeleteButtonDelete);
        $I->wait(1);
        $I->see('Статус удален', OrderStatusesPage::$DeleteMessageDeleting);
    } 
    
    
    
} 
