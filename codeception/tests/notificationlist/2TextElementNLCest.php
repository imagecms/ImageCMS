<?php
use \NotificationListTester;
class TextElementNLCest
{
//---------------------------AUTORIZATION---------------------------------------  
    
    /**
     * @group a
     */
    public function Login(NotificationListTester $I){
        InitTest::Login($I);
    }
    
    

//---------------------------CREATE NOTIFI FRONT--------------------------------   
    
    /**
     * @group a
     */
    public function CreateNotificationFront(NotificationListTester $I){
      $I->amOnPage(NotificationCreateFrontPage::$PageURL);
        $I->scrollToElement($I, '.infoBut.isDrop');
        $I->click(NotificationCreateFrontPage::$ButtonOnPage);
        $I->waitForText('Сообщить о появлении');
        $I->click(NotificationCreateFrontPage::$ButtonSendPresent);
    }
    
    
    
//----------------------BUTTON LIST---------------------------------------------
    
    /**
     * @group a
     */
    public function VerifyButtonList(NotificationListTester $I){
      $I->amOnPage('/admin');
      $I->click(NavigationBarPage::$Orders);
      $I->click(NavigationBarPage::$NotificationsList);
      $I->seeInCurrentUrl(NotificationListPage::$ListPageURL);
      $I->waitForElement(NotificationListPage::$ListButtonNew);
      $I->click(NotificationListPage::$ListButtonNew);
      $I->wait('1');
//      $I->waitForElement(NotificationListPage::$ListButtonMade);
      $I->click(NotificationListPage::$ListButtonMade);
      $I->wait('1');
//      $I->waitForElement(NotificationListPage::$ListButtonAll);
      $I->click(NotificationListPage::$ListButtonAll);
      $I->wait('1');
      $I->click(NotificationListPage::$ListMainCheckBox);
      $I->wait('1');
//      $I->waitForElementVisible(NotificationListPage::$ListButtonFilter);
      $I->click(NotificationListPage::$ListButtonFilter);
      $I->wait('1');
//      $I->waitForElement(NotificationListPage::$ListButtonCancelFilter);
      $I->click(NotificationListPage::$ListButtonCancelFilter);
      $I->wait('1');
//      $I->waitForElement(NotificationListPage::$ListMainCheckBox);
      $I->dontSeeCheckboxIsChecked(NotificationListPage::$ListMainCheckBox);
      }
      
      
      
//-------------------TEXT ELEMENT LIST PAGE-------------------------------------
      
    /**
     * @group a
     */  
    public function VerifyTextElementLlist(NotificationListTester $I){
        $I->amOnPage(NotificationListPage::$ListPageURL);
        $I->see('Уведомления о появлении', NotificationListPage::$ListTitle);
        $I->click(NotificationListPage::$ListMainCheckBox);
        $I->see('Фильтр', NotificationListPage::$ListButtonFilter);
        $I->see('Отменить фильтрацию', NotificationListPage::$ListButtonCancelFilter);
        $I->see('Удалить', NotificationListPage::$ListButtonDelete);
        $I->see('Все', NotificationListPage::$ListButtonAll);
        $I->see('Новый', NotificationListPage::$ListButtonNew);
        $I->see('Выполнен', NotificationListPage::$ListButtonMade);
        $I->see('ID', NotificationListPage::$ListColumnID);
        $I->see('E-mail', NotificationListPage::$ListColumnEmeil);
        $I->see('Время добавления', NotificationListPage::$ListColumnAddition);
        $I->see('Действительно до', NotificationListPage::$ListColumnValid);
        $I->see('Менеджер', NotificationListPage::$ListColumnManager);
        $I->see('Статус', NotificationListPage::$ListColumnStatus);
        $I->see('Товар', NotificationListPage::$ListColumnProduct);
        $I->see('Уведомления', NotificationListPage::$ListColumnNotifi);
    }  
    
    
    
//-------------------ELEMENT PRESENCE LIST PAGE---------------------------------
    
