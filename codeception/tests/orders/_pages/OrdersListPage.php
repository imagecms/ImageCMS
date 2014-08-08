<?php



class OrdersListPage



{   
       //Orders List Button
    
      public static $ListURLorders = "/admin/components/run/shop/orders/index";
      public static $ListTitle = "span.title";
      public static $ListButtFilter = "//div[2]/div/button[1]";
      public static $ListButtCancelFilter = "//section/div[1]/div[2]/div/a[1]";
      public static $ListButtSetStatuse = "//section/div[1]/div[2]/div/div/button";
      public static $ListButtSetStatusList = "//section/div[1]/div[2]/div/div/ul";
      public static $ListButtDelete = "//section/div[1]/div[2]/div/button[2]";
      public static $ListButtCreateOrder = "//section/div[1]/div[2]/div/a[2]";
      
      //Orders List Header
      
      public static $ListHeaderCheckBox = "//thead/tr[1]/th[1]/span/span";
      public static $ListHeaderID = "//th[2]/a";
      public static $ListHeaderStatus = "//th[3]/a";
      public static $ListHeaderDate = "//th[4]/a";
      public static $ListHeaderCustomer = "//th[5]";
      public static $ListHeaderProduct = "//th[6]";
      public static $ListHeaderPrice = "//th[7]/a";
      public static $ListHeaderPlaymentStatus = "//th[8]/a";
      
      //Orders List Fields
      
      public static $ListFieldID = "//td[2]/div/input";
      public static $ListFieldStatus = 'select[name="status_id"]';
      public static $ListFieldDateFrom = '//form[@id="ordersListFilter"]/section/div[2]/table/thead/tr[2]/td[4]/label[2]/span[2]/input';
      public static $ListFieldDateTO = '#dp1405345659189';
      public static $ListFieldCustomer = "//td[5]/input";
      public static $ListFieldProduct = './/*[@id="ordersFilterProduct"]';
      public static $ListFieldPriceFrom = "//td[7]/label[1]/span[2]/input";
      public static $ListFieldPriceTo = "//tr[2]/td[7]/label[2]/span[2]/input";
      public static $ListFieldPlaymentStatus = "//td[8]/select";
      
      //Orders List Rows
      
      public static $ListRow1CheckBox = "//tr[1]/td[1]/span/span";
      public static $ListRow1ID = "//tr[1]/td[2]/a";
      public static $ListRow1Status= "//section/div[2]/table/tbody/tr[1]/td[3]/span";
      public static $ListRow1DateFromTo = "//section/div[2]/table/tbody/tr[1]/td[4]";
      public static $ListRow1Customer = "//section/div[2]/table/tbody/tr[1]/td[5]/a";
      public static $ListRow1ButtInformation = "//section/div[2]/table/tbody/tr[1]/td[6]/div[1]/i";
      public static $ListRow1Price = "//section/div[2]/table/tbody/tr[1]/td[7]";
      public static $ListRow1SetStatus = "//section/div[2]/table/tbody/tr[1]/td[8]/span";
      
      //Orders List Pagination
      
      public static $ListPagiNameSelect = "//section/div[3]/div[2]";
      public static $ListPagiSelect = "//div/select";
      public static $ListPagiButtOffBack = ".//*[@id='ordersListFilter']/section/div[3]/div[2]/ul/li[1]/span";
      public static $ListPagiButtONBack = ".//*[@id='ordersListFilter']/section/div[3]/div[2]/ul/li[1]/a";
      public static $ListPagiButtOffForvard = ".//*[@id='ordersListFilter']/section/div[3]/div[2]/ul/li[2]/span";
      public static $ListPagiButtONForvard = ".//*[@id='ordersListFilter']/section/div[3]/div[2]/ul/li[2]/a";
      public static $ListPagiButt1ON = ".//*[@id='ordersListFilter']/section/div[3]/div[1]/ul/li[1]/a";
      public static $ListPagiButt1OFF= ".//*[@id='ordersListFilter']/section/div[3]/div[1]/ul/li[1]/span";
      public static $ListPagiButt2ON = ".//*[@id='ordersListFilter']/section/div[3]/div[1]/ul/li[2]/a";
      public static $ListPagi2OFF = ".//*[@id='ordersListFilter']/section/div[3]/div[1]/ul/li[2]/span";
      
      
       //Orders List Delete Window
       public static $DLTWindowWindow = ".modal.hide.fade.in";
       public static $DLTWindowTitle = "//div/div/div[1]/h3";
       public static $DLTWindowMessage = "//div/div/div[2]/p";
       public static $DLTWindowButtX = ".//*[@id='mainContent']/div/div/div[1]/button";
       public static $DLTWindowButtDelete = ".//*[@id='mainContent']/div/div/div[3]/a[1]";
       public static $DLTWindowButtCancel = ".//*[@id='mainContent']/div/div/div[3]/a[2]";
       

       
       
       
}