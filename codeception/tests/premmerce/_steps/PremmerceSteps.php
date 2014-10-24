<?php

namespace PremmerceTester;

class PremmerceSteps extends \PremmerceTester {

    /**
     * @param string $store_name
     * @param string $user_email
     * @param string $user_password
     * @param string $country
     * @param string $user_name
     * @param string $user_phone
     * @param string $user_city
     * @param int    $product_category
     * @param int    $product_level
     * @param bool   $agree
     * 
     * @return void
     */
    public function createStore($store_name, $user_email, $user_password, 
                                    $country = NULL, $user_name = 'Test', $user_phone = '800800', 
                                    $user_city = 'MyCity', $product_category = '11', $product_level = '3', $agree = TRUE) {
        $I = $this;
        $I->fillField(\CreateStorePage::$InputDomain,   $store_name);
        $I->fillField(\CreateStorePage::$InputEmail,    $user_email);
        $I->fillField(\CreateStorePage::$InputPassword, $user_password);
        $I->fillField(\CreateStorePage::$InputName,     $user_name);
        $I->fillField(\CreateStorePage::$InputPhone,    $user_phone);
        $I->fillField(\CreateStorePage::$InputCity,     $user_city);
        if (isset($country)) {
            $I->click(\CreateStorePage::$SelectCountry);
            $I->click(\CreateStorePage::selectCountryOption($country));
        }
        $I->click(\CreateStorePage::$SelectCategoryOfProducts);
        $I->click(\CreateStorePage::selectCategoryOfProductsOption($product_category));
        $I->click(\CreateStorePage::$SelectProducts);
        $I->click(\CreateStorePage::selectProductsOption($product_level));
        if ($agree) { $I->checkOption(\CreateStorePage::$CheckAgree);
        }
        $I->wait(3);
        $I->click(\CreateStorePage::$ButtonCreate);
        $I->waitForElement('.info-header', 60);
    }
    
    
    /**
     * Login for Saas Admim and StoreAdmin
     * 
     * @param string $user_email
     * @param string $user_password
     */
    public function login($user_email = USER_EMAIL, $user_password = USER_PASSWORD) {
        $I = $this;
        $I->amOnPage('/admin');
        $I->submitForm('#with_out_article', ['login' => $user_email, 'password' => $user_password]);
        $I->waitForElement('#topPanelNotifications');
    }
    public function logoutStore() {
        $I = $this;
        $I->click(\GeneralPage::$PersonalButton);
        $I->wait(2);
        $I->click(\GeneralPage::$PersonalButtonLogout);
    }

    /**
     * @param string $user_email
     * @param string $user_password
     */
    public function loginCabinet($user_email, $user_password) {

        $I = $this;
        $I->amOnPage(\MainPage::$URL);
        $I->wait(3);
        $I->click(\MainPage::$ButtonEnter);
        $I->wait(2);
        $I->fillField(\MainPage::$WindowLoginInputEmail, $user_email);
        $I->wait(1);
        $I->fillField(\MainPage::$WindowLoginInputPassword, $user_password);
        $I->wait(1);
        $I->click(\MainPage::$WindowLoginButtonSend);
        $I->wait(7);
    }

    
    public function logoutCabinet() {
        $I = $this;
        $I->click(\CabinetPage::$HeadButtonProfile);
        $I->wait(2);
        $I->click(\CabinetPage::$HeadButtonProfileExit);
    }



    public function logoutSaas() {
        $I = $this;
        $I->wait(1);
        $I->click(\SaasGeneralPage::$Logout);
        $I->wait(1);
    }

    
    /**
     * Returns random text with passed length
     *   
     * @param int $length
     * @return string
     */
    public function generateName($length = 10) {
        $set = "abcdefghijklmnopqrstuvwxyz";
        $size = strlen($set) - 1;
        $name = '';
        while ($length--) {
            $name.=$set[rand(0, $size)];
        }
        return $name;
    }
    
    public function SetTextAditorNative() {  
        $I = $this;
        $I->wait(1);
        $I->amOnPage('/admin/settings#setings');
        $I->wait(2);
        $I->selectOption('#textEditor', 'Native textarea');
        $I->click('.btn.btn-small.btn-primary.action_on.formSubmit');
        $I->wait('3');
    }
}
