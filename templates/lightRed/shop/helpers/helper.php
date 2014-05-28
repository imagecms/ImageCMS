<?php

if (!function_exists('month')) {

    function month($nm) {
        $month = array(1 => lang('Января', 'lightRed'), 2 => lang('Февраля', 'lightRed'), 3 => lang('Марта', 'lightRed'), 4 => lang('Апреля', 'lightRed'), 5 => lang('Мая', 'lightRed'), 6 => lang('Июня', 'lightRed'), 7 => lang('Июля', 'lightRed'), 8 => lang('Августа', 'lightRed'), 9 => lang('Сентября', 'lightRed'), 10 => lang('Октября', 'lightRed'), 11 => lang('Ноября', 'lightRed'), 12 => lang('Декабря', 'lightRed'));
        return $month[$nm];
    }

}
?>