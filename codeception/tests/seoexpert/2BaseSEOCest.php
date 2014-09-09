<?php

use \SeoExpertTester;
class BaseSEOCest

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
     */
    public function CkeckOptionSiteNoWork (SeoExpertTester $I){
        $I->amOnPage(seoexpertPage::$SeoUrl);
        $I->wait('1');
        $I->click(seoexpertPage::$SeoBaseRadioButtSiteNameNo);
        $I->wait('1');
        $I->click(seoexpertPage::$SeoButtSave);
        $I->wait('1');
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
        $I->wait('1');
        $I->click(seoexpertPage::$SeoButtSave);
        $I->wait('1');
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
        $I->wait('1');
        $I->click(seoexpertPage::$SeoButtSave);
        $I->wait('1');
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
        $I->wait('1');
        $I->click(seoexpertPage::$SeoButtSave);
        $I->wait('1');
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
    
    

    
    
}