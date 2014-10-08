<?php 
use \DeliveryTester;

class DeliveryVerifyElementsCest {
    
    /**
     * Login & go to page DeliveryList
     * @group verify
     * @group current
     * @guy DeliveryTester\DeliverySteps
     */
    public function Authorization(DeliveryTester\DeliverySteps $I){
        InitTest::login($I);
        $I->click(GeneralPage::$Settings);
        $I->click(GeneralPage::$SettingsDelivery);
        $I->waitForText("Список способов доставки");
    }
    
    /**
     * Verify all elements on list landing page
     * @group verify
     */
    public function DeliveryListElements(DeliveryTester $I)
    {
        $I->wantTo("Verify all elements in Delivery list landing page");
        $I->see("Список способов доставки",  DeliveryListPage::$Title);
        $I->see("Создать способ доставки", DeliveryListPage::$ButtonCreate);
        $I->seeElement(DeliveryListPage::$HeadCheck);
        $I->see("ID", DeliveryListPage::$HeadIDText);
        $I->see("Способ", DeliveryListPage::$HeadMethodText);
        $I->see("Цена", DeliveryListPage::$HeadPriceText);
        $I->see("Бесплатен от", DeliveryListPage::$HeadFreeFromText);
        $I->see("Активный", DeliveryListPage::$HeadActiveText);
        $I->click(DeliveryListPage::lineCheck(1));
        $I->see("Удалить",  DeliveryListPage::$ButtonDelete);
        
    }
    
    /**
     * Verify all elements in delete window 
     * @group verify
     */
    public function DeliveryDeleteWindow (DeliveryTester $I){
        $I->click(DeliveryListPage::$HeadCheck);
        $I->click(DeliveryListPage::$ButtonDelete);
        $I->waitForText("Удаление способов доставки", "30", DeliveryListPage::$WindowDeleteTitle);//  "//*[@id='mainContent']/div/div[1]/div[1]/h3");
        $I->seeElement(DeliveryListPage::$WindowDelete);
        $I->see("Удалить", DeliveryListPage::$WindowDeleteButtonDelete);
        $I->see("Отменить", DeliveryListPage::$WindowDeleteButtonCancel);
        $I->seeElement(DeliveryListPage::$WindowDeleteButtonClose);
        $I->click(DeliverylistPage::$WindowDeleteButtonClose);
    }
    
    /**
     * Verify all elements in Delivery create page
     * @group verify
     */
    public function DeliveryCreateElements(DeliveryTester $I)
    {
        $I->wantTo("Verify all elements in Delivery Create page");
        //InitTest::ClearAllCach($I);
        $I->wait('1');
        $I->click(DeliveryListPage::$ButtonCreate);
        $I->waitForText("Создание способа доставки",'30',  DeliveryCreatePage::$Title);
        $I->see("Создание способа доставки",DeliveryCreatePage::$Title);
        $I->see("Создание способа доставки", DeliveryCreatePage::$TitleBlockCreate);
        $I->see("Название: *", DeliveryCreatePage::$InputNameLabel);
        $I->see("Описание",  DeliveryCreatePage::$InputDescriptionLabel);
        $I->see("Описание цены доставки", DeliveryCreatePage::$InputDescriptionPriceLabel);
        $I->see("Цена доставки",DeliveryCreatePage::$InputPriceLabel);
        $I->see("Бесплатен от", DeliveryCreatePage::$InputFreeFromLabel);
        $I->see("Цена уточняется", DeliveryCreatePage::$CheckPriceSpecifiedLabel);
        $I->click(DeliveryCreatePage::$CheckPriceSpecified);
        $I->waitForElementVisible(DeliveryCreatePage::$InputPriceSpecified);
        $I->see("Сообщение про уточнение цены:",  DeliveryCreatePage::$InputPriceSpecifiedLabel);
        $I->see("Создать и выйти",DeliveryCreatePage::$ButtonCreateExit);
        $I->see("Создать",DeliveryCreatePage::$ButtonCreate);
        $I->see("Вернуться",DeliveryCreatePage::$ButtonBack);
        $I->click(DeliveryCreatePage::$ButtonBack);
        $I->waitForText("Список способов доставки");
    }
    
    /**
     * @group verify
     * @group current
     */    
    public function DeliveryEditElements(DeliveryTester $I)
    {
        $I->wantTo("Verifyy all elements in Delivery Edit page");
        $I->wait("1");
        $method = $I->grabTextFrom(DeliveryListPage::lineMethodLink(1));
        $I->comment("Selected method is: $method");
        $I->click($method);
        $I->waitForText("Редактирование способа доставки: $method");
        $I->see("Редактирование способа доставки: $method", DeliveryEditPage::$Title);// '.title');
        $I->see("Редактирование способа доставки",  DeliveryEditPage::$TitleBlockEdit);
        $I->see("Название: *", DeliveryEditPage::$InputNameLabel);
        $I->see("Описание", DeliveryEditPage::$InputDescriptionLabel);
        $I->see("Описание цены доставки", DeliveryEditPage::$InputDescriptionPriceLabel);
        $I->See("Цена:",DeliveryEditPage::$InputPriceLabel);
        $I->see("Бесплатен от", DeliveryEditPage::$InputFreeFromLabel);
        $I->see("Цена уточняется", DeliveryEditPage::$CheckPriceSpecifiedLabel);
        if($I->grabAttributeFrom(DeliveryEditPage::$CheckPriceSpecified.'/..', 'class')== 'frame_label no_connection'){
            $I->click(DeliveryEditPage::$CheckPriceSpecified);
        }
        
        $I->waitForElement(DeliveryCreatePage::$InputPriceSpecified);           
        $I->see("Сообщение про уточнение цены:",  DeliveryEditPage::$InputPriceSpecifiedLabel);
        $I->see("Сохранить и выйти",DeliveryEditPage::$ButtonSaveExit);
        $I->see("Сохранить",DeliveryEditPage::$ButtonSave);
        $I->see("Вернуться",DeliveryEditPage::$ButtonBack);
        $I->click(DeliveryEditPage::$ButtonBack);
        $I->waitForText("Список способов доставки");

    }
    /**
     * @group verify
     * @group current
     */
    public function logout(DeliveryTester $I) {
        InitTest::Loguot($I);
    }
}
