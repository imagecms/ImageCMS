<?php
use \OrdersTester;
class SubPageUserOCACest
{
//---------------------------AUTORIZATION--------------------------------------- 
    /**
     * @group a
     */
    public function Login(OrdersTester $I){
        InitTest::Login($I);
    }
    
    
    
    
    
    /**
     * @group a
     * @guy OrdersTester\OrdersSteps
     */  
    public function CreateUserCommon(OrdersTester\OrdersSteps $I) {
        $I->wantTo('Verify .');
//        $I->createUserUserPage($createUserName = 'Создан с Пользователя', $createUserEmail = 'polzovatel@page.com', $createUserPassword = '123456', $createUserPhone = '9876543210', $createUserAddress = 'Страница админки Пользователь');
//        $I->CreateUserOrderPage($createUserName = 'Создан с Заказа', $createUserEmail = 'polzovatel@zakaz.net', $createUserPhone = '0123456789', $createUserAddress = 'Страница админ панели Заказ');
        $I->searchUserOnUserPage($UserName = 'hkgjgjhg');//, $UserEmeil = 'saseras@brastamas.net'
    }
        
        
    
    
    
    
    
    
    
    
    
    
}