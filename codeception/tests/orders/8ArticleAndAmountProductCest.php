<?php
use \OrdersTester;
class ArticleAndAmountProduct
{
    
    
    
    //---------------------------AUTORIZATION--------------------------------------- 
    /**
     * @group aa
     */
    public function Login(OrdersTester $I){
        InitTest::Login($I);
    }  
    
    
    
     ///---///----Tests For Article Product-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    

    
    /**
     * @group a
     * @guy OrdersTester\OrdersSteps
     */
    public function ProductArticleMin (OrdersTester\OrdersSteps $I) {
        $I->wantTo('Verify Presence Article on Autocomplete.');
        $I->createProduct($nameProduct = 'Товар с мин.артикулом.',
                                        $nameVariantProduct = NULL,
                                        $priceProduct = 1,
                                        $articleProduct = 'r2d2',
                                        $amountProduct = NULL,
                                        $categoryProduct = CreateCategoryOrdersPage::$CrtCatName1ForSearch);
        $I->SearchArticleProductAutocomplete($articleProduct = 'r2d2');  
        InitTest::ClearAllCach($I);
    }
    
    
    
    
    
    
    
    /**
     * @group a
     * @guy OrdersTester\OrdersSteps
     */
    public function ProductArticleLatinSmall (OrdersTester\OrdersSteps $I) {
        $I->wantTo('Verify Presence Article on Autocomplete.');
        $I->createProduct($nameProduct = 'Товар с Lat Small артикулом.',
                                        $nameVariantProduct = NULL,
                                        $priceProduct = 1,
                                        $articleProduct = 'opqrstuvwxyabcdefglmnzhijk',
                                        $amountProduct = NULL,
                                        $categoryProduct = CreateCategoryOrdersPage::$CrtCatName1ForSearch);
        $I->SearchArticleProductAutocomplete($articleProduct = 'opqrstuvwxyabcdefglmnzhijk');  
        InitTest::ClearAllCach($I);
    }
    
    
    
    
    
    
    
    /**
     * @group a
     * @guy OrdersTester\OrdersSteps
     */
    public function ProductArticleLatinBig (OrdersTester\OrdersSteps $I) {
        $I->wantTo('Verify Presence Article on Autocomplete.');
        $I->createProduct($nameProduct = 'Товар с Lat Big артикулом',
                                        $nameVariantProduct = NULL,
                                        $priceProduct = 1,
                                        $articleProduct = 'LMNOPQRSTUABCDEFGHIJKVWXYZ',
                                        $amountProduct = NULL,
                                        $categoryProduct = CreateCategoryOrdersPage::$CrtCatName1ForSearch);
        $I->SearchArticleProductAutocomplete($articleProduct = 'LMNOPQRSTUABCDEFGHIJKVWXYZ');  
        InitTest::ClearAllCach($I);
    }
    
    
    
    
    /**
     * @group a
     * @guy OrdersTester\OrdersSteps
     */
    public function ProductArticleCirilicSmall (OrdersTester\OrdersSteps $I) {
        $I->wantTo('Verify Presence Article on Autocomplete.');
        $I->createProduct($nameProduct = 'Товар с Cirilic Small  артикулом',
                                        $nameVariantProduct = NULL,
                                        $priceProduct = 1,
                                        $articleProduct = 'клмнопрстуфхцжзийчшщьыъэабвгдеёюяїєі',
                                        $amountProduct = NULL,
                                        $categoryProduct = CreateCategoryOrdersPage::$CrtCatName1ForSearch);
        $I->SearchArticleProductAutocomplete($articleProduct = 'клмнопрстуфхцжзийчшщьыъэабвгдеёюяїєі');  
        InitTest::ClearAllCach($I);
    }
    
    
    
    
    
    
    /**
     * @group a
     * @guy OrdersTester\OrdersSteps
     */
    public function ProductArticleCirilicBig (OrdersTester\OrdersSteps $I) {
        $I->wantTo('Verify Presence Article on Autocomplete.');
        $I->createProduct($nameProduct = 'Товар с Cirilic Big  артикулом',
                                        $nameVariantProduct = NULL,
                                        $priceProduct = 1,
                                        $articleProduct = 'ЇЄІАБВНОПРСТУФХЦЧГДЕЁЖЗИЙКЛМШЩЬЫЪЭЮЯ',
                                        $amountProduct = NULL,
                                        $categoryProduct = CreateCategoryOrdersPage::$CrtCatName1ForSearch);
        $I->SearchArticleProductAutocomplete($articleProduct = 'ЇЄІАБВНОПРСТУФХЦЧГДЕЁЖЗИЙКЛМШЩЬЫЪЭЮЯ');  
        InitTest::ClearAllCach($I);
    }
    
    
    
    
    
    
    
    
    
