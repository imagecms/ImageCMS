<?php

use \PremmerceTester;

/**
 * Для запуску тесту має бути створений магаз
 *  	imageqatarifftest.premme.com
 *      imageqa@tarrrif.test
 *      imageqa
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

    private $url = 'http://imageqatarifftest.premme.com';
    private $email = 'imageqa@tarrrif.test';
    private $password = 'imageqa';
    private $tariffs = ['Free Russia', 'Basic Russia', 'Standart Russia', 'Business Russia', 'Premium Russia'];

    /**
     * @guy PremmerceTester\PremmerceSteps
     */
    public function chaeckFree(PremmerceTester\PremmerceSteps $I) {
        $jonny = $I->haveFriend('Jonny', 'PremmerceTester\PremmerceSteps');
        $jonny->does(function(PremmerceTester\PremmerceSteps $I) {
            $I->maximizeWindow();
            $this->changeTarif($I, $this->tariffs[0]);
// 
        });
        $I->amOnPage(MainPage::$URL);
        $I->loginCabinet($this->email, $this->password);
        $I->click(CabinetPage::$TabTariff);
        $I->wait(3);
        $I->comment($I->grabTextFrom(CabinetPage::$TabTariffFieldAdminLabel));
        $I->comment($I->grabTextFrom(CabinetPage::$TabTariffFieldAdminLink));
        $I->comment($I->grabTextFrom(CabinetPage::$TabTariffFieldCapacityLabel));
        $I->comment($I->grabTextFrom(CabinetPage::$TabTariffFieldCapacityText));
        
    }

   

    
    
    
    
    
    
    protected function changeTarif(PremmerceTester $I, $tarif) {
        $I->login();
        $I->amOnPage(SaasUserListPage::$URL);
        $I->click(SaasUserListPage::$FilterEmailLabel);
        $I->fillField(SaasUserListPage::$FilterEmailInput, $this->email);
        $I->click(SaasUserListPage::$FilterButtonFilter);
        $I->click(SaasUserListPage::lineActionlink(1));
        $I->selectOption(SaasUserListPage::SelectTariff(1), $tarif);
        $I->wait(5);
    }

}
