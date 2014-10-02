<?php
use \UkrainianTester;

class CreateShopUkrCest
{
    private $store, $mail;
    public function AllElementsPresent1(UkrainianTester $I)
    {
        $I->amOnPage('/');        
        $I->seeElement(LocUaPage::$DomainEnd);
        $I->see(".premmerce.com", LocUaPage::$DomainEnd);
        $I->click(LocUaPage::$CreateShopFreeButton);        
        $I->waitForElement(LocUaPage::$RegisterForm);                
        $I->seeElement(LocUaPage::$DomainEndInRegisterForm);
        $I->see(".premmerce.com", LocUaPage::$DomainEndInRegisterForm);
        $I->seeElement(LocUaPage::$HelpStaticFieldRegisterForm);
        $I->seeElement(LocUaPage::$EmailField);
        $I->seeElement(LocUaPage::$PasswordField);
        $I->seeElement(LocUaPage::$UserNameField);
        $I->seeElement(LocUaPage::$PhoneNumberField);
        $I->seeElement(LocUaPage::$CountrySelectMenu);
        $I->seeElement(LocUaPage::$CityField);
        $I->seeElement(LocUaPage::$CategorySelectMenu);
        $I->seeElement(LocUaPage::$LevelOfUseSelectMenu);
        $I->seeElement(LocUaPage::$AgreeCheckbox);
        $I->seeElement(LocUaPage::$WorkConditionLink);
        $I->seeElement(LocUaPage::$CreateShopNowRegisterFormButton);       
    }
    
    
    public function AllElementsPresent2(UkrainianTester $I)
    {
        $I->amOnPage('/');        
        $I->click(LocUaPage::$CreateShopButton);        
        $I->waitForElement(LocUaPage::$RegisterForm);                
        $I->seeElement(LocUaPage::$DomainEndInRegisterForm);
        $I->see(".premmerce.com", LocUaPage::$DomainEndInRegisterForm);
        $I->seeElement(LocUaPage::$HelpStaticFieldRegisterForm);
        $I->seeElement(LocUaPage::$EmailField);
        $I->seeElement(LocUaPage::$PasswordField);
        $I->seeElement(LocUaPage::$UserNameField);
        $I->seeElement(LocUaPage::$PhoneNumberField);
        $I->seeElement(LocUaPage::$CountrySelectMenu);
        $I->seeElement(LocUaPage::$CityField);
        $I->seeElement(LocUaPage::$CategorySelectMenu);
        $I->seeElement(LocUaPage::$LevelOfUseSelectMenu);
        $I->seeElement(LocUaPage::$AgreeCheckbox);
        $I->seeElement(LocUaPage::$WorkConditionLink);
        $I->seeElement(LocUaPage::$CreateShopNowRegisterFormButton);         
    }
    
    
    public function RequiredFields1(UkrainianTester $I)
    {
        $I->amOnPage('/');
        $I->wait(5);
        $I->fillField(LocUaPage::$CreateShopField, 'ыывв');
        $I->click(LocUaPage::$CreateShopFreeButton);
        $I->waitForElement(LocUaPage::$RegisterForm); 
        $I->click(LocUaPage::$CreateShopNowRegisterFormButton);
        $ErrorDomain=$I->grabAttributeFrom(".//*[@id='register-form']/div/label/span[2]", 'class');
        $I->comment("Error Domain:$ErrorDomain");
        $I->assertEquals($ErrorDomain, 'form_error');
        $RequiredEmail=$I->grabAttributeFrom(".//*[@id='register-form']/div/div[2]/div[1]/label[1]/span", 'class');
        $I->comment("Reguired Email:$RequiredEmail");
        $I->assertEquals($RequiredEmail, 'form_error');
        $RequiredPassword=$I->grabAttributeFrom(".//*[@id='register-form']/div/div[2]/div[2]/label[1]/span", 'class');
        $I->comment("Reguired Password:$RequiredPassword");
        $I->assertEquals($RequiredPassword, 'form_error');
        $RequiredUserName=$I->grabAttributeFrom(".//*[@id='register-form']/div/div[2]/div[1]/label[2]/span", 'class');
        $I->comment("Reguired User Name:$RequiredUserName");
        $I->assertEquals($RequiredUserName, 'form_error');
        $RequiredPhone=$I->grabAttributeFrom(".//*[@id='register-form']/div/div[2]/div[2]/label[2]/span", 'class');
        $I->comment("Reguired Phone:$RequiredPhone");
        $I->assertEquals($RequiredPhone, 'form_error');
//        $RequiredCountry=$I->grabAttributeFrom(".//*[@id='register-form']/div/div[2]/div[1]/div[1]/span", 'class');
//        $I->comment("Reguired Country:$RequiredCountry");
//        $I->assertEquals($RequiredCountry, 'form_error');
        $RequiredCity=$I->grabAttributeFrom(".//*[@id='register-form']/div/div[2]/div[2]/label[3]/span", 'class');
        $I->comment("Reguired City:$RequiredCity");
        $I->assertEquals($RequiredCity, 'form_error');
        $RequiredCategory=$I->grabAttributeFrom(".//*[@id='register-form']/div/div[2]/div[1]/div[2]/span", 'class');
        $I->comment("Reguired Category:$RequiredCategory");
        $I->assertEquals($RequiredCategory, 'form_error');
        $RequiredLevel=$I->grabAttributeFrom(".//*[@id='register-form']/div/div[2]/div[2]/div/span", 'class');
        $I->comment("Reguired Level:$RequiredLevel");
        $I->assertEquals($RequiredLevel, 'form_error');
        $RequiredAgree=$I->grabAttributeFrom(".//*[@id='register-form']/div/div[3]/span[2]", 'class');
        $I->comment("Reguired Agree:$RequiredAgree");
        $I->assertEquals($RequiredAgree, 'form_error');
    }
    
        
    public function RequiredFields2(UkrainianTester $I)
    {
        $I->amOnPage('/');        
        $I->click(LocUaPage::$CreateShopButton);        
        $I->waitForElement(LocUaPage::$RegisterForm); 
        $I->click(LocUaPage::$CreateShopNowRegisterFormButton);
        $ErrorDomain=$I->grabAttributeFrom(".//*[@id='register-form']/div/label/span[2]", 'class');
        $I->comment("Error Domain:$ErrorDomain");
        $I->assertEquals($ErrorDomain, 'form_error');
        $RequiredEmail=$I->grabAttributeFrom(".//*[@id='register-form']/div/div[2]/div[1]/label[1]/span", 'class');
        $I->comment("Reguired Email:$RequiredEmail");
        $I->assertEquals($RequiredEmail, 'form_error');
        $RequiredPassword=$I->grabAttributeFrom(".//*[@id='register-form']/div/div[2]/div[2]/label[1]/span", 'class');
        $I->comment("Reguired Password:$RequiredPassword");
        $I->assertEquals($RequiredPassword, 'form_error');
        $RequiredUserName=$I->grabAttributeFrom(".//*[@id='register-form']/div/div[2]/div[1]/label[2]/span", 'class');
        $I->comment("Reguired User Name:$RequiredUserName");
        $I->assertEquals($RequiredUserName, 'form_error');
        $RequiredPhone=$I->grabAttributeFrom(".//*[@id='register-form']/div/div[2]/div[2]/label[2]/span", 'class');
        $I->comment("Reguired Phone:$RequiredPhone");
        $I->assertEquals($RequiredPhone, 'form_error');
//        $RequiredCountry=$I->grabAttributeFrom(".//*[@id='register-form']/div/div[2]/div[1]/div[1]/span", 'class');
//        $I->comment("Reguired Country:$RequiredCountry");
//        $I->assertEquals($RequiredCountry, 'form_error');
        $RequiredCity=$I->grabAttributeFrom(".//*[@id='register-form']/div/div[2]/div[2]/label[3]/span", 'class');
        $I->comment("Reguired City:$RequiredCity");
        $I->assertEquals($RequiredCity, 'form_error');
        $RequiredCategory=$I->grabAttributeFrom(".//*[@id='register-form']/div/div[2]/div[1]/div[2]/span", 'class');
        $I->comment("Reguired Category:$RequiredCategory");
        $I->assertEquals($RequiredCategory, 'form_error');
        $RequiredLevel=$I->grabAttributeFrom(".//*[@id='register-form']/div/div[2]/div[2]/div/span", 'class');
        $I->comment("Reguired Level:$RequiredLevel");
        $I->assertEquals($RequiredLevel, 'form_error');
        $RequiredAgree=$I->grabAttributeFrom(".//*[@id='register-form']/div/div[3]/span[2]", 'class');
        $I->comment("Reguired Agree:$RequiredAgree");
        $I->assertEquals($RequiredAgree, 'form_error');
    }
    
    
    public function RequiredFields3(UkrainianTester $I)
    {
        $I->amOnPage('/');        
        $I->click(LocUaPage::$CreateShopFreeButton);
        $I->waitForElement(LocUaPage::$RegisterForm);
        $I->click(LocUaPage::$RusLangRegisterFormLink);
        $I->seeCurrentUrlEquals('/ru/saas/create_store');
        $I->click(LocUaPage::$CreateShopNowRegisterFormButton);
        $ErrorDomain=$I->grabAttributeFrom(".//*[@id='register-form']/div/label/span[2]", 'class');
        $I->comment("Error Domain:$ErrorDomain");
        $I->assertEquals($ErrorDomain, 'form_error');
        $RequiredEmail=$I->grabAttributeFrom(".//*[@id='register-form']/div/div[2]/div[1]/label[1]/span", 'class');
        $I->comment("Reguired Email:$RequiredEmail");
        $I->assertEquals($RequiredEmail, 'form_error');
        $RequiredPassword=$I->grabAttributeFrom(".//*[@id='register-form']/div/div[2]/div[2]/label[1]/span", 'class');
        $I->comment("Reguired Password:$RequiredPassword");
        $I->assertEquals($RequiredPassword, 'form_error');
        $RequiredUserName=$I->grabAttributeFrom(".//*[@id='register-form']/div/div[2]/div[1]/label[2]/span", 'class');
        $I->comment("Reguired User Name:$RequiredUserName");
        $I->assertEquals($RequiredUserName, 'form_error');
        $RequiredPhone=$I->grabAttributeFrom(".//*[@id='register-form']/div/div[2]/div[2]/label[2]/span", 'class');
        $I->comment("Reguired Phone:$RequiredPhone");
        $I->assertEquals($RequiredPhone, 'form_error');
//        $RequiredCountry=$I->grabAttributeFrom(".//*[@id='register-form']/div/div[2]/div[1]/div[1]/span", 'class');
//        $I->comment("Reguired Country:$RequiredCountry");
//        $I->assertEquals($RequiredCountry, 'form_error');
        $RequiredCity=$I->grabAttributeFrom(".//*[@id='register-form']/div/div[2]/div[2]/label[3]/span", 'class');
        $I->comment("Reguired City:$RequiredCity");
        $I->assertEquals($RequiredCity, 'form_error');
        $RequiredCategory=$I->grabAttributeFrom(".//*[@id='register-form']/div/div[2]/div[1]/div[2]/span", 'class');
        $I->comment("Reguired Category:$RequiredCategory");
        $I->assertEquals($RequiredCategory, 'form_error');
        $RequiredLevel=$I->grabAttributeFrom(".//*[@id='register-form']/div/div[2]/div[2]/div/span", 'class');
        $I->comment("Reguired Level:$RequiredLevel");
        $I->assertEquals($RequiredLevel, 'form_error');
        $RequiredAgree=$I->grabAttributeFrom(".//*[@id='register-form']/div/div[3]/span[2]", 'class');
        $I->comment("Reguired Agree:$RequiredAgree");
        $I->assertEquals($RequiredAgree, 'form_error');
    }
    
