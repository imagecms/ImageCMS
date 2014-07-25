<?php
use \AcceptanceTester;
class TextElementOCACest
{
//---------------------------AUTORIZATION--------------------------------------- 
    
    public function Login(AcceptanceTester $I){
        InitTest::Login($I);
    }
    
    
//---------------------------ORDER CREATE PAGE WAY------------------------------
    
    
    public function WayCreatePage (AcceptanceTester $I){
        $I->amOnPage(OrdersListPage::$ListURLorders);
        $I->click(OrdersListPage::$ListButtCreateOrder);
        $I->seeInCurrentUrl(OrdersListPage::$CrtPURL);
        $I->wait('1');
    }
    
//------------------TEXT ELEMENT CREATING PAGE PRODUCT--------------------------
    
    
    public function VerifyTextCreateProductPage (AcceptanceTester $I){
         $I->amOnPage(OrdersListPage::$CrtPURL);
         $I->see('Создание заказа', OrdersListPage::$CrtPTitle); 
         $I->see('Вернуться', OrdersListPage::$CrtPButtBack); 
         $I->see('Создать', OrdersListPage::$CrtPButtCreate); 
         $I->see('Создать и выйти', OrdersListPage::$CrtPButtCreateAndGoBack); 
         $I->see('Товар', OrdersListPage::$CrtPButtProduct); 
         $I->see('Пользователь', OrdersListPage::$CrtPButtUser); 
         $I->see('Заказ', OrdersListPage::$CrtPButtOrder); 
         $I->see('Поиск товара', OrdersListPage::$CrtPNameBlockProductSearch); 
         $I->see('ID / Название / Артикул', OrdersListPage::$CrtPNameFieldIDNameArticul); 
         $I->see('Категория:', OrdersListPage::$CrtPNameSelectCategory); 
         $I->see('Товар:', OrdersListPage::$CrtPNameSelectProduct); 
         $I->see('Вариант:', OrdersListPage::$CrtPNameSelectVariant); 
         $I->see('Товар', OrdersListPage::$CrtPNameColProduct); 
         $I->see('Вариант', OrdersListPage::$CrtPNameColVariant); 
         $I->see('Цена', OrdersListPage::$CrtPNameColPrice); 
         $I->see('Количество', OrdersListPage::$CrtPNameColNumber); 
         $I->see('Общая цена', OrdersListPage::$CrtPNameColTotalPrice); 
         $I->see('Удалить', OrdersListPage::$CrtPNameColDelete); 
    }
    
    
    
//------------------TEXT ELEMENT CREATING PAGE USER-----------------------------
    
    
    public function VerifyTextCreateUserPage (AcceptanceTester $I){
         $I->amOnPage(OrdersListPage::$CrtPURL);  
         $I->click(OrdersListPage:: $CrtPButtUser);
         $I->click(OrdersListPage::$CrtULinkCreate);
         $I->see('Пользователь', OrdersListPage::$CrtUNameBlockUser);
         $I->see('Создать', OrdersListPage::$CrtULinkCreate);
         $I->see('Создать пользователя:', OrdersListPage::$CrtUNameBlockCreateUser);
         $I->see('* Полное имя :', OrdersListPage::$CrtUNameFieldName);
         $I->see('* E-mail :', OrdersListPage::$CrtUNameFieldEmeil);
         $I->see('Телефон :', OrdersListPage::$CrtUNameFieldPhone);
         $I->see('Адрес:', OrdersListPage::$CrtUNameFieldAddress);
         $I->see('Создать', OrdersListPage::$CrtUButtCreate);
         $I->see('Пользователь', OrdersListPage::$CrtUNameBlockUser);
         $I->see('Поиск:', OrdersListPage::$CrtUNameBlockSearch);
         $I->see('ID / Имя / E-mail', OrdersListPage::$CrtUFieldIDNameEmeil);
    }
    

//------------------TEXT ELEMENT CREATING PAGE ORDER----------------------------    
    public function VerifyTextCreateOrderPage (AcceptanceTester $I){
        $I->amOnPage(OrdersListPage::$CrtPURL);
        $I->click(OrdersListPage::$CrtPButtOrder);
        $I->see('Информация заказа', OrdersListPage::$CrtONameBlockOrderInfo);
        $I->see('Пользователь:', OrdersListPage::$CrtONameBlockUser);
        $I->see('Имя:', OrdersListPage::$CrtONameFieldName);
        $I->see('Фамилия:', OrdersListPage::$CrtONameFieldFamily);
        $I->see('E-mail:', OrdersListPage::$CrtONameFieldEmeil);
        $I->see('Телефон:', OrdersListPage::$CrtONameFieldPhone);
        $I->see('Адрес:', OrdersListPage::$CrtONameFieldAddres);
        $I->see('Сумма товаров:', OrdersListPage::$CrtONameFieldTotalPrice);
        $I->see('Обновление', OrdersListPage::$CrtOButtUpdate);
        $I->see('Информация заказа:', OrdersListPage::$CrtONameBlockDeviliry);
        $I->see('Способ доставки:', OrdersListPage::$CrtONameSelectDelivey);
        $I->see('Не выбрано', '//select[1]');
        $I->see('Способ оплаты:', OrdersListPage::$CrtONameSelectPlaymant);
        $I->see('Не выбрано', '//select[2]');
        $I->see('Подарочный сертификат:', OrdersListPage::$CrtONameBlockCertificate);
        $I->see('Ввести промо-код:', OrdersListPage::$CrtONameFieldPromoCode);
    }

    
    
//------------------VERIFY TEXT MESSAGE PRESENCE--------------------------------
    public function VerifyTextMessagePresence (AcceptanceTester $I){
        $I->amOnPage(OrdersListPage::$CrtPURL);
        $I->click(OrdersListPage::$CrtPButtOrder);
        $I->moveMouseOver(OrdersListPage::$CrtOFieldTotalPrice);
        $I->waitForElementVisible('//body/div[5]/div[2]');
        $I->see('только цифры', '//body/div[5]/div[2]');
        $I->moveMouseOver(OrdersListPage::$CrtPButtCreate);
        $I->waitForElementNotVisible('//body/div[5]/div[2]');
        $I->dontSee('только цифры', '//body/div[5]/div[2]');
    }
    
   
    
    
}
