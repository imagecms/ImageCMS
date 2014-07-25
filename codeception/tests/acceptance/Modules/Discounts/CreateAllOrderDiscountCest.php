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
    
    
    public function NameInCreateDiscount(AcceptanceTester $I)
    {
        $I->amOnPage("/admin/components/init_window/mod_discount/create");        
        $I->see('Создание скидки', ".//*[@id='mainContent']/section/div[1]/div[1]/span[2]");
        $I->see('Создать', ".//*[@id='createDiscountForm']/table/thead/tr/th");
        $I->see('Детали скидки', ".//*[@id='createDiscountForm']/table/tbody/tr[1]/td/div/div/div[1]/div[2]");
        $I->see('Название скидки:', ".//*[@id='createDiscountForm']/table/tbody/tr[1]/td/div/div/label[1]/span[1]");
        $I->see('Код скидки:', ".//*[@id='createDiscountForm']/table/tbody/tr[1]/td/div/div/label[2]/span[1]");
        $I->see('Количество использования:', ".//*[@id='createDiscountForm']/table/tbody/tr[1]/td/div/div/div[2]/div[1]");
        $I->see('Неограниченно', ".//*[@id='createDiscountForm']/table/tbody/tr[1]/td/div/div/div[2]/div[2]/span[2]/span");
        $I->see('Метод подсчета', ".//*[@id='createDiscountForm']/table/tbody/tr[2]/td/div/div/div[1]/div[2]");
        $I->see('Выберите метод:', ".//*[@id='createDiscountForm']/table/tbody/tr[2]/td/div/div/div[2]/div[1]");
        $I->see('Проценты', DiscountsPage::$SelectMethod.'/option[1]');
        $I->see('Фиксированный', DiscountsPage::$SelectMethod.'/option[2]');
        $I->see('%', ".//*[@id='typeValue']");
        $I->click(DiscountsPage::$SelectMethod);
        $I->click(DiscountsPage::$SelectMethod.'/option[2]');
        $I->wait('1');
        $SymbCur=$I->grabTextFrom(".//*[@id='typeValue']");
        $I->see('Тип скидки', ".//*[@id='createDiscountForm']/table/tbody/tr[3]/td/div/div/div[1]/div[2]");
        $I->see('Выберите тип:', ".//*[@id='createDiscountForm']/table/tbody/tr[3]/td/div/div/div[2]/div[1]");
        $I->see('Нет', DiscountsPage::$SelectTypeDiscount);
        $I->click(DiscountsPage::$SelectTypeDiscount);
        $I->wait('1');
        $I->see('Нет', DiscountsPage::$SelectTypeDiscount.'/option[1]');
        $I->see('Сумма заказа на больше чем', DiscountsPage::$SelectTypeDiscount.'/option[2]');
        $I->see('Накопительная скидка', DiscountsPage::$SelectTypeDiscount.'/option[3]');
        $I->see('Пользователь', DiscountsPage::$SelectTypeDiscount.'/option[4]');
        $I->see('Группа пользователей', DiscountsPage::$SelectTypeDiscount.'/option[5]');
        $I->see('Категория', DiscountsPage::$SelectTypeDiscount.'/option[6]');
        $I->see('Товар', DiscountsPage::$SelectTypeDiscount.'/option[7]');
        $I->see('Бренд', DiscountsPage::$SelectTypeDiscount.'/option[8]');
        $I->click(DiscountsPage::$SelectTypeDiscount.'/option[2]');
        $I->wait('1');
        $I->seeInField(DiscountsPage::$BeginValueDiscount, '0');
        $SymbCur2=$I->grabTextFrom(".//*[@id='all_orderBlock']/span/span[2]");
        $I->see('Только для зарегистрированных', ".//*[@id='all_orderBlock']/div[1]/span");
        $I->see('Подарочный сертификат', ".//*[@id='giftSpanCheckbox']");                
        $I->click(DiscountsPage::$SelectTypeDiscount);
        $I->click(DiscountsPage::$SelectTypeDiscount.'/option[6]');
        $I->wait('1');
        $I->see('Учитывать дочерние категории', ".//*[@id='categoryBlock']");
        $categoryCheck=$I->grabTextFrom(DiscountsPage::$SelectCategory);
        $I->comment("$categoryCheck");
        $I->click(DiscountsPage::$SelectCategory);
        $cat=$I->grabClassCount($I, "active-result");
        $I->comment("$cat");
//        $kilCat=$cat+1;
//        $I->comment("$kilCat");
        for ($i=1; $i<=$cat; $i++){
            $categ[$i]=$I->grabTextFrom(".//*[@id='categoryBlock']/div/div/ul/li[$i]");
            $I->comment("$categ[$i]");
        }
        $AllCategoryDiscount=  implode(" ", $categ);
        $I->comment($AllCategoryDiscount);        
        $I->click(DiscountsPage::$SelectTypeDiscount);
        $I->click(DiscountsPage::$SelectTypeDiscount.'/option[8]');
        $I->wait('1');
        $brandCheck=$I->grabTextFrom(DiscountsPage::$SelectBrand);
        $I->comment("$brandCheck");
        $I->click(DiscountsPage::$SelectBrand);
        $brand=$I->grabClassCount($I, "active-result");
        $I->comment("$brand");
        for ($k=1; $k<=$brand; $k++){
            $brands[$k]=$I->grabTextFrom("//*[@id='selectBrand_chosen']/div/ul/li[$k]");
            $I->comment("$brands[$k]");
        }
        $AllBrandsDiscount=  implode(" ", $brands);
        $I->comment($AllBrandsDiscount);
        $I->see('Допустимое время для скидок', ".//*[@id='createDiscountForm']/table/tbody/tr[4]/td/div/div[1]/div[2]");
        $I->see('Период действия скидки от:', ".//*[@id='createDiscountForm']/table/tbody/tr[4]/td/div/div[2]/div[1]");
        $I->see('до', ".//*[@id='createDiscountForm']/table/tbody/tr[4]/td/div/div[2]/div[2]/div/span[2]");
        $I->see('Постоянная скидка', ".//*[@id='createDiscountForm']/table/tbody/tr[4]/td/div/div[2]/div[2]/div/span[3]/div/div/span");
        
        
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
        $name=$I->grabValueFrom(DiscountsPage::$NameDiscountCreate);
        $I->assertEquals($name, 'qwerrQEQE12345!#@$#%%^&*()_+|}{:>?<,./;][\\=-0ёцвцаымпУКП');
        $readOnlyField=$I->grabAttributeFrom(DiscountsPage::$DiscountKey, 'readonly');
        $I->comment("$readOnlyField");
        $I->assertEquals($readOnlyField, "true");
        $disabledField=$I->grabAttributeFrom(DiscountsPage::$AmountOfUse, 'disabled');
        $I->comment("$disabledField");
        $I->assertEquals($disabledField, "true");
        $ActiveCheckbox=$I->grabAttributeFrom(DiscountsPage::$UnlimitedCheckboxCreate.'/input', "checked");
        $I->comment("$ActiveCheckbox");
        $I->assertEquals($ActiveCheckbox, "true");
        $I->click(DiscountsPage::$UnlimitedCheckboxCreate);
        $I->fillField(DiscountsPage::$AmountOfUse, 'qQ1!#@$#%^&*()_+|}{:>?<,./;][\\=-0пУ');
        $kil=$I->grabValueFrom(DiscountsPage::$AmountOfUse);
        $I->assertEquals($kil, '10');
        $I->fillField(DiscountsPage::$ValueDiscount, 'qQ1!#@$#%^&*()_+|}{:>?<,./;][\\=-0пУ');
        $val=$I->grabValueFrom(DiscountsPage::$ValueDiscount);
        $I->assertEquals($val, '10');
        $I->click(DiscountsPage::$SelectTypeDiscount);
        $I->click(".//*[@id='selectDiscountType']/option[2]");
        $I->fillField(DiscountsPage::$BeginValueDiscount, 'qQ1!#@$#%^&*()_+|}{:>?<,./;][\\=-0пУ');
        $begin=$I->grabValueFrom(DiscountsPage::$BeginValueDiscount);
        $I->assertEquals($begin, '10');
        $NotActCheckbox=$I->grabAttributeFrom(DiscountsPage::$OnlyForAutorizedCheckbox, 'checked');
        $I->comment("$NotActCheckbox");
        $I->assertEquals($NotActCheckbox, null);
        $NotActGiftCheckbox=$I->grabAttributeFrom(DiscountsPage::$GiftSertificateCheckbox, 'checked');
        $I->comment("$NotActGiftCheckbox");
        $I->assertEquals($NotActGiftCheckbox, null);
        $I->fillField(DiscountsPage::$OnDateCreate, 'qQ1!#@$#%^&*()_+|}{:>?<,./;][\\=-0пУ');
        $dateBegin=$I->grabValueFrom(DiscountsPage::$OnDateCreate);
        $I->assertEquals($dateBegin, '');
        $ActCheckbox=$I->grabAttributeFrom(DiscountsPage::$ConstantDiscountCheckboxCreate.'/input', 'checked');
        $I->comment("$ActCheckbox");
        $I->assertEquals($ActCheckbox, "true");
        $disField=$I->grabAttributeFrom(DiscountsPage::$UntilDateCreate, 'disabled');
        $I->comment("$disField");
        $I->assertEquals($disField, "true");
        $I->click(DiscountsPage::$ConstantDiscountCheckboxCreate);
        $I->fillField(DiscountsPage::$UntilDateCreate, 'qQ1!#@$#%^&*()_+|}{:>?<,./;][\\=-0пУ');
        $dateEnd=$I->grabValueFrom(DiscountsPage::$UntilDateCreate);
        $I->assertEquals($dateEnd, '');
        $I->click(DiscountsPage::$SelectMethod);
        $I->click(DiscountsPage::$SelectMethod.'/option[2]');
        $I->fillField(DiscountsPage::$ValueDiscount, 'qQ1!#@$#%^&*()_+|}{:>?<,./;][\\=-0пУ');
        $val2=$I->grabValueFrom(DiscountsPage::$ValueDiscount);
        $I->assertEquals($val2, '10');
//        $I->seeInField('qwerrQEQE12345!#@$#%%^&*()_+|}{:>?<,./;][\\=-0ёцвцаымпУКП', DiscountsPage::$NameDiscountCreate);
//        $I->seeInField('', DiscountsPage::$DiscountKey);
//        $I->seeInField('10', DiscountsPage::$AmountOfUse);
//        $I->seeInField('10', DiscountsPage::$ValueDiscount);
//        $I->seeInField('10', DiscountsPage::$BeginValueDiscount);
//        $I->seeInField('', DiscountsPage::$OnDateCreate);
//        $I->seeInField('', DiscountsPage::$UntilDateCreate);
    }
    
    
    public function OneSymbolsInCreate(AcceptanceTester $I)
    {
        $I->amOnPage("/admin/components/init_window/mod_discount/create");        
        $I->fillField(DiscountsPage::$NameDiscountCreate, 'a');        
        $I->click(DiscountsPage::$UnlimitedCheckboxCreate);
        $I->fillField(DiscountsPage::$AmountOfUse, '1');
        $I->fillField(DiscountsPage::$ValueDiscount, '2');
        $I->click(DiscountsPage::$SelectTypeDiscount);
        $I->click(DiscountsPage::$SelectTypeDiscount.'/option[2]');
        $I->fillField(DiscountsPage::$BeginValueDiscount, '6');
        $I->click(DiscountsPage::$OnDateCreate);
        $I->click(".//*[@id='ui-datepicker-div']/table/tbody/tr[4]/td/a");        
        $date=$I->grabValueFrom(DiscountsPage::$OnDateCreate);
        $I->comment($date);
        $I->click(DiscountsPage::$SaveButton);
        $I->waitForText("Редактирование скидки");
        //$I->waitForElementVisible('.alert.in.fade.alert-success');
        //$I->see('Скидка успешно создана!');
        //$I->waitForElementNotVisible('.alert.in.fade.alert-success');
        $I->seeInField(DiscountsPage::$NameDiscountEdit, 'a');
        $I->seeInField(DiscountsPage::$AmountOfUse, '1');
        $I->seeInField(DiscountsPage::$ValueDiscount, '2');
        $I->seeInField(DiscountsPage::$BeginValueDiscount, '6');
        $I->seeInField(DiscountsPage::$OnDateEdit, "$date");
    }
    
    
    public function Symbols3InCreate(AcceptanceTester $I)
    {
        $I->amOnPage("/admin/components/init_window/mod_discount/create");        
        $I->fillField(DiscountsPage::$NameDiscountCreate, 'alo');        
        $I->click(DiscountsPage::$UnlimitedCheckboxCreate);
        $I->fillField(DiscountsPage::$AmountOfUse, '111');
        $I->fillField(DiscountsPage::$ValueDiscount, '222');
        $I->click(DiscountsPage::$SelectTypeDiscount);
        $I->click(DiscountsPage::$SelectTypeDiscount.'/option[2]');
        $I->fillField(DiscountsPage::$BeginValueDiscount, '666');
        $I->click(DiscountsPage::$OnDateCreate);
        $I->click(".//*[@id='ui-datepicker-div']/table/tbody/tr[4]/td/a");
        $I->click(DiscountsPage::$SaveButton);
        $I->waitForText("Редактирование скидки");
        //$I->waitForElementVisible('.alert.in.fade.alert-success');
        //$I->see('Скидка успешно создана!');
        //$I->waitForElementNotVisible('.alert.in.fade.alert-success');
        $I->seeInField(DiscountsPage::$NameDiscountEdit, 'alo');
        $I->seeInField(DiscountsPage::$AmountOfUse, '111');
        $I->seeInField(DiscountsPage::$ValueDiscount, '222');
        $I->seeInField(DiscountsPage::$BeginValueDiscount, '666');
    }
    
    public function Symbols4InCreate(AcceptanceTester $I)
    {
        $I->amOnPage("/admin/components/init_window/mod_discount/create");        
        $I->fillField(DiscountsPage::$NameDiscountCreate, 'Alor');        
        $I->click(DiscountsPage::$UnlimitedCheckboxCreate);
        $I->fillField(DiscountsPage::$AmountOfUse, '1111');
        $I->fillField(DiscountsPage::$ValueDiscount, '0022');
        $I->click(DiscountsPage::$SelectTypeDiscount);
        $I->click(DiscountsPage::$SelectTypeDiscount.'/option[2]');
        $I->fillField(DiscountsPage::$BeginValueDiscount, '6666');
        $I->click(DiscountsPage::$OnDateCreate);
        $I->click(".//*[@id='ui-datepicker-div']/table/tbody/tr[4]/td/a");
        $I->click(DiscountsPage::$SaveButton);
        $I->waitForText("Редактирование скидки");
        //$I->waitForElementVisible('.alert.in.fade.alert-success');
        //$I->see('Скидка успешно создана!');
        //$I->waitForElementNotVisible('.alert.in.fade.alert-success');
        $I->seeInField(DiscountsPage::$NameDiscountEdit, 'Alor');
        $I->seeInField(DiscountsPage::$AmountOfUse, '1111');
        $I->seeInField(DiscountsPage::$ValueDiscount, '22');
        $I->seeInField(DiscountsPage::$BeginValueDiscount, '6666');
    }
    
    
    public function Symbols7InCreate(AcceptanceTester $I)
    {
        $I->amOnPage("/admin/components/init_window/mod_discount/create");        
        $I->fillField(DiscountsPage::$NameDiscountCreate, 'AllOrdr');        
        $I->click(DiscountsPage::$UnlimitedCheckboxCreate);
        $I->fillField(DiscountsPage::$AmountOfUse, '1111111');
        $I->fillField(DiscountsPage::$ValueDiscount, '0022');
        $I->click(DiscountsPage::$SelectTypeDiscount);
        $I->click(DiscountsPage::$SelectTypeDiscount.'/option[2]');
        $I->fillField(DiscountsPage::$BeginValueDiscount, '6666666');
        $I->click(DiscountsPage::$OnDateCreate);
        $I->click(".//*[@id='ui-datepicker-div']/table/tbody/tr[4]/td/a");
        $I->click(DiscountsPage::$SaveButton);
        $I->waitForText("Редактирование скидки");
        //$I->waitForElementVisible('.alert.in.fade.alert-success');
        //$I->see('Скидка успешно создана!');
        //$I->waitForElementNotVisible('.alert.in.fade.alert-success');
        $I->seeInField(DiscountsPage::$NameDiscountEdit, 'AllOrdr');
        $I->seeInField(DiscountsPage::$AmountOfUse, '1111111');
        $I->seeInField(DiscountsPage::$ValueDiscount, '22');
        $I->seeInField(DiscountsPage::$BeginValueDiscount, '6666666');      
    }
    
    
    public function Symbols9InCreate(AcceptanceTester $I)
    {
        $I->amOnPage("/admin/components/init_window/mod_discount/create");        
        $I->fillField(DiscountsPage::$NameDiscountCreate, 'OrderAll9');        
        $I->click(DiscountsPage::$UnlimitedCheckboxCreate);
        $I->fillField(DiscountsPage::$AmountOfUse, '111111111');
        $I->fillField(DiscountsPage::$ValueDiscount, '0022');
        $I->click(DiscountsPage::$SelectTypeDiscount);
        $I->click(DiscountsPage::$SelectTypeDiscount.'/option[2]');
        $I->fillField(DiscountsPage::$BeginValueDiscount, '666666666');
        $I->click(DiscountsPage::$OnDateCreate);
        $I->click(".//*[@id='ui-datepicker-div']/table/tbody/tr[4]/td/a");
        $I->click(DiscountsPage::$SaveButton);
        $I->waitForText("Редактирование скидки");
        //$I->waitForElementVisible('.alert.in.fade.alert-success');
        //$I->see('Скидка успешно создана!');
        //$I->waitForElementNotVisible('.alert.in.fade.alert-success');
        $I->seeInField(DiscountsPage::$NameDiscountEdit, 'OrderAll9');
        $I->seeInField(DiscountsPage::$AmountOfUse, '1111111');
        $I->seeInField(DiscountsPage::$ValueDiscount, '22');
        $I->seeInField(DiscountsPage::$BeginValueDiscount, '666666666');
    }
    
    
    public function Symbols10InCreate(AcceptanceTester $I)
    {
        $I->amOnPage("/admin/components/init_window/mod_discount/create");        
        $I->fillField(DiscountsPage::$NameDiscountCreate, 'OrderAll10');        
        $I->click(DiscountsPage::$UnlimitedCheckboxCreate);
        $I->fillField(DiscountsPage::$AmountOfUse, '111111111');
        $I->fillField(DiscountsPage::$ValueDiscount, '0022');
        $I->click(DiscountsPage::$SelectTypeDiscount);
        $I->click(DiscountsPage::$SelectTypeDiscount.'/option[2]');
        $I->fillField(DiscountsPage::$BeginValueDiscount, '555');
        $I->click(DiscountsPage::$OnDateCreate);
        $I->click(".//*[@id='ui-datepicker-div']/table/tbody/tr[4]/td/a");
        $I->click(DiscountsPage::$SaveButton);
        $I->waitForText("Редактирование скидки");
        //$I->waitForElementVisible('.alert.in.fade.alert-success');
        //$I->see('Скидка успешно создана!');
        //$I->waitForElementNotVisible('.alert.in.fade.alert-success');
        $I->seeInField(DiscountsPage::$NameDiscountEdit, 'OrderAll10');
        $I->seeInField(DiscountsPage::$AmountOfUse, '1111111');
        $I->seeInField(DiscountsPage::$ValueDiscount, '22');
        $I->seeInField(DiscountsPage::$BeginValueDiscount, '555');
    }
    
    
    public function Symbols150InCreate(AcceptanceTester $I)
    {
        $I->amOnPage("/admin/components/init_window/mod_discount/create");        
        $I->fillField(DiscountsPage::$NameDiscountCreate, '150SymbolsInCreate AllOrdersDiscount 150SymbolsInCreateAllOrdersDiscount 150SymbolsInCreateAllOrdersDiscount 150SymbolsInCreateAllOrdersDiscountProcen');        
        $I->click(DiscountsPage::$UnlimitedCheckboxCreate);
        $I->fillField(DiscountsPage::$AmountOfUse, '111111111');
        $I->fillField(DiscountsPage::$ValueDiscount, '0022');
        $I->click(DiscountsPage::$SelectTypeDiscount);
        $I->click(DiscountsPage::$SelectTypeDiscount.'/option[2]');
        $I->fillField(DiscountsPage::$BeginValueDiscount, '555');
        $I->click(DiscountsPage::$OnDateCreate);
        $I->click(".//*[@id='ui-datepicker-div']/table/tbody/tr[4]/td/a");
        $I->click(DiscountsPage::$SaveButton);
        $I->waitForText("Редактирование скидки");
        //$I->waitForElementVisible('.alert.in.fade.alert-success');
        //$I->see('Скидка успешно создана!');
        //$I->waitForElementNotVisible('.alert.in.fade.alert-success');
        $I->seeInField(DiscountsPage::$NameDiscountEdit, '150SymbolsInCreate AllOrdersDiscount 150SymbolsInCreateAllOrdersDiscount 150SymbolsInCreateAllOrdersDiscount 150SymbolsInCreateAllOrdersDiscountProcen');
        $I->seeInField(DiscountsPage::$AmountOfUse, '1111111');
        $I->seeInField(DiscountsPage::$ValueDiscount, '22');
        $I->seeInField(DiscountsPage::$BeginValueDiscount, '555');
    }
    
    
    public function Symbols151InCreate(AcceptanceTester $I)
    {
        $I->amOnPage("/admin/components/init_window/mod_discount/create");        
        $I->fillField(DiscountsPage::$NameDiscountCreate, '151SymbolsInCreate AllOrdersDiscount 151SymbolsInCreate AllOrdersDiscount 151SymbolsInCreate AllOrdersDiscount 151SymbolsInCreate AllOrdersDiscountProc');        
        $I->click(DiscountsPage::$UnlimitedCheckboxCreate);
        $I->fillField(DiscountsPage::$AmountOfUse, '111111111');
        $I->fillField(DiscountsPage::$ValueDiscount, '0022');
        $I->click(DiscountsPage::$SelectTypeDiscount);
        $I->click(DiscountsPage::$SelectTypeDiscount.'/option[2]');
        $I->fillField(DiscountsPage::$BeginValueDiscount, '555');
        $I->click(DiscountsPage::$OnDateCreate);
        $I->click(".//*[@id='ui-datepicker-div']/table/tbody/tr[4]/td/a");
        $I->click(DiscountsPage::$SaveButton);
        $I->waitForText("Редактирование скидки");
        //$I->waitForElementVisible('.alert.in.fade.alert-success');
        //$I->see('Скидка успешно создана!');
        //$I->waitForElementNotVisible('.alert.in.fade.alert-success');
        $I->seeInField(DiscountsPage::$NameDiscountEdit, '151SymbolsInCreate AllOrdersDiscount 151SymbolsInCreate AllOrdersDiscount 151SymbolsInCreate AllOrdersDiscount 151SymbolsInCreate AllOrdersDiscountPro');
        $I->seeInField(DiscountsPage::$AmountOfUse, '1111111');
        $I->seeInField(DiscountsPage::$ValueDiscount, '22');
        $I->seeInField(DiscountsPage::$BeginValueDiscount, '555');
    }
    
    
    public function OneSymbolsFixMethodInCreate(AcceptanceTester $I)
    {
        $I->amOnPage("/admin/components/init_window/mod_discount/create");        
        $I->fillField(DiscountsPage::$NameDiscountCreate, 'o');        
        $I->click(DiscountsPage::$UnlimitedCheckboxCreate);
        $I->fillField(DiscountsPage::$AmountOfUse, '1');
        $I->click(DiscountsPage::$SelectMethod);
        $I->click(DiscountsPage::$SelectMethod.'/option[2]');
        $I->fillField(DiscountsPage::$ValueDiscount, '2');
        $I->click(DiscountsPage::$SelectTypeDiscount);
        $I->click(DiscountsPage::$SelectTypeDiscount.'/option[2]');
        $I->fillField(DiscountsPage::$BeginValueDiscount, '6');
        $I->click(DiscountsPage::$OnDateCreate);
        $I->click(".//*[@id='ui-datepicker-div']/table/tbody/tr[4]/td/a");        
        $date=$I->grabValueFrom(DiscountsPage::$OnDateCreate);
        $I->comment($date);
        $I->click(DiscountsPage::$SaveButton);
        $I->waitForText("Редактирование скидки");
        //$I->waitForElementVisible('.alert.in.fade.alert-success');
        //$I->see('Скидка успешно создана!');
        //$I->waitForElementNotVisible('.alert.in.fade.alert-success');
        $I->seeInField(DiscountsPage::$NameDiscountEdit, 'o');
        $I->seeInField(DiscountsPage::$AmountOfUse, '1');
        $I->seeInField(DiscountsPage::$ValueDiscount, '2');
        $I->seeInField(DiscountsPage::$BeginValueDiscount, '6');
        $I->seeInField(DiscountsPage::$OnDateEdit, "$date");
    }
    
    
    public function Symbols5FixMethodInCreate(AcceptanceTester $I)
    {
        $I->amOnPage("/admin/components/init_window/mod_discount/create");        
        $I->fillField(DiscountsPage::$NameDiscountCreate, '5SymbolsFixMethodDiscount AllOrders + NoLimitDiscount');       
        $I->click(DiscountsPage::$SelectMethod);
        $I->click(DiscountsPage::$SelectMethod.'/option[2]');
        $I->fillField(DiscountsPage::$ValueDiscount, '22222');
        $I->click(DiscountsPage::$SelectTypeDiscount);
        $I->click(DiscountsPage::$SelectTypeDiscount.'/option[2]');
        $I->fillField(DiscountsPage::$BeginValueDiscount, '6');
        $I->click(DiscountsPage::$OnDateCreate);
        $I->click(".//*[@id='ui-datepicker-div']/table/tbody/tr[4]/td/a");        
        $date=$I->grabValueFrom(DiscountsPage::$OnDateCreate);
        $I->comment($date);
        $I->click(DiscountsPage::$SaveButton);
        $I->waitForText("Редактирование скидки");
        //$I->waitForElementVisible('.alert.in.fade.alert-success');
        //$I->see('Скидка успешно создана!');
        //$I->waitForElementNotVisible('.alert.in.fade.alert-success');
        $I->seeInField(DiscountsPage::$NameDiscountEdit, '5SymbolsFixMethodDiscount AllOrders + NoLimitDiscount');        
        $I->seeInField(DiscountsPage::$ValueDiscount, '22222');
        $I->seeInField(DiscountsPage::$BeginValueDiscount, '6');
        $I->seeInField(DiscountsPage::$OnDateEdit, "$date");
        $I->seeInField(DiscountsPage::$AmountOfUse, '');
        $keyDisc=$I->grabValueFrom(DiscountsPage::$DiscountKey);
        $I->comment($keyDisc);
        $I->click(DiscountsPage::$GoBackButton);
        $I->waitForText('Скидки интернет-магазина');
        $I->see($keyDisc, DiscountsPage::DisKeyLine('1'));
        $I->see('5SymbolsFixMethodDiscount AllOrders + NoLimitDiscount', DiscountsPage::NameLine('1'));
        $I->see('Неограниченно', DiscountsPage::LimitLine('1'));
        $I->see('-', DiscountsPage::UseDiscLine('1'));
        $I->see($date, DiscountsPage::BeginTimeLine('1'));
        $I->see('-', DiscountsPage::EndTimeLine('1'));
        $activeDisc=$I->grabAttributeFrom(DiscountsPage::ActiveButtonLine('1'), 'class');
        $I->comment($activeDisc);
        $I->assertEquals($activeDisc, 'prod-on_off');
    }
    
    
    public function Symbols9FixMethodInCreate(AcceptanceTester $I)
    {
        $I->amOnPage("/admin/components/init_window/mod_discount/create");        
        $I->fillField(DiscountsPage::$NameDiscountCreate, '9SymbolsFixMethodDiscount + LimitDiscount');        
        $I->click(DiscountsPage::$UnlimitedCheckboxCreate);
        $I->fillField(DiscountsPage::$AmountOfUse, '1');
        $I->click(DiscountsPage::$SelectMethod);
        $I->click(DiscountsPage::$SelectMethod.'/option[2]');
        $I->fillField(DiscountsPage::$ValueDiscount, '222222222');
        $I->click(DiscountsPage::$SelectTypeDiscount);
        $I->click(DiscountsPage::$SelectTypeDiscount.'/option[2]');
        $I->fillField(DiscountsPage::$BeginValueDiscount, '6');
        $I->click(DiscountsPage::$OnDateCreate);
        $I->click(".//*[@id='ui-datepicker-div']/table/tbody/tr[4]/td/a");        
        $date=$I->grabValueFrom(DiscountsPage::$OnDateCreate);
        $I->comment($date);
        $I->click(DiscountsPage::$SaveButton);
        $I->waitForText("Редактирование скидки");
        //$I->waitForElementVisible('.alert.in.fade.alert-success');
        //$I->see('Скидка успешно создана!');
        //$I->waitForElementNotVisible('.alert.in.fade.alert-success');
        $I->seeInField(DiscountsPage::$NameDiscountEdit, '9SymbolsFixMethodDiscount + LimitDiscount');
        $I->seeInField(DiscountsPage::$AmountOfUse, '1');
        $I->seeInField(DiscountsPage::$ValueDiscount, '222222222');
        $I->seeInField(DiscountsPage::$BeginValueDiscount, '6');
        $I->seeInField(DiscountsPage::$OnDateEdit, "$date");
        $keyDisc=$I->grabValueFrom(DiscountsPage::$DiscountKey);
        $I->comment($keyDisc);
        $I->click(DiscountsPage::$GoBackButton);
        $I->waitForText('Скидки интернет-магазина');
        $I->see($keyDisc, DiscountsPage::DisKeyLine('1'));
        $I->see('9SymbolsFixMethodDiscount + LimitDiscount', DiscountsPage::NameLine('1'));
        $I->see('1', DiscountsPage::LimitLine('1'));
        $I->see('-', DiscountsPage::UseDiscLine('1'));
        $I->see($date, DiscountsPage::BeginTimeLine('1'));
        $I->see('-', DiscountsPage::EndTimeLine('1'));
        $activeDisc=$I->grabAttributeFrom(DiscountsPage::ActiveButtonLine('1'), 'class');
        $I->comment($activeDisc);
        $I->assertEquals($activeDisc, 'prod-on_off');
    }
    
    
    public function Symbols10FixMethodInCreate(AcceptanceTester $I)
    {
        $I->amOnPage("/admin/components/init_window/mod_discount/create");        
        $I->fillField(DiscountsPage::$NameDiscountCreate, '10SymbolsFixMethodAllOrdersDiscount');        
        $I->click(DiscountsPage::$UnlimitedCheckboxCreate);
        $I->fillField(DiscountsPage::$AmountOfUse, '1');
        $I->click(DiscountsPage::$SelectMethod);
        $I->click(DiscountsPage::$SelectMethod.'/option[2]');
        $I->fillField(DiscountsPage::$ValueDiscount, '2222222222');
        $I->click(DiscountsPage::$SelectTypeDiscount);
        $I->click(DiscountsPage::$SelectTypeDiscount.'/option[2]');
        $I->fillField(DiscountsPage::$BeginValueDiscount, '6');
        $I->click(DiscountsPage::$OnDateCreate);
        $I->click(".//*[@id='ui-datepicker-div']/table/tbody/tr[4]/td/a");        
        $date=$I->grabValueFrom(DiscountsPage::$OnDateCreate);
        $I->comment($date);
        $I->click(DiscountsPage::$SaveButton);
        $I->waitForText("Редактирование скидки");
        //$I->waitForElementVisible('.alert.in.fade.alert-success');
        //$I->see('Скидка успешно создана!');
        //$I->waitForElementNotVisible('.alert.in.fade.alert-success');
        $I->seeInField(DiscountsPage::$NameDiscountEdit, '10SymbolsFixMethodAllOrdersDiscount');
        $I->seeInField(DiscountsPage::$AmountOfUse, '1');
        $I->seeInField(DiscountsPage::$ValueDiscount, '222222222');
        $I->seeInField(DiscountsPage::$BeginValueDiscount, '6');
        $I->seeInField(DiscountsPage::$OnDateEdit, "$date");
    }
}