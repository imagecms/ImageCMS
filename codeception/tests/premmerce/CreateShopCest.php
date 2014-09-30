<?php

use \PremmerceTester;
/**
 * - встановити в codeception.yml адрес premmerce(на сервері)
 * - створитив папці тесту(або codecept_root_dir()) ShopData.json Файл з даними реєстрації (на сервері) 
 * 
 * - запустити тест
 * - зчитати дані(в тесті)
 * - створити магазин використовуючи ці дані(в тесті) 
 * - змінити адресу магаза в codeception.yml і логін пароль в InitTest(в тесті або на сервері)
 * - запустити всі інші тести (окремий запуск для врахування змін в налаштуваннях)
 */
class CreateShopCest {
    
    private $CodeceptionYml;
    private $Data;


    public function createShop(PremmerceTester $I) {
        $I->amOnPage('/');
        $I->fillField(CreateStorePage::$InputDomain,    STORE_NAME);
        $I->fillField(CreateStorePage::$InputEmail,     USER_EMAIL);
        $I->fillField(CreateStorePage::$InputPassword,  USER_PASSWORD);
        $I->fillField(CreateStorePage::$InputName,      'CI-server');
        $I->fillField(CreateStorePage::$InputPhone,     '800800');
        $I->fillField(CreateStorePage::$InputCity,      'Lviv');
        
        //селекти
        $I->click(CreateStorePage::$SelectCategoryOfProducts);
        $I->click(CreateStorePage::selectCategoryOfProductsOption(11));
        $I->click(CreateStorePage::$SelectProducts);
        $I->click(CreateStorePage::selectProductsOption(3));
        $I->checkOption(CreateStorePage::$CheckAgree);
        $I->click(CreateStorePage::$ButtonCreate);
        $I->wait(5);
//        $this->_getCodeceptionYml();
//        $this->_changeAdress(STORE_URL);
    }        


    /***************************************************************************
     ****************************PROTECTED**************************************
     **************************************************************************/
    protected function _getCodeceptionYml() {
        return $this->CodeceptionYml = file_get_contents(codecept_root_dir() . "codeception.yml");
    }
    protected function _changeAdress($adress) {
        $modified = preg_replace('~\surl:\s\'.*\'\s~', " url: '" . $adress . "' ", $this->CodeceptionYml);
        return  file_put_contents(codecept_root_dir() . "codeception.yml", $modified);
    }
    protected function _restoreCodeceptionYml(){
        return file_put_contents(codecept_root_dir() . "codeception.yml", $this->CodeceptionYml);
    }
}
