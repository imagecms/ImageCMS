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
    public function CreationOfTestDataExport (ImportExportTester\importexportSteps $I) {
        $I->TextAreaActive($on = 'on');
        $I->createCategoryProductForExport($createNameCategory = 'ПоВеРвАйЛеНс');
        $I->CreateRelatedProduct($namePRD = 'ДддОооПпп777', $PricePRD = 1);
        $I->CreateBrandForExport($nameBrand = 'СссУууПппЕееРрр444');
        $I->CreateProperty($NameProperty = 'PppRrrOooPppEeeRrrTttYyy1', $CVS = 'ololo', $Category = 'ПоВеРвАйЛеНс', $Values1 = '0123456789', $Values2 = 'q', $Values3 = 'zxc 123 ZVC', $Values4 = 'Дюйм Мертовый');
        $I->CreateProperty($NameProperty = 'ZuLusss2', $CVS = 'grabText', $Category = 'ПоВеРвАйЛеНс', $Values1 = '', $Values2 = '', $Values3 = '', $Values4 = '');
        $I->CreateProperty($NameProperty = 'Terpincode', $CVS = 'xxxxxyyyyyxxxxx', $Category = 'ПоВеРвАйЛеНс', $Values1 = '1', $Values2 = 'q', $Values3 = '_', $Values4 = '');
        $I->CreateProperty($NameProperty = 'Длина звука в абстрагированном помещении', $CVS = 'sounds', $Category = 'ПоВеРвАйЛеНс', $Values1 = '1 параметр', $Values2 = '2 дикий шок', $Values3 = '3 завороткишок', $Values4 = '');
        $I->createProductForExport($nameProduct = 'Export Import Item', $priceProduct = 987, $categoryProduct = 'ПоВеРвАйЛеНс', $hit = 'on', $nameVariant = 'Vvva Rrr Iii Aaa Nnn TTt', $article = 'q2 w3 e4 r5 t6 y7', $amount = 69, $brand = 'СссУууПппЕееРрр444', $smallDescription = InitTest::$text250, $fullDescripton = InitTest::$textSymbols, $oldPrice = '111', $relatedProducts = 'ДддОооПпп777', $productURL = 'on', $metaTitle = 'Експортированный товар FOR testing', $metaDescription = 'Nouboody fun in solo ritchen Бютифул лайф И ВСЕ ДЕЛА плюс ненавижу Придурков Долбаних', $metaKeywords = 'export, import, слова, какребол, онли файтимс');
        $I->SelectPropertyInProduct($NameProduct = 'Export Import Item', $Property1 = 'on', $Property2 = 'on', $Property3 = 'on', $Property4 = 'on');
        $I->wait('1');
    }
    
    /**
     * @group a
     * @guy ImportExportTester\importexportSteps
     */
    public function ExportProduct ($param) {
        
    }
    
    
    
    
    
    
    
    
    
    
    

//        $file_content = file('C:/CVS/products.csv');
//        foreach ($file_content as $line){
//            strstr($line, 'Твр 123 for click butn');
//        }
//        unlink('C:/CVS/products.csv');
    
    
    
    

}

