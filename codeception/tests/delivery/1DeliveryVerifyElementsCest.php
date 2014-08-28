<?php 
use \DeliveryTester;

class DeliveryVerifyElementsCest {
    
    /**
     * @group verify
     * @guy DeliveryTester\DeliverySteps
     */
    public function Authorization(DeliveryTester\DeliverySteps $I){
        //Login & go to page DeliveryList
        InitTest::login($I);
        $I->click(NavigationBarPage::$Settings);
        $I->click(NavigationBarPage::$SettingsDelivery);
        $I->waitForText("Список способов доставки");
    }
    
    /**
     * @group verify
     */
    public function DeliveryListElements(DeliveryTester $I)
    {
        $I->wantTo("Verify all elements in Delivery list landing page");
        $I->see("Список способов доставки","span.title");
        $I->see("Создать способ доставки",  DeliveryPage::$CreateButton);
        $I->see("Удалить",DeliveryPage::$DeleteButton);
        $I->seeElement(DeliveryPage::$CheckboxHeader);
        $I->see("ID", DeliveryPage::$IDHeader);
        $I->see("Способ", DeliveryPage::$MethodHEader);
        $I->see("Цена", DeliveryPage::$PriceHeader);
        $I->see("Бесплатен от",  DeliveryPage::$FreeFromHeader);
        $I->see("Активный", DeliveryPage::$ActiveButton);
        
    }
    
    /**
     * @group verify
     */
    public function DeliveryDeleteWindow (DeliveryTester $I){
        $I->click(DeliveryPage::$CheckboxHeader);
        $I->click(DeliveryPage::$DeleteButton);
        $I->waitForText("Удаление способов доставки", "30", "//*[@id='mainContent']/div/div[1]/div[1]/h3");
        $I->seeElement(DeliveryPage::$Deletewindow);
        $I->see("Удалить", DeliveryPage::$DeleteWindowDelete);
        $I->see("Отменить", DeliveryPage::$DeleteWindowBack);
        $I->seeElement(DeliveryPage::$DeleteWindowX);
        $I->click(DeliveryPage::$DeleteWindowX);
    }
    
    /**
     * @group verify
     */
    public function DeliveryCreateElements(DeliveryTester $I)
    {
        $I->wantTo("Verifyy all elements in Delivery Create page");
        //InitTest::ClearAllCach($I);
        $I->wait('1');
        $I->click(DeliveryPage::$CreateButton);
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
     *@group verify
     */    
    public function DeliveryEditElements(DeliveryTester $I)
    {
        $I->wantTo("Verifyy all elements in Delivery Edit page");
        $I->wait("1");
        $method = $I->grabTextFrom(DeliveryPage::ListMethodLine(1));
        $I->comment("Selected method is: $method");
        $I->click($method);
        $I->waitForText("Редактирование способа доставки: $method");
        $I->see("Редактирование способа доставки: $method",'.title');
        $I->see("Редактирование способа доставки","//thead/tr/th");
        $I->see("Название: *", DeliveryEditPage::$FieldNameLabel);
        $I->see("Описание", DeliveryEditPage::$FieldDescriptionLabel);
        $I->see("Описание цены доставки", DeliveryEditPage::$FieldDescriptionPriceLabel);
        $I->See("Цена:",DeliveryEditPage::$FieldPriceLabel);
        $I->see("Бесплатен от", DeliveryEditPage::$FieldFreeFromLabel);
        $I->see("Цена уточняется", DeliveryEditPage::$CheckboxPriceSpecifiedLabel);
        if($I->grabAttributeFrom(DeliveryEditPage::$CheckboxPriceSpecified.'/..', 'class')== 'frame_label no_connection'){
            $I->click(DeliveryEditPage::$CheckboxPriceSpecified);
        }
        
        $I->waitForElement(DeliveryCreatePage::$FieldPriceSpecified);           //________________________________replace(was Wait for element visible) for QA_server
        $I->see("Сообщение про уточнение цены:",  DeliveryEditPage::$FieldPriceSpecifiedLabel);
        $I->see("Сохранить и выйти",DeliveryEditPage::$ButtonSaveExit);
        $I->see("Сохранить",DeliveryEditPage::$ButtonSave);
        $I->see("Вернуться",DeliveryEditPage::$ButtonBack);
        $I->click(DeliveryEditPage::$ButtonBack);
        $I->waitForText("Список способов доставки");

    }
    /**
     * @group verify
     */
    public function logout(DeliveryTester $I) {
        InitTest::Loguot($I);
    }
}