    /**
     * @guy UkrainianTester\LocUaSteps
     */
    
    public function CreateShopUkrCountry(UkrainianTester\LocUaSteps $I)
    {
        InitTest::VerifyLogInOrLogOutUkr($I);
//        $I->amOnPage('/');        
        $I->fillField(LocUaPage::$CreateShopField, 's');
        $I->seeElement(LocUaPage::$DomainEnd);
        $I->see(".premmerce.com", LocUaPage::$DomainEnd);
        $I->click(LocUaPage::$CreateShopFreeButton);        
        $I->waitForElement(LocUaPage::$RegisterForm);
        $I->seeCurrentUrlEquals('/saas/create_store');        
        $I->seeInField(LocUaPage::$ShopNameField, 's');
        $I->fillField(LocUaPage::$EmailField, 'ss');
        $I->fillField(LocUaPage::$PasswordField, 'sssss');
        $I->fillField(LocUaPage::$UserNameField, 'S');
        $I->fillField(LocUaPage::$PhoneNumberField, 'eee');
        $I->fillField(LocUaPage::$CityField, 'Lv');
//        $I->click(LocUaPage::$CountrySelectMenu);
//        $I->wait(2);
//        $I->click('//*[@id="cusel-scroll-id1"]/span[2]');        
        $I->click(LocUaPage::$CategorySelectMenu);
        $I->click('//*[@id="cusel-scroll-id2"]/span[2]');
        $I->click(LocUaPage::$LevelOfUseSelectMenu);
        $I->click('//*[@id="cusel-scroll-id3"]/span[2]');
        $I->click(LocUaPage::$AgreeCheckbox);        
        $I->click(LocUaPage::$CreateShopNowRegisterFormButton);    
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
        $I->waitForElement('/html/body/div[1]/div/div[1]/nav/ul/li[1]/a/span[2]','10');
        $I->seeCurrentUrlEquals('/saas/profile/index');
        $PageLocale=$I->grabAttributeFrom('/html/body/div[1]/div/div[1]/nav/ul/li[1]/a', 'href');
        $I->comment("Page: $PageLocale");
        $I->assertEquals($PageLocale, 'http://premmerce.com.ua/saas/profile');
        $domain='.premmerce.com';
        $shopDom=$this->store.$domain;
        $I->see($shopDom, LocUaPage::$SiteLink);
        $I->see($shopDom.'/admin', LocUaPage::$AdminLink);
        $I->click(LocUaPage::$SiteLink);
        $I->waitForElement('/html/body/div[1]/div[1]/header/div[2]/div/span');
        $I->seeInTitle('ImageCMS DemoShop');
        $I->moveBack();
        $I->wait(5);
        $I->click(LocUaPage::$AdminLink);
        $I->waitForElement('/html/body/div[1]/div[3]/div/nav/ul/li[1]/a/span');
        $I->see('Віталій', ".//*[@id='user_name']");
        $I->moveBack();
        $I->seeCurrentUrlEquals('/ru/saas/profile/index');
        $I->click(LocUaPage::$ProfileButton);
        $I->click(LocUaPage::$ExitButton);
        $I->wait(2);
    }
    
