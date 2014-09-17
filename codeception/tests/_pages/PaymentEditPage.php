<?php

class PaymentEditPage
{
    public static $Title                    = '.title';
 
    //блок редагування
    public static $BlockEditTitle           = '//section[@class="mini-layout"]//th';
    
    //чекбокси
    public static $CheckActive              = '.niceCheck';
    
    //Кнопки
    public static $ButtonBack               = '.t-d_u';
    public static $ButtonSave               = '.btn.btn-small.btn-primary.formSubmit';
    public static $ButtonSaveExit           = '.btn.btn-small.formSubmit:nth-child(3)';
    public static $ButtonLanguage           = '.btn.dropdown-toggle.btn-small';
    
    //лейбли
    public static $InputNameLabel           = '//section[@class="mini-layout"]//form/div[1]/div[1]/label';
    public static $SelectCurrencyLabel      = '//section[@class="mini-layout"]//form/div[1]/div[2]/label';
    public static $CheckActiveLabel         = '//section[@class="mini-layout"]//form/div[1]/div[3]/div[2]/span';
    public static $InputDescriptionLable    = '//section[@class="mini-layout"]//form/div[2]/label';
    public static $SelectPaymentSystemLabel = '//section[@class="mini-layout"]//form/div[3]/div[1]/label';
    
    //поля для вводу
    public static $InputName            = '[name="Name"]';
    public static $InputDescription     = '[name="Description"]';
    
    //Selects
    public static $SelectCurrency       = '[name="CurrencyId"]';
    public static function selectCurrencyOption($row) {
        return "//select[@name='CurrencyId']/option[$row]";
    }
    
    public static $SelectPaymentSystem  = '//select[@name="PaymentSystemName"]';
    public static function selectPaymentSystemOption($row){
        return "//select[@name='PaymentSystemName']/option[$row]";
    }
}