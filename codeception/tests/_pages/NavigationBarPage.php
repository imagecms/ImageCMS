<?php

class NavigationBarPage
{
    //      Navigation bar buttons
    
    
    //     Настройки
    public static $Settings = "//nav/ul/li[8]/a";
    public static $SettingsDelivery = "//nav/ul/li[8]/ul/li[3]/a"; 
    public static $SettingsImportExport = "//div[3]/table/tbody/tr/td[7]/ul/li[5]/a";
    
    //      Система
    public static $System = "//table/tbody/tr/td[8]/a";
    public static $SystemGlobalSettings = '//table/tbody/tr/td[8]/a';
    public static $SystemClearAllCach = "#clearAllCache";
    
    

    //       Заказы
    public static $Orders = "//div[1]/div[3]/table/tbody/tr/td[1]/a";
    public static $OrdersList = "//table/tbody/tr/td[1]/ul/li[2]/a";
    public static $OrderStatuses = "//table/tbody/tr/td[1]/ul/li[3]/a";
    public static $CallbacksList = "//table/tbody/tr/td[1]/ul/li[5]/a";
    public static $CallbackStatuses = "//table/tbody/tr/td[1]/ul/li[6]/a";
    public static $CallbackThemes  = "//table/tbody/tr/td[1]/ul/li[7]/a";
    public static $NotificationsList = "//table/tbody/tr/td[1]/ul/li[9]/a";
    public static $NotificationStatuses = "//table/tbody/tr/td[1]/ul/li[10]/a";
    
    
    
    //     Пользователи
    public static $Users = "//div[3]/table/tbody/tr/td[3]/a";
    public static $UsersList = "//div[3]/table/tbody/tr/td[3]/ul/li[1]/a";
    public static $Permission = "//div[3]/table/tbody/tr/td[3]/ul/li[2]/a";
    
    
    //      Каталог товаров
    public static $ProductsCatalogue = "//div[1]/div[3]/table/tbody/tr/td[2]/a";
    public static $ProductCategories = "//div[3]/table/tbody/tr/td[2]/ul/li[1]/a";
    public static $ProductList = "//div[3]/table/tbody/tr/td[2]/ul/li[2]/a";
}