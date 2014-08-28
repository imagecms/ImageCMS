<?php

use \SeoExpertTester;
class FrontSettingsSEOCest

{
    
//---------------------------AUTORIZATION--------------------------------------- 
    /**
     * @group a
     */
    public function Login(SeoExpertTester $I){
        InitTest::Login($I);
    }
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps 
     */
    public function CreateCategoryForFront (SeoExpertTester\seoexpertSteps $I){
        $I->SeoCreateCategoryProduct($createNameCategory = 'Zzzz категория для SEO');
    }
    
    

    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps 
     */
    public function CreateSubCategoryForFront (SeoExpertTester\seoexpertSteps $I){
        $I->SeoCreateCategoryProduct($createNameCategory = 'Oooo SEO Саб Кат', $addParentCategory = 'Zzzz');
    }
    
    

    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps 
     */
    public function CreatуBrandForFront (SeoExpertTester\seoexpertSteps $I){
        $I->SeoCreateBrand($brandName = 'Про100 Бренд');
    }
    
    

    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps 
     */
    public function CreateProductForFront (SeoExpertTester\seoexpertSteps $I){
        $I->SeoCreateProduct($NameProduct = 'Товарчик для SEO експерта', $PriceProduct = '777', $BrandProduct = 'Про100 Бренд', $CategoryProduct = 'Zzzz категория для SEO');

    }
    
    
    /**
     * @group a
     */
    public function CkeckOptionSiteNoWork (SeoExpertTester $I){
        $I->amOnPage(seoexpertPage::$SeoUrl);
        $I->wait('1');
        $I->click(seoexpertPage::$SeoBaseRadioButtSiteNameNo);
        $I->wait('5');
        $I->click(seoexpertPage::$SeoButtSave);
        $I->wait('5');
        $I->amOnPage('/shop/category/zzzz-kategoriia-dlia-seo#');
        $I->wait('1');
        $I->seeInPageSource('lastbuild.loc');
    }
    
    
    
    
    /**
     * @group a
     */
    public function CkeckOptionSiteYesWork (SeoExpertTester $I){
        $I->amOnPage(seoexpertPage::$SeoUrl);
        $I->wait('1');
        $I->click(seoexpertPage::$SeoBaseRadioButtSiteNameYes);
        $I->wait('5');
        $I->click(seoexpertPage::$SeoButtSave);
        $I->wait('5');
        $I->amOnPage('/shop/category/zzzz-kategoriia-dlia-seo#');
        $I->wait('1');
        $I->seeInPageSource('lastbuild.loc');
    }
    
    
    
     /**
     * @group a
     */
    public function CkeckOptionCatNoWork (SeoExpertTester $I){
        $I->amOnPage(seoexpertPage::$SeoUrl);
        $I->wait('1');
        $I->click(seoexpertPage::$SeoBaseRadioButtCategoryNameNo);
        $I->wait('5');
        $I->click(seoexpertPage::$SeoButtSave);
        $I->wait('5');
        $I->amOnPage('/shop/category/zzzz-kategoriia-dlia-seo#');
        $I->wait('1');
        $I->seeInPageSource('Zzzz категория для SEO');
    }
    
    
    
    /**
     * @group a
     */
    public function CkeckOptionCatNYesWork (SeoExpertTester $I){
        $I->amOnPage(seoexpertPage::$SeoUrl);
        $I->wait('1');
        $I->click(seoexpertPage::$SeoBaseRadioButtCategoryNameYes);
        $I->wait('5');
        $I->click(seoexpertPage::$SeoButtSave);
        $I->wait('5');
        $I->amOnPage('/shop/category/zzzz-kategoriia-dlia-seo#');
        $I->wait('1');
        $I->seeInPageSource('Zzzz категория для SEO');
    }
    
    
    /**
     * @group a
     */
    public function CkeckFieldSeparatorSympol1 (SeoExpertTester $I){
        $I->amOnPage(seoexpertPage::$SeoUrl);
        $I->wait('1');
        $I->click(seoexpertPage::$SeoBaseRadioButtSiteNameYes);
        $I->click(seoexpertPage::$SeoBaseRadioButtCategoryNameYes);
        $I->fillField(seoexpertPage::$SeoBaseFieldSeparator, './*-+');
        $I->wait('1');
        $I->click(seoexpertPage::$SeoButtSave);
        $I->wait('1');
        $I->amOnPage('/shop/category/zzzz-kategoriia-dlia-seo#');
        $I->wait('1');
        $I->seeInPageSource('Zzzz категория для SEO ./*-+ lastbuild.loc');
    }
    
    
    
    
    /**
     * @group a
     */
    public function CkeckFieldSeparatorSympol2 (SeoExpertTester $I){
        $I->amOnPage(seoexpertPage::$SeoUrl);
        $I->wait('1');
        $I->click(seoexpertPage::$SeoBaseRadioButtSiteNameYes);
        $I->click(seoexpertPage::$SeoBaseRadioButtCategoryNameYes);
        $I->fillField(seoexpertPage::$SeoBaseFieldSeparator, '|%#@');
        $I->wait('1');
        $I->click(seoexpertPage::$SeoButtSave);
        $I->wait('1');
        $I->amOnPage('/shop/category/zzzz-kategoriia-dlia-seo#');
        $I->wait('1');
        $I->seeInPageSource('Zzzz категория для SEO |%#@ lastbuild.loc');
    }
    
    
    
    
    /**
     * @group a
     */
    public function CkeckFieldSeparatorSympol3 (SeoExpertTester $I){
        $I->amOnPage(seoexpertPage::$SeoUrl);
        $I->wait('1');
        $I->click(seoexpertPage::$SeoBaseRadioButtSiteNameYes);
        $I->click(seoexpertPage::$SeoBaseRadioButtCategoryNameYes);
        $I->fillField(seoexpertPage::$SeoBaseFieldSeparator, '~=\}');
        $I->wait('1');
        $I->click(seoexpertPage::$SeoButtSave);
        $I->wait('1');
        $I->amOnPage('/shop/category/zzzz-kategoriia-dlia-seo#');
        $I->wait('1');
        $I->seeInPageSource('Zzzz категория для SEO ~=\} lastbuild.loc');
    }
    
    
    
    
    
