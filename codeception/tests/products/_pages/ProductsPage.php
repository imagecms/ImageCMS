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
    public static $StatusMenu  = '//*[@id="filter_form"]/section/div[1]/div[2]/div/div/ul';
    public static $DeleteButton  = ".//*[@id='del_in_search']";    
    //Кнопки в создании
    public static $ProductButton  = '//*[@id="image_upload_form"]/div[1]/div/a[1]';
    public static $PreferencesButton  = '//*[@id="image_upload_form"]/div[1]/div/a[2]';
    public static $GoBackButton  = './/*[@id="mainContent"]/section/div[1]/div[2]/div/a/span[2]';
    public static $SaveButton  = './/*[@id="mainContent"]/section/div[1]/div[2]/div/button[1]';
    public static $SaveAndExitButton  = './/*[@id="mainContent"]/section/div[1]/div[2]/div/button[2]';
    //Поля
    public static $NameProduct  = ".//*[@id='Name']";
    public static $OldPrice  = ".//*[@id='oldP']";
    public static $NameVariantProduct  = ".//*[@id='ProductVariantRow_0']/td[2]/input[2]";
    public static $Price  = ".//*[@id='ProductVariantRow_0']/td[3]/input";
    public static $Currency  = ".//*[@id='ProductVariantRow_0']/td[4]/select";
    public static $Articul  = ".//*[@id='ProductVariantRow_0']/td[5]/input";
    public static $Amount  = ".//*[@id='ProductVariantRow_0']/td[6]/input";
    public static $ImageIcon  = ".//*[@id='ProductVariantRow_0']/td[1]/div/div";
    public static $BrandName  = '//*[@id="inputParent_chosen"]';   //div/ul  
    public static $BrandNameChosenList  = '//*[@id="inputParent"]';
    public static $Category  = '//*[@id="comment_chosen"]';    //div/ul 
    public static $AdditionalCategory  = '//*[@id="iddCategory_chosen"]';
    public static $ShortDescription  = ".//*[@id='ShortDescriptions']";
    public static $FullDescription  = ".//*[@id='FullDescription']";
    //Additional Preferences
    public static function Comments($agree){
        $Com = "//*[@id='settings']/div/div[2]/table/tbody/tr/td/div/div/div/div[1]/div/span[$agree]";
        return $Com;
    }
    public static $DateOfCreate  = ".//*[@id='dCreate']";    
    public static $MainTemplate  = ".//*[@id='templateGH']";
    //Meta Data
    public static $UrlField  = ".//*[@id='Url']";
    public static $MetaTitle  = ".//*[@id='Mtag']";
    public static $MetaDescription  = ".//*[@id='mDesc']";
    public static $MetaKeywords  = ".//*[@id='mKey']";
    public static $AutoSelectButton  = ".//*[@id='translateProductUrl']";
    
    public static $ActiveButton  = '//*[@id="parameters"]/div/div[1]/div[1]/div[2]/div/span';
    public static $EditImageButton  = ".//*[@id='ProductVariantRow_0']/td[1]/div/div/div[2]/button[1]";
    public static $ImageDownloadButton  = ".//*[@id='ProductVariantRow_0']/td[1]/div/div/div[2]/button[2]";
    public static $HotProductButton  = '//*[@id="parameters"]/div/table/tbody/tr/td/div/div[1]/div[2]/div/button[1]';
    public static $NewProductButton  = '//*[@id="parameters"]/div/table/tbody/tr/td/div/div[1]/div[2]/div/button[2]';
    public static $SaleProductButton  = '//*[@id="parameters"]/div/table/tbody/tr/td/div/div[1]/div[2]/div/button[3]';
    public static $AddVariantButton  = ".//*[@id='addVariant']";
    
    //Кнопки в редактировании
    public static $PropertyButton  = '//*[@id="image_upload_form"]/div[1]/div[1]/a[2]';
    public static $ImagesButton  = '//*[@id="image_upload_form"]/div[1]/div[1]/a[3]';
    public static $KitsProductButton  = '//*[@id="image_upload_form"]/div[1]/div[1]/a[4]';
    public static $AccessoriesButton  = '//*[@id="image_upload_form"]/div[1]/div[1]/a[5]';
    public static $PrefButtonEditing  = '//*[@id="image_upload_form"]/div[1]/div[1]/a[6]';
                                         
    public static $NameVariantProductEdit  = '//*[@id="ProductVariantRow_0"]/td[2]/input[4]';
    public static $AccessoryEdit  = '//*[@id="RelatedProducts"]';
    //Кнопки в списке
    public static function CheckboxLine($row){
        $Checkbox = ".//*[@id='filter_form']/section/div[2]/table/tbody/tr[$row]/td[1]/span/span";
        return $Checkbox;
    }
    public static function IdLine($row){
        $Id = ".//*[@id='filter_form']/section/div[2]/table/tbody/tr[$row]/td[2]/p";
        return $Id;
    }
    public static function ProductNameLine($row){
        $NameProd = ".//*[@id='filter_form']/section/div[2]/table/tbody/tr[$row]/td[3]/div/a";
        return $NameProd;
    }   
    public static function ProductReviewButton($row){
        $RevBut = "//*[@id='filter_form']/section/div[2]/table/tbody/tr[$row]/td[3]/a";
        return $RevBut;
    } 
    public static function CategoryLine($row) {
        $Category = ".//*[@id='filter_form']/section/div[2]/table/tbody/tr[$row]/td[4]/div/a";
        return $Category;
    }
    public static function ArticulLine($row) {
        $Artic = ".//*[@id='filter_form']/section/div[2]/table/tbody/tr[$row]/td[5]/p";
        return $Artic;
    }
    public static function ActiveButtonLine($row) {
        $ActBut = ".//*[@id='filter_form']/section/div[2]/table/tbody/tr[$row]/td[6]/div/span";
        return $ActBut;
    }
    public static function StatusLine1($row) {
        $StatBut1 = ".//*[@id='filter_form']/section/div[2]/table/tbody/tr[$row]/td[7]/button[1]";
        return $StatBut1;
    }
    public static function StatusLine2($row) {
        $StatBut2 = ".//*[@id='filter_form']/section/div[2]/table/tbody/tr[$row]/td[7]/button[2]";
        return $StatBut2;
    }
    public static function StatusLine3($row) {
        $StatBut3 = ".//*[@id='filter_form']/section/div[2]/table/tbody/tr[$row]/td[7]/button[3]";
        return $StatBut3;
    }
    public static function PriceFieldLine($row) {
        $Price = ".//*[@id='filter_form']/section/div[2]/table/tbody/tr[$row]/td[8]/div/input";
        return $Price;
    }
    public static function PriceCurrencySymbolLine($row) {
        $Symb = ".//*[@id='filter_form']/section/div[2]/table/tbody/tr[$row]/td[8]/span";
        return $Symb;
    }
    public static function PaginationLine($row) {
        $Pag = ".//*[@id='filter_form']/section/div[2]/div/div[1]/ul/li[$row]/a";
        return $Pag;
    }
    public static function ButtonsFront($row) {
        $But = "html/body/div[1]/div[2]/div[2]/div[3]/ul/li[$row]/button";
        return $But;
    }
}