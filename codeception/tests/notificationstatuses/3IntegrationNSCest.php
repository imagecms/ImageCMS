<?php
use \NotificationStatusesTester;
class IntegrationNSCest
{
    
    private $ID_Create_Status;
    private $Position_Create_Status;
    private $ID_Edit_Status;
    private $Position_Edit_Status;
    private $name_create_status =  '123 qwe !@# ЯЧС';
    private $name_edit_status   =  'Гидрокарбонат';
    
    
//---------------------------AUTORIZATION---------------------------------------

    /**
     * @group aa
     */
    public function Login(NotificationStatusesTester $I){
        InitTest::Login($I);
    }
    
//------------------CREATE Category, Product and NOTIFI FRONT-------------------
    /**
     * @group aa
     * @guy NotificationStatusesTester\NotificationStatusesSteps 
     */
    public function CreateProductCategory(NotificationStatusesTester\NotificationStatusesSteps $I) {
        $I->CreateProductCategory($createNameCategory = 'Уведомленная');
    }
    
    
    /**
     * @group aa
     * @guy NotificationStatusesTester\NotificationStatusesSteps 
     */
    public function CreateProduct(NotificationStatusesTester\NotificationStatusesSteps $I) {
        $I->CreateProduct(  $Name_Product       = 'Уведомления ради',
                            $Price_Product      = '888',
                            $Amount_Product     = '0',
                            $Category_Product   = 'Уведомленная');
    }
    
    

    /**
     * @group aa
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
     * @group aa
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
                $I->wait('3');
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
        $I->wait('2');        
        $I->see($this->name_create_status, NotificationListPage::tab($this->Position_Create_Status));
        $I->selectOption(NotificationListPage::tabAllLineStatusSelect(1), $this->name_create_status);
        $I->wait('1');  
        $I->click(NotificationListPage::tab($this->Position_Create_Status));
        $I->wait('1');
        $I->click(NotificationListPage::lineEmailLink($this->ID_Create_Status, 1));
        $I->wait('1');        
        $I->seeOptionIsSelected(NotificationEditPage::$SelectStatus, $this->name_create_status);
    } 

    
    
//---------------------------EDICTING STATUS------------------------------------   
    
    /**
     * @group a
     */
    public function VerifySavedEditStatus (NotificationStatusesTester $I){
        $I->amOnPage(NotificationStatusesListPage::$URL);
        $I->wait('1');
        $amount_rows = $I->grabCCSAmount($I, '.share_alt');
        for($j = 1;$j <= $amount_rows;++$j){
            $name_notification = $I->grabTextFrom(NotificationStatusesListPage::lineNameLink($j));
            if($name_notification == $this->name_create_status){
                $I->wait('1');
                $I->click(NotificationStatusesListPage::lineNameLink($j));
                $I->wait('1');
                $I->fillField(NotificationStatusesEditPage::$InputName, $this->name_edit_status);
                $I->click(NotificationStatusesEditPage::$ButtonSaveExit);
                $I->wait('3');
                $I->see($this->name_edit_status, NotificationStatusesListPage::lineNameLink($j));
            }
        }
    }
    

    /**
     * @group a
     * @guy NotificationStatusesTester\NotificationStatusesSteps 
     */
    public function GetIDEditStatus(NotificationStatusesTester\NotificationStatusesSteps  $I) {
               
        $ID_Status = $I->GetIDStatus($name_statuse = $this->name_edit_status);
        $this->ID_Edit_Status = $ID_Status;
        $I->comment("ID отредактированого статуса: '$this->ID_Edit_Status'");
        
        $number_position = $I->GetPositionStatus($name_statuse = $this->name_edit_status);
        $this->Position_Edit_Status = $number_position;
        $I->comment("Номер позиции отредактированого статуса увеличен на(+2), для страницы 'Список Уведомлений': '$this->Position_Edit_Status'");
    }
    
    
    
//---------------------------PRESENCE EDICTING STATUS---------------------------       
    
    /**
     * @group a
     */
    public function EditingStatusMappingOnThePageNotificationList (NotificationStatusesTester $I){
        $I->amOnPage(NotificationListPage::$URL);
        $I->wait('2');        
        $I->see($this->name_edit_status, NotificationListPage::tab($this->Position_Edit_Status));
        $I->selectOption(NotificationListPage::tabAllLineStatusSelect(1), $this->name_edit_status);
        $I->wait('1');  
        $I->click(NotificationListPage::tab($this->Position_Edit_Status));
        $I->wait('1');
        $I->click(NotificationListPage::lineEmailLink($this->ID_Edit_Status, 1));
        $I->wait('1');        
        $I->seeOptionIsSelected(NotificationEditPage::$SelectStatus, $this->name_edit_status);
                
   
    }   

         
         
//---------------------------DELETE STATUS--------------------------------------
         
    /**
     * @group a
     */     
    public function VerifyDeletedEditingStatus(NotificationStatusesTester $I){
        $I->amOnPage(NotificationStatusesListPage::$URL);
        $I->wait('2');
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
        $I->dontSee($this->name_create_status, NotificationStatusesListPage::$Table);
        $I->wait('1');
        $I->dontSee($this->name_edit_status, NotificationStatusesListPage::$Table);
        $I->see('Новый', NotificationStatusesListPage::$Table);
        $I->see('Выполнен', NotificationStatusesListPage::$Table);
         InitTest::ClearAllCach($I); 
    }  
        
        
          


            
            
//---------------------------NOT PRESENCE DELETING STATUS-----------------------  
            
    /**
     * @group a
     */        
    public function Jira_ICMS_1563(NotificationStatusesTester $I){
        $I->amOnPage(NotificationListPage::$URL);   
        $I->wait('1');        
        $I->dontsee($this->name_create_status, NotificationListPage::$TabAllFilterSelectStatus); 
        $I->dontsee($this->name_edit_status, NotificationListPage::$TabAllFilterSelectStatus); 
        $I->dontsee($this->name_create_status, NotificationListPage::lineStatusSelect('all', 1));
        $I->dontsee($this->name_edit_status, NotificationListPage::lineStatusSelect('all', 1));
        $I->dontsee($this->name_create_status, '//body/div[1]/div[5]/section/div[4]');
        $I->dontsee($this->name_edit_status, '//body/div[1]/div[5]/section/div[4]');         
        $I->click(NotificationListPage::tabAllLineIDLink(1));
        $I->wait('2');
        $I->dontsee(NotificationEditPage::$SelectStatus, $this->name_create_status);
        $I->dontsee(NotificationEditPage::$SelectStatus, $this->name_edit_status);
    }
    

//---------------------------CLEARING-------------------------------------------    
    
    /**
     * @group a
     */
    public function DeleteNotification(NotificationStatusesTester $I){
        $I->amOnPage(NotificationListPage::$URL);
        $I->wait('1');
        $I->click(NotificationListPage::$TabAllHeadCheck);
        $I->wait('1');
        $I->click(NotificationListPage::$ButtonDelete);
        $I->wait('1');
        $I->click(NotificationListPage::$WindowDeleteButtonDelete);
        $I->wait('1');
//        InitTest::ClearAllCach($I); 
    } 
    
    
    /**
     * @group a
     * @guy NotificationStatusesTester\NotificationStatusesSteps 
     */
    public function DeleteProductCategory(NotificationStatusesTester\NotificationStatusesSteps  $I) {
        $I->DeleteProductCategorys();        
    }
    
}    

