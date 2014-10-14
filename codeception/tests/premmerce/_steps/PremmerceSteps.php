<?php

namespace PremmerceTester;

class PremmerceSteps extends \PremmerceTester {

    public function createStore($store_name, $email, $password, $country = NULL) {
        $I = $this;
        $I->fillField(\CreateStorePage::$InputDomain, $store_name);
        $I->fillField(\CreateStorePage::$InputEmail, $email);
        $I->fillField(\CreateStorePage::$InputPassword, $password);
        $I->fillField(\CreateStorePage::$InputName, 'defult');
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
    public function generateName($length = 10){
        $set = "abcdefghijklmnopqrstuvwxyz1234567890";
        $size = strlen($set) - 1;
        $name = '';
        while ($length--) {
            $name.=$set[rand(0, $size)];
        }
        return $name;
    
    }

}
