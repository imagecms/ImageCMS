<?php

class ProductCategoryCreatePage
{
    // include url of current page
    public static $URL = '/admin/components/run/shop/categories/create';

    //заголовки
    public static $Title                    = '.title';
    public static $TitleBlockInformation    = '//section[@class="mini-layout"]//table[1]//th';
    public static $TitleBlockSettings       = '//section[@class="mini-layout"]//table[2]//th';
    public static $TitleBlockMetaData       = '//section[@class="mini-layout"]//table[3]//th';

    //кнопки
    public static $ButtonBack               = '.t-d_u';
    public static $ButtonCreate             = '//section[@class="mini-layout"]/div[1]/div[2]/div/button[1]';
    public static $ButtonCreateExit         = '//section[@class="mini-layout"]/div[1]/div[2]/div/button[2]';
    
    //поля для вводу
    public static $Input                    = '';

    //чекбокси
    public static $Check                    = '';
    
    //текст
    public static $Text                     = '';
    
    //лейбли
    public static $ElementNameLabel         = '';

    //таби
    public static $Tab                      = '';
    
    //селекти
    public static $Select                   = '';
    
    //опції
    public static function selectNameOption($number) { return "//[$number]";}

}