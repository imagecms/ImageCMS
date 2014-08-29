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
        $I->fillField(seoexpertPage::$SeoCategoryTitle, 'Кат ЭТО ТАЙТЛ ДЛЯ СТРАНИЦЫ Категорий');
        $I->fillField(seoexpertPage::$SeoCategoryDescription, 'О пBиИИИсание для страницы продуктов');
        $I->fillField(seoexpertPage::$SeoCategoryLength, '56');
        $I->fillField(seoexpertPage::$SeoCategoryKeywords, 'К ю ю ю ю чевые слова для страницы подуктоВВВВ');
        $I->click(seoexpertPage::$SeoCategoryCheckBoxActive);
        $I->wait('1');
        $I->click(seoexpertPage::$SeoButtSave);
        $I->wait('1');
        $I->amOnPage('/shop/category/zzzz-kategoriia-dlia-seo#');
        $I->wait('2');
        $I->seeInPageSource('Кат ЭТО ТАЙТЛ ДЛЯ СТРАНИЦЫ Категорий');
        $I->seeInPageSource('О пBиИИИсание для страницы продуктов');
        $I->seeInPageSource('К ю ю ю ю чевые слова для страницы подуктоВВВВ');
    }
    
    
    
    
    
}    
