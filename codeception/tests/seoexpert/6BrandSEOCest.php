<?php

use \SeoExpertTester;
class BrandSEOCest

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
    public function CreateBrandForFront (SeoExpertTester\seoexpertSteps $I){
        InitTest::ClearAllCach($I);
        InitTest::changeTextAditorToNative($I);
        $I->SeoCreateBrand($brandName = 'Пробник', $opisanie = 'Ъписание описание описание', $title = 'тайтл тайтл тайтл', $description = 'деск деск деск', $keywords = 'кей кей кей');       
        $I->SeoCreateBrand($brandName = 'Cannibal Corpse', $opisanie = 'Qrutal Death Metal', $title = 'Grind Core', $description = 'Powervailens noise', $keywords = 'SwS Destr CC CX EE');       
    }
    
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps 
     */
    public function CreateCategoryForFront (SeoExpertTester\seoexpertSteps $I){
        $I->SeoCreateCategoryProduct($createNameCategory = 'Брендовая');   
        $I->SeoCreateCategoryProduct($createNameCategory = 'Etmo Plasma');   
    }
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps 
     */
    public function CreateProductForFront (SeoExpertTester\seoexpertSteps $I){
        $I->SeoCreateProduct($Name_Product = 'Брендовый Пробник товар',
                            $Price_Product = '777',
                            $Brand_Product = 'Пробник',
                            $Category_Product = 'Брендовая',
                            $Additional_Category = '');     
        $I->SeoCreateProduct($Name_Product = 'Zulusandia',
                            $Price_Product = '888',
                            $Brand_Product = 'Cannibal Corpse',
                            $Category_Product = 'Etmo Plasma',
                            $Additional_Category = '');     
    }

    
    /**
     * @group a
     */
    public function ClearChash1(SeoExpertTester $I) {
        InitTest::ClearAllCach($I);
    }
    
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function BrandTitleComonVariableRUS (SeoExpertTester\seoexpertSteps $I) {
        $ID_brand = $I->GetBrandID($name_brand = 'Пробник');
        $I->NullValues();
        $I->SetBrandSeoPage($Title = '%ID% %name% %desc%',
                            $Description = '',
                            $Pagination = '',
                            $Length_Desc = '999',
                            $Keywords = '',
                            $CheckBox_Activate = '//section/form/div[2]/div[2]/table[4]/tbody/tr/td/div/div/div[1]/div/span[2]');     
        $I->CheckValuesInPage($URL_Page = '/shop/brand/probnik#',
                                $values = "$ID_brand Пробник Ъписание описание описание");
    }
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function BrandTitleComonVariableENG (SeoExpertTester\seoexpertSteps $I) {
        $ID_brand = $I->GetBrandID($name_brand = 'Cannibal Corpse');
        $I->NullValues();
        $I->SetBrandSeoPage($Title = '%ID% %name% %desc%',
                            $Description = '',
                            $Pagination = '',
                            $Length_Desc = '999',
                            $Keywords = '',
                            $CheckBox_Activate = '//section/form/div[2]/div[2]/table[4]/tbody/tr/td/div/div/div[1]/div/span[2]');     
        $I->CheckValuesInPage($URL_Page = '/shop/brand/cannibal-corpse#',
                                $values = "$ID_brand Cannibal Corpse Qrutal Death Metal");
    }
    
    
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function BrandTitleComonSymbolRUS (SeoExpertTester\seoexpertSteps $I) {
        $I->NullValues();
        $I->SetBrandSeoPage($Title = 'QWE asd 123 ЪХЗЫ хїзфіва +-',
                            $Description = '',
                            $Pagination = '',
                            $Length_Desc = '999',
                            $Keywords = '',
                            $CheckBox_Activate = '//section/form/div[2]/div[2]/table[4]/tbody/tr/td/div/div/div[1]/div/span[2]');     
        $I->CheckValuesInPage($URL_Page = '/shop/brand/probnik#',
                                $values = 'QWE asd 123 ЪХЗЫ хїзфіва +-');
    }
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function BrandTitleComonSymbolENG (SeoExpertTester\seoexpertSteps $I) {
        $I->NullValues();
        $I->SetBrandSeoPage($Title = 'QWE asd 123 ЪХЗЫ хїзфіва +-',
                            $Description = '',
                            $Pagination = '',
                            $Length_Desc = '999',
                            $Keywords = '',
                            $CheckBox_Activate = '//section/form/div[2]/div[2]/table[4]/tbody/tr/td/div/div/div[1]/div/span[2]');     
        $I->CheckValuesInPage($URL_Page = '/shop/brand/cannibal-corpse#',
                                $values = 'QWE asd 123 ЪХЗЫ хїзфіва +-');
    }
    
    
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function BrandTitleComonSymbolVariableRUS (SeoExpertTester\seoexpertSteps $I) {
        $ID_brand = $I->GetBrandID($name_brand = 'Пробник');
        $I->NullValues();
        $I->SetBrandSeoPage($Title = 'QWE %desc% asd 123 %ID% ЪХЗЫ хїзфіва %name% +-',
                            $Description = '',
                            $Pagination = '',
                            $Length_Desc = '999',
                            $Keywords = '',
                            $CheckBox_Activate = '//section/form/div[2]/div[2]/table[4]/tbody/tr/td/div/div/div[1]/div/span[2]');     
        $I->CheckValuesInPage($URL_Page = '/shop/brand/probnik#',
                                $values = "QWE Ъписание описание описание asd 123 $ID_brand ЪХЗЫ хїзфіва Пробник +-");
    }
    
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function BrandTitleComonSymbolVariableENG (SeoExpertTester\seoexpertSteps $I) {
        $ID_brand = $I->GetBrandID($name_brand = 'Cannibal Corpse');
        $I->NullValues();
        $I->SetBrandSeoPage($Title = 'QWE %desc% asd 123 %ID% ЪХЗЫ хїзфіва %name% +-',
                            $Description = '',
                            $Pagination = '',
                            $Length_Desc = '999',
                            $Keywords = '',
                            $CheckBox_Activate = '//section/form/div[2]/div[2]/table[4]/tbody/tr/td/div/div/div[1]/div/span[2]');     
        $I->CheckValuesInPage($URL_Page = '/shop/brand/cannibal-corpse#',
                                $values = "QWE Qrutal Death Metal asd 123 $ID_brand ЪХЗЫ хїзфіва Cannibal Corpse +-");
    }
    
    
    /**
     * @group a
     */
    public function ClearChash2(SeoExpertTester $I) {
        InitTest::ClearAllCach($I);
    }
    
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function BrandDescriptionComonRUS (SeoExpertTester\seoexpertSteps $I) {
        $ID_brand = $I->GetBrandID($name_brand = 'Пробник');
        $I->NullValues();
        $I->SetBrandSeoPage($Title = '',
                            $Description = '%ID% %name% %desc%',
                            $Pagination = '',
                            $Length_Desc = '999',
                            $Keywords = '',
                            $CheckBox_Activate = '//section/form/div[2]/div[2]/table[4]/tbody/tr/td/div/div/div[1]/div/span[2]');     
        $I->CheckValuesInPage($URL_Page = '/shop/brand/probnik#',
                                $values = "$ID_brand Пробник Ъписание описание описание");
    }
    
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function BrandDescriptionComonENG (SeoExpertTester\seoexpertSteps $I) {
        $ID_brand = $I->GetBrandID($name_brand = 'Cannibal Corpse');
        $I->NullValues();
        $I->SetBrandSeoPage($Title = '',
                            $Description = '%ID% %name% %desc%',
                            $Pagination = '',
                            $Length_Desc = '999',
                            $Keywords = '',
                            $CheckBox_Activate = '//section/form/div[2]/div[2]/table[4]/tbody/tr/td/div/div/div[1]/div/span[2]');     
        $I->CheckValuesInPage($URL_Page = '/shop/brand/cannibal-corpse#',
                                $values = "$ID_brand Cannibal Corpse Qrutal Death Metal");
    }
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function BrandDescriptionSymbolRUS (SeoExpertTester\seoexpertSteps $I) {
        $I->NullValues();
        $I->SetBrandSeoPage($Title = '',
                            $Description = 'QWE asd 123 ЪХЗЫ хїзфіва +-',
                            $Pagination = '',
                            $Length_Desc = '999',
                            $Keywords = '',
                            $CheckBox_Activate = '//section/form/div[2]/div[2]/table[4]/tbody/tr/td/div/div/div[1]/div/span[2]');     
        $I->CheckValuesInPage($URL_Page = '/shop/brand/probnik#',
                                $values = "QWE asd 123 ЪХЗЫ хїзфіва +-");
    }
    
    
    
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function BrandDescriptionSymbolENG (SeoExpertTester\seoexpertSteps $I) {
        $I->NullValues();
        $I->SetBrandSeoPage($Title = '',
                            $Description = 'QWE asd 123 ЪХЗЫ хїзфіва +-',
                            $Pagination = '',
                            $Length_Desc = '999',
                            $Keywords = '',
                            $CheckBox_Activate = '//section/form/div[2]/div[2]/table[4]/tbody/tr/td/div/div/div[1]/div/span[2]');     
        $I->CheckValuesInPage($URL_Page = '/shop/brand/cannibal-corpse#',
                                $values = "QWE asd 123 ЪХЗЫ хїзфіва +-");
    }
    
    
    
    
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function BrandKeywordsComonRUS (SeoExpertTester\seoexpertSteps $I) {   
        $I->NullValues();
        $I->SetBrandSeoPage($Title = '',
                            $Description = '',
                            $Pagination = '',
                            $Length_Desc = '',
                            $Keywords = '%name%',
                            $CheckBox_Activate = '//section/form/div[2]/div[2]/table[4]/tbody/tr/td/div/div/div[1]/div/span[2]');     
        $I->CheckValuesInPage($URL_Page = '/shop/brand/probnik#',
                                $values = "Пробник");
    }
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function BrandKeywordsComonENG (SeoExpertTester\seoexpertSteps $I) {   
        $I->NullValues();
        $I->SetBrandSeoPage($Title = '',
                            $Description = '',
                            $Pagination = '',
                            $Length_Desc = '',
                            $Keywords = '%name%',
                            $CheckBox_Activate = '//section/form/div[2]/div[2]/table[4]/tbody/tr/td/div/div/div[1]/div/span[2]');     
        $I->CheckValuesInPage($URL_Page = '/shop/brand/cannibal-corpse#',
                                $values = "Cannibal Corpse");
    }
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function BrandKeywordsSymbolRUS (SeoExpertTester\seoexpertSteps $I) {   
        $I->NullValues();
        $I->SetBrandSeoPage($Title = '',
                            $Description = '',
                            $Pagination = '',
                            $Length_Desc = '',
                            $Keywords = 'Привет %name% QWEasd 123 _)(^$%#',
                            $CheckBox_Activate = '//section/form/div[2]/div[2]/table[4]/tbody/tr/td/div/div/div[1]/div/span[2]');     
        $I->CheckValuesInPage($URL_Page = '/shop/brand/probnik#',
                                $values = "Привет Пробник QWEasd 123 _)(^$%#");
    }
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function BrandKeywordsSymbolENG (SeoExpertTester\seoexpertSteps $I) {   
        $I->NullValues();
        $I->SetBrandSeoPage($Title = '',
                            $Description = '',
                            $Pagination = '',
                            $Length_Desc = '',
                            $Keywords = 'Привет %name% QWEasd 123 _)(^$%#',
                            $CheckBox_Activate = '//section/form/div[2]/div[2]/table[4]/tbody/tr/td/div/div/div[1]/div/span[2]');     
        $I->CheckValuesInPage($URL_Page = '/shop/brand/cannibal-corpse#',
                                $values = "Привет Cannibal Corpse QWEasd 123 _)(^$%#");
    }
    
    
    /**
     * @group a
     */
    public function ClearChash3(SeoExpertTester $I) {
        InitTest::ClearAllCach($I);
    }
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function BrandTitleLengthRUS (SeoExpertTester\seoexpertSteps $I) {   
        $I->NullValues();
        $I->SetBrandSeoPage($Title = '%desc%',
                            $Description = '',
                            $Pagination = '',
                            $Length_Desc = '1',
                            $Keywords = '',
                            $CheckBox_Activate = '//section/form/div[2]/div[2]/table[4]/tbody/tr/td/div/div/div[1]/div/span[2]');     
        $I->CheckValuesInPage($URL_Page = '/shop/brand/probnik#',
                                $values = 'Ъ');
    }
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function BrandTitleLengthENG (SeoExpertTester\seoexpertSteps $I) {   
        $I->NullValues();
        $I->SetBrandSeoPage($Title = '%desc%',
                            $Description = '',
                            $Pagination = '',
                            $Length_Desc = '1',
                            $Keywords = '',
                            $CheckBox_Activate = '//section/form/div[2]/div[2]/table[4]/tbody/tr/td/div/div/div[1]/div/span[2]');     
        $I->CheckValuesInPage($URL_Page = '/shop/brand/cannibal-corpse#',
                                $values = 'Q');
    }
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function BrandTitleLengthMAXRUS (SeoExpertTester\seoexpertSteps $I) {   
        $I->NullValues();
        $I->SetBrandSeoPage($Title = '%desc%',
                            $Description = '',
                            $Pagination = '',
                            $Length_Desc = '999',
                            $Keywords = '',
                            $CheckBox_Activate = '//section/form/div[2]/div[2]/table[4]/tbody/tr/td/div/div/div[1]/div/span[2]');     
        $I->CheckValuesInPage($URL_Page = '/shop/brand/probnik#',
                                $values = 'Ъписание описание описание');
    }
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function BrandTitleLengthMAXENG (SeoExpertTester\seoexpertSteps $I) {   
        $I->NullValues();
        $I->SetBrandSeoPage($Title = '%desc%',
                            $Description = '',
                            $Pagination = '',
                            $Length_Desc = '999',
                            $Keywords = '',
                            $CheckBox_Activate = '//section/form/div[2]/div[2]/table[4]/tbody/tr/td/div/div/div[1]/div/span[2]');     
        $I->CheckValuesInPage($URL_Page = '/shop/brand/cannibal-corpse#',
                                $values = 'Qrutal Death Metal');
    }
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function BrandTitleLengthMedRUS (SeoExpertTester\seoexpertSteps $I) {   
        $I->NullValues();
        $I->SetBrandSeoPage($Title = '%desc%',
                            $Description = '',
                            $Pagination = '',
                            $Length_Desc = '10',
                            $Keywords = '',
                            $CheckBox_Activate = '//section/form/div[2]/div[2]/table[4]/tbody/tr/td/div/div/div[1]/div/span[2]');     
        $I->CheckValuesInPage($URL_Page = '/shop/brand/probnik#',
                                $values = 'Ъписа');
    }
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function BrandTitleLengthMedENG (SeoExpertTester\seoexpertSteps $I) {   
        $I->NullValues();
        $I->SetBrandSeoPage($Title = '%desc%',
                            $Description = '',
                            $Pagination = '',
                            $Length_Desc = '10',
                            $Keywords = '',
                            $CheckBox_Activate = '//section/form/div[2]/div[2]/table[4]/tbody/tr/td/div/div/div[1]/div/span[2]');     
        $I->CheckValuesInPage($URL_Page = '/shop/brand/cannibal-corpse#',
                                $values = 'Qrutal Dea');
    }
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function ICMS_1573__BrandDescriptionLengthMedRUS (SeoExpertTester\seoexpertSteps $I) {   
        $I->NullValues();
        $I->SetBrandSeoPage($Title = '',
                            $Description = '%desc%',
                            $Pagination = '',
                            $Length_Desc = '9',
                            $Keywords = '',
                            $CheckBox_Activate = '//section/form/div[2]/div[2]/table[4]/tbody/tr/td/div/div/div[1]/div/span[2]');     
        $I->CheckValuesInPage($URL_Page = '/shop/brand/probnik#',
                                $values = 'Ъписа');
    }
    
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function BrandDescriptionLengthMedENG (SeoExpertTester\seoexpertSteps $I) {   
        $I->NullValues();
        $I->SetBrandSeoPage($Title = '',
                            $Description = '%desc%',
                            $Pagination = '',
                            $Length_Desc = '5',
                            $Keywords = '',
                            $CheckBox_Activate = '//section/form/div[2]/div[2]/table[4]/tbody/tr/td/div/div/div[1]/div/span[2]');     
        $I->CheckValuesInPage($URL_Page = '/shop/brand/cannibal-corpse#',
                                $values = 'Qruta ');
    }
    
    
    
   /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function BrandActiveCheckBoxActiveRUS (SeoExpertTester\seoexpertSteps $I) {
        $ID_brand = $I->GetBrandID($name_brand = 'Пробник');
        $I->NullValues();
        $I->SetBrandSeoPage($Title = '%ID% %name% %desc% гуд бай',
                            $Description = '%ID% %name% %desc% гуд бай',
                            $Pagination = '',
                            $Length_Desc = '999',
                            $Keywords = '%name% гуд бай',
                            $CheckBox_Activate = '//section/form/div[2]/div[2]/table[4]/tbody/tr/td/div/div/div[1]/div/span[2]');     
        $I->CheckValuesInPage($URL_Page = '/shop/brand/probnik#',
                                $values = "$ID_brand Пробник Ъписание описание описание гуд бай");
    } 
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function BrandActiveCheckBoxActiveENG (SeoExpertTester\seoexpertSteps $I) {
        $ID_brand = $I->GetBrandID($name_brand = 'Cannibal Corpse');
        $I->NullValues();
        $I->SetBrandSeoPage($Title = '%ID% %name% %desc% гуд бай',
                            $Description = '%ID% %name% %desc% гуд бай',
                            $Pagination = '',
                            $Length_Desc = '999',
                            $Keywords = '%name% гуд бай',
                            $CheckBox_Activate = '//section/form/div[2]/div[2]/table[4]/tbody/tr/td/div/div/div[1]/div/span[2]');     
        $I->CheckValuesInPage($URL_Page = '/shop/brand/cannibal-corpse#',
                                $values = "$ID_brand Cannibal Corpse Qrutal Death Metal гуд бай");
    } 
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function BrandActiveCheckBoxDeactiveRUS (SeoExpertTester\seoexpertSteps $I) {
        $ID_brand = $I->GetBrandID($name_brand = 'Пробник');
        $I->NullValues();
        $I->SetBrandSeoPage($Title = '%ID% %name% %desc% гуд бай',
                            $Description = '%ID% %name% %desc% гуд бай',
                            $Pagination = '',
                            $Length_Desc = '999',
                            $Keywords = '%name% гуд бай',
                            $CheckBox_Activate = '//section/form/div[2]/div[2]/table[4]/tbody/tr/td/div/div/div[1]/div/span[2]');     
        $I->DeactivateCheckBox($checkbox_xpath = '//section/form/div[2]/div[2]/table[4]/tbody/tr/td/div/div/div[1]/div/span[2]');
        $I->amOnPage('/shop/brand/probnik#');
        $I->dontSeeInPageSource("$ID_brand Пробник Ъписание описание описание гуд бай");
    } 
    
    
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function BrandActiveCheckBoxDeactiveENG (SeoExpertTester\seoexpertSteps $I) {
        $ID_brand = $I->GetBrandID($name_brand = 'Cannibal Corpse');
        $I->NullValues();
        $I->SetBrandSeoPage($Title = '%ID% %name% %desc% гуд бай',
                            $Description = '%ID% %name% %desc% гуд бай',
                            $Pagination = '',
                            $Length_Desc = '999',
                            $Keywords = '%name% гуд бай',
                            $CheckBox_Activate = '//section/form/div[2]/div[2]/table[4]/tbody/tr/td/div/div/div[1]/div/span[2]');     
        $I->DeactivateCheckBox($checkbox_xpath = '//section/form/div[2]/div[2]/table[4]/tbody/tr/td/div/div/div[1]/div/span[2]');
        $I->amOnPage('/shop/brand/cannibal-corpse#');
        $I->dontSeeInPageSource("$ID_brand Пробник Ъписание описание описание гуд бай");
    } 
    
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function BrandNullCheckBoxActiveRUS (SeoExpertTester\seoexpertSteps $I) {
        $ID_brand = $I->GetBrandID($name_brand = 'Пробник');
        $I->NullValues();
        $I->SetBrandSeoPage($Title = '%ID% %name% %desc% гуд бай',
                            $Description = '%ID% %name% %desc% гуд бай',
                            $Pagination = '',
                            $Length_Desc = '999',
                            $Keywords = '%name% гуд бай',
                            $CheckBox_Activate = '//section/form/div[2]/div[2]/table[4]/tbody/tr/td/div/div/div[1]/div/span[2]');   
        $I->ActivateCheckBox($checkbox_xpath = '//section/form/div[2]/div[2]/table[4]/tbody/tr/td/div/div/div[2]/div/span[2]');
        $I->SeoBrandMetaDta($brand_name = 'Пробник',
                            $meta_title = 'тітутайтлілукай',
                            $meta_description = 'декскрімінатіононзенатіфон',
                            $meta_keywords = 'основаосвноавключей');
        $I->amOnPage('/shop/brand/probnik#');
        $I->dontSeeInPageSource("$ID_brand Пробник гуляй поле бай");
        $I->seeInPageSource('тітутайтлілукай');
        $I->seeInPageSource('декскрімінатіононзенатіфон');
        $I->seeInPageSource('основаосвноавключей');
    } 
    
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function BrandNullCheckBoxActiveENG (SeoExpertTester\seoexpertSteps $I) {
        $ID_brand = $I->GetBrandID($name_brand = 'Cannibal Corpse');
        $I->NullValues();
        $I->SetBrandSeoPage($Title = '%ID% %name% %desc% гуд бай',
                            $Description = '%ID% %name% %desc% гуд бай',
                            $Pagination = '',
                            $Length_Desc = '999',
                            $Keywords = '%name% гуд бай',
                            $CheckBox_Activate = '//section/form/div[2]/div[2]/table[4]/tbody/tr/td/div/div/div[1]/div/span[2]');   
        $I->ActivateCheckBox($checkbox_xpath = '//section/form/div[2]/div[2]/table[4]/tbody/tr/td/div/div/div[2]/div/span[2]');
        $I->SeoBrandMetaDta($brand_name = 'Cannibal Corpse',
                            $meta_title = 'Baambaataa',
                            $meta_description = 'Afrikanabanana',
                            $meta_keywords = 'TeroristUKRqwerty');
        $I->amOnPage('/shop/brand/cannibal-corpse#');
        $I->dontSeeInPageSource("$ID_brand Cannibal Corpse гуляй поле бай");
        $I->seeInPageSource('Baambaataa');
        $I->seeInPageSource('Afrikanabanana');
        $I->seeInPageSource('TeroristUKRqwerty');
    } 
    
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function BrandNullCheckBoxDeactiveRUS (SeoExpertTester\seoexpertSteps $I) {
        $ID_brand = $I->GetBrandID($name_brand = 'Пробник');
        $I->NullValues();
        $I->SetBrandSeoPage($Title = '%ID% %name% %desc% гуд бай',
                            $Description = '%ID% %name% %desc% гуд бай',
                            $Pagination = '',
                            $Length_Desc = '999',
                            $Keywords = '%name% гуд бай',
                            $CheckBox_Activate = '//section/form/div[2]/div[2]/table[4]/tbody/tr/td/div/div/div[1]/div/span[2]');   
        $I->DeactivateCheckBox($checkbox_xpath = '//section/form/div[2]/div[2]/table[4]/tbody/tr/td/div/div/div[2]/div/span[2]');
        $I->SeoBrandMetaDta($brand_name = 'Пробник',
                            $meta_title = 'тітутайтлілукай',
                            $meta_description = 'декскрімінатіононзенатіфон',
                            $meta_keywords = 'основаосвноавключей');
        $I->amOnPage('/shop/brand/probnik#');
        $I->seeInPageSource("$ID_brand Пробник Ъписание описание описание гуд бай");
        $I->dontSeeInPageSource('тітутайтлілукай');
        $I->dontSeeInPageSource('декскрімінатіононзенатіфон');
        $I->dontSeeInPageSource('основаосвноавключей');
    } 
    
    
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function BrandNullCheckBoxDeactiveENG (SeoExpertTester\seoexpertSteps $I) {
        $ID_brand = $I->GetBrandID($name_brand = 'Cannibal Corpse');
        $I->NullValues();
        $I->SetBrandSeoPage($Title = '%ID% %name% %desc% гуд бай',
                            $Description = '%ID% %name% %desc% гуд бай',
                            $Pagination = '',
                            $Length_Desc = '999',
                            $Keywords = '%name% гуд бай',
                            $CheckBox_Activate = '//section/form/div[2]/div[2]/table[4]/tbody/tr/td/div/div/div[1]/div/span[2]');   
        $I->DeactivateCheckBox($checkbox_xpath = '//section/form/div[2]/div[2]/table[4]/tbody/tr/td/div/div/div[2]/div/span[2]');
        $I->SeoBrandMetaDta($brand_name = 'Cannibal Corpse',
                            $meta_title = 'Baambaataa',
                            $meta_description = 'Afrikanabanana',
                            $meta_keywords = 'TeroristUKRqwerty');
        $I->amOnPage('/shop/brand/cannibal-corpse#');
        $I->seeInPageSource("$ID_brand Cannibal Corpse Qrutal Death Metal гуд бай");
        $I->dontSeeInPageSource('Baambaataa');
        $I->dontSeeInPageSource('Afrikanabanana');
        $I->dontSeeInPageSource('TeroristUKRqwerty');
    } 
    
   
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps 
     */
    public function DeleteCategoryForJiraTests(SeoExpertTester\seoexpertSteps $I) {
        $I->DeleteProductCategorys();
    }
    
    
    
  
}    

