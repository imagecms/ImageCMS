<?php

use \PremmerceTester;

/**
 * Для запуску тесту потрібен створений магаз
 * 
 * 
 * Перейти на free > basic > standart > bussiness > premium
 * змінити в адмінці
 * перевірити які модулі доступні
 * створити максимум товарів( CSV )-  підготувати CSV файли
 * забити місце до максимума
 * 
 * 
 * Перейти на basik тариф
 */
class TariffsCest {

    /**
     * 
     * @guy PremmerceTester\PremmerceSteps
     */
    public function controll(PremmerceTester\PremmerceSteps $I) {
        
//        $I->wait(5);
//        $this->createShop($I);
//        $joe = $I->haveFriend('Joe', 'PremmerceTester');
//        $joe->does(function(PremmerceTester $I) {
//            $I->comment('you too');
//            $I->wait(5);
//            $I->amOnUrl('http://google.com');
//        });
    }

    public function createShop(PremmerceTester $I) {
        
    }

}
