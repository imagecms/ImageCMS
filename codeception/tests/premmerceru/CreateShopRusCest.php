<?php
use \RussianTester;

class CreateShopRusCest
{
    private $store, $mail;
    public function AllElementsPresent1(RussianTester $I)
    {
        $I->amOnPage('/');        
        $I->seeElement(LocRusPage::$DomainEnd);
        $I->see(".premmerce.com", LocRusPage::$DomainEnd);
        $I->click(LocRusPage::$CreateShopFreeButton);        
        $I->waitForElement(LocRusPage::$RegisterForm);                
        $I->seeElement(LocRusPage::$DomainEndInRegisterForm);
        $I->see(".premmerce.com", LocRusPage::$DomainEndInRegisterForm);
        $I->seeElement(LocRusPage::$HelpStaticFieldRegisterForm);
        $I->seeElement(LocRusPage::$EmailField);
        $I->seeElement(LocRusPage::$PasswordField);
        $I->seeElement(LocRusPage::$UserNameField);
        $I->seeElement(LocRusPage::$PhoneNumberField);
        $I->seeElement(LocRusPage::$CountrySelectMenu);
        $I->seeElement(LocRusPage::$CityField);
        $I->seeElement(LocRusPage::$CategorySelectMenu);
        $I->seeElement(LocRusPage::$LevelOfUseSelectMenu);
        $I->seeElement(LocRusPage::$AgreeCheckbox);
        $I->seeElement(LocRusPage::$WorkConditionLink);
        $I->seeElement(LocRusPage::$CreateShopNowRegisterFormButton);       
    }
    
    
    public function AllElementsPresent2(RussianTester $I)
    {
        $I->amOnPage('/');        
        $I->click(LocRusPage::$CreateShopButton);        
        $I->waitForElement(LocRusPage::$RegisterForm);                
        $I->seeElement(LocRusPage::$DomainEndInRegisterForm);
        $I->see(".premmerce.com", LocRusPage::$DomainEndInRegisterForm);
        $I->seeElement(LocRusPage::$HelpStaticFieldRegisterForm);
        $I->seeElement(LocRusPage::$EmailField);
        $I->seeElement(LocRusPage::$PasswordField);
        $I->seeElement(LocRusPage::$UserNameField);
        $I->seeElement(LocRusPage::$PhoneNumberField);
        $I->seeElement(LocRusPage::$CountrySelectMenu);
        $I->seeElement(LocRusPage::$CityField);
        $I->seeElement(LocRusPage::$CategorySelectMenu);
        $I->seeElement(LocRusPage::$LevelOfUseSelectMenu);
        $I->seeElement(LocRusPage::$AgreeCheckbox);
        $I->seeElement(LocRusPage::$WorkConditionLink);
        $I->seeElement(LocRusPage::$CreateShopNowRegisterFormButton);       
    }
    
    
    public function RequiredFields1(RussianTester $I)
    {
        $I->amOnPage('/');
        $I->wait(5);
        $I->fillField(LocRusPage::$CreateShopField, 'ыывв');
        $I->click(LocRusPage::$CreateShopFreeButton);
        $I->waitForElement(LocRusPage::$RegisterForm); 
        $I->click(LocRusPage::$CreateShopNowRegisterFormButton);
        $ErrorDomain=$I->grabAttributeFrom(".//*[@id='register-form']/div/label/span[2]", 'class');
        $I->comment($ErrorDomain);
        $I->assertEquals($ErrorDomain, 'form_error');
        $RequiredEmail=$I->grabAttributeFrom(".//*[@id='register-form']/div/div[2]/div[1]/label[1]/span", 'class');
        $I->comment($RequiredEmail);
        $I->assertEquals($RequiredEmail, 'form_error');
        $RequiredPassword=$I->grabAttributeFrom(".//*[@id='register-form']/div/div[2]/div[2]/label[1]/span", 'class');
        $I->comment($RequiredPassword);
        $I->assertEquals($RequiredPassword, 'form_error');
        $RequiredUserName=$I->grabAttributeFrom(".//*[@id='register-form']/div/div[2]/div[1]/label[2]/span", 'class');
        $I->comment($RequiredUserName);
        $I->assertEquals($RequiredUserName, 'form_error');
        $RequiredPhone=$I->grabAttributeFrom(".//*[@id='register-form']/div/div[2]/div[2]/label[2]/span", 'class');
        $I->comment($RequiredPhone);
        $I->assertEquals($RequiredPhone, 'form_error');
//        $RequiredCountry=$I->grabAttributeFrom(".//*[@id='register-form']/div/div[2]/div[1]/div[1]/span", 'class');
//        $I->comment($RequiredCountry);
//        $I->assertEquals($RequiredCountry, 'form_error');
        $RequiredCity=$I->grabAttributeFrom(".//*[@id='register-form']/div/div[2]/div[2]/label[3]/span", 'class');
        $I->comment($RequiredCity);
        $I->assertEquals($RequiredCity, 'form_error');
        $RequiredCategory=$I->grabAttributeFrom(".//*[@id='register-form']/div/div[2]/div[1]/div[2]/span", 'class');
        $I->comment($RequiredCategory);
        $I->assertEquals($RequiredCategory, 'form_error');
        $RequiredLevel=$I->grabAttributeFrom(".//*[@id='register-form']/div/div[2]/div[2]/div/span", 'class');
        $I->comment($RequiredLevel);
        $I->assertEquals($RequiredLevel, 'form_error');
        $RequiredAgree=$I->grabAttributeFrom(".//*[@id='register-form']/div/div[3]/span[2]", 'class');
        $I->comment($RequiredAgree);
        $I->assertEquals($RequiredAgree, 'form_error');
    }
    
        
    public function RequiredFields2(RussianTester $I)
    {
        $I->amOnPage('/');        
        $I->click(LocRusPage::$CreateShopButton);        
        $I->waitForElement(LocRusPage::$RegisterForm); 
        $I->click(LocRusPage::$CreateShopNowRegisterFormButton);
        $ErrorDomain=$I->grabAttributeFrom(".//*[@id='register-form']/div/label/span[2]", 'class');
        $I->comment($ErrorDomain);
        $I->assertEquals($ErrorDomain, 'form_error');
        $RequiredEmail=$I->grabAttributeFrom(".//*[@id='register-form']/div/div[2]/div[1]/label[1]/span", 'class');
        $I->comment($RequiredEmail);
        $I->assertEquals($RequiredEmail, 'form_error');
        $RequiredPassword=$I->grabAttributeFrom(".//*[@id='register-form']/div/div[2]/div[2]/label[1]/span", 'class');
        $I->comment($RequiredPassword);
        $I->assertEquals($RequiredPassword, 'form_error');
        $RequiredUserName=$I->grabAttributeFrom(".//*[@id='register-form']/div/div[2]/div[1]/label[2]/span", 'class');
        $I->comment($RequiredUserName);
        $I->assertEquals($RequiredUserName, 'form_error');
        $RequiredPhone=$I->grabAttributeFrom(".//*[@id='register-form']/div/div[2]/div[2]/label[2]/span", 'class');
        $I->comment($RequiredPhone);
        $I->assertEquals($RequiredPhone, 'form_error');
//        $RequiredCountry=$I->grabAttributeFrom(".//*[@id='register-form']/div/div[2]/div[1]/div[1]/span", 'class');
//        $I->comment($RequiredCountry);
//        $I->assertEquals($RequiredCountry, 'form_error');
        $RequiredCity=$I->grabAttributeFrom(".//*[@id='register-form']/div/div[2]/div[2]/label[3]/span", 'class');
        $I->comment($RequiredCity);
        $I->assertEquals($RequiredCity, 'form_error');
        $RequiredCategory=$I->grabAttributeFrom(".//*[@id='register-form']/div/div[2]/div[1]/div[2]/span", 'class');
        $I->comment($RequiredCategory);
        $I->assertEquals($RequiredCategory, 'form_error');
        $RequiredLevel=$I->grabAttributeFrom(".//*[@id='register-form']/div/div[2]/div[2]/div/span", 'class');
        $I->comment($RequiredLevel);
        $I->assertEquals($RequiredLevel, 'form_error');
        $RequiredAgree=$I->grabAttributeFrom(".//*[@id='register-form']/div/div[3]/span[2]", 'class');
        $I->comment($RequiredAgree);
        $I->assertEquals($RequiredAgree, 'form_error');
    }
    
