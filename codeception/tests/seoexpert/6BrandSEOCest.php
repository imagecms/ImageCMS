<?php

use \SeoExpertTester;
class BrandSEOCest

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
    public function ShopBrandPage (SeoExpertTester $I){
        $I->amOnPage(seoexpertPage::$SeoUrl);
        $I->wait('1');
        $I->click(seoexpertPage::$SeoButtShop);
        $I->wait('1');
        $I->fillField(seoexpertPage::$SeoBrandFieldTitle, '');
        $I->fillField(seoexpertPage::$SeoBrandFieldDescription, '');
        $I->fillField(seoexpertPage::$SeoBrandFieldLength, '');
        $I->fillField(seoexpertPage::$SeoBrandFieldKeywords, '');
        $I->click(seoexpertPage::$SeoBrandCheckBoxActive);
        $I->wait('1');
        $I->click(seoexpertPage::$SeoButtSave);
        $I->wait('1');
        $I->amOnPage('/shop/brand/pro100-brend#');
        $I->wait('2');
        $I->seeInPageSource('');
        $I->seeInPageSource('');
        $I->seeInPageSource('');
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
}    

