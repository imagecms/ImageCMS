<?php

if (!function_exists('month')) {

    function month($nm) {
        $month = array(1 => lang('Января', 'newLevel'), 2 => lang('Февраля', 'newLevel'), 3 => lang('Марта', 'newLevel'), 4 => lang('Апреля', 'newLevel'), 5 => lang('Мая', 'newLevel'), 6 => lang('Июня', 'newLevel'), 7 => lang('Июля', 'newLevel'), 8 => lang('Августа', 'newLevel'), 9 => lang('Сентября', 'newLevel'), 10 => lang('Октября', 'newLevel'), 11 => lang('Ноября', 'newLevel'), 12 => lang('Декабря', 'newLevel'));
        return $month[$nm];
    }

}
?>