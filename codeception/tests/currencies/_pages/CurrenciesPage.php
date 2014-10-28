<?php

class CurrenciesPage
{
    //URL of currencies list landing page
    public static $URL = '/admin/components/run/shop/currencies';

    //Buttons
    public static $CreateCurrencyButton  = './/*[@id="mainContent"]/section/div[1]/div[2]/div/a';
    public static $VerifyPricesButton  = './/*[@id="mainContent"]/section/div[1]/div[2]/div/button';
    public static $GoBackButton  = './/*[@id="mainContent"]/section/div[1]/div[2]/div/a/span[2]';
    public static $SaveButton  = './/*[@id="mainContent"]/section/div[1]/div[2]/div/button[1]';
    public static $SaveAndExitButton  = './/*[@id="mainContent"]/section/div[1]/div[2]/div/button[2]';
    //Fields
    public static $NameCurrencyCreate  = './/*[@id="cur_cr_form"]/table/tbody/tr/td/div/div[1]/div/input';
    public static $IsoCodCreate  = './/*[@id="cur_cr_form"]/table/tbody/tr/td/div/div[2]/div/input';
    public static $SymbolCreate  = './/*[@id="cur_cr_form"]/table/tbody/tr/td/div/div[3]/div/input';
    public static $Rate  = './/*[@id="mod_name"]/div/input';
    public static $NameCurrencyEdit  = './/*[@id="cur_ed_form"]/table/tbody/tr/td/div/div[1]/div/input';
    public static $IsoCodEdit  = './/*[@id="cur_ed_form"]/table/tbody/tr/td/div/div[2]/div/input';
    public static $SymbolEdit  = './/*[@id="cur_ed_form"]/table/tbody/tr/td/div/div[3]/div/input';
    public static $TemplateForm  = ".//*[@id='cur_ed_form']/table[2]";
    public static $CurrencyTemplateSelect  = '//*[@id="select-format"]';
    public static $AmountDecimalsSelect  = ".//*[@id='select-decimal-places']";
    public static $NotNullsCheckbox  = ".//*[@id='cur_ed_form']/table[2]/tbody/tr/td/div/div[3]/div/span/span";
    
    
    //Delete Window   
    public static $DeleteWindow  = ".//div[@class='modal hide fade in']";
    public static $DeleteButtonWindow  = './/*[@id="first"]/div[3]/a[1]';
    public static $CancelButtonWindow  = './/*[@id="first"]/div[3]/a[2]';
    
    //FrontEnd Search
    public static $SearchField  = ".//*[@id='inputString']";
    public static $SearchButton  = '//*[@type="submit"]';
    
    
    //FrontEnd Product Price 
    public static $MainFirstPlace  = '//*[@id="items-catalog-main"]/li[1]//*[@class="price-new"]/span/span[1]';
    public static $MainSecondPlace  = '//*[@id="items-catalog-main"]/li[1]//*[@class="price-new"]/span/span[2]';
    public static $AdditFirstPlace  = '//*[@id="items-catalog-main"]/li[1]//*[@class="price-add"]/span/span[1]';
    public static $AdditSecondPlace  = '//*[@id="items-catalog-main"]/li[1]//*[@class="price-add"]/span/span[2]';
    
    public static $FirstProductSearching  = '//*[@id="items-catalog-main"]/li[1]/a';
    
    //FrontEnd Product Card Price 
    public static $MainFirstPlaceCard  = './/*[@class="frame-prices-buy-wish-compare"]//*[@class="price-new"]/span/span[1]';
    public static $MainSecondPlaceCard  = './/*[@class="frame-prices-buy-wish-compare"]//*[@class="price-new"]/span/span[2]';
    public static $AdditFirstPlaceCard  = './/*[@class="frame-prices-buy-wish-compare"]//*[@class="price-add"]/span/span[1]';
    public static $AdditSecondPlaceCard  = './/*[@class="frame-prices-buy-wish-compare"]//*[@class="price-add"]/span/span[2]';
    
