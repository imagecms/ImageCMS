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

    private static $titles = [  "name","url","prc",
                                "oldprc","stk","num",
                                "var","act","hit",
                                "brd","cat","relp",
                                "vimg","cur","imgs",
                                "shdesc","desc","mett",
                                "metd","metk"];
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
    protected static function formCSV($assoc_arrays_csv) {

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
        return $csv_rows;
    }
    
    
    /**
     * form csv from data and save to csv file
     * @param type $filename
     * @param type $data
     */
    public static function createCSV($filename,$data) {
        $csv = self::formCSV($data);
        file_put_contents($filename, $csv);
    }
    
    /**
     * Form data for creating scvfile
     * @param string $name
     * @param string $url
     * @param string $price
     * @param string $oldPrice
     * @param string $amount
     * @param string $article
     * @param string $variantName
     * @param string $active
     * @param string $hit
     * @param string $brand
     * @param string $category
     * @param string $relatedProducts
     * @param string $mainImage
     * @param string $currency
     * @param string $additionalImage
     * @param string $shortDescription
     * @param string $fullDescription
     * @param string $metaTitle
     * @param string $metaDescription
     * @param string $metaKeywords
     * @return array
     */
    public static function formData($name = null,$url = null,$price = null,
            $oldPrice = null,$amount = null,$article = null,
            $variantName = null,$active = null,$hit = null,
            $brand = null,$category = null,$relatedProducts = null,
            $mainImage = null,$currency = null,$additionalImage = null,
            $shortDescription = null,$fullDescription = null,$metaTitle = null,
            $metaDescription = null,$metaKeywords = null){
        $values = [ $name,$url,$price,
                    $oldPrice,$amount,$article,
                    $variantName,$active,$hit,
                    $brand,$category,$relatedProducts,
                    $mainImage,$currency,$additionalImage,
                    $shortDescription,$fullDescription,$metaTitle,
                    $metaDescription,$metaKeywords];
                $result = array_combine(self::$titles, $values);
        foreach ($result as $key => $value) {
            if ($value === NULL) {
                unset($result[$key]);
            }
        }
        return $result;
    }

    /**
     * create default csv file for testing import 
     * @param type $filename
     * @return type
     */
    
//    public static function createCSVForTest($filename){
//        $array_keys = self::$titles;
//        $array_values = [
//            "ТоварИмпорт","tovarimport","100.50000",
//            "200.00","10","200113",
//            "ТоварИмпортВариант","1","1",
//            "Apple","КатегорияИмпорт/ПодКатегорияИмпорт","17199",
//            "4013fae3c7538d3ba2714187e19dda61.jpg","1","","Краткое описание",
//        "Полное описание","tovarmetatitle","tovarmetadescription","tovarmetakeywords"];
//        $array_csv = array_combine($array_keys, $array_values);
//        self::createCSv([$array_csv], $filename);
//        return $array_csv;
//    }

}