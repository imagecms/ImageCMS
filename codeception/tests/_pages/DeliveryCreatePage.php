<?php

class DeliveryCreatePage
{
//адрес
    public static $URL = "/admin/components/run/shop/deliverymethods/create";
    
    
//блок лейбл
    public static $BlockCreateLabel = '//section[@class="mini-layout"]//th';

//кнопки
    Public static $ButtonBack                   = '.t-d_u';
    Public static $ButtonCreate                 = '.btn.btn-small.btn-success.formSubmit';
    Public static $ButtonCreateExit             = '.btn.btn-small.action_on.formSubmit';
    
//поля
    public static $InputName                    = '#Name';
    public static $InputDescription             = '#Description';
    public static $InputDescriptionPrice        = '#priceDescription';
    public static $InputPrice                   = '#Price';
    public static $InputFreeFrom                = '#FreeFrom';
    public static $InputPriceSpecified          = '[name="delivery_sum_specified_message"]';

//чекбокси
    public static $CheckActive                  = '//form[@id="createDelivery"]/div[2]/div[2]/span/span';
    public static $CheckPriceSpecified          = '#deliverySumSpecifiedSpan';

//лейбли
    public static $InputNameLabel               = 'label[for="Name"]';
    public static $InputDescriptionLabel        = 'label[for="Description"]';
    public static $InputDescriptionPriceLabel   = 'label[for="priceDescription"]'; 
    public static $InputPriceLabel              = 'label[for="Price"]';
    public static $InputFreeFromLabel           = 'label[for="FreeFrom"]';
    public static $InputPriceSpecifiedLabel     = '#deliverySumSpecifiedMessageSpan label';
    public static $CheckActiveLabel             = '//form[@id="createDelivery"]/div[2]/div[2]/span';
    public static $CheckPriceSpecifiedLabel     = '//div[@id="deliveryPriceDisableBlock"]/div[2]/div[2]/span';
    
//поле з чекбоксами
    public static $FieldPaymentLabel = 'div[for="inputRecCount"]';
    
    public static function checkPaymentMethodLabel($row){
        return "//section[@class='mini-layout']/div[2]/table/tbody/tr/td/div/div/div[2]/div[2]/div[$row]/button";
    }
    public static function checkPaymentMethod($row){
        return "//section[@class='mini-layout']/div[2]/table/tbody/tr/td/div/div/div[2]/div[2]/div[$row]/button/span";
    }
}