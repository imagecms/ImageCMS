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
        //table header elements
        $I->seeElement(PaymentListPage::$ActiveHeader);
        $I->see('ID', PaymentListPage::$IDHeader);
        $I->see('Способ', PaymentListPage::$MethodNameHeader);
        $I->see('Название валюты', PaymentListPage::$CurrencyNameHeader);
        $I->see('Обозначение валюты', PaymentListPage::$CurrencySymbolHeader);
        $I->see('Активный', PaymentListPage::$ActiveHeader);
        //buttons
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
    }
    
    /**
     * @group current
     */
    public function PaymentCreateElements(AcceptanceTester $I) {
        
    }
    
    /**
     * @group current
     */
    public function PaymentEditElements(AcceptanceTester $I) {
        
    }
}