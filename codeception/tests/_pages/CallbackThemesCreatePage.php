<?php

class CallbackThemesCreatePage
{
    public static $URL                      = '/admin/components/run/shop/callbacks/createTheme';
    
    //заголовки
    public static $Title                    = '.title';
    public static $TitleBlockCreate         = '//section[@class="mini-layout"]//th';

    //кнопки
    public static $ButtonBack               = '.t-d_u';
    public static $ButtonCreate             = '//section[@class="mini-layout"]/div[1]/div[2]/div/button[1]';
    public static $ButtonCreateExit         = '//section[@class="mini-layout"]/div[1]/div[2]/div/button[2]';
    
    //поля для вводу
    public static $Input                    = '#Text';
    
    //лейбли
    public static $InputNameLabel           = 'label[for="Text"]';
}