    /**
     * @guy RussianTester\LocrusSteps
     */
    
    public function CreateShopUkrCountry(RussianTester\LocrusSteps $I)
    {
        InitTest::VerifyLogInOrLogOutRus($I);
//        $I->amOnPage('/');        
        $I->fillField(LocRusPage::$CreateShopField, 's');
        $I->seeElement(LocRusPage::$DomainEnd);
        $I->see(".premmerce.com", LocRusPage::$DomainEnd);
        $I->click(LocRusPage::$CreateShopFreeButton);        
        $I->waitForElement(LocRusPage::$RegisterForm);       
        $I->seeInField(LocRusPage::$ShopNameField, 's');
        $I->fillField(LocRusPage::$EmailField, 'ss');
        $I->fillField(LocRusPage::$PasswordField, 'sssss');
        $I->fillField(LocRusPage::$UserNameField, 'S');
        $I->fillField(LocRusPage::$PhoneNumberField, 'eee');
        $I->fillField(LocRusPage::$CityField, 'Lv');
        $I->click(LocRusPage::$CountrySelectMenu);        
        $I->click('//*[@id="cusel-scroll-id1"]/span[2]');        
        $I->click(LocRusPage::$CategorySelectMenu);
        $I->click('//*[@id="cusel-scroll-id2"]/span[2]');
        $I->click(LocRusPage::$LevelOfUseSelectMenu);
        $I->click('//*[@id="cusel-scroll-id3"]/span[2]');
        $I->click(LocRusPage::$AgreeCheckbox);        
        $I->click(LocRusPage::$CreateShopNowRegisterFormButton);    
        $ErrorDomain=$I->grabAttributeFrom(".//*[@id='register-form']/div/label/span[2]", 'class');
        $I->comment("Domain:$ErrorDomain");
        $I->assertEquals($ErrorDomain, 'form_error');
        $ErrorEmail=$I->grabAttributeFrom(".//*[@id='register-form']/div/div[2]/div[1]/label[1]/span", 'class');
        $I->comment("Email:$ErrorEmail");
        $I->assertEquals($ErrorEmail, 'form_error');
        $ErrorPassword=$I->grabAttributeFrom(".//*[@id='register-form']/div/div[2]/div[2]/label[1]/span", 'class');
        $I->comment("Password:$ErrorPassword");
        $I->assertEquals($ErrorPassword, 'form_error');
        $ErrorUserName=$I->grabAttributeFrom(".//*[@id='register-form']/div/div[2]/div[1]/label[2]/span", 'class');
        $I->comment("UserName:$ErrorUserName");
        $I->assertEquals($ErrorUserName, "form_error");
//        $ErrorPhone=$I->grabAttributeFrom('.//*[@id='register-form']/div/div[2]/div[2]/label[2]/span', 'class');
//        $I->comment($ErrorPhone);
//        $I->assertEquals($ErrorPhone, 'form_error');       
        $ErrorCity=$I->grabAttributeFrom(".//*[@id='register-form']/div/div[2]/div[2]/label[3]/span", 'class');
        $I->comment("City:$ErrorCity");
        $I->assertEquals($ErrorCity, 'form_error');
            $set="abcdefghijklmnopqrstuvwxyz";
            $size = strlen($set)-1; 
            $prefix = 'shop-ru-ua-';
            $mailsufix = '@gmail.com';
            $name = null;
            $max = 7;
                while($max--)
                $name.=$set[rand(0,$size)]; 
            $this->store = $prefix.$name;
            $this->mail = $prefix.$name.$mailsufix;
            echo "your store name: $this->store \nyoour mail: $this->mail";
            $password='ssssss';
            $user='Sasha';
            $phone='123445';
            $city='Lviv';            
          $I->CreateShop($this->store, $this->mail, $password, $user, $phone, $city);
//        $I->fillField(LocRusPage::$ShopNameField, $this->store);
//        $I->fillField(LocRusPage::$EmailField, $this->mail);        
//        $I->fillField(LocRusPage::$PasswordField, 'ssssss');
//        $I->fillField(LocRusPage::$UserNameField, 'Sasha');        
//        $I->fillField(LocRusPage::$PhoneNumberField, '123445');
//        $I->fillField(LocRusPage::$CityField, 'Lviv');
//        $I->wait(5);
//        $I->click(LocRusPage::$CreateShopNowRegisterFormButton);
        $I->waitForElement('/html/body/div[1]/div/div[1]/nav/ul/li[1]/a/span[2]','10');
//        $I->waitForElement(".//*[@href='http://premmerce.com.ua/saas/profile']", '10');
        $I->seeCurrentUrlEquals('/saas/profile/index');
        $PageLocale=$I->grabAttributeFrom('/html/body/div[1]/div/div[1]/nav/ul/li[1]/a', 'href');
        $I->comment("Page: $PageLocale");
        $I->assertEquals($PageLocale, 'http://premmerce.com.ua/saas/profile');
        $domain='.premmerce.com';
        $shopDom=$this->store.$domain;
        $I->see($shopDom, LocRusPage::$SiteLink);
        $I->see($shopDom.'/admin', LocRusPage::$AdminLink);
        $I->click(LocRusPage::$SiteLink);
        $I->waitForElement('/html/body/div[1]/div[1]/header/div[2]/div/span');
        $I->seeInTitle('ImageCMS DemoShop');
        $I->moveBack();
        $I->wait(5);
        $I->click(LocRusPage::$AdminLink);
        $I->waitForElement('/html/body/div[1]/div[3]/div/nav/ul/li[1]/a/span');
        $I->see('Sasha', ".//*[@id='user_name']");
        $I->moveBack();
        $I->click(LocRusPage::$ProfileButton);
        $I->click(LocRusPage::$ExitButton);
        $I->wait(2);
    }
    
