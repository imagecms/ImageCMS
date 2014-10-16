<?php

use \PremmerceTester;

class SaasUserPageCest


{
   private $Store_Url = 'populationnationn.premme.com';
   private $Cabinet_Url = '/saas/profile';


   private $Store_Name = 'populationnationn';
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
   
   
   private $Name_Status = 'TEST';
   
   private $Name_Country;
   private $Name_Tariff;
   
   
    /**
     * @group a
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
//        $I->click(CabinetPage::$HeadButtonShop);
//        $I->executeInSelenium(function (\Webdriver $Webdriver) {
//            $Handles = $Webdriver->getWindowHandles();
//            $Last_Window = end($Handles);
//            $Webdriver->switchTo()->window($Last_Window);
//        });
//        $I->wait('6');
//        $I->waitForElement(".//*[@id='inputString']");
//        $I->seeInTitle('ImageCMS DemoShop');
//        $I->seeElement('.logo>img');
//        $I->amOnPage($this->Cabinet_Url);
//        $I->wait(1);
//        $I->click(CabinetPage::$HeadButtonAdmin);
//        $I->executeInSelenium(function (\Webdriver $Webdriver) {
//            $Handles = $Webdriver->getWindowHandles();
//            $Last_Window = end($Handles);
//            $Webdriver->switchTo()->window($Last_Window);
//        });
//        $I->seeElement('');
//        $I->logoutCabinet();
    }
    
    /**
     * @group q
     * @guy PremmerceTester\PremmerceSteps 
     */
    public function CetNameCountry(PremmerceTester\PremmerceSteps $I){
        $I->loginCabinet($user_email = $this->User_Email, $user_password = $this->User_Password);
        $I->wait(1);
        $Get_Name_Tariff = $I->grabTextFrom(CabinetPage::$TabMainFieldTariffNameText);
        $this->Name_Tariff = $Get_Name_Tariff;
        $I->click(CabinetPage::$TabProfile);
        $I->wait(1);
        $Get_Name_Country = $I->grabTextFrom(CabinetPage::$TabProfileSelectCountry);
        $this->Name_Country = $Get_Name_Country;
    }
    
