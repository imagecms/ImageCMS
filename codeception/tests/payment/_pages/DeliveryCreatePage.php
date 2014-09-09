<?php

class DeliveryCreatePage
{
    public static $URL = "/admin/components/run/shop/deliverymethods/create";
    public static $FieldNameLabel = "//*[@id='createDelivery']/div[1]/label";
    public static $FieldName = "//*[@id='Name']";
    public static $CheckboxActiveLabel = "//form[@id='createDelivery']/div[2]/div[2]/span";
    public static $CheckboxActive = "//*[@id='createDelivery']/div[2]/div[2]/span/span";
    public static $FieldDescriptionLabel = "//*[@id='createDelivery']/div[3]/label";
    public static $FieldDescription = ".//*[@id='Description']";
    public static $FieldDescriptionPriceLabel = ".//*[@id='createDelivery']/div[4]/label";
    public static $FieldDescriptionPrice = "//*[@id='priceDescription']";
    public static $FieldPriceLabel = "//*[@id='deliveryPriceDisableBlock']/div[1]/label";
    public static $FieldPrice = "//*[@id='Price']";
    public static $FieldFreeFromLabel = "//*[@id='deliveryPriceDisableBlock']/div[2]/label";
    public static $FieldFreeFrom = "//*[@id='FreeFrom']";
    public static $CheckboxPriceSpecifiedLabel = "//*[@id='deliveryPriceDisableBlock']/div[2]/div[2]/span";
    public static $CheckboxPriceSpecified = "//*[@id='deliverySumSpecifiedSpan']";
    public static $FieldPriceSpecified = "//*[@name='delivery_sum_specified_message']";
    public static $FieldPriceSpecifiedLabel = ".//*[@id='deliverySumSpecifiedMessageSpan']/label";
    public static $PaymentLabel = "//*[@id='mainContent']/div/section/div[2]/table/tbody/tr/td/div/div/div[3]/div[1]";
    public static function PaymentMethodLabel($row){
        $Payment = "//tbody/tr/td/div/div/div[3]/div[2]/div[$row]/button";
        return $Payment;
    }
    Public static $ButtonCreateExit = ".btn.btn-small.action_on.formSubmit";
    Public static $ButtonCreate = ".btn.btn-small.btn-success.formSubmit";
    Public static $ButtonBack = ".t-d_u";
}