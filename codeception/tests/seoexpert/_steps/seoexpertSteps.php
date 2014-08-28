<?php
namespace SeoExpertTester;

class seoexpertSteps 

extends \SeoExpertTester

{

    
    //-------------------------Create Category----------------------------------    
    

    
    function SeoCreateCategoryProduct( $createNameCategory = NULL, $addParentCategory = NULL) {
        $I = $this;
        $I->amOnPage('/admin/components/run/shop/categories/create');
        $I->wait('1');
        if(isset($createNameCategory)){
            $I->fillField('#inputName', $createNameCategory);
        }if(isset($addParentCategory)){ 
            $I->click('//div[1]/div[2]/div/div/a');
            $I->fillField('//section/form/div[1]/table[1]/tbody/tr/td/div/div[1]/div[2]/div/div/div/div/input', $addParentCategory);
            $I->click('//section/form/div[1]/table[1]/tbody/tr/td/div/div[1]/div[2]/div/div/div/ul/li');
        }$I->click('//button[2]'); 
        $I->wait('2');
    }
    
    
    //------------------------Create Brands-------------------------------------
    
    
    
    function SeoCreateBrand ($brandName = NULL, $opisanie = NULL, $title = NULL, $description = NULL, $keywords = NULL) {
        $I = $this;
        $I->amOnPage('/admin/components/run/shop/brands/create');
        $I->wait('2');
        $I->fillField('//tbody/tr/td/div/div[1]/div[1]/div/input', $brandName);
        if(isset($opisanie)){
            $I->fillField('//table/tbody/tr/td/div/div[2]/div/textarea', $opisanie);
        }if(isset($title)){
            $I->fillField('//table/tbody/tr/td/div/div[3]/div[1]/div/input', $title);
        }if(isset($description)){
            $I->fillField('//tbody/tr/td/div/div[3]/div[2]/div/input', $description);
        }if(isset($keywords)){
            $I->fillField('//tbody/tr/td/div/div[3]/div[3]/div/input', $keywords);
        }
        $I->click('//div[1]/div[5]/section/div[1]/div[2]/div/button[2]');
        $I->wait('2');
    }
    
    
    
    
    function SeoCreateProduct ($NameProduct = NULL, $PriceProduct = NULL, $BrandProduct = NULL, $CategoryProduct = NULL) {
        $I = $this;        
        $I->amOnPage('/admin/components/run/shop/products/create');
        $I->wait('2');
        $I->fillField('//table[1]/tbody/tr/td/div/div/div[1]/div[1]/div/input', $NameProduct);
        $I->fillField('//tbody/tr/td/div/div/div[1]/div[4]/table/tbody/tr/td[2]/input', $PriceProduct);
        $I->click('//tbody/tr/td/div/div/div[2]/div/div[1]/div/div/a/span');
        $I->fillField('//tbody/tr/td/div/div/div[2]/div/div[1]/div/div/div/div/input', $BrandProduct);
        $I->click('//tbody/tr/td/div/div/div[2]/div/div[1]/div/div/div/ul/li');
        $I->click('//table[1]/tbody/tr/td/div/div/div[2]/div/div[2]/div/div/a/span');
        $I->fillField('//table[1]/tbody/tr/td/div/div/div[2]/div/div[2]/div/div/div/div/input', $CategoryProduct);
        $I->click('//tbody/tr/td/div/div/div[2]/div/div[2]/div/div/div/ul/li');
        $I->click('//div[1]/div[5]/section/div/div[2]/div/button[1]');
        $I->wait('2');
    }
    
    
}