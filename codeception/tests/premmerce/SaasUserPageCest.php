<?php

use \PremmerceTester;

class SaasUserPageCest


{
//   private $Store_Url = 'populationnationn.premme.com';
   private $Cabinet_Url = '/saas/profile';


   private $Store_Name = 'population';
   private $User_Email = 'premme.test@test.com';
   private $User_Password = '98765431';
   private $User_Name = 'Bazooka Band Powerviolence Go';
   private $User_Phone = '11144226677788';
   private $User_City = 'Львів Сіті Сінь Пянь';


   
   private $Tariff_Free = 'Free';
   private $Tariff_Basic = 'Basic';
   private $Tariff_Standart = 'Standart';
   private $Tariff_Business = 'Business';
   private $Tariff_Premium = 'Premium';
   
   private $Status_Name = 'Test Saas';
   private $Status_Description = 'Jira PRMS-16 Admin page for Managers. Tests';
   
   private $Department_Name = 'Test QA';
   private $Department_Description = 'Test - Jira PRMS-16 Admin page for Managers';
   
   private $Admin_Amount_Point = '33';
   private $Admin_Name_Manager = 'Олена Іванець';
   private $Admin_End_Domain;
   private $Admin_Fill_Product;
   
   private $Empty_List = '.alert.alert-info';
   
   
   private $Cabinet_Name_Country;
   private $Cabinet_Name_Tariff;
   private $Cabinet_Amount_Product;
   private $Cabinet_Amount_Disk;
   private $Cabinet_Level;
   private $Cabinet_Category;
   
   
    /**
     * @group status123
     * @guy PremmerceTester\PremmerceSteps 
     */
    public function CreateStore(PremmerceTester\PremmerceSteps $I){
//        $I->loginCabinet($user_email = $this->User_Email, $user_password = $this->User_Password);
        $I->amOnPage(MainPage::$URL);
        $I->wait(3);  
        $I->click(MainPage::$ButtonCreateStore);
        $I->createStore($store_name         = $this->Store_Name,
                        $user_email         = $this->User_Email,
                        $user_password      = $this->User_Password,
                        $country            = NULL,
                        $user_name          = $this->User_Name,
                        $user_phone         = $this->User_Phone,
                        $user_city          = $this->User_City,
                        $product_category   = '3',
                        $product_level      = '2');
        $I->wait(1);
        $I->seeInCurrentUrl(CabinetPage::$URL);
        $I->see($this->Store_Name, CabinetPage::$TabMainFieldSiteLink);
        $I->see($this->Store_Name, CabinetPage::$TabMainFieldAdminLink);
        $I->click(CabinetPage::$TabProfile);
        $I->wait(1);
        $I->seeInField(CabinetPage::$TabProfileInputdName, $this->User_Name);
        $I->seeInField(CabinetPage::$TabProfileInputPhone, $this->User_Phone);
        $I->seeInField(CabinetPage::$TabProfileInputCity, $this->User_City);
        $I->seeInField(CabinetPage::$TabProfileInputEmail, $this->User_Email);        
        $I->wait(3);
        $I->logoutCabinet();
    }

    /**
     * @group a
     * @guy PremmerceTester\PremmerceSteps 
     */
    public function CheckOffStoreSaas(PremmerceTester\PremmerceSteps $I){
        $I->login($user_email = USER_EMAIL, $user_password = USER_PASSWORD);
        $I->click(SaasGeneralPage::$Modules);
        $I->wait(1);
        $I->click(SaasGeneralPage::$ModulSaas);
        $I->wait(1);
        $I->click(SaasGeneralPage::$ModulSaasTabUser);
        $I->wait(1);
        $I->click(SaasUserListPage::$FilterDomainLabel);
        $I->fillField(SaasUserListPage::$FilterDomainInput, $this->Store_Name);
        $I->click(SaasUserListPage::$FilterButtonFilter);
        $I->see($this->Store_Name, SaasUserListPage::lineDomainLink(1));
        $I->wait(1);
        $I->click(SaasUserListPage::lineActionlink(1));
        $I->click(SaasUserListPage::ButtonDisable(1));
        $I->reloadPage();
        $I->logoutSaas();
    }
    
    
    
