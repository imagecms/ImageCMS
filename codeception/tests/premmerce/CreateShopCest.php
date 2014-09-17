<?php
use \PremmerceTester;

class CreateShopCest
{
    // tests
    public function tryToTEsts(PremmerceTester $I)
    {
        InitTest::Login($I);
        $I->amOnPage(DeliveryListPage::$URL);
        $I->wait(5);
        $I->click(GeneralPage::$TopPanelOrders);
        $I->wait(5);
        $I->click(GeneralPage::$TopPanelComments);
        $I->wait(5);
        $I->click(GeneralPage::$TopPanelNoPhoto);
        $I->wait(5);
        $I->click(GeneralPage::$TopPanelCallback);
        $I->wait(10);
    }
}