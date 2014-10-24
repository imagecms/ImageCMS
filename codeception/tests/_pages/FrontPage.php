<?php

class FrontPage

{
    // Dashboard Category
    
    public static function DashboardMainCategory($number) {
        return "//tbody/tr/td[$number]/div/div/a";
    }
    public static function DashboardSecondCategory($number) {
        return "//table/tbody/tr/td[$number]/div/div[2]/ul/li/a/span[2]";
    }
    public static function DashboardThirdCategory($number) {
        return "//tbody/tr/td[$number]/div/div[2]/ul/li/div/ul/li/a";
    }
    public static function CategoryPageCategoryList($number) {
        return "//div/div[2]/div/div[2]/nav/ul/li[$number]/a";
    }
    public static $CategoryTitle                = '//div/div[1]/div[1]/div/h1';
//    public static $                         = '';
//    public static $                         = '';
//    public static $                         = '';
//    public static $                         = '';
//    public static $                         = '';
    
    
    
    
    
    
}

