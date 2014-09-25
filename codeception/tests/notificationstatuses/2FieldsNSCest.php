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
     * @group a
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
     * @group a
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
    }

      
      
//----------------INPUT SAVE PRESENCE 501 SYMVOL CREATE-------------------------
      
    /**
     * @group a
     */  
    public function CreatingStatus501Symbol(NotificationStatusesTester $I){
        $I->click(NavigationBarPage::$Orders);
        $I->click(NavigationBarPage::$NotificationStatuses);
        $I->wait('1');
        $I->click(NotificationStatusesListPage::$ButtonCreate);
        $I->wait('1');
        $I->fillField(NotificationStatusesCreatePage::$InputName, InitTest::$text501);
        $I->click(NotificationStatusesCreatePage::$ButtonCreateExit);
        $I->wait('1');
        $I->dontsee(InitTest::$text501);
        $I->wait('1');
    }   
    
    
    /**
     * @group a
     */  
    public function DeleteCreatingNotificationStatuses(NotificationStatusesTester $I){
        $I->click(NavigationBarPage::$Orders);
        $I->click(NavigationBarPage::$NotificationStatuses);
        $I->wait('1');
        $I->click(NotificationStatusesListPage::$HeadCheck);
        $I->click(NotificationStatusesListPage::lineCheck(1));
        $I->click(NotificationStatusesListPage::lineCheck(2));
        $I->click(NotificationStatusesListPage::$ButtonDelete);
        $I->wait('1');
        $I->click(NotificationStatusesListPage::$WindowDeleteButtonDelete);
        $I->wait('2');
    }
  
//-------------------INPUT SAVE PRESENCE 1 SYMVOL EDIT-------------------------- 
    
    /**
     * @group a
     */
    public function EdictingStatus1Symbol(NotificationStatusesTester $I){
        $I->click(NavigationBarPage::$Orders);
        $I->click(NavigationBarPage::$NotificationStatuses);
        $I->wait('1');
        $I->click(NotificationStatusesListPage::$ButtonCreate);
        $I->wait('1');
        $I->fillField(NotificationStatusesCreatePage::$InputName, 'a 3');
        $I->click(NotificationStatusesCreatePage::$ButtonCreate);
        $I->wait('1');
        $I->fillField(NotificationStatusesEditPage::$InputName, 'as 21 Q');
        $I->click(NotificationStatusesEditPage::$ButtonSaveExit);
        $I->wait('1');
        $I->see('as 21 Q');
    }
    
  
//---------------INPUT SAVE PRESENCE VALID SYMVOL CREATE------------------------
    
    /**
     * @group a
     */
    public function CreatingSymvol(NotificationStatusesTester $I){
        $I->click(NavigationBarPage::$Orders);
        $I->click(NavigationBarPage::$NotificationStatuses);
        $I->wait('1');
        $I->click(NotificationStatusesListPage::$ButtonCreate);
        $I->wait('1');
        $I->fillField(NotificationStatusesCreatePage::$InputName, InitTest::$textSymbols);
        $I->click(NotificationStatusesCreatePage::$ButtonCreateExit);
        $I->wait('1');
        $amount_rows = $I->grabCCSAmount($I, '.share_alt');
        for($j = 1;$j <= $amount_rows;++$j){
            $name_notification = $I->grabTextFrom(NotificationStatusesListPage::lineNameLink($j));
            if($name_notification == InitTest::$textSymbols){
            $I->see(InitTest::$textSymbols, NotificationStatusesListPage::lineNameLink($j));
            }
        }
    } 
 
//-----------------INPUT SAVE PRESENCE VALID SYMVOL EDIT------------------------ 
    
    /**
     * @group a
     */
    public function EdictingSymvol(NotificationStatusesTester $I){
        $I->click(NavigationBarPage::$Orders);
        $I->click(NavigationBarPage::$NotificationStatuses);
        $I->wait('1');  
        $amount_rows = $I->grabCCSAmount($I, '.share_alt');
        for($j = 1;$j <= $amount_rows;++$j){
            $name_notification = $I->grabTextFrom(NotificationStatusesListPage::lineNameLink($j));
            if($name_notification == InitTest::$textSymbols){
            $I->click(NotificationStatusesListPage::lineNameLink($j));
            $I->wait('1');
            $I->fillField(NotificationStatusesEditPage::$InputName, InitTest::$textSymbols);
            $I->click(NotificationStatusesEditPage::$ButtonSaveExit);
            $I->wait('1');
            $I->see(InitTest::$textSymbols, NotificationStatusesListPage::lineNameLink($j));
            }
        }
    }
      
      
      
//---------------------------CLEARING-------------------------------------------  
      
    /**
     * @group aa
     */ 
    public function DELETING(NotificationStatusesTester $I){
        $I->click(NavigationBarPage::$Orders);
        $I->click(NavigationBarPage::$NotificationStatuses);
        $I->wait('4');
        $amount_rows = $I->grabCCSAmount($I, '.share_alt');
        for($j = 1;$j <= $amount_rows;++$j){
            $name_notification = $I->grabTextFrom(NotificationStatusesListPage::lineNameLink($j));
            $I->wait('1');
            if($name_notification != 'Новый' && $name_notification != 'Выполнен'){
                $I->wait('1');
                $I->click(NotificationStatusesListPage::lineCheck($j));
                $I->wait('1');
                $I->click(NotificationStatusesListPage::$ButtonDelete);
                $I->wait('1');
                $I->click(NotificationStatusesListPage::$WindowDeleteButtonDelete);
                $I->wait('1'); 
                $amount_rows--;
                $j--;
            }        
        }
        $I->dontSee(InitTest::$textSymbols);
        $I->dontSee(InitTest::$text500);
        $I->dontSee('as 21 Q');
        InitTest::ClearAllCach($I); 
    }   
    
    
    
}