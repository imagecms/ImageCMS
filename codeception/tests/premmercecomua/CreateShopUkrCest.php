<?php
use \UkrainianTester;

class CreateShopUkrCest
{
    private $store, $mail;
    public function AllElementsPresent1(UkrainianTester $I)
    {
        InitTest::VerifyLogInOrLogOutPremmerceAdmin($I);
        $I->amOnPage(PremmerceMainPage::$URL); 
        $I->seeElement(PremmerceMainPage::$CreateShopField);
        $I->seeElement(PremmerceMainPage::$DomainEnd);
        $I->see(".premme.com", PremmerceMainPage::$DomainEnd);
        $I->click(PremmerceMainPage::$CreateShopButtonCentre);
        $RequiredDomain=$I->grabAttributeFrom(PremmerceMainPage::$ErrorDomain, 'class');
        $I->comment($RequiredDomain);
        $I->assertEquals($RequiredDomain, 'create-msg');
        $I->wait('2');
        $I->fillField(PremmerceMainPage::$CreateShopField, 'sh');
        $I->wait('2');
        $I->click(PremmerceMainPage::$CreateShopButtonCentre);
        $I->waitForElement(PremmerceCreateShopPage::$RegisterForm);                
        $I->seeElement(PremmerceCreateShopPage::$DomainEndInRegisterForm);
        $I->see(".premme.com", PremmerceCreateShopPage::$DomainEndInRegisterForm);
        $I->seeElement(PremmerceCreateShopPage::$EmailField);
        $I->seeElement(PremmerceCreateShopPage::$PasswordField);
        $I->seeElement(PremmerceCreateShopPage::$UserNameField);
        $I->seeElement(PremmerceCreateShopPage::$PhoneNumberField);
        $I->seeElement(PremmerceCreateShopPage::$CountrySelectMenu);
        $I->seeElement(PremmerceCreateShopPage::$CityField);
        $I->seeElement(PremmerceCreateShopPage::$CategorySelectMenu);
        $I->seeElement(PremmerceCreateShopPage::$LevelOfUseSelectMenu);
        $I->seeElement(PremmerceCreateShopPage::$AgreeCheckbox);
        $I->seeElement(PremmerceCreateShopPage::$WorkConditionLink);
        $I->seeElement(PremmerceCreateShopPage::$CreateShopNowRegisterFormButton);    
    }
    
    
    public function AllElementsPresent2(UkrainianTester $I)
    {
        $I->amOnPage(PremmerceMainPage::$URL);        
        $I->click(PremmerceMainPage::$CreateShopButtonTop);        
        $I->waitForElement(PremmerceCreateShopPage::$RegisterForm);                
        $I->seeElement(PremmerceCreateShopPage::$DomainEndInRegisterForm);
        $I->see(".premme.com", PremmerceCreateShopPage::$DomainEndInRegisterForm);        
        $I->seeElement(PremmerceCreateShopPage::$PasswordField);
        $I->seeElement(PremmerceCreateShopPage::$UserNameField);
        $I->seeElement(PremmerceCreateShopPage::$PhoneNumberField);
        $I->seeElement(PremmerceCreateShopPage::$CountrySelectMenu);
        $I->seeElement(PremmerceCreateShopPage::$CityField);
        $I->seeElement(PremmerceCreateShopPage::$CategorySelectMenu);
        $I->seeElement(PremmerceCreateShopPage::$LevelOfUseSelectMenu);
        $I->seeElement(PremmerceCreateShopPage::$AgreeCheckbox);
        $I->seeElement(PremmerceCreateShopPage::$WorkConditionLink);
        $I->seeElement(PremmerceCreateShopPage::$CreateShopNowRegisterFormButton);              
    }
    
    
    public function RequiredFields1(UkrainianTester $I)
    {
        $I->amOnPage(PremmerceMainPage::$URL);
        $I->wait(5);
        $I->fillField(PremmerceMainPage::$CreateShopField, 'ыывв');
        $I->wait('2');
        $I->click(PremmerceMainPage::$CreateShopButtonCentre);
        $I->waitForElement(PremmerceCreateShopPage::$RegisterForm); 
        $I->click(PremmerceCreateShopPage::$CreateShopNowRegisterFormButton);
        $ErrorDomain=$I->grabAttributeFrom(PremmerceCreateShopPage::$ErrorDomain, 'class');
        $I->comment("ErrorDomain: $ErrorDomain");
        $I->assertEquals($ErrorDomain, 'error');
        $RequiredEmail=$I->grabAttributeFrom(PremmerceCreateShopPage::$ErrorEmail, 'class');
        $I->comment("RequiredEmail: $RequiredEmail");
        $I->assertEquals($RequiredEmail, 'error');
        $RequiredPassword=$I->grabAttributeFrom(PremmerceCreateShopPage::$ErrorPassword, 'class');
        $I->comment("RequiredPassword: $RequiredPassword");
        $I->assertEquals($RequiredPassword, 'error');
        $RequiredUserName=$I->grabAttributeFrom(PremmerceCreateShopPage::$ErrorUserName, 'class');
        $I->comment("RequiredUserName: $RequiredUserName");
        $I->assertEquals($RequiredUserName, 'error');
        $RequiredPhone=$I->grabAttributeFrom(PremmerceCreateShopPage::$ErrorPhoneNumber, 'class');
        $I->comment("RequiredPhone: $RequiredPhone");
        $I->assertEquals($RequiredPhone, 'error');
        $RequiredCity=$I->grabAttributeFrom(PremmerceCreateShopPage::$ErrorCity, 'class');
        $I->comment("RequiredCity: $RequiredCity");
        $I->assertEquals($RequiredCity, 'error');        
        $RequiredLevel=$I->grabAttributeFrom(PremmerceCreateShopPage::$ErrorLevelOfUse, 'class');
        $I->comment("RequiredLevel: $RequiredLevel");
        $I->assertEquals($RequiredLevel, 'error');
        $RequiredAgree=$I->grabAttributeFrom(PremmerceCreateShopPage::$ErrorAgree, 'class');
        $I->comment("RequiredAgree: $RequiredAgree");
        $I->assertEquals($RequiredAgree, 'error');
    }
    
        
    public function RequiredFields2(UkrainianTester $I)
    {
        $I->amOnPage(PremmerceMainPage::$URL);        
        $I->click(PremmerceMainPage::$CreateShopButtonTop);        
        $I->waitForElement(PremmerceCreateShopPage::$RegisterForm); 
        $I->click(PremmerceCreateShopPage::$CreateShopNowRegisterFormButton);
        $ErrorDomain=$I->grabAttributeFrom(PremmerceCreateShopPage::$ErrorDomain, 'class');
        $I->comment("ErrorDomain: $ErrorDomain");
        $I->assertEquals($ErrorDomain, 'error');
        $RequiredEmail=$I->grabAttributeFrom(PremmerceCreateShopPage::$ErrorEmail, 'class');
        $I->comment("RequiredEmail: $RequiredEmail");
        $I->assertEquals($RequiredEmail, 'error');
        $RequiredPassword=$I->grabAttributeFrom(PremmerceCreateShopPage::$ErrorPassword, 'class');
        $I->comment("RequiredPassword: $RequiredPassword");
        $I->assertEquals($RequiredPassword, 'error');
        $RequiredUserName=$I->grabAttributeFrom(PremmerceCreateShopPage::$ErrorUserName, 'class');
        $I->comment("RequiredUserName: $RequiredUserName");
        $I->assertEquals($RequiredUserName, 'error');
        $RequiredPhone=$I->grabAttributeFrom(PremmerceCreateShopPage::$ErrorPhoneNumber, 'class');
        $I->comment("RequiredPhone: $RequiredPhone");
        $I->assertEquals($RequiredPhone, 'error');
        $RequiredCity=$I->grabAttributeFrom(PremmerceCreateShopPage::$ErrorCity, 'class');
        $I->comment("RequiredCity: $RequiredCity");
        $I->assertEquals($RequiredCity, 'error');        
        $RequiredLevel=$I->grabAttributeFrom(PremmerceCreateShopPage::$ErrorLevelOfUse, 'class');
        $I->comment("RequiredLevel: $RequiredLevel");
        $I->assertEquals($RequiredLevel, 'error');
        $RequiredAgree=$I->grabAttributeFrom(PremmerceCreateShopPage::$ErrorAgree, 'class');
        $I->comment("RequiredAgree: $RequiredAgree");
        $I->assertEquals($RequiredAgree, 'error');
    }
    
    
//    public function RequiredFields3(UkrainianTester $I)
//    {
//        $I->amOnPage('/');        
//        $I->click(LocUaPage::$CreateShopButtonCentre);
//        $I->waitForElement(LocUaPage::$RegisterForm);
//        $I->click(LocUaPage::$RusLangRegisterFormLink);
//        $I->seeCurrentUrlEquals('/ru/saas/create_store');
//        $I->click(LocUaPage::$CreateShopNowRegisterFormButton);
//        $ErrorDomain=$I->grabAttributeFrom(".//*[@id='register-form']/div/label/span[2]", 'class');
//        $I->comment("Error Domain:$ErrorDomain");
//        $I->assertEquals($ErrorDomain, 'form_error');
//        $RequiredEmail=$I->grabAttributeFrom(".//*[@id='register-form']/div/div[2]/div[1]/label[1]/span", 'class');
//        $I->comment("Reguired Email:$RequiredEmail");
//        $I->assertEquals($RequiredEmail, 'form_error');
//        $RequiredPassword=$I->grabAttributeFrom(".//*[@id='register-form']/div/div[2]/div[2]/label[1]/span", 'class');
//        $I->comment("Reguired Password:$RequiredPassword");
//        $I->assertEquals($RequiredPassword, 'form_error');
//        $RequiredUserName=$I->grabAttributeFrom(".//*[@id='register-form']/div/div[2]/div[1]/label[2]/span", 'class');
//        $I->comment("Reguired User Name:$RequiredUserName");
//        $I->assertEquals($RequiredUserName, 'form_error');
//        $RequiredPhone=$I->grabAttributeFrom(".//*[@id='register-form']/div/div[2]/div[2]/label[2]/span", 'class');
//        $I->comment("Reguired Phone:$RequiredPhone");
//        $I->assertEquals($RequiredPhone, 'form_error');
////        $RequiredCountry=$I->grabAttributeFrom(".//*[@id='register-form']/div/div[2]/div[1]/div[1]/span", 'class');
////        $I->comment("Reguired Country:$RequiredCountry");
////        $I->assertEquals($RequiredCountry, 'form_error');
//        $RequiredCity=$I->grabAttributeFrom(".//*[@id='register-form']/div/div[2]/div[2]/label[3]/span", 'class');
//        $I->comment("Reguired City:$RequiredCity");
//        $I->assertEquals($RequiredCity, 'form_error');
//        $RequiredCategory=$I->grabAttributeFrom(".//*[@id='register-form']/div/div[2]/div[1]/div[2]/span", 'class');
//        $I->comment("Reguired Category:$RequiredCategory");
//        $I->assertEquals($RequiredCategory, 'form_error');
//        $RequiredLevel=$I->grabAttributeFrom(".//*[@id='register-form']/div/div[2]/div[2]/div/span", 'class');
//        $I->comment("Reguired Level:$RequiredLevel");
//        $I->assertEquals($RequiredLevel, 'form_error');
//        $RequiredAgree=$I->grabAttributeFrom(".//*[@id='register-form']/div/div[3]/span[2]", 'class');
//        $I->comment("Reguired Agree:$RequiredAgree");
//        $I->assertEquals($RequiredAgree, 'form_error');
//    }
    
    
     /**
     * @guy UkrainianTester\LocUaSteps
     */
    
