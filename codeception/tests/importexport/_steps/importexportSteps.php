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
 
    

    
    
    
    function CreateProperty($NameProperty = NULL, $CVS = NULL, $Category = NULL,
            $Values1 = NULL, $Values2 = NULL, $Values3 = NULL, $Values4 = NULL) {
        $I = $this;
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
        $I->appendField(\ExportPropertyPage::$PropTextArea, '
            ');
        $I->appendField(\ExportPropertyPage::$PropTextArea, $Values2);
        $I->appendField(\ExportPropertyPage::$PropTextArea, '
            ');
        $I->appendField(\ExportPropertyPage::$PropTextArea, $Values3);
        $I->appendField(\ExportPropertyPage::$PropTextArea, '
            ');
        $I->appendField(\ExportPropertyPage::$PropTextArea, $Values4);
        $I->click(\ExportPropertyPage::$PropButtSave);
        $I->wait('1');        
    }
    
    
    function SelectPropertyInProduct($NameProduct = NULL, $Property1 = NULL, $Property2 = NULL, $Property3 = NULL, $Property4 = NULL) {
        $I = $this; 
        if(isset($NameProduct)){
         $I->amOnPage('/admin/components/run/shop/search');   
         $I->fillField('//section/div[2]/table/thead/tr[2]/td[3]/input', $NameProduct);
         $I->click('//section/div[1]/div[2]/div/button[1]');
         $I->wait('1');
         $I->click('//section/div[2]/table/tbody/tr/td[3]/div/a');
         $I->wait('2');
         $I->click(\ExportProductPage::$CrtProdButtonProperty);
         $I->wait('2');
         $I->click('//table/tbody/tr/td/div/div/div/div/div/select/option[1]');
         if(isset($Property1)){
            $I->click(\ExportPropertyPage::$PropSelectOption1);
//            $I->click(\ExportPropertyPage::$PropSelectOption1);
//            $I->click(\ExportPropertyPage::$PropSelectOption1);
        }if(isset($Property2)){
            $I->click(\ExportPropertyPage::$PropSelectOption2);
        }if(isset($Property3)){
            $I->click(\ExportPropertyPage::$PropSelectOption3);
        }if(isset($Property4)){
            $I->click(\ExportPropertyPage::$PropSelectOption4);
        }$I->wait('1');
        $I->click(\ExportProductPage::$CrtProductButtonSaveandBack);
        $I->wait('1');
         
        }
        
    }
    
    
    
    
        function createProductForExport($nameProduct = NULL,
                                $priceProduct = NULL,
                                $categoryProduct = NULL) {
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
    }
    
    
    
    
    
    
    
    
}