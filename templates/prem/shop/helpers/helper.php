<?php

if (!function_exists('month')) {

    function month($nm) {
        $month = array(1 => lang('Января', 'newLevel'), 2 => lang('Февраля', 'newLevel'), 3 => lang('Марта', 'newLevel'), 4 => lang('Апреля', 'newLevel'), 5 => lang('Мая', 'newLevel'), 6 => lang('Июня', 'newLevel'), 7 => lang('Июля', 'newLevel'), 8 => lang('Августа', 'newLevel'), 9 => lang('Сентября', 'newLevel'), 10 => lang('Октября', 'newLevel'), 11 => lang('Ноября', 'newLevel'), 12 => lang('Декабря', 'newLevel'));
        return $month[$nm];
    }

}

if (!function_exists('data_translate')) {

    function data_translate($date) {
        $month = array(
            1 => lang('Січня', 'prem'),
            2 => lang('Лютого', 'prem'),
            3 => lang('Березня', 'prem'),
            4 => lang('Квітня', 'prem'),
            5 => lang('Травня', 'prem'),
            6 => lang('Червня', 'prem'),
            7 => lang('Липня', 'prem'),
            8 => lang('Серпня', 'prem'),
            9 => lang('Вересня', 'prem'),
            10 => lang('Жовтня', 'prem'),
            11 => lang('Листопада', 'prem'),
            12 => lang('Грудня', 'prem'));
        $return = date('d', $date) . ' ' . $month[date('n', $date)] . ' ' . date('Y', $date);
        return $return;
    }

}
?>