    public function ValidationDomain1Fail(UkrainianTester\LocUaSteps $I)
    {
        InitTest::VerifyLogInOrLogOutPremmerceAdmin($I);
        $I->click(PremmerceMainPage::$CreateShopButtonTop);        
        $I->waitForElement(PremmerceCreateShopPage::$RegisterForm);
        $set="abcdefghijklmnopqrstuvwxyz1234567890";
            $size = strlen($set)-1; 
            $prefix = 'shop-ua-by-';
            $mailsufix = '@gmail.com';
            $name = null;
            $max = 7;
                while($max--)
                $name.=$set[rand(0,$size)]; 
            $store1 = '-'.$prefix.$name;
            $mail1 = $prefix.$name.$mailsufix;
            echo "your store name: $store1 \nyoour mail: $mail1";
            $password='1111111';
            $user='Norman';
            $phone='4443434367';
            $city='Boston';
            $country='3';
            $category='2';
            $level='3';
            $agree='';
            $I->CreateShop($store1, $mail1, $password, $user, $phone, $city, null, null, $level, $agree);
            $I->wait('2');
        $ErrorDomain=$I->grabAttributeFrom(PremmerceCreateShopPage::$ErrorDomain, 'class');
        $I->comment("Domain:$ErrorDomain");
        $I->assertEquals($ErrorDomain, 'error');        
    }
    
    
    /**
     * @guy UkrainianTester\LocUaSteps
     */
    
    public function ValidationDomain2Fail(UkrainianTester\LocUaSteps $I)
    {
        InitTest::VerifyLogInOrLogOutPremmerceAdmin($I);
        $I->click(PremmerceMainPage::$CreateShopButtonTop);        
        $I->waitForElement(PremmerceCreateShopPage::$RegisterForm);
        $set="abcdefghijklmnopqrstuvwxyz1234567890";
            $size = strlen($set)-1; 
            $prefix = 'shop-ua-ru-';
            $mailsufix = '@gmail.com';
            $name = null;
            $max = 7;
                while($max--)
                $name.=$set[rand(0,$size)]; 
            $store1 = '_'.$prefix.$name;
            $mail1 = $prefix.$name.$mailsufix;
            echo "your store name: $store1 \nyoour mail: $mail1";
            $password='1111111';
            $user='Norman';
            $phone='4443434367';
            $city='Boston';
            $country='2';
            $category='2';
            $level='3';
            $agree='';
            $I->CreateShop($store1, $mail1, $password, $user, $phone, $city, null, null, $level, $agree);
            $I->wait('2');
        $ErrorDomain=$I->grabAttributeFrom(PremmerceCreateShopPage::$ErrorDomain, 'class');
        $I->comment("Domain:$ErrorDomain");
        $I->assertEquals($ErrorDomain, 'error');        
    }
    
    
    /**
     * @guy UkrainianTester\LocUaSteps
     */
    
    public function ValidationDomain3Fail(UkrainianTester\LocUaSteps $I)
    {
        InitTest::VerifyLogInOrLogOutPremmerceAdmin($I);
        $I->click(PremmerceMainPage::$CreateShopButtonTop);        
        $I->waitForElement(PremmerceCreateShopPage::$RegisterForm);
        $set="abcdefghijklmnopqrstuvwxyz1234567890";
            $size = strlen($set)-1; 
            $prefix = 'shop-ua-ua-';
            $mailsufix = '@gmail.com';
            $name = null;
            $max = 7;
                while($max--)
                $name.=$set[rand(0,$size)]; 
            $store1 = $prefix.$name.'-';
            $mail1 = $prefix.$name.$mailsufix;
            echo "your store name: $store1 \nyoour mail: $mail1";
            $password='1111111';
            $user='Norman';
            $phone='4443434367';
            $city='Boston';
            $country='1';
            $category='2';
            $level='3';
            $agree='';
            $I->CreateShop($store1, $mail1, $password, $user, $phone, $city, null, null, $level, $agree);
            $I->wait('2');
        $ErrorDomain=$I->grabAttributeFrom(PremmerceCreateShopPage::$ErrorDomain, 'class');
        $I->comment("Domain:$ErrorDomain");
        $I->assertEquals($ErrorDomain, 'error');        
    }
            
    /**
     * @guy UkrainianTester\LocUaSteps
     */
    
    public function ValidationDomain4Fail(UkrainianTester\LocUaSteps $I)
    {
        InitTest::VerifyLogInOrLogOutPremmerceAdmin($I);
        $I->click(PremmerceMainPage::$CreateShopButtonTop);        
        $I->waitForElement(PremmerceCreateShopPage::$RegisterForm);
        $set="abcdefghijklmnopqrstuvwxyz1234567890";
            $size = strlen($set)-1; 
            $prefix = 'shop-ua-by-';
            $mailsufix = '@gmail.com';
            $name = null;
            $max = 7;
                while($max--)
                $name.=$set[rand(0,$size)]; 
            $store1 = '&#'.$prefix.'sdfs%^&$'.'fd'.$name;
            $mail1 = $prefix.$name.$mailsufix;
            echo "your store name: $store1 \nyoour mail: $mail1";
            $password='1111111';
            $user='Norman';
            $phone='4443434367';
            $city='Boston';
            $country='3';
            $category='2';
            $level='3';
            $agree='';
            $I->CreateShop($store1, $mail1, $password, $user, $phone, $city, null, null, $level, $agree);
            $I->wait('2');
        $ErrorDomain=$I->grabAttributeFrom(PremmerceCreateShopPage::$ErrorDomain, 'class');
        $I->comment("Domain:$ErrorDomain");
        $I->assertEquals($ErrorDomain, 'error');        
    }
    
