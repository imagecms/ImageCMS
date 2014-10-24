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

    protected $storeUrl = 'http://fqwenfkjidscgr.premme.com';
//    protected $storeUrl = 'http://qwertystore.premme.com';
    protected $email = 'qud@man.net';
//    protected $email    = 'qwerty@store.store';
    protected $password = 'premmerce';
//    protected $password = 'qwerty';

    protected $actualTariff;
    protected $tariffs = ['Free Russia', 'Basic Russia', 'Standart Russia', 'Business Russia', 'Premium Russia'];
    protected $prices = [
        'Free Russia' => 'Бесплатно',
        'Basic Russia' => '599 руб/мес.',
        'Standart Russia' => '1399 руб/мес.',
        'Business Russia' => '2399 руб/мес.',
        'Premium Russia' => '4499 руб/мес.'
    ];
    protected $modules = [
        //Basic
        'Настройки шаблона интернет-магазина',
        'Рейтинг',
        'Галерея',
//        'Конструктор полей',
        'Редактор шаблонов',
        'Управление шаблонами',
        //standart
        'Импорт-экспорт в CSV/XLS',
//        'Скидки интернет-магазина',
        'SEO эксперт',
        'Module Y.Market',
        //bussiness
//        'Списки пожеланий',
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

        $this->changeTariffSaas($I, $this->tariffs[1]);
        $I->loginCabinet($this->email, $this->password);
//        $this->checkCabinet($I);
    }

    /**
     * @guy PremmerceTester\PremmerceSteps
     */
    public function checkFreeStoreAdmin(PremmerceTester\PremmerceSteps $I) {
        $I->amOnUrl($this->storeUrl);
        $I->login($this->email, $this->password);
//        $this->checkStoreModules($I);
    }
