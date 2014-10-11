<?php

use \SeoExpertTester;
class AdvansedCategoryProductCest

{
    private $ID_Property_Russian_Name;
    private $ID_Product_Russian_Name;
    private $ID_Property_English_Name;
    private $ID_Product_English_Name;
    
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
    public function CreateCategoryRus (SeoExpertTester\seoexpertSteps $I){
        $I->SeoCreateCategoryProduct($createNameCategory = 'Троллейбус');
    }
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps 
     */
    public function CreateCategoryEng (SeoExpertTester\seoexpertSteps $I){
        $I->SeoCreateCategoryProduct($createNameCategory = 'Trolleybus');
    }
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps 
     */
    public function CreateBrandRus (SeoExpertTester\seoexpertSteps $I){
        $I->SeoCreateBrand($brandName = 'Тротуар');
    }
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps 
     */
    public function CreateBrandEng (SeoExpertTester\seoexpertSteps $I){
        $I->SeoCreateBrand($brandName = 'Sidewalk');
    }
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps 
     */
    public function CreateProductRus (SeoExpertTester\seoexpertSteps $I){
        $I->SeoCreateProduct($NameProduct           = 'Тракторная резина',
                            $PriceProduct           = '49870',
                            $BrandProduct           = 'Тротуар',
                            $CategoryProduct        = 'Троллейбус',
                            $Additional_Category    = 'Trolleybus');
    }
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps 
     */
    public function CreateProductEng (SeoExpertTester\seoexpertSteps $I){
        $I->SeoCreateProduct($NameProduct           = 'Tractor tires',
                            $PriceProduct           = '13265',
                            $BrandProduct           = 'Sidewalk',
                            $CategoryProduct        = 'Trolleybus', 
                            $Additional_Category    = 'Троллейбус');
    }
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps 
     */
    public function CreatePropertyRus(SeoExpertTester\seoexpertSteps $I) {
        $I->SeoCreateProperty(  $NameProperty   = 'Рогатый', 
                                $CVS            = 'TrapStation', 
                                $Category       = 'Троллейбус',
                                $Values1        = 'Организация организованных');
    }
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps 
     */
    public function SetPropertyRus(SeoExpertTester\seoexpertSteps $I) {
        $I->SeoSelectPropertyInProduct( $NameProduct    = 'Тракторная резина',
                                        $Property1      = 'Yes');
    }
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps 
     */
    public function CreatePropertyEng(SeoExpertTester\seoexpertSteps $I) {
        $I->SeoCreateProperty(  $NameProperty   = 'Horned', 
                                $CVS            = 'Intergalactik', 
                                $Category       = 'Trolleybus', 
                                $Values1        = 'Organization organized');
    }
    
    
     /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps 
     */
    public function SetPropertyEng(SeoExpertTester\seoexpertSteps $I) {
        $I->SeoSelectPropertyInProduct( $NameProduct    = 'Tractor tires', 
                                        $Property1      = 'Yes');
    }
    
    
     /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function grabIDProducts (SeoExpertTester\seoexpertSteps $I) {    
        
        $ID_product_Rus = $I->GetProductID($name_product = 'Тракторная резина');
        $this->ID_Product_Russian_Name = $ID_product_Rus; 
        
        $ID_product_Eng = $I->GetProductID($name_product = 'Tractor tires'); 
        $this->ID_Product_English_Name = $ID_product_Eng;      
    }
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function grabIDProperties (SeoExpertTester\seoexpertSteps $I) {
        
        $ID_property_Rus = $I->GetPropertyID($name_property = 'Рогатый');
        $this->ID_Property_Russian_Name = $ID_property_Rus;
        
        $ID_property_Eng = $I->GetPropertyID($name_property = 'Horned');  
        $this->ID_Property_English_Name = $ID_property_Eng;
    }
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function SetNullValuesBasePage (SeoExpertTester\seoexpertSteps $I){
        $I->NullValues();
    }
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function RusTitle (SeoExpertTester\seoexpertSteps $I){ 
    $I->CreateSettingValuesForFrontPageCategoryProducts($name_Category_Product_For_select = 'Троллейбус',
                                                        $input_Values_in_Field_Title = "%ID% %name% %category% %brand% %price% %CS% %p_$this->ID_Property_Russian_Name%",
                                                        $input_Values_in_Field_Description = '',
                                                        $input_Values_in_Field_Lenght = '',
                                                        $input_Values_in_Field_Keywords = '',
                                                        $CheckBox_Activate = '//section/form/table/tbody/tr/td/div/div/div[1]/div/span[2]');
    $I->CheckValuesInPage(  $URL_Page = '/shop/product/traktornaia-rezina', 
                            $values = "$this->ID_Product_Russian_Name Тракторная резина Троллейбус Тротуар 49870 руб Организация организованных");
    }
    
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
//    public function VerifyCommonValuesTitleOnFrontPageCategoryEnglishProduct (SeoExpertTester\seoexpertSteps $I){ 
//    $I->CreateSettingValuesForFrontPageCategoryProducts($name_Category_Product_For_select = '',
//                                                        $input_Values_in_Field_Title = "%ID% %name% %category% %brand% %price% %CS% %p_$this->ID_Property_English_Name%",
//                                                        $input_Values_in_Field_Description = '',
//                                                        $input_Values_in_Field_Lenght = '',
//                                                        $input_Values_in_Field_Keywords = '',
//                                                        $CheckBox_Activate = '//section/form/table/tbody/tr/td/div/div/div[1]/div/span[2]');
//    $I->CheckValuesInPage(  $URL_Page = '', 
//                            $values = "$this->ID_Product_");
//    }
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function RusDescription (SeoExpertTester\seoexpertSteps $I){ 
    $I->CreateSettingValuesForFrontPageCategoryProducts($name_Category_Product_For_select = 'Троллейбус',
                                                        $input_Values_in_Field_Title = '',
                                                        $input_Values_in_Field_Description = "%ID% %name% %category% %brand% %price% %CS% %p_$this->ID_Property_Russian_Name%",
                                                        $input_Values_in_Field_Lenght = '',
                                                        $input_Values_in_Field_Keywords = '',
                                                        $CheckBox_Activate = '//section/form/table/tbody/tr/td/div/div/div[1]/div/span[2]');
    $I->CheckValuesInPage(  $URL_Page = '/shop/product/traktornaia-rezina', 
                            $values = "$this->ID_Product_Russian_Name Тракторная резина Троллейбус Тротуар 49870 руб Организация организованных");
    }
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function RusKeywords (SeoExpertTester\seoexpertSteps $I){ 
    $I->CreateSettingValuesForFrontPageCategoryProducts($name_Category_Product_For_select = 'Троллейбус',
                                                        $input_Values_in_Field_Title = '',
                                                        $input_Values_in_Field_Description = '',
                                                        $input_Values_in_Field_Lenght = '',
                                                        $input_Values_in_Field_Keywords = "%name% %category% %brand% %p_$this->ID_Property_Russian_Name%",
                                                        $CheckBox_Activate = '//section/form/table/tbody/tr/td/div/div/div[1]/div/span[2]');
    $I->CheckValuesInPage(  $URL_Page = '/shop/product/traktornaia-rezina', 
                            $values = "Тракторная резина Троллейбус Тротуар Организация организованных");
    }
    
    
    

    
    /**
     * @group aaaa
     * @guy SeoExpertTester\seoexpertSteps
     */
//    public function ShopProductPageTitleRus (SeoExpertTester\seoexpertSteps $I){          
//        $I->amOnPage(seoexpertPage::$SeoUrl);
//        $I->wait('1');
//        $I->click(seoexpertPage::$SeoButtShop);
//        $I->wait('1');
//        $I->fillField(seoexpertPage::$SeoProductTitle, "%ID% %name% %category% %brand% %price% %CS% %p_$this->ID_Property_Russian_Name%");
//        $I->fillField(seoexpertPage::$SeoProductDescription, '');
//        $I->fillField(seoexpertPage::$SeoProductKeywords, '');
//        $checkbox_path = '//section/form/div[2]/div[2]/table[1]/tbody/tr/td/div/div/div[1]/div/span[2]'; 
//        $I->ActivateCheckBox($checkbox_xpath = $checkbox_path);
//        $checkbox_path = '//section/form/div[2]/div[2]/table[1]/tbody/tr/td/div/div/div[2]/div/span[2]';
//        $I->DeactivateCheckBox($checkbox_xpath = $checkbox_path);
//        $I->click(seoexpertPage::$SeoButtSave);
//        $I->wait('1');
//        $I->amOnPage(seoexpertPage::$FrontProductURLRu);
//        $I->wait('1');
//        $I->seeInPageSource("$this->ID_Product_Russian_Name");//Сеошний товар Вода Хлеб 777 руб Первое Свойство / mini.loc             
//    }
    
    
    
    
    
    
    
    
}