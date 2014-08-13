<?php
use \OrdersTester;
class ElementOCACest
{
 //---------------------------AUTORIZATION--------------------------------------- 
     
    
    /**
     * @group aa
     */
    public function Login(OrdersTester $I){
        InitTest::Login($I);
    }    
    
    /**
     * @group a
     */
    public function VerifyCategoryPresenceInSelectMenu (OrdersTester $I){
        $I->wantTo('Compare the identity of the names and фьщгте of categories  in the SELECT menu, pages "Create Product" and "Create Order".');
       $I->wantTo('');
       $AllOptions =[]; 
       $I->amOnPage('/admin/components/run/shop/products/create');
       $AllProductOptions = $I->grabTagCount($I, 'select option', 2);
       $MakeVisible1 = "$('select:eq(2)').css({'display':'block'})";
       $I->executeJS($MakeVisible1);
       for($row = 1; $row <= $AllProductOptions; ++$row){
           $AllOptions[$row] = $I->grabTextFrom("//div[@class = 'control-group'][2]//div//select/option[$row]");
       }
       
       
       $I->amOnPage('/admin/components/run/shop/orders/create');
       $OrderCategoriesLength = $I->grabTagCount($I, 'select option');
       
       $MakeVisible2 = "$('select:eq(0)').css({'display':'block'})";
       $I->executeJS($MakeVisible2);
       
       for($row = 1; $row <= $OrderCategoriesLength; ++$row){
           $AllOrderOptions[$row] = $I->grabTextFrom("//select[1]/option[$row]");
       }
       foreach ($AllOptions as $key => $AllOptionNow) {
           $I->assertEquals(str_replace([' ','-'],'',$AllOptionNow), str_replace([' ','-'],'',$AllOrderOptions[$key]));
       }
    }
    




//---------------------Verify Field Amount--------------------------------------
       
    
     /**
     * @group aa
     * @guy OrdersTester\OrdersSteps
     */
    public function VerifyFieldAmountInputInvalidValues1 (OrdersTester\OrdersSteps $I) {
        $I->wantTo('Check the output prices added to basket Product.');
        $I->createProduct($nameProduct = 'Prd44 FzOR Amount input.', $nameVariantProduct = NULL, $priceProduct = 1);
        $I->click(NavigationBarPage::$Orders);
        $I->click(NavigationBarPage::$OrdersList);
        $I->wait('2');
        $I->click(OrdersListPage::$ListButtCreateOrder);
        $I->wait('2');
        $I->fillField('#productNameForOrders', 'Prd44 FzOR Amount input.');
        $I->wait('1');
        $I->click('//body/ul[2]/li[1]/a');
        $I->wait('1');
        $I->click(CreateOrderAdminPage::$CrtPButtAddToCart);
        $I->fillField(CreateOrderAdminPage::$CrtPFieldAmount, '1.1.');
        $I->SeeInField(CreateOrderAdminPage::$CrtPFieldAmount, '1.1.');
        $I->see('NaN', CreateOrderAdminPage::$CrtPFieldCommon);
        $I->see('NaN', CreateOrderAdminPage::$CrtPFieldTotalPrice);      
    }
    
    /**
     * @group a
     * @guy OrdersTester\OrdersSteps
     */
    public function VerifyFieldAmountInputInvalidValues2 (OrdersTester\OrdersSteps $I) {
        $I->wantTo('Check the output prices added to basket Product.');
        $I->click(NavigationBarPage::$Orders);
        $I->click(NavigationBarPage::$OrdersList);
        $I->wait('2');
        $I->click(OrdersListPage::$ListButtCreateOrder);
        $I->wait('2');
        $I->fillField('#productNameForOrders', 'Prd44 FzOR Amount input.');
        $I->wait('1');
        $I->click('//body/ul[2]/li[1]/a');
        $I->wait('1');
        $I->click(CreateOrderAdminPage::$CrtPButtAddToCart);
        $I->fillField(CreateOrderAdminPage::$CrtPFieldAmount, '..');
        $I->SeeInField(CreateOrderAdminPage::$CrtPFieldAmount, '..');
        $I->see('NaN', CreateOrderAdminPage::$CrtPFieldCommon);
        $I->see('NaN', CreateOrderAdminPage::$CrtPFieldTotalPrice);      
    }
    
