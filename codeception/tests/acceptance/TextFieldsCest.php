<?php
use \AcceptanceTester;

class TextFieldsCest
{
    // tests
    public function _after(AcceptanceTester $I)
    {
        InitTest::ClearAllCach($I);
        //$I->wait("5");
    }
    
    /**
     * @group valid
     */
    public function Authoruzation(AcceptanceTester $I){
        InitTest::Login($I);
    }
    
    /**
     * @group valida
     */
    public function EmailValidCept (AcceptanceTester $I)
    {
        $I->amOnPage('/shop/category/telefoniia-pleery-gps/telefony/smartfony?per_page=12');
        $I->click('//div[3]/div/div/button');
        $I->fillField('//label[2]/span[2]/input', 'as12@0987qweasd.net');
        $I->click('//span[2]/div/button'); 
        $I->amOnPage('/admin/components/run/shop/notifications');
        $I->click(['link' => 'as12@0987qweasd.net']);
        $I->seeInField('//div[2]/div/input', 'as12@0987qweasd.net');
        $I->amOnPage('/admin/components/run/shop/notifications');
        $I->click(NotificationListPage::$ListMainCheckBox);
        $I->click(NotificationListPage::$ListButtonDelete);
        $I->click(NotificationListPage::$DeleteWindowButtonDelete);
    }
    
    /**
     * @group valida
     */
    public function Name1Cept(AcceptanceTester $I){
        $I->amOnPage('/shop/category/telefoniia-pleery-gps/telefony/smartfony?per_page=12');
        $I->click('//div[3]/div/div/button');
        $I->fillField('//span[2]/input', '1');
        $I->click('//span[2]/div/button'); 
        $I->amOnPage('/admin/components/run/shop/notifications');
        $I->click(['link' => 'ad@min.com']);
        $I->seeInField('//div[2]/div/div/input', '1');
        $I->amOnPage('/admin/components/run/shop/notifications');
        $I->click(NotificationListPage::$ListMainCheckBox);
        $I->click(NotificationListPage::$ListButtonDelete);
        $I->click(NotificationListPage::$DeleteWindowButtonDelete);
    }
     /**
     * @group valid
     */
    public function qweqe(AcceptanceTester $I){
        
    }
    
}