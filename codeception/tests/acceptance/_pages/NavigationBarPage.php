<?php

class NavigationBarPage
{
    //Navigation bar buttons
    //Настройки
    public static $Settings = "//nav/ul/li[8]/a";
    public static $SettingsDelivery = "//nav/ul/li[8]/ul/li[3]/a";
    //Заказы
    public static $Orders = "//nav/ul/li[2]/a";
    public static $OrdersList = "//ul/li[2]/ul/li[2]/a";
    public static $OrderStatuses = "//ul/li[2]/ul/li[3]/a";
    public static $CallbacksList = "//ul/li[2]/ul/li[5]/a";
    public static $CallbackStatuses = "//ul/li[2]/ul/li[6]/a";
    public static $CallbackThemes  = "//ul/li[2]/ul/li[7]/a";
    public static $NotificationsList = "//ul/li[2]/ul/li[9]/a";
    public static $NotificationStatuses = "//nav/ul/li[2]/ul/li[10]/a";

    //Система
    public static $System = "//nav/ul/li[9]/a";
    public static $SystemClearAllCach = "#clearAllCache";
}