<?php
use \OrdersTester;
class CategoryAndNameProductCest

{
//---------------------------AUTORIZATION--------------------------------------- 
    
    /**
     * @group categ
     */
    public function Login(OrdersTester $I){
        InitTest::Login($I);
    }    
    
        
    
    
    
    ///---///---Tests For Category Product in Select------------------------------------------------------------------------------------------------------------------------------------------
    
    
    
    
    /**
     * @group categ
     * @guy OrdersTester\OrdersSteps
     */
    public function ParentCategory (OrdersTester\OrdersSteps $I) {
        $I->wantTo('Verify Presence Parent Category on Select Menu.');
        $I->createCategoryProduct(CreateCategoryOrdersPage::$CrtCatName1);
        $I->SearchCategorySelect(CreateCategoryOrdersPage::$CrtCatName1ForSearch);
    } 
    
    
    
    
    
    
    
     /**
     * @group categ
     * @guy OrdersTester\OrdersSteps
     */
    public function ChildCategoryFirstLevel (OrdersTester\OrdersSteps $I) {
        $I->wantTo('Verify Presence Child Category Firs Level on Select Menu.');
        $I->createCategoryProduct(CreateCategoryOrdersPage::$CrtCatName2, CreateCategoryOrdersPage::$CrtCatName1ForSearch);
        $I->SearchCategorySelect(CreateCategoryOrdersPage::$CrtCatName2ForSearchOrder);
    }
    
    
    
    
    
    
    
    /**
     * @group categ
     * @guy OrdersTester\OrdersSteps
     */
    public function ChildCategorySecondLevel(OrdersTester\OrdersSteps $I) {
        $I->wantTo('Verify Presence Child Category Second Level on Select Menu.');
        $I->createCategoryProduct(CreateCategoryOrdersPage::$CrtCatName3, CreateCategoryOrdersPage::$CrtCatName2ForSearchOrder);
        $I->SearchCategorySelect(CreateCategoryOrdersPage::$CrtCatName3ForSearchOrder);
    }
    
    
    
    
    
    
    /**
     * @group a
     * @guy OrdersTester\OrdersSteps
     */
    public function ICMS823JiraRegressionBug (OrdersTester\OrdersSteps $I) {
        $I->wantTo('ICMS-823 Jira, Verify Noactive Category Presence on Create Orders Admin Page.');
        $I->createCategoryProduct('Category Regression Jira ICMS-823', NULL);
        $I->amOnPage('/admin/components/run/shop/orders/create');
        $I->wait('1');
        $I->click(\CreateOrderAdminPage::$CrtZMenuCategoryDefolt);
        $I->fillField(\CreateOrderAdminPage::$CrtZMenuCategoryInput, 'Category');
        $I->click(\CreateOrderAdminPage::$CrtZMenuCategorySearchButton);
        $I->see('Category Regression Jira ICMS-823', 'a.chosen-single > span');
    }
    
    
    
    /**
     * @group a
     * @guy OrdersTester\OrdersSteps
     */
    public function VerifyCategoryPresenceInSelectMenu (OrdersTester $I){
       $I->wantTo('Compare identity O product categories sElECt menu pages "Create Item" and "Create Order".');
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
        $I->wantTo('Verify Check Product Name Presence.');
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
        $I->wantTo('Verify Check Product Name Presence.');
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
        $I->wantTo('Verify Check Product Name Presence.');
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
        $I->wantTo('Verify Check Product Name Presence.');
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
        $I->wantTo('Verify Check Product Name Presence.');
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
        $I->wantTo('Verify Check Product Name Presence.');
        $I->SearchNameProductaAutocomplete($typeName = "¿←↑→↓ƒ∞√±≥≤><−⁄÷×–");
    }
    
    
    
    
    
    
    
    
    
    
    /**
     * @group a
     * @guy OrdersTester\OrdersSteps
     */
    public function DeleteCeatingProducts(OrdersTester\OrdersSteps $I) {
        $I->DeleteProductInCategory($CategoryWithProduct = CreateCategoryOrdersPage::$CrtCatName1ForSearch);
        $I->wait('1');
    }


}