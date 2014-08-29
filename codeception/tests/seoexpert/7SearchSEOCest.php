<?php

use \SeoExpertTester;
class SearchSEOCest

{
    
//---------------------------AUTORIZATION--------------------------------------- 
    /**
     * @group aa
     */
    public function Login(SeoExpertTester $I){
        InitTest::Login($I);
    }
    
    
    /**
     * @group aa
     */
    public function ShopSearchPage (SeoExpertTester $I){
        $I->amOnPage(seoexpertPage::$SeoUrl);
        $I->wait('1');
        $I->click(seoexpertPage::$SeoButtShop);
        $I->wait('1');
        $I->fillField(seoexpertPage::$SeoSearchFieldTitle, 'SEARCH сиарч и анд поиск');
        $I->fillField(seoexpertPage::$SeoSearchFielddescription, 'врунгель мики и тони');
        $I->fillField(seoexpertPage::$SeoSearchFieldKeywords, 'натворя еще на районе ето войдет в историю чтоб вы заполнили');
        $I->click(seoexpertPage::$SeoSearchCheckBoxActive);
        $I->wait('1');
        $I->click(seoexpertPage::$SeoButtSave);
        $I->wait('1');
        $I->amOnPage('/');
        $I->wait('2');
        $I->fillField('//header/div[2]/div/div/div[2]/div[2]/div/form/div/input', 'Товарчик для SEO експерта');
        $I->wait('3');
        $I->click('//header/div[2]/div/div/div[2]/div[2]/div/form/div/div/div/div/div/a/span[2]');
        $I->wait('3');
        $I->seeInPageSource('SEARCH сиарч и анд поиск');
        $I->seeInPageSource('врунгель мики и тони');
        $I->seeInPageSource('натворя еще на районе ето войдет в историю чтоб вы заполнили');
    }
}    