    /**
     * @guy RussianTester\LocrusSteps
     */
    
    public function CreateShopRusCountry(RussianTester\LocrusSteps $I)
    {
        InitTest::VerifyLogInOrLogOutRus($I);
//        $I->amOnPage('/');
//        $Atrib=$I->grabCCSAmount($I, '.f-s_0.d_i-b.v-a_t>input');
//        $I->comment($Atrib);
//        $I->wait(2);
//        if($Atrib==0){
//            $I->click(LocRusPage::$CabinetButton);
//            $I->waitForElement('/html/body/div[1]/div/div[1]/nav/ul/li[1]/a/span[2]');
//            $I->click(LocRusPage::$ProfileButton);
//            $I->click(LocRusPage::$ExitButton);
//            $I->seeInCurrentUrl('/');            
//        }   
        $I->click(LocRusPage::$CreateShopFreeButton);        
        $I->waitForElement(LocRusPage::$RegisterForm);
            $set="abcdefghijklmnopqrstuvwxyz";
            $size = strlen($set)-1; 
            $prefix = 'shop-ru-ru-';
            $mailsufix = '@gmail.com';
            $name = null;
            $max = 7;
                while($max--)
                $name.=$set[rand(0,$size)]; 
            $store1 = $prefix.$name;
            $mail1 = $prefix.$name.$mailsufix;
            echo "your store name: $store1 \nyoour mail: $mail1";
            $password='1111111';
            $user='Катя';
            $phone='12121212';
            $city='Москва';
            //$country='';
            $category='3';
            $level='3';
            $agree='';
        $I->CreateShop($store1, $mail1, $password, $user, $phone, $city, $country=null, $category, $level,$agree);
//        $I->fillField(LocRusPage::$ShopNameField, $store1);
//        $I->fillField(LocRusPage::$EmailField, $mail1);
//        $I->fillField(LocRusPage::$PasswordField, '1111111');
//        $I->fillField(LocRusPage::$UserNameField, 'Катя');
//        $I->fillField(LocRusPage::$PhoneNumberField, '12121212');
//        $I->fillField(LocRusPage::$CityField, 'Москва');
//        $I->click(LocRusPage::$CountrySelectMenu);        
//        $I->click('//*[@id="cusel-scroll-id1"]/span[3]');        
//        $I->click(LocRusPage::$CategorySelectMenu);
//        $I->click('//*[@id="cusel-scroll-id2"]/span[3]');
//        $I->click(LocRusPage::$LevelOfUseSelectMenu);
//        $I->click('//*[@id="cusel-scroll-id3"]/span[3]');
//        $I->click(LocRusPage::$AgreeCheckbox); 
//        $I->wait(5);
//        $I->click(LocRusPage::$CreateShopNowRegisterFormButton);
        $I->waitForElement('/html/body/div[1]/div/div[1]/nav/ul/li[1]/a/span[2]','10');
//        $I->waitForElement(".//*[@href='http://premmerce.ru/saas/profile']", '10');
        $I->seeCurrentUrlEquals('/saas/profile/index');
        $PageLocale=$I->grabAttributeFrom('/html/body/div[1]/div/div[1]/nav/ul/li[1]/a', 'href');
        $I->comment("Page: $PageLocale");
        $I->assertEquals($PageLocale, 'http://premmerce.ru/saas/profile');
        $I->seeCurrentUrlEquals('/saas/profile/index');
        $domain='.premmerce.com';
        $shopDom=$store1.$domain;
        $I->see($shopDom, LocRusPage::$SiteLink);
        $I->see($shopDom.'/admin', LocRusPage::$AdminLink);
        $I->click(LocRusPage::$StoreButton);
        $I->waitForElement('/html/body/div[1]/div[1]/header/div[2]/div/span','5');
        $I->seeInTitle('ImageCMS DemoShop');
        $I->moveBack();
        $I->wait(5);
        $I->click(LocRusPage::$AdminButton);
        $I->waitForElement('/html/body/div[1]/div[3]/div/nav/ul/li[1]/a/span');
        $I->see('Катя', ".//*[@id='user_name']");
        $I->moveBack();
        $I->click(LocRusPage::$ProfileButton);
        $I->click(LocRusPage::$ExitButton);
        $I->wait(2);
    }
    
