<?php
use \OrdersTester;
class CategoryAndProductCest
{
//---------------------------AUTORIZATION--------------------------------------- 
     
    
    /**
     * @group x
     */
    public function Login(OrdersTester $I){
        InitTest::Login($I);
    }
    
    
    /**
     * @group x
     * @guy OrdersTester\OrdersSteps
     */
    public function qqq (OrdersTester\OrdersSteps $I) {
        $I->SearchCategory($typeCategory = 'Основная');
}
    
//----------------Create Parent, Sub1, Sub2 Product Category--------------------
    
    
    /**
     * @group a
     */
    public function CreateParentMainCategory (OrdersTester $I){
        $I->wantTo('Create Parent Category Product.');
    $this->CreateCategory($I,$createNameCategory = CreateCategoryOrdersPage::$CrtCatName1,
                            $addParentCategory = null);
    }
    
    
    
    /**
     * @group a
     */
    public function CreateFirstChildCategory (OrdersTester $I){
        $I->wantTo('Create Ghild Category Product First Level.');
        $this->CreateCategory($I,$createNameCategory = CreateCategoryOrdersPage::$CrtCatName2,
                                $addParentCategory = 'Основ');
    }
    
    
    
    /**
     * @group a
     */
    public function CreateSecondChildCategory (OrdersTester $I){
        $I->wantTo('Create Ghild Category Product Second Level');
        $this->CreateCategory($I,$createNameCategory = CreateCategoryOrdersPage::$CrtCatName3,
                                $addParentCategory = 'First');
    }
    
    
    
    
    
    
    
    


//-------------------------Create Products--------------------------------------
    

    
    /**
     * @group a
     */
    public function CreateProductNameMin (OrdersTester $I){
        $I->wantTo('Create Product Whith Minimal Product Name.');
        $this->CreateProduct($I,$nameProduct = CreateProductsOrdersPage::$CrtPrdNameMin,
                                $priceProduct = CreateProductsOrdersPage::$CrtPrdPriceMin,
                                $articleProduct = NULL,
                                $amountProduct = NULL,
                                $categoryProduct = CreateCategoryOrdersPage::$CrtCatName1ForSearch);
    }
    
     /**
     * @group a
     */
    public function CreateProductNameMax (OrdersTester $I){
        $I->wantTo('Create Product Whith Maximal Product Name.');
        $this->CreateProduct($I,$nameProduct = CreateProductsOrdersPage::$CrtPrdNameMax,
                                $priceProduct = CreateProductsOrdersPage::$CrtPrdPriceMin,
                                $articleProduct = NULL,    
                                $amountProduct = NULL,
                                $categoryProduct = CreateCategoryOrdersPage::$CrtCatName1ForSearch);
    }
    
    
     /**
     * @group a
     */
    public function CreateProductPriceMin (OrdersTester $I){
        $I->wantTo('Создать товар с минимальным целым значением цены.');
        $this->CreateProduct($I,$nameProduct = 'Минимальная Цена Товара',
                                $priceProduct = CreateProductsOrdersPage::$CrtPrdPriceMin,
                                $articleProduct = NULL,
                                $amountProduct = NULL,
                                $categoryProduct = CreateCategoryOrdersPage::$CrtCatName1ForSearch);
    }
    
    
    /**
     * @group a
     */
    public function CreateProductPriceMax (OrdersTester $I){
        $I->wantTo('Создать товар с максимальным целым значением цены.');
        $this->CreateProduct($I,$nameProduct = 'Максимальная Цена Товара',
                                $priceProduct = CreateProductsOrdersPage::$CrtPrdPriceMax,
                                $articleProduct = NULL,
                                $amountProduct = NULL,
                                $categoryProduct = CreateCategoryOrdersPage::$CrtCatName1ForSearch);
    }
    
