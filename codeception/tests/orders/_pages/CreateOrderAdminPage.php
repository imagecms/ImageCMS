<?php



class CreateOrderAdminPage



{
// Creating Order Product Page
       
       public static $CrtPURL = "/admin/components/run/shop/orders/create";
       public static $CrtPTitle = "span.title.w-s_n";
       
       //Creating Order Button "Product"
       
       public static $CrtPButtBack = "span.t-d_u";
       public static $CrtPButtCreate = "//section/div[1]/div[2]/div/button[1]";
       public static $CrtPButtCreateAndGoBack = "//button[2]";
       public static $CrtPButtProduct = "//div/section/div[2]/div/a[1]";
       public static $CrtPButtUser = "//div/section/div[2]/div/a[2]";
       public static $CrtPButtOrder = "//div/section/div[2]/div/a[3]";
       public static $CrtPButtAddToCart = "#addVariantToCart";
       public static $CrtPButtOutStock = "//div[3]/button";
       public static $CrtPButtInBasket = "//div[3]/button";
       public static $CrtPButtDeleteTr1 = ".//*[@id='insertHere']/tr[1]/td[6]/button";
       
       //Creating Order Name Element "Product"
       
       public static $CrtPNameBlockProductSearch = ".//*[@id='addProduct']/thead/tr/th[1]";
       public static $CrtPNameFieldIDNameArticul = "//tbody/tr[1]/td[1]/div/label";
       public static $CrtPNameSelectCategory = "//tbody/tr[2]/td[1]/label/b";
       public static $CrtPNameSelectProduct = "//tbody/tr[2]/td[2]/label/b";
       public static $CrtPNameSelectVariant = "//tbody/tr[2]/td[3]/label/b";
       public static $CrtPNameColProduct = './/*[@id="productsInCart"]/thead/tr/th[1]';
       public static $CrtPNameColVariant = ".//*[@id='productsInCart']/thead/tr/th[2]";
       public static $CrtPNameColPrice = ".//*[@id='productsInCart']/thead/tr/th[3]";
       public static $CrtPNameColNumber = ".//*[@id='productsInCart']/thead/tr/th[4]";
       public static $CrtPNameColTotalPrice = ".//*[@id='productsInCart']/thead/tr/th[5]";
       public static $CrtPNameColDelete = ".//*[@id='productsInCart']/thead/tr/th[6]";
       
       
       //Creating Order Fields "Product"
       
       public static $CrtPFieldAmount = "//section/form/div/div[1]/div/table[2]/tbody/tr/td[4]/div/input";
       public static $CrtPFieldTotalPrice = "//section/form/div/div[1]/div/table[2]/tbody/tr/td[5]/span[1]";
       public static $CrtPFieldCommon = "//section/form/div/div[1]/div/table[2]/tfoot/tr/td[3]/span";
       
       
       //Creating Order Name Element "User"
       
       public static $CrtUNameBlockUser = "//thead/tr/th[1]";
       public static $CrtULinkCreate = "#collapsed";
       public static $CrtUNameFieldEmeil = "//div/div[1]/div[1]/label[3]";
       public static $CrtUNameBlockCreateUser = "//div/div[1]/div/label[1]/b";
       public static $CrtUNameFieldName = "//*[@id='collapseOne']/div/div[1]/div/label[2]";
       public static $CrtUUNameFieldEmeil = "//div[@id='collapseOne']/div/div/div/label[3]";
       public static $CrtUNameFieldPhone = "//div[@id='collapseOne']/div/div/div/label[4]";
       public static $CrtUNameFieldAddress = "//div[@id='collapseOne']/div/div/div/label[5]";
       public static $CrtUButtCreate = "//div[2]/div/div[2]/div/button";
       public static $CrtULinkSearchUser = "//tbody/tr/td/div/div[2]/div[1]/a";
       public static $CrtUNameBlockSearch = "//div[2]/div[2]/div/div/div/label/b";
       public static $CrtUNameFieldIDNameEmeil = "//div[2]/div[2]/div/div/div/label[2]";
       public static $CrtUNameColID = ".//*[@id='tab2']/div/table[2]/thead/tr/th[1]";
       public static $CrtUNameColEmeil = "//div[@id='tab2']/div/table[2]/thead/tr/th[2]";
       public static $CrtUNameColUser = "//div[@id='tab2']/div/table[2]/thead/tr/th[3]";
       public static $CrtUNameColAddress = "//div[@id='tab2']/div/table[2]/thead/tr/th[4]";
       public static $CrtUNameColPhone = "//div[@id='tab2']/div/table[2]/thead/tr/th[5]";
       public static $CrtUMessageAlertPresence = ".alert.in.fade.alert-error";
//       public static $CrtUMessageAlertText = "";
       
