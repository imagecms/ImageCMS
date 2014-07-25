<?php
use \AcceptanceTester;

class CreateCumulativeDiscountCest
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
    
    
    public function NamesAndValuesInCreate(AcceptanceTester $I)
    {
        $I->amOnPage("/admin/components/init_window/mod_discount/create");
        $I->click(DiscountsPage::$SelectTypeDiscount);
        $I->click(DiscountsPage::$SelectTypeDiscount.'/option[3]');
        $I->wait('1');
        $I->see('от', ".//*[@id='comulativBlock']/span[1]");
        $I->see('до', ".//*[@id='comulativBlock']/div/span[1]");
        $SymbCur3=$I->grabTextFrom(".//*[@id='comulativBlock']/div/span[3]");
        $I->see('Максимальный', DiscountsPage::$MaxCheckbox.'/..');
        $unchecked=$I->grabAttributeFrom(DiscountsPage::$MaxCheckbox.'/input', "checked");
        $I->comment("$unchecked");
        $I->assertEquals($unchecked, null);
    }
    
    
    public function RequiredFieldsInCreateSaveButton(AcceptanceTester $I)
    {
        $I->amOnPage("/admin/components/init_window/mod_discount/create");
        $I->click(DiscountsPage::$SelectTypeDiscount);
        $I->click(".//*[@id='selectDiscountType']/option[3]");
        $I->click(DiscountsPage::$SaveButton);
        $I->waitForElement(".//*[@id='createDiscountForm']/table/tbody/tr[2]/td/div/div/div[2]/div[2]/div[2]/label");        
        $I->see('Это поле обязательное.', ".//*[@id='createDiscountForm']/table/tbody/tr[2]/td/div/div/div[2]/div[2]/div[2]/label");
        $I->See('Это поле обязательное.', ".//*[@id='comulativBlock']/span[2]/label");
        $I->see('Это поле обязательное.', ".//*[@id='createDiscountForm']/table/tbody/tr[4]/td/div/div[2]/div[2]/div/span[1]/label/label");
        $I->click(DiscountsPage::$GoBackButton);        
        $I->waitForText("Скидки интернет-магазина");
    }
    
    
    public function RequiredFieldsInCreateSaveAndExitButton(AcceptanceTester $I)
    {
        $I->amOnPage("/admin/components/init_window/mod_discount/create");
        $I->click(DiscountsPage::$SelectTypeDiscount);
        $I->click(".//*[@id='selectDiscountType']/option[3]");
        $I->click(DiscountsPage::$SaveAndExitButton);
        $I->waitForElement(".//*[@id='createDiscountForm']/table/tbody/tr[2]/td/div/div/div[2]/div[2]/div[2]/label");        
        $I->see('Это поле обязательное.', ".//*[@id='createDiscountForm']/table/tbody/tr[2]/td/div/div/div[2]/div[2]/div[2]/label");
        $I->See('Это поле обязательное.', ".//*[@id='comulativBlock']/span[2]/label");
        $I->see('Это поле обязательное.', ".//*[@id='createDiscountForm']/table/tbody/tr[4]/td/div/div[2]/div[2]/div/span[1]/label/label");
        $I->click(DiscountsPage::$GoBackButton);        
        $I->waitForText("Скидки интернет-магазина");
    }
    
    
    public function TypesOfSymbolsInCreate(AcceptanceTester $I)
    {
        $I->amOnPage("/admin/components/init_window/mod_discount/create");        
        $I->click(DiscountsPage::$SelectTypeDiscount);
        $I->click(".//*[@id='selectDiscountType']/option[3]");
        $I->fillField(DiscountsPage::$BeginValue, 'qQ1!#@$#%^&*()_+|}{:>?<,./;][\\=-0пУ');
        $I->fillField(DiscountsPage::$EndValue, 'qQ1!#@$#%^&*()_+|}{:>?<,./;][\\=-0пУ');
        $begin=$I->grabValueFrom(DiscountsPage::$BeginValue);
        $I->assertEquals($begin, '10');
        $end=$I->grabValueFrom(DiscountsPage::$EndValue);
        $I->assertEquals($end, '10');
        $NotActCheckbox=$I->grabAttributeFrom(DiscountsPage::$MaxCheckbox, 'checked');
        $I->comment("$NotActCheckbox");
        $I->assertEquals($NotActCheckbox, null);        
    }
    
    
    public function OneSymbolsInCreate(AcceptanceTester $I)
    {
        $I->amOnPage("/admin/components/init_window/mod_discount/create");        
        $I->fillField(DiscountsPage::$NameDiscountCreate, 'OneSymbolsCumulativeDiscountLimitPercent');        
        $I->click(DiscountsPage::$UnlimitedCheckboxCreate);
        $I->fillField(DiscountsPage::$AmountOfUse, '3');
        $I->fillField(DiscountsPage::$ValueDiscount, '20');
        $I->click(DiscountsPage::$SelectTypeDiscount);
        $I->click(DiscountsPage::$SelectTypeDiscount.'/option[3]');
        $I->fillField(DiscountsPage::$BeginValue, '1');
        $I->fillField(DiscountsPage::$EndValue, '2');
        $I->click(DiscountsPage::$OnDateCreate);
        $I->click(".//*[@id='ui-datepicker-div']/table/tbody/tr[4]/td/a");        
        $date=$I->grabValueFrom(DiscountsPage::$OnDateCreate);
        $I->comment($date);
        $I->click(DiscountsPage::$SaveButton);
        $I->waitForText("Редактирование скидки");        
        $I->seeInField(DiscountsPage::$NameDiscountEdit, 'OneSymbolsCumulativeDiscountLimitPercent');
        $I->seeInField(DiscountsPage::$AmountOfUse, '3');
        $I->seeInField(DiscountsPage::$ValueDiscount, '20');
        $I->seeInField(DiscountsPage::$BeginValue, '1');
        $I->seeInField(DiscountsPage::$EndValue, '2');
        $I->seeInField(DiscountsPage::$OnDateEdit, "$date");
    }
    
    
    public function SymbolsInCreate(AcceptanceTester $I)
    {
        $I->amOnPage("/admin/components/init_window/mod_discount/create");        
        $I->fillField(DiscountsPage::$NameDiscountCreate, 'OneSymbolsCumulativeDiscountLimitPercent');        
        $I->click(DiscountsPage::$UnlimitedCheckboxCreate);
        $I->fillField(DiscountsPage::$AmountOfUse, '3');
        $I->fillField(DiscountsPage::$ValueDiscount, '20');
        $I->click(DiscountsPage::$SelectTypeDiscount);
        $I->click(DiscountsPage::$SelectTypeDiscount.'/option[3]');
        $I->fillField(DiscountsPage::$BeginValue, '1000');
        $I->fillField(DiscountsPage::$EndValue, '2000');
        $I->click(DiscountsPage::$OnDateCreate);
        $I->click(".//*[@id='ui-datepicker-div']/table/tbody/tr[4]/td/a");        
        $date=$I->grabValueFrom(DiscountsPage::$OnDateCreate);
        $I->comment($date);
        $I->click(DiscountsPage::$SaveButton);
        $I->waitForText("Редактирование скидки");        
        $I->seeInField(DiscountsPage::$NameDiscountEdit, 'OneSymbolsCumulativeDiscountLimitPercent');
        $I->seeInField(DiscountsPage::$AmountOfUse, '3');
        $I->seeInField(DiscountsPage::$ValueDiscount, '20');
        $I->seeInField(DiscountsPage::$BeginValue, '1000');
        $I->seeInField(DiscountsPage::$EndValue, '2000');
        $I->seeInField(DiscountsPage::$OnDateEdit, "$date");
    }
    
    
    
    
    
    
    
    
}