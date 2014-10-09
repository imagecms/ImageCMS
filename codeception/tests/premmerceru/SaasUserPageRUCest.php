<?php

use \RussianTester;

class SaasUserPageRUCest


{
   private $store_url = 'zagibokpolymjagkiy.premme.ru';
//   private $store_url = 'message.premme.ru';

   private $store_name = 'zagibokpolymjagkiy';
   private $user_email = 'premmerce.testers@gmail.com';
   private $user_password = '54319876';
   private $user_name = 'Tomi Mikky Dob';
   private $user_phone = '55777991113322';
   private $user_city = 'Любер Дед Тюмень';


   
   private $tarif_free = 'Free';
   private $tarif_basic = 'Basic';
   private $tarif_standart = 'Standart';
   private $tarif_business = 'Business';
   private $tarif_premium = 'Premium';
   

   
   private $price_free = '0 руб / мес';
   private $price_basic = '599 руб / мес';
   private $price_standart = '1399 руб / мес';
   private $price_business = '2399 руб / мес';
   private $price_premium = '4499 руб / мес';
   
   
   
   
    /**
     * @group aa
     * @guy RussianTester\LocrusSteps 
     */
    public function CreateStore(RussianTester\LocrusSteps $I){
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
        $I->wait(1);
        $I->seeInCurrentUrl('/saas/profile');
        $I->see('Баланс', PremmerceCabinetPage::$HeadTextBalans);
        $I->see('дней', PremmerceCabinetPage::$HeadTextDay);
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
        $I->wait(1);
//        $I->click(PremmerceCabinetPage::$HeadLinkShop);
//        $I->seeInCurrentUrl();
        $I->CabinetLogout();
    }
    

    
    
    /**
     * @group aaaaa
     * @guy RussianTester\LocrusSteps 
     */
    public function CheckSaas(RussianTester\LocrusSteps $I){
        $I->AdminLogin($admin_email = 'ad@min.com', $admin_password = 'admin');
        $I->click(\SaasUserListPage::$NavigationModules);
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
        $I->wait(12);
        $I->reloadPage();
        $I->AdminLogout();
    }
    
    
    
    /**
     * @group aa
     * @guy RussianTester\LocrusSteps 
     */
    public function CheckOffCabinet (RussianTester\LocrusSteps $I){
        $I->CabinetLogin($user_email = $this->user_email, $user_password = $this->user_password);
        $I->wait(1);
        $I->seeInCurrentUrl('/saas/profile');
        $I->see('Магазин отключен', PremmerceCabinetPage::$HeadTextShopOff);
        $I->see('Сплать', PremmerceCabinetPage::$HeadTextPaid);
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
        $I->CabinetLogout();
    }
    
    
    
    
    
    
    /**
     * @group aa
     * @guy RussianTester\LocrusSteps 
     */
    public function CheckOffSaas(RussianTester\LocrusSteps $I){
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
        $I->wait(12);
        $I->reloadPage();
        $I->AdminLogout();
    }
    
    
    /**
     * @group aa
     * @guy RussianTester\LocrusSteps 
     */
    public function CheckOnCabinet (RussianTester\LocrusSteps $I){
        $I->CabinetLogin($user_email = $this->user_email, $user_password = $this->user_password);
        $I->wait(1);
        $I->seeInCurrentUrl('/saas/profile');
        $I->see('Баланс', '//body/div[1]/header/div/div[2]/a/span[2]/span[1]');
        $I->see('дней', '//body/div[1]/header/div/div[2]/a/span[2]/span[3]');
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
        $I->CabinetLogout();
    }
        
    
    
    /**
     * @group aa
     * @guy RussianTester\LocrusSteps 
     */
    public function FilterPhone(RussianTester\LocrusSteps $I){
        $I->AdminLogin($admin_email = 'ad@min.com', $admin_password = 'admin');
        $I->amOnPage(SaasUserListPage::$URL);
        $I->wait(1);
        $I->click(SaasUserListPage::$FilterPhoneLabel);
        $I->fillField(SaasUserListPage::$FilterPhoneInput, $this->user_phone);
        $I->click(SaasUserListPage::$FilterButtonFilter);
        $I->see($this->user_phone, SaasUserListPage::linePhoneText(1));
        $I->AdminLogout();
    } 
    
