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
        $I->wait('3');
        $amount_rows = $I->grabCCSAmount($I, '.share_alt');
        for($j = 1;$j <= $amount_rows;++$j){
            $name_notification = $I->grabTextFrom(NotificationStatusesListPage::lineNameLink($j));
            if($name_notification == '1'){
            $I->see('1', NotificationStatusesListPage::lineNameLink($j));
            $I->wait('1');
            $I->click(NotificationStatusesListPage::lineCheck($j));
            $I->wait('1');
                $I->click(NotificationStatusesListPage::$ButtonDelete);
                $I->wait('1');
                $I->click(NotificationStatusesListPage::$WindowDeleteButtonDelete);
                $I->wait('1');
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
        $I->wait('3');
        $amount_rows = $I->grabCCSAmount($I, '.share_alt');
        $I->wait('1');
        for($j = 1;$j <= $amount_rows;++$j){
            $name_notification = $I->grabTextFrom(NotificationStatusesListPage::lineNameLink($j));
            $I->wait('1');
            if($name_notification == InitTest::$text500){
                $I->wait('1');
                $I->see(InitTest::$text500, NotificationStatusesListPage::lineNameLink($j));
                $I->wait('1');
                $I->click(NotificationStatusesListPage::lineCheck($j));
                $I->wait('1');
                $I->click(NotificationStatusesListPage::$ButtonDelete);
                $I->wait('1');
                $I->click(NotificationStatusesListPage::$WindowDeleteButtonDelete);
                $I->wait('1');
                $I->dontSee(InitTest::$text500, NotificationStatusesListPage::$Table);
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
        $I->wait('3');
        $amount_rows = $I->grabCCSAmount($I, '.share_alt');
        $I->wait('1');
        for($j = 1;$j <= $amount_rows;++$j){
            $name_notification = $I->grabTextFrom(NotificationStatusesListPage::lineNameLink($j));
            $I->wait('1');
            if($name_notification == InitTest::$text500){
                $I->wait('1');
                $I->see(InitTest::$text500, NotificationStatusesListPage::lineNameLink($j));
                $I->wait('1');
                $I->click(NotificationStatusesListPage::lineCheck($j));
                $I->wait('1');
                $I->click(NotificationStatusesListPage::$ButtonDelete);
                $I->wait('1');
                $I->click(NotificationStatusesListPage::$WindowDeleteButtonDelete);
                $I->wait('1');
                $I->dontSee(InitTest::$text500, NotificationStatusesListPage::$Table);
                }
        }
    }   
    
    
      
//-------------------INPUT SAVE PRESENCE 1 SYMVOL EDIT-------------------------- 
    
    /**
     * @group aa
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
        $I->wait('2');
        $I->see('as 21 Q', NotificationStatusesListPage::$Table);
        $amount_rows = $I->grabCCSAmount($I, '.share_alt');
        $I->wait('1');
        for($j = 1;$j <= $amount_rows;++$j){
            $name_notification = $I->grabTextFrom(NotificationStatusesListPage::lineNameLink($j));
            $I->wait('1');
            if($name_notification == 'as 21 Q'){
                $I->wait('1');
                $I->see('as 21 Q', NotificationStatusesListPage::lineNameLink($j));
                $I->wait('1');
                $I->click(NotificationStatusesListPage::lineCheck($j));
                $I->wait('1');
                $I->click(NotificationStatusesListPage::$ButtonDelete);
                $I->wait('1');
                $I->click(NotificationStatusesListPage::$WindowDeleteButtonDelete);
                $I->wait('1');
                $I->dontSee('as 21 Q', NotificationStatusesListPage::$Table);
            }
        }
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
        $I->fillField(NotificationStatusesCreatePage::$InputName, '1234 QWERT хзщфыв asd ФІВЇ');
        $I->click(NotificationStatusesCreatePage::$ButtonCreateExit);
        $I->wait('3');
        $amount_rows = $I->grabCCSAmount($I, '.share_alt');
        for($j = 1;$j <= $amount_rows;++$j){
            $name_notification = $I->grabTextFrom(NotificationStatusesListPage::lineNameLink($j));
            if($name_notification == '1234 QWERT хзщфыв asd ФІВЇ'){
                $I->wait('1');
                $I->see('1234 QWERT хзщфыв asd ФІВЇ', NotificationStatusesListPage::lineNameLink($j));
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
        $I->wait('3');  
        $amount_rows = $I->grabCCSAmount($I, '.share_alt');
        for($j = 1;$j <= $amount_rows;++$j){
            $name_notification = $I->grabTextFrom(NotificationStatusesListPage::lineNameLink($j));
            if($name_notification == '1234 QWERT хзщфыв asd ФІВЇ'){
            $I->click(NotificationStatusesListPage::lineNameLink($j));
            $I->wait('1');
            $I->fillField(NotificationStatusesEditPage::$InputName, '1234 QWERT хзщфыв asd ФІВЇ');
            $I->click(NotificationStatusesEditPage::$ButtonSaveExit);
            $I->wait('1');
            $I->see('1234 QWERT хзщфыв asd ФІВЇ', NotificationStatusesListPage::lineNameLink($j));
            $I->wait('1');
            $I->click(NotificationStatusesListPage::lineCheck($j));
            $I->wait('1');
            $I->click(NotificationStatusesListPage::$ButtonDelete);
            $I->wait('1');
            $I->click(NotificationStatusesListPage::$WindowDeleteButtonDelete);
            $I->wait('1');
            $I->dontSee('1234 QWERT хзщфыв asd ФІВЇ', NotificationStatusesListPage::$Table);
            }
        }
    }
      
      
      
//---------------------------CLEARING-------------------------------------------  
      
    
    
    
    /**
     * @group a
     */ 
    public function DELETING(NotificationStatusesTester $I){
        $I->click(NavigationBarPage::$Orders);
        $I->click(NavigationBarPage::$NotificationStatuses);
        $I->wait('5');
        $amount_rows = $I->grabCCSAmount($I, '.share_alt');
        $I->comment("$amount_rows");
        for($j = 1;$j <= $amount_rows;$j++){
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
        $I->dontSee(InitTest::$text500, NotificationStatusesListPage::$Table);
        $I->wait('1');
        $I->dontSee('as 21 Q', NotificationStatusesListPage::$Table);
        $I->wait('1');
        $I->dontSee('1234 QWERT хзщфыв asd ФІВЇ', NotificationStatusesListPage::$Table);
        InitTest::ClearAllCach($I); 
    }   
    
    
    

    
}