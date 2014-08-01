<?php


class CreateCategoryOrdersPage


{
    //Creating Order "Create Category 'Defolts' ".
       
       public static $CrtCategoryPageURL = "/admin/components/run/shop/categories/create";
       public static $CrtCategoryFieldName = "#inputName";
       public static $CrtCategorySelectMenu = "//div[1]/div[2]/div/div/a";
       public static $CrtCategorySelectMenuInput = "//section/form/div[1]/table[1]/tbody/tr/td/div/div[1]/div[2]/div/div/div/div/input";
       public static $CrtCategorySelectMenuSetSearch = "//section/form/div[1]/table[1]/tbody/tr/td/div/div[1]/div[2]/div/div/div/ul/li";
       public static $CrtCategoryButtonSaveandBack = "//button[2]";
       
       
       
       //Defolt Values For Created Category
       
       public static $CrtCatName1 = "Основная КаТеГоРиЯ";
       public static $CrtCatName2= "First Дочерная";
       public static $CrtCatName3 = "Second ДоЧеРнАя";
       public static $CrtCatName1ForSearch = "Основная";
       public static $CrtCatName2ForSearchOrder = "First";
       public static $CrtCatName2ForSearchCategory = "-First";
       public static $CrtCatName3ForSearchCategory = "--Second";
       public static $CrtCatName3ForSearchOrder = "Second";
}

