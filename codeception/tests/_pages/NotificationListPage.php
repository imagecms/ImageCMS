<?php

class NotificationListPage
{
    public static $URL = '/admin/components/run/shop/notifications/index#notification_all';
    public static $Title = '.title';
    
    //кнопки
    public static $ButtonDelete             = '//section[@class="mini-layout"]/div[3]/div[2]/div/button[2]';
    public static $ButtonFilter             = '//section[@class="mini-layout"]/div[3]/div[2]/div/button[1]';
    public static $ButtonCancelFiltration   = '//section[@class="mini-layout"]/div[3]/div[2]/div/a';
            
    //вікно видалення
    static $WindowDelete                = '.modal.hide.fade.modal_del.in';
    static $WindowDeleteTitle           = '.modal-header>h3';
    static $WindowDeleteQuestion        = '.modal-body>p';
    static $WindowDeleteButtonDelete    = '.modal-footer .btn.btn-primary';
    static $WindowDeleteButtonBack      = '.modal-footer .btn:nth-child(2)';
    static $WindowDeleteButtonClose     = '.close';

    //--------------------------------------------------------------------------
    //----------------------------ВКЛАДКА ВСЕ-----------------------------------
    //--------------------------------------------------------------------------
        public static $TabAll = '//section[@class="mini-layout"]/div[4]/a[1]';
        //заголовки таблиці
        public static $TabAllHeadCheck                = '//div[@id="notification_all"]//thead/tr[1]/th[1]/span/span';
        public static $TabAllHeadIDText               = '//div[@id="notification_all"]//thead/tr[1]/th[2]';
        public static $TabAllHeadEmailText            = '//div[@id="notification_all"]//thead/tr[1]/th[3]';
        public static $TabAllHeadTimeText             = '//div[@id="notification_all"]//thead/tr[1]/th[4]';
        public static $TabAllHeadValidUntilText       = '//div[@id="notification_all"]//thead/tr[1]/th[5]';
        public static $TabAllHeadManagerText          = '//div[@id="notification_all"]//thead/tr[1]/th[6]';
        public static $TabAllHeadStatusText           = '//div[@id="notification_all"]//thead/tr[1]/th[7]';
        public static $TabAllHeadProductText          = '//div[@id="notification_all"]//thead/tr[1]/th[8]';
        public static $TabAllHeadNotificationsText    = '//div[@id="notification_all"]//thead/tr[1]/th[9]';
        //Фільтр
        public static $TabAllFilterIDInput            = '//div[@id="notification_all"]//thead/tr[2]/td[2]/input';
        public static $TabAllFilterEmailInput         = '//div[@id="notification_all"]//thead/tr[2]/td[3]/input';
        public static $TabAllFilterTimeInput          = '//div[@id="notification_all"]//thead/tr[2]/td[4]/input';
        public static $TabAllFilterValidUntilInput    = '//div[@id="notification_all"]//thead/tr[2]/td[5]/input';

        public static $TabAllFilterSelectStatus       = '//div[@id="notification_all"]//thead/tr[2]/td[7]/select';
        public static function tabAllfilterSelectStatusOption($number) { return "//div[@id='notification_all']//thead/tr[2]/td[7]/select/option[$number]"; }


