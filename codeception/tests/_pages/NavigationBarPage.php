<?php

class NavigationBarPage
{
    //      Navigation bar buttons
    
    
    //     Настройки
    public static $Settings = "//nav/ul/li[8]/a";
    public static $SettingsDelivery = "//nav/ul/li[8]/ul/li[3]/a"; 
    

    public static $SettingsImportExport = "//nav/ul/li[8]/ul/li[5]/a";
    
    //      Система
    public static $System = "//nav/ul/li[9]/a";
    public static $SystemGlobalSettings = '//nav/ul/li[9]/ul/li[1]/a';
    public static $SystemClearAllCach = "#clearAllCache";
    
    

    //       Заказы
    public static $Orders = "//nav/ul/li[2]/a";
    public static $OrdersList = "//ul/li[2]/ul/li[2]/a";
    public static $OrderStatuses = "//ul/li[2]/ul/li[3]/a";
    public static $CallbacksList = "//ul/li[2]/ul/li[5]/a";
    public static $CallbackStatuses = "//ul/li[2]/ul/li[6]/a";
    public static $CallbackThemes  = "//ul/li[2]/ul/li[7]/a";
    public static $NotificationsList = "//ul/li[2]/ul/li[9]/a";
    public static $NotificationStatuses = "//nav/ul/li[2]/ul/li[10]/a";
    
    
    
    //     Пользователи
    public static $Users = "//body/div[1]/div[3]/div/nav/ul/li[4]/a";
    public static $UsersList = "//div[1]/div[3]/div/nav/ul/li[4]/ul/li[1]/a";
    public static $Permission = "//div[1]/div[3]/div/nav/ul/li[4]/ul/li[2]/a";
    
    
    //      Каталог товаров
    public static $ProductsCatalogue = "//body/div[1]/div[3]/div/nav/ul/li[3]/a";
    public static $ProductCategories = "//body/div[1]/div[3]/div/nav/ul/li[3]/ul/li[1]/a";
    public static $ProductList = "//body/div[1]/div[3]/div/nav/ul/li[3]/ul/li[2]/a";
}