<?php

class OrdersListEditPage
{
    //заголовки
    public static $Title                     = '//section[@class="mini-layout"]//span[@class="title w-s_n"]';
    
    public static $TitleBlockOrderDetails    = '//section[@class="mini-layout"]//th';
    public static $TitleBlockCustomer        = '//section[@class="mini-layout"]//th';
    public static $TitleTableProducts        = '//section[@class="mini-layout"]//div[@class="title-default"][1]';
    public static $TitleTableHistory         = '//section[@class="mini-layout"]//div[@class="title-default"][2]';
    
    //кнопки
    public static $ButtonBack                = '//section[@class="mini-layout"]/div[1]/div[2]/div/a[1]';
    public static $ButtonPrintCheck          = '//section[@class="mini-layout"]/div[1]/div[2]/div/a[2]';
    Public static $ButtonSave                = '//section[@class="mini-layout"]/div[1]/div[2]/div/button[1]';
    Public static $ButtonSaveExit            = '//section[@class="mini-layout"]/div[1]/div[2]/div/button[2]';
    
    //--------------------------------------------------------------------------
    //--------------------------БЛОК ДЕТАЛИ ЗАКАЗА------------------------------
    //--------------------------------------------------------------------------
    
    //текст
    public static $TextDate                 = '//div[@class="control-group"][1]//div[@class="controls ctext"]';
    public static $TextSum                  = '//div[@class="control-group"][4]//div[@class="controls ctext"]';
    
    //селекти
    public static $SelectStatus             = '//form/div[1]/div[1]//div[@class="control-group"][2]//select';
    
    //варіанти в селектах
    public static function selectStatusOption($number) { return "//form/div[1]/div[1]//div[@class='control-group'][2]//select/option[$number]"; }
    
    //радіокнопки
    public static $RadioPaidYes             = '//form/div[1]/div[1]//div[@class="control-group"][3]/div/span[1]/span';
    public static $RadioPaidNo              = '//form/div[1]/div[1]//div[@class="control-group"][3]/div/span[2]/span';
    
    //поля для вводу
    public static $InputComment             = '//form/div[1]/div[1]//div[@class="control-group"][5]//textarea';
    
    //чекбокси
    public static $CheckInfoBuyer           = '//form/div[1]/div[1]//div[@class="control-group"][6]/div/span/span';
    
    //лейбли
    public static $TextDateLabel            = '//form/div[1]/div[1]//div[@class="control-group"][1]/label';
    public static $TextSumLabel             = '//form/div[1]/div[1]//div[@class="control-group"][4]/label';
    public static $SelectStatusLabel        = '//form/div[1]/div[1]//div[@class="control-group"][2]/label';
    
    public static $RadioPaidLabel           = '//form/div[1]/div[1]//div[@class="control-group"][3]/label';
    public static $RadioPaidYesLabel        = '//form/div[1]/div[1]//div[@class="control-group"][3]/div/span[1]';
    public static $RadioPaidNoLabel         = '//form/div[1]/div[1]//div[@class="control-group"][3]/div/span[2]';
    
    public static $InputCommentLabel        = '//form/div[1]/div[1]//div[@class="control-group"][5]//label';
    public static $CheckInfoBuyerLabel      = '//form/div[1]/div[1]//div[@class="control-group"][6]/div/span';
    
    //підказки
    public static $InputCommentHelp         = '//form/div[1]/div[1]//div[@class="control-group"][5]/div/span';
    //--------------------------------------------------------------------------
    //--------------------------БЛОК ОФОРМЛЕНИЕ ПОКУПАТЕЛЯ----------------------
    //--------------------------------------------------------------------------
    //поля для вводу
    public static $InputUser                = '#UserFullName';
    public static $InputEmail               = '#UserEmail';
    public static $InputPhone               = '#UserPhone';
    public static $InputAdress              = '#postAddress';
    public static $InputUserComment         = '#UserComment';
    public static $InputCity                = '#custom_field_97';
    public static $InputHomePhone           = '#custom_field_100';

    
    //кнопки
    public static $ButtonProfile            = '//form/div[1]/div[2]//div[@class="control-group"][1]//a';
    public static $ButtonShowOnMap          = '#postAddressBtn';
    
    //селекти
    public static $SelectDelivery           = '//select[@class="shopOrdersdeliveryMethod"]';
    public static $SelectPayment            = '//select[@class="shopOrdersPaymentMethod"]';
    
    //варіанти в селектах
    public static function selectDeliveryOption($number) { return "//select[@class='shopOrdersdeliveryMethod']/option[$number]"; }
    public static function selectPaymentOption($number)  { return "//select[@class='shopOrdersPaymentMethod']/option[$number]"; }
    
