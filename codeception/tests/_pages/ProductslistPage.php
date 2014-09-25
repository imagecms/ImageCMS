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
    //Тут не змінювати локатори, для правильного пошуку товарів з варіантами.
    //Для таких товарів створюється ще она таблиця в рядку і локатори
    //мають знаходити ці рядки на рівні з іншими і тільки один елемент
    public static function lineCheck($row)          { return "//div[@id='mainContent']//div/table/tbody/tr[$row]/td[1]//span[@class='frame_label']/span"; }
    public static function lineIDText($row)         { return "//div[@id='mainContent']//div/table/tbody/tr[$row]//td[2]//p"; }
    public static function lineProductLink($row)    { return "//div[@id='mainContent']//div/table/tbody/tr[$row]//td[3]/div/a"; }
    public static function lineCategoryLink($row)   { return "//div[@id='mainContent']//div/table/tbody/tr[$row]//td[4]/div/a"; }
    public static function lineArticleText($row)    { return "//div[@id='mainContent']//div/table/tbody/tr[$row]//td[5]/p"; }//відсутній в товарі з  варіантами
    public static function lineActiveToggle($row)   { return "//div[@id='mainContent']//div/table/tbody/tr[$row]//td[6]//span"; }
    
    public static function lineStatusHit($row)          { return "//div[@id='mainContent']//div/table/tbody/tr[$row]//td[7]/button[1]"; }
    public static function lineStatusHot($row)          { return "//div[@id='mainContent']//div/table/tbody/tr[$row]//td[7]/button[2]"; }
    public static function lineStatusAction($row)       { return "//div[@id='mainContent']//div/table/tbody/tr[$row]//td[7]/button[3]"; }
    
    public static function linePriceInput($row)         { return "//div[@id='mainContent']//div/table/tbody/tr[$row]//td[8]//input";    }
    public static function linePriceButtonUpdate($row)  { return "//div[@id='mainContent']//div/table/tbody/tr[$row]//td[8]//button";   }
    public static function linePriceTextCurrency($row)  { return "//div[@id='mainContent']//div/table/tbody/tr[$row]//td[8]//span";     }
    public static function linePriceLinkVariants($row)  { return "//div[@id='mainContent']//div/table/tbody/tr[$row]//td[8]//a";        }
    
    //--------------------------------------------------------------------------
    //----------------------------ВІКНО ВИДАЛЕННЯ-------------------------------
    public static $WindowDelete                = '.modal.hide.fade.modal_del.in';
    public static $WindowDeleteTitle           = '.modal.hide.fade.modal_del.in h3';
    public static $WindowDeleteQuestion        = '.modal.hide.fade.modal_del.in p';
    public static $WindowDeleteButtonDelete    = '.modal.hide.fade.modal_del.in .modal-footer a:nth-child(1)';
    public static $WindowDeleteButtonCancel    = '.modal.hide.fade.modal_del.in .modal-footer a:nth-child(2)';
    public static $WindowDeleteButtonClose     = '.modal.hide.fade.modal_del.in .close';
    
    //--------------------------------------------------------------------------
    //--------------------------------ПАГІНАЦІЯ---------------------------------
    public static $PaginationForvard;
    public static $PaginationBack;
    
    public static $PaginationStart;
    public static $PaginationEnd;
    
    public static $PaginationSelect;

}