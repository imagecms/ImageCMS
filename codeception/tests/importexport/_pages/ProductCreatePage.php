<?php

class ProductCreatePage

{
       public static $URL = "/admin/components/run/shop/products/create";
       
       //Кнопки
       public static $ButtonCreate = '.btn.btn-small.btn-success.action_on.formSubmit';
       
       //Товар
       //-----------------------------------------------------------------------
            //кнопки
       public static $ButtonActive  = ".prod-on_off";
       public static $ButtonHit     = ".btn.btn-small.setHit";
       public static $ButtonHot     = ".btn.btn-small.setHot";
       public static $ButtonAction  = ".btn.btn-small.setAction";
            
            //поля
       public static $InputName                 = "#Name";
       public static $InputVariantName          = "//section[@class='mini-layout']//tbody//tbody/tr/td[2]/input[2]";
       public static $InputOldPrice             = "//input[@name='OldPrice']";
       public static $InputPrice                = "//input[@name='variants[PriceInMain][]']";
       public static $InputArticle              = "//input[@name='variants[Number][]']";
       public static $InputAmount               = "//input[@name='variants[Stock][]']";
       public static $InputShortDescriptin      = '#ShortDescriptions';
       public static $InputFullDescriptin       = '#FullDescription';
       public static $InputBrand                = "//div[@id='inputParent_chosen']/a";
       
            
            //селекти
       public static $SelectCurrency            = "//select[@class='input-medium'][@name='variants[currency][]']";
       public static $SelectBrand               = "//div[@id='inputParent_chosen']";
       public static $SelectCategory            = "//div[@id='comment_chosen']/a";
       public static $SelectAdditionalCategory  = "#iddCategory_chosen";
       //-----------------------------------------------------------------------

       //Настройки
       //-----------------------------------------------------------------------
       public static $TabSettings           = "//a[@href='#settings']";
            //поля
       public static $InputURL              = '#Url';
       public static $InputMetaTitle        = '#Mtag';
       public static $InputMetaDescription  = '#mDesc';
       public static $InputMetaKeywords     = '#mKey';
       //-----------------------------------------------------------------------
}
