<?php

use \SeoExpertTester;
class CategorySEOCest

{
    private $ID_Category_Rus;
    private $ID_Category_Eng;
    
//---------------------------AUTORIZATION--------------------------------------- 
    /**
     * @group aaa
     */
    public function Login(SeoExpertTester $I){
        InitTest::Login($I);
    }
    
   
    /**
     * @group aa
     */
    public function ClearChash(SeoExpertTester $I) {
        InitTest::ClearAllCach($I);
    }  
    
    
    
    /**
     * @group aa
     * @guy SeoExpertTester\seoexpertSteps 
     */
    public function CreateCategoryRusForFront (SeoExpertTester\seoexpertSteps $I){    
        $I->SeoCreateCategoryProduct($createNameCategory = 'Напиток');
    }       
    /**
     * @group aa
     * @guy SeoExpertTester\seoexpertSteps 
     */
    public function CreateCategoryEngForFront (SeoExpertTester\seoexpertSteps $I){      
        $I->SeoCreateCategoryProduct($createNameCategory = 'Bird');
        InitTest::ClearAllCach($I);        
    }
    /**
     * @group aa
     * @guy SeoExpertTester\seoexpertSteps 
     */
    public function CreateBrand1ForFront (SeoExpertTester\seoexpertSteps $I){      
        $I->SeoCreateBrand($brandName = 'Перец');
    }
    /**
     * @group aa
     * @guy SeoExpertTester\seoexpertSteps 
     */
    public function CreateBrand2ForFront (SeoExpertTester\seoexpertSteps $I){   
        $I->SeoCreateBrand($brandName = 'Сахар');
    }
    /**
     * @group aa
     * @guy SeoExpertTester\seoexpertSteps 
     */
    public function CreateBrand3ForFront (SeoExpertTester\seoexpertSteps $I){   
        $I->SeoCreateBrand($brandName = 'мойва просроченная');
    }
    /**
     * @group aa
     * @guy SeoExpertTester\seoexpertSteps 
     */
    public function CreateBrand4ForFront (SeoExpertTester\seoexpertSteps $I){   
        $I->SeoCreateBrand($brandName = 'Gstar');
    }
    /**
     * @group aa
     * @guy SeoExpertTester\seoexpertSteps 
     */
    public function CreateBrand5ForFront (SeoExpertTester\seoexpertSteps $I){   
        $I->SeoCreateBrand($brandName = 'Stone Island');
        InitTest::ClearAllCach($I);
    }
    
    /**
     * @group aa
     * @guy SeoExpertTester\seoexpertSteps 
     */
    public function CreateProduct1ForFront (SeoExpertTester\seoexpertSteps $I){  
        $I->SeoCreateProduct($NameProduct = 'Сок', $PriceProduct = '987', $BrandProduct = 'Перец', $CategoryProduct = 'Напиток', $Additional_Category = 'Bird');
    }
     /**
     * @group aa
     * @guy SeoExpertTester\seoexpertSteps 
     */
    public function CreateProduct2ForFront (SeoExpertTester\seoexpertSteps $I){  
        $I->SeoCreateProduct($NameProduct = 'Квас', $PriceProduct = '4', $BrandProduct = 'Сахар', $CategoryProduct = 'Напиток', $Additional_Category = 'Bird');
    }
     /**
     * @group aa
     * @guy SeoExpertTester\seoexpertSteps 
     */
    public function CreateProduct3ForFront (SeoExpertTester\seoexpertSteps $I){  
        $I->SeoCreateProduct($NameProduct = 'Пиво', $PriceProduct = '2', $BrandProduct = 'мойва просроченная', $CategoryProduct = 'Напиток', $Additional_Category = 'Bird');
    }
    /**
     * @group aa
     * @guy SeoExpertTester\seoexpertSteps 
     */
    public function CreateProduct4ForFront (SeoExpertTester\seoexpertSteps $I){  
        $I->SeoCreateProduct($NameProduct = 'Кефир', $PriceProduct = '3', $BrandProduct = 'Gstar', $CategoryProduct = 'Bird', $Additional_Category = 'Напиток');
    }
    /**
     * @group aa
     * @guy SeoExpertTester\seoexpertSteps 
     */
    public function CreateProduct5ForFront (SeoExpertTester\seoexpertSteps $I){  
        $I->SeoCreateProduct($NameProduct = 'Молоко', $PriceProduct = '5', $BrandProduct = 'Stone Island', $CategoryProduct = 'Bird', $Additional_Category = 'Напиток');
        InitTest::ClearAllCach($I);
    }

