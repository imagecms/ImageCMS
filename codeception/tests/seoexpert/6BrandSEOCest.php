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
        $I->fillField(seoexpertPage::$SeoBrandFieldTitle, 'Тайтл Просто тайтловый тайтслс');
        $I->fillField(seoexpertPage::$SeoBrandFieldDescription, 'Ну что я могу сказать про этот бренд в первую');
        $I->fillField(seoexpertPage::$SeoBrandFieldLength, '111');
        $I->fillField(seoexpertPage::$SeoBrandFieldKeywords, '100 сто Бренд диснейленд абрикос курамчос итче трингер нигас фигас');
        $I->click(seoexpertPage::$SeoBrandCheckBoxActive);
        $I->wait('1');
        $I->click(seoexpertPage::$SeoButtSave);
        $I->wait('1');
        $I->amOnPage('/shop/brand/pro100-brend#');
        $I->wait('2');
        $I->seeInPageSource('Тайтл Просто тайтловый тайтслс');
        $I->seeInPageSource('Ну что я могу сказать про этот бренд в первую');
        $I->seeInPageSource('100 сто Бренд диснейленд абрикос курамчос итче трингер нигас фигас');
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
}    