    /**
     * @group a
     * @guy PremmerceTester\PremmerceSteps
     */
    public function CheckOffCabinet (PremmerceTester\PremmerceSteps $I){
        $I->loginCabinet($user_email = $this->User_Email, $user_password = $this->User_Password);
        $I->wait(4);
        $I->seeInCurrentUrl($this->Cabinet_Url);
        $I->see($this->Store_Name, CabinetPage::$TabMainFieldSiteLink);
        $I->see($this->Store_Name, CabinetPage::$TabMainFieldAdminLink);
        $I->see($this->Tarif_Standart, CabinetPage::$TabMainFieldTariffNameText);
        $I->click(CabinetPage::$TabProfile);
        $I->wait(1);
        $I->seeInField(CabinetPage::$TabProfileInputdName, $this->User_Name);
        $I->seeInField(CabinetPage::$TabProfileInputPhone, $this->User_Phone);
        $I->seeInField(CabinetPage::$TabProfileInputCity, $this->User_City);
        $I->seeInField(CabinetPage::$TabProfileInputEmail, $this->User_Email);
        $I->logoutCabinet();
    }
    
    
    
    
    
    
    /**
     * @group a
     * @guy PremmerceTester\PremmerceSteps
     */
    public function CheckOffSaas(PremmerceTester\PremmerceSteps $I){
        $I->login($admin_email = USER_EMAIL, $admin_password = USER_PASSWORD);
        $I->amOnPage(SaasUserListPage::$URL);
        $I->wait(1);
        $I->click(SaasUserListPage::$FilterDomainLabel);
        $I->fillField(SaasUserListPage::$FilterDomainInput, $this->Store_Name);
        $I->click(SaasUserListPage::$FilterActiveLabel);
        $I->click(SaasUserListPage::$FilterActiveSelect);
        $I->click(SaasUserListPage::FilterActiveSelectOption(2));
        $I->click(SaasUserListPage::$FilterButtonFilter);
        $I->wait(1);
        $I->see($this->Store_Name, SaasUserListPage::lineDomainLink(1));
        $I->click(SaasUserListPage::lineActionlink(1));
        $I->click(SaasUserListPage::ButtonDisable(1));
        $I->wait(7);
        $I->reloadPage();
        $I->logoutSaas();
    }
    
    
    /**
     * @group a
     * @guy PremmerceTester\PremmerceSteps 
     */
    public function CheckOnCabinet (PremmerceTester\PremmerceSteps $I){
        $I->loginCabinet($user_email = $this->User_Email, $user_password = $this->User_Password);
        $I->wait(1);
        $I->seeInCurrentUrl('/saas/profile');
        $I->see($this->Store_Name, CabinetPage::$TabMainFieldSiteLink);
        $I->see($this->Store_Name, CabinetPage::$TabMainFieldAdminLink);
        $I->see($this->Tarif_Standart, CabinetPage::$TabMainFieldTariffNameText);
        $I->click(CabinetPage::$TabProfile);
        $I->wait(1);
        $I->seeInField(CabinetPage::$TabProfileInputdName, $this->User_Name);
        $I->seeInField(CabinetPage::$TabProfileInputPhone, $this->User_Phone);
        $I->seeInField(CabinetPage::$TabProfileInputCity, $this->User_City);
        $I->seeInField(CabinetPage::$TabProfileInputEmail, $this->User_Email);
        $I->logoutCabinet();
    }
        
    
    
    /**
     * @group a
     * @guy PremmerceTester\PremmerceSteps 
     */
    public function FilterPhone(PremmerceTester\PremmerceSteps $I){
        $I->login($admin_email = USER_EMAIL, $admin_password = USER_PASSWORD);
        $I->amOnPage(SaasUserListPage::$URL);
        $I->wait(1);
        $I->click(SaasUserListPage::$FilterPhoneLabel);
        $I->fillField(SaasUserListPage::$FilterPhoneInput, $this->User_Phone);
        $I->click(SaasUserListPage::$FilterButtonFilter);
        $I->wait(1);
        $I->see($this->User_Phone, SaasUserListPage::linePhoneText(1));
        $I->logoutSaas();
    } 
    
    
    
    
    /**
     * @group a
     * @guy PremmerceTester\PremmerceSteps 
     */
    public function FilterPhoneEmptyList(PremmerceTester\PremmerceSteps $I){
        $I->login($admin_email = USER_EMAIL, $admin_password = USER_PASSWORD);
        $I->amOnPage(SaasUserListPage::$URL);
        $I->wait(1);
        $I->click(SaasUserListPage::$FilterDomainLabel);
        $I->fillField(SaasUserListPage::$FilterDomainInput, '!@#+-*/');
        $I->click(SaasUserListPage::$FilterPhoneLabel);
        $I->fillField(SaasUserListPage::$FilterPhoneInput, $this->User_Phone);
        $I->click(SaasUserListPage::$FilterButtonFilter);
        $I->wait(1);
        $I->dontSee($this->User_Phone, SaasUserListPage::linePhoneText(1));
        $I->seeElement($this->Empty_List);
        $I->logoutSaas();
    } 
    
    
    
    /**
     * @group a
     * @guy PremmerceTester\PremmerceSteps
     */
    public function FilterName(PremmerceTester\PremmerceSteps $I){
        $I->login($admin_email = USER_EMAIL, $admin_password = USER_PASSWORD);
        $I->amOnPage(SaasUserListPage::$URL);
        $I->wait(1);
        $I->click(SaasUserListPage::$FilterNameLabel);
        $I->fillField(SaasUserListPage::$FilterNameInput, $this->User_Name);
        $I->click(SaasUserListPage::$FilterButtonFilter);
        $I->wait(1);
        $I->see($this->User_Name, SaasUserListPage::lineNameText(1));
        $I->logoutSaas();
    }
    
    
    
