<?php
use \RussianTester;

class CreateShopRusCest
{
    private $store, $mail;
    public function AllElementsPresent1(RussianTester $I)
    {
        $I->amOnPage(PremmerceMainPage::$URL);        
        $I->seeElement(PremmerceMainPage::$DomainEnd);
        $I->see(".premme.com", PremmerceMainPage::$DomainEnd);
        $I->click(PremmerceMainPage::$CreateShopFreeButton);        
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
    
    
    public function AllElementsPresent2(RussianTester $I)
    {
        $I->amOnPage(PremmerceMainPage::$URL);        
        $I->click(PremmerceMainPage::$CreateShopButton);        
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
    
    
    public function RequiredFields1(RussianTester $I)
    {
        $I->amOnPage(PremmerceMainPage::$URL);
        $I->wait(5);
        $I->fillField(PremmerceMainPage::$CreateShopField, 'ыывв');
        $I->click(PremmerceMainPage::$CreateShopFreeButton);
        $I->waitForElement(PremmerceCreateShopPage::$RegisterForm); 
        $I->click(PremmerceCreateShopPage::$CreateShopNowRegisterFormButton);
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
        $I->amOnPage(PremmerceMainPage::$URL);        
        $I->click(PremmerceMainPage::$CreateShopButton);        
        $I->waitForElement(PremmerceCreateShopPage::$RegisterForm); 
        $I->click(PremmerceCreateShopPage::$CreateShopNowRegisterFormButton);
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
        InitTest::VerifyLogInOrLogOutPremmerceAdmin($I);        
        $I->fillField(PremmerceMainPage::$CreateShopField, 's');
        $I->seeElement(PremmerceMainPage::$DomainEnd);
        $I->see(".premme.com", PremmerceMainPage::$DomainEnd);
        $I->click(PremmerceMainPage::$CreateShopFreeButton);        
        $I->waitForElement(PremmerceCreateShopPage::$RegisterForm);       
        $I->seeInField(PremmerceCreateShopPage::$ShopNameField, 's');
        $I->fillField(PremmerceCreateShopPage::$EmailField, 'ss');
        $I->fillField(PremmerceCreateShopPage::$PasswordField, 'sssss');
        $I->fillField(PremmerceCreateShopPage::$UserNameField, 'S');
        $I->fillField(PremmerceCreateShopPage::$PhoneNumberField, 'eee');
        $I->fillField(PremmerceCreateShopPage::$CityField, 'Lv');
        $I->click(PremmerceCreateShopPage::$CountrySelectMenu);        
        $I->click('//*[@id="cusel-scroll-id1"]/span[2]');        
        $I->click(PremmerceCreateShopPage::$CategorySelectMenu);
        $I->click('//*[@id="cusel-scroll-id2"]/span[2]');
        $I->click(PremmerceCreateShopPage::$LevelOfUseSelectMenu);
        $I->click('//*[@id="cusel-scroll-id3"]/span[2]');
        $I->click(PremmerceCreateShopPage::$AgreeCheckbox);        
        $I->click(PremmerceCreateShopPage::$CreateShopNowRegisterFormButton);    
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
        $I->waitForElement('/html/body/div[1]/div/div[1]/nav/ul/li[1]/a/span[2]','10');
//        $I->waitForElement(".//*[@href='http://premmerce.com.ua/saas/profile']", '10');
        $I->seeCurrentUrlEquals('/saas/profile/index');
        $PageLocale=$I->grabAttributeFrom('/html/body/div[1]/div/div[1]/nav/ul/li[1]/a', 'href');
        $I->comment("Page: $PageLocale");
        $I->assertEquals($PageLocale, 'http://imagego.com.ua/saas/profile');
        $domain='.premme.com';
        $shopDom=$this->store.$domain;
        $I->see($shopDom, PremmerceCabinetPage::$SiteLink);
        $I->see($shopDom.'/admin', PremmerceCabinetPage::$AdminLink);
        $I->click(PremmerceCabinetPage::$SiteLink);
        $I->waitForElement('/html/body/div[1]/div[1]/header/div[2]/div/span');
        $I->seeInTitle('ImageCMS DemoShop');
        $I->moveBack();
        $I->wait(5);
        $I->click(PremmerceCabinetPage::$AdminLink);
        $I->waitForElement('/html/body/div[1]/div[3]/div/nav/ul/li[1]/a/span');
        $I->see('Sasha', ".//*[@id='user_name']");
        $I->moveBack();
        $I->click(PremmerceCabinetPage::$ProfileButton);
        $I->click(PremmerceCabinetPage::$ExitButton);
        $I->wait(2);
    }
    
    /**
     * @guy RussianTester\LocrusSteps
     */
    
    public function CreateShopRusCountry(RussianTester\LocrusSteps $I)
    {
        InitTest::VerifyLogInOrLogOutPremmerceAdmin($I);
        $I->click(PremmerceMainPage::$CreateShopFreeButton);        
        $I->waitForElement(PremmerceCreateShopPage::$RegisterForm);
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
        $I->waitForElement('/html/body/div[1]/div/div[1]/nav/ul/li[1]/a/span[2]','10');
//        $I->waitForElement(".//*[@href='http://premmerce.ru/saas/profile']", '10');
        $I->seeCurrentUrlEquals('/saas/profile/index');
        $PageLocale=$I->grabAttributeFrom('/html/body/div[1]/div/div[1]/nav/ul/li[1]/a', 'href');
        $I->comment("Page: $PageLocale");
        $I->assertEquals($PageLocale, 'http://imagego.ru/saas/profile');
        $I->seeCurrentUrlEquals('/saas/profile/index');
        $domain='.premme.com';
        $shopDom=$store1.$domain;
        $I->see($shopDom, PremmerceCabinetPage::$SiteLink);
        $I->see($shopDom.'/admin', PremmerceCabinetPage::$AdminLink);
        $I->click(PremmerceCabinetPage::$StoreButton);
        $I->waitForElement('/html/body/div[1]/div[1]/header/div[2]/div/span','5');
        $I->seeInTitle('ImageCMS DemoShop');
        $I->moveBack();
        $I->wait(5);
        $I->click(PremmerceCabinetPage::$AdminButton);
        $I->waitForElement('/html/body/div[1]/div[3]/div/nav/ul/li[1]/a/span');
        $I->see('Катя', ".//*[@id='user_name']");
        $I->moveBack();
        $I->click(PremmerceCabinetPage::$ProfileButton);
        $I->click(PremmerceCabinetPage::$ExitButton);
        $I->wait(2);
    }
    
    /**
     * @guy RussianTester\LocrusSteps
     */
    
    public function CreateShopUsaCountry(RussianTester\LocrusSteps $I)
    {
        InitTest::VerifyLogInOrLogOutPremmerceAdmin($I);
        $I->click(PremmerceMainPage::$CreateShopFreeButton);        
        $I->waitForElement(PremmerceCreateShopPage::$RegisterForm);               
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
        $I->CreateShop($store1, $mail1, $password, $user, $phone, $city, $country, $category, $level,$agree);//
        $I->waitForElement('/html/body/div[1]/div/div[1]/nav/ul/li[1]/a/span[2]','20');
        $I->seeCurrentUrlEquals('/saas/profile/index');
        $PageLocale=$I->grabAttributeFrom('/html/body/div[1]/div/div[1]/nav/ul/li[1]/a', 'href');
        $I->comment("Page: $PageLocale");
        $I->assertEquals($PageLocale, 'http://imagego.net/saas/profile');
        $I->seeCurrentUrlEquals('/saas/profile/index');        
        $domain='.premme.com';
        $shopDom=$store1.$domain;
        $I->see($shopDom, PremmerceCabinetPage::$SiteLink);
        $I->see($shopDom.'/admin', PremmerceCabinetPage::$AdminLink);
        $I->click(PremmerceCabinetPage::$StoreButton);
        $I->waitForElement('/html/body/div[1]/div[1]/header/div[2]/div/span');
        $I->seeInTitle('ImageCMS DemoShop');
        $I->moveBack();
        $I->wait(5);
        $I->click(PremmerceCabinetPage::$AdminLink);
        $I->waitForElement('/html/body/div[1]/div[3]/div/nav/ul/li[1]/a/span');
        $I->see('Norman', ".//*[@id='user_name']");
        $I->moveBack();
        $I->click(PremmerceCabinetPage::$ProfileButton);
        $I->click(PremmerceCabinetPage::$ExitButton);
        $I->wait(2);
        
    }
    
    /**
     * @guy RussianTester\LocrusSteps
     */
        
    public function CreateShopWithEmailAlreadyRegistered(RussianTester\LocrusSteps $I)
    {
        InitTest::VerifyLogInOrLogOutPremmerceAdmin($I);
        $I->click(PremmerceMainPage::$CreateShopFreeButton);        
        $I->waitForElement(PremmerceCreateShopPage::$RegisterForm);               
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
        $ErrorEmail=$I->grabAttributeFrom(".//*[@id='register-form']/div/div[2]/div[1]/label[1]/span", 'class');
        $I->comment("Email:$ErrorEmail");
        $I->assertEquals($ErrorEmail, 'form_error');           
        $I->fillField(PremmerceCreateShopPage::$EmailField, $mail1);       
        $I->wait(5);
        $I->click(PremmerceCreateShopPage::$CreateShopNowRegisterFormButton);
        $I->waitForElement('/html/body/div[1]/div/div[1]/nav/ul/li[1]/a/span[2]','20');
        //$I->waitForElement(".//*[@href='http://imagego.com/saas/profile']", '20');
        $I->seeCurrentUrlEquals('/saas/profile/index');
        $PageLocale=$I->grabAttributeFrom('/html/body/div[1]/div/div[1]/nav/ul/li[1]/a', 'href');
        $I->comment("Page: $PageLocale");
        $I->assertEquals($PageLocale, 'http://imagego.com/saas/profile');
        $domain='.premme.com';
        $shopDom=$store1.$domain;
        $I->see($shopDom, PremmerceCabinetPage::$SiteLink);
        $I->see($shopDom.'/admin', PremmerceCabinetPage::$AdminLink);
        $I->click(PremmerceCabinetPage::$StoreButton);
        $I->waitForElement('/html/body/div[1]/div[1]/header/div[2]/div/span');
        $I->seeInTitle('ImageCMS DemoShop');
        $I->moveBack();
        $I->wait(5);
        $I->click(PremmerceCabinetPage::$AdminLink);
        $I->waitForElement('/html/body/div[1]/div[3]/div/nav/ul/li[1]/a/span');
        $I->see('David', ".//*[@id='user_name']");
        $I->moveBack();
        $I->click(PremmerceCabinetPage::$ProfileButton);
        $I->click(PremmerceCabinetPage::$ExitButton);
        $I->wait(2);
    }
    
    /**
     * @guy RussianTester\LocrusSteps
     */
    
    public function CreateShopWithNameDomainAlreadyRegistered(RussianTester\LocrusSteps $I)
    {
        InitTest::VerifyLogInOrLogOutPremmerceAdmin($I);
        $I->click(PremmerceMainPage::$CreateShopFreeButton);        
        $I->waitForElement(PremmerceCreateShopPage::$RegisterForm);
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
        $I->wait(5);
        $ErrorDomain=$I->grabAttributeFrom(".//*[@id='register-form']/div/label/span[2]", 'class');
        $I->comment("Domain:$ErrorDomain");
        $I->assertEquals($ErrorDomain, 'form_error');           
        $I->fillField(PremmerceCreateShopPage::$ShopNameField, $store1);        
        $I->wait(5);
        $I->click(PremmerceCreateShopPage::$CreateShopNowRegisterFormButton);
//        $I->waitForElement(".//*[@href='http://premmerce.ru/saas/profile']", '10');
        $I->waitForElement('/html/body/div[1]/div/div[1]/nav/ul/li[1]/a/span[2]','10');
        $I->seeCurrentUrlEquals('/saas/profile/index');
        $PageLocale=$I->grabAttributeFrom('/html/body/div[1]/div/div[1]/nav/ul/li[1]/a', 'href');
        $I->comment("Page: $PageLocale");
        $I->assertEquals($PageLocale, 'http://imagego.ru/saas/profile');
        $I->seeCurrentUrlEquals('/saas/profile/index');
        $domain='.premme.com';
        $shopDom=$store1.$domain;
        $I->see($shopDom, PremmerceCabinetPage::$SiteLink);
        $I->see($shopDom.'/admin', PremmerceCabinetPage::$AdminLink);
        $I->click(PremmerceCabinetPage::$StoreButton);
        $I->waitForElement('/html/body/div[1]/div[1]/header/div[2]/div/span');
        $I->seeInTitle('ImageCMS DemoShop');
        $I->moveBack();
        $I->wait(5);
        $I->click(PremmerceCabinetPage::$AdminButton);
        $I->waitForElement('/html/body/div[1]/div[3]/div/nav/ul/li[1]/a/span');
        $I->see('Владимир', ".//*[@id='user_name']");
        $I->moveBack();
        $I->click(PremmerceCabinetPage::$ProfileButton);
        $I->click(PremmerceCabinetPage::$ExitButton);
        $I->wait(2);
    }
}