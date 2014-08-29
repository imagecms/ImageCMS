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
        $I->fillField(seoexpertPage::$SeoSubCatFieldTitle, 'САБББ ЭТО ТАЙТЛ ДЛЯ СТРАНИЦЫ САБААБ');
        $I->fillField(seoexpertPage::$SeoSubCatFieldDescription, 'О пBиИИИсание САБ КАТЕГОРИИИИ');
        $I->fillField(seoexpertPage::$SeoSubCatFieldLength, '56');
        $I->fillField(seoexpertPage::$SeoSubCatFieldKeywords, 'Коооо неа ипм чевые слова дляСАБ САБ СБ');
        $I->click(seoexpertPage::$SeoSubCatCheckBoxActive);
        $I->wait('1');
        $I->click(seoexpertPage::$SeoButtSave);
        $I->wait('1');
        $I->amOnPage('/shop/category/zzzz-kategoriia-dlia-seo/oooo-seo-sab-kat');
        $I->wait('2');
        $I->seeInPageSource('САБББ ЭТО ТАЙТЛ ДЛЯ СТРАНИЦЫ САБААБ');
        $I->seeInPageSource('О пBиИИИсание САБ КАТЕГОРИИИИ');
        $I->seeInPageSource('Коооо неа ипм чевые слова дляСАБ САБ СБ');
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
}    