    /**
     * @group a
     * @guy PremmerceTester\PremmerceSteps
     */
    public function FilterEmail(PremmerceTester\PremmerceSteps $I){
        $I->login($admin_email = USER_EMAIL, $admin_password = USER_PASSWORD);
        $I->amOnPage(SaasUserListPage::$URL);
        $I->wait(1);
        $I->click(SaasUserListPage::$FilterEmailLabel);
        $I->fillField(SaasUserListPage::$FilterEmailInput, $this->User_Email);
        $I->click(SaasUserListPage::$FilterButtonFilter);
        $I->wait(1);
        $I->see($this->User_Email, SaasUserListPage::lineEmailLink(1));
        $I->logoutSaas();
    }
    
    
    
    
    /**
     * @group a
     * @guy PremmerceTester\PremmerceSteps 
     */
    public function FilterNameAndEmailEmptyList(PremmerceTester\PremmerceSteps $I){
        $I->login($admin_email = USER_EMAIL, $admin_password = USER_PASSWORD);
        $I->amOnPage(SaasUserListPage::$URL);
        $I->wait(1);
        $I->click(SaasUserListPage::$FilterDomainLabel);
        $I->fillField(SaasUserListPage::$FilterDomainInput, '!@#+-*/');
        $I->click(SaasUserListPage::$FilterNameLabel);
        $I->fillField(SaasUserListPage::$FilterNameInput, $this->User_Name);
        $I->click(SaasUserListPage::$FilterEmailLabel);
        $I->fillField(SaasUserListPage::$FilterEmailInput, $this->User_Email);
        $I->click(SaasUserListPage::$FilterButtonFilter);
        $I->wait(1);
        $I->dontSee($this->User_Email, SaasUserListPage::lineEmailLink(1));
        $I->dontSee($this->User_Name, SaasUserListPage::lineNameText(1));
        $I->seeElement($this->Empty_List);
        $I->logoutSaas();
    } 
    
    
    /**
     * @group a
     * @guy PremmerceTester\PremmerceSteps 
     */
    public function CetNameCountry(PremmerceTester\PremmerceSteps $I){
        $I->loginCabinet($user_email = $this->User_Email, $user_password = $this->User_Password);
        $I->wait(1);
        $I->click(CabinetPage::$TabProfile);
        $I->wait(1);
        $Get_Name_Country = $I->grabTextFrom(CabinetPage::$TabProfileSelectCountry);
        $this->Cabinet_Name_Country = $Get_Name_Country;
        $I->logoutCabinet();
    }
    
    /**
     * @group a
     * @guy PremmerceTester\PremmerceSteps
     */
    public function FilterCountry(PremmerceTester\PremmerceSteps $I){
        $I->login($admin_email = USER_EMAIL, $admin_password = USER_PASSWORD);
        $I->amOnPage(SaasUserListPage::$URL);
        $I->wait(1);
        $I->click(SaasUserListPage::$FilterNameLabel);
        $I->fillField(SaasUserListPage::$FilterNameInput, $this->User_Name);
        $I->click(SaasUserListPage::$FilterCountryLabel);
        $I->wait(1);
        $I->selectOption(SaasUserListPage::$FilterCountrySelect, $this->Cabinet_Name_Country);
        $I->click(SaasUserListPage::$FilterButtonFilter);
        $I->wait(1);
        $I->see($this->User_Email, SaasUserListPage::lineEmailLink(1));
        $I->logoutSaas();
    }
    
    
    /**
     * @group a
     * @guy PremmerceTester\PremmerceSteps
     */
    public function FilterCity(PremmerceTester\PremmerceSteps $I){
        $I->login($admin_email = USER_EMAIL, $admin_password = USER_PASSWORD);
        $I->amOnPage(SaasUserListPage::$URL);
        $I->wait(1);
        $I->click(SaasUserListPage::$FilterCityLabel);
        $I->fillField(SaasUserListPage::$FilterCityInput, $this->User_City);
        $I->click(SaasUserListPage::$FilterButtonFilter);
        $I->wait(1);
        $I->see($this->User_Email, SaasUserListPage::lineEmailLink(1));
        $I->logoutSaas();
    }
    
    
    
    /**
     * @group Tariff
     * @guy PremmerceTester\PremmerceSteps 
     */
    public function CetNameTariff(PremmerceTester\PremmerceSteps $I){
        $I->login($user_email = USER_EMAIL, $user_password = USER_PASSWORD);
        $I->amOnPage(SaasUserListPage::$URL);
        $I->wait(1);
        $I->click(SaasUserListPage::$FilterDomainLabel);
        $I->fillField(SaasUserListPage::$FilterDomainInput, $this->Store_Name);
        $I->click(SaasUserListPage::$FilterButtonFilter);
        $I->wait(1);
        $Get_Name_Tariff = $I->grabTextFrom(SaasUserListPage::lineTariffText(1));
        $this->Cabinet_Name_Tariff = $Get_Name_Tariff;
        $I->logoutSaas();
    }
    
    
    /**
     * @group Tariff
     * @guy PremmerceTester\PremmerceSteps
     */
    public function FilterTariff(PremmerceTester\PremmerceSteps $I){
        $I->login($admin_email = USER_EMAIL, $admin_password = USER_PASSWORD);
        $I->amOnPage(SaasUserListPage::$URL);
        $I->wait(1);
        $I->click(SaasUserListPage::$FilterDomainLabel);
        $I->fillField(SaasUserListPage::$FilterDomainInput, $this->Store_Name);
        $I->click(SaasUserListPage::$FilterTariffLabel);
        $I->wait(1);
        $I->selectOption(SaasUserListPage::$FilterTariffSelect, $this->Cabinet_Name_Tariff);
        $I->wait(1);
//        $I->click(SaasUserListPage::$FilterButtonFilter);
        $I->wait(1);
        $I->see($this->Cabinet_Name_Tariff, SaasUserListPage::lineTariffText(1));
        $I->logoutSaas();
    }
    
    
    /**
     * @group a
     * @guy PremmerceTester\PremmerceSteps 
     */
    public function CetNameLevel(PremmerceTester\PremmerceSteps $I){
        $I->loginCabinet($user_email = $this->User_Email, $user_password = $this->User_Password);
        $I->wait(1);
        $I->click(CabinetPage::$TabProfile);
        $I->wait(1);
        $Get_Name_level = $I->grabTextFrom(CabinetPage::$TabProfileSelectProduct);
        $I->comment("$Get_Name_level");
        $this->Cabinet_Level = $Get_Name_level;
        $I->logoutCabinet();
    }
    
    
    
