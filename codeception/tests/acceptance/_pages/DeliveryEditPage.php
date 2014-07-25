<?php

class DeliveryEditPage
{
    public static $FieldNameLabel = "//*[@id='deliveryUpdate']/div[1]/div/label";
    public static $FieldName = "#Name";
    public static $CheckboxActiveLabel = "//*[@id='deliveryUpdate']/div[2]/div[2]/span";
    public static $CheckboxActive = "//*[@id='deliveryUpdate']/div[2]/div[2]/span/span";
    public static $FieldDescriptionLabel = "//div[3]/label";
    public static $FieldDescription = "//*[@id='Description']";
    public static $FieldDescriptionPriceLabel = "//div[4]/label";
    public static $FieldDescriptionPrice = "//*[@id='pricedescription']";
    public static $FieldPriceLabel = "//*[@id='deliveryPriceDisableBlock']/div[1]/label";
    public static $FieldPrice = "//*[@id='Price']";
    public static $FieldFreeFromLabel = "//*[@id='deliveryPriceDisableBlock']/div[2]/label";
    public static $FieldFreeFrom = "//*[@id='FreeFrom']";
    public static $CheckboxPriceSpecifiedLabel = "//*[@id='deliveryPriceDisableBlock']/div[2]/div[2]/span";
    public static $CheckboxPriceSpecified = "//*[@id='deliverySumSpecifiedSpan']";
    public static $FieldPriceSpecified = "//*[@name='delivery_sum_specified_message']";
    public static $FieldPriceSpecifiedLabel = "//*[@id='deliverySumSpecifiedMessageSpan']/label";
    public static $PaymentLabel = "//*[@id='deliveryUpdate']/div[5]/div[3]/div[1]";
    public static function PaymentMethodLabel($row){
        $Payment = "//div[5]/div[3]/div[2]/span[$row]";
        return $Payment;
    }
    Public static $ButtonSaveExit = ".btn.btn-small.action_on.formSubmit";
    Public static $ButtonSave = ".btn.btn-small.btn-primary.formSubmit";
    Public static $ButtonBack = ".t-d_u";
}    
