<?php

use \UkrainianTester;

class AdminPageForManagersCest


{
   
    /**
     * @group aa
     * @guy UkrainianTester\LocUaSteps 
     */
    public function TestsCRT(UkrainianTester\LocUaSteps $I){
        $I->amOnPage(PremmerceMainPage::$URL);
        $I->click(PremmerceMainPage::$ButtonCreateStore);
        $I->CreateStore($store_name         = 'afrikabbaxx',
                        $user_email         = 'afrika@bomm.net',
                        $user_password      = '1122334455',
                        $user_name          = 'Bazuka',
                        $user_phone         = '777888999',
                        $user_city          = 'Львів',
                        $product_category   = 3,
                        $product_level      = 2);
        $I->wait(20);
    }
    
    /**
     * @group aa
     * @guy UkrainianTester\LocUaSteps 
     */
    public function TestsPRF(UkrainianTester\LocUaSteps $I){
        $I->CabinetLogin($user_email = 'afrika@bomm.net', $user_password = '1122334455');
        $I->wait(5);
    }
    
    
    /**
     * @group aa
     * @guy UkrainianTester\LocUaSteps 
     */
    public function TestsSAAS(UkrainianTester\LocUaSteps $I){
        $I->amOnPage('/admin');
        $I->wait(1);
        $I->AdminLogin($admin_email = 'ad@min.com', $admin_password = 'admin');
        $I->wait(1);
        $I->click(SaasUserListPage::$NavigationModules);
        $I->wait(1);
        $I->click(SaasUserListPage::$NavigationModulSaas);
        $I->wait(1);
        $I->click(SaasUserListPage::$NavigationModulSaasTabUser);
        $I->wait(7);
        $I->click(SaasUserListPage::$FilterDomainEndLabel);
        $I->fillField(SaasUserListPage::$FilterDomainInput, 'afrikabbaxx');
        $I->click(SaasUserListPage::$FilterButtonFilter);
        $I->wait(3);
        $I->see('afrikabbaxx', SaasUserListPage::lineDomainLink(1));
        $I->wait(3);
    }
}    
