<?php
use \AcceptanceTester;
class VerifyCreatingFrontCest
{
    // Авторизация
    public function Login(AcceptanceTester $I){
        InitTest::Login($I);
    }
    
    
//    Проверка присутствия Елементов и Текста в окне Создания Уведомления.
    public function VerifyTextElement(AcceptanceTester $I){
        $I->amOnPage(NotificationCreateFrontPage::$PageURL);
        $I->click(NotificationCreateFrontPage::$ButtonOnPage);
        $I->see('Сообщить о появлении', NotificationCreateFrontPage::$TitleWindow);
        $I->see('Смартфон Samsung GT-S7530 Omnia M EAA Deep Grey',  NotificationCreateFrontPage::$LinkNameProduct);    
        $I->see('100', NotificationCreateFrontPage::$PriceMaine);
        $I->see('3', NotificationCreateFrontPage::$PriceAdditional);
        $I->see('Ваше имя:', NotificationCreateFrontPage::$FieldUserName);
        $I->see('E-mail', NotificationCreateFrontPage::$FildEmailName);
        $I->see('*', NotificationCreateFrontPage::$FildUserStar);
        $I->see('*', NotificationCreateFrontPage::$FildEmeilStar);
        $I->see('Телефон:', NotificationCreateFrontPage::$FildPhoneName);
        $I->see('Комментарий:', NotificationCreateFrontPage::$FildCommentName);
        $I->see('Отправить', NotificationCreateFrontPage::$ButtonSendPresent);
        $I->see('Вы получите письмо, когда товар будет доступен', NotificationCreateFrontPage::$MessageInWindow);
        $I->seeElement(NotificationCreateFrontPage::$ButtonX);
        $I->seeElement(NotificationCreateFrontPage::$FildUserPresent);
        $I->seeElement(NotificationCreateFrontPage::$FildEmeilPresent);
        $I->seeElement( NotificationCreateFrontPage::$FildCommentPresent);
        $I->seeElement(NotificationCreateFrontPage::$FildCommentPresent);
        }
    
    //    Проверка появления сообщений обязательности заполнения поля Имя.
    public function Message1FildName (AcceptanceTester $I){
        $I->amOnPage(NotificationCreateFrontPage::$PageURL);
        $I->click(NotificationCreateFrontPage::$ButtonOnPage);
        $I->fillField(NotificationCreateFrontPage::$FildUserPresent, '');
        $I->click(NotificationCreateFrontPage::$ButtonSendPresent);
        $I->see('Поле Имя является обязательным.', NotificationCreateFrontPage::$FildUserMessage);
        }
        
    //    Проверка появления сообщений макс.кол.ввода в поле Имя.
    public function Message2FildName (AcceptanceTester $I){  
        $I->amOnPage(NotificationCreateFrontPage::$PageURL);
        $I->click(NotificationCreateFrontPage::$ButtonOnPage);     
        $I->fillField(NotificationCreateFrontPage::$FildUserPresent, '1234567890qwertyuiop asdfghj123kl; +_)(*&^%$# ЙЦУКЕНГШЩЗОР');
        $I->click(NotificationCreateFrontPage::$ButtonSendPresent);
        $I->see('Поле Имя не может превышать 50 символов в длину.', NotificationCreateFrontPage::$FildUserMessage);
        }       

    
//    Проверка появления сообщений обязательности заполнения поля E-mail.
    public function Message1FildEmeil (AcceptanceTester $I){
        $I->amOnPage(NotificationCreateFrontPage::$PageURL);
        $I->click(NotificationCreateFrontPage::$ButtonOnPage);
        $I->fillField(NotificationCreateFrontPage::$FildEmeilPresent, '');
        $I->click(NotificationCreateFrontPage::$ButtonSendPresent);
        $I->see('Поле Email является обязательным.', NotificationCreateFrontPage::$FildEmeilMessage);
        }      
        
        //    Проверка появления сообщений о корректности ввода символов в поле E-mail.
    public function Message2FildEmeil (AcceptanceTester $I){
        $I->amOnPage(NotificationCreateFrontPage::$PageURL);
        $I->click(NotificationCreateFrontPage::$ButtonOnPage);
        $I->fillField(NotificationCreateFrontPage::$FildEmeilPresent, 'йцу 123 !!!!!!! ЗЩШЗШ');
        $I->click(NotificationCreateFrontPage::$ButtonSendPresent);
        $I->seeElement(NotificationCreateFrontPage::$FildEmeilMessage);
        }          
             
        //    Проверка появления сообщений макс.кол.ввода в поле E-meil.
    public function Message3FildEmeil (AcceptanceTester $I){  
        $I->amOnPage(NotificationCreateFrontPage::$PageURL);
        $I->click(NotificationCreateFrontPage::$ButtonOnPage);   
        $I->fillField(NotificationCreateFrontPage::$FildEmeilPresent, 'ad@muuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuin.com');
        $I->click(NotificationCreateFrontPage::$ButtonSendPresent);
        $I->see('Поле Email не может превышать 50 символов в длину.', NotificationCreateFrontPage::$FildEmeilMessage);   
        }  
}