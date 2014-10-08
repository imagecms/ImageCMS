<?php

use \NotificationListTester;

class FieldsNLCest

{
    
    private $Prodct_URl    = '/shop/product/nepredskazuemost-tupizny';
    private $Prodct_Button_Notification = '.infoBut.isDrop';
    
    private $Prodct_Name  = 'непредсказуемость ТУПИЗНЫ';
    private $Prodct_Price = '1';
    
    private $Category_Name = 'Важность разума';
    
    private $Status_Awaiting_Name = 'В ожыдании';
    
    private $user_Name      = 'Квантовая теория';
    private $user_Email     = 'Zal.Upa@godo.net';
    private $user_Phone     = '9876453210';
    private $user_Comment   = 'QWErty its my faivorit message';
    
    private $additional_User_Name      = 'Бахвальство';
    private $additional_User_Email     = 'qwerty@ss.net';
    private $additional_User_Phone     = '8888888888';
    private $additional_User_Comment   = 'Прихвостай свой абстайс или в рот вали иии.';
    
    private $ID_Status_New;
    private $Position_Status_New;
    
    private $ID_Status_Made;
    private $Position_Status_Made;
    
    private $ID_Status_Awaiting;
    private $Position_Status_Awaiting;
    
    private $ID_Notification;
    private $Position_Notification;

    
//---------------------------AUTORIZATION---------------------------------------    
    
    /**
     * @group aa
     */
    public function Login(NotificationListTester $I){
        InitTest::Login($I);
    }
    
    
    
    /**
     * @group a
     * @guy NotificationListTester\notificationlistSteps
     */
    public function CreateProductCategory(NotificationListTester\notificationlistSteps $I) {
        $I->CreateProductCategory($createNameCategory = $this->Category_Name);
    }
    
    
    /**
     * @group a
     * @guy NotificationListTester\notificationlistSteps
     */
    public function CreateProduct(NotificationListTester\notificationlistSteps $I) {
        $I->CreateProduct(  $Name_Product       = $this->Prodct_Name,
                            $Price_Product      = $this->Prodct_Price,
                            $Amount_Product     = '0',
                            $Category_Product   = $this->Category_Name);
    }
    
    /**
     * @group a
     */
    public function CreateNotificationStatus (NotificationListTester $I){         
        $I->amOnPage(NotificationStatusesCreatePage::$URL);
        $I->wait('1');
        $I->fillField(NotificationStatusesCreatePage::$InputName, $this->Status_Awaiting_Name);
        $I->click(NotificationStatusesCreatePage::$ButtonCreateExit);
        $I->wait('1');
    }
    /**
     * @group aa
     * @guy NotificationListTester\notificationlistSteps
     */
    public function GetNumberIDStatusesNew(NotificationListTester\notificationlistSteps  $I) {
        
        $ID_Status = $I->GetIDStatus($name_statuse = 'Новый');
        $this->ID_Status_New = $ID_Status;
        $I->comment("ID статуса 'Новый': '$this->ID_Status_New'");
    }
    
    
    /**
     * @group aa
     * @guy NotificationListTester\notificationlistSteps
     */
    public function GetNumberPositionStatusNew(NotificationListTester\notificationlistSteps  $I) {
    
        $number_position = $I->GetPositionStatus($name_statuse = 'Новый');
        $this->Position_Status_New = $number_position;
        $I->comment("Номер позиции статуса 'Новый' увеличен на(+2), для страницы 'Список Уведомлений': '$this->Position_Status_New'");
        
    }    
    /**
     * @group aa
     * @guy NotificationListTester\notificationlistSteps
     */
    public function GetNumberIDStatusMade(NotificationListTester\notificationlistSteps  $I) {
        
        $ID_Status = $I->GetIDStatus($name_statuse = 'Выполнен');
        $this->ID_Status_Made = $ID_Status;
        $I->comment("ID статуса 'Выполнен': '$this->ID_Status_Made'");
        
    }
    /**
     * @group aa
     * @guy NotificationListTester\notificationlistSteps
     */
    public function GetNumberPositionStatusMade(NotificationListTester\notificationlistSteps  $I) {
        
        $number_position = $I->GetPositionStatus($name_statuse = 'Выполнен');
        $this->Position_Status_Made = $number_position;
        $I->comment("Номер позиции статуса 'Выполнен' увеличен на(+2), для страницы 'Список Уведомлений': '$this->Position_Status_Made'");
    }
    
    
    /**
     * @group aa
     * @guy NotificationListTester\notificationlistSteps
     */
    public function GetNumberIDStatusAwaiting(NotificationListTester\notificationlistSteps  $I) {
        
        $ID_Status = $I->GetIDStatus($name_statuse = 'В ожыдании');
        $this->ID_Status_Awaiting = $ID_Status;
        $I->comment("ID статуса 'В ожыдании': '$this->ID_Status_Awaiting'");
        
    }
    /**
     * @group aa
     * @guy NotificationListTester\notificationlistSteps
     */
    public function GetNumberPositionStatusAwaiting(NotificationListTester\notificationlistSteps  $I) {
        
        $number_position = $I->GetPositionStatus($name_statuse = 'В ожыдании');
        $this->Position_Status_Awaiting = $number_position;
        $I->comment("Номер позиции статуса 'В ожыдании' увеличен на(+2), для страницы 'Список Уведомлений': '$this->Position_Status_Awaiting'");
    }
    
    
    
