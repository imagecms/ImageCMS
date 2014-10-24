<?php

use \PremmerceTester;

class SystemTourCest

{
    protected $storeUrl = 'http://imitationhloya.premme.com';//systemtour
    private   $Store_Name = 'systemtour';//imitationhloya
    
    private $Cabinet_Url = '/saas/profile';

    private $Category_First_Name = 'Main Category 333';
    private $Category_Second_Name = 'Втораыя Категоъя';
    private $Category_Third_Name = '123 Треього рівняї MP3, SONY';


    
    private $User_Email = 'systemtour.test@test.net';//systemtour
    private $User_Password = '98765431';
    private $User_Name = 'Cannibal Corpse';
    private $User_Phone = '11177788444';
    private $User_City = 'Львів Сіті';


    
    /**
     * @group x
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
     * @group x
     * @guy PremmerceTester\PremmerceSteps
     */
    public function DeleteProductCategorys(PremmerceTester\PremmerceSteps $I){
        $I->loginCabinet($this->User_Email, $this->User_Password);
        $I->wait(1);
        $I->amOnUrl($this->storeUrl . '/admin');
        $I->wait(3);
        $I->login($this->User_Email, $this->User_Password);
        $I->wait(3);
        $I->amOnPage(ProductCategoryListPage::$URL);
        $I->wait(5);
        $I->click(ProductCategoryListPage::$HeadCheck);
        $I->wait(1);
        $I->click(ProductCategoryListPage::$ButtonDelete);
        $I->wait(1);
        $I->click(ProductCategoryListPage::$WindowDeleteButtonDelete);
        $I->wait(1);
//        $I->amOnPage($this->Cabinet_Url);
//        $I->logoutCabinet();
    }
    
    
    
    /**
     * @group x
     * @guy PremmerceTester\PremmerceSteps
     */
    public function CreateProductCategorysThreeLevels (PremmerceTester\PremmerceSteps $I){
//        $I->loginCabinet($this->User_Email, $this->User_Password);
        $I->wait(1);
        $I->amOnUrl($this->storeUrl . '/admin');
//        $I->wait(1);
//        $I->login($this->User_Email, $this->User_Password);
        $I->wait(1);
        $I->click(GeneralPage::$ProductsCatalogue);
        $I->wait(1);
        $I->click(GeneralPage::$ProductCategories);
        $I->wait(1);
        $I->click(ProductCategoryListPage::$ButtonCreate);
        $I->wait(1);
        $this->CreateProductCategory($I, $this->Category_First_Name);
        $I->wait(1);
        $this->CreateProductCategory($I, $this->Category_Second_Name, $this->Category_First_Name);
        $I->wait(1);
        $this->CreateProductCategory($I, $this->Category_Third_Name, $this->Category_Second_Name);
        $I->wait(1);
//        $I->logoutCabinet();
    }
    
    
    /**
     * @group x
     * @guy PremmerceTester\PremmerceSteps
     */
    public function CheckFrontDashboard(PremmerceTester\PremmerceSteps $I){
        $I->amOnUrl($this->storeUrl);
        $I->see($this->Category_First_Name, FrontPage::DashboardMainCategory(1));
        $I->moveMouseOver(FrontPage::DashboardMainCategory(1));
        $I->wait(1);
        $I->see($this->Category_Second_Name, FrontPage::DashboardSecondCategory(1));
        $I->see($this->Category_Third_Name, FrontPage::DashboardThirdCategory(1));
    }

    
    /**
     * @group x
     * @guy PremmerceTester\PremmerceSteps
     */
    public function CheckFrontLevelCategorys(PremmerceTester\PremmerceSteps $I){
       $I->amOnUrl($this->storeUrl); 
       $I->click(FrontPage::DashboardMainCategory(1));
       $I->see($this->Category_First_Name, FrontPage::$CategoryTitle);
       $I->see($this->Category_Second_Name, FrontPage::CategoryPageCategoryList(1));
       $I->click(FrontPage::CategoryPageCategoryList(1));
       $I->see($this->Category_Second_Name, FrontPage::$CategoryTitle);
       $I->see($this->Category_Third_Name, FrontPage::CategoryPageCategoryList(1));
       $I->click(FrontPage::CategoryPageCategoryList(1));
       $I->see($this->Category_Third_Name, FrontPage::$CategoryTitle);
    }
    
    
    /**
     * @group x
     * @guy PremmerceTester\PremmerceSteps
     */
    public function Test(PremmerceTester\PremmerceSteps $I){
        $I->wait(1);
        $I->amOnUrl($this->storeUrl . '/admin');
        $this->CreateProperty($I,   $Name = 'Особое свойство',
                                    $CVS = 'terpincodecaption',
                                    $Category = $this->Category_First_Name,
                                    $Values = 'Йцу 123 Qwe');
        
        $this->CreateProperty($I,   $Name = 'Соленость продукта',
                                    $CVS = 'oyyyyiamfucku',
                                    $Category = $this->Category_Second_Name,
                                    $Values = 'rd2 XX');
        
        $this->CreateProperty($I,   $Name = 'Горное раздражение',
                                    $CVS = 'prostocsvname',
                                    $Category = $this->Category_Third_Name,
                                    $Values = '-*/');
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
    
    
    
    
    /*------------------------------------------------------------------------*/
    /*                        PROTECTED                                       */
    /*------------------------------------------------------------------------*/
    
    
    protected function CreateProductCategory(PremmerceTester $I,
                                            $Name_Category,
                                            $Name_Parent_Category = NULL) {
        $I->amOnPage(ProductCategoryCreatePage::$URL);
        $I->wait('1');
        $I->fillField(ProductCategoryCreatePage::$InputName, $Name_Category);
        if(isset($Name_Parent_Category)){ 
            $I->selectOption(ProductCategoryCreatePage::$SelectParent, $Name_Parent_Category);
        }
        $I->click(ProductCategoryCreatePage::$ButtonCreate); 
        $I->wait('2');
    }
    
    protected function CreateProperty(PremmerceTester $I,
                                    $Name,
                                    $CVS,
                                    $Category,
                                    $Values){
        $I->amOnPage(PropertyCreatePage::$URL);
        $I->wait(1);
        $I->click(PropertyCreatePage::$CheckMainProperty);
        $I->click(PropertyCreatePage::$CheckHint);
        $I->click(PropertyCreatePage::$CheckShowProductPage);
        $I->click(PropertyCreatePage::$CheckShowProductCompare);
        $I->click(PropertyCreatePage::$CheckShowFilter);
        $I->fillField(PropertyCreatePage::$InputName, $Name);
        $I->fillField(PropertyCreatePage::$InputCSV, $CVS);
        $I->selectOption(PropertyCreatePage::$SelectCategory, $Category);
        $I->fillField(PropertyCreatePage::$InputValues, $Values);
        $I->click(PropertyCreatePage::$ButtonCreate);
        $I->wait(1);
    }
    
}

