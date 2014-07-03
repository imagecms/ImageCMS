<?php
use \AcceptanceTester;

class MainCurrencyCest
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
        $I->amOnPage("/admin/components/run/shop/currencies");
        $I->waitForText("Список валют", "10", "//*[@id='mainContent']/section/div[1]/div[1]/span[2]");
    }    
    public function VerifyButtons(AcceptanceTester $I)
    {
        $rows = $I->grabTagCount($I,"tbody tr");
        $I->comment((string)$rows);
        //Searching main currencie line
        for ($j=1;$j<$rows;++$j){
            //grab arrtibute checked from radiobutton
            $atribCheck = $I->grabAttributeFrom("//tbody/tr[$j]/td[5]/input","checked");
            if($atribCheck == TRUE){
                break;
            }
        }
        //grab class from active button
        $butActiveClass = $I->grabAttributeFrom(CurrenciesPage::ActiveButtonLine($j), "class");
        $I->comment("$butActiveClass");
        $disabled = $I->grabAttributeFrom(CurrenciesPage::DeleteButtonLine($j), "disabled");
        codecept_debug($disabled);
        if($disabled != TRUE){
            $I->comment("ERROR Button Active");
        }
        else {
            $I->comment("PASSED Button Disabled");
        }
        
        if($butActiveClass == 'prod-on_off disable_tovar'){

            $I->click(CurrenciesPage::ActiveButtonLine($j));
            $butActiveClass = $I->grabAttributeFrom(CurrenciesPage::ActiveButtonLine($j), "class");
            $I->comment("$butActiveClass");
            if($butActiveClass == 'prod-on_off'){
                $I->comment("ERROR Additional Main Currency");
            }
            else {
                $I->comment("PASSED Not Additional Main Currency");
            }
        }
        $disabled = $I->grabAttributeFrom(CurrenciesPage::DeleteButtonLine($j), "disabled");
        if($disabled != TRUE){
            $I->comment("ERROR Button Active");
        }
        else {
            $I->comment("PASSED Button Disabled");
        }
        
        $I->click(CurrenciesPage::RadioButtonLine($j));
        $atribCheck = $I->grabAttributeFrom("//tbody/tr[$j]/td[5]/input","checked");
        if ($atribCheck != TRUE ){
            $I->comment("ERROR");
        }
        else {
            $I->comment ("Passed");
        }    
        $j<$rows?$I->click(CurrenciesPage::RadioButtonLine($j+1)):$I->click(CurrenciesPage::RadioButtonLine($j-1));
        $true = 0;
        for ($k=1;$k<=$rows;++$k){
            $grabbedAttrib = $I->grabAttributeFrom(CurrenciesPage::RadioButtonLine($k), "checked"); 
            $I->comment("$grabbedAttrib");
            if($grabbedAttrib == "true"){
                 $true++;
            }
        }
        $true == 1?$I->comment("PASSED tr: $true\n"):$I->comment("ERROR tr: $true\n");
        
        }

}