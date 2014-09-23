<?php
use \PremmerceTester;

class CreateShopCest
{
    // tests
    public function tryToTEsts(PremmerceTester $I){
    InitTest::Login($I);
    $I->amOnPage(NotificationListPage::$URL);
    $I->click(NotificationListPage::tabStatusLink(2));
    $I->wait(5);
    $I->click(NotificationListPage::headCheck(2));
    $I->wait(5);
    
    }
}