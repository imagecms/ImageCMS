<?php

class OrdersListCreatePage
{
    public static $URL                              = '/admin/components/run/shop/orders/create';
    
    //заголовки
    public static $Title                            = '.title';
    public static $BlockCreateTitle                 = '//section[@class="mini-layout"]//th';
    public static $TitleBasket                      = '.title-default';

    //кнопки
    public static $ButtonBack                       = '.t-d_u';
    public static $ButtonCreate                     = '//section[@class="mini-layout"]/div[1]/div[2]/div/button[1]';
    public static $ButtonCreateExit                 = '//section[@class="mini-layout"]/div[1]/div[2]/div/button[2]';
    
    //ВКЛАДКИ
    //--------------------------------------------------------------------------
    //--------------------------ТАБ ШВИДКИЙ ПОШУК-------------------------------
    //--------------------------------------------------------------------------
    public static $TabQuickSearch                   = 'a[href="#quicksearch"]';
        //поля для вводу
        public static $TabQuickSearchInputProduct   = '#productNameForOrders';
        //селекти
        public static $TabQuickSearchSelectResult   = '#quicksearch .productsForOrders.notchosen';
        public static $TabQuickSearchSelectVariant  = '//select[@class="variantsForOrders"]';
            //варіанти в селектах
            public static function tabQuickSearchSelectResultOption($number){ return "//div[@id='quicksearch']//select[@class='productsForOrders notchosen']//option[$number]"; }
            public static function tabQuickSearchSelectVariantOption($number){ return "//select[@class='variantsForOrders']//option[$number]"; }
        //лейбли
        public static $TabQuickSearchInputProductLabel  = '//div[@id="quicksearch"]/div/div[1]/label';
        public static $TabQuickSearchSelectResultLabel  = '//div[@id="quicksearch"]/div/div[2]/label';
        public static $TabQuickSearchSelectVariantLabel = '//div[@id="quicksearch"]/div/div[3]/label';
        //ОПИС ВИБРАНОГО ТОВАРУ
        //зображення
        public static $TabQuickSearchImageProduct   = '//div[@id="quicksearch"]//div[@class="variantInfoBlock"]/div[1]/div[1]//img';
        //ссилки
        public static $TabQuickSearchLinkProduct    = '//div[@id="quicksearch"]//div[@class="variantInfoBlock"]/div[1]/div[2]/div[1]/div[1]/a';
        //текст
        public static $TabQuickSearchTextVariant    = '//div[@id="quicksearch"]//div[@class="variantInfoBlock"]/div[1]/div[2]/div[1]/div[2]/b';
        public static $TabQuickSearchTextPrice      = '//div[@id="quicksearch"]//div[@class="variantInfoBlock"]/div[1]/div[2]/div[1]/div[3]/b';
        public static $TabQuickSearchTextStock      = '//div[@id="quicksearch"]//div[@class="variantInfoBlock"]/div[1]/div[2]/div[2]/span/b';
        //кнопки
        public static $TabQuickSearchButtonAdd      = '#quicksearch .addVariantToCart.btn.btn-small.btn-success';
        //лейбли
        public static $TabQuickSearchLinkProductLabel   = '//div[@id="quicksearch"]//div[@class="variantInfoBlock"]/div[1]/div[2]/div[1]/div[1]';
        public static $TabQuickSearchTextVariantLabel   = '//div[@id="quicksearch"]//div[@class="variantInfoBlock"]/div[1]/div[2]/div[1]/div[2]';
        public static $TabQuickSearchTextPriceLabel     = '//div[@id="quicksearch"]//div[@class="variantInfoBlock"]/div[1]/div[2]/div[1]/div[3]';
        public static $TabQuickSearchTextStockLabel     = '//div[@id="quicksearch"]//div[@class="variantInfoBlock"]/div[1]/div[2]/div[2]/span';
    //--------------------------------------------------------------------------
    //--------------------------ТАБ РОЗШИРЕНИЙ ПОШУК----------------------------
    //--------------------------------------------------------------------------
    public static $TabAdvancedSearch                    = 'a[href="#advancedsearch"]';
        //селекти
        public static $TabAdvancedSearchSelectCategory  = '#advancedsearch .chosen-single';
        public static $TabAdvancedSearchSelectResult    = '#advancedsearch .productsForOrders.notchosen';
        public static $TabAdvancedSearchSelectVariant   = '//div[@id="advancedsearch"]//select[@class="variantsForOrders"]';
            //поля для вводу в селектах
            public static $TabAdvancedSearchSelectCtegoryInput      = '.chosen-search>input'; 
            //варіанти в селектах
            public static function tabAdvancedSearchSelectCategoryOption($number) { return "//div[@id='advancedsearch']//ul[@class='chosen-results']//li[$number]";}
            public static function tabAdvancedSearchSelectResultOption($number)   { return "//div[@id='advancedsearch']//select[@class='productsForOrders notchosen']/option[$number]";}
            public static function tabAdvancedSearchSelectVariantOption($number)  { return "//div[@id='advancedsearch']//select[@class='variantsForOrders']/option[$number]";}
        //лейбли
        public static $TabAdvancedSearchSelectCategoryLabel = '//div[@id="advancedsearch"]/div/div[1]/label';
        public static $TabAdvancedSearchSelectResultLabel   = '//div[@id="advancedsearch"]/div/div[2]/label';
        public static $TabAdvancedSearchSelectVariantLabel  = '//div[@id="advancedsearch"]/div/div[3]/label';
        //ОПИС ВИБРАНОГО ТОВАРУ
        //зображення
        public static $TabAdvancedSearchImageProduct        = '//div[@id="advancedsearch"]//div[@class="variantInfoBlock"]/div[1]/div[1]//img';
        //ссилки
        public static $TabAdvancedSearchLinkProduct         = '//div[@id="advancedsearch"]//div[@class="variantInfoBlock"]/div[1]/div[2]/div[1]/div[1]/a';
        //текст
        public static $TabAdvancedSearchTextVariant         = '//div[@id="advancedsearch"]//div[@class="variantInfoBlock"]/div[1]/div[2]/div[1]/div[2]/b';
        public static $TabAdvancedSearchTextPrice           = '//div[@id="advancedsearch"]//div[@class="variantInfoBlock"]/div[1]/div[2]/div[1]/div[3]/b';
        public static $TabAdvancedSearchTextStock           = '//div[@id="advancedsearch"]//div[@class="variantInfoBlock"]/div[1]/div[2]/div[2]/span/b';
        //кнопки
        public static $TabAdvancedSearchButtonAdd           = '#advancedsearch .addVariantToCart.btn.btn-small.btn-success';
        //лейбли
        public static $TabAdvancedSearchLinkProductLabel    = '//div[@id="advancedsearch"]//div[@class="variantInfoBlock"]/div[1]/div[2]/div[1]/div[1]';
        public static $TabAdvancedSearchTextVariantLabel    = '//div[@id="advancedsearch"]//div[@class="variantInfoBlock"]/div[1]/div[2]/div[1]/div[2]';
        public static $TabAdvancedSearchTextPriceLabel      = '//div[@id="advancedsearch"]//div[@class="variantInfoBlock"]/div[1]/div[2]/div[1]/div[3]';
        public static $TabAdvancedSearchTextStockLabel      = '//div[@id="advancedsearch"]//div[@class="variantInfoBlock"]/div[1]/div[2]/div[2]/span';
    //--------------------------------------------------------------------------
    //--------------------------ТАБ НОВИЙ КОРИСТУВАЧ----------------------------
    //--------------------------------------------------------------------------
    public static $TabNewUser           = 'a[href="#newuser"]';
        //поля для вводу
        public static $TabNewUserInputName      = '#createUserName';
        public static $TabNewUserInputEmail     = '#createUserEmail';
        public static $TabNewUserInputPhone     = '#createUserPhone';
        public static $TabNewUserInputAdress    = '#createUserAddress';
        //селекти
        public static $TabNewUserSelectDelivery = '//div[@id="newuser"]//select[@class="shopOrdersdeliveryMethod"]';
        public static $TabNewUserSelectPayment  = '//div[@id="newuser"]//select[@class="shopOrdersPaymentMethod"]';
            //варіанти в селектах
            public static function tabNewUserSelectDeliveryOption($number){ return "//div[@id='newuser']//select[@class='shopOrdersdeliveryMethod']/option[$number]";}
            public static function tabNewUserSelectPaymentOption($number) { return "//div[@id='newuser']//select[@class='shopOrdersPaymentMethod']/option[$number]";}
        //лейбли
        public static $TabNewUserInputNameLabel      = '//div[@id="newuser"]/div/div[1]/label';
        public static $TabNewUserInputEmailLabel     = '//div[@id="newuser"]/div/div[2]/label';
        public static $TabNewUserInputPhoneLabel     = '//div[@id="newuser"]/div/div[3]/label';
        public static $TabNewUserInputAdressLabel    = '//div[@id="newuser"]/div/div[4]/label';
        public static $TabNewUserSelectDeliveryLabel = '//div[@id="newuser"]/div/div[5]/label';
        public static $TabNewUserSelectPaymentLabel  = '//div[@id="newuser"]/div/div[6]/label';
    //--------------------------------------------------------------------------
    //--------------------------ТАБ ПОШУК КОРИСТУВАЧА---------------------------
    //--------------------------------------------------------------------------
    public static $TabSearchUser                    = 'a[href="#searchuser"]';
        //поля для вводу
        public static $TabSearchUserInputUser       = '#usersForOrders';
        
