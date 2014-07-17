<?php
use \AcceptanceTester;
class FieldsNLCest
{
//---------------------------AUTORIZATION---------------------------------------    
    public function Login(AcceptanceTester $I){
        InitTest::Login($I);
    }
//---------------------------CREATE NOTIFI FRONT--------------------------------    
    public function CreateNotificationFront(AcceptanceTester $I){
      $I->amOnPage(NotificationCreateFrontPage::$PageURL);
        $I->scrollToElement($I, '.infoBut.isDrop');
        $I->click(NotificationCreateFrontPage::$ButtonOnPage);
        $I->waitForText('Сообщить о появлении');
        $I->click(NotificationCreateFrontPage::$ButtonSendPresent);
    }
//-------------------------MESSAGE INPUT FIELD ID LIST--------------------------
    public function MessageInputFieldIDList (AcceptanceTester $I){
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
    public function InputFieldIDList (AcceptanceTester $I){
       $I->amOnPage(NotificationListPage::$ListPageURL);
       $I->fillField(NotificationListPage::$ListFildId, '0123456789');
       $I->seeInField(NotificationListPage::$ListFildId, '0123456789');
       }
//-------------------------INPUT FIELD ID LIST----------------------------------
    public function InputFieldEmailList (AcceptanceTester $I){
        $I->amOnPage(NotificationListPage::$ListPageURL);
        $I->appendField(NotificationListPage::$ListFildEmail, 'QWE 123 !@# ячс');
        $I->seeInField(NotificationListPage::$ListFildEmail, 'QWE 123 !@# ячс');
    }
//--------------------UNACCEPTABLE INPUT FIELD ADDING LIST----------------------
    public function NoInputFieldAdditngList (AcceptanceTester $I){
        $I->amOnPage(NotificationListPage::$ListPageURL);
        $I->appendField(NotificationListPage::$ListFildAddition, 'QWE !@# ячс');
        $I->dontSeeInField(NotificationListPage::$ListFildAddition, 'QWE !@# ячс');
    }
//--------------------VALID INPUT FIELD ADDING LIST-----------------------------
    public function InputFieldAdditngList (AcceptanceTester $I){
        $I->amOnPage(NotificationListPage::$ListPageURL);
        $I->appendField(NotificationListPage::$ListFildAddition, '12-345-678-90');
        $I->seeInField(NotificationListPage::$ListFildAddition, '12-345-678-90');
    }
//--------------------CALENDAR PRESENCE INPUT FIELD ADDING EDITING--------------
    public function CalendardAdditngList (AcceptanceTester $I){
        $I->amOnPage(NotificationListPage::$ListPageURL);
        $I->appendField(NotificationListPage::$ListFildAddition, '2');
        $I->seeElement(NotificationListPage::$ListCalendar);        
        }
//--------------------UNACCEPTABLE INPUT FIELD VALIDUNIT LIST-------------------
    public function nOVALIDInputFieldVALIDUNITList (AcceptanceTester $I){
        $I->amOnPage(NotificationListPage::$ListPageURL);
        $I->appendField(NotificationListPage::$ListFildValidUnit, 'QWE !@# ячс');
        $I->dontSeeInField(NotificationListPage::$ListFildValidUnit, 'QWE !@# ячс');
    }
//--------------------VALID INPUT FIELD VALIDUNIT LIST--------------------------
    public function VALIDInputFieldVALIDUNITList (AcceptanceTester $I){
        $I->amOnPage(NotificationListPage::$ListPageURL);
        $I->appendField(NotificationListPage::$ListFildValidUnit, '12-345-678-90');
        $I->seeInField(NotificationListPage::$ListFildValidUnit, '12-345-678-90');
    }
//-----------------------DEFAULT HEAD FIELD STATUSE  LIST-----------------------
    public function DefaultFieldStatuseList (AcceptanceTester $I){
     $I->amOnPage(NotificationListPage::$ListPageURL);
     $I->seeOptionIsSelected(NotificationListPage::$ListSelectMain, 'нет');    
    }
//-----------------------SELECT HEAD FIELD STATUSE LIST-------------------------
    public function SelectFieldStatuseList (AcceptanceTester $I){
     $I->amOnPage(NotificationListPage::$ListPageURL);
     $I->selectOption(NotificationListPage::$ListSelectMain, 'Новый');
     $I->seeOptionIsSelected(NotificationListPage::$ListSelectMain, 'Новый');
     $I->selectOption(NotificationListPage::$ListSelectMain, 'Выполнен');
     $I->seeOptionIsSelected(NotificationListPage::$ListSelectMain, 'Выполнен');    
    } 
//-----------------------DEFAULT NOTIFY FIELD STATUSE  LIST---------------------
    public function DefaultFieldStatuseLlist (AcceptanceTester $I){
     $I->amOnPage(NotificationListPage::$ListPageURL);
     $I->seeOptionIsSelected(NotificationListPage::$ListSelectFirst, 'Новый');    
    }
//-----------------------SELECT NOTIFY FIELD STATUSE LIST-----------------------
    public function SelectFieldStatuseLlist (AcceptanceTester $I){
     $I->amOnPage(NotificationListPage::$ListPageURL);
     $I->selectOption(NotificationListPage::$ListSelectFirst, 'Выполнен');
     $I->seeOptionIsSelected(NotificationListPage::$ListSelectFirst, 'Выполнен');
     $I->amOnPage(NotificationListPage::$ListPageURL);
     $I->selectOption(NotificationListPage::$ListSelectFirst, 'Новый');
     $I->seeOptionIsSelected(NotificationListPage::$ListSelectFirst, 'Новый');    
    }
//--------------------CALENDAR PRESENCE INPUT FIELD VALUNIT LIST----------------
    public function CalendardVALUNITList (AcceptanceTester $I){
        $I->amOnPage(NotificationListPage::$ListPageURL);
        $I->appendField(NotificationListPage::$ListFildAddition, '2');
        $I->seeElement(NotificationListPage::$ListCalendar);        
        }
//--------------------BUTTON INFORMATION LIST-----------------------------------
    public function ButonInformationList (AcceptanceTester $I){
        $I->amOnPage(NotificationListPage::$ListPageURL);
        $I->click(NotificationListPage::$ListButtonInformation);
        $I->see('Товар', 'h3.popover-title');
        $I->see('Смартфон Samsung GT-S7530 Omnia M EAA Deep Grey (Смартфон Samsung GT-S7530 Omnia M EAA Deep Grey)', 'p > div.check_product > a');
        $I->click(NotificationListPage::$ListButtonInformation);
        $I->dontSeeElement('.popover.fade.left.in');
    }
//--------------------LINK BUTTON INFORMATION LIST------------------------------
    public function LinkButonInformationList (AcceptanceTester $I){
        $I->amOnPage(NotificationListPage::$ListPageURL);
        $I->click(NotificationListPage::$ListButtonInformation);
        $I->click('Смартфон Samsung GT-S7530 Omnia M EAA Deep Grey (Смартфон Samsung GT-S7530 Omnia M EAA Deep Grey)', '.popover.fade.left.in');
        $I->see('Смартфон Samsung GT-S7530 Omnia M EAA Deep Grey', 'span.title');
    }    
//-----------------------DEFAULT NOTIFY FIELD STATUSE  EDIT---------------------
    public function DefaultFieldStatuseist (AcceptanceTester $I){
     $I->amOnPage(NotificationListPage::$ListPageURL);
     $I->click(NotificationListPage::$ListLinkEditting);
     $I->seeOptionIsSelected(NotificationListPage::$EditingSelectStatus, 'Новый');    
    }
//-----------------------SELECT NOTIFY FIELD STATUSE EDITING--------------------
    public function SelectFieldStatuseist (AcceptanceTester $I){
     $I->amOnPage(NotificationListPage::$ListPageURL);
     $I->click(NotificationListPage::$ListLinkEditting);
     $I->selectOption(NotificationListPage::$EditingSelectStatus, 'Выполнен');
     $I->click(NotificationListPage::$EditingButtonSave);
     $I->seeOptionIsSelected(NotificationListPage::$EditingSelectStatus, 'Выполнен');
     $I->selectOption(NotificationListPage::$EditingSelectStatus, 'Новый');
     $I->click(NotificationListPage::$EditingButtonSave);
     $I->seeOptionIsSelected(NotificationListPage::$EditingSelectStatus, 'Новый');    
    }
//-------------UNACCEPTABLE INPUT FIELD VALIDUNIT EDITING-----------------------
    public function NoVALIDInputFieldVALIDUNITEditing (AcceptanceTester $I){
        $I->amOnPage(NotificationListPage::$ListPageURL);
        $I->click(NotificationListPage::$ListLinkEditting);
        $I->fillField(NotificationListPage::$EditingFildExpirationDate, 'QWE !@# ячс');
        $I->click(NotificationListPage::$EditingButtonSave);
        $I->dontSeeInField(NotificationListPage::$EditingFildExpirationDate, 'QWE !@# ячс');
    }
//--------------------VALID INPUT FIELD VALIDUNIT EDITING-----------------------
    public function VALIDInputFieldVALIDUNITEditing (AcceptanceTester $I){
        $I->amOnPage(NotificationListPage::$ListPageURL);
        $I->click(NotificationListPage::$ListLinkEditting);
        $I->fillField(NotificationListPage::$EditingFildExpirationDate, '1999-05-03');
        $I->click(NotificationListPage::$EditingButtonSave);
        $I->seeInField(NotificationListPage::$EditingFildExpirationDate, '1999-05-03');
    }
//--------------------CALENDAR PRESENCE INPUT FIELD VALUNIT EDITING-------------
    public function CalendarVALUnitEditing (AcceptanceTester $I){
        $I->amOnPage(NotificationListPage::$ListPageURL);
        $I->appendField(NotificationListPage::$ListFildAddition, '2');
        $I->seeElement(NotificationListPage::$ListCalendar);        
        }

//--------------------NOT SAVED INPUT FIELD NAME EDITING------------------------
      public function VALIDInputFieldNamediting (AcceptanceTester $I){
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
      public function VALIDInputFieldEmeilEditing (AcceptanceTester $I){
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
      public function VALIDInputFieldPhonelEditing (AcceptanceTester $I){
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
      public function VALIDInputFieldCommentlEditing (AcceptanceTester $I){
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
    public function TextDeletingNotifi(AcceptanceTester $I){
      $I->amOnPage(NotificationListPage::$ListPageURL);
      $I->click(NotificationListPage::$ListMainCheckBox);
      $I->click(NotificationListPage::$ListButtonDelete);
      $I->wait('1');
      $I->click(NotificationListPage::$DeleteWindowButtonDelete);
      $I->wait('1');
      InitTest::ClearAllCach($I);
    }
}