<?php

class ListPage
{

    public static $URL = '';
    public static $Title = '.title';
    
    //кнопки
    public static $ButtonCreate = '';
    public static $ButtonDelete = '';
    
    //заголовки таблиці
    public static $Head = '';
    
    //рядки таблиці
    public static function line($row) { return ""; }
    
    //вікно видалення
    static $WindowDelete                = '';
    static $WindowDeleteTitle           = '';
    static $WindowDeleteQuestion        = '';
    static $WindowDeleteButtonDelete    = '';
    static $WindowDeleteButtonCancel    = '';
    static $WindowDeleteButtonClose     = '';
}