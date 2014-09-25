<?php
use \PremmerceTester;
use ProductCategoryCreatePage as PCP;

class CreateShopCest
{
    // tests
    public function tryToTEsts(PremmerceTester $I){
//    InitTest::Login($I);
    $I->amOnPage(PCP::$URL);
    $I->wait(3);
    $I->click(PCP::$SelectParent);
    $I->wait(5);
    
    }
}