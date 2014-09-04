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
    
    
    function SeoCreateProperty($NameProperty = NULL,
                            $CVS = NULL,
                            $Category = NULL,
            $Values1 = NULL, $Values2 = NULL, $Values3 = NULL, $Values4 = NULL) {
        $I = $this;
        $I->amOnPage('/admin/components/run/shop/properties/create');
        $I->fillField('//tbody/tr/td/div/div[1]/div/input', $NameProperty);
        $I->fillField('//tbody/tr/td/div/div[2]/div/input', $CVS);
        $I->click('//tbody/tr/td/div/div[4]/div[2]/span/span');
        $I->click('//tbody/tr/td/div/div[5]/div[2]/span/span');
        $I->click('//tbody/tr/td/div/div[6]/div[2]/span/span');
        $I->click('//tbody/tr/td/div/div[7]/div[2]/span/span');
        $I->click('//tbody/tr/td/div/div[8]/div[2]/span/span');
        $I->click('//table/tbody/tr/td/div/div[9]/div[2]/span/span');
        $I->click('//tbody/tr/td/div/div[10]/div/div/ul/li/input');
        $I->wait('2');
        $I->fillField('//tbody/tr/td/div/div[10]/div/div/ul/li/input', $Category);
        $I->wait('1');
        $I->click('//tbody/tr/td/div/div[10]/div/div/div/ul/li'); 
        $I->appendField('//tbody/tr/td/div/div[12]/div/textarea', $Values1);
        $I->appendField('//tbody/tr/td/div/div[12]/div/textarea', '
            ');
        $I->appendField('//tbody/tr/td/div/div[12]/div/textarea', $Values2);
        $I->appendField('//tbody/tr/td/div/div[12]/div/textarea', '
            ');
        $I->appendField('//tbody/tr/td/div/div[12]/div/textarea', $Values3);
        $I->appendField('//tbody/tr/td/div/div[12]/div/textarea', '
            ');
        $I->appendField('//tbody/tr/td/div/div[12]/div/textarea', $Values4);
        $I->click('//section/div/div[2]/div/button[2]');
        $I->wait('1');        
    }
    
    
    
     function SeoSelectPropertyInProduct($NameProduct = NULL,
                                    $Property1 = NULL,
                                    $Property2 = NULL,
                                    $Property3 = NULL,
                                    $Property4 = NULL) {
        $I = $this; 
        if(isset($NameProduct)){
         $I->amOnPage('/admin/components/run/shop/search');   
         $I->fillField('//section/div[2]/table/thead/tr[2]/td[3]/input', $NameProduct);
         $I->click('//section/div[1]/div[2]/div/button[1]');
         $I->wait('1');
         $I->click('//section/div[2]/table/tbody/tr/td[3]/div/a');
         $I->wait('2');
         $I->click('//section/form/div/div[1]/div[1]/a[2]');
         $I->wait('2');
         $I->click('//table/tbody/tr/td/div/div/div/div/div/select/option[1]');
         if(isset($Property1)){
            $I->click('//tbody/tr/td/div/div/div/div/div/select/option[2]');
            $I->click('//tbody/tr/td/div/div/div/div/div/select/option[3]');
            $I->click('//tbody/tr/td/div/div/div/div/div/select/option[4]');
            $I->click('//tbody/tr/td/div/div/div/div/div/select/option[5]');
        }if(isset($Property2)){
            $I->fillField('//form/div/div[2]/div[2]/table/tbody/tr/td/div/div/div/div[2]/div/input', '1');
        }if(isset($Property3)){
            $I->click('//table/tbody/tr/td/div/div/div/div[3]/div/select/option[4]');
            $I->click('//table/tbody/tr/td/div/div/div/div[3]/div/select/option[3]');
        }if(isset($Property4)){
            $I->click('//table/tbody/tr/td/div/div/div/div[4]/div/select/option[2]');
        }$I->wait('1');
        $I->click('//section/div/div[2]/div/button[2]');
        $I->wait('1');         
        }        
    }
    
    
    function SeoGrabIDProperty($namesOfProperty = NULL) {
        $I = $this;
        $I->amOnPage('/admin/components/run/shop/properties');
        $I->wait('2');
        $I->fillField('//form/table/thead/tr[2]/td[3]/input', $namesOfProperty);
        $I->click('//section/div[1]/div[2]/div/button[1]');
        $I->wait('2');
        $a = $I->grabTextFrom('//tr[1]/td[2]');
//        $I->gr
        $I->comment("$a");        
        
    }
    
    
    
    
}