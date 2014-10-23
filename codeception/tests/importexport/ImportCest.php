<?php

use \ImportExportTester;

/**
 * активувати модуль CSV
 * 
 * сформувати csv - файл s і зберегти codecept_data_dir()
 * 
 * імпортувати підготований CSV - Файл (_data(test.csv))
 * 
 * перевірити на сторінці редагування товару всі імпортовані поля
 * 
 */
class ImportExport {
    protected $csvFileName = 'test.csv';
    private $data = [
                 'name'             => 'ТоварИмпортCSV',
                 'url'              => 'tovarimportcsvtest',
                 'price'            => '1080.50',
                 'oldPrice'         => '500',
                 'amount'           => '500',
                 'article'          => '2043113',
                 'variantName'      => 'ТоварИмпортTestВариант',
                 'active'           => 1,
                 'hit'              => 0,
                 'hot'              => 0,
                 'action'           => 0,
                 'brand'            => 'Apple',
                 'category'         => 'КАТЕГОРИЯ/КатегорияИмпорт/Подкатегория импорт',
                 'relatedProducts'  => null,
                 'mainImage'        => null,
                 'currency'         => 2,
                 'additionalImage'  => null,
                 'shortDescription' => 'Краткое описание',
                 'fullDescription'  => 'Полное описание',
                 'metaTitle'        => 'tovarmetatitle',
                 'metaDescription'  => 'tovarmetadescription',
                 'metaKeywords'     => 'tovarmetakeywords'
        ];
    
    /**
     * @group current
     * @group import
     */
    public function login(ImportExportTester $I) {
         InitTest::Login($I);
         InitTest::changeTextAditorToNative($I);
    }
    
    /**
     * Install module importExport CSV
     * @group current
     * @group import
     */
    public function activateModule(ImportExportTester $I) {
        $I->amOnPage('/admin');
        $I->click(NavigationBarPage::$Modules);
        $I->click(NavigationBarPage::$ModulesAllModules);
        $I->waitForText('Все модули', null, '.title');
        $I->click('Установить модули');
        $rows = $I->getAmount($I, '#nimt tbody tr');
        $present = false;
        for ($index = 1; $index <= $rows; $index++) {
            $module_name = $I->grabTextFrom("//table[@id ='nimt']/tbody/tr[$index]/td[1]");
            if(trim($module_name) == 'Module Import & Export'){
                $present = true;
                break;
            }
        }
        if($present){ 
            $I->comment('Not installed');
            $I->click("//table[@id ='nimt']/tbody/tr[$index]/td[4]/a");
            $I->wait(3);
        }
    }

    /**
     * Create csv file and save him to _data directory
     * @group current
     * @group import
     */
    public function createCSV(ImportExportTester $I){
        include_once '_steps/CSV.php';
        $I->comment('Create CSV file');
        $datadir = codecept_data_dir();
        $filename = $datadir.$this->csvFileName;
        $data = CSV::formData($this->data);
        CSV::createCSV($filename, [$data]);
    }
    
    /**
     * Import CSV file test.csv from _data directory
     * @group current
     * @group  import
     */
    public function importCSV(ImportExportTester $I) {
        $I->amOnPage(ImportPage::$URL);
        $I->click(ImportPage::$ButtonSlot1);
        $I->wait(1);
        $I->attachFile(ImportPage::$InputSelectFile, $this->csvFileName);
        $I->wait(3);
        $I->click(ImportPage::$ButtonStartImport);
        $I->wait(7);
    }
    
