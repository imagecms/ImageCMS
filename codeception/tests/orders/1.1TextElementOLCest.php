<?php
use \AcceptanceTester;
class TextElementOLCest
{
//---------------------------AUTORIZATION--------------------------------------- 
    /**
     * @group a
     */
    public function Login(AcceptanceTester $I){
        InitTest::Login($I);
    }
    
    
//---------------------------ORDER LIST PAGE WAY--------------------------------
    
    /**
     * @group a
     */
    public function  WayListOL (AcceptanceTester $I){      
        $I->wantTo('Проверить путь к странице "Список заказов".');
        $I->click(NavigationBarPage::$Orders);
        $I->click(NavigationBarPage::$OrdersList);
        $I->wait('1');
        $I->seeInCurrentUrl('/admin/components/run/shop/orders/index');
    }
    

    
    
//---------------------TEXT ELEMENT LIST PAGE-----------------------------------
    
    /**
     * @group a
     */
    public function VerufyTextListPage (AcceptanceTester $I){
        $I->wantTo('Проверить текст на странице "Список заказов.');
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
    
    /**
     * @group a
     */
    public function VerufyElementListPage (AcceptanceTester $I){
        $I->wantTo('Проверить наличие елементов страницы "Список заказов".');
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
    
    
    

    
    
    

    
   
   
}