    /**
     * @guy UkrainianTester\LocUaSteps
     */
    
    public function CreateShopRusCountry(UkrainianTester\LocUaSteps $I)
    {
        InitTest::VerifyLogInOrLogOutUkr($I);  
        $I->click(LocUaPage::$CreateShopFreeButton);        
        $I->waitForElement(LocUaPage::$RegisterForm);
            $set="abcdefghijklmnopqrstuvwxyz";
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
        $I->waitForElement('/html/body/div[1]/div/div[1]/nav/ul/li[1]/a/span[2]','10');
        $I->seeCurrentUrlEquals('/saas/profile/index');
        $PageLocale=$I->grabAttributeFrom('/html/body/div[1]/div/div[1]/nav/ul/li[1]/a', 'href');
        $I->comment("Page: $PageLocale");
        $I->assertEquals($PageLocale, 'http://premmerce.ru/saas/profile');
        $I->seeCurrentUrlEquals('/saas/profile/index');
        $domain='.premmerce.com';
        $shopDom=$store1.$domain;
        $I->see($shopDom, LocUaPage::$SiteLink);
        $I->see($shopDom.'/admin', LocUaPage::$AdminLink);
        $I->click(LocUaPage::$StoreButton);
        $I->waitForElement('/html/body/div[1]/div[1]/header/div[2]/div/span','5');
        $I->seeInTitle('ImageCMS DemoShop');
        $I->moveBack();
        $I->wait(5);
        $I->click(LocUaPage::$AdminButton);
        $I->waitForElement('/html/body/div[1]/div[3]/div/nav/ul/li[1]/a/span');
        $I->see('Вова', ".//*[@id='user_name']");
        $I->moveBack();
        $I->click(LocUaPage::$ProfileButton);
        $I->click(LocUaPage::$ExitButton);
        $I->wait(2);
    }
    
