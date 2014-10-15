<?php

class CabinetPage

{
    public static $HeadTitle = "//header/div/div[1]/a/img";   
    public static $HeadLinkConsultation = "//header/div/div[2]/div/div/a/span";   
    public static $HeadQuestionConsultationText = "//header/div/div[2]/div/div/span/span[1]";
    public static $HeadButtonProfile = "//body/div[1]/header/div/ul/li[1]/button";   
    public static $HeadButtonProfileUserData = "//body/ul/li[1]/a";   
    public static $HeadButtonProfileExit = "//body/ul/li[2]/a";   
    public static $HeadButtonShop = "//body/div[1]/header/div/ul/li[2]/a";   
    public static $HeadButtonAdmin = "//header/div/ul/li[4]/a";   
    
    //--- Зелене вікно оплаченого магазу
    public static $HeadLinkBalans = "//body/div[1]/header/div/div[2]/a";   
    public static $HeadTextBalans = '//body/div[1]/header/div/div[2]/a/span[2]/span[1]';
    public static $HeadTextDay = '//body/div[1]/header/div/div[2]/a/span[2]/span[3]';
    
    //--- Червоне вікно неоплаченого магазу
    public static $HeadLinkPaid = '//body/div[1]/header/div/div[2]/div[1]/span[2]/a';
    public static $HeadTextShopOff = '//body/div[1]/header/div/div[2]/div[1]/span[2]/span';
    
    
    //-----------Tab Main------------
    
    public static $TabMain = "//body/div[1]/div/div[1]/nav/ul/li[1]/a";   
    public static $TabMainTitle = "//body/div[1]/div/div[3]/div[1]/div[1]/div";   
    public static $TabMainFieldSiteLabel = "//table/tbody/tr[1]/th";   
    public static $TabMainFieldSiteLink = "//table/tbody/tr[1]/td/a";   
//    public static $TabMainFieldSiteButtonChange = "//table/tbody/tr[1]/td[2]/a";   
    public static $TabMainFieldAdminLabel = "//table/tbody/tr[2]/th";   
    public static $TabMainFieldAdminLink = "//table/tbody/tr[2]/td/a";   
    public static $TabMainFieldAdminText = "//table/tbody/tr[2]/td/div";   
    public static $TabMainFieldTarifLabel = "//table/tbody/tr[3]/th";   
    public static $TabMainFieldTarifNameText = "//table/tbody/tr[3]/td[1]";   
    public static $TabMainFieldTarifButtonChange = "//table/tbody/tr[3]/td[2]/a";   
    public static $TabMainFieldCostLabel = "//table/tbody/tr[4]/th";   
    public static $TabMainFieldCostPrice = "//table/tbody/tr[4]/td";   
    public static $TabMainFieldFillingLabel = "//table/tbody/tr[5]/th";   
    public static $TabMainFieldFillingData = "//table/tbody/tr[5]/td";   
//    public static $TabMainFieldFilling = "";   
//    public static $TabMainFieldFilling = "";   
    public static $TabMainFieldCapacityLabel = "//table/tbody/tr[6]/th";   
    public static $TabMainFieldCapacityData = "//table/tbody/tr[6]/td";   
    public static $TabMainFieldDesignLabel = "//table/tbody/tr[7]/th";   
    public static $TabMainFieldDesignImg = "//table/tbody/tr[7]/td[1]/button";   
    public static $TabMainFieldDesignButtonChange = "//table/tbody/tr[7]/td[2]/a";   
    public static $TabMainFieldPaidToLabel = "//table/tbody/tr[8]/th";   
    public static $TabMainFieldPaidToDate = "//table/tbody/tr[8]/td/span";   
    public static $TabMainFieldPaidToButtonExtend  = "//body/div[1]/div/div[3]/div[1]/div[2]/div/a";   
    
    
    
