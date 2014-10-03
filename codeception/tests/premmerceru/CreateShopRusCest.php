<?php
use \RussianTester;

class CreateShopRusCest
{
    private $store, $mail;
    public function AllElementsPresent1(RussianTester $I)
    {
        InitTest::VerifyLogInOrLogOutPremmerceAdmin($I);
        $I->amOnPage(PremmerceMainPage::$URL); 
        $I->seeElement(PremmerceMainPage::$CreateShopField);
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
        $ErrorDomain=$I->grabAttributeFrom(PremmerceCreateShopPage::$ErrorDomain, 'class');
        $I->comment($ErrorDomain);
        $I->assertEquals($ErrorDomain, 'error');
        $RequiredEmail=$I->grabAttributeFrom(PremmerceCreateShopPage::$ErrorEmail, 'class');
        $I->comment($RequiredEmail);
        $I->assertEquals($RequiredEmail, 'error');
        $RequiredPassword=$I->grabAttributeFrom(PremmerceCreateShopPage::$ErrorPassword, 'class');
        $I->comment($RequiredPassword);
        $I->assertEquals($RequiredPassword, 'error');
        $RequiredUserName=$I->grabAttributeFrom(PremmerceCreateShopPage::$ErrorUserName, 'class');
        $I->comment($RequiredUserName);
        $I->assertEquals($RequiredUserName, 'error');
        $RequiredPhone=$I->grabAttributeFrom(PremmerceCreateShopPage::$ErrorPhoneNumber, 'class');
        $I->comment($RequiredPhone);
        $I->assertEquals($RequiredPhone, 'error');
        $RequiredCity=$I->grabAttributeFrom(PremmerceCreateShopPage::$ErrorCity, 'class');
        $I->comment($RequiredCity);
        $I->assertEquals($RequiredCity, 'error');        
        $RequiredLevel=$I->grabAttributeFrom(PremmerceCreateShopPage::$ErrorLevelOfUse, 'class');
        $I->comment($RequiredLevel);
        $I->assertEquals($RequiredLevel, 'error');
        $RequiredAgree=$I->grabAttributeFrom(PremmerceCreateShopPage::$ErrorAgree, 'class');
        $I->comment($RequiredAgree);
        $I->assertEquals($RequiredAgree, 'error');
    }
    
        
    public function RequiredFields2(RussianTester $I)
    {
        $I->amOnPage(PremmerceMainPage::$URL);        
        $I->click(PremmerceMainPage::$CreateShopButton);        
        $I->waitForElement(PremmerceCreateShopPage::$RegisterForm); 
        $I->click(PremmerceCreateShopPage::$CreateShopNowRegisterFormButton);
        $ErrorDomain=$I->grabAttributeFrom(PremmerceCreateShopPage::$ErrorDomain, 'class');
        $I->comment($ErrorDomain);
        $I->assertEquals($ErrorDomain, 'error');
        $RequiredEmail=$I->grabAttributeFrom(PremmerceCreateShopPage::$ErrorEmail, 'class');
        $I->comment($RequiredEmail);
        $I->assertEquals($RequiredEmail, 'error');
        $RequiredPassword=$I->grabAttributeFrom(PremmerceCreateShopPage::$ErrorPassword, 'class');
        $I->comment($RequiredPassword);
        $I->assertEquals($RequiredPassword, 'error');
        $RequiredUserName=$I->grabAttributeFrom(PremmerceCreateShopPage::$ErrorUserName, 'class');
        $I->comment($RequiredUserName);
        $I->assertEquals($RequiredUserName, 'error');
        $RequiredPhone=$I->grabAttributeFrom(PremmerceCreateShopPage::$ErrorPhoneNumber, 'class');
        $I->comment($RequiredPhone);
        $I->assertEquals($RequiredPhone, 'error');
        $RequiredCity=$I->grabAttributeFrom(PremmerceCreateShopPage::$ErrorCity, 'class');
        $I->comment($RequiredCity);
        $I->assertEquals($RequiredCity, 'error');        
        $RequiredLevel=$I->grabAttributeFrom(PremmerceCreateShopPage::$ErrorLevelOfUse, 'class');
        $I->comment($RequiredLevel);
        $I->assertEquals($RequiredLevel, 'error');
        $RequiredAgree=$I->grabAttributeFrom(PremmerceCreateShopPage::$ErrorAgree, 'class');
        $I->comment($RequiredAgree);
        $I->assertEquals($RequiredAgree, 'error');
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
        $I->waitForElementVisible(PremmerceCreateShopPage::$CreateLoadingForm);
        $I->wait('10');
        $I->waitForElement(PremmerceCabinetPage::$SiteLink, '10');
        $I->seeCurrentUrlEquals('/saas/profile');
        $PageLocale=$I->grabAttributeFrom('/html/body/div[1]/div/div[1]/nav/ul/li[1]/a', 'href');
        $I->comment("Page: $PageLocale");
        $I->assertEquals($PageLocale, 'http://imagego.com.ua/saas/profile');
        $domain='.premme.com';
        $shopDom=$this->store.$domain;
        $I->see($shopDom, PremmerceCabinetPage::$SiteLink);
        $I->see($shopDom.'/admin', PremmerceCabinetPage::$AdminLink);
        $I->click(PremmerceCabinetPage::$SiteLink);
        $$I->executeInSelenium(function (\Webdriver $webdriver) {
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
        $I->see('Sasha', ".head");
        $I->amOnPage('/saas/profile');
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
            $category='3';
            $level='3';
            $agree='';
        $I->CreateShop($store1, $mail1, $password, $user, $phone, $city, $country=null, $category, $level,$agree);
        $I->waitForElementVisible(PremmerceCreateShopPage::$CreateLoadingForm);
        $I->wait('10');
        $I->waitForElement(PremmerceCabinetPage::$SiteLink, '10');
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
        $I->see('Катя', ".head");
        $I->amOnPage('/saas/profile');
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
        $I->waitForElementVisible(PremmerceCreateShopPage::$CreateLoadingForm);
        $I->wait('10');
        $I->waitForElement(PremmerceCabinetPage::$SiteLink, '10');
        $I->seeCurrentUrlEquals('/saas/profile');
        $PageLocale=$I->grabAttributeFrom('/html/body/div[1]/div/div[1]/nav/ul/li[1]/a', 'href');
        $I->comment("Page: $PageLocale");
        $I->assertEquals($PageLocale, 'http://imagego.net/saas/profile');
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
        $I->see('Norman', ".head");
        $I->amOnPage('/saas/profile');
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
            $prefix = 'shop-ru-ru-';
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
//            $country='1';
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
        $I->waitForElement(PremmerceCabinetPage::$SiteLink, '10');
        $I->seeCurrentUrlEquals('/saas/profile');
        $PageLocale=$I->grabAttributeFrom('/html/body/div[1]/div/div[1]/nav/ul/li[1]/a', 'href');
        $I->comment("Page: $PageLocale");
        $I->assertEquals($PageLocale, 'http://imagego.ru/saas/profile');
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
        $I->see('David', ".head");
        $I->amOnPage('/saas/profile');
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
//        $I->dontSeeElement(PremmerceCreateShopPage::$CreateLoadingForm);
        $ErrorDomain=$I->grabAttributeFrom(PremmerceCreateShopPage::$ErrorDomain, 'class');
        $I->comment("Domain:$ErrorDomain");
        $I->assertEquals($ErrorDomain, 'error');           
        $I->fillField(PremmerceCreateShopPage::$ShopNameField, $store1);        
        $I->wait(5);
        $I->click(PremmerceCreateShopPage::$CreateShopNowRegisterFormButton);
        $I->waitForElementVisible(PremmerceCreateShopPage::$CreateLoadingForm);
        $I->wait('10');
        $I->waitForElement(PremmerceCabinetPage::$SiteLink, '10');
        $I->seeCurrentUrlEquals('/saas/profile');
        $PageLocale=$I->grabAttributeFrom('/html/body/div[1]/div/div[1]/nav/ul/li[1]/a', 'href');
        $I->comment("Page: $PageLocale");
        $I->assertEquals($PageLocale, 'http://imagego.ru/saas/profile');
        $I->seeCurrentUrlEquals('/saas/profile/index');
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
        $I->see('Владимир', ".head");
        $I->amOnPage('/saas/profile');
        $I->click(PremmerceCabinetPage::$ProfileButton);
        $I->click(PremmerceCabinetPage::$ExitButton);
        $I->wait(2);
    }
}