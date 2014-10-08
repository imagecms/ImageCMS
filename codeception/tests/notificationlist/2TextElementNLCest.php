<?php

use \NotificationListTester;

class TextElementNLCest


{
    private $front_Prodct_URl    = '/shop/product/vazonok-dracena-classic-r2d2';
    private $front_Prodct_Button_Notification = '.infoBut.isDrop';
    
    private $create_Prodct_Name  = 'Вазонок Dracena classic r2d2';
    private $create_Prodct_Price = '98764';
    
    private $create_Category_Name = 'Botanicula';
    
    private $user_Name      = 'Паша Tehniq';
    private $user_Email     = 'Sword.muse@terpincode.com';
    private $user_Phone     = '9873216540';
    private $user_Comment   = 'Незнаю когда, но хочу купить етот вазон себе на дом, интересуэт цена доставки ?';
    
    private $ID_Status_New;
    private $Position_Status_New;
    private $ID_Status_Made;
    private $Position_Status_Made;
    
    private $Position_Notification;

    
//---------------------------AUTORIZATION---------------------------------------  
    
    /**
     * @group a
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
     * @group a
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
    
    
    
    

//---------------------------CREATE NOTIFI FRONT--------------------------------   
    
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
     * @group a
     * @guy NotificationListTester\notificationlistSteps
     */
    public function GetRowNotification(NotificationListTester\notificationlistSteps  $I) {
        $position = $I->GetRowNotification($email = $this->user_Email);
        $I->comment("$position");
        $this->Position_Notification = $position;  
    }
    
    
//----------------------BUTTON LIST---------------------------------------------
    
    /**
     * @group a
     */
    public function VerifyWayListPage(NotificationListTester $I){
        $I->amOnPage('/admin');
        $I->click(NavigationBarPage::$Orders);
        $I->click(NavigationBarPage::$NotificationsList);
        $I->wait('2');
        $I->seeInCurrentUrl(NotificationListPage::$URL);
    } 
    
    
    
    /**
     * @group a
     */
    public function VerifyTabsPresentListPage(NotificationListTester $I){
        $I->amOnPage(NotificationListPage::$URL);
        $I->wait('3');
        $I->see('Все', NotificationListPage::$TabAll);
        $I->see('Выполнен', NotificationListPage::tab($this->Position_Status_Made));
        $I->see('Новый', NotificationListPage::tab($this->Position_Status_New));
        $I->click(NotificationListPage::tab($this->Position_Status_Made));
        $I->wait('1');
        $I->click(NotificationListPage::tab($this->Position_Status_New));
        $I->wait('1');
        $I->click(NotificationListPage::$TabAll);
        $I->wait('1');
        $I->seeOptionIsSelected(NotificationListPage::tabAllLineStatusSelect($this->Position_Notification), 'Новый');
    }
      
      
      
//-------------------TEXT ELEMENT LIST PAGE-------------------------------------
      
    /**
     * @group a
     */  
    public function VerifyTextElementLlist(NotificationListTester $I){
        $I->amOnPage(NotificationListPage::$URL);
        $I->wait('1');
        $I->see('Уведомления о появлении', NotificationListPage::$Title);
        $I->click(NotificationListPage::$TabAllHeadCheck);
        $I->wait('1');
        $I->see('Фильтр', NotificationListPage::$ButtonFilter);
        $I->see('Удалить', NotificationListPage::$ButtonDelete);
        $I->see('Все', NotificationListPage::$TabAll);
        $I->see('Выполнен', NotificationListPage::tab($this->Position_Status_Made));
        $I->see('Новый', NotificationListPage::tab($this->Position_Status_New));
        $I->see('ID', NotificationListPage::$TabAllHeadIDText);
        $I->see('E-mail', NotificationListPage::$TabAllHeadEmailText);
        $I->see('Время добавления', NotificationListPage::$TabAllHeadTimeText);
        $I->see('Действительно до', NotificationListPage::$TabAllHeadValidUntilText);
        $I->see('Менеджер', NotificationListPage::$TabAllHeadManagerText);
        $I->see('Статус', NotificationListPage::$TabAllHeadStatusText);
        $I->see('Товар', NotificationListPage::$TabAllHeadProductText);
        $I->see('Уведомления', NotificationListPage::$TabAllHeadNotificationsText);
    }  
    
    
    
//-------------------ELEMENT PRESENCE LIST PAGE---------------------------------
    
