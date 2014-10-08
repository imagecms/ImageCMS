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
     * @group aa
     * @guy SeoExpertTester\seoexpertSteps 
     */
    public function CreateCategory (SeoExpertTester\seoexpertSteps $I){
        $I->SeoCreateCategoryProduct($createNameCategory = 'Zzzz категория для SEO');
    }
    
    
    /**
     * @group a
     */
    public function BasePageSetData (SeoExpertTester $I) {
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
     * @group a
     */
    public function RadioButtonSiteNameOff (SeoExpertTester $I){
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
     * @group a
     */
    public function RadioButtonSiteNameOn (SeoExpertTester $I){
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
     * @group a
     */
    public function RadioButtonCategoryNameOff (SeoExpertTester $I){
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
     * @group a
     */
    public function RadioButtonCategoryNameOn (SeoExpertTester $I){
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
    public function FirstSetSeparator (SeoExpertTester\seoexpertSteps $I){
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
    public function SecondSetSeparator (SeoExpertTester\seoexpertSteps $I){
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
    public function ThirdSetSeparator (SeoExpertTester\seoexpertSteps $I){
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
    public function FouthSetSeparator (SeoExpertTester\seoexpertSteps $I){
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
    public function FifthSetSeparator (SeoExpertTester\seoexpertSteps $I){
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
    public function TabBaseFieldDescription (SeoExpertTester $I){
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
    public function TabBaseFieldKeywords (SeoExpertTester $I){
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
    public function DeleteAllTestCategory(SeoExpertTester\seoexpertSteps $I) {
        $I->DeleteProductCategorys();
    }

    
    
}