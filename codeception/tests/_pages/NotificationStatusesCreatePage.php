<?php

class NotificationStatusesCreatePage
{
    public static $URL                      = '/admin/components/run/shop/notificationstatuses/create';
    
    //заголовки
    public static $Title                    = '.title';
    public static $BlockInfoTitle           = '//section[@class="mini-layout"]//th';

    //кнопки
    public static $ButtonBack               = '.t-d_u';
    public static $ButtonCreate             = '//section[@class="mini-layout"]/div[1]/div[2]/div/button[1]';
    public static $ButtonCreateExit         = '//section[@class="mini-layout"]/div[1]/div[2]/div/button[2]';
    
    //поля для вводу
    public static $InputName                = '#inputFio';

    //лейбли
    public static $InputNameLabel           = 'label[for="inputFio"]';
}