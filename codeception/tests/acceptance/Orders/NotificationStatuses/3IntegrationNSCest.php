<?php
use \AcceptanceTester;
class IntegrationNSCest
{
//---------------------------AUTORIZATION---------------------------------------

    public function Login(AcceptanceTester $I){
        InitTest::Login($I);
    }
    
//---------------------------CREATE NOTIFI FRONT--------------------------------  
    
    
    public function CreateNotificationFront(AcceptanceTester $I){
      $I->amOnPage('/shop/category/telefoniia-pleery-gps/telefony/smartfony?per_page=12');
      $I->wait('1');
      $I->scrollToElement($I, '.infoBut.isDrop');
      $I->wait('1');
      $I->click('.infoBut.isDrop');
      $I->wait('1');
      $I->click('//span[2]/div/button');
    }        

    
    
//---------------------------CREATE STATUS--------------------------------------  
    
    
    public function VerifySavedCreateStatus (AcceptanceTester $I){    
    $I->amOnPage(NotificationStatusesPage::$CreatePageUrl);
    $I->fillField(NotificationStatusesPage::$CreationFildInput, '123 qwe !@# ЯЧС');
    $I->click(NotificationStatusesPage::$CreationButtonCreateAndGoBack);
    $I->waitForText('Статусы уведомлений о появлении');
    $I->See('123 qwe !@# ЯЧС', '//div[3]/section/div[2]');
    }

    
    
//---------------------------PRESENCE CREATED STATUS----------------------------    
    
    
    public function CreatingStatusMappingOnThePageNotificationList (AcceptanceTester $I){
     $I->amOnPage(NotificationListPage::$ListPageURL);
     $I->see('123 qwe !@# ЯЧС',  NotificationListPage::$ListSelectMain);
     $I->selectOption(NotificationListPage::$ListSelectFirst, '123 qwe !@# ЯЧС');
     $I->click(NotificationListPage::$ListButtonCreatedStatus);
     $I->wait('1');
     $I->click(NotificationListPage::$ListLinkEdittingCreateStatusButton);
     $I->seeOptionIsSelected(NotificationListPage::$EditingSelectStatus, '123 qwe !@# ЯЧС');
    } 

    
    
//---------------------------EDICTING STATUS------------------------------------   
    
    
    public function VerifySavedEditStatus (AcceptanceTester $I){
    $I->amOnPage(NotificationStatusesPage::$ListPageURL);
    $I->click(NotificationStatusesPage::$ListLinkForEditing);
    $I->fillField(NotificationStatusesPage::$EditingFildInput, 'Гидрокарбонат');
    $I->click(NotificationStatusesPage::$EditingButtonSaveAndGoBack);
    $I->waitForText('Статусы уведомлений о появлении');
    $I->See('Гидрокарбонат', '//div[3]/section/div[2]');
    }
    
    
//---------------------------PRESENCE EDICTING STATUS---------------------------       
    
    
    public function EditingStatusMappingOnThePageNotificationList (AcceptanceTester $I){
         $I->amOnPage(NotificationListPage::$ListPageURL);   
         $I->see('Гидрокарбонат',  NotificationListPage::$ListSelectMain);   
         $I->selectOption(NotificationListPage::$ListSelectFirst, 'Гидрокарбонат');    
         $I->click(NotificationListPage::$ListButtonCreatedStatus);
         $I->wait('1');
         $I->click(NotificationListPage::$ListLinkEdittingCreateStatusButton);
         $I->seeOptionIsSelected(NotificationListPage::$EditingSelectStatus, 'Гидрокарбонат');
         }   

         
         
//---------------------------DELETE STATUS--------------------------------------
         
         
    public function VerifyDeletedEditingStatus(AcceptanceTester $I){
            $I->amOnPage(NotificationStatusesPage::$ListPageURL);
            $I->click(NotificationStatusesPage::$ListHeaderCheckBox);
            $I->click(NotificationStatusesPage::$ListCheckBoxFirst);
            $I->click(NotificationStatusesPage::$ListCheckBoxSecond);
            $I->click(NotificationStatusesPage::$ListButtonDelete);
            $I->wait('1');
            $I->click(NotificationStatusesPage::$DeleteWindowButtonDelete);
            $I->wait('1');
            $I->dontSeeLink('Гидрокарбонат');   
            }

            
            
//---------------------------NOT PRESENCE DELETING STATUS-----------------------  
            
            
    public function DeletingStatusMappingOnThePageNotificationList(AcceptanceTester $I){
    $I->amOnPage(NotificationListPage::$ListPageURL);
    $I->dontsee('Гидрокарбонат',  NotificationListPage::$ListSelectMain); 
    $I->dontsee('123 qwe !@# ЯЧС',  NotificationListPage::$ListSelectMain);
    $I->dontSeeOptionIsSelected(NotificationListPage::$ListSelectFirst, 'Гидрокарбонат'); 
    $I->dontSeeOptionIsSelected(NotificationListPage::$ListSelectFirst, '123 qwe !@# ЯЧС'); 
    $I->click(NotificationListPage::$ListLinkEditting);
    $I->dontseeOptionIsSelected(NotificationListPage::$EditingSelectStatus, 'Гидрокарбонат');
    $I->dontseeOptionIsSelected(NotificationListPage::$EditingSelectStatus, '123 qwe !@# ЯЧС');             
    }
    

//---------------------------CLEARING-------------------------------------------    
    
    
    public function DeleteNotification(AcceptanceTester $I){
    $I->amOnPage(NotificationListPage::$ListPageURL);
    $I->click(NotificationListPage::$ListMainCheckBox);
    $I->click(NotificationListPage::$ListButtonDelete);
    $I->wait('1');
    $I->click(NotificationListPage::$DeleteWindowButtonDelete);
    $I->wait('1');
    InitTest::ClearAllCach($I);
    } 
    
    
    
}    

