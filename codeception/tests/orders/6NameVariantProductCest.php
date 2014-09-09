<?php
use \OrdersTester;
class NameVariantProductCest

{
    //---------------------------AUTORIZATION--------------------------------------- 
    /**
     * @group a
     */
    public function Login(OrdersTester $I){
        InitTest::Login($I);
    }  
    
    
    ///---///----Tests For Variant Product--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    
    
    
    
    
    /**
     * @group a
     * @guy OrdersTester\OrdersSteps
     */
    public function ProductVariantMinParentCategory (OrdersTester\OrdersSteps $I) {
        $I->wantTo('Verify Presence Variant Min in First Child Category on Select Menu.');
        $I->createProduct($nameProduct = 'Товар с xXxXx названием варианта',
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
        $I->wantTo('Verify Check Variant Name Presence.');
        $I->SearchVariantProductAutocomplete($productName = 'Товар с xXxXx названием варианта', $variantName = 'x'); 
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
        $I->wantTo('Verify Check Variant Name Presence.');
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
        $I->wantTo('Verify Check Variant Name Presence.');
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
        $I->wantTo('Verify Check Variant Name Presence.');
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
        $I->wantTo('Verify Check Variant Name Presence.');
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
        $I->wantTo('Verify Check Variant Name Presence.');
        $I->SearchVariantProductAutocomplete($productName = 'Товар с цифрами в названии варианта', $variantName = '1 2 3 4 5 6 7 8 9 0'); 
    }
    
    
    
    /**
     * @group a
     * @guy OrdersTester\OrdersSteps
     */
    public function DeleteProductIn2Category(OrdersTester\OrdersSteps $I) {
       $I->DeleteProductInCategory($CategoryWithProduct = CreateCategoryOrdersPage::$CrtCatName2ForSearchOrder); 
    }
}

