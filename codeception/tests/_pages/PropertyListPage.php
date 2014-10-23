<?php

class PropertyListPage

{
    
    public static $URL                      = '/admin/components/run/shop/properties'; 
    public static $Title                    = '.title';
    
    
    
    public static $ButtonCreate             = '.btn.btn-small.btn-success.pjax';
    public static $ButtonDelete             = '#del_sel_property';
    public static $ButtonFilter             = '.btn.btn-small.action_on.listFilterSubmitButton';
    public static $ButtonCancelFilter       = '//section/div[1]/div[2]/div/button[2]';
    
    
    public static $SelectCategory           = '.catfilter';
    public static function SelectCategoryOption($number) {
        return "//section/div[1]/div[2]/div/div/select/option[$number]";
    }
    
    public static $SelectStatus             = '.propFilterSelect';
    public static function SelectStatusOption($number) {
        return "//table/thead/tr[2]/td[5]/select/option[$number]";
    }
    
    
    public static $HeadCheck                = '//table/thead/tr[1]/th[1]/span/span';
    public static $HeadID                   = '//table/thead/tr[1]/th[2]/span';
    public static $HeadProperty             = '//table/thead/tr[1]/th[3]/span';
    public static $HeadCSV                  = '//table/thead/tr[1]/th[4]/span';
    public static $HeadStatuse              = '//table/thead/tr[1]/th[5]/span';
    
    public static $InputID                  = '.number>div>input';
    public static $InputProperty            = ".head_body.properties_filter_inputs>td>input[name='Property']";
    public static $InputCSV                 = ".head_body.properties_filter_inputs>td>input[name='CSVName']";
            
    
    public static function LineCheck($row)                     { return "//tbody/tr[$row]/td[1]/span/span"; }
    public static function LineIDText($row)                    { return "//table/tbody/tr[$row]/td[2]"; }
    public static function LinePropertyLink($row)              { return "//table/tbody/tr[$row]/td[3]/a"; }
    public static function LineCSVText($row)                   { return "//table/tbody/tr[$row]/td[4]"; }
    public static function LineStatusToogle($row)              { return "//table/tbody/tr[$row]/td[5]/div/span"; }

    public static $WindowDelete                 = ".modal.hide.fade.modal_del.in";
    public static $WindowDeleteTitle            = ".modal-header>h3";
    public static $WindowDeletequestion         = ".modal-body>p";
    public static $WindowDeleteButtonClose      = ".close";
    public static $WindowDeleteButtonDelet      = ".btn.btn-primary";
    public static $WindowDeleteButtonCancel     = "//div[5]/div[1]/div[3]/a[2]";
    
}

