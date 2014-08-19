<?php
namespace ImportExportTester;

class importexportSteps extends \ImportExportTester
{
   
    
    function createCategoryProductForExport( $createNameCategory = NULL, $addParentCategory = NULL) {
        $I = $this;
        $I->amOnPage(\CategoryPage::$CrtCategoryPageURL);
        $I->wait('1');
        if(isset($createNameCategory)){
            $I->fillField(\CategoryPage::$CrtCategoryFieldName, $createNameCategory);
        }if(isset($addParentCategory)){ 
            $I->click(\CategoryPage::$CrtCategorySelectMenu);
            $I->fillField(\CategoryPage::$CrtCategorySelectMenuInput, $addParentCategory);
            $I->click(\CategoryPage::$CrtCategorySelectMenuSetSearch);
        }$I->click(\CategoryPage::$CrtCategoryButtonSaveandBack); 
        $I->wait('2');
    }
    
    
    
    
    
    function createProductForExport($nameProduct = NULL,
                                $priceProduct = NULL,
                                $categoryProduct = NULL,
                                $Property = NULL) {
        $I = $this;
        $I->wait('1');
        $I->click(\NavigationBarPage::$ProductsCatalogue); 
        $I->wait('1');
        $I->click(\NavigationBarPage::$ProductList);
        $I->wait('3');
        $I->waitForElement(\CreateProductsOrdersPage::$CrtProductButtonCreateProduct);
        $I->click(\CreateProductsOrdersPage::$CrtProductButtonCreateProduct);                                                                                                 
        $I->wait('3');
        if (isset($nameProduct)) {
            $I->fillField(\CreateProductsOrdersPage::$CrtProductNameProduct, $nameProduct);                                          
        }if(isset($priceProduct)){
            $I->fillField(\CreateProductsOrdersPage::$CrtProductPriceProduct, $priceProduct);                                                                            
        }if(isset($categoryProduct)){
            $I->click(\CreateProductsOrdersPage::$CrtProductCategoryProductSelectField);                                                         
            $I->fillField(\CreateProductsOrdersPage::$CrtProductCategoryProductSelectInput, $categoryProduct);                                               
            $I->click(\CreateProductsOrdersPage::$CrtProductCategoryProductSetSelect);                                         
        }
        $I->wait('1');
        $I->click(\CreateProductsOrdersPage::$CrtProductButtonSaveandBack);
        $I->wait('2');
    }
    
    
    
    
    function CreateProperty($NameProperty = NULL, $CVS = NULL, $Category = NULL, $Values = NULL) {
        $I = $this;
        $I->amOnPage('/admin/components/run/shop/properties/create');
        $I->click('.default');
        $I->selectOption('//tbody/tr/td/div/div[10]/div/select', 'Повервайленс');
//        $I->fillField('.default', 'Повервай');
//        $I->click('.active-result.highlighted');
//        $I->fillField('//tbody/tr/td/div/div[1]/div/input', $NameProperty);
//        $I->fillField('//tbody/tr/td/div/div[2]/div/input', $CVS);
//        $I->click('//tbody/tr/td/div/div[4]/div[2]/span/span');
//        $I->click('//tbody/tr/td/div/div[9]/div[2]/span/span');
//        $I->click('.default');
//        $I->wait('1');
//        $a = $I->grabTextFrom('//tbody/tr/td/div/div[10]/div/div/div/ul/li[26]');
//        $I->comment("прам пам пам, $a");
//        $I->moveMouseOver('//tbody/tr/td/div/div[10]/div/div/div/ul/li[1]');
//        $I->scrollToElement($I, '//tbody/tr/td/div/div[10]/div/div/div/ul/li[26]');
//        $I->click($Category);
//        $I->selectOption('.active-result', '26');
//        $I->appendField('//tbody/tr/td/div/div[10]/div/div/ul', $Category);
//        $I->wait('1');
//        $I->click('//tbody/tr/td/div/div[10]/div/div/ul/li/input');
//        $I->fillField('//tbody/tr/td/div/div[10]/div/div/ul', $Category);
    }
    
    
    
    
    
    
    
}