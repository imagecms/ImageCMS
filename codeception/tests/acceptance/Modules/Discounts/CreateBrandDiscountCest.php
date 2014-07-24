<?php
use \AcceptanceTester;

class CreateBrandDiscountCest
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
        $I->amOnPage("/admin/components/run/shop/brands/index");
        $kil1=$I->grabClassCount($I, "niceCheck");
        $kil2=$kil1-1;
        $I->comment("$kil2");
        $pag=$I->grabClassCount($I, "pagination pull-left");
        $I->comment("$pag");
        if ($pag=0){
            for ($j=1; $j<=$kil2; $j++){
                $brandList[$j]=$I->grabTextFrom(".//*[@id='brands_filter']/table/tbody/tr[$j]/td[3]/a");
                $I->comment("$brandList[$j]");
            }
        }
        else {
            $but=1;
            for ($j=1; $j<=$kil2; $j++){
                $brandList[$j]=$I->grabTextFrom(".//*[@id='brands_filter']/table/tbody/tr[$j]/td[3]/a");
                $I->comment("$brandList[$j]");
            }
            $BrandAllList=  implode(" ", $brandList);
            $I->comment($BrandAllList);
            for ($i=1; $i<=$but; $i++){
                $pag2=$I->grabAttributeFrom(".//*[@id='brands_filter']/div/div[2]/ul/li[2]/a", "class");
                $I->comment("$pag2");
                if ($pag='pjax'){
                    $but++;
                }
                while ($pag2!="disabled"){
                    $I->click(".//*[@id='brands_filter']/div/div[2]/ul/li[2]/a");
                    $I->wait('2');
                    $kil3=$I->grabClassCount($I, "niceCheck");
                    $kil4=$kil3-1;
                    $I->comment("$kil4");
                    for ($n=1; $n<=$kil4; $n++){
                        $brandList[$n]=$I->grabTextFrom(".//*[@id='brands_filter']/table/tbody/tr[$n]/td[3]/a");
                        $I->comment("$brandList[$n]");
                    }
                    $BrandAllList=  implode(" ", $brandList);
                    $I->comment($BrandAllList);
                    if ($kil4<24){
                        break;
                    }
                }
                $i++;                
            }
            $BrandAllList=  implode(" ", $brandList);
            $I->comment($BrandAllList);
        }
    }
}