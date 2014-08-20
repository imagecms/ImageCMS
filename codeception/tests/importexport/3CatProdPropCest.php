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
//        $I->createCategoryProductForExport($createNameCategory = 'Повервайленс', $addParentCategory = NULL);
//        $I->CreateProperty($NameProperty = 'Test', $CVS = 'ProstoTest', $Category = 'Повервайленс', $Values1 = 1, $Values2 = 0.888, $Values3 = 74556312);
        $I->CreateProperty($NameProperty = 'TestTestTest', $CVS = 'ProstoTestProstoTest', $Category = 'Повервайленс', $Values1 = '1                                                                                                                                                    2                                                                                                                                                    3');
//        $I->createProductForExport($nameProduct = 'Product for Export', $priceProduct = 777, $categoryProduct = 'Повервайленс', $Property = '1');
        $I->wait('1');
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}

