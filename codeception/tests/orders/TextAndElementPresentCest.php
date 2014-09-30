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
     * @group aa
     */
    public function VerifyWayToListPage (OrdersTester $I) {
        $I->click(NavigationBarPage::$Orders);
        $I->click(NavigationBarPage::$OrdersList);
        $I->wait(1);
        $I->seeInCurrentUrl($this->URl_List_Page);
    }
    
    
    /**
     * @group aa
     */
    public function VerifyTextPresentListPage (OrdersTester $I) {
        $I->click(NavigationBarPage::$Orders);
        $I->click(NavigationBarPage::$OrdersList);
        $I->wait(1);
        $I->see('Список Заказов', OrdersListPage::$Title);
    }
    
    
}

