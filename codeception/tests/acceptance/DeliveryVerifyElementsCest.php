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
        //$I->executeJS("document.getElementsByTagName('tbody')[0].getElementsByTagName('tr').length");
        $I->executeInSelenium(function(\WebDriver $wd){
            //$wd->;
        });
    }
    /**
     * @group verifyi
     */

    public function DeliveryDeleteWindow (AcceptanceTester $I){
        $I->click(DeliveryPage::$ListCheckboxHeader);
        $I->click(DeliveryPage::$ListDeleteButton);
        $I->waitForText("Удаление способов доставки", "30", "//*[@id='mainContent']/div/div[1]/div[1]/h3");
        $I->seeElement(DeliveryPage::$Deletewindow);
        $I->see("Удалить", DeliveryPage::$DeleteWindowDelete);
        $I->see("Отменить", DeliveryPage::$DeleteWindowBack);
        $I->seeElement(DeliveryPage::$DeleteWindowX);
        $I->click(DeliveryPage::$DeleteWindowX);
    }
    
    /**
     * @group verifyi
     */
    public function DeliveryCreateElements(AcceptanceTester $I)
    {
        $I->wantTo("Verifyy all elements in Delivery Create page");
        //InitTest::ClearAllCach($I);
        $I->click(DeliveryPage::$ListCreateButton);
        $I->waitForText("Создание способа доставки",'30','.title');
        $I->see("Создание способа доставки",'.title');
        $I->see("Создание способа доставки","//thead/tr/th");
        
        }
    /**
     *@group verifyi
     */    
    public function DeliveryEditElements(AcceptanceTester $I)
    {
        $I->see("");
    }
}
