<?php
use \NotificationStatusesTester;
class IntegrationNSCest
{
    
    private $ID_Create_Status;
    private $Position_Create_Status;
    private $name_create_status =  '123 qwe !@# ЯЧС';
//---------------------------AUTORIZATION---------------------------------------
    /**
     * @group aa
     */
    public function Login(NotificationStatusesTester $I){
        InitTest::Login($I);
    }
    
//------------------CREATE Category, Product and NOTIFI FRONT-------------------
    /**
     * @group a
     * @guy NotificationStatusesTester\NotificationStatusesSteps 
     */
    public function CreateProductCategory(NotificationStatusesTester\NotificationStatusesSteps $I) {
        $I->CreateProductCategory($createNameCategory = 'Уведомленная');
    }
    
    
    /**
     * @group a
     * @guy NotificationStatusesTester\NotificationStatusesSteps 
     */
    public function CreateProduct(NotificationStatusesTester\NotificationStatusesSteps $I) {
        $I->CreateProduct(  $Name_Product       = 'Уведомления ради',
                            $Price_Product      = '888',
                            $Amount_Product     = '0',
                            $Category_Product   = 'Уведомленная');
    }
    
    

    /**
     * @group a
     */
    public function CreateNotificationFront(NotificationStatusesTester $I){
        $I->amOnPage('/shop/category/uvedomlennaia#');
        $I->wait('1');
        $I->scrollToElement($I, '.infoBut.isDrop');
        $I->wait('1');
        $I->click('.infoBut.isDrop');
        $I->wait('1');
        $I->click('//span[2]/div/button');
    }

    
    
//---------------------------CREATE STATUS--------------------------------------  
    
    /**
     * @group a
     */
    public function VerifySavedCreateStatus (NotificationStatusesTester $I){         
        $I->amOnPage(NotificationStatusesCreatePage::$URL);
        $I->wait('1');
        $I->fillField(NotificationStatusesCreatePage::$InputName, $this->name_create_status);
        $I->click(NotificationStatusesCreatePage::$ButtonCreateExit);
        $I->wait('1');
        $amount_rows = $I->grabCCSAmount($I, '.share_alt');
        for($j = 1;$j <= $amount_rows;++$j){
            $name_notification = $I->grabTextFrom(NotificationStatusesListPage::lineNameLink($j));
            if($name_notification == $this->name_create_status){
                $I->wait('1');
                $I->see('123 qwe !@# ЯЧС', NotificationStatusesListPage::lineNameLink($j));
            }
        }        
    }
    
    
    /**
     * @group aa
     * @guy NotificationStatusesTester\NotificationStatusesSteps 
     */
    public function GetIDCreateStatus(NotificationStatusesTester\NotificationStatusesSteps  $I) {
               
        $ID_Status = $I->GetIDStatus($name_statuse = $this->name_create_status);
        $this->ID_Create_Status = $ID_Status;
        $I->comment("ID созданного статуса: '$this->ID_Create_Status'");
        
        $number_position = $I->GetPositionStatus($name_statuse = $this->name_create_status);
        $this->Position_Create_Status = $number_position;
        $I->comment("Номер позиции созданого статуса увеличен на(+2), для страницы 'Список Уведомлений': '$this->Position_Create_Status'");
    }

    
    
//---------------------------PRESENCE CREATED STATUS----------------------------    
    
    /**
     * @group aa
     */
    public function CreatingStatusMappingOnThePageNotificationList (NotificationStatusesTester $I){
        $I->amOnPage(NotificationListPage::$URL);
        $I->wait('1');        
        $I->see('123 qwe !@# ЯЧС', NotificationListPage::tab($this->Position_Create_Status));
        $I->selectOption(NotificationListPage::tabAllLineStatusSelect(1), '123 qwe !@# ЯЧС');
        $I->wait('1');  
        $I->click(NotificationListPage::tab($this->Position_Create_Status));
        $I->wait('1');
        $I->click(NotificationListPage::lineEmailLink($this->ID_Create_Status, 1));
        $I->wait('1');        
        $I->seeOptionIsSelected(NotificationEditPage::$SelectStatus, '123 qwe !@# ЯЧС');
    } 

    
    
//---------------------------EDICTING STATUS------------------------------------   
    
