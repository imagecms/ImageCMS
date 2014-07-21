<?php
use \AcceptanceTester;

class CreateAllOrderDiscountCest
{
//    public function _before()
//    {
//    }
//
//    public function _after()
//    {
//    }

    // tests
    public function Autorization(AcceptanceTester $I)
    {
        InitTest::Login($I);
        $I->amOnPage("/admin/components/cp/mod_discount");
        $I->waitForText("Скидки интернет-магазина");
    }
    
    
    public function RequiredFieldsInCreateSaveButton(AcceptanceTester $I)
    {
        $I->amOnPage("/admin");
        $I->click('html/body/div[1]/div[3]/div/nav/ul/li[6]/a');
        $I->waitForElement('html/body/div[1]/div[3]/div/nav/ul/li[6]/ul');
        $I->click('html/body/div[1]/div[3]/div/nav/ul/li[6]/ul/li[last()]/a');
        $I->waitForElementNotVisible('html/body/div[1]/div[3]/div/nav/ul/li[6]/ul');
        $I->waitForText('Все модули');
        $rows=$I->grabClassCount($I, "niceCheck");
        $I->comment("$rows");
        for ($j=1; $j<=$rows; $j++){
            $nameModule=$I->grabTextFrom(".//*[@id='modules']/div/table/tbody/tr[$j]/td[2]/a");
            $I->comment("$nameModule");
            
            if ($nameModule=="Скидки интернет-магазина"){
                break;
            }
        }
        $I->click(".//*[@id='modules']/div/table/tbody/tr[$j]/td[2]/a");
        $I->waitForText("Создать скидку");
        $I->click(DiscountsPage::$CreateDiscount);
        $I->waitForText("Создание скидки");
        $I->click(DiscountsPage::$SaveButton);
        $I->waitForElement(".//*[@id='createDiscountForm']/table/tbody/tr[2]/td/div/div/div[2]/div[2]/div[2]/label");
        $I->see('Это поле обязательное.', ".//*[@id='createDiscountForm']/table/tbody/tr[2]/td/div/div/div[2]/div[2]/div[2]/label");
        $I->see('Это поле обязательное.', ".//*[@id='createDiscountForm']/table/tbody/tr[3]/td/div/div/div[2]/div[2]/label");
        $I->see('Это поле обязательное.', ".//*[@id='createDiscountForm']/table/tbody/tr[4]/td/div/div[2]/div[2]/div/span[1]/label/label");
        $I->click(DiscountsPage::$SelectTypeDiscount);
        $I->click(".//*[@id='selectDiscountType']/option[2]");
        $I->click(DiscountsPage::$SaveButton);
        $I->see('Это поле обязательное.', ".//*[@id='createDiscountForm']/table/tbody/tr[2]/td/div/div/div[2]/div[2]/div[2]/label");
        $I->dontSee('Это поле обязательное.', ".//*[@id='createDiscountForm']/table/tbody/tr[3]/td/div/div/div[2]/div[2]/label");
        $I->see('Это поле обязательное.', ".//*[@id='createDiscountForm']/table/tbody/tr[4]/td/div/div[2]/div[2]/div/span[1]/label/label");
        $I->click(DiscountsPage::$GoBackButton);        
        $I->waitForText("Скидки интернет-магазина");
    }
    
    
    public function RequiredFieldsInCreateSaveAndExitButton(AcceptanceTester $I)
    {
        $I->amOnPage("/admin/components/init_window/mod_discount/create");        
        $I->click(DiscountsPage::$SaveAndExitButton);
        $I->waitForElement(".//*[@id='createDiscountForm']/table/tbody/tr[2]/td/div/div/div[2]/div[2]/div[2]/label");
        $I->see('Это поле обязательное.', ".//*[@id='createDiscountForm']/table/tbody/tr[2]/td/div/div/div[2]/div[2]/div[2]/label");
        $I->see('Это поле обязательное.', ".//*[@id='createDiscountForm']/table/tbody/tr[3]/td/div/div/div[2]/div[2]/label");
        $I->see('Это поле обязательное.', ".//*[@id='createDiscountForm']/table/tbody/tr[4]/td/div/div[2]/div[2]/div/span[1]/label/label");
        $I->click(DiscountsPage::$SelectTypeDiscount);
        $I->click(".//*[@id='selectDiscountType']/option[2]");
        $I->click(DiscountsPage::$SaveAndExitButton);
        $I->see('Это поле обязательное.', ".//*[@id='createDiscountForm']/table/tbody/tr[2]/td/div/div/div[2]/div[2]/div[2]/label");
        $I->dontSee('Это поле обязательное.', ".//*[@id='createDiscountForm']/table/tbody/tr[3]/td/div/div/div[2]/div[2]/label");
        $I->see('Это поле обязательное.', ".//*[@id='createDiscountForm']/table/tbody/tr[4]/td/div/div[2]/div[2]/div/span[1]/label/label");
        $I->click(DiscountsPage::$GoBackButton);        
        $I->waitForText("Скидки интернет-магазина");
    }
    
    
    public function TypesOfSymbolsInCreate(AcceptanceTester $I)
    {
        $I->amOnPage("/admin/components/init_window/mod_discount/create");        
        $I->fillField(DiscountsPage::$NameDiscountCreate, 'qwerrQEQE12345!#@$#%%^&*()_+|}{:>?<,./;][\\=-0ёцвцаымпУКП');
        $readOnlyField=$I->grabAttributeFrom(DiscountsPage::$DiscountKey, 'readonly');
        $I->comment("$readOnlyField");
        $I->assertEquals($readOnlyField, "true");
        $disabledField=$I->grabAttributeFrom(DiscountsPage::$AmountOfUse, 'disabled');
        $I->comment("$disabledField");
        $I->assertEquals($disabledField, "true");
        $ActiveCheckbox=$I->grabAttributeFrom(DiscountsPage::$UnlimitedCheckboxCreate, "checked");
        $I->comment("$ActiveCheckbox");
        $I->assertEquals($ActiveCheckbox, "true");
        $I->click(".//*[@id='createDiscountForm']/table/tbody/tr[1]/td/div/div/div[2]/div[2]/span[2]/span/span");
        $I->fillField(DiscountsPage::$AmountOfUse, 'qQ1!#@$#%^&*()_+|}{:>?<,./;][\\=-0пУ');
        $I->fillField(DiscountsPage::$ValueDiscount, 'qQ1!#@$#%^&*()_+|}{:>?<,./;][\\=-0пУ');
        $I->click(DiscountsPage::$SelectTypeDiscount);
        $I->click(".//*[@id='selectDiscountType']/option[2]");
        $I->fillField(DiscountsPage::$BeginValueDiscount, 'qQ1!#@$#%^&*()_+|}{:>?<,./;][\\=-0пУ');
        $NotActCheckbox=$I->grabAttributeFrom(DiscountsPage::$OnlyForAutorizedCheckbox, 'checked');
        $I->comment("$NotActCheckbox");
        $I->assertEquals($NotActCheckbox, null);
        $NotActGiftCheckbox=$I->grabAttributeFrom(DiscountsPage::$GiftSertificateCheckbox, 'checked');
        $I->comment("$NotActGiftCheckbox");
        $I->assertEquals($NotActGiftCheckbox, null);
        $I->fillField(DiscountsPage::$OnDateCreate, 'qQ1!#@$#%^&*()_+|}{:>?<,./;][\\=-0пУ');
        $ActCheckbox=$I->grabAttributeFrom(DiscountsPage::$ConstantDiscountCheckboxCreate, 'checked');
        $I->comment("$ActCheckbox");
        $I->assertEquals($ActCheckbox, "true");
        $disField=$I->grabAttributeFrom(DiscountsPage::$UntilDateCreate, 'disabled');
        $I->comment("$disField");
        $I->assertEquals($disField, "true");
        $I->click(".//*[@id='createDiscountForm']/table/tbody/tr[4]/td/div/div[2]/div[2]/div/span[3]/div/div/span/span");
        $I->fillField(DiscountsPage::$UntilDateCreate, 'qQ1!#@$#%^&*()_+|}{:>?<,./;][\\=-0пУ');
        $I->click(".//*[@id='createDiscountForm']/table/tbody/tr[4]/td/div/div[2]/div[2]/div/span[3]/div/div/span/span");
        $I->wait('5');
        $I->seeInField('qwerrQEQE12345!#@$#%%^&*()_+|}{:>?<,./;][\\=-0ёцвцаымпУКП', DiscountsPage::$NameDiscountCreate);
        $I->seeInField('', DiscountsPage::$DiscountKey);
        $I->seeInField('10', DiscountsPage::$AmountOfUse);
        $I->seeInField('10', DiscountsPage::$ValueDiscount);
        $I->seeInField('10', DiscountsPage::$BeginValueDiscount);
        $I->seeInField('', DiscountsPage::$OnDateCreate);
        $I->seeInField('', DiscountsPage::$UntilDateCreate);
    }
    
    
    public function OneSymbolsInCreate(AcceptanceTester $I)
    {
        $I->amOnPage("/admin/components/init_window/mod_discount/create");        
        $I->fillField(DiscountsPage::$NameDiscountCreate, 'q');        
        $I->click(".//*[@id='createDiscountForm']/table/tbody/tr[1]/td/div/div/div[2]/div[2]/span[2]/span/span");
        $I->fillField(DiscountsPage::$AmountOfUse, '1');
        $I->fillField(DiscountsPage::$ValueDiscount, '2');
        $I->click(DiscountsPage::$SelectTypeDiscount);
        $I->click(".//*[@id='selectDiscountType']/option[2]");
        $I->fillField(DiscountsPage::$BeginValueDiscount, '6');
        $I->click(DiscountsPage::$OnDateCreate);
        $I->click(".//*[@id='ui-datepicker-div']/table/tbody/tr[4]/td[2]/a");        
        $date=$I->grabValueFrom(DiscountsPage::$OnDateCreate);
        $I->comment($date);
        $I->click(DiscountsPage::$SaveButton);
        $I->waitForText("Редактирование скидки");
        //$I->waitForElementVisible('.alert.in.fade.alert-success');
        //$I->see('Скидка успешно создана!');
        //$I->waitForElementNotVisible('.alert.in.fade.alert-success');
        $I->seeInField(DiscountsPage::$NameDiscountEdit, 'q');
        $I->seeInField(DiscountsPage::$AmountOfUse, '1');
        $I->seeInField(DiscountsPage::$ValueDiscount, '2');
        $I->seeInField(DiscountsPage::$BeginValueDiscount, '6');
        $I->seeInField(DiscountsPage::$OnDateEdit, "$date");
//        $name=$I->grabValueFrom(DiscountsPage::$NameDiscountEdit);
//        $I->assertEquals($name, 'q');
//        $use=$I->grabValueFrom(DiscountsPage::$AmountOfUse);
//        $I->assertEquals($use, '1');
//        $val=$I->grabValueFrom(DiscountsPage::$ValueDiscount);
//        $I->assertEquals($val, '2');
//        $begin=$I->grabValueFrom(DiscountsPage::$BeginValueDiscount);
//        $I->assertEquals($begin, '6');
    }
    
    
    public function Symbols3InCreate(AcceptanceTester $I)
    {
        $I->amOnPage("/admin/components/init_window/mod_discount/create");        
        $I->fillField(DiscountsPage::$NameDiscountCreate, 'qwe');        
        $I->click(".//*[@id='createDiscountForm']/table/tbody/tr[1]/td/div/div/div[2]/div[2]/span[2]/span/span");
        $I->fillField(DiscountsPage::$AmountOfUse, '111');
        $I->fillField(DiscountsPage::$ValueDiscount, '222');
        $I->click(DiscountsPage::$SelectTypeDiscount);
        $I->click(".//*[@id='selectDiscountType']/option[2]");
        $I->fillField(DiscountsPage::$BeginValueDiscount, '666');
        $I->click(DiscountsPage::$OnDateCreate);
        $I->click(".//*[@id='ui-datepicker-div']/table/tbody/tr[4]/td[2]/a");
        $I->click(DiscountsPage::$SaveButton);
        $I->waitForText("Редактирование скидки");
        //$I->waitForElementVisible('.alert.in.fade.alert-success');
        //$I->see('Скидка успешно создана!');
        //$I->waitForElementNotVisible('.alert.in.fade.alert-success');
        $I->seeInField(DiscountsPage::$NameDiscountEdit, 'qwe');
        $I->seeInField(DiscountsPage::$AmountOfUse, '111');
        $I->seeInField(DiscountsPage::$ValueDiscount, '222');
        $I->seeInField(DiscountsPage::$BeginValueDiscount, '666');
//        $name=$I->grabValueFrom(DiscountsPage::$NameDiscountEdit);
//        $I->assertEquals($name, 'qwe');
//        $use=$I->grabValueFrom(DiscountsPage::$AmountOfUse);
//        $I->assertEquals($use, '111');
//        $val=$I->grabValueFrom(DiscountsPage::$ValueDiscount);
//        $I->assertEquals($val, '99');
//        $begin=$I->grabValueFrom(DiscountsPage::$BeginValueDiscount);
//        $I->assertEquals($begin, '666');
    }
    
