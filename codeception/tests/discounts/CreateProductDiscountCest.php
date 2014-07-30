<?php
use \AcceptanceTester;

class CreateProductDiscountCest
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
        $I->click(DiscountsPage::$SelectTypeDiscount.'/option[7]');
        $I->wait('1');
        $I->see('ID / Название / Артикул :', ".//*[@id='productBlock']/div/label[2]");                
    }
    
    
    public function TypesOfSymbolsInCreate(AcceptanceTester $I)
    {
        $I->amOnPage('/admin/components/run/shop/products/create');
        $I->fillField('.//*[@id="Name"]', 'Товар');
        $I->fillField(".//*[@id='ProductVariantRow_0']/td[2]/input", '2000');
        $I->click(".//*[@id='ProductVariantRow_0']/td[3]/div/a/span");
        $I->click(".//*[@id='ProductVariantRow_0']/td[3]/div/div/ul/li[3]");        
        $I->click(CurrenciesPage::$SaveAndExitButton);
        $I->waitForText("Продукт был успешно создан");
        $I->waitForText("Список товаров");
        $I->fillField(".//*[@id='filter_form']/section/div[2]/table/thead/tr[2]/td[3]/input", "товар");
        $I->click(".//*[@id='filter_form']/section/div[1]/div[2]/div/button[1]");
        $I->wait('1');
        $kil=$I->grabTagCount($I, "tbody tr");
        for ($j=1; $j<=$kil; $j++){
            $tovar=$I->grabTextFrom(".//*[@id='filter_form']/section/div[2]/table/tbody/tr[$j]/td[3]/div/a");
            $I->comment("$tovar");
            if ($tovar=="Товар"){
                $id=$I->grabTextFrom(".//*[@id='filter_form']/section/div[2]/table/tbody/tr[last()]/td[2]/p");
                $I->comment($id);
                break;
            }            
        }        
        $I->amOnPage("/admin/components/init_window/mod_discount/create");        
        $I->fillField(DiscountsPage::$ValueDiscount, '10');        
        $I->click(DiscountsPage::$SelectTypeDiscount);
        $I->click(".//*[@id='selectDiscountType']/option[7]");        
        $I->wait('1');
        $I->fillField(DiscountsPage::$ProductForDiscount, 'то');
        $I->wait('1');
        $sum=$I->grabClassCount($I, "ui-menu-item");
        $I->comment($sum);
        for ($i=1; $i<=$sum; $i++){
            $product=$I->grabTextFrom(".//*[@class='ui-autocomplete ui-menu ui-widget ui-widget-content ui-corner-all']/li[$i]/a");
            $I->comment($product);
            if ($product=="$id - Товар"){
                $I->click(".//*[@class='ui-autocomplete ui-menu ui-widget ui-widget-content ui-corner-all']/li[$i]/a");
                break;
            }            
        }
        $I->seeInField(DiscountsPage::$ProductForDiscount, "$id - Товар");
    }
}