        public static $TabSearchUserInputEmail      = '#userEmail';
        public static $TabSearchUserInputPhone      = '#userPhone';
        public static $TabSearchUserInputAdress     = '#userAddress';
        //селекти
        public static $TabSearchUserSelectResult    = '#listUsersForOrder';
        public static $TabSearchUserSelectDelivery  = '//div[@id="searchuser"]//select[@class="shopOrdersdeliveryMethod"]';
        public static $TabSearchUserSelectPayment   = '//div[@id="searchuser"]//select[@class="shopOrdersPaymentMethod"]';
            //варіанти в селектах
            public static function tabSearchUserSelectResultOption($number)  { return "//select[@id='listUsersForOrder']/option[$number]";}
            public static function tabSearchUserSelectDeliveryOption($number){ return "//div[@id='searchuser']//select[@class='shopOrdersdeliveryMethod']/option[$number]";}
            public static function tabSearchUserSelectPaymentOption($number) { return "//div[@id='searchuser']//select[@class='shopOrdersPaymentMethod']/option[$number]";}
    //--------------------------------------------------------------------------
    //--------------------------ТАБЛИЦЯ КОРЗИНА---------------------------------
    //--------------------------------------------------------------------------
    //заголовки таблиці
    public static $HeadDelete           = '//*[@id="productsInCart"]//thead//th[1]';
    public static $HeadProductText      = '//*[@id="productsInCart"]//thead//th[2]';
    public static $HeadArticleText      = '//*[@id="productsInCart"]//thead//th[3]';
    public static $HeadVariantText      = '//*[@id="productsInCart"]//thead//th[4]';
    public static $HeadPriceText        = '//*[@id="productsInCart"]//thead//th[5]';
    public static $HeadAmountText       = '//*[@id="productsInCart"]//thead//th[6]';
    public static $HeadTotalPriceText   = '//*[@id="productsInCart"]//thead//th[7]';
    //рядки таблиці
    public static function lineDeleteButton($row)           { return "//*[@id='productsInCart']//tbody//tr[$row]/td[1]/button"; }
    public static function lineProductLink($row)            { return "//*[@id='productsInCart']//tbody//tr[$row]/td[2]//a";     }
    public static function lineArticleText($row)            { return "//*[@id='productsInCart']//tbody//tr[$row]/td[3]/span";   }
    public static function lineVarianText($row)             { return "//*[@id='productsInCart']//tbody//tr[$row]/td[4]/span";   }
    public static function linePriceText($row)              { return "//*[@id='productsInCart']//tbody//tr[$row]/td[5]/span";   }
    public static function lineAmountInput($row)            { return "//*[@id='productsInCart']//tbody//tr[$row]/td[6]//input"; }
    public static function lineTotalPriceText($row)         { return "//*[@id='productsInCart']//tbody//tr[$row]/td[7]/span[1]";}
    public static function lineTotalPriceCurrencyText($row) { return "//*[@id='productsInCart']//tbody//tr[$row]/td[7]/span[2]";}
    //футер таблиці
    public static $FooterGiftCertificateInput   = '#shopOrdersCheckGiftCert';
    public static $FooterTotalPrice             = '//span[@class="gen_sum d-i_b v-a_m"]/b/span[1]';
    public static $FooterTotalPriceLabel        = '.gen_sum.d-i_b.v-a_m';
    public static $FooterTotalPriceCurrency     = '//span[@class="gen_sum d-i_b v-a_m"]/b/span[2]';
}