<?php

use \ImportExportTester;

/**
 * імпортувати підготований CSV - Файл (_data(test.csv))
 * перевірити на сторінці товару
 * змінити 
 * експортувати
 * перевірити 
 * змінити
 * імпортувати 
 * перевірити
 * 
 */
class ImportExport {

    protected $category = 'ПодКатегорияИмпорт';

//---------------------------AUTORIZATION--------------------------------------- 
    /**
     * @group export
     * @group current
     */
    public function login(ImportExportTester $I) {
         InitTest::Login($I);
    }

    /**
     * @group current
     */
    public function importCSV(ImportExportTester $I) {
        $I->amOnPage(ImportPage::$URL);
        $I->click(ImportPage::$ButtonSlot1);
        $I->wait(1);
        $I->attachFile(ImportPage::$InputSelectFile, 'test.csv');
        $I->click(ImportPage::$ButtonStartImport);
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

/**
     * @group a
     * @guy ImportExportTester\importexportSteps
     */
//    public function ExportProduct(ImportExportTester\importexportSteps $I) {
//        $I->amOnPage('http://cmsprem.loc/admin/components/init_window/import_export/getTpl/export');
//        $I->comment(CSV_OUTPUT_FILE);
//        $handle = fopen(CSV_OUTPUT_FILE, 'rb');
//        $csv = [];
//        while ($csv [] = fgetcsv($handle,0,';')){
//            
//        }
//        codecept_debug($csv);
//    }

    /**
     * @group a
     * @guy ImportExportTester\importexportSteps
     */
//    public function CreationOfTestDataExport(ImportExportTester\importexportSteps $I) {
//        $I->TextAreaActive($on = 'on');
//        $I->createCategoryProductForExport($createNameCategory = 'ПоВеРвАйЛеНс');
//        $I->CreateRelatedProduct($namePRD = 'ДддОооПпп777', $PricePRD = 1);
//        $I->CreateBrandForExport($nameBrand = 'СссУууПппЕееРрр444');
//        $I->CreateProperty($NameProperty = 'PppRrrOooPppEeeRrrTttYyy1', $CVS = 'ololo', $Category = 'ПоВеРвАйЛеНс', $Values1 = '0123456789', $Values2 = 'q', $Values3 = 'zxc 123 ZVC', $Values4 = 'Дюйм Мертовый');
//        $I->CreateProperty($NameProperty = 'ZuLusss2', $CVS = 'grabText', $Category = 'ПоВеРвАйЛеНс', $Values1 = '', $Values2 = '', $Values3 = '', $Values4 = '');
//        $I->CreateProperty($NameProperty = 'Terpincode', $CVS = 'xxxxxyyyyyxxxxx', $Category = 'ПоВеРвАйЛеНс', $Values1 = '1', $Values2 = 'q', $Values3 = '_', $Values4 = '');
//        $I->CreateProperty($NameProperty = 'Длина звука в абстрагированном помещении', $CVS = 'sounds', $Category = 'ПоВеРвАйЛеНс', $Values1 = '1 параметр', $Values2 = '2 дикий шок', $Values3 = '3 завороткишок', $Values4 = '');
//        $I->createProductForExport($nameProduct = 'Export Import Item', $priceProduct = 987, $categoryProduct = 'ПоВеРвАйЛеНс', $hit = 'on', $nameVariant = 'Vvva Rrr Iii Aaa Nnn TTt', $article = 'q2 w3 e4 r5 t6 y7', $amount = 69, $brand = 'СссУууПппЕееРрр444', $smallDescription = InitTest::$text250, $fullDescripton = InitTest::$textSymbols, $oldPrice = '111', $relatedProducts = 'ДддОооПпп777', $productURL = 'on', $metaTitle = 'Експортированный товар FOR testing', $metaDescription = 'Nouboody fun in solo ritchen Бютифул лайф И ВСЕ ДЕЛА плюс ненавижу Придурков Долбаних', $metaKeywords = 'export, import, слова, какребол, онли файтимс');
//        $I->SelectPropertyInProduct($NameProduct = 'Export Import Item', $Property1 = 'on', $Property2 = 'on', $Property3 = 'on', $Property4 = 'on');
//        $I->wait('1');
//    }
//        $file_content = file('C:/CVS/products.csv');
//        foreach ($file_content as $line){
//            strstr($line, 'Твр 123 for click butn');
//        }
//        unlink('C:/CVS/products.csv');

/**
 * 
 * 
 *     private function convertXLStoCSV($excel_file = '') {
        include './application/modules/shop/classes/PHPExcel.php';
        include './application/modules/shop/classes/PHPExcel/IOFactory.php';
        include './application/modules/shop/classes/PHPExcel/Writer/Excel2007.php';
        $objReader = PHPExcel_IOFactory::createReaderForFile($excel_file);
        $objReader->setReadDataOnly(true);
        $objPHPExcel = $objReader->load($excel_file);
        $sheetData = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);

        foreach ($sheetData as $i) {
            foreach ($i as $j) {
                $toPrint .= '"' . str_replace('"', '""', $j) . '";';
            }
            $toPrint = rtrim($toPrint, ';') . PHP_EOL;
        }
        $filename = $this->csvFileName;
        fopen(BACKUPFOLDER . $filename, 'w+');
        if (is_writable(BACKUPFOLDER . $filename)) {
            if (!$handle = fopen(BACKUPFOLDER . $filename, 'w+')) {
                echo json_encode(array('error' => \ImportCSV\Factor::ErrorFolderPermission));
                exit;
            }

            write_file(BACKUPFOLDER . $filename, $toPrint);

            fclose($handle);
        } else {
            showMessage(lang("The file {$filename} is not writable", 'admin'));
        }
    }
 *     /**
     * Saving csv-file
     * @return string filename
     *//*
    public function saveToCsvFile($pathToFile) {
        $path = $pathToFile . 'products.csv';
        $this->getDataCsv();
        $f = fopen($path, 'w+');
        $writeResult = fwrite($f, $this->resultString);
        fclose($f);
        return $writeResult == FALSE ? FALSE : basename($path);
    }

    /**
     * Saving excel-file
     * @param string $type format version (Excel2007|Excel5)
     * @return string filename
     */
/*
    public function saveToExcelFile($pathToFile, $type = "Excel5") {
        switch ($type) {
            case "Excel5":
                $path = $pathToFile . 'products.xls';
                break;
            case "Excel2007":
                $path = $pathToFile . 'products.xlsx';
                break;
            default:
                return FALSE;
        }

        $this->getDataArray(); // selecting data from DB (if not performed)
        $objPHPExcel = new PHPExcel();

        // formation of headlines (from keys of first product data)
        $someProductData = current($this->resultArray);
        $headerArray = array();
        $columnNumber = 0;
        foreach ($someProductData as $field => $junk) {
            if (FALSE == $abbr = $this->getAbbreviation($field)) {
                $this->addError("Error. Abbreviation not found.");
            }
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($columnNumber++, 1, $abbr);
        }

        $rowNumber = 2;
        foreach ($this->resultArray as $productData) {
            $columnNumber = 0;
            foreach ($productData as $value) {
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($columnNumber++, $rowNumber, $value);
            }
            $rowNumber++;
        }
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, $type);
        $objWriter->save($path);
        return basename($path);
    }
 */
