<?php
namespace UkrainianTester;

class LocUaSteps extends \UkrainianTester
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
    
    
    
    
    
//    //----Saas--------Saas--------Saas--------Saas--------Saas--------Saas----
//    
//    public function CreateStore($store_name,
//                                $user_email,
//                                $user_password,
//                                $user_name,
//                                $user_phone,
//                                $user_city,
//                                $product_category,
//                                $product_level){
//        $I = $this;                     
//        $I->fillField(\PremmerceCreateShopPage::$FieldStoreName, $store_name);
//        $I->fillField(\PremmerceCreateShopPage::$FieldUserEmail, $user_email);
//        $I->fillField(\PremmerceCreateShopPage::$FieldUserPassword, $user_password); 
//        $I->fillField(\PremmerceCreateShopPage::$FieldUserName, $user_name);
//        $I->fillField(\PremmerceCreateShopPage::$FieldUserPhone, $user_phone);
//        $I->fillField(\PremmerceCreateShopPage::$FieldUserCity, $user_city);
//        $I->wait(1);
//        $I->click(\PremmerceCreateShopPage::$SelectProductCategory);
//        $I->click("//*[@id='cusel-scroll-id2']/span[$product_category]");
//        $I->wait(1);
//        $I->click(\PremmerceCreateShopPage::$SelectProductLevel);
//        $I->click("//*[@id='cusel-scroll-id3']/span[$product_level]");
//        $I->wait(1);
//        $I->click(\PremmerceCreateShopPage::$CheckBoxAgree);
//        $I->click(\PremmerceCreateShopPage::$ButtonCreateStore);
//        $I->wait(1);
//    }  
//    
//    
//    public function AdminLogin (    $admin_email,
//                                    $admin_password){
//        $I = $this; 
//        $I->amOnPage('/admin');
//        $I->wait(1);
//        $I->fillField('//body/div[1]/div[1]/form/label[1]/input', $admin_email);
//        $I->wait(1);
//        $I->fillField('//body/div[1]/div[1]/form/label[2]/input', $admin_password);
//        $I->wait(1);
//        $I->click('//body/div[1]/div[1]/form/input[1]');
//        $I->wait(3);
//    }
//    
//    public function AdminLogout (){
//        $I = $this;
//        $I->click(\SaasUserListPage::$NavigationSystem);
//        $I->click(\SaasUserListPage::$NavigationSystemClearCach);
//        $I->wait(1);
//        $I->click(\SaasUserListPage::$Logout);
//        $I->wait(1);
//    } 
//    
//    public function AdminCabinetLogin (    $admin_email,
//                                    $admin_password){
//        $I = $this; 
//        $I->wait(1);
//        $I->fillField('//body/div[1]/div[1]/form/label[1]/input', $admin_email);
//        $I->wait(1);
//        $I->fillField('//body/div[1]/div[1]/form/label[2]/input', $admin_password);
//        $I->wait(1);
//        $I->click('//body/div[1]/div[1]/form/input[1]');
//        $I->wait(3);
//    }
//    
//    
//    
//    
//    public function CabinetLogin (  $user_email,
//                                    $user_password){
//        $I = $this; 
//        $I->amOnPage(\PremmerceMainPage::$URL);//body/div[3]/header/div/div/div/div[1]/div[1]/a
//        $I->wait(2);           //body/div[3]/header/div/div/div/div[1]/div[1]/button 
//        $button_text = $I->grabTextFrom('//body/div[3]/header/div/div/div/div[1]/div[1]');
//        $I->comment("$button_text");
//        $name_button_enter      = 'ВХІД';
//        $name_button_cabinet    = 'КАБІНЕТ';
//        if($button_text == $name_button_enter){
//            $I->click(\PremmerceMainPage::$ButtonEnter);
//        $I->wait(1);
//        $I->fillField(\PremmerceMainPage::$WindowLoginFieldEmail, $user_email);
//        $I->wait(1);
//        $I->fillField(\PremmerceMainPage::$WindowLoginFieldPassword, $user_password);
//        $I->wait(1);
//        $I->click(\PremmerceMainPage::$WindowLoginButtonSend);
//        $I->wait(7);
//        }
//        if($button_text == $name_button_cabinet){
//        $I->click(\PremmerceMainPage::$ButtonCabinet);
//        $I->wait(1);
//        }
//    }
//    
//    public function CabinetLogout (){
//        $I = $this;
//        $I->click(\PremmerceCabinetPage::$HeadLinkProfile);
//        $I->click(\PremmerceCabinetPage::$HeadLinkProfileLinkExit);
//        $I->wait(1);
//    } 
    
}