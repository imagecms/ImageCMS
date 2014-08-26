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
        $I->createCategoryProductForExport($createNameCategory = 'Повервайленс', $addParentCategory = NULL);
        $I->CreateProperty($NameProperty = 'Gfv PAMBAM', $CVS = 'pppoooiiiuuuyyy', $Category = 'Повервайленс', $Values1 = '!@#$%^&*()_+|/*-', $Values2 = 'qweafIUHGHBKJOIvbcxcv', $Values3 = 'ЙЦУЕКНШЩГШЩХЪХЖДЛОпавфываячсмбю', $Values4 = '0123456789');
        $I->createProductForExport($nameProduct = 'Product for Export', $priceProduct = 777, $categoryProduct = 'Повервайленс');
        $I->SelectPropertyInProduct($NameProduct = 'Product for Export', $Property1 = '6', $Property2 = 'Yoes', $Property3 = '1', $Property4 = 'Yes');
        $I->wait('1');
    }

    
    
}

