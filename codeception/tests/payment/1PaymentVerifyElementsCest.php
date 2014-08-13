<?php
use \PaymentTester;

class PaymentElementsCest
{

    /**
     * @group verify
     */
    public function Authorization(PaymentTester $I)
    {
        InitTest::Login($I);
    }
    
    /**
     * @group verify
     */
    public function PaymentListElements(PaymentTester $I) {
        $I->amOnPage(PaymentListPage::$URL);
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
    public function PaymentDeleteWindow(PaymentTester $I) {
        $I->click(PaymentListPage::$CheckboxHeader);
        $I->click(PaymentListPage::$ButtonDelete);
        $I->waitForText('Удаление способов оплаты',NULL,PaymentListPage::$DeleteWindowTitle);
        $I->see('Удалить выбранные способы оплаты?', PaymentListPage::$DeleteWindowQuestion);
        $I->see('Удалить', PaymentListPage::$DeleteWindowButtonDelete);
        $I->see('Отменить', PaymentListPage::$DeleteWindowButtonBack);
        $I->see('×',PaymentListPage::$DeleteWindowButtonXClose);
        $I->click(PaymentListPage::$DeleteWindowButtonXClose);
        $I->waitForElementNotVisible(PaymentListPage::$DeleteWindowTitle);
    }
    
    /**
     * @group verify
     */
    public function miniMessageEdit(PaymentTester $I) {
        $I->moveMouseOver(PaymentListPage::MethodNameLine(1));
        $I->waitForElementVisible('.tooltip.fade.top.in');
        $I->see("Редактировать",'.tooltip.fade.top.in');
        $I->moveMouseOver('//tbody//tr[3]//td');
        $I->waitForElementNotVisible('.tooltip.fade.top.in');
    }
    
    /**
     * @group verify
     */
    public function miniMessagesActive(PaymentTester $I) {
        $Class = $I->grabAttributeFrom(PaymentListPage::ActiveLine(1), 'class');
        $I->comment($Class);
        //BUG HERE------------------------------------------------------------------------------------------
//        $I->click(PaymentListPage::ActiveLine(1));                                //BUG HERE inscription ACTIVE
        //--------------------------------------------------------------------------------------------------
        $I->wait(1);
        $I->moveMouseOver(PaymentListPage::ActiveLine(1));
        $I->waitForElementVisible('.tooltip-inner');
        if ($Class == 'prod-on_off')
            $I->see ('показать', '.tooltip-inner');
        else {
            $I->see ('не показывать', '.tooltip-inner');
        }
        
        
        
        $I->click(PaymentListPage::ActiveLine(1));
        $I->moveMouseOver('//tbody//tr[3]');
        $Class = $I->grabAttributeFrom(PaymentListPage::ActiveLine(1), 'class');
        $I->comment($Class);
        $I->moveMouseOver(PaymentListPage::ActiveLine(1));
        if ($Class == 'prod-on_off')
            $I->see ('показать', '.tooltip-inner');
        else {
            $I->see ('не показывать', '.tooltip-inner');
        }
        
    }
    
    
    /**
     * @group verify
     */
    public function PaymentCreateElements(PaymentTester $I) {
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
    public function PaymentEditElements(PaymentTester $I) {
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