    //інфо
    public static $InputCityInfo            = '//form/div[1]/div[2]//div[@class="control-group"][8]//span';
    public static $InputHomePhoneInfo       = '//form/div[1]/div[2]//div[@class="control-group"][9]//span';
    //--------------------------------------------------------------------------
    //--------------------------ТАБЛИЦЯ ЗАКАЗАНЫЕ ТОВАРИ------------------------
    //--------------------------------------------------------------------------
    public static $TableProducts = '//section[@class="mini-layout"]/form/table[1]';
    //Заголовки таблиці
    public static $TableProductsHeadProductsText    = '//section[@class="mini-layout"]/form/table[1]/thead//th[2]';
    public static $TableProductsHeadArticleText     = '//section[@class="mini-layout"]/form/table[1]/thead//th[3]';
    public static $TableProductsHeadPriceText       = '//section[@class="mini-layout"]/form/table[1]/thead//th[4]';
    public static $TableProductsHeadAmountText      = '//section[@class="mini-layout"]/form/table[1]/thead//th[5]';
    public static $TableProductsHeadTotalPriceText  = '//section[@class="mini-layout"]/form/table[1]/thead//th[6]';
    //Рядки таблиці
    public static function tableProductsLineDeleteButton($row)          { return "//section[@class='mini-layout']/form/table[1]/tbody/tr[$row]/td[1]/button";   }
    public static function tableProductsLineProductsLink($row)          { return "//section[@class='mini-layout']/form/table[1]/tbody/tr[$row]/td[2]/a";        }
    public static function tableProductsLineArticleText($row)           { return "//section[@class='mini-layout']/form/table[1]/tbody/tr[$row]/td[3]/div";      }
    public static function tableProductsLinePriceInput($row)            { return "//section[@class='mini-layout']/form/table[1]/tbody/tr[$row]/td[4]/div/input";}
    public static function tableProductsLinePriceButtonUpdate($row)     { return "//section[@class='mini-layout']/form/table[1]/tbody/tr[$row]/td[4]/div/button";}
    public static function tableProductsLinePriceTextCurrency($row)     { return "//section[@class='mini-layout']/form/table[1]/tbody/tr[$row]/td[4]/span";}
    public static function tableProductsLineAmountInput($row)           { return "//section[@class='mini-layout']/form/table[1]/tbody/tr[$row]/td[5]/div/input";}
    public static function tableProductsLineAmountButtonUpdate($row)    { return "//section[@class='mini-layout']/form/table[1]/tbody/tr[$row]/td[5]/div/button";}
    public static function tableProductsLineTotalPriceText($row)        { return "//section[@class='mini-layout']/form/table[1]/tbody/tr[$row]/td[6]";}
    //футер таблиці
    public static $TableProductsFoot                    = '';
    
    public static $TableProductsFootButtonAddProduct    = '//section[@class="mini-layout"]/form/table[1]/tfoot//a';
    public static $TableProductsFootTextInitialPrice    = '//section[@class="mini-layout"]/form/table[1]/tfoot/tr/td/div/div/div[1]/b';
    public static $TableProductsFootTextTotalPrice      = '//section[@class="mini-layout"]/form/table[1]/tfoot/tr/td/div/div/div[2]/div/b';
    //лейбли
    public static $TableProductsFootInitialPriceLabel   = '//section[@class="mini-layout"]/form/table[1]/tfoot/tr/td/div/div/div[1]';
    public static $TableProductsFootTotalPriceLabel     = '//section[@class="mini-layout"]/form/table[1]/tfoot/tr/td/div/div/div[2]/div';
    
    
    
    //--------------------------------------------------------------------------
    //--------------------------ТАБЛИЦЯ ИСТОРИЯ СТАТУСОВ ЗАКАЗА-----------------
    //--------------------------------------------------------------------------
    public static $TableHistory = '//section[@class="mini-layout"]/form/table[2]';
    
    //Заголовки таблиці
    public static $TableHistoryHeadStatusText           = '//section[@class="mini-layout"]/form/table[2]//th[1]';
    public static $TableHistoryHeadDateText             = '//section[@class="mini-layout"]/form/table[2]//th[2]';
    public static $TableHistoryHeadCommentText          = '//section[@class="mini-layout"]/form/table[2]//th[3]';
    public static $TableHistoryHeadManagerText          = '//section[@class="mini-layout"]/form/table[2]//th[4]';
    public static $TableHistoryHeadPaymentStatusText    = '//section[@class="mini-layout"]/form/table[2]//th[5]';
    //Рядки таблиці
    public static function tableHistoryLineStatus($row)         { return "//section[@class='mini-layout']/form/table[2]/tbody/tr[$row]/td[1]/span";}
    public static function tableHistoryLineDate($row)           { return "//section[@class='mini-layout']/form/table[2]/tbody/tr[$row]/td[2]";}
    public static function tableHistoryLineComment($row)        { return "//section[@class='mini-layout']/form/table[2]/tbody/tr[$row]/td[3]";}
    public static function tableHistoryLineManager($row)        { return "//section[@class='mini-layout']/form/table[2]/tbody/tr[$row]/td[4]";}
    public static function tableHistoryLinePaymentStatus($row)  { return "//section[@class='mini-layout']/form/table[2]/tbody/tr[$row]/td[5]/span";}
    //--------------------------------------------------------------------------
    //-------------------------ВІКНО ДОБАВЛЕНИЕ ТОВАРА К ЗАКАЗУ-----------------
    //--------------------------------------------------------------------------
    public static $WindowAddProduct             = ".modal.hide.fade.in";
    public static $WindowAddProductTitle        = ".modal.hide.fade.in .modal-header h3";
    
    //поля для вводу
    public static $WindowAddProductInputArticle = "#productNumber";
    public static $WindowAddProductInputProduct = "#product_name";
    public static $WindowAddProductInputAmount  = "#product_quantity";
    
    //селекти
    public static $WindowAddProductSelectVariant        = "#product_variant_name";
    public static function windowAddProductSelectVariantOption($number) { return "//select[@id='product_variant_name']/option[$number]"; }
    
    //кнопки
    public static $WindowAddProductButtonClose  = ".modal.hide.fade.in .modal-header button";
    public static $WindowAddProductButtonAdd    = "#addToCartConfirm";
    public static $WindowAddProductButtonCancel = ".modal.hide.fade.in a.btn";
    
    //лейбли
    public static $WindowAddProductInputArticleLabel    = "//form[@id='addToCartForm']/div[1]/label";
    public static $WindowAddProductInputProductLabel    = "//form[@id='addToCartForm']/div[2]/label";
    public static $WindowAddProductSelectVariantLabel   = "//form[@id='addToCartForm']/div[3]/label";
    public static $WindowAddProductInputAmountLabel     = "//form[@id='addToCartForm']/div[4]/label";

}