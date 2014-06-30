<?php
class NavBarPage
{


}
use \AcceptanceTester;
class DeliveryVerifyElementsCest
{
    public function _before(AcceptanceTester $I)
    {
        InitTest::login($I);
        $I->click(DeliveryPage::$Settings);
        $I->click(DeliveryPage::$SettingsDelivery);
        $I->waitForText("Список способов доставки");
    }

    public function _after()
    {
    }

    // tests
    public function tryToTest(AcceptanceTester $I)
    {
    }
}