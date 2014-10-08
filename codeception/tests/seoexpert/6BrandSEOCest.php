<?php

use \SeoExpertTester;
class BrandSEOCest

{
    private $ID_Russian_Name_Brand;
    private $ID_English_Name_Brand;
    
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
    public function ClearCashee (SeoExpertTester\seoexpertSteps $I){
        InitTest::ClearAllCach($I);
        InitTest::changeTextAditorToNative($I);
    }
    

    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps 
     */
    public function CreateRussianNameBrandForFront (SeoExpertTester\seoexpertSteps $I){        
        $I->SeoCreateBrand( $brandName      = 'Пробник',
                            $opisanie       = 'Ъписание описание описание',
                            $title          = 'тайтл тайтл тайтл',
                            $description    = 'деск деск деск',
                            $keywords       = 'кей кей кей'); 
    }
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps 
     */
    public function CreateEnglishNameBrandForFront (SeoExpertTester\seoexpertSteps $I){    
        $I->SeoCreateBrand( $brandName      = 'Cannibal Corpse',
                            $opisanie       = 'Qrutal Death Metal',
                            $title          = 'Grind Core',
                            $description    = 'Powervailens noise',
                            $keywords       = 'SwS Destr CC CX EE');       
    }
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function GetIDCreatingrussianAndEnglishNameBrands(SeoExpertTester\seoexpertSteps $I) {
        $ID_Russian_Name_Brand = $I->GetBrandID($name_brand = 'Пробник');
        $ID_English_Name_Brand = $I->GetBrandID($name_brand = 'Cannibal Corpse');
        $this->ID_Russian_Name_Brand = $ID_Russian_Name_Brand;
        $this->ID_English_Name_Brand = $ID_English_Name_Brand;
    }
    
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps 
     */
    public function CreateRussianNameProductCategoryForFront (SeoExpertTester\seoexpertSteps $I){
        $I->SeoCreateCategoryProduct($createNameCategory = 'Брендовая');
    }
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps 
     */
    public function CreateEnglishNameProductCategoryForFront (SeoExpertTester\seoexpertSteps $I){
        $I->SeoCreateCategoryProduct($createNameCategory = 'Etmo Plasma');   
    }
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps 
     */
    public function CreateProduct1ForFront (SeoExpertTester\seoexpertSteps $I){
        $I->SeoCreateProduct($Name_Product  = 'Брендовый Пробник товар',
                            $Price_Product  = '777',
                            $Brand_Product  = 'Пробник',
                            $Category_Product   = 'Брендовая',
                            $Additional_Category = '');
    }
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps 
     */
    public function CreateProduct2ForFront (SeoExpertTester\seoexpertSteps $I){        
        $I->SeoCreateProduct($Name_Product  = 'Пробник товар Брендовий',
                            $Price_Product  = '888',
                            $Brand_Product  = 'Пробник',
                            $Category_Product = 'Брендовая',
                            $Additional_Category = '');
    }
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps 
     */
    public function CreateProduct3ForFront (SeoExpertTester\seoexpertSteps $I){        
        $I->SeoCreateProduct($Name_Product = 'Товар Брендовый Пробник',
                            $Price_Product = '654',
                            $Brand_Product = 'Пробник',
                            $Category_Product = 'Брендовая',
                            $Additional_Category = ''); 
    }
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps 
     */
    public function CreateProduct4ForFront (SeoExpertTester\seoexpertSteps $I){        
        $I->SeoCreateProduct($Name_Product = 'Zulusandia',
                            $Price_Product = '888',
                            $Brand_Product = 'Cannibal Corpse',
                            $Category_Product = 'Etmo Plasma',
                            $Additional_Category = '');  
    }
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps 
     */
    public function CreateProduct5ForFront (SeoExpertTester\seoexpertSteps $I){
        $I->SeoCreateProduct($Name_Product = 'Two Zulusandia',
                            $Price_Product = '999',
                            $Brand_Product = 'Cannibal Corpse',
                            $Category_Product = 'Etmo Plasma',
                            $Additional_Category = ''); 
    }
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps 
     */
    public function CreateProduct6ForFront (SeoExpertTester\seoexpertSteps $I){        
        $I->SeoCreateProduct($Name_Product = 'Zulusandia Three',
                            $Price_Product = '658',
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
    public function SettingvaluesOnSeoexpertBasePage(SeoExpertTester\seoexpertSteps $I) {
        $I->NullValues();
    }
    
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function BrandTitleComonVariableRUS (SeoExpertTester\seoexpertSteps $I) {  
        $I->SetBrandSeoPage($Title = '%ID% %name% %desc%',
                            $Description = '',
                            $Pagination = '',
                            $Length_Desc = '999',
                            $Keywords = '',
                            $CheckBox_Activate = '//section/form/div[2]/div[2]/table[4]/tbody/tr/td/div/div/div[1]/div/span[2]');     
        $I->CheckValuesInPage($URL_Page = '/shop/brand/probnik#',
                                $values = "$this->ID_Russian_Name_Brand Пробник Ъписание описание описание");
    }
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function BrandTitleComonVariableENG (SeoExpertTester\seoexpertSteps $I) {
        $I->SetBrandSeoPage($Title = '%ID% %name% %desc%',
                            $Description = '',
                            $Pagination = '',
                            $Length_Desc = '999',
                            $Keywords = '',
                            $CheckBox_Activate = '//section/form/div[2]/div[2]/table[4]/tbody/tr/td/div/div/div[1]/div/span[2]');     
        $I->CheckValuesInPage($URL_Page = '/shop/brand/cannibal-corpse#',
                                $values = "$this->ID_English_Name_Brand Cannibal Corpse Qrutal Death Metal");
    }
    
    
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function BrandTitleComonSymbolRUS (SeoExpertTester\seoexpertSteps $I) {
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
        $I->SetBrandSeoPage($Title = 'QWE %desc% asd 123 %ID% ЪХЗЫ хїзфіва %name% +-',
                            $Description = '',
                            $Pagination = '',
                            $Length_Desc = '999',
                            $Keywords = '',
                            $CheckBox_Activate = '//section/form/div[2]/div[2]/table[4]/tbody/tr/td/div/div/div[1]/div/span[2]');     
        $I->CheckValuesInPage($URL_Page = '/shop/brand/probnik#',
                                $values = "QWE Ъписание описание описание asd 123 $this->ID_Russian_Name_Brand ЪХЗЫ хїзфіва Пробник +-");
    }
    
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function BrandTitleComonSymbolVariableENG (SeoExpertTester\seoexpertSteps $I) {
        $I->SetBrandSeoPage($Title = 'QWE %desc% asd 123 %ID% ЪХЗЫ хїзфіва %name% +-',
                            $Description = '',
                            $Pagination = '',
                            $Length_Desc = '999',
                            $Keywords = '',
                            $CheckBox_Activate = '//section/form/div[2]/div[2]/table[4]/tbody/tr/td/div/div/div[1]/div/span[2]');     
        $I->CheckValuesInPage($URL_Page = '/shop/brand/cannibal-corpse#',
                                $values = "QWE Qrutal Death Metal asd 123 $this->ID_English_Name_Brand ЪХЗЫ хїзфіва Cannibal Corpse +-");
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
        $I->SetBrandSeoPage($Title = '',
                            $Description = '%ID% %name% %desc%',
                            $Pagination = '',
                            $Length_Desc = '999',
                            $Keywords = '',
                            $CheckBox_Activate = '//section/form/div[2]/div[2]/table[4]/tbody/tr/td/div/div/div[1]/div/span[2]');     
        $I->CheckValuesInPage($URL_Page = '/shop/brand/probnik#',
                                $values = "$this->ID_Russian_Name_Brand Пробник Ъписание описание описание");
    }
    
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function BrandDescriptionComonENG (SeoExpertTester\seoexpertSteps $I) {
        $I->SetBrandSeoPage($Title = '',
                            $Description = '%ID% %name% %desc%',
                            $Pagination = '',
                            $Length_Desc = '999',
                            $Keywords = '',
                            $CheckBox_Activate = '//section/form/div[2]/div[2]/table[4]/tbody/tr/td/div/div/div[1]/div/span[2]');     
        $I->CheckValuesInPage($URL_Page = '/shop/brand/cannibal-corpse#',
                                $values = "$this->ID_English_Name_Brand Cannibal Corpse Qrutal Death Metal");
    }
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function BrandDescriptionSymbolRUS (SeoExpertTester\seoexpertSteps $I) {
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
        $I->SetBrandSeoPage($Title = '%ID% %name% %desc% гуд бай',
                            $Description = '%ID% %name% %desc% гуд бай',
                            $Pagination = '',
                            $Length_Desc = '999',
                            $Keywords = '%name% гуд бай',
                            $CheckBox_Activate = '//section/form/div[2]/div[2]/table[4]/tbody/tr/td/div/div/div[1]/div/span[2]');     
        $I->CheckValuesInPage($URL_Page = '/shop/brand/probnik#',
                                $values = "$this->ID_Russian_Name_Brand Пробник Ъписание описание описание гуд бай");
    } 
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function BrandActiveCheckBoxActiveENG (SeoExpertTester\seoexpertSteps $I) {
        $I->SetBrandSeoPage($Title = '%ID% %name% %desc% гуд бай',
                            $Description = '%ID% %name% %desc% гуд бай',
                            $Pagination = '',
                            $Length_Desc = '999',
                            $Keywords = '%name% гуд бай',
                            $CheckBox_Activate = '//section/form/div[2]/div[2]/table[4]/tbody/tr/td/div/div/div[1]/div/span[2]');     
        $I->CheckValuesInPage($URL_Page = '/shop/brand/cannibal-corpse#',
                                $values = "$this->ID_English_Name_Brand Cannibal Corpse Qrutal Death Metal гуд бай");
    } 
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function BrandActiveCheckBoxDeactiveRUS (SeoExpertTester\seoexpertSteps $I) {
        $I->SetBrandSeoPage($Title = '%ID% %name% %desc% гуд бай',
                            $Description = '%ID% %name% %desc% гуд бай',
                            $Pagination = '',
                            $Length_Desc = '999',
                            $Keywords = '%name% гуд бай',
                            $CheckBox_Activate = '//section/form/div[2]/div[2]/table[4]/tbody/tr/td/div/div/div[1]/div/span[2]');     
        $I->DeactivateCheckBox($checkbox_xpath = '//section/form/div[2]/div[2]/table[4]/tbody/tr/td/div/div/div[1]/div/span[2]');
        $I->amOnPage('/shop/brand/probnik#');
        $I->dontSeeInPageSource("$this->ID_Russian_Name_Brand Пробник Ъписание описание описание гуд бай");
    } 
    
    
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function BrandActiveCheckBoxDeactiveENG (SeoExpertTester\seoexpertSteps $I) {
        $I->SetBrandSeoPage($Title = '%ID% %name% %desc% гуд бай',
                            $Description = '%ID% %name% %desc% гуд бай',
                            $Pagination = '',
                            $Length_Desc = '999',
                            $Keywords = '%name% гуд бай',
                            $CheckBox_Activate = '//section/form/div[2]/div[2]/table[4]/tbody/tr/td/div/div/div[1]/div/span[2]');     
        $I->DeactivateCheckBox($checkbox_xpath = '//section/form/div[2]/div[2]/table[4]/tbody/tr/td/div/div/div[1]/div/span[2]');
        $I->amOnPage('/shop/brand/cannibal-corpse#');
        $I->dontSeeInPageSource("$this->ID_English_Name_Brand Пробник Ъписание описание описание гуд бай");
    } 
    
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function BrandNullCheckBoxActiveRUS (SeoExpertTester\seoexpertSteps $I) {
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
        $I->dontSeeInPageSource("$this->ID_Russian_Name_Brand Пробник гуляй поле бай");
        $I->seeInPageSource('тітутайтлілукай');
        $I->seeInPageSource('декскрімінатіононзенатіфон');
        $I->seeInPageSource('основаосвноавключей');
    } 
    
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function BrandNullCheckBoxActiveENG (SeoExpertTester\seoexpertSteps $I) {
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
        $I->dontSeeInPageSource("$this->ID_English_Name_Brand Cannibal Corpse гуляй поле бай");
        $I->seeInPageSource('Baambaataa');
        $I->seeInPageSource('Afrikanabanana');
        $I->seeInPageSource('TeroristUKRqwerty');
    } 
    
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function BrandNullCheckBoxDeactiveRUS (SeoExpertTester\seoexpertSteps $I) {
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
        $I->seeInPageSource("$this->ID_Russian_Name_Brand Пробник Ъписание описание описание гуд бай");
        $I->dontSeeInPageSource('тітутайтлілукай');
        $I->dontSeeInPageSource('декскрімінатіононзенатіфон');
        $I->dontSeeInPageSource('основаосвноавключей');
    } 
    
    
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function BrandNullCheckBoxDeactiveENG (SeoExpertTester\seoexpertSteps $I) {
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
        $I->seeInPageSource("$this->ID_English_Name_Brand Cannibal Corpse Qrutal Death Metal гуд бай");
        $I->dontSeeInPageSource('Baambaataa');
        $I->dontSeeInPageSource('Afrikanabanana');
        $I->dontSeeInPageSource('TeroristUKRqwerty');
    } 
    
   
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function BrandPaginationNumberRUS (SeoExpertTester\seoexpertSteps $I) {
        $I->AmountProductInFront($Amount_Product_Front = '1');
        $I->SetBrandSeoPage($Title = 'тайтл %pagenumber%',
                            $Description = 'дескрипшн %pagenumber%',
                            $Pagination = 'привет питер %number%',
                            $Length_Desc = '',
                            $Keywords = 'кейвордс %pagenumber%',
                            $CheckBox_Activate = '//section/form/div[2]/div[2]/table[4]/tbody/tr/td/div/div/div[1]/div/span[2]');     
        $I->CheckValuesInPage($URL_Page = '/shop/brand/probnik#',
                                $values = 'тайтл ');
        $I->seeInPageSource('дескрипшн ');
        $I->seeInPageSource('кейвордс ');
        $I->CheckValuesInPage($URL_Page = '/shop/brand/probnik?per_page=1#',
                                $values = 'тайтл привет питер 2');
        $I->seeInPageSource('дескрипшн привет питер 2 ');
        $I->seeInPageSource('кейвордс привет питер 2');
        $I->CheckValuesInPage($URL_Page = '/shop/brand/probnik?per_page=2#',
                                $values = 'тайтл привет питер 3');
        $I->seeInPageSource('дескрипшн привет питер 3 ');
        $I->seeInPageSource('кейвордс привет питер 3');     
    }
    
    
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function BrandPaginationNumberENG (SeoExpertTester\seoexpertSteps $I) {
        $I->AmountProductInFront($Amount_Product_Front = '1');
        $I->SetBrandSeoPage($Title = 'тайтл title %pagenumber%',
                            $Description = 'дескрипшн Description %pagenumber%',
                            $Pagination = 'привет питер Zdorow %number%',
                            $Length_Desc = '',
                            $Keywords = 'кейвордс Keywords %pagenumber%',
                            $CheckBox_Activate = '//section/form/div[2]/div[2]/table[4]/tbody/tr/td/div/div/div[1]/div/span[2]');     
        $I->CheckValuesInPage($URL_Page = '/shop/brand/cannibal-corpse#',
                                $values = 'тайтл title ');
        $I->seeInPageSource('дескрипшн Description ');
        $I->seeInPageSource('кейвордс Keywords ');
        $I->CheckValuesInPage($URL_Page = '/shop/brand/cannibal-corpse?per_page=1#',
                                $values = 'тайтл title привет питер Zdorow 2');
        $I->seeInPageSource('дескрипшн Description привет питер Zdorow 2');
        $I->seeInPageSource('кейвордс Keywords привет питер Zdorow 2');
        $I->CheckValuesInPage($URL_Page = '/shop/brand/cannibal-corpse?per_page=2#',
                                $values = 'тайтл title привет питер Zdorow 3');
        $I->seeInPageSource('дескрипшн Description привет питер Zdorow 3 ');
        $I->seeInPageSource('кейвордс Keywords привет питер Zdorow 3');     
    }
    

    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps 
     */
    public function DeleteCategoryForJiraTests(SeoExpertTester\seoexpertSteps $I) {
        $I->DeleteProductCategorys();
    }
    
    
    
  
}    

