<?php

use \SeoExpertTester;
class CategorySEOCest

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
    public function CreateCategoryForFront (SeoExpertTester\seoexpertSteps $I){
        $I->SeoCreateCategoryProduct($createNameCategory = 'Напиток');
        $I->SeoCreateCategoryProduct($createNameCategory = 'Bird');
        $I->SeoCreateBrand($brandName = 'Перец');
        $I->SeoCreateBrand($brandName = 'Сахар');
        $I->SeoCreateBrand($brandName = 'мойва просроченная');
        $I->SeoCreateBrand($brandName = 'Gstar');
        $I->SeoCreateBrand($brandName = 'Stone Island');
        $I->SeoCreateProduct($NameProduct = 'Сок', $PriceProduct = '987', $BrandProduct = 'Перец', $CategoryProduct = 'Напиток', $Additional_Category = 'Bird');
        $I->SeoCreateProduct($NameProduct = 'Квас', $PriceProduct = '4', $BrandProduct = 'Сахар', $CategoryProduct = 'Напиток', $Additional_Category = 'Bird');
        $I->SeoCreateProduct($NameProduct = 'Пиво', $PriceProduct = '2', $BrandProduct = 'мойва просроченная', $CategoryProduct = 'Напиток', $Additional_Category = 'Bird');
        $I->SeoCreateProduct($NameProduct = 'Кефир', $PriceProduct = '3', $BrandProduct = 'Gstar', $CategoryProduct = 'Bird', $Additional_Category = 'Напиток');
        $I->SeoCreateProduct($NameProduct = 'Молоко', $PriceProduct = '5', $BrandProduct = 'Stone Island', $CategoryProduct = 'Bird', $Additional_Category = 'Напиток');
        $I->SeoTextAreaActive($on = 'YES');
        $I->SeoCreateDescriptonAndH1($name_category = 'Напиток',
                                    $description_category = 'ДЕСК страх и ненависть ДЕСК',
                                    $H1_category = "'Н1 для категории Н1'");
        $I->SeoCreateDescriptonAndH1($name_category = 'Bird',
                                    $description_category = 'DESC cannibal corpse DESC',
                                    $H1_category = "'Н1 for eng category Н1'");
    }
    
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function CategoryTitleComonRUS (SeoExpertTester\seoexpertSteps $I) {
        $I->DefoultValues();
        $ID_Cat = $I->GetCategoryID($name_category = 'Напиток');
        $I->SettingsCategorySeoPage($Title = '%ID% %name% %desc% %H1% %brands%',
                                    $Description = '',
                                    $Length_Desc = '999',
                                    $Amount_Brands = '3',
                                    $Keywords = '',
                                    $CheckBox_Activate = '//section/form/div[2]/div[2]/table/tbody/tr[2]/td/div/div/div[2]/div/span[2]');     
        $I->CheckValuesInPage($URL_Page = '/shop/category/napitok#', $values = "$ID_Cat Напиток ДЕСК Модная категория страх и ненависть в Ласвегасе ДЕСК 'Н1 для категории Н1' мойва просроченная, Сахар, Перец / mini.loc");
    }
    
    
    
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function CategoryTitleComonENG (SeoExpertTester\seoexpertSteps $I) {
        $I->DefoultValues();
        $ID_Cat = $I->GetCategoryID($name_category = 'Bird');
        $I->SettingsCategorySeoPage($Title = '%ID% %name% %desc% %H1% %brands%',
                                    $Description = '',
                                    $Length_Desc = '999',
                                    $Amount_Brands = '3',
                                    $Keywords = '',
                                    $CheckBox_Activate = '//section/form/div[2]/div[2]/table/tbody/tr[2]/td/div/div/div[2]/div/span[2]');     
        $I->CheckValuesInPage($URL_Page = '/shop/category/bird#', $values = "$ID_Cat Bird DESC cannibal corpse DESC 'Н1 for eng category Н1' мойва просроченная, Сахар, Перец / mini.loc");
    }
    
     
    
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function CategoryTitleComonAndTextRUS (SeoExpertTester\seoexpertSteps $I) {
        $I->DefoultValues();
        $ID_Cat = $I->GetCategoryID($name_category = 'Напиток');
        $I->SettingsCategorySeoPage($Title = 'Вот %ID%  такоей %name% prdoduct %desc% in %H1% category %brands%',
                                    $Description = '',
                                    $Length_Desc = '999',
                                    $Amount_Brands = '3',
                                    $Keywords = '',
                                    $CheckBox_Activate = '//section/form/div[2]/div[2]/table/tbody/tr[2]/td/div/div/div[2]/div/span[2]');     
        $I->CheckValuesInPage($URL_Page = '/shop/category/napitok#', $values = "Вот $ID_Cat  такоей Напиток prdoduct ДЕСК Модная категория страх и ненависть в Ласвегасе ДЕСК in 'Н1 для категории Н1' category мойва просроченная, Сахар, Перец / mini.loc");
    }
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function CategoryTitleComonAndTextENG (SeoExpertTester\seoexpertSteps $I) {
        $I->DefoultValues();
        $ID_Cat = $I->GetCategoryID($name_category = 'Bird');
        $I->SettingsCategorySeoPage($Title = 'QWE %ID% asd %name% фыв %desc% ясч %H1% ы %brands%',
                                    $Description = '',
                                    $Length_Desc = '999',
                                    $Amount_Brands = '3',
                                    $Keywords = '',
                                    $CheckBox_Activate = '//section/form/div[2]/div[2]/table/tbody/tr[2]/td/div/div/div[2]/div/span[2]');     
        $I->CheckValuesInPage($URL_Page = '/shop/category/bird#', $values = "QWE $ID_Cat asd Bird фыв DESC cannibal corpse DESC ясч 'Н1 for eng category Н1' ы мойва просроченная, Сахар, Перец / mini.loc");
    }
    
    
    
    
    
    
    
}    
