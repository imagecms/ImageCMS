<?php

class CurrenciesPage
{
    //URL of currencies list page
    public static $URL = '/admin/components/run/shop/currencies';

    //Кнопки
    public static $CreateCurrencyButton  = './/*[@id="mainContent"]/section/div[1]/div[2]/div/a';
    public static $VerifyPrices  = './/*[@id="mainContent"]/section/div[1]/div[2]/div/button';
    public static $GoBackButton  = './/*[@id="mainContent"]/section/div[1]/div[2]/div/a/span[2]';
    public static $SaveButton  = './/*[@id="mainContent"]/section/div[1]/div[2]/div/button[1]';
    public static $SaveAndExitButton  = './/*[@id="mainContent"]/section/div[1]/div[2]/div/button[2]';
    //Поля
    public static $NameCurrencyCreate  = './/*[@id="cur_cr_form"]/table/tbody/tr/td/div/div[1]/div/input';
    public static $IsoCodCreate  = './/*[@id="cur_cr_form"]/table/tbody/tr/td/div/div[2]/div/input';
    public static $SymbolCreate  = './/*[@id="cur_cr_form"]/table/tbody/tr/td/div/div[3]/div/input';
    public static $Rate  = './/*[@id="mod_name"]/div/input';
    public static $NameCurrencyEdit  = './/*[@id="cur_ed_form"]/table/tbody/tr/td/div/div[1]/div/input';
    public static $IsoCodEdit  = './/*[@id="cur_ed_form"]/table/tbody/tr/td/div/div[2]/div/input';
    public static $SymbolEdit  = './/*[@id="cur_ed_form"]/table/tbody/tr/td/div/div[3]/div/input';
    public static $TemplateForm  = ".//*[@id='cur_ed_form']/table[2]";
    public static $CurrencyTemplate  = '//*[@id="select-format"]';
    public static $FormatLine  = '//*[@id="select-format-currency"]';
    public static $DelimiterTens  = '//*[@id="select-separator-tens"]';
    public static $DelimiterThousands  = '//*[@id="select-thousands-separator"]';
    public static $AmountDecimals  = '//*[@id="select-decimal-places"]';
    public static $NotNullsCheckbox  = '//*[@id="cur_ed_form"]/table[2]/tbody/tr/td/div/div[6]/div/input';
    
       
    public static $DeleteWindow  = ".//div[@class='modal hide fade in']";
    public static $DeleteButtonWindow  = './/*[@id="first"]/div[3]/a[1]';
    public static $CancelButtonWindow  = './/*[@id="first"]/div[3]/a[2]';
    
   
    //Кнопки в списке
     public static function IdCurrencyLine($row){
        $IdCur = "//tbody/tr[$row]/td[1]";
        return $IdCur;
    }    
    public static function CurrencyNameLine($row) {
        $CurrencyLine = "//tbody/tr[$row]/td[2]/a";
        return $CurrencyLine;
    }
    public static function IsoCodeLine($row) {
        $IsoCodeLine = "//tbody/tr[$row]/td[3]";
        return $IsoCodeLine;
    }
    public static function SymbolCurrencyLine($row) {
        $SymbLine = "//tbody/tr[$row]/td[4]";
        return $SymbLine;
    }
    public static function RadioButtonLine($row){
        $RadioBut = "//tbody//tr[$row]//td[5]/input";
        return $RadioBut;
    }
    public static function ActiveButtonLine($row){
        $ActiveBut = "//tbody/tr[$row]/td[6]/div/span";
        return $ActiveBut;
    }
    public static function DeleteButtonLine($row){
        $DeleteBut = "//tbody/tr[$row]/td[7]/button";
        return $DeleteBut;
    }
        
}