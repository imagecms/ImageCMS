<?php
use \NotificationListTester;
class FieldsNLCest
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
        $I->wantTo('Create Notifi on Frontend.');
        $I->amOnPage(NotificationCreateFrontPage::$PageURL);
        $I->scrollToElement($I, '.infoBut.isDrop');
        $I->click(NotificationCreateFrontPage::$ButtonOnPage);
        $I->waitForText('Сообщить о появлении');
        $I->click(NotificationCreateFrontPage::$ButtonSendPresent);
    }
    
    
    
//-------------------------MESSAGE INPUT FIELD ID LIST--------------------------
    
    /**
     * @group a
     */
    public function MessageInputFieldIDList (NotificationListTester $I){
        $I->wantTo('Verify Presence Tooltip in Field.');
        $I->amOnPage(NotificationListPage::$ListPageURL);
        $I->fillField(NotificationListPage::$ListFildId, 'q');
        $I->see('только цифры', NotificationListPage::$ListMessageID);
        $I->fillField(NotificationListPage::$ListFildId, '');
        $I->fillField(NotificationListPage::$ListFildId, '@');
        $I->waitForText('только цифры');
        $I->see('только цифры', NotificationListPage::$ListMessageID);
        $I->fillField(NotificationListPage::$ListFildId, '');
        $I->fillField(NotificationListPage::$ListFildId, 'Ы');
        $I->waitForText('только цифры');
        $I->see('только цифры', NotificationListPage::$ListMessageID);
        $I->fillField(NotificationListPage::$ListFildId, '');
        $I->fillField(NotificationListPage::$ListFildId, 'ї');
        $I->waitForText('только цифры');
        $I->see('только цифры', NotificationListPage::$ListMessageID);
        $I->fillField(NotificationListPage::$ListFildId, '');
        $I->fillField(NotificationListPage::$ListFildId, ' ');
        $I->waitForText('только цифры');
        $I->see('только цифры', NotificationListPage::$ListMessageID);
    } 
    
    
    
//-------------------------INPUT FIELD ID LIST----------------------------------
    
    /**
     * @group a
     */
    public function InputFieldIDList (NotificationListTester $I){
        $I->wantTo('Verify Valid Input in Field.');
        $I->amOnPage(NotificationListPage::$ListPageURL);
        $I->fillField(NotificationListPage::$ListFildId, '0123456789');
        $I->seeInField(NotificationListPage::$ListFildId, '0123456789');
    }
       
       
       
//-------------------------INPUT FIELD ID LIST----------------------------------
       
    /**
     * @group a
     */   
    public function InputFieldEmailList (NotificationListTester $I){
        $I->wantTo('Verify Valid Input in Field.');
        $I->amOnPage(NotificationListPage::$ListPageURL);
        $I->appendField(NotificationListPage::$ListFildEmail, 'QWE 123 !@# ячс');
        $I->seeInField(NotificationListPage::$ListFildEmail, 'QWE 123 !@# ячс');
    }
    
    
    
//--------------------UNACCEPTABLE INPUT FIELD ADDING LIST----------------------
    
    /**
     * @group a
     */
    public function NoInputFieldAdditngList (NotificationListTester $I){
        $I->wantTo('Verify Valid Input in Field.');
        $I->amOnPage(NotificationListPage::$ListPageURL);
        $I->appendField(NotificationListPage::$ListFildAddition, 'QWE !@# ячс');
        $I->dontSeeInField(NotificationListPage::$ListFildAddition, 'QWE !@# ячс');
    }
    
    
    
//--------------------VALID INPUT FIELD ADDING LIST-----------------------------
    
    /**
     * @group a
     */
    public function InputFieldAdditngList (NotificationListTester $I){
        $I->wantTo('Verify Valid Input in Field.');
        $I->amOnPage(NotificationListPage::$ListPageURL);
        $I->appendField(NotificationListPage::$ListFildAddition, '12-345-678-90');
        $I->seeInField(NotificationListPage::$ListFildAddition, '12-345-678-90');
    }
    
    
    
//--------------------CALENDAR PRESENCE INPUT FIELD ADDING EDITING--------------
    
    /**
     * @group a
     */
    public function CalendardAdditngList (NotificationListTester $I){
        $I->wantTo('Verify Calendar Presence.');
        $I->amOnPage(NotificationListPage::$ListPageURL);
        $I->appendField(NotificationListPage::$ListFildAddition, '2');
        $I->seeElement(NotificationListPage::$ListCalendar);        
        }
        
        
        
