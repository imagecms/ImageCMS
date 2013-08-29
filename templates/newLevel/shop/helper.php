<?php

function promoLabel($action, $hot, $hit, $disc) {
    $pricePrecision = ShopCore::app()->SSettings->pricePrecision;
    $out = "";

    if ($action && (int) $action > 0)
        $out .= '<span class="product-status action"></span>';
    if ($hot && (int) $hot > 0)
        $out .= '<span class="product-status nowelty"></span>';
    if ($hit && (int) $hit > 0)
        $out .= '<span class="product-status hit"></span>';
    if ($disc && (float) $disc > 0)
        $out .= '<span class="product-status discount"><span class="text-el">' . round($disc, 0) . '%</span></span>';
    return $out;
}

function promoLabelBtn($action, $hot, $hit, $disc) {
    $out = array();
    if ($action && (int) $action > 0)
        $out['action'] = $action;
    if ($hot && (int) $hot > 0)
        $out['hot'] = $hot;
    if ($hit && (int) $hit > 0)
        $out['hit'] = $hit;
    if ($disc && (float) $disc > 0)
        $out['disc'] = round($disc, 0);

    return $out;
}

function month($nm) {
    $month = array(1 => 'Января', 2 => 'Февраля', 3 => 'Марта', 4 => 'Апреля', 5 => 'Мая', 6 => 'Июня', 7 => 'Июля', 8 => 'Августа', 9 => 'Сентября', 10 => 'Октября', 11 => 'Ноября', 12 => 'Декабря');
    return $month[$nm];
}
?>