    /**
     * @guy UkrainianTester\LocUaSteps
     */
    
    public function CreateShopUsaCountry(UkrainianTester\LocUaSteps $I)
    {
        InitTest::VerifyLogInOrLogOutUkr($I);       
        $I->click(LocUaPage::$CreateShopFreeButton);        
        $I->waitForElement(LocUaPage::$RegisterForm);               
            $set="abcdefghijklmnopqrstuvwxyz";
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
            $password='fffffffff';
            $user='Maria';
            $phone='0303030498';
            $city='Boston';
            $country='3';
            $category='2';
            $level='3';
            $agree='';
        $I->CreateShop($store1, $mail1, $password, $user, $phone, $city, $country, $category, $level,$agree);
        $I->waitForElement('/html/body/div[1]/div/div[1]/nav/ul/li[1]/a/span[2]','20');
        $I->seeCurrentUrlEquals('/saas/profile/index');
        $PageLocale=$I->grabAttributeFrom('/html/body/div[1]/div/div[1]/nav/ul/li[1]/a', 'href');
        $I->comment("Page: $PageLocale");
        $I->assertEquals($PageLocale, 'http://premmerce.com/saas/profile');
        $I->seeCurrentUrlEquals('/saas/profile/index');        
        $domain='.premmerce.com';
        $shopDom=$store1.$domain;
        $I->see($shopDom, LocUaPage::$SiteLink);
        $I->see($shopDom.'/admin', LocUaPage::$AdminLink);
        $I->click(LocUaPage::$StoreButton);
        $I->waitForElement('/html/body/div[1]/div[1]/header/div[2]/div/span');
        $I->seeInTitle('ImageCMS DemoShop');
        $I->moveBack();
        $I->wait(5);
        $I->click(LocUaPage::$AdminLink);
        $I->waitForElement('/html/body/div[1]/div[3]/div/nav/ul/li[1]/a/span');
        $I->see('Maria', ".//*[@id='user_name']");
        $I->moveBack();
        $I->click(LocUaPage::$ProfileButton);
        $I->click(LocUaPage::$ExitButton);
        $I->wait(2);
        
    }
    