    /**
     * @guy UkrainianTester\LocUaSteps
     */
    
    public function ValidationDomain5Fail(UkrainianTester\LocUaSteps $I)
    {
        InitTest::VerifyLogInOrLogOutPremmerceAdmin($I);
        $I->click(PremmerceMainPage::$CreateShopButtonTop);        
        $I->waitForElement(PremmerceCreateShopPage::$RegisterForm);
        $set="abcdefghijklmnopqrstuvwxyz1234567890";
            $size = strlen($set)-1; 
            $prefix = 'shop-ua-ua-';
            $mailsufix = '@gmail.com';
            $name = null;
            $max = 7;
                while($max--)
                $name.=$set[rand(0,$size)]; 
            $store1 = $prefix.'_'.'12fg'.$name;
            $mail1 = $prefix.$name.$mailsufix;
            echo "your store name: $store1 \nyoour mail: $mail1";
            $password='1111111';
            $user='Norman';
            $phone='4443434367';
            $city='Boston';
            $country='1';
            $category='2';
            $level='3';
            $agree='';
            $I->CreateShop($store1, $mail1, $password, $user, $phone, $city, null, null, $level, $agree);
            $I->wait('2');
        $ErrorDomain=$I->grabAttributeFrom(PremmerceCreateShopPage::$ErrorDomain, 'class');
        $I->comment("Domain:$ErrorDomain");
        $I->assertEquals($ErrorDomain, 'error');        
    }
          
    /**
     * @guy UkrainianTester\LocUaSteps
     */
    
    public function ValidationDomain6Fail(UkrainianTester\LocUaSteps $I)
    {
        InitTest::VerifyLogInOrLogOutPremmerceAdmin($I);
        $I->click(PremmerceMainPage::$CreateShopButtonTop);        
        $I->waitForElement(PremmerceCreateShopPage::$RegisterForm);
        $set="abcdefghijklmnopqrstuvwxyz1234567890";
            $size = strlen($set)-1; 
            $prefix = 'shop-ua-ua-';
            $mailsufix = '@gmail.com';
            $name = null;
            $max = 7;
                while($max--)
                $name.=$set[rand(0,$size)]; 
            $store1 = $prefix.'.'.'d'.$name;
            $mail1 = $prefix.$name.$mailsufix;
            echo "your store name: $store1 \nyoour mail: $mail1";
            $password='1111111';
            $user='Norman';
            $phone='4443434367';
            $city='Boston';
            $country='1';
            $category='2';
            $level='3';
            $agree='';
            $I->CreateShop($store1, $mail1, $password, $user, $phone, $city, null, null, $level, $agree);
            $I->wait('2');
        $ErrorDomain=$I->grabAttributeFrom(PremmerceCreateShopPage::$ErrorDomain, 'class');
        $I->comment("Domain:$ErrorDomain");
        $I->assertEquals($ErrorDomain, 'error');        
    }
    
    
    /**
     * @guy UkrainianTester\LocUaSteps
     */
    
    public function ValidationDomain7Fail(UkrainianTester\LocUaSteps $I)
    {
        InitTest::VerifyLogInOrLogOutPremmerceAdmin($I);
        $I->click(PremmerceMainPage::$CreateShopButtonTop);        
        $I->waitForElement(PremmerceCreateShopPage::$RegisterForm);
        $set="abcdefghijklmnopqrstuvwxyz1234567890";
            $size = strlen($set)-1; 
            $prefix = 'shop-ua-ua-';
            $mailsufix = '@gmail.com';
            $name = null;
            $max = 10;
                while($max--)
                $name.=$set[rand(0,$size)]; 
            $store1 = $prefix.'.'.'d'.$name;
            $mail1 = $prefix.$name.$mailsufix;
            echo "your store name: $store1 \nyoour mail: $mail1";
            $password='1111111';
            $user='Norman';
            $phone='4443434367';
            $city='Boston';
            $country='1';
            $category='2';
            $level='3';
            $agree='';
            $I->CreateShop($store1, $mail1, $password, $user, $phone, $city, null, null, $level, $agree);
            $I->wait('2');
        $ErrorDomain=$I->grabAttributeFrom(PremmerceCreateShopPage::$ErrorDomain, 'class');
        $I->comment("Domain:$ErrorDomain");
        $I->assertEquals($ErrorDomain, 'error');        
    }
    
    /**
     * @guy UkrainianTester\LocUaSteps
     */
    
    public function ValidationDomain8Fail(UkrainianTester\LocUaSteps $I)
    {
        InitTest::VerifyLogInOrLogOutPremmerceAdmin($I);
        $I->click(PremmerceMainPage::$CreateShopButtonTop);        
        $I->waitForElement(PremmerceCreateShopPage::$RegisterForm);
        $set="abcdefghijklmnopqrstuvwxyz1234567890";
            $size = strlen($set)-1; 
            $prefix = 'shop-ua-ua-';
            $mailsufix = '@gmail.com';
            $name = null;
            $max = 7;
                while($max--)
                $name.=$set[rand(0,$size)]; 
            $store1 = $prefix.' '.$name;
            $mail1 = $prefix.$name.$mailsufix;
            echo "your store name: $store1 \nyoour mail: $mail1";
            $password='1111111';
            $user='Norman';
            $phone='4443434367';
            $city='Boston';
            $country='1';
            $category='2';
            $level='3';
            $agree='';
            $I->CreateShop($store1, $mail1, $password, $user, $phone, $city, null, null, $level, $agree);
            $I->wait('2');
        $ErrorDomain=$I->grabAttributeFrom(PremmerceCreateShopPage::$ErrorDomain, 'class');
        $I->comment("Domain:$ErrorDomain");
        $I->assertEquals($ErrorDomain, 'error');        
    }
    
    /**
     * @guy UkrainianTester\LocUaSteps
     */
    
    public function ValidationEmail1Fail(UkrainianTester\LocUaSteps $I)
    {
        InitTest::VerifyLogInOrLogOutPremmerceAdmin($I);
        $I->click(PremmerceMainPage::$CreateShopButtonTop);        
        $I->waitForElement(PremmerceCreateShopPage::$RegisterForm);
        $set="abcdefghijklmnopqrstuvwxyz1234567890";
            $size = strlen($set)-1; 
            $prefix = 'shop-ua-ru-';
            $mailsufix = 'gmail.com';
            $name = null;
            $max = 7;
                while($max--)
                $name.=$set[rand(0,$size)]; 
            $store1 = $prefix.'-'.$name;
            $mail1 = $prefix.$name.$mailsufix;
            echo "your store name: $store1 \nyoour mail: $mail1";
            $password='1111111';
            $user='Norman';
            $phone='4443434367';
            $city='Boston';
            $country='2';
            $category='2';
            $level='3';
            $agree='';
            $I->CreateShop($store1, $mail1, $password, $user, $phone, $city, null, null, $level, $agree);
            $I->wait('2');
        $ErrorEmail=$I->grabAttributeFrom(PremmerceCreateShopPage::$ErrorEmail, 'class');
        $I->comment("Email:$ErrorEmail");
        $I->assertEquals($ErrorEmail, 'error');        
    }   
    
    /**
     * @guy UkrainianTester\LocUaSteps
     */
    
    public function ValidationEmail2Fail(UkrainianTester\LocUaSteps $I)
    {
        InitTest::VerifyLogInOrLogOutPremmerceAdmin($I);
        $I->click(PremmerceMainPage::$CreateShopButtonTop);        
        $I->waitForElement(PremmerceCreateShopPage::$RegisterForm);
        $set="abcdefghijklmnopqrstuvwxyz1234567890";
            $size = strlen($set)-1; 
            $prefix = 'shop-ua-ua-';
            $mailsufix = '@gmail.c';
            $name = null;
            $max = 7;
                while($max--)
                $name.=$set[rand(0,$size)]; 
            $store1 = $prefix.$name;
            $mail1 = $prefix.$name.$mailsufix;
            echo "your store name: $store1 \nyoour mail: $mail1";
            $password='1111111';
            $user='Norman';
            $phone='4443434367';
            $city='Boston';
            $country='1';
            $category='2';
            $level='3';
            $agree='';
            $I->CreateShop($store1, $mail1, $password, $user, $phone, $city, null, null, $level, $agree);
            $I->wait('2');
        $ErrorEmail=$I->grabAttributeFrom(PremmerceCreateShopPage::$ErrorEmail, 'class');
        $I->comment("Email:$ErrorEmail");
        $I->assertEquals($ErrorEmail, 'error');        
    }   
    
