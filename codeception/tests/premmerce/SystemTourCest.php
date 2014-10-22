<?php

use \PremmerceTester;

class SystemTourCest

{
    protected $storeUrl = 'http://systemtour.premme.com';
    private   $Store_Name = 'systemtour';
    
    private $Cabinet_Url = '/saas/profile';

    private $Category_First_Name = 'Main Category 333';
    private $Category_Second_Name = 'Втораыя Категоъя';
    private $Category_Third_Name = '123 Треього рівняї';


    
    private $User_Email = 'systemtour.test@test.net';
    private $User_Password = '98765431';
    private $User_Name = 'Cannibal Corpse';
    private $User_Phone = '11177788444';
    private $User_City = 'Львів Сіті';


    
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
        $I->logoutCabinet();
    }
    
    
    
    /**
     * @group x
     * @guy PremmerceTester\PremmerceSteps
     */
    public function CreateProductCategorysThreeLevels (PremmerceTester\PremmerceSteps $I){
        $I->loginCabinet($this->User_Email, $this->User_Password);
        $I->wait(1);
        $I->amOnUrl($this->storeUrl . '/admin');
        $I->wait(1);
        $I->login($this->User_Email, $this->User_Password);
        $I->wait(1);
        $I->click(GeneralPage::$ProductsCatalogue);
        $I->wait(1);
        $I->click(GeneralPage::$ProductCategories);
        $I->wait(1);
        $I->click(ProductCategoryListPage::$ButtonCreate);
        $I->wait(1);
        $this->CreateProductCategory($I, $this->Category_First_Name);
        $I->wait(1);
        $this->CreateProductCategory($I, $this->Category_Second_Name);
        $I->wait(1);
        $this->CreateProductCategory($I, $this->Category_Third_Name);
        $I->wait(1);
//        $I->logoutCabinet();
    }
    
    //// PROTECTED
    
    protected function CreateProductCategory(PremmerceTester $I, $Name_Category, $Name_Parent_Category = NULL) {
        $I->amOnPage(ProductCategoryCreatePage::$URL);
        $I->wait('1');
            $I->fillField(ProductCategoryCreatePage::$InputName, $Name_Category);//'#inputName'
        if(isset($Name_Parent_Category)){ 
//            $I->sele(ProductCategoryCreatePage::$SelectParent);//'//div[1]/div[2]/div/div/a'
        $I->wait('1');
            $I->selectOption('#inputMainC', $Name_Parent_Category);
//            $I->fillField('//section/form/div[1]/table[1]/tbody/tr/td/div/div[1]/div[2]/div/div/div/div/input', $Name_Parent_Category);
//            $I->click('//section/form/div[1]/table[1]/tbody/tr/td/div/div[1]/div[2]/div/div/div/ul/li');
        }
        $I->click(ProductCategoryCreatePage::$ButtonCreate); 
        $I->wait('2');
    }
    
}

