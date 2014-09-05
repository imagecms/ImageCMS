<?php

use \SeoExpertTester;
class CategorySEOCest

{
    
//---------------------------AUTORIZATION--------------------------------------- 
    /**
     * @group aa
     */
    public function Login(SeoExpertTester $I){
        InitTest::Login($I);
    }
    
    
    /**
     * @group a
     * @guy SeoExpertTester\seoexpertSteps 
     */
    public function CreateCategoryForFront (SeoExpertTester\seoexpertSteps $I){
        $I->SeoCreateCategoryProduct($createNameCategory = 'ФуриКури');
        $I->SeoCreateProduct($NameProduct = 'ДжузаваДжуКун', $PriceProduct = '987', $BrandProduct = 'apple', $CategoryProduct = 'Фури');
        $I->SeoCreateProduct($NameProduct = 'Микасо', $PriceProduct = '4', $BrandProduct = 'sony', $CategoryProduct = 'фури');
        $I->SeoCreateProduct($NameProduct = 'Сапуто', $PriceProduct = '2', $BrandProduct = 'samsung', $CategoryProduct = 'фури');
        $I->SeoCreateProduct($NameProduct = 'ОчибанаСан', $PriceProduct = '3', $BrandProduct = 'LG', $CategoryProduct = 'фури');
        $I->SeoCreateProduct($NameProduct = 'Митоте', $PriceProduct = '5', $BrandProduct = 'Philips', $CategoryProduct = 'фури');
        $I->SeoTextAreaActive($on = 'YES');
        $I->SeoCreateDescriptonAndH1($name_category = 'ФуриКури',
                                    $description_category = 'Модная категория для применения положительного эфэкта при страх и ненависть в Ласвегасе',
                                    $H1_category = 'Супер пупер категория для товаров');
    }
    
    /**
     * @group a
     */
    public function BaseDefoultValues (SeoExpertTester $I) {
        $I->amOnPage(seoexpertPage::$SeoUrl);
        $I->click(seoexpertPage::$SeoBaseRadioButtCategoryNameNo);
        $I->click(seoexpertPage::$SeoBaseRadioButtSiteNameYes);
        $I->fillField(seoexpertPage::$SeoBaseFieldSeparator, '/');
        $I->fillField(seoexpertPage::$SeoBaseFieldDescription, '');
        $I->fillField(seoexpertPage::$SeoBaseFieldKeywords, '');
        $I->fillField(seoexpertPage::$SeoBaseFieldSiteName, 'lastbuild.loc');
        $I->fillField(seoexpertPage::$SeoBaseFieldShortSiteName, 'mini.loc');
        $I->click(seoexpertPage::$SeoButtSave);
        $I->wait('1');
    }
    
    
    
    
    
    /**
     * @group aa
     */
    public function ShopCategoryPageTitle (SeoExpertTester $I){
        $I->amOnPage(seoexpertPage::$SeoUrl);
        $I->wait('1');
        $I->click(seoexpertPage::$SeoButtShop);
        $I->wait('1');        
        $I->fillField(seoexpertPage::$SeoCategoryTitle, " %name% %desc% %H1% %brands% %pagenumber%");
        $I->fillField(seoexpertPage::$SeoCategoryDescription, '%pagenumber%');
        $I->fillField(seoexpertPage::$SeoCategoryKeywords, '%pagenumber%');
        $I->fillField(seoexpertPage::$SeoCategoryPaginationPage, '%pagenumber%');
        $checkbox_path = '//tbody/tr[2]/td/div/div/div[2]/div/span[2]/span'; 
        $I->ActivateCheckBox($checkbox_xpath = $checkbox_path);
        $I->click(seoexpertPage::$SeoButtSave);
        InitTest::ClearAllCach($I);
        $I->wait('2');
        $I->amOnPage('/shop/category/furikuri#');
        $I->wait('7');
        $I->seeInPageSource('');
    }    
    
    
    
    
    
}    