    /**
     * @group a
     */
    public function CreateAdditionalNotificationFront(NotificationListTester $I){
        $I->amOnPage($this->Prodct_URl);
        $I->wait('2');
        $I->scrollToElement($I, $this->Prodct_Button_Notification);
        $I->wait('1');
        $I->click($this->Prodct_Button_Notification);
        $I->wait('3');
        $I->fillField(FrontCreateNotificationPage::$InputName, $this->additional_User_Name);
        $I->wait('1');
        $I->fillField(FrontCreateNotificationPage::$InputEmail, $this->additional_User_Email);
        $I->wait('1');
        $I->fillField(FrontCreateNotificationPage::$InputPhone, $this->additional_User_Phone);
        $I->wait('1');
        $I->fillField(FrontCreateNotificationPage::$InputComment, $this->additional_User_Comment);
        $I->click(FrontCreateNotificationPage::$ButtonSend);
    }
    
    /**
     * @group a
     */
    public function CreateNotificationFront(NotificationListTester $I){
        $I->amOnPage($this->Prodct_URl);
        $I->wait('2');
        $I->scrollToElement($I, $this->Prodct_Button_Notification);
        $I->wait('1');
        $I->click($this->Prodct_Button_Notification);
        $I->wait('3');
        $I->fillField(FrontCreateNotificationPage::$InputName, $this->user_Name);
        $I->wait('1');
        $I->fillField(FrontCreateNotificationPage::$InputEmail, $this->user_Email);
        $I->wait('1');
        $I->fillField(FrontCreateNotificationPage::$InputPhone, $this->user_Phone);
        $I->wait('1');
        $I->fillField(FrontCreateNotificationPage::$InputComment, $this->user_Comment);
        $I->click(FrontCreateNotificationPage::$ButtonSend);
    }
    
    
    
    
    
    /**
     * @group aa
     * @guy NotificationListTester\notificationlistSteps
     */
    public function GetRowNotification(NotificationListTester\notificationlistSteps  $I) {
        $position = $I->GetRowNotification($email = $this->user_Email);
        $I->comment("$position");
        $this->Position_Notification = $position;  
    }
    
    /**
     * @group aa
     * @guy NotificationListTester\notificationlistSteps
     */
    public function GetIDNotification(NotificationListTester\notificationlistSteps  $I) {
        $ID_notification = $I->GetIDNotification($email = $this->user_Email);
        $I->comment("$ID_notification");
        $this->ID_Notification = $ID_notification;  
    }
   
    
    
    
//-------------------------MESSAGE INPUT FIELD ID LIST--------------------------
    
