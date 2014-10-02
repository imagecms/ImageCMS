<?php
namespace UkrainianTester;

class LocUaSteps extends \UkrainianTester
{
    public function CreateShop($store1,$mail1,$password,$user,$phone,$city,$country=null,$category=null,$level=null,$agree=null)
    {
        $I = $this;              
        $I->fillField(\LocUaPage::$ShopNameField, $store1);
        $I->fillField(\LocUaPage::$EmailField, $mail1);
        $I->fillField(\LocUaPage::$PasswordField, $password);
        $I->fillField(\LocUaPage::$UserNameField, $user);
        $I->fillField(\LocUaPage::$PhoneNumberField, $phone);
        $I->fillField(\LocUaPage::$CityField, $city);
        if(isset($country)){
            $I->click(\LocUaPage::$CountrySelectMenu);        
            $I->click("//*[@id='cusel-scroll-id1']/span[$country]");
        }
        if(isset($category)){
            $I->click(\LocUaPage::$CategorySelectMenu);
            $I->click("//*[@id='cusel-scroll-id2']/span[$category]");
        }
        if(isset($level)){
            $I->click(\LocUaPage::$LevelOfUseSelectMenu);
            $I->click("//*[@id='cusel-scroll-id3']/span[$level]");
        }
        if(isset($agree)){
            $I->click(\LocUaPage::$AgreeCheckbox);
        }
        $I->click(\LocUaPage::$CreateShopNowRegisterFormButton);
    }   
}