    //-----------Tab Profile------------
    //--- Блок Дані
    public static $TabProfile = "//body/div[1]/div/div[1]/nav/ul/li[2]/a";  
    public static $TabProfileTitleBlockData = "//body/div[1]/div/div[2]/div[1]/div";  
    public static $TabProfileInputdName = "//div[1]/div/div[2]/div[2]/div/form/div[1]/div[2]/div/input";  
    public static $TabProfileInputNameLabel = "//body/div[1]/div/div[2]/div[2]/div/form/div[1]/div[2]/label";  
    public static $TabProfileInputPhone = "//div[1]/div/div[2]/div[2]/div/form/div[1]/div[3]/div/input";  
    public static $TabProfileInputPhoneLabel = "//body/div[1]/div/div[2]/div[2]/div/form/div[1]/div[3]/label";  
    public static $TabProfileSelectCountry = "//div[1]/div/div[2]/div[2]/div/form/div[1]/div[4]/div/div/div";  
    public static $TabProfileSelectCountryLabel = "//div[1]/div/div[2]/div[2]/div/form/div[1]/div[4]/span";  
    public static $TabProfileInputCity = "//div[1]/div/div[2]/div[2]/div/form/div[1]/div[5]/div/input";  
    public static $TabProfileInputCityLabel = "//div[1]/div/div[2]/div[2]/div/form/div[1]/div[5]/label";  
    public static $TabProfileSelectCategory = "//div[1]/div/div[2]/div[2]/div/form/div[1]/div[6]/div/div/div/div[2]";  
    public static $TabProfileSelectCategoryLabel = "//div[1]/div/div[2]/div[2]/div/form/div[1]/div[6]/span";  
    public static $TabProfileSelectProduct = "//div[1]/div/div[2]/div[2]/div/form/div[1]/div[7]/div/div/div/div[2]";  
    public static $TabProfileSelectProductLabel = "//div[1]/div/div[2]/div[2]/div/form/div[1]/div[7]/span";  
    public static $TabProfileBlockDataButtonSave = "//div[1]/div/div[2]/div[2]/div/form/button";  
    //--- Блок Логін і пароль     
    public static $TabProfileTitleBlockLogin = "//body/div[1]/div/div[2]/div[3]/div";  
    public static $TabProfileInputEmail = "//div[1]/div/div[2]/div[4]/div/form/div/div[2]/div/input";  
    public static $TabProfileInputEmailLabel = "//div[1]/div/div[2]/div[4]/div/form/div/div[2]/label";  
    public static $TabProfileInputNewPassword = "//div[1]/div/div[2]/div[4]/div/form/div/div[3]/div/input";  
    public static $TabProfileInputNewPasswordLabel = "//div[1]/div/div[2]/div[4]/div/form/div/div[3]/label";  
    public static $TabProfileInputOldPassword = "//div[1]/div/div[2]/div[4]/div/form/div/div[4]/div/input";  
    public static $TabProfileInputOldPasswordLabel = "//body/div[1]/div/div[2]/div[4]/div/form/div/div[4]/label";  
    public static $TabProfileInputReplayNewPassword = "//div[1]/div/div[2]/div[4]/div/form/div/div[5]/div/input";  
    public static $TabProfileInputReplayNewPasswordLabel = "//body/div[1]/div/div[2]/div[4]/div/form/div/div[5]/label";  
    public static $TabProfileBlockLoginButtonSave = "//div[1]/div/div[2]/div[4]/div/form/button"; 
    
    
    
//    public static $TabSystemTour = "";   
    
//    public static $TabTechnicalSupport = "";  
    
//    public static $TabMyAdditions = "";   
    
//    public static $TabPayments = "";   
    
    public static $TabChoiceTarif = "";   
    public static $TabChoiceTarif = "";   
    public static $TabChoiceTarif = "";   
    public static $TabChoiceTarif = "";   
    public static $TabChoiceTarif = "";   
    
//    public static $TabConfigureDomain = "";  
    
//    public static $TabAdditionalServices = "";   
    
}  
     

