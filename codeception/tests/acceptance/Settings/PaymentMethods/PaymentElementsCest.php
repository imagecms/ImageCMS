<?php
use \AcceptanceTester;

class PaymentElementsCest
{

    /**
     * @group current
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
     * @group current
     */
    public function PaymentCreateElements(AcceptanceTester $I) {
        $I->click(PaymentListPage::$ButtonCreate);
        $I->waitForText("Создание способа оплаты", NULL, PaymentCreatePage::$Title);
        $I->see("Создание способа оплаты", PaymentCreatePage::$TitleHead);
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
    }
    
    /**
     * @group current
     */
    public function PaymentEditElements(AcceptanceTester $I) {
        
    }
}