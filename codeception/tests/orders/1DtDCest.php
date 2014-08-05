<?php
use \OrdersTester;
class DtDCest
{
//---------------------------AUTORIZATION--------------------------------------- 
    /**
     * @group x
     */
    public function Login(OrdersTester $I){
        InitTest::Login($I);
    }    
    
    
     
    
    
    
    
    ///---///---Tests For Category Product in Select------------------------------------------------------------------------------------------------------------------------------------------
    
    
    
    
    /**
     * @group a
     * @guy OrdersTester\OrdersSteps
     */
    public function ParentCategory (OrdersTester\OrdersSteps $I) {
        $I->wantTo('Verify Presence Parent Category on Select Menu.');
        $I->createCategoryProduct(CreateCategoryOrdersPage::$CrtCatName1);
        $I->SearchCategorySelect(CreateCategoryOrdersPage::$CrtCatName1ForSearch);
    } 
    
    
    
    
    
    
    
     /**
     * @group a
     * @guy OrdersTester\OrdersSteps
     */
    public function ChildCategoryFirstLevel (OrdersTester\OrdersSteps $I) {
        $I->wantTo('Verify Presence Child Category Firs Level on Select Menu.');
        $I->createCategoryProduct(CreateCategoryOrdersPage::$CrtCatName2, CreateCategoryOrdersPage::$CrtCatName1ForSearch);
        $I->SearchCategorySelect(CreateCategoryOrdersPage::$CrtCatName2ForSearchOrder);
    }
    
    
    
    
    
    
    
    /**
     * @group a
     * @guy OrdersTester\OrdersSteps
     */
    public function ChildCategorySecondLevel(OrdersTester\OrdersSteps $I) {
        $I->wantTo('Verify Presence Child Category Second Level on Select Menu.');
        $I->createCategoryProduct(CreateCategoryOrdersPage::$CrtCatName3, CreateCategoryOrdersPage::$CrtCatName2ForSearchOrder);
        $I->SearchCategorySelect(CreateCategoryOrdersPage::$CrtCatName3ForSearchOrder);
    }
    
    
    
    
    
    
    
    
    
    
    
