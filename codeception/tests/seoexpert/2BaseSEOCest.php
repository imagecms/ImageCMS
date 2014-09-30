<?php

use \SeoExpertTester;
class BaseSEOCest

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
    public function CreateCategoryForFront (SeoExpertTester\seoexpertSteps $I){
        $I->SeoCreateCategoryProduct($createNameCategory = 'Zzzz категория для SEO');
    }
    
    
    /**
     * @group aa
     */
    public function BaseDefoultValues (SeoExpertTester $I) {
        $I->amOnPage(seoexpertPage::$SeoUrl);
        $I->click(seoexpertPage::$SeoBaseRadioButtCategoryNameYes);
        $I->click(seoexpertPage::$SeoBaseRadioButtSiteNameYes);
        $I->click(seoexpertPage::$SeoBaseSelectKeywords);
        $I->click(seoexpertPage::$SeoBaseOptionMakeAutomaticKeywords);
        $I->click(seoexpertPage::$SeoBaseSelectDescription);
        $I->click(seoexpertPage::$SeoBaseOptionMakeAutomaticDescription);
        $I->fillField(seoexpertPage::$SeoBaseFieldSeparator, '/');
        $I->fillField(seoexpertPage::$SeoBaseFieldDescription, '');
        $I->fillField(seoexpertPage::$SeoBaseFieldKeywords, '');
        $I->fillField(seoexpertPage::$SeoBaseFieldSiteName, 'lastbuild.loc');
        $I->fillField(seoexpertPage::$SeoBaseFieldShortSiteName, 'lastbuild.loc');
        $I->click(seoexpertPage::$SeoButtSave);
        $I->wait('1');
    }

    
    
    /**
     * @group aa
     */
    public function CkeckOptionSiteNoWork (SeoExpertTester $I){
        $I->amOnPage(seoexpertPage::$SeoUrl);
        $I->wait('1');
        $I->click(seoexpertPage::$SeoBaseRadioButtSiteNameNo);
        $I->wait('1');
        $I->click(seoexpertPage::$SeoButtSave);
        $I->wait('1');
        $I->amOnPage('/shop/category/zzzz-kategoriia-dlia-seo#');
        $I->wait('2');
        $I->seeInPageSource('lastbuild.loc');
    }
    
    
    
    
    /**
     * @group aa
     */
    public function CkeckOptionSiteYesWork (SeoExpertTester $I){
        $I->amOnPage(seoexpertPage::$SeoUrl);
        $I->wait('1');
        $I->click(seoexpertPage::$SeoBaseRadioButtSiteNameYes);
        $I->wait('1');
        $I->click(seoexpertPage::$SeoButtSave);
        $I->wait('1');
        $I->amOnPage('/shop/category/zzzz-kategoriia-dlia-seo#');
        $I->wait('2');
        $I->seeInPageSource('lastbuild.loc');
    }
    
    
    
    /**
     * @group aa
     */
    public function CkeckOptionCatNoWork (SeoExpertTester $I){
        $I->amOnPage(seoexpertPage::$SeoUrl);
        $I->wait('1');
        $I->click(seoexpertPage::$SeoBaseRadioButtCategoryNameNo);
        $I->wait('1');
        $I->click(seoexpertPage::$SeoButtSave);
        $I->wait('1');
        $I->amOnPage('/shop/category/zzzz-kategoriia-dlia-seo#');
        $I->wait('2');
        $I->seeInPageSource('Zzzz категория для SEO');
    }
    
    
    
    /**
     * @group aa
     */
    public function CkeckOptionCatNYesWork (SeoExpertTester $I){
        $I->amOnPage(seoexpertPage::$SeoUrl);
        $I->wait('1');
        $I->click(seoexpertPage::$SeoBaseRadioButtCategoryNameYes);
        $I->wait('1');
        $I->click(seoexpertPage::$SeoButtSave);
        $I->wait('1');
        $I->amOnPage('/shop/category/zzzz-kategoriia-dlia-seo#');
        $I->wait('2');
        $I->seeInPageSource('Zzzz категория для SEO');
    }
    
    
    /**
     * @group aa
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function CkeckFieldSeparatorSympol1 (SeoExpertTester\seoexpertSteps $I){
        $I->amOnPage(seoexpertPage::$SeoUrl);
        $I->wait('1');
        $I->DefoultValues();
        $I->click(seoexpertPage::$SeoBaseRadioButtSiteNameYes);
        $I->click(seoexpertPage::$SeoBaseRadioButtCategoryNameYes);
        $I->fillField(seoexpertPage::$SeoBaseFieldSeparator, './*-+');
        $I->wait('1');
        $I->click(seoexpertPage::$SeoButtSave);
        $I->wait('1');
        $I->amOnPage('/shop/category/zzzz-kategoriia-dlia-seo#');
        $I->wait('2');
        $I->seeInPageSource('Zzzz категория для SEO ./*-+ mini.loc');
    }
    
    
    
    
    /**
     * @group aa
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function CkeckFieldSeparatorSympol2 (SeoExpertTester\seoexpertSteps $I){
        $I->amOnPage(seoexpertPage::$SeoUrl);
        $I->wait('1');
        $I->DefoultValues();
        $I->click(seoexpertPage::$SeoBaseRadioButtSiteNameYes);
        $I->click(seoexpertPage::$SeoBaseRadioButtCategoryNameYes);
        $I->fillField(seoexpertPage::$SeoBaseFieldSeparator, '|%#@');
        $I->wait('1');
        $I->click(seoexpertPage::$SeoButtSave);
        $I->wait('1');
        $I->amOnPage('/shop/category/zzzz-kategoriia-dlia-seo#');
        $I->wait('2');
        $I->seeInPageSource('Zzzz категория для SEO |%#@ mini.loc');
    }
    
    
    
    
    /**
     * @group aa
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function CkeckFieldSeparatorSympol3 (SeoExpertTester\seoexpertSteps $I){
        $I->amOnPage(seoexpertPage::$SeoUrl);
        $I->wait('1');
        $I->DefoultValues();
        $I->click(seoexpertPage::$SeoBaseRadioButtSiteNameYes);
        $I->click(seoexpertPage::$SeoBaseRadioButtCategoryNameYes);
        $I->fillField(seoexpertPage::$SeoBaseFieldSeparator, '~=\}');
        $I->wait('1');
        $I->click(seoexpertPage::$SeoButtSave);
        $I->wait('1');
        $I->amOnPage('/shop/category/zzzz-kategoriia-dlia-seo#');
        $I->wait('2');
        $I->seeInPageSource('Zzzz категория для SEO ~=\} mini.loc');
    }
    
    
    
    
    
    /**
     * @group aa
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function CkeckFieldSeparatorSympol4 (SeoExpertTester\seoexpertSteps $I){
        $I->amOnPage(seoexpertPage::$SeoUrl);
        $I->wait('1');
        $I->DefoultValues();
        $I->click(seoexpertPage::$SeoBaseRadioButtSiteNameYes);
        $I->click(seoexpertPage::$SeoBaseRadioButtCategoryNameYes);
        $I->fillField(seoexpertPage::$SeoBaseFieldSeparator, '1230');
        $I->wait('1');
        $I->click(seoexpertPage::$SeoButtSave);
        $I->wait('1');
        $I->amOnPage('/shop/category/zzzz-kategoriia-dlia-seo#');
        $I->wait('2');
        $I->seeInPageSource('Zzzz категория для SEO 1230 mini.loc');
    }
    
    
    
    
    
    
    /**
     * @group aa
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function CkeckFieldSeparatorSympol5 (SeoExpertTester\seoexpertSteps $I){
        $I->amOnPage(seoexpertPage::$SeoUrl);
        $I->wait('1');
        $I->DefoultValues();
        $I->click(seoexpertPage::$SeoBaseRadioButtSiteNameYes);
        $I->click(seoexpertPage::$SeoBaseRadioButtCategoryNameYes);
        $I->fillField(seoexpertPage::$SeoBaseFieldSeparator, 'ЙЦол');
        $I->wait('1');
        $I->click(seoexpertPage::$SeoButtSave);
        $I->wait('1');
        $I->amOnPage('/shop/category/zzzz-kategoriia-dlia-seo#');
        $I->wait('2');
        $I->seeInPageSource('Zzzz категория для SEO ЙЦол mini.loc');
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
        $I->wait('2');
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
        $I->wait('2');
        $I->seeInPageSource('Keywords а также Ключевыэ сЛоВЫААА р2д2 брр и в том стиле');
    }
    
    
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps 
     */
    public function DeleteCategoryForJiraTests(SeoExpertTester\seoexpertSteps $I) {
        $I->DeleteProductCategorys();
    }

    
    
}