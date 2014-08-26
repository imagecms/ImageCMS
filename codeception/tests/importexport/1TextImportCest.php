<?php
use \ImportExportTester;
class TextImportCest

{
    
//---------------------------AUTORIZATION--------------------------------------- 
    /**
     * @group a
     */
    public function Login(ImportExportTester $I){
        InitTest::Login($I);
    }
    
    
//-----------------------------------------------------------
    
    /**
     * @group a
     */
    public function  WayImport (ImportExportTester $I){
        $I->click(NavigationBarPage::$Settings);
        $I->click(NavigationBarPage::$SettingsImportExport);
        $I->seeInCurrentUrl(ImportPage::$IMPURL);
    }
    
    
    /**
     * @group a
     */
    public function VerifyTextImpotrPage (ImportExportTester $I){
        $I->amOnPage(ImportPage::$IMPURL);
        $I->see('Импорт', ImportPage::$IMPButtonImport);
        $I->see('Импорт-Экспорт CSV/XLS', ImportPage::$IMPTitle);
        $I->see('Импорт', '//section/div[2]/div[2]/div[1]/table/thead/tr/th');
        $I->see('Выберите файл');
        $I->see('Файлы', '//table/tbody/tr/td/div/form/div/div[1]/span');
        $I->see('CSV/XLS/XLSX File slot #1', '//tbody/tr/td/div/form/div/div[1]/div/label/span');
        $I->see('CSV/XLS/XLSX File slot #2', '//tbody/tr/td/div/form/div/div[2]/div/label/span');
        $I->see('CSV/XLS/XLSX File slot #3', '//tbody/tr/td/div/form/div/div[3]/div/label/span');
        $I->see('Сделать снимок базы данных перед запуском', '//table/tbody/tr/td/div/form/div/span[1]/label/span');
        $I->see('Начать ресайз изображений после импорта', '//table/tbody/tr/td/div/form/div/span[2]/label/span');
        $I->see('Обновить цены после импорта', '//table/tbody/tr/td/div/form/div/span[3]/label/span');
    }
    
    
    /**
     * @group a
     */
    public function Ds (ImportExportTester $I){
        $I->amOnPage(ImportPage::$IMPURL);
        $I->click(ImportPage::$IMPInfoFile);
        $I->see('CSV/XLS/XLSX', ImportPage::$IMPInfoPopoverTitle);
        $I->see('Выберите файл в удобном формате', ImportPage::$IMPInfoPopoverContent);
        
        
    }
    /**
     * @group a
     */
    public function Dss (ImportExportTester $I){
        $I->amOnPage(ImportPage::$IMPURL);
        $I->click(ImportPage::$IMPInfoBD);
        $I->see('Backup', ImportPage::$IMPInfoPopoverTitle);
        $I->see('Данные вашей базы данных будут храниться в папке', ImportPage::$IMPInfoPopoverContent);
        
        
    }
    /**
     * @group a
     */
    public function Dse (ImportExportTester $I){
        $I->amOnPage(ImportPage::$IMPURL);
        $I->click(ImportPage::$IMPInfoImg);
        $I->see('Ресайз', ImportPage::$IMPInfoPopoverTitle);
        $I->see('Для импортированных изображений будет произведен ресайз', ImportPage::$IMPInfoPopoverContent);
        
        
        
        
    }
    /**
     * @group a
     */
    public function Dsd (ImportExportTester $I){
        $I->amOnPage(ImportPage::$IMPURL);
        $I->click(ImportPage::$IMPInfoPrice);
        $I->see('Проверка цен', ImportPage::$IMPInfoPopoverTitle);
        $I->see('Будут пересчитаны цены на продукцию в соответствии с валютой по умолчанию', ImportPage::$IMPInfoPopoverContent);
        
        
    }
    
            
            
    /**
     * @group a
     */
    public function Dsiid (ImportExportTester $I){
        $I->amOnPage(ImportPage::$IMPURL);
        $I->click(ImportPage::$IMPButtonStartImport);
        $I->waitForElement('.alert.in.fade.alert-success');
        $I->see('Не загружен файл. Слот пуст Подробнее', '.alert.in.fade.alert-success');        
    }
    
    
    
    
    /**
     * @group a
     */
    public function Dsyyy (ImportExportTester $I){
        $I->amOnPage(ImportPage::$IMPURL);
        $I->click(ImportPage::$IMPButtonSlot2);
        $I->seeCheckboxIsChecked('//tbody/tr/td/div/form/div/div[2]/div/label/input');
    }
    
    
    
    
    /**
     * @group a
     */
    public function Dsyyyppp (ImportExportTester $I){
        $I->amOnPage(ImportPage::$IMPURL);
        $I->click(ImportPage::$IMPButtonSlot3);
        $I->seeCheckboxIsChecked('//tbody/tr/td/div/form/div/div[3]/div/label/input');
    }
    
    
    
    
    /**
     * @group a
     */
    public function Dsyyyooo (ImportExportTester $I){
        $I->amOnPage(ImportPage::$IMPURL);
        $I->click(ImportPage::$IMPButtonSlot1);
        $I->seeCheckboxIsChecked('//tbody/tr/td/div/form/div/div[1]/div/label/input');
    }
    
    
    
    /**
     * @group a
     */
    public function Dsyypp65 (ImportExportTester $I){
        $I->amOnPage(ImportPage::$IMPURL);
        $I->click(ImportPage::$IMPChekBoxBD);
        $I->seeCheckboxIsChecked(ImportPage::$IMPChekBoxBD);
    }
    
    
    
    /**
     * @group a
     */
    public function Dsyypp87 (ImportExportTester $I){
        $I->amOnPage(ImportPage::$IMPURL);
        $I->click(ImportPage::$IMPChekBoxImg);
        $I->seeCheckboxIsChecked(ImportPage::$IMPChekBoxImg);
    }
    
    
    
    /**
     * @group a
     */
    public function Dsyypp98 (ImportExportTester $I){
        $I->amOnPage(ImportPage::$IMPURL);
        $I->click(ImportPage::$IMPChekBoxPrice);
        $I->seeCheckboxIsChecked(ImportPage::$IMPChekBoxPrice);
    }
    
    


    
    /**
     * @group a
     */
    public function ICMS1521 (ImportExportTester $I){
        $I->amOnPage(ImportPage::$IMPURL);
        $I->click(ImportPage::$IMPButtonStartImport);
        $I->waitForElement('.alert.in.fade.alert-success');
        $I->click('//body/div[1]/div[2]/div/a[2]');
//        $I->amOnPage('http://docs.imagecms.net/administrirovanie-imagecms-shop/nastroiki/import-eksport');
        $I->wait('3');
        $I->see('Импорт-Экспорт CSV/XLS', '//body/div[1]/div[2]/div/div[2]/div/div/div/div/div/h1');
    }
    
    
    
    
    
    
}
