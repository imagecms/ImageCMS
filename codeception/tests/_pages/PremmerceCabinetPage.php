<?php

class PremmerceCabinetPage
{
    // include url of current page
//    public static $URL = '';
    
    public static $SiteLink = "/html/body/div[1]/div/div[3]/div[1]/table/tbody/tr[1]/td[1]/a";
    public static $AdminLink = "/html/body/div[1]/div/div[3]/div[1]/table/tbody/tr[2]/td/a";
    public static $StoreButton = "/html/body/div[1]/header/div/ul/li[2]/a/span[2]";
    public static $AdminButton = "/html/body/div[1]/header/div/ul/li[4]/a/span";
    public static $ProfileButton = "/html/body/div[1]/header/div/ul/li[1]/button/span[2]/span[1]";        
    public static $PersonalDataButton='/html/body/ul/li[1]';
    public static $ExitButton = "/html/body/ul/li[2]";   

    //Language Buttons on .COM.UA
    public static $UkrLangProfileButton = "/html/body/div[1]/div/div[1]/div/ul/li[1]";
    public static $RusLangProfileButton = "/html/body/div[1]/div/div[1]/div/ul/li[2]";
    
    
    
    
    
    
    
    
    
    
    
    //---------------------------------------------------------------------------
    //---------------------------------------------------------------------------
    //---------------------------------------------------------------------------
    
    public static $HeadTitleImg = "//header/div/div[1]/a/img";   
    public static $HeadLinkBalans = "//body/div[1]/header/div/div[2]/a";   
    public static $HeadLinkProfile = "//header/div/ul/li[1]/button";   
    public static $HeadLinkProfileLinkUserData = "//body/ul/li[1]/a";   
    public static $HeadLinkProfileLinkExit = "//body/ul/li[2]/a";   
    public static $HeadLinkShop = "//body/div[1]/header/div/ul/li[2]/a";   
    public static $HeadLinkAdmin = "//header/div/ul/li[4]/a";   
    public static $HeadLinkConsultation = "//header/div/div[2]/div/div/a/span";   
    public static $HeadQuestionConsultationText = "//header/div/div[2]/div/div/span/span[1]";
    public static $HeadTextBalans = '//body/div[1]/header/div/div[2]/a/span[2]/span[1]';
    public static $HeadTextDay = '//body/div[1]/header/div/div[2]/a/span[2]/span[3]';
    public static $HeadTextShopOff = '//body/div[1]/header/div/div[2]/div[1]/span[2]/span';
    public static $HeadTextPaid = '//body/div[1]/header/div/div[2]/div[1]/span[2]/a';
    
    //-----------Tab Main------------
    
    public static $TabMain = "//body/div[1]/div/div[1]/nav/ul/li[1]/a";   
    public static $TabMainBlockText = "//body/div[1]/div/div[3]/div[1]/div[1]/div";   
    public static $TabMainFieldSiteLabel = "//table/tbody/tr[1]/th";   
    public static $TabMainFieldSiteLink = "//table/tbody/tr[1]/td/a";   
    public static $TabMainFieldSiteButtonChange = "//table/tbody/tr[1]/td[2]/a";   
    public static $TabMainFieldAdminLabel = "//table/tbody/tr[2]/th";   
    public static $TabMainFieldAdminLink = "//table/tbody/tr[2]/td/a";   
    public static $TabMainFieldTarifLabel = "//table/tbody/tr[3]/th";   
    public static $TabMainFieldTarifNameTarif = "//table/tbody/tr[3]/td[1]";   
    public static $TabMainFieldTarifButtonChange = "//table/tbody/tr[3]/td[2]/a";   
    public static $TabMainFieldCostLabel = "//table/tbody/tr[4]/th";   
    public static $TabMainFieldCostPrice = "//table/tbody/tr[4]/td";   
    public static $TabMainFieldFillingLabel = "//table/tbody/tr[5]/th";   
    public static $TabMainFieldFillingData = "//table/tbody/tr[5]/td";   
//    public static $TabMainFieldFilling = "";   
//    public static $TabMainFieldFilling = "";   
//    public static $TabMainFieldCapacityLabel = "";   
//    public static $TabMainFieldCapacityData = "";   
//    public static $TabMainFieldDesignLabel = "";   
//    public static $TabMainFieldDesignImg = "";   
//    public static $TabMainFieldDesignButtonChange = "";   
//    public static $TabMainFieldPaidtoLabel = "";   
//    public static $TabMainFieldPaidtoDate = "";   
//    public static $TabMainFieldPaidtoButtonextend  = "";   
    
    
    //-----------Tab Profile-------
    
