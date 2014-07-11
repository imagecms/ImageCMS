<?php

class PaymentPage
{
    // include url of current page
    static $URL = '/admin/components/run/shop/paymentmethods/index';
    static function ListMethodLine($row) {
        $ListMethodLine = "//table//tbody//tr[$row]/td[3]";
        return $ListMethodLine;
    }

}