    /**
     * @guy UkrainianTester\LocUaSteps
     */
        
    public function CreateShopWithEmailAlreadyRegistered(UkrainianTester\LocUaSteps $I)
    {
        InitTest::VerifyLogInOrLogOutUkr($I);
        $I->click(LocUaPage::$CreateShopFreeButton);        
        $I->waitForElement(LocUaPage::$RegisterForm);               
            $set="abcdefghijklmnopqrstuvwxyz";
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
            $country='3';
            $category='2';
            $level='3';
            $agree='';
        $I->CreateShop($store1, $this->mail, $password, $user, $phone, $city, $country, $category, $level, $agree);  
        $ErrorEmail=$I->grabAttributeFrom(".//*[@id='register-form']/div/div[2]/div[1]/label[1]/span", 'class');
        $I->comment("Email:$ErrorEmail");
        $I->assertEquals($ErrorEmail, 'form_error');           
        $I->fillField(LocUaPage::$EmailField, $mail1);       
        $I->wait(5);
        $I->click(LocUaPage::$CreateShopNowRegisterFormButton);
        $I->waitForElement('/html/body/div[1]/div/div[1]/nav/ul/li[1]/a/span[2]','20');        
        $I->seeCurrentUrlEquals('/saas/profile/index');
        $PageLocale=$I->grabAttributeFrom('/html/body/div[1]/div/div[1]/nav/ul/li[1]/a', 'href');
        $I->comment("Page: $PageLocale");
        $I->assertEquals($PageLocale, 'http://premmerce.com/saas/profile');
        $domain='.premmerce.com';
        $shopDom=$store1.$domain;
        $I->see($shopDom, LocUaPage::$SiteLink);
        $I->see($shopDom.'/admin', LocUaPage::$AdminLink);
        $I->click(LocUaPage::$StoreButton);
        $I->waitForElement('/html/body/div[1]/div[1]/header/div[2]/div/span');
        $I->seeInTitle('ImageCMS DemoShop');
        $I->moveBack();
        $I->wait(5);
        $I->click(LocUaPage::$AdminLink);
        $I->waitForElement('/html/body/div[1]/div[3]/div/nav/ul/li[1]/a/span');
        $I->see('David Cooper', ".//*[@id='user_name']");
        $I->moveBack();
        $I->click(LocUaPage::$ProfileButton);
        $I->click(LocUaPage::$ExitButton);
        $I->wait(2);
    }
    
