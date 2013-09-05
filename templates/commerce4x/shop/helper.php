<?php
if (!function_exists('promoLabel')) {
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
        $out .= '<span class="product-status discount"><span class="text-el">' . round($disc, $pricePrecision) . '%</span></span>';
    return $out;
}
}
if (!function_exists('promoLabelBtn')) {
function promoLabelBtn($action, $hot, $hit, $disc) {
    $out = array();
    if ($action && (int) $action > 0)
        $out['action'] = $action;
    if ($hot && (int) $hot > 0)
        $out['hot'] = $hot;
    if ($hit && (int) $hit > 0)
        $out['hit'] = $hit;
    if ($disc && (float) $disc > 0)
        $out['disc'] = $disc;

    return $out;
}
}
if (!function_exists('month')) {

function month($nm) {
    $month = array(1 => lang('Января', 'newLevel'), 2 => lang('Февраля', 'newLevel'), 3 => lang('Марта', 'newLevel'), 4 => lang('Апреля', 'newLevel'), 5 => lang('Мая', 'newLevel'), 6 => lang('Июня', 'newLevel'), 7 => lang('Июля', 'newLevel'), 8 => lang('Августа', 'newLevel'), 9 => lang('Сентября', 'newLevel'), 10 => lang('Октября', 'newLevel'), 11 => lang('Ноября', 'newLevel'), 12 => lang('Декабря', 'newLevel'));
    return $month[$nm];
}
}
?>