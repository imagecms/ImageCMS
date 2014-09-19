<?php
use \PremmerceTester;

class CreateShopCest
{
    // tests
    public function tryToTEsts(PremmerceTester $I){
    InitTest::Login($I);
    $I->amOnPage(OrdersListCreatePage::$URL);
    $I->waitForElement(OrdersListCreatePage::$ButtonBack);
    
    $I->click(OrdersListCreatePage::$TabAdvancedSearch);
    $I->wait(1);
    $I->click('.chosen-single');
    $I->wait(10);
    
        
    }
}