<?php

if (!function_exists('month')) {

    function month($nm) {
        $month = array(1 => lang('Января', 'inTime'), 2 => lang('Февраля', 'inTime'), 3 => lang('Марта', 'inTime'), 4 => lang('Апреля', 'inTime'), 5 => lang('Мая', 'inTime'), 6 => lang('Июня', 'inTime'), 7 => lang('Июля', 'inTime'), 8 => lang('Августа', 'inTime'), 9 => lang('Сентября', 'inTime'), 10 => lang('Октября', 'inTime'), 11 => lang('Ноября', 'inTime'), 12 => lang('Декабря', 'inTime'));
        return $month[$nm];
    }

}
?>