    /**
     * @group a
     * @guy OrdersTester\OrdersSteps
     */
    public function VerifyFieldAmountInputInvalidValues3 (OrdersTester\OrdersSteps $I) {
        $I->wantTo('Check the output prices added to basket Product.');
        $I->click(NavigationBarPage::$Orders);
        $I->click(NavigationBarPage::$OrdersList);
        $I->wait('2');
        $I->click(OrdersListPage::$ListButtCreateOrder);
        $I->wait('2');
        $I->fillField('#productNameForOrders', 'Prd44 FzOR Amount input.');
        $I->wait('1');
        $I->click('//body/ul[2]/li[1]/a');
        $I->wait('1');
        $I->click(CreateOrderAdminPage::$CrtPButtAddToCart);
        $I->fillField(CreateOrderAdminPage::$CrtPFieldAmount, '.1.1');
        $I->SeeInField(CreateOrderAdminPage::$CrtPFieldAmount, '.1.1');
        $I->see('NaN', CreateOrderAdminPage::$CrtPFieldCommon);
        $I->see('NaN', CreateOrderAdminPage::$CrtPFieldTotalPrice);      
    }
    
    /**
     * @group a
     * @guy OrdersTester\OrdersSteps
     */
    public function VerifyFieldAmountInputInvalidValues4 (OrdersTester\OrdersSteps $I) {
        $I->wantTo('Check the output prices added to basket Product.');
        $I->click(NavigationBarPage::$Orders);
        $I->click(NavigationBarPage::$OrdersList);
        $I->wait('2');
        $I->click(OrdersListPage::$ListButtCreateOrder);
        $I->wait('2');
        $I->fillField('#productNameForOrders', 'Prd44 FzOR Amount input.');
        $I->wait('1');
        $I->click('//body/ul[2]/li[1]/a');
        $I->wait('1');
        $I->click(CreateOrderAdminPage::$CrtPButtAddToCart);
        $I->fillField(CreateOrderAdminPage::$CrtPFieldAmount, '123654..1');
        $I->SeeInField(CreateOrderAdminPage::$CrtPFieldAmount, '123654..1');
        $I->see('NaN', CreateOrderAdminPage::$CrtPFieldCommon);
        $I->see('NaN', CreateOrderAdminPage::$CrtPFieldTotalPrice);      
    }
    
    /**
     * @group a
     * @guy OrdersTester\OrdersSteps
     */
    public function VerifyFieldAmountInputInvalidValues5 (OrdersTester\OrdersSteps $I) {
        $I->wantTo('Check the output prices added to basket Product.');
        $I->click(NavigationBarPage::$Orders);
        $I->click(NavigationBarPage::$OrdersList);
        $I->wait('2');
        $I->click(OrdersListPage::$ListButtCreateOrder);
        $I->wait('2');
        $I->fillField('#productNameForOrders', 'Prd44 FzOR Amount input.');
        $I->wait('1');
        $I->click('//body/ul[2]/li[1]/a');
        $I->wait('1');
        $I->click(CreateOrderAdminPage::$CrtPButtAddToCart);
        $I->fillField(CreateOrderAdminPage::$CrtPFieldAmount, '1.123.');
        $I->SeeInField(CreateOrderAdminPage::$CrtPFieldAmount, '1.123.');
        $I->see('NaN', CreateOrderAdminPage::$CrtPFieldCommon);
        $I->see('NaN', CreateOrderAdminPage::$CrtPFieldTotalPrice);      
    }
    
    
    
    
    
    
    