    /**
     * @group a
     */
    public function InvalidInputFieldIDList (NotificationListTester $I){
        $I->amOnPage(NotificationListPage::$URL);
        $I->wait(3);
        $I->fillField(NotificationListPage::$TabAllFilterIDInput, 'qweert');
        $I->seeInField(NotificationListPage::$TabAllFilterIDInput, '');
        $I->wait(1);
        $I->fillField(NotificationListPage::$TabAllFilterIDInput, '-+=/,!');
        $I->seeInField(NotificationListPage::$TabAllFilterIDInput, '');
        $I->wait(1);
        $I->fillField(NotificationListPage::$TabAllFilterIDInput, 'фыв ії');
        $I->seeInField(NotificationListPage::$TabAllFilterIDInput, '');
        $I->wait(1);
        $I->fillField(NotificationListPage::$TabAllFilterIDInput, '0987654321');
        $I->wait(1);
        $I->seeInField(NotificationListPage::$TabAllFilterIDInput, '0987654321');
    }
    
    
    /**
     * @group a
     */
    public function ValidInputFieldIDTabAll (NotificationListTester $I){
        $I->amOnPage(NotificationListPage::$URL);
        $I->wait('3');
        $I->fillField(NotificationListPage::$TabAllFilterIDInput, $this->ID_Notification);
        $I->click(NotificationListPage::$ButtonFilter);
        $I->wait('2');
        $I->see($this->user_Email, NotificationListPage::tabAllLineEmailText($this->Position_Notification));
        $I->dontSeeElement(NotificationListPage::tabAllLineEmailText(2));
    } 
    
    
    /**
     * @group a
     */
    public function ValidInputFieldIDTabMade (NotificationListTester $I){
        $I->amOnPage(NotificationListPage::$URL);
        $I->wait(3);
        $I->click(NotificationListPage::tab($this->Position_Status_Made));
        $I->wait(1);        
        $I->fillField(NotificationListPage::filterIDInput($this->ID_Status_Made), $this->ID_Notification);
        $I->click(NotificationListPage::$ButtonFilter);
        $I->wait(2);
        $I->see('Список уведомлений о появлении пустой.', NotificationListPage::TextEmptyList($this->ID_Status_Made));
        $I->dontSeeElement(NotificationListPage::lineEmailLink($this->ID_Status_Made, 1));
    } 
    
    /**
     * @group a
     */
    public function ValidInputFieldIDTabNew (NotificationListTester $I){
        $I->amOnPage(NotificationListPage::$URL);
        $I->wait('3');
        $I->click(NotificationListPage::tab($this->Position_Status_New));
        $I->wait(1);   
        $I->fillField(NotificationListPage::filterIDInput($this->ID_Status_New), $this->ID_Notification);
        $I->click(NotificationListPage::$ButtonFilter);
        $I->wait('2');
        $I->see($this->user_Email, NotificationListPage::lineEmailLink($this->ID_Status_New, $this->Position_Notification));
        $I->dontSeeElement(NotificationListPage::lineEmailLink($this->ID_Status_New, 2));
    } 
    
    
    /**
     * @group a
     */
    public function ValidInputFieldIDTabAwaiting (NotificationListTester $I){
        $I->amOnPage(NotificationListPage::$URL);
        $I->wait('3');
        $I->click(NotificationListPage::tab($this->Position_Status_Awaiting));
        $I->wait(1);   
        $I->fillField(NotificationListPage::filterIDInput($this->ID_Status_Awaiting), $this->ID_Notification);
        $I->click(NotificationListPage::$ButtonFilter);
        $I->wait('2');
        $I->see('Список уведомлений о появлении пустой.', NotificationListPage::TextEmptyList($this->Position_Status_Awaiting));
        $I->dontSeeElement(NotificationListPage::lineEmailLink($this->ID_Status_Awaiting, 1));
    } 
    
    


//-------------------------INPUT FIELD EMAIL LIST----------------------------------
    /**
     * @group a
     */   
    public function InputFieldEmailTabAll (NotificationListTester $I){
        $I->amOnPage(NotificationListPage::$URL);
        $I->wait('3');
        $I->fillField(NotificationListPage::$TabAllFilterEmailInput, $this->user_Email);
        $I->click(NotificationListPage::$ButtonFilter);
        $I->wait('2');
        $I->see($this->user_Email, NotificationListPage::tabAllLineEmailText($this->Position_Notification));//lineEmailLink($this->ID_Status_New, $this->Position_Notification)
        $I->dontSeeElement(NotificationListPage::tabAllLineEmailText(2));
    }   
    
    
    /**
     * @group a
     */   
    public function InputFieldEmailTabMade (NotificationListTester $I){
        $I->amOnPage(NotificationListPage::$URL);
        $I->wait('3');
        $I->click(NotificationListPage::tab($this->Position_Status_Made));
        $I->wait(1);  
        $I->fillField(NotificationListPage::filterEmailInput($this->ID_Status_Made), $this->user_Email);
        $I->click(NotificationListPage::$ButtonFilter);
        $I->wait('2');
        $I->see('Список уведомлений о появлении пустой.', NotificationListPage::TextEmptyList($this->ID_Status_Made));
        $I->dontSeeElement(NotificationListPage::lineEmailLink($this->ID_Status_Made, 1));
    }
    
    

