<?php

class ProductslistPage
{
    public static $URL = '/admin/components/run/shop/search/index';
    
     public static $Title = 'span.title';
    
    //--------------------------------------------------------------------------
    //--------------------------КНОПКИ------------------------------------------
     
    public static $ButtonCreate = '.btn.btn-small.btn-success.pjax';
    public static $ButtonDelete = '#del_in_search';
    
    public static $ButtonFilter             = '//div[@class="pull-right"]/div/button[1]';
    public static $ButtonCancelFiltration   = '//div[@class="pull-right"]/div/button[2]';
    public static $ButtonChangeStatus       = '//div[@class="pull-right"]/div/div';
    
    public static $ButtonChangeStatusActive = '//ul[@class="dropdown-menu"]/li[1]';
    public static $ButtonChangeStatusHit    = '//ul[@class="dropdown-menu"]/li[3]';
    public static $ButtonChangeStatusHot    = '//ul[@class="dropdown-menu"]/li[4]';
    public static $ButtonChangeStatusAction = '//ul[@class="dropdown-menu"]/li[5]';
    public static $ButtonChangeStatusCopy   = '//ul[@class="dropdown-menu"]/li[7]';
    public static $ButtonChangeStatusMove   = '//ul[@class="dropdown-menu"]/li[8]';
    
    
    //--------------------------------------------------------------------------
    //--------------------------ЗАГОЛОВКИ ТАБЛИЦІ-------------------------------
    //заголовки таблиці
    public static $HeadCheck        = '//section[@class="mini-layout"]/div[@class="row-fluid"]/table//th[1]/span/span';
    public static $HeadIDLink       = '//section[@class="mini-layout"]/div[@class="row-fluid"]/table//th[2]/span';
    public static $HeadProductLink  = '//section[@class="mini-layout"]/div[@class="row-fluid"]/table//th[3]/span';
    public static $HeadCategoryLink = '//section[@class="mini-layout"]/div[@class="row-fluid"]/table//th[4]/span';
    public static $HeadArticleLink  = '//section[@class="mini-layout"]/div[@class="row-fluid"]/table//th[5]/span';
    public static $HeadActiveLink   = '//section[@class="mini-layout"]/div[@class="row-fluid"]/table//th[6]/span';
    public static $HeadStatusText   = '//section[@class="mini-layout"]/div[@class="row-fluid"]/table//th[7]';
    public static $HeadPriceLink    = '//section[@class="mini-layout"]/div[@class="row-fluid"]/table//th[8]/span';
    
    //--------------------------------------------------------------------------
    //------------------------------ФІЛЬТР--------------------------------------
    public static $FilterIDInput             = 'input[name="filterID"]';
    public static $FilterProductInput        = 'input[name="text"]';
    public static $FilterCategorySelect      = 'div.chosen-container.chosen-container-single';
    public static $FilterCategorySelectInput = 'div.chosen-container.chosen-container-single input';
    public static $FilterArticleinput        = 'input[name="number"]';
    public static $FilterActiveSelect        = 'select[name="Active"]';
    public static $FilterStatusSelect        = 'select[name="s"]';
    public static $FilterPriceFrom           = 'input[name="min_price"]';
    public static $FilterPriceTo             = 'input[name="max_price"]';

    public static function filterCategorySelectOption($number)  { return "div.chosen-container.chosen-container-single li:nth-child($number)";}
    public static function filterActiveSelectOption($number)    { return "select[name='Active'] > option:nth-child($number)"; }
    public static function filterStatusSelectOption($number)    { return "select[name='s'] > option:nth-child($number)";}

    //--------------------------------------------------------------------------
    //----------------------------РЯДКИ ТАБЛИЦІ---------------------------------
    public static function lineCheck($row) { return ""; }
    public static function lineIDText($row) { return ""; }
    public static function lineProductLink($row) { return ""; }
    public static function lineCategoryLink($row) { return ""; }
    public static function lineArticleText($row) { return ""; }
    public static function lineActiveToggle($row) { return ""; }
    
    public static function lineStatusHit($row) { return ""; }
    public static function lineStatusHot($row) { return ""; }
    public static function lineStatusAction($row) { return ""; }
    
    public static function linePriceInput($row) { return ""; }
    public static function linePriceTextCurrency($row) { return ""; }
    
    //вікно видалення
    static $WindowDelete                = '';
    static $WindowDeleteTitle           = '';
    static $WindowDeleteQuestion        = '';
    static $WindowDeleteButtonDelete    = '';
    static $WindowDeleteButtonCancel    = '';
    static $WindowDeleteButtonClose     = '';

}