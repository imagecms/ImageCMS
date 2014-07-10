<?php

class NotificationListPage
{   
    //   Notification List     Header
    
    public static $ListPageURL = "/admin/components/run/shop/notifications";
    public static $ListTitle = "span.title";
    public static $ListLinkEditting = "//table/tbody/tr[1]/td[3]/a";
    public static $ListLinkEdittingCreateStatusButton = "//div[4]/form/table/tbody/tr/td[3]/a";
    public static $ListButtonFilter = "//div[2]/div/button";
    public static $ListButtonCancelFilter = "//div[3]/div[2]/div/a";
    public static $ListButtonDelete = "//button[2]";
    public static $ListButtonAll = "//section/div[4]/a[1]";
    public static $ListButtonNew = "//section/div[4]/a[2]";
    public static $ListButtonMade = "//section/div[4]/a[3]";
    public static $ListButtonInformation = "//table/tbody/tr[1]/td[8]/div[1]/i";
    public static $ListButtonNotifi = "//table/tbody/tr[1]/td[9]/button";
    public static $ListButtonCreatedStatus = "//div[4]/a[4]";
    public static $ListFildId = "//td[2]/input";
    public static $ListFildEmail = "//td[3]/input";
    public static $ListFildAddition = "//td[4]/input";
    public static $ListFildValidUnit = "//td[5]/input";
    public static $ListSelectMain = "//thead/tr[2]/td[7]/select";
    public static $ListSelectFirst = "//tbody/tr[1]/td[7]/select";
    public static $ListMainCheckBox = "//span/span";   
    public static $ListPaginationButton1 = "//section/div[6]/div[1]/ul/li[1]/span";
    public static $ListPaginationButton2 = "//section/div[6]/div[1]/ul/li[2]/a";
    public static $ListPaginationButton3 = "//section/div[6]/div[1]/ul/li[3]/a";
    public static $ListPaginationButtonBackNotAct = "//section/div[6]/div[2]/ul/li[1]/span";
    public static $ListPaginationButtonBackAct = "section/div[6]/div[2]/ul/li[1]/a";
    public static $ListPaginationButtonForwardAct = "//section/div[6]/div[2]/ul/li[2]/a";
    public static $ListPaginationButtonForwardNotAct = "//section/div[6]/div[2]/ul/li[2]/span";
     
     //   Window of Deleting 
    
    public static $DeleteWindowTitle = "//h3"; 
    public static $DeleteWindowMassage = "//section/div[1]/div[2]/p"; 
    public static $DeleteWindowButtonX = "//section/div[1]/div[1]/button";  
    public static $DeleteWindowButtonDelete = "//section/div[1]/div[3]/a[1]";  
    public static $DeleteWindowButtonCancel = "//section/div[1]/div[3]/a[2]";  
    
    //   Edit Page Notice
    
    public static $EditingTitle = "//div/section/div/div/span[2]";
    public static $EditingBlockData = "//*[@id='editNot']/table/thead/tr/th"; 
    public static $EditingBlockImage = "//*[@id='mainContent']/div/section/div[3]/table/thead/tr/th[1]"; 
    public static $EditingBlockProduct = "//*[@id='mainContent']/div/section/div[3]/table/thead/tr/th[2]"; 
    public static $EditingLinkImg = "//table/tbody/tr/td[1]/a/img";
    public static $EditingLinkProduct = "//section/div[3]/table/tbody/tr/td[2]/a";    
    public static $EditingButtonBack = "//a/span[2]";
    public static $EditingButtonSave = "//section/div[1]/div[2]/div/button[1]";
    public static $EditingButtonSaveAndGoBack = "//section/div[1]/div[2]/div/button[2]";
    public static $EditingButtonNotifi = "//dd[6]/img";
    public static $EditingFildID = "//section/div[1]/div[2]/div/button[2]";
    public static $EditingFildCreated = "//dd[3]";
    public static $EditingFildExpirationDate = "//dd[4]/input";
    public static $EditingFildStatusSet = "//dd[5]";
    public static $EditingSelectStatus = "//dl/dd[2]/select";
    public static $EditingFildName = "//div[2]/div[1]/div/input";
    public static $EditingFildEmail = "//div[2]/div[2]/div/input";
    public static $EditingFildPhone = "//div[2]/div[3]/div/input";
    public static $EditingFildComment = "//div[2]/div[4]/div/textarea";
     
    
}    