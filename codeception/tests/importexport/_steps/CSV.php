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

    private static $titles = ["name",
        "url","prc","oldprc",
        "stk","num","var",
        "act","hit","brd",
        "cat","relp","vimg",
        "cur","imgs","shdesc",
        "desc","mett","metd","metk"];
//    private $name; //ТоварИмпорт
//    private $url; //tovarimport
//    private $price; //100.50
//    private $oldPrice; //200
//    private $amount; //10
//    private $article; //200113
//    private $variantName; //ТоварИмпортВариант
//    private $active; //on
//    private $hit;
//    private $brand; //Apple
//    private $category; // ПодкатегорияИмпорт
//    private $relatedProducts;  //СвязаныйТоварИмпорт
//    private $mainImage;
//    private $currency; //USD
//    private $additionalImage;
//    private $shortDescription; //Краткое описание
//    private $fullDescription; //Полное описание
//    private $metaTitle; //tovarmetatitle
//    private $metaDescription; //tovarmetadescription
//    private $metaKeywords; //tovarmetakeywords

    
    
    /**
     * 
     * @param string $filename output file
     * @return array products
     */
    public static function loadCSV($filename) {
//        $filename = 'C:\Users\moff\Downloads\products.csv';
        $handle = fopen($filename, 'rb');
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
                $array_csvs [] = array_combine($keys, $value);
            }
            return $array_csvs;
        }
    }
      

    /**
     * 
     * create csv  file from passed associative arrays
     * 
     * expample of passed array 
     * array(array('name'=>'tel',
     *              'price'=''100),
     *      array('name'=>'TV'
     *            'price'=>'200'
     * ))
     * array(array(option=>value,[...,option=>value]),[...,array()])
     * options=>values
     * 
     * 
     * @param array $assoc_arrays_csv array of assoc arrays
     * @param string $filename name of output file
     */
    public static function createCSv($assoc_arrays_csv,$filename) {

        //add titles to csv file
        $titles = array_keys($assoc_arrays_csv[0]);
        array_unshift($assoc_arrays_csv, $titles);

        foreach ($assoc_arrays_csv as $csv_key => $product) {
            foreach ($product as $key => $option) {
                $assoc_arrays_csv[$csv_key][$key] = '"' . trim($option) . '"';
            }
        }
        $csv_rows = '';
        foreach ($assoc_arrays_csv as $row) {
            $csv_rows .= implode(';', $row) . "\n";
        }
        file_put_contents($filename, $csv_rows);
    }
    
    /**
     * create default csv file for testing import 
     * @param type $filename
     * @return type
     */
    public static function createCSVForTest($filename){
        $array_keys = self::$titles;
        $array_values = [
            "ТоварИмпорт","tovarimport","100.50000",
            "200.00","10","200113",
            "ТоварИмпортВариант","1","1",
            "Apple","КатегорияИмпорт/ПодКатегорияИмпорт","17199",
            "4013fae3c7538d3ba2714187e19dda61.jpg","1","","Краткое описание",
        "Полное описание","tovarmetatitle","tovarmetadescription","tovarmetakeywords"];
        $array_csv = array_combine($array_keys, $array_values);
        self::createCSv([$array_csv], $filename);
        return $array_csv;
    }

}