    /**
     * @group current
     */
    public function verifyExportedDataICMS1540(ImportExportTester $I) {
        $data = $this->data;
        $I->amOnPage(ProductListPage::$URL);
        $I->fillField(ProductListPage::$InputFilterProduct, $data['name']);
        $I->click(ProductListPage::$ButtonFilter);
        $I->waitForText($data['name']);
        $I->click($data['name']);
        $I->waitForText($data['name'],NULL, '.title');
        //verifying
        $I->seeInField(ProductEditPage::$InputProductName, $data['name']); 
        $I->seeInField(ProductEditPage::$InputProductVariantPrice, $data['price']); 
        $I->seeInField(ProductEditPage::$InputOldPrice, $data['oldPrice']);
        $I->seeInField(ProductEditPage::$InputProductVariantAmount, $data['amount']);
        $I->seeInField(ProductEditPage::$InputProductvariantArticle, $data['article']);
        $I->seeInField(ProductEditPage::$InputProductVariantName, $data['variantName']);
        
        //verify that product is active
        if($data['active'] == 1) { $active_class = 'prod-on_off ';}
        elseif ($data['active'] == 0) { $active_class  = 'prod-on_off disable_tovar'; }
        $I->assertEquals($I->grabAttributeFrom(ProductEditPage::$ButtonActive, 'class'),$active_class);
        unset($active_class);
        
        //verify that product is hit and thet button is anabled|disabled
        if      ( $data['hit'] == 1 && $data['active'] ==1) { $hit_class = 'btn btn-small  btn-primary active setHit';}
        elseif  ( $data['hit'] == 0 && $data['active'] ==1) { $hit_class = 'btn btn-small  setHit';}
        if      ( $data['hit'] == 1 && $data['active'] ==0) { $hit_class = 'btn btn-small disabled btn-primary active setHit';}
        elseif  ( $data['hit'] == 0 && $data['active'] ==0) { $hit_class = 'btn btn-small disabled setHit';}
        $I->assertEquals($I->grabAttributeFrom(ProductEditPage::$ButtonStatusHit, 'class'),$hit_class);
        //verify that product is hot and thet button is anabled|disabled
        if      ( $data['hot'] == 1 && $data['active'] ==1) { $hot_class = 'btn btn-small  btn-primary active setHot';}
        elseif  ( $data['hot'] == 0 && $data['active'] ==1) { $hot_class = 'btn btn-small  setHot';}
        if      ( $data['hot'] == 1 && $data['active'] ==0) { $hot_class = 'btn btn-small disabled btn-primary active setHot';}
        elseif  ( $data['hot'] == 0 && $data['active'] ==0) { $hot_class = 'btn btn-small disabled setHot';}
        $I->assertEquals($I->grabAttributeFrom(ProductEditPage::$ButtonStatusHot, 'class'),$hot_class);
        //verify that product is action and thet button is anabled|disabled
        if      ( $data['action'] == 1 && $data['active'] ==1) { $action_class = 'btn btn-small  btn-primary active setAction';}
        elseif  ( $data['action'] == 0 && $data['active'] ==1) { $action_class = 'btn btn-small  setAction';}
        if      ( $data['action'] == 1 && $data['active'] ==0) { $action_class = 'btn btn-small disabled btn-primary active setAction';}
        elseif  ( $data['action'] == 0 && $data['active'] ==0) { $action_class = 'btn btn-small disabled setAction';}
        $I->assertEquals($I->grabAttributeFrom(ProductEditPage::$ButtonStatusAction, 'class'),$action_class);
        
        $I->see($data['brand'], ProductEditPage::$SelectBrend);
        
        if(strstr($data['category'],'/') === false){
            $category = $data['category']; 
        }  else {
            $category = array_pop(explode('/', $data['category']));
        }
        $I->see($category,  ProductEditPage::$SelectCategory);

        if      ( $data['currency'] == 1) { $currency = 'USD'; }
        elseif  ( $data['currency'] == 2) { $currency = 'RUR'; }
        $I->see($currency,  ProductEditPage::$SelectProductVariantCurrency);
        
//        $I->seeInField(ProductEditPage::$TextareaShortDescription, $data['shortDescription']);        //----------------------bug
//        $I->seeInField(ProductEditPage::$TextareaFullDescription, $data['fullDescription']);          //----------------------bug

        //switch to Settings tab
        $I->click(ProductEditPage::$TabSettings);
        $I->seeInField(ProductEditPage::$SettingsInputdUrl, $data['url']);
        $I->seeInField(ProductEditPage::$SettingsInputMetaTitle, $data['metaTitle']);
        $I->seeInField(ProductEditPage::$SettingsInputMetaDescription, $data['metaDescription']);
        $I->seeInField(ProductEditPage::$SettingsInputMetaKeywords, $data['metaKeywords']);
    }
}
