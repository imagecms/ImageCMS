<?php

use \UkrainianTester;

class SaasUserPageUACest


{
   private $store_url = 'populationnation.premme.com';
//   private $store_url = 'message.premme.com.ua';

   private $store_name = 'populationnation';
   private $user_email = 'premmerce.test@gmail.com';
   private $user_password = '98765431';
   private $user_name = 'Bazooka Band Powerviolence Go';
   private $user_phone = '11144226677788';
   private $user_city = 'Львів Сіті Сінь Пянь';


   
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
   
   private $name_status = 'TEST';
   
   
   
    /**
     * @group q
     * @guy UkrainianTester\LocUaSteps 
     */
    public function CreateStore(UkrainianTester\LocUaSteps $I){
//        $I->CabinetLogin($user_email = $this->user_email, $user_password = $this->user_password);
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
        $I->see('днів', PremmerceCabinetPage::$HeadTextDay);
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
//        $I->wait(3);
//        $I->click(PremmerceCabinetPage::$HeadLinkShop);
//        $I->wait(3);
//        $I->seeInCurrentUrl($this->store_url);
//        $I->wait(3);
//        $I->see('PREMMERCE', '//body/div[1]/div[1]/header/div[2]/div/span/img');
//        $I->wait(3);
//        $I->amOnPage('/saas/profile');
//        $I->wait(3);
//        $I->click(PremmerceCabinetPage::$HeadLinkAdmin);
//        $I->AdminLogin($admin_email = 'premmerce.test@gmail.com', $admin_password = '98765431');
        $I->CabinetLogout();
    }
    

    
    
    /**
     * @group a
     * @guy UkrainianTester\LocUaSteps 
     */
    public function CheckSaas(UkrainianTester\LocUaSteps $I){
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
        $I->wait(12);
        $I->reloadPage();
        $I->AdminLogout();
    }
    
    
    
