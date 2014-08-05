<?php
use \OrdersTester;
class TextElementOLCest
{
//---------------------------AUTORIZATION--------------------------------------- 
    /**
     * @group a
     */
    public function Login(OrdersTester $I){
        InitTest::Login($I);
    }    
    
    
 //-------Verify Presence Create Category and Product in Select Menu-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------  
 //______________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________
// 
//    
//    
//    
//    
//    
//    
        ///---///----Tests For Category Product---///---///---///---///---///
    
    /**
     * @group a
     * @guy OrdersTester\OrdersSteps
     */
    public function ParentCategory (OrdersTester\OrdersSteps $I) {
        $I->wantTo('Verify Presence Parent Category on Select Menu.');
        $I->createCategoryProduct(CreateCategoryOrdersPage::$CrtCatName1);
        $I->SearchCategorySelect(CreateCategoryOrdersPage::$CrtCatName1ForSearch);
        $I->see('', CreateOrderAdminPage::$CrtZMenuProduct);
        $I->see('', CreateOrderAdminPage::$CrtZMenuVariant);
        
    } 
    
     /**
     * @group a
     * @guy OrdersTester\OrdersSteps
     */
    public function ChildCategoryFirstLevel (OrdersTester\OrdersSteps $I) {
        $I->wantTo('Verify Presence Child Category Firs Level on Select Menu.');
        $I->createCategoryProduct(CreateCategoryOrdersPage::$CrtCatName2, CreateCategoryOrdersPage::$CrtCatName1ForSearch);
        $I->SearchCategorySelect(CreateCategoryOrdersPage::$CrtCatName2ForSearchOrder);
        $I->see('', CreateOrderAdminPage::$CrtZMenuProduct);
        $I->see('', CreateOrderAdminPage::$CrtZMenuVariant);
    }
    
    /**
     * @group a
     * @guy OrdersTester\OrdersSteps
     */
    public function ChildCategorySecondLevel(OrdersTester\OrdersSteps $I) {
        $I->wantTo('Verify Presence Child Category Second Level on Select Menu.');
        $I->createCategoryProduct(CreateCategoryOrdersPage::$CrtCatName3, CreateCategoryOrdersPage::$CrtCatName2ForSearchOrder);
        $I->SearchCategorySelect(CreateCategoryOrdersPage::$CrtCatName3ForSearchOrder);
        $I->see('', CreateOrderAdminPage::$CrtZMenuProduct);
        $I->see('', CreateOrderAdminPage::$CrtZMenuVariant);
    }
//    
//    
//    
//    
//    
//    
//    
//    
//    
//    
        ///---///----Tests For Name Product---///---///---///---///---///
    
    /**
     * @group a
     * @guy OrdersTester\OrdersSteps
     */
    public function ProductNemaMinParentCategory (OrdersTester\OrdersSteps $I) {
        $I->wantTo('Verify Presence Product Name and Price Max in Parent Category on Select Menu.');
        $I->createProduct($nameProduct = 'X',
                                        $nameVariantProduct = NULL ,
                                        $priceProduct = '1',
                                        $articleProduct = NULL,
                                        $amountProduct = NULL,
                                        $categoryProduct = CreateCategoryOrdersPage::$CrtCatName1ForSearch);
          $I->SearchProductNameSelect($typeCategoryName = CreateCategoryOrdersPage::$CrtCatName1ForSearch, $typeProductName = $nameProduct);
          $I->AddToBascketSelect();
          $I->SearchProductInBascket($name = $nameProduct, $variant = $nameVariantProduct, $Price = $priceProduct, $totalPrice = $priceProduct, $Check = $priceProduct);
          InitTest::ClearAllCach($I);
    }
    
    
    
    /**
     * @group a
     * @guy OrdersTester\OrdersSteps
     */
    public function ProductNemaLatinSmallParentCategory (OrdersTester\OrdersSteps $I) {
        $I->wantTo('Verify Presence Product Latin Small Name in Parent Category on Select Menu.');
        $I->createProduct($nameProduct = 'abcdefghijklmnopqrstuvwxyz',
                                        $nameVariantProduct = NULL ,
                                        $priceProduct = '1',
                                        $articleProduct = NULL,
                                        $amountProduct = NULL,
                                        $categoryProduct = CreateCategoryOrdersPage::$CrtCatName1ForSearch);
          $I->SearchProductNameSelect($typeCategoryName = CreateCategoryOrdersPage::$CrtCatName1ForSearch, $typeProductName = $nameProduct);
          $I->AddToBascketSelect();
          $I->SearchProductInBascket($name = $nameProduct, $variant = $nameVariantProduct, $Price = $priceProduct, $totalPrice = $priceProduct, $Check = $priceProduct);
          InitTest::ClearAllCach($I);
    }
    