    /**
     * @group aa
     * @guy RussianTester\LocrusSteps 
     */
    public function FilterName(RussianTester\LocrusSteps $I){
        $I->AdminLogin($admin_email = 'ad@min.com', $admin_password = 'admin');
        $I->amOnPage(SaasUserListPage::$URL);
        $I->wait(1);
        $I->click(SaasUserListPage::$FilterNameLabel);
        $I->fillField(SaasUserListPage::$FilterNameInput, $this->user_name);
        $I->click(SaasUserListPage::$FilterButtonFilter);
        $I->see($this->user_name, SaasUserListPage::lineNameText(1));
        $I->AdminLogout();
    }
    
    
    
    /**
     * @group aa
     * @guy RussianTester\LocrusSteps 
     */
    public function FilterEmail(RussianTester\LocrusSteps $I){
        $I->AdminLogin($admin_email = 'ad@min.com', $admin_password = 'admin');
        $I->amOnPage(SaasUserListPage::$URL);
        $I->wait(1);
        $I->click(SaasUserListPage::$FilterEmailLabel);
        $I->fillField(SaasUserListPage::$FilterEmailInput, $this->user_email);
        $I->click(SaasUserListPage::$FilterButtonFilter);
        $I->see($this->user_email, SaasUserListPage::lineEmailLink(1));
        $I->AdminLogout();
    }
    
    
    /**
     * @group aa
     * @guy RussianTester\LocrusSteps 
     */
    public function FilterCountry(RussianTester\LocrusSteps $I){
        $I->AdminLogin($admin_email = 'ad@min.com', $admin_password = 'admin');
        $I->amOnPage(SaasUserListPage::$URL);
        $I->wait(1);
        $I->click(SaasUserListPage::$FilterDomainLabel);
        $I->fillField(SaasUserListPage::$FilterDomainInput, $this->store_name);
        $I->click(SaasUserListPage::$FilterCountryLabel);
        $I->click(SaasUserListPage::$FilterCountrySelect);
        $I->click(SaasUserListPage::FilterCountrySelectOption(2));
        $I->click(SaasUserListPage::$FilterButtonFilter);
        $I->see($this->user_email, SaasUserListPage::lineEmailLink(1));
        $I->AdminLogout();
    }
    
    
    /**
     * @group aa
     * @guy RussianTester\LocrusSteps 
     */
    public function FilterCity(RussianTester\LocrusSteps $I){
        $I->AdminLogin($admin_email = 'ad@min.com', $admin_password = 'admin');
        $I->amOnPage(SaasUserListPage::$URL);
        $I->wait(1);
        $I->click(SaasUserListPage::$FilterCityLabel);
        $I->fillField(SaasUserListPage::$FilterCityInput, $this->user_city);
        $I->click(SaasUserListPage::$FilterButtonFilter);
        $I->see($this->user_email, SaasUserListPage::lineEmailLink(1));
        $I->AdminLogout();
    }
    
    
    
    
    /**
     * @group aa
     * @guy RussianTester\LocrusSteps 
     */
    public function FilterTarif(RussianTester\LocrusSteps $I){
        $I->AdminLogin($admin_email = 'ad@min.com', $admin_password = 'admin');
        $I->amOnPage(SaasUserListPage::$URL);
        $I->wait(1);
        $I->click(SaasUserListPage::$FilterDomainLabel);
        $I->fillField(SaasUserListPage::$FilterDomainInput, $this->store_name);
        $I->click(SaasUserListPage::$FilterTarifLabel);
        $I->click(SaasUserListPage::$FilterTarifSelect);
        $I->click(SaasUserListPage::FilterTarifSelectOption(3));
        $I->click(SaasUserListPage::$FilterButtonFilter);
        $I->see($this->user_email, SaasUserListPage::lineEmailLink(1));
        $I->AdminLogout();
    }
    
    
    
