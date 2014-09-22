<?php

class NavigationBarPage
{
    //      Navigation bar buttons
    
    //Header buttons
    //
    public static $PersonalButton = "//a[@class='btn_header btn-personal-area']";
    public static $PersonalButtonLogout = "//a[@href='/admin/logout']";
    
    //      Модули
    public static $Modules = "//div[@class='frame_nav']/table/tbody/tr/td[5]/a";
    public static $ModulesAllModules = '//a[@href="/admin/components/modules_table"]';
    
    //     Настройки
    public static $Settings = "//div[1]/div[3]/table/tbody/tr/td[7]/a";
    
    public static $Currencies = "//div[1]/div[3]/table/tbody/tr/td[7]/ul/li[2]/a"; 
    public static $SettingsDelivery = "//div[1]/div[3]/table/tbody/tr/td[7]/ul/li[3]/a";
    public static $SettingsShopSettings = "//div[1]/div[3]/table/tbody/tr/td[7]/ul/li[1]/a";
    
//    public static $SettingsImportExport = "//div[3]/table/tbody/tr/td[7]/ul/li[5]/a";
    
    //      Система
    public static $System = "//table/tbody/tr/td[8]/a";
    public static $SystemGlobalSettings = '//div[1]/div[3]/table/tbody/tr/td[8]/ul/li[1]/a';
    public static $SystemClearAllCach = "#clearAllCache";
    
    

    //       Заказы
    public static $Orders = "//div[1]/div[3]/table/tbody/tr/td[1]/a";
    public static $OrdersList = "//table/tbody/tr/td[1]/ul/li[2]/a";
    public static $OrderStatuses = "//body/div[1]/div[3]/table/tbody/tr/td[1]/ul/li[2]/a";
    public static $CallbacksList = "//table/tbody/tr/td[1]/ul/li[5]/a";
    public static $CallbackStatuses = "//table/tbody/tr/td[1]/ul/li[6]/a";
    public static $CallbackThemes  = "//table/tbody/tr/td[1]/ul/li[7]/a";
    public static $NotificationsList = "//div[1]/div[3]/table/tbody/tr/td[1]/ul/li[8]/a";
    public static $NotificationStatuses = "//div[1]/div[3]/table/tbody/tr/td[1]/ul/li[9]/a";
    
    
    
    //     Пользователи
    public static $Users = "//div[3]/table/tbody/tr/td[3]/a";
    public static $UsersList = "//div[3]/table/tbody/tr/td[3]/ul/li[1]/a";
    public static $Permission = "//div[3]/table/tbody/tr/td[3]/ul/li[2]/a";
    
    
    //      Каталог товаров
    public static $ProductsCatalogue = "//div[1]/div[3]/table/tbody/tr/td[2]/a";
    public static $ProductCategories = "//div[3]/table/tbody/tr/td[2]/ul/li[1]/a";
    public static $ProductsList = "//div[3]/table/tbody/tr/td[2]/ul/li[2]/a";
}