    /**
     * @group a
     */
    public function VerifyElementPresenceList(NotificationListTester $I){
        $I->amOnPage(NotificationListPage::$URL);
        $I->wait('3');
        $I->seeElement(NotificationListPage::$TabAllFilterIDInput);
        $I->seeElement(NotificationListPage::$TabAllFilterEmailInput);
        $I->seeElement(NotificationListPage::$TabAllFilterTimeInput);
        $I->seeElement(NotificationListPage::$TabAllFilterValidUntilInput);
        $I->seeElement(NotificationListPage::$TabAllHeadEmailText);
        $I->seeElement(NotificationListPage::$TabAllHeadCheck);
        $I->seeElement(NotificationListPage::$TabAllFilterSelectStatus);
        $I->seeElement(NotificationListPage::tabAllLineStatusSelect($this->Position_Notification));
    }
    
//-------------------TEXT ELEMENT DELETE WINDOW---------------------------------
    
    /**
     * @group a
     */
    public function VerifyTextElementDeleteWindow(NotificationListTester $I){
        $I->amOnPage(NotificationListPage::$URL);
        $I->wait('3');
        $I->click(NotificationListPage::tabAllLineCheck($this->Position_Notification));
        $I->click(NotificationListPage::$ButtonDelete);
        $I->wait('1');
        $I->seeElement(NotificationListPage::$WindowDelete);
        $I->see('Запросов на удаление',NotificationListPage::$WindowDeleteTitle);
        $I->see('Удалить выбранные запросы?',NotificationListPage::$WindowDeleteQuestion);
        $I->see('Удалить', NotificationListPage::$WindowDeleteButtonDelete);
        $I->see('Отменить', NotificationListPage::$WindowDeleteButtonCancel);
        $I->see('×', NotificationListPage::$WindowDeleteButtonClose);      
    }
    
    
    
//-------------------TEXT ELEMENT EDITING PAGE----------------------------------
    
    /**
     * @group a
     */
    public function VerifyTextElementEditing(NotificationListTester $I){
        $I->amOnPage(NotificationListPage::$URL);
        $I->wait('3');
        $I->click(NotificationListPage::tabAllLineIDLink($this->Position_Notification));
        $I->wait('2');
        $I->see('Редактирование уведомления', NotificationEditPage::$Title);
        $I->see('Вернуться', NotificationEditPage::$ButtonBack);
        $I->see('Сохранить', NotificationEditPage::$ButtonSave);
        $I->see('Сохранить и выйти', NotificationEditPage::$ButtonSaveExit);
        $I->see('Данные', NotificationEditPage::$TitleBlockEdit);
        $I->see('Изображение', NotificationEditPage::$HeadImage);
        $I->see('Товар', NotificationEditPage::$HeadProduct);
        $I->see('ID:', NotificationEditPage::$TextIDLabel);
        $I->see('Статус:', NotificationEditPage::$SelectStatusLabel);
        $I->see('Дата создания:', NotificationEditPage::$TextDateOfCreatingLabel);
        $I->see('Дата окончания:', NotificationEditPage::$InputDateActiveToLabel);
        $I->see('Статус установлен:', NotificationEditPage::$TextStatusSetByLabel);
        $I->see('Уведомить:', NotificationEditPage::$ButtonNotifyLabel);
        $I->see('Имя пользователя:', NotificationEditPage::$InputNameLabel);
        $I->see('E-mail:', NotificationEditPage::$InputEmailLabel);
        $I->see('Телефон:', NotificationEditPage::$InputPhoneLabel);
        $I->see('Комментарий:', NotificationEditPage::$InputCommentLabel);      
    }
    
    
    
//-------------------ELEMENT PRESENCE EDITING PAGE------------------------------
    
