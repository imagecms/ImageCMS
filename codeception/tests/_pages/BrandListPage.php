<?php

class BrandListPage

{
    
    public static $URL                      = "/admin/components/run/shop/brands"; 
    public static $Title                    = ".title";
   
    
    public static $ButtonCreate             = ".btn.btn-small.btn-success.pjax";
    public static $ButtonDelete             = "#del_sel_brand";

    public static $HeadCheck                = "//table/thead/tr[1]/th[1]/span/span";
    public static $HeadIDText               = "//table/thead/tr[1]/th[2]";
    public static $HeadBrandText            = "//table/thead/tr[1]/th[3]";
    public static $HeadURLText              = "//table/thead/tr[1]/th[4]";
    
    public static $InputID                  = "//table/thead/tr[2]/td[2]/input";
    public static $InputBrand               = "//table/thead/tr[2]/td[3]/input";
    
    public static function LineCheck($row)  { return "//tbody/tr[$row]/td[1]/span/span"; }
    public static function LineID($row)     { return "//tbody/tr[$row]/td[2]"; }
    public static function LineBrand($row)  { return "//tbody/tr[$row]/td[3]/a"; }
    public static function LineURL($row)    { return "//tbody/tr[$row]/td[4]/a"; }
    
    
    public static $WindowDelete             = ".modal.hide.fade.modal_del.in";
    public static $WindowDeleteTitle             = ".modal-header>h3";
    public static $WindowDeletequestion             = ".modal-body>p";
    public static $WindowDeleteButtonClose             = ".close";
    public static $WindowDeleteButtonDelet             = ".btn.btn-primary";
    public static $WindowDeleteButtonCancel             = "//div[5]/div[1]/div[3]/a[2]";
    
}

