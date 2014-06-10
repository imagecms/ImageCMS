<?php

if (!function_exists('month')) {

    function month($nm) {
        $month = array(1 => lang('Января', 'newLevelVertical'), 2 => lang('Февраля', 'newLevelVertical'), 3 => lang('Марта', 'newLevelVertical'), 4 => lang('Апреля', 'newLevelVertical'), 5 => lang('Мая', 'newLevelVertical'), 6 => lang('Июня', 'newLevelVertical'), 7 => lang('Июля', 'newLevelVertical'), 8 => lang('Августа', 'newLevelVertical'), 9 => lang('Сентября', 'newLevelVertical'), 10 => lang('Октября', 'newLevelVertical'), 11 => lang('Ноября', 'newLevelVertical'), 12 => lang('Декабря', 'newLevelVertical'));
        return $month[$nm];
    }

}
?>