<?php
use \AcceptanceTester;
class FieldsNSCest
{
//---------------------------AUTORIZATION--------------------------------------- 
    
    public function Login(AcceptanceTester $I){
        InitTest::Login($I);
    }
    

//----------------INPUT SAVE PRESENCE 1 SYMVOL CREATE--------------------------- 
    
    
    public function CreatingStatus1Symbol(AcceptanceTester $I){
      $I->amOnPage(NotificationStatusesPage::$CreatePageUrl);
      $I->fillField(NotificationStatusesPage::$CreationFildInput, '1');
      $I->click(NotificationStatusesPage::$CreationButtonCreateAndGoBack);
      $I->waitForText('Статусы уведомлений о появлении');
      $I->see('1', NotificationStatusesPage::$ListTable);
    }   

    
    
//--------------------INPUT SAVE PRESENCE 500 SYMVOL CREATE---------------------
    
    
    public function CreatingStatus500Symbol(AcceptanceTester $I){
      $I->amOnPage(NotificationStatusesPage::$CreatePageUrl);
      $I->fillField(NotificationStatusesPage::$CreationFildInput,  InitTest::$text500);
      $I->click(NotificationStatusesPage::$CreationButtonCreateAndGoBack);
      $I->waitForText('Статусы уведомлений о появлении');
      $I->See(InitTest::$text500, NotificationStatusesPage::$ListTable);
      }

      
      
//----------------INPUT SAVE PRESENCE 501 SYMVOL CREATE-------------------------
      
      
    public function CreatingStatus501Symbol(AcceptanceTester $I){
      $I->amOnPage(NotificationStatusesPage::$CreatePageUrl);
      $I->fillField(NotificationStatusesPage::$CreationFildInput, InitTest::$text501);
      $I->click(NotificationStatusesPage::$CreationButtonCreateAndGoBack);
      $I->waitForText('Статусы уведомлений о появлении');
      $I->dontsee(InitTest::$text501, NotificationStatusesPage::$ListTable);
      $I->click(NotificationStatusesPage::$ListHeaderCheckBox);
      $I->click(NotificationStatusesPage::$ListCheckBoxFirst);
      $I->click(NotificationStatusesPage::$ListCheckBoxSecond);
      $I->click(NotificationStatusesPage::$ListCheckBoxThird);
      $I->click(NotificationStatusesPage::$ListButtonDelete);
      $I->wait(1);
      $I->click(NotificationStatusesPage::$DeleteWindowButtonDelete);
      $I->wait(1);
      InitTest::ClearAllCach($I);
    }   

    
    
//-------------------INPUT SAVE PRESENCE 1 SYMVOL EDIT-------------------------- 
    
    
    public function EdictingStatus1Symbol(AcceptanceTester $I){
      $I->amOnPage(NotificationStatusesPage::$ListPageURL);
      $I->click(NotificationStatusesPage::$ListLinkForEditing);
      $I->fillField(NotificationStatusesPage::$EditingFildInput, '1');
      $I->click(NotificationStatusesPage::$EditingButtonSaveAndGoBack);
      $I->waitForText('Статусы уведомлений о появлении');      
      $I->see('1', NotificationStatusesPage::$ListTable);
    }

    
    
//-----------------INPUT SAVE PRESENCE 500 SYMVOL EDIT-------------------------- 
    
    
    public function EdictingStatus500Symbol(AcceptanceTester $I){
      $I->amOnPage(NotificationStatusesPage::$ListPageURL);
      $I->click(NotificationStatusesPage::$ListLinkForEditing);
      $I->fillField(NotificationStatusesPage::$EditingFildInput, InitTest::$text500);
      $I->click(NotificationStatusesPage::$EditingButtonSaveAndGoBack);
      $I->waitForText('Статусы уведомлений о появлении'); 
      $I->see(InitTest::$text500, NotificationStatusesPage::$ListTable);
    }

    
    
//----------------INPUT SAVE PRESENCE 501 SYMVOL EDIT--------------------------- 
    
    
    public function EdictingStatus501Symbol(AcceptanceTester $I){
      $I->amOnPage(NotificationStatusesPage::$ListPageURL);
      $I->click(NotificationStatusesPage::$ListLinkForEditing);
      $I->fillField(NotificationStatusesPage::$EditingFildInput, InitTest::$text501);
      $I->click(NotificationStatusesPage::$EditingButtonSaveAndGoBack);
      $I->waitForText('Статусы уведомлений о появлении'); 
      $I->dontSee(InitTest::$text501, NotificationStatusesPage::$ListTable);
      $I->See(InitTest::$text500, NotificationStatusesPage::$ListTable);
      }
      
      
      
//---------------------------CLEARING-------------------------------------------
      
      
    public function CLEARING(AcceptanceTester $I){
      $I->amOnPage(NotificationStatusesPage::$ListPageURL);
      $I->click(NotificationStatusesPage::$ListHeaderCheckBox);
      $I->click(NotificationStatusesPage::$ListCheckBoxFirst);
      $I->click(NotificationStatusesPage::$ListCheckBoxSecond);
      $I->click(NotificationStatusesPage::$ListButtonDelete);
      $I->waitForText('Удаление статуса');
      $I->click(NotificationStatusesPage::$DeleteWindowButtonDelete);
      $I->wait('1');
      InitTest::ClearAllCach($I);
    }

    
    
//---------------INPUT SAVE PRESENCE VALID SYMVOL CREATE------------------------
    
    
    public function CreatingSymvol(AcceptanceTester $I){
      $I->amOnPage(NotificationStatusesPage::$CreatePageUrl);
      $I->fillField(NotificationStatusesPage::$CreationFildInput, InitTest::$textSymbols);
      $I->click(NotificationStatusesPage::$CreationButtonCreateAndGoBack);
      $I->waitForText('Статусы уведомлений о появлении'); 
      $I->see(InitTest::$textSymbols, NotificationStatusesPage::$ListTable);  
    }

    
    
//-----------------INPUT SAVE PRESENCE VALID SYMVOL EDIT------------------------ 
    
    
    public function EdictingSymvol(AcceptanceTester $I){
      $I->amOnPage(NotificationStatusesPage::$ListPageURL);
      $I->click(NotificationStatusesPage::$ListLinkForEditing);
      $I->fillField(NotificationStatusesPage::$EditingFildInput, InitTest::$textSymbols);
      $I->click(NotificationStatusesPage::$EditingButtonSaveAndGoBack);
      $I->waitForText('Статусы уведомлений о появлении'); 
      $I->see(InitTest::$textSymbols, NotificationStatusesPage::$ListTable);
      }
      
      
      
//---------------------------CLEARING-------------------------------------------  
      
      
    public function DELETING(AcceptanceTester $I){
      $I->amOnPage(NotificationStatusesPage::$ListPageURL);
      $I->click(NotificationStatusesPage::$ListHeaderCheckBox);
      $I->click(NotificationStatusesPage::$ListCheckBoxFirst);
      $I->click(NotificationStatusesPage::$ListCheckBoxSecond);
      $I->click(NotificationStatusesPage::$ListButtonDelete);
      $I->wait('1');
      $I->click(NotificationStatusesPage::$DeleteWindowButtonDelete);
      $I->wait('1');
      $I->dontSee(InitTest::$textSymbols);
      InitTest::ClearAllCach($I);
    }   
    
    
    
}