    ///---///----Tests For Name Product----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    
    
    
    
    

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
    public function SearchProductNameLatSmallAutocomplit (OrdersTester\OrdersSteps $I){
        $I->SearchNameProductaAutocomplete($typeName = "abcdefghijklmnopqrstuvwxyz");
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
    public function SearchProductNameLatBigAutocomplit (OrdersTester\OrdersSteps $I){
        $I->SearchNameProductaAutocomplete($typeName = "MNOPQRSTUVWXYZABCDEFGHIJKL");
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
    public function SearchProductNameCirilicSmallAutocomplit (OrdersTester\OrdersSteps $I){
        $I->SearchNameProductaAutocomplete($typeName = "абвгдеёжзийклмнопрстуфхцчшщьыъэюяїєі");
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
    public function SearchProductNameBiigSmallAutocomplit (OrdersTester\OrdersSteps $I){
        $I->SearchNameProductaAutocomplete($typeName = "РСТУФХЦЧШЩЬЫЪЭЮЯЇЄІАБВГДЕЁЖЗИЙКЛМНОП");
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
    public function SearchProductNameNumeralAutocomplit (OrdersTester\OrdersSteps $I){
        $I->SearchNameProductaAutocomplete($typeName = "1 2 3 4 5 6 7 8 9 0");
    }
    
    
    
    
    
    
    
    
    /**
     * @group a
     * @guy OrdersTester\OrdersSteps
     */
    public function ProductNemaSymbolParentCategory (OrdersTester\OrdersSteps $I) {
        $I->wantTo('Verify Presence Product Symbol Name in Parent Category on Select Menu.');
        $I->createProduct($nameProduct = "¿←↑→↓ƒ∞√±≥≤><−⁄÷×–—‚>@!?%<&€¦§¨«»¯*№{}[])(^:|",
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
    public function SearchProductNameSymbolAutocomplit (OrdersTester\OrdersSteps $I){
        $I->SearchNameProductaAutocomplete($typeName = "¿←↑→↓ƒ∞√±≥≤><−⁄÷×–");
    }
    
    
    
    
    
    
    
    
    
    
   
    ///---///----Tests For Variant Product--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    
    
    
    
    
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
    public function SearchProductVarianMinAutocomplit (OrdersTester\OrdersSteps $I){
        $I->SearchVariantProductAutocomplete($productName = 'Товар с минимальним названием варианта', $variantName = 'x'); 
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
    public function SearchProductVarianLatinSmallAutocomplit (OrdersTester\OrdersSteps $I){
        $I->SearchVariantProductAutocomplete($productName = 'Товар с мал.сим.лат. в названии варианта', $variantName = 'abcdefghijklmnopqrstuvwxyz'); 
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
    public function SearchProductVarianLatinBigAutocomplit (OrdersTester\OrdersSteps $I){
        $I->SearchVariantProductAutocomplete($productName = 'Товар с вел.сим.лат. в названии варианта', $variantName = 'NOPQRSTUVWXYZABCDEFGHIJKLM'); 
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
    public function SearchProductVarianCirilicSmallAutocomplit (OrdersTester\OrdersSteps $I){
        $I->SearchVariantProductAutocomplete($productName = 'Товар с мал.сим.кир. в названии варианта', $variantName = 'абвгдеёжзийклмнопрстуфхцчшщьыъэюяїєі'); 
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
    public function SearchProductVarianCirilicBigAutocomplit (OrdersTester\OrdersSteps $I){
        $I->SearchVariantProductAutocomplete($productName = 'Товар с вел.сим.кир. в названии варианта', $variantName = 'СТУФХЦЧШЩЬЫЪЭЮЯЇЄІАБВГДЕЁЖЗИЙКЛМНОПР'); 
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
    public function SearchProductVarianNumeralAutocomplit (OrdersTester\OrdersSteps $I){
        $I->SearchVariantProductAutocomplete($productName = 'Товар с цифрами в названии варианта', $variantName = '1 2 3 4 5 6 7 8 9 0'); 
    }
    
    
    
    
    
    
    
    
//    /**
//     * @group x
//     * @guy OrdersTester\OrdersSteps
//     */
//    public function ProductVariantSymbolParentCategory (OrdersTester\OrdersSteps $I) {
//        $I->wantTo('Verify Presence Variant Symbol in First Child Category on Select Menu.');
//        $I->createProduct($nameProduct = 'Товар с спец символами в названии варианта',
//                                        $nameVariantProduct = '`!@#$%^&*|}{.,',
//                                        $priceProduct = '1',
//                                        $articleProduct = NULL,
//                                        $amountProduct = NULL,
//                                        $categoryProduct = CreateCategoryOrdersPage::$CrtCatName2ForSearchCategory);
//          $I->SearchProductNameSelect($typeCategoryName = CreateCategoryOrdersPage::$CrtCatName2ForSearchOrder, $typeProductName = $nameProduct);
//          $I->AddToBascketSelect();
//          $I->SearchProductInBascket($name = $nameProduct, $variant = $nameVariantProduct, $Price = $priceProduct, $totalPrice = $priceProduct, $Check = $priceProduct);
//          InitTest::ClearAllCach($I);
//    }
//    /**
//     * @group x
//     * @guy OrdersTester\OrdersSteps
//     */
//    public function SearchProductVarianSymbolAutocomplit (OrdersTester\OrdersSteps $I){
//        $I->SearchVariantProductAutocomplete($productName = 'Товар с спец символами в названии варианта', $variantName = '`!@#$%^&*|}{.,'); 
//    }
    
    
    
    
    
    
    
    
    
    
    ///---///----Tests For Price Product-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    
    
    
    
    
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
    public function SearchProductPriceNullAutocomplit (OrdersTester\OrdersSteps $I){
        $I->SearchPriceProductAutocomplete($typeName = 'Товар с нулевой ценой.', $typePrice = '0'); 
    }
    
    
    
    
    
    
    
    
    /**
     * @group a
     * @guy OrdersTester\OrdersSteps
     */
    public function SelectNumber1AfterPoint(OrdersTester\OrdersSteps $I) {
        $I->SelectNumberAfterPoint($numberAfterPoint = 1);
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
    public function SearchProductPriceMin1Autocomplit (OrdersTester\OrdersSteps $I){
        $I->SearchPriceProductAutocomplete($typeName = 'Товар с 1 знаком после точки в цене.', $typePrice = '0.1'); 
    }
    
    
    
    
    
    
    
    
    /**
     * @group a
     * @guy OrdersTester\OrdersSteps
     */
    public function SelectNumber2AfterPoint(OrdersTester\OrdersSteps $I) {
        $I->SelectNumberAfterPoint($numberAfterPoint = 2);
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
    public function SearchProductPriceMin2Autocomplit (OrdersTester\OrdersSteps $I){
        $I->SearchPriceProductAutocomplete($typeName = 'Товар с 2 знаками после точки в цене.', $typePrice = '0.11'); 
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
    public function SearchProductPriceMin3Autocomplit (OrdersTester\OrdersSteps $I){
        $I->SearchPriceProductAutocomplete($typeName = 'Товар с 2 знаками после точки в цене.', $typePrice = '0.11'); 
    }
    
    
    
    
    
    
    
    
    /**
     * @group a
     * @guy OrdersTester\OrdersSteps
     */
    public function SelectNumber11AfterPoint(OrdersTester\OrdersSteps $I) {
        $I->SelectNumberAfterPoint($numberAfterPoint = 1);
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
    public function SearchProductPricemin4Autocomplit (OrdersTester\OrdersSteps $I){
        $I->SearchPriceProductAutocomplete($typeName = 'Товар с 1 целым и 1 числом после точки в цене.', $typePrice = '9878.3'); 
    }
    
    
    
    
    
    
       
    
    
    /**
     * @group a
     * @guy OrdersTester\OrdersSteps
     */
    public function SelectNumber111AfterPoint(OrdersTester\OrdersSteps $I) {
        $I->SelectNumberAfterPoint($numberAfterPoint = 2);
    }
    /**
     * @group a
     * @guy OrdersTester\OrdersSteps
     */
    public function  ProductPrice2AndPointParentCategory (OrdersTester\OrdersSteps $I) {
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
    public function SearchProductPricemin5Autocomplit (OrdersTester\OrdersSteps $I){
        $I->SearchPriceProductAutocomplete($typeName = 'Товар с 1 целым и 2 числами после точки в цене.', $typePrice = '6543127.86'); 
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
    public function SearchProductPricemin6Autocomplit (OrdersTester\OrdersSteps $I){
        $I->SearchPriceProductAutocomplete($typeName = 'Товар с 1 целым и 2 макс.числами после точки в цене.', $typePrice = '99.99'); 
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
    public function SearchProductPricemin7Autocomplit (OrdersTester\OrdersSteps $I){
        $I->SearchPriceProductAutocomplete($typeName = 'Товар с 1 целым и 2 нулевими числами после точки в цене.', $typePrice = '99.00'); 
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
    public function SearchProductPricemin8Autocomplit (OrdersTester\OrdersSteps $I){
        $I->SearchPriceProductAutocomplete($typeName = 'Товар с макс.значением цены.', $typePrice = '10000000000000'); 
    }
    
    
    
    
    
    
    
    
    /**
     * @group a
     * @guy OrdersTester\OrdersSteps
     */
    public function SelectNumber113AfterPoint(OrdersTester\OrdersSteps $I) {
        $I->SelectNumberAfterPoint($numberAfterPoint = 2);
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
    public function SearchProductPricemin9Autocomplit (OrdersTester\OrdersSteps $I){
        $I->SearchPriceProductAutocomplete($typeName = 'Товар с макс.значением цены и с нулями после точки.', $typePrice = '10000000000000.00'); 
    }
    
    

    
    
    
    
    
    /**
     * @group a
     * @guy OrdersTester\OrdersSteps
     */
    public function SelectNumber114AfterPoint(OrdersTester\OrdersSteps $I) {
        $I->SelectNumberAfterPoint($numberAfterPoint = 2);
    }
    /**
     * @group a
     * @guy OrdersTester\OrdersSteps
     */
    public function ProductPrice7AndPointParentCategory (OrdersTester\OrdersSteps $I) {
        $I->wantTo('Verify Presence Price in Second Child Category on Select Menu.');
        $I->createProduct($nameProduct = 'Товар с макс.значением цены и с макс.знач. после точки.',
                                        $nameVariantProduct = NULL,
                                        $priceProduct = '1000000000000000.99999',
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
    public function SearchProductPricemin10Autocomplit (OrdersTester\OrdersSteps $I){
        $I->SearchPriceProductAutocomplete($typeName = 'Товар с макс.значением цены и с макс.знач. после точки.', $typePrice = '1000000000000000.00'); 
    }

    
    
    
    
    ///---///----Tests For Article Product-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    
    
    
    
    
    
    
    
    
    
    
    
    /**
     * @group x
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
     * @group x
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
     * @group x
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
     * @group x
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
     * @group x
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
     * @group x
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
     * @group x
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
     * @group x
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
        $I->SearchArticleProductAutocomplete($articleProduct = InitTest::$textSymbols);  
        InitTest::ClearAllCach($I);
    }
    
    
    
    
    
    
    /**
     * @group x
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
     * @group x
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
    
    
    
    
    
    
    
   
    
    
    
    
    
    
    ///---///----Tests For Amount Product-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    

    
    
}

