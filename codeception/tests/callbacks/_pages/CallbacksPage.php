<?php

class CallbacksPage
{
    //Кнопки
    public static $DeleteCallback  = './/*[@id="mainContent"]/div[1]/form/section/div[1]/div[2]/div/button'; //CallbacksList
    public static $GoBackButton  = './/*[@id="mainContent"]/section/div[1]/div[2]/div/a/span[2]';
    public static $SaveButton  = './/*[@id="mainContent"]/section/div[1]/div[2]/div/button[1]';
    public static $SaveAndExitButton  = './/*[@id="mainContent"]/section/div[1]/div[2]/div/button[2]';
    public static $CallMeButton  = '.btn-form>button'; //CallbacksList
    public static $OrderCallButton  = 'html/body/div[1]/div[1]/header/div[2]/div/div/div[1]/div/div[2]/button'; //CallbacksList
    public static $CreateStatusButton  = './/*[@id="orderStatusesList"]/section/div[1]/div[2]/div/a'; //CallbacksStatuses
    public static $CreateThemeButton  = './/*[@id="orderStatusesList"]/section/div[1]/div[2]/div/a'; //CallbacksThemes
    //Поля
    public static $UserNameCreate  = './/*[@id="data-callback"]/label[1]/span[2]/input'; //CallbacksList
    public static $TelephoneCreate  = './/*[@id="data-callback"]/label[2]/span[2]/input'; //CallbacksList
    public static $CommentCreate  = './/*[@id="data-callback"]/label[3]/span[2]/textarea'; //CallbacksList
    public static $StatusSelEdit  = './/*[@id="editCallbackForm"]/div[1]/div/select/option[@selected="selected"]'; //CallbacksList
    public static $ThemeSelEdit  = './/*[@id="editCallbackForm"]/div[2]/div/select/option[@selected="selected"]'; //CallbacksList
    public static $UserNameEdit  = './/*[@id="editCallbackForm"]/div[3]/div/input'; //CallbacksList
    public static $TelephoneEdit  = './/*[@id="editCallbackForm"]/div[4]/div/input'; //CallbacksList
    public static $CommentEdit  = './/*[@id="editCallbackForm"]/div[5]/div/textarea'; //CallbacksList
    public static $DateEdit  = './/*[@id="editCallbackForm"]/div[6]/div/input'; //CallbacksList
    public static $NameStatus  = './/*[@id="Text"]'; //CallbacksStatuses
    public static $DefaultStatusCheckboxCreate  = ".//*[@id='addCallbackStatusForm']/div[2]/div[2]/span[1]/span"; //CallbacksStatuses
    public static $DefaultStatusCheckboxEdit  = ".//*[@id='addCallbackStatusForm']/div[2]/div/span"; //CallbacksStatuses
    public static $NameTheme  = './/*[@id="Text"]'; //CallbacksThemes
    public static $StatusSelListLanding  = './/*[@id="callbacks_all"]/table/tbody/tr/td[6]/div/select'; //CallbacksList
    public static $ThemeSelListLanding  = './/*[@id="editCallbackForm"]/div[2]/div/select'; //CallbacksList
    

    //Кнопки в списку
    public static function CheckBoxButtonLine($row){
        $CheckBox = ".//*[@id='callbacks_all']/table/tbody/tr[$row]/td[1]/span/span"; //CallbacksList
        return $CheckBox;
    }
    public static function IdLine($row){
        $IdBut = ".//*[@id='callbacks_all']/table/tbody/tr[$row]/td[2]";
        return $IdBut;
    }
    public static function UserNameLine($row){
        $NameBut = ".//*[@id='callbacks_all']/table/tbody/tr[$row]/td[3]/a";
        return $NameBut;
    }    
    public static function PhoneLine($row){
        $PhoneBut = ".//*[@id='callbacks_all']/table/tbody/tr[$row]/td[4]";
        return $PhoneBut;
    }
    public static function ThemeSelListLandingLine($row){
        $ThemeSelList = ".//*[@id='callbacks_all']/table/tbody/tr[$row]/td[5]/div/select/option[@selected='selected']"; //CallbacksList
        return $ThemeSelList;
    }
    public static function StatusSelListLandingLine($row){
        $StatusSelList = ".//*[@id='callbacks_all']/table/tbody/tr[$row]/td[6]/div/select/option[@selected='selected']"; //CallbacksList
        return $StatusSelList;
    }
    public static function DateLine($row){
        $DateBut = ".//*[@id='callbacks_all']/table/tbody/tr[$row]/td[7]";
        return $DateBut;
    }
    public static function DeleteButtonLine($row){
        $DeleteBut = ".//*[@id='callbacks_all']/table/tbody/tr[$row]/td[8]/a"; //CallbacksList
        return $DeleteBut;
    } 
    public static function PaginationButton($pag){
        $PageBut = ".//*[@id='gopages']/div/ul/li[$pag]/a";
        return $PageBut;
    }
    
    
    //CallbacksStatuses
    public static function IdStatusLine($row){
        $IdStatBut = ".//*[@id='orderStatusesList']/section/div[2]/div/table/tbody/tr[$row]/td[1]";
        return $IdStatBut;
    }
    public static function StatusNameLine($row){
        $StatNameBut = ".//*[@id='orderStatusesList']/section/div[2]/div/table/tbody/tr[$row]/td[2]/a";
        return $StatNameBut;
    }    
    public static function ActiveButtonLine($row){
        $ActiveBut = ".//*[@id='orderStatusesList']/section/div[2]/div/table/tbody/tr[$row]/td[3]/div/span";
        return $ActiveBut;
    }
    public static function DeleteStatusButtonLine($row){
        $DeleteStatusBut = ".//*[@id='orderStatusesList']/section/div[2]/div/table/tbody/tr[$row]/td[4]/a"; //CallbacksStatuses
        return $DeleteStatusBut;
    }
    
    
    //CallbacksThemes
    public static function IdThemeLine($row){
        $IdThemBut = ".//*[@id='orderStatusesList']/section/div[2]/div/table/tbody/tr[$row]/td[1]";
        return $IdThemBut;
    }
    public static function ThemeNameLine($row){
        $ThemNameBut = ".//*[@id='orderStatusesList']/section/div[2]/div/table/tbody/tr[$row]/td[2]/a";
        return $ThemNameBut;
    }        
    public static function DeleteThemeButtonLine($row){
        $DeleteThemeBut = ".//*[@id='orderStatusesList']/section/div[2]/div/table/tbody/tr[$row]/td[3]/a"; //CallbacksThemes
        return $DeleteThemeBut;
    }
    
    
}
