<?php

class DeliveryPage
{
    //ListElements
    public static $ListCreateButton = ".btn.btn-small.btn-success.pjax";
    public static $ListDeleteButton = ".btn.btn-small.btn-danger.action_on";
    public static $ListCheckboxHeader = "//table/thead/tr/th[1]/span/span";
    public static function ListCheckboxLine($row){
        $ListCheckboxLine  = "//table/tbody/tr[$row]/td[1]/span/span";
        return $ListCheckboxLine;
    }
}