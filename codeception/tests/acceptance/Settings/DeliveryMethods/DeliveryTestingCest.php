<?php

use \AcceptanceTester;

class DeliveryTesting {
    /**
     * @group create
     */
    public function Authorization(AcceptanceTester $I) {
        InitTest::Login($I);
        $I->amOnPage("/admin/components/run/shop/deliverymethods/index");
        $I->waitForText("Список способов доставки","1",".title");
    }
     /**
     * @group create
     */
    public function NameEmpty(AcceptanceTester $I){
        $I->click(DeliveryPage::$CreateButton);
        $I->waitForText("Создание способа доставки",'10','.title');
        $I->click(DeliveryCreatePage::$ButtonCreate);
        $I->waitForElementVisible('//label[@generated="true"]');
        $I->see('Это поле обязательное.','label.alert.alert-error');
        $I->click(DeliveryCreatePage::$ButtonBack);
        $I->wait('2');
    }
    
     /**
     * @group create
     */
    public function Name250(AcceptanceTester $I){
        $I->click(DeliveryPage::$CreateButton);
        $I->waitForText("Создание способа доставки",'10','.title');
        $this->CreateDelivery($I, InitTest::$name250);
        $I->waitForElementVisible(".alert.in.fade.alert-success");
        $I->waitForElementNotVisible(".alert.in.fade.alert-success");
        $I->click(DeliveryCreatePage::$ButtonBack);
        $I->wait('2');
    }
     /**
     * @group create
     */
    public function Name500(AcceptanceTester $I){
        $I->click(DeliveryPage::$CreateButton);
        $I->waitForText("Создание способа доставки",'10','.title');
        $this->CreateDelivery($I, InitTest::$name500);
        $I->waitForElementVisible(".alert.in.fade.alert-success");
        $I->waitForElementNotVisible(".alert.in.fade.alert-success");
        $I->click(DeliveryCreatePage::$ButtonBack);
        $I->wait('2');
    }
         /**
     * @group create
     */
    public function Name501(AcceptanceTester $I){
        $I->click(DeliveryPage::$CreateButton);
        $I->waitForText("Создание способа доставки",'10','.title');
        $this->CreateDelivery($I, InitTest::$name501);
        $I->waitForElementVisible('.alert.in.fade.alert-error');
        $I->waitForElementNotVisible('.alert.in.fade.alert-error');
        $I->click(DeliveryCreatePage::$ButtonBack);
        $I->wait('2');
    }

    
    /**
     * function create Delivery with specified parrameters
     * if you wont to skip some field type off
     * if you want to select several Payment methods type "method1_method2_met hod3"
     */
    protected function CreateDelivery(AcceptanceTester $I,
                                      $name = "off",
                                      $active = "on",
                                      $description = "off" ,
                                      $descriptionprice ="off",
                                      $price = "off",
                                      $freefrom = "off",
                                      $message = "off",
                                      $pay = "off"){
        switch ($name){
            case 'off':
                break;
                default :
                $I->fillField(DeliveryCreatePage::$FieldName, $name);
                break;
        }
        switch ($active){
            case 'off':
                break;
            case 'on' :
                $I->checkOption(DeliveryCreatePage::$CheckboxActive);
                //$I->click(DeliveryCreatePage::$CheckboxActive);
                break;
        }
        switch ($description){
            case 'off':
                break;
            default :
                $I->fillField(DeliveryCreatePage::$FieldDescription,$description);
                break;
        }
        switch ($descriptionprice){
            case 'off':
                break;
            default :
                $I->fillField(DeliveryCreatePage::$FieldDescriptionPrice, $descriptionprice);
                break;
        }
        switch ($price){
            case 'off';
                break;
            default :
                $I->fillField(DeliveryCreatePage::$FieldPrice,$price);
                break;
        }
        switch ($freefrom){
            case 'off':
                break;
            default :
                $I->fillField(DeliveryCreatePage::$FieldFreeFrom, $freefrom);
                break;
        }
        switch ($message){
            case 'off':
                break;
            default :
                $I->checkOption(DeliveryCreatePage::$CheckboxPriceSpecified);
                $I->fillField(DeliveryCreatePage::$FieldPriceSpecified,$message);
        }
        switch ($pay){
            case 'off':
                break;
            default :
                //$len = $I->grabClassCount($I, 'focus frame_label no_connection');
                $pay = explode("_", $pay);
                foreach ($pay as $value) {
                    $I->click($value);
                }
                break;
        }
        $I->click(DeliveryCreatePage::$ButtonCreate);
        $I->wait("3");
    }
}
