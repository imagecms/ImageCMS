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
//        $I->createCategoryProductForExport($createNameCategory = 'Повервайленс');
        $I->CreateProperty($NameProperty = 'Test', $CVS = 'ProstoTest', $Category = 'Повервайленс');
        $I->wait('5');
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}

