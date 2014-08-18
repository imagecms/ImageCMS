<?php
use \DiscountsTester;

class CreateCategoryDiscountCest
{
//    public function _before()
//    {
//    }
//
//    public function _after()
//    {
//    }

    public function Autorization(DiscountsTester $I)
    {
        InitTest::Login($I);
        $I->amOnPage("/admin/components/cp/mod_discount");
        $I->waitForText("Скидки интернет-магазина");
    }
    
    
    public function NamesAndValuesInCreate(DiscountsTester $I)
    {
        $I->amOnPage("/admin/components/init_window/mod_discount/create");
        $I->click(DiscountsPage::$SelectTypeDiscount);
        $I->click(DiscountsPage::$SelectTypeDiscount.'/option[6]');
        $I->wait('1');
        $I->see('Учитывать дочерние категории', ".//*[@id='categoryBlock']");
        $categoryCheck=$I->grabTextFrom(DiscountsPage::$SelectCategory);
        $I->comment("$categoryCheck");
        $I->click(DiscountsPage::$SelectCategory);
        $cat=$I->grabClassCount($I, "active-result");
        $I->comment("$cat");
        for ($i=1; $i<=$cat; $i++){
            $categ[$i]=$I->grabTextFrom(".//*[@id='categoryBlock']/div/div/ul/li[$i]");
            $I->comment("$categ[$i]");
        }
        $AllCategoryDiscount=  implode(" ", $categ);
        $AllCategoryDiscount=str_replace(array('-'),"",$AllCategoryDiscount);        
        $I->comment($AllCategoryDiscount);
        $I->amOnPage("/admin/components/run/shop/categories/index");
        $I->wait(3);
        $I->clickAllElements($I,".btn.expandButton",3);        
        $text = $I->grabTextFromAllElements($I, "div.body_category div.row-category div.share_alt a.pjax");
            foreach ($text as $value) {
                $I->comment("$value");                
            }
        $AllCat=  implode(" ", $text);
        $I->comment($AllCat);
        $AllCat=  str_replace(array('-'),"",$AllCat);
        $I->comment($AllCat);
        $I->assertEquals($AllCat, $AllCategoryDiscount);        
    }
}