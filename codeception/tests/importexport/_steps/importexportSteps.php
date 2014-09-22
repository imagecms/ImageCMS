<?php

namespace ImportExportTester;

class ImportExportSteps extends \ImportExportTester {
Private $data = [
    
                    'name'             => 'ТоварЕкспортCSV',
                    'url'              => 'tovarexportcsvtest',
                    'price'            => '1080.50',
                    'oldPrice'         => '500',
                    'amount'           => '500',
                    'article'          => '2043113',
                    'variantName'      => 'ТоварИмпортTestВариант',
                    'active'           => 1,
                    'hit'              => 0,
                    'hot'              => 0,
                    'action'           => 0,
                    'brand'            => 'Apple',
                    'category'         => 'КатегорияЕкспорт',
                    'relatedProducts'  => null,
                    'mainImage'        => null,
                    'currency'         => 2,
                    'additionalImage'  => null,
                    'shortDescription' => 'Краткое описание',
                    'fullDescription'  => 'Полное описание',
                    'metaTitle'        => 'tovarmetatitle',
                    'metaDescription'  => 'tovarmetadescription',
                    'metaKeywords'     => 'tovarmetakeywords'
];
    public function createCategory($name) {
        $I = $this;
        $I->amOnPage(\CategoryCreatePage::$URL);
        $I->wait('1');
        $I->fillField(\CategoryCreatePage::$FieldName, $name);
        $I->click(\CategoryCreatePage::$ButtonSave);
        $I->wait('2');
    }
    public function createProduct(
            $name,
            $price,
            $active             = null,
            $hit                = null,
            $hot                = null,
            $action             = null,
            $old_price          = null,
            $variant_name       = null,
            $currency           = null,
            $article            = null,
            $amount             = null,
            $brand              = null,
            $category           = null,
            $short_description  = null,
            $full_description   = null,
            $url                = null,
            $meta_title         = null,
            $meta_description   = null,
            $meta_keywords      = null
            ){

        $I = $this;
        $I->wait(1);
        $I->amOnPage(\ProductCreatePage::$URL);
        $I->waitForElement(\ProductCreatePage::$InputName);
        $I->fillField(\ProductCreatePage::$InputName, $name);
        $I->fillField(\ProductCreatePage::$InputPrice, $price);
//        
        if(isset($active) && $active != 1 ) { $I->click(\ProductCreatePage::$ButtonActive);                                 }
        if(isset($hit) && $hit == 1)        { $I->click(\ProductCreatePage::$ButtonHit);                                    }
        if(isset($hot) && $hot == 1)        { $I->click(\ProductCreatePage::$ButtonHot);                                    }       
        if(isset($action) && $action ==1)   { $I->click(\ProductCreatePage::$ButtonAction);                                 }
        if(isset($old_price))               { $I->fillField(\ProductCreatePage::$InputOldPrice, $old_price);                }
        if(isset($variant_name))            { $I->fillField(\ProductCreatePage::$InputVariantName, $variant_name);          }
        
        if(isset($currency)){
            switch ($currency) {
                case 1:
                    $currency = 'USD';
                    break;
                case 2:
                    $currency = 'RUR';
                    break;
                default:
                    break;
            }
            $I->selectOption(\ProductCreatePage::$SelectCurrency, $currency);             }
        if(isset($article))                 { $I->fillField(\ProductCreatePage::$InputArticle, $article);                   }
        if(isset($amount))                  { $I->fillField(\ProductCreatePage::$InputAmount, $amount);                     }
        
        if(isset($brand)){ 
            $I->executeJS("$('#inputParent').css({'display':'block'})");
            $I->selectOption('div.control-group div.controls select#inputParent', $brand);
        }
//        
        if(isset($category))                { 
            $I->executeJS("$('#comment').css({'display':'block'})");
            $I->selectOption('#comment', $category);             }
        if(isset($short_description))       { $I->fillField(\ProductCreatePage::$InputShortDescriptin, $short_description); }
        if(isset($full_description))        { $I->fillField(\ProductCreatePage::$InputFullDescriptin, $full_description);   }
//        
        if(isset($url) || isset($meta_title) || isset($meta_description) || isset($meta_keywords)){
            $I->click(\ProductCreatePage::$TabSettings);
            $I->waitForElement(\ProductCreatePage::$InputURL);
            
            if(isset($url))                 { $I->fillField(\ProductCreatePage::$InputURL, $url);                           }
            if(isset($meta_title))          { $I->fillField(\ProductCreatePage::$InputMetaTitle, $meta_title);              }
            if(isset($meta_description))    { $I->fillField(\ProductCreatePage::$InputMetaDescription, $meta_description);  }
            if(isset($meta_keywords))       { $I->fillField(\ProductCreatePage::$InputMetaKeywords, $meta_keywords);        }
        }
        $I->click(\ProductCreatePage::$ButtonCreate);
        $I->wait(3);
    }

//    function createProductForExport($name, $price, $category = NULL, $hit = NULL, $nameVariant = NULL, $article = NULL, $amount = NULL, $brand = NULL, $smallDescription = NULL, $fullDescripton = NULL, $oldPrice = NULL, $relatedProducts = NULL, $productURL = NULL, $metaTitle = NULL, $metaDescription = NULL, $metaKeywords = NULL) {
//        $I = $this;
//        $I->wait('1');
//        $I->amOnPage('/admin/components/run/shop/products/create');
//        $I->wait('1');
//        $I->fillField(\ExportProductPage::$CrtProductNameProduct, $name);
//        $I->fillField(\ExportProductPage::$CrtProductPriceProduct, $price);
//        $I->click(\ExportProductPage::$CrtProductButtonSave);
//        $I->wait('3');
//        if (isset($category)) {
//            $I->click(\ExportProductPage::$CrtProductCategoryProductSelectField);
//            $I->fillField(\ExportProductPage::$CrtProductCategoryProductSelectInput, $category);
//            $I->click(\ExportProductPage::$CrtProductCategoryProductSetSelect);
//        }if (isset($hit)) {
//            $I->click('//tbody/tr/td/div/div/div[1]/div[3]/div/button[1]');
//        }if (isset($nameVariant)) {
//            $I->fillField('//tbody/tr/td/div/div/div[1]/div[4]/table/tbody/tr/td[1]/div/input[3]', $nameVariant);
//        }if (isset($article)) {
//            $I->fillField('//table[1]/tbody/tr/td/div/div/div[1]/div[4]/table/tbody/tr/td[4]/input', $article);
//        }if (isset($amount)) {
//            $I->fillField('//table[1]/tbody/tr/td/div/div/div[1]/div[4]/table/tbody/tr/td[5]/input', $amount);
//        }if (isset($brand)) {
//            $I->click('//table[1]/tbody/tr/td/div/div/div[2]/div/div[1]/div/div/a/span');
//            $I->fillField('//table[1]/tbody/tr/td/div/div/div[2]/div/div[1]/div/div/div/div/input', $brand);
//            $I->click('//table[1]/tbody/tr/td/div/div/div[2]/div/div[1]/div/div/div/ul/li');
//        }if (isset($smallDescription)) {
//            $I->fillField('//table[1]/tbody/tr/td/div/div/div[3]/div/textarea', $smallDescription);
//        }if (isset($fullDescripton)) {
//            $I->fillField('//table[1]/tbody/tr/td/div/div/div[4]/div/textarea', $fullDescripton);
//        }if (isset($oldPrice)) {
//            $I->fillField('//table[2]/tbody/tr/td/div/div/div[3]/div/input', $oldPrice);
//        }if (isset($relatedProducts)) {
//            $I->fillField('//table[2]/tbody/tr/td/div/div/div[4]/div/input', $relatedProducts);
//            $I->wait('2');
//            $I->click('//body/ul[2]/li/a');
//        }if (isset($productURL)) {
//            $I->click('//table[3]/tbody/tr/td/div/div/div[1]/div/div/button');
//            $urla = $I->grabValueFrom('//table[3]/tbody/tr/td/div/div/div[1]/div/span/input');
//            $I->comment("Url Product = ( $urla )");
//        }if (isset($metaTitle)) {
//            $I->fillField('//tbody/tr/td/div/div/div[2]/div/textarea', $metaTitle);
//        }if (isset($metaDescription)) {
//            $I->fillField('//table[3]/tbody/tr/td/div/div/div[3]/div/textarea', $metaDescription);
//        }if (isset($metaKeywords)) {
//            $I->fillField('//table[3]/tbody/tr/td/div/div/div[4]/div/textarea', $metaKeywords);
//        }$I->click(\ExportProductPage::$CrtProductButtonSaveandBack);
//        $I->wait('3');
//    }

}

