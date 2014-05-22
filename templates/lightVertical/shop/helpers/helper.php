<?php

if (!function_exists('month')) {

    function month($nm) {
        $month = array(1 => lang('Января', 'lightVertical'), 2 => lang('Февраля', 'lightVertical'), 3 => lang('Марта', 'lightVertical'), 4 => lang('Апреля', 'lightVertical'), 5 => lang('Мая', 'lightVertical'), 6 => lang('Июня', 'lightVertical'), 7 => lang('Июля', 'lightVertical'), 8 => lang('Августа', 'lightVertical'), 9 => lang('Сентября', 'lightVertical'), 10 => lang('Октября', 'lightVertical'), 11 => lang('Ноября', 'lightVertical'), 12 => lang('Декабря', 'lightVertical'));
        return $month[$nm];
    }

}
?>