    /**
     * @guy RussianTester\LocrusSteps
     */
    
    public function CreateShopUsaCountry(RussianTester\LocrusSteps $I)
    {
        InitTest::VerifyLogInOrLogOutRus($I);
//        $I->amOnPage('/');
//        $Atrib=$I->grabCCSAmount($I, '.f-s_0.d_i-b.v-a_t>input');
//        $I->comment($Atrib);
//        $I->wait(2);
//        if($Atrib==0){
//            $I->click(LocRusPage::$CabinetButton);
//            $I->waitForElement('/html/body/div[1]/div/div[1]/nav/ul/li[1]/a/span[2]');
//            $I->click(LocRusPage::$ProfileButton);
//            $I->click(LocRusPage::$ExitButton);
//            $I->seeInCurrentUrl('/');            
//        }        
        $I->click(LocRusPage::$CreateShopFreeButton);        
        $I->waitForElement(LocRusPage::$RegisterForm);               
            $set="abcdefghijklmnopqrstuvwxyz";
            $size = strlen($set)-1; 
            $prefix = 'shop-ru-eng-';
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
        $I->CreateShop($store1, $mail1, $password, $user, $phone, $city, $country, $category, $level,$agree);
//        $I->fillField(LocRusPage::$ShopNameField, $store1);
//        $I->fillField(LocRusPage::$EmailField, $mail1);
//        $I->fillField(LocRusPage::$PasswordField, '1111111');
//        $I->fillField(LocRusPage::$UserNameField, 'Norman');
//        $I->fillField(LocRusPage::$PhoneNumberField, '4443434367');
//        $I->fillField(LocRusPage::$CityField, 'Boston');
//        $I->click(LocRusPage::$CountrySelectMenu);        
//        $I->click('//*[@id="cusel-scroll-id1"]/span[4]');        
//        $I->click(LocRusPage::$CategorySelectMenu);
//        $I->click('//*[@id="cusel-scroll-id2"]/span[2]');
//        $I->click(LocRusPage::$LevelOfUseSelectMenu);
//        $I->click('//*[@id="cusel-scroll-id3"]/span[3]');
//        $I->click(LocRusPage::$AgreeCheckbox);               
//        $I->wait(5);
//        $I->click(LocRusPage::$CreateShopNowRegisterFormButton);
//        $I->waitForElement(".//*[@href='http://premmerce.com/saas/profile']", '20');
        $I->waitForElement('/html/body/div[1]/div/div[1]/nav/ul/li[1]/a/span[2]','20');
        $I->seeCurrentUrlEquals('/saas/profile/index');
        $PageLocale=$I->grabAttributeFrom('/html/body/div[1]/div/div[1]/nav/ul/li[1]/a', 'href');
        $I->comment("Page: $PageLocale");
        $I->assertEquals($PageLocale, 'http://premmerce.com/saas/profile');
        $I->seeCurrentUrlEquals('/saas/profile/index');        
        $domain='.premmerce.com';
        $shopDom=$store1.$domain;
        $I->see($shopDom, LocRusPage::$SiteLink);
        $I->see($shopDom.'/admin', LocRusPage::$AdminLink);
        $I->click(LocRusPage::$StoreButton);
        $I->waitForElement('/html/body/div[1]/div[1]/header/div[2]/div/span');
        $I->seeInTitle('ImageCMS DemoShop');
        $I->moveBack();
        $I->wait(5);
        $I->click(LocRusPage::$AdminLink);
        $I->waitForElement('/html/body/div[1]/div[3]/div/nav/ul/li[1]/a/span');
        $I->see('Norman', ".//*[@id='user_name']");
        $I->moveBack();
        $I->click(LocRusPage::$ProfileButton);
        $I->click(LocRusPage::$ExitButton);
        $I->wait(2);
        
    }
    
