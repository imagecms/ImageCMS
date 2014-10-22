<?php
use \EnglishTester;

class CreateShopUsaCest
{
    private $store, $mail;
    public function AllElementsPresent1(EnglishTester $I)
    {
        $I->amOnPage('/');        
        $I->seeElement(LocEngPage::$DomainEnd);
        $I->see(".premmerce.com", LocEngPage::$DomainEnd);
        $I->click(LocEngPage::$CreateShopFreeButton);        
        $I->waitForElement(LocEngPage::$RegisterForm);                
        $I->seeElement(LocEngPage::$DomainEndInRegisterForm);
        $I->see(".premmerce.com", LocEngPage::$DomainEndInRegisterForm);
        $I->seeElement(LocEngPage::$HelpStaticFieldRegisterForm);
        $I->seeElement(LocEngPage::$EmailField);
        $I->seeElement(LocEngPage::$PasswordField);
        $I->seeElement(LocEngPage::$UserNameField);
        $I->seeElement(LocEngPage::$PhoneNumberField);
        $I->seeElement(LocEngPage::$CountrySelectMenu);
        $I->seeElement(LocEngPage::$CityField);
        $I->seeElement(LocEngPage::$CategorySelectMenu);
        $I->seeElement(LocEngPage::$LevelOfUseSelectMenu);
        $I->seeElement(LocEngPage::$AgreeCheckbox);
        $I->seeElement(LocEngPage::$WorkConditionLink);
        $I->seeElement(LocEngPage::$CreateShopNowRegisterFormButton);       
    }
    
    
    public function AllElementsPresent2(EnglishTester $I)
    {
        $I->amOnPage('/');        
        $I->click(LocEngPage::$CreateShopButton);        
        $I->waitForElement(LocEngPage::$RegisterForm);                
        $I->seeElement(LocEngPage::$DomainEndInRegisterForm);
        $I->see(".premmerce.com", LocEngPage::$DomainEndInRegisterForm);
        $I->seeElement(LocEngPage::$HelpStaticFieldRegisterForm);
        $I->seeElement(LocEngPage::$EmailField);
        $I->seeElement(LocEngPage::$PasswordField);
        $I->seeElement(LocEngPage::$UserNameField);
        $I->seeElement(LocEngPage::$PhoneNumberField);
        $I->seeElement(LocEngPage::$CountrySelectMenu);
        $I->seeElement(LocEngPage::$CityField);
        $I->seeElement(LocEngPage::$CategorySelectMenu);
        $I->seeElement(LocEngPage::$LevelOfUseSelectMenu);
        $I->seeElement(LocEngPage::$AgreeCheckbox);
        $I->seeElement(LocEngPage::$WorkConditionLink);
        $I->seeElement(LocEngPage::$CreateShopNowRegisterFormButton);       
    }
    
    
    public function RequiredFields1(EnglishTester $I)
    {
        $I->amOnPage('/');
        $I->wait(5);
        $I->fillField(LocEngPage::$CreateShopField, 'ыывв');
        $I->click(LocEngPage::$CreateShopFreeButton);
        $I->waitForElement(LocEngPage::$RegisterForm); 
        $I->click(LocEngPage::$CreateShopNowRegisterFormButton);
        $ErrorDomain=$I->grabAttributeFrom(".//*[@id='register-form']/div/label/span[2]", 'class');
        $I->comment($ErrorDomain);
        $I->assertEquals($ErrorDomain, 'error');
        $RequiredEmail=$I->grabAttributeFrom(".//*[@id='register-form']/div/div[2]/div[1]/label[1]/span", 'class');
        $I->comment($RequiredEmail);
        $I->assertEquals($RequiredEmail, 'error');
        $RequiredPassword=$I->grabAttributeFrom(".//*[@id='register-form']/div/div[2]/div[2]/label[1]/span", 'class');
        $I->comment($RequiredPassword);
        $I->assertEquals($RequiredPassword, 'error');
        $RequiredUserName=$I->grabAttributeFrom(".//*[@id='register-form']/div/div[2]/div[1]/label[2]/span", 'class');
        $I->comment($RequiredUserName);
        $I->assertEquals($RequiredUserName, 'error');
        $RequiredPhone=$I->grabAttributeFrom(".//*[@id='register-form']/div/div[2]/div[2]/label[2]/span", 'class');
        $I->comment($RequiredPhone);
        $I->assertEquals($RequiredPhone, 'error');
//        $RequiredCountry=$I->grabAttributeFrom(".//*[@id='register-form']/div/div[2]/div[1]/div[1]/span", 'class');
//        $I->comment($RequiredCountry);
//        $I->assertEquals($RequiredCountry, 'form_error');
        $RequiredCity=$I->grabAttributeFrom(".//*[@id='register-form']/div/div[2]/div[2]/label[3]/span", 'class');
        $I->comment($RequiredCity);
        $I->assertEquals($RequiredCity, 'error');
        $RequiredCategory=$I->grabAttributeFrom(".//*[@id='register-form']/div/div[2]/div[1]/div[2]/span", 'class');
        $I->comment($RequiredCategory);
        $I->assertEquals($RequiredCategory, 'error');
        $RequiredLevel=$I->grabAttributeFrom(".//*[@id='register-form']/div/div[2]/div[2]/div/span", 'class');
        $I->comment($RequiredLevel);
        $I->assertEquals($RequiredLevel, 'error');
        $RequiredAgree=$I->grabAttributeFrom(".//*[@id='register-form']/div/div[3]/span[2]", 'class');
        $I->comment($RequiredAgree);
        $I->assertEquals($RequiredAgree, 'error');
    }
    
        
    public function RequiredFields2(EnglishTester $I)
    {
        $I->amOnPage('/');        
        $I->click(LocEngPage::$CreateShopButton);        
        $I->waitForElement(LocEngPage::$RegisterForm); 
        $I->click(LocEngPage::$CreateShopNowRegisterFormButton);
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
     * @guy EnglishTester\LocEngSteps
     */
    
    public function CreateShopUkrCountry(EnglishTester\LocEngSteps $I)
    {
        InitTest::VerifyLogInOrLogOutUsa($I);
//        $I->amOnPage('/');        
        $I->fillField(LocEngPage::$CreateShopField, 's');
        $I->seeElement(LocEngPage::$DomainEnd);
        $I->see(".premmerce.com", LocEngPage::$DomainEnd);
        $I->click(LocEngPage::$CreateShopFreeButton);        
        $I->waitForElement(LocEngPage::$RegisterForm);       
        $I->seeInField(LocEngPage::$ShopNameField, 's');
        $I->fillField(LocEngPage::$EmailField, 'ss');
        $I->fillField(LocEngPage::$PasswordField, 'sssss');
        $I->fillField(LocEngPage::$UserNameField, 'S');
        $I->fillField(LocEngPage::$PhoneNumberField, 'eee');
        $I->fillField(LocEngPage::$CityField, 'Lv');
        $I->click(LocEngPage::$CountrySelectMenu);
        $I->wait(2);
        $I->click('//*[@id="cusel-scroll-id1"]/span[2]');        
        $I->click(LocEngPage::$CategorySelectMenu);
        $I->click('//*[@id="cusel-scroll-id2"]/span[2]');
        $I->click(LocEngPage::$LevelOfUseSelectMenu);
        $I->click('//*[@id="cusel-scroll-id3"]/span[2]');
        $I->seeCheckboxIsChecked(LocEngPage::$AgreeCheckbox);        
        $I->click(LocEngPage::$CreateShopNowRegisterFormButton);    
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
            $prefix = 'shop-eng-ua-';
            $mailsufix = '@gmail.com';
            $name = null;
            $max = 7;
                while($max--)
                $name.=$set[rand(0,$size)]; 
            $this->store = $prefix.$name;
            $this->mail = $prefix.$name.$mailsufix;
            echo "your store name: $this->store \nyoour mail: $this->mail";
            $password='ssssss';
            $user='Kogut Ivan Bogdanovuch';
            $phone='123445';
            $city='Kyiv';            
        $I->CreateShop($this->store, $this->mail, $password, $user, $phone, $city);
        $I->waitForElement('/html/body/div[1]/div/div[1]/nav/ul/li[1]/a/span[2]','10');
        $I->seeCurrentUrlEquals('/saas/profile/index');
        $PageLocale=$I->grabAttributeFrom('/html/body/div[1]/div/div[1]/nav/ul/li[1]/a', 'href');
        $I->comment("Page: $PageLocale");
        $I->assertEquals($PageLocale, 'http://premmerce.com.ua/saas/profile');
        $domain='.premmerce.com';
        $shopDom=$this->store.$domain;
        $I->see($shopDom, LocEngPage::$SiteLink);
        $I->see($shopDom.'/admin', LocEngPage::$AdminLink);
        $I->click(LocEngPage::$SiteLink);
        $I->waitForElement('/html/body/div[1]/div[1]/header/div[2]/div/span');
        $I->seeInTitle('ImageCMS DemoShop');
        $I->moveBack();
        $I->wait(5);
        $I->click(LocEngPage::$AdminLink);
        $I->waitForElement('/html/body/div[1]/div[3]/div/nav/ul/li[1]/a/span');
        $I->see('Kogut Ivan Bogdanovuch', ".//*[@id='user_name']");
        $I->moveBack();
        $I->click(LocEngPage::$ProfileButton);
        $I->click(LocEngPage::$ExitButton);
        $I->wait(2);
    }
    
    /**
     * @guy EnglishTester\LocEngSteps
     */
    
    public function CreateShopRusCountry(EnglishTester\LocEngSteps $I)
    {
        InitTest::VerifyLogInOrLogOutUsa($I);
        $I->click(LocEngPage::$CreateShopFreeButton);        
        $I->waitForElement(LocEngPage::$RegisterForm);
            $set="abcdefghijklmnopqrstuvwxyz";
            $size = strlen($set)-1; 
            $prefix = 'shop-eng-ru-';
            $mailsufix = '@gmail.com';
            $name = null;
            $max = 7;
                while($max--)
                $name.=$set[rand(0,$size)]; 
            $store1 = $prefix.$name;
            $mail1 = $prefix.$name.$mailsufix;
            echo "your store name: $store1 \nyoour mail: $mail1";
            $password='Авп66ss';
            $user='Иванов Иван Иванович';
            $phone='777777';
            $city='Тула';
            $country='3';
            $category='3';
            $level='3';
//            $agree='';
        $I->CreateShop($store1, $mail1, $password, $user, $phone, $city, $country, $category, $level);
        $I->waitForElementVisible('/html/body/div[3]/div');
        $I->waitForElementNotVisible('/html/body/div[3]/div');
        $I->waitForElement('/html/body/div[1]/div/div[1]/nav/ul/li[1]/a','10');
        $I->seeCurrentUrlEquals('/saas/profile/index');
        $PageLocale=$I->grabAttributeFrom('/html/body/div[1]/div/div[1]/nav/ul/li[1]/a', 'href');
        $I->comment("Page: $PageLocale");
        $I->assertEquals($PageLocale, 'http://premmerce.ru/saas/profile');
        $I->seeCurrentUrlEquals('/saas/profile/index');
        $domain='.premmerce.com';
        $shopDom=$store1.$domain;
        $I->see($shopDom, LocEngPage::$SiteLink);
        $I->see($shopDom.'/admin', LocEngPage::$AdminLink);
        $I->click(LocEngPage::$StoreButton);
        $I->waitForElement('/html/body/div[1]/div[1]/header/div[2]/div/span','5');
        $I->seeInTitle('ImageCMS DemoShop');
        $I->moveBack();
        $I->wait(5);
        $I->click(LocEngPage::$AdminButton);
        $I->waitForElement('/html/body/div[1]/div[3]/div/nav/ul/li[1]/a/span');
        $I->see('Иванов Иван Иванович', ".//*[@id='user_name']");
        $I->moveBack();
        $I->click(LocEngPage::$ProfileButton);
        $I->click(LocEngPage::$ExitButton);
        $I->wait(2);
    }
    
    /**
     * @guy EnglishTester\LocEngSteps
     */
    
    public function CreateShopUsaCountry(EnglishTester\LocEngSteps $I)
    {
        InitTest::VerifyLogInOrLogOutUsa($I);
        $I->click(LocEngPage::$CreateShopFreeButton);        
        $I->waitForElement(LocEngPage::$RegisterForm);               
            $set="abcdefghijklmnopqrstuvwxyz";
            $size = strlen($set)-1; 
            $prefix = 'shop-eng-eng-';
            $mailsufix = '@gmail.com';
            $name = null;
            $max = 7;
                while($max--)
                $name.=$set[rand(0,$size)]; 
            $store1 = $prefix.$name;
            $mail1 = $prefix.$name.$mailsufix;
            echo "your store name: $store1 \nyoour mail: $mail1";
            $password='000000';
            $user='John';
            $phone='45-45-45';
            $city='Boston';
            //$country='4';
            $category='2';
            $level='3';
//            $agree='';
        $I->CreateShop($store1, $mail1, $password, $user, $phone, $city, $country=null, $category, $level);
        $I->waitForElement('/html/body/div[1]/div/div[1]/nav/ul/li[1]/a/span[2]','20');
        $I->seeCurrentUrlEquals('/saas/profile/index');
        $PageLocale=$I->grabAttributeFrom('/html/body/div[1]/div/div[1]/nav/ul/li[1]/a', 'href');
        $I->comment("Page: $PageLocale");
        $I->assertEquals($PageLocale, 'http://premmerce.com/saas/profile');
        $I->seeCurrentUrlEquals('/saas/profile/index');        
        $domain='.premmerce.com';
        $shopDom=$store1.$domain;
        $I->see($shopDom, LocEngPage::$SiteLink);
        $I->see($shopDom.'/admin', LocEngPage::$AdminLink);
        $I->click(LocEngPage::$StoreButton);
        $I->waitForElement('/html/body/div[1]/div[1]/header/div[2]/div/span');
        $I->seeInTitle('ImageCMS DemoShop');
        $I->moveBack();
        $I->wait(5);
        $I->click(LocEngPage::$AdminLink);
        $I->waitForElement('/html/body/div[1]/div[3]/div/nav/ul/li[1]/a/span');
        $I->see('John', ".//*[@id='user_name']");
        $I->moveBack();
        $I->click(LocEngPage::$ProfileButton);
        $I->click(LocEngPage::$ExitButton);
        $I->wait(2);
        
    }
    
    /**
     * @guy EnglishTester\LocEngSteps
     */
        
    public function CreateShopWithEmailAlreadyRegistered(EnglishTester\LocEngSteps $I)
    {
        InitTest::VerifyLogInOrLogOutUsa($I);   
        $I->click(LocEngPage::$CreateShopFreeButton);        
        $I->waitForElement(LocEngPage::$RegisterForm);               
            $set="abcdefghijklmnopqrstuvwxyz";
            $size = strlen($set)-1; 
            $prefix = 'shop-eng-eng-';
            $mailsufix = '@gmail.com';
            $name = null;
            $max = 7;
                while($max--)
                $name.=$set[rand(0,$size)]; 
            $store1 = $prefix.$name;
            $mail1 = $prefix.$name.$mailsufix;
            echo "your store name: $store1 \nyoour mail: $mail1";
            $password='454444';
            $user='Anna';
            $phone='4545555';
            $city='Washington';
            //$country='4';
            $category='2';
            $level='3';
//            $agree='';
        $I->CreateShop($store1, $this->mail, $password, $user, $phone, $city, $country=null, $category, $level);  
        $ErrorEmail=$I->grabAttributeFrom(".//*[@id='register-form']/div/div[2]/div[1]/label[1]/span", 'class');
        $I->comment("Email:$ErrorEmail");
        $I->assertEquals($ErrorEmail, 'form_error');           
        $I->fillField(LocEngPage::$EmailField, $mail1);       
        $I->wait(5);
        $I->click(LocEngPage::$CreateShopNowRegisterFormButton);
        $I->waitForElement('/html/body/div[1]/div/div[1]/nav/ul/li[1]/a/span[2]','20');        
        $I->seeCurrentUrlEquals('/saas/profile/index');
        $PageLocale=$I->grabAttributeFrom('/html/body/div[1]/div/div[1]/nav/ul/li[1]/a', 'href');
        $I->comment("Page: $PageLocale");
        $I->assertEquals($PageLocale, 'http://premmerce.com/saas/profile');
        $domain='.premmerce.com';
        $shopDom=$store1.$domain;
        $I->see($shopDom, LocEngPage::$SiteLink);
        $I->see($shopDom.'/admin', LocEngPage::$AdminLink);
        $I->click(LocEngPage::$StoreButton);
        $I->waitForElement('/html/body/div[1]/div[1]/header/div[2]/div/span');
        $I->seeInTitle('ImageCMS DemoShop');
        $I->moveBack();
        $I->wait(5);
        $I->click(LocEngPage::$AdminLink);
        $I->waitForElement('/html/body/div[1]/div[3]/div/nav/ul/li[1]/a/span');
        $I->see('Anna', ".//*[@id='user_name']");
        $I->moveBack();
        $I->click(LocEngPage::$ProfileButton);
        $I->click(LocEngPage::$ExitButton);
        $I->wait(2);
    }
    
    /**
     * @guy EnglishTester\LocEngSteps
     */
    
    public function CreateShopWithNameDomainAlreadyRegistered(EnglishTester\LocEngSteps $I)
    {
        InitTest::VerifyLogInOrLogOutUsa($I);  
        $I->click(LocEngPage::$CreateShopFreeButton);        
        $I->waitForElement(LocEngPage::$RegisterForm);
            $set="abcdefghijklmnopqrstuvwxyz";
            $size = strlen($set)-1; 
            $prefix = 'shop-eng-ru-';
            $mailsufix = '@gmail.com';
            $name = null;
            $max = 7;
                while($max--)
                $name.=$set[rand(0,$size)]; 
            $store1 = $prefix.$name;
            $mail1 = $prefix.$name.$mailsufix;
            echo "your store name: $store1 \nyoour mail: $mail1";
            $password='1111111';
            $user='Petrov';
            $phone='12121212';
            $city='St.Peterburg';
            $country='3';
            $category='3';
            $level='3';
//            $agree='';
        $I->CreateShop($this->store, $mail1, $password, $user, $phone, $city, $country, $category, $level);
        $I->wait(5);
        $ErrorDomain=$I->grabAttributeFrom(".//*[@id='register-form']/div/label/span[2]", 'class');
        $I->comment("Domain:$ErrorDomain");
        $I->assertEquals($ErrorDomain, 'form_error');           
        $I->fillField(LocEngPage::$ShopNameField, $store1);        
        $I->wait(5);
        $I->click(LocEngPage::$CreateShopNowRegisterFormButton);
        $I->waitForElement('/html/body/div[1]/div/div[1]/nav/ul/li[1]/a/span[2]','10');
        $I->seeCurrentUrlEquals('/saas/profile/index');
        $PageLocale=$I->grabAttributeFrom('/html/body/div[1]/div/div[1]/nav/ul/li[1]/a', 'href');
        $I->comment("Page: $PageLocale");
        $I->assertEquals($PageLocale, 'http://premmerce.ru/saas/profile');
        $I->seeCurrentUrlEquals('/saas/profile/index');
        $domain='.premmerce.com';
        $shopDom=$store1.$domain;
        $I->see($shopDom, LocEngPage::$SiteLink);
        $I->see($shopDom.'/admin', LocEngPage::$AdminLink);
        $I->click(LocEngPage::$StoreButton);
        $I->waitForElement('/html/body/div[1]/div[1]/header/div[2]/div/span');
        $I->seeInTitle('ImageCMS DemoShop');
        $I->moveBack();
        $I->wait(5);
        $I->click(LocEngPage::$AdminButton);
        $I->waitForElement('/html/body/div[1]/div[3]/div/nav/ul/li[1]/a/span');
        $I->see('Petrov', ".//*[@id='user_name']");
        $I->moveBack();
        $I->click(LocEngPage::$ProfileButton);
        $I->click(LocEngPage::$ExitButton);
        $I->wait(2);
    }
    
}