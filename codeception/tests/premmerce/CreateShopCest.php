<?php
use \PremmerceTester;

class CreateShopCest
{
    // tests
    public function tryToTEsts(PremmerceTester $I){
    InitTest::Login($I);
    $I->amOnPage(ProductCategoryCreatePage::$URL);
    $I->wait(3);
    $I->click(ProductCategoryCreatePage::$SelectParent);
    $I->wait(5);
    
    }
}