    /**
     * @group a
     * @guy OrdersTester\OrdersSteps
     */
    public function ProductNemaLatinBigParentCategory (OrdersTester\OrdersSteps $I) {
        $I->wantTo('Verify Presence Product Latin Big Name in Parent Category on Select Menu.');
        $I->createProduct($nameProduct = 'MNOPQRSTUVWXYZABCDEFGHIJKL',
                                        $nameVariantProduct = NULL ,
                                        $priceProduct = '1',
                                        $articleProduct = NULL,
                                        $amountProduct = NULL,
                                        $categoryProduct = CreateCategoryOrdersPage::$CrtCatName1ForSearch);
          $I->SearchProductNameSelect($typeCategoryName = CreateCategoryOrdersPage::$CrtCatName1ForSearch, $typeProductName = $nameProduct);
          $I->AddToBascketSelect();
          $I->SearchProductInBascket($name = $nameProduct, $variant = $nameVariantProduct, $Price = $priceProduct, $totalPrice = $priceProduct, $Check = $priceProduct);
          InitTest::ClearAllCach($I);
    }
    
    
    /**
     * @group a
     * @guy OrdersTester\OrdersSteps
     */
    public function ProductNemaCillicSmallParentCategory (OrdersTester\OrdersSteps $I) {
        $I->wantTo('Verify Presence Product Cirillic Small Name in Parent Category on Select Menu.');
        $I->createProduct($nameProduct = 'абвгдеёжзийклмнопрстуфхцчшщьыъэюяїєі',
                                        $nameVariantProduct = NULL ,
                                        $priceProduct = '1',
                                        $articleProduct = NULL,
                                        $amountProduct = NULL,
                                        $categoryProduct = CreateCategoryOrdersPage::$CrtCatName1ForSearch);
          $I->SearchProductNameSelect($typeCategoryName = CreateCategoryOrdersPage::$CrtCatName1ForSearch, $typeProductName = $nameProduct);
          $I->AddToBascketSelect();
          $I->SearchProductInBascket($name = $nameProduct, $variant = $nameVariantProduct, $Price = $priceProduct, $totalPrice = $priceProduct, $Check = $priceProduct);
          InitTest::ClearAllCach($I);
    }
    
    
    /**
     * @group a
     * @guy OrdersTester\OrdersSteps
     */
    public function ProductNemaCillicBigParentCategory (OrdersTester\OrdersSteps $I) {
        $I->wantTo('Verify Presence Product Cirillic Big Name in Parent Category on Select Menu.');
        $I->createProduct($nameProduct = 'РСТУФХЦЧШЩЬЫЪЭЮЯЇЄІАБВГДЕЁЖЗИЙКЛМНОП',
                                        $nameVariantProduct = NULL ,
                                        $priceProduct = '1',
                                        $articleProduct = NULL,
                                        $amountProduct = NULL,
                                        $categoryProduct = CreateCategoryOrdersPage::$CrtCatName1ForSearch);
          $I->SearchProductNameSelect($typeCategoryName = CreateCategoryOrdersPage::$CrtCatName1ForSearch, $typeProductName = $nameProduct);
          $I->AddToBascketSelect();
          $I->SearchProductInBascket($name = $nameProduct, $variant = $nameVariantProduct, $Price = $priceProduct, $totalPrice = $priceProduct, $Check = $priceProduct);
          InitTest::ClearAllCach($I);
    }
    
    
    /**
     * @group a
     * @guy OrdersTester\OrdersSteps
     */
    public function ProductNemaNumeralParentCategory (OrdersTester\OrdersSteps $I) {
        $I->wantTo('Verify Presence Product Numeral Name in Parent Category on Select Menu.');
        $I->createProduct($nameProduct = '1 2 3 4 5 6 7 8 9 0',
                                        $nameVariantProduct = NULL ,
                                        $priceProduct = '1',
                                        $articleProduct = NULL,
                                        $amountProduct = NULL,
                                        $categoryProduct = CreateCategoryOrdersPage::$CrtCatName1ForSearch);
          $I->SearchProductNameSelect($typeCategoryName = CreateCategoryOrdersPage::$CrtCatName1ForSearch, $typeProductName = $nameProduct);
          $I->AddToBascketSelect();
          $I->SearchProductInBascket($name = $nameProduct, $variant = $nameVariantProduct, $Price = $priceProduct, $totalPrice = $priceProduct, $Check = $priceProduct);
          InitTest::ClearAllCach($I);
    }
    
    
    
