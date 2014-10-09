<?php

use \UkrainianTester;

class SaasUserPageUACest


{

   private $store_name = 'message';
   private $user_email = 'r2d2r2d2@boomm.net';
   private $user_password = '98765431';
   private $user_name = 'Bazooka Band';
   private $user_phone = '777888999';
   private $user_city = 'Львів';


   
   private $tarif_free = 'Free';
   private $tarif_basic = 'Basic';
   private $tarif_standart = 'Standart';
   private $tarif_business = 'Business';
   private $tarif_premium = 'Premium';
   

   
   private $price_free = 'Безкоштовно';
   private $price_basic = '199 грн/міс';
   private $price_standart = '399 грн/міс';
   private $price_business = '699 грн/міс';
   private $price_premium = '1399 грн/міс';
   
    /**
     * @group a
     * @guy UkrainianTester\LocUaSteps 
     */
    public function CreateShop(UkrainianTester\LocUaSteps $I){
        $I->amOnPage(PremmerceMainPage::$URL);
        $I->click(PremmerceMainPage::$ButtonCreateStore);
        $I->CreateStore($store_name         = $this->store_name,
                        $user_email         = $this->user_email,
                        $user_password      = $this->user_password,
                        $user_name          = $this->user_name,
                        $user_phone         = $this->user_phone,
                        $user_city          = $this->user_city,
                        $product_category   = 3,
                        $product_level      = 2);
        $I->wait(20);
    }
    
 
    /**
     * @group aa
     * @guy UkrainianTester\LocUaSteps 
     */
    public function CreateShopPresenceCabinet (UkrainianTester\LocUaSteps $I){
        $I->CabinetLogin($user_email = $this->user_email, $user_password = $this->user_password);
        $I->wait(1);
        $I->see($this->store_name, PremmerceCabinetPage::$TabMainFieldSiteLink);
        $I->see($this->store_name, PremmerceCabinetPage::$TabMainFieldAdminLink);
        $I->see($this->tarif_standart, PremmerceCabinetPage::$TabMainFieldTarifNameTarif);
        $I->see($this->price_standart, PremmerceCabinetPage::$TabMainFieldCostPrice);
        $I->click(PremmerceCabinetPage::$TabProfile);
        $I->wait(1);
        $I->seeInField(PremmerceCabinetPage::$TabProfileFieldName, $this->user_name);
        $I->seeInField(PremmerceCabinetPage::$TabProfileFieldPhone, $this->user_phone);
        $I->seeInField(PremmerceCabinetPage::$TabProfileFieldCity, $this->user_city);
        $I->seeInField(PremmerceCabinetPage::$TabProfileFieldEmail, $this->user_email);
    }
    
    
    /**
     * @group aa
     * @guy UkrainianTester\LocUaSteps 
     */
    public function CreateShopPresenceModuleSaas(UkrainianTester\LocUaSteps $I){
        $I->AdminLogin($admin_email = 'ad@min.com', $admin_password = 'admin');
        $I->click(SaasUserListPage::$NavigationModules);
        $I->wait(1);
        $I->click(SaasUserListPage::$NavigationModulSaas);
        $I->wait(1);
        $I->click(SaasUserListPage::$NavigationModulSaasTabUser);
        $I->wait(1);
        $I->click(SaasUserListPage::$FilterDomainLabel);
        $I->fillField(SaasUserListPage::$FilterDomainInput, $this->store_name);
        $I->click(SaasUserListPage::$FilterButtonFilter);
        $I->see($this->store_name, SaasUserListPage::lineDomainLink(1));
        $I->click(SaasUserListPage::lineActionlink(1));
        $I->click(SaasUserListPage::ButtonDisable(1));
        $I->wait(5);
    }
    
    
    
    /**
     * @group a
     * @guy UkrainianTester\LocUaSteps 
     */
    public function OffShopPresenceCabinet (UkrainianTester\LocUaSteps $I){
        $I->CabinetLogin($user_email = $this->user_email, $user_password = $this->user_password);
    }
    
    
    
    
    
    
    /**
     * @group a
     * @guy UkrainianTester\LocUaSteps 
     */
    public function OffShopPresenceModuleSaas(UkrainianTester\LocUaSteps $I){
        $I->AdminLogin($admin_email = 'ad@min.com', $admin_password = 'admin');
        $I->amOnPage(SaasUserListPage::$URL);
        $I->wait(1);
        $I->click(SaasUserListPage::$FilterDomainLabel);
        $I->fillField(SaasUserListPage::$FilterDomainInput, $this->store_name);
        $I->click(SaasUserListPage::$FilterActiveLabel);
        $I->click(SaasUserListPage::$FilterActiveSelect);
        $I->click(SaasUserListPage::FilterActiveSelectOption(2));
        $I->click(SaasUserListPage::$FilterButtonFilter);
        $I->see($this->store_name, SaasUserListPage::lineDomainLink(1));
        $I->click(SaasUserListPage::lineActionlink(1));
        $I->click(SaasUserListPage::ButtonDisable(1));
        $I->wait(5);
    }
    
    
    
    
    
    
    
    
    
    
    
}    
