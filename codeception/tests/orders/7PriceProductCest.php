<?php
use \OrdersTester;
class PriceProductCest
{
    
    
    
    
    //---------------------------AUTORIZATION--------------------------------------- 
    /**
     * @group a
     */
    public function Login(OrdersTester $I){
        InitTest::Login($I);
    }  
    
    
    
    ///---///----Tests For Price Product-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    
    
    
    
    
    /**
     * @group a
     * @guy OrdersTester\OrdersSteps
     */
    public function ProductPriceMinParentCategory (OrdersTester\OrdersSteps $I) {
        $I->wantTo('Verify Presence Price Null in Second Child Category on Select Menu.');
        $I->wait('3');
        $I->createProduct($nameProduct = '0Товар0 0с0 0нулевой0 0ценой0',
                                        $nameVariantProduct = NULL,
                                        $priceProduct = '0',
                                        $articleProduct = NULL,
                                        $amountProduct = NULL,
                                        $categoryProduct = CreateCategoryOrdersPage::$CrtCatName3ForSearchCategory);
          $I->SearchProductNameSelect($typeCategoryName = CreateCategoryOrdersPage::$CrtCatName3ForSearchOrder, $typeProductName = $nameProduct);
          $I->AddToBascketSelect();
          $I->SearchProductInBascket($name = $nameProduct, $variant = $nameVariantProduct, $Price = $priceProduct, $totalPrice = $priceProduct, $Check = $priceProduct);
          InitTest::ClearAllCach($I);
    }
    /**
     * @group a
     * @guy OrdersTester\OrdersSteps
     */
    public function SearchProductPriceNullAutocomplit (OrdersTester\OrdersSteps $I){
        $I->wantTo('Verify Check Price Presence.');
        $I->SearchPriceProductAutocomplete($typeName = '0Товар0 0с0 0нулевой0 0ценой0', $typePrice = '0'); 
    }
    
    
    
    
    
    
    
    
    /**
     * @group a
     * @guy OrdersTester\OrdersSteps
     */
    public function SelectNumber1AfterPoint(OrdersTester\OrdersSteps $I) {
        $I->wantTo('Select The Number Of The Menu Price After The Point');
        $I->SelectNumberAfterPoint($numberAfterPoint = 1);
    }
    /**
     * @group a
     * @guy OrdersTester\OrdersSteps
     */
    public function ProductPricePoint1ParentCategory (OrdersTester\OrdersSteps $I) {
        $I->wantTo('Verify Presence Price in Second Child Category on Select Menu.');
        $I->createProduct($nameProduct = 'zagibok Pointa',
                                        $nameVariantProduct = NULL,
                                        $priceProduct = '0.1',
                                        $articleProduct = NULL,
                                        $amountProduct = NULL,
                                        $categoryProduct = CreateCategoryOrdersPage::$CrtCatName3ForSearchCategory);
          $I->SearchProductNameSelect($typeCategoryName = CreateCategoryOrdersPage::$CrtCatName3ForSearchOrder, $typeProductName = $nameProduct);
          $I->AddToBascketSelect();
          $I->SearchProductInBascket($name = $nameProduct, $variant = $nameVariantProduct, $Price = $priceProduct, $totalPrice = $priceProduct, $Check = $priceProduct);
          InitTest::ClearAllCach($I);
    }
    /**
     * @group a
     * @guy OrdersTester\OrdersSteps
     */
    public function SearchProductPriceMin1Autocomplit (OrdersTester\OrdersSteps $I){
        $I->wantTo('Verify Check Price Presence.');
        $I->SearchPriceProductAutocomplete($typeName = 'zagibok Pointa', $typePrice = '0.1'); 
    }
    
    
    
    
    
    
    
    
    /**
     * @group a
     * @guy OrdersTester\OrdersSteps
     */
    public function SelectNumber2AfterPoint(OrdersTester\OrdersSteps $I) {
        $I->wantTo('Select The Number Of The Menu Price After The Point');
        $I->SelectNumberAfterPoint($numberAfterPoint = 2);
    }
    /**
     * @group a
     * @guy OrdersTester\OrdersSteps
     */
    public function ProductPricePoint2ParentCategory (OrdersTester\OrdersSteps $I) {
        $I->wantTo('Verify Presence Price in Second Child Category on Select Menu.');
        $I->createProduct($nameProduct = 'terpinkod 222Producticus2 с 222 знаками',
                                        $nameVariantProduct = NULL,
                                        $priceProduct = '0.11',
                                        $articleProduct = NULL,
                                        $amountProduct = NULL,
                                        $categoryProduct = CreateCategoryOrdersPage::$CrtCatName3ForSearchCategory);
          $I->SearchProductNameSelect($typeCategoryName = CreateCategoryOrdersPage::$CrtCatName3ForSearchOrder, $typeProductName = $nameProduct);
          $I->AddToBascketSelect();
          $I->SearchProductInBascket($name = $nameProduct, $variant = $nameVariantProduct, $Price = $priceProduct, $totalPrice = $priceProduct, $Check = $priceProduct);
          InitTest::ClearAllCach($I);
    }
    /**
     * @group a
     * @guy OrdersTester\OrdersSteps
     */
    public function SearchProductPriceMin2Autocomplit (OrdersTester\OrdersSteps $I){
        $I->wantTo('Verify Check Price Presence.');
        $I->SearchPriceProductAutocomplete($typeName = 'terpinkod 222Producticus2 с 222 знаками', $typePrice = '0.11'); 
    }
    
    
    
    
    
    
    
    
    /**
     * @group a
     * @guy OrdersTester\OrdersSteps
     */
    public function ProductPricePoint2MaxParentCategory (OrdersTester\OrdersSteps $I) {
        $I->wantTo('Verify Presence Price in Second Child Category on Select Menu.');
        $I->createProduct($nameProduct = 'PRDmax 2654 максзнаками',
                                        $nameVariantProduct = NULL,
                                        $priceProduct = '0.99',
                                        $articleProduct = NULL,
                                        $amountProduct = NULL,
                                        $categoryProduct = CreateCategoryOrdersPage::$CrtCatName3ForSearchCategory);
          $I->SearchProductNameSelect($typeCategoryName = CreateCategoryOrdersPage::$CrtCatName3ForSearchOrder, $typeProductName = $nameProduct);
          $I->AddToBascketSelect();
          $I->SearchProductInBascket($name = $nameProduct, $variant = $nameVariantProduct, $Price = $priceProduct, $totalPrice = $priceProduct, $Check = $priceProduct);
          InitTest::ClearAllCach($I);
    }
    /**
     * @group a
     * @guy OrdersTester\OrdersSteps
     */
    public function SearchProductPriceMin3Autocomplit (OrdersTester\OrdersSteps $I){
        $I->wantTo('Verify Check Price Presence.');
        $I->SearchPriceProductAutocomplete($typeName = 'PRDmax 2654 максзнаками', $typePrice = '0.99'); 
    }
    
    
    
    
    
    
    
    
    /**
     * @group a
     * @guy OrdersTester\OrdersSteps
     */
    public function SelectNumber11AfterPoint(OrdersTester\OrdersSteps $I) {
        $I->wantTo('Select The Number Of The Menu Price After The Point');
        $I->SelectNumberAfterPoint($numberAfterPoint = 1);
    }
    /**
     * @group a
     * @guy OrdersTester\OrdersSteps
     */
    public function ProductPrice1AndPointParentCategory (OrdersTester\OrdersSteps $I) {
        $I->wantTo('Verify Presence Price in Second Child Category on Select Menu.');
        $I->amOnPage('/admin/components/run/shop/orders/create');
        $I->createProduct($nameProduct = 'WwWTOvaR55',
                                        $nameVariantProduct = NULL,
                                        $priceProduct = '9878.3',
                                        $articleProduct = NULL,
                                        $amountProduct = NULL,
                                        $categoryProduct = CreateCategoryOrdersPage::$CrtCatName3ForSearchCategory);
          $I->SearchProductNameSelect($typeCategoryName = CreateCategoryOrdersPage::$CrtCatName3ForSearchOrder, $typeProductName = $nameProduct);
          $I->AddToBascketSelect();
          $I->SearchProductInBascket($name = $nameProduct, $variant = $nameVariantProduct, $Price = $priceProduct, $totalPrice = $priceProduct, $Check = $priceProduct);
          InitTest::ClearAllCach($I);
    }
    /**
     * @group a
     * @guy OrdersTester\OrdersSteps
     */
    public function SearchProductPricemin4Autocomplit (OrdersTester\OrdersSteps $I){
        $I->wantTo('Verify Check Price Presence.');
        $I->SearchPriceProductAutocomplete($typeName = 'WwWTOvaR55', $typePrice = '9878.3'); 
    }
    
    
    
    
    
    
       
    
    