    /**
     * @group a
     */
    public function VerifyElementPresenceEditing(NotificationListTester $I){
        $I->amOnPage(NotificationListPage::$URL);
        $I->wait('3');
        $I->click(NotificationListPage::tabAllLineIDLink($this->Position_Notification));
        $I->wait('2');
        $I->seeElement(NotificationEditPage::$SelectStatus);
        $I->seeElement(NotificationEditPage::$InputDateActiveTo);
        $I->seeElement(NotificationEditPage::$ButtonNotify);
        $I->see('Менеджер не существует или не установлен', NotificationEditPage::$TextStatusSetBy);
        $I->seeElement(NotificationEditPage::$InputName);
        $I->seeElement(NotificationEditPage::$InputEmail);
        $I->seeElement(NotificationEditPage::$InputPhone);
        $I->seeElement(NotificationEditPage::$InputComment);
        $I->seeElement(NotificationEditPage::$LineImage);
        $I->seeElement(NotificationEditPage::$LineProduct);
    }
    
    
    
//-------------------- BUTTON EDITING PAGE-------------------------------------- 
    
    /**
     * @group a
     */
    public function VerifyButtonEditing(NotificationListTester $I){
        $I->amOnPage(NotificationListPage::$URL);
        $I->wait('3');
        $I->click(NotificationListPage::tabAllLineIDLink($this->Position_Notification));
        $I->wait('2');
        $I->click(NotificationEditPage::$ButtonBack);
        $I->click(NotificationListPage::tabAllLineIDLink($this->Position_Notification));
        $I->wait('1');
        $I->click(NotificationEditPage::$ButtonSave);
        $I->wait('1');
        $I->click(NotificationEditPage::$ButtonSaveExit);
        $I->wait('1');
        $I->see('Уведомления о появлении', NotificationEditPage::$Title);
    }
    
    
    
//-------------------LINK IMG EDITING PAGE--------------------------------------
    
    /**
     * @group a
     */
    public function VerifyLinkImgEditingProduct(NotificationListTester $I){
        $I->amOnPage(NotificationListPage::$URL);
        $I->wait('3');
        $I->click(NotificationListPage::tabAllLineIDLink($this->Position_Notification));
        $I->wait('2');
        $I->click(NotificationEditPage::$LineImage);
        $I->wait('2');
        $I->see($this->create_Prodct_Name, '//body/div[1]/div[5]/section/div/div[1]/span[2]');
     }
     
     
     
//-------------------LINK PRODUCT NAME EDITING PAGE-----------------------------
     
    /**
     * @group a
     */ 
    public function VerifyLinkProductNameEditingProduct(NotificationListTester $I){
        $I->amOnPage(NotificationListPage::$URL);
        $I->wait('3');
        $I->click(NotificationListPage::tabAllLineIDLink($this->Position_Notification));
        $I->wait('2');
        $I->click(NotificationEditPage::$LineProduct);
        $I->wait('2');
        $I->see($this->create_Prodct_Name, '//body/div[1]/div[5]/section/div/div[1]/span[2]');
     }

    
    
    
  
    
//-------------------BUTTON DELETE WINDOW---------------------------------------
    
    /**
     * @group a
     */
    public function VerifyButtonDeleteWindow (NotificationListTester $I){
        $I->amOnPage(NotificationListPage::$URL);
        $I->wait('3');
        $I->click(NotificationListPage::tabAllLineCheck($this->Position_Notification));
        $I->wait('1');
        $I->click(NotificationListPage::$ButtonDelete);
        $I->wait('1');
        $I->click(NotificationListPage::$WindowDeleteButtonClose);
        $I->wait('1');
        $I->click(NotificationListPage::$ButtonDelete);
        $I->wait('1');
        $I->click(NotificationListPage::$WindowDeleteButtonCancel);
        $I->wait('1');
    }
    
    
    
//-------------------TEXT DELETING NOTIFY LIST PAGE-----------------------------
    
    /**
     * @group a
     */
    public function TextDeletingNotifi(NotificationListTester $I){
        $I->amOnPage(NotificationListPage::$URL);
        $I->wait('3');
        $I->click(NotificationListPage::tabAllLineCheck($this->Position_Notification));
        $I->wait('1');
        $I->click(NotificationListPage::$ButtonDelete);
        $I->wait('1');
        $I->click(NotificationListPage::$WindowDeleteButtonDelete);
        $I->wait('1');
        $I->exactlySeeAlert($I, 'success', 'Удаление');
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