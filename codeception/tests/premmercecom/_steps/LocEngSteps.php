<?php
namespace EnglishTester;

class LocEngSteps extends \EnglishTester
{
    public function CreateShop($store1,$mail1,$password,$user,$phone,$city,$country=null,$category=null,$level=null,$agree=null)
    {
        $I = $this;              
        $I->fillField(\LocEngPage::$ShopNameField, $store1);
        $I->fillField(\LocEngPage::$EmailField, $mail1);
        $I->fillField(\LocEngPage::$PasswordField, $password);
        $I->fillField(\LocEngPage::$UserNameField, $user);
        $I->fillField(\LocEngPage::$PhoneNumberField, $phone);
        $I->fillField(\LocEngPage::$CityField, $city);
        if(isset($country)){
            $I->click(\LocEngPage::$CountrySelectMenu);        
            $I->click("//*[@id='cusel-scroll-id1']/span[$country]");
        }
        if(isset($category)){
            $I->click(\LocEngPage::$CategorySelectMenu);
            $I->click("//*[@id='cusel-scroll-id2']/span[$category]");
        }
        if(isset($level)){
            $I->click(\LocEngPage::$LevelOfUseSelectMenu);
            $I->click("//*[@id='cusel-scroll-id3']/span[$level]");
        }
        if(isset($agree)){
            $I->click(\LocEngPage::$AgreeCheckbox);
        }
        $I->click(\LocEngPage::$CreateShopNowRegisterFormButton);
    }    
}