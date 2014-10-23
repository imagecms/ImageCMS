<?php

use \ImportExportTester;


/**
 * 
 * ЕКСПОРТ ПРАЦЮЄ ТІЛЬКИ В ХРОМІ !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
 * створити категорію
 * створити товар
 * імпортувати цей товар в CSV файл
 * порівняти дані створеного товару з CSV файлом
 * 
 */
class ExportCest {
    private $data = [
                     'name'             => 'ТоварЕкспортCSV',
                     'url'              => 'tovarexportcsvtest',
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
                     'category'         => 'КатегорияЕкспорт',
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
     * @group export
     */
    public function login(ImportExportTester $I) {
        InitTest::Login($I);
    }
    /**
     * Install module importExport CSV
     * @group export
     */
    public function activateModuleChangeTextarea(ImportExportTester $I) {
        InitTest::changeTextAditorToNative($I);
        $I->amOnPage('/admin');
        $I->click(NavigationBarPage::$Modules);
        $I->click(NavigationBarPage::$ModulesAllModules);
        $I->waitForText('Все модули', null, '.title');
        $I->click('Установить модули');
        $rows = $I->getAmount($I, '#nimt tbody tr');
        $present = false;
        for ($index = 1; $index <= $rows; $index++) {
            $module_name = $I->grabTextFrom("//table[@id ='nimt']/tbody/tr[$index]/td[1]");
            if (trim($module_name) == 'Module Import & Export') {
                $present = true;
                break;
            }
        }
        if ($present) {
            $I->comment('Not installed');
            $I->click("//table[@id ='nimt']/tbody/tr[$index]/td[4]/a");
            $I->wait(3);
        }
    }
    
    
    /**
     * @group export
     * @guy ImportExportTester\ImportExportSteps
     */
    public function createCategory(ImportExportTester\ImportExportSteps $I) {
        $I->createCategory($this->data['category']);
        
    }

    /**
     * @group export
     * @guy ImportExportTester\ImportExportSteps
     */
    public function createProduct(ImportExportTester\ImportExportSteps $I) {
        $I->createProduct(  $this->data['name'],
                            $this->data['price'],
                            $this->data['active'],
                            $this->data['hit'], 
                            $this->data['hot'], 
                            $this->data['action'], 
                            $this->data['oldPrice'],
                            $this->data['variantName'], 
                            $this->data['currency'],
                            $this->data['article'],
                            $this->data['amount'], 
                            $this->data['brand'], 
                            $this->data['category'],
                            $this->data['shortDescription'],
                            $this->data['fullDescription'], 
                            $this->data['url'],
                            $this->data['metaTitle'], 
                            $this->data['metaDescription'], 
                            $this->data['metaKeywords']);
    }
    
    /**
     * export file products.csv 
     * @group export
     */
    public function exportCSV(ImportExportTester $I) {
        $output_file = BROWSER_DOWNLOADS . '/' . 'products.csv';
        //if browser downloads directory contains file products.csv - unlink it
        if (file_exists($output_file)) {
            unlink($output_file);
        }

        $I->wait(1);
        $I->amOnPage(ExportPage::$Url);
        $I->waitForElement(ExportPage::$SelectMenu);
        $I->click(ExportPage::$SelectMenu);

        //get pathes to all checkboxes and mark each if its's not checked
        $checkboxes = ExportPage::allCheckboxes();
        foreach ($checkboxes as $checkbox) {
            if ($I->grabAttributeFrom($checkbox . '/..', 'class') == 'frame_label no_connection eattrcol') {
                $I->click($checkbox);
            }
        }
        $category = $this->data['category'];
        $I->fillField(ExportPage::$SelectMenu, $category);
        $I->wait(3);
        $I->click("//li[contains(.,'$category')]");
        $I->wait(3);
        $I->click(ExportPage::$ButtonExport);
        $I->wait(5);
        if(file_exists($output_file)){
            $I->assertEquals(true, true, ' File products.csv downloaded to '. BROWSER_DOWNLOADS);
        }  else {
        $I->fail("* I couldn\'t see file products.csv in directory " . BROWSER_DOWNLOADS);    
        }

        
    }
    
    /**
     * Compare data from products.csv file and entered data
     * 
     * @group export
     * @group current
     */
    public function comparedata(ImportExportTester $I) {
        include_once '_steps/CSV.php';
        $products = CSV::loadCSV(BROWSER_DOWNLOADS . 'products.csv');
//        codecept_debug($products);
        $I->assertEquals($products[0]['name'], $this->data['name']);
        $I->assertEquals($products[0]['url'], $this->data['url']);
        $I->assertEquals($products[0]['prc'], $this->data['price']);
        $I->assertEquals($products[0]['oldprc'], $this->data['oldPrice']);
        $I->assertEquals($products[0]['stk'], $this->data['amount']);
        $I->assertEquals($products[0]['num'], $this->data['article']);
        $I->assertEquals($products[0]['var'], $this->data['variantName']);
        $I->assertEquals($products[0]['act'], $this->data['active']);
        $I->assertEquals($products[0]['hit'], $this->data['hit']);
        $I->assertEquals($products[0]['hot'], $this->data['hot']);
        $I->assertEquals($products[0]['action'], $this->data['action']);
        $I->assertEquals($products[0]['brd'], $this->data['brand']);
        $I->assertEquals($products[0]['cat'], $this->data['category']);
        $I->assertEquals($products[0]['relp'], $this->data['relatedProducts']);
        $I->assertEquals($products[0]['relp'], $this->data['relatedProducts']);
        $I->assertEquals($products[0]['vimg'], $this->data['mainImage']);
        $I->assertEquals($products[0]['cur'], $this->data['currency']);
        $I->assertEquals($products[0]['imgs'], $this->data['additionalImage']);
        $I->assertEquals($products[0]['shdesc'], $this->data['shortDescription']);
        $I->assertEquals($products[0]['desc'], $this->data['fullDescription']);
        $I->assertEquals($products[0]['mett'], $this->data['metaTitle']);
        $I->assertEquals($products[0]['metd'], $this->data['metaDescription']);
        $I->assertEquals($products[0]['metk'], $this->data['metaKeywords']);
    }

}
// include_once '_steps/CSV.php';
//         $array_csv = CSV::loadCSV('C:\Users\moff\Downloads\products.csv');
//        var_dump($array_csv);