    /**
     * @guy RussianTester\LocrusSteps
     */
        
    public function CreateShopWithEmailAlreadyRegistered(RussianTester\LocrusSteps $I)
    {
        InitTest::VerifyLogInOrLogOutRus($I);
//        $I->amOnPage('/');
//        $Atrib=$I->grabCCSAmount($I, '.f-s_0.d_i-b.v-a_t>input');
//        $I->comment($Atrib);
//        $I->wait(2);
//        if($Atrib==0){
//            $I->click(LocRusPage::$CabinetButton);
//            $I->waitForElement('/html/body/div[1]/div/div[1]/nav/ul/li[1]/a/span[2]');
//            $I->click(LocRusPage::$ProfileButton);
//            $I->click(LocRusPage::$ExitButton);
//            $I->seeInCurrentUrl('/');            
//        }   
        $I->click(LocRusPage::$CreateShopFreeButton);        
        $I->waitForElement(LocRusPage::$RegisterForm);               
            $set="abcdefghijklmnopqrstuvwxyz";
            $size = strlen($set)-1; 
            $prefix = 'shop-ru-eng-';
            $mailsufix = '@gmail.com';
            $name = null;
            $max = 7;
                while($max--)
                $name.=$set[rand(0,$size)]; 
            $store1 = $prefix.$name;
            $mail1 = $prefix.$name.$mailsufix;
            echo "your store name: $store1 \nyoour mail: $mail1";
            $password='454444';
            $user='David';
            $phone='4545555';
            $city='New York';
            $country='3';
            $category='2';
            $level='3';
            $agree='';
            $I->CreateShop($store1, $this->mail, $password, $user, $phone, $city, $country, $category, $level, $agree);
//        $I->fillField(LocRusPage::$ShopNameField, $store1);
//        $I->fillField(LocRusPage::$EmailField, $this->mail);
//        $I->fillField(LocRusPage::$PasswordField, '454444');
//        $I->fillField(LocRusPage::$UserNameField, 'David');
//        $I->fillField(LocRusPage::$PhoneNumberField, '4545555');
//        $I->fillField(LocRusPage::$CityField, 'New York');
//        $I->click(LocRusPage::$CountrySelectMenu);        
//        $I->click('//*[@id="cusel-scroll-id1"]/span[4]');        
//        $I->click(LocRusPage::$CategorySelectMenu);
//        $I->click('//*[@id="cusel-scroll-id2"]/span[2]');
//        $I->click(LocRusPage::$LevelOfUseSelectMenu);
//        $I->click('//*[@id="cusel-scroll-id3"]/span[3]');
//        $I->click(LocRusPage::$AgreeCheckbox);        
//        $I->click(LocRusPage::$CreateShopNowRegisterFormButton);    
        $ErrorEmail=$I->grabAttributeFrom(".//*[@id='register-form']/div/div[2]/div[1]/label[1]/span", 'class');
        $I->comment("Email:$ErrorEmail");
        $I->assertEquals($ErrorEmail, 'form_error');           
        $I->fillField(LocRusPage::$EmailField, $mail1);       
        $I->wait(5);
        $I->click(LocRusPage::$CreateShopNowRegisterFormButton);
        $I->waitForElement('/html/body/div[1]/div/div[1]/nav/ul/li[1]/a/span[2]','20');
        //$I->waitForElement(".//*[@href='http://premmerce.com/saas/profile']", '20');
        $I->seeCurrentUrlEquals('/saas/profile/index');
        $PageLocale=$I->grabAttributeFrom('/html/body/div[1]/div/div[1]/nav/ul/li[1]/a', 'href');
        $I->comment("Page: $PageLocale");
        $I->assertEquals($PageLocale, 'http://premmerce.com/saas/profile');
        $domain='.premmerce.com';
        $shopDom=$store1.$domain;
        $I->see($shopDom, LocRusPage::$SiteLink);
        $I->see($shopDom.'/admin', LocRusPage::$AdminLink);
        $I->click(LocRusPage::$StoreButton);
        $I->waitForElement('/html/body/div[1]/div[1]/header/div[2]/div/span');
        $I->seeInTitle('ImageCMS DemoShop');
        $I->moveBack();
        $I->wait(5);
        $I->click(LocRusPage::$AdminLink);
        $I->waitForElement('/html/body/div[1]/div[3]/div/nav/ul/li[1]/a/span');
        $I->see('David', ".//*[@id='user_name']");
        $I->moveBack();
        $I->click(LocRusPage::$ProfileButton);
        $I->click(LocRusPage::$ExitButton);
        $I->wait(2);
    }
    
