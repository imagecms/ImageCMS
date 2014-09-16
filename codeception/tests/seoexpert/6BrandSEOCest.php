<?php

use \SeoExpertTester;
class BrandSEOCest

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
    public function CreateBrandForFront (SeoExpertTester\seoexpertSteps $I){
        InitTest::ClearAllCach($I);
        InitTest::changeTextAditorToNative($I);
        $I->SeoCreateBrand($brandName = 'Пробник', $opisanie = 'описание описание описание', $title = 'тайтл тайтл тайтл', $description = 'деск деск деск', $keywords = 'кей кей кей');       
    }
    
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps 
     */
    public function CreateCategoryForFront (SeoExpertTester\seoexpertSteps $I){
        $I->SeoCreateCategoryProduct($createNameCategory = 'Брендовая');   
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
    }
    
 
        
    
    
    /**
     * @group a
     */
    public function ClearChash1(SeoExpertTester $I) {
        InitTest::ClearAllCach($I);
    }
    
    
    
    /**
     * @group aa
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function CategoryTitleComonRUS (SeoExpertTester\seoexpertSteps $I) {
        $ID_brand = $I->GetBrandID($name_brand = 'Пробник');
        $I->NullValues();
        $I->SetBrandSeoPage($Title = '%ID% %name% %desc% ',
                            $Description = '%ID% %name% %desc%',
                            $Pagination = '',
                            $Length_Desc = '999',
                            $Keywords = '%ID% %name% %desc%',
                            $CheckBox_Activate = '//section/form/div[2]/div[2]/table[4]/tbody/tr/td/div/div/div[1]/div/span[2]');     
        $I->CheckValuesInPage($URL_Page = '/shop/brand/probnik#',
                                $values = "$ID_brand ");
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
  
}    

