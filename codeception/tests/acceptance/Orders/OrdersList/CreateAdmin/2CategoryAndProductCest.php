<?php
use \AcceptanceTester;
class CategoryAndProductOCACest
{
//---------------------------AUTORIZATION--------------------------------------- 
     
    
    /**
     * @group q
     */
    public function Login(AcceptanceTester $I){
        InitTest::Login($I);
    }
    
    
    
//----------------Create Parent, Sub1, Sub2 Product Category--------------------
    
    
    /**
     * @group a
     */
    public function CreateParentMainCategory (AcceptanceTester $I){
    $this->CreateCategory($I, $createNameCategory = 'Основная КаТеГоРиЯ', null);
    }
    
    
    
    /**
     * @group a
     */
    public function CreateFirstChildCategory (AcceptanceTester $I){
        $this->CreateCategory($I, 'First Дочерная','Осно');
    }
    
    
    
    /**
     * @group a
     */
    public function CreateSecondChildCategory (AcceptanceTester $I){
        $this->CreateCategory($I, 'Second ДоЧеРнАя', 'First');
    }
    
    
    


//-------------------------Create Products--------------------------------------
    
     
    
    
    
    
    /**
     * @group a
     */
    public function CreateProductMainNameMin (AcceptanceTester $I){
        $this->CreateProduct($I, $nameProduct = '......', $priceProduct = '1', $articleProduct = NULL,
                            $amountProduct = NULL, $categoryProduct = 'Основ', $variantProduct = NULL,
                            $variantPrice = NULL, $variantArticle = NULL, $variantAmount = NULL);
    }
    
     /**
     * @group a
     */
    public function CreateProductMainNameMax (AcceptanceTester $I){
        $this->CreateProduct($I, $nameProduct = 'qwertyuioasdfghjklzxcvbnmйцукенгшщзхъфывапролдджэячсмиттьбю QWERTYUIOPASDFGHJKLZXCVBNMЙЦУКЕННГШГШЩЗФЫВАПРОЛДЖЭЯЧСМИТЬБЮqwertyuioasdfghj klzxcvbnmйцукенгшщзхъфывапролдджэячсмиттьбюQWERTYUIOPASDFGHJKLZXCVB NMЙЦУКЕННГШГШЩЗФЫВАПРОЛДЖЭЯЧСМИТЬБЮqwertyuioasdfgh jklzxcvbnmйцукенгшщзхъфывапролдджэячсмиттьбюQWERTYUIOPASDFGHJKLZXCVBNMЙЦУКЕННГШГШЩЗФЫВАПРОЛДЖЭЯ ЧСМИТЬБЮqwertyuioasdfghjklzxcvbnmйцукенгшщзхъфывапролдджэячсмиттьбюQWERTYUIOP ASDFGHJKLZXCVBNMЙЦУКЕННГШГШЩЗФЫВАПРОЛДЖЭЯЧСМИТЬБЮQWEQWEQWEQWEQWEASDASDZXCASDQQ',
                                $priceProduct = 1, $articleProduct = NULL, $amountProduct = NULL,
                                $categoryProduct = 'Основ', $variantProduct = NULL, $variantPrice = NULL, $variantArticle = NULL, $variantAmount = NULL);
    }
    
    
    /**
     * @group a
     */
    public function CreateProductMainArticleMin (AcceptanceTester $I){
        $this->CreateProduct($I, $nameProduct = 'Артикул МиН', $priceProduct = 123, $articleProduct = 'R2D2',
                            $amountProduct = NULL, $categoryProduct = 'Основ', $variantProduct = null, $variantPrice = NULL, $variantArticle = null, $variantAmount = NULL);
    }
    
    
    /**
     * @group a
     */
    public function CreateProductMainArticleMax (AcceptanceTester $I){
        $this->CreateProduct($I, $nameProduct = 'Артикул МаХ', $priceProduct = 456, $articleProduct = 'АааРррТттИииКккУууЛллМммАааКккСссАааРррТттИииКккУууЛллМммАааКккСссАааРррТт тИииКккУууЛллМммАааКккСссАааРррТттИииКккУууЛллМммАаа КккСссАааРррТттИииКккУууЛллМммАааКккСссАааРррТттИи иКккУууЛллМммАааКккСссАааРррТттИииКккУууЛллМм мАааКккСссАааРррТттИииКккУууЛллМмм123123',
                                                NULL, $categoryProduct = 'Основ', NULL, NULL, NULL, $variantAmount = NULL);
    }

    
    /**
     * @group a
     */
    public function CreateProductMainPriceMin (AcceptanceTester $I){
    $this->CreateProduct($I, 'Цена МиН', 1, NULL, NULL, 'Осно', NULL, NULL, NULL, NULL);
    }
    
    
    /**
     * @group a
     */
    public function CreateProductMainPriceMax (AcceptanceTester $I){
        $this->CreateProduct($I, 'Цена МаХ', 10000000000000, NULL, NULL, '-First', NULL, NULL, NULL, NULL);
    }
    
    
    /**
     * @group a
     */
    public function CreateProductVariantMin (AcceptanceTester $I){
        $this->CreateProduct($I, 'Вариант МиН', 11, NULL, NULL, '-First', 'V', 1, NULL, NULL);
    }
    
    
    /**
     * @group a
     */
    public function CreateProductVariantMax (AcceptanceTester $I){
        $this->CreateProduct($I, 'Вариант МаХ', 45.23, NULL, NULL, '-First', 'ффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффф',
                                                                            33.55, NULL, NULL);
    }
    
    
    /**
     * @group a
     */
    public function CreateProductAmountMin (AcceptanceTester $I){
    $this->CreateProduct($I, 'Количество МиН', 645.987, NULL, 0, '-First', NULL, NULL, NULL, NULL);
    }
    
    
    /**
     * @group a
     */
    public function CeateProductAmountMax (AcceptanceTester $I){
        $this->CreateProduct($I, 'КоЛиЧеСтВо МаХ', 9.9, NULL, 2147483649 , '-First', NULL, NULL, NULL, NULL);
    }
    