    /**
     * @group a
     * @guy PremmerceTester\PremmerceSteps
     */
    public function FilterLevel(PremmerceTester\PremmerceSteps $I){
        $I->login($admin_email = USER_EMAIL, $admin_password = USER_PASSWORD);
        $I->amOnPage(SaasUserListPage::$URL);
        $I->wait(1);
        $I->click(SaasUserListPage::$FilterEmailLabel);
        $I->fillField(SaasUserListPage::$FilterEmailInput, $this->User_Email);
        $I->click(SaasUserListPage::$FilterLevelLabel);
        $I->selectOption(SaasUserListPage::$FilterLevelSelect, $this->Cabinet_Level);
        $I->click(SaasUserListPage::$FilterButtonFilter);
        $I->wait(1);
        $I->see($this->User_Email, SaasUserListPage::lineEmailLink(1));
        $I->logoutSaas();
    }
    
    
    /**
     * @group a
     * @guy PremmerceTester\PremmerceSteps 
     */
    public function CetNameCategory(PremmerceTester\PremmerceSteps $I){
        $I->loginCabinet($user_email = $this->User_Email, $user_password = $this->User_Password);
        $I->wait(1);
        $I->click(CabinetPage::$TabProfile);
        $I->wait(1);
        $Get_Name_Category = $I->grabTextFrom(CabinetPage::$TabProfileSelectCategory);
        $I->comment("$Get_Name_Category");        
        $this->Cabinet_Category = $Get_Name_Category;
        $I->logoutCabinet();
    }
    
    
    /**
     * @group a
     * @guy PremmerceTester\PremmerceSteps
     */
    public function FilterCategory(PremmerceTester\PremmerceSteps $I){
        $I->login($admin_email = USER_EMAIL, $admin_password = USER_PASSWORD);
        $I->amOnPage(SaasUserListPage::$URL);
        $I->wait(1);
        $I->click(SaasUserListPage::$FilterEmailLabel);
        $I->fillField(SaasUserListPage::$FilterEmailInput, $this->User_Email);
        $I->click(SaasUserListPage::$FilterCategoryLabel);
        $I->selectOption(SaasUserListPage::$FilterCategorySelect, $this->Cabinet_Category);
        $I->click(SaasUserListPage::$FilterButtonFilter);
        $I->wait(1);
        $I->see($this->User_Email, SaasUserListPage::lineEmailLink(1));
        $I->logoutSaas();
    }
    
    
    /**
     * @group a
     * @guy PremmerceTester\PremmerceSteps 
     */
//    public function CetAmountProduct(PremmerceTester\PremmerceSteps $I){
//        $I->loginCabinet($user_email = $this->User_Email, $user_password = $this->User_Password);
//        $I->wait(3);
//        $Get_Amount_Product = $I->grabTextFrom('//table/tbody/tr[5]/td/span');
//        preg_match('/[0-9]*/', $Get_Amount_Product,$number);
//        $Get_Amount_Product = $number[0];
//        $I->comment("$Get_Amount_Product");
//        $this->Cabinet_Amount_Product = $Get_Amount_Product;
//        $I->wait(1);
//        $I->logoutCabinet();
//    }
    
    
    /**
     * @group a
     * @guy PremmerceTester\PremmerceSteps
     */
//    public function FilterAmountProduct(PremmerceTester\PremmerceSteps $I){
//        $I->login($admin_email = USER_EMAIL, $admin_password = USER_PASSWORD);
//        $I->amOnPage(SaasUserListPage::$URL);
//        $I->wait(1);
//        $I->click(SaasUserListPage::$FilterEmailLabel);
//        $I->fillField(SaasUserListPage::$FilterEmailInput, $this->User_Email);
//        $I->click(SaasUserListPage::$FilterAmountProducntLabel);
//        $I->fillField(SaasUserListPage::$FilterAmountProducntInputFrom, $this->Cabinet_Amount_Product);
//        $I->fillField(SaasUserListPage::$FilterAmountProducntInputTo, $this->Cabinet_Amount_Product);
//        $I->click(SaasUserListPage::$FilterButtonFilter);
//        $I->wait(1);
//        $I->see($this->User_Email, SaasUserListPage::lineEmailLink(1));
//        $I->logoutSaas();
//    }

    
    /**
     * @group a
     * @guy PremmerceTester\PremmerceSteps 
     */
//    public function CetAmountDisk(PremmerceTester\PremmerceSteps $I){
//        $I->loginCabinet($user_email = $this->User_Email, $user_password = $this->User_Password);
//        $I->wait(3);
//        $Get_Amount_Disk = $I->grabTextFrom('//table/tbody/tr[6]/td/span');
//        preg_match('/[0-9]*/', $Get_Amount_Disk,$number);
//        $Get_Amount_Disk = $number[0];
//        $I->comment("$Get_Amount_Disk");
//        $this->Cabinet_Amount_Disk = $Get_Amount_Disk;
//        $I->wait(1);
//        $I->logoutCabinet();
//    }
    
    
    