    /**
     * @group a
     * @guy OrdersTester\OrdersSteps
     */
    public function ProductNemaSymbolParentCategory (OrdersTester\OrdersSteps $I) {
        $I->wantTo('Verify Presence Product Symbol Name in Parent Category on Select Menu.');
        $I->createProduct($nameProduct = '¿←↑→↓ƒ∞√±≥≤><−⁄÷×–—‚>@!?%<&€¦§¨«»¯*№{}[])(^:|\~;',
                                        $nameVariantProduct = NULL ,
                                        $priceProduct = '1',
                                        $articleProduct = NULL,
                                        $amountProduct = NULL,
                                        $categoryProduct = CreateCategoryOrdersPage::$CrtCatName1ForSearch);
          $I->SearchProductNameSelect($typeCategoryName = CreateCategoryOrdersPage::$CrtCatName1ForSearch, $typeProductName = $nameProduct);
          $I->AddToBascketSelect();
          $I->SearchProductInBascket($name = $nameProduct, $variant = $nameVariantProduct, $Price = $priceProduct, $totalPrice = $priceProduct, $Check = $priceProduct);
          InitTest::ClearAllCach($I);
    }
//    
//    
//    
//    
//    
//    
//    
//    
//    
//    
//    
        ///---///----Tests For Variant Product---///---///---///---///---///
    
    /**
     * @group a
     * @guy OrdersTester\OrdersSteps
     */
    public function ProductVariantMinParentCategory (OrdersTester\OrdersSteps $I) {
        $I->wantTo('Verify Presence Variant Min in First Child Category on Select Menu.');
        $I->createProduct($nameProduct = 'Товар с минимальним названием варианта',
                                        $nameVariantProduct = 'x' ,
                                        $priceProduct = '1',
                                        $articleProduct = NULL,
                                        $amountProduct = NULL,
                                        $categoryProduct = CreateCategoryOrdersPage::$CrtCatName2ForSearchCategory);
          $I->SearchProductNameSelect($typeCategoryName = CreateCategoryOrdersPage::$CrtCatName2ForSearchOrder, $typeProductName = $nameProduct);
          $I->AddToBascketSelect();
          $I->SearchProductInBascket($name = $nameProduct, $variant = $nameVariantProduct, $Price = $priceProduct, $totalPrice = $priceProduct, $Check = $priceProduct);
          InitTest::ClearAllCach($I);
    }
    
    
    
    /**
     * @group a
     * @guy OrdersTester\OrdersSteps
     */
    public function ProductVariantLatinSmallParentCategory (OrdersTester\OrdersSteps $I) {
        $I->wantTo('Verify Presence Variant Latin Small in First Child Category on Select Menu.');
        $I->createProduct($nameProduct = 'Товар с мал.сим.лат. в названии варианта',
                                        $nameVariantProduct = 'abcdefghijklmnopqrstuvwxyz',
                                        $priceProduct = '1',
                                        $articleProduct = NULL,
                                        $amountProduct = NULL,
                                        $categoryProduct = CreateCategoryOrdersPage::$CrtCatName2ForSearchCategory);
          $I->SearchProductNameSelect($typeCategoryName = CreateCategoryOrdersPage::$CrtCatName2ForSearchOrder, $typeProductName = $nameProduct);
          $I->AddToBascketSelect();
          $I->SearchProductInBascket($name = $nameProduct, $variant = $nameVariantProduct, $Price = $priceProduct, $totalPrice = $priceProduct, $Check = $priceProduct);
          InitTest::ClearAllCach($I);
    }
    
    
    /**
     * @group a
     * @guy OrdersTester\OrdersSteps
     */
    public function ProductVariantLatinBigParentCategory (OrdersTester\OrdersSteps $I) {
        $I->wantTo('Verify Presence Variant Latin Big in First Child Category on Select Menu.');
        $I->createProduct($nameProduct = 'Товар с вел.сим.лат. в названии варианта',
                                        $nameVariantProduct = 'NOPQRSTUVWXYZABCDEFGHIJKLM',
                                        $priceProduct = '1',
                                        $articleProduct = NULL,
                                        $amountProduct = NULL,
                                        $categoryProduct = CreateCategoryOrdersPage::$CrtCatName2ForSearchCategory);
          $I->SearchProductNameSelect($typeCategoryName = CreateCategoryOrdersPage::$CrtCatName2ForSearchOrder, $typeProductName = $nameProduct);
          $I->AddToBascketSelect();
          $I->SearchProductInBascket($name = $nameProduct, $variant = $nameVariantProduct, $Price = $priceProduct, $totalPrice = $priceProduct, $Check = $priceProduct);
          InitTest::ClearAllCach($I);
    }
    
    
    
