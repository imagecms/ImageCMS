<?php

use \AcceptanceTester;

class DeliveryTesting {

    public function Authorization(AcceptanceTester $I) {
        InitTest::Login($I);
        $I->amOnPage("/admin/components/run/shop/deliverymethods/index");
        $I->waitForText("Список способов доставки","1",".title");
    }
    public function NameEmpty(AcceptanceTester $I){
        $I->click(DeliveryPage::$CreateButton);
        InitTest::ClearAllCach($I);
        //$I->wait("1");
        $I->waitForText("Создание способа доставки",'10','.title');
        $I->click(DeliveryCreatePage::$ButtonCreate);
        $I->waitForElementVisible('//label[@generated="true"]');
        $I->see('Это поле обязательное.','label.alert.alert-error');
        $I->click(DeliveryCreatePage::$ButtonBack);
        $I->wait('1');
    }
}
