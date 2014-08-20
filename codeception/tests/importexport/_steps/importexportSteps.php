<?php
namespace ImportExportTester;

class importexportSteps extends \ImportExportTester
{
   
    
    function createCategoryProductForExport( $createNameCategory = NULL, $addParentCategory = NULL) {
        $I = $this;
        $I->amOnPage(\ExportCategoryPage::$CatCreatURL);
        $I->wait('1');
        if(isset($createNameCategory)){
            $I->fillField(\ExportCategoryPage::$CatCreatFieldName, $createNameCategory);
        }if(isset($addParentCategory)){
            $I->click(\ExportCategoryPage::$CatCreatSelectMenu);
            $I->fillField(\ExportCategoryPage::$CatCreatSelectField, $addParentCategory);
            $I->click(\ExportCategoryPage::$CatCreatSelectCategory);
        }$I->click(\ExportCategoryPage::$CatCreatButtSave);
        $I->wait('2');
    }
//        $I->amOnPage('/admin/components/run/shop/categories/create');
//        $I->wait('1');
//        if(isset($createNameCategory)){
//            $I->fillField('#inputName', $createNameCategory);
//        }if(isset($addParentCategory)){ 
//            $I->click('//div[1]/div[2]/div/div/a');
//            $I->fillField('//section/form/div[1]/table[1]/tbody/tr/td/div/div[1]/div[2]/div/div/div/div/input', $addParentCategory);
//            $I->click('//section/form/div[1]/table[1]/tbody/tr/td/div/div[1]/div[2]/div/div/div/ul/li');
//        }$I->click('//button[2]'); 
//        $I->wait('2');
//    }
    
    

    
    
    
    function CreateProperty($NameProperty = NULL, $CVS = NULL, $Category = NULL,
            $Values1 = NULL) {
        $I = $this;
        //'                                                                                                                                                    '   
        $I->amOnPage(\ExportPropertyPage::$PropURL);
        $I->fillField(\ExportPropertyPage::$PropFieldName, $NameProperty);
        $I->fillField(\ExportPropertyPage::$PropFieldCVS, $CVS);
        $I->click(\ExportPropertyPage::$PropChekBoxMainProp);
        $I->click(\ExportPropertyPage::$PropChekBoxTip);
        $I->click(\ExportPropertyPage::$PropChekBoxProdPage);
        $I->click(\ExportPropertyPage::$PropChekBoxProdSimile);
        $I->click(\ExportPropertyPage::$PropChekBoxFilter);
        $I->click(\ExportPropertyPage::$PropMultipleChoice);
        $I->click(\ExportPropertyPage::$PropSelect);
        $I->fillField(\ExportPropertyPage::$PropSelecctField, $Category);
        $I->click(\ExportPropertyPage::$PropSelectCategory);  
        $I->appendField(\ExportPropertyPage::$PropTextArea, $Values1);
        $I->click(\ExportPropertyPage::$PropButtSave);
        $I->wait('1');
        
    }
    
    
    
    
        function createProductForExport($nameProduct = NULL,
                                $priceProduct = NULL,
                                $categoryProduct = NULL,
                                $Property = NULL) {
        $I = $this;
        $I->wait('1');
        $I->amOnPage('/admin/components/run/shop/products/create');                                                                                    
        $I->wait('1');
        if (isset($nameProduct)) {
            $I->fillField(\ExportProductPage::$CrtProductNameProduct, $nameProduct);                                          
        }if(isset($priceProduct)){
            $I->fillField(\ExportProductPage::$CrtProductPriceProduct, $priceProduct);                                                                            
        }if(isset($categoryProduct)){
            $I->click(\ExportProductPage::$CrtProductCategoryProductSelectField);                                                         
            $I->fillField(\ExportProductPage::$CrtProductCategoryProductSelectInput, $categoryProduct);                                               
            $I->click(\ExportProductPage::$CrtProductCategoryProductSetSelect);            
        }$I->click(\ExportProductPage::$CrtProductButtonSave);
        $I->wait('3');
        if(isset($Property)){
            $I->click(\ExportProductPage::$CrtProdButtonProperty);
            $I->click(\ExportProductPage::$CrtProdSelectProperty);
        }$I->wait('1');
        $I->click(\ExportProductPage::$CrtProductButtonSaveandBack);
        $I->wait('1');
    }
    
    
    
    
    
    
    
    
}