<?php

use \SeoExpertTester;
class SubcategorySEOCest

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
    public function CreateSubCategoryForFront (SeoExpertTester\seoexpertSteps $I){
        $I->SeoCreateCategoryProduct($createNameCategory = 'Ooo Сео Саб Кат', $addParentCategory = 'seo SEO seo');
    }
    
    
    
     /**
     * @group a
     */
    public function ShopSubCategoryPage (SeoExpertTester $I){
        $I->amOnPage(seoexpertPage::$SeoUrl);
        $I->wait('1');
        $I->click(seoexpertPage::$SeoButtShop);
        $I->wait('1');
        $I->fillField(seoexpertPage::$SeoSubCatFieldTitle, '');
        $I->fillField(seoexpertPage::$SeoSubCatFieldDescription, '');
        $I->fillField(seoexpertPage::$SeoSubCatFieldLength, '');
        $I->fillField(seoexpertPage::$SeoSubCatFieldKeywords, '');
        $I->click(seoexpertPage::$SeoSubCatCheckBoxActive);
        $I->wait('1');
        $I->click(seoexpertPage::$SeoButtSave);
        $I->wait('1');
        $I->amOnPage('/shop/category/zzzz-kategoriia-dlia-seo/oooo-seo-sab-kat');
        $I->wait('2');
        $I->seeInPageSource('');
        $I->seeInPageSource('');
        $I->seeInPageSource('');
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
}    