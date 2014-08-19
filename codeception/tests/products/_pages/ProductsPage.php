<?php

class ProductsPage
{
   //URL of currencies list page
    public static $URL = '/admin/components/run/shop/search/index';

    //Кнопки в списке
    public static $CreateProductButton  = ".//*[@id='filter_form']/section/div[1]/div[2]/div/a[2]";
    public static $FilterButton  = ".//*[@id='filter_form']/section/div[1]/div[2]/div/button[1]";
    public static $CancelFilterButton  = ".//*[@id='filter_form']/section/div[1]/div[2]/div/button[2]";
    public static $ChangeStatusButton  = ".//*[@id='filter_form']/section/div[1]/div[2]/div/div/button";
    public static $DeleteButton  = ".//*[@id='del_in_search']";    
    //Кнопки в создании
    public static $ProductButton  = ".//*[@id='image_upload_form']/div/div[1]/div/a";
    public static $GoBackButton  = './/*[@id="mainContent"]/section/div[1]/div[2]/div/a/span[2]';
    public static $SaveButton  = './/*[@id="mainContent"]/section/div[1]/div[2]/div/button[1]';
    public static $SaveAndExitButton  = './/*[@id="mainContent"]/section/div[1]/div[2]/div/button[2]';
    //Поля
    public static $NameProduct  = ".//*[@id='Name']";
    public static $NameVariantProduct  = ".//*[@id='ProductVariantRow_0']/td[1]/input[2]";
    public static $Price  = ".//*[@id='ProductVariantRow_0']/td[2]/input";
    public static $Currency  = ".//*[@id='ProductVariantRow_0']/td[3]/select";
    public static $Articul  = ".//*[@id='ProductVariantRow_0']/td[4]/input";
    public static $Amount  = ".//*[@id='ProductVariantRow_0']/td[5]/input";
    public static $BrandName  = '//*[@id="inputParent_chosen"]';   //div/ul     
    public static $Category  = '//*[@id="comment_chosen"]';    //div/ul 
    public static $AdditionalCategory  = '//*[@id="iddCategory_chosen"]/ul/li/input';
    public static $ShortDescription  = ".//*[@id='ShortDescriptions']";
    public static $FullDescription  = ".//*[@id='FullDescriptions']";
    public static $Comments  = ".//*[@id='comments']";
    public static $DateOfCreate  = ".//*[@id='dCreate']";
    public static $OldPrice  = ".//*[@id='oldP']";
    public static $MainTemplate  = ".//*[@id='templateGH']";
    public static $UrlField  = ".//*[@id='Url']";
    public static $MetaTitle  = ".//*[@id='Mtag']";
    public static $MetaDescription  = ".//*[@id='mDesc']";
    public static $MetaKeywords  = ".//*[@id='mKey']";
    
    public static $EditImageButton  = ".//*[@id='ProductVariantRow_0']/td[6]/div/div/div[2]/button[1]";
    public static $HotProductButton  = ".//*[@id='parameters']/table[1]/tbody/tr/td/div/div/div[1]/div[3]/div/button[1]";
    public static $NewProductButton  = ".//*[@id='parameters']/table[1]/tbody/tr/td/div/div/div[1]/div[3]/div/button[2]";
    public static $SaleProductButton  = ".//*[@id='parameters']/table[1]/tbody/tr/td/div/div/div[1]/div[3]/div/button[3]";
    public static $AutoSelectButton  = ".//*[@id='translateProductUrl']";
    public static $AddVariantButton  = ".//*[@id='addVariant']";
    
    //Кнопки в списке
    public static function ActiveButtonLine($row){
        $ActiveBut = "//tbody/tr[$row]/td[6]/div/span";
        return $ActiveBut;
    }
    public static function DeleteButtonLine($row){
        $DeleteBut = "//tbody/tr[$row]/td[7]/button";
        return $DeleteBut;
    }
    public static function RadioButtonLine($row){
        $RadioBut = "//tbody//tr[$row]//td[5]/input";
        return $RadioBut;
    }
    //Currency name in table
    public static function CurrencyNameLine($row) {
        $CurrencyLine = "//tbody/tr[$row]/td[2]/a";
        return $CurrencyLine;
    }
}