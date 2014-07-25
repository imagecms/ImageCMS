<?php
use \AcceptanceTester;

class CreateCategoryDiscountCest
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
        $I->amOnPage("/admin/components/run/shop/categories/index");
        $kil1=$I->grabClassCount($I, "btn btn-small my_btn_s");
        $I->comment($kil1);
        for ($j=1; $j<=$kil1; $j++){
            $I->click(".//*[@id='category']/div[2]/div/div[$j]/div/div[3]/div/button[2]");
            $I->wait('1');
            $catAll[$j]=$I->grabTextFrom(".//*[@id='category']/div[2]/div/div[$j]/div[1]/div[3]/div/a");
            $I->comment("$catAll[$j]");
            $k=2;
            //$sum=$I->grabAttributeFrom(".//*[@id='category']/div[2]/div/div[$j]/div[$k]/div/div[1]/div[3]/div/a", "")
            //$class=$I->grabAttributeFrom(".//*[@id='category']/div[2]/div/div[$j]/div[2]/div[$k]/div/a", $attribute);
        }
        
    }
}