<?php



class CreateProductsOrdersPage



{
    //Creating Order "Create Products 'Defolt' ".
       
       public static $CrtProductPageURL = "/admin/components/run/shop/products/create";
       public static $CrtProductNameProduct = "//table[1]/tbody/tr/td/div/div/div[1]/div[1]/div/input";
       public static $CrtProductPriceProduct = "//tbody/tr/td/div/div/div[1]/div[4]/table/tbody/tr/td[2]/input";
       public static $CrtProductArticleProduct = "//tbody/tr/td/div/div/div[1]/div[4]/table/tbody/tr/td[4]/input";
       public static $CrtProductAmountProduct = "//table[1]/tbody/tr/td/div/div/div[1]/div[4]/table/tbody/tr[1]/td[5]/input";
       public static $CrtProductCategoryProductSelectField = "//tbody/tr/td/div/div/div[2]/div/div[2]/div/div/a";
       public static $CrtProductCategoryProductSelectInput = "//tbody/tr/td/div/div/div[2]/div/div[2]/div/div/div/div/input";
       public static $CrtProductCategoryProductSetSelect = "//tbody/tr/td/div/div/div[2]/div/div[2]/div/div/div/ul/li";
       public static $CrtProductVariantButtonADD = "//tbody/tr/td/div/div/div[1]/div[4]/table/tfoot/tr/td/div/button";
       public static $CrtProductVariantFieldName = "//tbody/tr[2]/td[1]/div/input[3]";
       public static $CrtProductVariantFieldPrice = "//body/div[1]/div[5]/section/form/div/div[2]/div[1]/table[1]/tbody/tr/td/div/div/div[1]/div[4]/table/tbody/tr[2]/td[2]/input";
       public static $CrtProductVariantFieldArticle = "//body/div[1]/div[5]/section/form/div/div[2]/div[1]/table[1]/tbody/tr/td/div/div/div[1]/div[4]/table/tbody/tr[2]/td[4]/input";
       public static $CrtProductVariantFieldAmount = "//body/div[1]/div[5]/section/form/div/div[2]/div[1]/table[1]/tbody/tr/td/div/div/div[1]/div[4]/table/tbody/tr[2]/td[5]/input";
       public static $CrtProductButtonSaveandBack = "//body/div[1]/div[5]/section/div/div[2]/div/button[2]";
       
       
       
    
       
    //Defolt Values For Created Products
       
    public static $CrtPrdNameMin = "....."; 
    public static $CrtPrdNameMax = "qwertyuioasdfghjklzxcvbnmйцукенгшщзхъфывапролдджэячсмиттьбюQWERTYUIOPASDFGHJKLZXCVBNMЙЦУКЕННГШГШЩЗФЫВАПРОЛДЖЭЯЧСМИТЬБЮqwertyuioasdfghjklzxcvbnmйцукенгшщзхъфывапролдджэячсмиттьбюQWERTYUIOPASDFGHJKLZXCVBNMЙЦУКЕННГШГШЩЗФЫВАПРОЛДЖЭЯЧСМИТЬБЮqwertyuioasdfghjklzxcvbnmйцукенгшщзхъфывапролдджэячсмиттьбюQWERTYUIOPASDFGHJKLZXCVBNMЙЦУКЕННГШГШЩЗФЫВАПРОЛДЖЭЯЧСМИТЬБЮqwertyuioasdfghjklzxcvbnmйцукенгшщзхъфывапролдджэячсмиттьбюQWERTYUIOPASDFGHJKLZXCVBNMЙЦУКЕННГШГШЩЗФЫВАПРОЛДЖЭЯЧСМИТЬБЮQWEQWEQWEQWEQWEASDASDZXCASDQ"; 
    public static $CrtPrdPriceMin = "1"; 
    public static $CrtPrdPriceMax = "10000000000000"; 
    public static $CrtPrdArticleMin = "R2D2"; 
    public static $CrtPrdArticleMax = "АааРррТттИииКккУууЛллМммАааКккСссАааРррТттИииКккУууЛллМммАааКккСссАааРррТттИииКккУууЛллМммАааКккСссАааРррТттИииКккУууЛллМммАааКккСссАааРррТттИииКккУууЛллМммАааКккСссАааРррТттИииКккУууЛллМммАааКккСссАааРррТттИииКккУууЛллМммАааКккСссАааРррТттИииКккУууЛллМмм"; 
    public static $CrtPrdAmountMin = "0"; 
    public static $CrtPrdAmountMax = "2147483647"; 
    public static $CrtVarNameMin = "VoP"; 
    public static $CrtVarNameMax = "фффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффффф"; 
    public static $CrtVarPriceMin = "1"; 
    public static $CrtVarPriceMax = "10000000000000"; 
    public static $CrtVarArticleMin = "D3R3"; 
    public static $CrtVarArticleMax = "ъъъъъъъъВариантаоооооооооооАРТИКУЛееееееееееееееМММаааКСъъъъъъъъВариантаоооооооооооАРТИКУЛееееееееееееееМММаааКСъъъъъъъъВариантаоооооооооооАРТИКУЛееееееееееееееМММаааКСъъъъъъъъВариантаоооооооооооАРТИКУЛееееееееееееееМММаааКСееееееееееееМММаааКСМаааКСйцууу"; 
    public static $CrtVarAmountMin = "0"; 
    public static $CrtVarAmountMax = "2147483647"; 
}