    /**
     * @guy UkrainianTester\LocUaSteps
     */
    
    public function ValidationEmail3Fail(UkrainianTester\LocUaSteps $I)
    {
        InitTest::VerifyLogInOrLogOutPremmerceAdmin($I);
        $I->click(PremmerceMainPage::$CreateShopButtonTop);        
        $I->waitForElement(PremmerceCreateShopPage::$RegisterForm);
        $set="abcdefghijklmnopqrstuvwxyz1234567890";
            $size = strlen($set)-1; 
            $prefix = 'shop-ua-ua-';
            $mailsufix = '@g_d.com';
            $name = null;
            $max = 7;
                while($max--)
                $name.=$set[rand(0,$size)]; 
            $store1 = $prefix.$name;
            $mail1 = $prefix.$name.$mailsufix;
            echo "your store name: $store1 \nyoour mail: $mail1";
            $password='1111111';
            $user='Norman';
            $phone='4443434367';
            $city='Boston';
            $country='1';
            $category='2';
            $level='3';
            $agree='';
            $I->CreateShop($store1, $mail1, $password, $user, $phone, $city, null, null, $level, $agree);
            $I->wait('2');
        $ErrorEmail=$I->grabAttributeFrom(PremmerceCreateShopPage::$ErrorEmail, 'class');
        $I->comment("Email:$ErrorEmail");
        $I->assertEquals($ErrorEmail, 'error');        
    }   
    
    
     /**
     * @guy UkrainianTester\LocUaSteps
     */
    
    public function ValidationEmail4Fail(UkrainianTester\LocUaSteps $I)
    {
        InitTest::VerifyLogInOrLogOutPremmerceAdmin($I);
        $I->click(PremmerceMainPage::$CreateShopButtonTop);        
        $I->waitForElement(PremmerceCreateShopPage::$RegisterForm);
        $set="abcdefghijklmnopqrstuvwxyz1234567890";
            $size = strlen($set)-1; 
            $prefix = 'shop-ua-ua-';
            $mailsufix = '@g_d.com';
            $name = null;
            $max = 7;
                while($max--)
                $name.=$set[rand(0,$size)]; 
            $store1 = $prefix.$name;
            $mail1 = $prefix.$name.$mailsufix;
            echo "your store name: $store1 \nyoour mail: $mail1";
            $password='1111111';
            $user='Norman';
            $phone='4443434367';
            $city='Boston';
            $country='1';
            $category='2';
            $level='3';
            $agree='';
            $I->CreateShop($store1, $mail1, $password, $user, $phone, $city, null, null, $level, $agree);
            $I->wait('2');
        $ErrorEmail=$I->grabAttributeFrom(PremmerceCreateShopPage::$ErrorEmail, 'class');
        $I->comment("Email:$ErrorEmail");
        $I->assertEquals($ErrorEmail, 'error');        
    }   
    
    
     /**
     * @guy UkrainianTester\LocUaSteps
     */
    
    public function ValidationEmail5Fail(UkrainianTester\LocUaSteps $I)
    {
        InitTest::VerifyLogInOrLogOutPremmerceAdmin($I);
        $I->click(PremmerceMainPage::$CreateShopButtonTop);        
        $I->waitForElement(PremmerceCreateShopPage::$RegisterForm);
        $set="abcdefghijklmnopqrstuvwxyz1234567890";
            $size = strlen($set)-1; 
            $prefix = 'shop-ua-ua-';
            $mailsufix = '@gmail.com';
            $name = null;
            $max = 7;
                while($max--)
                $name.=$set[rand(0,$size)]; 
            $store1 = $prefix.$name;
            $mail1 = '.'.$prefix.$name.$mailsufix;
            echo "your store name: $store1 \nyoour mail: $mail1";
            $password='1111111';
            $user='Norman';
            $phone='4443434367';
            $city='Boston';
            $country='1';
            $category='2';
            $level='3';
            $agree='';
            $I->CreateShop($store1, $mail1, $password, $user, $phone, $city, null, null, $level, $agree);
            $I->wait('2');
        $ErrorEmail=$I->grabAttributeFrom(PremmerceCreateShopPage::$ErrorEmail, 'class');
        $I->comment("Email:$ErrorEmail");
        $I->assertEquals($ErrorEmail, 'error');        
    }   
    
    
     /**
     * @guy UkrainianTester\LocUaSteps
     */
    
    public function ValidationEmail6Fail(UkrainianTester\LocUaSteps $I)
    {
        InitTest::VerifyLogInOrLogOutPremmerceAdmin($I);
        $I->click(PremmerceMainPage::$CreateShopButtonTop);        
        $I->waitForElement(PremmerceCreateShopPage::$RegisterForm);
        $set="abcdefghijklmnopqrstuvwxyz1234567890";
            $size = strlen($set)-1; 
            $prefix = 'shop-ua-ua-';
            $mailsufix = '@gmail.com';
            $name = null;
            $max = 7;
                while($max--)
                $name.=$set[rand(0,$size)]; 
            $store1 = $prefix.$name;
            $mail1 = '_'.$prefix.$name.'_'.$mailsufix;
            echo "your store name: $store1 \nyoour mail: $mail1";
            $password='1111111';
            $user='Norman';
            $phone='4443434367';
            $city='Boston';
            $country='1';
            $category='2';
            $level='3';
            $agree='';
            $I->CreateShop($store1, $mail1, $password, $user, $phone, $city, null, null, $level, $agree);
            $I->wait('2');
        $ErrorEmail=$I->grabAttributeFrom(PremmerceCreateShopPage::$ErrorEmail, 'class');
        $I->comment("Email:$ErrorEmail");
        $I->assertEquals($ErrorEmail, 'error');        
    }   
    
    /**
     * @guy UkrainianTester\LocUaSteps
     */
    
    public function ValidationEmail7Fail(UkrainianTester\LocUaSteps $I)
    {
        InitTest::VerifyLogInOrLogOutPremmerceAdmin($I);
        $I->click(PremmerceMainPage::$CreateShopButtonTop);        
        $I->waitForElement(PremmerceCreateShopPage::$RegisterForm);
        $set="abcdefghijklmnopqrstuvwxyz1234567890";
            $size = strlen($set)-1; 
            $prefix = 'shop-ua-ua-';
            $mailsufix = '@gmail.com';
            $name = null;
            $max = 7;
                while($max--)
                $name.=$set[rand(0,$size)]; 
            $store1 = $prefix.$name;
            $mail1 = $prefix.'_'.$name.'@'.$mailsufix;
            echo "your store name: $store1 \nyoour mail: $mail1";
            $password='1111111';
            $user='Norman';
            $phone='4443434367';
            $city='Boston';
            $country='1';
            $category='2';
            $level='3';
            $agree='';
            $I->CreateShop($store1, $mail1, $password, $user, $phone, $city, null, null, $level, $agree);
            $I->wait('2');
        $ErrorEmail=$I->grabAttributeFrom(PremmerceCreateShopPage::$ErrorEmail, 'class');
        $I->comment("Email:$ErrorEmail");
        $I->assertEquals($ErrorEmail, 'error');        
    }   
    
     /**
     * @guy UkrainianTester\LocUaSteps
     */
    
    public function ValidationEmail8Fail(UkrainianTester\LocUaSteps $I)
    {
        InitTest::VerifyLogInOrLogOutPremmerceAdmin($I);
        $I->click(PremmerceMainPage::$CreateShopButtonTop);        
        $I->waitForElement(PremmerceCreateShopPage::$RegisterForm);
        $set="abcdefghijklmnopqrstuvwxyz1234567890";
            $size = strlen($set)-1; 
            $prefix = 'shop-ua-by-';
            $mailsufix = '@gmail.com';
            $name = null;
            $max = 7;
                while($max--)
                $name.=$set[rand(0,$size)]; 
            $store1 = $prefix.$name;
            $mail1 = $prefix.'@'.$name.$mailsufix;
            echo "your store name: $store1 \nyoour mail: $mail1";
            $password='1111111';
            $user='Norman';
            $phone='4443434367';
            $city='Boston';
            $country='3';
            $category='2';
            $level='3';
            $agree='';
            $I->CreateShop($store1, $mail1, $password, $user, $phone, $city, null, null, $level, $agree);
            $I->wait('2');
        $ErrorEmail=$I->grabAttributeFrom(PremmerceCreateShopPage::$ErrorEmail, 'class');
        $I->comment("Email:$ErrorEmail");
        $I->assertEquals($ErrorEmail, 'error');        
    } 
    
    
    /**
     * @guy UkrainianTester\LocUaSteps
     */
    
