<?php

class ProductCategoryListPage
{

    public static $URL = 'admin/components/run/shop/categories/index';
    public static $Title = 'span.title';
    
    //кнопки
    public static $ButtonCreate = '.btn.btn-small.btn-success.pjax';
    public static $ButtonDelete = '#del_sel_cat';
    
    //заголовки таблиці
    public static $HeadCheck        = '//div[@id="category"]/div[1]/div[1]/span/span';
    public static $HeadIDText       = '//div[@id="category"]/div[1]/div[2]';
    public static $HeadNameText     = '//div[@id="category"]/div[1]/div[3]';
    public static $HeadURLText      = '//div[@id="category"]/div[1]/div[4]';
    public static $HeadAmountText   = '//div[@id="category"]/div[1]/div[5]';
    public static $HeadActiveText   = '//div[@id="category"]/div[1]/div[6]';
    
    //рядки таблиці
    public static function lineCheck($row)              { return "//div[@id='category']/div[2]/div/div[$row]/div[@class='row-category']/div[1]/span/span"; }
    public static function lineIDText($row)             { return "//div[@id='category']/div[2]/div/div[$row]/div[@class='row-category']/div[2]/p"; }
    
    public static function lineNameLink($row)           { return "//div[@id='category']/div[2]/div/div[$row]/div[@class='row-category']/div[3]/div/a"; }
    public static function lineNameButtonGoToSite($row) { return "//div[@id='category']/div[2]/div/div[$row]/div[@class='row-category']/div[3]/a"; }
    public static function lineNameButtonExpand($row)   { return "//div[@id='category']/div[2]/div/div[$row]/div[@class='row-category']/div[3]/div/button[2]"; }
    public static function lineNameButtonCollapse($row) { return "//div[@id='category']/div[2]/div/div[$row]/div[@class='row-category']/div[3]/div/button[1]"; }
    
    public static function lineUrlLink($row)            { return "//div[@id='category']/div[2]/div/div[$row]/div[@class='row-category']/div[4]//a"; }
    public static function lineAmountText($row)         { return "//div[@id='category']/div[2]/div/div[$row]/div[@class='row-category']/div[5]/p"; }
    public static function lineActiveToggle($row)       { return "//div[@id='category']/div[2]/div/div[$row]/div[@class='row-category']/div[6]//span"; }
    
    //--------------------------------------------------------------------------
    //----------------------------ПІДКАТЕГОРІЇ----------------------------------
    //параметр level(масив) передавати як [
    //                                      порядковий номер основної категорії,
    //                                      порядковий номер підкатегорії,
    //                                      [,порядковий номер підкатегорії ...]
    //                                    ] 
    //EXP:
    //ProductCategoryListPage::_subLineActiveToggle([1,2,3,1]);
    //
    //--------------------------------------------------------------------------
    public static function subLineCheck($level)              { return self::_subCategoryLocator($level) . "/div[1]/span/span"; }
    public static function subLineIDText($level)             { return self::_subCategoryLocator($level) . "/div[2]/p"; }
    
    public static function subLineNameLink($level)           { return self::_subCategoryLocator($level) . "/div[3]/div/a"; }
    public static function subLineNameButtonGoToSite($level) { return self::_subCategoryLocator($level) . "/div[3]/a"; }
    public static function subLineNameButtonExpand($level)   { return self::_subCategoryLocator($level) . "/div[3]/div/button[2]"; }
    public static function subLineNameButtonCollapse($level) { return self::_subCategoryLocator($level) . "/div[3]/div/button[1]"; }
    
    public static function subLineUrlLink($level)            { return self::_subCategoryLocator($level) . "/div[4]//a"; }
    public static function subLineAmountText($level)         { return self::_subCategoryLocator($level) . "/div[5]/p"; }
    public static function subLineActiveToggle($level)       { return self::_subCategoryLocator($level) . "/div[6]//span"; }
    




    //вікно видалення
    static $WindowDelete                = '.modal.hide.fade.in';
    static $WindowDeleteTitle           = '.modal.hide.fade.in .modal-header >h3';
    static $WindowDeleteButtonClose     = '.modal.hide.fade.in .modal-header >button';
    static $WindowDeleteQuestion        = '.modal.hide.fade.in .modal-body > p:nth-child(1)';
    static $WindowDeleteWarning         = '.modal.hide.fade.in .modal-body > p:nth-child(2)';
    static $WindowDeleteButtonDelete    = '.modal.hide.fade.in .modal-footer a:nth-child(1)';
    static $WindowDeleteButtonCancel    = '.modal.hide.fade.in .modal-footer a:nth-child(2)';
    
    
    
    
    //--------------------------------------------------------------------------
    //-----------------------ПОШУК ПІДКАТЕГОРІЇ---------------------------------
    //mainCategory(рядок)   повертає локатор базової категорія    
    //subLevel повертає     локатор підкатегорії         
    //subCategoryLocator    об'єднує локатори                     
    //                      
    //categories                    div[@class='row-category']
    //wraper for subcategories      div[@class='frame_level sortable ui-sortable']
    //
    //                      ТУТ НІЧОГО НЕ ЗМІНЮВАТИ
    //--------------------------------------------------------------------------
    
    /**
     * Main category locator
     * Returns locator of basic category
     * 
     * @param int|string $main_category_row
     * @return string
     */
    private static function _mainCategory($main_category_row){
        return "//div[@id='category']/div[2]/div/div[$main_category_row]/div[@class='row-category']";
    }
    
    /**
     * Sub category locator
     * Returns sublevel category locator
     * 
     * @param int|string $sub_category_row
     * @return string
     */
    private static function _subLevel($sub_category_row){
        return "/following-sibling::div/div[$sub_category_row]/div[@class='row-category']";
    }

    /**
     * Full locator
     * returns full Xpath locator of Subcategory in passed level
     * 
     * @param array $level
     * @return string
     */
    private static function _subCategoryLocator($level=[]){
        $main_category_row = array_shift($level);
        $path = self::_mainCategory($main_category_row);
        foreach ($level as $sub_category_row) {
            $path .=self::_subLevel($sub_category_row);
        }
        return $path;
    }
}

echo ProductCategoryListPage::subLineActiveToggle([1]);