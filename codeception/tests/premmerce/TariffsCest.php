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

    protected $storeUrl = 'http://imageqatest.premme.com';
//    protected $storeUrl = 'http://qwertystore.premme.com';
    protected $email = 'imageqa@tariff.test';
//    protected $email    = 'qwerty@store.store';
    protected $password = 'imageqa';
//    protected $password = 'qwerty';

    protected $tariffs = ['Free Russia', 'Basic Russia', 'Standart Russia', 'Business Russia', 'Premium Russia'];
    protected $modules = [
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
     * @group current
     * @guy PremmerceTester\PremmerceSteps
     */
    public function checkFreeCabinet(PremmerceTester\PremmerceSteps $I) {

        $this->changeTariffSaas($I, $this->tariffs[0]);
//        $I->amOnPage(MainPage::$URL);
        $I->loginCabinet($this->email, $this->password);
        $this->checkCabinet($I);
    }

    /**
     * @group current
     * @guy PremmerceTester\PremmerceSteps
     */
    public function checkFreeStoreAdmin(PremmerceTester\PremmerceSteps $I) {
        $I->amOnUrl($this->storeUrl);
        $I->login($this->email, $this->password);
        $this->checkStore($I);

//        $I->wait(10);
    }

    /**
     * @group current
     * @guy PremmerceTester\PremmerceSteps
     */
    public function checkBasicCabinet(PremmerceTester\PremmerceSteps $I) {
//        $this->changeTariffSaas($I, $this->tariffs[1]);
        $this->changeTariffCabinet($I, 2);
        $this->checkCabinet($I);
//        
//        $I->amOnPage('/saas/tariffs');
//        $I->reloadPage();
//        $cabinet_actual_tarif = $I->grabTextFrom(CabinetPage::$TabTariffFieldTariffText);
//        $I->assertEquals(preg_replace('/\s.*/', '', $this->actualTariff), $cabinet_actual_tarif);
    }

    /**
     * @guy PremmerceTester\PremmerceSteps
     */
    public function checkBasicStoreAdmin(PremmerceTester\PremmerceSteps $I) {
//        $I->amOnUrl($this->storeUrl);
        $this->checkStore($I);
    }

    /**
     * @guy PremmerceTester\PremmerceSteps
     */
    public function checkStandartCabinet(PremmerceTester\PremmerceSteps $I) {
//        $this->changeTariffSaas($I, $this->tariffs[2]);
        $this->changeTariffCabinet($I, 3);
        $this->checkCabinet($I);
        
        
//        $I->reloadPage();
//        $cabinet_actual_tarif = $I->grabTextFrom(CabinetPage::$TabTariffFieldTariffText);
//        $I->assertEquals(preg_replace('/\s.*/', '', $this->actualTariff), $cabinet_actual_tarif);
    }

    /**
     * @guy PremmerceTester\PremmerceSteps
     */
    public function checkStandartStoreAdmin(PremmerceTester\PremmerceSteps $I) {
//        $I->amOnUrl($this->storeUrl);
        $this->checkStore($I);
    }

    /**
     * @guy PremmerceTester\PremmerceSteps
     */
    public function checkBusinessCabinet(PremmerceTester\PremmerceSteps $I) {
//        $this->changeTariffSaas($I, $this->tariffs[3]);
        
        $this->changeTariffCabinet($I, 4);
        $this->checkCabinet($I);
//        $I->reloadPage();
//        $cabinet_actual_tarif = $I->grabTextFrom(CabinetPage::$TabTariffFieldTariffText);
//        $I->assertEquals(preg_replace('/\s.*/', '', $this->actualTariff), $cabinet_actual_tarif);
    }

    /**
     * @guy PremmerceTester\PremmerceSteps
     */
    public function checkBusinessStoreAdmin(PremmerceTester\PremmerceSteps $I) {
//        $I->amOnUrl($this->storeUrl);
        $this->checkStore($I);
    }

    /**
     * @guy PremmerceTester\PremmerceSteps
     */
    public function checkPremiumCabinet(PremmerceTester\PremmerceSteps $I) {
//        $this->changeTariffSaas($I, $this->tariffs[4]);
        $this->changeTariffCabinet($I, 5);
        $this->checkCabinet($I);
//        $I->reloadPage();
//        $cabinet_actual_tarif = $I->grabTextFrom(CabinetPage::$TabTariffFieldTariffText);
//        $I->assertEquals(preg_replace('/\s.*/', '', $this->actualTariff), $cabinet_actual_tarif);
    }

    /**
     * @guy PremmerceTester\PremmerceSteps
     */
    public function checkPremiumStoreAdmin(PremmerceTester\PremmerceSteps $I) {
//        $I->amOnUrl($this->storeUrl);
        $this->checkStore($I);
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    /*------------------------------------------------------------------------*/
    /*                        PROTECTED                                       */
    /*------------------------------------------------------------------------*/

    /**
     * create new tester(new session in another window)
     * which change tarif to [protected : $actualTariff] in Saas Admin Panel
     */
    protected $actualTariff;

    protected function checkCabinet(PremmerceTester $I) {
        $I->reloadPage();
        $I->amOnPage('/saas/tariffs');
        $cabinet_actual_tarif = $I->grabTextFrom(CabinetPage::$TabTariffFieldTariffText);
        $I->assertEquals(preg_replace('/\s.*/', '', $this->actualTariff), $cabinet_actual_tarif);
    }

    /**
     * check all modules in admin panel in dependence of actual tariff
     */
    protected function checkStore(PremmerceTester $I) {

        $I->amOnUrl($this->storeUrl . '/admin');
//        $I->login($this->email, $this->password);
        $I->click(GeneralPage::$Modules);
        $length = $I->getAmount($I, 'div.frame_nav td:nth-child(5) ul li'); //$I->executeJS("return $('div.frame_nav td:nth-child(5) ul li').length");
        $I->comment("$length");
        for ($i = 1; $i <= $length; $i ++) {
            $I->comment($I->grabTextFrom(GeneralPage::modules($i)));
        }
    }

    /**
     * change tariff from cabinet
     * @param int $tariff
     */
    protected function changeTariffCabinet(PremmerceTester $I, $tariff) {
        $this->actualTariff = $this->tariffs[$tariff - 1];
        $I->amOnPage('/saas/tariffs');
        $I->click(CabinetPage::tabTariffTableColumnButton($tariff));
        $I->click(CabinetPage::$TabTariffWindowChangeButtonMove);
        $I->waitForElement(CabinetPage::$TabTariffFieldTariffText, 60);
    }

    /**
     * change tariff from saas admin panel
     * 
     * @param string $tariff
     */
    protected function changeTariffSaas(PremmerceTester $I, $tariff) {
        $this->actualTariff = $tariff;
        $I->login();
        $I->amOnPage(SaasUserListPage::$URL);
        $I->click(SaasUserListPage::$FilterEmailLabel);
        $I->fillField(SaasUserListPage::$FilterEmailInput, $this->email);
        $I->click(SaasUserListPage::$FilterButtonFilter);
        $I->click(SaasUserListPage::lineActionlink(1));
        $I->selectOption(SaasUserListPage::SelectTariff(1), $this->actualTariff);

        $I->wait(5);
        try {
            $I->acceptPopup();
        } catch (Exception $exc) {
            
        }

    }

}
