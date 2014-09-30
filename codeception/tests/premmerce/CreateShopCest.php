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




    public function getData(PremmerceTester $I) {
        $this->_getCodeceptionYml();
        $this->_getStoreData();
        
    }
    public function createShop(PremmerceTester $I) {
        $I->amOnPage('/');
        $I->fillField(CreateStorePage::$InputDomain,    $this->Data['domain']);
        $I->fillField(CreateStorePage::$InputEmail,     $this->Data['email']);
        $I->fillField(CreateStorePage::$InputPassword,  $this->Data['password']);
        $I->fillField(CreateStorePage::$InputName,      $this->Data['name']);
        $I->fillField(CreateStorePage::$InputPhone,     $this->Data['phone']);
        $I->fillField(CreateStorePage::$InputCity,      $this->Data['city']);
        
        //селекти
        $I->click(CreateStorePage::$SelectCategoryOfProducts);
        $I->click(CreateStorePage::selectCategoryOfProductsOption(11));
        $I->click(CreateStorePage::$SelectProducts);
        $I->click(CreateStorePage::selectProductsOption(3));
        $I->checkOption(CreateStorePage::$CheckAgree);
        $I->click(CreateStorePage::$ButtonCreate);
        $I->wait(100);
    }        


    /***************************************************************************
     ****************************PROTECTED**************************************
     **************************************************************************/
    protected function _getStoreData() {
        return $this->Data = json_decode(file_get_contents(codecept_root_dir().'tests/premmerce/ShopData.json'),TRUE);
    }
    protected function _restoreCodeceptionYml(){
        return file_put_contents(codecept_root_dir() . "codeception.yml", $this->CodeceptionYml);
    }
    protected function _getCodeceptionYml() {
        return file_get_contents(codecept_root_dir() . "codeception.yml");
    }
    protected function _changeAdress($adress) {
        $modified = preg_replace('~\surl:\s\'.*\'\s~', " url: '" . $adress . "' ", $this->CodeceptionYml);
        return  file_put_contents(codecept_root_dir() . "codeception.yml", $modified);
    }
}