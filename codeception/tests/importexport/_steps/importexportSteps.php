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

        if(isset($category))                { 
            $I->executeJS("$('#comment').css({'display':'block'})");
            $I->selectOption('#comment', $category);             }
        if(isset($short_description))       { $I->fillField(\ProductCreatePage::$InputShortDescriptin, $short_description); }
        if(isset($full_description))        { $I->fillField(\ProductCreatePage::$InputFullDescriptin, $full_description);   }

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
}