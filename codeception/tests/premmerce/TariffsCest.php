<?php

use \PremmerceTester;

/**
 * Для запуску тесту має бути створений магаз
 *  	imageqatarifftest.premme.com
 *      imageqa@tarrrif.test
 *      imageqa
 * 
 * 
 * Перейти на free > basic > standart > bussiness > premium
 * змінити в адмінці на фрі(перший раз) потім змінювати в кабінеті
 * перевірити які модулі доступні
 * створити максимум товарів( CSV )-  підготувати CSV файли
 * забити місце до максимума
 * 
 * 
 * Перейти на basik тариф
 */
class TariffsCest {

//    protected $storeUrl = 'http://imageqatarifftest.premme.com';
    protected $storeUrl = 'http://qwertystore.premme.com';
//    protected $email    = 'imageqa@tarrrif.test';
    protected $email    = 'qwerty@store.store';
//    protected $password = 'imageqa';
    protected $password = 'qwerty';
    
    protected $tariffs  = ['Free Russia', 'Basic Russia', 'Standart Russia', 'Business Russia', 'Premium Russia'];
    protected $modules  = [
        //Basic
        'Настройки шаблона интернет-магазина',
        'Рейтинг',
        'Галерея',
        'Конструктор полей',
        'Редактор шаблонов',
        'Управление шаблонами',
        //standart
        'Импорт-экспорт в CSV/XLS',
        'Скидки интернет-магазина',
        'SEO эксперт',
        'Module Y.Market',
        //bussiness
        'Списки пожеланий',
        'Синхронизация с 1С',
        'Статистика',
        'Модуль редиректов',
        'Карта сайта',
        'Управление пользователями',
    ];

    /**
     * @guy PremmerceTester\PremmerceSteps
     */
    public function checkFreeCabinet(PremmerceTester\PremmerceSteps $I) {

        $this->changeTariffSaas($I, $this->tariffs[0]);

        $I->amOnPage(MainPage::$URL);
        $I->loginCabinet($this->email, $this->password);
        $I->amOnPage('/saas/tariffs');
        $cabinet_actual_tarif = $I->grabTextFrom(CabinetPage::$TabTariffFieldTariffText);
        $I->assertEquals(preg_replace('/\s.*/', '', $this->actualTariff), $cabinet_actual_tarif);
    }

    /**
     * @group current
     * @guy PremmerceTester\PremmerceSteps
     */
    public function checkFreeStoreAdmin(PremmerceTester\PremmerceSteps $I) {
        $I->amOnUrl($this->storeUrl);
        $I->login($this->email, $this->password);
//        $I->click(GeneralPage::$Modules);
        $length = $I->getAmount($I, 'div.frame_nav td:nth-child(5) ul li');//$I->executeJS("return $('div.frame_nav td:nth-child(5) ul li').length");
        $I->comment("$length");

        $I->wait(10);
    }

    /**
     * @guy PremmerceTester\PremmerceSteps
     */
    public function checkBasicCabinet(PremmerceTester\PremmerceSteps $I) {
        $this->changeTariffSaas($I, $this->tariffs[1]);
        $I->amOnPage('/saas/tariffs');
        $I->reloadPage();
        $cabinet_actual_tarif = $I->grabTextFrom(CabinetPage::$TabTariffFieldTariffText);
        $I->assertEquals(preg_replace('/\s.*/', '', $this->actualTariff), $cabinet_actual_tarif);
    }

    /**
     * @guy PremmerceTester\PremmerceSteps
     */
    public function checkBasicStoreAdmin(PremmerceTester\PremmerceSteps $I) {
        $I->amOnUrl($this->storeUrl);
    }

    /**
     * @guy PremmerceTester\PremmerceSteps
     */
    public function checkStandartCabinet(PremmerceTester\PremmerceSteps $I) {
        $this->changeTariffSaas($I, $this->tariffs[2]);
        $I->reloadPage();
        $cabinet_actual_tarif = $I->grabTextFrom(CabinetPage::$TabTariffFieldTariffText);
        $I->assertEquals(preg_replace('/\s.*/', '', $this->actualTariff), $cabinet_actual_tarif);
    }

    /**
     * @guy PremmerceTester\PremmerceSteps
     */
    public function checkStandartStoreAdmin(PremmerceTester\PremmerceSteps $I) {
        $I->amOnUrl($this->storeUrl);
    }

    /**
     * @guy PremmerceTester\PremmerceSteps
     */
    public function checkBusinessCabinet(PremmerceTester\PremmerceSteps $I) {
        $this->changeTariffSaas($I, $this->tariffs[3]);
        $I->reloadPage();
        $cabinet_actual_tarif = $I->grabTextFrom(CabinetPage::$TabTariffFieldTariffText);
        $I->assertEquals(preg_replace('/\s.*/', '', $this->actualTariff), $cabinet_actual_tarif);
    }

    /**
     * @guy PremmerceTester\PremmerceSteps
     */
    public function checkBusinessStoreAdmin(PremmerceTester\PremmerceSteps $I) {
        $I->amOnUrl($this->storeUrl);
    }

    /**
     * @guy PremmerceTester\PremmerceSteps
     */
    public function checkPremiumCabinet(PremmerceTester\PremmerceSteps $I) {
        $this->changeTariffSaas($I, $this->tariffs[4]);
        $I->reloadPage();
        $cabinet_actual_tarif = $I->grabTextFrom(CabinetPage::$TabTariffFieldTariffText);
        $I->assertEquals(preg_replace('/\s.*/', '', $this->actualTariff), $cabinet_actual_tarif);
    }

    /**
     * @guy PremmerceTester\PremmerceSteps
     */
    public function checkPremiumStoreAdmin(PremmerceTester\PremmerceSteps $I) {
        $I->amOnUrl($this->storeUrl);
    }

    /*                        PROTECTED                                       */

    /**
     * create new tester(new session in another window)
     * which change tarif to [protected : $actualTariff] in Saas Admin Panel
     */
    protected $actualTariff;

    /**
     * change tariff from cabinet
     * @param PremmerceTester $I
     * @param string $tariff
     */
    protected function changeTariffCabinet(PremmerceTester $I,$tariff) {
            $I->amOnPage('/saas/tariffs');
            //тут зміна тарифа(буде))
    }

    /**
     * change tariff from saas admin panel
     * 
     * @param string $tariff
     */
    protected function changeTariffSaas(PremmerceTester $I, $tariff) {
        $this->actualTariff = $tariff;

        $jonny = $I->haveFriend('Jonny', 'PremmerceTester\PremmerceSteps');
        $jonny->does(function(PremmerceTester\PremmerceSteps $I) {
            $I->maximizeWindow();

            $I->login();
            $I->amOnPage(SaasUserListPage::$URL);
            $I->click(SaasUserListPage::$FilterEmailLabel);
            $I->fillField(SaasUserListPage::$FilterEmailInput, $this->email);
            $I->click(SaasUserListPage::$FilterButtonFilter);
            $I->click(SaasUserListPage::lineActionlink(1));
            $I->selectOption(SaasUserListPage::SelectTariff(1), $this->actualTariff);
            $I->wait(3);
//            $I->acceptPopup();
            $I->resizeWindow(1, 1);
        });
    }

}
