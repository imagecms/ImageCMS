<?php

class CurrenciesPage
{
    //URL of currencies list page
    public static $URL = '/admin/components/run/shop/currencies';

    //Кнопки
    public static $CreateCurrencyButton  = './/*[@id="mainContent"]/section/div[1]/div[2]/div/a';
    public static $VerifyPricesButton  = './/*[@id="mainContent"]/section/div[1]/div[2]/div/button';
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
    public static $CurrencyTemplateSelect  = '//*[@id="select-format"]';
//    public static $FormatLine  = '//*[@id="select-format-currency"]';
//    public static $DelimiterTens  = '//*[@id="select-separator-tens"]';
//    public static $DelimiterThousands  = '//*[@id="select-thousands-separator"]';
    public static $AmountDecimalsSelect  = '//*[@id="select-decimal-places"]';
    public static $NotNullsCheckbox  = '//*[@id="cur_ed_form"]/table[2]/tbody/tr/td/div/div[6]/div/input';
    
    
    //Delete Window
    public static $DeleteWindow  = ".//div[@class='modal hide fade in']";
    public static $DeleteButtonWindow  = './/*[@id="first"]/div[3]/a[1]';
    public static $CancelButtonWindow  = './/*[@id="first"]/div[3]/a[2]';
    
    //FrontEnd Search
    public static $SearchField  = ".//*[@id='inputString']";
    public static $SearchButton  = "html/body/div[1]/div[1]/header/div[2]/div/div/div[2]/div[2]/div/form/span/button";
    
    
    //FrontEnd Product Price 
    public static $MainFirstPlace  = ".//*[@id='items-catalog-main']/li/div[1]/div[2]/span/span/span/span[1]";
    public static $MainSecondPlace  = ".//*[@id='items-catalog-main']/li/div[1]/div[2]/span/span/span/span[2]";
    public static $AdditFirstPlace  = '//*[@id="items-catalog-main"]/li/div[1]/div[2]/span/span[2]/span/span/span[1]';
    public static $AdditSecondPlace  = '//*[@id="items-catalog-main"]/li/div[1]/div[2]/span/span[2]/span/span/span[2]';
                                          
    //FrontEnd Product Card Price 
    public static $MainFirstPlaceCard  = "/html/body/div[1]/div[2]/div[2]/div[1]/div/div[2]/div[2]/div[1]/div/div[1]/div[1]/span/span[1]/span/span/span[1]";
    public static $MainSecondPlaceCard  = "/html/body/div[1]/div[2]/div[2]/div[1]/div/div[2]/div[2]/div[1]/div/div[1]/div[1]/span/span[1]/span/span/span[2]";
    public static $AdditFirstPlaceCard  = '/html/body/div[1]/div[2]/div[2]/div[1]/div/div[2]/div[2]/div/div/div[1]/div[1]/span/span[2]/span/span/span[1]';
    public static $AdditSecondPlaceCard  = '/html/body/div[1]/div[2]/div[2]/div[1]/div/div[2]/div[2]/div/div/div[1]/div[1]/span/span[2]/span/span/span[2]';
    
    //FrontEnd Product Cart Price 
    public static $MainFirstCart  = '//*[@id="popupCart"]/div/div[3]/div[1]/div/span[2]/span/span[1]/span/span/span[1]';
    public static $MainSecondCart  = '//*[@id="popupCart"]/div/div[3]/div[1]/div/span[2]/span/span[1]/span/span/span[2]';
    public static $AdditFirstCart  = '//*[@id="popupCart"]/div/div[3]/div[1]/div/span[2]/span/span[2]/span/span/span[1]';
    public static $AdditSecondCart  = '//*[@id="popupCart"]/div/div[3]/div[1]/div/span[2]/span/span[2]/span/span/span[2]';
    
    public static $MainFirstPlaceSum  = '//*[@id="popupCart"]/div/div[2]/div/div/div/table/tbody/tr/td[4]/div/span/span/span/span/span[1]';
    public static $MainSecondPlaceSum  = '//*[@id="popupCart"]/div/div[2]/div/div/div/table/tbody/tr/td[4]/div/span/span/span/span/span[2]';
    
    //List Landing Page
     public static function IdCurrencyLine($row){
        $IdCur = "//section[@class='mini-layout']/div[2]/div/form/table/tbody/tr[$row]/td[1]";
        return $IdCur;
    }    
    public static function CurrencyNameLine($row) {
        $CurrencyLine = "//section[@class='mini-layout']/div[2]/div/form/table/tbody/tr[$row]/td[2]/a";
        return $CurrencyLine;
    }
    public static function IsoCodeLine($row) {
        $IsoCodeLine = "//section[@class='mini-layout']/div[2]/div/form/table/tbody/tr[$row]/td[3]";
        return $IsoCodeLine;
    }
    public static function SymbolCurrencyLine($row) {
        $SymbLine = "//section[@class='mini-layout']/div[2]/div/form/table/tbody/tr[$row]/td[4]";
        return $SymbLine;
    }
    public static function RadioButtonLine($row){
        $RadioBut = "//section[@class='mini-layout']/div[2]/div/form/table/tbody//tr[$row]//td[5]/input";
        return $RadioBut;
    }
    public static function ActiveButtonLine($row){
        $ActiveBut = "//section[@class='mini-layout']/div[2]/div/form/table/tbody/tr[$row]/td[6]/div/span";
        return $ActiveBut;
    }
    public static function DeleteButtonLine($row){
        $DeleteBut = "//section[@class='mini-layout']/div[2]/div/form/table/tbody/tr[$row]/td[7]/button";
        return $DeleteBut;
    }
        
}