//--------------------UNACCEPTABLE INPUT FIELD VALIDUNIT LIST-------------------
        
     /**
     * @group a
     */   
    public function inVALIDInputFieldVALIDUNITList (NotificationListTester $I){
        $I->wantTo('Verify InValid Input in Field.');
        $I->amOnPage(NotificationListPage::$ListPageURL);
        $I->appendField(NotificationListPage::$ListFildValidUnit, 'QWE !@# ячс');
        $I->dontSeeInField(NotificationListPage::$ListFildValidUnit, 'QWE !@# ячс');
    }
    
    
    
//--------------------VALID INPUT FIELD VALIDUNIT LIST--------------------------
    
    /**
     * @group a
     */
    public function VALIDInputFieldVALIDUNITList (NotificationListTester $I){
        $I->wantTo('Verify Valid Input in Field.');
        $I->amOnPage(NotificationListPage::$ListPageURL);
        $I->appendField(NotificationListPage::$ListFildValidUnit, '12-345-678-90');
        $I->seeInField(NotificationListPage::$ListFildValidUnit, '12-345-678-90');
    }
    
    
    
//-----------------------DEFAULT HEAD FIELD STATUSE  LIST-----------------------
    
    /**
     * @group a
     */
    public function DefaultFieldStatuseList (NotificationListTester $I){
        $I->wantTo('Verify Default Values on Select Menu.');
        $I->amOnPage(NotificationListPage::$ListPageURL);
        $I->seeOptionIsSelected(NotificationListPage::$ListSelectMain, 'нет');    
    }
    
    
    
//-----------------------SELECT HEAD FIELD STATUSE LIST-------------------------
    
    /**
     * @group a
     */
    public function SelectFieldStatuseList (NotificationListTester $I){
        $I->wantTo('Verify Select in Option.');
        $I->amOnPage(NotificationListPage::$ListPageURL);
        $I->selectOption(NotificationListPage::$ListSelectMain, 'Новый');
        $I->seeOptionIsSelected(NotificationListPage::$ListSelectMain, 'Новый');
        $I->selectOption(NotificationListPage::$ListSelectMain, 'Выполнен');
        $I->seeOptionIsSelected(NotificationListPage::$ListSelectMain, 'Выполнен');    
    } 
    
    
    
//-----------------------DEFAULT NOTIFY FIELD STATUSE  LIST---------------------
    
    /**
     * @group a
     */
    public function DefaultFieldStatuseLlist (NotificationListTester $I){
        $I->wantTo('Verify Default Values in Field.');
        $I->amOnPage(NotificationListPage::$ListPageURL);
        $I->seeOptionIsSelected(NotificationListPage::$ListSelectFirst, 'Новый');    
    }
    
    
    
//-----------------------SELECT NOTIFY FIELD STATUSE LIST-----------------------
    
    /**
     * @group a
     */
    public function SelectFieldStatuseLlist (NotificationListTester $I){
        $I->wantTo('Verify Select in Option.');
        $I->amOnPage(NotificationListPage::$ListPageURL);
        $I->selectOption(NotificationListPage::$ListSelectFirst, 'Выполнен');
        $I->seeOptionIsSelected(NotificationListPage::$ListSelectFirst, 'Выполнен');
        $I->amOnPage(NotificationListPage::$ListPageURL);
        $I->selectOption(NotificationListPage::$ListSelectFirst, 'Новый');
        $I->seeOptionIsSelected(NotificationListPage::$ListSelectFirst, 'Новый');    
    }
    
    
    
//--------------------CALENDAR PRESENCE INPUT FIELD VALUNIT LIST----------------
    
    /**
     * @group a
     */
    public function CalendardVALUNITList (NotificationListTester $I){
        $I->wantTo('Verify Calendar Presence.');
        $I->amOnPage(NotificationListPage::$ListPageURL);
        $I->appendField(NotificationListPage::$ListFildAddition, '2');
        $I->seeElement(NotificationListPage::$ListCalendar);        
    }
        
        
        
//--------------------BUTTON INFORMATION LIST-----------------------------------
        
     /**
     * @group a
     */   
    public function ButonInformationList (NotificationListTester $I){
        $I->wantTo('Verify Valid Information Presence in Button Information.');
        $I->amOnPage(NotificationListPage::$ListPageURL);
        $I->waitForElement(NotificationListPage::$ListButtonInformation);
        $I->click(NotificationListPage::$ListButtonInformation);
        $I->wait('1');
        $I->see('Товар', 'h3.popover-title');
        $I->see('Смартфон Samsung GT-S7530 Omnia M EAA Deep Grey (Смартфон Samsung GT-S7530 Omnia M EAA Deep Grey)', 'p > div.check_product > a');
        $I->click(NotificationListPage::$ListButtonInformation);
        $I->dontSeeElement('.popover.fade.left.in');
    }
    
    
    
