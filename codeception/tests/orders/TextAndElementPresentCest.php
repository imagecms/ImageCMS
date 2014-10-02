<?php

use \OrdersTester;

class TextAndElementsPresentCast

{
    private $URl_List_Page      = '/admin/components/run/shop/orders';
    private $URl_Create_Page    = '/admin/components/run/shop/orders/create';
    
    
    
    
    
    
    
    
    
    
//    /**
//     * @group a
//     * @guy OrdersTester\OrdersSteps
//     */
//    public function Kits(OrdersTester\OrdersSteps $I) {
// }
 
    
//----------------------------LIST PAGE-----------------------------------------   
    
    /**
     * @group aa
     */
    public function Login(OrdersTester $I) {
        InitTest::Login($I);
    }
    
    /**
     * @group a
     */
    public function VerifyWayToListPage (OrdersTester $I) {
        $I->click(NavigationBarPage::$Orders);
        $I->click(NavigationBarPage::$OrdersList);
        $I->wait(1);
        $I->seeInCurrentUrl($this->URl_List_Page);
    }
    
    
    /**
     * @group a
     */
    public function VerifyTitlePresentListPage (OrdersTester $I) {
        $I->click(NavigationBarPage::$Orders);
        $I->click(NavigationBarPage::$OrdersList);
        $I->wait(1);
        $I->see('Список заказов (0)',OrdersListPage::$Title);
    }
    
    
    
    /**
     * @group a
     */
    public function VerifyTextPresentListPage (OrdersTester $I) {
        $I->click(NavigationBarPage::$Orders);
        $I->click(NavigationBarPage::$OrdersList);
        $I->wait(1);
        $I->see('Создать заказ', OrdersListPage::$ButtonCreate);
        $I->see('ID', OrdersListPage::$HeadIDLink);
        $I->see('Статус', OrdersListPage::$HeadStatusLink);
        $I->see('Дата', OrdersListPage::$HeadDateLink);
        $I->see('Заказчик', OrdersListPage::$HeadCustomerText);
        $I->see('Товары', OrdersListPage::$HeadProductsText);
        $I->see('Общая цена (без доставки)', OrdersListPage::$HeadTotalPriceLink);
        $I->see('Статус оплаты', OrdersListPage::$HeadPaymentStatusLink);
        $I->see('Заказов на странице', OrdersListPage::$SelectPaginationLabel);
    }
    
    
    
    /**
     * @group a
     */
    public function VerifyElementPresentListPage (OrdersTester $I) {
        $I->click(NavigationBarPage::$Orders);
        $I->click(NavigationBarPage::$OrdersList);
        $I->wait(1);
        $I->seeElement(OrdersListPage::$FilterIDInput);
        $I->seeElement(OrdersListPage::$FilterDateInputFrom);
        $I->seeElement(OrdersListPage::$FilterDateInputTo);
        $I->seeElement(OrdersListPage::$FilterCustomerInput);
        $I->seeElement(OrdersListPage::$FilterProductsInput);
        $I->seeElement(OrdersListPage::$FilterTotalPriceInputFrom);
        $I->seeElement(OrdersListPage::$FilterTotalPriceInputTo);
        $I->seeElement(OrdersListPage::$FilterStatusSelect);
        $I->seeElement(OrdersListPage::$FilterPaymentStatusSelect);
    }
    
    
    /**
     * @group aa
     */
    public function VerifyWayToCreatetPage (OrdersTester $I) {
        $I->click(NavigationBarPage::$Orders);
        $I->click(NavigationBarPage::$OrdersList);
        $I->wait(1);
        $I->click(OrdersListPage::$ButtonCreate);
        $I->wait(1);
        $I->seeInCurrentUrl($this->URl_Create_Page);
    }
    
    
    /**
     * @group a
     */
    public function VerifyTextPresentCreatePage (OrdersTester $I) {
        $I->amOnPage(OrdersListCreatePage::$URL);
        $I->see('Создание заказа', OrdersListCreatePage::$Title);
//        $I->see('', OrdersListCreatePage::);
//        $I->see('', OrdersListCreatePage::);
//        $I->see('', OrdersListCreatePage::);
//        $I->see('', OrdersListCreatePage::);
//        $I->see('', OrdersListCreatePage::);

    }
    
    
}