    /**
     * @group a
     */
    public function CreateProductArticleMin (OrdersTester $I){
        $I->wantTo('Создать товар с минимальной длинной акртикула.');
        $this->CreateProduct($I,$nameProduct = 'Минимальний Арикул Товара',
                                $priceProduct = CreateProductsOrdersPage::$CrtPrdPriceMin,
                                $articleProduct = CreateProductsOrdersPage::$CrtPrdArticleMin,
                                $amountProduct = NULL,
                                $categoryProduct = CreateCategoryOrdersPage::$CrtCatName2ForSearch);
    }
    
    
    /**
     * @group a
     */
    public function CreateProductArticleMax (OrdersTester $I){
        $I->wantTo('Создать товар с максимальной длинной артикула.');
        $this->CreateProduct($I,$nameProduct = 'Максимальний Артикул Товара',
                                $priceProduct = CreateProductsOrdersPage::$CrtPrdPriceMin,
                                $articleProduct = CreateProductsOrdersPage::$CrtPrdArticleMax,
                                $amountProduct = NULL,
                                $categoryProduct = CreateCategoryOrdersPage::$CrtCatName2ForSearch);
    }

    
    /**
     * @group a
     */
    public function CreateProductAmountMin (OrdersTester $I){
        $I->wantTo('Создать товар с нулевім количеством товара.');
        $this->CreateProduct($I,$nameProduct = 'Минимальное Количество Товара',
                                $priceProduct = CreateProductsOrdersPage::$CrtPrdPriceMin,
                                $articleProduct = NULL,
                                $amountProduct = CreateProductsOrdersPage::$CrtVarAmountMin,
                                $categoryProduct = CreateCategoryOrdersPage::$CrtCatName2ForSearch);
    }
    
    
    /**
     * @group a
     */
    public function CeateProductAmountMax (OrdersTester $I){
        $I->wantTo('Создать товар с максимальнім количеством товара.');
        $this->CreateProduct($I,$nameProduct = 'Максимальное Количество Товара',
                                $priceProduct = CreateProductsOrdersPage::$CrtPrdPriceMin,
                                $articleProduct = NULL,
                                $amountProduct = CreateProductsOrdersPage::$CrtVarAmountMax,
                                $categoryProduct = CreateCategoryOrdersPage::$CrtCatName3ForSearch);
    }
    
    
    
    
    /**
     * @group a
     */
    public function CreateProductPrice1AfterPoint (OrdersTester $I){
        $I->wantTo('Создать товар с одним значением после точки.');
        $this->CreateProduct($I,$nameProduct = 'Товар с ценой 1 после точки',
                                $priceProduct = '0.1',
                                $articleProduct = NULL,
                                $amountProduct = NULL,
                                $categoryProduct = CreateCategoryOrdersPage::$CrtCatName3ForSearch);
    }
    
    
    
    /**
     * @group a
     */
    public function CreateProductPrice2AfterPoint (OrdersTester $I){
        $I->wantTo('Создать товар с двумя значениями после точки.');
        $this->CreateProduct($I,$nameProduct = 'Товар с ценой 2 после точки',
                                $priceProduct = '0.11',
                                $articleProduct = NULL,
                                $amountProduct = NULL,
                                $categoryProduct = CreateCategoryOrdersPage::$CrtCatName3ForSearch);
    }
    
    /**
     * @group a
     */
    public function CreateProductPriceMaxAfterPoint (OrdersTester $I){
        $I->wantTo('Создать товар с максимальной ценой после точки.');
        $this->CreateProduct($I,$nameProduct = 'Товар с ценой Макс после точки',
                                $priceProduct = '0.99',
                                $articleProduct = NULL,
                                $amountProduct = NULL,
                                $categoryProduct = CreateCategoryOrdersPage::$CrtCatName3ForSearch);
    }
    
    
    
//-------------------------Create Users-----------------------------------------   
    /**
     * @group a
     */ 
    
    public function createUserValuesMin(OrdersTester $I) {
        $I->wantTo('Создать пользователя с минимальной длинной валидных дынных в обязательных полях.');
        $this->CreateUser($I,   $createUserName = 'Ъ',
                                $createUserEmail = 'a@a.com',
                                $createUserPassword = '1');        
    }
    /**
     * @group a
     */ 
    
    public function createUserValuesMax(OrdersTester $I) {
        $I->wantTo('Создать пользователя с максимальной длинной обязательнных полей.');
        $this->CreateUser($I,   $createUserName = 'qqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqq',
                                $createUserEmail = 'qqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqq@qqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqq.com',
                                $createUserPassword = 'qqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqq');        
    }
    /**
     * @group a
     */ 
    
    public function createUserPhoneMin(OrdersTester $I) {
        $I->wantTo('Создать пользователя с минимальной длинной телефона');
        $this->CreateUser($I,   $createUserName = 'Минимальное количество ТЕЛЕФОН',
                                $createUserEmail = 'Line@Age.com',
                                $createUserPassword = '/',
                                $createUserPhone = '0');        
    }
    /**
     * @group a
     */ 
    