//--------------------LINK BUTTON INFORMATION LIST------------------------------
    
    /**
     * @group a
     */
    public function LinkButonInformationList (NotificationListTester $I){
        $I->wantTo('Verify Clickability Link Element.');
        $I->amOnPage(NotificationListPage::$ListPageURL);
        $I->click(NotificationListPage::$ListButtonInformation);
        $I->click('Смартфон Samsung GT-S7530 Omnia M EAA Deep Grey (Смартфон Samsung GT-S7530 Omnia M EAA Deep Grey)', '.popover.fade.left.in');
        $I->see('Смартфон Samsung GT-S7530 Omnia M EAA Deep Grey', 'span.title');
    } 
    
    
    
//-----------------------DEFAULT NOTIFY FIELD STATUSE  EDIT---------------------
    
    /**
     * @group a
     */
    public function DefaultFieldStatuseist (NotificationListTester $I){
        $I->wantTo('Verify Default Values oi Select Menu.');
        $I->amOnPage(NotificationListPage::$ListPageURL);
        $I->click(NotificationListPage::$ListLinkEditting);
        $I->seeOptionIsSelected(NotificationListPage::$EditingSelectStatus, 'Новый');    
    }
    
    
    
//-----------------------SELECT NOTIFY FIELD STATUSE EDITING--------------------
    
    /**
     * @group a
     */
    public function SelectFieldStatuseist (NotificationListTester $I){
        $I->wantTo('Verify Select in Option.');
        $I->amOnPage(NotificationListPage::$ListPageURL);
        $I->click(NotificationListPage::$ListLinkEditting);
        $I->selectOption(NotificationListPage::$EditingSelectStatus, 'Выполнен');
        $I->click(NotificationListPage::$EditingButtonSave);
        $I->wait('2');
        $I->seeOptionIsSelected(NotificationListPage::$EditingSelectStatus, 'Выполнен');
        $I->selectOption(NotificationListPage::$EditingSelectStatus, 'Новый');
        $I->click(NotificationListPage::$EditingButtonSave);
        $I->wait('2');
        $I->seeOptionIsSelected(NotificationListPage::$EditingSelectStatus, 'Новый');    
    }
    
    
    
//-------------UNACCEPTABLE INPUT FIELD VALIDUNIT EDITING-----------------------
    
    /**
     * @group a
     */
    public function NoVALIDInputFieldVALIDUNITEditing (NotificationListTester $I){
        $I->wantTo('Verify Input Valid Values in Field.');
        $I->amOnPage(NotificationListPage::$ListPageURL);
        $I->click(NotificationListPage::$ListLinkEditting);
        $I->fillField(NotificationListPage::$EditingFildExpirationDate, 'QWE !@# ячс');
        $I->click(NotificationListPage::$EditingButtonSave);
        $I->dontSeeInField(NotificationListPage::$EditingFildExpirationDate, 'QWE !@# ячс');
    }
    
    
    
//--------------------VALID INPUT FIELD VALIDUNIT EDITING-----------------------
    
    /**
     * @group a
     */
    public function VALIDInputFieldVALIDUNITEditing (NotificationListTester $I){
        $I->wantTo('Verify Input Valid Values in Field.');
        $I->amOnPage(NotificationListPage::$ListPageURL);
        $I->click(NotificationListPage::$ListLinkEditting);
        $I->wait('1'); 
        $I->fillField(NotificationListPage::$EditingFildExpirationDate, '1999-05-03');
        $I->click(NotificationListPage::$EditingButtonSave);
        $I->wait('1'); 
        $I->seeInField(NotificationListPage::$EditingFildExpirationDate, '1999-05-03');
    }
    
    
    
//--------------------CALENDAR PRESENCE INPUT FIELD VALUNIT EDITING-------------
    
    /**
     * @group a
     */
    public function CalendarVALUnitEditing (NotificationListTester $I){
        $I->wantTo('See Calendar Presence.');
        $I->amOnPage(NotificationListPage::$ListPageURL);
        $I->appendField(NotificationListPage::$ListFildAddition, '2');
        $I->seeElement(NotificationListPage::$ListCalendar);        
        }
        
        

