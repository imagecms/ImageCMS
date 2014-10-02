<?php
namespace RussianTester;

class LocrusSteps extends \RussianTester
{
       
    public function CreateShop($store1,$mail1,$password,$user,$phone,$city,$country=null,$category=null,$level=null,$agree=null)
    {
        $I = $this;              
        $I->fillField(\LocRusPage::$ShopNameField, $store1);
        $I->fillField(\LocRusPage::$EmailField, $mail1);
        $I->fillField(\LocRusPage::$PasswordField, $password);
        $I->fillField(\LocRusPage::$UserNameField, $user);
        $I->fillField(\LocRusPage::$PhoneNumberField, $phone);
        $I->fillField(\LocRusPage::$CityField, $city);
        if(isset($country)){
            $I->click(\LocRusPage::$CountrySelectMenu);        
            $I->click("//*[@id='cusel-scroll-id1']/span[$country]");
        }
        if(isset($category)){
            $I->click(\LocRusPage::$CategorySelectMenu);
            $I->click("//*[@id='cusel-scroll-id2']/span[$category]");
        }
        if(isset($level)){
            $I->click(\LocRusPage::$LevelOfUseSelectMenu);
            $I->click("//*[@id='cusel-scroll-id3']/span[$level]");
        }
        if(isset($agree)){
            $I->click(\LocRusPage::$AgreeCheckbox);
        }
        $I->click(\LocRusPage::$CreateShopNowRegisterFormButton);
    }    
    public function edit()
    {
        $I = $this;
    }
}