    public function createUserPhoneMax(OrdersTester $I) {
        $I->wantTo('Создать пользователя с максимальной длинной телефона.');
        $this->CreateUser($I,   $createUserName = 'Максимальное количество ТЕЛЕФОН',
                                $createUserEmail = 'Arche@Age.com',
                                $createUserPassword = '*',
                                $createUserPhone = '1234567890123456789012312345678901');        
    }
    /**
     * @group a
     */ 
    
    public function createUserAddressMin(OrdersTester $I) {
        $I->wantTo('Создать пользователя с минималной длинной адреса');
        $this->CreateUser($I,   $createUserName = 'Минимальное количество АДРЕС',
                                $createUserEmail = 'Line@Age.com',
                                $createUserPassword = '/',
                                $createUserPhone = NULL,
                                $createUserAddress = 'ж'); 
        }
    
    /**
     * @group a
     */ 
     public function CreateUserAddressMax (OrdersTester $I) {
         $I->wantTo('Создать пользователя с максимальной длиной адреса.');
         $this->CreateUser($I,  $createUserName = 'Максимальное количество АДРЕС',
                                $createUserEmail = 'Cannibal@Corpse.net',
                                $createUserPassword = 'Z',
                                $createUserPhone = NULL,
                                $createUserAddress = 'wwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwww');
    }
    
    
//-------------------------Create Cirrency--------------------------------------    
//    /**
//     * @group a
//     */ 
//    public function CreateCurrencyMainCurr (OrdersTester $I) {
//        $I->wantTo('Создать новую главную валюту.');
//        $this->CreateCurrency($I,   $createCurrName = 'Тестовая Валюта',
//                                    $createCurrCode = 'OUI',
//                                    $createCurrSymbol = '#%&',
//                                    $createCurrCourse = '5.0000');
//    }










//---------------------------Protected Function---------------------------------
    
    
    
    
    
    protected function CreateCategory (OrdersTester $I, $createNameCategory = null,
                                                            $addParentCategory = null){
        $I->amOnPage(CreateCategoryOrdersPage::$CrtCategoryPageURL);
        if(isset($createNameCategory)){
            $I->fillField(CreateCategoryOrdersPage::$CrtCategoryFieldName, $createNameCategory);
        }if(isset($addParentCategory)){ 
            $I->click(CreateCategoryOrdersPage::$CrtCategorySelectMenu);
            $I->fillField(CreateCategoryOrdersPage::$CrtCategorySelectMenuInput, $addParentCategory);
            $I->click(CreateCategoryOrdersPage::$CrtCategorySelectMenuSetSearch);
        }$I->click(CreateCategoryOrdersPage::$CrtCategoryButtonSaveandBack); 
    }
    
    
   
    

    
    