//--------------------NOT SAVED INPUT FIELD NAME EDITING------------------------
        
    /**
     * @group a
     */    
    public function VALIDInputFieldNamEditing (NotificationListTester $I){
        $I->wantTo('Verify Input Valid Values in Field.');
        $I->amOnPage(NotificationListPage::$ListPageURL);
        $I->click(NotificationListPage::$ListLinkEditting);
        $I->appendField(NotificationListPage::$EditingFildName, '123 QWE !@# їзщ');
        $I->click(NotificationListPage::$EditingButtonSave);
        $I->wait('1');
        $I->seeInField(NotificationListPage::$EditingFildName, 'Administrator');
        $I->fillField(NotificationListPage::$EditingFildName, '');
        $I->click(NotificationListPage::$EditingButtonSave);
        $I->wait('1');
        $I->seeInField(NotificationListPage::$EditingFildName, 'Administrator');          
    }
      
      
      
//--------------------NOT SAVED INPUT FIELD EMEIL EDITING-----------------------
      
    /**
     * @group a
     */  
    public function VALIDInputFieldEmeilEditing (NotificationListTester $I){
        $I->wantTo('Verify Input Valid Values in Field.');
        $I->amOnPage(NotificationListPage::$ListPageURL);
        $I->click(NotificationListPage::$ListLinkEditting);
        $I->appendField(NotificationListPage::$EditingFildEmail, '123 QWE !@# їзщ');
        $I->click(NotificationListPage::$EditingButtonSave); 
        $I->wait('1');
        $I->seeInField(NotificationListPage::$EditingFildEmail, 'ad@min.com');
        $I->fillField(NotificationListPage::$EditingFildEmail, '');
        $I->click(NotificationListPage::$EditingButtonSave);
        $I->wait('1');
        $I->seeInField(NotificationListPage::$EditingFildEmail, 'ad@min.com');          
    }
      
      
      
//-----------------------SAVED INPUT FIELD PHONE EDITING------------------------
      
    /**
     * @group a
     */  
    public function VALIDInputFieldPhonelEditing (NotificationListTester $I){
        $I->wantTo('Verify Input Valid Values in Field.');
        $I->amOnPage(NotificationListPage::$ListPageURL);
        $I->click(NotificationListPage::$ListLinkEditting);
        $I->fillField(NotificationListPage::$EditingFildPhone, 'QWE 123 !@# ячс');
        $I->click(NotificationListPage::$EditingButtonSave);
        $I->wait('1');
        $I->seeInField(NotificationListPage::$EditingFildPhone, 'QWE 123 !@# ячс');
        $I->fillField(NotificationListPage::$EditingFildPhone, '');
        $I->click(NotificationListPage::$EditingButtonSave);
        $I->wait('1');
        $I->seeInField(NotificationListPage::$EditingFildPhone, '');
    }
      
      
      
//-----------------------SAVED INPUT FIELD COMMENT EDITING----------------------
      
    /**
     * @group a
     */  
    public function VALIDInputFieldCommentlEditing (NotificationListTester $I){
        $I->wantTo('Verify Input Valid Values in Field.');
        $I->amOnPage(NotificationListPage::$ListPageURL);
        $I->click(NotificationListPage::$ListLinkEditting);
        $I->fillField(NotificationListPage::$EditingFildComment, 'QWE 123 !@# ячс');
        $I->click(NotificationListPage::$EditingButtonSave);
        $I->wait('1');
        $I->seeInField(NotificationListPage::$EditingFildComment, 'QWE 123 !@# ячс');
        $I->fillField(NotificationListPage::$EditingFildComment, '');
        $I->click(NotificationListPage::$EditingButtonSave);
        $I->wait('1');
        $I->seeInField(NotificationListPage::$EditingFildComment, '');
    }
      
      
      
//------------------------------CLEARING----------------------------------------
      
    /**
     * @group a
     */  
    public function TextDeletingNotifi(NotificationListTester $I){
        $I->wantTo('Verify Deleting Notifi.');
        $I->amOnPage(NotificationListPage::$ListPageURL);
        $I->click(NotificationListPage::$ListMainCheckBox);
        $I->click(NotificationListPage::$ListButtonDelete);
        $I->wait('1');
        $I->click(NotificationListPage::$DeleteWindowButtonDelete);
        $I->wait('1');
        InitTest::ClearAllCach($I);
    }
    
    
    
}