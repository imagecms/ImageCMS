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
        $I->wantTo("Verify all elements in Delivery list landing page");
        $I->see("Список способов доставки","span.title");
        $I->see("Создать способ доставки",  DeliveryPage::$ListCreateButton);
        $I->see("Удалить",DeliveryPage::$ListDeleteButton);
        $I->seeElement(DeliveryPage::$ListCheckboxHeader);
        $I->see("ID", DeliveryPage::$ListIDHeader);
        $I->see("Способ", DeliveryPage::$ListMethodHEader);
        $I->see("Цена", DeliveryPage::$ListPriceHeader);
        $I->see("Бесплатен от",  DeliveryPage::$ListFreeFromHeader);
        $I->see("Активный", DeliveryPage::$ListActiveButton);

    }
    public function DeliveryCreateElements(AcceptanceTester $I)
    {
        $I->wantTo("Verifyy all elements in Delivery Create page");
        $I->click(DeliveryPage::$ListCreateButton);
        }
        
//    public function DeliveryEditElements(AcceptanceTester $I)
//    {
//        $I->see("Список способов доставки","span.title");
//        $I->see("Создать способ доставки",  DeliveryPage::$ListCreateButton);
//        }
}
