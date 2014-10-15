<?php

namespace PremmerceTester;

class PremmerceSteps extends \PremmerceTester {

    public function createStore($store_name, $email, $password, $country = NULL) { //$user, $phone, $city, $category=null, $level=null, $agree=null
        $I = $this;
        $I->fillField(\CreateStorePage::$InputDomain, $store_name);
        $I->fillField(\CreateStorePage::$InputEmail, $email);
        $I->fillField(\CreateStorePage::$InputPassword, $password);
        $I->fillField(\CreateStorePage::$InputName, 'Test');
        $I->fillField(\CreateStorePage::$InputPhone, '800800');
        $I->fillField(\CreateStorePage::$InputCity, 'MyCity');
        if (isset($country)) {
            $I->click(\CreateStorePage::$SelectCountry);
            $I->click(\CreateStorePage::selectCountryOption($country));
        }
        $I->click(\CreateStorePage::$SelectCategoryOfProducts);
        $I->click(\CreateStorePage::selectCategoryOfProductsOption(11));
        $I->click(\CreateStorePage::$SelectProducts);
        $I->click(\CreateStorePage::selectProductsOption(3));
        $I->checkOption(\CreateStorePage::$CheckAgree);
        $I->click(\CreateStorePage::$ButtonCreate);
        $I->waitForElement('.info-header', 60);
    }

    public function generateName($length = 10) {
//        $set = "abcdefghijklmnopqrstuvwxyz1234567890";
        $set = "abcdefghijklmnopqrstuvwxyz";
        $size = strlen($set) - 1;
        $name = '';
        while ($length--) {
            $name.=$set[rand(0, $size)];
        }
        return $name;
    }
    
    
    public function StoreLogin($user_email, $user_password){
        $I = $this;
        $I->submitForm('#with_out_article', ['login' => $user_email, 'password' => $user_password]);
        $I->waitForElement('#topPanelNotifications');
    }
    
    public function StoreLogout(){
        $I = $this;
        $I->click(\GeneralPage::$PersonalButton);
        $I->wait(2);
        $I->click(\GeneralPage::$PersonalButtonLogout);
        $I->wait(2);
    }
    
    public function CabinetLogin($user_email, $user_password) {

        $I = $this; 
        $I->amOnPage(\PremmerceMainPage::$URL);//body/div[3]/header/div/div/div/div[1]/div[1]/a
        $I->wait(2);           //body/div[3]/header/div/div/div/div[1]/div[1]/button 
        $button_text = $I->grabTextFrom('//body/div[3]/header/div/div/div/div[1]/div[1]');
        $I->comment("$button_text");
        $name_button_enter      = 'ВХІД';
        $name_button_cabinet    = 'КАБІНЕТ';
        if($button_text == $name_button_enter){
            $I->click(\PremmerceMainPage::$ButtonEnter);
        $I->wait(1);
        $I->fillField(\PremmerceMainPage::$WindowLoginFieldEmail, $user_email);
        $I->wait(1);
        $I->fillField(\PremmerceMainPage::$WindowLoginFieldPassword, $user_password);
        $I->wait(1);
        $I->click(\PremmerceMainPage::$WindowLoginButtonSend);
        $I->wait(7);
        }
        if($button_text == $name_button_cabinet){
        $I->click(\PremmerceMainPage::$ButtonCabinet);
        $I->wait(1);
        }
    
    }

    public function CabinetLogout() {
        $I = $this;
        $I->click('.btn-profile.btn.isDrop');
        $I->wait(2);
        $I->click('.sub-menu.drop-sub-menu.drop.noinherit.active>li:nth-child(2)>a');
    }

    public function SaasLogin() {
        $I = $this;
        $I->amOnPage('/admin');
        $I->wait(1);
        $I->fillField('//body/div[1]/div[1]/form/label[1]/input', USER_EMAIL);
        $I->wait(1);
        $I->fillField('//body/div[1]/div[1]/form/label[2]/input', USER_PASSWORD);
        $I->wait(1);
        $I->click('//body/div[1]/div[1]/form/input[1]');
        $I->wait(3);
    }

    public function SaasLogout() {
        $I = $this;
        $I->click(\SaasUserListPage::$NavigationSystem);
        $I->click(\SaasUserListPage::$NavigationSystemClearCach);
        $I->wait(1);
        $I->click(\SaasUserListPage::$Logout);
        $I->wait(1);
    }

}