    /**
     * @group a
     */    
    public function CreateVariantName (AcceptanceTester $I){
        $this->CreateProduct($I, 'ВаРиАнТ НаЗвАнИъЭ', 874, NULL, NULL, '--Second', 'NamE VaRиАнТ ПрОдУcT', 123345, NULL, NULL);
    }
    
    
    /**
     * @group a
     */
    public function CreateVariantArticle (AcceptanceTester $I){
        $this->CreateProduct($I, 'ВаРиииАнТТ АрТиКла', 777, NULL, NULL, '--Second', 'VaRiiiAAnnnTTt ARTIKAAA', 909, '989 -*+ qwe ЇЗХ', NULL);
    }

    
    /**
     * @group a
     */
    public function CreateVariantPrice (AcceptanceTester $I){
        $this->CreateProduct($I, 'ВаРиАнТТ ЦенА', 111, NULL, NULL, '--Second', 'Afrika BoomBaaTaa', 9875.6541, NULL, NULL);
    }

    
     /**
     * @group a
     */
     public function CreateVariantAmountMin (AcceptanceTester $I){
         $this->CreateProduct($I, 'ВариаНтиКККссс КОЛ минимализмикс', 1, NULL, NULL, '--Second', 'SaPuTO КОЛ минимал биток', 1, NULL, 0);
     }
     
      /**
     * @group a
     */
      public function CreateVariantAmountMax (AcceptanceTester $I){
          $this->CreateProduct($I, 'ВаР ХаЙ лвл КОЛИЧЕСТВО', 2, NULL, NULL, '--Second', 'ZuRgOdZuP КОЛ МАКС', 2, NULL, 2147483649);
      }









//---------------------------Protected Function---------------------------------
    
    
    
    
    
