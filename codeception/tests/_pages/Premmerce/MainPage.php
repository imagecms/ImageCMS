<?php

class MainPage
    
{   
    public static $URL = '/';
    public static $ButtonEnter          = '#loginButton';
    public static $ButtonCabinet        = '//body/div[3]/header/div/div/div/div[1]/div[1]';
    public static $ButtonCreateStore    = '.btn-create-shop>a';
    public static $ButtonCreateStoreNow = '#createStoreButton';
    public static $InputNameShop        = '[name="domain"]';
    
    public static $WindowLoginTitle                 = '//body/div[10]/div/div[1]/div';
    public static $WindowLoginInputEmail            = '[name="email"]';
    public static $WindowLoginInputPassword         = '[name="password"]';
    public static $WindowLoginButtonSend            = '//form/div/div/div/span/button';
    public static $WindowLoginButtonClose           = '//body/div[10]/div/button';
    public static $WindowLoginLinkRecallPassword    = '//div[10]/div/div[2]/div[1]/div/form/div/div/div/div/button';
    public static $WindowLoginCreateShop            = '//div[10]/div/div[2]/div[2]/div/a';
    public static $WindowLoginTextRegistration      = '//div[10]/div/div[2]/div[2]/div/span';
    public static $WindowLoginTextLogining          = '//body/div[10]/div/div[2]/div[1]/div/div/div/div';

    
    public static $WindowForgotPasswordTitle        = '//body/div[12]/div/div[1]/div';
    public static $WindowForgotPasswordInputEmail   = '//form/div/label/span/input';
    public static $WindowForgotPasswordButtonClose  = '//body/div[12]/div/button';
    public static $WindowForgotPasswordButtonSend   = '//div[12]/div/div[2]/div/div/form/div/div/div/div/button';
}