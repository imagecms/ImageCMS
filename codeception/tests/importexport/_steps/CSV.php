<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CSV
 *
 * @author moff
 */
class CSV {

    private $name; //ТоварИмпорт
    private $url; //tovarimport
    private $price; //100.50
    private $oldPrice; //200
    private $amount; //10
    private $article; //200113
    private $variantName; //ТоварИмпортВариант
    private $active; //on
    private $hit;
    private $brand; //Apple
    private $category; // ПодкатегорияИмпорт
    private $relatedProducts;  //СвязаныйТоварИмпорт
    private $mainImage;
    private $currency; //USD
    private $additionalImage;
    private $shortDescription; //Краткое описание
    private $fullDescription; //Полное описание
    private $metaTitle; //tovarmetatitle
    private $metaDescription; //tovarmetadescription
    private $metaKeywords; //tovarmetakeywords

    public static function loadCSV($path) {
        $path = 'C:\Users\moff\Downloads\products.csv';
        $handle = fopen($path, 'rb');
        if ($handle) {
            $csv = [];
            while (true) {
                $tmp = fgetcsv($handle, 0, ';');
                if ($tmp) {
                    $csv [] = $tmp;
                } else {
                    break;
                }
            }
            $keys = array_shift($csv);
            foreach ($csv as $value) {
                $csvs [] = array_combine($keys, $value);
            }
            return $csvs;
        }
    }
    public static function createCSv()
    {
        $csv = self::loadCSV(3);
        foreach ($csv as $value){
            foreach ($value as $val) {
                
            }
        }
        $handle = fopen('c:\file.csv', 'wb');
        fputcsv($handle, $csv[0],';','"');
        fputcsv($handle, $csv[1],';','"');
        fclose($handle);
        
    }

}

var_dump(CSV::loadCSV(3));
CSV::createCSv();