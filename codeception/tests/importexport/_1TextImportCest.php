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
    public function  installationImportNew (ImportExportTester $I){
        $I->wantTo("Verify Way To Import New Page.");
        $I->click('//div[1]/div[3]/div/nav/ul/li[6]/a');
        $I->wait('1');
        $I->click('//div[1]/div[3]/div/nav/ul/li[6]/ul/li[15]/a');
        $I->wait('3');
        $I->click('//div/form/section/div[2]/div[1]/div[1]/a[2]');
        $I->wait('1');
        $I->click('//section/div[2]/div[2]/div[2]/div/table/tbody/tr[2]/td[1]/a');
    }
    
    
    /**
     * @group a
     */
    
    public function ActivationModuel(ImportExportTester $I) {
        $I->wantTo("Activation Moduel Import Export.");
        $I->click('//div[1]/div[3]/div/nav/ul/li[6]/a');
        $I->wait('1');
        $I->click('//div[1]/div[3]/div/nav/ul/li[6]/ul/li[15]/a');
        $I->wait('3');
        $I->click('//table/tbody/tr[2]/td[5]/div/span');
        $I->click('//table/tbody/tr[2]/td[6]/div/span');
        $I->click('//table/tbody/tr[2]/td[7]/div/span');
    }
    
    
    
    /**
     * @group a
     */
    
    public function PresentActivationModuel(ImportExportTester $I) {
        $I->wantTo("Present Activation Moduel.");
        $I->amOnPage('/admin/components/init_window/import_export');
        $I->wait('1');
        $I->see('Категории управления модулем', '//div[5]/div/section/div[1]/div[1]/span[2]');        
    }
    
    
    /**
     * @group a
     */
    
    public function LinkBack1Moduel(ImportExportTester $I) {
        $I->wantTo("Clicability Link Moduel.");
        $I->amOnPage('/admin/components/cp/import_export');
        $I->click('//div[5]/div/section/div[1]/div[2]/div/a');
        $I->wait('3');
        $I->see('Все модули', '//div[5]/div/form/section/div[1]/div[1]/span[2]');                
    }
    
    
    /**
     * @group a
     */
    
    public function LinkBack2Moduel(ImportExportTester $I) {
        $I->wantTo("Present Activation Moduel.");
        $I->amOnPage('/admin/components/cp/import_export');
        $I->wait('1');
        $I->click('//div[5]/div/section/div[1]/div[2]/div/a');
        $I->wait('3');
        $I->see('Все модули', '//div[5]/div/form/section/div[1]/div[1]/span[2]');                
    }
    
    
    
    /**
     * @group a
     */
    
    public function LinkBack3Moduel(ImportExportTester $I) {
        $I->wantTo("Present Activation Moduel.");
        $I->amOnPage('/admin/components/cp/import_export');
        $I->wait('1');
        $I->click('//div[1]/div[5]/div/section/div[2]/a[1]');
        $I->wait('1');
        $I->click('//div[1]/div[5]/section/div[1]/div[2]/div/div/a');
        $I->wait('1');
        $I->see('Категории управления модулем', '//div[1]/div[5]/div/section/div[1]/div[1]/span[2]');                
    }
    
    
    
    
    
    /**
     * @group a
     */
    
    public function LinkBack4Moduel(ImportExportTester $I) {
        $I->wantTo("Present Activation Moduel.");
        $I->amOnPage('/admin/components/cp/import_export');
        $I->wait('1');
        $I->click('//div[1]/div[5]/div/section/div[2]/a[2]');
        $I->wait('1');
        $I->click('//div[1]/div[5]/section/div[1]/div[2]/div/a/span[2]');
        $I->wait('1');
        $I->see('Категории управления модулем', '//div[1]/div[5]/div/section/div[1]/div[1]/span[2]');                
    }
    
    
    
    
    /**
     * @group aw
     */
    
    public function LinkBack5Moduel(ImportExportTester $I) {
        $I->wantTo("Present Activation Moduel.");
        $I->amOnPage('/admin/components/cp/import_export');
        $I->wait('1');
        $I->click('//div[1]/div[5]/div/section/div[2]/a[3]');
        $I->wait('1');
        $I->click('//div[1]/div[5]/section/div[1]/div[2]/div/a/span[2]');
        $I->wait('1');
        $I->see('Категории управления модулем', '//div[1]/div[5]/div/section/div[1]/div[1]/span[2]');                
    }
    
    
    /**
     * @group a
     */
    public function  WayImport (ImportExportTester $I){
        $I->wantTo("Verify Way To Import Page.");
        $I->click(NavigationBarPage::$Settings);
        $I->click(NavigationBarPage::$SettingsImportExport);
        $I->seeInCurrentUrl(ImportPage::$URL);
    }
    
    
    /**
     * @group a
     */
    public function VerifyTextImpotrPage (ImportExportTester $I){
        $I->wantTo('Verify Text On Import Page.');
        $I->amOnPage(ImportPage::$URL);
        $I->see('Импорт', ImportPage::$ButtonImport);
        $I->see('Импорт-Экспорт CSV/XLS', ImportPage::$Title);
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
    public function VerifyTipInformationFile (ImportExportTester $I){
        $I->amOnPage(ImportPage::$URL);
        $I->click(ImportPage::$InfoFile);
        $I->see('CSV/XLS/XLSX', ImportPage::$IMPInfoPopoverTitle);
        $I->see('Выберите файл в удобном формате', ImportPage::$IMPInfoPopoverContent);
        
        
    }
    /**
     * @group a
     */
    public function VerifyTipInformationBD (ImportExportTester $I){
        $I->amOnPage(ImportPage::$URL);
        $I->click(ImportPage::$InfoDB);
        $I->see('Backup', ImportPage::$IMPInfoPopoverTitle);
        $I->see('Данные вашей базы данных будут храниться в папке', ImportPage::$IMPInfoPopoverContent);
        
        
    }
    /**
     * @group a
     */
    public function VerifyTipInformationIMG (ImportExportTester $I){
        $I->amOnPage(ImportPage::$URL);
        $I->click(ImportPage::$InfoImg);
        $I->see('Ресайз', ImportPage::$IMPInfoPopoverTitle);
        $I->see('Для импортированных изображений будет произведен ресайз', ImportPage::$IMPInfoPopoverContent);
        
        
        
        
    }
    /**
     * @group a
     */
    public function VerifyTipInformationPrice (ImportExportTester $I){
        $I->amOnPage(ImportPage::$URL);
        $I->click(ImportPage::$InfoPrice);
        $I->see('Проверка цен', ImportPage::$IMPInfoPopoverTitle);
        $I->see('Будут пересчитаны цены на продукцию в соответствии с валютой по умолчанию', ImportPage::$IMPInfoPopoverContent);
        
        
    }
    
            
            
    /**
     * @group a
     */
    public function VerifyTipAlertMessage (ImportExportTester $I){
        $I->amOnPage(ImportPage::$URL);
        $I->click(ImportPage::$ButtonStartImport);
        $I->waitForElement('.alert.in.fade.alert-success');
        $I->see('Не загружен файл. Слот пуст Подробнее', '.alert.in.fade.alert-success');        
    }
    
    
    
    
    /**
     * @group a
     */
    public function VerifyClickSlot2 (ImportExportTester $I){
        $I->amOnPage(ImportPage::$URL);
        $I->click(ImportPage::$ButtonSlot2);
        $I->seeCheckboxIsChecked('//tbody/tr/td/div/form/div/div[2]/div/label/input');
    }
    
    
    
    
    /**
     * @group a
     */
    public function VerifyClickSlot3 (ImportExportTester $I){
        $I->amOnPage(ImportPage::$URL);
        $I->click(ImportPage::$ButtonSlot3);
        $I->seeCheckboxIsChecked('//tbody/tr/td/div/form/div/div[3]/div/label/input');
    }
    
    
    
    
    /**
     * @group a
     */
    public function VerifyClickSlot1 (ImportExportTester $I){
        $I->amOnPage(ImportPage::$URL);
        $I->click(ImportPage::$ButtonSlot1);
        $I->seeCheckboxIsChecked('//tbody/tr/td/div/form/div/div[1]/div/label/input');
    }
    
    
    
    /**
     * @group a
     */
    public function VerifyClickChekBoxBD (ImportExportTester $I){
        $I->amOnPage(ImportPage::$URL);
        $I->click(ImportPage::$ChekBoxBD);
        $I->seeCheckboxIsChecked(ImportPage::$ChekBoxBD);
    }
    
    
    
    /**
     * @group a
     */
    public function VerifyClickChekBoxIMG (ImportExportTester $I){
        $I->amOnPage(ImportPage::$URL);
        $I->click(ImportPage::$ChekBoxImg);
        $I->seeCheckboxIsChecked(ImportPage::$ChekBoxImg);
    }
    
    
    
    /**
     * @group a
     */
    public function VerifyClickChekBoxPrice (ImportExportTester $I){
        $I->amOnPage(ImportPage::$URL);
        $I->click(ImportPage::$ChekBoxPrice);
        $I->seeCheckboxIsChecked(ImportPage::$ChekBoxPrice);
    }
    
    


    
    /**
     * @group a
     */
    public function ICMS1521 (ImportExportTester $I){
        $I->wantTo('Verify Link Page Open');
        $I->amOnPage(ImportPage::$URL);
        $I->click(ImportPage::$ButtonStartImport);
        $I->waitForElement('.alert.in.fade.alert-success');
        $I->click('//body/div[1]/div[2]/div/a[2]');
//        $I->amOnPage('http://docs.imagecms.net/administrirovanie-imagecms-shop/nastroiki/import-eksport');
        $I->wait('3');
        $I->see('Импорт-Экспорт CSV/XLS', '//body/div[1]/div[2]/div/div[2]/div/div/div/div/div/h1');
    }
    
    
    
    
    
    
}