    /**
     * @group aa
     * @guy SeoExpertTester\seoexpertSteps 
     */
    public function TextAreaActive (SeoExpertTester\seoexpertSteps $I){ 
        $I->SeoTextAreaActive($on = 'YES');
    }
    
    /**
     * @group aa
     * @guy SeoExpertTester\seoexpertSteps 
     */
    public function H1andDescriptionForRusProduct (SeoExpertTester\seoexpertSteps $I){     
        $I->SeoCreateDescriptonAndH1($name_category = 'Напиток',
                                    $description_category = 'ДЕСК страх и ненависть ДЕСК',
                                    $H1_category = "'Н1 категории Н1'");
        InitTest::ClearAllCach($I);
    }
    
    
    /**
     * @group aa
     * @guy SeoExpertTester\seoexpertSteps 
     */
    public function H1andDescriptionForEngProduct (SeoExpertTester\seoexpertSteps $I){       
        $I->SeoCreateDescriptonAndH1($name_category = 'Bird',
                                    $description_category = 'DESC cannibal corpse DESC',
                                    $H1_category = "'Н1 eng category Н1'");
    }
     /**
     * @group aa
     */
    public function ClearChash1(SeoExpertTester $I) {
        InitTest::ClearAllCach($I);
    }
    /**
     * @group aaa
     * @guy SeoExpertTester\seoexpertSteps 
     */
    public function GetIDCategory(SeoExpertTester\seoexpertSteps $I) {
        $ID_Cat_RUS = $I->GetCategoryID($name_category = 'Напиток');
        $ID_Cat_ENG = $I->GetCategoryID($name_category = 'Bird');
        $this->ID_Category_Rus = $ID_Cat_RUS;
        $this->ID_Category_Eng = $ID_Cat_ENG;
                
    }
    
    
    /**
     * @group aaa
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function DefoltSettings(SeoExpertTester\seoexpertSteps $I) {
        $I->DefoultValues();
    }
    
    
    /**
     * @group aaa
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function CategoryTitleComonRUS (SeoExpertTester\seoexpertSteps $I) {
//        $I->NullValues();
        $I->SettingsCategorySeoPage($Title = '%ID% %name% %desc% %H1% %brands%',
                                    $Description = '',
                                    $Length_Desc = '999',
                                    $Amount_Brands = '3',
                                    $Keywords = '',
                                    $CheckBox_Activate = '//div[1]/div[5]/section/form/div[2]/div[2]/table[2]/tbody/tr/td/div/div/div[1]/div/span[2]');     
        $I->CheckValuesInPage($URL_Page = '/shop/category/napitok#', $values = "$this->ID_Category_Rus");//Напиток ДЕСК страх и ненависть ДЕСК 'Н1 категории Н1' мойва просроченная, Сахар, Перец / mini.loc
    }
    
    
    
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function CategoryTitleComonENG (SeoExpertTester\seoexpertSteps $I) {
        $I->SettingsCategorySeoPage($Title = '%ID% %name% %desc% %H1% %brands%',
                                    $Description = '',
                                    $Length_Desc = '999',
                                    $Amount_Brands = '3',
                                    $Keywords = '',
                                    $CheckBox_Activate = '//div[1]/div[5]/section/form/div[2]/div[2]/table[2]/tbody/tr/td/div/div/div[1]/div/span[2]');
        $I->CheckValuesInPage($URL_Page = '/shop/category/bird#', $values = "$this->ID_Category_Eng Bird DESC cannibal corpse DESC 'Н1 eng category Н1' мойва просроченная, Сахар, Перец / mini.loc");
    }
    
     
    
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function CategoryTitleComonAndTextRUS (SeoExpertTester\seoexpertSteps $I) {
        $I->SettingsCategorySeoPage($Title = 'Вот %ID%  такоей %name% prdoduct %desc% in %H1% category %brands%',
                                    $Description = '',
                                    $Length_Desc = '999',
                                    $Amount_Brands = '3',
                                    $Keywords = '',
                                    $CheckBox_Activate = '//div[1]/div[5]/section/form/div[2]/div[2]/table[2]/tbody/tr/td/div/div/div[1]/div/span[2]');     
        $I->CheckValuesInPage($URL_Page = '/shop/category/napitok#', $values = "Вот $this->ID_Category_Rus  такоей Напиток prdoduct ДЕСК страх и ненависть ДЕСК in 'Н1 категории Н1' category мойва просроченная, Сахар, Перец / mini.loc");
    }
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function CategoryTitleComonAndTextENG (SeoExpertTester\seoexpertSteps $I) {
        $I->SettingsCategorySeoPage($Title = 'QWE %ID% asd %name% фыв %desc% ясч %H1% ы %brands%',
                                    $Description = '',
                                    $Length_Desc = '999',
                                    $Amount_Brands = '3',
                                    $Keywords = '',
                                    $CheckBox_Activate = '//div[1]/div[5]/section/form/div[2]/div[2]/table[2]/tbody/tr/td/div/div/div[1]/div/span[2]');     
        $I->CheckValuesInPage($URL_Page = '/shop/category/bird#', $values = "QWE $this->ID_Category_Eng asd Bird фыв DESC cannibal corpse DESC ясч 'Н1 eng category Н1' ы мойва просроченная, Сахар, Перец / mini.loc");
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
    public function CategoryTitleTranslitRUS (SeoExpertTester\seoexpertSteps $I) {
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
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function CategoryTitleTranslitENG (SeoExpertTester\seoexpertSteps $I) {
        $I->SettingsCategorySeoPage($Title = 'тайтл%name[t]%',
                                    $Description = 'дескрипшн%name[t]%',
                                    $Length_Desc = '',
                                    $Amount_Brands = '',
                                    $Keywords = '',
                                    $CheckBox_Activate = '//div[1]/div[5]/section/form/div[2]/div[2]/table[2]/tbody/tr/td/div/div/div[1]/div/span[2]');     
        $I->CheckValuesInPage($URL_Page = '/shop/category/bird#', $values = "тайтлBird / mini.loc");
        $I->CheckValuesInPage($URL_Page = '/shop/category/bird#', $values = "дескрипшнBird / mini.loc");
    }
    
    
    /**
     * @group a
     */
    public function ClearChash4(SeoExpertTester $I) {
        InitTest::ClearAllCach($I);
    }
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function CategoryTitlePadeguRUS (SeoExpertTester\seoexpertSteps $I) {
        $I->SettingsCategorySeoPage($Title = '%name[1]%  %name[2]%  %name[3]%  %name[4]%  %name[5]%  %name[6]%',
                                    $Description = '',
                                    $Length_Desc = '',
                                    $Amount_Brands = '',
                                    $Keywords = '',
                                    $CheckBox_Activate = '//div[1]/div[5]/section/form/div[2]/div[2]/table[2]/tbody/tr/td/div/div/div[1]/div/span[2]');     
        $I->CheckValuesInPage($URL_Page = '/shop/category/napitok#', $values = "Напиток  Напитка  Напитку  Напитка  Напитком  Напитке / mini.loc");
    }
    
    
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function CategoryDescriptionPadeguRUS (SeoExpertTester\seoexpertSteps $I) {
        $I->SettingsCategorySeoPage($Title = '',
                                    $Description = '%name[1]%,%name[2]%%name[3]%,%name[4]%.%name[5]%-%name[6]%',
                                    $Length_Desc = '',
                                    $Amount_Brands = '',
                                    $Keywords = '',
                                    $CheckBox_Activate = '//div[1]/div[5]/section/form/div[2]/div[2]/table[2]/tbody/tr/td/div/div/div[1]/div/span[2]');     
        $I->CheckValuesInPage($URL_Page = '/shop/category/napitok#', $values = "Напиток,НапиткаНапитку,Напитка.Напитком-Напитке / mini.loc");
    }
    
    
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function CategoryTitleTranslitPadeguRUS (SeoExpertTester\seoexpertSteps $I) {
        $I->SettingsCategorySeoPage($Title = '%name[1][t]%  %name[t][2]%  %name[3][t]%  %name[t][4]%  %name[t][5]%  %name[6][t]%',
                                    $Description = '',
                                    $Length_Desc = '',
                                    $Amount_Brands = '',
                                    $Keywords = '',
                                    $CheckBox_Activate = '//div[1]/div[5]/section/form/div[2]/div[2]/table[2]/tbody/tr/td/div/div/div[1]/div/span[2]');     
        $I->CheckValuesInPage($URL_Page = '/shop/category/napitok#', $values = "Napitok  Napitka  Napitku  Napitka  Napitkom  Napitke / mini.loc");
    }
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function CategoryDescriptionTranslitPadeguRUS (SeoExpertTester\seoexpertSteps $I) {
        $I->SettingsCategorySeoPage($Title = '',
                                    $Description = '%name[1][t]%  %name[t][2]%  %name[3][t]%  %name[t][4]%  %name[t][5]%  %name[6][t]%',
                                    $Length_Desc = '',
                                    $Amount_Brands = '',
                                    $Keywords = '',
                                    $CheckBox_Activate = '//div[1]/div[5]/section/form/div[2]/div[2]/table[2]/tbody/tr/td/div/div/div[1]/div/span[2]');     
        $I->CheckValuesInPage($URL_Page = '/shop/category/napitok#', $values = "Napitok  Napitka  Napitku  Napitka  Napitkom  Napitke / mini.loc");
    }
    
    
    /**
     * @group a
     */
    public function ClearChash5(SeoExpertTester $I) {
        InitTest::ClearAllCach($I);
    }
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function CategoryTitlePadeguENG (SeoExpertTester\seoexpertSteps $I) {
        $I->SettingsCategorySeoPage($Title = '%name[1]%  %name[2]%  %name[3]%  %name[4]%  %name[5]%  %name[6]%',
                                    $Description = '',
                                    $Length_Desc = '',
                                    $Amount_Brands = '',
                                    $Keywords = '',
                                    $CheckBox_Activate = '//div[1]/div[5]/section/form/div[2]/div[2]/table[2]/tbody/tr/td/div/div/div[1]/div/span[2]');     
        $I->CheckValuesInPage($URL_Page = '/shop/category/bird#', $values = "Bird  Bird  Bird  Bird  Bird  Bird / mini.loc");
    }
    
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function CategoryDescriptionPadeguENG (SeoExpertTester\seoexpertSteps $I) {
        $I->SettingsCategorySeoPage($Title = '',
                                    $Description = '%name[1]%  %name[2]%  %name[3]%  %name[4]%  %name[5]%  %name[6]%',
                                    $Length_Desc = '',
                                    $Amount_Brands = '',
                                    $Keywords = '',
                                    $CheckBox_Activate = '//div[1]/div[5]/section/form/div[2]/div[2]/table[2]/tbody/tr/td/div/div/div[1]/div/span[2]');     
        $I->CheckValuesInPage($URL_Page = '/shop/category/bird#', $values = "Bird  Bird  Bird  Bird  Bird  Bird / mini.loc");
    }
    
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function CategoryTitleTranslitPadeguENG (SeoExpertTester\seoexpertSteps $I) {
        $I->SettingsCategorySeoPage($Title = '%name[1][t]%  %name[t][2]%  %name[3][t]%  %name[t][4]%  %name[t][5]%  %name[6][t]%',
                                    $Description = '',
                                    $Length_Desc = '',
                                    $Amount_Brands = '',
                                    $Keywords = '',
                                    $CheckBox_Activate = '//div[1]/div[5]/section/form/div[2]/div[2]/table[2]/tbody/tr/td/div/div/div[1]/div/span[2]');     
        $I->CheckValuesInPage($URL_Page = '/shop/category/bird#', $values = "Bird  Bird  Bird  Bird  Bird  Bird / mini.loc");
    }
    
    
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function CategoryDescriptionTranslitPadeguENG (SeoExpertTester\seoexpertSteps $I) {
        $I->SettingsCategorySeoPage($Title = '',
                                    $Description = '%name[1][t]%  %name[t][2]%  %name[3][t]%  %name[t][4]%  %name[t][5]%  %name[6][t]%',
                                    $Length_Desc = '',
                                    $Amount_Brands = '',
                                    $Keywords = '',
                                    $CheckBox_Activate = '//div[1]/div[5]/section/form/div[2]/div[2]/table[2]/tbody/tr/td/div/div/div[1]/div/span[2]');     
        $I->CheckValuesInPage($URL_Page = '/shop/category/bird#', $values = "Bird  Bird  Bird  Bird  Bird  Bird / mini.loc");
    }
    
