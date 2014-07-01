<?php
use \AcceptanceTester;
class DeliveryVerifyElementsCest
{
//    public function _before(AcceptanceTester $I)
//    {
//    }
//
//    public function _after()
//    {
//    }

    // tests
    /**
     * @group verify
     */
    public function Autorization(AcceptanceTester $I){
        //Login & go to page DeliveryList
        InitTest::login($I);
        $I->click(NavigationBarPage::$Settings);
        $I->click(NavigationBarPage::$SettingsDelivery);
        $I->waitForText("Список способов доставки");
    }
    /**
     * @group verify
     */
    public function DeliveryListElements(AcceptanceTester $I)
    {
        
        //Verification
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
    
    /**
     * @group verify
     */
    public function DeliveryCreateElements(AcceptanceTester $I)
    {
        $I->wantTo("Verifyy all elements in Delivery Create page");
        InitTest::ClearAllCach($I);
        $I->click(DeliveryPage::$ListCreateButton);
        $I->waitForText("Создание способа доставки",'30','.title');

        }
    /**
     *@group verify 
     */    
    public function DeliveryEditElements(AcceptanceTester $I)
    {
        $I->see("");
    }
}
