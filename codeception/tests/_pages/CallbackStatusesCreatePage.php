<?php

class CallbackStatusesCreatePage
{
    public static $URL = '/admin/components/run/shop/callbacks/createStatus';
    
    //заголовки
    public static $Title                    = '.title';
    public static $TitleBlockCreate         = '//thead//th';
    
    //кнопки
    public static $ButtonBack               = '.t-d_u';
    public static $ButtonCreate             = '//section[@class="mini-layout"]/div[1]/div[2]/div/button[1]';
    public static $ButtonCreateExit         = '//section[@class="mini-layout"]/div[1]/div[2]/div/button[2]';
    
    //поля для вводу
    public static $InputName                = '#Text';
    
    //чекбокси
    public static $CheckDefault             = '.niceCheck';
    
    //лейбли
    public static $InputNameLabel           = 'label[for="Text"]';
    public static $CheckDefaultLabel        = '.frame_label.no_connection';
}