    public function Symbols4InCreate(AcceptanceTester $I)
    {
        $I->amOnPage("/admin/components/init_window/mod_discount/create");        
        $I->fillField(DiscountsPage::$NameDiscountCreate, 'qwer');        
        $I->click(".//*[@id='createDiscountForm']/table/tbody/tr[1]/td/div/div/div[2]/div[2]/span[2]/span/span");
        $I->fillField(DiscountsPage::$AmountOfUse, '1111');
        $I->fillField(DiscountsPage::$ValueDiscount, '0022');
        $I->click(DiscountsPage::$SelectTypeDiscount);
        $I->click(".//*[@id='selectDiscountType']/option[2]");
        $I->fillField(DiscountsPage::$BeginValueDiscount, '6666');
        $I->click(DiscountsPage::$OnDateCreate);
        $I->click(".//*[@id='ui-datepicker-div']/table/tbody/tr[4]/td[2]/a");
        $I->click(DiscountsPage::$SaveButton);
        $I->waitForText("Редактирование скидки");
        //$I->waitForElementVisible('.alert.in.fade.alert-success');
        //$I->see('Скидка успешно создана!');
        //$I->waitForElementNotVisible('.alert.in.fade.alert-success');
        $I->seeInField(DiscountsPage::$NameDiscountEdit, 'qwer');
        $I->seeInField(DiscountsPage::$AmountOfUse, '1111');
        $I->seeInField(DiscountsPage::$ValueDiscount, '22');
        $I->seeInField(DiscountsPage::$BeginValueDiscount, '6666');
//        $name=$I->grabValueFrom(DiscountsPage::$NameDiscountEdit);
//        $I->assertEquals($name, 'qwer');
//        $use=$I->grabValueFrom(DiscountsPage::$AmountOfUse);
//        $I->assertEquals($use, '1111');
//        $val=$I->grabValueFrom(DiscountsPage::$ValueDiscount);
//        $I->assertEquals($val, '22');
//        $begin=$I->grabValueFrom(DiscountsPage::$BeginValueDiscount);
//        $I->assertEquals($begin, '6666');
    }
    
    
    public function Symbols7InCreate(AcceptanceTester $I)
    {
        $I->amOnPage("/admin/components/init_window/mod_discount/create");        
        $I->fillField(DiscountsPage::$NameDiscountCreate, 'qwert12');        
        $I->click(".//*[@id='createDiscountForm']/table/tbody/tr[1]/td/div/div/div[2]/div[2]/span[2]/span/span");
        $I->fillField(DiscountsPage::$AmountOfUse, '1111111');
        $I->fillField(DiscountsPage::$ValueDiscount, '0022');
        $I->click(DiscountsPage::$SelectTypeDiscount);
        $I->click(".//*[@id='selectDiscountType']/option[2]");
        $I->fillField(DiscountsPage::$BeginValueDiscount, '6666666');
        $I->click(DiscountsPage::$OnDateCreate);
        $I->click(".//*[@id='ui-datepicker-div']/table/tbody/tr[4]/td[2]/a");
        $I->click(DiscountsPage::$SaveButton);
        $I->waitForText("Редактирование скидки");
        //$I->waitForElementVisible('.alert.in.fade.alert-success');
        //$I->see('Скидка успешно создана!');
        //$I->waitForElementNotVisible('.alert.in.fade.alert-success');
        $I->seeInField(DiscountsPage::$NameDiscountEdit, 'qwert12');
        $I->seeInField(DiscountsPage::$AmountOfUse, '1111111');
        $I->seeInField(DiscountsPage::$ValueDiscount, '22');
        $I->seeInField(DiscountsPage::$BeginValueDiscount, '6666666');
//        $name=$I->grabValueFrom(DiscountsPage::$NameDiscountEdit);
//        $I->assertEquals($name, 'qwert12');
//        $use=$I->grabValueFrom(DiscountsPage::$AmountOfUse);
//        $I->assertEquals($use, '1111111');
//        $val=$I->grabValueFrom(DiscountsPage::$ValueDiscount);
//        $I->assertEquals($val, '22');
//        $begin=$I->grabValueFrom(DiscountsPage::$BeginValueDiscount);
//        $I->assertEquals($begin, '6666666');
    }
    
    
    public function Symbols9InCreate(AcceptanceTester $I)
    {
        $I->amOnPage("/admin/components/init_window/mod_discount/create");        
        $I->fillField(DiscountsPage::$NameDiscountCreate, 'qwert1234');        
        $I->click(".//*[@id='createDiscountForm']/table/tbody/tr[1]/td/div/div/div[2]/div[2]/span[2]/span/span");
        $I->fillField(DiscountsPage::$AmountOfUse, '111111111');
        $I->fillField(DiscountsPage::$ValueDiscount, '0022');
        $I->click(DiscountsPage::$SelectTypeDiscount);
        $I->click(".//*[@id='selectDiscountType']/option[2]");
        $I->fillField(DiscountsPage::$BeginValueDiscount, '666666666');
        $I->click(DiscountsPage::$OnDateCreate);
        $I->click(".//*[@id='ui-datepicker-div']/table/tbody/tr[4]/td[2]/a");
        $I->click(DiscountsPage::$SaveButton);
        $I->waitForText("Редактирование скидки");
        //$I->waitForElementVisible('.alert.in.fade.alert-success');
        //$I->see('Скидка успешно создана!');
        //$I->waitForElementNotVisible('.alert.in.fade.alert-success');
        $I->seeInField(DiscountsPage::$NameDiscountEdit, 'qwert1234');
        $I->seeInField(DiscountsPage::$AmountOfUse, '1111111');
        $I->seeInField(DiscountsPage::$ValueDiscount, '22');
        $I->seeInField(DiscountsPage::$BeginValueDiscount, '666666666');
//        $name=$I->grabValueFrom(DiscountsPage::$NameDiscountEdit);
//        $I->assertEquals($name, 'qwert1234');
//        $use=$I->grabValueFrom(DiscountsPage::$AmountOfUse);
//        $I->assertEquals($use, '1111111');
//        $val=$I->grabValueFrom(DiscountsPage::$ValueDiscount);
//        $I->assertEquals($val, '22');
//        $begin=$I->grabValueFrom(DiscountsPage::$BeginValueDiscount);
//        $I->assertEquals($begin, '666666666');
    }
    
    
    public function Symbols10InCreate(AcceptanceTester $I)
    {
        $I->amOnPage("/admin/components/init_window/mod_discount/create");        
        $I->fillField(DiscountsPage::$NameDiscountCreate, 'qwert12345');        
        $I->click(".//*[@id='createDiscountForm']/table/tbody/tr[1]/td/div/div/div[2]/div[2]/span[2]/span/span");
        $I->fillField(DiscountsPage::$AmountOfUse, '111111111');
        $I->fillField(DiscountsPage::$ValueDiscount, '0022');
        $I->click(DiscountsPage::$SelectTypeDiscount);
        $I->click(".//*[@id='selectDiscountType']/option[2]");
        $I->fillField(DiscountsPage::$BeginValueDiscount, '555');
        $I->click(DiscountsPage::$OnDateCreate);
        $I->click(".//*[@id='ui-datepicker-div']/table/tbody/tr[4]/td[2]/a");
        $I->click(DiscountsPage::$SaveButton);
        $I->waitForText("Редактирование скидки");
        //$I->waitForElementVisible('.alert.in.fade.alert-success');
        //$I->see('Скидка успешно создана!');
        //$I->waitForElementNotVisible('.alert.in.fade.alert-success');
        $I->seeInField(DiscountsPage::$NameDiscountEdit, 'qwert12345');
        $I->seeInField(DiscountsPage::$AmountOfUse, '1111111');
        $I->seeInField(DiscountsPage::$ValueDiscount, '22');
        $I->seeInField(DiscountsPage::$BeginValueDiscount, '555');
    }
    
    
    public function Symbols150InCreate(AcceptanceTester $I)
    {
        $I->amOnPage("/admin/components/init_window/mod_discount/create");        
        $I->fillField(DiscountsPage::$NameDiscountCreate, 'qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345');        
        $I->click(".//*[@id='createDiscountForm']/table/tbody/tr[1]/td/div/div/div[2]/div[2]/span[2]/span/span");
        $I->fillField(DiscountsPage::$AmountOfUse, '111111111');
        $I->fillField(DiscountsPage::$ValueDiscount, '0022');
        $I->click(DiscountsPage::$SelectTypeDiscount);
        $I->click(".//*[@id='selectDiscountType']/option[2]");
        $I->fillField(DiscountsPage::$BeginValueDiscount, '555');
        $I->click(DiscountsPage::$OnDateCreate);
        $I->click(".//*[@id='ui-datepicker-div']/table/tbody/tr[4]/td[2]/a");
        $I->click(DiscountsPage::$SaveButton);
        $I->waitForText("Редактирование скидки");
        //$I->waitForElementVisible('.alert.in.fade.alert-success');
        //$I->see('Скидка успешно создана!');
        //$I->waitForElementNotVisible('.alert.in.fade.alert-success');
        $I->seeInField(DiscountsPage::$NameDiscountEdit, 'qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345');
        $I->seeInField(DiscountsPage::$AmountOfUse, '1111111');
        $I->seeInField(DiscountsPage::$ValueDiscount, '22');
        $I->seeInField(DiscountsPage::$BeginValueDiscount, '555');
    }
    
    
    public function Symbols151InCreate(AcceptanceTester $I)
    {
        $I->amOnPage("/admin/components/init_window/mod_discount/create");        
        $I->fillField(DiscountsPage::$NameDiscountCreate, 'qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert123456');        
        $I->click(".//*[@id='createDiscountForm']/table/tbody/tr[1]/td/div/div/div[2]/div[2]/span[2]/span/span");
        $I->fillField(DiscountsPage::$AmountOfUse, '111111111');
        $I->fillField(DiscountsPage::$ValueDiscount, '0022');
        $I->click(DiscountsPage::$SelectTypeDiscount);
        $I->click(".//*[@id='selectDiscountType']/option[2]");
        $I->fillField(DiscountsPage::$BeginValueDiscount, '555');
        $I->click(DiscountsPage::$OnDateCreate);
        $I->click(".//*[@id='ui-datepicker-div']/table/tbody/tr[4]/td[2]/a");
        $I->click(DiscountsPage::$SaveButton);
        $I->waitForText("Редактирование скидки");
        //$I->waitForElementVisible('.alert.in.fade.alert-success');
        //$I->see('Скидка успешно создана!');
        //$I->waitForElementNotVisible('.alert.in.fade.alert-success');
        $I->seeInField(DiscountsPage::$NameDiscountEdit, 'qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345qwert12345');
        $I->seeInField(DiscountsPage::$AmountOfUse, '1111111');
        $I->seeInField(DiscountsPage::$ValueDiscount, '22');
        $I->seeInField(DiscountsPage::$BeginValueDiscount, '555');
    }
}