    public function ValidationEmail9Fail(UkrainianTester\LocUaSteps $I)
    {
        InitTest::VerifyLogInOrLogOutPremmerceAdmin($I);
        $I->click(PremmerceMainPage::$CreateShopButtonTop);        
        $I->waitForElement(PremmerceCreateShopPage::$RegisterForm);
        $set="abcdefghijklmnopqrstuvwxyz1234567890";
            $size = strlen($set)-1; 
            $prefix = 'shop-ua-ru-';
            $mailsufix = '@gmail.com';
            $name = null;
            $max = 7;
                while($max--)
                $name.=$set[rand(0,$size)]; 
            $store1 = $prefix.$name;
            $mail1 = $prefix.'_-'.$name.'@@%$^&$#'.$mailsufix;
            echo "your store name: $store1 \nyoour mail: $mail1";
            $password='1111111';
            $user='Norman';
            $phone='4443434367';
            $city='Boston';
            $country='2';
            $category='2';
            $level='3';
            $agree='';
            $I->CreateShop($store1, $mail1, $password, $user, $phone, $city, null, null, $level, $agree);
            $I->wait('2');
        $ErrorEmail=$I->grabAttributeFrom(PremmerceCreateShopPage::$ErrorEmail, 'class');
        $I->comment("Email:$ErrorEmail");
        $I->assertEquals($ErrorEmail, 'error');        
    } 
    
    /**
     * @guy UkrainianTester\LocUaSteps
     */
    
    public function ValidationEmail10Fail(UkrainianTester\LocUaSteps $I)
    {
        InitTest::VerifyLogInOrLogOutPremmerceAdmin($I);
        $I->click(PremmerceMainPage::$CreateShopButtonTop);        
        $I->waitForElement(PremmerceCreateShopPage::$RegisterForm);
        $set="abcdefghijklmnopqrstuvwxyz1234567890";
            $size = strlen($set)-1; 
            $prefix = 'shop-ua-ua-';
            $mailsufix = '@gmail.com';
            $name = null;
            $max = 7;
                while($max--)
                $name.=$set[rand(0,$size)]; 
            $store1 = $prefix.$name;
            $mail1 = $prefix.'_-'.$name.'@@%$^&$#'.$mailsufix.'.';
            echo "your store name: $store1 \nyoour mail: $mail1";
            $password='1111111';
            $user='Norman';
            $phone='4443434367';
            $city='Boston';
            $country='1';
            $category='2';
            $level='3';
            $agree='';
            $I->CreateShop($store1, $mail1, $password, $user, $phone, $city, null, null, $level, $agree);
            $I->wait('2');
        $ErrorEmail=$I->grabAttributeFrom(PremmerceCreateShopPage::$ErrorEmail, 'class');
        $I->comment("Email:$ErrorEmail");
        $I->assertEquals($ErrorEmail, 'error');        
    } 
    
    /**
     * @guy UkrainianTester\LocUaSteps
     */
    
    public function ValidationEmail11Passed(UkrainianTester\LocUaSteps $I)
    {
        InitTest::VerifyLogInOrLogOutPremmerceAdmin($I);
        $I->click(PremmerceMainPage::$CreateShopButtonTop);        
        $I->waitForElement(PremmerceCreateShopPage::$RegisterForm);
        $set="abcdefghijklmnopqrstuvwxyz1234567890";
            $size = strlen($set)-1; 
            $prefix = 'shop-ua-ua-';
            $mailsufix = '@gmail.com';
            $name = null;
            $max = 7;
                while($max--)
                $name.=$set[rand(0,$size)]; 
            $store1 = $prefix.$name;
            $mail1 = $prefix.'x._12-'.$name.'.rs'.$mailsufix;
            echo "your store name: $store1 \nyoour mail: $mail1";
            $password='1111111';
            $user='Norman';
            $phone='4443434367';
            $city='Boston';
            $country='1';
            $category='2';
            $level='3';
            $agree='';
            $I->CreateShop($store1, $mail1, $password, $user, $phone, $city, null, null, $level, $agree);                    
        $I->waitForElementVisible(PremmerceCreateShopPage::$CreateLoadingForm);
        $I->wait('10');
        $I->waitForElement(PremmerceCabinetPage::$SiteLink, '60');
        $I->seeCurrentUrlEquals('/saas/profile');
    } 
    
    /**
     * @guy UkrainianTester\LocUaSteps
     */
    
    public function ValidationEmail12Passed(UkrainianTester\LocUaSteps $I)
    {
        InitTest::VerifyLogInOrLogOutPremmerceAdmin($I);
        $I->click(PremmerceMainPage::$CreateShopButtonTop);        
        $I->waitForElement(PremmerceCreateShopPage::$RegisterForm);
        $set="abcdefghijklmnopqrstuvwxyz1234567890";
            $size = strlen($set)-1; 
            $prefix = 'shopuaua';
            $mailsufix = '@gmail.com';
            $name = null;
            $max = 7;
                while($max--)
                $name.=$set[rand(0,$size)]; 
            $store1 = $prefix.$name;
            $mail1 = $prefix.$name.$mailsufix;
            echo "your store name: $store1 \nyoour mail: $mail1";
            $password='1111111';
            $user='Norman';
            $phone='4443434367';
            $city='Boston';
            $country='3';
            $category='2';
            $level='3';
            $agree='';
            $I->CreateShop($store1, $mail1, $password, $user, $phone, $city, null, null, $level, $agree);            
        $I->waitForElementVisible(PremmerceCreateShopPage::$CreateLoadingForm);
        $I->wait('10');
        $I->waitForElement(PremmerceCabinetPage::$SiteLink, '60');
        $I->seeCurrentUrlEquals('/saas/profile');       
    } 
    
    /**
     * @guy UkrainianTester\LocUaSteps
     */
    
    public function CreateShopUkrCountry(UkrainianTester\LocUaSteps $I)
    {
        InitTest::VerifyLogInOrLogOutPremmerceAdmin($I);
        $I->fillField(PremmerceMainPage::$CreateShopField, 's');
        $I->seeElement(PremmerceMainPage::$DomainEnd);
        $I->see(".premme.com", PremmerceMainPage::$DomainEnd);
        $I->wait('2');
        $I->click(PremmerceMainPage::$CreateShopButtonCentre);     
        $I->wait('2');
        $I->waitForElement(PremmerceCreateShopPage::$RegisterForm);       
        $I->seeInField(PremmerceCreateShopPage::$ShopNameField, 's');
        $I->fillField(PremmerceCreateShopPage::$EmailField, 'ss');
        $I->fillField(PremmerceCreateShopPage::$PasswordField, 'sssss');
        $I->fillField(PremmerceCreateShopPage::$UserNameField, 'S');
        $I->fillField(PremmerceCreateShopPage::$PhoneNumberField, 'eee');
        $I->fillField(PremmerceCreateShopPage::$CityField, 'Lv');                
        $I->click(PremmerceCreateShopPage::$CategorySelectMenu);
        $I->click('//*[@id="cusel-scroll-id2"]/span[2]');
        $I->click(PremmerceCreateShopPage::$LevelOfUseSelectMenu);
        $I->click('//*[@id="cusel-scroll-id3"]/span[2]');
        $I->click(PremmerceCreateShopPage::$AgreeCheckbox);        
        $I->click(PremmerceCreateShopPage::$CreateShopNowRegisterFormButton);    
        $ErrorDomain=$I->grabAttributeFrom(PremmerceCreateShopPage::$ErrorDomain, 'class');
        $I->comment("Domain:$ErrorDomain");
        $I->assertEquals($ErrorDomain, 'error');
        $ErrorEmail=$I->grabAttributeFrom(PremmerceCreateShopPage::$ErrorEmail, 'class');
        $I->comment("Email:$ErrorEmail");
        $I->assertEquals($ErrorEmail, 'error');
        $ErrorPassword=$I->grabAttributeFrom(PremmerceCreateShopPage::$ErrorPassword, 'class');
        $I->comment("Password:$ErrorPassword");
        $I->assertEquals($ErrorPassword, 'error');
        $ErrorUserName=$I->grabAttributeFrom(PremmerceCreateShopPage::$ErrorUserName, 'class');
        $I->comment("UserName:$ErrorUserName");
        $I->assertEquals($ErrorUserName, "error");
        $ErrorPhone=$I->grabAttributeFrom(PremmerceCreateShopPage::$ErrorPhoneNumber, 'class');
        $I->comment($ErrorPhone);
        $I->assertEquals($ErrorPhone, 'error');       
        $ErrorCity=$I->grabAttributeFrom(PremmerceCreateShopPage::$ErrorCity, 'class');
        $I->comment("City:$ErrorCity");
        $I->assertEquals($ErrorCity, 'error');
            $set="abcdefghijklmnopqrstuvwxyz1234567890";
            $size = strlen($set)-1; 
            $prefix = 'shop-ua-ua-';
            $mailsufix = '@gmail.com';
            $name = null;
            $max = 7;
                while($max--)
                $name.=$set[rand(0,$size)]; 
            $this->store = $prefix.$name;
            $this->mail = $prefix.$name.$mailsufix;
            echo "your store name: $this->store \nyoour mail: $this->mail";
            $password='ssssss';
            $user='Віталій';
            $phone='123445';
            $city='Херсон';           
        $I->CreateShop($this->store, $this->mail, $password, $user, $phone, $city);
        $I->wait('5');
        $I->waitForElementVisible(PremmerceCreateShopPage::$CreateLoadingForm);
        $I->wait('10');
        $I->waitForElement(PremmerceCabinetPage::$SiteLink, '60');
        $I->seeCurrentUrlEquals('/saas/profile');
        $PageLocale=$I->grabAttributeFrom('/html/body/div[1]/div/div[1]/nav/ul/li[1]/a', 'href');
        $I->comment("Page: $PageLocale");
        $I->assertEquals($PageLocale, 'http://imagego.com.ua/saas/profile');
        $domain='.premme.com';
        $shopDom=$this->store.$domain;
        $I->see($shopDom, PremmerceCabinetPage::$SiteLink);
        $I->see($shopDom.'/admin', PremmerceCabinetPage::$AdminLink);
        $I->wait('3');
        $I->click(PremmerceCabinetPage::$SiteLink);
        $I->executeInSelenium(function (\Webdriver $webdriver) {
            $handles=$webdriver->getWindowHandles();
            $last_window = end($handles);
            $webdriver->switchTo()->window($last_window);
        });
        $I->wait('6');
        $I->waitForElement(".//*[@id='inputString']");
        $I->seeInTitle('ImageCMS DemoShop');
        $I->amOnPage('/saas/profile');
        $I->wait(5);
        $I->click(PremmerceCabinetPage::$AdminLink);
        $I->executeInSelenium(function (\Webdriver $webdriver) {
            $handles=$webdriver->getWindowHandles();
            $last_window = end($handles);
            $webdriver->switchTo()->window($last_window);
        });
        $I->waitForElement('[id="topPanelNotifications"]');
        $I->seeElement('[class="btn_header btn-personal-area"]');
        $I->click('[class="btn_header btn-personal-area"]');
        $I->wait('1');
        $I->see($user, ".head");
        $I->amOnPage('/saas/profile');
        $I->click(PremmerceCabinetPage::$ProfileButton);
        $I->click(PremmerceCabinetPage::$ExitButton);
        $I->wait(2);       
    }
    
