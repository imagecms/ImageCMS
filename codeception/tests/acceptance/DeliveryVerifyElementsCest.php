<?php
use \AcceptanceTester;
class DeliveryVerifyElementsCest
{
    public function _before(AcceptanceTester $I)
    {
        InitTest::login($I);
        $I->click(NavigationBarPage::$Settings);
        $I->click(NavigationBarPage::$SettingsDelivery);
        $I->waitForText("Список способов доставки");
    }

    public function _after()
    {
    }

    // tests
    public function DeliveryListElements(AcceptanceTester $I)
    {
        $I->see("Список способов доставки","span.title");
        $gi = $I->see("Создать способ доставки",  DeliveryPage::$ListCreateButton);
        
        var_dump($gi);
        $I->checkOption(DeliveryPage::ListCheckboxLine(1));
        $text = $I->grabTextFrom(DeliveryPage::ListPriceLine(1));
        if ($text)  $I->comment($text);
        
        
    }
//    public function DeliveryCreateElements(AcceptanceTester $I)
//    {
//        $I->see("Список способов доставки","span.title");
//        $I->see("Создать способ доставки",  DeliveryPage::$ListCreateButton);
//        }
//        
//    public function DeliveryEditElements(AcceptanceTester $I)
//    {
//        $I->see("Список способов доставки","span.title");
//        $I->see("Создать способ доставки",  DeliveryPage::$ListCreateButton);
//        }
}
