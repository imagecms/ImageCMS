<?php

class ProductsCreatePage
{
    public static $URL                      = '/admin/components/run/shop/products/create';
    
    //заголовки
    public static $Title                    = '.title';
    public static $TitleBlockSettings       = '//div[@class="form-horizontal"]/table/thead//th';

    //--------------------------------------------------------------------------
    //----------------------------КНОПКИ----------------------------------------
    public static $ButtonBack               = '.t-d_u';
    public static $ButtonCreate             = '//section[@class="mini-layout"]/div[1]/div[2]/div/button[1]';
    public static $ButtonCreateExit         = '//section[@class="mini-layout"]/div[1]/div[2]/div/button[2]';
    
    public static $ButtonHit                = '//div[@class="inside_padd"]/div[1]/div[2]//button[1]';
    public static $ButtonHot                = '//div[@class="inside_padd"]/div[1]/div[2]//button[2]';
    public static $ButtonAction             = '//div[@class="inside_padd"]/div[1]/div[2]//button[3]';
    
    public static $ButtonAddVariant         = '';
    
        //перемикач
        public static $ToggleActive     =  'span.prod-on_off' ;


        //таби
        public static $TabProduct   = '//div[@class="clearfix"]//a[1]';
        public static $TabSettings  = '//div[@class="clearfix"]//a[2]';
    
    
    
    
    //--------------------------------------------------------------------------
    //-------------------------ПОЛЯ ДЛЯ ВВОДУ-----------------------------------
    public static $InputName                = '#Name';
    public static $InputOldPrice            = '#oldP';
    public static $InputShortDescription    = '#ShortDescriptions';
    public static $InputFullDescription     = '#FullDescription';
    

    //--------------------------------------------------------------------------
    //---------------------ТАБЛИЦЯ ТОВАРУ---------------------------------------
   


    //--------------------------------------------------------------------------




    //лейбли
    public static $FieldStatusLabel                 = '//div[@class="inside_padd"]/div[1]/div[2]/label';
    
    public static $SelectBrandLabel                 = '';
    public static $SelectCategoryLabel              = '';
    public static $SelectAdditionalCategoryLabel    = '';

    
    //селекти
    public static $SelectBrand                        = '';
    public static $SelectBrandInput                   = '';
    public static function selectBrandOption($number) { return "//[$number]";}
    
    
    public static $SelectCategory                     = '';
    public static $SelectCategoryInput                = '';
    public static function selectCategoryOption($number) { return "//[$number]";}
    
    
    public static $SelectAdditionalCategory           = '';
    public static function selectAdditionalCategoryOption($number) { return "//[$number]";}
    public static $SelectAdditionalCategoryInput      = '';
}