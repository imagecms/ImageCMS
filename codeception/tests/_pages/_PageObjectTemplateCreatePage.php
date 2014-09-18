<?php

class PageObjectTemplateCreatePage
{
    public static $URL                      = '';
    public static $Title                    = '.title';
    
    //заголовки
    public static $Title                    = '.title';
    public static $BlockCreateTitle         = '//section[@class="mini-layout"]//th';

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
    public static $InputNameLabel           = '';

    //таби
    public static $Tab                      = '';
    
    //селекти
    public static $Select                   = '';
    
    //опції
    public static function selectNameOptin($number) { return "//[$number]";}
}