    /**
     * @group a
     * @guy OrdersTester\OrdersSteps
     */
    public function SelectNumber111AfterPoint(OrdersTester\OrdersSteps $I) {
        $I->wantTo('Select The Number Of The Menu Price After The Point');
        $I->SelectNumberAfterPoint($numberAfterPoint = 2);
    }
    /**
     * @group a
     * @guy OrdersTester\OrdersSteps
     */
    public function  ProductPrice2AndPointParentCategory (OrdersTester\OrdersSteps $I) {
        $I->wantTo('Verify Presence Price in Second Child Category on Select Menu.');
        $I->createProduct($nameProduct = 'OlOlO integer33 1 и 1 beFore',
                                        $nameVariantProduct = NULL,
                                        $priceProduct = '6543127.86',
                                        $articleProduct = NULL,
                                        $amountProduct = NULL,
                                        $categoryProduct = CreateCategoryOrdersPage::$CrtCatName3ForSearchCategory);
          $I->SearchProductNameSelect($typeCategoryName = CreateCategoryOrdersPage::$CrtCatName3ForSearchOrder, $typeProductName = $nameProduct);
          $I->AddToBascketSelect();
          $I->SearchProductInBascket($name = $nameProduct, $variant = $nameVariantProduct, $Price = $priceProduct, $totalPrice = $priceProduct, $Check = $priceProduct);
          InitTest::ClearAllCach($I);
    }
    /**
     * @group a
     * @guy OrdersTester\OrdersSteps
     */
    public function SearchProductPricemin5Autocomplit (OrdersTester\OrdersSteps $I){
        $I->wantTo('Verify Check Price Presence.');
        $I->SearchPriceProductAutocomplete($typeName = 'OlOlO integer33 1 и 1 beFore', $typePrice = '6543127.86'); 
    }
    
    
    
    
    
    
    
    
    /**
     * @group a
     * @guy OrdersTester\OrdersSteps
     */
    public function ProductPrice3AndPointParentCategory (OrdersTester\OrdersSteps $I) {
        $I->wantTo('Verify Presence Price in Second Child Category on Select Menu.');
        $I->createProduct($nameProduct = 'DESTROY 22second values after point22',
                                        $nameVariantProduct = NULL,
                                        $priceProduct = '99.99',
                                        $articleProduct = NULL,
                                        $amountProduct = NULL,
                                        $categoryProduct = CreateCategoryOrdersPage::$CrtCatName3ForSearchCategory);
          $I->SearchProductNameSelect($typeCategoryName = CreateCategoryOrdersPage::$CrtCatName3ForSearchOrder, $typeProductName = $nameProduct);
          $I->AddToBascketSelect();
          $I->SearchProductInBascket($name = $nameProduct, $variant = $nameVariantProduct, $Price = $priceProduct, $totalPrice = $priceProduct, $Check = $priceProduct);
          InitTest::ClearAllCach($I);
    }
    /**
     * @group a
     * @guy OrdersTester\OrdersSteps
     */
    public function SearchProductPricemin6Autocomplit (OrdersTester\OrdersSteps $I){
        $I->wantTo('Verify Check Price Presence.');
        $I->SearchPriceProductAutocomplete($typeName = 'DESTROY 22second values after point22', $typePrice = '99.99'); 
    }

    
    
    
    
    
    
    
    /**
     * @group a
     * @guy OrdersTester\OrdersSteps
     */
    public function ProductPrice4AndPointParentCategory (OrdersTester\OrdersSteps $I) {
        $I->wantTo('Verify Presence Price in Second Child Category on Select Menu.');
        $I->createProduct($nameProduct = 'Picachu null after null point null',
                                        $nameVariantProduct = NULL,
                                        $priceProduct = '99.00',
                                        $articleProduct = NULL,
                                        $amountProduct = NULL,
                                        $categoryProduct = CreateCategoryOrdersPage::$CrtCatName3ForSearchCategory);
          $I->SearchProductNameSelect($typeCategoryName = CreateCategoryOrdersPage::$CrtCatName3ForSearchOrder, $typeProductName = $nameProduct);
          $I->AddToBascketSelect();
          $I->SearchProductInBascket($name = $nameProduct, $variant = $nameVariantProduct, $Price = $priceProduct, $totalPrice = $priceProduct, $Check = $priceProduct);
          InitTest::ClearAllCach($I);
    }
    /**
     * @group a
     * @guy OrdersTester\OrdersSteps
     */
    public function SearchProductPricemin7Autocomplit (OrdersTester\OrdersSteps $I){
        $I->wantTo('Verify Check Price Presence.');
        $I->SearchPriceProductAutocomplete($typeName = 'Picachu null after null point null', $typePrice = '99.00'); 
    }
    
    
    
    
    
    
    
    
    /**
     * @group a
     * @guy OrdersTester\OrdersSteps
     */
    public function ProductPrice5AndPointParentCategory (OrdersTester\OrdersSteps $I) {
        $I->wantTo('Verify Presence Price in Second Child Category on Select Menu.');
        $I->createProduct($nameProduct = 'SoSiskA maximuzik price в товаре',
                                        $nameVariantProduct = NULL,
                                        $priceProduct = CreateProductsOrdersPage::$CrtPrdPriceMax,//10000000000000
                                        $articleProduct = NULL,
                                        $amountProduct = NULL,
                                        $categoryProduct = CreateCategoryOrdersPage::$CrtCatName3ForSearchCategory);
          $I->SearchProductNameSelect($typeCategoryName = CreateCategoryOrdersPage::$CrtCatName3ForSearchOrder, $typeProductName = $nameProduct);
          $I->AddToBascketSelect();
          $I->SearchProductInBascket($name = $nameProduct, $variant = $nameVariantProduct, $Price = $priceProduct, $totalPrice = $priceProduct, $Check = $priceProduct);
          InitTest::ClearAllCach($I);
    }
    /**
     * @group a
     * @guy OrdersTester\OrdersSteps
     */
    public function SearchProductPricemin8Autocomplit (OrdersTester\OrdersSteps $I){
        $I->wantTo('Verify Check Price Presence.');
        $I->SearchPriceProductAutocomplete($typeName = 'SoSiskA maximuzik price в товаре', $typePrice = '10000000000000'); 
    }
    
    
    
    
    
    
    
    
    /**
     * @group a
     * @guy OrdersTester\OrdersSteps
     */
    public function SelectNumber113AfterPoint(OrdersTester\OrdersSteps $I) {
        $I->wantTo('Select The Number Of The Menu Price After The Point');
        $I->SelectNumberAfterPoint($numberAfterPoint = 2);
    }
    /**
     * @group a
     * @guy OrdersTester\OrdersSteps
     */
    public function ProductPrice6AndPointParentCategory (OrdersTester\OrdersSteps $I) {
        $I->wantTo('Verify Presence Price in Second Child Category on Select Menu.');
        $I->createProduct($nameProduct = 'Moonnigth макс null max прайс',
                                        $nameVariantProduct = NULL,
                                        $priceProduct = '10000000000000.00',
                                        $articleProduct = NULL,
                                        $amountProduct = NULL,
                                        $categoryProduct = CreateCategoryOrdersPage::$CrtCatName3ForSearchCategory);
          $I->SearchProductNameSelect($typeCategoryName = CreateCategoryOrdersPage::$CrtCatName3ForSearchOrder, $typeProductName = $nameProduct);
          $I->AddToBascketSelect();
          $I->SearchProductInBascket($name = $nameProduct, $variant = $nameVariantProduct, $Price = $priceProduct, $totalPrice = $priceProduct, $Check = $priceProduct);
          InitTest::ClearAllCach($I);
    }
    /**
     * @group a
     * @guy OrdersTester\OrdersSteps
     */
    public function SearchProductPricemin9Autocomplit (OrdersTester\OrdersSteps $I){
        $I->wantTo('Verify Check Price Presence.');
        $I->SearchPriceProductAutocomplete($typeName = 'Moonnigth макс null max прайс', $typePrice = '10000000000000.00'); 
    }
    
    

    
    
    
    
    
    /**
     * @group a
     * @guy OrdersTester\OrdersSteps
     */
    public function SelectNumber114AfterPoint(OrdersTester\OrdersSteps $I) {
        $I->wantTo('Select The Number Of The Menu Price After The Point');
        $I->SelectNumberAfterPoint($numberAfterPoint = 5);
    }
    /**
     * @group a
     * @guy OrdersTester\OrdersSteps
     */
    public function ProductPrice7AndPointParentCategory (OrdersTester\OrdersSteps $I) {
        $I->wantTo('Verify Presence Price in Second Child Category on Select Menu.');
        $I->createProduct($nameProduct = 'JJJJJ нули по фулу after pointsesis',
                                        $nameVariantProduct = NULL,
                                        $priceProduct = '1000000000000000.99999',
                                        $articleProduct = NULL,
                                        $amountProduct = NULL,
                                        $categoryProduct = CreateCategoryOrdersPage::$CrtCatName3ForSearchCategory);
          $I->SearchProductNameSelect($typeCategoryName = CreateCategoryOrdersPage::$CrtCatName3ForSearchOrder, $typeProductName = $nameProduct);
          $I->AddToBascketSelect();
          $I->SearchProductInBascket($name = $nameProduct, $variant = $nameVariantProduct, $Price = '1000000000000000.00', $totalPrice = '1000000000000000.00', $Check = '1000000000000000.00');
          InitTest::ClearAllCach($I);
    }
    /**
     * @group a
     * @guy OrdersTester\OrdersSteps
     */
    public function SearchProductPricemin10Autocomplit (OrdersTester\OrdersSteps $I){
        $I->wantTo('Verify Check Price Presence.');
        $I->SearchPriceProductAutocomplete($typeName = 'JJJJJ нули по фулу after pointsesis', $typePrice = '1000000000000000.00'); 
    }

    
    
    /**
     * @group a
     * @guy OrdersTester\OrdersSteps
     */
    public function DeletePriceProductInCategory (OrdersTester\OrdersSteps $I){
        $I->DeleteProductInCategory($CategoryWithProduct = CreateCategoryOrdersPage::$CrtCatName3ForSearchOrder);
    }
}

