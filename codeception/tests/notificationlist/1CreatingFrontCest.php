<?php

use \NotificationListTester;

class CreatingFrontCest

{
    
    private $front_Prodct_URl    = '/shop/product/front-forma-sozdaniia-uvedomleniia';
    private $front_Prodct_Button_Notification = '.infoBut.isDrop';
    
    private $create_Prodct_Name  = 'Фронт Форма Создания Уведомления';
    private $create_Prodct_Price = '789';
    
    private $create_Category_Name = 'Нотіфікованная';
    
    private $symbol_name_51 = '1234567890qwertyuiop asdfghj123kl; +_)(*&^%$# ЙЦУКЕ';
    private $symbol_email_51 = 'ad@muuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuusuuuuin.com';
    private $symbol_phone_51 = '012365478901236548120123654789012365481201236547890';
    
    private $user_Name      = 'QWER ФЫВ 213';
    private $user_Email     = 'Africa@Boombaataa.net';
    private $user_Phone     = '1320654987';
    private $user_Comment   = 'Привет Питер ії ZXCMN !,.-';








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
    
    
//---------------------------TEXT ELEMENT PRESENCE------------------------------

    /**
     * @group a
     */
    public function VerifyTextElement(NotificationListTester $I){
        $I->amOnPage($this->front_Prodct_URl);
        $I->wait('2');
        $I->scrollToElement($I, $this->front_Prodct_Button_Notification);
        $I->wait('1');
        $I->click($this->front_Prodct_Button_Notification);
        $I->wait('3');
        $I->see('Сообщить о появлении', FrontCreateNotificationPage::$Title);
        $I->see($this->create_Prodct_Name, FrontCreateNotificationPage::$LinkNameProduct);    
        $I->see($this->create_Prodct_Price, FrontCreateNotificationPage::$TextPrice);
        $I->see('Ваше имя:', FrontCreateNotificationPage::$InputNameLabel);
        $I->see('E-mail', FrontCreateNotificationPage::$InputEmailLabel);
        $I->see('*', FrontCreateNotificationPage::$InputNameStar);
        $I->see('*', FrontCreateNotificationPage::$InputEmailStar);
        $I->see('Телефон:', FrontCreateNotificationPage::$InputPhoneLabel);
        $I->see('Комментарий:', FrontCreateNotificationPage::$InputCommentLabel);
        $I->see('Отправить', FrontCreateNotificationPage::$ButtonSend);
        $I->see('Вы получите письмо, когда товар будет доступен', FrontCreateNotificationPage::$Help);
        }
        
        
        
//--------------------------ELEMENT PRESENCE------------------------------------
        
    /**
     * @group a
     */    
    public function VerifyElement(NotificationListTester $I){
        $I->amOnPage($this->front_Prodct_URl);
        $I->wait('2');
        $I->scrollToElement($I, $this->front_Prodct_Button_Notification);
        $I->wait('1');
        $I->click($this->front_Prodct_Button_Notification);
        $I->wait('3');
        $I->seeElement(FrontCreateNotificationPage::$WindowCreateNotification);
        $I->seeElement(FrontCreateNotificationPage::$ImageProduct);
        $I->seeElement(FrontCreateNotificationPage::$ButtonClose);
        $I->seeElement(FrontCreateNotificationPage::$InputName);
        $I->seeElement(FrontCreateNotificationPage::$InputEmail);
        $I->seeElement(FrontCreateNotificationPage::$InputPhone);
        $I->seeElement(FrontCreateNotificationPage::$InputComment);
        $I->seeElement(FrontCreateNotificationPage::$TextCurrency);
    }  
        
        
        
//-----------------------MESSAGE MANDATORY FIELD NAME---------------------------
        
