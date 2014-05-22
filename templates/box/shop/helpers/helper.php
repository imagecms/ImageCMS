<?php

if (!function_exists('month')) {

    function month($nm) {
        $month = array(1 => lang('Января', 'box'), 2 => lang('Февраля', 'box'), 3 => lang('Марта', 'box'), 4 => lang('Апреля', 'box'), 5 => lang('Мая', 'box'), 6 => lang('Июня', 'box'), 7 => lang('Июля', 'box'), 8 => lang('Августа', 'box'), 9 => lang('Сентября', 'box'), 10 => lang('Октября', 'box'), 11 => lang('Ноября', 'box'), 12 => lang('Декабря', 'box'));
        return $month[$nm];
    }

}
?>