    /**
     * @group a
     * @guy PremmerceTester\PremmerceSteps
     */
//    public function FilterDisk(PremmerceTester\PremmerceSteps $I){
//        $I->login($admin_email = USER_EMAIL, $admin_password = USER_PASSWORD);
//        $I->amOnPage(SaasUserListPage::$URL);
//        $I->wait(1);
//        $I->click(SaasUserListPage::$FilterEmailLabel);
//        $I->fillField(SaasUserListPage::$FilterEmailInput, $this->User_Email);
//        $I->click(SaasUserListPage::$FilterDiskLimitLabel);
//        $I->fillField(SaasUserListPage::$FilterDiskLimitInputFrom, $this->Cabinet_Amount_Disk);
//        $I->fillField(SaasUserListPage::$FilterDiskLimitInputTo, $this->Cabinet_Amount_Disk);
//        $I->click(SaasUserListPage::$FilterButtonFilter);
//        $I->wait(1);
//        $I->see($this->User_Email, SaasUserListPage::lineEmailLink(1));
//        $I->logoutSaas();
//    }
    
    /**
     * @group a
     * @guy PremmerceTester\PremmerceSteps
     */
    public function SetBalans(PremmerceTester\PremmerceSteps $I){
        $I->login($admin_email = USER_EMAIL, $admin_password = USER_PASSWORD);
        $I->amOnPage(SaasUserListPage::$URL);
        $I->wait(1);
        $I->click(SaasUserListPage::$FilterEmailLabel);
        $I->fillField(SaasUserListPage::$FilterEmailInput, $this->User_Email);
        $I->click(SaasUserListPage::$FilterButtonFilter);
        $I->wait(1);
        $I->see($this->User_Email, SaasUserListPage::lineEmailLink(1));
        $I->click(SaasUserListPage::lineActionlink(1));
        $I->fillField(SaasUserListPage::InputAmountPoints(1), $this->Admin_Amount_Point);
        $I->wait(4);
        $I->logoutSaas();
    }
    
    
    
    /**
     * @group a
     * @guy PremmerceTester\PremmerceSteps
     */
    public function FilterBalans(PremmerceTester\PremmerceSteps $I){
        $I->login($admin_email = USER_EMAIL, $admin_password = USER_PASSWORD);
        $I->amOnPage(SaasUserListPage::$URL);
        $I->wait(1);
        $I->click(SaasUserListPage::$FilterEmailLabel);
        $I->fillField(SaasUserListPage::$FilterEmailInput, $this->User_Email);
        $I->click(SaasUserListPage::$FilterBalansLabel);
        $I->fillField(SaasUserListPage::$FilterBalansInputFrom, $this->Admin_Amount_Point);
        $I->fillField(SaasUserListPage::$FilterBalansInputTo, $this->Admin_Amount_Point);
        $I->click(SaasUserListPage::$FilterButtonFilter);
        $I->wait(1);
        $I->see($this->User_Email, SaasUserListPage::lineEmailLink(1));
        $I->seeInField(SaasUserListPage::lineBalansText(1), $this->Admin_Amount_Point);
        $I->logoutSaas();
    }
    
    
    /**
     * @group a
     * @guy PremmerceTester\PremmerceSteps
     */
    public function SetManager(PremmerceTester\PremmerceSteps $I){
        $I->login($admin_email = USER_EMAIL, $admin_password = USER_PASSWORD);
        $I->amOnPage(SaasUserListPage::$URL);
        $I->wait(1);
        $I->click(SaasUserListPage::$FilterEmailLabel);
        $I->fillField(SaasUserListPage::$FilterEmailInput, $this->User_Email);
        $I->click(SaasUserListPage::$FilterButtonFilter);
        $I->see($this->User_Email, SaasUserListPage::lineEmailLink(1));
        $I->click(SaasUserListPage::lineActionlink(1));
        $I->wait(1);        
        $I->selectOption(SaasUserListPage::SelectManager(1), $this->Admin_Name_Manager);
        $I->wait(1);        
        $I->logoutSaas();
    }
    
    
    
    /**
     * @group a
     * @guy PremmerceTester\PremmerceSteps
     */
    public function FilterManager(PremmerceTester\PremmerceSteps $I){
        $I->login($admin_email = USER_EMAIL, $admin_password = USER_PASSWORD);
        $I->amOnPage(SaasUserListPage::$URL);
        $I->wait(1);
        $I->click(SaasUserListPage::$FilterEmailLabel);
        $I->fillField(SaasUserListPage::$FilterEmailInput, $this->User_Email);
        $I->click(SaasUserListPage::$FilterManagerLabel);
        $I->selectOption(SaasUserListPage::$FilterManagerSelect, $this->Admin_Name_Manager);
        $I->click(SaasUserListPage::$FilterButtonFilter);
        $I->wait(1);
        $I->see($this->User_Email, SaasUserListPage::lineEmailLink(1));
        $I->logoutSaas();
    }
    
    
    
