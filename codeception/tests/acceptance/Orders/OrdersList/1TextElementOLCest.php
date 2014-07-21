<?php
use \AcceptanceTester;
class TextElementOLCest
{
//---------------------------AUTORIZATION--------------------------------------- 
    
    public function Login(AcceptanceTester $I){
        InitTest::Login($I);
    }
    
    
//---------------------------ORDER LIST PAGE WAY--------------------------------
    
    
    public function  WayListOL (AcceptanceTester $I){       
        $I->click(NavigationBarPage::$Orders);
        $I->click(NavigationBarPage::$OrdersList);
        $I->wait('3');
        $I->seeInCurrentUrl('/admin/components/run/shop/orders/index');
    }
    
    
//---------------------------ORDER CREATE PAGE WAY------------------------------
    
    
    public function WayCreatePage (AcceptanceTester $I){
        $I->amOnPage(OrdersListPage::$ListURLorders);
        $I->click(OrdersListPage::$ListButtCreateOrder);
        $I->seeInCurrentUrl(OrdersListPage::$CrtPURL);
        $I->wait('1');
    }
    
    
//---------------------TEXT ELEMENT LIST PAGE-----------------------------------
    
    
    public function VerufyTextListPage (AcceptanceTester $I){
        $I->amOnPage(OrdersListPage::$ListURLorders);
        $I->seeInPageSource('Список заказов');
        $I->click(OrdersListPage::$ListHeaderCheckBox);
        $I->see('Фильтр', OrdersListPage::$ListButtFilter);
        $I->see('Отменить фильтрацию', OrdersListPage::$ListButtCancelFilter);
        $I->see('Изменить статус', OrdersListPage::$ListButtSetStatuse);
        $I->see('Удалить', OrdersListPage::$ListButtDelete);
        $I->see('Создать заказ', OrdersListPage::$ListButtCreateOrder);
        $I->see('ID', OrdersListPage::$ListHeaderID);
        $I->see('Статус', OrdersListPage::$ListHeaderStatus);
        $I->see('Дата', OrdersListPage::$ListHeaderDate);
        $I->see('Заказчик', OrdersListPage::$ListHeaderCustomer);
        $I->see('Товары', OrdersListPage::$ListHeaderProduct);
        $I->see('Общая цена (без доставки)', OrdersListPage::$ListHeaderPrice);
        $I->see('Статус оплаты', OrdersListPage::$ListHeaderPlaymentStatus);
        $I->see('Заказов на странице', OrdersListPage::$ListPagiNameSelect);
    }
    
    
    
//---------------------------TEXT ELEMENT LIST PAGE-----------------------------
    
    
    public function VerufyElementListPage (AcceptanceTester $I){
        $I->amOnPage(OrdersListPage::$ListURLorders);
        $I->seeElement(OrdersListPage::$ListHeaderCheckBox);
        $I->seeElement(OrdersListPage::$ListFieldID);
        $I->seeElement(OrdersListPage::$ListFieldStatus);
        $I->seeElement(OrdersListPage::$ListFieldDateFrom);
        $I->seeElement(OrdersListPage::$ListFieldDateFrom);
        $I->seeElement(OrdersListPage::$ListFieldCustomer);
        $I->seeElement(OrdersListPage::$ListFieldProduct);
        $I->seeElement(OrdersListPage::$ListFieldPriceFrom);
        $I->seeElement(OrdersListPage::$ListFieldPriceTo);
        $I->seeElement(OrdersListPage::$ListFieldPlaymentStatus);
        $I->seeElement(OrdersListPage::$ListPagiSelect);
    }
    
    
    
//------------------TEXT ELEMENT CREATING PAGE----------------------------------
    
    
    public function VerufyTextCreatePPage (AcceptanceTester $I){
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
    
    
    
//------------------TEXT ELEMENT CREATING PAGE----------------------------------
    
    
    public function VerufyTextCreateUPage (AcceptanceTester $I){
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
    
    
   
   
}