<?php

class OrderStatusesListPage

{
//------List Page---------------------------------------------------------------
    public static $ListURL = "/admin/components/run/shop/orderstatuses";
    public static $ListaButtonCreateStatuse = "//div/div[2]/div/a";
    public static $ListButtonDelete = "i.icon-trash";
    public static $ListLinkStstusTr1 = ".//*[@id='orderStatusesList']/section/div[2]/div/table/tbody/tr[1]/td[2]/a";
    public static $ListLinkStatusTr2 = "//tr[2]/td[2]/a";
    public static $ListColumnID = "th.span1";
    public static $ListColumnName = "//th[2]";
    public static $ListCollumFontColor = "//th[4]";
    public static $ListCollumBackColor = "th.span2";
    public static $ListColumnDelete = "//th[5]";
    public static $ListMessageMouseFocuse = "div.tooltip-inner";
    public static $ListMessageDragDrop = ".alert.in.fade.alert-success";
    public static $ListTitle = ".//*[@id='orderStatusesList']/section/div[1]/div[1]";




//------DeleteWindow------------------------------------------------------------
    public static $DeleteTitle = "//div[@id='mainContent']/div[2]/div/h3";
    public static $DeleteMessage = "//div[@id='mainContent']/div[2]/div[2]/div/p";
    public static $DeleteButtonX = "button.close";
    public static $DeleteButtonDelete = "//div[@id='mainContent']/div[2]/div[3]/a";
    public static $DeleteButtonCancel = "//div[@id='mainContent']/div[2]/div[3]/a[2]";
    public static $DeleteWindow = ".//*[@id='mainContent']/div[2]";//".modal.hide.fade.in";
    public static $DeleteMessageDeleting = ".alert.in.fade.alert-success";
    
    
//------Delete Window Active Status---------------------------------------------
    public static $ASDeleteTitle = "//h3";
    public static $ASDeleteButtonX = "button.close";
    public static $ASDeleteMessage = "//p";
    public static $ASDeleteNameFieldFirs = "label.control-label";
    public static $ASDeleteNemeFieldSecond = "//div[2]/label";
    public static $ASDeleteSelectMenu = "//select";
    public static $ASDeleteButtonDelete = "//div[3]/a";
    public static $ASDeleteButtonCancel = "//div[3]/a[2]";
    public static $ASDeleteCheckBoxFirst = "//div[2]/form/div/div/input";
    public static $ASDeleteCheckBoxSecond = "//div[2]/div/div/input";
  
 
    

}

