<?php
use \AcceptanceTester;

class CreateGiftSertificateCest
{
//    public function _before()
//    {
//    }
//
//    public function _after()
//    {
//    }

    public function Autorization(AcceptanceTester $I)
    {
        InitTest::Login($I);
        $I->amOnPage("/admin/components/cp/mod_discount");
        $I->waitForText("Скидки интернет-магазина");
    }
    
    
    public function GiftFixMethodInCreate(AcceptanceTester $I)
    {
        $I->amOnPage("/admin/components/init_window/mod_discount/create");        
        $I->fillField(DiscountsPage::$NameDiscountCreate, 'GiftFixDiscount');       
        $I->click(DiscountsPage::$SelectMethod);
        $I->click(DiscountsPage::$SelectMethod.'/option[2]');
        $I->fillField(DiscountsPage::$ValueDiscount, '200');
        $I->click(DiscountsPage::$SelectTypeDiscount);
        $I->click(DiscountsPage::$SelectTypeDiscount.'/option[2]');
        $I->click(DiscountsPage::$GiftSertificateCheckbox);
        $disabledCheckbox=$I->grabAttributeFrom(DiscountsPage::$UnlimitedCheckboxCreate.'/..', "style");
        $I->comment($disabledCheckbox);
        $I->assertEquals($disabledCheckbox, "display: none;");
        $I->seeInField(DiscountsPage::$AmountOfUse, '1');
        $I->click(DiscountsPage::$OnDateCreate);
        $I->click(".//*[@id='ui-datepicker-div']/table/tbody/tr[4]/td/a");        
        $date=$I->grabValueFrom(DiscountsPage::$OnDateCreate);
        $I->comment($date);
        $I->click(DiscountsPage::$SaveButton);
        $I->waitForText("Редактирование скидки");        
        $I->seeInField(DiscountsPage::$NameDiscountEdit, 'GiftFixDiscount');        
        $I->seeInField(DiscountsPage::$ValueDiscount, '200');
        $I->seeOptionIsSelected(DiscountsPage::$SelectMethod, 'Фиксированный');
        $I->seeInField(DiscountsPage::$OnDateEdit, "$date");
        $disabledCheckboxEdit=$I->grabAttributeFrom(DiscountsPage::$UnlimitedCheckboxEdit.'/..', "style");
        $I->comment($disabledCheckboxEdit);
        $I->assertEquals($disabledCheckbox, "display: none;");
        $I->seeInField(DiscountsPage::$AmountOfUse, '1');
        $keyDisc=$I->grabValueFrom(DiscountsPage::$DiscountKey);
        $I->comment($keyDisc);        
        $I->click(DiscountsPage::$GoBackButton);
        $I->waitForText('Скидки интернет-магазина');
        $I->see($keyDisc, DiscountsPage::DisKeyLine('1'));
        $I->see('GiftFixDiscount', DiscountsPage::NameLine('1'));
        $I->see('1', DiscountsPage::LimitLine('1'));
        $I->see('-', DiscountsPage::UseDiscLine('1'));
        $I->see($date, DiscountsPage::BeginTimeLine('1'));
        $I->see('-', DiscountsPage::EndTimeLine('1'));
        $activeDisc=$I->grabAttributeFrom(DiscountsPage::ActiveButtonLine('1'), 'class');
        $I->comment($activeDisc);
        $I->assertEquals($activeDisc, 'prod-on_off');
    }
    
    
    public function GiftPercentMethodInCreate(AcceptanceTester $I)
    {
        $I->amOnPage("/admin/components/init_window/mod_discount/create");        
        $I->fillField(DiscountsPage::$NameDiscountCreate, 'GiftPercentDiscount');        
        $I->fillField(DiscountsPage::$ValueDiscount, '10');
        $I->click(DiscountsPage::$SelectTypeDiscount);
        $I->click(DiscountsPage::$SelectTypeDiscount.'/option[2]');
        $I->click(DiscountsPage::$GiftSertificateCheckbox);
        $disabledCheckbox=$I->grabAttributeFrom(DiscountsPage::$UnlimitedCheckboxCreate.'/..', "style");
        $I->comment($disabledCheckbox);
        $I->assertEquals($disabledCheckbox, "display: none;");
        $I->seeInField(DiscountsPage::$AmountOfUse, '1');
        $I->click(DiscountsPage::$OnDateCreate);
        $I->click(".//*[@id='ui-datepicker-div']/table/tbody/tr[4]/td/a");        
        $date=$I->grabValueFrom(DiscountsPage::$OnDateCreate);
        $I->comment($date);
        $I->click(DiscountsPage::$SaveButton);
        $I->waitForText("Редактирование скидки");        
        $I->seeInField(DiscountsPage::$NameDiscountEdit, 'GiftPercentDiscount');        
        $I->seeInField(DiscountsPage::$ValueDiscount, '10');
        $I->seeOptionIsSelected(DiscountsPage::$SelectMethod, 'Проценты');
        $I->seeInField(DiscountsPage::$OnDateEdit, "$date");
        $disabledCheckboxEdit=$I->grabAttributeFrom(DiscountsPage::$UnlimitedCheckboxEdit.'/..', "style");
        $I->comment($disabledCheckboxEdit);
        $I->assertEquals($disabledCheckbox, "display: none;");
        $I->seeInField(DiscountsPage::$AmountOfUse, '1');
        $keyDisc=$I->grabValueFrom(DiscountsPage::$DiscountKey);
        $I->comment($keyDisc);        
        $I->click(DiscountsPage::$GoBackButton);
        $I->waitForText('Скидки интернет-магазина');
        $I->see($keyDisc, DiscountsPage::DisKeyLine('1'));
        $I->see('GiftPercentDiscount', DiscountsPage::NameLine('1'));
        $I->see('1', DiscountsPage::LimitLine('1'));
        $I->see('-', DiscountsPage::UseDiscLine('1'));
        $I->see($date, DiscountsPage::BeginTimeLine('1'));
        $I->see('-', DiscountsPage::EndTimeLine('1'));
        $activeDisc=$I->grabAttributeFrom(DiscountsPage::ActiveButtonLine('1'), 'class');
        $I->comment($activeDisc);
        $I->assertEquals($activeDisc, 'prod-on_off');
    }
    
    
    
}