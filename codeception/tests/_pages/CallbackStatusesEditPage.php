<?php

class CallbackStatusesEditPage
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
    public static $InputName                    = '#Text';

    //чекбокси
    public static $CheckDefault                 = '#IsDefault';
    
    //лейбли
    public static $InputNameLabel               = 'label[for="Text"]';
    public static $CheckDefaultLabel            = '.frame_label.no_connection';
    
}