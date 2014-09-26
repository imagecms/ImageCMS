<?php

use \PremmerceTester;

class CreateShopCest {

    private static $PremmerceAdress = 'http://www.premmerce.ru/saas/create_store';
    private static $CodeceptionYml;
    
    private static $Domain = '[name="domain"]';
    private static $Email = '[name="email"]';
    private static $Password = '[name="password"]';
    private static $Name = '[name="username"]';
    private static $Phone = '[name="phone"]';
    private static $City = '[name="city"]';

    public function createShop(PremmerceTester $I) {
        $I->amOnPage('/');
        $I->fillField(self::$Domain, 'premmerce1');
        $I->fillField(self::$Email, 'prem@merce1.com');
        $I->fillField(self::$Password, 'premmerce');
        $I->fillField(self::$Name, 'CIServer');
        $I->fillField(self::$Phone, '0101100101');
        $I->fillField(self::$City, 'Львів');
        $I->click('#cuselFrame-id2');
        $I->click('#cusel-scroll-id2>span:nth-child(11)');
        $I->click('#cuselFrame-id3');
        $I->click('#cusel-scroll-id3>span:nth-child(3)');
        $I->checkOption('.frame-apply-terms.f-s_0>input');
        $I->click('.btn-create-shop2>button');
        $I->wait(15);
        
    }        


    /***************************************************************************
     ****************************PROTECTED**************************************
     **************************************************************************/
    protected static function restoreCodeceptionYml(){
        file_put_contents(codecept_root_dir() . "codeception.yml", self::$CodeceptionYml);
    }
    protected static function getCodeceptionYml() {
        return file_get_contents(codecept_root_dir() . "codeception.yml");
    }
    protected static function changeAdress($adress) {
        $modified = preg_replace('~\surl:\s\'.*\'\s~', " url: '" . $adress . "' ", self::$CodeceptionYml);
        return  file_put_contents(codecept_root_dir() . "codeception.yml", $modified);
    }

}