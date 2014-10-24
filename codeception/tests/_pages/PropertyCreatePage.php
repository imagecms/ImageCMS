<?php

class PropertyCreatePage

{
    
    public static $URL                      = "/admin/components/run/shop/properties/create"; 
    public static $Title                    = ".title";
    
    
    
    public static $ButtonCreate             = ".btn.btn-small.btn-success.formSubmit";
    public static $ButtonCreateExit         = "//section/div/div[2]/div/button[2]";
    public static $ButtonBack               = "//section/div/div[2]/div/a";


     public static $BlockPropertyTitle      = "//form/div/div/table/thead/tr/th";
    
    
    
    
    public static $InputName                = "input[name='Name']";
    public static $InputNameLabel           = "//tbody/tr/td/div/div[2]/label";
    public static $InputCSV                 = "input[name='CsvName']";
    public static $InputCSVLabel            = "//tbody/tr/td/div/div[2]/label";
    public static $InputFAQ                 = "//tbody/tr/td/div/div[11]/div/textarea";
    public static $InputFAQLabel            = "//tbody/tr/td/div/div[11]/label";
    public static $InputValues              = "//tbody/tr/td/div/div[12]/div/textarea";
    public static $InputValuesLabel         = "//tbody/tr/td/div/div[12]/label";
    
    
    public static $CheckActive                  = "//tbody/tr/td/div/div[3]/div[2]/span/span";
    public static $CheckMainProperty            = "//tbody/tr/td/div/div[4]/div[2]/span/span";
    public static $CheckHint                    = "//tbody/tr/td/div/div[5]/div[2]/span/span";
    public static $CheckShowProductPage         = "//tbody/tr/td/div/div[6]/div[2]/span/span";
    public static $CheckShowProductCompare      = "//tbody/tr/td/div/div[7]/div[2]/span/span";
    public static $CheckShowFilter              = "//tbody/tr/td/div/div[8]/div[2]/span/span";
    public static $CheckMultipleSelection       = "//tbody/tr/td/div/div[9]/div[2]/span/span";

    
    
    public static $SelectCategory                    = ".controls>select";
    
    public static function SelectCategoryOption($number)                     { return "//select/option[$number]"; }

    
}