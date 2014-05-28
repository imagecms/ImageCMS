<?php

if (!function_exists('month')) {

    function month($nm) {
        $month = array(1 => lang('Января', 'boxGreen'), 2 => lang('Февраля', 'boxGreen'), 3 => lang('Марта', 'boxGreen'), 4 => lang('Апреля', 'boxGreen'), 5 => lang('Мая', 'boxGreen'), 6 => lang('Июня', 'boxGreen'), 7 => lang('Июля', 'boxGreen'), 8 => lang('Августа', 'boxGreen'), 9 => lang('Сентября', 'boxGreen'), 10 => lang('Октября', 'boxGreen'), 11 => lang('Ноября', 'boxGreen'), 12 => lang('Декабря', 'boxGreen'));
        return $month[$nm];
    }

}
?>