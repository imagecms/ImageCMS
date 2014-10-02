<?php
namespace RussianTester;

class LocrusSteps extends \RussianTester
{
       
    public function CreateShop($store1,$mail1,$password,$user,$phone,$city,$country=null,$category=null,$level=null,$agree=null)
    {
        $I = $this;              
        $I->fillField(\PremmerceCreateShopPage::$ShopNameField, $store1);
        $I->fillField(\PremmerceCreateShopPage::$EmailField, $mail1);
        $I->fillField(\PremmerceCreateShopPage::$PasswordField, $password);
        $I->fillField(\PremmerceCreateShopPage::$UserNameField, $user);
        $I->fillField(\PremmerceCreateShopPage::$PhoneNumberField, $phone);
        $I->fillField(\PremmerceCreateShopPage::$CityField, $city);
        if(isset($country)){
            $I->click(\PremmerceCreateShopPage::$CountrySelectMenu);        
            $I->click("//*[@id='cusel-scroll-id1']/span[$country]");
        }
        if(isset($category)){
            $I->click(\PremmerceCreateShopPage::$CategorySelectMenu);
            $I->click("//*[@id='cusel-scroll-id2']/span[$category]");
        }
        if(isset($level)){
            $I->click(\PremmerceCreateShopPage::$LevelOfUseSelectMenu);
            $I->click("//*[@id='cusel-scroll-id3']/span[$level]");
        }
        if(isset($agree)){
            $I->click(\PremmerceCreateShopPage::$AgreeCheckbox);
        }
        $I->click(\PremmerceCreateShopPage::$CreateShopNowRegisterFormButton);
    }    
    public function edit()
    {
        $I = $this;
    }
}