    /**
     * @group q
     * @guy PremmerceTester\PremmerceSteps 
     */
    public function CetNameTariff(PremmerceTester\PremmerceSteps $I){
        $I->wait(1);
        $Get_Name_Tariff = $I->grabTextFrom(CabinetPage::$TabMainFieldTariffNameText);
        $this->Name_Tariff = $Get_Name_Tariff;
    }
        
        
    /**
     * @group a
     * @guy PremmerceTester\PremmerceSteps 
     */
    public function CheckSaas(PremmerceTester\PremmerceSteps $I){
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
        $I->see($this->User_Phone, SaasUserListPage::linePhoneText(1));
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
        $I->see($this->User_Email, SaasUserListPage::lineEmailLink(1));
        $I->logoutSaas();
    }
    
    
    /**
     * @group q
     * @guy PremmerceTester\PremmerceSteps
     */
    public function FilterCountry(PremmerceTester\PremmerceSteps $I){
        $I->login($admin_email = USER_EMAIL, $admin_password = USER_PASSWORD);
        $I->amOnPage(SaasUserListPage::$URL);
        $I->wait(1);
        $I->click(SaasUserListPage::$FilterCountryLabel);
        $I->selectOption(SaasUserListPage::$FilterCountrySelect, $this->Name_Country);
        $I->click(SaasUserListPage::$FilterButtonFilter);
        $I->see($this->User_Email, SaasUserListPage::lineEmailLink(1));
        $I->logoutSaas();
    }
    
    
    /**
     * @group q
     * @guy PremmerceTester\PremmerceSteps
     */
    public function FilterCity(PremmerceTester\PremmerceSteps $I){
        $I->login($admin_email = USER_EMAIL, $admin_password = USER_PASSWORD);
        $I->amOnPage(SaasUserListPage::$URL);
        $I->wait(1);
        $I->click(SaasUserListPage::$FilterCityLabel);
        $I->fillField(SaasUserListPage::$FilterCityInput, $this->User_City);
        $I->click(SaasUserListPage::$FilterButtonFilter);
        $I->see($this->User_Email, SaasUserListPage::lineEmailLink(1));
        $I->logoutSaas();
    }
    
    
    
    
    /**
     * @group q
     * @guy PremmerceTester\PremmerceSteps
     */
    public function FilterTarif(PremmerceTester\PremmerceSteps $I){
        $I->login($admin_email = USER_EMAIL, $admin_password = USER_PASSWORD);
        $I->amOnPage(SaasUserListPage::$URL);
        $I->wait(1);
        $I->click(SaasUserListPage::$FilterDomainLabel);
        $I->fillField(SaasUserListPage::$FilterDomainInput, $this->Store_Name);
        $I->click(SaasUserListPage::$FilterTarifLabel);
        $I-
        $I->click(SaasUserListPage::$FilterTarifSelect);
        $I->click(SaasUserListPage::FilterTarifSelectOption(3));
        $I->click(SaasUserListPage::$FilterButtonFilter);
        $I->see($this->User_Email, SaasUserListPage::lineEmailLink(1));
        $I->logoutSaas();
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
        $I->fillField(SaasUserListPage::$FilterEmailInput, $this->user_email);
        $I->click(SaasUserListPage::$FilterLevelLabel);
        $I->click(SaasUserListPage::$FilterLevelSelect);
        $I->click(SaasUserListPage::FilterLevelSelectOption(2));
        $I->click(SaasUserListPage::$FilterButtonFilter);
        $I->see($this->User_Email, SaasUserListPage::lineEmailLink(1));
        $I->logoutSaas();
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
        $I->fillField(SaasUserListPage::$FilterEmailInput, $this->user_email);
        $I->click(SaasUserListPage::$FilterCategoryLabel);
        $I->click(SaasUserListPage::$FilterCategorySelect);
        $I->click(SaasUserListPage::FilterCategorySelectOption(3));
        $I->click(SaasUserListPage::$FilterButtonFilter);
        $I->see($this->user_email, SaasUserListPage::lineEmailLink(1));
        $I->logoutSaas();
    }
    
    
    /**
     * @group aa
     * @guy PremmerceTester\PremmerceSteps
     */
    public function FilterAmountProduct(PremmerceTester\PremmerceSteps $I){
        $I->login($admin_email = USER_EMAIL, $admin_password = USER_PASSWORD);
        $I->amOnPage(SaasUserListPage::$URL);
        $I->wait(1);
        $I->click(SaasUserListPage::$FilterEmailLabel);
        $I->fillField(SaasUserListPage::$FilterEmailInput, $this->user_email);
        $I->click(SaasUserListPage::$FilterAmountProducntLabel);
        $I->fillField(SaasUserListPage::$FilterAmountProducntInputFrom, '1');
        $I->fillField(SaasUserListPage::$FilterAmountProducntInputTo, '1111');
        $I->click(SaasUserListPage::$FilterButtonFilter);
        $I->see($this->user_email, SaasUserListPage::lineEmailLink(1));
        $I->logoutSaas();
    }

    
    
    /**
     * @group aa
     * @guy PremmerceTester\PremmerceSteps
     */
    public function FilterDisk(PremmerceTester\PremmerceSteps $I){
        $I->login($admin_email = USER_EMAIL, $admin_password = USER_PASSWORD);
        $I->amOnPage(SaasUserListPage::$URL);
        $I->wait(1);
        $I->click(SaasUserListPage::$FilterEmailLabel);
        $I->fillField(SaasUserListPage::$FilterEmailInput, $this->user_email);
        $I->click(SaasUserListPage::$FilterDiskLimitLabel);
        $I->fillField(SaasUserListPage::$FilterDiskLimitInputFrom, '1');
        $I->fillField(SaasUserListPage::$FilterDiskLimitInputTo, '1111');
        $I->click(SaasUserListPage::$FilterButtonFilter);
        $I->see($this->user_email, SaasUserListPage::lineEmailLink(1));
        $I->logoutSaas();
    }
    
    
    