    /**
     * @guy UkrainianTester\LocUaSteps
     */
    
    public function CreateShopWithNameDomainAlreadyRegistered(UkrainianTester\LocUaSteps $I)
    {
        InitTest::VerifyLogInOrLogOutUkr($I);  
        $I->click(LocUaPage::$CreateShopFreeButton);        
        $I->waitForElement(LocUaPage::$RegisterForm);
            $set="abcdefghijklmnopqrstuvwxyz";
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
            $phone='77-77-77';
            $city='St.Peterburg';
            $country='2';
            $category='3';
            $level='3';
            $agree='';
        $I->CreateShop($this->store, $mail1, $password, $user, $phone, $city, $country, $category, $level, $agree);
        $I->wait(5);
        $ErrorDomain=$I->grabAttributeFrom(".//*[@id='register-form']/div/label/span[2]", 'class');
        $I->comment("Domain:$ErrorDomain");
        $I->assertEquals($ErrorDomain, 'form_error');           
        $I->fillField(LocUaPage::$ShopNameField, $store1);        
        $I->wait(5);
        $I->click(LocUaPage::$CreateShopNowRegisterFormButton);
        $I->waitForElement('/html/body/div[1]/div/div[1]/nav/ul/li[1]/a/span[2]','10');
        $I->seeCurrentUrlEquals('/saas/profile/index');
        $PageLocale=$I->grabAttributeFrom('/html/body/div[1]/div/div[1]/nav/ul/li[1]/a', 'href');
        $I->comment("Page: $PageLocale");
        $I->assertEquals($PageLocale, 'http://premmerce.ru/saas/profile');
        $I->seeCurrentUrlEquals('/saas/profile/index');
        $domain='.premmerce.com';
        $shopDom=$store1.$domain;
        $I->see($shopDom, LocUaPage::$SiteLink);
        $I->see($shopDom.'/admin', LocUaPage::$AdminLink);
        $I->click(LocUaPage::$StoreButton);
        $I->waitForElement('/html/body/div[1]/div[1]/header/div[2]/div/span');
        $I->seeInTitle('ImageCMS DemoShop');
        $I->moveBack();
        $I->wait(5);
        $I->click(LocUaPage::$AdminButton);
        $I->waitForElement('/html/body/div[1]/div[3]/div/nav/ul/li[1]/a/span');
        $I->see('Victoria', ".//*[@id='user_name']");
        $I->moveBack();
        $I->click(LocUaPage::$ProfileButton);
        $I->click(LocUaPage::$ExitButton);
        $I->wait(2);
    }
    
    
    public function CheckPresentTextInFieldAfterChangeLanguage(UkrainianTester $I)
    {
        InitTest::VerifyLogInOrLogOutUkr($I);         
        $I->click(LocUaPage::$CreateShopFreeButton);        
        $I->waitForElement(LocUaPage::$RegisterForm);
        $I->seeCurrentUrlEquals('/saas/create_store');        
        $I->fillField(LocUaPage::$ShopNameField, 's');
        $I->fillField(LocUaPage::$EmailField, 'ss');
        $I->fillField(LocUaPage::$PasswordField, 'sssss');
        $I->fillField(LocUaPage::$UserNameField, 'S');
        $I->fillField(LocUaPage::$PhoneNumberField, 'eee');
        $I->fillField(LocUaPage::$CityField, 'Lv');        
        $I->click(LocUaPage::$CategorySelectMenu);
        $I->click('//*[@id="cusel-scroll-id2"]/span[2]');
        $cat=$I->grabTextFrom('//*[@id="cuselFrame-id2"]/div[2]');
        $I->comment($cat);
        $I->click(LocUaPage::$LevelOfUseSelectMenu);
        $I->click('//*[@id="cusel-scroll-id3"]/span[2]');
        $level=$I->grabTextFrom('//*[@id="cuselFrame-id3"]/div[2]');
        $I->comment($level);
        $I->click(LocUaPage::$AgreeCheckbox);
        $I->click(LocUaPage::$RusLangRegisterFormLink);
        $I->seeCurrentUrlEquals('/ru/saas/create_store');
        $I->seeInField(LocUaPage::$ShopNameField, 's');
        $I->seeInField(LocUaPage::$EmailField, 'ss');
        $I->seeInField(LocUaPage::$PasswordField, 'sssss');
        $I->seeInField(LocUaPage::$UserNameField, 'S');
        $I->seeInField(LocUaPage::$PhoneNumberField, 'eee');
        $I->seeInField(LocUaPage::$CityField, 'Lv');
        $cat1=$I->grabTextFrom('//*[@id="cuselFrame-id2"]/div[2]');
        $level1=$I->grabTextFrom('//*[@id="cuselFrame-id3"]/div[2]');
//        $I->assertEquals($cat1, $cat);
//        $I->assertEquals($level1, $level);
        $I->seeCheckboxIsChecked(LocUaPage::$AgreeCheckbox);        
    }
    