    protected function CreateProduct (OrdersTester $I,  $nameProduct = NULL,
                                                            $priceProduct = NULL,
                                                            $articleProduct = NULL,
                                                            $amountProduct = NULL,
                                                            $categoryProduct = NULL,
                                                            $variantProduct = NULL,
                                                            $variantPrice = NULL,
                                                            $variantArticle = NULL,
                                                            $variantAmount = NULL){
        $I->amOnPage(CreateProductsOrdersPage::$CrtProductPageURL);                                                                                                     
        if (isset($nameProduct)) {
            $I->fillField(CreateProductsOrdersPage::$CrtProductNameProduct, $nameProduct);                                          
        }if(isset($priceProduct)){
            $I->fillField(CreateProductsOrdersPage::$CrtProductPriceProduct, $priceProduct);                                                                            
        }if(isset($articleProduct)){
            $I->fillField(CreateProductsOrdersPage::$CrtProductArticleProduct, $articleProduct);                           
        }if(isset($amountProduct)){
            $I->fillField(CreateProductsOrdersPage::$CrtProductAmountProduct, $amountProduct);                            
        }if(isset($categoryProduct)){
            $I->click(CreateProductsOrdersPage::$CrtProductCategoryProductSelectField);                                                         
            $I->fillField(CreateProductsOrdersPage::$CrtProductCategoryProductSelectInput, $categoryProduct);                                               
            $I->click(CreateProductsOrdersPage::$CrtProductCategoryProductSetSelect);                                         
        }if(isset($variantProduct)){                                                        
            $a = $I->grabTagCount($I, 'td select');
            $b = $I->comment("$a");
                if($a == 4){
                    $I->click(CreateProductsOrdersPage::$CrtProductVariantButtonADD);                                                      
                    $I->fillField(CreateProductsOrdersPage::$CrtProductVariantFieldName, $variantProduct);                                                        
                }elseif($a > 4){
                    $I->fillField(CreateProductsOrdersPage::$CrtProductVariantFieldName, $variantProduct);                
                }
        }if(isset($variantPrice)){
            $a = $I->grabTagCount($I, 'td select');
            $b = $I->comment("$a");
                if($a == 4){
                  $I->click(CreateProductsOrdersPage::$CrtProductVariantButtonADD);
                  $I->fillField(CreateProductsOrdersPage::$CrtProductVariantFieldPrice, $variantPrice);                                         
                }elseif ($a > 4) {
                  $I->fillField(CreateProductsOrdersPage::$CrtProductVariantFieldPrice, $variantPrice);                                               
                }
        }if(isset($variantArticle)){
            $a = $I->grabTagCount($I, 'td select');
            $b = $I->comment("$a");
                if($a == 4){
                   $I->click(CreateProductsOrdersPage::$CrtProductVariantButtonADD);
                   $I->fillField(CreateProductsOrdersPage::$CrtProductVariantFieldArticle, $variantArticle); 
                }elseif ($a > 4) {
                   $I->fillField(CreateProductsOrdersPage::$CrtProductVariantFieldArticle, $variantArticle);
                }
        }if(isset($variantAmount)){
            $a = $I->grabTagCount($I, 'td select');
            $b = $I->comment("$a");
                if($a == 4){
                  $I->click(CreateProductsOrdersPage::$CrtProductVariantButtonADD);
                  $I->fillField(CreateProductsOrdersPage::$CrtProductVariantFieldAmount, $variantAmount);                       
                }elseif ($a > 4) {
                  $I->fillField(CreateProductsOrdersPage::$CrtProductVariantFieldAmount, $variantAmount); 
                }
        }
        $I->wait('1');
        $I->click(CreateProductsOrdersPage::$CrtProductButtonSaveandBack);
    }
    
    
    
    

    
    
    
     protected function CreateUser(OrdersTester $I,  $createUserName = NULL,
                                                        $createUserEmail = NULL,
                                                        $createUserPassword = NULL,
                                                        $createUserPhone = NULL, 
                                                        $createUserAddress = NULL) {
        $I->amOnPage(CreateUserForOrdersPage::$CrtUserPageUrl);
        if(isset($createUserName)){
            $I->fillField(CreateUserForOrdersPage::$CrtUserFieldName, $createUserName);
        }if(isset($createUserEmail)){
            $I->fillField(CreateUserForOrdersPage::$CrtUserFieldEmail, $createUserEmail);
        }if(isset($createUserPassword)){
            $I->fillField(CreateUserForOrdersPage::$CrtUserFieldPassword, $createUserPassword);
        }if(isset($createUserPhone)){
            $I->fillField(CreateUserForOrdersPage::$CrtUserFieldPhone, $createUserPhone);
        }if(isset($createUserAddress)){
            $I->fillField(CreateUserForOrdersPage::$CrtUserFieldAddress, $createUserAddress);    
        }
        $I->click(CreateUserForOrdersPage::$CrtUserButtonSaveAndBack);
    }
    
    
    
    
    
    
    
    protected function CreateCurrency(OrdersTester $I, $createCurrName = NULL,
                                        $createCurrCode = NULL,
                                        $createCurrSymbol = NULL,
                                        $createCurrCourse = NULL) {
        $I->amOnPage(CreateCurrencyOrderPage::$CrtCurrPageURL);
        $I->wait('1');
        if(isset($createCurrName)){
          $I->fillField(CreateCurrencyOrderPage::$CrtCurrFieldName, $createCurrName);  
        }if(isset($createCurrCode)){
            $I->fillField(CreateCurrencyOrderPage::$CrtCurrFieldCode, $createCurrCode); 
        }if(isset($createCurrSymbol)){
            $I->fillField(CreateCurrencyOrderPage::$CrtCurrFieldSymbol, $createCurrSymbol); 
        }if(isset($createCurrCourse)){
            $I->fillField(CreateCurrencyOrderPage::$CrtCurrFieldCourse, $createCurrCourse); 
        }
        $I->click(CreateCurrencyOrderPage::$CrtCurrButtonSaveExit);
        $I->wait('1');
        $I->See('Валюта создана');
        $I->click('//form/table/tbody/tr[3]/td[5]/input');
        $I->click('//form/table/tbody/tr[2]/td[6]/div/span');
        $I->click(CreateCurrencyOrderPage::$ListCurrButtonChekPrices);
        $I->wait('1');
        $I->See('Цены обновлены', '//div[2]/div');
        $I->wait('5');
    }
     
    

    

}    
