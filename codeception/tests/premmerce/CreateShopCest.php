<?php

use \PremmerceTester;
/**
 * - встановити в codeception.yml адрес premmerce(на сервері)
 * - створитив папці тесту(або codecept_root_dir()) config.php Файл з даними реєстрації (на сервері) 
 * 
 * - запустити тест
 * - створити магазин використовуючи ці дані(в тесті) 
 * - змінити адресу магаза в codeception.yml
 * - запустити всі інші тести (окремий запуск для врахування змін в налаштуваннях)
 */
class CreateShopCest {
    
    private $CodeceptionYml;

    /**
     * 
     * @guy PremmerceTester\PremmerceSteps
     */
    public function createShop(PremmerceTester\PremmerceSteps $I) {
        $I->amOnPage('/');
        $I->createStore(STORE_NAME, USER_EMAIL, USER_PASSWORD);
        
        $this->_getCodeceptionYml();
        $this->_changeAdress(STORE_URL);
    }        


    /***************************************************************************
     ****************************PROTECTED**************************************
     **************************************************************************/
    protected function _getCodeceptionYml() {
        return $this->CodeceptionYml = file_get_contents(codecept_root_dir() . "codeception.yml");
    }
    protected function _changeAdress($adress) {
        $modified = preg_replace('~\surl:\s\'.*\'\s~', " url: '" . $adress . "'\n", $this->CodeceptionYml);
        return  file_put_contents(codecept_root_dir() . "codeception.yml", $modified);
    }
    protected function _restoreCodeceptionYml(){
        return file_put_contents(codecept_root_dir() . "codeception.yml", $this->CodeceptionYml);
    }
}