    /**
     * @group a
     * @guy PremmerceTester\PremmerceSteps
     */
    public function GetDomainEnd(PremmerceTester\PremmerceSteps $I){
        $I->login($admin_email = USER_EMAIL, $admin_password = USER_PASSWORD);
        $I->amOnPage(SaasUserListPage::$URL);
        $I->wait(1);
        $I->click(SaasUserListPage::$FilterEmailLabel);
        $I->fillField(SaasUserListPage::$FilterEmailInput, $this->User_Email);
        $I->click(SaasUserListPage::$FilterButtonFilter);
        $I->wait(1);
        $I->see($this->User_Email, SaasUserListPage::lineEmailLink(1));
        $Get_End_domain = $I->grabTextFrom(SaasUserListPage::lineDomainEndText(1));
        $I->comment("$Get_End_domain");
        $this->Admin_End_Domain =$Get_End_domain;
        $I->logoutSaas();
    }
    
    
    
    /**
     * @group a
     * @guy PremmerceTester\PremmerceSteps
     */
    public function FilterDomainEnd(PremmerceTester\PremmerceSteps $I){
        $I->login($admin_email = USER_EMAIL, $admin_password = USER_PASSWORD);
        $I->amOnPage(SaasUserListPage::$URL);
        $I->wait(1);
        $I->click(SaasUserListPage::$FilterEmailLabel);
        $I->fillField(SaasUserListPage::$FilterEmailInput, $this->User_Email);
        $I->click(SaasUserListPage::$FilterDomainEndLabel);
        $I->selectOption(SaasUserListPage::$FilterDomainEnSelect, $this->Admin_End_Domain);
        $I->click(SaasUserListPage::$FilterButtonFilter);
        $I->wait(1);
        $I->see($this->User_Email, SaasUserListPage::lineEmailLink(1));
        $I->logoutSaas();
    }
    
    
    
    
    
    /**
     * @group a
     * @guy PremmerceTester\PremmerceSteps
     */
    public function FilterActivateByEmail(PremmerceTester\PremmerceSteps $I){
        $I->login($admin_email = USER_EMAIL, $admin_password = USER_PASSWORD);
        $I->amOnPage(SaasUserListPage::$URL);
        $I->wait(1);
        $I->click(SaasUserListPage::$FilterEmailLabel);
        $I->fillField(SaasUserListPage::$FilterEmailInput, $this->User_Email);
        $I->click(SaasUserListPage::$FilterActivatedByEmailLabel);
        $I->selectOption(SaasUserListPage::$FilterActivatedByEmailSelect, 'не активовано');
        $I->click(SaasUserListPage::$FilterButtonFilter);
        $I->wait(1);
        $I->see($this->User_Email, SaasUserListPage::lineEmailLink(1));
        $I->logoutSaas();
    }
    
    
    /**
     * @group a
     * @guy PremmerceTester\PremmerceSteps
     */
    public function FilterNoactivateByEmail(PremmerceTester\PremmerceSteps $I){
        $I->login($admin_email = USER_EMAIL, $admin_password = USER_PASSWORD);
        $I->amOnPage(SaasUserListPage::$URL);
        $I->wait(1);
        $I->click(SaasUserListPage::$FilterEmailLabel);
        $I->fillField(SaasUserListPage::$FilterEmailInput, $this->User_Email);
        $I->click(SaasUserListPage::$FilterActivatedByEmailLabel);
        $I->selectOption(SaasUserListPage::$FilterActivatedByEmailSelect, 'активовано');
        $I->click(SaasUserListPage::$FilterButtonFilter);
        $I->wait(1);
        $I->dontSee($this->User_Email, SaasUserListPage::lineEmailLink(1));
        $I->logoutSaas();
    }
    
    
    /**
     * @group aaqq
     * @guy PremmerceTester\PremmerceSteps
     */
//    public function GetFillProduct(PremmerceTester\PremmerceSteps $I){
//        $I->login($admin_email = USER_EMAIL, $admin_password = USER_PASSWORD);
//        $I->amOnPage(SaasUserListPage::$URL);
//        $I->wait(1);
//        $I->click(SaasUserListPage::$FilterEmailLabel);
//        $I->fillField(SaasUserListPage::$FilterEmailInput, $this->User_Email);
//        $I->click(SaasUserListPage::$FilterButtonFilter);
//        $I->see($this->user_email, SaasUserListPage::lineEmailLink(1));
//        $I->wait(1);
//        $Get_Values = $I->grabTextFrom(SaasUserListPage::lineFillProductsText(1));
//        $I->comment("$Get_Values");
//        $this->Admin_Fill_Product = $Get_Values;        
//        $I->logoutSaas();
//    }
    
    
    