    protected function CreateCategory (AcceptanceTester $I, $createNameCategory = null,
                                                            $addParentCategory = null){
        $I->amOnPage(OrdersListPage::$CrtCategoryPageURL);                                                                                                                                     
        if(isset($createNameCategory)){
        $I->fillField(OrdersListPage::$CrtCategoryFieldName, $createNameCategory);                                                                                              
        }if(isset($addParentCategory)){            
        $I->click(OrdersListPage::$CrtCategorySelectMenu);                                                                                                                        
        $I->fillField(OrdersListPage::$CrtCategorySelectMenuInput, $addParentCategory);                                                                                              
        $I->click(OrdersListPage::$CrtCategorySelectMenuSetSearch);                                                                                                                            
        }$I->click(OrdersListPage::$CrtCategoryButtonSaveandBack);                                                                                                                                  
    }

    
    

    protected function CreateProduct (AcceptanceTester $I, $nameProduct = NULL , $priceProduct = NULL, $articleProduct = NULL, $amountProduct = NULL, $categoryProduct = NULL, $variantProduct = NULL, $variantPrice = NULL, $variantArticle = NULL, $variantAmount = NULL){
        $I->amOnPage(OrdersListPage::$CrtProductPageURL);                                                                                                     
        if (isset($nameProduct)) {
            $I->fillField(OrdersListPage::$CrtProductNameProduct, $nameProduct);                                          
        }if(isset($priceProduct)){
            $I->fillField(OrdersListPage::$CrtProductPriceProduct, $priceProduct);                                                                            
        }if(isset($articleProduct)){
            $I->fillField(OrdersListPage::$CrtProductArticleProduct, $articleProduct);                           
        }if(isset($amountProduct)){
            $I->fillField(OrdersListPage::$CrtProductAmountProduct, $amountProduct);                            
        }if(isset($categoryProduct)){
            $I->click(OrdersListPage::$CrtProductCategoryProductSelectField);                                                         
            $I->fillField(OrdersListPage::$CrtProductCategoryProductSelectInput, $categoryProduct);                                               
            $I->click(OrdersListPage::$CrtProductCategoryProductSetSelect);                                         
        }if(isset($variantProduct)){                                                        
            $a = $I->grabTagCount($I, 'td select');
            $b = $I->comment("$a");
                if($a == 4){
                    $I->click(OrdersListPage::$CrtProductVariantButtonADD);                                                      
                    $I->fillField(OrdersListPage::$CrtProductVariantFieldName, $variantProduct);                                                        
                }elseif($a > 4){
                    $I->fillField(OrdersListPage::$CrtProductVariantFieldName, $variantProduct);                
                }
        }if(isset($variantPrice)){
            $a = $I->grabTagCount($I, 'td select');
            $b = $I->comment("$a");
                if($a == 4){
                  $I->click(OrdersListPage::$CrtProductVariantButtonADD);
                  $I->fillField(OrdersListPage::$CrtProductVariantFieldPrice, $variantPrice);                                         
                }elseif ($a > 4) {
                  $I->fillField(OrdersListPage::$CrtProductVariantFieldPrice, $variantPrice);                                               
                }
        }if(isset($variantArticle)){
            $a = $I->grabTagCount($I, 'td select');
            $b = $I->comment("$a");
                if($a == 4){
                   $I->click(OrdersListPage::$CrtProductVariantButtonADD);
                   $I->fillField(OrdersListPage::$CrtProductVariantFieldArticle, $variantArticle); 
                }elseif ($a > 4) {
                   $I->fillField(OrdersListPage::$CrtProductVariantFieldArticle, $variantArticle);
                }
        }if(isset($variantAmount)){
            $a = $I->grabTagCount($I, 'td select');
            $b = $I->comment("$a");
                if($a == 4){
                  $I->click(OrdersListPage::$CrtProductVariantButtonADD);
                  $I->fillField(OrdersListPage::$CrtProductVariantFieldAmount, $variantAmount);                       
                }elseif ($a > 4) {
                  $I->fillField(OrdersListPage::$CrtProductVariantFieldAmount, $variantAmount); 
                }
        }
        $I->wait('1');
        $I->click(OrdersListPage::$CrtProductButtonSaveandBack);
    }
    

    

}    
