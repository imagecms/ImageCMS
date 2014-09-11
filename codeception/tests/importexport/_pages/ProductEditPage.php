<?php

class ProductEditPage
{

   public static $InputProductName = '#Name';
   public static $ButtonStatusHit = "//section[@class='mini-layout']/form/div[2]/div[1]/div/div[1]/div[2]/div/button[1]";
   public static $ButtonStatusNew = "//section[@class='mini-layout']/form/div[2]/div[1]/div/div[1]/div[2]/div/button[1]";
   public static $ButtonStatusAction = "//section[@class='mini-layout']/form/div[2]/div[1]/div/div[1]/div[2]/div/button[1]";
   public static $InputOldPrice = '#oldP';

   public static $ButtonActive = "//section[@class='mini-layout']/form/div[2]/div[1]/div/div[1]/div[1]/div[2]/div/span";
   public static $SelectBrend = "//section/form/div[2]/div[1]/div/div[2]/div/div[1]/div/div/a";
   public static $SelectCategory = "//section/form/div[2]/div[1]/div/div[2]/div/div[2]/div/div/a";
   
   public static $ProductVariantRow = '#ProductVariantRow_0';
   public static $InputProductVariantName = "//tr[@id='ProductVariantRow_0']/td[2] /input[@type='text']";
   public static $InputProductVariantPrice = "//tr[@id='ProductVariantRow_0']/td[3] /input[@type='text']";
   public static $SelectProductVariantCurrency = "//tr[@id='ProductVariantRow_0']/td[4] //select";
   public static $InputProductvariantArticle = "//tr[@id='ProductVariantRow_0']/td[5] //input";
   public static $InputProductVariantAmount = "//tr[@id='ProductVariantRow_0']/td[6] //input";
   public static $TextareaShortDescription = '#ShortDescriptions';
   public static $TextareaFullDescription = '#FullDescriptions';
   
   
   //Вкладка Настройки
   public static $TabSettings = "//section[@class='mini-layout']/form/div[1]/div[1]/a[6]";

   public static $SettingsInputdUrl = '#Url';
   public static $SettingsInputMetaTitle = '#Mtag';
   public static $SettingsInputMetaDescription = '#mDesc';
   public static $SettingsInputMetaKeywords = '#mKey';

}