    /**
     * @group a
     * @guy UkrainianTester\LocUaSteps 
     */
    public function CheckOffCabinet (UkrainianTester\LocUaSteps $I){
        $I->CabinetLogin($user_email = $this->user_email, $user_password = $this->user_password);
        $I->wait(1);
        $I->seeInCurrentUrl('/saas/profile');
        $I->see('Магазин отключен', PremmerceCabinetPage::$HeadTextShopOff);
        $I->see('Сплатити', PremmerceCabinetPage::$HeadTextPaid);
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
     * @group a
     * @guy UkrainianTester\LocUaSteps 
     */
    public function CheckOffSaas(UkrainianTester\LocUaSteps $I){
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
     * @group a
     * @guy UkrainianTester\LocUaSteps 
     */
    public function CheckOnCabinet (UkrainianTester\LocUaSteps $I){
        $I->CabinetLogin($user_email = $this->user_email, $user_password = $this->user_password);
        $I->wait(1);
        $I->seeInCurrentUrl('/saas/profile');
        $I->see('Баланс', '//body/div[1]/header/div/div[2]/a/span[2]/span[1]');
        $I->see('днів', '//body/div[1]/header/div/div[2]/a/span[2]/span[3]');
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
     * @group a
     * @guy UkrainianTester\LocUaSteps 
     */
    public function FilterPhone(UkrainianTester\LocUaSteps $I){
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
     * @group a
     * @guy UkrainianTester\LocUaSteps 
     */
    public function FilterName(UkrainianTester\LocUaSteps $I){
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
     * @group a
     * @guy UkrainianTester\LocUaSteps 
     */
    public function FilterEmail(UkrainianTester\LocUaSteps $I){
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
     * @group a
     * @guy UkrainianTester\LocUaSteps 
     */
    public function FilterCountry(UkrainianTester\LocUaSteps $I){
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
     * @group a
     * @guy UkrainianTester\LocUaSteps 
     */
    public function FilterCity(UkrainianTester\LocUaSteps $I){
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
     * @group a
     * @guy UkrainianTester\LocUaSteps 
     */
    public function FilterTarif(UkrainianTester\LocUaSteps $I){
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
     * @group a
     * @guy UkrainianTester\LocUaSteps 
     */
    public function FilterLevel(UkrainianTester\LocUaSteps $I){
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
     * @group a
     * @guy UkrainianTester\LocUaSteps 
     */
    public function FilterCategory(UkrainianTester\LocUaSteps $I){
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
     * @guy UkrainianTester\LocUaSteps 
     */
    public function FilterAmountProduct(UkrainianTester\LocUaSteps $I){
        $I->AdminLogin($admin_email = 'ad@min.com', $admin_password = 'admin');
        $I->amOnPage(SaasUserListPage::$URL);
        $I->wait(1);
        $I->click(SaasUserListPage::$FilterEmailLabel);
        $I->fillField(SaasUserListPage::$FilterEmailInput, $this->user_email);
        $I->click(SaasUserListPage::$FilterAmountProducntLabel);
        $I->fillField(SaasUserListPage::$FilterAmountProducntInputFrom, '1');
        $I->fillField(SaasUserListPage::$FilterAmountProducntInputTo, '1111');
        $I->click(SaasUserListPage::$FilterButtonFilter);
        $I->see($this->user_email, SaasUserListPage::lineEmailLink(1));
        $I->AdminLogout();
    }

    
    
    /**
     * @group aa
     * @guy UkrainianTester\LocUaSteps 
     */
    public function FilterDisk(UkrainianTester\LocUaSteps $I){
        $I->AdminLogin($admin_email = 'ad@min.com', $admin_password = 'admin');
        $I->amOnPage(SaasUserListPage::$URL);
        $I->wait(1);
        $I->click(SaasUserListPage::$FilterEmailLabel);
        $I->fillField(SaasUserListPage::$FilterEmailInput, $this->user_email);
        $I->click(SaasUserListPage::$FilterDiskLimitLabel);
        $I->fillField(SaasUserListPage::$FilterDiskLimitInputFrom, '1');
        $I->fillField(SaasUserListPage::$FilterDiskLimitInputTo, '1111');
        $I->click(SaasUserListPage::$FilterButtonFilter);
        $I->see($this->user_email, SaasUserListPage::lineEmailLink(1));
        $I->AdminLogout();
    }
    
    
    
    /**
     * @group aa
     * @guy UkrainianTester\LocUaSteps 
     */
    public function FilterBalans(UkrainianTester\LocUaSteps $I){
        $I->AdminLogin($admin_email = 'ad@min.com', $admin_password = 'admin');
        $I->amOnPage(SaasUserListPage::$URL);
        $I->wait(1);
        $I->click(SaasUserListPage::$FilterEmailLabel);
        $I->fillField(SaasUserListPage::$FilterEmailInput, $this->user_email);
        $I->click(SaasUserListPage::$FilterBalansLabel);
        $I->fillField(SaasUserListPage::$FilterBalansInputFrom, '1');
        $I->fillField(SaasUserListPage::$FilterBalansInputTo, '1111');
        $I->click(SaasUserListPage::$FilterButtonFilter);
        $I->see($this->user_email, SaasUserListPage::lineEmailLink(1));
        $I->AdminLogout();
    }
    
    
    
    /**
     * @group aa
     * @guy UkrainianTester\LocUaSteps 
     */
    public function FilterManager(UkrainianTester\LocUaSteps $I){
        $I->AdminLogin($admin_email = 'ad@min.com', $admin_password = 'admin');
        $I->amOnPage(SaasUserListPage::$URL);
        $I->wait(1);
        $I->click(SaasUserListPage::$FilterEmailLabel);
        $I->fillField(SaasUserListPage::$FilterEmailInput, $this->user_email);
        $I->click(SaasUserListPage::$FilterButtonFilter);
        $I->click(SaasUserListPage::$HeadCheckBox);
        $I->click(SaasUserListPage::$ButtonChancheData);
        $I->click(SaasUserListPage::$WindowChancheDataSelectManager);
        $I->click(SaasUserListPage::WindowChancheDataSelectManagerOption(2));
        $I->click(SaasUserListPage::$FilterManagerLabel);
        $I->click(SaasUserListPage::$FilterManagerSelect);
        $I->click(SaasUserListPage::FilterManagerSelectOption(2));
        $I->click(SaasUserListPage::$FilterButtonFilter);
        $I->see($this->user_email, SaasUserListPage::lineEmailLink(1));
        $I->AdminLogout();
    }
    
    
    

    /**
     * @group aa
     * @guy UkrainianTester\LocUaSteps 
     */
    public function FilterDomainEnd(UkrainianTester\LocUaSteps $I){
        $I->AdminLogin($admin_email = 'ad@min.com', $admin_password = 'admin');
        $I->amOnPage(SaasUserListPage::$URL);
        $I->wait(1);
        $I->click(SaasUserListPage::$FilterEmailLabel);
        $I->fillField(SaasUserListPage::$FilterEmailInput, $this->user_email);
        $I->click(SaasUserListPage::$FilterDomainEndLabel);
        $I->click(SaasUserListPage::$FilterDomainEndLabel);
        $I->click(SaasUserListPage::FilterDomainEndSelectOption(3));
        $I->click(SaasUserListPage::$FilterButtonFilter);
        $I->see($this->user_email, SaasUserListPage::lineEmailLink(1));
        $I->AdminLogout();
    }
    
    
    
    
    
    /**
     * @group aa
     * @guy UkrainianTester\LocUaSteps 
     */
    public function FilterActivateByEmail(UkrainianTester\LocUaSteps $I){
        $I->AdminLogin($admin_email = 'ad@min.com', $admin_password = 'admin');
        $I->amOnPage(SaasUserListPage::$URL);
        $I->wait(1);
        $I->click(SaasUserListPage::$FilterEmailLabel);
        $I->fillField(SaasUserListPage::$FilterEmailInput, $this->user_email);
        $I->click(SaasUserListPage::$FilterActivatedByEmailLabel);
        $I->click(SaasUserListPage::$FilterActivatedByEmailSelect);
        $I->click(SaasUserListPage::FilterActivatedByEmailSelectOption(2));
        $I->click(SaasUserListPage::$FilterButtonFilter);
        $I->see($this->user_email, SaasUserListPage::lineEmailLink(1));
        $I->AdminLogout();
    }
    
    
    
    /**
     * @group aa
     * @guy UkrainianTester\LocUaSteps 
     */
    public function FilterFillProduct(UkrainianTester\LocUaSteps $I){
        $I->AdminLogin($admin_email = 'ad@min.com', $admin_password = 'admin');
        $I->amOnPage(SaasUserListPage::$URL);
        $I->wait(1);
        $I->click(SaasUserListPage::$FilterEmailLabel);
        $I->fillField(SaasUserListPage::$FilterEmailInput, $this->user_email);
        $I->click(SaasUserListPage::$FilterFillProductsLabel);
        $I->click(SaasUserListPage::$FilterFillProductsSelect);
        $I->click(SaasUserListPage::FilterFillProductsSelectOption(2));
        $I->click(SaasUserListPage::$FilterButtonFilter);
        $I->see($this->user_email, SaasUserListPage::lineEmailLink(1));
        $I->AdminLogout();
    }
    
    
    
    /**
     * @group aa
     * @guy UkrainianTester\LocUaSteps 
     */
    public function FilterStatuses(UkrainianTester\LocUaSteps $I){
        $I->AdminLogin($admin_email = 'ad@min.com', $admin_password = 'admin');
        $I->amOnPage(SaasUserListPage::$URL);
        $I->wait(1);
        $I->click(SaasUserListPage::$FilterEmailLabel);
        $I->fillField(SaasUserListPage::$FilterEmailInput, $this->user_email);
        $I->click(SaasUserListPage::$FilterStatusesLabel);
        $I->click(SaasUserListPage::$FilterStatusesSelect);
        $I->click(SaasUserListPage::FilterStatusesSelectOption(2));
        $I->click(SaasUserListPage::$FilterButtonFilter);
        $I->see($this->user_email, SaasUserListPage::lineEmailLink(1));
        $I->AdminLogout();
    }
    
    /**
     * @group aa
     * @guy UkrainianTester\LocUaSteps 
     */
    public function FilterDepartments(UkrainianTester\LocUaSteps $I){
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
    
    
    ///----------Test For Create Statuse------------
    
    /**
     * @group aass
     * @guy UkrainianTester\LocUaSteps 
     */
    public function CreateStatus(UkrainianTester\LocUaSteps $I){
        $I->AdminLogin($admin_email = 'ad@min.com', $admin_password = 'admin');
        $I->wait(2);
        $I->amOnPage('/admin/settings#setings');
        $I->wait(2);
        $I->selectOption('#textEditor', 'Native textarea');
        $I->click('.btn.btn-small.btn-primary.action_on.formSubmit');
        $I->wait('3');
        $I->amOnPage(SaasUserListPage::$URL);
        $I->wait(2);
        $I->click(SaasUserListPage::$ButtonStatuses);
        $I->wait(2);
        $I->seeInCurrentUrl('/admin/components/cp/saas/users_statuses');
        $I->click(SaasUserListPage::$StatusesListButtonCreate);
        $I->wait(2);
        $I->fillField(SaasUserListPage::$StatusesCreateFieldName, $this->name_status);
        $I->fillField(SaasUserListPage::$StatusesCreateFieldDescription, 'for test');
        $I->click(SaasUserListPage::$StatusesCreateButtonSave);
        $I->wait(2);
        $I->click(SaasUserListPage::$StatusesCreateButtonBack);
        $I->wait(2);
        $amount_rows = $I->grabCCSAmount($I, '.table.table-striped.table-bordered.table-hover.table-condensed.t-l_a>tbody>tr>td>p');
        $I->comment("Количество строк = $amount_rows");
        for($j = 1;$j > $amount_rows; $j++){
        $name = $I->grabTextFrom(SaasUserListPage::StatusListlineName($j));
        if($name == $this->name_status){
            $number_ID = $I->grabTextFrom(SaasUserListPage::StatusListlineID($j));
            $I->comment("Вот такое айди созданого статуса = $number_ID");            
        }
        
        }        
        $I->AdminLogout();
    }
    
    
    
    
    
    
    
    
    
    
   /////////////////////////////////////////////////////////////////////////////
   //DELETE SHOP     DELETE SHOP    DELETE SHOP    DELETE SHOP   DELETE SHOP  //                    
    /**
     * @group a
     * @guy UkrainianTester\LocUaSteps 
     */
    public function DeleteSahopSaas(UkrainianTester\LocUaSteps $I){
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
