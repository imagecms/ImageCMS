<?php
use \NotificationStatusesTester;
class FieldsNSCest
{
//---------------------------AUTORIZATION--------------------------------------- 
    /**
     * @group aa
     */
    public function Login(NotificationStatusesTester $I){
        InitTest::Login($I);
    }
    

//----------------INPUT SAVE PRESENCE 1 SYMVOL CREATE--------------------------- 
    
    /**
     * @group aa
     */
    public function CreatingStatus1Symbol(NotificationStatusesTester $I){
        $I->click(NavigationBarPage::$Orders);
        $I->click(NavigationBarPage::$NotificationStatuses);
        $I->wait('1');
        $I->click(NotificationStatusesListPage::$ButtonCreate);
        $I->wait('1');
        $I->fillField(NotificationStatusesCreatePage::$InputName, '1');
        $I->click(NotificationStatusesCreatePage::$ButtonCreateExit);
        $I->wait('1');
        $amount_rows = $I->grabCCSAmount($I, '.share_alt');
        for($j = 1;$j <= $amount_rows;++$j){
            $name_notification = $I->grabTextFrom(NotificationStatusesListPage::lineNameLink($j));
            if($name_notification == '1'){
            $I->see('1', NotificationStatusesListPage::lineNameLink($j));
            }
        }
    }   

    
    
//--------------------INPUT SAVE PRESENCE 500 SYMVOL CREATE---------------------
    
    /**
     * @group aa
     */
    public function CreatingStatus500Symbol(NotificationStatusesTester $I){
        $I->click(NavigationBarPage::$Orders);
        $I->click(NavigationBarPage::$NotificationStatuses);
        $I->wait('1');
        $I->click(NotificationStatusesListPage::$ButtonCreate);
        $I->wait('1');
        $I->fillField(NotificationStatusesCreatePage::$InputName, InitTest::$text500);
        $I->click(NotificationStatusesCreatePage::$ButtonCreateExit);
        $I->wait('1');
        $amount_rows = $I->grabCCSAmount($I, '.share_alt');
        $I->wait('1');
        for($j = 1;$j <= $amount_rows;++$j){
            $name_notification = $I->grabTextFrom(NotificationStatusesListPage::lineNameLink($j));
            $I->wait('1');
            if($name_notification == InitTest::$text500){
                $I->wait('1');
                $I->see(InitTest::$text500, NotificationStatusesListPage::lineNameLink($j));
                }
        }
        
        
//        $I->wantTo('Verify Create and Present Status Whit 500 Symbol on Name.');
//        $I->amOnPage(NotificationStatusesPage::$CreatePageUrl);
//        $I->fillField(NotificationStatusesPage::$CreationFildInput,  InitTest::$text500);
//        $I->click(NotificationStatusesPage::$CreationButtonCreateAndGoBack);
//        $I->waitForText('Статусы уведомлений о появлении');
//        $I->See(InitTest::$text500, NotificationStatusesPage::$ListTable);
    }

      
      
//----------------INPUT SAVE PRESENCE 501 SYMVOL CREATE-------------------------
      
    /**
     * @group a
     */  
    public function CreatingStatus501Symbol(NotificationStatusesTester $I){
        $I->wantTo('Verify Create and Present Status Whit 501 Symbol on Name.');
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
    public function EdictingStatus1Symbol(NotificationStatusesTester $I){
        $I->wantTo('Verify Edit and Present Status Whit 1 Symbol on Name.');
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
    public function EdictingStatus500Symbol(NotificationStatusesTester $I){
        $I->wantTo('Verify Edit and Present Status Whit 500 Symbol on Name.');
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
    public function EdictingStatus501Symbol(NotificationStatusesTester $I){
        $I->wantTo('Verify Edit and Present Status Whit 501 Symbol on Name.');
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
    public function CLEARING(NotificationStatusesTester $I){
        $I->wantTo('Verify Delete Status.');
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
    public function CreatingSymvol(NotificationStatusesTester $I){
        $I->wantTo('Verify Create and Present Status Whit Symbol on Name.');
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
    public function EdictingSymvol(NotificationStatusesTester $I){
        $I->wantTo('Verify Edit and Present Status Whit 1 Symbol on Name.');
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
    public function DELETING(NotificationStatusesTester $I){
        $I->wantTo('Verify Delete and Not Present Status.');
        $I->amOnPage(NotificationStatusesPage::$ListPageURL);
        $I->click(NotificationStatusesPage::$ListHeaderCheckBox);
        $I->click(NotificationStatusesPage::$ListCheckBoxFirst);
        $I->click(NotificationStatusesPage::$ListCheckBoxSecond);
        $I->click(NotificationStatusesPage::$ListButtonDelete);
        $I->wait('1');
        $I->click(NotificationStatusesPage::$DeleteWindowButtonDelete);
        $I->wait('2');
        $I->dontSee(InitTest::$textSymbols);
        InitTest::ClearAllCach($I); 
    }   
    
    
    
}