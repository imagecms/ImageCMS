<?php
use \AcceptanceTester;
class FieldsOCACest
{
 //---------------------------AUTORIZATION--------------------------------------- 
     
    
    /**
     * @group a
     */
    public function Login(AcceptanceTester $I){
        InitTest::Login($I);
    }    
    
    
    
//    /**
//     * @group a
//     */
//    public function VerifyCategoryPresenceInSelectMenu (AcceptanceTester $I){
//       $AllOptions =[]; 
//       $I->amOnPage('/admin/components/run/shop/products/create');
//       $AllProductOptions = $I->grabTagCount($I, 'select option', 2);
//       $MakeVisible1 = "$('select:eq(2)').css({'display':'block'})";
//       $I->executeJS($MakeVisible1);
//       for($row = 1; $row <= $AllProductOptions; ++$row){
//           $AllOptions[$row] = $I->grabTextFrom("//div[@class = 'control-group'][2]//div//select/option[$row]");
//       }
//       
//       
//       $I->amOnPage('/admin/components/run/shop/orders/create');
//       $OrderCategoriesLength = $I->grabTagCount($I, 'select option');
//       
//       $MakeVisible2 = "$('select:eq(0)').css({'display':'block'})";
//       $I->executeJS($MakeVisible2);
//       
//       for($row = 1; $row <= $OrderCategoriesLength; ++$row){
//           $AllOrderOptions[$row] = $I->grabTextFrom("//select[1]/option[$row]");
//       }
//       foreach ($AllOptions as $key => $AllOptionNow) {
//           $I->assertEquals(str_replace([' ','-'],'',$AllOptionNow), str_replace([' ','-'],'',$AllOrderOptions[$key]));
//       }
//    }  
    
    
    
    /**
     * @group a
     */
    public function SearchProductNameMin (AcceptanceTester $I){
        $this->SearchNameProduct($I, $typeName = OrdersListPage::$CrtPrdNameMin);
    }
    /**
     * @group a
     */
    public function SearchProductNameMax (AcceptanceTester $I){
        $this->SearchNameProduct($I, $typeName = OrdersListPage::$CrtPrdNameMax);
    }
    /**
     * @group a
     */
    public function SearchProductPriceMin (AcceptanceTester $I){
        $this->SearchPriceProduct($I, $typeName = 'Минимальная Цена Товара', $typePrice = OrdersListPage::$CrtPrdPriceMin);
    }
    /**
     * @group a
     */
    public function SearchProductPriceMax (AcceptanceTester $I){
        $this->SearchPriceProduct($I, $typeName = 'Максимальная Цена Товара', $typePrice = OrdersListPage::$CrtPrdPriceMax);
    }
    /**
     * @group a
     */
    public function SearchProductArticleMin (AcceptanceTester $I){
        $this->SearchArticleProduct($I, $articleProduct = OrdersListPage::$CrtPrdArticleMin);
    }
    /**
     * @group a
     */
    public function SearchProductArticleMax (AcceptanceTester $I){
        $this->SearchArticleProduct($I, $articleProduct = OrdersListPage::$CrtPrdArticleMax);
    }
    /**
     * @group a
     */
    public function SearchProductAmountMin (AcceptanceTester $I){
        $this->SearchAmountProduct($I,  $typeName = 'Минимальное Количество Товара',
                                        $amountProduct = OrdersListPage::$CrtPrdAmountMin);
    }
    /**
     * @group a
     */
    public function SearchProductAmountMax (AcceptanceTester $I){
        $this->SearchAmountProduct($I,  $typeName = 'Максимальное Количество Товара',
                                        $amountProduct = OrdersListPage::$CrtPrdAmountMax);
    }











////////////////////////////////////////////////////////////////////////////////
//                                                                            //
//------------------------PROTECTED________FUNCTIONS----------------------------
    
    
    
    
    protected function SearchNameProduct (AcceptanceTester $I, $typeName = NULL){        
        $I->amOnPage(OrdersListPage::$CrtPURL);
        if(isset($typeName)){            
            $I->click(OrdersListPage::$CrtPButtProduct);    
            $I->fillField('#productNameForOrders', $typeName);
            $I->wait('1');
            $I->see($typeName,'//body/ul[2]/li[1]/a');
            $I->click('//body/ul[2]/li[1]/a');
            $I->wait('1');
            $I->see("Товар: $typeName", '//tbody/tr[1]/td[2]/div/div[2]/span[1]/b'); 
            $I->click(OrdersListPage::$CrtPButtAddToCart);
            $I->see('В корзине', OrdersListPage::$CrtPButtInBasket);
            $I->see($typeName, '//tbody/tr[2]/td[2]/select');
            $I->see($typeName, '//table[2]/tbody/tr/td[1]/span');            
        }        
    }   
    
    
    
