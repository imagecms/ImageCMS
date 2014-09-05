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
        $I->fillField(seoexpertPage::$SeoSearchFieldTitle, '');
        $I->fillField(seoexpertPage::$SeoSearchFielddescription, '');
        $I->fillField(seoexpertPage::$SeoSearchFieldKeywords, '');
        $I->click(seoexpertPage::$SeoSearchCheckBoxActive);
        $I->wait('1');
        $I->click(seoexpertPage::$SeoButtSave);
        $I->wait('1');
        $I->amOnPage('/');
        $I->wait('2');
        $I->fillField('//header/div[2]/div/div/div[2]/div[2]/div/form/div/input', '');
        $I->wait('3');
        $I->click('//header/div[2]/div/div/div[2]/div[2]/div/form/div/div/div/div/div/a/span[2]');
        $I->wait('3');
        $I->seeInPageSource('');
        $I->seeInPageSource('');
        $I->seeInPageSource('');
    }
}    

