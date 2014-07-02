<?php
use \AcceptanceTester;
class DeliveryVerifyElementsCest
{
//    public function _before(AcceptanceTester $I)
//    {
<<<<<<< HEAD
//        InitTest::login($I);
//        $I->click(NavigationBarPage::$Settings);
//        $I->click(NavigationBarPage::$SettingsDelivery);
//        $I->waitForText("Список способов доставки");
//    }
//
=======
//    }
>>>>>>> ef42d0598b50218c8224834e7b11c1baec589e2f
//    public function _after()
//    {
//    }

<<<<<<< HEAD
    // tests
    public function DeliveryListElements(AcceptanceTester $I)
    {
=======
    /**
     * @group verify
     */
    public function Autorization(AcceptanceTester $I){
>>>>>>> ef42d0598b50218c8224834e7b11c1baec589e2f
        //Login & go to page DeliveryList
        InitTest::login($I);
        $I->click(NavigationBarPage::$Settings);
        $I->click(NavigationBarPage::$SettingsDelivery);
        $I->waitForText("Список способов доставки");
<<<<<<< HEAD
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
    public function DeliveryCreateElements(AcceptanceTester $I)
    {
        $I->wantTo("Verifyy all elements in Delivery Create page");
        //$I->click(DeliveryPage::$ListCreateButton);
        InitTest::ClearAllCach($I);
        }
        
//    public function DeliveryEditElements(AcceptanceTester $I)
//    {
//        $I->see("Список способов доставки","span.title");
//        $I->see("Создать способ доставки",  DeliveryPage::$ListCreateButton);
//        }
}
=======
        //
        //InitTest::a($I, "tbody", "tr");
       // $I->comment(InitTest::TagCount($I,"tbody tr"));
        $count = $I->grabTagCount($I,"tbody tr");
        $I->comment($count);
    }
    /**
     * @group verifyi
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
        $I->wait('1');
        $I->click(DeliveryPage::$ListCreateButton);
        $I->waitForText("Создание способа доставки",'30','.title');
        $I->see("Создание способа доставки",'.title');
        $I->see("Создание способа доставки","//thead/tr/th");
        $I->see("Название: *", DeliveryCreatePage::$FieldNameLabel);
        $I->see("Описание",  DeliveryCreatePage::$FieldDescriptionLabel);
        $I->see("Описание цены доставки", DeliveryCreatePage::$FieldDescriptionPriceLabel);
        $I->see("Цена доставки",DeliveryCreatePage::$FieldPriceLabel);
        $I->see("Бесплатен от", DeliveryCreatePage::$FieldFreeFromLabel);
        $I->see("Цена уточняется", DeliveryCreatePage::$CheckboxPriceSpecifiedLabel);
        $I->click(DeliveryCreatePage::$CheckboxPriceSpecified);
        $I->waitForElementVisible(DeliveryCreatePage::$FieldPriceSpecified);
        $I->see("Сообщение про уточнение цены:",  DeliveryCreatePage::$FieldPriceSpecifiedLabel);
        $I->see("Создать и выйти",DeliveryCreatePage::$ButtonCreateExit);
        $I->see("Создать",DeliveryCreatePage::$ButtonCreate);
        $I->see("Вернуться",DeliveryCreatePage::$ButtonBack);
        $I->click(DeliveryCreatePage::$ButtonBack);
        $I->waitForText("Список способов доставки");
    }
    /**
     *@group verifyi
     */    
    public function DeliveryEditElements(AcceptanceTester $I)
    {
        $I->wantTo("Verifyy all elements in Delivery Edit page");
        $I->wait("1");
        $method = $I->grabTextFrom(DeliveryPage::ListMethodLine(1));
        $I->comment("Selected method is: $method");
        $I->click($method);
        $I->waitForText("Редактирование способа доставки: $method");

    }
}/*
        $I->executeJS("var container = document.createElement('input');
	container.id = 'length';
	container.value = document.getElementsByTagName(\"tbody\")[0].getElementsByTagName(\"tr\").length;
	document.body.insertBefore(container, document.body.firstChild)");
        $I->wait("3");
        $lines = $I->grabValueFrom('#length');
        $I->comment((string)$lines);
*/
>>>>>>> ef42d0598b50218c8224834e7b11c1baec589e2f
