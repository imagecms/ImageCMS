<?php

namespace OrdersTester;


//    /**
//     * @group a
//     * @guy OrdersTester\OrdersSteps
//     */
//    public function Blabla(OrdersTester\OrdersSteps $I) {
//        $I->createOrderAdmin
//    }

class OrdersSteps extends \OrdersTester {

//    function createOrderAdmin($product,$user = null, $delivery = null, $payment  = null) {
//        $I = $this;
//    }
    
    
    
    
    
//-------------------------Create Category--------------------------------------    
    

    function createCategoryProduct( $createNameCategory = NULL, $addParentCategory = NULL) {
        $I = $this;
        $I->amOnPage(\CreateCategoryOrdersPage::$CrtCategoryPageURL);
        if(isset($createNameCategory)){
            $I->fillField(\CreateCategoryOrdersPage::$CrtCategoryFieldName, $createNameCategory);
        }if(isset($addParentCategory)){ 
            $I->click(\CreateCategoryOrdersPage::$CrtCategorySelectMenu);
            $I->fillField(\CreateCategoryOrdersPage::$CrtCategorySelectMenuInput, $addParentCategory);
            $I->click(\CreateCategoryOrdersPage::$CrtCategorySelectMenuSetSearch);
        }$I->click(\CreateCategoryOrdersPage::$CrtCategoryButtonSaveandBack); 
    }
    
    
    
    
    
    
    
//-------------------------Create Product---------------------------------------   
    

    function createProduct( $nameProduct = NULL,
                            $priceProduct = NULL,
                            $articleProduct = NULL,
                            $amountProduct = NULL,
                            $categoryProduct = NULL,
                            $variantProduct = NULL,
                            $variantPrice = NULL,
                            $variantArticle = NULL,
                            $variantAmount = NULL) {
        $I = $this;
        $I->amOnPage(\CreateProductsOrdersPage::$CrtProductPageURL);                                                                                                     
        if (isset($nameProduct)) {
            $I->fillField(\CreateProductsOrdersPage::$CrtProductNameProduct, $nameProduct);                                          
        }if(isset($priceProduct)){
            $I->fillField(\CreateProductsOrdersPage::$CrtProductPriceProduct, $priceProduct);                                                                            
        }if(isset($articleProduct)){
            $I->fillField(\CreateProductsOrdersPage::$CrtProductArticleProduct, $articleProduct);                           
        }if(isset($amountProduct)){
            $I->fillField(\CreateProductsOrdersPage::$CrtProductAmountProduct, $amountProduct);                            
        }if(isset($categoryProduct)){
            $I->click(\CreateProductsOrdersPage::$CrtProductCategoryProductSelectField);                                                         
            $I->fillField(\CreateProductsOrdersPage::$CrtProductCategoryProductSelectInput, $categoryProduct);                                               
            $I->click(\CreateProductsOrdersPage::$CrtProductCategoryProductSetSelect);                                         
        }if(isset($variantProduct)){                                                        
            $a = $I->grabTagCount($I, 'td select');
            $b = $I->comment("$a");
                if($a == 4){
                    $I->click(\CreateProductsOrdersPage::$CrtProductVariantButtonADD);                                                      
                    $I->fillField(\CreateProductsOrdersPage::$CrtProductVariantFieldName, $variantProduct);                                                        
                }elseif($a > 4){
                    $I->fillField(\CreateProductsOrdersPage::$CrtProductVariantFieldName, $variantProduct);                
                }
        }if(isset($variantPrice)){
            $a = $I->grabTagCount($I, 'td select');
            $b = $I->comment("$a");
                if($a == 4){
                  $I->click(\CreateProductsOrdersPage::$CrtProductVariantButtonADD);
                  $I->fillField(\CreateProductsOrdersPage::$CrtProductVariantFieldPrice, $variantPrice);                                         
                }elseif ($a > 4) {
                  $I->fillField(\CreateProductsOrdersPage::$CrtProductVariantFieldPrice, $variantPrice);                                               
                }
        }if(isset($variantArticle)){
            $a = $I->grabTagCount($I, 'td select');
            $b = $I->comment("$a");
                if($a == 4){
                   $I->click(\CreateProductsOrdersPage::$CrtProductVariantButtonADD);
                   $I->fillField(\CreateProductsOrdersPage::$CrtProductVariantFieldArticle, $variantArticle); 
                }elseif ($a > 4) {
                   $I->fillField(\CreateProductsOrdersPage::$CrtProductVariantFieldArticle, $variantArticle);
                }
        }if(isset($variantAmount)){
            $a = $I->grabTagCount($I, 'td select');
            $b = $I->comment("$a");
                if($a == 4){
                  $I->click(\CreateProductsOrdersPage::$CrtProductVariantButtonADD);
                  $I->fillField(\CreateProductsOrdersPage::$CrtProductVariantFieldAmount, $variantAmount);                       
                }elseif ($a > 4) {
                  $I->fillField(\CreateProductsOrdersPage::$CrtProductVariantFieldAmount, $variantAmount); 
                }
        }
        $I->wait('1');
        $I->click(\CreateProductsOrdersPage::$CrtProductButtonSaveandBack);
    }
    
    
    
    
    
    
    
    
    
//----------------------------Create User---------------------------------------       
    