    /**
     * @group aa
     * @guy RussianTester\LocrusSteps 
     */
    public function FilterLevel(RussianTester\LocrusSteps $I){
        $I->AdminLogin($admin_email = 'ad@min.com', $admin_password = 'admin');
        $I->amOnPage(SaasUserListPage::$URL);
        $I->wait(1);
        $I->click(SaasUserListPage::$FilterEmailLabel);
        $I->fillField(SaasUserListPage::$FilterEmailInput, $this->user_email);
        $I->click(SaasUserListPage::$FilterLevelLabel);
        $I->click(SaasUserListPage::$FilterLevelSelect);
        $I->click(SaasUserListPage::FilterLevelSelectOption(2));
        $I->click(SaasUserListPage::$FilterButtonFilter);
        $I->see($this->user_email, SaasUserListPage::lineEmailLink(1));
        $I->AdminLogout();
    }
    
    
    /**
     * @group aa
     * @guy RussianTester\LocrusSteps 
     */
    public function FilterCategory(RussianTester\LocrusSteps $I){
        $I->AdminLogin($admin_email = 'ad@min.com', $admin_password = 'admin');
        $I->amOnPage(SaasUserListPage::$URL);
        $I->wait(1);
        $I->click(SaasUserListPage::$FilterEmailLabel);
        $I->fillField(SaasUserListPage::$FilterEmailInput, $this->user_email);
        $I->click(SaasUserListPage::$FilterCategoryLabel);
        $I->click(SaasUserListPage::$FilterCategorySelect);
        $I->click(SaasUserListPage::FilterCategorySelectOption(3));
        $I->click(SaasUserListPage::$FilterButtonFilter);
        $I->see($this->user_email, SaasUserListPage::lineEmailLink(1));
        $I->AdminLogout();
    }
    
    
    /**
     * @group aa
     * @guy RussianTester\LocrusSteps 
     */
//    public function FilterAmountProduct(RussianTester\LocrusSteps $I){
//        $I->AdminLogin($admin_email = 'ad@min.com', $admin_password = 'admin');
//        $I->amOnPage(SaasUserListPage::$URL);
//        $I->wait(1);
//        $I->click(SaasUserListPage::$FilterEmailLabel);
//        $I->fillField(SaasUserListPage::$FilterEmailInput, $this->user_email);
//        $I->click(SaasUserListPage::$FilterAmountProducntLabel);
//        $I->fillField(SaasUserListPage::$FilterAmountProducntInputFrom, '1');
//        $I->fillField(SaasUserListPage::$FilterAmountProducntInputTo, '1111');
//        $I->click(SaasUserListPage::$FilterButtonFilter);
//        $I->see($this->user_email, SaasUserListPage::lineEmailLink(1));
//        $I->AdminLogout();
//    }

    
    
    /**
     * @group aa
     * @guy RussianTester\LocrusSteps 
     */
//    public function FilterDisk(RussianTester\LocrusSteps $I){
//        $I->AdminLogin($admin_email = 'ad@min.com', $admin_password = 'admin');
//        $I->amOnPage(SaasUserListPage::$URL);
//        $I->wait(1);
//        $I->click(SaasUserListPage::$FilterEmailLabel);
//        $I->fillField(SaasUserListPage::$FilterEmailInput, $this->user_email);
//        $I->click(SaasUserListPage::$FilterDiskLimitLabel);
//        $I->fillField(SaasUserListPage::$FilterDiskLimitInputFrom, '1');
//        $I->fillField(SaasUserListPage::$FilterDiskLimitInputTo, '1111');
//        $I->click(SaasUserListPage::$FilterButtonFilter);
//        $I->see($this->user_email, SaasUserListPage::lineEmailLink(1));
//        $I->AdminLogout();
//    }
    
    
    