    /**
     * @group aa
     * @guy PremmerceTester\PremmerceSteps
     */
    public function FilterBalans(PremmerceTester\PremmerceSteps $I){
        $I->login($admin_email = USER_EMAIL, $admin_password = USER_PASSWORD);
        $I->amOnPage(SaasUserListPage::$URL);
        $I->wait(1);
        $I->click(SaasUserListPage::$FilterEmailLabel);
        $I->fillField(SaasUserListPage::$FilterEmailInput, $this->user_email);
        $I->click(SaasUserListPage::$FilterBalansLabel);
        $I->fillField(SaasUserListPage::$FilterBalansInputFrom, '1');
        $I->fillField(SaasUserListPage::$FilterBalansInputTo, '1111');
        $I->click(SaasUserListPage::$FilterButtonFilter);
        $I->see($this->user_email, SaasUserListPage::lineEmailLink(1));
        $I->logoutSaas();
    }
    
    
    
    /**
     * @group aa
     * @guy PremmerceTester\PremmerceSteps
     */
    public function FilterManager(PremmerceTester\PremmerceSteps $I){
        $I->login($admin_email = USER_EMAIL, $admin_password = USER_PASSWORD);
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
        $I->logoutSaas();
    }
    
    
    

    /**
     * @group aa
     * @guy PremmerceTester\PremmerceSteps
     */
    public function FilterDomainEnd(PremmerceTester\PremmerceSteps $I){
        $I->login($admin_email = USER_EMAIL, $admin_password = USER_PASSWORD);
        $I->amOnPage(SaasUserListPage::$URL);
        $I->wait(1);
        $I->click(SaasUserListPage::$FilterEmailLabel);
        $I->fillField(SaasUserListPage::$FilterEmailInput, $this->user_email);
        $I->click(SaasUserListPage::$FilterDomainEndLabel);
        $I->click(SaasUserListPage::$FilterDomainEndLabel);
        $I->click(SaasUserListPage::FilterDomainEndSelectOption(3));
        $I->click(SaasUserListPage::$FilterButtonFilter);
        $I->see($this->user_email, SaasUserListPage::lineEmailLink(1));
        $I->logoutSaas();
    }
    
    
    
    
    
    /**
     * @group aa
     * @guy PremmerceTester\PremmerceSteps
     */
    public function FilterActivateByEmail(PremmerceTester\PremmerceSteps $I){
        $I->login($admin_email = USER_EMAIL, $admin_password = USER_PASSWORD);
        $I->amOnPage(SaasUserListPage::$URL);
        $I->wait(1);
        $I->click(SaasUserListPage::$FilterEmailLabel);
        $I->fillField(SaasUserListPage::$FilterEmailInput, $this->user_email);
        $I->click(SaasUserListPage::$FilterActivatedByEmailLabel);
        $I->click(SaasUserListPage::$FilterActivatedByEmailSelect);
        $I->click(SaasUserListPage::FilterActivatedByEmailSelectOption(2));
        $I->click(SaasUserListPage::$FilterButtonFilter);
        $I->see($this->user_email, SaasUserListPage::lineEmailLink(1));
        $I->logoutSaas();
    }
    
    
    
