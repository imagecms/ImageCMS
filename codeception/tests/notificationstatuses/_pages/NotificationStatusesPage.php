<?php

class NotificationStatusesPage
{   // List Page
    public static $ListPageURL = "admin/components/run/shop/notificationstatuses";
    public static $ListButtonCreate = ".btn.btn-small.btn-success.pjax"; 
    public static $ListLinkEditing = "//section/div[2]/table/tbody/tr[1]/td[3]/a";
    public static $ListLinkForEditing = "//tr[3]/td[3]/a";
    public static $ListHeaderCheckBox = "//div[2]/table/thead/tr/th[1]/span/span";
    public static $ListCheckBoxFirst = ".//*[@id='mainContent']/div/div[3]/section/div[2]/table/tbody/tr[1]/td[1]/span/span";
    public static $ListCheckBoxSecond = "//div[2]/table/tbody/tr[2]/td[1]/span/span";
    public static $ListCheckBoxThird = "//tr[3]/td[1]/span/span";    
    public static $ListButtonDelete = "//div[1]/div[2]/div/button";
    public static $ListTitle = "span.title";
    public static $ListNameFirstStatuse = "//tr[2]/td[3]/a";
    public static $ListNameSecondStatuse = "//table/tbody/tr[1]/td[3]/a";
    public static $ListNameFirstCollum = "//th[2]";
    public static $ListNameSecondCollum = "//th[3]";
    public static $ListNameThirdCollum = "//th[4]";
    public static $ListTable = "//div/div[3]/section/div[2]";
    // Delete Window
    public static $DeleteWindowButtonDelete = ".//*[@id='mainContent']/div/div[1]/div[3]/a[1]";
    public static $DeleteWindowTitle = "//div[@id='mainContent']/div/div/div/h3";
    public static $DeleteWindowMassege = "//p";
    public static $DeleteWindowButtonX = "//div/div/button";
    public static $DeleteWindowButtonCancel = "//div[3]/a[2]";
    // Create Page
    public static $CreatePageUrl = "admin/components/run/shop/notificationstatuses/create";
    public static $CreationButtonCreate = "//div[2]/div/button[1]";
    public static $CreationButtonBack = "//a/span[2]";
    public static $CreationButtonCreateAndGoBack = ".btn.btn-small.btn-default.formSubmit";
    public static $CreationFildInput =  ".//*[@id='inputFio']";
    public static $CreationNameTitle =  "//div/section/div/div/span[2]";
    public static $CreationNameBlock =  "//th";
    public static $CreationNameFild =  "//label";
    public static $CreationAlertMessage =  "//div/div/div/label";
    public static $CreationCreateMessage =  "//div[2]/div[2]";
    // Edit Page
    public static $EditingPageURL = "/admin/components/run/shop/notificationstatuses/edit/1";
    public static $EditingButtonBack = "//a/span[2]";
    public static $EditingButtonSave = "//div[2]/div/button[1]";
    public static $EditingButtonSaveAndGoBack = "//div[2]/div/button[2]";
    public static $EdictingEdictMessage =  "//div[2]/div[2]";
    public static $EditingFildInput = ".//*[@id='Name']";
    public static $EditingNameTitle = "//div/section/div/div/span[2]";
    public static $EditingNameBlock = "//th";
    public static $EditingNameFild = "//label";
    public static $DeleteWindow = ".modal.hide.fade";
    
}