    public static $CardForm  = '//*[@class="frame-inside page-product"]';
    public static $BuyCardButton  = '//*[@class="btnBuy infoBut"]';
    public static $CartInfo  = '//*[@id="tinyBask"]/div/button/span[2]/span[2]/span[1]';
    public static $CartButton  = './/*[@class="btnBask"]';
    public static $ExecuteOrderCardButton  = './/*[@class="btn-buy btn-buy-p f_r"]';
    
    //FrontEnd Product Cart Price 
    public static $MainFirstCart  = ".//*[@id='popupCart']//*[@class='clearfix']//*[@class='price-new']/span/span[1]";
    public static $MainSecondCart  = ".//*[@id='popupCart']//*[@class='clearfix']//*[@class='price-new']/span/span[1]";
    public static $AdditFirstCart  = ".//*[@id='popupCart']//*[@class='clearfix']//*[@class='price-add']/span/span[1]";
    public static $AdditSecondCart  = ".//*[@id='popupCart']//*[@class='clearfix']//*[@class='price-add']/span/span[1]";
    
    public static $MainFirstPlaceSum  = ".//*[@id='popupCart']//*[@class='table-order']//*[@class='price-new']/span/span[1]";
    public static $MainSecondPlaceSum  = ".//*[@id='popupCart']//*[@class='table-order']//*[@class='price-new']/span/span[2]";
    
    public static $CartDeleteProductButton  = './/*[@class="icon_times_cart"]';
    public static $CloseCartButton  = '//*[@id="popupCart"]/div/button';
    public static $CartForm  = '//*[@id="popupCart"]';
    
    //FrontEnd Product ExecuteOrdering Price 
    
    public static $MainFirstProductExecuteOrdering  = './/*[@class="frame-cur-sum-price"]//*[@class="price-new"]/span/span[1]';
    public static $MainSecondProductExecuteOrdering  = './/*[@class="frame-cur-sum-price"]//*[@class="price-new"]/span/span[2]';
    public static $MainFirstCostProductsExecuteOrdering  = './/*[@class="gen-info-price"]//*[@class="f_r"]/span[1]';
    public static $MainSecondCostProductsExecuteOrdering  = './/*[@class="gen-info-price"]//*[@class="f_r"]/span[2]';
    public static $MainFirstSumExecuteOrdering  = './/*[@class="frame-prices f_r"]//*[@class="price-new"]/span/span[1]';
    public static $MainSecondSumExecuteOrdering  = './/*[@class="frame-prices f_r"]//*[@class="price-new"]/span/span[2]';
    public static $AdditFirstSumExecuteOrdering  = './/*[@class="frame-prices f_r"]//*[@class="price-add"]/span/span[1]';
    public static $AdditSecondSumExecuteOrdering  = './/*[@class="frame-prices f_r"]//*[@class="price-add"]/span/span[2]';
    
    public static $PhoneField  = '//*[@class="m-b_5"]';
    public static $SubmitOrderButton  = '//*[@id="submitOrder"]';
    
    //FrontEnd Product OrderFinish Price 
    
    public static $MainFirstProductOrderFinish  = './/*[@class="frame-cur-sum-price"]//*[@class="price-new"]/span/span[1]';
    public static $MainSecondProductOrderFinish  = './/*[@class="frame-cur-sum-price"]//*[@class="price-new"]/span/span[2]';
    public static $MainFirstCostProductsOrderFinish  = './/*[@class="gen-info-price"]//*[@class="price-new"]/span/span[1]';
    public static $MainSecondCostProductsOrderFinish  = './/*[@class="gen-info-price"]//*[@class="price-new"]/span/span[2]';
    public static $MainFirstSumOrderFinish  = './/*[@class="frame-prices f-s_0 f_r"]//*[@class="price-new"]/span/span[1]';
    public static $MainSecondSumOrderFinish  = './/*[@class="frame-prices f-s_0 f_r"]//*[@class="price-new"]/span/span[2]';
    public static $AdditFirstSumOrderFinish  = './/*[@class="frame-prices f-s_0 f_r"]//*[@class="price-add"]/span/span[1]';
    public static $AdditSecondSumOrderFinish  = './/*[@class="frame-prices f-s_0 f_r"]//*[@class="price-add"]/span/span[2]';
    
    
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