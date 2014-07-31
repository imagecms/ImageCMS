<?php
use \AcceptanceTester;
class FieldsNSCest
{
//---------------------------AUTORIZATION--------------------------------------- 
    /**
     * @group a
     */
    public function Login(AcceptanceTester $I){
        InitTest::Login($I);
    }
    

//----------------INPUT SAVE PRESENCE 1 SYMVOL CREATE--------------------------- 
    
    /**
     * @group a
     */
    public function CreatingStatus1Symbol(AcceptanceTester $I){
        $I->wantTo('Создать статус с минимально допустимым значением в поле "Название".');
        $I->amOnPage(NotificationStatusesPage::$CreatePageUrl);
        $I->fillField(NotificationStatusesPage::$CreationFildInput, '1');
        $I->click(NotificationStatusesPage::$CreationButtonCreateAndGoBack);
        $I->waitForText('Статусы уведомлений о появлении');
        $I->see('1', NotificationStatusesPage::$ListTable);
    }   

    
    
//--------------------INPUT SAVE PRESENCE 500 SYMVOL CREATE---------------------
    
    /**
     * @group a
     */
    public function CreatingStatus500Symbol(AcceptanceTester $I){
        $I->wantTo('Создать статус с максимально допустимым значением в поле "Название".');
        $I->amOnPage(NotificationStatusesPage::$CreatePageUrl);
        $I->fillField(NotificationStatusesPage::$CreationFildInput,  InitTest::$text500);
        $I->click(NotificationStatusesPage::$CreationButtonCreateAndGoBack);
        $I->waitForText('Статусы уведомлений о появлении');
        $I->See(InitTest::$text500, NotificationStatusesPage::$ListTable);
    }

      
      
//----------------INPUT SAVE PRESENCE 501 SYMVOL CREATE-------------------------
      
    /**
     * @group a
     */  
    public function CreatingStatus501Symbol(AcceptanceTester $I){
        $I->wantTo('Создать статус с 501 введенным символом в поле "Название".');
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
    }   

    
    
//-------------------INPUT SAVE PRESENCE 1 SYMVOL EDIT-------------------------- 
    
    /**
     * @group a
     */
    public function EdictingStatus1Symbol(AcceptanceTester $I){
        $I->wantTo('Отредактировать статус с минимально допустимым значением в поле "Название".');
        $I->amOnPage(NotificationStatusesPage::$ListPageURL);
        $I->click(NotificationStatusesPage::$ListLinkForEditing);
        $I->fillField(NotificationStatusesPage::$EditingFildInput, '1');
        $I->click(NotificationStatusesPage::$EditingButtonSaveAndGoBack);
        $I->waitForText('Статусы уведомлений о появлении');      
        $I->see('1', NotificationStatusesPage::$ListTable);
    }

    
    
//-----------------INPUT SAVE PRESENCE 500 SYMVOL EDIT-------------------------- 
    
    /**
     * @group a
     */
    public function EdictingStatus500Symbol(AcceptanceTester $I){
        $I->wantTo('Отредактировать статус с максимально допустимым значением в поле "Название".');
        $I->amOnPage(NotificationStatusesPage::$ListPageURL);
        $I->click(NotificationStatusesPage::$ListLinkForEditing);
        $I->fillField(NotificationStatusesPage::$EditingFildInput, InitTest::$text500);
        $I->click(NotificationStatusesPage::$EditingButtonSaveAndGoBack);
        $I->waitForText('Статусы уведомлений о появлении'); 
        $I->see(InitTest::$text500, NotificationStatusesPage::$ListTable);
    }

    
    
//----------------INPUT SAVE PRESENCE 501 SYMVOL EDIT--------------------------- 
    
    /**
     * @group a
     */
    public function EdictingStatus501Symbol(AcceptanceTester $I){
        $I->wantTo('Отредактировать статус с 501 введенным символом в поле "Название".');
        $I->amOnPage(NotificationStatusesPage::$ListPageURL);
        $I->click(NotificationStatusesPage::$ListLinkForEditing);
        $I->fillField(NotificationStatusesPage::$EditingFildInput, InitTest::$text501);
        $I->click(NotificationStatusesPage::$EditingButtonSaveAndGoBack);
        $I->waitForText('Статусы уведомлений о появлении'); 
        $I->dontSee(InitTest::$text501, NotificationStatusesPage::$ListTable);
        $I->See(InitTest::$text500, NotificationStatusesPage::$ListTable);
    }
      
      
      
//---------------------------CLEARING-------------------------------------------
      
    /**
     * @group a
     */ 
    public function CLEARING(AcceptanceTester $I){
        $I->wantTo('Проверить отсутствие удалинных созданных и отредактированных статусов уведомлений.');
        $I->amOnPage(NotificationStatusesPage::$ListPageURL);
        $I->click(NotificationStatusesPage::$ListHeaderCheckBox);
        $I->click(NotificationStatusesPage::$ListCheckBoxFirst);
        $I->click(NotificationStatusesPage::$ListCheckBoxSecond);
        $I->click(NotificationStatusesPage::$ListButtonDelete);
        $I->waitForText('Удаление статуса');
        $I->click(NotificationStatusesPage::$DeleteWindowButtonDelete);
        $I->wait('1');
    }

    
    
//---------------INPUT SAVE PRESENCE VALID SYMVOL CREATE------------------------
    
    /**
     * @group a
     */
    public function CreatingSymvol(AcceptanceTester $I){
        $I->wantTo('Создать статус с введенными спе-символами в поле "Название".');
        $I->amOnPage(NotificationStatusesPage::$CreatePageUrl);
        $I->fillField(NotificationStatusesPage::$CreationFildInput, InitTest::$textSymbols);
        $I->click(NotificationStatusesPage::$CreationButtonCreateAndGoBack);
        $I->waitForText('Статусы уведомлений о появлении'); 
        $I->see(InitTest::$textSymbols, NotificationStatusesPage::$ListTable);  
    }

    
    
//-----------------INPUT SAVE PRESENCE VALID SYMVOL EDIT------------------------ 
    
    /**
     * @group a
     */
    public function EdictingSymvol(AcceptanceTester $I){
        $I->wantTo('Отредактиовать статус с введенными спе-символами в поле "Название".');
        $I->amOnPage(NotificationStatusesPage::$ListPageURL);
        $I->click(NotificationStatusesPage::$ListLinkForEditing);
        $I->fillField(NotificationStatusesPage::$EditingFildInput, InitTest::$textSymbols);
        $I->click(NotificationStatusesPage::$EditingButtonSaveAndGoBack);
        $I->waitForText('Статусы уведомлений о появлении'); 
        $I->see(InitTest::$textSymbols, NotificationStatusesPage::$ListTable);
    }
      
      
      
//---------------------------CLEARING-------------------------------------------  
      
    /**
     * @group a
     */ 
    public function DELETING(AcceptanceTester $I){
        $I->wantTo('Проверить возможность возобновления первичного состояния модуля "Статусы уведомления", после тестирования.');
        $I->amOnPage(NotificationStatusesPage::$ListPageURL);
        $I->click(NotificationStatusesPage::$ListHeaderCheckBox);
        $I->click(NotificationStatusesPage::$ListCheckBoxFirst);
        $I->click(NotificationStatusesPage::$ListCheckBoxSecond);
        $I->click(NotificationStatusesPage::$ListButtonDelete);
        $I->wait('1');
        $I->click(NotificationStatusesPage::$DeleteWindowButtonDelete);
        $I->wait('1');
        $I->dontSee(InitTest::$textSymbols);
    }   
    
    
    
}