    /**
     * @group a
     */
    public function CkeckFieldSeparatorSympol4 (SeoExpertTester $I){
        $I->amOnPage(seoexpertPage::$SeoUrl);
        $I->wait('1');
        $I->click(seoexpertPage::$SeoBaseRadioButtSiteNameYes);
        $I->click(seoexpertPage::$SeoBaseRadioButtCategoryNameYes);
        $I->fillField(seoexpertPage::$SeoBaseFieldSeparator, '1230');
        $I->wait('1');
        $I->click(seoexpertPage::$SeoButtSave);
        $I->wait('1');
        $I->amOnPage('/shop/category/zzzz-kategoriia-dlia-seo#');
        $I->wait('1');
        $I->seeInPageSource('Zzzz категория для SEO 1230 lastbuild.loc');
    }
    
    
    
    
    
    
    /**
     * @group a
     */
    public function CkeckFieldSeparatorSympol5 (SeoExpertTester $I){
        $I->amOnPage(seoexpertPage::$SeoUrl);
        $I->wait('1');
        $I->click(seoexpertPage::$SeoBaseRadioButtSiteNameYes);
        $I->click(seoexpertPage::$SeoBaseRadioButtCategoryNameYes);
        $I->fillField(seoexpertPage::$SeoBaseFieldSeparator, 'ЙЦол');
        $I->wait('1');
        $I->click(seoexpertPage::$SeoButtSave);
        $I->wait('1');
        $I->amOnPage('/shop/category/zzzz-kategoriia-dlia-seo#');
        $I->wait('1');
        $I->seeInPageSource('Zzzz категория для SEO ЙЦол lastbuild.loc');
    }
    
    
    
    /**
     * @group a
     */
    public function CkeckFieldOpisanie1 (SeoExpertTester $I){
        $I->amOnPage(seoexpertPage::$SeoUrl);
        $I->wait('1');
        $I->fillField(seoexpertPage::$SeoBaseFieldDescription, '098765 ~!@##$^% ЗЩШГ фыва хіь POI ZXC');
        $I->wait('1');
        $I->click(seoexpertPage::$SeoButtSave);
        $I->wait('1');
        $I->amOnPage('/');
        $I->wait('1');
        $I->seeInPageSource('098765 ~!@##$^% ЗЩШГ фыва хіь POI ZXC');
    }
    
    
    
    
    /**
     * @group a
     */
    public function CkeckFieldOpisanie2 (SeoExpertTester $I){
        $I->amOnPage(seoexpertPage::$SeoUrl);
        $I->wait('1');
        $I->fillField(seoexpertPage::$SeoBaseFieldKeywords, 'Keywords а также Ключевыэ сЛоВЫААА р2д2 брр и в том стиле');
        $I->wait('1');
        $I->click(seoexpertPage::$SeoButtSave);
        $I->wait('1');
        $I->amOnPage('/');
        $I->wait('1');
        $I->seeInPageSource('Keywords а также Ключевыэ сЛоВЫААА р2д2 брр и в том стиле');
    }
    
    
    
    /**
     * @group a
     */
    public function ShopProductPage (SeoExpertTester $I){
        $I->amOnPage(seoexpertPage::$SeoUrl);
        $I->wait('1');
        $I->click(seoexpertPage::$SeoButtShop);
        $I->wait('1');
        $I->fillField(seoexpertPage::$SeoProductTitle, 'ЭТО ТАЙТЛ ДЛЯ СТРАНИЦЫ ПРОДУКТОВ');
        $I->fillField(seoexpertPage::$SeoProductDescription, 'ООООООООООООО писание для страницы продуктов');
        $I->fillField(seoexpertPage::$SeoProductLength, '500');
        $I->fillField(seoexpertPage::$SeoProductKeywords, 'Клллллллллллллллллллллл ючевые слова для страницы подуктоВВВВ');
        $I->click(seoexpertPage::$SeoProductCheckBoxActive);
        $I->wait('1');
        $I->click(seoexpertPage::$SeoButtSave);
        $I->wait('1');
        $I->amOnPage('/shop/product/tovarchik-dlia-seo-eksperta');
        $I->wait('2');
        $I->seeInPageSource('ЭТО ТАЙТЛ ДЛЯ СТРАНИЦЫ ПРОДУКТОВ');
        $I->seeInPageSource('ООООООООООООО писание для страницы продуктов');
        $I->seeInPageSource('Клллллллллллллллллллллл ючевые слова для страницы подуктоВВВВ');
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