    /**
     * @group a
     */    
    public function AlertMessage1FildName (NotificationListTester $I){

        $I->amOnPage($this->front_Prodct_URl);
        $I->wait('2');
        $I->scrollToElement($I, $this->front_Prodct_Button_Notification);
        $I->wait('1');
        $I->click($this->front_Prodct_Button_Notification);
        $I->wait('3');
        $I->fillField(FrontCreateNotificationPage::$InputName, '');
        $I->click(FrontCreateNotificationPage::$ButtonSend);
        $I->waitForElement(FrontCreateNotificationPage::$InputNameMessageAlert);
        $I->see('Поле Имя является обязательным.', FrontCreateNotificationPage::$InputNameMessageAlert);
        }
        
        
        
//-----------------------MESSAGE LINITATION FIELD NAME--------------------------
        
    /**
     * @group a
     */    
    public function AlertMessage2FildName (NotificationListTester $I){  
        $I->amOnPage($this->front_Prodct_URl);
        $I->wait('2');
        $I->scrollToElement($I, $this->front_Prodct_Button_Notification);
        $I->wait('1');
        $I->click($this->front_Prodct_Button_Notification);
        $I->wait('3');
        $I->fillField(FrontCreateNotificationPage::$InputName, $this->symbol_name_51);
        $I->click(FrontCreateNotificationPage::$ButtonSend);
        $I->waitForElement(FrontCreateNotificationPage::$InputNameMessageAlert);
        $I->see('Поле Имя не может превышать 50 символов в длину.', FrontCreateNotificationPage::$InputNameMessageAlert);
        }  
        
        
        
//-----------------------MESSAGE MANDATORY FIELD EMEIL--------------------------
        
    /**
     * @group a
     */    
    public function AlertMessage1FildEmeil (NotificationListTester $I){
        $I->amOnPage($this->front_Prodct_URl);
        $I->wait('2');
        $I->scrollToElement($I, $this->front_Prodct_Button_Notification);
        $I->wait('1');
        $I->click($this->front_Prodct_Button_Notification);
        $I->wait('3');
        $I->fillField(FrontCreateNotificationPage::$InputEmail, '');
        $I->click(FrontCreateNotificationPage::$ButtonSend);
        $I->waitForElement(FrontCreateNotificationPage::$InputEmailMessageAlert);
        $I->see('Поле Email является обязательным.', FrontCreateNotificationPage::$InputEmailMessageAlert);
        } 
        
        
        
//-----------------------MESSAGE CORRECTLY FIELD EMEIL--------------------------
        
    /**
     * @group a
     */    
    public function AlertMessage2FildEmeil (NotificationListTester $I){
        $I->amOnPage($this->front_Prodct_URl);
        $I->wait('2');
        $I->scrollToElement($I, $this->front_Prodct_Button_Notification);
        $I->wait('1');
        $I->click($this->front_Prodct_Button_Notification);
        $I->wait('3');
        $I->fillField(FrontCreateNotificationPage::$InputEmail, 'йцу 123 !!!!!!! ЗЩШЗШ');
        $I->click(FrontCreateNotificationPage::$ButtonSend);
        $I->waitForElement(FrontCreateNotificationPage::$InputEmailMessageAlert);
        $I->see('Поле Email должно содержать корректный адрес электронной почты.',FrontCreateNotificationPage::$InputEmailMessageAlert);//'label.for_validations.error'
        }  
        
        
        
//-----------------------MESSAGE LIMITATION FIELD EMEIL-------------------------
        
    /**
     * @group a
     */    
    public function AlertMessage3FildEmeil (NotificationListTester $I){  
        $I->amOnPage($this->front_Prodct_URl);
        $I->wait('2');
        $I->scrollToElement($I, $this->front_Prodct_Button_Notification);
        $I->wait('1');
        $I->click($this->front_Prodct_Button_Notification);
        $I->wait('3');
        $I->fillField(FrontCreateNotificationPage::$InputEmail, $this->symbol_email_51);
        $I->click(FrontCreateNotificationPage::$ButtonSend);
        $I->waitForElement(FrontCreateNotificationPage::$InputEmailMessageAlert);
        $I->see('Поле Email не может превышать 50 символов в длину.', FrontCreateNotificationPage::$InputEmailMessageAlert);   
        } 
        
        
        
//-----------------------MESSAGE LIMITATION FIELD PHONE-------------------------
        
