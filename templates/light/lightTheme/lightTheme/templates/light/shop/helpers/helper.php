<?php

if (!function_exists('month')) {

    function month($nm) {
        $month = array(1 => lang('Января', 'light'), 2 => lang('Февраля', 'light'), 3 => lang('Марта', 'light'), 4 => lang('Апреля', 'light'), 5 => lang('Мая', 'light'), 6 => lang('Июня', 'light'), 7 => lang('Июля', 'light'), 8 => lang('Августа', 'light'), 9 => lang('Сентября', 'light'), 10 => lang('Октября', 'light'), 11 => lang('Ноября', 'light'), 12 => lang('Декабря', 'light'));
        return $month[$nm];
    }

}
?>