    /**
     * @guy UkrainianTester\LocUaSteps
     */
    
    public function CreateShopRusCountry(UkrainianTester\LocUaSteps $I)
    {
        InitTest::VerifyLogInOrLogOutPremmerceAdmin($I);
        $I->click(PremmerceMainPage::$CreateShopButtonTop);        
        $I->waitForElement(PremmerceCreateShopPage::$RegisterForm);
            $set="abcdefghijklmnopqrstuvwxyz1234567890";
            $size = strlen($set)-1; 
            $prefix = 'shop-ua-ru-';
            $mailsufix = '@gmail.com';
            $name = null;
            $max = 7;
                while($max--)
                $name.=$set[rand(0,$size)]; 
            $store1 = $prefix.$name;
            $mail1 = $prefix.$name.$mailsufix;
            echo "your store name: $store1 \nyoour mail: $mail1";
            $password='рррррр';
            $user='Вова';
            $phone='77777887';
            $city='Магадан';
            $country='2';
            $category='3';
            $level='3';
            $agree='';
        $I->CreateShop($store1, $mail1, $password, $user, $phone, $city, $country, $category, $level,$agree);        
        $I->waitForElementVisible(PremmerceCreateShopPage::$CreateLoadingForm);
        $I->wait('10');
        $I->waitForElement(PremmerceCabinetPage::$SiteLink, '60');
        $I->seeCurrentUrlEquals('/saas/profile');
        $PageLocale=$I->grabAttributeFrom('/html/body/div[1]/div/div[1]/nav/ul/li[1]/a', 'href');
        $I->comment("Page: $PageLocale");
        $I->assertEquals($PageLocale, 'http://imagego.ru/saas/profile');
        $I->seeCurrentUrlEquals('/saas/profile');
        $domain='.premme.com';
        $shopDom=$store1.$domain;
        $I->see($shopDom, PremmerceCabinetPage::$SiteLink);
        $I->see($shopDom.'/admin', PremmerceCabinetPage::$AdminLink);
        $I->click(PremmerceCabinetPage::$StoreButton);
        $I->executeInSelenium(function (\Webdriver $webdriver) {
            $handles=$webdriver->getWindowHandles();
            $last_window = end($handles);
            $webdriver->switchTo()->window($last_window);
        });
        $I->wait('6');
        $I->waitForElement(".//*[@id='inputString']");
        $I->seeInTitle('ImageCMS DemoShop');
        $I->amOnPage('/saas/profile');
        $I->wait(5);
        $I->click(PremmerceCabinetPage::$AdminButton);
        $I->executeInSelenium(function (\Webdriver $webdriver) {
            $handles=$webdriver->getWindowHandles();
            $last_window = end($handles);
            $webdriver->switchTo()->window($last_window);
        });
        $I->waitForElement('[id="topPanelNotifications"]');
        $I->seeElement('[class="btn_header btn-personal-area"]');
        $I->click('[class="btn_header btn-personal-area"]');
        $I->wait('1');
        $I->see($user, ".head");
        $I->amOnPage('/saas/profile');
        $I->click(PremmerceCabinetPage::$ProfileButton);
        $I->click(PremmerceCabinetPage::$ExitButton);
        $I->wait(2);        
    }
    
    /**
     * @guy UkrainianTester\LocUaSteps
     */
    
//    public function CreateShopUsaCountry(UkrainianTester\LocUaSteps $I)
//    {
//        InitTest::VerifyLogInOrLogOutUkr($I);       
//        $I->click(LocUaPage::$CreateShopButtonTop);        
//        $I->waitForElement(LocUaPage::$RegisterForm);               
//            $set="abcdefghijklmnopqrstuvwxyz";
//            $size = strlen($set)-1; 
//            $prefix = 'shop-ua-eng-';
//            $mailsufix = '@gmail.com';
//            $name = null;
//            $max = 7;
//                while($max--)
//                $name.=$set[rand(0,$size)]; 
//            $store1 = $prefix.$name;
//            $mail1 = $prefix.$name.$mailsufix;
//            echo "your store name: $store1 \nyoour mail: $mail1";
//            $password='fffffffff';
//            $user='Maria';
//            $phone='0303030498';
//            $city='Boston';
//            $country='3';
//            $category='2';
//            $level='3';
//            $agree='';
//        $I->CreateShop($store1, $mail1, $password, $user, $phone, $city, $country, $category, $level,$agree);
//        $I->waitForElement('/html/body/div[1]/div/div[1]/nav/ul/li[1]/a/span[2]','20');
//        $I->seeCurrentUrlEquals('/saas/profile/index');
//        $PageLocale=$I->grabAttributeFrom('/html/body/div[1]/div/div[1]/nav/ul/li[1]/a', 'href');
//        $I->comment("Page: $PageLocale");
//        $I->assertEquals($PageLocale, 'http://premmerce.com/saas/profile');
//        $I->seeCurrentUrlEquals('/saas/profile/index');        
//        $domain='.premmerce.com';
//        $shopDom=$store1.$domain;
//        $I->see($shopDom, LocUaPage::$SiteLink);
//        $I->see($shopDom.'/admin', LocUaPage::$AdminLink);
//        $I->click(LocUaPage::$StoreButton);
//        $I->waitForElement('/html/body/div[1]/div[1]/header/div[2]/div/span');
//        $I->seeInTitle('ImageCMS DemoShop');
//        $I->moveBack();
//        $I->wait(5);
//        $I->click(LocUaPage::$AdminLink);
//        $I->waitForElement('/html/body/div[1]/div[3]/div/nav/ul/li[1]/a/span');
//        $I->see('Maria', ".//*[@id='user_name']");
//        $I->moveBack();
//        $I->click(LocUaPage::$ProfileButton);
//        $I->click(LocUaPage::$ExitButton);
//        $I->wait(2);
        
//    }
    
