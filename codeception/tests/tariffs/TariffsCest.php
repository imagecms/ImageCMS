<?php

use \PremmerceTester;

/**
 * Створити магаз
 * Перейти на free > basic > standart > bussiness > premium
 * змінити в адмінці
 * перевірити які модулі доступні
 * створити максимум товарів
 * забити місце до максимума
 * 
 * 
 * Перейти на basik тариф
 */
class TariffsCest {

    public $joe;

    public function controll(PremmerceTester $I) {
        $I->amOnUrl('http://google.com');
        $I->wait(5);
        $this->createShop($I);
        $joe = $I->haveFriend('Joe', 'PremmerceTester');
        $joe->does(function(PremmerceTester $I) {
            $I->comment('you too');
            $I->wait(5);
            $I->amOnUrl('http://google.com');
        });
    }

    public function createShop(PremmerceTester $I) {
        
    }

}
