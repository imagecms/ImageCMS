<?php

class CreateStorePage
{
    //кнопки
    public static $ButtonCreate         = '.btn-create-shop2>button';
    
    //лінки
    public static $LinkWorkConditions   = '.ref.isDrop';

    //інпути
    public static $InputDomain      = '[name="domain"]';
    public static $InputEmail       = '[name="email"]';
    public static $InputPassword    = '[name="password"]';
    public static $InputName        = '[name="username"]';
    public static $InputPhone       = '[name="phone"]';
    public static $InputCity        = '[name="city"]';
    
    //чекбокси
    public static $CheckAgree       = '#agreeLicense';
    
    //селекти
    public static $SelectCountry            = '#cuselFrame-id1';
    public static $SelectCategoryOfProducts = '#cuselFrame-id2';
    public static $SelectProducts           = '#cuselFrame-id3';
    
    //варіанти
    public static function selectCountryOption($number)              { return "#cusel-scroll-id1>span:nth-child($number)";}
    public static function selectCategoryOfProductsOption($number)   { return "#cusel-scroll-id2>span:nth-child($number)";}
    public static function selectProductsOption($number)             { return "#cusel-scroll-id3>span:nth-child($number)";}
}