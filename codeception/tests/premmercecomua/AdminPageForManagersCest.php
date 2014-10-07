<?php

use \UkrainianTester;

class AdminPageForManagersCest


{
   
    /**
     * @group a
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
        $I->wait(25);
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
        $I->click('//body/div[1]/div[3]/div/nav/ul/li[6]/a');
        $I->wait(1);
        $I->click('//body/div[1]/div[3]/div/nav/ul/li[6]/ul/li[2]/a');
        $I->wait(1);
        $I->click('//body/div[1]/div[5]/section/div/div[1]/ul/li[2]/a');
        $I->wait(7);
        $I->click('//body/div[1]/div[5]/div[3]/section/div[2]/div/div[2]/form/div/ul/li[1]/label/span');
        $I->fillField('//body/div[1]/div[5]/div[3]/section/div[2]/div/div[2]/form/div/ul/li[1]/input', 'afrikabbaxx');
        $I->click('//body/div[1]/div[5]/div[3]/section/div[2]/div/div[2]/form/div/input');
        $I->wait(3);
        $I->see('afrikabbaxx', '//body/div[1]/div[5]/div[3]/section/div[2]/div/div[1]/table/tbody/tr/td[5]/p/a');
        $I->wait(3);
    }
}    
