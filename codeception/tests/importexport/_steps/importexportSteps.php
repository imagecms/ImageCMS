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
 
    

    
    
    
    function CreateProperty($NameProperty = NULL,
                            $CVS = NULL,
                            $Category = NULL,
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
    
    
    function SelectPropertyInProduct($NameProduct = NULL,
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
         $I->click(\ExportProductPage::$CrtProdButtonProperty);
         $I->wait('2');
         $I->click('//table/tbody/tr/td/div/div/div/div/div/select/option[1]');
         if(isset($Property1)){
            $I->click(\ExportPropertyPage::$PropSelectOption1);
//            $I->click(\ExportPropertyPage::$PropSelectOption1);
//            $I->click(\ExportPropertyPage::$PropSelectOption1);
            $I->click(\ExportPropertyPage::$PropSelectOption2);
            $I->click(\ExportPropertyPage::$PropSelectOption3);
            $I->click(\ExportPropertyPage::$PropSelectOption4);
        }if(isset($Property2)){
            $I->fillField('//form/div/div[2]/div[2]/table/tbody/tr/td/div/div/div/div[2]/div/input', '1');
        }if(isset($Property3)){
            $I->click('//table/tbody/tr/td/div/div/div/div[3]/div/select/option[4]');
            $I->click('//table/tbody/tr/td/div/div/div/div[3]/div/select/option[3]');
        }if(isset($Property4)){
            $I->click('//table/tbody/tr/td/div/div/div/div[4]/div/select/option[2]');
        }$I->wait('1');
        $I->click(\ExportProductPage::$CrtProductButtonSaveandBack);
        $I->wait('1');
         
        }
        
    }
    
    
    
    function TextAreaActive ($on = NULL) {
        $I = $this;
        $I->wait('1');
        $I->amOnPage('/admin/settings');
        $I->selectOption('//form/div/div[1]/table/tbody/tr/td/div/div/div/div[5]/div/select', 'none');
        $I->click('//section/div[1]/div[2]/div/button');
        $I->wait('1');
    }
    
    
    
    function CreateRelatedProduct($namePRD = NULL, $PricePRD = NULL) {
        $I = $this;
        $I->wait('1');
        $I->amOnPage('/admin/components/run/shop/products/create');                                                                                    
        $I->wait('1');
        if (isset($namePRD)) {
            $I->fillField(\ExportProductPage::$CrtProductNameProduct, $namePRD);                                          
        }if(isset($PricePRD)){
            $I->fillField(\ExportProductPage::$CrtProductPriceProduct, $PricePRD);
            $I->click(\ExportProductPage::$CrtProductButtonSaveandBack);
            $I->wait('3');
        }
    }
    
    
    
    
    
    function CreateBrandForExport($nameBrand = NULL) {
        $I = $this;
        $I->wait('1');
        $I->amOnPage('/admin/components/run/shop/brands/create');                                                                                    
        $I->wait('1');
        $I->fillField('//table/tbody/tr/td/div/div[1]/div[1]/div/input', $nameBrand);
        $I->click('//section/div[1]/div[2]/div/button[2]');
        $I->wait('1');
    }
    
    
    
        function createProductForExport($nameProduct = NULL,
                                        $priceProduct = NULL,
                                        $categoryProduct = NULL,
                                        $hit = NULL,                                     
                                        $nameVariant = NULL,                                        
                                        $article = NULL,
                                        $amount = NULL,
                                        $brand = NULL,                                        
                                        $smallDescription = NULL,
                                        $fullDescripton = NULL,
                                        $oldPrice = NULL,
                                        $relatedProducts = NULL,
                                        $productURL = NULL,
                                        $metaTitle = NULL,
                                        $metaDescription = NULL,
                                        $metaKeywords = NULL) {
        $I = $this;
        $I->wait('1');
        $I->amOnPage('/admin/components/run/shop/products/create');                                                                                    
        $I->wait('1');
        if (isset($nameProduct)) {
            $I->fillField(\ExportProductPage::$CrtProductNameProduct, $nameProduct);                                          
        }if(isset($priceProduct)){
            $I->fillField(\ExportProductPage::$CrtProductPriceProduct, $priceProduct);
            $I->click(\ExportProductPage::$CrtProductButtonSave);
            $I->wait('3');
        }if(isset($categoryProduct)){
            $I->click(\ExportProductPage::$CrtProductCategoryProductSelectField);                                                         
            $I->fillField(\ExportProductPage::$CrtProductCategoryProductSelectInput, $categoryProduct);                                               
            $I->click(\ExportProductPage::$CrtProductCategoryProductSetSelect);            
        }if(isset($hit)){
            $I->click('//tbody/tr/td/div/div/div[1]/div[3]/div/button[1]');
        }if(isset($nameVariant)){
            $I->fillField('//tbody/tr/td/div/div/div[1]/div[4]/table/tbody/tr/td[1]/div/input[3]', $nameVariant);
        }if(isset($article)){
            $I->fillField('//table[1]/tbody/tr/td/div/div/div[1]/div[4]/table/tbody/tr/td[4]/input', $article);
        }if(isset($amount)){
            $I->fillField('//table[1]/tbody/tr/td/div/div/div[1]/div[4]/table/tbody/tr/td[5]/input', $amount);
        }if(isset($brand)){
            $I->click('//table[1]/tbody/tr/td/div/div/div[2]/div/div[1]/div/div/a/span');                                                         
            $I->fillField('//table[1]/tbody/tr/td/div/div/div[2]/div/div[1]/div/div/div/div/input', $brand);                                               
            $I->click('//table[1]/tbody/tr/td/div/div/div[2]/div/div[1]/div/div/div/ul/li'); 
        }if(isset($smallDescription)){
            $I->fillField('//table[1]/tbody/tr/td/div/div/div[3]/div/textarea', $smallDescription);
        }if(isset($fullDescripton)){
            $I->fillField('//table[1]/tbody/tr/td/div/div/div[4]/div/textarea', $fullDescripton);
        }if(isset($oldPrice)){
            $I->fillField('//table[2]/tbody/tr/td/div/div/div[3]/div/input', $oldPrice);
        }if(isset($relatedProducts)){
            $I->fillField('//table[2]/tbody/tr/td/div/div/div[4]/div/input', $relatedProducts);
            $I->wait('2');
            $I->click('//body/ul[2]/li/a');
        }if(isset($productURL)){
            $I->click('//table[3]/tbody/tr/td/div/div/div[1]/div/div/button');
            $urla = $I->grabValueFrom('//table[3]/tbody/tr/td/div/div/div[1]/div/span/input');
            $I->comment("Url Product = ( $urla )");
        }if(isset($metaTitle)){
            $I->fillField('//tbody/tr/td/div/div/div[2]/div/textarea', $metaTitle);
        }if(isset($metaDescription)){
            $I->fillField('//table[3]/tbody/tr/td/div/div/div[3]/div/textarea', $metaDescription);
        }if(isset($metaKeywords)){
            $I->fillField('//table[3]/tbody/tr/td/div/div/div[4]/div/textarea', $metaKeywords);
        }$I->click(\ExportProductPage::$CrtProductButtonSaveandBack);
        $I->wait('3');
    }
    
    
    
    
    
    
    
    
}