<?php
use \AcceptanceTester;

class CreateUserDiscountCest
{
    public function _before()
    {
    }
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
        $I->click(DiscountsPage::$SelectTypeDiscount.'/option[4]');
        $I->wait('1');
        $I->see('ID / Имя / Электронная почта :', ".//*[@id='userBlock']/div/div/label[2]");
    }
    
    
    public function RequiredFieldsInCreateSaveButton(AcceptanceTester $I)
    {
        $I->amOnPage("/admin/components/init_window/mod_discount/create");
        $I->click(DiscountsPage::$SelectTypeDiscount);
        $I->click(DiscountsPage::$SelectTypeDiscount.'/option[4]');        
        $I->click(DiscountsPage::$SaveButton);
        $I->waitForElement(".//*[@id='createDiscountForm']/table/tbody/tr[2]/td/div/div/div[2]/div[2]/div[2]/label");
        $I->see('Это поле обязательное.', ".//*[@id='createDiscountForm']/table/tbody/tr[2]/td/div/div/div[2]/div[2]/div[2]/label");
        $I->see('Это поле обязательное.', ".//*[@id='userBlock']/div/div/label[3]");
        $I->see('Это поле обязательное.', ".//*[@id='createDiscountForm']/table/tbody/tr[4]/td/div/div[2]/div[2]/div/span[1]/label/label");        
    }
    
    
    public function RequiredFieldsInCreateSaveAndExitButton(AcceptanceTester $I)
    {
        $I->amOnPage("/admin/components/init_window/mod_discount/create");
        $I->click(DiscountsPage::$SelectTypeDiscount);
        $I->click(DiscountsPage::$SelectTypeDiscount.'/option[4]');        
        $I->click(DiscountsPage::$SaveAndExitButton);
        $I->waitForElement(".//*[@id='createDiscountForm']/table/tbody/tr[2]/td/div/div/div[2]/div[2]/div[2]/label");
        $I->see('Это поле обязательное.', ".//*[@id='createDiscountForm']/table/tbody/tr[2]/td/div/div/div[2]/div[2]/div[2]/label");
        $I->see('Это поле обязательное.', ".//*[@id='userBlock']/div/div/label[3]");
        $I->see('Это поле обязательное.', ".//*[@id='createDiscountForm']/table/tbody/tr[4]/td/div/div[2]/div[2]/div/span[1]/label/label");        
    }
    
    
    public function TypesOfSymbolsInCreate(AcceptanceTester $I)
    {
        $I->amOnPage('/admin/components/run/shop/users/create');        
        $I->fillField(".//*[@id='UserEmail']", 'a@a.aa');
        $I->fillField(".//*[@id='Password']", 'aaaaa');
        $I->fillField(".//*[@id='Name']", 'Aaa');                
        $I->click(".//*[@id='mainContent']/div/section/div[1]/div[2]/div/button[2]");
        $I->waitForText("Пользователь создан");
        $I->waitForText("Список пользователей");
        $userId=$I->grabTextFrom(".//*[@id='ordersListFilter']/table/tbody/tr[last()]/td[2]/a");        
        $I->amOnPage("/admin/components/init_window/mod_discount/create");        
        $I->fillField(DiscountsPage::$ValueDiscount, '10');        
        $I->click(DiscountsPage::$SelectTypeDiscount);
        $I->click(".//*[@id='selectDiscountType']/option[4]");        
        $I->wait('1');
        $I->fillField(DiscountsPage::$UserForDiscount, 'dddddddddddd');
        $I->wait('1');
        $I->fillField(DiscountsPage::$ValueDiscount, '10');
        $I->click(DiscountsPage::$OnDateCreate);
        $I->click(".//*[@id='ui-datepicker-div']/table/tbody/tr[4]/td/a");
        $I->click(DiscountsPage::$SaveButton);
        $I->waitForElementVisible(".alert.in.fade.alert-error");
        $I->see("Введите пользователя, который находится в базе данных", ".alert.in.fade.alert-error");
        $I->waitForElementNotVisible(".alert.in.fade.alert-error");
        $I->fillField(DiscountsPage::$UserForDiscount, 'a');
        $I->wait('1');
        $sum=$I->grabClassCount($I, "ui-menu-item");
        $I->comment($sum);
        for ($i=1; $i<=$sum; $i++){
            $user=$I->grabTextFrom(".//*[@class='ui-autocomplete ui-menu ui-widget ui-widget-content ui-corner-all']/li[$i]/a");
            $I->comment($user);
            if ($user=="$userId - Aaa - a@a.aa"){
                $I->click(".//*[@class='ui-autocomplete ui-menu ui-widget ui-widget-content ui-corner-all']/li[$i]/a");
                break;
            }            
        }
        $I->seeInField(DiscountsPage::$UserForDiscount, "$userId - Aaa - a@a.aa");
    }
    
}