    /**
     * @group a
     */    
    public function AlertMessage1FildPhone (NotificationListTester $I){  
        $I->amOnPage($this->front_Prodct_URl);
        $I->wait('2');
        $I->scrollToElement($I, $this->front_Prodct_Button_Notification);
        $I->wait('1');
        $I->click($this->front_Prodct_Button_Notification);
        $I->wait('3');
        $I->fillField(FrontCreateNotificationPage::$InputPhone, $this->symbol_phone_51);
        $I->wait('2');       
        $I->click(FrontCreateNotificationPage::$ButtonSend);
        $I->waitForElement(FrontCreateNotificationPage::$InputPhoneMessageAlert);
        $I->see('Поле Телефон не может превышать 50 символов в длину.', FrontCreateNotificationPage::$InputPhoneMessageAlert);   
        } 
        
        
        
//-----------------------MESSAGE CORRECTLY FIELD PHONE--------------------------
        
    /**
     * @group a
     */    
    public function AlertMessage2FildPhone (NotificationListTester $I){  
        $I->amOnPage($this->front_Prodct_URl);
        $I->wait('2');
        $I->scrollToElement($I, $this->front_Prodct_Button_Notification);
        $I->wait('1');
        $I->click($this->front_Prodct_Button_Notification);
        $I->wait('3');
        $I->fillField(FrontCreateNotificationPage::$InputPhone, '0112 54 !@# QWE a 987');
        $I->click(FrontCreateNotificationPage::$ButtonSend);
        $I->waitForElement(FrontCreateNotificationPage::$InputPhoneMessageAlert);
        $I->see('Поле Телефон должно содержать целое число.', FrontCreateNotificationPage::$InputPhoneMessageAlert);   
        } 
           
        
//-----------------------MESSAGE OF CREATE NOTIFI-------------------------------
        
    /**
     * @group a
     */    
    public function CreateNotificationMessage (NotificationListTester $I){
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
        $I->waitForElement('div.jspPane > div.inside-padd');
        $I->waitForText('Спасибо');
        $I->see('Спасибо');
        } 
        
        
        
//-----------------------PRESENCE CREATEING NOTIFI ADMIN------------------------
        
    /**
     * @group a
     */    
    public function VerifyPresenceCreatedNotification (NotificationListTester $I){
        $I->amOnPage(NotificationListPage::$URL);
        $I->wait('2');
        $I->see($this->user_Email, NotificationListPage::tabAllLineEmailText(1));
        $I->click(NotificationListPage::tabAllLineIDLink(1));
        $I->wait('2');
        $I->see('Редактирование уведомления', NotificationEditPage::$Title);
        }
        
        
        
//-----------------------PRESENCE INPUT VALUES FIELDS ADMIN---------------------
        
    /**
     * @group a
     */    
    public function VerifyInputValuesCreatedNotification (NotificationListTester $I){
        $I->amOnPage(NotificationListPage::$URL);
        $I->wait('2');
        $I->click(NotificationListPage::tabAllLineIDLink(1));
        $I->wait('2');
        $I->see('Редактирование уведомления', NotificationEditPage::$Title);
        $I->seeInField(NotificationEditPage::$InputName, $this->user_Name);
        $I->seeInField(NotificationEditPage::$InputEmail, $this->user_Email);
        $I->seeInField(NotificationEditPage::$InputPhone, $this->user_Phone);
        $I->seeInField(NotificationEditPage::$InputComment, $this->user_Comment);
        }  
        
        
        
//---------------------------CLEARING-------------------------------------------  
        
    /**
     * @group a
     */
    public function DeleteNotification2(NotificationListTester $I){
        $I->amOnPage(NotificationListPage::$URL);
        $I->wait('1');
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