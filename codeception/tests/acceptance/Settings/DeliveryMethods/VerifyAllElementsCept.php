<?php
class DeliveryListElements{
    public static $listPage = 'http://cmsprem.loc/admin/components/run/shop/deliverymethods/index';
    public static $listCreateButton = '.btn.btn-small.btn-success.pjax';
    public static $listDeleteButton = '.btn.btn-small.btn-danger.action_on';
    public static $listHeaderCheck = '//table/thead/tr/th[1]/span/span/input';
    
}
$I = new AcceptanceTester($scenario);
InitTest::login($I);
$I->click(NavButtons::$NavSettings);
$I->click(NavButtons::$NavSettingsDelivery);
$I->waitForText("Список способов доставки");