    /**
     * @group aa
     * @guy PremmerceTester\PremmerceSteps
     */
//    public function FilterFillProduct(PremmerceTester\PremmerceSteps $I){
//        $I->login($admin_email = USER_EMAIL, $admin_password = USER_PASSWORD);
//        $I->amOnPage(SaasUserListPage::$URL);
//        $I->wait(1);
//        $I->click(SaasUserListPage::$FilterEmailLabel);
//        $I->fillField(SaasUserListPage::$FilterEmailInput, $this->User_Email);
//        $I->click(SaasUserListPage::$FilterFillProductsLabel);
//        $I->selectOption(SaasUserListPage::$FilterFillProductsSelect, $this->Admin_Fill_Product);
//        $I->click(SaasUserListPage::$FilterButtonFilter);
//        $I->wait(1);
//        $I->see($this->User_Email, SaasUserListPage::lineEmailLink(1));
//        $I->see($this->Admin_Fill_Product, SaasUserListPage::lineFillProductsText(1));
//        $I->logoutSaas();
//    }
    
    /**
     * @group status
     * @guy PremmerceTester\PremmerceSteps 
     */
    public function CreateSaasStatus(PremmerceTester\PremmerceSteps $I){
        $I->login($user_email = USER_EMAIL, $user_password = USER_PASSWORD);
        $I->wait(1);
        $I->SetTextAditorNative();
        $I->wait(1);
        $I->amOnPage(SaasUserListPage::$URL);
        $I->wait(1);
        $I->click(SaasUserListPage::$ButtonStatuses);
        $I->wait(1);
        $I->click(SaasStatusesPage::$ListButtonCreate);
        $I->wait(1);
        $I->fillField(SaasStatusesPage::$CreateInputName, $this->Status_Name);
        $I->wait(1);
        $I->fillField(SaasStatusesPage::$CreateInputDescription, $this->Status_Description);
        $I->click(SaasStatusesPage::$CreateButtonSave);
        $I->wait(1);
        $I->logoutSaas();
    }
    
    
    /**
     * @group status1
     * @guy PremmerceTester\PremmerceSteps
     */
    public function SetStatuses(PremmerceTester\PremmerceSteps $I){
        $I->login($admin_email = USER_EMAIL, $admin_password = USER_PASSWORD);
        $I->amOnPage(SaasUserListPage::$URL);
        $I->wait(1);
        $I->click(SaasUserListPage::$FilterEmailLabel);
        $I->fillField(SaasUserListPage::$FilterEmailInput, $this->User_Email);
        $I->click(SaasUserListPage::$FilterButtonFilter);
        $I->wait(1);
        $I->see($this->User_Email, SaasUserListPage::lineEmailLink(1));
        $I->click(SaasUserListPage::lineActionlink(1)); 
        $I->wait(1);
        $I->selectOption(SaasUserListPage::SelectStatuses(1), $this->Status_Name);
        $I->wait(1);
        $I->logoutSaas();
    }
    
    
    
    
    
    /**
     * @group status
     * @guy PremmerceTester\PremmerceSteps
     */
    public function FilterStatuses(PremmerceTester\PremmerceSteps $I){
        $I->login($admin_email = USER_EMAIL, $admin_password = USER_PASSWORD);
        $I->amOnPage(SaasUserListPage::$URL);
        $I->wait(1);
        $I->click(SaasUserListPage::$FilterEmailLabel);
        $I->fillField(SaasUserListPage::$FilterEmailInput, $this->User_Email);
        $I->click(SaasUserListPage::$FilterStatusesLabel);
        $I->selectOption(SaasUserListPage::$FilterStatusesSelect, $this->Status_Name);
        $I->wait(1);
        $I->click(SaasUserListPage::$FilterButtonFilter);
        $I->wait(1);
        $I->see($this->User_Email, SaasUserListPage::lineEmailLink(1));
        $I->logoutSaas();
    }
    
    
    
    /**
     * @group Department
     * @guy PremmerceTester\PremmerceSteps 
     */
    public function CreateSaasDepartment(PremmerceTester\PremmerceSteps $I){
        $I->login($admin_email = USER_EMAIL, $admin_password = USER_PASSWORD);
        $I->SetTextAditorNative();
        $I->amOnPage(SaasUserListPage::$URL);
        $I->wait(1);
        $I->click(SaasUserListPage::$ButtonDepartments);
        $I->wait(1);
        $I->click(SaasDepartmenstPage::$ListButtonCreate);
        $I->wait(1);
        $I->fillField(SaasDepartmenstPage::$CreateInputName, $this->Department_Name);
        $I->fillField(SaasDepartmenstPage::$CreateInputDescription, $this->Department_Description);
        $I->click(SaasDepartmenstPage::$CreateButtonSave);
        $I->wait(1);
        $I->logoutSaas();
    }
    
    
    
    
    
