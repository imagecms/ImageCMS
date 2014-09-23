<?php

class NotificationListPage
{   
    //   Notification List     
    
    public static $ListPageURL = "/admin/components/run/shop/notifications";
    public static $ListTitle = "span.title";
    public static $ListMessageID = ".tooltip-inner";
    public static $ListMouseMessage = ".tooltip-inner";
    public static $ListLinkEditting = "//section/div[5]/div[1]/form/table/tbody/tr/td[2]/a";
    public static $ListLinkEdittingCreateStatusButton = "//div[4]/form/table/tbody/tr/td[3]/a";
    public static $ListButtonFilter = "//section/div[3]/div[2]/div/button[1]";
    public static $ListButtonCancelFilter = "//div[3]/div[2]/div/a";
    public static $ListButtonDelete = "//button[2]";
    public static $ListCalendar = "#ui-datepicker-div";
    public static $ListButtonAll = "//body/div[1]/div[5]/section/div[4]/a[1]";
    public static $ListButtonNew = "//section[@class='mini-layout']/div[4]/a[2]";
    public static $ListButtonMade = "//section[@class='mini-layout']/div[4]/a[3]";
    public static $ListButtonInformation = "//table/tbody/tr[1]/td[8]/div[1]/i";
    public static $ListButtonNotifi = "//table/tbody/tr[1]/td[9]/button";
    public static $ListButtonCreatedStatus = "//div[4]/a[4]";
    public static $ListFildId = "//td[2]/input";
    public static $ListFildEmail = "//td[3]/input";
    public static $ListFildAddition = "//td[4]/input";
    public static $ListFildValidUnit = "//td[5]/input";
    public static $ListSelectMain = "//section[@class='mini-layout']/div[5]/div[1]/form/table/thead/tr[2]/td[7]/select";
    public static $ListSelectFirst = "//section[@class='mini-layout']/div[5]/div[1]/form/table/tbody/tr/td[7]/select";
    public static $ListMainCheckBox = "//section[@class='mini-layout']/div[5]/div[1]/form/table/thead/tr[1]/th[1]/span/span"; //section/div[5]/div[1]/form/table/thead/tr[1]/th[1]/span/span
    public static $ListColumnID = "//th[2]";
    public static $ListColumnEmeil = "//th[3]";
    public static $ListColumnAddition = "//th[4]";
    public static $ListColumnValid = "//th[5]";
    public static $ListColumnManager = "//th[6]";
    public static $ListColumnStatus = "//th[7]";
    public static $ListColumnProduct = "//th[8]";
    public static $ListColumnNotifi = "//th[9]";
     
    // Pagination
    public static $ListPaginationButton1 = "//section[@class='mini-layout']/div[6]/div[1]/ul/li[1]/span";
    public static $ListPaginationButton2 = "//section[@class='mini-layout']/div[6]/div[1]/ul/li[2]/a";
    public static $ListPaginationButton3 = "//section[@class='mini-layout']/div[6]/div[1]/ul/li[3]/a";
    public static $ListPaginationButtonBackNotAct = "//section/div[6]/div[2]/ul/li[1]/span";
    public static $ListPaginationButtonBackAct = "section/div[6]/div[2]/ul/li[1]/a";
    public static $ListPaginationButtonForwardAct = "//section/div[6]/div[2]/ul/li[2]/a";
    public static $ListPaginationButtonForwardNotAct = "//section/div[6]/div[2]/ul/li[2]/span";
     
     //   Window of Deleting 
    
    public static $DeleteWindow = ".modal.hide.fade";
    public static $DeleteWindowTitle = ".modal-header>h3"; 
    public static $DeleteWindowMassage = ".modal-body>p"; 
    public static $DeleteWindowButtonX = ".close";  
    public static $DeleteWindowButtonDelete = ".btn.btn-primary";  
    public static $DeleteWindowButtonCancel = ".//*[@id='mainContent']/section/div[1]/div[3]/a[2]";  
    
    //   Edititing Page Notice
    
    public static $EditingTitle = "//div/section[@class='mini-layout']/div/div/span[2]";
    public static $EditingBlockData = "//*[@id='editNot']/table/thead/tr/th"; 
    public static $EditingBlockImage = "//section[@class='mini-layout']/div[2]/table/thead/tr/th[1]"; 
    public static $EditingBlockProduct = "//section[@class='mini-layout']/div[2]/table/thead/tr/th[2]"; 
    public static $EditingLinkImg = "//table/tbody/tr/td[1]/a/img";
    public static $EditingLinkProduct = "//section[@class='mini-layout']/div[2]/table/tbody/tr/td[2]/a";    
    public static $EditingButtonBack = "//section[@class='mini-layout']/div[1]/div[2]/div/a/span[2]";
    public static $EditingButtonSave = "//section/div[1]/div[2]/div/button[1]";
    public static $EditingButtonSaveAndGoBack = "//button[2]";
    public static $EditingButtonNotifi = "//dd[6]/img";
    public static $EditingFildID = "//dd";
    public static $EditingCalendar = "#ui-datepicker-div";
    public static $EditingFildCreated = "//dd[3]";
    public static $EditingFildExpirationDate = "//dd[4]/input";
    public static $EditingFildStatusSet = "//dd[5]";
    public static $EditingSelectStatus = "//dl/dd[2]/select";
    public static $EditingFildName = "//section/form/table/tbody/tr/td/div/div/div/div[1]/div/input";
    public static $EditingFildEmail = "//section/form/table/tbody/tr/td/div/div/div/div[2]/div/input";
    public static $EditingFildPhone = "//section/form/table/tbody/tr/td/div/div/div/div[3]/div/input";
    public static $EditingFildComment = "//section/form/table/tbody/tr/td/div/div/div/div[4]/div/textarea";
    public static $EditingNameFieldID =  "//dt[1]";
    public static $EditingNameFieldStatus =  "//dt[2]";
    public static $EditingNameFieldAddition =  "//dt[3]";
    public static $EditingNameFieldValid =  "//dt[4]";
    public static $EditingNameFieldSetStatus =  "//dt[5]";
    public static $EditingNameFieldNotify =  "//dt[6]";
    public static $EditingNameFieldUser =  "//label";
    public static $EditingNameFieldEmeil =  "//div[2]/label";
    public static $EditingNameFieldPhone =  "//div[3]/label";
    public static $EditingNameFieldComment =  "//div[4]/label";
 }    