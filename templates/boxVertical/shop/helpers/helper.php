<?php

if (!function_exists('month')) {

    function month($nm) {
        $month = array(1 => lang('Января', 'boxVertical'), 2 => lang('Февраля', 'boxVertical'), 3 => lang('Марта', 'boxVertical'), 4 => lang('Апреля', 'boxVertical'), 5 => lang('Мая', 'boxVertical'), 6 => lang('Июня', 'boxVertical'), 7 => lang('Июля', 'boxVertical'), 8 => lang('Августа', 'boxVertical'), 9 => lang('Сентября', 'boxVertical'), 10 => lang('Октября', 'boxVertical'), 11 => lang('Ноября', 'boxVertical'), 12 => lang('Декабря', 'boxVertical'));
        return $month[$nm];
    }

}
?>