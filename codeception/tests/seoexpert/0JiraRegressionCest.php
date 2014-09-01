<?php

use \SeoExpertTester;
class JiraRegresionCest

{
    
//---------------------------AUTORIZATION--------------------------------------- 
    /**
     * @group aa
     */
    public function Login(SeoExpertTester $I){
        InitTest::Login($I);
    }
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps 
     */
    public function CreateCategoryForJiraTests(SeoExpertTester\seoexpertSteps $I) {
        $I->SeoCreateCategoryProduct($createNameCategory = 'Jira Tests');
    }
    
    
    

    /**
     * @group aa
     */
    public function ICMS258ICMS336ButtonBackSaveAndBack(SeoExpertTester $I) {
        $NameCategory = 'Jira Tests';
        $I->amOnPage(seoexpertPage::$SeoUrl);
        $I->wait('1');
        $I->see('Вернуться', seoexpertPage::$SeoButtBack);
        $I->click(seoexpertPage::$SeoButtShop);
        $I->wait('1');
        $I->click(seoexpertPage::$SeoProductButtAdvanced);
        $I->wait('1');
        $I->see('Вернуться', seoexpertPage::$SeoAdvencedButtBack);
        $I->click(seoexpertPage::$SeoAdvencedButtAddCategory);
        $I->wait('1');
        $I->see('Вернуться', seoexpertPage::$SeoCreatePageButtBack);
        $I->fillField(seoexpertPage::$SeoCreatePageFieldCategory, $NameCategory);
        $I->wait('3');
        $I->click(seoexpertPage::$SeoCreatePageSelectCategory);
        $I->click(seoexpertPage::$SeoCreatePageButtSave);
        $I->wait('3');
        $ListNameCategory = $I->grabTextFrom(seoexpertPage::$SeoAdvencedLinkCategory);
        $I->comment("Такое название первой категории $ListNameCategory");
        $I->wait('3');
        $AmountRows = $I->grabTagCount($I, 'tbody tr');
         $I->comment("Количество строк $AmountRows");
        if($ListNameCategory == $NameCategory){
            $I->click(seoexpertPage::$SeoAdvencedLinkCategory);
            $I->see("Редактирование метаданных категории $NameCategory", seoexpertPage::$SeoEditPageTitle);  
            $I->see('Вернуться', seoexpertPage::$SeoEditPageButtBack);    
            $I->see('Сохранить и выйти', seoexpertPage::$SeoEditPageButtSaveAndBack);            
        }
        elseif($ListNameCategory != $NameCategory) {
            for($j = 1;$j < $AmountRows;$j++){
                $a = $I->grabTextFrom("//body/div[1]/div[5]/section/table/tbody/tr[$j]/td[2]/a"); 
                $I->comment(" вот вот вот $a");
                    if($a == $NameCategory){
                    $I->click("//body/div[1]/div[5]/section/table/tbody/tr[$j]/td[2]/a");
                    $I->wait('1');
                    $I->see("Редактирование метаданных категории $NameCategory", seoexpertPage::$SeoEditPageTitle);  
                    $I->see('Вернуться', seoexpertPage::$SeoEditPageButtBack);
                    $I->see('Сохранить и выйти', seoexpertPage::$SeoEditPageButtSaveAndBack);
                    break;
                    } 
            }
        }
    
    }
    
    
    
    
    
    
    
    
    
    
}