    /**
     * @group a
     * @guy OrdersTester\OrdersSteps
     */
    public function ProductVariantCirillicSmallParentCategory (OrdersTester\OrdersSteps $I) {
        $I->wantTo('Verify Presence Variant Cirillic Small in First Child Category on Select Menu.');
        $I->createProduct($nameProduct = 'Товар с мал.сим.кир. в названии варианта',
                                        $nameVariantProduct = 'абвгдеёжзийклмнопрстуфхцчшщьыъэюяїєі',
                                        $priceProduct = '1',
                                        $articleProduct = NULL,
                                        $amountProduct = NULL,
                                        $categoryProduct = CreateCategoryOrdersPage::$CrtCatName2ForSearchCategory);
          $I->SearchProductNameSelect($typeCategoryName = CreateCategoryOrdersPage::$CrtCatName2ForSearchOrder, $typeProductName = $nameProduct);
          $I->AddToBascketSelect();
          $I->SearchProductInBascket($name = $nameProduct, $variant = $nameVariantProduct, $Price = $priceProduct, $totalPrice = $priceProduct, $Check = $priceProduct);
          InitTest::ClearAllCach($I);
    }
    
    
    
    /**
     * @group a
     * @guy OrdersTester\OrdersSteps
     */
    public function ProductVariantCirilliBigParentCategory (OrdersTester\OrdersSteps $I) {
        $I->wantTo('Verify Presence Variant Cirillic Big in First Child Category on Select Menu.');
        $I->createProduct($nameProduct = 'Товар с вел.сим.кир. в названии варианта',
                                        $nameVariantProduct = 'СТУФХЦЧШЩЬЫЪЭЮЯЇЄІАБВГДЕЁЖЗИЙКЛМНОПР',
                                        $priceProduct = '1',
                                        $articleProduct = NULL,
                                        $amountProduct = NULL,
                                        $categoryProduct = CreateCategoryOrdersPage::$CrtCatName2ForSearchCategory);
          $I->SearchProductNameSelect($typeCategoryName = CreateCategoryOrdersPage::$CrtCatName2ForSearchOrder, $typeProductName = $nameProduct);
          $I->AddToBascketSelect();
          $I->SearchProductInBascket($name = $nameProduct, $variant = $nameVariantProduct, $Price = $priceProduct, $totalPrice = $priceProduct, $Check = $priceProduct);
          InitTest::ClearAllCach($I);
    }
    
    
    /**
     * @group a
     * @guy OrdersTester\OrdersSteps
     */
    public function ProductVariantNumeralParentCategory (OrdersTester\OrdersSteps $I) {
        $I->wantTo('Verify Presence Variant Numeral in First Child Category on Select Menu.');
        $I->createProduct($nameProduct = 'Товар с цифрами в названии варианта',
                                        $nameVariantProduct = '1 2 3 4 5 6 7 8 9 0',
                                        $priceProduct = '1',
                                        $articleProduct = NULL,
                                        $amountProduct = NULL,
                                        $categoryProduct = CreateCategoryOrdersPage::$CrtCatName2ForSearchCategory);
          $I->SearchProductNameSelect($typeCategoryName = CreateCategoryOrdersPage::$CrtCatName2ForSearchOrder, $typeProductName = $nameProduct);
          $I->AddToBascketSelect();
          $I->SearchProductInBascket($name = $nameProduct, $variant = $nameVariantProduct, $Price = $priceProduct, $totalPrice = $priceProduct, $Check = $priceProduct);
          InitTest::ClearAllCach($I);
    }
    
    
    /**
     * @group a
     * @guy OrdersTester\OrdersSteps
     */
    public function ProductVariantSymbolParentCategory (OrdersTester\OrdersSteps $I) {
        $I->wantTo('Verify Presence Variant Symbol in First Child Category on Select Menu.');
        $I->createProduct($nameProduct = 'Товар с спец символами в названии варианта',
                                        $nameVariantProduct = '¿←↑→↓ƒ∞√±≥≤><−⁄÷×–—‚>@!?%<&€¦§¨«»¯*№{}[])(^:|\~;',
                                        $priceProduct = '1',
                                        $articleProduct = NULL,
                                        $amountProduct = NULL,
                                        $categoryProduct = CreateCategoryOrdersPage::$CrtCatName2ForSearchCategory);
          $I->SearchProductNameSelect($typeCategoryName = CreateCategoryOrdersPage::$CrtCatName2ForSearchOrder, $typeProductName = $nameProduct);
          $I->AddToBascketSelect();
          $I->SearchProductInBascket($name = $nameProduct, $variant = $nameVariantProduct, $Price = $priceProduct, $totalPrice = $priceProduct, $Check = $priceProduct);
          InitTest::ClearAllCach($I);
    }
    
    
    