    function createUser($createUserName = NULL,
                        $createUserEmail = NULL,
                        $createUserPassword = NULL,
                        $createUserPhone = NULL, 
                        $createUserAddress = NULL) {
        $I = $this;
        $I->amOnPage(\CreateUserForOrdersPage::$CrtUserPageUrl);
        if(isset($createUserName)){
            $I->fillField(\CreateUserForOrdersPage::$CrtUserFieldName, $createUserName);
        }if(isset($createUserEmail)){
            $I->fillField(\CreateUserForOrdersPage::$CrtUserFieldEmail, $createUserEmail);
        }if(isset($createUserPassword)){
            $I->fillField(\CreateUserForOrdersPage::$CrtUserFieldPassword, $createUserPassword);
        }if(isset($createUserPhone)){
            $I->fillField(\CreateUserForOrdersPage::$CrtUserFieldPhone, $createUserPhone);
        }if(isset($createUserAddress)){
            $I->fillField(\CreateUserForOrdersPage::$CrtUserFieldAddress, $createUserAddress);    
        }
        $I->click(\CreateUserForOrdersPage::$CrtUserButtonSaveAndBack);
    }

    function createDelivery() {
        $I = $this;
    }

    function createPayment() {
        $I = $this;
    }

    function createDiscount() {
        $I = $this;
    }

    function createCurrency($createCurrName = NULL,
                            $createCurrCode = NULL,
                            $createCurrSymbol = NULL,
                            $createCurrCourse = NULL){
        $I = $this;
        $I->amOnPage(\CreateCurrencyOrderPage::$CrtCurrPageURL);
        $I->wait('1');
        if(isset($createCurrName)){
          $I->fillField(\CreateCurrencyOrderPage::$CrtCurrFieldName, $createCurrName);  
        }if(isset($createCurrCode)){
            $I->fillField(\CreateCurrencyOrderPage::$CrtCurrFieldCode, $createCurrCode); 
        }if(isset($createCurrSymbol)){
            $I->fillField(\CreateCurrencyOrderPage::$CrtCurrFieldSymbol, $createCurrSymbol); 
        }if(isset($createCurrCourse)){
            $I->fillField(\CreateCurrencyOrderPage::$CrtCurrFieldCourse, $createCurrCourse); 
        }
        $I->click(\CreateCurrencyOrderPage::$CrtCurrButtonSaveExit);
        $I->wait('1');
        $I->See('Валюта создана');
        $I->click('//form/table/tbody/tr[3]/td[5]/input');
        $I->click('//form/table/tbody/tr[2]/td[6]/div/span');
        $I->click(\CreateCurrencyOrderPage::$ListCurrButtonChekPrices);
        $I->wait('1');
        $I->See('Цены обновлены', '//div[2]/div');
        $I->wait('5');
    }
    
    
    
    
    
