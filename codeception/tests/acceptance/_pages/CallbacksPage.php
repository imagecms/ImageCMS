<?php

class CallbacksPage
{
    //Кнопки
    public static $DeleteCallback  = './/*[@id="mainContent"]/div[1]/form/section/div[1]/div[2]/div/button'; //CallbacksList
    public static $GoBackButton  = './/*[@id="mainContent"]/section/div[1]/div[2]/div/a/span[2]';
    public static $SaveButton  = './/*[@id="mainContent"]/section/div[1]/div[2]/div/button[1]';
    public static $SaveAndExitButton  = './/*[@id="mainContent"]/section/div[1]/div[2]/div/button[2]';
    public static $CallMeButton  = '.btn-form>button'; //CallbacksList
    public static $OrderCallButton  = '.isDrop'; //CallbacksList
    public static $CreateStatusButton  = './/*[@id="orderStatusesList"]/section/div[1]/div[2]/div/a'; //CallbacksStatuses
    public static $CreateThemeButton  = './/*[@id="orderStatusesList"]/section/div[1]/div[2]/div/a'; //CallbacksThemes
    //Поля
    public static $UserNameCreate  = './/*[@id="data-callback"]/label[1]/span[2]/input'; //CallbacksList
    public static $TelephoneCreate  = './/*[@id="data-callback"]/label[2]/span[2]/input'; //CallbacksList
    public static $CommentCreate  = './/*[@id="data-callback"]/label[3]/span[2]/textarea'; //CallbacksList
    public static $StatusSelEdit  = './/*[@id="editCallbackForm"]/div[1]/div/select'; //CallbacksList
    public static $ThemeSelEdit  = './/*[@id="editCallbackForm"]/div[2]/div/select'; //CallbacksList
    public static $UserNameEdit  = './/*[@id="editCallbackForm"]/div[3]/div/input'; //CallbacksList
    public static $TelephoneEdit  = './/*[@id="editCallbackForm"]/div[4]/div/input'; //CallbacksList
    public static $CommentEdit  = './/*[@id="editCallbackForm"]/div[5]/div/textarea'; //CallbacksList
    public static $DateEdit  = './/*[@id="editCallbackForm"]/div[6]/div/input'; //CallbacksList
    public static $NameStatus  = './/*[@id="Text"]'; //CallbacksStatuses
    public static $NameTheme  = './/*[@id="Text"]'; //CallbacksThemes

    //Кнопки в списку
    public static function PaginationButton($pag){
        $PageBut = ".//*[@id='gopages']/div/ul/li[$pag]/a";
        return $PageBut;
    }
    public static function DeleteButtonLine($row){
        $DeleteBut = ".//*[@id='callbacks_all']/table/tbody/tr[$row]/td[8]/a"; //CallbacksList
        return $DeleteBut;
    }
    public static function CheckBoxButtonLine($row){
        $CheckBox = ".//*[@id='callbacks_all']/table/tbody/tr[$row]/td[1]/span/span/input"; //CallbacksList
        return $CheckBox;
    }
    
    //CallbacksStatuses
    public static function DeleteStatusButtonLine($row){
        $DeleteStatusBut = ".//*[@id='orderStatusesList']/section/div[2]/div/table/tbody/tr[$row]/td[4]/a"; //CallbacksStatuses
        return $DeleteStatusBut;
    }
}