    /**
     * @group aaa
     * @guy RussianTester\LocrusSteps 
     */
//    public function FilterBalans(RussianTester\LocrusSteps $I){
//        $I->AdminLogin($admin_email = 'ad@min.com', $admin_password = 'admin');
//        $I->amOnPage(SaasUserListPage::$URL);
//        $I->wait(1);
//        $I->click(SaasUserListPage::$FilterEmailLabel);
//        $I->fillField(SaasUserListPage::$FilterEmailInput, $this->user_email);
//        $I->click(SaasUserListPage::$FilterBalansLabel);
//        $I->fillField(SaasUserListPage::$FilterBalansInputFrom, '1');
//        $I->fillField(SaasUserListPage::$FilterBalansInputTo, '1111');
//        $I->click(SaasUserListPage::$FilterButtonFilter);
//        $I->see($this->user_email, SaasUserListPage::lineEmailLink(1));
//        $I->AdminLogout();
//    }
    
    
    
    /**
     * @group aaa
     * @guy RussianTester\LocrusSteps 
     */
//    public function FilterManager(RussianTester\LocrusSteps $I){
//        $I->AdminLogin($admin_email = 'ad@min.com', $admin_password = 'admin');
//        $I->amOnPage(SaasUserListPage::$URL);
//        $I->wait(1);
//        $I->click(SaasUserListPage::$FilterEmailLabel);
//        $I->fillField(SaasUserListPage::$FilterEmailInput, $this->user_email);
//        $I->click(SaasUserListPage::$FilterManagerLabel);
//        $I->click(SaasUserListPage::$FilterManagerSelect);
//        $I->click(SaasUserListPage::FilterManagerSelectOption(3));
//        $I->click(SaasUserListPage::$FilterButtonFilter);
//        $I->see($this->user_email, SaasUserListPage::lineEmailLink(1));
//        $I->AdminLogout();
//    }
    
    
    

    /**
     * @group aa
     * @guy RussianTester\LocrusSteps 
     */
//    public function FilterDomainEnd(RussianTester\LocrusSteps $I){
//        $I->AdminLogin($admin_email = 'ad@min.com', $admin_password = 'admin');
//        $I->amOnPage(SaasUserListPage::$URL);
//        $I->wait(1);
//        $I->click(SaasUserListPage::$FilterEmailLabel);
//        $I->fillField(SaasUserListPage::$FilterEmailInput, $this->user_email);
//        $I->click(SaasUserListPage::$FilterDomainEndLabel);
//        $I->click(SaasUserListPage::$FilterDomainEndLabel);
//        $I->click(SaasUserListPage::FilterDomainEndSelectOption(3));
//        $I->click(SaasUserListPage::$FilterButtonFilter);
//        $I->see($this->user_email, SaasUserListPage::lineEmailLink(1));
//        $I->AdminLogout();
//    }
    
    
    
    
    
    /**
     * @group aa
     * @guy RussianTester\LocrusSteps 
     */
//    public function FilterActivateByEmail(RussianTester\LocrusSteps $I){
//        $I->AdminLogin($admin_email = 'ad@min.com', $admin_password = 'admin');
//        $I->amOnPage(SaasUserListPage::$URL);
//        $I->wait(1);
//        $I->click(SaasUserListPage::$FilterEmailLabel);
//        $I->fillField(SaasUserListPage::$FilterEmailInput, $this->user_email);
//        $I->click(SaasUserListPage::$FilterActivatedByEmailLabel);
//        $I->click(SaasUserListPage::$FilterActivatedByEmailSelect);
//        $I->click(SaasUserListPage::FilterActivatedByEmailSelectOption(2));
//        $I->click(SaasUserListPage::$FilterButtonFilter);
//        $I->see($this->user_email, SaasUserListPage::lineEmailLink(1));
//        $I->AdminLogout();
//    }
    
    
    
