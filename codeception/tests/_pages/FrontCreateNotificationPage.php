<?php

class FrontCreateNotificationPage

{
    //   Тайтл і Вікно форми створення Уведомления 
    public static $Title                        = '//body/div[10]/div/div[1]/div';
    public static $WindowCreateNotification     = '//body/div[10]/div';
    
    //   Кнопки    
    public static $ButtonClose  = '//body/div[10]/div/button';
    public static $ButtonSend   = '//div[10]/div/div[2]/div/div/div/div/form/div/div/span[2]/div/button';

    //   Підказка
    public static $Help = '//body/div[10]/div/div[2]/div/div/div/div/form/div/label[2]/span[2]/span[2]';
    
    //   Посилання
    public static $LinkNameProduct  = '//body/div[10]/div/div[2]/div/div/div/ul/li/a/span[2]';
    public static $ImageProduct     = '//body/div[10]/div/div[2]/div/div/div/ul/li/a/span[1]';
    
    //   Текстова інформація товару
    public static $TextPrice                = '//body/div[10]/div/div[2]/div/div/div/ul/li/div/div/span/span[1]/span/span[1]';
    public static $TextCurrency             = '//body/div[10]/div/div[2]/div/div/div/ul/li/div/div/span/span[1]/span/span[2]';
    public static $TextAdditionalPrice      = '//body/div[10]/div/div[2]/div/div/div/ul/li/div/div/span/span[2]/span/span[1]';
    public static $TextAdditionalCurrency   = '//body/div[10]/div/div[2]/div/div/div/ul/li/div/div/span/span[2]/span/span[2]';
    
    //   Поле Імя
    public static $InputName        = '//body/div[10]/div/div[2]/div/div/div/div/form/div/label[1]/span[2]/input';
    public static $InputNameLabel   = '//body/div[10]/div/div[2]/div/div/div/div/form/div/label[1]/span[1]';
    public static $InputNameStar    = '//body/div[10]/div/div[2]/div/div/div/div/form/div/label[1]/span[2]/span';
    public static $InputNameMessageAlert    = '//body/div[10]/div/div[2]/div/div/div/div/form/div/label[1]/span[2]/label';
    
    //   Поле Емейл
    public static $InputEmail       = '//body/div[10]/div/div[2]/div/div/div/div/form/div/label[2]/span[2]/input';
    public static $InputEmailLabel  = '//body/div[10]/div/div[2]/div/div/div/div/form/div/label[2]/span[1]';
    public static $InputEmailStar   = '//body/div[10]/div/div[2]/div/div/div/div/form/div/label[2]/span[2]/span[1]';
    public static $InputEmailMessageAlert   = '//body/div[10]/div/div[2]/div/div/div/div/form/div/label[2]/span[2]/label';

    //   Поле Телефон
    public static $InputPhone       = '//body/div[10]/div/div[2]/div/div/div/div/form/div/label[3]/span[2]/input';
    public static $InputPhoneLabel  = '//body/div[10]/div/div[2]/div/div/div/div/form/div/label[3]/span[1]';
    public static $InputPhoneMessageAlert  = '//body/div[10]/div/div[2]/div/div/div/div/form/div/label[3]/span[2]/label';

    //   Поле Комментар
    public static $InputComment         = '//body/div[10]/div/div[2]/div/div/div/div/form/div/label[4]/span[2]/textarea';
    public static $InputCommentLabel    = '//body/div[10]/div/div[2]/div/div/div/div/form/div/label[4]/span[1]';
    
    
}

