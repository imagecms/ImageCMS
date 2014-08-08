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
        $I->wait('2');
    }
    
    
    
    
    
    
    
//-------------------------Create Product---------------------------------------   
    

    function createProduct( $nameProduct = NULL,
                            $nameVariantProduct = NULL,
                            $priceProduct = NULL,
                            $articleProduct = NULL,
                            $amountProduct = NULL,
                            $categoryProduct = NULL,
                            $variantProduct = NULL,
                            $variantPrice = NULL,
                            $variantArticle = NULL,
                            $variantAmount = NULL) {
        $I = $this;
        $I->click(\NavigationBarPage::$ProductsCatalogue);                                                                                                 
        $I->click(\NavigationBarPage::$ProductList);
        $I->wait('3');
        $I->waitForElement(\CreateProductsOrdersPage::$CrtProductButtonCreateProduct);
        $I->click(\CreateProductsOrdersPage::$CrtProductButtonCreateProduct);                                                                                                 
        $I->wait('3');
        if (isset($nameProduct)) {
            $I->fillField(\CreateProductsOrdersPage::$CrtProductNameProduct, $nameProduct);                                          
        }If (isset($nameVariantProduct)){
            $I->fillField(\CreateProductsOrdersPage::$CrtProductNameVariantProduct, $nameVariantProduct);
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
    

    function createUserUserPage($createUserName = NULL,
                                $createUserEmail = NULL,
                                $createUserPassword = NULL,
                                $createUserPhone = NULL, 
                                $createUserAddress = NULL) {
        $I = $this;
        $I->click(\NavigationBarPage::$Users);
        $I->click(\NavigationBarPage::$UsersList);
        $I->wait('3');
        $I->click('//body/div[1]/div[5]/div/section/div[1]/div[2]/div/a');
        $I->wait('3');
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
        $I->wait('2');
    }
    
    
    
    
    
    
    
    
    
    
    
    
    function searchUserOnUserPage($UserName = NULL, $UserEmeil = NULL) {
        $I = $this;
        $I->click(\NavigationBarPage::$Users);
        $I->click(\NavigationBarPage::$UsersList);
        $I->wait('2');
        if(isset($UserName)){
           $Rows = $I->grabTagCount($I, 'tbody tr');
        }
        for($j = 1;$j <= $Rows;$j++){
               $b = $I->grabTextFrom("//table/tbody/tr[$j]/td[4]/a");
               if($b == $UserName){
                   $I->see($UserName, "//table/tbody/tr[$j]/td[4]/a");
                   break;
               }
           }
        if(isset($UserEmeil)){
            $RowsEmeil = $I->grabTagCount($I, 'tbody tr');
        } 
        for($l = 1;$l <= $RowsEmeil;$l++){
               $bb = $I->grabTextFrom("//table/tbody/tr[$l]/td[3]/span");
               if($bb == $UserEmeil){
                   $I->see($UserEmeil, "//table/tbody/tr[$l]/td[3]/span");
                   break;
               }
           }
        
    }
    
    
    
    
    
    
    
    
    
    
    
    
    function CreateUserOrderPage($createUserName = NULL,
                                $createUserEmail = NULL,
                                $createUserPhone = NULL, 
                                $createUserAddress = NULL){
        $I = $this;
        $I->click(\NavigationBarPage::$Orders);
        $I->click(\NavigationBarPage::$OrdersList);
        $I->wait('2');
        $I->click(\OrdersListPage::$ListButtCreateOrder);
        $I->wait('2');
        $I->click(\CreateOrderAdminPage::$CrtPButtUser);
        $I->click(\CreateOrderAdminPage::$CrtULinkCreate);
        if(isset($createUserName)){
            $I->fillField(\CreateOrderAdminPage::$CrtUFieldName, $createUserName);
        }if(isset($createUserEmail)){
            $I->fillField(\CreateOrderAdminPage::$CrtUFieldEmeil, $createUserEmail);
        }if(isset($createUserPhone)){
            $I->fillField(\CreateOrderAdminPage::$CrtUFieldPhone, $createUserPhone);
        }if(isset($createUserAddress)){
            $I->fillField(\CreateOrderAdminPage::$CrtUFieldAddress, $createUserAddress);    
        }
        $I->click(\CreateOrderAdminPage::$CrtUButtCreate);
        $I->wait('1');
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
    

    
    
    
  //----------------------------Create Currenci---------------------------------         
    
    

    function createCurrency($createCurrName = NULL,
                            $createCurrCode = NULL,
                            $createCurrSymbol = NULL,
                            $createCurrCourse = NULL){
        $I = $this;
//        $I->click();
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
    
    
    
    
//-----------------Search For Field  "ID /Название /Артикул"--------------------   
    
    function SearchNameProductaAutocomplete ( $typeName = NULL){ 
        $I = $this;
        $I->click(\NavigationBarPage::$Orders);
        $I->click(\NavigationBarPage::$OrdersList);
        $I->wait('3');
        $I->click(\OrdersListPage::$ListButtCreateOrder);
        $I->wait('3');
        if(isset($typeName)){            
//            $I->click(\CreateOrderAdminPage::$CrtPButtProduct);    
            $I->fillField('#productNameForOrders', $typeName);
            $I->wait('2');
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
    
    
    
    
    
    
    function SearchVariantProductAutocomplete ($productName = NULL, $variantName = NULL) {
        $I = $this;
        $I->click(\NavigationBarPage::$Orders);
        $I->click(\NavigationBarPage::$OrdersList);
        $I->wait('3');
        $I->click(\OrdersListPage::$ListButtCreateOrder);
        $I->wait('3');
        $I->fillField('#productNameForOrders', $productName);
        $I->wait('2');
        $I->see($variantName,'//body/ul[2]/li[1]/a');
        $I->click('//body/ul[2]/li[1]/a');
        $I->wait('1');
        $I->see($variantName, '//table[1]/tbody/tr[2]/td[3]/select/option');
        $I->click(\CreateOrderAdminPage::$CrtPButtAddToCart);
        $I->see($variantName, '//section/form/div/div[1]/div/table[2]/tbody/tr/td[2]/span');
        
              
    } 
    
    
    

    function SearchPriceProductAutocomplete( $typeName = NULL, $typePrice = NULL) { 
        $I = $this;
        $I->click(\NavigationBarPage::$Orders);
        $I->click(\NavigationBarPage::$OrdersList);
        $I->wait('3');
        $I->click(\OrdersListPage::$ListButtCreateOrder);
        $I->wait('3');        
        if(isset($typeName)){            
            $I->fillField('#productNameForOrders', $typeName);
            $I->wait('2');
            $I->click('//body/ul[2]/li[1]/a');
            $I->wait('2');
            $I->click(\CreateOrderAdminPage::$CrtPButtAddToCart);
        }if(isset($typePrice)){            
//            $I->click(\CreateOrderAdminPage::$CrtPButtProduct);
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
    
    
    
    
    
    
    function SelectNumberAfterPoint ($numberAfterPoint = NULL){
        $I = $this;
        $I->amOnPage('/admin/components/run/shop/settings#view');
        $I->wait('3');
        $I->selectOption('//table/tbody/tr/td/div/div[3]/div/div/select', "$numberAfterPoint");
        $I->wait('1');
        $I->click('//section/div[1]/div[2]/div/button[2]');
        $I->wait('3');
        
    }
    
    
    
    
    
    
    
    function SelectAmountOutStock($amountOutStockNo = NULL, $amountOutStockYes = NULL) {
        $I = $this;
        $I->amOnPage('/admin/components/run/shop/settings#orders');
        $I->wait('3');
        if(isset($amountOutStockNo)){
            $I->click('//div[3]/div/label[2]/input');
            $I->click('//body/div[1]/div[5]/section/div[1]/div[2]/div/button[2]');
        }if(isset($amountOutStockYes)){
            $I->click('//div[3]/div/label/input');
            $I->click('//body/div[1]/div[5]/section/div[1]/div[2]/div/button[2]');
        }
        $I->wait('3');
    }
    
    
    
    
    
    function SearchArticleProductAutocomplete ( $articleProduct = NULL) { 
        $I = $this;
//        $I->click(\NavigationBarPage::$Orders);
//        $I->click(\NavigationBarPage::$OrdersList);
//        $I->wait('5');
//        $I->click(\OrdersListPage::$ListButtCreateOrder);
        $I->amOnPage('/admin/components/run/shop/orders/create');
        $I->wait('3');
//        if(isset($articleProduct)){
//           $I->wait('1');
//           $I->waitForElement('//table[1]/tbody/tr[1]/td[1]/div/input'); 
           $I->fillField('//table[1]/tbody/tr[1]/td[1]/div/input', "$articleProduct");
           $I->wait('1');
           $I->see($articleProduct, '//body/ul[2]/li[1]/a');           
//        }
    }
    
    
    
    
    
    
    
    
    function SearchAmountProductAutocomplete ( $typeName = NULL, $amountProduct = NULL) { 
        $I = $this;
        if(isset($typeName)){            
            $I->click(\NavigationBarPage::$Orders);
            $I->click(\NavigationBarPage::$OrdersList);
            $I->wait('3');
            $I->click(\OrdersListPage::$ListButtCreateOrder);
            $I->wait('3');
            $I->fillField('#productNameForOrders', $typeName);
            $I->wait('1');
            $I->click('//body/ul[2]/li[1]/a');
            $I->wait('1');
            $I->click(\CreateOrderAdminPage::$CrtPButtAddToCart);
        }if(isset($amountProduct)){
            $I->see("Остаток: $amountProduct", '#productStock');
            $I->seeInField('//table[2]/tbody/tr/td[4]/div/input', '1');
        }
    } 
    
    

    
    
    
    
    
    
    
    //-----------------Search For Select Menu-----------------------------------   
    
    
    
    
    
    
    
    
    
    function SearchCategorySelect ($typeCategory = NULL){
        $I = $this;
        $urlCrtOrd = '/admin/components/run/shop/orders/create';
        $I->click(\NavigationBarPage::$Orders);
        $I->click(\NavigationBarPage::$OrdersList);
        $I->wait('3');
        $I->click(\OrdersListPage::$ListButtCreateOrder);
        $I->wait('3');
        $a = $I->grabFromCurrentUrl();
        $I->comment("Вот такой у нас урл = $a");
        if(isset($typeCategory)){
            if($a != $urlCrtOrd){
            $I->amOnPage("$urlCrtOrd");
            }
            $I->click(\CreateOrderAdminPage::$CrtZMenuCategoryDefolt);
            $I->fillField(\CreateOrderAdminPage::$CrtZMenuCategoryInput, $typeCategory);
            $I->click(\CreateOrderAdminPage::$CrtZMenuCategorySearchButton);
            $I->wait('1');
            $I->see("$typeCategory", '//table[1]/tbody/tr[2]/td[1]/div/a');
            
        }
    }
    
    function DeleteProductInCategory($CategoryWithProduct) {
        $I = $this;
        if(isset($CategoryWithProduct)){
            $I->click(\NavigationBarPage::$ProductsCatalogue);
            $I->wait('1');
            $I->click(\NavigationBarPage::$ProductList);
            $I->wait('3');
            $I->click('//form/section/div[2]/table/thead/tr[2]/td[4]/div/a');
            $I->fillField('//form/section/div[2]/table/thead/tr[2]/td[4]/div/div/div/input', $CategoryWithProduct);
            $I->click('//form/section/div[2]/table/thead/tr[2]/td[4]/div/div/ul/li');
            $I->wait('2');
            $I->click(\CreateProductsOrdersPage::$DelPrdMainCheckBox);
            $I->click(\CreateProductsOrdersPage::$DelPrdButtonDelete);
            $I->wait('2');
            $I->click(\CreateProductsOrdersPage::$DelPrdButtonDeleteWindowDelete);
            $I->wait('1');
        }
        
    }
    
    
    
    
    
    
    
    
    
    
    function SearchProductNameSelect($typeCategoryName = NULL, $typeProductName = NULL) {
        $I = $this;
        if(isset($typeProductName)){
        $I->click(\NavigationBarPage::$ProductsCatalogue);
        $I->click(\NavigationBarPage::$ProductList);
        $I->wait('3');        
        $I->click('//form/section/div[2]/table/thead/tr[2]/td[4]/div/a');
        $I->fillField('//form/section/div[2]/table/thead/tr[2]/td[4]/div/div/div/input', $typeCategoryName);
        $I->click('//form/section/div[2]/table/thead/tr[2]/td[4]/div/div/ul/li');
        $I->wait('2');
        $a = $I->grabTagCount($I, 'tbody tr');
        $I->comment("вот столько у нас rows = $a");
        }
        if(isset($typeCategoryName)){
        $I->amOnPage(\CreateOrderAdminPage::$CrtPURL);
        $I->wait('3');
            $I->click(\CreateOrderAdminPage::$CrtZMenuCategoryDefolt);
            $I->fillField(\CreateOrderAdminPage::$CrtZMenuCategoryInput, $typeCategoryName);
            $I->click(\CreateOrderAdminPage::$CrtZMenuCategorySearchButton);
            for($j = 1;$j <= $a;$j++){
            $b = $I->grabTextFrom("//table[1]/tbody/tr[2]/td[2]/select/option[$j]");
                if($b == $typeProductName){
                $I->wait('2');    
                $I->click("//table[1]/tbody/tr[2]/td[2]/select/option[$j]");
                $I->comment('Все Хорошо товар найден и активирован.');
                $I->wait('2');
                $I->see("Товар: $typeProductName", '//tbody/tr[1]/td[2]/div/div[2]/span[1]/b'); 
                break;
                }elseif ($b != $typeProductName) {
                $I->comment('Етот товар не соответствует ожыдаэмому.');
                }
            }
        }
        
    }
    
    
    
    
    
    
    
    
    function SearchProductVariantandPriceSelect($typeVariantName = NULL, $typeVariantPrice = NULL) {
        $I = $this;
        if(isset($typeVariantName)){
            $I->see($typeVariantName, '//table[1]/tbody/tr[2]/td[3]/select/option');
        }
        if(isset($typeVariantPrice)){
            $I->see($typeVariantPrice, '//table[1]/tbody/tr[2]/td[3]/select/option');
        }
    }
    
    
    
    
    
    
    
    
    
    function AddToBascketSelect() {
        $I = $this;
        $I->wait('2');
        $I->click(\CreateOrderAdminPage::$CrtPButtAddToCart);
        $I->see('В корзине', \CreateOrderAdminPage::$CrtPButtInBasket);
        $I->wait('1');
    }
    
    
    
    
    
    
    
    function SearchProductInBascket($name = NULL,
                                    $variant = NULL,
                                    $Price = NULL,
                                    $totalPrice = NULL,
                                    $Check = NULL){
        $I = $this;
    if(isset($name)){
        $I->see($name, '//table[2]/tbody/tr/td[1]/span');
    }    
    if(isset($variant)){
        $I->see($variant, '//form/div/div[1]/div/table[2]/tbody/tr/td[2]/span');
    }    
    if(isset($Price)){
        $I->see($Price, '//form/div/div[1]/div/table[2]/tbody/tr/td[3]/span/span[1]');
    }    
    if(isset($totalPrice)){
        $I->see($totalPrice, '//form/div/div[1]/div/table[2]/tbody/tr/td[5]/span[1]');
    }    
    if(isset($Check)){
       $I->see($Check, '//form/div/div[1]/div/table[2]/tfoot/tr/td[3]/span/b/span[1]'); 
    }    
            
    }

    
    
    
    
    
    
    function DeleteCategory() {
        $I = $this;
        $I->amOnPage(\DeleteCategoryOrder::$ListURL);
        $I->click(\DeleteCategoryOrder::$ListHeaderCheckBox);
        $I->click(\DeleteCategoryOrder::$ListButtonDelete);
        $I->click(\DeleteCategoryOrder::$DeleteWindowButtonDelete);
        $I->wait('1');
        \InitTest::ClearAllCach($I);
        
    }
    
    
    
    
    
    
}