    /**
     * @group a
     * @guy OrdersTester\OrdersSteps
     */
    public function ProductArticleNumeral (OrdersTester\OrdersSteps $I) {
        $I->wantTo('Verify Presence Article on Autocomplete.');
        $I->createProduct($nameProduct = 'Товар с Articl Numer артикулом',
                                        $nameVariantProduct = NULL,
                                        $priceProduct = 1,
                                        $articleProduct = '7890123456',
                                        $amountProduct = NULL,
                                        $categoryProduct = CreateCategoryOrdersPage::$CrtCatName1ForSearch);
        $I->SearchArticleProductAutocomplete($articleProduct = '7890123456');  
        InitTest::ClearAllCach($I);
    }
    
    
    
    
    
    

    /**
     * @group a
     * @guy OrdersTester\OrdersSteps
     */
    public function ProductArticleNumeralSpace (OrdersTester\OrdersSteps $I) {
        $I->wantTo('Verify Presence Article on Autocomplete.');
        $I->createProduct($nameProduct = 'Товар с Article Num Space артикулом',
                                        $nameVariantProduct = NULL,
                                        $priceProduct = 1,
                                        $articleProduct = '1 2 3 4 5 6 7 8 9 0',
                                        $amountProduct = NULL,
                                        $categoryProduct = CreateCategoryOrdersPage::$CrtCatName1ForSearch);
        $I->SearchArticleProductAutocomplete($articleProduct = '1 2 3 4 5 6 7 8 9 0');  
        InitTest::ClearAllCach($I);
    }
    
    
    
    
    
