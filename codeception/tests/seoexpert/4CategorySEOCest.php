<?php

use \SeoExpertTester;
class CategorySEOCest

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
     */
    public function ShopCategoryPage (SeoExpertTester $I){
        $I->amOnPage(seoexpertPage::$SeoUrl);
        $I->wait('1');
        $I->click(seoexpertPage::$SeoButtShop);
        $I->wait('1');
        $I->fillField(seoexpertPage::$SeoCategoryTitle, '');
        $I->fillField(seoexpertPage::$SeoCategoryDescription, '');
        $I->fillField(seoexpertPage::$SeoCategoryLength, '');
        $I->fillField(seoexpertPage::$SeoCategoryKeywords, '');
        $I->click(seoexpertPage::$SeoCategoryCheckBoxActive);
        $I->wait('1');
        $I->click(seoexpertPage::$SeoButtSave);
        $I->wait('1');
        $I->amOnPage('/shop/category/zzzz-kategoriia-dlia-seo#');
        $I->wait('2');
        $I->seeInPageSource('');
        $I->seeInPageSource('');
        $I->seeInPageSource('');
    }
    
    
    
    
    
}    