//    function CreateProperty($NameProperty = NULL, $CVS = NULL, $Category = NULL,
//                                $Values1 = NULL, $Values2 = NULL, $Values3 = NULL, $Values4 = NULL) {
//        $I = $this;
//        $I->amOnPage(\ExportPropertyPage::$PropURL);
//        $I->fillField(\ExportPropertyPage::$PropFieldName, $NameProperty);
//        $I->fillField(\ExportPropertyPage::$PropFieldCVS, $CVS);
//        $I->click(\ExportPropertyPage::$PropChekBoxMainProp);
//        $I->click(\ExportPropertyPage::$PropChekBoxTip);
//        $I->click(\ExportPropertyPage::$PropChekBoxProdPage);
//        $I->click(\ExportPropertyPage::$PropChekBoxProdSimile);
//        $I->click(\ExportPropertyPage::$PropChekBoxFilter);
//        $I->click(\ExportPropertyPage::$PropMultipleChoice);
//        $I->click(\ExportPropertyPage::$PropSelect);
//        $I->fillField(\ExportPropertyPage::$PropSelecctField, $Category);
//        $I->click(\ExportPropertyPage::$PropSelectCategory); 
//        $I->appendField(\ExportPropertyPage::$PropTextArea, $Values1);
//        $I->appendField(\ExportPropertyPage::$PropTextArea, '
//            ');
//        $I->appendField(\ExportPropertyPage::$PropTextArea, $Values2);
//        $I->appendField(\ExportPropertyPage::$PropTextArea, '
//            ');
//        $I->appendField(\ExportPropertyPage::$PropTextArea, $Values3);
//        $I->appendField(\ExportPropertyPage::$PropTextArea, '
//            ');
//        $I->appendField(\ExportPropertyPage::$PropTextArea, $Values4);
//        $I->click(\ExportPropertyPage::$PropButtSave);
//        $I->wait('1');        
//    }
    
    
//    function SelectPropertyInProduct($NameProduct = NULL,
//                                    $Property1 = NULL,
//                                    $Property2 = NULL,
//                                    $Property3 = NULL,
//                                    $Property4 = NULL) {
//        $I = $this; 
//        if(isset($NameProduct)){
//         $I->amOnPage('/admin/components/run/shop/search');   
//         $I->fillField('//section/div[2]/table/thead/tr[2]/td[3]/input', $NameProduct);
//         $I->click('//section/div[1]/div[2]/div/button[1]');
//         $I->wait('1');
//         $I->click('//section/div[2]/table/tbody/tr/td[3]/div/a');
//         $I->wait('2');
//         $I->click(\ExportProductPage::$CrtProdButtonProperty);
//         $I->wait('2');
//         $I->click('//table/tbody/tr/td/div/div/div/div/div/select/option[1]');
//         if(isset($Property1)){
//            $I->click(\ExportPropertyPage::$PropSelectOption1);
//            $I->click(\ExportPropertyPage::$PropSelectOption2);
//            $I->click(\ExportPropertyPage::$PropSelectOption3);
//            $I->click(\ExportPropertyPage::$PropSelectOption4);
//        }if(isset($Property2)){
//            $I->fillField('//form/div/div[2]/div[2]/table/tbody/tr/td/div/div/div/div[2]/div/input', '1');
//        }if(isset($Property3)){
//            $I->click('//table/tbody/tr/td/div/div/div/div[3]/div/select/option[4]');
//            $I->click('//table/tbody/tr/td/div/div/div/div[3]/div/select/option[3]');
//        }if(isset($Property4)){
//            $I->click('//table/tbody/tr/td/div/div/div/div[4]/div/select/option[2]');
//        }$I->wait('1');
//        $I->click(\ExportProductPage::$CrtProductButtonSaveandBack);
//        $I->wait('1');
//         
//        }
//        
//    }   
    
//    
//    
//    function CreateBrandForExport($nameBrand = NULL) {
//        $I = $this;
//        $I->wait('1');
//        $I->amOnPage('/admin/components/run/shop/brands/create');                                                                                    
//        $I->wait('1');
//        $I->fillField('//table/tbody/tr/td/div/div[1]/div[1]/div/input', $nameBrand);
//        $I->click('//section/div[1]/div[2]/div/button[2]');
//        $I->wait('1');
//    }