    /**
     * @group a
     * @guy OrdersTester\OrdersSteps
     */
    public function ProductArticleSymbol (OrdersTester\OrdersSteps $I) {
        $I->wantTo('Verify Presence Article on Autocomplete.');
        $I->createProduct($nameProduct = 'Товар с допустимими символами в артикуле.',
                                        $nameVariantProduct = NULL,
                                        $priceProduct = 1,
                                        $articleProduct = InitTest::$textSymbols,
                                        $amountProduct = NULL,
                                        $categoryProduct = CreateCategoryOrdersPage::$CrtCatName1ForSearch);
        $I->SearchArticleProductAutocomplete($articleProduct = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyzАБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЬЫЪЭЮЯЇЄІабвгдеёжзийклмнопрстуфхцчшщьыъэюяїєі');  
        InitTest::ClearAllCach($I);
    }
    
    
    
    
    
    
    /**
     * @group a
     * @guy OrdersTester\OrdersSteps
     */
    public function ProductArticleSpaceTabBefore(OrdersTester\OrdersSteps $I) {
        $I->wantTo('Verify Presence Article on Autocomplete.');
        $I->createProduct($nameProduct = 'Товар с пробелом и табом перед вводом  в артикуле.',
                                        $nameVariantProduct = NULL,
                                        $priceProduct = 1,
                                        $articleProduct = '  Тиква3333',
                                        $amountProduct = NULL,
                                        $categoryProduct = CreateCategoryOrdersPage::$CrtCatName1ForSearch);
        $I->SearchArticleProductAutocomplete($articleProduct = 'Тиква3333');  
        InitTest::ClearAllCach($I);
    }
    
    
    
    
    
    
    /**
     * @group a
     * @guy OrdersTester\OrdersSteps
     */
    public function ProductArticlSpaceTabAfter (OrdersTester\OrdersSteps $I) {
        $I->wantTo('Verify Presence Article on Autocomplete.');
        $I->createProduct($nameProduct = 'Товар с пробелом и табом после ввода в артикуле.',
                                        $nameVariantProduct = NULL,
                                        $priceProduct = 1,
                                        $articleProduct = 'Тапки4444            ',
                                        $amountProduct = NULL,
                                        $categoryProduct = CreateCategoryOrdersPage::$CrtCatName1ForSearch);
        $I->SearchArticleProductAutocomplete($articleProduct = 'Тапки4444');  
        InitTest::ClearAllCach($I);
    }
    
    
    /**
     * @group a
     * @guy OrdersTester\OrdersSteps
     */
    public function DeleteArticleProductInCategory (OrdersTester\OrdersSteps $I){
        $I->DeleteProductInCategory($CategoryWithProduct = CreateCategoryOrdersPage::$CrtCatName1ForSearch);
        $I->wait('1');
    }













///---///----Tests For Amount Product-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    
    /**
     * @group a
     * @guy OrdersTester\OrdersSteps
     */
    public function VerifyFieldAmountInputSymbols(OrdersTester\OrdersSteps $I) {//Amount 09876543432
        $I->wantTo('Verify input invalid values in field Amount".');
        $I->createProduct($nameProduct = 'Amount 09876543432', $nameVariantProduct = NULL, $priceProduct = 1);
        $I->click(\NavigationBarPage::$Orders);
        $I->click(\NavigationBarPage::$OrdersList);
        $I->wait('3');
        $I->click(\OrdersListPage::$ListButtCreateOrder);
        $I->wait('3');
        $I->fillField('#productNameForOrders', 'Amount 09876543432');
        $I->wait('1');
        $I->click('//body/ul[2]/li[1]/a');
        $I->wait('1');
        $I->click(CreateOrderAdminPage::$CrtPButtAddToCart);
        $I->fillField(CreateOrderAdminPage::$CrtPFieldAmount, ' ');
        $I->dontSeeInField(CreateOrderAdminPage::$CrtPFieldAmount, ' ');
        $I->fillField(CreateOrderAdminPage::$CrtPFieldAmount, InitTest::$textSymbols);
        $I->dontSeeInField(CreateOrderAdminPage::$CrtPFieldAmount, InitTest::$textSymbols);
        $I->seeInField(CreateOrderAdminPage::$CrtPFieldAmount, '1234567890.');       
    }
    
    
    
    /**
     * @group a
     * @guy OrdersTester\OrdersSteps
     */
    public function ICMS1518ProductAmountNull (OrdersTester\OrdersSteps $I) {
         $I->wantTo('Switch The Radio Button Amount Out of stock');
         $I->SelectAmountOutStock($amountOutStockNo = NULL, $amountOutStockYes = 1);
     }
     /**
     * @group a
     * @guy OrdersTester\OrdersSteps
     */
    public function ICMS1518AddBasketProductAmountNull (OrdersTester\OrdersSteps $I) {
        $I->wantTo('ICMS-1518 Task From Jira.');
        $I->createProduct($nameProduct = 'ICMS-1518 Товарчик Jira.',
                                        $nameVariantProduct = NULL,
                                        $priceProduct = 1,
                                        $articleProduct = NULL,
                                        $amountProduct = 0,
                                        $categoryProduct = CreateCategoryOrdersPage::$CrtCatName1ForSearch);
          $I->SearchProductNameSelect($typeCategoryName = CreateCategoryOrdersPage::$CrtCatName1ForSearch, $typeProductName = $nameProduct);
          $I->click(\CreateOrderAdminPage::$CrtPButtAddToCart);
          $I->SearchProductInBascket($name = $nameProduct, $variant = $nameVariantProduct, $Price = '1', $totalPrice = '1', $Check = '1');
          InitTest::ClearAllCach($I);
        
    }
    
    
    
    
    /**
     * @group aa
     * @guy OrdersTester\OrdersSteps
     */
    public function ProductAmountYes (OrdersTester\OrdersSteps $I) {
         $I->wantTo('Switch The Radio Button Amount Out of stock');
         $I->SelectAmountOutStock($amountOutStockNo = 'Check', $amountOutStockYes = NULL);
     }
     /**
     * @group aa
     * @guy OrdersTester\OrdersSteps
     */
    public function AddBasketProductAmountYes (OrdersTester\OrdersSteps $I) {
        $I->wantTo('Verify Add To Basket Product Whith Zero Amount.');
        $I->createProduct($nameProduct = 'Товарчик с нулевым складеке Yes.',
                                        $nameVariantProduct = NULL,
                                        $priceProduct = 1,
                                        $articleProduct = NULL,
                                        $amountProduct = 0,
                                        $categoryProduct = CreateCategoryOrdersPage::$CrtCatName1ForSearch);
          $I->SearchProductNameSelect($typeCategoryName = CreateCategoryOrdersPage::$CrtCatName1ForSearch, $typeProductName = $nameProduct);
          $I->click(\CreateOrderAdminPage::$CrtPButtAddToCart);
          $I->SearchProductInBascket($name = $nameProduct, $variant = $nameVariantProduct, $Price = '1', $totalPrice = '1', $Check = '1');
          InitTest::ClearAllCach($I);
        
    }
    
    
/**
     * @group aa
     * @guy OrdersTester\OrdersSteps
     */
    public function DeleteAmountYesProductInCategory (OrdersTester\OrdersSteps $I){
        $I->DeleteProductInCategory($CategoryWithProduct = CreateCategoryOrdersPage::$CrtCatName1ForSearch);
    }
}

