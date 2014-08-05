<?php

class OrderStatusesCreatePage

{
//------Create Page-------------------------------------------------------------    
    public static $CreateURL = "/admin/components/run/shop/orderstatuses/create";
    public static $CreateTitle = "span.title.w-s_n";
    public static $CreateButtonBack = "span.t-d_u";
    public static $CreateButtonCreate = "//div[2]/div/button[1]";
    public static $CreateButtonCreateAndGoBack = "//button[2]";
    public static $CreateNameBlock = "//th";
    public static $CreateNameFieldName = "label.control-label";
    public static $CreateNameFieldColor = "//div[2]/label";
    public static $CreateNameFieldColorFont = "//div[3]/label";
    public static $CreateMessageAlertFild = "label.alert.alert-error";
    public static $CreateMessageCreatingStatus = ".alert.in.fade.alert-success";
    public static $CreateFieldName = "#Name";
    public static $CreateFieldColorBack = "//div[2]/div/input";
    public static $CreateFieldColorFont = "//div[3]/div/input";
    
    
 //---------Edit Page-----------------------------------------------------------
    public static $EditLinkEditing = "//tr[2]/td[2]/a";
    public static $EditTitle = "span.title.w-s_n";
    public static $EditButtonBack = "span.t-d_u";
    public static $EditButtonSave = "//div[2]/div/button[1]";
    public static $EditButtonSaveAndGoBack = "//section/div[1]/div[2]/div/button[2]";
    public static $EditNameBlock = "//th";
    public static $EditNameFieldName = "label.control-label";
    public static $EditNameFieldColor = "//div[2]/label";
    public static $EditNameFieldColorFont = "//div[3]/label";
    public static $EditFieldName = "//td/div/form/div/div/input";
    public static $EditFieldColor = "//div[2]/div/input";
    public static $EditFieldColorFont = "//div[3]/div/input";
    public static $EditNessageAlert = "label.alert.alert-error";
    public static $EditMessageEditingStatus = "//div[2]/div[2]";

}