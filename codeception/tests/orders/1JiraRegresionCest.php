<?php

use \OrdersTester;

class JiraRegresionCest {

//---------------------------AUTORIZATION--------------------------------------- 
    /**
     * @group aa
     */
    public function Login(OrdersTester $I) {
        InitTest::Login($I);
    }

    /**
     * @group a
     * @guy OrdersTester\OrdersSteps
     */
    public function ICMS1370ProductKits(OrdersTester\OrdersSteps $I) {
        $I->createCategoryProduct($createNameCategory = 'НАБОРЫ');
        $I->createProduct($nameProduct = 'Основа', $nameVariantProduct = '', $priceProduct = 10, $articleProduct = '', $amountProduct = 1, $categoryProduct = 'НАБОРЫ');
        $I->createProduct($nameProduct = 'Карлота', $nameVariantProduct = '', $priceProduct = 10, $articleProduct = '', $amountProduct = 1, $categoryProduct = 'НАБОРЫ');
        $I->SelectAmountOutStock($amountOutStockNo = NULL, $amountOutStockYes = 'YES');
        $I->CreateProductKits($MainProductKits = 'Основа', $AddProductKits = 'Карлота');
        $I->wait('2');
        $I->amOnPage('/shop/product/osnova');
        $I->wait('4');
        $buy_element = 'form div:nth-child(2) .btnBuy.infoBut.btnBuyKit';
        $in_basket_element = 'form div:nth-child(1) .btnBuy.infoBut.btnBuyKit';
        try {
            $I->scrollToElement($I, $buy_element);
            $I->wait('2');
            $I->click($buy_element); 
            $I->comment('I click buy button');
        } catch (Exception $exc) {
            $I->scrollToElement($I, $in_basket_element);
            $I->wait('2');
            $I->click($in_basket_element);
            $I->comment('I click basket button');
        }
        $I->wait('6');
        $I->fillField('//body/div[8]/div/div/div[2]/div/div/div/table/tbody/tr/td[3]/div/input', '2');
        $I->wait('7');
        $I->click('//body/div[8]/div/div/div[3]/div[2]/div/div[2]/a');
        $I->wait('5');
        $I->see('1', '//form/div[1]/div/div[2]/table/tbody/tr/td[2]/div/div/span[2]');
    }
    
    
    /**
     * @group a
     * @guy OrdersTester\OrdersSteps
     */
    public function ICMS1518ProductBasket(OrdersTester\OrdersSteps $I) {
        $I->createCategoryProduct($createNameCategory = 'Для Корзини админка');
        $I->createProduct($nameProduct = 'Add in Basket', $nameVariantProduct = NULL, $priceProduct = 33, $articleProduct = NULL, $amountProduct = 0, $categoryProduct = 'Для Корзини админка');
        $I->SelectAmountOutStock($amountOutStockNo = NULL, $amountOutStockYes = 'YES');
        $I->SearchNameProductaAutocomplete($typeName = 'Add in Basket');
        
        
    }

    
    
    
    
    /**
     * @group aa
     * @guy OrdersTester\OrdersSteps
     */
    public function ICMS1468DeleteOrderStatuses(OrdersTester\OrdersSteps $I) {
//        $I->amOnPage('/admin/components/run/shop/orderstatuses/create');
//        $I->fillField('//div[2]/table/tbody/tr/td/div/form/div[1]/div/input', 'Видаляем');
//        $I->click('//section/div[1]/div[2]/div/button[1]');
//        $I->amOnPage(CreateOrderAdminPage::$CrtPURL);
//        $I->wait('1');
//        $I->click(CreateOrderAdminPage::$CrtPButtUser);
//        $I->wait('1');
//        $I->fillField('//tbody/tr/td/div/div[2]/div[2]/div/div/div/input', '1');
//        $I->wait('3');
//        $I->click('//body/ul[3]/li/a');
//        $I->click('//div[1]/div[5]/div/section/div[2]/div/a[3]');
//        $I->click(CreateOrderAdminPage::$CrtOButtUpdate);
//        $I->wait('1');
//        $I->click(CreateOrderAdminPage::$CrtPButtCreateAndGoBack);
//        $I->wait('3');
        $I->click();
        
    
    
    }
    
    
    
    
    
    
    
    
    
    
    
    
}
