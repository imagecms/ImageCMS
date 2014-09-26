<?php

class DeliveryEditPage
{
    
    
    //заголовки
    public static $Title                        = '.title';
    public static $TitleBlockEdit               = '//section[@class="mini-layout"]//th';
    
    //кнопки
    Public static $ButtonBack                   = '.t-d_u';
    Public static $ButtonSave                   = '.btn.btn-small.btn-primary.formSubmit';
    Public static $ButtonSaveExit               = '.btn.btn-small.action_on.formSubmit';
    public static $ButtonLanguage               = '.btn.dropdown-toggle.btn-small';
    
    //поля для вводу
    public static $InputName                    = '#Name';
    public static $InputDescription             = '#Description';
    public static $InputDescriptionPrice        = '#pricedescription';
    public static $InputPrice                   = '#Price';
    public static $InputFreeFrom                = '#FreeFrom';
    public static $InputPriceSpecified          = '[name="delivery_sum_specified_message"]';

    //чекбокси
    public static $CheckActive               = '//form[@id="deliveryUpdate"]/div[2]/div[2]/span/span';
    public static $CheckPriceSpecified          = '//span[@id="deliverySumSpecifiedSpan"]';

    
    //лейбли
    public static $InputNameLabel               = 'label[for="Name"]';
    public static $InputDescriptionLabel        = 'label[ for="Description"]';
    public static $InputDescriptionPriceLabel   = 'label[for="priceDescription"]';
    public static $InputPriceLabel              = 'label[for="Price"]';
    public static $InputFreeFromLabel           = 'label[for="FreeFrom"]';
    public static $InputPriceSpecifiedLabel     = "#deliverySumSpecifiedMessageSpan label";
    
    public static $CheckActiveLabel             = '//form[@id="deliveryUpdate"]/div[2]/div[2]/span';
    public static $CheckPriceSpecifiedLabel     = '//div[@id="deliveryPriceDisableBlock"]/div[2]/div[2]/span';
    
    
    //поле з чекбоксами
    public static $FieldPaymentLabel            = "//form[@id='deliveryUpdate']/div[5]/div[3]/div[1]";
    
    public static function checkPaymentMethodLabel($row) { return "//div[5]/div[3]/div[2]/span[$row]";           }
    public static function checkPaymentMethod($row)      { return "//form/div[5]/div[3]/div[2]/span[$row]/span"; }
}    
