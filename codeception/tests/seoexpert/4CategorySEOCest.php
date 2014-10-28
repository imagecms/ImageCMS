<?php

use \SeoExpertTester;
class CategorySEOCest

{
    private $ID_Russian_Name_Product_Category;
    private $ID_English_Name_Product_Category;
    
//---------------------------AUTORIZATION--------------------------------------- 
    /**
     * @group aa
     */
    public function Login(SeoExpertTester $I){
        InitTest::Login($I);
    }
    
   
//    /**
//     * @group a
//     */
//    public function ClearChash(SeoExpertTester $I) {
//        InitTest::ClearAllCach($I);
//    }  
    
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps 
     */
    public function CreateCategoryRus (SeoExpertTester\seoexpertSteps $I){    
        $I->SeoCreateCategoryProduct($createNameCategory = 'Напиток');
    }   
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps 
     */
    public function CreateCategoryEng (SeoExpertTester\seoexpertSteps $I){      
        $I->SeoCreateCategoryProduct($createNameCategory = 'Bird');
//        InitTest::ClearAllCach($I);        
    }
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps 
     */
    public function CreateBrandFirst (SeoExpertTester\seoexpertSteps $I){   
        $I->SeoCreateBrand($brandName = 'Перец');
       }
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps 
     */
    public function CreateBrandSecond (SeoExpertTester\seoexpertSteps $I){ 
        $I->SeoCreateBrand($brandName = 'Сахар');
    }
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps 
     */
    public function CreateBrandThird (SeoExpertTester\seoexpertSteps $I){  
        $I->SeoCreateBrand($brandName = 'мойва просроченная');
    }
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps 
     */
    public function CreateBrandFouth (SeoExpertTester\seoexpertSteps $I){
        $I->SeoCreateBrand($brandName = 'Gstar');
    }
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps 
     */
    public function CreateBrandFifth (SeoExpertTester\seoexpertSteps $I){
        $I->SeoCreateBrand($brandName = 'Stone Island');
//        InitTest::ClearAllCach($I);
    }
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps 
     */
    public function CreateProductFirst (SeoExpertTester\seoexpertSteps $I){  
        $I->SeoCreateProduct(
                $NameProduct    = 'Сок',
                $PriceProduct   = '987',
                $BrandProduct   = 'Перец', 
                $CategoryProduct = 'Напиток', 
                $Additional_Category = 'Bird');
    }
    
    
     /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps 
     */
    public function CreateProductSecond (SeoExpertTester\seoexpertSteps $I){  
        $I->SeoCreateProduct(
                $NameProduct    = 'Квас', 
                $PriceProduct   = '4', 
                $BrandProduct   = 'Сахар',
                $CategoryProduct = 'Напиток',
                $Additional_Category = 'Bird');
    }
    
    
     /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps 
     */
    public function CreateProductThird (SeoExpertTester\seoexpertSteps $I){  
        $I->SeoCreateProduct(
                $NameProduct    = 'Пиво', 
                $PriceProduct   = '2', 
                $BrandProduct   = 'мойва просроченная',
                $CategoryProduct = 'Напиток',
                $Additional_Category = 'Bird');
    }
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps 
     */
    public function CreateProductFouth (SeoExpertTester\seoexpertSteps $I){  
        $I->SeoCreateProduct(
                $NameProduct    = 'Кефир',
                $PriceProduct   = '3',
                $BrandProduct   = 'Gstar',
                $CategoryProduct = 'Bird', 
                $Additional_Category = 'Напиток');
    }
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps 
     */
    public function CreateProductFifth (SeoExpertTester\seoexpertSteps $I){  
        $I->SeoCreateProduct(
                $NameProduct    = 'Молоко',
                $PriceProduct   = '5',
                $BrandProduct   = 'Stone Island',
                $CategoryProduct = 'Bird',
                $Additional_Category = 'Напиток');
//        InitTest::ClearAllCach($I);
    }

    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps 
     */
    public function NativeTextAresOn (SeoExpertTester\seoexpertSteps $I){ 
        $I->SeoTextAreaActive($on = 'YES');
    }
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps 
     */
    public function CreateRusCategoryMetaData (SeoExpertTester\seoexpertSteps $I){     
        $I->SeoCreateDescriptonAndH1($name_category = 'Напиток',
                                    $description_category = 'ДЕСК страх и ненависть ДЕСК',
                                    $H1_category = "'Н1 категории Н1'");
//        InitTest::ClearAllCach($I);
    }
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps 
     */
    public function CreateEngCategoryMetaData (SeoExpertTester\seoexpertSteps $I){       
        $I->SeoCreateDescriptonAndH1($name_category = 'Bird',
                                    $description_category = 'DESC cannibal corpse DESC',
                                    $H1_category = "'Н1 eng category Н1'");
    }
    
    
//     /**
//     * @group a
//     */
//    public function CCach(SeoExpertTester $I) {
//        InitTest::ClearAllCach($I);
//    }
    
    
    /**
     * @group aa
     * @guy SeoExpertTester\seoexpertSteps 
     */
    public function GetIDCategory(SeoExpertTester\seoexpertSteps $I) {
        $ID_Cat_RUS = $I->GetCategoryID($name_category = 'Напиток');
        $ID_Cat_ENG = $I->GetCategoryID($name_category = 'Bird');
        $this->ID_Russian_Name_Product_Category = $ID_Cat_RUS;
        $this->ID_English_Name_Product_Category = $ID_Cat_ENG;
                
    }
    
    
    /**
     * @group aa
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function TabBaseSetData(SeoExpertTester\seoexpertSteps $I) {
        $I->DefoultValues();
    }
    
    
    /**
     * @group aa
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function RusTitle (SeoExpertTester\seoexpertSteps $I) {
        $I->SettingsCategorySeoPage($Title = '%ID% %name% %desc% %H1% %brands%',
                                    $Description = '',
                                    $Length_Desc = '999',
                                    $Amount_Brands = '3',
                                    $Keywords = '',
                                    $CheckBox_Activate = '//div[1]/div[5]/section/form/div[2]/div[2]/table[2]/tbody/tr/td/div/div/div[1]/div/span[2]');     
        $I->CheckValuesInPage($URL_Page = '/shop/category/napitok#', $values = "$this->ID_Russian_Name_Product_Category Напиток ДЕСК страх и ненависть ДЕСК 'Н1 категории Н1' мойва просроченная, Сахар, Перец / mini.loc");
    }
    
    
    
    
    
    /**
     * @group aa
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function EngTitle (SeoExpertTester\seoexpertSteps $I) {
        $I->SettingsCategorySeoPage($Title = '%ID% %name% %desc% %H1% %brands%',
                                    $Description = '',
                                    $Length_Desc = '999',
                                    $Amount_Brands = '3',
                                    $Keywords = '',
                                    $CheckBox_Activate = '//div[1]/div[5]/section/form/div[2]/div[2]/table[2]/tbody/tr/td/div/div/div[1]/div/span[2]');
        $I->CheckValuesInPage($URL_Page = '/shop/category/bird#', $values = "$this->ID_English_Name_Product_Category Bird DESC cannibal corpse DESC 'Н1 eng category Н1' мойва просроченная, Сахар, Перец / mini.loc");
    }
    
     
    
    
    
    /**
     * @group aa
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function RusTitleText (SeoExpertTester\seoexpertSteps $I) {
        $I->SettingsCategorySeoPage($Title = 'Вот %ID%  такоей %name% prdoduct %desc% in %H1% category %brands%',
                                    $Description = '',
                                    $Length_Desc = '999',
                                    $Amount_Brands = '3',
                                    $Keywords = '',
                                    $CheckBox_Activate = '//div[1]/div[5]/section/form/div[2]/div[2]/table[2]/tbody/tr/td/div/div/div[1]/div/span[2]');     
        $I->CheckValuesInPage($URL_Page = '/shop/category/napitok#', $values = "Вот $this->ID_Russian_Name_Product_Category  такоей Напиток prdoduct ДЕСК страх и ненависть ДЕСК in 'Н1 категории Н1' category мойва просроченная, Сахар, Перец / mini.loc");
    }
    
    
    /**
     * @group aa
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function EngTitleText (SeoExpertTester\seoexpertSteps $I) {
        $I->SettingsCategorySeoPage($Title = 'QWE %ID% asd %name% фыв %desc% ясч %H1% ы %brands%',
                                    $Description = '',
                                    $Length_Desc = '999',
                                    $Amount_Brands = '3',
                                    $Keywords = '',
                                    $CheckBox_Activate = '//div[1]/div[5]/section/form/div[2]/div[2]/table[2]/tbody/tr/td/div/div/div[1]/div/span[2]');     
        $I->CheckValuesInPage($URL_Page = '/shop/category/bird#', $values = "QWE $this->ID_English_Name_Product_Category asd Bird фыв DESC cannibal corpse DESC ясч 'Н1 eng category Н1' ы мойва просроченная, Сахар, Перец / mini.loc");
    }
    
    
    
//    /**
//     * @group a
//     */
//    public function ClearC(SeoExpertTester $I) {
//        InitTest::ClearAllCach($I);
//    }
    
    
    /**
     * @group aa
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function RusTitleTrnslit (SeoExpertTester\seoexpertSteps $I) {
        $I->SettingsCategorySeoPage($Title = 'тайтл%name[t]%',
                                    $Description = 'дескрипшн%name[t]%',
                                    $Length_Desc = '',
                                    $Amount_Brands = '',
                                    $Keywords = '',
                                    $CheckBox_Activate = '//div[1]/div[5]/section/form/div[2]/div[2]/table[2]/tbody/tr/td/div/div/div[1]/div/span[2]');     
        $I->CheckValuesInPage($URL_Page = '/shop/category/napitok#', $values = "тайтлNapitok / mini.loc");
        $I->CheckValuesInPage($URL_Page = '/shop/category/napitok#', $values = "дескрипшнNapitok / mini.loc");
    }
    
    
    
    
    
    /**
     * @group aa
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function EngTitleTranslit (SeoExpertTester\seoexpertSteps $I) {
        $I->SettingsCategorySeoPage($Title = 'тайтл%name[t]%',
                                    $Description = 'дескрипшн%name[t]%',
                                    $Length_Desc = '',
                                    $Amount_Brands = '',
                                    $Keywords = '',
                                    $CheckBox_Activate = '//div[1]/div[5]/section/form/div[2]/div[2]/table[2]/tbody/tr/td/div/div/div[1]/div/span[2]');     
        $I->CheckValuesInPage($URL_Page = '/shop/category/bird#', $values = "тайтлBird / mini.loc");
        $I->CheckValuesInPage($URL_Page = '/shop/category/bird#', $values = "дескрипшнBird / mini.loc");
    }
    
    
//    /**
//     * @group a
//     */
//    public function ClearChashOn(SeoExpertTester $I) {
//        InitTest::ClearAllCach($I);
//    }
    
    
    /**
     * @group aa
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function RusTitlePadegu (SeoExpertTester\seoexpertSteps $I) {
        $I->SettingsCategorySeoPage($Title = '%name[1]%  %name[2]%  %name[3]%  %name[4]%  %name[5]%  %name[6]%',
                                    $Description = '',
                                    $Length_Desc = '',
                                    $Amount_Brands = '',
                                    $Keywords = '',
                                    $CheckBox_Activate = '//div[1]/div[5]/section/form/div[2]/div[2]/table[2]/tbody/tr/td/div/div/div[1]/div/span[2]');     
        $I->CheckValuesInPage($URL_Page = '/shop/category/napitok#', $values = "Напиток  Напитка  Напитку  Напитка  Напитком  Напитке / mini.loc");
    }
    
    
    
    
    /**
     * @group aa
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function RusDescriptionPadegu (SeoExpertTester\seoexpertSteps $I) {
        $I->SettingsCategorySeoPage($Title = '',
                                    $Description = '%name[1]%,%name[2]%%name[3]%,%name[4]%.%name[5]%-%name[6]%',
                                    $Length_Desc = '',
                                    $Amount_Brands = '',
                                    $Keywords = '',
                                    $CheckBox_Activate = '//div[1]/div[5]/section/form/div[2]/div[2]/table[2]/tbody/tr/td/div/div/div[1]/div/span[2]');     
        $I->CheckValuesInPage($URL_Page = '/shop/category/napitok#', $values = "Напиток,НапиткаНапитку,Напитка.Напитком-Напитке / mini.loc");
    }
    
    
    
    
    /**
     * @group aa
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function RusTitlePadeguTranslit (SeoExpertTester\seoexpertSteps $I) {
        $I->SettingsCategorySeoPage($Title = '%name[1][t]%  %name[t][2]%  %name[3][t]%  %name[t][4]%  %name[t][5]%  %name[6][t]%',
                                    $Description = '',
                                    $Length_Desc = '',
                                    $Amount_Brands = '',
                                    $Keywords = '',
                                    $CheckBox_Activate = '//div[1]/div[5]/section/form/div[2]/div[2]/table[2]/tbody/tr/td/div/div/div[1]/div/span[2]');     
        $I->CheckValuesInPage($URL_Page = '/shop/category/napitok#', $values = "Napitok  Napitka  Napitku  Napitka  Napitkom  Napitke / mini.loc");
    }
    
    
    /**
     * @group aa
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function RusDescriptionPadeguTranslit (SeoExpertTester\seoexpertSteps $I) {
        $I->SettingsCategorySeoPage($Title = '',
                                    $Description = '%name[1][t]%  %name[t][2]%  %name[3][t]%  %name[t][4]%  %name[t][5]%  %name[6][t]%',
                                    $Length_Desc = '',
                                    $Amount_Brands = '',
                                    $Keywords = '',
                                    $CheckBox_Activate = '//div[1]/div[5]/section/form/div[2]/div[2]/table[2]/tbody/tr/td/div/div/div[1]/div/span[2]');     
        $I->CheckValuesInPage($URL_Page = '/shop/category/napitok#', $values = "Napitok  Napitka  Napitku  Napitka  Napitkom  Napitke / mini.loc");
    }
    
    
//    /**
//     * @group a
//     */
//    public function ClearChashClear(SeoExpertTester $I) {
//        InitTest::ClearAllCach($I);
//    }
    
    
    /**
     * @group aa
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function EngTitlePadegu (SeoExpertTester\seoexpertSteps $I) {
        $I->SettingsCategorySeoPage($Title = '%name[1]%  %name[2]%  %name[3]%  %name[4]%  %name[5]%  %name[6]%',
                                    $Description = '',
                                    $Length_Desc = '',
                                    $Amount_Brands = '',
                                    $Keywords = '',
                                    $CheckBox_Activate = '//div[1]/div[5]/section/form/div[2]/div[2]/table[2]/tbody/tr/td/div/div/div[1]/div/span[2]');     
        $I->CheckValuesInPage($URL_Page = '/shop/category/bird#', $values = "Bird  Bird  Bird  Bird  Bird  Bird / mini.loc");
    }
    
    
    
    /**
     * @group aa
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function EngDEscriprionPadegu (SeoExpertTester\seoexpertSteps $I) {
        $I->SettingsCategorySeoPage($Title = '',
                                    $Description = '%name[1]%  %name[2]%  %name[3]%  %name[4]%  %name[5]%  %name[6]%',
                                    $Length_Desc = '',
                                    $Amount_Brands = '',
                                    $Keywords = '',
                                    $CheckBox_Activate = '//div[1]/div[5]/section/form/div[2]/div[2]/table[2]/tbody/tr/td/div/div/div[1]/div/span[2]');     
        $I->CheckValuesInPage($URL_Page = '/shop/category/bird#', $values = "Bird  Bird  Bird  Bird  Bird  Bird / mini.loc");
    }
    
    
    
    /**
     * @group aa
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function EngTitlePadeguTranslit (SeoExpertTester\seoexpertSteps $I) {
        $I->SettingsCategorySeoPage($Title = '%name[1][t]%  %name[t][2]%  %name[3][t]%  %name[t][4]%  %name[t][5]%  %name[6][t]%',
                                    $Description = '',
                                    $Length_Desc = '',
                                    $Amount_Brands = '',
                                    $Keywords = '',
                                    $CheckBox_Activate = '//div[1]/div[5]/section/form/div[2]/div[2]/table[2]/tbody/tr/td/div/div/div[1]/div/span[2]');     
        $I->CheckValuesInPage($URL_Page = '/shop/category/bird#', $values = "Bird  Bird  Bird  Bird  Bird  Bird / mini.loc");
    }
    
    
    
    
    /**
     * @group aa
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function EngDescriptionPadeguTranslit (SeoExpertTester\seoexpertSteps $I) {
        $I->SettingsCategorySeoPage($Title = '',
                                    $Description = '%name[1][t]%  %name[t][2]%  %name[3][t]%  %name[t][4]%  %name[t][5]%  %name[6][t]%',
                                    $Length_Desc = '',
                                    $Amount_Brands = '',
                                    $Keywords = '',
                                    $CheckBox_Activate = '//div[1]/div[5]/section/form/div[2]/div[2]/table[2]/tbody/tr/td/div/div/div[1]/div/span[2]');     
        $I->CheckValuesInPage($URL_Page = '/shop/category/bird#', $values = "Bird  Bird  Bird  Bird  Bird  Bird / mini.loc");
    }
    
//    /**
//     * @group a
//     */
//    public function ChashClear(SeoExpertTester $I) {
//        InitTest::ClearAllCach($I);
//    }
    
    
    
    
    /**
     * @group aa
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function RusLenghtFirst (SeoExpertTester\seoexpertSteps $I) {
        $I->NullValues();
        $I->SeoCreateDescriptonAndH1($name_category = 'Напиток',
                                    $description_category = 'Миллионы покупателей ищут товары в интернет-магазинах, но покупают как правило в одном из них. Что же влияет на выбор покупателем того или иного магазина? Как сделать так, чтобы покупатель, ищущий определенный товар, остановил свой выбор именно на вашем интернет-магазине?',
                                    $H1_category = "'Н1 категории Н1'");
        $I->SettingsCategorySeoPage($Title = '',
                                    $Description = '%desc%',
                                    $Length_Desc = '100',
                                    $Amount_Brands = '',
                                    $Keywords = '',
                                    $CheckBox_Activate = '//div[1]/div[5]/section/form/div[2]/div[2]/table[2]/tbody/tr/td/div/div/div[1]/div/span[2]');     
        $I->CheckValuesInPage($URL_Page = '/shop/category/napitok#',
                            $values = "Миллионы покупателей ищут товары в интернет-магазинах, но покупают как правило в одном из них. Что ж");
    }
    
    
    /**
     * @group aa
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function RusLenghtFirstMax (SeoExpertTester\seoexpertSteps $I) {
        $I->SeoCreateDescriptonAndH1($name_category = 'Напиток',
                                    $description_category = 'Миллионы покупателей ищут товары в интернет-магазинах, но покупают как правило в одном из них. Что же влияет на выбор покупателем того или иного магазина? Как сделать так, чтобы покупатель, ищущий определенный товар, остановил свой выбор именно на вашем интернет-магазине?',
                                    $H1_category = "'Н1 категории Н1'");
        $I->SettingsCategorySeoPage($Title = '',
                                    $Description = '%desc%',
                                    $Length_Desc = '150',
                                    $Amount_Brands = '',
                                    $Keywords = '',
                                    $CheckBox_Activate = '//div[1]/div[5]/section/form/div[2]/div[2]/table[2]/tbody/tr/td/div/div/div[1]/div/span[2]');     
        $I->CheckValuesInPage($URL_Page = '/shop/category/napitok#',
                            $values = "Миллионы покупателей ищут товары в интернет-магазинах, но покупают как правило в одном из них. Что же влияет на выбор покупателем того или иного магаз");
    }
    
    
    
    /**
     * @group aa
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function RusLenghtFirstMin (SeoExpertTester\seoexpertSteps $I) {
        $I->SeoCreateDescriptonAndH1($name_category = 'Напиток',
                                    $description_category = 'Миллионы покупателей ищут товары в интернет-магазинах, но покупают как правило в одном из них. Что же влияет на выбор покупателем того или иного магазина? Как сделать так, чтобы покупатель, ищущий определенный товар, остановил свой выбор именно на вашем интернет-магазине?',
                                    $H1_category = "'Н1 категории Н1'");
        $I->SettingsCategorySeoPage($Title = '',
                                    $Description = '%desc%',
                                    $Length_Desc = '1',
                                    $Amount_Brands = '',
                                    $Keywords = '',
                                    $CheckBox_Activate = '//div[1]/div[5]/section/form/div[2]/div[2]/table[2]/tbody/tr/td/div/div/div[1]/div/span[2]');     
        $I->CheckValuesInPage($URL_Page = '/shop/category/napitok#',
                            $values = "М");
    }
    
    
    
    
    /**
     * @group aa
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function RusLenghtFirstNull (SeoExpertTester\seoexpertSteps $I) {
        $I->SeoCreateDescriptonAndH1($name_category = 'Напиток',
                                    $description_category = 'Миллионы покупателей ищут товары в интернет-магазинах, но покупают как правило в одном из них. Что же влияет на выбор покупателем того или иного магазина? Как сделать так, чтобы покупатель, ищущий определенный товар, остановил свой выбор именно на вашем интернет-магазине?',
                                    $H1_category = "'Н1 категории Н1'");
        $I->SettingsCategorySeoPage($Title = '',
                                    $Description = '%desc%',
                                    $Length_Desc = '0',
                                    $Amount_Brands = '',
                                    $Keywords = '',
                                    $CheckBox_Activate = '//div[1]/div[5]/section/form/div[2]/div[2]/table[2]/tbody/tr/td/div/div/div[1]/div/span[2]');     
        $I->CheckValuesInPage($URL_Page = '/shop/category/napitok#',
                            $values = " ");
    }
    
    
    /**
     * @group aa
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function RusPagination (SeoExpertTester\seoexpertSteps $I) {
        $I->AmountProductInFront($Amount_Product_Front = '1');
        $I->SeoCreateDescriptonAndH1($name_category = 'Напиток',
                                    $description_category = '',
                                    $H1_category = '');
        $I->SettingsCategorySeoPage($Title = '%pagenumber%',
                                    $Description = '%pagenumber%',
                                    $Length_Desc = '',
                                    $Amount_Brands = '',
                                    $Keywords = '',
                                    $CheckBox_Activate = '//div[1]/div[5]/section/form/div[2]/div[2]/table[2]/tbody/tr/td/div/div/div[1]/div/span[2]',
                                    $Page_namber = '%number%');     
        $I->CheckValuesInPage($URL_Page = '/shop/category/napitok?per_page=2#',
                            $values = "3");
        $I->CheckValuesInPage($URL_Page = '/shop/category/napitok?per_page=1#',
                            $values = "2");
        $I->CheckValuesInPage($URL_Page = '/shop/category/napitok?per_page=3#',
                            $values = "4");
        $I->CheckValuesInPage($URL_Page = '/shop/category/napitok?per_page=4#',
                            $values = "5");
        $I->AmountProductInFront($Amount_Product_Front = '12');
    }
    
    
    /**
     * @group aa
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function RusAmuontBrandOne (SeoExpertTester\seoexpertSteps $I) {
        $I->SettingsCategorySeoPage($Title = '%brands%',
                                    $Description = '',
                                    $Length_Desc = '999',
                                    $Amount_Brands = '1',
                                    $Keywords = '',
                                    $CheckBox_Activate = '//div[1]/div[5]/section/form/div[2]/div[2]/table[2]/tbody/tr/td/div/div/div[1]/div/span[2]');     
        $I->CheckValuesInPage($URL_Page = '/shop/category/napitok#', $values = "мойва просроченная");
    }
    
    
    
    /**
     * @group aa
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function EngAmuontBrandOne (SeoExpertTester\seoexpertSteps $I) {
        $I->SettingsCategorySeoPage($Title = '%brands%',
                                    $Description = '',
                                    $Length_Desc = '999',
                                    $Amount_Brands = '1',
                                    $Keywords = '',
                                    $CheckBox_Activate = '//div[1]/div[5]/section/form/div[2]/div[2]/table[2]/tbody/tr/td/div/div/div[1]/div/span[2]');     
        $I->CheckValuesInPage($URL_Page = '/shop/category/bird#', $values = "мойва просроченная");
    }
    
    
    /**
     * @group aa
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function RusAmuontBrandTwo (SeoExpertTester\seoexpertSteps $I) {
        $I->SettingsCategorySeoPage($Title = '%brands%',
                                    $Description = '',
                                    $Length_Desc = '999',
                                    $Amount_Brands = '2',
                                    $Keywords = '',
                                    $CheckBox_Activate = '//div[1]/div[5]/section/form/div[2]/div[2]/table[2]/tbody/tr/td/div/div/div[1]/div/span[2]');     
        $I->CheckValuesInPage($URL_Page = '/shop/category/napitok#', $values = "мойва просроченная, Сахар");
    }
    
    
    
    
    /**
     * @group aa
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function EngAmuontBrandTwo (SeoExpertTester\seoexpertSteps $I) {
        $I->SettingsCategorySeoPage($Title = '%brands%',
                                    $Description = '',
                                    $Length_Desc = '999',
                                    $Amount_Brands = '2',
                                    $Keywords = '',
                                    $CheckBox_Activate = '//div[1]/div[5]/section/form/div[2]/div[2]/table[2]/tbody/tr/td/div/div/div[1]/div/span[2]');     
        $I->CheckValuesInPage($URL_Page = '/shop/category/bird#', $values = "мойва просроченная, Сахар");
    }
    
    
    
    /**
     * @group aa
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function RusAmuontBrandThree (SeoExpertTester\seoexpertSteps $I) {
        $I->SettingsCategorySeoPage($Title = '%brands%',
                                    $Description = '',
                                    $Length_Desc = '999',
                                    $Amount_Brands = '3',
                                    $Keywords = '',
                                    $CheckBox_Activate = '//div[1]/div[5]/section/form/div[2]/div[2]/table[2]/tbody/tr/td/div/div/div[1]/div/span[2]');     
        $I->CheckValuesInPage($URL_Page = '/shop/category/napitok#', $values = "мойва просроченная, Сахар, Перец");
    }
    
    
    
    /**
     * @group aa
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function EngAmuontBrandThree (SeoExpertTester\seoexpertSteps $I) {
        $I->SettingsCategorySeoPage($Title = '%brands%',
                                    $Description = '',
                                    $Length_Desc = '999',
                                    $Amount_Brands = '0',
                                    $Keywords = '',
                                    $CheckBox_Activate = '//div[1]/div[5]/section/form/div[2]/div[2]/table[2]/tbody/tr/td/div/div/div[1]/div/span[2]');     
        $I->CheckValuesInPage($URL_Page = '/shop/category/napitok#', $values = "мойва просроченная, Сахар, Перец");
    }
    
    
    
    /**
     * @group aa
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function RusAmuontBrandMax (SeoExpertTester\seoexpertSteps $I) {
        $I->SettingsCategorySeoPage($Title = '%brands%',
                                    $Description = '',
                                    $Length_Desc = '',
                                    $Amount_Brands = '999',
                                    $Keywords = '',
                                    $CheckBox_Activate = '//div[1]/div[5]/section/form/div[2]/div[2]/table[2]/tbody/tr/td/div/div/div[1]/div/span[2]');     
        $I->CheckValuesInPage($URL_Page = '/shop/category/napitok#', $values = "мойва просроченная, Сахар, Перец, Stone Island, Gstar");
    }
    

    
    
    /**
     * @group aa
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function EngAmuontBrandMax (SeoExpertTester\seoexpertSteps $I) {
        $I->SeoCreateDescriptonAndH1($name_category = 'Напиток',
                                    $description_category = 'Сангвынык Холерик Ипохондрик Флегматик',
                                    $H1_category = 'Меланхолік');
        $I->SettingsCategorySeoPage($Title = '',
                                    $Description = '',
                                    $Length_Desc = '999',
                                    $Amount_Brands = '',
                                    $Keywords = '%ID% %name% %desc% %H1% %brands%',
                                    $CheckBox_Activate = '//div[1]/div[5]/section/form/div[2]/div[2]/table[2]/tbody/tr/td/div/div/div[1]/div/span[2]');     
        $I->CheckValuesInPage($URL_Page = '/shop/category/napitok#', $values = "$this->ID_Russian_Name_Product_Category Напиток Сангвынык Холерик Ипохондрик Флегматик Меланхолік мойва просроченная, Сахар, Перец");
    }
    
    
    
    /**
     * @group aa
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function RusKeywords (SeoExpertTester\seoexpertSteps $I) {
        $I->SeoCreateDescriptonAndH1($name_category = 'Bird',
                                    $description_category = 'Сангвынык Холерик Ипохондрик Флегматик',
                                    $H1_category = 'Меланхолік');
        $I->SettingsCategorySeoPage($Title = '',
                                    $Description = '',
                                    $Length_Desc = '999',
                                    $Amount_Brands = '',
                                    $Keywords = '%ID% %name% %desc% %H1% %brands%',
                                    $CheckBox_Activate = '//div[1]/div[5]/section/form/div[2]/div[2]/table[2]/tbody/tr/td/div/div/div[1]/div/span[2]');     
        $I->CheckValuesInPage($URL_Page = '/shop/category/bird#', $values = "$this->ID_English_Name_Product_Category Bird Сангвынык Холерик Ипохондрик Флегматик Меланхолік мойва просроченная, Сахар, Перец");
    }
    
    
    
    /**
     * @group aa
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function CheckBoxActiveOn (SeoExpertTester\seoexpertSteps $I) {
        $I->SeoCreateDescriptonAndH1($name_category = 'Напиток',
                                    $description_category = 'Сангвынык Холерик Ипохондрик Флегматик',
                                    $H1_category = 'Меланхолік');
        $I->SettingsCategorySeoPage($Title = '%ID% %name% %desc% %H1% %brands%',
                                    $Description = '%ID% %name% %desc% %H1% %brands%',
                                    $Length_Desc = '999',
                                    $Amount_Brands = '999',
                                    $Keywords = '%ID% %name% %desc% %H1% %brands%',
                                    $CheckBox_Activate = '//div[1]/div[5]/section/form/div[2]/div[2]/table[2]/tbody/tr/td/div/div/div[1]/div/span[2]');     
        $I->CheckValuesInPage($URL_Page = '/shop/category/napitok#', $values = "$this->ID_Russian_Name_Product_Category Напиток Сангвынык Холерик Ипохондрик Флегматик Меланхолік мойва просроченная, Сахар, Перец, Stone Island, Gstar");
    }
    
    
    /**
     * @group aa
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function CategoryCheckBoxActiveOff (SeoExpertTester\seoexpertSteps $I) {
        $I->SeoCreateDescriptonAndH1($name_category = 'Напиток',
                                    $description_category = 'Сангвынык Холерик Ипохондрик Флегматик',
                                    $H1_category = 'Меланхолік');
        $I->SettingsCategorySeoPage($Title = '%ID% %name% %desc% %H1% %brands%',
                                    $Description = '%ID% %name% %desc% %H1% %brands%',
                                    $Length_Desc = '999',
                                    $Amount_Brands = '999',
                                    $Keywords = '%ID% %name% %desc% %H1% %brands%',
                                    $CheckBox_Activate = '//div[1]/div[5]/section/form/div[2]/div[2]/table[2]/tbody/tr/td/div/div/div[1]/div/span[2]');     
        $I->DeactivateCheckBox($checkbox_xpath = '//div[1]/div[5]/section/form/div[2]/div[2]/table[2]/tbody/tr/td/div/div/div[1]/div/span[2]');
        $I->amOnPage('/shop/category/napitok#');
        $I->dontSeeInPageSource("$this->ID_Russian_Name_Product_Category Напиток Сангвынык Холерик Ипохондрик Флегматик Меланхолік мойва просроченная, Сахар, Перец, Stone Island, Gstar");
    }
    
    
    
    /**
     * @group aa
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function CategoryCheckBoxNullMetaData (SeoExpertTester\seoexpertSteps $I) {
        $I->SeoCreateDescriptonAndH1($name_category = 'Напиток',
                                    $description_category = 'Сангвынык Холерик Ипохондрик Флегматик',
                                    $H1_category = 'Меланхолік');
        $I->SeoCreatecategoryMetaData($name_category = 'Напиток',
                                    $meta_description = 'абракадабра',
                                    $meta_title = 'тайтловский',
                                    $meta_keywords = 'кейовордекс');
        $I->SettingsCategorySeoPage($Title = '%ID% %name% %desc% %H1% %brands%',
                                    $Description = '%ID% %name% %desc% %H1% %brands%',
                                    $Length_Desc = '999',
                                    $Amount_Brands = '999',
                                    $Keywords = '%ID% %name% %desc% %H1% %brands%',
                                    $CheckBox_Activate = '//div[1]/div[5]/section/form/div[2]/div[2]/table[2]/tbody/tr/td/div/div/div[1]/div/span[2]');     
        $I->ActivateCheckBox($checkbox_xpath = '//section/form/div[2]/div[2]/table[2]/tbody/tr/td/div/div/div[2]/div/span[2]');
        $I->amOnPage('/shop/category/napitok#');
        $I->dontSeeInPageSource("$this->ID_Russian_Name_Product_Category Напиток Сангвынык Холерик Ипохондрик Флегматик Меланхолік мойва просроченная, Сахар, Перец, Stone Island, Gstar");
        $I->CheckValuesInPage($URL_Page = '/shop/category/napitok#', $values = 'абракадабра');
        $I->CheckValuesInPage($URL_Page = '/shop/category/napitok#', $values = 'тайтловский');
        $I->CheckValuesInPage($URL_Page = '/shop/category/napitok#', $values = 'кейовордекс');
    }
    
    
  
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps 
     */
    public function DeleteCreatingProductCategoryForTests(SeoExpertTester\seoexpertSteps $I) {
        $I->DeleteProductCategorys();
    }
    
    
}    
