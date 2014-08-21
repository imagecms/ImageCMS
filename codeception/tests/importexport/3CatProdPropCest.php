<?php

use \ImportExportTester;

class CatProdPropCest


{
    
//---------------------------AUTORIZATION--------------------------------------- 
    /**
     * @group a
     */
    public function Login(ImportExportTester $I){
        InitTest::Login($I);
    }

    
    
    /**
     * @group a
     * @guy ImportExportTester\importexportSteps
     */
    public function CreateProperty(ImportExportTester\importexportSteps $I) {
        $I->TextAreaActive($on = 'on');
        $I->createCategoryProductForExport($createNameCategory = 'ПоВеРвАйЛеНс');
        $I->CreateRelatedProduct($namePRD = 'ДддОооПпп777', $PricePRD = 1);
        $I->CreateBrandForExport($nameBrand = 'СссУууПппЕееРрр444');
        $I->CreateProperty($NameProperty = 'PppRrrOooPppEeeRrrTttYyy1', $CVS = 'ololo', $Category = 'ПоВеРвАйЛеНс', $Values1 = '0123456789', $Values2 = 'q', $Values3 = 'zxc 123 ZVC', $Values4 = 'Дюйм Мертовый');
        $I->createProductForExport($nameProduct = 'Export Import Item', $priceProduct = 987, $categoryProduct = 'ПоВеРвАйЛеНс', $hit = 'on', $nameVariant = 'Vvva Rrr Iii Aaa Nnn TTt', $article = 'q2 w3 e4 r5 t6 y7', $amount = 69, $brand = 'СссУууПппЕееРрр444', $smallDescription = InitTest::$text250, $fullDescripton = InitTest::$textSymbols, $oldPrice = '111', $relatedProducts = 'ДддОооПпп777', $productURL = 'on', $metaTitle = 'Експортированный товар FOR testing', $metaDescription = 'Nouboody fun in solo ritchen Бютифул лайф И ВСЕ ДЕЛА плюс ненавижу Придурков Долбаних', $metaKeywords = 'export, import, слова, какребол, онли файтимс');
        $I->SelectPropertyInProduct($NameProduct = 'Export Import Item', $Property1 = 'on', $Property2 = 'on', $Property3 = 'on', $Property4 = 'on');
        $I->wait('1');
    }

//        $file_content = file('C:/CVS/products.csv');
//        foreach ($file_content as $line){
//            strstr($line, 'Твр 123 for click butn');
//        }
//        unlink('C:/CVS/products.csv');
    
    
    
    
    
//        $I->wantTo('Create Category, Property, Product and Verify Creating in Export Page.');
//        $I->createCategoryProductForExport($createNameCategory = 'Повервайленс', $addParentCategory = NULL);
//        $I->CreateProperty($NameProperty = 'Gfv PAMBAM', $CVS = 'pppoooiiiuuuyyy', $Category = 'Повервайленс', $Values1 = '!@#$%^&*()_+|/*-', $Values2 = 'qweafIUHGHBKJOIvbcxcv', $Values3 = 'ЙЦУЕКНШЩГШЩХЪХЖДЛОпавфываячсмбю', $Values4 = '0123456789');
//        $I->createProductForExport($nameProduct = 'Product for Export', $priceProduct = 777, $categoryProduct = 'Повервайленс');
//        $I->SelectPropertyInProduct($NameProduct = 'Product for Export', $Property1 = '6', $Property2 = 'Yoes', $Property3 = '1', $Property4 = 'Yes');
    
}