    function SearchNameProduct ( $typeName = NULL){ 
        $I = $this;
        $I->amOnPage(\CreateOrderAdminPage::$CrtPURL);
        if(isset($typeName)){            
            $I->click(\CreateOrderAdminPage::$CrtPButtProduct);    
            $I->fillField('#productNameForOrders', $typeName);
            $I->wait('1');
            $I->see($typeName,'//body/ul[2]/li[1]/a');
            $I->click('//body/ul[2]/li[1]/a');
            $I->wait('1');
            $I->see("Товар: $typeName", '//tbody/tr[1]/td[2]/div/div[2]/span[1]/b'); 
            $I->click(\CreateOrderAdminPage::$CrtPButtAddToCart);
            $I->see('В корзине', \CreateOrderAdminPage::$CrtPButtInBasket);
            $I->see($typeName, '//tbody/tr[2]/td[2]/select');
            $I->see($typeName, '//table[2]/tbody/tr/td[1]/span');            
        }        
    } 
    
    
    

    function SearchPriceProduct( $typeName = NULL, $typePrice = NULL) { 
        $I = $this;
        $I->amOnPage(\CreateOrderAdminPage::$CrtPURL);        
        if(isset($typeName)){            
            $I->click(\CreateOrderAdminPage::$CrtPButtProduct);    
            $I->fillField('#productNameForOrders', $typeName);
            $I->wait('1');
            $I->see($typeName,'//body/ul[2]/li[1]/a');
            $I->click('//body/ul[2]/li[1]/a');
            $I->wait('1');
            $I->see("Товар: $typeName", '//tbody/tr[1]/td[2]/div/div[2]/span[1]/b'); 
            $I->click(\CreateOrderAdminPage::$CrtPButtAddToCart);
            $I->see('В корзине', \CreateOrderAdminPage::$CrtPButtInBasket);
            $I->see($typeName, '//tbody/tr[2]/td[2]/select');
            $I->see($typeName, '//table[2]/tbody/tr/td[1]/span');            
        }if(isset($typePrice)){            
            $I->click(\CreateOrderAdminPage::$CrtPButtProduct);
            $I->see($typePrice, '//tbody/tr[1]/td[2]/div/div[2]/span[1]');
            $I->see($typePrice, '//tbody/tr[2]/td[3]/select/option');
            $I->see($typePrice, '//table[2]/tbody/tr/td[3]/span/span[1]');
            $I->see($typePrice, '//table[2]/tbody/tr/td[5]/span[1]');
            $I->see($typePrice, '//table[2]/tfoot/tr/td[3]/span');
            $I->click(\CreateOrderAdminPage::$CrtPButtOrder);
            $I->click(\CreateOrderAdminPage::$CrtOButtUpdate);
            $I->wait('1');
            $I->seeInField('//table/tbody/tr/td/div/div/div[1]/div[1]/input', $typePrice);            
        }
    }
    
    
    
    function SearchArticleProduct ( $articleProduct = NULL) { 
        $I = $this;
        $I->amOnPage(\CreateOrderAdminPage::$CrtPURL);
        if(isset($articleProduct)){            
           $I->click(\CreateOrderAdminPage::$CrtPButtProduct);
           $I->fillField('#productNameForOrders', $articleProduct);
           $I->wait('1');
           $I->see($articleProduct, '//body/ul[2]/li[1]/a');           
        }
    }
    
    
    function SearchAmountProduct ( $typeName = NULL, $amountProduct = NULL) { 
        $I = $this;
        if(isset($typeName)){            
            $I->amOnPage(\CreateOrderAdminPage::$CrtPURL); 
            $I->fillField('#productNameForOrders', $typeName);
            $I->wait('1');
            $I->see($typeName,'//body/ul[2]/li[1]/a');
            $I->click('//body/ul[2]/li[1]/a');
            $I->wait('1');
            $I->see("Товар: $typeName", '//tbody/tr[1]/td[2]/div/div[2]/span[1]/b'); 
            $I->click(\CreateOrderAdminPage::$CrtPButtAddToCart);
            $I->see('В корзине', \CreateOrderAdminPage::$CrtPButtInBasket);
            $I->see($typeName, '//tbody/tr[2]/td[2]/select');
            $I->see($typeName, '//table[2]/tbody/tr/td[1]/span');            
        }if(isset($amountProduct)){
            $I->click(\CreateOrderAdminPage::$CrtPButtProduct); 
            $I->see("Остаток: $amountProduct", '#productStock');
            $I->seeInField('//table[2]/tbody/tr/td[4]/div/input', '1');
        }
    } 
    
    
    
    
    
    
}