        //рядки таблиці
        public static function tabAllLineCheck($row)                      { return "//div[@id='notification_all']//tbody/tr[$row]/td[1]/span/span"; }
        public static function tabAllLineIDLink($row)                     { return "//div[@id='notification_all']//tbody/tr[$row]/td[2]/a"; }
        public static function tabAllLineEmailText($row)                  { return "//div[@id='notification_all']//tbody/tr[$row/td[3]"; }
        public static function tabAllLineTimeText($row)                   { return "//div[@id='notification_all']//tbody/tr[$row]/td[4]/p"; }
        public static function tabAllLineValidUntilText($row)             { return "//div[@id='notification_all']//tbody/tr[$row]/td[5]/p"; }
        public static function tabAllLineManagerText($row)                { return "//div[@id='notification_all']//tbody/tr[$row]/td[6]/p"; }
        public static function tabAllLineStatusSelect($row)               { return "//div[@id='notification_all']//tbody/tr[$row]/td[7]/select"; }
        public static function tabAllLineStatusSelectOption($row,$number){ 
                return "//div[@id='notification_all']//tbody/tr[$row]/td[7]/select/option[$number]"; 
            }
        public static function tabAllLineProductText($row)                { return "//div[@id='notification_all']//tbody/tr[$row]/td[8]/div/span"; }
        public static function tabAllLineProductInfo($row)                { return "//div[@id='notification_all']//tbody/tr[$row]/td[8]/div/i"; }
        public static function tabAllLineNotifications($row)              { return "//div[@id='notification_all']//tbody/tr[$row]/td[9]/button"; }
    //--------------------------------------------------------------------------
    //----------------------------ДЛЯ ВСІХ ВКЛАДОК------------------------------
    //Елементи всіх табі в дублюються , і для елементів кожного таба створюється 
    //<DIV> з ID notification_(тут ID статуса)
    //тому для роботи з окремим табом, методу потрібно потрібно передати ID таба 
    //--------------------------------------------------------------------------
    //перемикання вкладок
    public static function tab($number) { return "//div[@class='btn-group myTab m-t_20']/a[$number]"; }

    
    public static function headCheck($tab_id)               {return "//div[@id='notification_$tab_id']//thead/tr[1]/th[1]/span/span";}
    public static function headIDText($tab_id)              {return "//div[@id='notification_$tab_id']//thead/tr[1]/th[2]";}
    public static function headEmailText($tab_id)           {return "//div[@id='notification_$tab_id']//thead/tr[1]/th[3]";}
    public static function headTimeText($tab_id)            {return "//div[@id='notification_$tab_id']//thead/tr[1]/th[4]";}
    public static function headValidUntilText($tab_id)      {return "//div[@id='notification_$tab_id']//thead/tr[1]/th[5]";}
    public static function headManagerText($tab_id)         {return "//div[@id='notification_$tab_id']//thead/tr[1]/th[6]";}
    public static function headStatusText($tab_id)          {return "//div[@id='notification_$tab_id']//thead/tr[1]/th[7]";}
    public static function headProductText($tab_id)         {return "//div[@id='notification_$tab_id']//thead/tr[1]/th[8]";}
    public static function headNotificationsText($tab_id)   {return "//div[@id='notification_$tab_id']//thead/tr[1]/th[9]";}
    //фільтр
        public static function filterIDInput($tab_id)                        { return "//div[@id='notification_$tab_id']//thead/tr[2]/td[2]/input";}
        public static function filterEmailInput($tab_id)                     { return "//div[@id='notification_$tab_id']//thead/tr[2]/td[3]/input";}
        public static function filterTimeInput($tab_id)                      { return "//div[@id='notification_$tab_id']//thead/tr[2]/td[4]/input";}
        public static function filterValidUntilInput($tab_id)                { return "//div[@id='notification_$tab_id']//thead/tr[2]/td[5]/input";}

        public static function filterSelectStatus($tab_id)                   { return "//div[@id='notification_$tab_id']//thead/tr[2]/td[7]/select";}
        public static function filterSelectStatusOption($tab_id, $number)    { return "//div[@id='notification_$tab_id']//thead/tr[2]/td[7]/select/option[$number]"; }
    //рядки таблиці
        public static function lineCheck($tab_id, $row)                      { return "//div[@id='notification_$tab_id']//tbody/tr[$row]/td[1]/span/span"; }
        public static function lineIDLink($tab_id, $row)                     { return "//div[@id='notification_$tab_id']//tbody/tr[$row]/td[2]/a"; }
        public static function lineEmailText($tab_id, $row)                  { return "//div[@id='notification_$tab_id']//tbody/tr[$row/td[3]"; }
        public static function lineTimeText($tab_id, $row)                   { return "//div[@id='notification_$tab_id']//tbody/tr[$row]/td[4]/p"; }
        public static function lineValidUntilText($tab_id, $row)             { return "//div[@id='notification_$tab_id']//tbody/tr[$row]/td[5]/p"; }
        public static function lineManagerText($tab_id, $row)                { return "//div[@id='notification_$tab_id']//tbody/tr[$row]/td[6]/p"; }
        public static function lineStatusSelect($tab_id, $row)               { return "//div[@id='notification_$tab_id']//tbody/tr[$row]/td[7]/select"; }
        public static function lineStatusSelectOption($tab_id, $row,$number){ 
                return "//div[@id='notification_$tab_id']//tbody/tr[$row]/td[7]/select/option[$number]"; 
            }
        public static function lineProductText($tab_id, $row)                { return "//div[@id='notification_$tab_id']//tbody/tr[$row]/td[8]/div/span"; }
        public static function lineProductInfo($tab_id, $row)                { return "//div[@id='notification_$tab_id']//tbody/tr[$row]/td[8]/div/i"; }
        public static function lineNotifications($tab_id, $row)              { return "//div[@id='notification_$tab_id']//tbody/tr[$row]/td[9]/button"; }    

}