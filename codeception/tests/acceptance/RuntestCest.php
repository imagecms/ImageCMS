<?php
use \AcceptanceTester;

class RuntestCest
{
//    public function _before()
//    {
//    }
//
//    public function _after()
//    {
//    }
    // tests
    public function tryToTest(AcceptanceTester $I)
    {
        InitTest::Login($I);
        $I->click(NavigationBarPage::$Settings);
        $I->click(NavigationBarPage::$SettingsDelivery);
        $I->waitForText("Список способов доставки");
        $rows = $I->grabTagCount($I, "tbody tr");
        for ($j=1;$j<$rows;++$j){
            $grabmethod = $I->grabTextFrom("//tbody/tr[$j]/td[3]/a");
            $I->comment("$grabmethod");
            if($grabmethod == "Доставка экспресс службой"){
                break;
            }
        }
        $togleclass = $I->grabAttributeFrom(DeliveryPage::ListActiveButtonLine($j), "class");
        $I->comment($togleclass);
        $I->comment((string)$j);
        $I->click(DeliveryPage::ListCheckboxLine($j));
        $I->wait("4");
        }
}