<?php
use \AcceptanceTester;

class RuntestCest
{
    public function _before()
    {
    }

    public function _after()
    {
    }

    // tests
    public function tryToTest(AcceptanceTester $I)
    {
        InitTest::Login($I);
        $I->click(NavigationBarPage::$Settings);
        $I->click(NavigationBarPage::$SettingsDelivery);
        $I->waitForText("Список способов доставки");
    }
}