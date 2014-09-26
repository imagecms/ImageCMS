<?php

use \NotificationListTester;

class FieldsNLCest

{
    
    private $front_Prodct_URl    = '/shop/product/nepredskazuemost-tupizny';
    private $front_Prodct_Button_Notification = '.infoBut.isDrop';
    
    private $create_Prodct_Name  = 'непредсказуемость ТУПИЗНЫ';
    private $create_Prodct_Price = '1';
    
    private $create_Category_Name = 'Важность разума';
    
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
    
    private $Position_Notification;
    private $ID_Notification;

    
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
        $I->CreateProductCategory($createNameCategory = $this->create_Category_Name);
    }
    
    
    /**
     * @group a
     * @guy NotificationListTester\notificationlistSteps
     */
    public function CreateProduct(NotificationListTester\notificationlistSteps $I) {
        $I->CreateProduct(  $Name_Product       = $this->create_Prodct_Name,
                            $Price_Product      = $this->create_Prodct_Price,
                            $Amount_Product     = '0',
                            $Category_Product   = $this->create_Category_Name);
    }
    
    /**
     * @group aa
     * @guy NotificationListTester\notificationlistSteps
     */
    public function GetIDDefoultStatuses(NotificationListTester\notificationlistSteps  $I) {
        
        $ID_Status = $I->GetIDStatus($name_statuse = 'Новый');
        $this->ID_Status_New = $ID_Status;
        $I->comment("ID статуса 'Новый': '$this->ID_Status_New'");
        $number_position = $I->GetPositionStatus($name_statuse = 'Новый');
        $this->Position_Status_New = $number_position;
        $I->comment("Номер позиции статуса 'Новый' увеличен на(+2), для страницы 'Список Уведомлений': '$this->Position_Status_New'");
               
        $ID_Status = $I->GetIDStatus($name_statuse = 'Выполнен');
        $this->ID_Status_Made = $ID_Status;
        $I->comment("ID статуса 'Выполнен': '$this->ID_Status_Made'");
        $number_position = $I->GetPositionStatus($name_statuse = 'Выполнен');
        $this->Position_Status_Made = $number_position;
        $I->comment("Номер позиции статуса 'Выполнен' увеличен на(+2), для страницы 'Список Уведомлений': '$this->Position_Status_Made'");
    }
    
    
    
    /**
     * @group a
     */
    public function CreateAdditionalNotificationFront(NotificationListTester $I){
        $I->amOnPage($this->front_Prodct_URl);
        $I->wait('2');
        $I->scrollToElement($I, $this->front_Prodct_Button_Notification);
        $I->wait('1');
        $I->click($this->front_Prodct_Button_Notification);
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
        $I->amOnPage($this->front_Prodct_URl);
        $I->wait('2');
        $I->scrollToElement($I, $this->front_Prodct_Button_Notification);
        $I->wait('1');
        $I->click($this->front_Prodct_Button_Notification);
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
     * @group aa
     */
    public function InvalidIDInputFieldIDList (NotificationListTester $I){
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
     * @group aa
     */
    public function ValidIDInputFieldIDListtabAll (NotificationListTester $I){
        $I->amOnPage(NotificationListPage::$URL);
        $I->wait('3');
        $I->fillField(NotificationListPage::$TabAllFilterIDInput, $this->ID_Notification);
        $I->click(NotificationListPage::$ButtonFilter);
        $I->wait('2');
        $I->see($this->user_Email, NotificationListPage::tabAllLineEmailText($this->Position_Notification));
        $I->dontSeeElement(NotificationListPage::tabAllLineEmailText(2));
    } 
    
    
    /**
     * @group aa
     */
    public function ValidIDInputFieldIDListtabMade (NotificationListTester $I){
        $I->amOnPage(NotificationListPage::$URL);
        $I->wait(3);
        $I->click(NotificationListPage::tab($this->Position_Status_Made));
        $I->wait(1);        
        $I->fillField(NotificationListPage::filterIDInput($this->ID_Status_Made), $this->ID_Notification);
        $I->click(NotificationListPage::$ButtonFilter);
        $I->wait(2);
        $I->see('Список уведомлений о появлении пустой.', NotificationListPage::TextEmptyList($this->ID_Status_Made));
        $I->dontSeeElement(NotificationListPage::tabAllLineEmailText(1));
    } 
    
    /**
     * @group aa
     */
    public function ValidIDInputFieldIDListtabNew (NotificationListTester $I){
        $I->amOnPage(NotificationListPage::$URL);
        $I->wait('3');
        $I->click(NotificationListPage::tab($this->Position_Status_New));
        $I->wait(1);   
        $I->fillField(NotificationListPage::filterIDInput($this->ID_Status_New), $this->ID_Notification);
        $I->click(NotificationListPage::$ButtonFilter);
        $I->wait('2');
        $I->see($this->user_Email, NotificationListPage::lineEmailLink($this->ID_Status_New, $this->Position_Notification));
        $I->dontSeeElement(NotificationListPage::tabAllLineEmailText(2));
    } 
    
    

       
       
       
//-------------------------INPUT FIELD ID LIST----------------------------------
       
    /**
     * @group a
     */   
    public function InputFieldEmailList (NotificationListTester $I){
        $I->wantTo('Verify Valid Input in Field.');
        $I->amOnPage(NotificationListPage::$ListPageURL);
        $I->wait('1');
        $I->appendField(NotificationListPage::$ListFildEmail, 'QWE 123 !@# ячс');
        $I->seeInField(NotificationListPage::$ListFildEmail, 'QWE 123 !@# ячс');
    }
    
    
    
//--------------------UNACCEPTABLE INPUT FIELD ADDING LIST----------------------
    
    /**
     * @group a
     */
    public function NoInputFieldAdditngList (NotificationListTester $I){
        $I->wantTo('Verify Valid Input in Field.');
        $I->amOnPage(NotificationListPage::$ListPageURL);
        $I->wait('1');
        $I->appendField(NotificationListPage::$ListFildAddition, 'QWE !@# ячс');
        $I->dontSeeInField(NotificationListPage::$ListFildAddition, 'QWE !@# ячс');
    }
    
    
    
//--------------------VALID INPUT FIELD ADDING LIST-----------------------------
    
    /**
     * @group a
     */
    public function InputFieldAdditngList (NotificationListTester $I){
        $I->wantTo('Verify Valid Input in Field.');
        $I->amOnPage(NotificationListPage::$ListPageURL);
        $I->wait('1');
        $I->appendField(NotificationListPage::$ListFildAddition, '12-345-678-90');
        $I->seeInField(NotificationListPage::$ListFildAddition, '12-345-678-90');
    }
    
    
    
//--------------------CALENDAR PRESENCE INPUT FIELD ADDING EDITING--------------
    
    /**
     * @group a
     */
    public function CalendardAdditngList (NotificationListTester $I){
        $I->wantTo('Verify Calendar Presence.');
        $I->amOnPage(NotificationListPage::$ListPageURL);
        $I->wait('1');
        $I->appendField(NotificationListPage::$ListFildAddition, '2');
        $I->seeElement(NotificationListPage::$ListCalendar);        
        }
        
        
        
//--------------------UNACCEPTABLE INPUT FIELD VALIDUNIT LIST-------------------
        
     /**
     * @group a
     */   
    public function inVALIDInputFieldVALIDUNITList (NotificationListTester $I){
        $I->wantTo('Verify InValid Input in Field.');
        $I->amOnPage(NotificationListPage::$ListPageURL);
        $I->wait('1');
        $I->appendField(NotificationListPage::$ListFildValidUnit, 'QWE !@# ячс');
        $I->dontSeeInField(NotificationListPage::$ListFildValidUnit, 'QWE !@# ячс');
    }
    
    
    
//--------------------VALID INPUT FIELD VALIDUNIT LIST--------------------------
    
    /**
     * @group a
     */
    public function VALIDInputFieldVALIDUNITList (NotificationListTester $I){
        $I->wantTo('Verify Valid Input in Field.');
        $I->amOnPage(NotificationListPage::$ListPageURL);
        $I->wait('1');
        $I->appendField(NotificationListPage::$ListFildValidUnit, '12-345-678-90');
        $I->seeInField(NotificationListPage::$ListFildValidUnit, '12-345-678-90');
    }
    
    
    
//-----------------------DEFAULT HEAD FIELD STATUSE  LIST-----------------------
    
    /**
     * @group a
     */
    public function DefaultFieldStatuseList (NotificationListTester $I){
        $I->wantTo('Verify Default Values on Select Menu.');
        $I->amOnPage(NotificationListPage::$ListPageURL);
        $I->wait('1');
        $I->seeOptionIsSelected(NotificationListPage::$ListSelectMain, 'нет');    
    }
    
    
    
//-----------------------SELECT HEAD FIELD STATUSE LIST-------------------------
    
    /**
     * @group a
     */
    public function SelectFieldStatuseList (NotificationListTester $I){
        $I->wantTo('Verify Select in Option.');
        $I->amOnPage(NotificationListPage::$ListPageURL);
        $I->wait('1');
        $I->selectOption(NotificationListPage::$ListSelectMain, 'Новый');
        $I->seeOptionIsSelected(NotificationListPage::$ListSelectMain, 'Новый');
        $I->selectOption(NotificationListPage::$ListSelectMain, 'Выполнен');
        $I->seeOptionIsSelected(NotificationListPage::$ListSelectMain, 'Выполнен');    
    } 
    
    
    
//-----------------------DEFAULT NOTIFY FIELD STATUSE  LIST---------------------
    
    /**
     * @group a
     */
    public function DefaultFieldStatuseLlist (NotificationListTester $I){
        $I->wantTo('Verify Default Values in Field.');
        $I->amOnPage(NotificationListPage::$ListPageURL);
        $I->wait('1');
        $I->seeOptionIsSelected(NotificationListPage::$ListSelectFirst, 'Новый');    
    }
    
    
    
//-----------------------SELECT NOTIFY FIELD STATUSE LIST-----------------------
    
    /**
     * @group a
     */
    public function SelectFieldStatuseLlist (NotificationListTester $I){
        $I->wantTo('Verify Select in Option.');
        $I->amOnPage(NotificationListPage::$ListPageURL);
        $I->wait('1');
        $I->selectOption(NotificationListPage::$ListSelectFirst, 'Выполнен');
        $I->seeOptionIsSelected(NotificationListPage::$ListSelectFirst, 'Выполнен');
        $I->amOnPage(NotificationListPage::$ListPageURL);
        $I->selectOption(NotificationListPage::$ListSelectFirst, 'Новый');
        $I->seeOptionIsSelected(NotificationListPage::$ListSelectFirst, 'Новый');    
    }
    
    
    
//--------------------CALENDAR PRESENCE INPUT FIELD VALUNIT LIST----------------
    
    /**
     * @group a
     */
    public function CalendardVALUNITList (NotificationListTester $I){
        $I->wantTo('Verify Calendar Presence.');
        $I->amOnPage(NotificationListPage::$ListPageURL);
        $I->wait('1');
        $I->appendField(NotificationListPage::$ListFildAddition, '2');
        $I->seeElement(NotificationListPage::$ListCalendar);        
    }
        
        
        
//--------------------BUTTON INFORMATION LIST-----------------------------------
        
     /**
     * @group a
     */   
    public function ButonInformationList (NotificationListTester $I){
        $I->wantTo('Verify Valid Information Presence in Button Information.');
        $I->amOnPage(NotificationListPage::$ListPageURL);
        $I->wait('1');
        $I->waitForElement(NotificationListPage::$ListButtonInformation);
        $I->click(NotificationListPage::$ListButtonInformation);
        $I->wait('1');
        $I->see('Товар', 'h3.popover-title');
        $I->see('Смартфон Samsung GT-S7530 Omnia M EAA Deep Grey (Смартфон Samsung GT-S7530 Omnia M EAA Deep Grey)', 'p > div.check_product > a');
        $I->click(NotificationListPage::$ListButtonInformation);
        $I->dontSeeElement('.popover.fade.left.in');
    }
    
    
    
//--------------------LINK BUTTON INFORMATION LIST------------------------------
    
    /**
     * @group a
     */
    public function LinkButonInformationList (NotificationListTester $I){
        $I->wantTo('Verify Clickability Link Element.');
        $I->amOnPage(NotificationListPage::$ListPageURL);
        $I->wait('1');
        $I->click(NotificationListPage::$ListButtonInformation);
        $I->click('Смартфон Samsung GT-S7530 Omnia M EAA Deep Grey (Смартфон Samsung GT-S7530 Omnia M EAA Deep Grey)', '.popover.fade.left.in');
        $I->see('Смартфон Samsung GT-S7530 Omnia M EAA Deep Grey', 'span.title');
    } 
    
    
    
//-----------------------DEFAULT NOTIFY FIELD STATUSE  EDIT---------------------
    
    /**
     * @group a
     */
    public function DefaultFieldStatuseist (NotificationListTester $I){
        $I->wantTo('Verify Default Values oi Select Menu.');
        $I->amOnPage(NotificationListPage::$ListPageURL);
        $I->wait('1');
        $I->click(NotificationListPage::$ListLinkEditting);
        $I->seeOptionIsSelected(NotificationListPage::$EditingSelectStatus, 'Новый');    
    }
    
    
    
//-----------------------SELECT NOTIFY FIELD STATUSE EDITING--------------------
    
    /**
     * @group a
     */
    public function SelectFieldStatuseist (NotificationListTester $I){
        $I->wantTo('Verify Select in Option.');
        $I->amOnPage(NotificationListPage::$ListPageURL);
        $I->wait('1');
        $I->click(NotificationListPage::$ListLinkEditting);
        $I->selectOption(NotificationListPage::$EditingSelectStatus, 'Выполнен');
        $I->click(NotificationListPage::$EditingButtonSave);
        $I->wait('2');
        $I->seeOptionIsSelected(NotificationListPage::$EditingSelectStatus, 'Выполнен');
        $I->selectOption(NotificationListPage::$EditingSelectStatus, 'Новый');
        $I->click(NotificationListPage::$EditingButtonSave);
        $I->wait('2');
        $I->seeOptionIsSelected(NotificationListPage::$EditingSelectStatus, 'Новый');    
    }
    
    
    
//-------------UNACCEPTABLE INPUT FIELD VALIDUNIT EDITING-----------------------
    
    /**
     * @group a
     */
    public function NoVALIDInputFieldVALIDUNITEditing (NotificationListTester $I){
        $I->wantTo('Verify Input Valid Values in Field.');
        $I->amOnPage(NotificationListPage::$ListPageURL);
        $I->wait('1');
        $I->click(NotificationListPage::$ListLinkEditting);
        $I->fillField(NotificationListPage::$EditingFildExpirationDate, 'QWE !@# ячс');
        $I->click(NotificationListPage::$EditingButtonSave);
        $I->dontSeeInField(NotificationListPage::$EditingFildExpirationDate, 'QWE !@# ячс');
    }
    
    
    
//--------------------VALID INPUT FIELD VALIDUNIT EDITING-----------------------
    
    /**
     * @group a
     */
    public function VALIDInputFieldVALIDUNITEditing (NotificationListTester $I){
        $I->wantTo('Verify Input Valid Values in Field.');
        $I->amOnPage(NotificationListPage::$ListPageURL);
        $I->wait('1');
        $I->click(NotificationListPage::$ListLinkEditting);
        $I->wait('1'); 
        $I->fillField(NotificationListPage::$EditingFildExpirationDate, '1999-05-03');
        $I->click(NotificationListPage::$EditingButtonSave);
        $I->wait('1'); 
        $I->seeInField(NotificationListPage::$EditingFildExpirationDate, '1999-05-03');
    }
    
    
    
//--------------------CALENDAR PRESENCE INPUT FIELD VALUNIT EDITING-------------
    
    /**
     * @group a
     */
    public function CalendarVALUnitEditing (NotificationListTester $I){
        $I->wantTo('See Calendar Presence.');
        $I->amOnPage(NotificationListPage::$ListPageURL);
        $I->wait('1');
        $I->appendField(NotificationListPage::$ListFildAddition, '2');
        $I->seeElement(NotificationListPage::$ListCalendar);        
        }
        
        

//--------------------NOT SAVED INPUT FIELD NAME EDITING------------------------
        
    /**
     * @group a
     */    
    public function VALIDInputFieldNamEditing (NotificationListTester $I){
        $I->wantTo('Verify Input Valid Values in Field.');
        $I->amOnPage(NotificationListPage::$ListPageURL);
        $I->wait('1');
        $I->click(NotificationListPage::$ListLinkEditting);
        $I->appendField(NotificationListPage::$EditingFildName, '123 QWE !@# їзщ');
        $I->click(NotificationListPage::$EditingButtonSave);
        $I->wait('2');
        $I->seeInField(NotificationListPage::$EditingFildName, 'Administrator');
        $I->fillField(NotificationListPage::$EditingFildName, '');
        $I->click(NotificationListPage::$EditingButtonSave);
        $I->wait('2');
        $I->seeInField(NotificationListPage::$EditingFildName, 'Administrator');          
    }
      
      
      
//--------------------NOT SAVED INPUT FIELD EMEIL EDITING-----------------------
      
    /**
     * @group a
     */  
    public function VALIDInputFieldEmeilEditing (NotificationListTester $I){
        $I->wantTo('Verify Input Valid Values in Field.');
        $I->amOnPage(NotificationListPage::$ListPageURL);
        $I->wait('1');
        $I->click(NotificationListPage::$ListLinkEditting);
        $I->appendField(NotificationListPage::$EditingFildEmail, '123 QWE !@# їзщ');
        $I->click(NotificationListPage::$EditingButtonSave); 
        $I->wait('2');
        $I->seeInField(NotificationListPage::$EditingFildEmail, 'ad@min.com');
        $I->fillField(NotificationListPage::$EditingFildEmail, '');
        $I->click(NotificationListPage::$EditingButtonSave);
        $I->wait('2');
        $I->seeInField(NotificationListPage::$EditingFildEmail, 'ad@min.com');          
    }
      
      
      
//-----------------------SAVED INPUT FIELD PHONE EDITING------------------------
      
    /**
     * @group a
     */  
    public function VALIDInputFieldPhonelEditing (NotificationListTester $I){
        $I->wantTo('Verify Input Valid Values in Field.');
        $I->amOnPage(NotificationListPage::$ListPageURL);
        $I->wait('1');
        $I->click(NotificationListPage::$ListLinkEditting);
        $I->fillField(NotificationListPage::$EditingFildPhone, 'QWE 123 !@# ячс');
        $I->click(NotificationListPage::$EditingButtonSave);
        $I->wait('2');
        $I->seeInField(NotificationListPage::$EditingFildPhone, 'QWE 123 !@# ячс');
        $I->fillField(NotificationListPage::$EditingFildPhone, '');
        $I->click(NotificationListPage::$EditingButtonSave);
        $I->wait('2');
        $I->seeInField(NotificationListPage::$EditingFildPhone, '');
    }
      
      
      
//-----------------------SAVED INPUT FIELD COMMENT EDITING----------------------
      
    /**
     * @group a
     */  
    public function VALIDInputFieldCommentlEditing (NotificationListTester $I){
        $I->wantTo('Verify Input Valid Values in Field.');
        $I->amOnPage(NotificationListPage::$ListPageURL);
        $I->wait('1');
        $I->click(NotificationListPage::$ListLinkEditting);
        $I->fillField(NotificationListPage::$EditingFildComment, 'QWE 123 !@# ячс');
        $I->click(NotificationListPage::$EditingButtonSave);
        $I->wait('2');
        $I->seeInField(NotificationListPage::$EditingFildComment, 'QWE 123 !@# ячс');
        $I->fillField(NotificationListPage::$EditingFildComment, '');
        $I->click(NotificationListPage::$EditingButtonSave);
        $I->wait('2');
        $I->seeInField(NotificationListPage::$EditingFildComment, '');
    }
      
      
      
//------------------------------CLEARING----------------------------------------
      
    /**
     * @group a
     */  
    public function TextDeletingNotifi(NotificationListTester $I){
        $I->wantTo('Verify Deleting Notifi.');
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