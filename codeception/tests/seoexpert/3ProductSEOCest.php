<?php

use \SeoExpertTester;
class ProductSEOCest

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
        $I->SeoCreateCategoryProduct($createNameCategory = 'СЕОшная категория Product');
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
        $I->SeoCreateProduct($NameProduct = 'Товарчик для SEO експерта', $PriceProduct = '777', $BrandProduct = 'Про100 Бренд', $CategoryProduct = 'СЕОшная категория');

    }
    
    
    /**
     * @group aa
     * @guy SeoExpertTester\seoexpertSteps 
     */
    public function CreateProperty(SeoExpertTester\seoexpertSteps $I) {
        $I->SeoCreateProperty($NameProperty = 'Оуххх Х', $CVS = 'XYXYxyxyxyxyXYXY', $Category = 'СЕОшная', $Values1 = 'Первое Свойство', $Values2 = NULL, $Values3 = NULL, $Values4 = NULL);
//        $I->SeoCreateProperty($NameProperty = 'Оуххх Х', $CVS = 'XYXYxyxyxyxyXYXY', $Category = 'СЕОшная', $Values1 = 'Первое Свойство');
        $I->SeoSelectPropertyInProduct($NameProduct = 'Товарчик для SEO експерта', $Property1 = 'Yes');
    }
    
    /**
     * @group a
     */
    public function BaseDefoultValues (SeoExpertTester $I) {
        $I->amOnPage(seoexpertPage::$SeoUrl);
        $I->click(seoexpertPage::$SeoBaseRadioButtCategoryNameNo);
        $I->click(seoexpertPage::$SeoBaseRadioButtSiteNameNo);
        $I->fillField(seoexpertPage::$SeoBaseFieldSeparator, '');
        $I->fillField(seoexpertPage::$SeoBaseFieldDescription, '');
        $I->fillField(seoexpertPage::$SeoBaseFieldKeywords, '');
        $I->fillField(seoexpertPage::$SeoBaseFieldSiteName, '');
        $I->fillField(seoexpertPage::$SeoBaseFieldShortSiteName, '');
        $I->click(seoexpertPage::$SeoButtSave);
        $I->wait('1');
    }
    
    

   

    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function ShopProductPageTitle (SeoExpertTester\seoexpertSteps $I){
        $I->amOnPage('/admin/components/run/shop/properties');
        $I->wait('2');
        $I->fillField('//form/table/thead/tr[2]/td[3]/input', $namesOfProperty = 'Оуххх Х');
        $I->click('//section/div[1]/div[2]/div/button[1]');
        $a = $I->grabTextFrom('//tr[1]/td[2]');
        $I->comment("$a");   
        $I->wait('2');               
        $I->amOnPage(seoexpertPage::$SeoUrl);
        $I->wait('1');
        $I->click(seoexpertPage::$SeoButtShop);
        $I->wait('1');
        $I->fillField(seoexpertPage::$SeoProductTitle, "%ID%%name%%category%%brand%%price%%CS%%p_$a%");
        $I->fillField(seoexpertPage::$SeoProductDescription, '');
        $I->fillField(seoexpertPage::$SeoProductKeywords, '');
        $checkbox_path = '//tbody/tr[1]/td/div/div/div[2]/div/span[2]'; 
        $I->ActivateCheckBox($checkbox_xpath = $checkbox_path);
        $I->click(seoexpertPage::$SeoButtSave);
        InitTest::ClearAllCach($I);
        $I->wait('2');
        $I->amOnPage('/shop/product/tovarchik-dlia-seo-eksperta');
        $I->wait('7');
        $I->seeInPageSource('17194Товарчик для SEO експертаСЕОшная категория ProductПро100 Бренд777рубПервое Свойство');// / lastbuild.loc
             
    }
    

    
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function ShopProductPageDescription (SeoExpertTester\seoexpertSteps $I){
       $I->amOnPage('/admin/components/run/shop/properties');
        $I->wait('2');
        $I->fillField('//form/table/thead/tr[2]/td[3]/input', $namesOfProperty = 'Оуххх Х');
        $I->click('//section/div[1]/div[2]/div/button[1]');
        $a = $I->grabTextFrom('//tr[1]/td[2]');
        $I->comment("$a");   
        $I->wait('2');               
        $I->amOnPage(seoexpertPage::$SeoUrl);
        $I->wait('1');
        $I->click(seoexpertPage::$SeoButtShop);
        $I->wait('1');
        $I->fillField(seoexpertPage::$SeoProductTitle, '');
        $I->fillField(seoexpertPage::$SeoProductDescription, "%ID%  %name%  %category%  %brand%  %price% %CS%  %p_$a%");
        $I->fillField(seoexpertPage::$SeoProductKeywords, '');
        $I->fillField(seoexpertPage::$SeoProductLength, '555');
        $checkbox_path = '//tbody/tr[1]/td/div/div/div[2]/div/span[2]'; 
        $I->ActivateCheckBox($checkbox_xpath = $checkbox_path);
        $I->click(seoexpertPage::$SeoButtSave);
        InitTest::ClearAllCach($I);
        $I->wait('2');
        $I->amOnPage('/shop/product/tovarchik-dlia-seo-eksperta');
        $I->wait('7');
        $I->seeInPageSource('17194  Товарчик для SEO експерта  СЕОшная категория Product  Про100 Бренд  777 руб  Первое Свойство');// / lastbuild.loc
       
    }
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function ShopProductPageLength (SeoExpertTester\seoexpertSteps $I){       
        $I->wait('2');               
        $I->amOnPage(seoexpertPage::$SeoUrl);
        $I->wait('1');
        $I->click(seoexpertPage::$SeoButtShop);
        $I->wait('1');
        $I->fillField(seoexpertPage::$SeoProductTitle, '');
        $I->fillField(seoexpertPage::$SeoProductDescription, 'я тут');
        $I->fillField(seoexpertPage::$SeoProductKeywords, '');
        $I->fillField(seoexpertPage::$SeoProductLength, '1');
        $checkbox_path = '//tbody/tr[1]/td/div/div/div[2]/div/span[2]'; 
        $I->ActivateCheckBox($checkbox_xpath = $checkbox_path);
        $I->click(seoexpertPage::$SeoButtSave);
        InitTest::ClearAllCach($I);
        $I->wait('2');
        $I->amOnPage('/shop/product/tovarchik-dlia-seo-eksperta');
        $I->wait('7');
        $I->dontSeeInPageSource('я тут');
        $I->seeInPageSource('я');
       
    }
   

    
    

    
    
    
    
}