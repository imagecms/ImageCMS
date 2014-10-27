<?php

class ExportPage

{
       public static $Url = "/admin/components/init_window/import_export/getTpl/export";
       public static $ButtonExport = ".btn.btn-small.action_on.runExport";
       
       //   Чекбокси
       public static $Chek1Column = "//tbody/tr/td/form/div/div[1]/div[1]/span/span";
       public static $Chek2Name = "//tbody/tr/td/form/div/div[1]/div[2]/span/span";
       public static $Chek3URL = "//tbody/tr/td/form/div/div[1]/div[3]/span/span";
       public static $Chek4Price = "//tbody/tr/td/form/div/div[1]/div[4]/span/span";
       public static $Chek5OldPrice = "//tbody/tr/td/form/div/div[1]/div[5]/span/span";
       public static $Chek6Amount = "//tbody/tr/td/form/div/div[1]/div[6]/span/span";
       public static $Chek7Article = "//tbody/tr/td/form/div/div[1]/div[7]/span/span";
       public static $Chek8Variant = "//tbody/tr/td/form/div/div[1]/div[8]/span/span";
       public static $Chek9Active = "//tbody/tr/td/form/div/div[1]/div[9]/span/span";
       public static $Chek10Hit = "//tbody/tr/td/form/div/div[1]/div[10]/span/span";
       public static $Chek11New = "//tbody/tr/td/form/div/div[1]/div[11]/span/span";
       public static $Chek12Action = "//tbody/tr/td/form/div/div[1]/div[12]/span/span";
       
       
       public static $Chek13Brand = "//tbody/tr/td/form/div/div[1]/div[13]/span/span";
       public static $Chek14Category = "//tbody/tr/td/form/div/div[1]/div[14]/span/span";
       public static $Chek15LinkedProduct = "//tbody/tr/td/form/div/div[1]/div[15]/span/span";
       public static $Chek16MainImg = "//tbody/tr/td/form/div/div[1]/div[16]/span/span";
       public static $Chek17Currency = "//tbody/tr/td/form/div/div[1]/div[17]/span/span";
       public static $Chek18MoreImg = "//tbody/tr/td/form/div/div[1]/div[18]/span/span";
       public static $Chek19SmallDescription = "//tbody/tr/td/form/div/div[1]/div[19]/span/span";
       public static $Chek20FullDescription = "//tbody/tr/td/form/div/div[1]/div[20]/span/span";
       public static $Chek21MetaTitle = "//tbody/tr/td/form/div/div[1]/div[21]/span/span";
       public static $Chek22MetaDis = "//tbody/tr/td/form/div/div[1]/div[22]/span/span";
       public static $Chek23MetaKey = "//tbody/tr/td/form/div/div[1]/div[23]/span/span";

       /**
        * void
        * @return array
        */
       public static function allCheckboxes(){
           return [self::$Chek1Column,  self::$Chek2Name, self::$Chek3URL, self::$Chek4Price, self::$Chek5OldPrice, self::$Chek6Amount,
           self::$Chek7Article, self::$Chek8Variant, self::$Chek9Active, self::$Chek10Hit, self::$Chek11New, self::$Chek12Action, self::$Chek13Brand,
           self::$Chek14Category, self::$Chek15LinkedProduct, self::$Chek16MainImg, self::$Chek17Currency,
           self::$Chek18MoreImg, self::$Chek19SmallDescription, self::$Chek20FullDescription,  self::$Chek21MetaTitle,
           self::$Chek22MetaDis, self::$Chek23MetaKey];
       }
       // Селект меню "Категории"
       public static $SelectCategory= "#selectedCats"; 
//       public static $SelectField = "//tbody/tr/td/form/div/div[2]/div[1]/div/ul/li/input"; 
       public static $SelectSearch = "//tbody/tr/td/form/div/div[2]/div[1]/div/div/ul/li"; 
       
       public static $ButtonShowProperties = "//table/tbody/tr/td/form/div/div[2]/div[1]/button"; 
       
       public static $RadioCSV =  '//tbody/tr/td/form/div/div[3]/div/span[1]/span';
       public static $RadioXLSX = '//tbody/tr/td/form/div/div[3]/div/span[2]/span';
       public static $RadioXLS =  '//tbody/tr/td/form/div/div[3]/div/span[3]/span';
}
//var_dump(ExportPage::allCheckboxes());