    /**
     * @group aa
     * @guy OrdersTester\OrdersSteps
     */
    public function VerifyTotalPriceAddInFieldAmount(OrdersTester\OrdersSteps $I){
        $I->wantTo('Check the map editing the amount of added an item to cart and the correct calculation of the amount of order.');
        $I->createProduct($nameProduct = 'Prd0 for1 Цыкл2 подсчета3 и4 отображения5 Edit6', $nameVariantProduct = NULL, $priceProduct = 1);
        $I->click(\NavigationBarPage::$Orders);
        $I->click(\NavigationBarPage::$OrdersList);
        $I->wait('1');
        $I->click(\OrdersListPage::$ListButtCreateOrder);
        $I->wait('1');
        $I->fillField('#productNameForOrders', 'Prd0 for1 Цыкл2 подсчета3 и4 отображения5 Edit6');
        $I->wait('1');
        $I->click('//body/ul[2]/li[1]/a');
        $I->wait('1');
        $I->click(CreateOrderAdminPage::$CrtPButtAddToCart);
        for($j = 1;$j <  2147483647;$j = $j + 88998899){
            $I->click(CreateOrderAdminPage::$CrtPButtProduct);
            $I->wait('1');
            $a = $I->grabValueFrom(CreateOrderAdminPage::$CrtPFieldAmount);
            $I->comment("Amount Product In Basket($a)");
            $I->fillField(CreateOrderAdminPage::$CrtPFieldAmount, "$j");
            $I->wait('1');
            $I->see( "$j", CreateOrderAdminPage::$CrtPFieldTotalPrice);
            $I->see("$j", CreateOrderAdminPage::$CrtPFieldCommon);
            $I->click(CreateOrderAdminPage::$CrtPButtOrder);
            $I->click(CreateOrderAdminPage::$CrtOButtUpdate);
            $I->seeInField(CreateOrderAdminPage::$CrtOFieldTotalPrice, "$j");
        }       
    }





////////////////////////////////////////////////////////////////////////////////
//                                                                            //
//------------------------PROTECTED________FUNCTIONS----------------------------
    
    
    
    
    protected function SearchNameProduct (OrdersTester $I, $typeName = NULL){        
        $I->amOnPage(CreateOrderAdminPage::$CrtPURL);
        if(isset($typeName)){            
            $I->click(CreateOrderAdminPage::$CrtPButtProduct);    
            $I->fillField('#productNameForOrders', $typeName);
            $I->wait('1');
            $I->see($typeName,'//body/ul[2]/li[1]/a');
            $I->click('//body/ul[2]/li[1]/a');
            $I->wait('1');
            $I->see("Товар: $typeName", '//tbody/tr[1]/td[2]/div/div[2]/span[1]/b'); 
            $I->click(CreateOrderAdminPage::$CrtPButtAddToCart);
            $I->see('В корзине', CreateOrderAdminPage::$CrtPButtInBasket);
            $I->see($typeName, '//tbody/tr[2]/td[2]/select');
            $I->see($typeName, '//table[2]/tbody/tr/td[1]/span');            
        }        
    }   
    
    
    
