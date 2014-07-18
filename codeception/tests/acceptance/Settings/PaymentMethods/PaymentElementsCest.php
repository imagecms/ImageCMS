<?php
use \AcceptanceTester;

class PaymentElementsCest
{

    /**
     * @group verify
     */
    public function Authorization(AcceptanceTester $I)
    {
        InitTest::Login($I);
        $I->amOnPage(PaymentListPage::$URL);
    }
    
    /**
     * @group verify
     */
    public function PaymentListElements(AcceptanceTester $I) {
        $I->see("Список способов оплаты", PaymentListPage::$Title);
        $I->seeElement(PaymentListPage::$ActiveHeader);
        $I->see('ID', PaymentListPage::$IDHeader);
        $I->see('Способ', PaymentListPage::$MethodNameHeader);
        $I->see('Название валюты', PaymentListPage::$CurrencyNameHeader);
        $I->see('Обозначение валюты', PaymentListPage::$CurrencySymbolHeader);
        $I->see('Активный', PaymentListPage::$ActiveHeader);
        $I->see('Создать способ оплаты', PaymentListPage::$ButtonCreate);
        $I->see('Удалить', PaymentListPage::$ButtonDelete);
    }
    
    /**
     * @group verify
     */
    public function PaymentDeleteWindow(AcceptanceTester $I) {
        $I->click(PaymentListPage::$CheckboxHeader);
        $I->click(PaymentListPage::$ButtonDelete);
        $I->waitForText('Удаление способов оплаты',NULL,PaymentListPage::$DeleteWindowTitle);
        $I->see('Удалить выбранные способы оплаты?', PaymentListPage::$DeleteWindowQuestion);
        $I->see('Удалить', PaymentListPage::$DeleteWindowButtonDelete);
        $I->see('Отменить', PaymentListPage::$DeleteWindowButtonBack);
        $I->see('×',PaymentListPage::$DeleteWindowButtonXClose);
        $I->click(PaymentListPage::$DeleteWindowButtonXClose);
    }
    
    /**
     * @group verify
     */
    public function PaymentCreateElements(AcceptanceTester $I) {
        $I->click(PaymentListPage::$ButtonCreate);
        $I->waitForText('Создание способа оплаты', NULL, PaymentCreatePage::$Title);
        $I->see('Создание способа оплаты', PaymentCreatePage::$TitleHead);
        $I->see('Вернуться',        PaymentCreatePage::$ButtonBack);
        $I->see('Создать',          PaymentCreatePage::$ButtonCreate);
        $I->see('Создать и выйти',  PaymentCreatePage::$ButtonCreateExit);
        $I->see('Название: *', PaymentCreatePage::$LabelName);
        $I->seeElement(PaymentCreatePage::$FieldName);
        $I->see('Валюта:', PaymentCreatePage::$LabelCurrency);
        $I->seeElement(PaymentCreatePage::$SelectCurrency);
        $I->see("Активный", PaymentCreatePage::$LabelActive);
        $I->seeElement(PaymentCreatePage::$CheckboxActive);
        $I->see('Описание:', PaymentCreatePage::$LableDescription);
        $I->seeElement(PaymentCreatePage::$FieldDescription);
        $I->see('Система оплаты:', PaymentCreatePage::$LabelPaymentSystem);
        $I->seeElement(PaymentCreatePage::$SelectPaymentSystem);
        $I->click(PaymentCreatePage::$ButtonBack);
        $I->waitForText("Список способов оплаты",NULL, PaymentListPage::$Title);
    }
    
    /**
     * @group verify
     */
    public function PaymentEditElements(AcceptanceTester $I) {
        $I->click("//tbody//tr[1]//a");
        $I->waitForText('Редактирование способа оплаты', NULL, PaymentEditPage::$Title);
        $I->see('Редактирование способа оплаты', PaymentEditPage::$TitleHead);
        $I->see('Вернуться',        PaymentEditPage::$ButtonBack);
        $I->see('Сохранить',          PaymentEditPage::$ButtonSave);
        $I->see('Сохранить и выйти',  PaymentEditPage::$ButtonSaveExit);
        $I->see('Название: *', PaymentEditPage::$NameLabel);
        $I->seeElement(PaymentEditPage::$FieldName);
        $I->see('Валюта:', PaymentEditPage::$CurrencyLabel);
        $I->seeElement(PaymentEditPage::$SelectCurrency);
        $I->see("Активный", PaymentEditPage::$Activelabel);
        $I->seeElement(PaymentEditPage::$CheckboxActive);
        $I->see('Описание:', PaymentEditPage::$DescriptionLable);
        $I->seeElement(PaymentEditPage::$FieldDescription);
        $I->see('Система оплаты:', PaymentEditPage::$PaymentSystemLabel);
        $I->seeElement(PaymentEditPage::$SelectPaymentSystem);
        $I->click(PaymentEditPage::$ButtonBack);
        $I->waitForText("Список способов оплаты",NULL, PaymentListPage::$Title);        
        
    }
}