    /**
     * @group a
     */
    public function VerifyElementPresenceList(NotificationListTester $I){
        $I->amOnPage(NotificationListPage::$ListPageURL);
        $I->seeElement(NotificationListPage::$ListFildId);
        $I->seeElement(NotificationListPage::$ListFildEmail);
        $I->seeElement(NotificationListPage::$ListFildAddition);
        $I->seeElement(NotificationListPage::$ListFildValidUnit);
        $I->seeElement(NotificationListPage::$ListLinkEditting);
        $I->seeElement(NotificationListPage::$ListMainCheckBox);
        $I->seeElement(NotificationListPage::$ListSelectMain);
        $I->seeElement(NotificationListPage::$ListSelectFirst);
    }
    
    
    
//-------------------MOUSE FOCUS TEXT MESSAGE LIST PAGE-------------------------
    
    /**
     * @group a
     */
    public function VerifyTextElementList(NotificationListTester $I){
        $I->amOnPage(NotificationListPage::$ListPageURL);
        $I->moveMouseOver(NotificationListPage::$ListLinkEditting);
        $I->waitForText('Редактировать уведомление');
        $I->see('Редактировать уведомление', NotificationListPage::$ListMouseMessage);
        $I->moveMouseOver(NotificationListPage::$ListSelectMain);
        $I->waitForElementNotVisible(NotificationListPage::$ListMouseMessage);
        $I->dontSee('Редактировать уведомление');
    }
    
    
    
//-------------------TEXT ELEMENT DELETE WINDOW---------------------------------
    
    /**
     * @group a
     */
    public function VerifyTextElementDeleteWindow(NotificationListTester $I){
        $I->amOnPage(NotificationListPage::$ListPageURL);
        $I->click(NotificationListPage::$ListMainCheckBox);
        $I->click(NotificationListPage::$ListButtonDelete);
        $I->waitForText('Запросов на удаление', '5', NotificationListPage::$DeleteWindowTitle);
        $I->seeElement(NotificationListPage::$DeleteWindow);
        $I->see('Запросов на удаление',NotificationListPage::$DeleteWindowTitle);
        $I->see('Удалить выбранные запросы?',NotificationListPage::$DeleteWindowMassage);
        $I->see('Удалить', NotificationListPage::$DeleteWindowButtonDelete);
        $I->see('Отменить', NotificationListPage::$DeleteWindowButtonCancel);
        $I->see('×', NotificationListPage::$DeleteWindowButtonX);      
    }
    
    
    
//-------------------TEXT ELEMENT EDITING PAGE----------------------------------
    
    /**
     * @group a
     */
    public function VerifyTextElementEditing(NotificationListTester $I){
        $I->amOnPage(NotificationListPage::$ListPageURL);
        $I->click(NotificationListPage::$ListLinkEditting);
        $I->see('Редактирование уведомления', NotificationListPage::$EditingTitle);
        $I->see('Вернуться', NotificationListPage::$EditingButtonBack);
        $I->see('Сохранить', NotificationListPage::$EditingButtonSave);
        $I->see('Сохранить и выйти', NotificationListPage::$EditingButtonSaveAndGoBack);
        $I->see('Данные', NotificationListPage::$EditingBlockData);
        $I->see('Изображение', NotificationListPage::$EditingBlockImage);
        $I->see('Товар', NotificationListPage::$EditingBlockProduct);
        $I->see('ID:', NotificationListPage::$EditingNameFieldID);
        $I->see('Статус:', NotificationListPage::$EditingNameFieldStatus);
        $I->see('Дата создания:', NotificationListPage::$EditingNameFieldAddition);
        $I->see('Дата окончания:', NotificationListPage::$EditingNameFieldValid);
        $I->see('Статус установлен:', NotificationListPage::$EditingNameFieldSetStatus);
        $I->see('Уведомить:', NotificationListPage::$EditingNameFieldNotify);
        $I->see('Имя пользователя:', NotificationListPage::$EditingNameFieldUser);
        $I->see('E-mail:', NotificationListPage::$EditingNameFieldEmeil);
        $I->see('Телефон:', NotificationListPage::$EditingNameFieldPhone);
        $I->see('Комментарий:', NotificationListPage::$EditingNameFieldComment);      
    }
    
    
    
//-------------------ELEMENT PRESENCE EDITING PAGE------------------------------
    