    protected function SearchPriceProduct(OrdersTester $I, $typeName = NULL, $typePrice = NULL) {        
        $I->amOnPage(CreateOrderAdminPage::$CrtPURL);        
        if(isset($typeName)){            
            $I->click(CreateOrderAdminPage::$CrtPButtProduct);    
            $I->fillField('#productNameForOrders', $typeName);
            $I->wait('1');
            $I->see($typeName,'//body/ul[2]/li[1]/a');
            $I->click('//body/ul[2]/li[1]/a');
            $I->wait('1');
            $I->see("Товар: $typeName", '//tbody/tr[1]/td[2]/div/div[2]/span[1]/b'); 
            $I->click(CreateOrderAdminPage::$CrtPButtAddToCart);
            $I->see('В корзине', CreateOrderAdminPage::$CrtPButtInBasket);
            $I->see($typeName, '//tbody/tr[2]/td[2]/select');
            $I->see($typeName, '//table[2]/tbody/tr/td[1]/span');            
        }if(isset($typePrice)){            
            $I->click(CreateOrderAdminPage::$CrtPButtProduct);
            $I->see($typePrice, '//tbody/tr[1]/td[2]/div/div[2]/span[1]');
            $I->see($typePrice, '//tbody/tr[2]/td[3]/select/option');
            $I->see($typePrice, '//table[2]/tbody/tr/td[3]/span/span[1]');
            $I->see($typePrice, '//table[2]/tbody/tr/td[5]/span[1]');
            $I->see($typePrice, '//table[2]/tfoot/tr/td[3]/span');
            $I->click(CreateOrderAdminPage::$CrtPButtOrder);
            $I->click(CreateOrderAdminPage::$CrtOButtUpdate);
            $I->wait('1');
            $I->seeInField('//table/tbody/tr/td/div/div/div[1]/div[1]/input', $typePrice);            
        }
    }
    
    
    
    protected function SearchArticleProduct (OrdersTester $I, $articleProduct = NULL) {        
        $I->amOnPage(CreateOrderAdminPage::$CrtPURL);
        if(isset($articleProduct)){            
           $I->click(CreateOrderAdminPage::$CrtPButtProduct);
           $I->fillField('#productNameForOrders', $articleProduct);
           $I->wait('1');
           $I->see($articleProduct, '//body/ul[2]/li[1]/a');           
        }
    }
    
    
    
    protected function SearchAmountProduct (OrdersTester $I, $typeName = NULL, $amountProduct = NULL) {        
        if(isset($typeName)){            
            $I->amOnPage(CreateOrderAdminPage::$CrtPURL); 
            $I->fillField('#productNameForOrders', $typeName);
            $I->wait('1');
            $I->see($typeName,'//body/ul[2]/li[1]/a');
            $I->click('//body/ul[2]/li[1]/a');
            $I->wait('1');
            $I->see("Товар: $typeName", '//tbody/tr[1]/td[2]/div/div[2]/span[1]/b'); 
            $I->click(CreateOrderAdminPage::$CrtPButtAddToCart);
            $I->see('В корзине', CreateOrderAdminPage::$CrtPButtInBasket);
            $I->see($typeName, '//tbody/tr[2]/td[2]/select');
            $I->see($typeName, '//table[2]/tbody/tr/td[1]/span');            
        }if(isset($amountProduct)){
            $I->click(CreateOrderAdminPage::$CrtPButtProduct); 
            $I->see("Остаток: $amountProduct", '#productStock');
            $I->seeInField('//table[2]/tbody/tr/td[4]/div/input', '1');
        }
    }




//    /**
//     * @group a
//     */
//    public function QwQEqwQEewqqQQ (OrdersTester $I){
//        $I->amOnPage('/admin/components/run/shop/search/index');
//        $I->click('//section/div[2]/table/thead/tr[2]/td[4]/div/a');
//        $I->fillField('//table/thead/tr[2]/td[4]/div/div/div/input', 'Основ');
//        $I->click('//table/thead/tr[2]/td[4]/div/div/ul/li');
//        $I->wait('3');
//        $rows = $I->grabTagCount($I, 'tbody tr');
//        $amountRows = $I->comment(" Количество строк в категории = $rows");
//        $allNames = [];
//        for($j = 1;$j <= $rows;$j++){
//            $allNames[$j] = $I->grabTextFrom("//section/div[2]/table/tbody/tr[$j]/td[3]/div/a");//"//div[@class = 'control-group'][2]//div//select/option[$row]"
//            $I->comment($allNames[$j]);  
//            
//        }$I->comment("$allNames[$j]");
            
        
//        $a = $I->grabTextFrom('.pjax.title');
//        $b = $I->comment("$a");
//        $I->wait('9');
//    }
 

}
