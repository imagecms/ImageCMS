<?php

class OrdersListCreatePage
{
    public static $URL                              = '/admin/components/run/shop/orders/create';
    
    //заголовки
    public static $Title                            = '.title';
    public static $BlockCreateTitle                 = '//section[@class="mini-layout"]//th';

    //кнопки
    public static $ButtonBack                       = '.t-d_u';
    public static $ButtonCreate                     = '//section[@class="mini-layout"]/div[1]/div[2]/div/button[1]';
    public static $ButtonCreateExit                 = '//section[@class="mini-layout"]/div[1]/div[2]/div/button[2]';
    
    //таби
    //--------------------------ТАБ ШВИДКИЙ ПОШУК-------------------------------
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
    public static $TabAdvancedSearch                    = 'a[href="#advancedsearch"]';
        //селекти
        public static $TabAdvancedSearchSelectCategory  = '#advancedsearch .chosen-single';
        public static $TabAdvancedSearchSelectResult    = '#advancedsearch .productsForOrders.notchosen';
        public static $TabAdvancedSearchSelectVariant   = '//div[@id="advancedsearch"]//select[@class="variantsForOrders"]';
            //варіанти в селектах
            public static function tabAdvancedSearchSelectCategoryOption($number){ return "//div[@id='categoryForOrders_chosen']//ul[@class='chosen-results']//li[$number]";}
            public static function tabAdvancedSearchSelectResultOption($number)  { return "//div[@id='advancedsearch']//select[@class='productsForOrders notchosen']/option[$number]";}
            public static function tabAdvancedSearchSelectVariantOption($number)  { return "//div[@id='advancedsearch']//select[@class='variantsForOrders']/option[$number]";}
        
        //поля для вводу
        public static $TabAdvancedSearchSelectCtegoryInput      = '.chosen-search>input'; 
    //--------------------------------------------------------------------------
    
    //--------------------------ТАБ НОВИЙ КОРИСТУВАЧ----------------------------
    public static $TabNewUser                       = 'a[href="#newuser"]';
    //--------------------------------------------------------------------------
    
    //--------------------------ТАБ ПОШУК КОРИСТУВАЧА---------------------------
    public static $TabSearchUser                    = 'a[href="#searchuser"]';
    //--------------------------------------------------------------------------
    



    //чекбокси
    public static $Check                    = '';
    
    //текст
    public static $Text                     = '';
    
    //лейбли
    public static $ElementNameLabel         = '';
}