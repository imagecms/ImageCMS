<?php
use \PaymentTester;

class PaymentElementsCest
{

    /**
     * @group verify
     */
    public function authorization(PaymentTester $I)
    {
        InitTest::Login($I);
    }
    
    /**
     * @group verify
     */
    public function paymentListElements(PaymentTester $I) {
        $I->amOnPage(PaymentListPage::$URL);
        $I->see("Список способов оплаты", PaymentListPage::$Title);
        $I->seeElement(PaymentListPage::$HeadActiveText);
        $I->see('ID', PaymentListPage::$HeadIDText);
        $I->see('Способ', PaymentListPage::$HeadMethodText);
        $I->see('Название валюты', PaymentListPage::$HeadCurrencyNameText);
        $I->see('Обозначение валюты', PaymentListPage::$HeadCurrencySymbolText);
        $I->see('Активный', PaymentListPage::$HeadActiveText);
        $I->see('Создать способ оплаты', PaymentListPage::$ButtonCreate);
        $I->click(PaymentListPage::lineCheck(1));
        $I->see('Удалить', PaymentListPage::$ButtonDelete);
    }
    
    /**
     * @group verify
     */
    public function paymentDeleteWindow(PaymentTester $I) {
        $I->click(PaymentListPage::$HeadCheck);
        $I->click(PaymentListPage::$ButtonDelete);
        $I->waitForText('Удаление способов оплаты',NULL,PaymentListPage::$WindowDeleteTitle);
        $I->see('Удалить выбранные способы оплаты?', PaymentListPage::$WindowDeleteQuestion);
        $I->see('Удалить', PaymentListPage::$WindowDeleteButtonDelete);
        $I->see('Отменить', PaymentListPage::$WindowDeleteButtonCancel);
        $I->see('×',PaymentListPage::$WindowDeleteButtonClose);
        $I->click(PaymentListPage::$WindowDeleteButtonClose);
        $I->waitForElementNotVisible(PaymentListPage::$WindowDeleteTitle);
    }
    
    
    /**
     * @group verify
     */
    public function paymentCreateElements(PaymentTester $I) {
        $I->click(PaymentListPage::$ButtonCreate);
        $I->waitForText('Создание способа оплаты', NULL, PaymentCreatePage::$Title);
        $I->see('Создание способа оплаты', PaymentCreatePage::$TitleBlockCreate);
        $I->see('Вернуться',        PaymentCreatePage::$ButtonBack);
        $I->see('Создать',          PaymentCreatePage::$ButtonCreate);
        $I->see('Создать и выйти',  PaymentCreatePage::$ButtonCreateExit);
        $I->see('Название: *', PaymentCreatePage::$InputNameLabel);
        $I->seeElement(PaymentCreatePage::$InputName);
        $I->see('Валюта:', PaymentCreatePage::$SelectCurrencyLabel);
        $I->seeElement(PaymentCreatePage::$SelectCurrency);
        $I->see("Активный", PaymentCreatePage::$CheckActiveLabel);
        $I->seeElement(PaymentCreatePage::$CheckActive);
        $I->see('Описание:', PaymentCreatePage::$InputDescriptionLabel);
        $I->seeElement(PaymentCreatePage::$InputDescription);
        $I->see('Система оплаты:', PaymentCreatePage::$SelectPaymentSystemLabel);
        $I->seeElement(PaymentCreatePage::$SelectPaymentSystem);
        $I->click(PaymentCreatePage::$ButtonBack);
        $I->waitForText("Список способов оплаты",NULL, PaymentListPage::$Title);
    }
    
    /**
     * @group verify
     */
    public function PaymentEditElements(PaymentTester $I) {
        $I->click(PaymentListPage::lineMethodLink(1));
        $I->waitForText('Редактирование способа оплаты', NULL, PaymentEditPage::$Title);
        $I->see('Редактирование способа оплаты', PaymentEditPage::$TitleBlockEdit);
        $I->see('Вернуться',        PaymentEditPage::$ButtonBack);
        $I->see('Сохранить',          PaymentEditPage::$ButtonSave);
        $I->see('Сохранить и выйти',  PaymentEditPage::$ButtonSaveExit);
        $I->see('Название: *', PaymentEditPage::$InputNameLabel);
        $I->seeElement(PaymentEditPage::$InputName);
        $I->see('Валюта:', PaymentEditPage::$SelectCurrencyLabel);
        $I->seeElement(PaymentEditPage::$SelectCurrency);
        $I->see("Активный", PaymentEditPage::$CheckActiveLabel);
        $I->seeElement(PaymentEditPage::$CheckActive);
        $I->see('Описание:', PaymentEditPage::$InputDescriptionLabel);
        $I->seeElement(PaymentEditPage::$InputDescription);
        $I->see('Система оплаты:', PaymentEditPage::$SelectPaymentSystemLabel);
        $I->seeElement(PaymentEditPage::$SelectPaymentSystem);
        $I->click(PaymentEditPage::$ButtonBack);
        $I->waitForText("Список способов оплаты",NULL, PaymentListPage::$Title);        
    }
}