    /**
     * @group i
     * @guy PremmerceTester\PremmerceSteps
     */
    public function FilterDepartments(PremmerceTester\PremmerceSteps $I){
        $I->login($admin_email = USER_EMAIL, $admin_password = USER_PASSWORD);
        $I->amOnPage(SaasUserListPage::$URL);
        $I->wait(1);
        $I->click(SaasUserListPage::$FilterEmailLabel);
        $I->fillField(SaasUserListPage::$FilterEmailInput, $this->User_Email);
        $I->click(SaasUserListPage::$FilterDepartmentsLabel);
        $I->selectOption(SaasUserListPage::$FilterDepartmentsSelect, $this->Department_Name);
        $I->click(SaasUserListPage::$FilterButtonFilter);
        $I->wait(1);
        $I->see($this->User_Name, SaasUserListPage::lineEmailLink(1));
        $I->logoutSaas();
    }
    
    

    
    /**
     * @group status
     * @guy PremmerceTester\PremmerceSteps 
     */
    public function DeleteSaasStatus(PremmerceTester\PremmerceSteps $I){
        $I->login($user_email = USER_EMAIL, $user_password = USER_PASSWORD);
        $I->wait(3);
//        $I->SetTextAditorNative();
        $I->amOnPage(SaasUserListPage::$URL);
        $I->wait(3);
        $I->click(SaasUserListPage::$ButtonStatuses);
        $I->wait(3);
        $Amount_Rows = $I->getAmount($I, 'tbody .niceCheck');
        $I->comment("$Amount_Rows");
        for ($j = 1;$j <= $Amount_Rows; ++$j){
        $Get_Name_Statuse = $I->grabTextFrom(SaasStatusesPage::LineName($j));
        $I->comment("$Get_Name_Statuse");      
            if($Get_Name_Statuse == $this->Status_Name){
                $I->wait(1);
                $I->click(SaasStatusesPage::LineCheckBox($j));
                $I->wait(1);
                $I->click(SaasStatusesPage::$ListButtonDelete);
                $I->wait(1);
                $I->click(SaasStatusesPage::$WindowDeleteButtonDelete);
                $Amount_Rows--;
                $j--;
            }  else {
                $I->comment("$Get_Name_Statuse не є створенним тестовим статусом.");
            }
        }
        $I->logoutSaas();
    }
    
    
    /**
     * @group Department
     * @guy PremmerceTester\PremmerceSteps 
     */
    public function DeleteSaasDepartment(PremmerceTester\PremmerceSteps $I){
        $I->login($user_email = USER_EMAIL, $user_password = USER_PASSWORD);
        $I->wait(3);
//        $I->SetTextAditorNative();
        $I->amOnPage(SaasUserListPage::$URL);
        $I->wait(3);
        $I->click(SaasUserListPage::$ButtonDepartments);
        $I->wait(3);
        $Amount_Rows = $I->getAmount($I, 'tbody .niceCheck');
        $I->comment("$Amount_Rows");
        for ($j = 1;$j <= $Amount_Rows; ++$j){
        $Get_Name_Department = $I->grabTextFrom(SaasDepartmenstPage::LineName($j));
        $I->comment("$Get_Name_Department");      
            if($Get_Name_Department == $this->Department_Name){
                $I->wait(1);
                $I->click(SaasDepartmenstPage::LineCheckBox($j));
                $I->wait(1);
                $I->click(SaasDepartmenstPage::$ListButtonDelete);
                $I->wait(1);
                $I->click(SaasDepartmenstPage::$WindowDeleteButtonDelete);
                $Amount_Rows--;
                $j--;
            }  else {
                $I->comment("$Get_Name_Department не є створенним тестовим статусом.");
            }
        }
        $I->logoutSaas();
    }
    
    
    
    
    
    
    
   /////////////////////////////////////////////////////////////////////////////
   //DELETE SHOP     DELETE SHOP    DELETE SHOP    DELETE SHOP   DELETE SHOP  //                    
    /**
     * @group DeleteShop
     * @guy PremmerceTester\PremmerceSteps
     */
    public function DeleteSahopSaas(PremmerceTester\PremmerceSteps $I){
        $I->login($admin_email = USER_EMAIL, $admin_password = USER_PASSWORD);
        $I->amOnPage(SaasUserListPage::$URL);
        $I->wait(1);
        $I->click(SaasUserListPage::$FilterDomainLabel);
        $I->fillField(SaasUserListPage::$FilterDomainInput, $this->Store_Name);
        $I->click(SaasUserListPage::$FilterNameLabel);
        $I->fillField(SaasUserListPage::$FilterNameInput, $this->User_Name);
        $I->click(SaasUserListPage::$FilterPhoneLabel);
        $I->fillField(SaasUserListPage::$FilterPhoneInput, $this->User_Phone);
        $I->click(SaasUserListPage::$FilterEmailLabel);
        $I->fillField(SaasUserListPage::$FilterEmailInput, $this->User_Email);
        $I->click(SaasUserListPage::$FilterButtonFilter);
        $I->wait(1);
        $I->see($this->Store_Name, SaasUserListPage::lineDomainLink(1));
        $I->see($this->User_Name, SaasUserListPage::lineNameText(1));
        $I->see($this->User_Phone, SaasUserListPage::linePhoneText(1));
        $I->see($this->User_Email, SaasUserListPage::lineEmailLink(1));
        $I->click(SaasUserListPage::lineActionlink(1));
        $I->click(SaasUserListPage::ButtonDelete(1));
        $I->wait(3);
        $I->logoutSaas();
    }    
        
      
    
    /**
     * @group DeleteShopCabinet
     * @guy PremmerceTester\PremmerceSteps
     */
    public function VerifyDeleteSahopCabinet(PremmerceTester\PremmerceSteps $I){
       $I->loginCabinet($user_email = $this->User_Email, $user_password = $this->User_Password);
       $I->wait(1);
       $I->seeElement('.for_validations.error');
       $I->wait(1);
       $I->seeInField(MainPage::$WindowLoginInputEmail, $this->User_Email);       
       $I->seeInField(MainPage::$WindowLoginInputPassword, $this->User_Password);       
       $I->seeElement(MainPage::$WindowLoginButtonSend);       
    }
    
    

}    