    /**
     * @guy UkrainianTester\LocUaSteps
     */
        
    public function CreateShopWithEmailAlreadyRegistered(UkrainianTester\LocUaSteps $I)
    {
        InitTest::VerifyLogInOrLogOutPremmerceAdmin($I);
        $I->click(PremmerceMainPage::$CreateShopButtonTop);        
        $I->waitForElement(PremmerceCreateShopPage::$RegisterForm);               
            $set="abcdefghijklmnopqrstuvwxyz1234567890";
            $size = strlen($set)-1; 
            $prefix = 'shop-ua-eng-';
            $mailsufix = '@gmail.com';
            $name = null;
            $max = 7;
                while($max--)
                $name.=$set[rand(0,$size)]; 
            $store1 = $prefix.$name;
            $mail1 = $prefix.$name.$mailsufix;
            echo "your store name: $store1 \nyoour mail: $mail1";
            $password='gggggg';
            $user='David Cooper';
            $phone='4545009555';
            $city='Washington';            
            $category='2';
            $level='3';
            $agree='';
        $I->CreateShop($store1, $this->mail, $password, $user, $phone, $city, null, $category, $level, $agree); 
        $ErrorEmail=$I->grabAttributeFrom(PremmerceCreateShopPage::$ErrorEmail, 'class');
        $I->comment("Email:$ErrorEmail");
        $I->assertEquals($ErrorEmail, 'error');           
        $I->fillField(PremmerceCreateShopPage::$EmailField, $mail1);       
        $I->wait(5);
        $I->click(PremmerceCreateShopPage::$CreateShopNowRegisterFormButton);
        $I->waitForElementVisible(PremmerceCreateShopPage::$CreateLoadingForm);
        $I->wait('10');
        $I->waitForElement(PremmerceCabinetPage::$SiteLink, '30');
        $I->seeCurrentUrlEquals('/saas/profile');
        $PageLocale=$I->grabAttributeFrom('/html/body/div[1]/div/div[1]/nav/ul/li[1]/a', 'href');
        $I->comment("Page: $PageLocale");
        $I->assertEquals($PageLocale, 'http://imagego.com.ua/saas/profile');
        $domain='.premme.com';
        $shopDom=$store1.$domain;
        $I->see($shopDom, PremmerceCabinetPage::$SiteLink);
        $I->see($shopDom.'/admin', PremmerceCabinetPage::$AdminLink);
        $I->click(PremmerceCabinetPage::$StoreButton);
        $I->executeInSelenium(function (\Webdriver $webdriver) {
            $handles=$webdriver->getWindowHandles();
            $last_window = end($handles);
            $webdriver->switchTo()->window($last_window);
        });
        $I->wait('6');
        $I->waitForElement(".//*[@id='inputString']");
        $I->seeInTitle('ImageCMS DemoShop');
        $I->amOnPage('/saas/profile');
        $I->wait(5);
        $I->click(PremmerceCabinetPage::$AdminLink);
        $I->executeInSelenium(function (\Webdriver $webdriver) {
            $handles=$webdriver->getWindowHandles();
            $last_window = end($handles);
            $webdriver->switchTo()->window($last_window);
        });
        $I->waitForElement('[id="topPanelNotifications"]');
        $I->seeElement('[class="btn_header btn-personal-area"]');
        $I->click('[class="btn_header btn-personal-area"]');
        $I->wait('1');
        $I->see($user, ".head");
        $I->amOnPage('/saas/profile');
        $I->click(PremmerceCabinetPage::$ProfileButton);
        $I->click(PremmerceCabinetPage::$ExitButton);
        $I->wait(2);                 
        
    }
    
    /**
     * @guy UkrainianTester\LocUaSteps
     */
    
    public function CreateShopWithNameDomainAlreadyRegistered(UkrainianTester\LocUaSteps $I)
    {
        InitTest::VerifyLogInOrLogOutPremmerceAdmin($I);
        $I->click(PremmerceMainPage::$CreateShopButtonTop);        
        $I->waitForElement(PremmerceCreateShopPage::$RegisterForm);
            $set="abcdefghijklmnopqrstuvwxyz1234567890";
            $size = strlen($set)-1; 
            $prefix = 'shop-ua-ru-';
            $mailsufix = '@gmail.com';
            $name = null;
            $max = 7;
                while($max--)
                $name.=$set[rand(0,$size)]; 
            $store1 = $prefix.$name;
            $mail1 = $prefix.$name.$mailsufix;
            echo "your store name: $store1 \nyoour mail: $mail1";
            $password='kkkkkk';
            $user='Victoria';
            $phone='777777';
            $city='St.Peterburg';
            $country='2';
            $category='3';
            $level='3';
            $agree='';
        $I->CreateShop($this->store, $mail1, $password, $user, $phone, $city, $country, $category, $level, $agree);
        $I->wait(5);
        $I->wait(5);
//        $I->dontSeeElement(PremmerceCreateShopPage::$CreateLoadingForm);
        $ErrorDomain=$I->grabAttributeFrom(PremmerceCreateShopPage::$ErrorDomain, 'class');
        $I->comment("Domain:$ErrorDomain");
        $I->assertEquals($ErrorDomain, 'error');           
        $I->fillField(PremmerceCreateShopPage::$ShopNameField, $store1);        
        $I->wait(5);
        $I->click(PremmerceCreateShopPage::$CreateShopNowRegisterFormButton);
        $I->waitForElementVisible(PremmerceCreateShopPage::$CreateLoadingForm);
        $I->wait('10');
        $I->waitForElement(PremmerceCabinetPage::$SiteLink, '60');
        $I->seeCurrentUrlEquals('/saas/profile');
        $PageLocale=$I->grabAttributeFrom('/html/body/div[1]/div/div[1]/nav/ul/li[1]/a', 'href');
        $I->comment("Page: $PageLocale");
        $I->assertEquals($PageLocale, 'http://imagego.ru/saas/profile');
        $I->seeCurrentUrlEquals('/saas/profile');
        $domain='.premme.com';
        $shopDom=$store1.$domain;
        $I->see($shopDom, PremmerceCabinetPage::$SiteLink);
        $I->see($shopDom.'/admin', PremmerceCabinetPage::$AdminLink);
        $I->click(PremmerceCabinetPage::$StoreButton);
        $I->executeInSelenium(function (\Webdriver $webdriver) {
            $handles=$webdriver->getWindowHandles();
            $last_window = end($handles);
            $webdriver->switchTo()->window($last_window);
        });
        $I->wait('6');
        $I->waitForElement(".//*[@id='inputString']");
        $I->seeInTitle('ImageCMS DemoShop');
        $I->amOnPage('/saas/profile');
        $I->wait(5);
        $I->click(PremmerceCabinetPage::$AdminButton);
        $I->executeInSelenium(function (\Webdriver $webdriver) {
            $handles=$webdriver->getWindowHandles();
            $last_window = end($handles);
            $webdriver->switchTo()->window($last_window);
        });
        $I->waitForElement('[id="topPanelNotifications"]');
        $I->seeElement('[class="btn_header btn-personal-area"]');
        $I->click('[class="btn_header btn-personal-area"]');
        $I->wait('1');
        $I->see($user, ".head");
        $I->amOnPage('/saas/profile');
        $I->click(PremmerceCabinetPage::$ProfileButton);
        $I->click(PremmerceCabinetPage::$ExitButton);
        $I->wait(2);
    }
//    
//    
//    public function CheckPresentTextInFieldAfterChangeLanguage(UkrainianTester $I)
//    {
//        InitTest::VerifyLogInOrLogOutUkr($I);         
//        $I->click(LocUaPage::$CreateShopButtonTop);        
//        $I->waitForElement(LocUaPage::$RegisterForm);
//        $I->seeCurrentUrlEquals('/saas/create_store');        
//        $I->fillField(LocUaPage::$ShopNameField, 's');
//        $I->fillField(LocUaPage::$EmailField, 'ss');
//        $I->fillField(LocUaPage::$PasswordField, 'sssss');
//        $I->fillField(LocUaPage::$UserNameField, 'S');
//        $I->fillField(LocUaPage::$PhoneNumberField, 'eee');
//        $I->fillField(LocUaPage::$CityField, 'Lv');        
//        $I->click(LocUaPage::$CategorySelectMenu);
//        $I->click('//*[@id="cusel-scroll-id2"]/span[2]');
//        $cat=$I->grabTextFrom('//*[@id="cuselFrame-id2"]/div[2]');
//        $I->comment($cat);
//        $I->click(LocUaPage::$LevelOfUseSelectMenu);
//        $I->click('//*[@id="cusel-scroll-id3"]/span[2]');
//        $level=$I->grabTextFrom('//*[@id="cuselFrame-id3"]/div[2]');
//        $I->comment($level);
//        $I->click(LocUaPage::$AgreeCheckbox);
//        $I->click(LocUaPage::$RusLangRegisterFormLink);
//        $I->seeCurrentUrlEquals('/ru/saas/create_store');
//        $I->seeInField(LocUaPage::$ShopNameField, 's');
//        $I->seeInField(LocUaPage::$EmailField, 'ss');
//        $I->seeInField(LocUaPage::$PasswordField, 'sssss');
//        $I->seeInField(LocUaPage::$UserNameField, 'S');
//        $I->seeInField(LocUaPage::$PhoneNumberField, 'eee');
//        $I->seeInField(LocUaPage::$CityField, 'Lv');
//        $cat1=$I->grabTextFrom('//*[@id="cuselFrame-id2"]/div[2]');
//        $level1=$I->grabTextFrom('//*[@id="cuselFrame-id3"]/div[2]');
////        $I->assertEquals($cat1, $cat);
////        $I->assertEquals($level1, $level);
//        $I->seeCheckboxIsChecked(LocUaPage::$AgreeCheckbox);        
//    }
    