//
//    /**
//     * @group current
//     * @guy PremmerceTester\PremmerceSteps
//     */
//    public function checkBasicCabinet(PremmerceTester\PremmerceSteps $I) {
//        $this->changeTariffCabinet($I, 2);
//        $this->checkCabinet($I);
//    }
//
    /**
     * @guy PremmerceTester\PremmerceSteps
     */
    public function checkBasicStoreAdmin(PremmerceTester\PremmerceSteps $I) {
        $this->checkStoreModules($I);
    }

    /**
     * @group current
     * @guy PremmerceTester\PremmerceSteps
     */
    public function checkStandartCabinet(PremmerceTester\PremmerceSteps $I) {
        $this->changeTariffCabinet($I, 3);
        $this->checkCabinet($I);
    }

    /**
     * @guy PremmerceTester\PremmerceSteps
     */
    public function checkStandartStoreAdmin(PremmerceTester\PremmerceSteps $I) {
        $this->checkStoreModules($I);
    }

    /**
     * @group current
     * @guy PremmerceTester\PremmerceSteps
     */
    public function checkBusinessCabinet(PremmerceTester\PremmerceSteps $I) {
        $this->changeTariffCabinet($I, 4);
        $this->checkCabinet($I);
    }

    /**
     * @guy PremmerceTester\PremmerceSteps
     */
    public function checkBusinessStoreAdmin(PremmerceTester\PremmerceSteps $I) {
        $this->checkStoreModules($I);
    }

    /**
     * @group current
     * @guy PremmerceTester\PremmerceSteps
     */
    public function checkPremiumCabinet(PremmerceTester\PremmerceSteps $I) {
        $this->changeTariffCabinet($I, 5);
        $this->checkCabinet($I);
    }

    /**
     * @guy PremmerceTester\PremmerceSteps
     */
    public function checkPremiumStoreAdmin(PremmerceTester\PremmerceSteps $I) {
        $this->checkStoreModules($I);
    }

    /* ------------------------------------------------------------------------ */
    /*                        PROTECTED                                       */
    /* ------------------------------------------------------------------------ */

    /**
     * create new tester(new session in another window)
     * which change tarif to [protected : $actualTariff] in Saas Admin Panel
     */
    protected function checkCabinet(PremmerceTester $I) {
//        $I->reloadPage();
        $I->amOnPage('/saas/tariffs');

        $tarif = preg_replace('/\s.*/', '', $this->actualTariff);

        //зчитати текст з поля тариф і порівняти з поточним тарифом
        $cabinet_actual_tarif = $I->grabTextFrom(CabinetPage::$TabTariffFieldTariffText);
        $I->assertEquals($tarif, $cabinet_actual_tarif);

        //зчитати заголовок активної колонки таблиці тарифів і порівняти з поточним тарифом
        $table_actual_tariff = $I->grabTextFrom('ul.items.items-tarifs.items-tarifs-new li.active div.title');
        $I->assertEquals(strtoupper($tarif), $table_actual_tariff);

        //зчитати ціну активної колонки таблиці тарифів і порівняти з ціною поточного тарифу
        $table_actual_price = $I->grabTextFrom('ul.items.items-tarifs.items-tarifs-new li.active div.frame-price');
        $I->comment($table_actual_price);
        $I->assertEquals($this->prices[$this->actualTariff], $table_actual_price);
    }

    /**
     * check all modules in admin panel in dependence of actual tariff
     */
    protected function checkStoreModules(PremmerceTester $I) {

        $I->amOnUrl($this->storeUrl . '/admin');
        $I->click(GeneralPage::$Modules);
        $length = $I->getAmount($I, 'div.frame_nav td:nth-child(5) ul li');


        //визначити дозволені ($allowed_modules) 
        //і заборонені ($forbidden_modules) 
        //модулі для тарифу ($actualTariff)
        switch ($this->actualTariff) {
            case $this->tariffs[0]://free
                $allowed_modules = [];
                break;
            case $this->tariffs[1]://basic
                $allowed_modules = array_slice($this->modules, 0, 6);
                break;
            case $this->tariffs[2]://standart
                $allowed_modules = array_slice($this->modules, 0, 10);
                break;
            case $this->tariffs[3]://business
                $allowed_modules = $this->modules;
                break;
            case $this->tariffs[4]://premium
                $allowed_modules = $this->modules;
                break;
        }
        $forbidden_modules = array_diff($this->modules, $allowed_modules);

        //зчитати всі модулі які присутні в адмінці
        $actual_modules = [];
        for ($i = 1; $i <= $length; $i ++) {
            $actual_modules [] = $I->grabTextFrom(GeneralPage::modules($i));
        }


        /*  ПЕРЕВІРКА ЧИ НЕМАЄ СЕРЕД МОДУЛІВ МАГАЗИНУ НЕДОСТУПНИХ ДЛЯ ТАРИФУ */
        //вибрати заборонені модулі серед всіх присутніх в адмінці магазу
        $actual_forbidden = array_intersect($forbidden_modules, $actual_modules);

        //якшо масив не пустий то fail в фейлі вивести всі лишні модулі
        if (!empty($actual_forbidden)) {
            $error_message = "Forbidden modules present: \n";
            foreach ($actual_forbidden as $f_module) {
                $error_message .= "* --- " . $f_module . " ---\n";
            }
            $I->fail($error_message);
        }

        /* ПЕРЕВІРКА ЧИ ПРАЦЮЮТЬ ВСІ ДОСТУПНІ ДЛЯ ТАРИФУ МОДУЛІ */
        $I->click(GeneralPage::$Modules);
        foreach ($allowed_modules as $a_module) {
            $I->click(GeneralPage::$Modules);
            $I->see($a_module, 'li');
            $I->click($a_module);
            $I->waitForElement('span.title');
            $I->seeElement('span.title');
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

//        $I->cancelPopup();
        $I->wait(10);
        try {
            $I->acceptPopup();
        } catch (Exception $exc) {
            
        }
    }

}
