<?php
use \ImportExportTester;
class TextExportCest

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
    public function  WayExport (ImportExportTester $I){
        $I->wantTo('Verify Way ToExport Page');
        $I->click(NavigationBarPage::$Settings);
        $I->click(NavigationBarPage::$SettingsImportExport);
        $I->wait('1');
        $I->click(ExportPage::$ExpButtonExport);
        $I->seeInCurrentUrl('/admin/components/run/shop/system/import#exportcsv');
    }
    
    
    
    
    /**
     * @group a
     */
    public function  TextExport (ImportExportTester $I){
        $I->wantTo('Verify Text Present On Export Page.');
        $I->amOnPage(ExportPage::$ExpURL);
        $I->waitForElement(ExportPage::$ExpButtonExport);
        $I->see('Экспорт', ExportPage::$ExpButtonExport);
        $I->click(ExportPage::$ExpButtonExport);
        $I->see('Колонки', '//tbody/tr/td/form/div/label');
        $I->see('Категории', '//tbody/tr/td/form/div/div[2]/label');
        $I->see('Свойства продуктов:', '//tbody/tr/td/form/div/div[2]/div[2]/label');
        $I->see('Выберите категорию для экспорта', '//tbody/tr/td/form/div/div[2]/div[2]/div/p');
        $I->see('Тип файла', '//table/tbody/tr/td/form/div/div[3]/label');
        $I->see('CSV', '//tbody/tr/td/form/div/div[3]/div/span[1]');
        $I->see('XLSX', '//tbody/tr/td/form/div/div[3]/div/span[2]');
        $I->see('XLS', '//tbody/tr/td/form/div/div[3]/div/span[3]');
    }

}