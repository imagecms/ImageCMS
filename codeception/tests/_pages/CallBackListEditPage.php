<?php

class CallBackListEditPage
{
    //заголовки
    public static $Title                = '.title';
    public static $BlockTitle           = '//section[@class="mini-layout"]//thead/tr/th';

    //кнопки
    public static $ButtonBack           = '.mini-layout .t-d_u';
    public static $ButtonCreate         = '.btn.btn-small.btn-primary.action_on.formSubmit';
    public static $ButtonCreateExit     = '.btn.btn-small.action_on.formSubmit[data-action="close"]';
    
    //селекти
    public static $SelectStatus         = '//section[@class="mini-layout"]//form/div[1]//select';
    public static $SelectTheme          = '//section[@class="mini-layout"]//form/div[2]//select';
    
    //поля для вводу
    public static $InputUserName        = '[name="Name"]';
    public static $InputPhone           = '[name="Phone"]';
    public static $InputComment         = '[name="Comment"]';
    
    //текст
    public static $TextDate             = 'input[readonly="readonly"]';

    //лейбли
    public static $SelectStatusLabel    = '//form[@id="editCallbackForm"]/div[1]/label';
    public static $SelectThemeLabel     = '//form[@id="editCallbackForm"]/div[2]/label';
    public static $InputUserNameLabel   = '//form[@id="editCallbackForm"]/div[3]/label';
    public static $InputPhoneLabel      = '//form[@id="editCallbackForm"]/div[4]/label';
    public static $InputCommentLabel    = '//form[@id="editCallbackForm"]/div[5]/label';
    public static $TextDateLabel        = '//form[@id="editCallbackForm"]/div[6]/label';
    
    //опції в селектах
    public static function selectStatusOption($number)  { return "//section[@class='mini-layout']//form/div[1]//select/option[$number]"; }
    public static function selectThemeOption($number)   { return "//section[@class='mini-layout']//form/div[2]//select/option[$number]"; }
}