    /**
     * @group a
     */
    public function VerifySavedEditStatus (NotificationStatusesTester $I){
        $I->wantTo('Verify Edited Status Present on Status List Page.');
        $I->amOnPage(NotificationStatusesPage::$ListPageURL);
        $I->wait('1');
        $I->click(NotificationStatusesPage::$ListLinkForEditing);
        $I->fillField(NotificationStatusesPage::$EditingFildInput, 'Гидрокарбонат');
        $I->click(NotificationStatusesPage::$EditingButtonSaveAndGoBack);
        $I->waitForText('Статусы уведомлений о появлении');
        $I->See('Гидрокарбонат', '//div[3]/section/div[2]');
    }
    
    
//---------------------------PRESENCE EDICTING STATUS---------------------------       
    
    /**
     * @group a
     */
    public function EditingStatusMappingOnThePageNotificationList (NotificationStatusesTester $I){
        $I->wantTo('Verify Edited Status Present on Notification List Page.');
        $I->amOnPage(NotificationListPage::$ListPageURL);   
        $I->see('Гидрокарбонат',  NotificationListPage::$ListSelectMain);   
        $I->selectOption(NotificationListPage::$ListSelectFirst, 'Гидрокарбонат');    
        $I->click(NotificationListPage::$ListButtonCreatedStatus);
        $I->wait('1');
        $I->click(NotificationListPage::$ListLinkEdittingCreateStatusButton);
        $I->seeOptionIsSelected(NotificationListPage::$EditingSelectStatus, 'Гидрокарбонат');
    }   

         
         
//---------------------------DELETE STATUS--------------------------------------
         
    /**
     * @group a
     */     
    public function VerifyDeletedEditingStatus(NotificationStatusesTester $I){
        $I->wantTo('Verify Deleted Status Not Present on Status List Page.');
        $I->amOnPage(NotificationStatusesPage::$ListPageURL);
        $I->wait('1');
        $I->click(NotificationStatusesPage::$ListHeaderCheckBox);
        $I->click(NotificationStatusesPage::$ListCheckBoxFirst);
        $I->click(NotificationStatusesPage::$ListCheckBoxSecond);
        $I->click(NotificationStatusesPage::$ListButtonDelete);
        $I->wait('1');
        $I->click(NotificationStatusesPage::$DeleteWindowButtonDelete);
        $I->wait('2');
        $I->dontSeeLink('Гидрокарбонат');   
    }

            
            
//---------------------------NOT PRESENCE DELETING STATUS-----------------------  
            
    /**
     * @group a
     */        
    public function Jira_ICMS_1563(NotificationStatusesTester $I){
        $I->wantTo('Verify Deleted Status Not Present on Notification List Page.');
        $I->amOnPage(NotificationListPage::$ListPageURL);   
        $I->wait('1');        
        $I->dontsee('Гидрокарбонат',  NotificationListPage::$ListSelectMain); 
        $I->dontsee('123 qwe !@# ЯЧС',  NotificationListPage::$ListSelectMain);
        $I->dontSeeOptionIsSelected(NotificationListPage::$ListSelectFirst, 'Гидрокарбонат'); 
        $I->dontSeeOptionIsSelected(NotificationListPage::$ListSelectFirst, '123 qwe !@# ЯЧС'); 
        $I->click(NotificationListPage::$ListLinkEditting);
        $I->wait('2');
        $I->dontseeOptionIsSelected(NotificationListPage::$EditingSelectStatus, 'Гидрокарбонат');
        $I->dontseeOptionIsSelected(NotificationListPage::$EditingSelectStatus, '123 qwe !@# ЯЧС');             
    }
    

//---------------------------CLEARING-------------------------------------------    
    
    /**
     * @group a
     */
    public function DeleteNotification(NotificationStatusesTester $I){
        $I->wantTo('Deleted Notification.');
        $I->amOnPage(NotificationListPage::$ListPageURL);
        $I->wait('1');
        $I->click(NotificationListPage::$ListMainCheckBox);
        $I->click(NotificationListPage::$ListButtonDelete);
        $I->wait('1');
        $I->click(NotificationListPage::$DeleteWindowButtonDelete);
        $I->wait('1');
        InitTest::ClearAllCach($I); 
    } 
    
    
    
}    