    protected function SearchPriceProduct(AcceptanceTester $I, $typeName = NULL, $typePrice = NULL) {        
        $I->amOnPage(OrdersListPage::$CrtPURL);        
        if(isset($typeName)){            
            $I->click(OrdersListPage::$CrtPButtProduct);    
            $I->fillField('#productNameForOrders', $typeName);
            $I->wait('1');
            $I->see($typeName,'//body/ul[2]/li[1]/a');
            $I->click('//body/ul[2]/li[1]/a');
            $I->wait('1');
            $I->see("Товар: $typeName", '//tbody/tr[1]/td[2]/div/div[2]/span[1]/b'); 
            $I->click(OrdersListPage::$CrtPButtAddToCart);
            $I->see('В корзине', OrdersListPage::$CrtPButtInBasket);
            $I->see($typeName, '//tbody/tr[2]/td[2]/select');
            $I->see($typeName, '//table[2]/tbody/tr/td[1]/span');            
        }if(isset($typePrice)){            
            $I->click(OrdersListPage::$CrtPButtProduct);
            $I->see($typePrice, '//tbody/tr[1]/td[2]/div/div[2]/span[1]');
            $I->see($typePrice, '//tbody/tr[2]/td[3]/select/option');
            $I->see($typePrice, '//table[2]/tbody/tr/td[3]/span/span[1]');
            $I->see($typePrice, '//table[2]/tbody/tr/td[5]/span[1]');
            $I->see($typePrice, '//table[2]/tfoot/tr/td[3]/span');
            $I->click(OrdersListPage::$CrtPButtOrder);
            $I->click(OrdersListPage::$CrtOButtUpdate);
            $I->wait('1');
            $I->seeInField('//table/tbody/tr/td/div/div/div[1]/div[1]/input', $typePrice);            
        }
    }
    
    
    
    protected function SearchArticleProduct (AcceptanceTester $I, $articleProduct = NULL) {        
        $I->amOnPage(OrdersListPage::$CrtPURL);
        if(isset($articleProduct)){            
           $I->click(OrdersListPage::$CrtPButtProduct);
           $I->fillField('#productNameForOrders', $articleProduct);
           $I->wait('1');
           $I->see($articleProduct, '//body/ul[2]/li[1]/a');           
        }
    }
    
    
    
    protected function SearchAmountProduct (AcceptanceTester $I, $typeName = NULL, $amountProduct = NULL) {        
        if(isset($typeName)){            
            $I->amOnPage(OrdersListPage::$CrtPURL); 
            $I->fillField('#productNameForOrders', $typeName);
            $I->wait('1');
            $I->see($typeName,'//body/ul[2]/li[1]/a');
            $I->click('//body/ul[2]/li[1]/a');
            $I->wait('1');
            $I->see("Товар: $typeName", '//tbody/tr[1]/td[2]/div/div[2]/span[1]/b'); 
            $I->click(OrdersListPage::$CrtPButtAddToCart);
            $I->see('В корзине', OrdersListPage::$CrtPButtInBasket);
            $I->see($typeName, '//tbody/tr[2]/td[2]/select');
            $I->see($typeName, '//table[2]/tbody/tr/td[1]/span');            
        }if(isset($amountProduct)){
            $I->click(OrdersListPage::$CrtPButtProduct); 
            $I->see("Остаток: $amountProduct", '#productStock');
            $I->seeInField('//table[2]/tbody/tr/td[4]/div/input', '1');
        }
    }
    
    
    
    
//    protected function SearchVariantName(AcceptanceTester $I, $typeVariant = NULL){
//        if(isset($typeVariant)){            
//            $I->click(OrdersListPage::$CrtPButtProduct);
//            //$I->wait('5');
//            $I->see("Вариант: $typeVariant", '#productText');
//            $I->see($typeVariant, '//form/div/div[1]/div/table[2]/tbody/tr/td[2]');
//            $I->see($typeVariant, '//tbody/tr[2]/td[3]/select');
//            
//        }
//        
//    }

    
    
    
//    protected function SearchVariantPrice (AcceptanceTester $I, $typeVariant = NULL, $variantPrice = NULL) {
//        
//        if(isset($typeVariant)){            
//            $I->click(OrdersListPage::$CrtPButtProduct);
//            //$I->wait('5');
//            $I->see("Вариант: $typeVariant", '#productText');
//            $I->see($typeVariant, '//form/div/div[1]/div/table[2]/tbody/tr/td[2]');
//            $I->see($typeVariant, '//tbody/tr[2]/td[3]/select');
//            
//        }if(isset($variantPrice)){
//            
//        }
//    }
    
    
    
//    protected function SearchVariantArticle (AcceptanceTester $I, $typeVariant = NULL, $variantArticle = NULL) {
//        
//        if(isset($typeVariant)){            
//            $I->click(OrdersListPage::$CrtPButtProduct);
//            //$I->wait('5');
//            $I->see("Вариант: $typeVariant", '#productText');
//            $I->see($typeVariant, '//form/div/div[1]/div/table[2]/tbody/tr/td[2]');
//            $I->see($typeVariant, '//tbody/tr[2]/td[3]/select');
//            
//        }if(isset($variantArticle)){
//            
//        }
//    }

    
    
    
//    protected function SearchVariantAmount (AcceptanceTester $I, $typeVariant = NULL, $variantAmount = NULL) {
//        
//        if(isset($typeVariant)){            
//            $I->click(OrdersListPage::$CrtPButtProduct);
//            //$I->wait('5');
//            $I->see("Вариант: $typeVariant", '#productText');
//            $I->see($typeVariant, '//form/div/div[1]/div/table[2]/tbody/tr/td[2]');
//            $I->see($typeVariant, '//tbody/tr[2]/td[3]/select');
//            
//        }if(isset($variantAmount)){
//            
//        }
//    }





























































//    /**
//     * @group a
//     */
//    public function QwQEqwQEewqqQQ (AcceptanceTester $I){
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