    /**
     * @group a
     */
    public function ClearChash6(SeoExpertTester $I) {
        InitTest::ClearAllCach($I);
    }
    
    
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function CategoryDescriptionLenght100RUS (SeoExpertTester\seoexpertSteps $I) {
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
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function CategoryDescriptionLenghtMaxRUS (SeoExpertTester\seoexpertSteps $I) {
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
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function CategoryDescriptionLenghtMinRUS (SeoExpertTester\seoexpertSteps $I) {
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
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function CategoryDescriptionLenghtNullRUS (SeoExpertTester\seoexpertSteps $I) {
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
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function CategoryDescriptionPagination (SeoExpertTester\seoexpertSteps $I) {
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
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function CategoryAmount1BrandsTitleComonRUS (SeoExpertTester\seoexpertSteps $I) {
        $I->SettingsCategorySeoPage($Title = '%brands%',
                                    $Description = '',
                                    $Length_Desc = '999',
                                    $Amount_Brands = '1',
                                    $Keywords = '',
                                    $CheckBox_Activate = '//div[1]/div[5]/section/form/div[2]/div[2]/table[2]/tbody/tr/td/div/div/div[1]/div/span[2]');     
        $I->CheckValuesInPage($URL_Page = '/shop/category/napitok#', $values = "мойва просроченная");
    }
    
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function CategoryAmount1BrandsTitleComonENG (SeoExpertTester\seoexpertSteps $I) {
        $I->SettingsCategorySeoPage($Title = '%brands%',
                                    $Description = '',
                                    $Length_Desc = '999',
                                    $Amount_Brands = '1',
                                    $Keywords = '',
                                    $CheckBox_Activate = '//div[1]/div[5]/section/form/div[2]/div[2]/table[2]/tbody/tr/td/div/div/div[1]/div/span[2]');     
        $I->CheckValuesInPage($URL_Page = '/shop/category/bird#', $values = "мойва просроченная");
    }
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function CategoryAmount2BrandsTitleComonRUS (SeoExpertTester\seoexpertSteps $I) {
        $I->SettingsCategorySeoPage($Title = '%brands%',
                                    $Description = '',
                                    $Length_Desc = '999',
                                    $Amount_Brands = '2',
                                    $Keywords = '',
                                    $CheckBox_Activate = '//div[1]/div[5]/section/form/div[2]/div[2]/table[2]/tbody/tr/td/div/div/div[1]/div/span[2]');     
        $I->CheckValuesInPage($URL_Page = '/shop/category/napitok#', $values = "мойва просроченная, Сахар");
    }
    
    
    /**
     * @group a
     */
    public function ClearChashasas(SeoExpertTester $I) {
        InitTest::ClearAllCach($I);
    }  
    
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function CategoryAmount2BrandsTitleComonENG (SeoExpertTester\seoexpertSteps $I) {
        $I->SettingsCategorySeoPage($Title = '%brands%',
                                    $Description = '',
                                    $Length_Desc = '999',
                                    $Amount_Brands = '2',
                                    $Keywords = '',
                                    $CheckBox_Activate = '//div[1]/div[5]/section/form/div[2]/div[2]/table[2]/tbody/tr/td/div/div/div[1]/div/span[2]');     
        $I->CheckValuesInPage($URL_Page = '/shop/category/bird#', $values = "мойва просроченная, Сахар");
    }
    
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function CategoryAmount3BrandsTitleComonRUS (SeoExpertTester\seoexpertSteps $I) {
        $I->SettingsCategorySeoPage($Title = '%brands%',
                                    $Description = '',
                                    $Length_Desc = '999',
                                    $Amount_Brands = '3',
                                    $Keywords = '',
                                    $CheckBox_Activate = '//div[1]/div[5]/section/form/div[2]/div[2]/table[2]/tbody/tr/td/div/div/div[1]/div/span[2]');     
        $I->CheckValuesInPage($URL_Page = '/shop/category/napitok#', $values = "мойва просроченная, Сахар, Перец");
    }
    
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function CategoryAmount0BrandsTitleComonRUS (SeoExpertTester\seoexpertSteps $I) {
        $I->SettingsCategorySeoPage($Title = '%brands%',
                                    $Description = '',
                                    $Length_Desc = '999',
                                    $Amount_Brands = '0',
                                    $Keywords = '',
                                    $CheckBox_Activate = '//div[1]/div[5]/section/form/div[2]/div[2]/table[2]/tbody/tr/td/div/div/div[1]/div/span[2]');     
        $I->CheckValuesInPage($URL_Page = '/shop/category/napitok#', $values = "мойва просроченная, Сахар, Перец");
    }
    
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function CategoryAmountMAXBrandsTitleComonRUS (SeoExpertTester\seoexpertSteps $I) {
        $I->SettingsCategorySeoPage($Title = '%brands%',
                                    $Description = '',
                                    $Length_Desc = '',
                                    $Amount_Brands = '999',
                                    $Keywords = '',
                                    $CheckBox_Activate = '//div[1]/div[5]/section/form/div[2]/div[2]/table[2]/tbody/tr/td/div/div/div[1]/div/span[2]');     
        $I->CheckValuesInPage($URL_Page = '/shop/category/napitok#', $values = "мойва просроченная, Сахар, Перец, Stone Island, Gstar");
    }
    

    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function CategoryKeywordsComonRUS (SeoExpertTester\seoexpertSteps $I) {
        $I->SeoCreateDescriptonAndH1($name_category = 'Напиток',
                                    $description_category = 'Сангвынык Холерик Ипохондрик Флегматик',
                                    $H1_category = 'Меланхолік');
        $I->SettingsCategorySeoPage($Title = '',
                                    $Description = '',
                                    $Length_Desc = '999',
                                    $Amount_Brands = '',
                                    $Keywords = '%ID% %name% %desc% %H1% %brands%',
                                    $CheckBox_Activate = '//div[1]/div[5]/section/form/div[2]/div[2]/table[2]/tbody/tr/td/div/div/div[1]/div/span[2]');     
        $I->CheckValuesInPage($URL_Page = '/shop/category/napitok#', $values = "$this->ID_Category_Rus Напиток Сангвынык Холерик Ипохондрик Флегматик Меланхолік мойва просроченная, Сахар, Перец");
    }
    
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function CategoryKeywordsComonENG (SeoExpertTester\seoexpertSteps $I) {
        $I->SeoCreateDescriptonAndH1($name_category = 'Bird',
                                    $description_category = 'Сангвынык Холерик Ипохондрик Флегматик',
                                    $H1_category = 'Меланхолік');
        $I->SettingsCategorySeoPage($Title = '',
                                    $Description = '',
                                    $Length_Desc = '999',
                                    $Amount_Brands = '',
                                    $Keywords = '%ID% %name% %desc% %H1% %brands%',
                                    $CheckBox_Activate = '//div[1]/div[5]/section/form/div[2]/div[2]/table[2]/tbody/tr/td/div/div/div[1]/div/span[2]');     
        $I->CheckValuesInPage($URL_Page = '/shop/category/bird#', $values = "$this->ID_Category_Eng Bird Сангвынык Холерик Ипохондрик Флегматик Меланхолік мойва просроченная, Сахар, Перец");
    }
    
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function CategoryCheckBoxActiveON (SeoExpertTester\seoexpertSteps $I) {
        $I->SeoCreateDescriptonAndH1($name_category = 'Напиток',
                                    $description_category = 'Сангвынык Холерик Ипохондрик Флегматик',
                                    $H1_category = 'Меланхолік');
        $I->SettingsCategorySeoPage($Title = '%ID% %name% %desc% %H1% %brands%',
                                    $Description = '%ID% %name% %desc% %H1% %brands%',
                                    $Length_Desc = '999',
                                    $Amount_Brands = '999',
                                    $Keywords = '%ID% %name% %desc% %H1% %brands%',
                                    $CheckBox_Activate = '//div[1]/div[5]/section/form/div[2]/div[2]/table[2]/tbody/tr/td/div/div/div[1]/div/span[2]');     
        $I->CheckValuesInPage($URL_Page = '/shop/category/napitok#', $values = "$this->ID_Category_Rus Напиток Сангвынык Холерик Ипохондрик Флегматик Меланхолік мойва просроченная, Сахар, Перец, Stone Island, Gstar");
    }
    
    /**
     * @group a
     */
    public function ClearChash111(SeoExpertTester $I) {
        InitTest::ClearAllCach($I);
    }  
    
    
    /**
     * @group a
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
        $I->dontSeeInPageSource("$this->ID_Category_Rus Напиток Сангвынык Холерик Ипохондрик Флегматик Меланхолік мойва просроченная, Сахар, Перец, Stone Island, Gstar");
    }
    
    
    
    /**
     * @group a
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
        $I->dontSeeInPageSource("$this->ID_Category_Rus Напиток Сангвынык Холерик Ипохондрик Флегматик Меланхолік мойва просроченная, Сахар, Перец, Stone Island, Gstar");
        $I->CheckValuesInPage($URL_Page = '/shop/category/napitok#', $values = 'абракадабра');
        $I->CheckValuesInPage($URL_Page = '/shop/category/napitok#', $values = 'тайтловский');
        $I->CheckValuesInPage($URL_Page = '/shop/category/napitok#', $values = 'кейовордекс');
    }
    
    
    
    
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps 
     */
    public function DeleteCategoryForJiraTests(SeoExpertTester\seoexpertSteps $I) {
        $I->DeleteProductCategorys();
    }
    
    
}    
