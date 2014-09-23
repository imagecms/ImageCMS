<?php

class OrdersListPage
{

    public static $URL                          = '/admin/components/run/shop/orders/index';
    public static $Title                        = '.title';
    
    //кнопки
    public static $ButtonCreate                 = '.btn.btn-small.btn-success.pjax';
    public static $ButtonDelete                 = '.btn.btn-small.btn-danger.action_on';
    
    public static $ButtonFilter                 = '//section[@class="mini-layout"]/div[1]/div[2]/div/button[1]';
    public static $ButtonCancelFiltration       = '//section[@class="mini-layout"]/div[1]/div[2]/div/a[1]';
    public static $ButtonChangeStatus           = '//section[@class="mini-layout"]/div[1]/div[2]/div/div/button';
    
    //заголовки таблиці
    public static $HeadCheck                    = '//section[@class="mini-layout"]//thead/tr[1]/th[1]/span/span';
    public static $HeadIDLink                   = '//section[@class="mini-layout"]//thead/tr[1]/th[2]/a';
    public static $HeadStatusLink               = '//section[@class="mini-layout"]//thead/tr[1]/th[3]/a';
    public static $HeadDateLink                 = '//section[@class="mini-layout"]//thead/tr[1]/th[4]/a';
    public static $HeadCustomerText             = '//section[@class="mini-layout"]//thead/tr[1]/th[5]';
    public static $HeadProductsText             = '//section[@class="mini-layout"]//thead/tr[1]/th[6]';
    public static $HeadTotalPriceLink           = '//section[@class="mini-layout"]//thead/tr[1]/th[7]/a';
    public static $HeadPaymentStatusLink        = '//section[@class="mini-layout"]//thead/tr[1]/th[8]/a';
    
    //фільтр
    public static $FilterIDInput                = '[name="order_id"]';
    public static $FilterDateInputFrom          = '[name="created_from"]';
    public static $FilterDateInputTo            = '[name="created_to"]';
    public static $FilterCustomerInput          = '[name="customer"]';
    public static $FilterProductsInput          = '[name="product"]';
    public static $FilterTotalPriceInputFrom    = '[name="amount_from"]';
    public static $FilterTotalPriceInputTo      = '[name="amount_to"]';
    
    public static $FilterStatusSelect           = '[name="status_id"]';
    public static $FilterPaymentStatusSelect    = '[name="paid"]';

    public static function filterSelectStatusOption($number)        { return "//select[@name='status_id']/option[$number]"; }
    public static function filterSelectPaymentStatusOption($number) { return "//select[@name='paid']/option[$number]";      }

    //рядки таблиці
    public static function lineCheck($row)              { return "//section[@class='mini-layout']//tbody/tr[$row]/td[1]/span/span"; }
    public static function lineIDLink($row)             { return "//section[@class='mini-layout']//tbody/tr[$row]/td[2]/a"; }
    public static function lineStatusText($row)         { return "//section[@class='mini-layout']//tbody/tr[$row]/td[3]/span"; }
    public static function lineDateText($row)           { return "//section[@class='mini-layout']//tbody/tr[$row]/td[4]"; }
    public static function lineCustomerLink($row)       { return "//section[@class='mini-layout']//tbody/tr[$row]/td[5]/a"; }
    public static function lineProductsText($row)       { return "//section[@class='mini-layout']//tbody/tr[$row]/td[6]/div[1]/span"; }
    public static function lineProductsInfo($row)       { return "//section[@class='mini-layout']//tbody/tr[$row]/td[6]/div[1]/i"; }
    public static function lineTotalPriceText($row)     { return "//section[@class='mini-layout']//tbody/tr[$row]/td[7]"; }
    public static function linePaymentStatusText($row)  { return "//section[@class='mini-layout']//tbody/tr[$row]/td[8]/span"; }
    
    //футер таблиці
    public static $FooterProductsText               =  '//section[@class="mini-layout"]//tbody/tr[last()]/td[6]';
    public static $FooterTotalPriceText             =  '//section[@class="mini-layout"]//tbody/tr[last()]/td[7]';
    public static $FooterPaymentStatusText          =  '//section[@class="mini-layout"]//tbody/tr[last()]/td[8]';
    
    //селекти (пагінація)
    public static $SelectPagination                 = '.input-mini';
    public static function selectPaginationOption($number) { return "//select[@class='input-mini']/option[$number]";}


    //лейбли
    public static $SelectPaginationLabel            = '//div[@class="pagination pull-right"][2]';
    
    //вікно видалення
    static $WindowDelete                = '.modal.hide.fade.in';
    static $WindowDeleteTitle           = '.modal.hide.fade.in>div.modal-header>h3';
    static $WindowDeleteQuestion        = '.modal.hide.fade.in>div.modal-body>p';
    static $WindowDeleteButtonDelete    = '.modal.hide.fade.in>div.modal-footer>a:nth-child(1)';
    static $WindowDeleteButtonBack      = '.modal.hide.fade.in>div.modal-footer>a:nth-child(2)';
    static $WindowDeleteButtonClose     = '.modal.hide.fade.in>div.modal-header>button';

}