    /**
     * @group aa
     * @guy PremmerceTester\PremmerceSteps
     */
    public function FilterFillProduct(PremmerceTester\PremmerceSteps $I){
        $I->login($admin_email = USER_EMAIL, $admin_password = USER_PASSWORD);
        $I->amOnPage(SaasUserListPage::$URL);
        $I->wait(1);
        $I->click(SaasUserListPage::$FilterEmailLabel);
        $I->fillField(SaasUserListPage::$FilterEmailInput, $this->user_email);
        $I->click(SaasUserListPage::$FilterFillProductsLabel);
        $I->click(SaasUserListPage::$FilterFillProductsSelect);
        $I->click(SaasUserListPage::FilterFillProductsSelectOption(2));
        $I->click(SaasUserListPage::$FilterButtonFilter);
        $I->see($this->user_email, SaasUserListPage::lineEmailLink(1));
        $I->logoutSaas();
    }
    
    
    
    /**
     * @group aa
     * @guy PremmerceTester\PremmerceSteps
     */
    public function FilterStatuses(PremmerceTester\PremmerceSteps $I){
        $I->login($admin_email = USER_EMAIL, $admin_password = USER_PASSWORD);
        $I->amOnPage(SaasUserListPage::$URL);
        $I->wait(1);
        $I->click(SaasUserListPage::$FilterEmailLabel);
        $I->fillField(SaasUserListPage::$FilterEmailInput, $this->user_email);
        $I->click(SaasUserListPage::$FilterStatusesLabel);
        $I->click(SaasUserListPage::$FilterStatusesSelect);
        $I->click(SaasUserListPage::FilterStatusesSelectOption(2));
        $I->click(SaasUserListPage::$FilterButtonFilter);
        $I->see($this->user_email, SaasUserListPage::lineEmailLink(1));
        $I->logoutSaas();
    }
    
    /**
     * @group aa
     * @guy PremmerceTester\PremmerceSteps
     */
    public function FilterDepartments(PremmerceTester\PremmerceSteps $I){
        $I->login($admin_email = USER_EMAIL, $admin_password = USER_PASSWORD);
        $I->amOnPage(SaasUserListPage::$URL);
        $I->wait(1);
        $I->click(SaasUserListPage::$FilterEmailLabel);
        $I->fillField(SaasUserListPage::$FilterEmailInput, $this->user_email);
        $I->click(SaasUserListPage::$FilterDepartmentsLabel);
        $I->click(SaasUserListPage::$FilterDepartmentsSelect);
        $I->click(SaasUserListPage::FilterDepartmentsSelectOption(2));
        $I->click(SaasUserListPage::$FilterButtonFilter);
        $I->see($this->user_email, SaasUserListPage::lineEmailLink(1));
        $I->logoutSaas();
    }
    
    
    ///----------Test For Create Statuse------------
    
    /**
     * @group aass
     * @guy PremmerceTester\PremmerceSteps
     */
    public function CreateStatus(PremmerceTester\PremmerceSteps $I){
        $I->login($admin_email = USER_EMAIL, $admin_password = USER_PASSWORD);
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
        $I->logoutSaas();
    }
    
    
    
    
    
    
    
    
    
    
   /////////////////////////////////////////////////////////////////////////////
   //DELETE SHOP     DELETE SHOP    DELETE SHOP    DELETE SHOP   DELETE SHOP  //                    
    /**
     * @group a
     * @guy PremmerceTester\PremmerceSteps
     */
    public function DeleteSahopSaas(PremmerceTester\PremmerceSteps $I){
        $I->login($admin_email = USER_EMAIL, $admin_password = USER_PASSWORD);
        $I->amOnPage(SaasUserListPage::$URL);
        $I->wait(1);
        $I->click(SaasUserListPage::$FilterDomainLabel);
        $I->fillField(SaasUserListPage::$FilterDomainInput, $this->store_name);
        $I->click(SaasUserListPage::$FilterButtonFilter);
        $I->see($this->store_name, SaasUserListPage::lineDomainLink(1));
        $I->click(SaasUserListPage::lineActionlink(1));
        $I->click(SaasUserListPage::ButtonDelete(1));
        $I->wait(3);
        $I->logoutSaas();
    }    
        
        
    
    
    
    
    
    
    
    
    
}    