       //Creating Order Fields "User"
       
       public static $CrtUFieldName = "#createUserName";
       public static $CrtUFieldEmeil = "#createUserEmail";
       public static $CrtUFieldPhone = "#createUserPhone";
       public static $CrtUFieldAddress = "#createUserAddress";
       public static $CrtUFieldIDNameEmeil = "//div[2]/div[2]/div/div/div/label[2]";
       public static $CrtULinkEditUser = "#userNameforOrder";
       
       //Creating Order Name "Order"
       
       public static $CrtONameBlockOrderInfo = "//div[3]/table/thead/tr/th";
       public static $CrtONameBlockUser = "//tbody/tr/td/div/div/div[1]/label[1]/b";
       public static $CrtONameBlockDeviliry = "//div[2]/label[1]/b";
       public static $CrtONameBlockCertificate = "//label[4]/b";
       public static $CrtONameFieldName = "//td/div/div[1]/div[1]/label[2]";
       public static $CrtONameFieldFamily = "//td/div/div[1]/div[1]/label[3]";
       public static $CrtONameFieldPhone = "//td/div/div[1]/div[1]/label[5]";
       public static $CrtONameFieldEmeil = "//td/div/div[1]/div[1]/label[4]";
       public static $CrtONameFieldAddres = "//td/div/div[1]/div[1]/label[6]";
       public static $CrtONameFieldTotalPrice = "//tbody/tr/td/div/div/div[1]/div[1]/label";
       public static $CrtONameSelectDelivey = "//div[2]/label[2]";
       public static $CrtONameSelectPlaymant = "//div[2]/label[3]";
       public static $CrtONameFieldPromoCode = "//div[2]/label[5]";
       
       //Creating Order Fields "Order"
       
       public static $CrtOFieldName = "//div[3]/table/tbody/tr/td/div/div/div[1]/input[1]";
       public static $CrtOFieldFamily = "//td/div/div/div/input[2]";
       public static $CrtOFieldEmeil = "//td/div/div/div/input[3]";
       public static $CrtOFieldPhone = "//td/div/div/div/input[4]";
       public static $CrtOFieldAddres = "//input[5]";
       public static $CrtOFieldTotalPrice = "//td/div/div/div/div/input";
       public static $CrtOselectDelivery = "//div[2]/select[1]";
       public static $CrtOSelectPlayment = "//select[2]";
       public static $CrtOFieldPromocode = "//div[2]/input";
       public static $CrtOButtUpdate = "//div[2]/button";
       
       //--------Select Window Category.Product.Variant------------
       
       public static $CrtZMenuCategoryDefolt = "//table[1]/tbody/tr[2]/td[1]/div/a";
       public static $CrtZMenuCategoryInput = "//table[1]/tbody/tr[2]/td[1]/div/div/div/input";
       public static $CrtZMenuCategorySearchButton = "//section/form/div/div[1]/div/table[1]/tbody/tr[2]/td[1]/div/div/ul/li";
       public static $CrtZMenuProduct = "//table[1]/tbody/tr[2]/td[2]/select";
       public static $CrtZMenuVariant = "//table[1]/tbody/tr[2]/td[3]/select";
       public static $CrtZMenuSetCategory = "//tbody/tr[2]/td[1]/div/a/span";
       public static $CrtZMenuProductRowOne = "//table[1]/tbody/tr[2]/td[2]/select/option";
       

       
       
       

}