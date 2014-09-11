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

    private static $titles = [  
        'name',
        'url',
        'prc',
        'oldprc',
        'stk',
        'num',
        'var',
        'act',
        'hit',
        'hot',
        'action',
        'brd',
        'cat',
        'relp',
        'vimg',
        'cur',
        'imgs',
        'shdesc',
        'desc',
        'mett',
        'metd',
        'metk'];
    
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
     * create csv  file from passed associative arrays
     * 
     * Example of passed array 
     * array(array('name'=>'tel',
     *              'price'=''100),
     *      array('name'=>'TV'
     *            'price'=>'200'
     * ))
     * array(array(option=>value,[...,option=>value]),[...,array()])
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
     * form data as ['column_name'=>'column_value'] for CSV transformation 
     * @param array $data
     * @return array
     */
    public static function formData($data){
         $default = [   
             'name'             => null,
             'url'              => null,
             'price'            => null,
             'oldPrice'         => null,
             'amount'           => null,
             'article'          => null,
             'variantName'      => null,
             'active'           => null,
             'hit'              => null,
             'hot'              => null,
             'action'           => null,
             'brand'            => null,
             'category'         => null,
             'elatedProducts'   => null,
             'mainImage'        => null,
             'currency'         => null,
             'additionalImage'  => null,
             'shortDescription' => null,
             'fullDescription'  => null,
             'metaTitle'        => null,
             'metaDescription'  => null,
             'metaKeywords'     => null
             ];
        $values = array_merge($default,$data);
        $result = array_combine(self::$titles, $values);
        foreach ($result as $key => $value) {
            if ($value === NULL) {
                unset($result[$key]);
            }
        }
        return $result;
   }
}