    /**
     * @guy UkrainianTester\LocUaSteps
     */
    
//    public function CheckChangeLanguage(UkrainianTester\LocUaSteps $I)
//    {
//        InitTest::VerifyLogInOrLogOutUkr($I);
//        $I->click(LocUaPage::$RusLangRegisterFormLink);
//        $I->seeCurrentUrlEquals('/ru');
//        $I->click(LocUaPage::$CreateShopButtonTop);        
//        $I->waitForElement(LocUaPage::$RegisterForm);
//        $I->seeCurrentUrlEquals('/ru/saas/create_store');
//        $I->click(LocUaPage::$UkrLangRegisterFormLink);
//        $I->seeCurrentUrlEquals('/saas/create_store');
//        $set="abcdefghijklmnopqrstuvwxyz";
//            $size = strlen($set)-1; 
//            $prefix = 'shop-ua-ua-';
//            $mailsufix = '@gmail.com';
//            $name = null;
//            $max = 7;
//                while($max--)
//                $name.=$set[rand(0,$size)]; 
//            $store1 = $prefix.$name;
//            $mail1 = $prefix.$name.$mailsufix;
//            echo "your store name: $this->store \nyoour mail: $this->mail";
//            $password='ssssss';
//            $user='Віталій';
//            $phone='123445';
//            $city='Київ';
//            $category='2';
//            $level='2';
//            $agree='';
//        $I->CreateShop($store1, $mail1, $password, $user, $phone, $city, $country=null, $category, $level, $agree);
//        $I->waitForElement('/html/body/div[1]/div/div[1]/nav/ul/li[1]/a/span[2]','20');
//        $I->seeCurrentUrlEquals('/saas/profile/index');
//        $PageLocale=$I->grabAttributeFrom('/html/body/div[1]/div/div[1]/nav/ul/li[1]/a', 'href');
//        $I->comment("Page: $PageLocale");
//        $I->assertEquals($PageLocale, 'http://premmerce.com/saas/profile');
//        $I->seeCurrentUrlEquals('/saas/profile/index');        
//        $domain='.premmerce.com';
//        $shopDom=$store1.$domain;
//        $I->see($shopDom, LocUaPage::$SiteLink);
//        $I->see($shopDom.'/admin', LocUaPage::$AdminLink);
//        $I->click(LocUaPage::$StoreButton);
//        $I->waitForElement('/html/body/div[1]/div[1]/header/div[2]/div/span');
//        $I->seeInTitle('ImageCMS DemoShop');
//        $I->moveBack();
//        $I->wait(5);
//        $I->click(LocUaPage::$AdminLink);
//        $I->waitForElement('/html/body/div[1]/div[3]/div/nav/ul/li[1]/a/span');
//        $I->see('Віталій', ".//*[@id='user_name']");
//        $I->moveBack();
//        $I->click(LocUaPage::$RusLangProfileButton); //Кнопка переключения язіка в профиле
//        $I->seeCurrentUrlEquals('/ru/saas/profile/index');
//        $I->see($shopDom, LocUaPage::$SiteLink);
//        $I->see($shopDom.'/admin', LocUaPage::$AdminLink);
//        $I->click(LocUaPage::$StoreButton);
//        $I->waitForElement('/html/body/div[1]/div[1]/header/div[2]/div/span');
//        $I->seeInTitle('ImageCMS DemoShop');
//        $I->moveBack();
//        $I->wait(5);
//        $I->click(LocUaPage::$AdminLink);
//        $I->waitForElement('/html/body/div[1]/div[3]/div/nav/ul/li[1]/a/span');
//        $I->see('Віталій', ".//*[@id='user_name']");
//        $I->moveBack();
//        $I->click(LocUaPage::$ProfileButton);
//        $I->click(LocUaPage::$ExitButton);
//        $I->wait(2);          
//    }
    
    /**
     * @guy UkrainianTester\LocUaSteps
     */
    
//    public function CheckChangeLanguage2(UkrainianTester\LocUaSteps $I)
//    {
//        InitTest::VerifyLogInOrLogOutUkr($I);
//        $I->click(LocUaPage::$RusLangRegisterFormLink);
//        $I->seeCurrentUrlEquals('/ru');
//        $I->click(LocUaPage::$CreateShopButtonTop);        
//        $I->waitForElement(LocUaPage::$RegisterForm);
//        $I->seeCurrentUrlEquals('/ru/saas/create_store');        
//        $set="abcdefghijklmnopqrstuvwxyz";
//            $size = strlen($set)-1; 
//            $prefix = 'shop-ua-ua-';
//            $mailsufix = '@gmail.com';
//            $name = null;
//            $max = 7;
//                while($max--)
//                $name.=$set[rand(0,$size)]; 
//            $store1 = $prefix.$name;
//            $mail1 = $prefix.$name.$mailsufix;
//            echo "your store name: $this->store \nyoour mail: $this->mail";
//            $password='ssssss';
//            $user='Вадим';
//            $phone='123445';
//            $city='Львів';
//            $category='2';
//            $level='2';
//            $agree='';
//        $I->CreateShop($store1, $mail1, $password, $user, $phone, $city, $country=null, $category, $level, $agree);
//        $I->waitForElement('/html/body/div[1]/div/div[1]/nav/ul/li[1]/a/span[2]','20');
//        $I->seeCurrentUrlEquals('/saas/profile/index');
//        $PageLocale=$I->grabAttributeFrom('/html/body/div[1]/div/div[1]/nav/ul/li[1]/a', 'href');
//        $I->comment("Page: $PageLocale");
//        $I->assertEquals($PageLocale, 'http://premmerce.com/ru/saas/profile');
//        $I->seeCurrentUrlEquals('/ru/saas/profile/index');        
//        $domain='.premmerce.com';
//        $shopDom=$store1.$domain;
//        $I->see($shopDom, LocUaPage::$SiteLink);
//        $I->see($shopDom.'/admin', LocUaPage::$AdminLink);
//        $I->click(LocUaPage::$StoreButton);
//        $I->waitForElement('/html/body/div[1]/div[1]/header/div[2]/div/span');
//        $I->seeInTitle('ImageCMS DemoShop');
//        $I->moveBack();
//        $I->wait(5);
//        $I->click(LocUaPage::$AdminLink);
//        $I->waitForElement('/html/body/div[1]/div[3]/div/nav/ul/li[1]/a/span');
//        $I->see('Вадим', ".//*[@id='user_name']");
//        $I->moveBack();        
//        $I->click(LocUaPage::$UkrLangProfileButton); //Кнопка переключения язіка в профиле
//        $I->seeCurrentUrlEquals('/saas/profile/index');
//        $I->see($shopDom, LocUaPage::$SiteLink);
//        $I->see($shopDom.'/admin', LocUaPage::$AdminLink);
//        $I->click(LocUaPage::$StoreButton);
//        $I->waitForElement('/html/body/div[1]/div[1]/header/div[2]/div/span');
//        $I->seeInTitle('ImageCMS DemoShop');
//        $I->moveBack();
//        $I->wait(5);
//        $I->click(LocUaPage::$AdminLink);
//        $I->waitForElement('/html/body/div[1]/div[3]/div/nav/ul/li[1]/a/span');
//        $I->see('Вадим', ".//*[@id='user_name']");
//        $I->moveBack();
//        $I->click(LocUaPage::$ProfileButton);
//        $I->click(LocUaPage::$ExitButton);
//        $I->wait(2);            
//    }
}