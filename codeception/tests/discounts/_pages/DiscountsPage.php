<?php

class DiscountsPage
{
    //Buttons
public static $CreateDiscount  = ".//*[@id='mainContent']/section/div[1]/div[2]/div/a";    
public static $GoBackButton  = './/*[@id="mainContent"]/section/div[1]/div[2]/div/a/span[2]';
public static $SaveButton  = './/*[@id="mainContent"]/section/div[1]/div[2]/div/button[1]';
public static $SaveAndExitButton  = './/*[@id="mainContent"]/section/div[1]/div[2]/div/button[2]';
    //Main Fields & Main Elements on page
public static $NameDiscountCreate  = ".//*[@id='createDiscountForm']/table/tbody/tr[1]/td/div/div/label[1]/span[2]/input"; 
public static $NameDiscountEdit  = ".//*[@id='editDiscountForm']/table/tbody/tr[1]/td/div/div/label[1]/span[2]/input";
public static $DiscountKey  = ".//*[@id='discountKey']";
public static $AmountOfUse  = ".//*[@id='how-much']";
public static $SelectMethod  = ".//*[@id='selectTypeValue']";
public static $ValueDiscount  = ".//*[@id='valueInput']";
public static $SelectTypeDiscount  = ".//*[@id='selectDiscountType']";
public static $OnDateCreate  = ".//*[@id='createDiscountForm']/table/tbody/tr[4]/td/div/div[2]/div/div/span/label/input";
public static $OnDateEdit  = ".//*[@id='editDiscountForm']/table/tbody/tr[4]/td/div/div[2]/div/div/span/label/input";
public static $UntilDateCreate  = ".//*[@id='createDiscountForm']/table/tbody/tr[4]/td/div/div[2]/div[2]/div/span[3]/div/label/input";
public static $UntilDateEdit  = ".//*[@id='editDiscountForm']/table/tbody/tr[4]/td/div/div[2]/div[2]/div/span[3]/div/label/input";
public static $UnlimitedCheckboxCreate  = ".//*[@id='createDiscountForm']/table/tbody/tr[1]/td/div/div/div[2]/div[2]/span[2]/span/span";
public static $UnlimitedCheckboxEdit  = ".//*[@id='editDiscountForm']/table/tbody/tr[1]/td/div/div/div[2]/div[2]/span[2]/span/span";
public static $ConstantDiscountCheckboxCreate  = ".//*[@id='createDiscountForm']/table/tbody/tr[4]/td/div/div[2]/div[2]/div/span[3]/div/div/span/span";
public static $ConstantDiscountCheckboxEdit  = ".//*[@id='editDiscountForm']/table/tbody/tr[4]/td/div/div[2]/div[2]/div/span[3]/div/div/span/span";
    //Fields & Elements of AllOrder Discount
public static $BeginValueDiscount  = ".//*[@id='all_orderBlock']/span/span[1]/input";
public static $OnlyForAutorizedCheckbox  = ".//*[@id='all_orderBlock']/div[1]/span/span";
public static $GiftSertificateCheckbox  = ".//*[@id='giftSpanCheckbox']/span";
    //Fields & Elements of Cumulative Discount
public static $BeginValue  = ".//*[@id='comulativBlock']/span[2]/input";
public static $EndValue  = ".//*[@id='comulativBlock']/div/span[2]/input";
public static $MaxCheckbox  = ".//*[@id='comulativBlock']/div/span[4]/span/span";
    //Fields & Elements of User Discount
public static $UserForDiscount  = ".//*[@id='usersForDiscount']";
    //Fields & Elements of Category Discount
public static $SelectCategory  = ".//*[@id='categoryBlock']/div/a/span";
public static $ChildCategoryCheckbox  = ".//*[@id='categoryBlock']/input";
    //Fields & Elements of Product Discount
public static $ProductForDiscount  = ".//*[@id='productForDiscount']";
    //Fields & Elements of Brand Discount
public static $SelectBrand  = ".//*[@id='selectBrand_chosen']/a/span";


public static function DisKeyLine($row){
    $Key = ".//*[@id='mainContent']/section/div[2]/table/tbody/tr[$row]/td[1]/a";
    return $Key;
}
public static function NameLine($row){
    $NameDis = ".//*[@id='mainContent']/section/div[2]/table/tbody/tr[$row]/td[2]/p"; 
    return $NameDis;
}
public static function LimitLine($row){
    $DisLimit = ".//*[@id='mainContent']/section/div[2]/table/tbody/tr[$row]/td[3]";
    return $DisLimit;
}
public static function UseDiscLine($row){
    $DisUse = ".//*[@id='mainContent']/section/div[2]/table/tbody/tr[$row]/td[4]";
    return $DisUse;
}
public static function BeginTimeLine($row){
    $TimeBegin = ".//*[@id='mainContent']/section/div[2]/table/tbody/tr[$row]/td[5]";
    return $TimeBegin;
}
public static function EndTimeLine($row){
    $TimeEnd = ".//*[@id='mainContent']/section/div[2]/table/tbody/tr[$row]/td[6]";
    return $TimeEnd;
}
public static function ActiveButtonLine($row){
    $ActBut = ".//*[@id='mainContent']/section/div[2]/table/tbody/tr[$row]/td[7]/div/span";
    return $ActBut;
}
public static function DeleteButtonLine($row){
    $DelBut = ".//*[@id='mainContent']/section/div[2]/table/tbody/tr[$row]/td[8]/button";
    return $DelBut;
}











}