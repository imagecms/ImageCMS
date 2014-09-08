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
        $I->SeoCreateCategoryProduct($createNameCategory = 'Вода');
    }
    

    

    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps 
     */
    public function CreatуBrandForFront (SeoExpertTester\seoexpertSteps $I){
        $I->SeoCreateBrand($brandName = 'Хлеб');
    }
    
    

    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps 
     */
    public function CreateProductForFront (SeoExpertTester\seoexpertSteps $I){
        $I->SeoCreateProduct($NameProduct = 'Сеошний товар', $PriceProduct = '777', $BrandProduct = 'Хлеб', $CategoryProduct = 'Вода');

    }
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps 
     */
    public function CreateProperty(SeoExpertTester\seoexpertSteps $I) {
        $I->SeoCreateProperty($NameProperty = 'Свойственно сео', $CVS = 'XYXYxyxyxyxyXYXY', $Category = 'Вода', $Values1 = 'Первое Свойство', $Values2 = NULL, $Values3 = NULL, $Values4 = NULL);
        $I->SeoSelectPropertyInProduct($NameProduct = 'Сеошний товар', $Property1 = 'Yes');
    }
    
    
    
    /**
     * @group a
     */
    public function BaseDefoultValues (SeoExpertTester $I) {
        $I->amOnPage(seoexpertPage::$SeoUrl);
        $I->click(seoexpertPage::$SeoBaseRadioButtCategoryNameNo);
        $I->click(seoexpertPage::$SeoBaseRadioButtSiteNameYes);
        $I->click(seoexpertPage::$SeoBaseSelectKeywords);
        $I->click(seoexpertPage::$SeoBaseOptionMakeAutomaticKeywords);
        $I->click(seoexpertPage::$SeoBaseSelectDescription);
        $I->click(seoexpertPage::$SeoBaseOptionMakeAutomaticDescription);
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
        $I->amOnPage(PropertySEOPage::$ListURL);
        $I->wait('2');
        $I->fillField(PropertySEOPage::$SearchField, $namesOfProperty = 'Свойственно сео');
        $I->click(PropertySEOPage::$ButtonFilter);
        $a = $I->grabTextFrom(PropertySEOPage::$IDField);
        $I->comment("$a"); 
        $I->amOnPage(ProductSEOPage::$ListURL);
        $I->wait('2');
        $I->fillField(ProductSEOPage::$ListFildSearch, $name_product = 'Сеошний товар');
        $I->click(ProductSEOPage::$ListButtonFilter);
        $b = $I->grabTextFrom(ProductSEOPage::$ListGrabID);
        $I->comment("$b");
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
        $I->amOnPage(seoexpertPage::$FrontProductURL);
        $I->wait('2');
        $I->seeInPageSource("$b Сеошний товар Вода Хлеб 777 руб Первое Свойство / mini.loc");
             
    }
    
    
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function ShopProductPageTitleTranslit (SeoExpertTester\seoexpertSteps $I){
        $I->amOnPage(PropertySEOPage::$ListURL);
        $I->wait('2');
        $I->fillField(PropertySEOPage::$SearchField, $namesOfProperty = 'Свойственно сео');
        $I->click(PropertySEOPage::$ButtonFilter);
        $a = $I->grabTextFrom(PropertySEOPage::$IDField);
        $I->comment("$a");
        $I->amOnPage(ProductSEOPage::$ListURL);
        $I->wait('2');
        $I->fillField(ProductSEOPage::$ListFildSearch, $name_product = 'Сеошний товар');
        $I->click(ProductSEOPage::$ListButtonFilter);
        $b = $I->grabTextFrom(ProductSEOPage::$ListGrabID);
        $I->comment("$b");
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
        $I->amOnPage(seoexpertPage::$FrontProductURL);
        $I->wait('2');
        $I->seeInPageSource("$b Seoshnii tovar Voda Hleb 777 руб Первое Свойство / mini.loc");
             
    }
    
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function ShopProductPageTitlePadeguName (SeoExpertTester\seoexpertSteps $I){                    
        $I->amOnPage(seoexpertPage::$SeoUrl);
        $I->wait('1');
        $I->click(seoexpertPage::$SeoButtShop);
        $I->wait('1');
        $I->fillField(seoexpertPage::$SeoProductTitle, "%name[1]% %name[2]% %name[3]% %name[4]% %name[5]% %name[6]%");
        $I->fillField(seoexpertPage::$SeoProductDescription, '');
        $I->fillField(seoexpertPage::$SeoProductKeywords, '');
        $checkbox_path = '//tbody/tr[1]/td/div/div/div[2]/div/span[2]'; 
        $I->ActivateCheckBox($checkbox_xpath = $checkbox_path);
        $I->click(seoexpertPage::$SeoButtSave);
        InitTest::ClearAllCach($I);
        $I->wait('2');
        $I->amOnPage(seoexpertPage::$FrontProductURL);
        $I->wait('2');
        $I->seeInPageSource('Сеошний товар Сеошнего товара Сеошнему товару Сеошнего товара Сеошним товаром Сеошнем товаре / mini.loc');
             
    }
    

    
    
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function ShopProductPageTitlePadeguCategory (SeoExpertTester\seoexpertSteps $I){         
        $I->amOnPage(seoexpertPage::$SeoUrl);
        $I->wait('1');
        $I->click(seoexpertPage::$SeoButtShop);
        $I->wait('1');
        $I->fillField(seoexpertPage::$SeoProductTitle, "%category[1]% %category[2]% %category[3]% %category[4]% %category[5]% %category[6]%");
        $I->fillField(seoexpertPage::$SeoProductDescription, '');
        $I->fillField(seoexpertPage::$SeoProductKeywords, '');
        $checkbox_path = '//tbody/tr[1]/td/div/div/div[2]/div/span[2]'; 
        $I->ActivateCheckBox($checkbox_xpath = $checkbox_path);
        $I->click(seoexpertPage::$SeoButtSave);
        InitTest::ClearAllCach($I);
        $I->wait('2');
        $I->amOnPage(seoexpertPage::$FrontProductURL);
        $I->wait('2');
        $I->seeInPageSource('Вода Воды Воде Воду Водой Воде / mini.loc');
             
    }
    
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function ShopProductPageDescription (SeoExpertTester\seoexpertSteps $I){
        $I->amOnPage(PropertySEOPage::$ListURL);
        $I->wait('2');
        $I->fillField(PropertySEOPage::$SearchField, $namesOfProperty = 'Свойственно сео');
        $I->click(PropertySEOPage::$ButtonFilter);
        $a = $I->grabTextFrom(PropertySEOPage::$IDField);
        $I->comment("$a"); 
        $I->amOnPage(ProductSEOPage::$ListURL);
        $I->wait('2');
        $I->fillField(ProductSEOPage::$ListFildSearch, $name_product = 'Сеошний товар');
        $I->click(ProductSEOPage::$ListButtonFilter);
        $b = $I->grabTextFrom(ProductSEOPage::$ListGrabID);
        $I->comment("$b");
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
        $I->amOnPage(seoexpertPage::$FrontProductURL);
        $I->wait('2');
        $I->seeInPageSource("$b Сеошний товар Вода Хлеб 777 руб Первое Свойство / mini.loc");
       
    }
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function ShopProductPageDescriptionTranslit (SeoExpertTester\seoexpertSteps $I){
        $I->amOnPage(PropertySEOPage::$ListURL);
        $I->wait('2');
        $I->fillField(PropertySEOPage::$SearchField, $namesOfProperty = 'Свойственно сео');
        $I->click(PropertySEOPage::$ButtonFilter);
        $a = $I->grabTextFrom(PropertySEOPage::$IDField);
        $I->comment("$a");   
        $I->amOnPage(ProductSEOPage::$ListURL);
        $I->wait('2');
        $I->fillField(ProductSEOPage::$ListFildSearch, $name_product = 'Сеошний товар');
        $I->click(ProductSEOPage::$ListButtonFilter);
        $b = $I->grabTextFrom(ProductSEOPage::$ListGrabID);
        $I->comment("$b");
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
        $I->amOnPage(seoexpertPage::$FrontProductURL);
        $I->wait('2');
        $I->seeInPageSource("$b Seoshnii tovar Voda Hleb 777 руб Первое Свойство / mini.loc");
       
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
        $I->amOnPage(seoexpertPage::$FrontProductURL);
        $I->wait('2');
        $I->dontSeeInPageSource('я тут');
        $I->seeInPageSource('я');
       
    }
   
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function ShopProductPageKeywords (SeoExpertTester\seoexpertSteps $I){
        $I->amOnPage(PropertySEOPage::$ListURL);
        $I->wait('2');
        $I->fillField(PropertySEOPage::$SearchField, $namesOfProperty = 'Свойственно сео');
        $I->click(PropertySEOPage::$ButtonFilter);
        $a = $I->grabTextFrom(PropertySEOPage::$IDField);
        $I->comment("$a");   
        $I->wait('1');               
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
        $I->amOnPage(seoexpertPage::$FrontProductURL);
        $I->wait('2');
        $I->seeInPageSource('Сеошний товар Вода Хлеб Первое Свойство');
             
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
        $I->amOnPage(seoexpertPage::$FrontProductURL);
        $I->wait('7');
        $I->seeInPageSource('Сеошний товар / mini.loc');
        $I->seeInPageSource('Вода / mini.loc');
        $I->seeInPageSource('Хлеб');             
    }
    
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function ShopProductPageDeactive (SeoExpertTester\seoexpertSteps $I){ 
        $I->amOnPage(seoexpertPage::$SeoUrl);
        $I->click(seoexpertPage::$SeoBaseSelectKeywords);
        $I->click(seoexpertPage::$SeoBaseOptionLeaveBlankKeywords);
        $I->click(seoexpertPage::$SeoBaseSelectDescription);
        $I->click(seoexpertPage::$SeoBaseOptionLeaveBlankDescription);
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
        $I->amOnPage(seoexpertPage::$FrontProductURL);
        $I->wait('2');
        $I->dontSeeInPageSource('Церберус офф руб');             
        $I->dontSeeInPageSource('Нига777Нига');             
    }
    
    
    
    
    
    
    
    
    
}