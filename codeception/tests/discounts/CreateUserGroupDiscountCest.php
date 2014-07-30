<?php
use \AcceptanceTester;

class CreateUserGroupDiscountCest
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
        $I->click(DiscountsPage::$SelectTypeDiscount.'/option[5]');
        $I->wait('1');
        $activeRadioBut=$I->grabAttributeFrom(".//*[@id='group_userBlock']/label[1]/input", 'checked');
        $I->comment("$activeRadioBut");
        $I->assertEquals($activeRadioBut, 'true');
        $script = "$('<p id=\"radioButtonAmount\"></p>').text( $(\"input[type='radio']\").length).appendTo('body')";
        $I->executeJS($script);
        $kil = $I->grabTextFrom("#radioButtonAmount");
        $I->comment("$kil");
        for ($j=1; $j<=$kil; $j++){
            $group[$j]=$I->grabTextFrom(".//*[@id='group_userBlock']/label[$j]");
            $I->comment("$group[$j]");
        }
        $AllGroupDiscount=  implode(" ", $group);
        $I->comment($AllGroupDiscount);
        $I->amOnPage("/admin/rbac/roleList");
        $kil2=$I->grabTagCount($I, "tbody tr");
        $I->comment("$kil2");
        for ($i=1; $i<=$kil2; $i++){
            $role[$i]=$I->grabTextFrom(".//*[@id='mainContent']/div/form/section/div[2]/div/table/tbody/tr[$i]/td[3]/a");
            $I->comment("$role[$i]");            
        }
        $AllRoles=  implode(" ", $role);
        $I->assertEquals($kil2, $kil);
        $I->assertEquals($AllRoles, $AllGroupDiscount);
    }
}