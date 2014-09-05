<?php

use \OrdersTester;
class JiraRegresionCest

{
    
//---------------------------AUTORIZATION--------------------------------------- 
    /**
     * @group a
     */
    public function Login(OrdersTester $I){
        InitTest::Login($I);
    }

    
    
    /**
     * @group a
     * @guy OrdersTester\OrdersSteps
     */
    public function ICMS1370ProductKits (OrdersTester\OrdersSteps $I) {
//        $I->createCategoryProduct($createNameCategory = 'НАБОРЫ');
//        $I->createProduct($nameProduct = 'Основа', $nameVariantProduct = '', $priceProduct = 10, $articleProduct = '', $amountProduct = 1, $categoryProduct = 'НАБОРЫ');
//        $I->createProduct($nameProduct = 'Карлота', $nameVariantProduct = '', $priceProduct = 10, $articleProduct = '', $amountProduct = 1, $categoryProduct = 'НАБОРЫ');
//        $I->SelectAmountOutStock($amountOutStockNo = NULL, $amountOutStockYes = 'YES');
//        $I->CreateProductKits($MainProductKits = 'Основа', $AddProductKits = 'Карлота');
        $I->wait('2');
        $I->amOnPage('/shop/product/osnova');
        $I->wait('7');
        $I->scrollToElement($I, '//section/div[2]/div/div[1]/div/div/ul/li/a');
        $I->wait('2');
        $I->click('//div[1]/div/ul/li/div/div[2]/form/div[2]/button');//.btnBuy.infoBut.btnBuyKit
        $I->wait('2');
        $I->fillField('//body/div[8]/div/div/div[2]/div/div/div/table/tbody/tr/td[3]/div/input', '100');
        $I->wait('5');
        $I->click('//body/div[8]/div/div/div[3]/div[2]/div/div[2]/a');
        $I->wait('3');
        $I->see('1', '//form/div[1]/div/div[2]/table/tbody/tr/td[2]/div/div/span[2]');
        
        
    }
    
    
    
    
    
    
    
}