    /**
     * @guy RussianTester\LocrusSteps
     */
    
    public function CreateShopWithNameDomainAlreadyRegistered(RussianTester\LocrusSteps $I)
    {
        InitTest::VerifyLogInOrLogOutRus($I);
//        $I->amOnPage('/');
//        $Atrib=$I->grabCCSAmount($I, '.f-s_0.d_i-b.v-a_t>input');
//        $I->comment($Atrib);
//        $I->wait(2);
//        if($Atrib==0){
//            $I->click(LocRusPage::$CabinetButton);
//            $I->waitForElement('/html/body/div[1]/div/div[1]/nav/ul/li[1]/a/span[2]');
//            $I->click(LocRusPage::$ProfileButton);
//            $I->click(LocRusPage::$ExitButton);
//            $I->seeInCurrentUrl('/');            
//        }   
        $I->click(LocRusPage::$CreateShopFreeButton);        
        $I->waitForElement(LocRusPage::$RegisterForm);
            $set="abcdefghijklmnopqrstuvwxyz";
            $size = strlen($set)-1; 
            $prefix = 'shop-ru-ru-';
            $mailsufix = '@gmail.com';
            $name = null;
            $max = 7;
                while($max--)
                $name.=$set[rand(0,$size)]; 
            $store1 = $prefix.$name;
            $mail1 = $prefix.$name.$mailsufix;
            echo "your store name: $store1 \nyoour mail: $mail1";
            $password='1111111';
            $user='Владимир';
            $phone='12121212';
            $city='Москва';
            //$country='';
            $category='3';
            $level='3';
            $agree='';
        $I->CreateShop($this->store, $mail1, $password, $user, $phone, $city, $country=null, $category, $level, $agree);
//        $I->fillField(LocRusPage::$ShopNameField, $this->store);
//        $I->fillField(LocRusPage::$EmailField, $mail1);
//        $I->fillField(LocRusPage::$PasswordField, '1111111');
//        $I->fillField(LocRusPage::$UserNameField, 'Владимир');
//        $I->fillField(LocRusPage::$PhoneNumberField, '12121212');
//        $I->fillField(LocRusPage::$CityField, 'Москва');
//        $I->click(LocRusPage::$CountrySelectMenu);        
//        $I->click('//*[@id="cusel-scroll-id1"]/span[3]');        
//        $I->click(LocRusPage::$CategorySelectMenu);
//        $I->click('//*[@id="cusel-scroll-id2"]/span[3]');
//        $I->click(LocRusPage::$LevelOfUseSelectMenu);
//        $I->click('//*[@id="cusel-scroll-id3"]/span[3]');
//        $I->click(LocRusPage::$AgreeCheckbox); 
//        $I->wait(5);
//        $I->click(LocRusPage::$CreateShopNowRegisterFormButton);
        $I->wait(5);
        $ErrorDomain=$I->grabAttributeFrom(".//*[@id='register-form']/div/label/span[2]", 'class');
        $I->comment("Domain:$ErrorDomain");
        $I->assertEquals($ErrorDomain, 'form_error');           
        $I->fillField(LocRusPage::$ShopNameField, $store1);        
        $I->wait(5);
        $I->click(LocRusPage::$CreateShopNowRegisterFormButton);
//        $I->waitForElement(".//*[@href='http://premmerce.ru/saas/profile']", '10');
        $I->waitForElement('/html/body/div[1]/div/div[1]/nav/ul/li[1]/a/span[2]','10');
        $I->seeCurrentUrlEquals('/saas/profile/index');
        $PageLocale=$I->grabAttributeFrom('/html/body/div[1]/div/div[1]/nav/ul/li[1]/a', 'href');
        $I->comment("Page: $PageLocale");
        $I->assertEquals($PageLocale, 'http://premmerce.ru/saas/profile');
        $I->seeCurrentUrlEquals('/saas/profile/index');
        $domain='.premmerce.com';
        $shopDom=$store1.$domain;
        $I->see($shopDom, LocRusPage::$SiteLink);
        $I->see($shopDom.'/admin', LocRusPage::$AdminLink);
        $I->click(LocRusPage::$StoreButton);
        $I->waitForElement('/html/body/div[1]/div[1]/header/div[2]/div/span');
        $I->seeInTitle('ImageCMS DemoShop');
        $I->moveBack();
        $I->wait(5);
        $I->click(LocRusPage::$AdminButton);
        $I->waitForElement('/html/body/div[1]/div[3]/div/nav/ul/li[1]/a/span');
        $I->see('Владимир', ".//*[@id='user_name']");
        $I->moveBack();
        $I->click(LocRusPage::$ProfileButton);
        $I->click(LocRusPage::$ExitButton);
        $I->wait(2);
    }
}