    /**
     * @guy UkrainianTester\LocUaSteps
     */
    
    public function CheckChangeLanguage(UkrainianTester\LocUaSteps $I)
    {
        InitTest::VerifyLogInOrLogOutUkr($I);
        $I->click(LocUaPage::$RusLangRegisterFormLink);
        $I->seeCurrentUrlEquals('/ru');
        $I->click(LocUaPage::$CreateShopFreeButton);        
        $I->waitForElement(LocUaPage::$RegisterForm);
        $I->seeCurrentUrlEquals('/ru/saas/create_store');
        $I->click(LocUaPage::$UkrLangRegisterFormLink);
        $I->seeCurrentUrlEquals('/saas/create_store');
        $set="abcdefghijklmnopqrstuvwxyz";
            $size = strlen($set)-1; 
            $prefix = 'shop-ua-ua-';
            $mailsufix = '@gmail.com';
            $name = null;
            $max = 7;
                while($max--)
                $name.=$set[rand(0,$size)]; 
            $store1 = $prefix.$name;
            $mail1 = $prefix.$name.$mailsufix;
            echo "your store name: $this->store \nyoour mail: $this->mail";
            $password='ssssss';
            $user='Віталій';
            $phone='123445';
            $city='Київ';
            $category='2';
            $level='2';
            $agree='';
        $I->CreateShop($store1, $mail1, $password, $user, $phone, $city, $country=null, $category, $level, $agree);
        $I->waitForElement('/html/body/div[1]/div/div[1]/nav/ul/li[1]/a/span[2]','20');
        $I->seeCurrentUrlEquals('/saas/profile/index');
        $PageLocale=$I->grabAttributeFrom('/html/body/div[1]/div/div[1]/nav/ul/li[1]/a', 'href');
        $I->comment("Page: $PageLocale");
        $I->assertEquals($PageLocale, 'http://premmerce.com/saas/profile');
        $I->seeCurrentUrlEquals('/saas/profile/index');        
        $domain='.premmerce.com';
        $shopDom=$store1.$domain;
        $I->see($shopDom, LocUaPage::$SiteLink);
        $I->see($shopDom.'/admin', LocUaPage::$AdminLink);
        $I->click(LocUaPage::$StoreButton);
        $I->waitForElement('/html/body/div[1]/div[1]/header/div[2]/div/span');
        $I->seeInTitle('ImageCMS DemoShop');
        $I->moveBack();
        $I->wait(5);
        $I->click(LocUaPage::$AdminLink);
        $I->waitForElement('/html/body/div[1]/div[3]/div/nav/ul/li[1]/a/span');
        $I->see('Віталій', ".//*[@id='user_name']");
        $I->moveBack();
        $I->click(LocUaPage::$RusLangProfileButton); //Кнопка переключения язіка в профиле
        $I->seeCurrentUrlEquals('/ru/saas/profile/index');
        $I->see($shopDom, LocUaPage::$SiteLink);
        $I->see($shopDom.'/admin', LocUaPage::$AdminLink);
        $I->click(LocUaPage::$StoreButton);
        $I->waitForElement('/html/body/div[1]/div[1]/header/div[2]/div/span');
        $I->seeInTitle('ImageCMS DemoShop');
        $I->moveBack();
        $I->wait(5);
        $I->click(LocUaPage::$AdminLink);
        $I->waitForElement('/html/body/div[1]/div[3]/div/nav/ul/li[1]/a/span');
        $I->see('Віталій', ".//*[@id='user_name']");
        $I->moveBack();
        $I->click(LocUaPage::$ProfileButton);
        $I->click(LocUaPage::$ExitButton);
        $I->wait(2);          
    }
    