    /**
     * @group aaa
     * @guy RussianTester\LocrusSteps 
     */
//    public function FilterFillProduct(RussianTester\LocrusSteps $I){
//        $I->AdminLogin($admin_email = 'ad@min.com', $admin_password = 'admin');
//        $I->amOnPage(SaasUserListPage::$URL);
//        $I->wait(1);
//        $I->click(SaasUserListPage::$FilterEmailLabel);
//        $I->fillField(SaasUserListPage::$FilterEmailInput, $this->user_email);
//        $I->click(SaasUserListPage::$FilterFillProductsLabel);
//        $I->click(SaasUserListPage::$FilterFillProductsSelect);
//        $I->click(SaasUserListPage::FilterFillProductsSelectOption(2));
//        $I->click(SaasUserListPage::$FilterButtonFilter);
//        $I->see($this->user_email, SaasUserListPage::lineEmailLink(1));
//        $I->AdminLogout();
//    }
    
    
    
    /**
     * @group aa
     * @guy RussianTester\LocrusSteps 
     */
//    public function FilterStatuses(RussianTester\LocrusSteps $I){
//        $I->AdminLogin($admin_email = 'ad@min.com', $admin_password = 'admin');
//        $I->amOnPage(SaasUserListPage::$URL);
//        $I->wait(1);
//        $I->click(SaasUserListPage::$FilterEmailLabel);
//        $I->fillField(SaasUserListPage::$FilterEmailInput, $this->user_email);
//        $I->click(SaasUserListPage::$FilterStatusesLabel);
//        $I->click(SaasUserListPage::$FilterStatusesSelect);
//        $I->click(SaasUserListPage::FilterStatusesSelectOption(2));
//        $I->click(SaasUserListPage::$FilterButtonFilter);
//        $I->see($this->user_email, SaasUserListPage::lineEmailLink(1));
//        $I->AdminLogout();
//    }
    
    /**
     * @group aaa
     * @guy RussianTester\LocrusSteps 
     */
    public function FilterDepartments(RussianTester\LocrusSteps $I){
        $I->AdminLogin($admin_email = 'ad@min.com', $admin_password = 'admin');
        $I->amOnPage(SaasUserListPage::$URL);
        $I->wait(1);
        $I->click(SaasUserListPage::$FilterEmailLabel);
        $I->fillField(SaasUserListPage::$FilterEmailInput, $this->user_email);
        $I->click(SaasUserListPage::$FilterDepartmentsLabel);
        $I->click(SaasUserListPage::$FilterDepartmentsSelect);
        $I->click(SaasUserListPage::FilterDepartmentsSelectOption(2));
        $I->click(SaasUserListPage::$FilterButtonFilter);
        $I->see($this->user_email, SaasUserListPage::lineEmailLink(1));
        $I->AdminLogout();
    }
    
    
    
    
    
    
    
    
    
   /////////////////////////////////////////////////////////////////////////////
   //DELETE SHOP     DELETE SHOP    DELETE SHOP    DELETE SHOP   DELETE SHOP  //                    
    /**
     * @group a
     * @guy RussianTester\LocrusSteps 
     */
    public function DeleteSahopSaas(RussianTester\LocrusSteps $I){
        $I->AdminLogin($admin_email = 'ad@min.com', $admin_password = 'admin');
        $I->amOnPage(SaasUserListPage::$URL);
        $I->wait(1);
        $I->click(SaasUserListPage::$FilterDomainLabel);
        $I->fillField(SaasUserListPage::$FilterDomainInput, $this->store_name);
        $I->click(SaasUserListPage::$FilterButtonFilter);
        $I->see($this->store_name, SaasUserListPage::lineDomainLink(1));
        $I->click(SaasUserListPage::lineActionlink(1));
        $I->click(SaasUserListPage::ButtonDelete(1));
        $I->wait(3);
        $I->AdminLogout();
    }    
        
        
    
    
    
    
    
    
    
    
    
}    

