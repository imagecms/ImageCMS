<?php

use \ImportExportTester;

class ExportCest {

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
     * read export 
     * @group export
     */
    public function exportCSV(ImportExportTester $I) {
        include_once '_steps/CSV.php';
        $output_file = BROWSER_DOWNLOADS . 'products.csv';
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

        $I->fillField(ExportPage::$SelectMenu, $this->category);
        $I->wait(3);
        $I->click("//li[contains(.,'$this->category')]");
        $I->wait(3);
        $I->click(ExportPage::$ButtonExport);
        $I->wait(5);


        $array_csv = CSV::loadCSV(BROWSER_DOWNLOADS . 'products.csv');
    }

}