    public static $TabProfile = "//body/div[1]/div/div[1]/nav/ul/li[2]/a";  
    public static $TabProfileBlockDataText = "//body/div[1]/div/div[2]/div[1]/div";  
    public static $TabProfileFieldName = "//div[1]/div/div[2]/div[2]/div/form/div[1]/div[2]/div/input";  
    public static $TabProfileFieldNameLabel = "//body/div[1]/div/div[2]/div[2]/div/form/div[1]/div[2]/label";  
    public static $TabProfileFieldPhone = "//div[1]/div/div[2]/div[2]/div/form/div[1]/div[3]/div/input";  
    public static $TabProfileFieldPhoneLabel = "//body/div[1]/div/div[2]/div[2]/div/form/div[1]/div[3]/label";  
    public static $TabProfileSelectCountry = "//div[1]/div/div[2]/div[2]/div/form/div[1]/div[4]/div/div/div";  
    public static $TabProfileSelectCountryLabel = "//div[1]/div/div[2]/div[2]/div/form/div[1]/div[4]/span";  
    public static $TabProfileFieldCity = "//div[1]/div/div[2]/div[2]/div/form/div[1]/div[5]/div/input";  
    public static $TabProfileFieldCityLabel = "//div[1]/div/div[2]/div[2]/div/form/div[1]/div[5]/label";  
    public static $TabProfileSelectCategory = "//div[1]/div/div[2]/div[2]/div/form/div[1]/div[6]/div/div/div/div[2]";  
    public static $TabProfileSelectCategoryLabel = "//div[1]/div/div[2]/div[2]/div/form/div[1]/div[6]/span";  
    public static $TabProfileSelectProduct = "//div[1]/div/div[2]/div[2]/div/form/div[1]/div[7]/div/div/div/div[2]";  
    public static $TabProfileSelectProductLabel = "//div[1]/div/div[2]/div[2]/div/form/div[1]/div[7]/span";  
    public static $TabProfileBlockDataButtonSave = "//div[1]/div/div[2]/div[2]/div/form/button";  
    public static $TabProfileBlockLoginPasswordText = "//body/div[1]/div/div[2]/div[3]/div";  
    public static $TabProfileFieldEmail = "//div[1]/div/div[2]/div[4]/div/form/div/div[2]/div/input";  
    public static $TabProfileFieldEmailLabel = "//div[1]/div/div[2]/div[4]/div/form/div/div[2]/label";  
    public static $TabProfileFieldNewPassword = "//div[1]/div/div[2]/div[4]/div/form/div/div[3]/div/input";  
    public static $TabProfileFieldNewPasswordLabel = "//div[1]/div/div[2]/div[4]/div/form/div/div[3]/label";  
    public static $TabProfileFieldOldPassword = "//div[1]/div/div[2]/div[4]/div/form/div/div[4]/div/input";  
    public static $TabProfileFieldOldPasswordLabel = "//body/div[1]/div/div[2]/div[4]/div/form/div/div[4]/label";  
    public static $TabProfileFieldReplayNewPassword = "//div[1]/div/div[2]/div[4]/div/form/div/div[5]/div/input";  
    public static $TabProfileFieldReplayNewPasswordLabel = "//body/div[1]/div/div[2]/div[4]/div/form/div/div[5]/label";  
    public static $TabProfileBlockLoginButtonSave = "//div[1]/div/div[2]/div[4]/div/form/button";  
    
    
//    public static $TabSystemTour = "";   
//    
//    public static $TabTechnicalSupport = "";  
//    
//    public static $TabMyAdditions = "";   
//    
//    public static $TabPayments = "";   
//    
    public static $TabChoiceTarif = "";   
    public static $TabChoiceTarif = "";   
    public static $TabChoiceTarif = "";   
    public static $TabChoiceTarif = "";   
    public static $TabChoiceTarif = "";   
//    
//    public static $TabConfigureDomain = "";  
//    
//    public static $TabAdditionalServices = "";   
    
    
       
}