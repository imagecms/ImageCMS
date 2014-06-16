<?php

if (!function_exists('month')) {

    function month($nm) {
        $month = array(1 => lang('Января', 'greyVision'), 2 => lang('Февраля', 'greyVision'), 3 => lang('Марта', 'greyVision'), 4 => lang('Апреля', 'greyVision'), 5 => lang('Мая', 'greyVision'), 6 => lang('Июня', 'greyVision'), 7 => lang('Июля', 'greyVision'), 8 => lang('Августа', 'greyVision'), 9 => lang('Сентября', 'greyVision'), 10 => lang('Октября', 'greyVision'), 11 => lang('Ноября', 'greyVision'), 12 => lang('Декабря', 'greyVision'));
        return $month[$nm];
    }

}
?>