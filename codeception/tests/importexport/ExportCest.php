<?php

use \ImportExportTester;


/**
 * 
 * ЕКСПОРТ ПРАЦЮЄ ТІЛЬКИ В ХРОМІ !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
 * створити товар
 * створити аксесуар
 * створити категорію
 * створити 
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
     * @group current
     * @group export
     */
    public function login(ImportExportTester $I) {
        InitTest::Login($I);
        InitTest::changeTextAditorToNative($I);
    }

    /**
     * Install module importExport CSV
     * @group current
     * @group export
     */
    public function activateModule(ImportExportTester $I) {
        $I->amOnPage('/admin');
        $I->click(NavigationBarPage::$Modules);
        $I->click(NavigationBarPage::$ModulesAllModules);
        $I->waitForText('Все модули', null, '.title');
        $I->click('Установить модули');
        $rows = $I->grabCCSAmount($I, '#nimt tbody tr');
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
     * export file products.csv 
     * @group export
     */
    public function exportCSV(ImportExportTester $I) {
        include_once '_steps/CSV.php';
        $output_file = BROWSER_DOWNLOADS . '/' . 'products.csv';
        //if browser downloads directory contains file products.csv - unlink it
        if (file_exists($output_file)) {
            $I->comment("I unlink file products.csv");
            unlink($output_file);
        }


        $I->amOnPage(ExportPage::$Url);
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

        $array_csv = CSV::loadCSV(BROWSER_DOWNLOADS . 'products.csv');
        codecept_debug($array_csv);
    }

}
// include_once '_steps/CSV.php';
//         $array_csv = CSV::loadCSV('C:\Users\moff\Downloads\products.csv');
//        var_dump($array_csv);