    /**
     * @guy UkrainianTester\LocUaSteps
     */
    
    public function CheckChangeLanguage2(UkrainianTester\LocUaSteps $I)
    {
        InitTest::VerifyLogInOrLogOutUkr($I);
        $I->click(LocUaPage::$RusLangRegisterFormLink);
        $I->seeCurrentUrlEquals('/ru');
        $I->click(LocUaPage::$CreateShopFreeButton);        
        $I->waitForElement(LocUaPage::$RegisterForm);
        $I->seeCurrentUrlEquals('/ru/saas/create_store');        
        $set="abcdefghijklmnopqrstuvwxyz";
            $size = strlen($set)-1; 
            $prefix = 'shop-ua-ua-';
            $mailsufix = '@gmail.com';
            $name = null;
            $max = 7;
                while($max--)
                $name.=$set[rand(0,$size)]; 
            $store1 = $prefix.$name;
            $mail1 = $prefix.$name.$mailsufix;
            echo "your store name: $this->store \nyoour mail: $this->mail";
            $password='ssssss';
            $user='Вадим';
            $phone='123445';
            $city='Львів';
            $category='2';
            $level='2';
            $agree='';
        $I->CreateShop($store1, $mail1, $password, $user, $phone, $city, $country=null, $category, $level, $agree);
        $I->waitForElement('/html/body/div[1]/div/div[1]/nav/ul/li[1]/a/span[2]','20');
        $I->seeCurrentUrlEquals('/saas/profile/index');
        $PageLocale=$I->grabAttributeFrom('/html/body/div[1]/div/div[1]/nav/ul/li[1]/a', 'href');
        $I->comment("Page: $PageLocale");
        $I->assertEquals($PageLocale, 'http://premmerce.com/ru/saas/profile');
        $I->seeCurrentUrlEquals('/ru/saas/profile/index');        
        $domain='.premmerce.com';
        $shopDom=$store1.$domain;
        $I->see($shopDom, LocUaPage::$SiteLink);
        $I->see($shopDom.'/admin', LocUaPage::$AdminLink);
        $I->click(LocUaPage::$StoreButton);
        $I->waitForElement('/html/body/div[1]/div[1]/header/div[2]/div/span');
        $I->seeInTitle('ImageCMS DemoShop');
        $I->moveBack();
        $I->wait(5);
        $I->click(LocUaPage::$AdminLink);
        $I->waitForElement('/html/body/div[1]/div[3]/div/nav/ul/li[1]/a/span');
        $I->see('Вадим', ".//*[@id='user_name']");
        $I->moveBack();        
        $I->click(LocUaPage::$UkrLangProfileButton); //Кнопка переключения язіка в профиле
        $I->seeCurrentUrlEquals('/saas/profile/index');
        $I->see($shopDom, LocUaPage::$SiteLink);
        $I->see($shopDom.'/admin', LocUaPage::$AdminLink);
        $I->click(LocUaPage::$StoreButton);
        $I->waitForElement('/html/body/div[1]/div[1]/header/div[2]/div/span');
        $I->seeInTitle('ImageCMS DemoShop');
        $I->moveBack();
        $I->wait(5);
        $I->click(LocUaPage::$AdminLink);
        $I->waitForElement('/html/body/div[1]/div[3]/div/nav/ul/li[1]/a/span');
        $I->see('Вадим', ".//*[@id='user_name']");
        $I->moveBack();
        $I->click(LocUaPage::$ProfileButton);
        $I->click(LocUaPage::$ExitButton);
        $I->wait(2);            
    }
}