    /**
     * @group a
     */
    public function VerifyElementPresenceEditing(NotificationListTester $I){
        $I->amOnPage(NotificationListPage::$ListPageURL);
        $I->click(NotificationListPage::$ListLinkEditting);
        $I->seeElement(NotificationListPage::$EditingSelectStatus);
        $I->seeElement(NotificationListPage::$EditingFildStatusSet);
        $I->seeElement(NotificationListPage::$EditingFildPhone);
        $I->seeElement(NotificationListPage::$EditingFildName);
        $I->seeElement(NotificationListPage::$EditingFildID);
        $I->seeElement(NotificationListPage::$EditingFildExpirationDate);
        $I->seeElement(NotificationListPage::$EditingFildEmail);
        $I->seeElement(NotificationListPage::$EditingFildCreated);
        $I->seeElement(NotificationListPage::$EditingFildComment);
        $I->seeElement(NotificationListPage::$EditingButtonNotifi);
    }
    
    
    
//-------------------- BUTTON EDITING PAGE-------------------------------------- 
    
    /**
     * @group a
     */
    public function VerifyButtonEditing(NotificationListTester $I){
        $I->amOnPage(NotificationListPage::$ListPageURL); 
        $I->click(NotificationListPage::$ListLinkEditting);
        $I->click(NotificationListPage::$EditingButtonBack);
        $I->click(NotificationListPage::$ListLinkEditting);
        $I->click(NotificationListPage::$EditingButtonSave);
        $I->wait('1');
        $I->click(NotificationListPage::$EditingButtonSaveAndGoBack);
    }
    
    
    
//-------------------LINK IMG EDITING PAGE--------------------------------------
    
    /**
     * @group a
     */
    public function VerifyLinkImgEditingProduct(NotificationListTester $I){
        $I->amOnPage(NotificationListPage::$ListPageURL); 
        $I->click(NotificationListPage::$ListLinkEditting);
        $I->click(NotificationListPage::$EditingLinkImg);
        $I->see('Смартфон Samsung GT-S7530 Omnia M EAA Deep Grey');
     }
     
     
     
//-------------------LINK PRODUCT NAME EDITING PAGE-----------------------------
     
    /**
     * @group a
     */ 
    public function VerifyLinkProductNameEditingProduct(NotificationListTester $I){
        $I->amOnPage(NotificationListPage::$ListPageURL); 
        $I->click(NotificationListPage::$ListLinkEditting);
        $I->click(NotificationListPage::$EditingLinkProduct);
        $I->see('Смартфон Samsung GT-S7530 Omnia M EAA Deep Grey');
     }
     
     
     
//-------------------TEXT MESSAGE EDIT PAGE-------------------------------------
     
    /**
     * @group a
     */
    public function TextMessageEditNotifi(NotificationListTester $I){
        $I->amOnPage(NotificationListPage::$ListPageURL);
        $I->click(NotificationListPage::$ListLinkEditting);
        $I->click(NotificationListPage::$EditingButtonSave);
        $I->waitForText('Уведомление обновлено');
        $I->see('Уведомление обновлено', '.alert.in.fade.alert-success');
        $I->wait('1'); 
        $I->click(NotificationListPage::$EditingButtonSaveAndGoBack);
        $I->see('Уведомление обновлено', '.alert.in.fade.alert-success');
    }
    
    
    
//-------------------BUTTON DELETE WINDOW---------------------------------------
    
    /**
     * @group a
     */
    public function VerifyButtonDelete(NotificationListTester $I){
        $I->amOnPage(NotificationListPage::$ListPageURL);  
        $I->click(NotificationListPage::$ListMainCheckBox);
        $I->click(NotificationListPage::$ListButtonDelete);
        $I->wait('1');
        $I->click(NotificationListPage::$DeleteWindowButtonX);
        $I->wait('1');
        $I->click(NotificationListPage::$ListButtonDelete);
        $I->wait('1');
        $I->click(NotificationListPage::$DeleteWindowButtonCancel);
    }
    
    
    
//-------------------TEXT DELETING NOTIFY LIST PAGE-----------------------------
    
    /**
     * @group a
     */
    public function TextDeletingNotifi(NotificationListTester $I){
        $I->amOnPage(NotificationListPage::$ListPageURL);
        $I->click(NotificationListPage::$ListMainCheckBox);
        $I->click(NotificationListPage::$ListButtonDelete);
        $I->wait('1');
        $I->click(NotificationListPage::$DeleteWindowButtonDelete);
        $I->waitForText('Удаление');
        $I->see('Удаление', '.alert.in.fade.alert-success');
    }
      
      
      
}