<?php

class DeliveryCreatePage
{
    public static $URL = "/admin/components/run/shop/deliverymethods/create";
    public static $InputNameLabel = "//*[@id='createDelivery']/div[1]/label";
    public static $InputName = "//*[@id='Name']";
    public static $CheckActiveLabel = "//form[@id='createDelivery']/div[2]/div[2]/span";
    public static $CheckActive = "//*[@id='createDelivery']/div[2]/div[2]/span/span";
    public static $InputDescriptionLabel = "//*[@id='createDelivery']/div[3]/label";
    public static $InputDescription = ".//*[@id='Description']";
    public static $InputDescriptionPriceLabel = ".//*[@id='createDelivery']/div[4]/label";
    public static $InputDescriptionPrice = "//*[@id='priceDescription']";
    public static $InputPriceLabel = "//*[@id='deliveryPriceDisableBlock']/div[1]/label";
    public static $InputPrice = "//*[@id='Price']";
    public static $InputFreeFromLabel = "//*[@id='deliveryPriceDisableBlock']/div[2]/label";
    public static $InputFreeFrom = "//*[@id='FreeFrom']";
    public static $CheckPriceSpecifiedLabel = "//*[@id='deliveryPriceDisableBlock']/div[2]/div[2]/span";
    public static $CheckPriceSpecified = "//*[@id='deliverySumSpecifiedSpan']";
    public static $InputPriceSpecified = "//*[@name='delivery_sum_specified_message']";
    public static $InputPriceSpecifiedLabel = ".//*[@id='deliverySumSpecifiedMessageSpan']/label";
    public static $FieldPaymentLabel = "//section/div[2]/table/tbody/tr/td/div/div/div[2]/div[1]";
    
    public static function CheckPaymentMethodLabel($row){
        $Payment = "//section[@class='mini-layout']/div[2]/table/tbody/tr/td/div/div/div[2]/div[2]/div[$row]/button";
        return $Payment;
    }
    Public static $ButtonBack = ".t-d_u";
    Public static $ButtonCreate = ".btn.btn-small.btn-success.formSubmit";
    Public static $ButtonCreateExit = ".btn.btn-small.action_on.formSubmit";
}