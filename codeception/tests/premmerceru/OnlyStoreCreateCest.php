<?php
use \RussianTester;

class OnlyStoreCreateCest
{
    
    /**
     * @guy RussianTester\LocrusSteps
     */
    
    public function CreateShopUkrCountry1(RussianTester\LocrusSteps $I)
    {
        InitTest::VerifyLogInOrLogOutPremmerceAdmin($I);       
        $I->click(PremmerceMainPage::$CreateShopButtonTop);        
        $I->waitForElement(PremmerceCreateShopPage::$RegisterForm);        
            $set="abcdefghijklmnopqrstuvwxyz1234567890";
            $size = strlen($set)-1; 
            $prefix = 'shop-ru-ua-';
            $mailsufix = '@gmail.com';
            $name = null;
            $max = 7;
                while($max--)
                $name.=$set[rand(0,$size)]; 
            $store = $prefix.$name;
            $mail = $prefix.$name.$mailsufix;
            echo "your store name: $store \nyoour mail: $mail";
            $password='ssssss';
            $user='Sasha Sasha';
            $phone='123445';
            $city='Lviv';    
            $country='2';
            $agree='';
            $level='2';
        $I->CreateShop($store, $mail, $password, $user, $phone, $city, $country, null, $level, $agree);
        $I->waitForElementVisible(PremmerceCreateShopPage::$CreateLoadingForm);
        $I->wait('10');
        $I->waitForElement(PremmerceCabinetPage::$SiteLink, '60');
        $I->seeCurrentUrlEquals('/saas/profile');        
        $domain='.premme.com';
        $shopDom=$store.$domain;
        $I->see($shopDom, PremmerceCabinetPage::$SiteLink);
        $I->see($shopDom.'/admin', PremmerceCabinetPage::$AdminLink);
        $I->click(PremmerceCabinetPage::$SiteLink);
        $I->wait('3');
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
        $I->amOnPage('/saas/profile');
        $I->click(PremmerceCabinetPage::$ProfileButton);
        $I->click(PremmerceCabinetPage::$ExitButton);
        $I->wait("2");
    }
    
    /**
     * @guy RussianTester\LocrusSteps
     */
    
    public function CreateShopRusCountry2(RussianTester\LocrusSteps $I)
    {
        $I->wait('5');
        InitTest::VerifyLogInOrLogOutPremmerceAdmin($I);
        $I->click(PremmerceMainPage::$CreateShopButtonTop);        
        $I->waitForElement(PremmerceCreateShopPage::$RegisterForm);
            $set="abcdefghijklmnopqrstuvwxyz1234567890";
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
        $I->waitForElement(PremmerceCabinetPage::$SiteLink, '60');
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
        $I->amOnPage('/saas/profile');
        $I->click(PremmerceCabinetPage::$ProfileButton);
        $I->click(PremmerceCabinetPage::$ExitButton);
        $I->wait(2);
    }
        
    /**
     * @guy RussianTester\LocrusSteps
     */
    
    public function CreateShopBylCountry3(RussianTester\LocrusSteps $I)
    {
        $I->wait('5');
        InitTest::VerifyLogInOrLogOutPremmerceAdmin($I);
        $I->click(PremmerceMainPage::$CreateShopButtonTop);        
        $I->waitForElement(PremmerceCreateShopPage::$RegisterForm);
            $set="abcdefghijklmnopqrstuvwxyz1234567890";
            $size = strlen($set)-1; 
            $prefix = 'shop-ru-by-';
            $mailsufix = '@gmail.com';
            $name = null;
            $max = 7;
                while($max--)
                $name.=$set[rand(0,$size)]; 
            $store1 = $prefix.$name;
            $mail1 = $prefix.$name.$mailsufix;
            echo "your store name: $store1 \nyoour mail: $mail1";
            $password='1111111';
            $user='Sergey';
            $phone='12121212';
            $city='MINSK';            
            $category='3';
            $level='3';
            $agree='';
            $country='3';
        $I->CreateShop($store1, $mail1, $password, $user, $phone, $city, $country, $category, $level,$agree);
        $I->waitForElementVisible(PremmerceCreateShopPage::$CreateLoadingForm);
        $I->wait('10');
        $I->waitForElement(PremmerceCabinetPage::$SiteLink, '60');
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
        $I->amOnPage('/saas/profile');
        $I->click(PremmerceCabinetPage::$ProfileButton);
        $I->click(PremmerceCabinetPage::$ExitButton);
        $I->wait(2);
    }
}