    /**
     * @group a
     */   
    public function InputFieldEmailTabNew (NotificationListTester $I){
        $I->amOnPage(NotificationListPage::$URL);
        $I->wait('3');
        $I->click(NotificationListPage::tab($this->Position_Status_New));
        $I->wait(1);  
        $I->fillField(NotificationListPage::filterEmailInput($this->ID_Status_New), $this->user_Email);
        $I->click(NotificationListPage::$ButtonFilter);
        $I->wait('2');
        $I->see($this->user_Email, NotificationListPage::lineEmailLink($this->ID_Status_New, $this->Position_Notification));
        $I->dontSeeElement(NotificationListPage::lineEmailLink($this->ID_Status_New, 2));
    }

    
    /**
     * @group a
     */   
    public function InputFieldEmailTabAwaiting (NotificationListTester $I){
        $I->amOnPage(NotificationListPage::$URL);
        $I->wait('3');
        $I->click(NotificationListPage::tab($this->Position_Status_Awaiting));
        $I->wait(1);  
        $I->fillField(NotificationListPage::filterEmailInput($this->ID_Status_Awaiting), $this->user_Email);
        $I->click(NotificationListPage::$ButtonFilter);
        $I->wait('2');
        $I->see('Список уведомлений о появлении пустой.', NotificationListPage::TextEmptyList($this->Position_Status_Awaiting));
        $I->dontSeeElement(NotificationListPage::lineEmailLink($this->ID_Status_Awaiting, 1));
    }
    
    
    
    
//--------------------------------Select Status-------------------------------------------    
    /**
     * @group aa
     */   
    public function SelectStatuseAllTab (NotificationListTester $I){
        $I->amOnPage(NotificationListPage::$URL);
        $I->wait('3');
        $I->selectOption(NotificationListPage::tabAllLineStatusSelect($this->Position_Notification), 'Выполнен');
        $I->wait(1);  
        $I->click(NotificationListPage::tab($this->Position_Status_Made));
        $I->wait(1);  
        $I->see($this->user_Email, NotificationListPage::lineEmailLink($this->ID_Status_Made, $this->Position_Notification));
        $I->dontSeeElement(NotificationListPage::lineEmailLink($this->ID_Status_Made, 2));
        $I->click(NotificationListPage::tab($this->Position_Status_New));
        $I->wait(1);  
        $I->dontSee($this->user_Email, NotificationListPage::lineEmailLink($this->ID_Status_New, $this->Position_Notification));
        $I->click(NotificationListPage::tab($this->Position_Status_Made));
        $I->wait(1);  
        $I->selectOption(NotificationListPage::lineStatusSelect($this->ID_Status_Made, $this->Position_Notification), 'Новый');
        $I->dontSeeElement(NotificationListPage::lineEmailLink($this->ID_Status_Made, 2));
        $I->wait(1);  
        $I->click(NotificationListPage::tab($this->Position_Status_New));
        $I->wait(1);  
        $I->See($this->user_Email, NotificationListPage::lineEmailLink($this->ID_Status_New, $this->Position_Notification));
        $I->selectOption(NotificationListPage::lineStatusSelect($this->ID_Status_New, $this->Position_Notification), $this->Status_Awaiting_Name);
        $I->wait(1);  
        $I->click(NotificationListPage::tab($this->Position_Status_Awaiting));
        $I->wait(1);  
        $I->See($this->user_Email, NotificationListPage::lineEmailLink($this->ID_Status_Awaiting, $this->Position_Notification));
        $I->dontSeeElement(NotificationListPage::lineEmailLink($this->ID_Status_Awaiting, 2));
        $I->selectOption(NotificationListPage::lineStatusSelect($this->ID_Status_Awaiting, $this->Position_Notification), 'Новый');
        $I->click(NotificationListPage::tab($this->Position_Status_Awaiting));
        $I->wait(2);  
        $I->see('Список уведомлений о появлении пустой.', NotificationListPage::TextEmptyList($this->Position_Status_Awaiting));
    }
    
    
    
    
    

    
    
    //-------------------TEXT DELETING NOTIFY LIST PAGE-----------------------------
    
    /**
     * @group a
     */
    public function TextDeletingNotifi(NotificationListTester $I){
        $I->amOnPage(NotificationListPage::$URL);
        $I->wait('3');
        $I->click(NotificationListPage::$TabAllHeadCheck);
        $I->wait('1');
        $I->click(NotificationListPage::$ButtonDelete);
        $I->wait('1');
        $I->click(NotificationListPage::$WindowDeleteButtonDelete);
        $I->wait('1');
        InitTest::ClearAllCach($I);
    }
      
  
    /**
     * @group a
     * @guy NotificationListTester\notificationlistSteps
     */
    public function DeleteProductCategory(NotificationListTester\notificationlistSteps  $I) {
        $I->DeleteProductCategorys();        
    }
    
    
    
}