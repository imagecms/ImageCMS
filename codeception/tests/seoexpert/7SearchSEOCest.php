<?php

use \SeoExpertTester;
class SearchSEOCest

{
    
//---------------------------AUTORIZATION--------------------------------------- 
    /**
     * @group a
     */
    public function Login(SeoExpertTester $I){
        InitTest::Login($I);
    }
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps 
     */
    public function CreateCategoryForFront (SeoExpertTester\seoexpertSteps $I){
        $I->SeoCreateCategoryProduct($createNameCategory = 'Брендовая');   
        $I->SeoCreateCategoryProduct($createNameCategory = 'Etmo Plasma');   
    }
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps 
     */
    public function CreateProductForFront (SeoExpertTester\seoexpertSteps $I){
        $I->SeoCreateProduct($Name_Product = 'Брендовый Пробник товар',
                            $Price_Product = '777',
                            $Brand_Product = '',
                            $Category_Product = 'Брендовая',
                            $Additional_Category = '');     
        $I->SeoCreateProduct($Name_Product = 'Пробник товар Брендовий',
                            $Price_Product = '888',
                            $Brand_Product = '',
                            $Category_Product = 'Брендовая',
                            $Additional_Category = '');
        $I->SeoCreateProduct($Name_Product = 'Товар Брендовый Пробник',
                            $Price_Product = '654',
                            $Brand_Product = '',
                            $Category_Product = 'Брендовая',
                            $Additional_Category = ''); 
        $I->SeoCreateProduct($Name_Product = 'Zulusandia',
                            $Price_Product = '888',
                            $Brand_Product = '',
                            $Category_Product = 'Etmo Plasma',
                            $Additional_Category = '');     
        $I->SeoCreateProduct($Name_Product = 'Two Zulusandia',
                            $Price_Product = '999',
                            $Brand_Product = '',
                            $Category_Product = 'Etmo Plasma',
                            $Additional_Category = '');     
        $I->SeoCreateProduct($Name_Product = 'Zulusandia Three',
                            $Price_Product = '658',
                            $Brand_Product = '',
                            $Category_Product = 'Etmo Plasma',
                            $Additional_Category = '');     
    }
    
    
    /**
     * @group a
     */
    public function ClearChash1(SeoExpertTester $I) {
        InitTest::ClearAllCach($I);
    }
    
    
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function SearchComonData (SeoExpertTester\seoexpertSteps $I) {
        $I->NullValues();
        $I->SetSearchSeoPage($Title = 'тайтл для пошуку title FOR Poshuck',
                            $Description = 'DEScription ой ао ый яй ей оаей Дескріптіон',
                            $Keywords = 'Слово не горобець як полетить Tj nespiymaew KEYWords',
                            $CheckBox_Activate = seoexpertPage::$SeoSearchCheckBoxActive);     
        $I->CheckValuesInPage($URL_Page = '/shop/search?text=Zulusandia#',
                                $values = 'тайтл для пошуку title FOR Poshuck');
        $I->seeInPageSource('DEScription ой ао ый яй ей оаей Дескріптіон ');
        $I->seeInPageSource('Слово не горобець як полетить Tj nespiymaew KEYWords');
        $I->CheckValuesInPage($URL_Page = '/shop/search?text=Zulusandia&per_page=1#',
                                $values = 'тайтл для пошуку title FOR Poshuck');
        $I->seeInPageSource('DEScription ой ао ый яй ей оаей Дескріптіон ');
        $I->seeInPageSource('Слово не горобець як полетить Tj nespiymaew KEYWords');
        $I->CheckValuesInPage($URL_Page = '/shop/search?text=Zulusandia&per_page=2#',
                                $values = 'тайтл для пошуку title FOR Poshuck');
        $I->seeInPageSource('DEScription ой ао ый яй ей оаей Дескріптіон ');
        $I->seeInPageSource('Слово не горобець як полетить Tj nespiymaew KEYWords');
    }
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps
     */
    public function SearchDeactivate (SeoExpertTester\seoexpertSteps $I) {
        $I->NullValues();
        $I->SetSearchSeoPage($Title = 'тайтл для пошуку title FOR Poshuck',
                            $Description = 'DEScription ой ао ый яй ей оаей Дескріптіон',
                            $Keywords = 'Слово не горобець як полетить Tj nespiymaew KEYWords',
                            $CheckBox_Activate = seoexpertPage::$SeoSearchCheckBoxActive); 
        $I->DeactivateCheckBox($checkbox_xpath = seoexpertPage::$SeoSearchCheckBoxActive);
        $I->amOnPage('/shop/search?text=Zulusandia#');
        $I->wait('1');
        $I->dontSeeInPageSource('тайтл для пошуку title FOR Poshuck');
        $I->dontSeeInPageSource('DEScription ой ао ый яй ей оаей Дескріптіон ');
        $I->dontSeeInPageSource('Слово не горобець як полетить Tj nespiymaew KEYWords');
        $I->wait('1');
        $I->amOnPage('/shop/search?text=Zulusandia&per_page=1#');
        $I->dontSeeInPageSource('тайтл для пошуку title FOR Poshuck');
        $I->dontSeeInPageSource('DEScription ой ао ый яй ей оаей Дескріптіон ');
        $I->dontSeeInPageSource('Слово не горобець як полетить Tj nespiymaew KEYWords');
        $I->wait('1');
        $I->amOnPage('/shop/search?text=Zulusandia&per_page=2#');
        $I->dontSeeInPageSource('тайтл для пошуку title FOR Poshuck');
        $I->dontSeeInPageSource('DEScription ой ао ый яй ей оаей Дескріптіон ');
        $I->dontSeeInPageSource('Слово не горобець як полетить Tj nespiymaew KEYWords');
    }
    
    
    
    
    
    
    
}    

