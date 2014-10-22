<?php

class PropertyListPage

{
    
    public static $URL                      = '/admin/components/run/shop/properties'; 
    public static $Title                    = '.title';
    
    
//    
//    public static $ButtonCreate              = '';
//    public static $ButtonDelete              = '';
//    public static $ButtonFilter              = '';
//    public static $ButtonCancelFilter        = '';
    
    
    public static $SelectCategory                   = '.catfilter';
    public static function SelectCategoryOption($number) {
        return "//section/div[1]/div[2]/div/div/select/option[$number]";
    }
    
    public static $SelectStatus                   = '.propFilterSelect';
    public static function SelectStatusOption($number) {
        return "//table/thead/tr[2]/td[5]/select/option[$number]";
    }
    
//    
//    public static $HeadCheck                   = '';
//    public static $HeadID                    = '';
//    public static $HeadProperty                    = '';
//    public static $HeadCSV                    = '';
//    public static $HeadStatuse                    = '';
//    
//    public static $InputID                    = '';
//    public static $InputProperty                    = '';
//    public static $InputCSV                    = '';
//    public static $                    = '';
//    public static $                    = '';
    
    
}