    /**
     * @group a
     * @guy OrdersTester\OrdersSteps
     */
    public function ProductPriceMinParentCategory (OrdersTester\OrdersSteps $I) {
        $I->wantTo('Verify Presence Price Null in Second Child Category on Select Menu.');
        $I->createProduct($nameProduct = 'Товар с нулевой ценой.',
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
    public function ProductPricePoint1ParentCategory (OrdersTester\OrdersSteps $I) {
        $I->wantTo('Verify Presence Price in Second Child Category on Select Menu.');
        $I->createProduct($nameProduct = 'Товар с 1 знаком после точки в цене.',
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
    public function ProductPricePoint2ParentCategory (OrdersTester\OrdersSteps $I) {
        $I->wantTo('Verify Presence Price in Second Child Category on Select Menu.');
        $I->createProduct($nameProduct = 'Товар с 2 знаками после точки в цене.',
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
    public function ProductPricePoint2MaxParentCategory (OrdersTester\OrdersSteps $I) {
        $I->wantTo('Verify Presence Price in Second Child Category on Select Menu.');
        $I->createProduct($nameProduct = 'Товар с 2 макс.знаками после точки в цене.',
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
    public function ProductPrice1AndPointParentCategory (OrdersTester\OrdersSteps $I) {
        $I->wantTo('Verify Presence Price in Second Child Category on Select Menu.');
        $I->createProduct($nameProduct = 'Товар с 1 целым и 1 числом после точки в цене.',
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
    public function ProductPrice2AndPointParentCategory (OrdersTester\OrdersSteps $I) {
        $I->wantTo('Verify Presence Price in Second Child Category on Select Menu.');
        $I->createProduct($nameProduct = 'Товар с 1 целым и 2 числами после точки в цене.',
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
    public function ProductPrice3AndPointParentCategory (OrdersTester\OrdersSteps $I) {
        $I->wantTo('Verify Presence Price in Second Child Category on Select Menu.');
        $I->createProduct($nameProduct = 'Товар с 1 целым и 2 макс.числами после точки в цене.',
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
    public function ProductPrice4AndPointParentCategory (OrdersTester\OrdersSteps $I) {
        $I->wantTo('Verify Presence Price in Second Child Category on Select Menu.');
        $I->createProduct($nameProduct = 'Товар с 1 целым и 2 нулевими числами после точки в цене.',
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
    public function ProductPrice5AndPointParentCategory (OrdersTester\OrdersSteps $I) {
        $I->wantTo('Verify Presence Price in Second Child Category on Select Menu.');
        $I->createProduct($nameProduct = 'Товар с макс.значением цены.',
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
    public function ProductPrice6AndPointParentCategory (OrdersTester\OrdersSteps $I) {
        $I->wantTo('Verify Presence Price in Second Child Category on Select Menu.');
        $I->createProduct($nameProduct = 'Товар с макс.значением цены и с нулями после точки.',
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
    public function ProductPrice7AndPointParentCategory (OrdersTester\OrdersSteps $I) {
        $I->wantTo('Verify Presence Price in Second Child Category on Select Menu.');
        $I->createProduct($nameProduct = 'Товар с макс.значением цены и с макс.знач. после точки.',
                                        $nameVariantProduct = NULL,
                                        $priceProduct = '10000000000000.99',
                                        $articleProduct = NULL,
                                        $amountProduct = NULL,
                                        $categoryProduct = CreateCategoryOrdersPage::$CrtCatName3ForSearchCategory);
          $I->SearchProductNameSelect($typeCategoryName = CreateCategoryOrdersPage::$CrtCatName3ForSearchOrder, $typeProductName = $nameProduct);
          $I->AddToBascketSelect();
          $I->SearchProductInBascket($name = $nameProduct, $variant = $nameVariantProduct, $Price = $priceProduct, $totalPrice = $priceProduct, $Check = $priceProduct);
          InitTest::ClearAllCach($I);
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    /**
     * @group q
     * @guy OrdersTester\OrdersSteps
     */
    public function ProductMinParentCategory (OrdersTester\OrdersSteps $I) {
        $I->wantTo('Verify Presence Product Name and Price Min in Parent Category on Select Menu.');
        $I->createProduct($nameProduct = CreateProductsOrdersPage::$CrtPrdNameMin,
                                        $nameVariantProduct = NULL ,
                                        $priceProduct = CreateProductsOrdersPage::$CrtPrdPriceMin,
                                        $articleProduct = NULL,
                                        $amountProduct = NULL,
                                        $categoryProduct = CreateCategoryOrdersPage::$CrtCatName1ForSearch);
        $I->SearchCategorySelect(CreateCategoryOrdersPage::$CrtCatName1ForSearch);
        $I->see(CreateProductsOrdersPage::$CrtPrdNameMin, CreateOrderAdminPage::$CrtZMenuProduct);
        $I->click(CreateOrderAdminPage::$CrtZMenuProductRowOne);
        $I->wait('1');
        $I->see($priceProduct, CreateOrderAdminPage::$CrtZMenuVariant);
        
    }
    
    /**
     * @group q
     * @guy OrdersTester\OrdersSteps
     */
    public function ProductPrice01ParentCategory (OrdersTester\OrdersSteps $I) {
        $I->wantTo('Verify Presence Product Name and Price Max in Parent Category on Select Menu.');
        $I->createProduct($nameProduct = 'Тестовы товар для проверки максикова значения после точки.',
                                        $nameVariantProduct = 'WertW' ,
                                        $priceProduct = '1.1',
                                        $articleProduct = NULL,
                                        $amountProduct = NULL,
                                        $categoryProduct = CreateCategoryOrdersPage::$CrtCatName1ForSearch);
          $I->SearchProductNameSelect($typeCategoryName = CreateCategoryOrdersPage::$CrtCatName1ForSearch, $typeProductName = $nameProduct);
          $I->SearchProductVariantandPriceSelect($typeVariantName = $nameVariantProduct, $typeVariantPrice = $priceProduct);
          $I->AddToBascketSelect();
          $I->SearchProductInBascket($name = $nameProduct, $variant = $nameVariantProduct, $Price = $priceProduct, $totalPrice = $priceProduct, $Check = $priceProduct);
          $I->wait('5');
        
    }
    
    /**
     * @group q
     * @guy OrdersTester\OrdersSteps
     */
    public function ProductPrice02ParentCategory (OrdersTester\OrdersSteps $I) {
        $I->wantTo('Verify Presence Product Name and Price Max in Parent Category on Select Menu.');
        $I->createProduct($nameProduct = 'Тестовы товар для проверки 1 значения после точки.',
                                        $nameVariantProduct = NULL ,
                                        $priceProduct = '1.1',
                                        $articleProduct = NULL,
                                        $amountProduct = NULL,
                                        $categoryProduct = CreateCategoryOrdersPage::$CrtCatName1ForSearch);
          $I->SearchProductNameSelect($typeCategoryName = CreateCategoryOrdersPage::$CrtCatName1ForSearch, $typeProductName = $nameProduct);
          $I->SearchProductVariantandPriceSelect($typeVariantName = NULL, $typeVariantPrice = $priceProduct);
    }
    
    
    
    
    
    
    
    
    
    
   
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}

