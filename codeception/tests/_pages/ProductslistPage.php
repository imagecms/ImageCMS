<?php

class ProductslistPage
{
    public static $URL = '/admin/components/run/shop/search/index';
    
     public static $Title = 'span.title';
    
    //кнопки
    public static $ButtonCreate = '.btn.btn-small.btn-success.pjax';
    public static $ButtonDelete = '#del_in_search';
    
    public static $ButtonFilter             = '//div[@class="pull-right"]/div/button[1]';
    public static $ButtonCancelFiltration   = '//div[@class="pull-right"]/div/button[2]';
    public static $ButtonChangeStatus       = '//div[@class="pull-right"]/div/div';
    
    public static $ButtonChangeStatusActive = '';
    public static $ButtonChangeStatusHit    = '';
    public static $ButtonChangeStatusHot    = '';
    public static $ButtonChangeStatusAction = '';
    public static $ButtonChangeStatusCopy   = '';
    public static $ButtonChangeStatusMove   = '';
    
    
    //заголовки таблиці
    public static $HeadCheck        = '';
    public static $HeadIDLink       = '';
    public static $HeadProductLink  = '';
    public static $HeadCategoryLink = '';
    public static $HeadArticleLink  = '';
    public static $HeadActiveLink   = '';
    public static $HeadStatusLink   = '';
    public static $HeadPriceLink    = '';
    
    //Фільтр
    public static $FilterIDInput        = '';
    public static $FilterProductInput   = '';
    public static $FilterCategorySelect = '';
    public static $FilterArticleinput   = '';
    public static $FilterActiveSelect   = '';
    public static $FilterStatusSelect   = '';
    public static $FilterPriceFrom      = '';
    public static $FilterPriceTo        = '';


    //рядки таблиці
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