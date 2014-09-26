<?php
use \PremmerceTester;

class CreateShopCest
{
    private static $PremmerceAdress = 'http://www.premmerce.ru/saas/create_store';
    public function createShop(PremmerceTester $I){
    $I->amOnPage(self::$PremmerceAdress);    
    }
}