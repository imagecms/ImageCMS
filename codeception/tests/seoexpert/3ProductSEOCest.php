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
        $I->SeoCreateCategoryProduct($createNameCategory = 'СЕО Тест Категория');
    }
    
    

  
    

    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps 
     */
    public function CreatуBrandForFront (SeoExpertTester\seoexpertSteps $I){
        $I->SeoCreateBrand($brandName = 'СЕО тест Бренд');
    }
    
    

    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps 
     */
    public function CreateProductForFront (SeoExpertTester\seoexpertSteps $I){
        $I->SeoCreateProduct($NameProduct = 'СЕО Тест Продукт', $PriceProduct = '777', $BrandProduct = 'СЕО тест Бренд', $CategoryProduct = 'СЕО Тест Категория');

    }
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps 
     */
    public function CreateProperty(SeoExpertTester\seoexpertSteps $I) {
        $I->SeoCreateProperty($NameProperty = 'СЕО Тест Свойство', $CVS = 'XYXYxyxyxyxyXYXY', $Category = 'СЕО', $Values1 = 'Первое Свойство', $Values2 = NULL, $Values3 = NULL, $Values4 = NULL);
        $I->SeoSelectPropertyInProduct($NameProduct = 'СЕО Тест Продукт', $Property1 = 'Yes');
    }
    
    /**
     * @group a
     */
    public function BaseDefoultValues (SeoExpertTester $I) {
        $I->amOnPage(seoexpertPage::$SeoUrl);
        $I->click(seoexpertPage::$SeoBaseRadioButtCategoryNameNo);
        $I->click(seoexpertPage::$SeoBaseRadioButtSiteNameYes);
        $I->fillField(seoexpertPage::$SeoBaseFieldSeparator, '/');
        $I->fillField(seoexpertPage::$SeoBaseFieldDescription, '');
        $I->fillField(seoexpertPage::$SeoBaseFieldKeywords, '');
        $I->fillField(seoexpertPage::$SeoBaseFieldSiteName, 'lastbuild.loc');
        $I->fillField(seoexpertPage::$SeoBaseFieldShortSiteName, 'mini.loc');
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
        $I->fillField('//form/table/thead/tr[2]/td[3]/input', $namesOfProperty = 'СЕО Тест Свойство');
        $I->click('//section/div[1]/div[2]/div/button[1]');
        $a = $I->grabTextFrom('//tr[1]/td[2]');
        $I->comment("$a");   
        $I->wait('2');               
        $I->amOnPage(seoexpertPage::$SeoUrl);
        $I->wait('1');
        $I->click(seoexpertPage::$SeoButtShop);
        $I->wait('1');
        $I->fillField(seoexpertPage::$SeoProductTitle, "%ID% %name% %category% %brand% %price% %CS% %p_$a%");
        $I->fillField(seoexpertPage::$SeoProductDescription, '');
        $I->fillField(seoexpertPage::$SeoProductKeywords, '');
        $checkbox_path = '//tbody/tr[1]/td/div/div/div[2]/div/span[2]'; 
        $I->ActivateCheckBox($checkbox_xpath = $checkbox_path);
        $I->click(seoexpertPage::$SeoButtSave);
        InitTest::ClearAllCach($I);
        $I->wait('2');
        $I->amOnPage('/shop/product/seo-test-produkt');
        $I->wait('7');
        $I->seeInPageSource('17193 СЕО Тест Продукт СЕО Тест Категория СЕО тест Бренд 777 руб Первое Свойство / mini.loc');
             
    }
    
    
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function ShopProductPageTitleTranslit (SeoExpertTester\seoexpertSteps $I){
        $I->amOnPage('/admin/components/run/shop/properties');
        $I->wait('2');
        $I->fillField('//form/table/thead/tr[2]/td[3]/input', $namesOfProperty = 'СЕО Тест Свойство');
        $I->click('//section/div[1]/div[2]/div/button[1]');
        $a = $I->grabTextFrom('//tr[1]/td[2]');
        $I->comment("$a");   
        $I->wait('2');               
        $I->amOnPage(seoexpertPage::$SeoUrl);
        $I->wait('1');
        $I->click(seoexpertPage::$SeoButtShop);
        $I->wait('1');
        $I->fillField(seoexpertPage::$SeoProductTitle, "%ID% %name[t]% %category[t]% %brand[t]% %price% %CS% %p_$a%");
        $I->fillField(seoexpertPage::$SeoProductDescription, '');
        $I->fillField(seoexpertPage::$SeoProductKeywords, '');
        $checkbox_path = '//tbody/tr[1]/td/div/div/div[2]/div/span[2]'; 
        $I->ActivateCheckBox($checkbox_xpath = $checkbox_path);
        $I->click(seoexpertPage::$SeoButtSave);
        InitTest::ClearAllCach($I);
        $I->wait('2');
        $I->amOnPage('/shop/product/seo-test-produkt');
        $I->wait('7');
        $I->seeInPageSource('17193 SEO Test Produkt SEO Test Kategoriia SEO test Brend 777 руб Первое Свойство / mini.loc');
             
    }
    

    
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function ShopProductPageDescription (SeoExpertTester\seoexpertSteps $I){
       $I->amOnPage('/admin/components/run/shop/properties');
        $I->wait('2');
        $I->fillField('//form/table/thead/tr[2]/td[3]/input', $namesOfProperty = 'СЕО Тест Свойство');
        $I->click('//section/div[1]/div[2]/div/button[1]');
        $a = $I->grabTextFrom('//tr[1]/td[2]');
        $I->comment("$a");   
        $I->wait('2');               
        $I->amOnPage(seoexpertPage::$SeoUrl);
        $I->wait('1');
        $I->click(seoexpertPage::$SeoButtShop);
        $I->wait('1');
        $I->fillField(seoexpertPage::$SeoProductTitle, '');
        $I->fillField(seoexpertPage::$SeoProductDescription, "%ID% %name% %category% %brand% %price% %CS% %p_$a%");
        $I->fillField(seoexpertPage::$SeoProductKeywords, '');
        $I->fillField(seoexpertPage::$SeoProductLength, '');
        $checkbox_path = '//tbody/tr[1]/td/div/div/div[2]/div/span[2]'; 
        $I->ActivateCheckBox($checkbox_xpath = $checkbox_path);
        $I->click(seoexpertPage::$SeoButtSave);
        InitTest::ClearAllCach($I);
        $I->wait('2');
        $I->amOnPage('/shop/product/seo-test-produkt');
        $I->wait('7');
        $I->seeInPageSource('17193 СЕО Тест Продукт СЕО Тест Категория СЕО тест Бренд 777 руб Первое Свойство / mini.loc');
       
    }
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function ShopProductPageDescriptionTranslit (SeoExpertTester\seoexpertSteps $I){
       $I->amOnPage('/admin/components/run/shop/properties');
        $I->wait('2');
        $I->fillField('//form/table/thead/tr[2]/td[3]/input', $namesOfProperty = 'СЕО Тест Свойство');
        $I->click('//section/div[1]/div[2]/div/button[1]');
        $a = $I->grabTextFrom('//tr[1]/td[2]');
        $I->comment("$a");   
        $I->wait('2');               
        $I->amOnPage(seoexpertPage::$SeoUrl);
        $I->wait('1');
        $I->click(seoexpertPage::$SeoButtShop);
        $I->wait('1');
        $I->fillField(seoexpertPage::$SeoProductTitle, '');
        $I->fillField(seoexpertPage::$SeoProductDescription, "%ID% %name[t]% %category[t]% %brand[t]% %price% %CS% %p_$a%");
        $I->fillField(seoexpertPage::$SeoProductKeywords, '');
        $I->fillField(seoexpertPage::$SeoProductLength, '');
        $checkbox_path = '//tbody/tr[1]/td/div/div/div[2]/div/span[2]'; 
        $I->ActivateCheckBox($checkbox_xpath = $checkbox_path);
        $I->click(seoexpertPage::$SeoButtSave);
        InitTest::ClearAllCach($I);
        $I->wait('2');
        $I->amOnPage('/shop/product/seo-test-produkt');
        $I->wait('7');
        $I->seeInPageSource('17193 SEO Test Produkt SEO Test Kategoriia SEO test Brend 777 руб Первое Свойство / mini.loc');
       
    }
 
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function ICMS1264ShopProductPageLength (SeoExpertTester\seoexpertSteps $I){       
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
        $I->amOnPage('/shop/product/seo-test-produkt');
        $I->wait('7');
        $I->dontSeeInPageSource('я тут');
        $I->seeInPageSource('я');
       
    }
   
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function ShopProductPageKeywords (SeoExpertTester\seoexpertSteps $I){
        $I->amOnPage('/admin/components/run/shop/properties');
        $I->wait('2');
        $I->fillField('//form/table/thead/tr[2]/td[3]/input', $namesOfProperty = 'СЕО Тест Свойство');
        $I->click('//section/div[1]/div[2]/div/button[1]');
        $a = $I->grabTextFrom('//tr[1]/td[2]');
        $I->comment("$a");   
        $I->wait('2');               
        $I->amOnPage(seoexpertPage::$SeoUrl);
        $I->wait('1');
        $I->click(seoexpertPage::$SeoButtShop);
        $I->wait('1');
        $I->fillField(seoexpertPage::$SeoProductTitle, '');
        $I->fillField(seoexpertPage::$SeoProductDescription, '');
        $I->fillField(seoexpertPage::$SeoProductKeywords, "%name% %category% %brand% %p_$a%");
        $checkbox_path = '//tbody/tr[1]/td/div/div/div[2]/div/span[2]'; 
        $I->ActivateCheckBox($checkbox_xpath = $checkbox_path);
        $I->click(seoexpertPage::$SeoButtSave);
        InitTest::ClearAllCach($I);
        $I->wait('2');
        $I->amOnPage('/shop/product/seo-test-produkt');
        $I->wait('8');
        $I->seeInPageSource('СЕО Тест Продукт СЕО Тест Категория СЕО тест Бренд Первое Свойство');
             
    }
    
    
    
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function ShopProductPageActive (SeoExpertTester\seoexpertSteps $I){             
        $I->amOnPage(seoexpertPage::$SeoUrl);
        $I->wait('1');
        $I->click(seoexpertPage::$SeoButtShop);
        $I->wait('2');
        $I->fillField(seoexpertPage::$SeoProductTitle, '%name%');
        $I->fillField(seoexpertPage::$SeoProductDescription, '%category%');
        $I->fillField(seoexpertPage::$SeoProductKeywords, "%brand%");
        $checkbox_path = '//tbody/tr[1]/td/div/div/div[2]/div/span[2]'; 
        $I->ActivateCheckBox($checkbox_xpath = $checkbox_path);
        $I->click(seoexpertPage::$SeoButtSave);
        InitTest::ClearAllCach($I);
        $I->wait('2');
        $I->amOnPage('/shop/product/seo-test-produkt');
        $I->wait('7');
        $I->seeInPageSource('СЕО Тест Продукт / mini.loc');
        $I->seeInPageSource('СЕО Тест Категория / mini.loc');
        $I->seeInPageSource('СЕО тест Бренд');             
    }
    
    
    
    /**
     * @group aa
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function ShopProductPageDeactive (SeoExpertTester\seoexpertSteps $I){ 
        $I->amOnPage(seoexpertPage::$SeoUrl);
        $I->click(seoexpertPage::$SeoBaseSelectKeywords);
        $I->click('//tbody/tr/td/div/div/div/div[4]/div/select/option[2]');
        $I->click(seoexpertPage::$SeoBaseSelectDescription);
        $I->click('//tbody/tr/td/div/div/div/div[5]/div/select/option[2]');
        $I->click(seoexpertPage::$SeoButtSave);
        $I->wait('1');   
        $I->amOnPage(seoexpertPage::$SeoUrl);
        $I->wait('1');
        $I->click(seoexpertPage::$SeoButtShop);
        $I->wait('2');
        $I->fillField(seoexpertPage::$SeoProductTitle, '%name%');
        $I->fillField(seoexpertPage::$SeoProductDescription, 'Церберус офф %CS%');
        $I->fillField(seoexpertPage::$SeoProductKeywords, "Нига%price%Нига");
        $checkbox_path = '//tbody/tr[1]/td/div/div/div[2]/div/span[2]'; 
        $I->DeactivateCheckBox($checkbox_xpath = $checkbox_path);
        $I->click(seoexpertPage::$SeoButtSave);
        InitTest::ClearAllCach($I);
        $I->wait('2');
        $I->amOnPage('/shop/product/seo-test-produkt');
        $I->wait('7');
        $I->dontSeeInPageSource('Церберус офф руб');             
        $I->dontSeeInPageSource('Нига777Нига');             
    }
    
    
    
    
    
    
    
    
    
}