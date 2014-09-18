<?php

class PageObjectTemplateEditPage
{
    //заголовки
    public static $Title                        = '.title';
    public static $BlockEditTitle               = '//section[@class="mini-layout"]//th';
    
    //кнопки
    Public static $ButtonBack                   = '.t-d_u';
    Public static $ButtonSave                   = '//section[@class="mini-layout"]/div[1]/div[2]/div/button[1]';
    Public static $ButtonSaveExit               = '//section[@class="mini-layout"]/div[1]/div[2]/div/button[2]';
    public static $ButtonLanguage               = '.btn.dropdown-toggle.btn-small';
    
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